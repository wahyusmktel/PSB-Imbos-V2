<?php

namespace App\Exports;

use App\Models\AkunPendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftarExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $jenjang;
    protected $jalur;
    protected $statusPembayaran;
    protected $gelombang;

    // Konstruktor untuk menerima filter
    public function __construct($jenjang = null, $jalur = null, $statusPembayaran = null, $gelombang = null)
    {
        $this->jenjang = $jenjang;
        $this->jalur = $jalur;
        $this->statusPembayaran = $statusPembayaran;
        $this->gelombang = $gelombang;
    }

    // Method untuk menambahkan border
    public function styles(Worksheet $sheet)
    {
        // Menambahkan border ke seluruh sel yang berisi data
        $sheet->getStyle('A1:Y' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }

    // Mengambil data untuk dikonversi menjadi koleksi
    public function collection()
    {
        // Query untuk mengambil data pendaftar beserta relasi jenjang, jalur, alamat, dll.
        $pendaftar = AkunPendaftar::with([
            'pendaftarJenjang.jenjang',
            'pendaftarJalur.jalur',
            'transaksi',
            'biodataDiri',
            'alamat.province',   // Relasi provinsi dari alamat
            'alamat.regency',    // Relasi kabupaten dari alamat
            'alamat.district',   // Relasi kecamatan dari alamat
            'alamat.village'     // Relasi desa dari alamat
        ])
            ->when($this->jenjang, function ($query) {
                return $query->whereHas('pendaftarJenjang', function ($q) {
                    $q->where('jenjang_id', $this->jenjang);
                });
            })
            ->when($this->jalur, function ($query) {
                return $query->whereHas('pendaftarJalur', function ($q) {
                    $q->where('jalur_id', $this->jalur);
                });
            })
            ->when($this->statusPembayaran !== null, function ($query) {
                return $query->whereHas('transaksi', function ($q) {
                    $q->where('status_pembayaran', $this->statusPembayaran);
                });
            })
            ->when($this->gelombang, function ($query) {
                if ($this->gelombang == 1) {
                    return $query->where(function ($q) {
                        $q->whereNull('gelombang')->orWhere('gelombang', '!=', 2);
                    });
                } else {
                    return $query->where('gelombang', $this->gelombang);
                }
            })            
            ->get();

        // Mapping data menjadi array sesuai dengan kolom yang akan ditampilkan di Excel
        return $pendaftar->map(function ($pendaftar) {
            return [
                $pendaftar->no_pendaftaran,
                (!empty($pendaftar->gelombang) && $pendaftar->gelombang == 2) ? 'Gelombang 2' : 'Gelombang 1',
                $pendaftar->nama_lengkap,
                $pendaftar->nisn,
                $pendaftar->asal_sekolah,
                $pendaftar->no_hp,
                $pendaftar->username,
                $pendaftar->status == 1 ? 'Aktif' : 'Nonaktif',
                optional(optional($pendaftar->pendaftarJenjang)->jenjang)->tingkat_jenjang ?? 'Tidak ada data',
                optional(optional($pendaftar->pendaftarJalur)->jalur)->nama_jalur ?? 'Tidak ada data',
                $pendaftar->transaksi ? ($pendaftar->transaksi->status_pembayaran == 1 ? 'Sudah Diterima' : 'Sedang Proses Verifikasi') : 'Belum Membayar',
                // Data Diri
                optional($pendaftar->biodataDiri)->tempat_lahir ?? 'Tidak ada data',
                optional($pendaftar->biodataDiri)->tgl_lahir ?? 'Tidak ada data',
                optional($pendaftar->biodataDiri)->jenis_kelamin ?? 'Tidak ada data',
                optional($pendaftar->biodataDiri)->agama ?? 'Tidak ada data',
                // Alamat
                optional($pendaftar->alamat)->alamat_tempat_tinggal ?? 'Tidak ada data',  // Alamat tempat tinggal
                optional(optional($pendaftar->alamat)->province)->name ?? 'Tidak ada data',  // Nama provinsi
                optional(optional($pendaftar->alamat)->regency)->name ?? 'Tidak ada data',   // Nama kabupaten
                optional(optional($pendaftar->alamat)->district)->name ?? 'Tidak ada data',  // Nama kecamatan
                optional(optional($pendaftar->alamat)->village)->name ?? 'Tidak ada data',   // Nama desa
                // Data Orang Tua
                optional($pendaftar->biodataOrangTua)->nama_ayah ?? 'Tidak ada data',
                optional($pendaftar->biodataOrangTua)->nama_ibu ?? 'Tidak ada data',
                optional($pendaftar->biodataOrangTua)->pekerjaan_ayah ?? 'Tidak ada data',
                optional($pendaftar->biodataOrangTua)->pekerjaan_ibu ?? 'Tidak ada data',
                // Riwayat Penyakit
                optional($pendaftar->pendaftarPenyakit)->nama_penyakit ?? 'Tidak ada data',
            ];
        });
    }



    // Menampilkan judul kolom
    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Gelombang',
            'Nama Lengkap',
            'NISN',
            'Asal Sekolah',
            'No HP',
            'Username',
            'Status',
            'Jenjang',
            'Jalur',
            'Status Pembayaran',
            // Data Diri
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            // Alamat
            'Alamat Tempat Tinggal',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            // Orang Tua
            'Nama Ayah',
            'Nama Ibu',
            'Pekerjaan Ayah',
            'Pekerjaan Ibu',
            // Riwayat Penyakit
            'Riwayat Penyakit',
        ];
    }
}
