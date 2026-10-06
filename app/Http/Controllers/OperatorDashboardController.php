<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OperatorDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard operator.
     */
    public function index()
    {
        // Dapatkan data operator yang sedang login (jika diperlukan)
        $operator = Auth::guard('operator')->user();

        // Buat array untuk menyimpan data per bulan
        $months = collect([]);
        $smpCounts = collect([]);
        $smaCounts = collect([]);
        $noJenjangCounts = collect([]); // Pendaftar tanpa jenjang

        // Menghitung data untuk 6 bulan terakhir
        $namaBulanIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        for ($i = 5; $i >= 0; $i--) {
            $carbonMonth = Carbon::now()->subMonths($i);
            $monthNum = (int) $carbonMonth->format('n');
            $yearNum = $carbonMonth->format('Y');
            $months->push($namaBulanIndo[$monthNum] . ' ' . $yearNum);

            // Hitung jumlah pendaftar SMP per bulan
            $smpCounts->push(AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
                $query->where('tingkat_jenjang', 'SMP');
            })->whereMonth('created_at', $carbonMonth->month)
                ->whereYear('created_at', $carbonMonth->year)
                ->count());

            // Hitung jumlah pendaftar SMA per bulan
            $smaCounts->push(AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
                $query->where('tingkat_jenjang', 'SMA');
            })->whereMonth('created_at', $carbonMonth->month)
                ->whereYear('created_at', $carbonMonth->year)
                ->count());

            // Hitung jumlah pendaftar tanpa jenjang per bulan
            $noJenjangCounts->push(AkunPendaftar::doesntHave('pendaftarJenjang')
                ->whereMonth('created_at', $carbonMonth->month)
                ->whereYear('created_at', $carbonMonth->year)
                ->count());
        }

        // Statistik pendaftar
        $jumlahPendaftar = AkunPendaftar::count(); // Total jumlah pendaftar

        // Jumlah pendaftar berdasarkan jenjang (SMP)
        $jumlahPendaftarSMP = AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
            $query->where('tingkat_jenjang', 'SMP'); // Mengambil pendaftar dengan tingkat jenjang 'SMP'
        })->count();

        // Jumlah pendaftar berdasarkan jenjang (SMA)
        $jumlahPendaftarSMA = AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
            $query->where('tingkat_jenjang', 'SMA'); // Mengambil pendaftar dengan tingkat jenjang 'SMA'
        })->count();

        // Jumlah pendaftar yang sudah membayar
        $jumlahSudahBayar = AkunPendaftar::whereHas('transaksi', function ($query) {
            $query->where('status_pembayaran', 1); // status_pembayaran = 1 berarti sudah membayar
        })->count();

        // Render view dashboard untuk operator
        return view('operator.dashboard.index', compact(
            'operator',
            'jumlahPendaftar',
            'jumlahPendaftarSMP',
            'jumlahPendaftarSMA',
            'jumlahSudahBayar',
            'months', // Nama bulan (label chart)
            'smpCounts', // Data pendaftar SMP per bulan
            'smaCounts',  // Data pendaftar SMA per bulan
            'noJenjangCounts'  // Data pendaftar tanpa jenjang
        ));
    }
}
