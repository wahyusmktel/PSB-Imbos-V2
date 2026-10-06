{{-- 
    <h3 class="text-center">Formulir Pendaftaran</h3>

    <h4>Data Akun Pendaftar</h4>
    <p>Nama: {{ $akunPendaftar->nama_lengkap }}</p>
    <p>NISN: {{ $akunPendaftar->nisn }}</p>
    <p>No HP: {{ $akunPendaftar->no_hp }}</p>

    <h4>Biodata Diri</h4>
    <p>Alamat Asal Sekolah: {{ $biodataDiri->alamat_asal_sekolah }}</p>
    <p>Ukuran Baju: {{ $biodataDiri->ukuran_baju }}</p>

    <h4>Biodata Orang Tua</h4>
    <p>Nama Ayah: {{ $biodataOrangTua->nama_ayah }}</p>
    <p>Nama Ibu: {{ $biodataOrangTua->nama_ibu }}</p>

    <h4>Alamat Tempat Tinggal</h4>
    <p>Alamat: {{ $alamat->alamat_tempat_tinggal }}</p>

    <h4>Berkas yang Diunggah</h4>
    <ul>
        @foreach ($berkas as $b)
            <li>{{ $b->file }}</li>
        @endforeach
    </ul>

    <h4>Jalur dan Jenjang</h4>
    <p>Jalur: {{ $jalur->nama_jalur }}</p>
    <p>Jenjang: {{ $jenjang->nama_jenjang }}</p>

    <h4>Kuesioner</h4>
    <p>Masuk Insan Mulia: {{ $kuesioner->masuk_insan_mulia }}</p>

    <h4>Riwayat Penyakit</h4>
    <p>Nama Penyakit: {{ $penyakit->nama_penyakit }}</p>

    <h4>Transaksi Pembayaran</h4>
    <ul>
        @foreach ($transaksi as $t)
            <li>Kode Transaksi: {{ $t->kode_transaksi }}</li>
            <li>Status Pembayaran: {{ $t->status_pembayaran ? 'Terverifikasi' : 'Belum Diverifikasi' }}</li>
        @endforeach
    </ul> --}}


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Formulir_{{ $akunPendaftar->nama_lengkap }}</title>

    <style>
        /* Watermark Style */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.1; /* Transparansi 10% */
            font-size: 100px; /* Ukuran font untuk teks watermark, bisa juga menggunakan gambar */
            color: #000; /* Warna watermark */
        }

        /* Untuk membuatnya blur samar-samar */
        .watermark img {
            width: 100%;
            height: auto;
            filter: blur(3px); /* Membuat gambar watermark menjadi blur */
        }

        /* Typography */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* General table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            vertical-align: top;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Center text for certain elements */
        .centered {
            text-align: center;
        }

        /* Image Styles */
        img {
            border-radius: 0px;
            display: block;
            margin: 0 auto;
        }

        /* Table styling for better spacing */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .table-bordered th {
            background-color: #007BFF;
            color: white;
        }

        /* Styles for headers and titles */
        h3,
        h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        /* Horizontal line styling */
        hr {
            border: 0;
            border-top: 2px solid #007BFF;
            margin: 20px 0;
        }

        /* Additional Styling for icons and WhatsApp links */
        .fas,
        .fab {
            color: #28a745;
        }

        i.fab.fa-whatsapp {
            font-size: 18px;
            margin-right: 5px;
        }

        /* Responsive table */
        .table-responsive {
            overflow-x: auto;
        }

        /* Informational Notice */
        .alert-info {
            background-color: #e9f7fd;
            color: #31708f;
            border-color: #bce8f1;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
        }

        /* Custom Print Date & Info */
        .print-info {
            font-style: italic;
            color: #555;
        }

        /* Footer notes */
        footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }

        .noborder {
            border: 0px;
        }

        /* For Print Media */
        @media print {
            body {
                font-size: 12px;
                color: #000;
            }

            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body>
    <!-- Watermark Element -->
    <div class="watermark">
        <img src="{{ public_path('img/logo-imbos.png') }}" alt="Watermark">
        <!-- Atau bisa pakai teks watermark -->
        <!-- <span>WATERMARK</span> -->
    </div>
    <center>
        <div style="display: grid; grid-template-columns: 1fr 1fr; align-items: center; width: 100%;">
            <div style="text-align: left;">
                <img width="150" src="{{ public_path('img/logo-kop.png') }}" alt="Kop-Logo">
            </div>
        </div>
    </center>

    <div style="margin-top: -20px">
        <center>
            <h4><u>Formulir Pendaftaran - Jenjang {{ $jenjang->jenjang->tingkat_jenjang }}</u></h4>
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode No. Pendaftaran">
            <p style="margin-top: -3px">No. Pendaftaran : {{ $akunPendaftar->no_pendaftaran }}</p>
        </center>
    </div>

    <div class="table-responsive" style="margin-top: -8px">
        <table style="font-size: 12px" class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <!-- <th align="center" width="90">
                        <center>FOTO SISWA</center>
                    </th> -->
                    <td align="left" ><b>1. DATA PRIBADI SISWA</b></td>
                </tr>
                <tr>
                    <!-- <td rowspan="7">
                        {{-- <img src="{{ public_path('storage/' . $biodataDiri->pas_photo) }}" width="120" /> --}}
                        @if(!empty($fotoBase64))
                            <img src="data:{{ $fotoMime }};base64,{{ $fotoBase64 }}" width="120" alt="Foto Siswa">
                        @else
                            {{-- Placeholder kalau foto belum ada --}}
                            <div style="width:120px; height:160px; border:1px solid #999; position:relative; margin:0 auto;">
                                <div style="position:absolute; top:0; left:0; right:0; bottom:0;
                                            background: linear-gradient(to bottom right, #999 0, #999 50%, transparent 50%, transparent 100%);">
                                </div>
                            </div>
                        @endif
                    </td> -->
                    <td><b>NISN</b></td>
                    <td>{{ $akunPendaftar->nisn }}</td>
                </tr>

                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td align="left">{{ $akunPendaftar->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td><b>Tempat Tgl Lahir</b></td>
                    <td align="left">{{ $biodataDiri->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($biodataDiri->tgl_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td><b>Jenis Kelamin</b></td>
                    <td align="left">{{ $biodataDiri->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td><b>Asal Sekolah</b></td>
                    <td align="left">{{ $akunPendaftar->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td><b>No Handphone</b></td>
                    <td align="left">{{ $akunPendaftar->no_hp }}</td>
                </tr>
                <tr>
                    <td style="color: red;"><b>Jalur Pendaftaran</b></td>
                    <td align="left" style="color: red;"><b>{{ $jalur->jalur->nama_jalur }}</b></td>
                </tr>

            </tbody>
        </table>
        <table style="font-size: 12px" class="table table-bordered table-striped table-sm ">
            <tbody>
                <tr>
                    <td align="left" style="width: 150px" colspan="2"><b>2. Data Alamat</b>
                    </td>
                </tr>
                <tr>
                    <td><b>Alamat Tempat Tinggal</b></td>
                    <td align="left">{{ $alamat->alamat_tempat_tinggal }}</td>
                </tr>
                <tr>
                    <td><b>RT/RW</b></td>
                    <td align="left"> {{ $alamat->rt }} / {{ $alamat->rw }}</td>
                </tr>
                <tr>
                    <td><b>Provinsi</b></td>
                    <td align="left">{{ $province ? $province->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Kabupaten/Kota</b></td>
                    <td align="left">{{ $kabupaten ? $kabupaten->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Kecamatan</b></td>
                    <td align="left">{{ $kecamatan ? $kecamatan->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Desa/Kelurahan</b></td>
                    <td align="left">{{ $desa ? $desa->name : 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
        <table style="font-size: 12px" class="table table-bordered table-striped table-sm ">
            <tbody>
                <tr>
                    <td align="left" style="width: 150px"><b>3. Data Orang Tua</b>
                    </td>
                    <td align="left"><b>Data Ayah</b></td>
                    <td align="left"><b>Data Ibu</b></td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap</b></td>
                    <td align="left">{{ $biodataOrangTua->nama_ayah }}</td>
                    <td align="left">{{ $biodataOrangTua->nama_ibu }}</td>
                </tr>
                <tr>
                    <td><b>Pekerjaan</b></td>
                    <td align="left"> {{ $biodataOrangTua->pekerjaan_ayah }}</td>
                    <td align="left"> {{ $biodataOrangTua->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <td><b>No Hp</b></td>
                    <td align="left">{{ $biodataOrangTua->telp_ayah }}
                    </td>
                    <td align="left">{{ $biodataOrangTua->telp_ibu }}</td>
                </tr>
                <tr>
                    <td><b>Alamat</b></td>
                    <td align="left">{{ $biodataOrangTua->alamat_lengkap_ayah }}</td>
                    <td align="left">{{ $biodataOrangTua->alamat_ibu }}</td>
                </tr>
            </tbody>
        </table>
        <!-- End -->
        <table style="font-size: 10px">
            <tbody>
                <tr>
                    <td align="left" colspan="4">
                        <b>Informasi Tambahan</b><br>
                        *<i>( Jadwal Tes Tertulis dan Wawancara akan di informasikan lebih lanjut di Group
                            WhatsApp )</i><br>
                        <b>Silahkan membawa berkas dibawah ini ketika pelaksanaan tes :</b>
                        <ul>
                            <li>Bawa Materai 10.000 1 buah</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="4">Print Date:
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} | <i>Waktu Pendaftaran:
                            {{ \Carbon\Carbon::parse($akunPendaftar->created_at)->translatedFormat('d F Y') }}</i>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</body>

</html>
