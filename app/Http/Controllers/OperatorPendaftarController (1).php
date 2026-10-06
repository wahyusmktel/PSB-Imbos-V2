<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkunPendaftar;
use App\Models\ConfigJalurModel;
use App\Models\ConfigJenjangModel;
use App\Models\District;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert; // SweetAlert
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftarAlamatModel; // Pastikan model PendaftarAlamat diimpor
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use App\Models\BiodataDiriModel; // Pastikan model BiodataDiri diimpor
use App\Models\BiodataOrangTuaModel; // Pastikan model BiodataOrangTua diimpor
use App\Models\BiodataPenyakitModel;
use App\Models\ConfigBerkasModel;
use App\Models\PendaftarBerkas; // Pastikan model PendaftarBerkas diimpor
use App\Models\PendaftarJalurModel;
use App\Models\PendaftarJenjangModel;
use App\Models\PendaftarTransaksiModel;
use Illuminate\Support\Facades\Storage; // Untuk mengelola file upload
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Exports\PendaftarExport;
use Maatwebsite\Excel\Facades\Excel;

class OperatorPendaftarController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data untuk filter
        $jenjangs = ConfigJenjangModel::all();
        $jalurs = ConfigJalurModel::all();

        // Ambil keyword pencarian dari form input
        $search = $request->input('search');

        // Query untuk mendapatkan data dengan pencarian, paginasi, dan eager loading relasi pendaftarJenjang
        $akunPendaftars = AkunPendaftar::with('pendaftarJenjang.jenjang', 'pendaftarJalur.jalur', 'transaksi','hasilSeleksi')
            ->when($search, function ($query, $search) {
                return $query->where('no_pendaftaran', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('asal_sekolah', 'like', "%{$search}%");
            })
            ->when($request->filter_jenjang, function ($query, $filterJenjang) {
                return $query->whereHas('pendaftarJenjang.jenjang', function ($query) use ($filterJenjang) {
                    $query->where('id', $filterJenjang);
                });
            })
            ->when($request->filter_jalur, function ($query, $filterJalur) {
                return $query->whereHas('pendaftarJalur.jalur', function ($query) use ($filterJalur) {
                    $query->where('id', $filterJalur);
                });
            })
            ->when($request->filter_status_pembayaran, function ($query, $filterStatusPembayaran) {
                if ($filterStatusPembayaran === 'null') {
                    return $query->whereDoesntHave('transaksi');
                } else {
                    return $query->whereHas('transaksi', function ($query) use ($filterStatusPembayaran) {
                        $query->where('status_pembayaran', $filterStatusPembayaran);
                    });
                }
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10) // Paginate dengan 10 item per halaman
            ->appends($request->query());

        // Kirim hasil ke view
        return view('operator.pendaftar.index', compact('akunPendaftars', 'search', 'jenjangs', 'jalurs'));
    }

    // Method untuk menampilkan data pendaftar di form edit
    public function edit($id)
    {
        $akunPendaftar = AkunPendaftar::with('alamat', 'biodataDiri', 'biodataOrangTua', 'pendaftarPenyakit', 'pendaftarBerkas', 'pendaftarJenjang', 'pendaftarJalur')->findOrFail($id);

        $provinces = Province::all();

        // Cek jika sudah ada alamat, ambil data terkait dari kabupaten, kecamatan, dan desa
        $kabupatens = $akunPendaftar->alamat ? Regency::where('province_id', $akunPendaftar->alamat->provinsi_id)->get() : collect();
        $kecamatans = $akunPendaftar->alamat ? District::where('regency_id', $akunPendaftar->alamat->kabupaten_id)->get() : collect();
        $desas = $akunPendaftar->alamat ? Village::where('district_id', $akunPendaftar->alamat->kecamatan_id)->get() : collect();

        // Ambil data jenjang yang tersedia
        $jenjangs = ConfigJenjangModel::all();

        // Ambil data jalur yang tersedia
        $jalurs = ConfigJalurModel::all();

        // Ambil jenjang dan jalur yang dipilih oleh pendaftar
        $pendaftar_jenjang = $akunPendaftar->pendaftarJenjang;
        $pendaftar_jalur = $akunPendaftar->pendaftarJalur;

        // Cek apakah pendaftar sudah memilih jenjang dan jalur
        if (!$pendaftar_jenjang || !$pendaftar_jalur) {
            // Tampilkan pesan peringatan menggunakan SweetAlert
            if (!$pendaftar_jenjang) {
                Alert::warning('Peringatan', 'Pendaftar belum memilih jenjang.');
            }
            if (!$pendaftar_jalur) {
                Alert::warning('Peringatan', 'Pendaftar belum memilih jalur.');
            }
        }

        // // Ambil berkas-berkas yang sesuai dengan jalur_id
        // $berkas = ConfigBerkasModel::where('jalur_id', $pendaftar_jalur->jalur_id)->get();

        // Ambil berkas-berkas yang sesuai dengan jalur_id
        $berkas = $pendaftar_jalur ? ConfigBerkasModel::where('jalur_id', $pendaftar_jalur->jalur_id)->get() : collect();

        // Ambil berkas yang sudah diupload oleh pendaftar
        $uploadedBerkas = PendaftarBerkas::where('pendaftar_id', $akunPendaftar->id)->get()->keyBy('berkas_id');

        // Tandai berkas yang sudah diupload
        foreach ($berkas as $b) {
            $b->uploaded = $uploadedBerkas->get($b->id);
        }

        return view('operator.pendaftar.edit', compact('akunPendaftar', 'provinces', 'kabupatens', 'kecamatans', 'desas', 'jenjangs', 'jalurs', 'berkas')); // Kirim data ke view
    }

    // Method untuk mengupdate data pendaftar
    public function updateAkunPendaftar(Request $request, $id)
    {
        // Validasi input dengan pesan custom
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits:10|unique:akun_pendaftars,nisn,' . $id,
            'asal_sekolah' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nisn.required' => 'NISN wajib diisi dan harus berjumlah 10 digit.',
            'nisn.unique' => 'NISN ini sudah digunakan, harap gunakan NISN lain.',
            'nisn.digits' => 'NISN harus terdiri dari 10 angka.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus memiliki panjang antara 10 hingga 15 angka.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Mencari pendaftar berdasarkan ID
            $akunPendaftar = AkunPendaftar::findOrFail($id);

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            // Update data
            $akunPendaftar->update([
                'nama_lengkap' => $request->input('nama_lengkap'),
                'nisn' => $request->input('nisn'),
                'asal_sekolah' => $request->input('asal_sekolah'),
                'no_hp' => $request->input('no_hp'),
                'password' => bcrypt($request->input('nisn')),
                'updated_by' => $operator->id,
            ]);

            // Mengembalikan pesan sukses dengan SweetAlert
            Alert::success('Berhasil', 'Data pendaftar berhasil diperbarui.');
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            // Jika ada error, tangani dengan try-catch dan tampilkan SweetAlert error
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateAlamat(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'alamat_tempat_tinggal' => 'nullable|string|max:255',
            'provinsi_id' => 'required|exists:provinces,id',
            'kabupaten_id' => 'required|exists:regencies,id',
            'kecamatan_id' => 'required|exists:districts,id',
            'desa_id' => 'required|exists:villages,id',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Mencari data alamat berdasarkan pendaftar_id
            $alamat = PendaftarAlamatModel::where('pendaftar_id', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($alamat) {

                // Update data alamat
                $alamat->update([
                    'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                    'provinsi_id' => $request->provinsi_id,
                    'kabupaten_id' => $request->kabupaten_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'desa_id' => $request->desa_id,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'updated_by' => $operator->id,
                ]);

                Alert::success('Berhasil', 'Data alamat pendaftar berhasil diperbarui.');
            } else {
                // Jika data alamat belum ada, lakukan insert
                PendaftarAlamatModel::create([
                    'pendaftar_id' => $id,
                    'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
                    'provinsi_id' => $request->provinsi_id,
                    'kabupaten_id' => $request->kabupaten_id,
                    'kecamatan_id' => $request->kecamatan_id,
                    'desa_id' => $request->desa_id,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data alamat pendaftar berhasil ditambahkan.');
            }
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function updateDatadiri(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'alamat_asal_sekolah' => 'nullable|string|max:255',
            'ukuran_baju' => 'nullable|string|max:10',
            'pas_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nik' => 'nullable|string|max:16',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',
            'jumlah_saudara_tiri' => 'nullable|integer',
            'jumlah_saudara_angkat' => 'nullable|integer',
            'bahasa_sehari_hari' => 'nullable|string|max:255',
            'bakat_dan_prestasi' => 'nullable|string|max:255',
        ], [
            'alamat_asal_sekolah.max' => 'Alamat asal sekolah tidak boleh lebih dari 255 karakter.',
            'ukuran_baju.max' => 'Ukuran baju tidak boleh lebih dari 10 karakter.',
            'pas_photo.image' => 'Pas photo harus berupa gambar.',
            'pas_photo.mimes' => 'Pas photo harus berformat jpg, png, atau jpeg.',
            'pas_photo.max' => 'Pas photo tidak boleh lebih dari 2MB.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'tgl_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'jenis_kelamin.max' => 'Jenis kelamin tidak boleh lebih dari 10 karakter.',
            'anak_ke.integer' => 'Anak ke harus berupa angka.',
            'jumlah_saudara.integer' => 'Jumlah saudara harus berupa angka.',
            'tinggi_badan.integer' => 'Tinggi badan harus berupa angka.',
            'berat_badan.integer' => 'Berat badan harus berupa angka.',
            'jumlah_saudara_tiri.integer' => 'Jumlah saudara tiri harus berupa angka.',
            'jumlah_saudara_angkat.integer' => 'Jumlah saudara angkat harus berupa angka.',
            'bahasa_sehari_hari.max' => 'Bahasa sehari-hari tidak boleh lebih dari 255 karakter.',
            'bakat_dan_prestasi.max' => 'Bakat dan prestasi tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah biodata diri sudah ada atau belum berdasarkan pendaftar_id
            $biodata = BiodataDiriModel::where('id_pendaftar', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($biodata) {
                // Simpan foto jika ada
                $pasPhoto = null;
                if ($request->hasFile('pas_photo')) {
                    $pasPhoto = $request->file('pas_photo')->store('pas_photos', 'public');
                }
                // Jika data biodata sudah ada, lakukan update
                $biodata->update([
                    'alamat_asal_sekolah' => $request->alamat_asal_sekolah,
                    'ukuran_baju' => $request->ukuran_baju,
                    'pas_photo' => $pasPhoto ?? $biodata->pas_photo,
                    'nik' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'anak_ke' => $request->anak_ke,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    'tinggi_badan' => $request->tinggi_badan,
                    'berat_badan' => $request->berat_badan,
                    'jumlah_saudara_tiri' => $request->jumlah_saudara_tiri,
                    'jumlah_saudara_angkat' => $request->jumlah_saudara_angkat,
                    'bahasa_sehari_hari' => $request->bahasa_sehari_hari,
                    'bakat_dan_prestasi' => $request->bakat_dan_prestasi,
                    'updated_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data diri pendaftar berhasil diperbarui.');
            } else {
                // Simpan foto jika ada
                $pasPhoto = null;
                if ($request->hasFile('pas_photo')) {
                    $pasPhoto = $request->file('pas_photo')->store('pas_photos', 'public');
                }
                // Jika data biodata belum ada, lakukan insert
                BiodataDiriModel::create([
                    'id_pendaftar' => $id,
                    'alamat_asal_sekolah' => $request->alamat_asal_sekolah,
                    'ukuran_baju' => $request->ukuran_baju,
                    'pas_photo' => $pasPhoto,
                    'nik' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'anak_ke' => $request->anak_ke,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    'tinggi_badan' => $request->tinggi_badan,
                    'berat_badan' => $request->berat_badan,
                    'jumlah_saudara_tiri' => $request->jumlah_saudara_tiri,
                    'jumlah_saudara_angkat' => $request->jumlah_saudara_angkat,
                    'bahasa_sehari_hari' => $request->bahasa_sehari_hari,
                    'bakat_dan_prestasi' => $request->bakat_dan_prestasi,
                    'status' => true,
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data diri pendaftar berhasil ditambahkan.');
            }

            // Redirect ke halaman edit lagi
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateOrangTua(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'nullable|string|max:255',
            'tempat_lahir_ayah' => 'nullable|string|max:255',
            'agama_ayah' => 'nullable|string|max:50',
            'tgl_lahir_ayah' => 'nullable|date',
            'pendidikan_terakhir_ayah' => 'nullable|string|max:50',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'range_gaji_ayah' => 'nullable|string|max:50',
            'alamat_lengkap_ayah' => 'nullable|string|max:255',
            'telp_ayah' => 'nullable|string|max:15',
            'email_ayah' => 'nullable|email|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tempat_lahir_ibu' => 'nullable|string|max:255',
            'tgl_lahir_ibu' => 'nullable|date',
            'agama_ibu' => 'nullable|string|max:50',
            'pendidikan_ibu' => 'nullable|string|max:50',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'range_gaji_ibu' => 'nullable|string|max:50',
            'alamat_ibu' => 'nullable|string|max:255',
            'telp_ibu' => 'nullable|string|max:15',
            'email_ibu' => 'nullable|email|max:255',
            'hubungan_santri' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah data orang tua sudah ada atau belum berdasarkan pendaftar_id
            $orangtua = BiodataOrangTuaModel::where('pendaftar_id', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($orangtua) {
                // Jika data orang tua sudah ada, lakukan update
                $orangtua->update([
                    'nama_ayah' => $request->nama_ayah,
                    'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                    'agama_ayah' => $request->agama_ayah,
                    'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                    'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'range_gaji_ayah' => $request->range_gaji_ayah,
                    'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
                    'telp_ayah' => $request->telp_ayah,
                    'email_ayah' => $request->email_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                    'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                    'agama_ibu' => $request->agama_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'range_gaji_ibu' => $request->range_gaji_ibu,
                    'alamat_ibu' => $request->alamat_ibu,
                    'telp_ibu' => $request->telp_ibu,
                    'email_ibu' => $request->email_ibu,
                    'hubungan_santri' => $request->hubungan_santri,
                    'updated_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data orang tua pendaftar berhasil diperbarui.');
            } else {
                // Jika data orang tua belum ada, lakukan insert
                BiodataOrangTuaModel::create([
                    'pendaftar_id' => $id,
                    'nama_ayah' => $request->nama_ayah,
                    'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                    'agama_ayah' => $request->agama_ayah,
                    'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                    'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'range_gaji_ayah' => $request->range_gaji_ayah,
                    'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
                    'telp_ayah' => $request->telp_ayah,
                    'email_ayah' => $request->email_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                    'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                    'agama_ibu' => $request->agama_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'range_gaji_ibu' => $request->range_gaji_ibu,
                    'alamat_ibu' => $request->alamat_ibu,
                    'telp_ibu' => $request->telp_ibu,
                    'email_ibu' => $request->email_ibu,
                    'hubungan_santri' => $request->hubungan_santri,
                    'status' => true,
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data orang tua pendaftar berhasil ditambahkan.');
            }

            // Redirect ke halaman edit lagi
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateRiwayatpenyakit(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_penyakit' => 'nullable|string|max:255',
            'sejak_kapan' => 'nullable|date',
            'status_kesembuhan' => 'nullable|string|max:255',
            'penanganan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah data riwayat penyakit sudah ada atau belum berdasarkan pendaftar_id
            $riwayatPenyakit = BiodataPenyakitModel::where('pendaftar_id', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($riwayatPenyakit) {
                // Jika data riwayat penyakit sudah ada, lakukan update
                $riwayatPenyakit->update([
                    'nama_penyakit' => $request->nama_penyakit,
                    'sejak_kapan' => $request->sejak_kapan,
                    'status_kesembuhan' => $request->status_kesembuhan,
                    'penanganan' => $request->penanganan,
                    'updated_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data riwayat penyakit pendaftar berhasil diperbarui.');
            } else {
                // Jika data riwayat penyakit belum ada, lakukan insert
                BiodataPenyakitModel::create([
                    'pendaftar_id' => $id,
                    'nama_penyakit' => $request->nama_penyakit,
                    'sejak_kapan' => $request->sejak_kapan,
                    'status_kesembuhan' => $request->status_kesembuhan,
                    'penanganan' => $request->penanganan,
                    'status' => true,
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data riwayat penyakit pendaftar berhasil ditambahkan.');
            }

            // Redirect ke halaman edit lagi
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateBerkas(Request $request, $id)
    {
        // Validasi input file
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'berkas_id' => 'required|exists:config_berkas,id', // Pastikan berkas_id valid
        ]);

        try {
            // Ambil data berkas yang dipilih pendaftar
            $berkas = PendaftarBerkas::where('pendaftar_id', $id)
                ->where('berkas_id', $request->input('berkas_id'))
                ->first();

            if ($berkas) {
                // Hapus file lama jika ada
                if ($berkas->file && Storage::exists('public/' . $berkas->file)) {
                    Storage::delete('public/' . $berkas->file);
                }

                // Simpan file baru
                $filePath = $request->file('file')->store('berkas', 'public');
                $berkas->update([
                    'file' => $filePath,
                ]);

                Alert::success('Berhasil', 'Berkas berhasil diperbarui.');
            } else {
                // Jika belum ada data berkas, buat baru
                $filePath = $request->file('file')->store('berkas', 'public');
                PendaftarBerkas::create([
                    'pendaftar_id' => $id,
                    'berkas_id' => $request->input('berkas_id'),
                    'file' => $filePath,
                ]);

                Alert::success('Berhasil', 'Berkas berhasil diunggah.');
            }

            // Redirect ke halaman edit
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateJenjang(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jenjang_id' => 'required|exists:config_jenjangs,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah data jenjang sudah ada atau belum berdasarkan pendaftar_id
            $pendaftarJenjang = PendaftarJenjangModel::where('pendaftar_id', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($pendaftarJenjang) {
                // Jika data jenjang sudah ada, lakukan update
                $pendaftarJenjang->update([
                    'jenjang_id' => $request->input('jenjang_id'),
                    'updated_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data jenjang pendaftar berhasil diperbarui.');
            } else {
                // Jika data jenjang belum ada, lakukan insert
                PendaftarJenjangModel::create([
                    'pendaftar_id' => $id,
                    'jenjang_id' => $request->input('jenjang_id'),
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data jenjang pendaftar berhasil ditambahkan.');
            }

            // Redirect ke halaman edit lagi
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateJalur(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jalur_id' => 'required|exists:config_jalurs,id',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Validasi gagal, silakan periksa kembali input Anda.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah data jalur sudah ada atau belum berdasarkan pendaftar_id
            $pendaftarJalur = PendaftarJalurModel::where('pendaftar_id', $id)->first();

            // Dapatkan data operator yang sedang login
            $operator = Auth::guard('operator')->user();

            if ($pendaftarJalur) {
                // Jika data jalur sudah ada, lakukan update
                $pendaftarJalur->update([
                    'jalur_id' => $request->input('jalur_id'),
                    'updated_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data jalur pendaftar berhasil diperbarui.');
            } else {
                // Jika data jalur belum ada, lakukan insert
                PendaftarJalurModel::create([
                    'pendaftar_id' => $id,
                    'jalur_id' => $request->input('jalur_id'),
                    'created_by' => $operator->id,
                ]);
                Alert::success('Berhasil', 'Data jalur pendaftar berhasil ditambahkan.');
            }

            // Redirect ke halaman edit lagi
            return redirect()->route('operator.pendaftar.edit', $id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function cetakFormulir($id)
    {
        $pendaftar_id = $id;

        // Ambil semua data
        $akunPendaftar = AkunPendaftar::findOrFail($pendaftar_id);
        $biodataDiri = BiodataDiriModel::where('id_pendaftar', $pendaftar_id)->first();
        $biodataOrangTua = BiodataOrangTuaModel::where('pendaftar_id', $pendaftar_id)->first();
        $alamat = PendaftarAlamatModel::where('pendaftar_id', $pendaftar_id)->first();
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftar_id)->get();
        $jalur = PendaftarJalurModel::where('pendaftar_id', $pendaftar_id)->first();
        $jenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftar_id)->first();
        // $kuesioner = KuesionerModel::where('pendaftar_id', $pendaftar_id)->first();
        // $penyakit = BiodataPenyakitModel::where('pendaftar_id', $pendaftar_id)->first();
        $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)->get();

        // Ambil transaksi dengan status_pembayaran = 0 (belum diverifikasi)
        $transaksiBelumTerverifikasi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)
            ->where('status_pembayaran', 0)
            ->exists(); // Menggunakan exists untuk memeriksa apakah ada transaksi yang belum diverifikasi

        // Buat array untuk menyimpan tabel yang belum terisi
        $dataBelumLengkap = [];

        // Cek apakah data sudah ada atau belum, jika tidak tambahkan ke array dataBelumLengkap
        if (!$biodataDiri) {
            $dataBelumLengkap[] = 'Biodata Diri';
        }
        if (!$biodataOrangTua) {
            $dataBelumLengkap[] = 'Biodata Orang Tua';
        }
        if (!$alamat) {
            $dataBelumLengkap[] = 'Alamat Tempat Tinggal';
        }
        // Pengecekan berkas hanya jika pendaftar bukan dari Jalur Reguler
        if ($jalur && $jalur->jalur && $jalur->jalur->nama_jalur !== 'Jalur Reguler') {
            if ($berkas->isEmpty()) {
                $dataBelumLengkap[] = 'Berkas Pendaftaran';
            }
        }
        if (!$jalur) {
            $dataBelumLengkap[] = 'Jalur Pendaftaran';
        }
        if (!$jenjang) {
            $dataBelumLengkap[] = 'Jenjang Pendidikan';
        }
        // if (!$kuesioner) {
        //     $dataBelumLengkap[] = 'Kuesioner';
        // }
        // if (!$penyakit) {
        //     $dataBelumLengkap[] = 'Riwayat Penyakit';
        // }
        if ($transaksi->isEmpty()) {
            $dataBelumLengkap[] = 'Transaksi Pembayaran';
        }

        // Tambahkan validasi jika ada transaksi yang belum diverifikasi
        if ($transaksiBelumTerverifikasi) {
            $dataBelumLengkap[] = 'Transaksi Pembayaran belum diverifikasi';
        }

        // Jika ada data yang belum terisi, kembalikan ke dashboard dan tampilkan pesan
        if (!empty($dataBelumLengkap)) {
            $message = 'Pendaftar belum melengkapi data berikut: ' . implode(', ', $dataBelumLengkap) . '. Silakan lengkapi data terlebih dahulu sebelum mencetak formulir.';
            Alert::error('Validasi Gagal', $message);
            return redirect()->route('operator.pendaftar.edit', $id);
        }

        // Generate barcode dari no_pendaftaran
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($akunPendaftar->no_pendaftaran, $generator::TYPE_CODE_128));

        $province = $alamat ? Province::find($alamat->provinsi_id) : null;
        $kabupaten = $alamat ? Regency::find($alamat->kabupaten_id) : null;
        $kecamatan = $alamat ? District::find($alamat->kecamatan_id) : null;
        $desa = $alamat ? Village::find($alamat->desa_id) : null;

        // Jika semua data sudah lengkap, generate PDF
        $pdf = PDF::loadView('pendaftar.formulir.cetak', compact(
            'akunPendaftar',
            'biodataDiri',
            'biodataOrangTua',
            'alamat',
            'berkas',
            'jalur',
            'jenjang',
            'transaksi',
            'barcode',
            'province',
            'kabupaten',
            'kecamatan',
            'desa'
        ));

        return $pdf->download('formulir_pendaftaran.pdf');
        // return $pdf->stream('formulir_pendaftaran.pdf');
    }

    // Fungsi untuk mengekspor data pendaftar
    public function export(Request $request)
    {
        $jenjang = $request->input('jenjang');
        $jalur = $request->input('jalur');
        $statusPembayaran = $request->input('status_pembayaran');

        // Nama file Excel
        $fileName = 'rekap_pendaftar_' . date('YmdHis') . '.xlsx';

        // Memanggil export class dengan filter yang diberikan
        return Excel::download(new PendaftarExport($jenjang, $jalur, $statusPembayaran), $fileName);
    }

    public function destroy($id)
    {
        try {
            $akunPendaftar = AkunPendaftar::findOrFail($id);
            $akunPendaftar->delete();

            Alert::success('Berhasil', 'Data pendaftar berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }

        return redirect()->route('operator.pendaftar.index');
    }
}
