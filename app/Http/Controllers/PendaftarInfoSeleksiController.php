<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoSeleksiModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftarInfoSeleksiController extends Controller
{
    // Method untuk menampilkan informasi seleksi berdasarkan jenjang dan jalur yang dimiliki pendaftar
    public function index()
    {
        // Cek apakah pendaftar sudah login
        if (!Auth::guard('pendaftar')->check()) {
            Alert::error('Akses Ditolak', 'Anda harus login terlebih dahulu.');
            return redirect()->route('pendaftar.login');
        }

        // Ambil data pendaftar yang sedang login
        $pendaftar = Auth::guard('pendaftar')->user();

        // Ambil jenjang dan jalur yang dimiliki pendaftar
        $jenjang_id = optional($pendaftar->pendaftarJenjang)->jenjang_id;
        $jalur_id = optional($pendaftar->pendaftarJalur)->jalur_id;

        // Cari informasi seleksi berdasarkan jenjang dan jalur, atau tampilkan yang tidak memiliki jenjang/jalur
        $infoSeleksi = InfoSeleksiModel::where(function ($query) use ($jenjang_id, $jalur_id) {
            $query->where('jenjang_id', $jenjang_id)
                  ->where('jalur_id', $jalur_id)
                  ->orWhereNull('jenjang_id')
                  ->orWhereNull('jalur_id');
        })->get();

        // Jika tidak ada data, beri peringatan
        if ($infoSeleksi->isEmpty()) {
            Alert::info('Info', 'Tidak ada informasi seleksi yang tersedia.');
            return redirect()->route('pendaftar.dashboard');
        }

        return view('pendaftar.info_seleksi.index', compact('infoSeleksi'));
    }
}
