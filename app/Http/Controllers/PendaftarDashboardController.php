<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftarDashboardController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login sebagai pendaftar
        if (!Auth::guard('pendaftar')->check()) {
            Alert::error('Error', 'Silakan login terlebih dahulu.');
            return redirect()->route('pendaftar.login');
        }

        // Ambil data pendaftar yang sedang login
        $pendaftar = Auth::guard('pendaftar')->user();

        // Cek apakah pendaftar memiliki jalur dan jenjang
        $pendaftarJenjang = $pendaftar->pendaftarJenjang ? $pendaftar->pendaftarJenjang->first() : null;

        // Jika belum memilih jenjang, redirect ke halaman pemilihan jenjang
        if (!$pendaftarJenjang) {
            // Alert::warning('Pilih Jenjang', 'Silakan pilih jenjang terlebih dahulu.');
            return redirect()->route('pendaftar.jenjang.index');
        }

        // Cek apakah pendaftar memiliki jalur
        $pendaftarJalur = $pendaftar->pendaftarJalur ? $pendaftar->pendaftarJalur->first() : null;

        // Query untuk pengumuman aktif
        $query = Pengumuman::active(); // Menggunakan scope active untuk pengumuman dengan status true

        // Filter berdasarkan jenjang dan jalur yang dimiliki oleh pendaftar atau pengumuman umum (null)
        if ($pendaftarJenjang && $pendaftarJalur) {
            $query->where(function ($q) use ($pendaftarJenjang) {
                $q->where('jenjang_id', $pendaftarJenjang->jenjang_id)
                    ->orWhereNull('jenjang_id'); // Tampilkan pengumuman umum
            })->where(function ($q) use ($pendaftarJalur) {
                $q->where('jalur_id', $pendaftarJalur->jalur_id)
                    ->orWhereNull('jalur_id'); // Tampilkan pengumuman umum
            });
        } else {
            // Jika tidak ada jenjang dan jalur, ambil pengumuman yang umum (null)
            $query->whereNull('jenjang_id')->orWhereNull('jalur_id');
        }

        // Ambil pengumuman yang sudah difilter
        $pengumumans = $query->get();

        // Tampilkan ke view
        return view('pendaftar.dashboard.index', compact('pengumumans'));
    }
}
