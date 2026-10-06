<?php

namespace App\Http\Controllers;

use App\Models\PendaftarTransaksiModel; // Import model transaksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert; // SweetAlert
use Picqer\Barcode\BarcodeGeneratorPNG;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Exports\TransaksiExport;
use App\Models\AkunPendaftar;
use App\Models\ConfigBiayaModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ConfigJenjangModel;
use App\Models\ConfigJalurModel;
use Carbon\Carbon;

class OperatorTransaksiController extends Controller
{
    /**
     * Method untuk menampilkan semua data transaksi.
     */
    // public function index()
    // {
    //     // Ambil semua data transaksi
    //     $transaksis = PendaftarTransaksiModel::with('pendaftar')->get();

    //     // Tampilkan data ke view transaksi.index
    //     return view('operator.transaksi.index', compact('transaksis'));
    // }

    public function index(Request $request)
    {
        // Query dasar untuk transaksi, termasuk relasi dengan pendaftar
        $query = PendaftarTransaksiModel::with('pendaftar', 'biaya');

        // Pencarian berdasarkan no_pendaftaran, nama_pendaftar, nama_pengirim, atau kode_transaksi
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('pendaftar', function ($q) use ($search) {
                $q->where('no_pendaftaran', 'like', '%' . $search . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $search . '%');
            })->orWhere('nama_pengirim', 'like', '%' . $search . '%')
                ->orWhere('kode_transaksi', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan metode pembayaran
        if ($request->filled('filter_metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->input('filter_metode_pembayaran'));
        }

        // Filter berdasarkan status pembayaran
        if ($request->filled('filter_status_pembayaran')) {
            $query->where('status_pembayaran', $request->input('filter_status_pembayaran'));
        }

        // Ambil data jenjang dan jalur dari database
        $jenjangs = ConfigJenjangModel::all();
        $jalurs = ConfigJalurModel::all();

        // Ambil 6 bulan terakhir
        $labels = [];
        $totalPerBulan = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $labels[] = $bulan->format('M Y');

            // Hitung total pembayaran diterima di bulan ini dengan join ke tabel config_biayas
            $totalBulan = PendaftarTransaksiModel::join('config_biayas', 'pendaftar_transaksis.biaya_id', '=', 'config_biayas.id')
                ->whereMonth('tanggal_pembayaran', $bulan->month)
                ->whereYear('tanggal_pembayaran', $bulan->year)
                ->where('status_pembayaran', 1)
                ->sum('config_biayas.nominal');

            $totalPerBulan[] = $totalBulan;
        }

        // Hitung total income (pembayaran yang diterima) hanya untuk status_pembayaran = 1
        $totalIncome = PendaftarTransaksiModel::join('config_biayas', 'pendaftar_transaksis.biaya_id', '=', 'config_biayas.id')
            ->where('pendaftar_transaksis.status_pembayaran', 1) // Pastikan hanya status pembayaran 1
            ->sum('config_biayas.nominal');


        // Ambil semua pendaftar yang belum memiliki transaksi atau yang status pembayarannya selain 1
        $pendaftarBelumBayar = AkunPendaftar::whereDoesntHave('transaksi')
            ->orWhereHas('transaksi', function ($query) {
                $query->where('status_pembayaran', '!=', 1);  // Transaksi yang belum diterima
            })
            ->with(['pendaftarJenjang.jenjang', 'pendaftarJalur.jalur']) // Muat relasi jenjang dan jalur
            ->get();

        // Hitung total nominal yang belum dibayar dari pendaftar yang belum memiliki transaksi atau yang status pembayarannya selain 1
        $totalBelumBayar = 0;
        foreach ($pendaftarBelumBayar as $pendaftar) {
            // Ambil jenjang dan jalur pendaftar
            $jenjangId = optional(optional($pendaftar->pendaftarJenjang)->jenjang)->id;
            $jalurId = optional(optional($pendaftar->pendaftarJalur)->jalur)->id;

            // Temukan biaya berdasarkan jenjang dan jalur
            $biaya = ConfigBiayaModel::where('jenjang_id', $jenjangId)
                ->where('jalur_id', $jalurId)
                ->first();

            // Jika biaya ditemukan, tambahkan nominal ke total
            if ($biaya) {
                $totalBelumBayar += $biaya->nominal;
            }
        }

        // Paginate 10 data per halaman
        $transaksis = $query->paginate(10);

        // Ambil semua metode pembayaran yang tersedia untuk filter
        $metodePembayaran = PendaftarTransaksiModel::select('metode_pembayaran')->distinct()->get();

        return view('operator.transaksi.index', compact('transaksis', 'metodePembayaran', 'jenjangs', 'jalurs', 'labels', 'totalPerBulan', 'totalIncome', 'totalBelumBayar'));
    }


    /**
     * Method untuk memperbarui status pembayaran transaksi.
     */
    public function updateTransaksi(Request $request, $id)
    {
        try {
            // Validasi input dari form
            $request->validate([
                'status_pembayaran' => 'required|in:0,1,2', // Validasi nilai 0, 1, dan 2
            ], [
                'status_pembayaran.required' => 'Status pembayaran wajib diisi.',
                'status_pembayaran.in' => 'Status pembayaran tidak valid.',
            ]);

            // Cari transaksi berdasarkan ID
            $transaksi = PendaftarTransaksiModel::findOrFail($id);

            // Update status pembayaran
            $transaksi->status_pembayaran = $request->input('status_pembayaran');
            $transaksi->save();

            // Tampilkan pesan sukses menggunakan SweetAlert
            Alert::success('Berhasil', 'Status pembayaran berhasil diverifikasi.');

            // Redirect kembali ke halaman transaksi
            return redirect()->route('operator.transaksi.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika transaksi tidak ditemukan
            Alert::error('Error', 'Data transaksi tidak ditemukan.');
            return redirect()->route('operator.transaksi.index');
        } catch (\Exception $e) {
            // Tangani error lain
            Alert::error('Error', 'Terjadi kesalahan saat memproses verifikasi.');
            return redirect()->route('operator.transaksi.index');
        }
    }

    public function downloadKwitansi($id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = PendaftarTransaksiModel::with('biaya', 'pendaftar')->findOrFail($id);

        // Cek apakah pembayaran sudah diterima (status_pembayaran == 1)
        if ($transaksi->status_pembayaran != 1) {
            // Jika pembayaran belum diterima, tampilkan alert warning
            Alert::warning('Peringatan', 'Pembayaran belum diterima, kwitansi tidak dapat diunduh.');
            return redirect()->back(); // Kembali ke halaman sebelumnya
        }

        // Generate barcode dari kode transaksi
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($transaksi->kode_transaksi, $generator::TYPE_CODE_128));

        // Buat PDF dari view kwitansi
        $pdf = Pdf::loadView('operator.transaksi.kwitansi', compact('transaksi', 'barcode'));

        // Download file PDF kwitansi
        return $pdf->download('kwitansi_transaksi_' . $transaksi->kode_transaksi . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        // Mengambil filter dari request
        $statusPembayaran = $request->input('status_pembayaran');
        $metodePembayaran = $request->input('metode_pembayaran');
        $jenjang = $request->input('jenjang');
        $jalur = $request->input('jalur');

        // Dapatkan tanggal dan waktu saat ini
        $now = Carbon::now()->format('Ymd_His'); // Format: YYYYMMDD_HHMMSS

        // Buat nama file dengan tanggal dan waktu saat ini
        $fileName = 'Transaksi_' . $now . '.xlsx';

        // Export data ke Excel menggunakan TransaksiExport class
        return Excel::download(new TransaksiExport($statusPembayaran, $metodePembayaran, $jenjang, $jalur), $fileName);
    }

    public function destroy($id)
    {
        try {
            $transaksi = PendaftarTransaksiModel::findOrFail($id);
            $transaksi->delete();

            Alert::success('Berhasil', 'Data transaksi berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Data transaksi tidak ditemukan.');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('operator.transaksi.index');
    }
}
