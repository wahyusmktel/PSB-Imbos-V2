<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use App\Models\BiodataDiriModel;
use App\Models\HasilSeleksiModel;
use App\Models\PendaftarJalurModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\ConfigPpdbModel;

class PendaftarHasilSeleksiController extends Controller
{
    // Method untuk menampilkan halaman hasil seleksi
    public function index()
    {
        // Ambil data akun pendaftar
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;
        $akun_pendaftar = AkunPendaftar::findOrFail($pendaftar_id);

        // Ambil data biodata diri
        $biodata_diri = BiodataDiriModel::where('id_pendaftar', $pendaftar_id)->first();

        // Ambil hasil seleksi dari tabel hasil_seleksis
        $hasil_seleksi = HasilSeleksiModel::where('pendaftar_id', $pendaftar_id)->first();

        // Ambil data pengumuman dari model
        $configPPDB = ConfigPpdbModel::select('ppdb_pengumuman')->first();

        // Cek apakah hasil seleksi tersedia
        if (!$hasil_seleksi) {
            // Jika tidak ada hasil seleksi, tampilkan alert dan arahkan kembali
            Alert::warning('Hasil Seleksi Belum Tersedia', 'Silakan cek berkala untuk melihat hasil seleksi.');
            return redirect()->route('pendaftar.dashboard');
        }

        return view('pendaftar.hasil_seleksi.index', compact('akun_pendaftar', 'biodata_diri', 'hasil_seleksi', 'configPPDB'));
    }

    // Method untuk mendownload surat hasil seleksi dalam bentuk PDF
    public function downloadHasilSeleksi()
    {
        // Ambil data akun pendaftar
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Ambil hasil seleksi dari tabel hasil_seleksis
        $hasil_seleksi = HasilSeleksiModel::where('pendaftar_id', $pendaftar_id)->first();

        // Ambil jalur pendaftaran
        $jalur = PendaftarJalurModel::where('pendaftar_id', $pendaftar_id)->first();

        // Validasi apakah hasil seleksi tersedia
        if (!$hasil_seleksi) {
            Alert::error('Pengumuman Belum Tersedia', 'Saat ini pengumuman hasil seleksi belum tersedia.');
            return redirect()->route('pendaftar.hasil_seleksi.index');
        }

        // Tentukan status kelulusan
        $status_kelulusan = '';
        switch ($hasil_seleksi->hasil_kelulusan) {
            case 1:
                $status_kelulusan = 'Lulus';
                break;
            case 2:
                $status_kelulusan = 'Tidak Lulus';
                break;
            case 3:
                $status_kelulusan = 'Cadangan';
                break;
            default:
                $status_kelulusan = 'Belum Ada Hasil';
        }

        // Ambil nomor pendaftaran
        $nomor_pendaftaran = $hasil_seleksi->pendaftar->no_pendaftaran;

        // Generate barcode
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($nomor_pendaftaran, $generator::TYPE_CODE_128));

        // Load view untuk PDF
        $pdf = PDF::loadView('pendaftar.hasil_seleksi.surat_hasil', compact('hasil_seleksi', 'status_kelulusan', 'barcode', 'jalur'));

        // Download file PDF
        return $pdf->download('Surat_Hasil_Seleksi_' . $hasil_seleksi->pendaftar->nama_lengkap . '.pdf');
    }
}
