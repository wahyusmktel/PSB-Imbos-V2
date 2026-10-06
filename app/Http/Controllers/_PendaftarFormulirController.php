<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use App\Models\BiodataDiriModel;
use App\Models\BiodataOrangTuaModel;
use App\Models\PendaftarAlamatModel;
use App\Models\PendaftarBerkas;
use App\Models\PendaftarJalurModel;
use App\Models\PendaftarJenjangModel;
use App\Models\KuesionerModel;
use App\Models\BiodataPenyakitModel;
use App\Models\District;
use App\Models\PendaftarTransaksiModel;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PendaftarFormulirController extends Controller
{
    public function cetakFormulir()
    {
        $pendaftar_id = Auth::guard('pendaftar')->user()->id;

        // Ambil semua data
        $akunPendaftar = AkunPendaftar::findOrFail($pendaftar_id);
        $biodataDiri = BiodataDiriModel::where('id_pendaftar', $pendaftar_id)->first();
        $biodataOrangTua = BiodataOrangTuaModel::where('pendaftar_id', $pendaftar_id)->first();
        $alamat = PendaftarAlamatModel::where('pendaftar_id', $pendaftar_id)->first();
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftar_id)->get();
        $jalur = PendaftarJalurModel::where('pendaftar_id', $pendaftar_id)->first();
        $jenjang = PendaftarJenjangModel::where('pendaftar_id', $pendaftar_id)->first();
        // $kuesioner = KuesionerModel::where('pendaftar_id', $pendaftar_id)->first();
        // $penyakit = BiodataPenyakitModel::where('pendaftar_id', $pendaftar_id)->first();
        $transaksi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)->get();

        // Ambil transaksi dengan status_pembayaran = 0 (belum diverifikasi)
        $transaksiBelumTerverifikasi = PendaftarTransaksiModel::where('pendaftar_id', $pendaftar_id)
            ->where('status_pembayaran', 0)
            ->exists(); // Menggunakan exists untuk memeriksa apakah ada transaksi yang belum diverifikasi

        // Buat array untuk menyimpan tabel yang belum terisi
        $dataBelumLengkap = [];

        // Cek apakah data sudah ada atau belum, jika tidak tambahkan ke array dataBelumLengkap
        if (!$biodataDiri) {
            $dataBelumLengkap[] = 'Biodata Diri';
        }
        if (!$biodataOrangTua) {
            $dataBelumLengkap[] = 'Biodata Orang Tua';
        }
        if (!$alamat) {
            $dataBelumLengkap[] = 'Alamat Tempat Tinggal';
        }
        // Pengecekan berkas hanya jika pendaftar bukan dari Jalur Reguler
        if ($jalur && $jalur->jalur && $jalur->jalur->nama_jalur !== 'Jalur Reguler') {
            if ($berkas->isEmpty()) {
                $dataBelumLengkap[] = 'Berkas Pendaftaran';
            }
        }
        if (!$jalur) {
            $dataBelumLengkap[] = 'Jalur Pendaftaran';
        }
        if (!$jenjang) {
            $dataBelumLengkap[] = 'Jenjang Pendidikan';
        }
        // if (!$kuesioner) {
        //     $dataBelumLengkap[] = 'Kuesioner';
        // }
        // if (!$penyakit) {
        //     $dataBelumLengkap[] = 'Riwayat Penyakit';
        // }
        if ($transaksi->isEmpty()) {
            $dataBelumLengkap[] = 'Transaksi Pembayaran';
        }

        // Tambahkan validasi jika ada transaksi yang belum diverifikasi
        if ($transaksiBelumTerverifikasi) {
            $dataBelumLengkap[] = 'Transaksi Pembayaran belum diverifikasi';
        }

        // Jika ada data yang belum terisi, kembalikan ke dashboard dan tampilkan pesan
        if (!empty($dataBelumLengkap)) {
            $message = 'Anda belum melengkapi data berikut: ' . implode(', ', $dataBelumLengkap) . '. Silakan lengkapi data terlebih dahulu sebelum mencetak formulir.';
            Alert::error('Validasi Gagal', $message);
            return redirect()->route('pendaftar.dashboard');
        }

        // Generate barcode dari no_pendaftaran
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($akunPendaftar->no_pendaftaran, $generator::TYPE_CODE_128));

        $province = $alamat ? Province::find($alamat->provinsi_id) : null;
        $kabupaten = $alamat ? Regency::find($alamat->kabupaten_id) : null;
        $kecamatan = $alamat ? District::find($alamat->kecamatan_id) : null;
        $desa = $alamat ? Village::find($alamat->desa_id) : null;

        // Jika semua data sudah lengkap, generate PDF
        $pdf = PDF::loadView('pendaftar.formulir.cetak', compact(
            'akunPendaftar',
            'biodataDiri',
            'biodataOrangTua',
            'alamat',
            'berkas',
            'jalur',
            'jenjang',
            'transaksi',
            'barcode',
            'province',
            'kabupaten',
            'kecamatan',
            'desa'
        ));

        return $pdf->download('formulir_pendaftaran.pdf');
        // return $pdf->stream('formulir_pendaftaran.pdf');
    }
}
