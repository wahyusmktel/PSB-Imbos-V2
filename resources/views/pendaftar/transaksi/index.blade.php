@extends('layouts.app')

@section('title', 'Transaksi Pembayaran')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Transaksi Pembayaran</h2>
                    <h5 class="text-white op-7 mb-2">Silahkan lakukan pembayaran sesuai dengan data yang ada dibawah ini.
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    Tabel Informasi Pembayaran
                </div>
                <div>
                    <!-- Tombol untuk membuka modal Tambah Pembayaran -->
                    {{-- <button type="button" class="btn btn-primary" >
                    Tambah Pembayaran
                </button> --}}
                </div>
            </div>
            <!-- Modal untuk Tambah Pembayaran -->
            <div class="modal fade" id="tambahPembayaranModal" tabindex="-1" role="dialog"
                aria-labelledby="tambahPembayaranModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahPembayaranModalLabel">Tambah Transaksi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form Tambah Transaksi -->
                            <form method="POST" action="{{ route('pendaftar.transaksi.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="biaya_id">Biaya</label>
                                    <select name="biaya_id" class="form-control">
                                        @foreach ($biayas as $biaya)
                                            <option value="{{ $biaya->id }}">{{ $biaya->nama_biaya }} -
                                                Rp{{ number_format($biaya->nominal, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pengirim">Nama Pengirim</label>
                                    <input type="text" name="nama_pengirim" class="form-control" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="metode_pembayaran">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                        <option value="">--Pilih Salah Satu--</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="tunai">Tunai</option>
                                    </select>
                                </div>

                                <div class="form-group" id="bukti_pembayaran_group" style="display: none;">
                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" class="form-control">
                                </div>
                                <script>
                                    document.getElementById('metode_pembayaran').addEventListener('change', function() {
                                        var metode = this.value;
                                        var buktiPembayaranGroup = document.getElementById('bukti_pembayaran_group');

                                        if (metode === 'transfer') {
                                            buktiPembayaranGroup.style.display = 'block';
                                        } else {
                                            buktiPembayaranGroup.style.display = 'none';
                                        }
                                    });
                                </script> --}}
                                <div class="form-group">
                                    <label for="metode_pembayaran">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                        <option value="">--Pilih Salah Satu--</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="tunai">Tunai</option>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="bukti_pembayaran_group" style="display: none;">
                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
                                </div>
                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var metodePembayaranSelect = document.getElementById('metode_pembayaran');
                                        var buktiPembayaranGroup = document.getElementById('bukti_pembayaran_group');
                                        var buktiPembayaranInput = document.getElementById('bukti_pembayaran');
                                
                                        metodePembayaranSelect.addEventListener('change', function() {
                                            var metode = this.value;
                                
                                            if (metode === 'transfer') {
                                                buktiPembayaranGroup.style.display = 'block';
                                                buktiPembayaranInput.setAttribute('required', 'required'); // Set required
                                            } else {
                                                buktiPembayaranGroup.style.display = 'none';
                                                buktiPembayaranInput.removeAttribute('required'); // Remove required
                                            }
                                        });
                                    });
                                </script>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="alert alert-info">
                            Pembayaran yang harus dibayarkan terlebih dahulu adalah Biaya Pendaftaran sebesar
                            Rp{{ number_format($biaya->nominal, 0, ',', '.') }}
                            Silahkan lakukan transfer ke rekening berikut ini :
                        </div>


                        <div class="col-md-12 pl-md-0 pr-md-0">
                            <div class="card card-pricing card-pricing-focus card-secondary">

                                <div class="card-body">
                                    <ul class="specification-list">
                                        <li>
                                            <span class="name-specification">Biaya Pendaftaran</span>

                                            <span
                                                class="status-specification">Rp{{ number_format($biaya->nominal, 0, ',', '.') }}</span>

                                        </li>
                                        <li>
                                            <span class="name-specification">Nama Bank Penerima</span>
                                            <span class="status-specification">{{ $ppdbConfig->nama_bank_penerima }}</span>
                                        </li>
                                        <li>
                                            <span class="name-specification">Nomor Rekening Penerima</span>
                                            <span
                                                class="status-specification">{{ $ppdbConfig->nomor_rekening_penerima }}</span>
                                        </li>
                                        <li>
                                            <span class="name-specification">Atas Nama</span>
                                            <span class="status-specification">{{ $ppdbConfig->atas_nama }}</span>
                                        </li>
                                    </ul>
                                    <div class="card-sub" style="background-color: rgba(255, 255, 255, 0.278);">
                                        <span style="color: #fff;">Setelah melakukan pembayaran silahkan lakukan
                                            <b>Konfirmasi Pembayaran</b> dengan
                                            cara klik tombol dibawah ini.</span>
                                    </div>
                                </div>
                                {{-- <div class="card-footer">
                                    <button data-toggle="modal" data-target="#tambahPembayaranModal"
                                        class="btn btn-light btn-block"><b><i class="fas fa-plus"></i> Tambah
                                            Pembayaran</b></button>
                                </div> --}}
                                <div class="card-footer">
                                    @if ($transaksi->count() > 0)
                                        <button type="button" class="btn btn-light btn-block" onclick="showAlert()">
                                            <b><i class="fas fa-plus"></i> Tambah Pembayaran</b>
                                        </button>
                                    @else
                                        <button data-toggle="modal" data-target="#tambahPembayaranModal" class="btn btn-light btn-block">
                                            <b><i class="fas fa-plus"></i> Tambah Pembayaran</b>
                                        </button>
                                    @endif
                                </div>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                <script>
                                    function showAlert() {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Informasi',
                                            text: "Anda sudah melakukan transaksi pembayaran, silahkan lihat pada tabel transaksi dibawah. Jika pembayaran ditolak silahkan hapus data terlebih dahulu sebelum menambahkan transaksi baru."
                                        });
                                    }
                                </script>
                            </div>
                        </div>


                        <!-- Tabel Transaksi yang sudah ada -->
                        <table class="table table-bordered table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Pengirim</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $t)
                                    <tr>
                                        <td>{{ $t->kode_transaksi }}</td>
                                        <td>{{ $t->nama_pengirim }}</td>
                                        <td>{{ $t->metode_pembayaran }}</td>
                                        <td>
                                            @if ($t->status_pembayaran == 1)
                                                <span class="badge badge-success">Pembayaran Diterima</span>
                                            @elseif ($t->status_pembayaran == 2)
                                                <span class="badge badge-danger">Pembayaran Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Sedang Diproses</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($t->metode_pembayaran === 'tunai')
                                                <span class="text-muted">Pembayaran Tunai</span>
                                            @elseif ($t->bukti_pembayaran)
                                                <a href="{{ asset('storage/' . $t->bukti_pembayaran) }}"
                                                    target="_blank">Lihat Bukti</a>
                                            @else
                                                <span class="text-muted">Belum ada bukti</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$t->status_pembayaran)
                                                <!-- Tombol untuk membuka modal edit -->
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editModal{{ $t->id }}"><i class="fas fa-edit"></i>
                                                    Edit</button>
                                                <!-- Tombol untuk menghapus transaksi -->
                                                <form action="{{ route('operator.pendaftar.transaksi.destroy', $t->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-button">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                <script>
                                                    document.querySelectorAll('.delete-button').forEach(button => {
                                                        button.addEventListener('click', function () {
                                                            const form = button.closest('.delete-form'); // Mendapatkan form yang terkait dengan tombol ini
                                                            
                                                            Swal.fire({
                                                                title: 'Konfirmasi Hapus?',
                                                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonText: 'Ya, Hapus!',
                                                                cancelButtonText: 'Batal',
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    form.submit(); // Jika pengguna mengkonfirmasi, kirimkan form
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                            @endif
                                            @if ($t->status_pembayaran == 1)
                                                <a href="{{ route('pendaftar.transaksi.download', $t->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-download"></i> Download Kwitansi
                                                </a>
                                            @elseif ($t->status_pembayaran == 2)
                                                {{-- <span class="text-danger">Tidak ada data</span> --}}
                                                <!-- Tombol untuk menghapus transaksi -->
                                                <form action="{{ route('operator.pendaftar.transaksi.destroy', $t->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-button">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                <script>
                                                    document.querySelectorAll('.delete-button').forEach(button => {
                                                        button.addEventListener('click', function () {
                                                            const form = button.closest('.delete-form'); // Mendapatkan form yang terkait dengan tombol ini
                                                            
                                                            Swal.fire({
                                                                title: 'Konfirmasi Hapus?',
                                                                text: 'Apakah Anda yakin ingin menghapus data ini?',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonText: 'Ya, Hapus!',
                                                                cancelButtonText: 'Batal',
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    form.submit(); // Jika pengguna mengkonfirmasi, kirimkan form
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                            @else
                                                <span class="text-warning"></span>
                                            @endif

                                        </td>
                                    </tr>
                                    <!-- Modal untuk mengedit transaksi -->
                                    <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel{{ $t->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $t->id }}">Edit
                                                        Transaksi {{ $t->kode_transaksi }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('pendaftar.transaksi.update', $t->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="biaya_id">Biaya</label>
                                                            <select name="biaya_id" class="form-control">
                                                                @foreach ($biayas as $biaya)
                                                                    <option value="{{ $biaya->id }}"
                                                                        {{ $t->biaya_id == $biaya->id ? 'selected' : '' }}>
                                                                        {{ $biaya->nama_biaya }} -
                                                                        Rp{{ number_format($biaya->nominal, 0, ',', '.') }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_pengirim">Nama Pengirim</label>
                                                            <input type="text" name="nama_pengirim"
                                                                class="form-control" value="{{ $t->nama_pengirim }}">
                                                            @if ($errors->has('nama_pengirim'))
                                                                <div class="text-danger">
                                                                    {{ $errors->first('nama_pengirim') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="metode_pembayaran">Metode Pembayaran</label>
                                                            <select name="metode_pembayaran" class="form-control"
                                                                id="metode_pembayaran_{{ $t->id }}">
                                                                <option value="transfer"
                                                                    {{ $t->metode_pembayaran == 'transfer' ? 'selected' : '' }}>
                                                                    Transfer</option>
                                                                <option value="tunai"
                                                                    {{ $t->metode_pembayaran == 'tunai' ? 'selected' : '' }}>
                                                                    Tunai</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group" id="bukti_pembayaran_{{ $t->id }}"
                                                            style="display: none;">
                                                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                                            <input type="file" name="bukti_pembayaran"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fas fa-save"></i> Simpan
                                                            Perubahan</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var metodePembayaranSelect = document.getElementById('metode_pembayaran_{{ $t->id }}');
                                            var buktiPembayaranForm = document.getElementById('bukti_pembayaran_{{ $t->id }}');

                                            // Function to toggle visibility of the bukti pembayaran field
                                            function toggleBuktiPembayaran() {
                                                if (metodePembayaranSelect.value === 'transfer') {
                                                    buktiPembayaranForm.style.display = 'block';
                                                } else {
                                                    buktiPembayaranForm.style.display = 'none';
                                                }
                                            }

                                            // Initially check on page load
                                            toggleBuktiPembayaran();

                                            // Add event listener for change
                                            metodePembayaranSelect.addEventListener('change', toggleBuktiPembayaran);
                                        });
                                    </script> --}}
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var metodePembayaranSelect = document.getElementById('metode_pembayaran_{{ $t->id }}');
                                            var buktiPembayaranForm = document.getElementById('bukti_pembayaran_{{ $t->id }}');
                                            var buktiPembayaranInput = buktiPembayaranForm.querySelector('input[name="bukti_pembayaran"]');
                                    
                                            // Function to toggle visibility and required attribute of bukti pembayaran field
                                            function toggleBuktiPembayaran() {
                                                if (metodePembayaranSelect.value === 'transfer') {
                                                    buktiPembayaranForm.style.display = 'block';
                                                    buktiPembayaranInput.setAttribute('required', 'required'); // Set required
                                                } else {
                                                    buktiPembayaranForm.style.display = 'none';
                                                    buktiPembayaranInput.removeAttribute('required'); // Remove required
                                                }
                                            }
                                    
                                            // Initially check on page load
                                            toggleBuktiPembayaran();
                                    
                                            // Add event listener for change
                                            metodePembayaranSelect.addEventListener('change', toggleBuktiPembayaran);
                                        });
                                    </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
