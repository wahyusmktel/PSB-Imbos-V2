<?php

namespace App\Exports;

use App\Models\PendaftarTransaksiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $statusPembayaran;
    protected $metodePembayaran;
    protected $jenjang;
    protected $jalur;

    // Simpan total biaya
    protected $totalBiaya = 0;

    public function __construct($statusPembayaran = null, $metodePembayaran = null, $jenjang = null, $jalur = null)
    {
        $this->statusPembayaran = $statusPembayaran;
        $this->metodePembayaran = $metodePembayaran;
        $this->jenjang = $jenjang;
        $this->jalur = $jalur;
    }

    // Mengambil data transaksi berdasarkan filter
    public function collection()
    {
        $query = PendaftarTransaksiModel::with(['pendaftar.pendaftarJenjang.jenjang', 'pendaftar.pendaftarJalur.jalur', 'biaya']);

        // Filter berdasarkan status pembayaran
        if ($this->statusPembayaran !== null) {
            $query->where('status_pembayaran', $this->statusPembayaran);
        }

        // Filter berdasarkan metode pembayaran
        if ($this->metodePembayaran) {
            $query->where('metode_pembayaran', $this->metodePembayaran);
        }

        // Filter berdasarkan jenjang
        if ($this->jenjang) {
            $query->whereHas('pendaftar.pendaftarJenjang', function ($q) {
                $q->where('jenjang_id', $this->jenjang);
            });
        }

        // Filter berdasarkan jalur
        if ($this->jalur) {
            $query->whereHas('pendaftar.pendaftarJalur', function ($q) {
                $q->where('jalur_id', $this->jalur);
            });
        }

        return $query->get();
    }

    // Mengatur heading di Excel
    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Pendaftar',
            'Nama Pengirim',
            'Metode Pembayaran',
            'Status Pembayaran',
            'Kode Transaksi',
            'Tanggal Pembayaran',
            'Nama Jenjang',
            'Nama Jalur',
            'Rincian Pembayaran',
            'Nominal Biaya',
        ];
    }

    // Mapping data transaksi ke kolom Excel
    public function map($transaksi): array
    {

        // Tambahkan nominal biaya ke total biaya
        $nominal = optional($transaksi->biaya)->nominal ?? 0;
        $this->totalBiaya += $nominal;

        return [
            // No. Pendaftaran
            optional($transaksi->pendaftar)->no_pendaftaran ?? 'Tidak ada data',

            // Nama Pendaftar
            optional($transaksi->pendaftar)->nama_lengkap ?? 'Tidak ada data',

            // Nama Pengirim
            $transaksi->nama_pengirim,

            // Metode Pembayaran
            ucfirst($transaksi->metode_pembayaran),

            // Status Pembayaran
            $transaksi->status_pembayaran == 1 ? 'Sudah Diterima' : ($transaksi->status_pembayaran == 2 ? 'Ditolak' : 'Sedang Diproses'),

            // Kode Transaksi
            $transaksi->kode_transaksi,

            // Tanggal Pembayaran
            $transaksi->tanggal_pembayaran ? $transaksi->tanggal_pembayaran->format('d-m-Y') : 'Tidak ada data',

            // Nama Jenjang (gunakan optional untuk menghindari error)
            optional(optional($transaksi->pendaftar->pendaftarJenjang)->jenjang)->tingkat_jenjang ?? 'Tidak ada data',

            // Nama Jalur (gunakan optional untuk menghindari error)
            optional(optional($transaksi->pendaftar->pendaftarJalur)->jalur)->nama_jalur ?? 'Tidak ada data',

            // Rincian Biaya
            optional($transaksi->biaya)->nama_biaya ?? 'Tidak ada data',

            // Nominal Biaya
            'Rp ' . number_format(optional($transaksi->biaya)->nominal, 0, ',', '.'),
        ];
    }

    // Mengatur border dan style untuk Excel
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        // Menambahkan border pada semua data
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Style untuk heading (misal, menebalkan font)
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Menambahkan total biaya di bagian paling bawah
        $sheet->setCellValue('J' . ($highestRow + 1), 'Total Biaya');
        $sheet->setCellValue('K' . ($highestRow + 1), 'Rp ' . number_format($this->totalBiaya, 0, ',', '.'));

        // Style untuk baris total
        $sheet->getStyle('J' . ($highestRow + 1) . ':K' . ($highestRow + 1))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    // Mengatur lebar kolom agar sesuai dengan panjang data
    public function columnWidths(): array
    {
        return [
            'A' => 20,  // No. Pendaftaran
            'B' => 30,  // Nama Pendaftar
            'C' => 30,  // Nama Pengirim
            'D' => 20,  // Metode Pembayaran
            'E' => 20,  // Status Pembayaran
            'F' => 25,  // Kode Transaksi
            'G' => 20,  // Tanggal Pembayaran
            'H' => 20,  // Nama Jenjang
            'I' => 20,  // Nama Jalur
            'J' => 20,  // Rincian Biaya
            'K' => 20,  // Nominal Biaya
        ];
    }
}
