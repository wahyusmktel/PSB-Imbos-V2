<?php

namespace App\Http\Controllers;

use App\Models\PendaftarBerkas;
use App\Models\ConfigBerkasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class PendaftarBerkasController extends Controller
{
    // Method untuk menampilkan form upload berkas
    public function index()
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Ambil jalur yang dipilih oleh pendaftar
        $pendaftar_jalur = Auth::guard('pendaftar')->user()->pendaftarJalur;

        if (!$pendaftar_jalur) {
            Alert::error('Error', 'Anda belum memilih jalur.');
            return redirect()->route('pendaftar.dashboard');
        }

        // Ambil berkas-berkas yang sesuai dengan jalur_id
        $berkas = ConfigBerkasModel::where('jalur_id', $pendaftar_jalur->jalur_id)->get();

        // Ambil berkas yang sudah diupload oleh pendaftar
        $uploadedBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftar_id)->get()->keyBy('berkas_id');

        foreach ($berkas as $b) {
            $b->uploaded = $uploadedBerkas->get($b->id);
        }

        return view('pendaftar.berkas.index', compact('berkas'));
    }

    // Method untuk menyimpan berkas yang diupload
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Cari data berkas dari database berdasarkan berkas_id
        $berkasConfig = ConfigBerkasModel::findOrFail($request->berkas_id);

        // Ambil nilai ekstensi dan ukuran maksimum dari database
        $fileExtension = $berkasConfig->ekstensi_berkas;  // kolom 'ekstensi_berkas'
        $fileMaxSize = $berkasConfig->ukuran_maksimum;    // kolom 'ukuran_maksimum'

        // Validasi file yang diupload dengan pesan kustom dalam bahasa Indonesia
        $validator = Validator::make($request->all(), [
            'berkas_id' => 'required|exists:config_berkas,id',
            'file' => 'required|file|mimes:' . $fileExtension . '|max:' . $fileMaxSize,
        ], [
            'berkas_id.required' => 'Berkas tidak boleh kosong.',
            'berkas_id.exists' => 'Berkas tidak valid.',
            'file.required' => 'File tidak boleh kosong.',
            'file.file' => 'File yang diupload harus valid.',
            'file.mimes' => 'File harus berformat: ' . $fileExtension . '.',
            'file.max' => 'File tidak boleh lebih besar dari ' . $fileMaxSize/1024 . 'MB.',
        ]);

        if ($validator->fails()) {
            Alert::error('Validasi Gagal', 'Harap periksa kembali file yang diupload.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Simpan file yang diupload
            $filePath = $request->file('file')->store('berkas', 'public');

            // Cek apakah berkas sudah ada
            $existingBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftar_id)
                ->where('berkas_id', $request->berkas_id)
                ->first();

            if ($existingBerkas) {
                // Hapus file lama
                Storage::disk('public')->delete($existingBerkas->file);

                // Update data dengan file baru
                $existingBerkas->update([
                    'file' => $filePath,
                    'updated_by' => $pendaftar_id,
                ]);

                Alert::success('Success', 'Berkas berhasil diperbarui.');
            } else {
                // Insert data baru
                PendaftarBerkas::create([
                    'pendaftar_id' => $pendaftar_id,
                    'berkas_id' => $request->berkas_id,
                    'file' => $filePath,
                    'status' => true,
                    'created_by' => $pendaftar_id,
                ]);

                Alert::success('Success', 'Berkas berhasil diupload.');
            }

            return redirect()->route('pendaftar.data_diri.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
