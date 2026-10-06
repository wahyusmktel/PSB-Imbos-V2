<?php

namespace App\Http\Controllers;

use App\Models\PendaftarJalurModel;
use App\Models\ConfigJalurModel;
use App\Models\PendaftarJenjangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftarJalurController extends Controller
{

    /**
     * Menampilkan halaman untuk memilih jalur
     */
    public function index()
    {
        // Ambil data pendaftar yang sedang login
        $pendaftarId = Auth::guard('pendaftar')->id();
        $pendaftarJenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftarId)->first();

        // Jika pendaftar belum memilih jenjang, redirect ke halaman pemilihan jenjang
        if (!$pendaftarJenjang) {
            Alert::warning('Pilih Jenjang', 'Silakan pilih jenjang terlebih dahulu.');
            return redirect()->route('pendaftar.jenjang.index');
        }

        // Ambil data semua jalur
        $jalurs = ConfigJalurModel::where('status', true)->get();

        // Cek apakah pendaftar sudah memilih jalur sebelumnya
        $selectedJalur = PendaftarJalurModel::where('pendaftar_id', $pendaftarId)->first();

        return view('pendaftar.jalur.index', compact('jalurs', 'selectedJalur'));
    }


    /**
     * Menyimpan atau memperbarui pilihan jalur
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'jalur_id' => 'required|uuid|exists:config_jalurs,id',
        ], [
            'jalur_id.required' => 'Jalur harus dipilih.',
            'jalur_id.exists' => 'Jalur yang dipilih tidak valid.',
        ]);

        try {
            // Dapatkan ID pendaftar yang sedang login
            $pendaftarId = Auth::guard('pendaftar')->id();

            // Cari apakah sudah ada pilihan jalur sebelumnya
            $pendaftarJalur = PendaftarJalurModel::where('pendaftar_id', $pendaftarId)->first();

            if ($pendaftarJalur) {
                // Jika sudah ada pilihan, perbarui jalurnya
                $pendaftarJalur->update([
                    'jalur_id' => $request->jalur_id,
                    'updated_by' => $pendaftarId,
                ]);

                Alert::success('Berhasil', 'Jalur berhasil diperbarui.');
                return redirect()->route('pendaftar.jalur.index');
            } else {
                // Jika belum memilih, buat baru
                PendaftarJalurModel::create([
                    'pendaftar_id' => $pendaftarId,
                    'jalur_id' => $request->jalur_id,
                    'status' => true,
                    'created_by' => $pendaftarId,
                ]);

                Alert::success('Berhasil', 'Jalur berhasil dipilih.');
                return redirect()->route('pendaftar.data_diri.index');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Method untuk menyimpan pilihan jalur
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jalur_id' => 'required|uuid|exists:config_jalurs,id',
        ], [
            'jalur_id.required' => 'Jalur harus dipilih.',
            'jalur_id.exists' => 'Jalur yang dipilih tidak valid.',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cek apakah pengguna sudah login
            if (!Auth::guard('pendaftar')->check()) {
                Alert::error('Error', 'Anda harus login terlebih dahulu untuk memilih jalur.');
                return redirect()->route('pendaftar.login');
            }

            // Dapatkan ID pendaftar yang sedang login
            $pendaftarId = Auth::guard('pendaftar')->id();

            // Cek apakah pendaftar sudah memilih jalur sebelumnya
            $existingChoice = PendaftarJalurModel::where('pendaftar_id', $pendaftarId)->first();

            if ($existingChoice) {
                // Jika sudah memilih, beri notifikasi bahwa jalur sudah dipilih
                Alert::warning('Perhatian', 'Anda sudah memilih jalur sebelumnya.');
                return redirect()->back();
            }

            // Simpan data jalur yang dipilih
            PendaftarJalurModel::create([
                'pendaftar_id' => $pendaftarId,
                'jalur_id' => $request->jalur_id,
                'status' => true,
                'created_by' => $pendaftarId,
            ]);

            // Beri notifikasi berhasil
            Alert::success('Sukses', 'Jalur berhasil dipilih.');
            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            // Jika terjadi kesalahan pada query database
            Alert::error('Error', 'Terjadi kesalahan pada database: ' . $e->getMessage());
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            // Tangani kesalahan lainnya
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
