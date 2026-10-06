@extends('layouts.app_operator')

@section('title', 'Data Transaksi')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Data Transaksi Pendaftar</h2>
                    <h5 class="text-white op-7 mb-2">Daftar semua transaksi pendaftar</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <form action="{{ route('operator.transaksi.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari No Pendaftaran, Nama Pendaftar, Nama Pengirim, Kode Transaksi"
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <!-- Form Pencarian dan Filter -->
                        <form action="{{ route('operator.transaksi.index') }}" method="GET" class="form-inline">
                            {{-- <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari No Pendaftaran, Nama Pendaftar, Nama Pengirim, Kode Transaksi"
                                    value="{{ request('search') }}">
                            </div> --}}

                            <!-- Filter Metode Pembayaran -->
                            <div class="form-group mr-2">
                                <label for="filter_metode_pembayaran" class="mr-2">Metode Pembayaran</label>
                                <select name="filter_metode_pembayaran" class="form-control">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    @foreach ($metodePembayaran as $metode)
                                        <option value="{{ $metode->metode_pembayaran }}"
                                            {{ request('filter_metode_pembayaran') == $metode->metode_pembayaran ? 'selected' : '' }}>
                                            {{ $metode->metode_pembayaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Status Pembayaran -->
                            <div class="form-group mr-2">
                                <label for="filter_status_pembayaran" class="mr-2">Metode Pembayaran</label>
                                <select name="filter_status_pembayaran" class="form-control">
                                    <option value="">Pilih Status Pembayaran</option>
                                    <option value="0"
                                        {{ request('filter_status_pembayaran') == '0' ? 'selected' : '' }}>Sedang Diproses
                                    </option>
                                    <option value="1"
                                        {{ request('filter_status_pembayaran') == '1' ? 'selected' : '' }}>Sudah Diterima
                                    </option>
                                    <option value="2"
                                        {{ request('filter_status_pembayaran') == '2' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <!-- Tombol Filter dan Reset -->
                            <div class="form-group">
                                <div class="btn-group" role="group" aria-label="Filter and Reset">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i>
                                        Filter</button>
                                    <a href="{{ route('operator.transaksi.index') }}" class="btn btn-secondary"><i
                                            class="fas fa-redo"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exportExcelModal">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <!-- Modal Export Excel -->
                        <div class="modal fade" id="exportExcelModal" tabindex="-1" role="dialog"
                            aria-labelledby="exportExcelModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exportExcelModalLabel">Export Data Transaksi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Export Excel -->
                                        <form action="{{ route('operator.transaksi.export') }}" method="GET">
                                            <!-- Filter Status Pembayaran -->
                                            <div class="form-group">
                                                <label for="status_pembayaran">Status Pembayaran</label>
                                                <select name="status_pembayaran" class="form-control">
                                                    <option value="">Semua Status Pembayaran</option>
                                                    <option value="0"
                                                        {{ request('status_pembayaran') == '0' ? 'selected' : '' }}>Sedang
                                                        Diproses</option>
                                                    <option value="1"
                                                        {{ request('status_pembayaran') == '1' ? 'selected' : '' }}>Sudah
                                                        Diterima</option>
                                                    <option value="2"
                                                        {{ request('status_pembayaran') == '2' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Filter Metode Pembayaran -->
                                            <div class="form-group">
                                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                                <select name="metode_pembayaran" class="form-control">
                                                    <option value="">Semua Metode Pembayaran</option>
                                                    @foreach ($metodePembayaran as $metode)
                                                        <option value="{{ $metode->metode_pembayaran }}"
                                                            {{ request('metode_pembayaran') == $metode->metode_pembayaran ? 'selected' : '' }}>
                                                            {{ $metode->metode_pembayaran }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Filter Jenjang -->
                                            <div class="form-group">
                                                <label for="jenjang">Jenjang Pendaftar</label>
                                                <select name="jenjang" class="form-control">
                                                    <option value="">Semua Jenjang</option>
                                                    @foreach ($jenjangs as $jenjang)
                                                        <option value="{{ $jenjang->id }}"
                                                            {{ request('jenjang') == $jenjang->id ? 'selected' : '' }}>
                                                            {{ $jenjang->tingkat_jenjang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Filter Jalur -->
                                            <div class="form-group">
                                                <label for="jalur">Jalur Pendaftar</label>
                                                <select name="jalur" class="form-control">
                                                    <option value="">Semua Jalur</option>
                                                    @foreach ($jalurs as $jalur)
                                                        <option value="{{ $jalur->id }}"
                                                            {{ request('jalur') == $jalur->id ? 'selected' : '' }}>
                                                            {{ $jalur->nama_jalur }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-file-excel"></i> Export Excel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <style>
                            td {
                                white-space: nowrap;
                            }
                        </style>
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama Pendaftar</th>
                                    {{-- <th>Rincian Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Nama Pengirim</th>
                                    <th>Metode Pembayaran</th> --}}
                                    <th>Status Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>{{ $transaksi->kode_transaksi }}</td>
                                        <td>{{ optional($transaksi->pendaftar)->no_pendaftaran ?? 'Tidak ada data' }}</td>
                                        <td>{{ optional($transaksi->pendaftar)->nama_lengkap ?? 'Tidak ada data' }}</td>
                                        {{-- <td>{{ optional($transaksi->biaya)->nama_biaya ?? 'Tidak ada data' }}</td>
                                        <td>{{ optional($transaksi->biaya)->nominal ?? 'Tidak ada data' }}</td>
                                        <td>{{ $transaksi->nama_pengirim }}</td>
                                        <td>{{ $transaksi->metode_pembayaran }}</td> --}}
                                        <td>
                                            @if ($transaksi->status_pembayaran == 1)
                                                <span class="badge badge-success">Sudah Diterima</span>
                                            @elseif($transaksi->status_pembayaran == 2)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Sedang Proses Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>
                                            <!-- Tombol Lihat Pembayaran -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#modalTransaksi{{ $transaksi->id }}">
                                                <i class="fas fa-info-circle"></i> Lihat Pembayaran
                                            </button>
                                            <!-- Tombol Cetak Kwitansi -->
                                            <a href="{{ route('operator.transaksi.download', $transaksi->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-file-pdf"></i> Cetak Kwitansi
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('operator.transaksi.delete', $transaksi->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $transaksi->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ $transaksi->id }}');">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            <!-- SweetAlert2 CSS -->
                                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

                                            <!-- SweetAlert2 JS -->
                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

                                            <script>
                                                function confirmDelete(id) {
                                                    Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: "Data ini akan dihapus permanen!",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Hapus',
                                                        cancelButtonText: 'Batal',
                                                        customClass: {
                                                            cancelButton: 'btn btn-secondary',
                                                            confirmButton: 'btn btn-danger'
                                                        }
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('delete-form-' + id).submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                    <!-- Modal Lihat Pembayaran -->
                                    <div class="modal fade" id="modalTransaksi{{ $transaksi->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modalTransaksiLabel{{ $transaksi->id }}"
                                        aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTransaksiLabel{{ $transaksi->id }}">
                                                        Detail Transaksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('operator.transaksi.update', $transaksi->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">
                                                            <!-- No. Pendaftaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="no_pendaftaran">No. Pendaftaran</label>
                                                                    <input type="text" id="no_pendaftaran"
                                                                        class="form-control"
                                                                        value="{{ optional($transaksi->pendaftar)->no_pendaftaran ?? 'Tidak ada data' }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <!-- Nama Pendaftar -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_pendaftar">Nama Pendaftar</label>
                                                                    <input type="text" id="nama_pendaftar"
                                                                        class="form-control"
                                                                        value="{{ optional($transaksi->pendaftar)->nama_lengkap ?? 'Tidak ada data' }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <!-- Kode Transaksi -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="kode_transaksi">Kode Transaksi</label>
                                                                    <input type="text" id="kode_transaksi"
                                                                        class="form-control"
                                                                        value="{{ $transaksi->kode_transaksi }}" readonly>
                                                                </div>
                                                            </div>

                                                            <!-- Status Pembayaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="kode_transaksi">Status Pembayaran</label>

                                                                    @if ($transaksi->status_pembayaran == 1)
                                                                        <input type="text" class="form-control"
                                                                            value="Sudah Diterima" readonly>
                                                                    @elseif($transaksi->status_pembayaran == 2)
                                                                        <input type="text" class="form-control"
                                                                            value="Ditolak" readonly>
                                                                    @else
                                                                        <input type="text" class="form-control"
                                                                            value="Sedang Proses Verifikasi" readonly>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Nama Pengirim -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_pengirim">Nama Pengirim</label>
                                                                    <input type="text" id="nama_pengirim"
                                                                        class="form-control"
                                                                        value="{{ $transaksi->nama_pengirim }}" readonly>
                                                                </div>
                                                            </div>

                                                            <!-- Metode Pembayaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="metode_pembayaran">Metode
                                                                        Pembayaran</label>
                                                                    <input type="text" id="metode_pembayaran"
                                                                        class="form-control"
                                                                        value="{{ $transaksi->metode_pembayaran }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_biaya">Rincian Pembayaran</label>
                                                                    <input type="text" id="nama_biaya"
                                                                        class="form-control"
                                                                        value="{{ $transaksi->biaya->nama_biaya }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nominal">Nominal Pembayaran</label>
                                                                    <input type="text" id="nominal"
                                                                        class="form-control"
                                                                        value="Rp{{ number_format($transaksi->biaya->nominal, 0, ',', '.') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            <!-- Tanggal Pembayaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="tanggal_pembayaran">Tanggal
                                                                        Pembayaran</label>
                                                                    <input type="text" id="tanggal_pembayaran"
                                                                        class="form-control"
                                                                        value="{{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->translatedFormat('d F Y') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>

                                                            {{-- <!-- Bukti Pembayaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                                                    @if ($transaksi->bukti_pembayaran)
                                                                        <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                                                            alt="Bukti Pembayaran" class="img-fluid">
                                                                    @else
                                                                        <input type="text" class="form-control"
                                                                            value="Tidak ada bukti pembayaran" readonly>
                                                                    @endif
                                                                </div>
                                                            </div> --}}

                                                            <style>
                                                                /* Style untuk efek zoom */
                                                                .zoom {
                                                                    transition: transform .2s;
                                                                    /* Animasi transisi zoom */
                                                                    cursor: pointer;
                                                                }

                                                                .zoom:hover {
                                                                    transform: scale(1.05);
                                                                    /* Zoom saat hover */
                                                                }

                                                                .modal-fullscreen {
                                                                    display: none;
                                                                    /* Mulai dari modal tertutup */
                                                                    position: fixed;
                                                                    z-index: 1050;
                                                                    padding: 10px;
                                                                    top: 0;
                                                                    left: 0;
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    overflow: hidden;
                                                                    background-color: rgba(0, 0, 0, 0.9);
                                                                    /* Background modal zoom */
                                                                }

                                                                .modal-fullscreen img {
                                                                    max-width: 100%;
                                                                    max-height: 100%;
                                                                    margin: auto;
                                                                    display: block;
                                                                    transition: transform .3s;
                                                                }

                                                                .close-modal {
                                                                    position: absolute;
                                                                    top: 15px;
                                                                    right: 35px;
                                                                    color: white;
                                                                    font-size: 40px;
                                                                    font-weight: bold;
                                                                    cursor: pointer;
                                                                }
                                                            </style>

                                                            <!-- Bukti Pembayaran -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                                                    @if ($transaksi->bukti_pembayaran)
                                                                        <!-- Gambar akan memunculkan modal saat diklik -->
                                                                        <p>Silahkan klik gambar untuk memperbesar.</p>
                                                                        <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                                                            alt="Bukti Pembayaran" class="img-fluid zoom"
                                                                            data-toggle="modal"
                                                                            data-target="#imageModal{{ $transaksi->id }}"
                                                                            onclick="openInNewTab(this)">
                                                                    @else
                                                                        <input type="text" class="form-control"
                                                                            value="Tidak ada bukti pembayaran" readonly>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Modal Fullscreen untuk Zoom Gambar -->
                                                            <div id="imageModal" class="modal-fullscreen">
                                                                <span class="close-modal"
                                                                    onclick="closeModal()">&times;</span>
                                                                <img id="modalImage" src="">
                                                            </div>

                                                            <script>
                                                                // Fungsi untuk membuka modal dan memperbesar gambar
                                                                function openModal(imgElement) {
                                                                    var modal = document.getElementById("imageModal");
                                                                    var modalImg = document.getElementById("modalImage");
                                                                    modal.style.display = "block";
                                                                    modalImg.src = imgElement.src;
                                                                }

                                                                // Fungsi untuk menutup modal zoom
                                                                function closeModal() {
                                                                    var modal = document.getElementById("imageModal");
                                                                    modal.style.display = "none";
                                                                }

                                                                // Fungsi untuk membuka gambar di tab baru
                                                                function openInNewTab(imgElement) {
                                                                    var imgSrc = imgElement.src;
                                                                    window.open(imgSrc, '_blank');
                                                                }
                                                            </script>
                                                        </div>

                                                        <!-- Select Status Pembayaran -->
                                                        <div class="form-group">
                                                            <label for="status_pembayaran">Pilih Status Pembayaran:</label>
                                                            <select name="status_pembayaran" id="status_pembayaran"
                                                                class="form-control">
                                                                <option value="0"
                                                                    {{ $transaksi->status_pembayaran == 0 ? 'selected' : '' }}>
                                                                    Sedang Proses Verifikasi</option>
                                                                <option value="1"
                                                                    {{ $transaksi->status_pembayaran == 1 ? 'selected' : '' }}>
                                                                    Sudah Diterima</option>
                                                                <option value="2"
                                                                    {{ $transaksi->status_pembayaran == 2 ? 'selected' : '' }}>
                                                                    Ditolak</option>
                                                            </select>
                                                        </div>

                                                        <!-- Alert Pesan Verifikasi -->
                                                        <div class="alert alert-success" role="alert">
                                                            Fitur ini digunakan untuk melakukan verifikasi pembayaran
                                                            pendaftar. Harap pastikan data yang benar sebelum melakukan
                                                            verifikasi.
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Verifikasi
                                                                Pembayaran</button>
                                                            <!-- Tombol Download Bukti Pembayaran -->
                                                            @if ($transaksi->bukti_pembayaran)
                                                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                                                    class="btn btn-primary" download>
                                                                    <i class="fas fa-download"></i> Download Bukti
                                                                    Pembayaran
                                                                </a>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- Link Paginasi -->
                        <div class="d-flex justify-content-center">
                            {{ $transaksis->appends(request()->input())->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Statistik Pembayaran Pendaftar</div>
                        <div class="row py-3">
                            <div class="col-md-4 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8">Total Pembayaran Diterima</h6>
                                    <h3 class="fw-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                                </div>
                                {{-- <div>
                                    <h6 class="fw-bold text-uppercase text-danger op-8">Total Belum Membayar</h6>
                                    <h3 class="fw-bold">Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}</h3>
                                </div> --}}
                            </div>
                            <div class="col-md-8">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: @json($labels), // Labels untuk 6 bulan terakhir
                datasets: [{
                    label: "Total Pembayaran",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: @json($totalPerBulan), // Data total pembayaran per bulan
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: true,
                            beginAtZero: true // Mulai dari angka 0
                        },
                        gridLines: {
                            drawBorder: false,
                            display: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }]
                },
            }
        });
    </script>


@endsection
