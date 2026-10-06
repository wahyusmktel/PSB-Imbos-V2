<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use App\Models\ConfigPpdbModel;
use App\Models\PendaftarJenjangModel;
use App\Models\PendaftarTransaksiModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftarGroupWaController extends Controller
{
    public function index()
    {
        // Ambil data akun pendaftar yang sedang login
        $pendaftar = Auth::guard('pendaftar')->user();

        // Ambil jenjang yang dipilih oleh pendaftar
        $pendaftarJenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftar->id)->first();

        // Ambil data konfigurasi PPDB
        $ppdbConfig = ConfigPpdbModel::getActiveConfig(); // Asumsi ada metode untuk mengambil konfigurasi aktif

        // Jika pendaftar belum memilih jenjang, redirect ke halaman pemilihan jenjang
        if (!$pendaftarJenjang) {
            return redirect()->route('pendaftar.jenjang.index')->with('error', 'Silakan pilih jenjang terlebih dahulu.');
        }

        // Cek status pembayaran
        $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar->id)->first();

        if (!$transaksi || $transaksi->status_pembayaran != 1) {
            // Jika belum ada transaksi atau status pembayaran bukan 1, tampilkan pesan peringatan
            Alert::warning('Peringatan', 'Anda harus melakukan pembayaran dan terverifikasi terlebih dahulu sebelum bergabung dengan grup WhatsApp.');
            return redirect()->route('pendaftar.transaksi.index')->with('warning', 'Anda harus melakukan pembayaran dan diterima terlebih dahulu sebelum bergabung dengan grup WhatsApp.');
        }

        // Ambil data jenjang terkait dari relasi dengan tabel config_jenjangs
        $jenjang = $pendaftarJenjang->jenjang; // Pastikan ada relasi di model PendaftarJenjangModel ke ConfigJenjangModel

        // Tentukan link group WA dan QR code sesuai jenjang yang dipilih berdasarkan tingkat_jenjang
        if ($jenjang->tingkat_jenjang == 'SMP') {
            $groupLink = $ppdbConfig->link_group_smp;
            $qrCode = $ppdbConfig->qr_code_smp;
        } elseif ($jenjang->tingkat_jenjang == 'SMA') {
            $groupLink = $ppdbConfig->link_group_sma;
            $qrCode = $ppdbConfig->qr_code_sma;
        } else {
            $groupLink = null;
            $qrCode = null; // Jika jenjang tidak dikenal atau tidak ada data
        }

        // Render view dengan data link group dan QR code
        return view('pendaftar.group_wa.index', compact('groupLink', 'qrCode'));
    }
}
