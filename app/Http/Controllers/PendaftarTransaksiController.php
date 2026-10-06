<?php

namespace App\Http\Controllers;

use App\Models\PendaftarTransaksiModel;
use App\Models\ConfigBiayaModel;
use App\Models\ConfigPpdbModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Storage; // Untuk mengelola file upload

class PendaftarTransaksiController extends Controller
{
    // Method untuk menampilkan halaman transaksi
    public function index()
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Dapatkan jalur yang dipilih oleh pendaftar
        $pendaftar_jalur = Auth::guard('pendaftar')->user()->pendaftarJalur;

        if (!$pendaftar_jalur) {
            Alert::error('Error', 'Anda belum memilih jalur.');
            return redirect()->route('pendaftar.jalur.index');
        }

        // Dapatkan jenjang yang dipilih oleh pendaftar
        $pendaftar_jenjang = Auth::guard('pendaftar')->user()->pendaftarJenjang;

        if (!$pendaftar_jenjang) {
            Alert::error('Error', 'Anda belum memilih jenjang.');
            return redirect()->route('pendaftar.jenjang.index');
        }

        // ------------------------------------------------------------
        // CEK: apakah jalur yang dipilih adalah "Jalur Alumni"
        // ------------------------------------------------------------
        $isJalurAlumni = optional($pendaftar_jalur->jalur)->nama_jalur === 'Jalur Alumni';

        // ------------------------------------------------------------
        // QUERY BIAYA
        // Jika Jalur Alumni → ambil hanya SATU biaya untuk jalur alumni
        // Selain itu        → filter jalur + jenjang seperti biasa
        // ------------------------------------------------------------
        if ($isJalurAlumni) {
            // 🔽 KHUSUS JALUR ALUMNI
            $biayas = ConfigBiayaModel::where('jalur_id', $pendaftar_jalur->jalur_id)
                // optional: atur urutan kalau mau konsisten ambil yang paling awal
                ->orderBy('created_at', 'asc')
                ->take(1)            // ⬅️ ambil hanya 1 biaya
                ->get();
        } else {
            // 🔽 JALUR BIASA (NON ALUMNI) → tetap pakai filter jenjang
            $biayas = ConfigBiayaModel::where('jalur_id', $pendaftar_jalur->jalur_id)
                ->where('jenjang_id', $pendaftar_jenjang->jenjang_id)
                ->get();
        }
        // ------------------------------------------------------------

        $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)->get();

        //Ambil data config
        $ppdbConfig = ConfigPpdbModel::getActiveConfig();

        return view('pendaftar.transaksi.index', compact('transaksi', 'biayas', 'ppdbConfig'));
    }

    // Method untuk menyimpan transaksi baru
    public function store(Request $request)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'biaya_id' => 'required|exists:config_biayas,id',
            'nama_pengirim' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|max:100',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $filePath = null; // Inisialisasi $filePath dengan null

            // Simpan file bukti pembayaran jika ada
            if ($request->hasFile('bukti_pembayaran')) {
                $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            // Generate kode transaksi unik
            $kodeTransaksi = 'TRX-PSB-IMBOS-' . strtoupper(Str::random(8));

            // Simpan data transaksi
            PendaftarTransaksiModel::create([
                'pendaftar_id' => $pendaftar_id,
                'biaya_id' => $request->biaya_id,
                'tanggal_pembayaran' => now(),
                'nama_pengirim' => $request->nama_pengirim,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_pembayaran' => $filePath, // Simpan filePath (jika ada)
                'kode_transaksi' => $kodeTransaksi,
                'status_pembayaran' => false, // Default status transaksi adalah false (belum diverifikasi)
                'status' => true,
                'created_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Transaksi berhasil disimpan. Tunggu verifikasi admin.');
            return redirect()->route('pendaftar.transaksi.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    // Method untuk memperbarui transaksi jika status pembayaran belum diverifikasi (false)
    public function update(Request $request, $id)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Validasi input
        $validator = Validator::make($request->all(), [
            'biaya_id' => 'required|exists:config_biayas,id',
            'nama_pengirim' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|max:100',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // nullable untuk bukti pembayaran
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            if ($transaksi->status_pembayaran) {
                Alert::error('Error', 'Transaksi sudah diverifikasi dan tidak bisa diubah.');
                return redirect()->route('pendaftar.transaksi.index');
            }

            // Jika ada file baru
            if ($request->hasFile('bukti_pembayaran')) {
                // Hapus file lama
                if ($transaksi->bukti_pembayaran) {
                    Storage::disk('public')->delete($transaksi->bukti_pembayaran);
                }
                // Simpan file baru
                $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $transaksi->update(['bukti_pembayaran' => $filePath]);
            }

            // Update data transaksi
            $transaksi->update([
                'biaya_id' => $request->biaya_id,
                'nama_pengirim' => $request->nama_pengirim,
                'metode_pembayaran' => $request->metode_pembayaran,
                'updated_by' => $pendaftar_id,
            ]);

            Alert::success('Success', 'Transaksi berhasil diperbarui.');
            return redirect()->route('pendaftar.transaksi.index');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat memperbarui data.');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Method untuk mendownload kwitansi
    public function downloadKwitansi($id)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)
            ->where('status_pembayaran', true) // Hanya transaksi yang sudah diverifikasi yang bisa didownload
            ->findOrFail($id);

        // Generate barcode dari kode transaksi
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($transaksi->kode_transaksi, $generator::TYPE_CODE_128));

        // Render PDF dengan barcode
        $pdf = PDF::loadView('pendaftar.transaksi.kwitansi', compact('transaksi', 'barcode'));

        return $pdf->download('kwitansi_' . $transaksi->kode_transaksi . '.pdf');
    }

    // Method untuk menghapus transaksi
    public function destroy($id)
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        try {
            // Temukan transaksi berdasarkan ID
            $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)->findOrFail($id);

            // Hapus data bukti pembayaran dari storage jika ada
            if ($transaksi->bukti_pembayaran) {
                Storage::disk('public')->delete($transaksi->bukti_pembayaran);
            }

            // Hapus transaksi
            $transaksi->delete();

            Alert::success('Success', 'Transaksi berhasil dihapus.');
        } catch (QueryException $e) {
            Alert::error('Database Error', 'Terjadi kesalahan saat menghapus data.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('pendaftar.transaksi.index');
    }
}
