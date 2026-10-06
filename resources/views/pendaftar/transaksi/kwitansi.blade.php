<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .transaction-details {
            margin-bottom: 20px;
        }

        .transaction-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .transaction-details table th, 
        .transaction-details table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .transaction-details table th {
            background-color: #f4f4f4;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature .name {
            font-weight: bold;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
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
        <div class="header">
            <h1>Kwitansi Pembayaran</h1>
            <p>Nomor Transaksi: {{ $transaksi->kode_transaksi }}</p>
            <!-- Tampilkan barcode -->
            <div class="barcode">
                <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode Kode Transaksi">
            </div>
        </div>

        <div class="transaction-details">
            <table>
                <tr>
                    <th>Nama Pengirim</th>
                    <td>{{ $transaksi->nama_pengirim }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ $transaksi->tanggal_pembayaran->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
                </tr>
                <tr>
                    <th>Nama Biaya</th>
                    <td>{{ $transaksi->biaya->nama_biaya }}</td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>Rp {{ number_format($transaksi->biaya->nominal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>{{ $transaksi->status_pembayaran ? 'Terverifikasi' : 'Belum Terverifikasi' }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Terima kasih atas pembayaran Anda.</p>
        </div>

        <div class="signature">
            <p class="name">Admin PSB IMBOS</p>
            <p>______________________</p>
            <p>Tanggal: {{ now()->format('d-m-Y') }}</p>
        </div>

        
    </div>
</body>
</html>
