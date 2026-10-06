<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Akun Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .info-table th,
        .info-table td {
            padding: 10px;
            border: 1px dotted rgba(0, 0, 0, 0.5);
            text-align: left;
            background-color: rgba(128, 128, 128, 0.1);
            /* Transparan abu-abu */
        }

        .info-table th {
            font-weight: bold;
            background-color: rgba(128, 128, 128, 0.2);
            /* Warna sedikit lebih gelap untuk header */
        }

        .instructions {
            margin-top: 20px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.05);
            /* Sedikit transparan */
            border: 1px solid rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <div style="display: grid; grid-template-columns: 1fr 1fr; align-items: center; width: 100%;">
                <div style="text-align: left;">
                    <img width="150" src="{{ public_path('img/logo-kop.png') }}" alt="Kop-Logo">
                </div>
            </div>
        </center>
        <h1>Kartu Akun Pendaftar</h1>
        <h3>PSB Insan Mulia Boarding School Pringsewu Tahun 2025/2026</h3>
        <table class="info-table">
            <tr>
                <th>No Pendaftaran</th>
                <td>{{ $akun->no_pendaftaran }}</td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $akun->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>NISN</th>
                <td>{{ $akun->nisn }}</td>
            </tr>
            <tr>
                <th>Asal Sekolah</th>
                <td>{{ $akun->asal_sekolah }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $akun->no_hp }}</td>
            </tr>
            {{-- <tr>
                <th>Username</th>
                <td>{{ $akun->username }}</td>
            </tr> --}}
        </table>

        <div class="instructions">
            <p>Gunakan No. Pendaftaran dan NISN Anda untuk login ke sistem PPDB. Harap simpan kartu ini dengan baik.
            </p>
        </div>
    </div>
</body>

</html>
