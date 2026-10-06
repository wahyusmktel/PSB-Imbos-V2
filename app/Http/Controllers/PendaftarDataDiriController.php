<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use App\Models\BiodataDiriModel;
use App\Models\BiodataOrangTuaModel;
use App\Models\BiodataPenyakitModel;
use App\Models\ConfigBerkasModel;
use App\Models\District;
use App\Models\KuesionerModel;
use App\Models\PendaftarAlamatModel;
use App\Models\PendaftarBerkas;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class PendaftarDataDiriController extends Controller
{
    public function index()
    {
        // Ambil data pendaftar yang sedang login
        $pendaftarId = Auth::guard('pendaftar')->user()->id;

        // Cari data biodata berdasarkan pendaftar_id
        $biodata = BiodataDiriModel::where('id_pendaftar', $pendaftarId)->first();

        // Ambil data dari tabel akun_pendaftars
        $akunPendaftar = AkunPendaftar::find($pendaftarId);

        $alamat = PendaftarAlamatModel::where('pendaftar_id', $pendaftarId)->first();

        $provinces = Province::all();
        
        // Cek jika sudah ada alamat, ambil data terkait dari kabupaten, kecamatan, dan desa
        $kabupatens = $alamat ? Regency::where('province_id', $alamat->provinsi_id)->get() : collect();
        $kecamatans = $alamat ? District::where('regency_id', $alamat->kabupaten_id)->get() : collect();
        $desas = $alamat ? Village::where('district_id', $alamat->kecamatan_id)->get() : collect();

        $biodata_orang_tua = BiodataOrangTuaModel::where('pendaftar_id', $pendaftarId)->first();

        $riwayat_penyakit = BiodataPenyakitModel::where('pendaftar_id', $pendaftarId)->first();

        $kuesioner = KuesionerModel::where('pendaftar_id', $pendaftarId)->first();

        // Ambil jalur yang dipilih oleh pendaftar
        $pendaftar_jalur = Auth::guard('pendaftar')->user()->pendaftarJalur;

        if (!$pendaftar_jalur) {
            Alert::error('Error', 'Anda belum memilih jalur.');
            return redirect()->route('pendaftar.jalur.index');
        }

        // Ambil berkas-berkas yang sesuai dengan jalur_id
        $berkas = ConfigBerkasModel::where('jalur_id', $pendaftar_jalur->jalur_id)->get();

        // Ambil berkas yang sudah diupload oleh pendaftar
        $uploadedBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)->get()->keyBy('berkas_id');

        foreach ($berkas as $b) {
            $b->uploaded = $uploadedBerkas->get($b->id);
        }

        // Tampilkan form pengisian data diri, serta jika ada data, tampilkan di form
        return view('pendaftar.data_diri.index', compact('biodata', 'akunPendaftar', 'alamat', 'provinces', 'kabupatens', 'kecamatans', 'desas', 'biodata_orang_tua', 'riwayat_penyakit', 'kuesioner', 'berkas', 'pendaftar_jalur'));
    }

    public function store(Request $request)
    {
        // Validasi input dengan pesan kustom dalam bahasa Indonesia
        $validator = Validator::make($request->all(), [
            'alamat_asal_sekolah' => 'nullable|string|max:255',
            'ukuran_baju' => 'nullable|string',
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
            //'ukuran_baju.max' => 'Ukuran baju tidak boleh lebih dari 10 karakter.',
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
            Alert::error('Validasi Gagal', 'Harap isi data dengan benar.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Ambil data pendaftar yang sedang login
            $pendaftarId = Auth::guard('pendaftar')->user()->id;

            // Simpan foto jika ada
            $pasPhoto = null;
            if ($request->hasFile('pas_photo')) {
                $pasPhoto = $request->file('pas_photo')->store('pas_photos', 'public');
            }

            // Simpan data
            BiodataDiriModel::create([
                'id_pendaftar' => $pendaftarId,
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
                'created_by' => $pendaftarId,
            ]);

            Alert::success('Sukses', 'Data diri berhasil disimpan.');
            return redirect()->route('pendaftar.data_diri.index');

        } catch (QueryException $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data.');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input dengan pesan kustom dalam bahasa Indonesia
        $validator = Validator::make($request->all(), [
            'alamat_asal_sekolah' => 'nullable|string|max:255',
            'ukuran_baju' => 'nullable|string',
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
            //'ukuran_baju.max' => 'Ukuran baju tidak boleh lebih dari 10 karakter.',
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
            Alert::error('Validasi Gagal', 'Harap isi data dengan benar.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Ambil data pendaftar yang sedang login
            $pendaftarId = Auth::guard('pendaftar')->user()->id;

            // Simpan foto jika ada
            $pasPhoto = null;
            if ($request->hasFile('pas_photo')) {
                $pasPhoto = $request->file('pas_photo')->store('pas_photos', 'public');
            }

            // Update data
            $biodata = BiodataDiriModel::where('id_pendaftar', $pendaftarId)->findOrFail($id);
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
                'updated_by' => $pendaftarId,
            ]);

            Alert::success('Sukses', 'Data diri berhasil diperbarui.');
            return redirect()->route('pendaftar.data_diri.index');

        } catch (QueryException $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data.');
            return redirect()->back()->withInput();
        }
    }
}
