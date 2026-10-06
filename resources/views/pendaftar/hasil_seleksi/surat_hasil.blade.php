{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Hasil Seleksi</title>
</head>
<body>
    <h2>Surat Hasil Seleksi</h2>
    <!-- Barcode -->
    <div>
        {!! $barcode !!}
    </div>
    <p>Dengan ini menyatakan bahwa:</p>
    <ul>
        <li><strong>Nama:</strong> {{ $hasil_seleksi->pendaftar->nama_lengkap }}</li>
        <li><strong>NISN:</strong> {{ $hasil_seleksi->pendaftar->nisn }}</li>
        <li><strong>Tempat Lahir:</strong> {{ optional($hasil_seleksi->pendaftar->biodata_diri)->tempat_lahir ?? 'Data belum tersedia' }}</li>
        <li><strong>Tanggal Lahir:</strong> {{ optional($hasil_seleksi->pendaftar->biodata_diri)->tgl_lahir ?? 'Data belum tersedia' }}</li>
    </ul>
    <p><strong>Status Kelulusan:</strong> {{ $status_kelulusan }}</p>
    <p>Surat ini dikeluarkan sebagai bukti hasil seleksi penerimaan peserta didik baru.</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Hasil Seleksi_{{ $hasil_seleksi->pendaftar->nama_lengkap }}</title>

    <style>
        /* Watermark Style */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.1;
            /* Transparansi 10% */
            font-size: 100px;
            /* Ukuran font untuk teks watermark, bisa juga menggunakan gambar */
            color: #000;
            /* Warna watermark */
        }

        /* Untuk membuatnya blur samar-samar */
        .watermark img {
            width: 100%;
            height: auto;
            filter: blur(3px);
            /* Membuat gambar watermark menjadi blur */
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
            <h4><u>Surat Keterangan Hasil Seleksi PSB IMBOS Pringsewu</u></h4>
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode No. Pendaftaran">
            <p style="margin-top: -3px">No. Pendaftaran : {{ $hasil_seleksi->pendaftar->no_pendaftaran }}</p>
        </center>
    </div>

    <p style="text-align: justify">
        Dengan mempertimbangkan hasil seleksi yang telah dilakukan secara objektif dan transparan, berdasarkan kriteria
        serta ketentuan yang telah ditetapkan oleh <b>Panitia Penerimaan Santri Baru (PSB) IMBOS
            Pringsewu</b>, maka dengan ini kami menyatakan bahwa :
    </p>

    <div class="table-responsive" style="margin-top: -8px">
        <table style="font-size: 12px" class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>{{ $hasil_seleksi->pendaftar->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>{{ $hasil_seleksi->pendaftar->nisn }}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td>{{ optional($hasil_seleksi->pendaftar->biodata_diri)->tempat_lahir ?? 'Data belum tersedia' }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ optional($hasil_seleksi->pendaftar->biodata_diri)->tgl_lahir ?? 'Data belum tersedia' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="text-align: center"><strong>Dinyatakan :</strong></p>

    @if ($status_kelulusan === 'Lulus')
        <h4 style="text-align: center; color:#007BFF;">
            {{ $status_kelulusan }} - {{ $jalur->jalur->nama_jalur }}
        </h4>
    @elseif ($status_kelulusan === 'Tidak Lulus')
        <h4 style="text-align: center; color:#ff0000;">
            {{ $status_kelulusan }} - {{ $jalur->jalur->nama_jalur }}
        </h4>
    @elseif ($status_kelulusan === 'Cadangan')
        <h4 style="text-align: center; color:#ffa200;">
            {{ $status_kelulusan }} - {{ $jalur->jalur->nama_jalur }}
        </h4>
    @else
        <span class="badge badge-secondary">Belum Ditentukan</span>
    @endif

    @if ($status_kelulusan === 'Lulus')
        <p style="text-align: justify">
            Keputusan ini diambil berdasarkan hasil penilaian yang objektif serta pertimbangan akademik maupun
            non-akademik
            yang telah dilakukan oleh tim seleksi. Dengan ini, kami mengucapkan selamat atas kelulusan yang telah
            dicapai,
            serta mengimbau agar segera melakukan proses daftar ulang sesuai dengan jadwal yang telah ditentukan
            oleh
            panitia.
        </p>
    @elseif ($status_kelulusan === 'Tidak Lulus')
        <p style="text-align: justify">
            Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada IMBOS Pringsewu, serta
            berharap agar saudara dapat meraih kesuksesan di masa depan.
        </p>
    @elseif ($status_kelulusan === 'Cadangan')
        <p style="text-align: justify">
            Hal ini berarti bahwa saat ini saudara belum masuk dalam daftar utama peserta yang diterima, namun masih
            memiliki peluang untuk diterima. Untuk informasi lebih lanjut mengenai status pendaftaran, harap
            menghubungi panitia penerimaan melalui kontak yang telah disediakan.
        </p>
    @else
        <span class="badge badge-secondary">Belum Ditentukan</span>
    @endif

</body>

</html>
