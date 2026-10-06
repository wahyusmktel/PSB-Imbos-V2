@extends('layouts.app_operator')

@section('title', 'Dashboard Operator')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Assalamualaikum</h2>
                    <h5 class="text-white op-7 mb-2">Selamat datang di halaman dashboard Operator</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <!-- Form Pencarian -->
                    <form action="{{ route('operator.pendaftar.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan No. Pendaftaran, Nama Lengkap, NISN, atau Asal Sekolah"
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
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Form Filter -->
                            <form action="{{ route('operator.pendaftar.index') }}" method="GET" class="form-inline w-100">
                                <div class="d-flex flex-wrap align-items-center">
                                    <!-- Filter Jenjang -->
                                    <div class="form-group mr-3 mb-2">
                                        <label for="jenjang" class="mr-2">Jenjang</label>
                                        <select name="filter_jenjang" id="jenjang" class="form-control">
                                            <option value="">Pilih Jenjang</option>
                                            @foreach ($jenjangs as $jenjang)
                                                <option value="{{ $jenjang->id }}"
                                                    {{ request('filter_jenjang') == $jenjang->id ? 'selected' : '' }}>
                                                    {{ $jenjang->tingkat_jenjang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Jalur -->
                                    <div class="form-group mr-3 mb-2">
                                        <label for="jalur" class="mr-2">Jalur</label>
                                        <select name="filter_jalur" id="jalur" class="form-control">
                                            <option value="">Pilih Jalur</option>
                                            @foreach ($jalurs as $jalur)
                                                <option value="{{ $jalur->id }}"
                                                    {{ request('filter_jalur') == $jalur->id ? 'selected' : '' }}>
                                                    {{ $jalur->nama_jalur }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status Pembayaran -->
                                    <div class="form-group mr-3 mb-2">
                                        <label for="status_pembayaran" class="mr-2">Status Pembayaran</label>
                                        <select name="filter_status_pembayaran" id="status_pembayaran" class="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="0"
                                                {{ request('filter_status_pembayaran') == '0' ? 'selected' : '' }}>Sedang
                                                Proses Verifikasi</option>
                                            <option value="1"
                                                {{ request('filter_status_pembayaran') == '1' ? 'selected' : '' }}>Sudah
                                                Diterima</option>
                                            <option value="null"
                                                {{ request('filter_status_pembayaran') == 'null' ? 'selected' : '' }}>Belum
                                                Membayar</option>
                                        </select>
                                    </div>

                                    <!-- Tombol Filter dan Reset -->
                                    <div class="form-group mb-2">
                                        <div class="btn-group" role="group" aria-label="Filter and Reset">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <a href="{{ route('operator.pendaftar.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-redo"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <button type="button" class="btn btn-info" id="setKelulusanBtn" data-toggle="modal"
                                data-target="#kelulusanModal" disabled>
                                <i class="fas fa-check"></i> Set Kelulusan
                            </button>
                            <div class="modal fade" id="kelulusanModal" tabindex="-1" role="dialog"
                                aria-labelledby="kelulusanModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="kelulusanModalLabel">Set Status Kelulusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('operator.hasil-seleksi.store') }}" method="POST"
                                            id="kelulusanForm">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="selected_pendaftar_ids"
                                                    id="selectedPendaftarIds">
                                                <div class="form-group">
                                                    <label for="hasil_kelulusan">Status Kelulusan</label>
                                                    <select name="hasil_kelulusan" id="hasil_kelulusan" class="form-control"
                                                        required>
                                                        <option value="1">Lulus</option>
                                                        <option value="2">Tidak Lulus</option>
                                                        <option value="3">Cadangan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol untuk memunculkan modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#exportModal">
                                <i class="fas fa-file-export"></i> Export Data
                            </button>
                            <!-- Modal untuk Export Data -->
                            <div class="modal fade" id="exportModal" tabindex="-1" role="dialog"
                                aria-labelledby="exportModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel"><i
                                                    class="fas fa-file-export"></i>
                                                Export Data
                                                Pendaftar</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Export Data -->
                                            <form action="{{ route('operator.pendaftar.export') }}" method="GET">
                                                <div class="form-group">
                                                    <label for="jenjang">Pilih Jenjang</label>
                                                    <select name="jenjang" id="jenjang" class="form-control">
                                                        <option value="">Semua Jenjang</option>
                                                        @foreach ($jenjangs as $jenjang)
                                                            <option value="{{ $jenjang->id }}">
                                                                {{ $jenjang->tingkat_jenjang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="jalur">Pilih Jalur</label>
                                                    <select name="jalur" id="jalur" class="form-control">
                                                        <option value="">Semua Jalur</option>
                                                        @foreach ($jalurs as $jalur)
                                                            <option value="{{ $jalur->id }}">
                                                                {{ $jalur->nama_jalur }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status_pembayaran">Status
                                                        Pembayaran</label>
                                                    <select name="status_pembayaran" id="status_pembayaran"
                                                        class="form-control">
                                                        <option value="">Semua Status</option>
                                                        <option value="0">Sedang Proses Verifikasi
                                                        </option>
                                                        <option value="1">Sudah Diterima</option>
                                                        <option value="null">Belum Membayar</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gelombang">Pilih Gelombang</label>
                                                    <select name="gelombang" id="gelombang" class="form-control">
                                                        <option value="">Semua Gelombang</option>
                                                        <option value="1">Gelombang 1</option>
                                                        <option value="2">Gelombang 2</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-file-export"></i> Download
                                                        Rekap</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-sub">
                            Halaman ini menampilkan seluruh data pendaftar yang masuk, anda dapat mengelola data melalui
                            kolom aksi dan melakukan filter data untuk menampilkan data berdasarkan kondisi yang diinginkan
                            melalui fitur filter diatas.
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sukses!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <style>
                            td {
                                white-space: nowrap;
                            }
                        </style>
                        <table class="table table-striped table-responsive  ">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>No</th>
                                    <th>Status Kelulusan</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Gelombang</th>
                                    <th>Jenjang</th>
                                    <th>Jalur</th>
                                    <th>Nama Lengkap</th>
                                    <th>NISN</th>
                                    <th>Asal Sekolah</th>
                                    <th>No HP</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($akunPendaftars->count() > 0)
                                    @foreach ($akunPendaftars as $akunPendaftar)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selected_pendaftar[]"
                                                    value="{{ $akunPendaftar->id }}" class="pendaftarCheckbox">
                                            </td>
                                            <td>{{ ($akunPendaftars->currentPage() - 1) * $akunPendaftars->perPage() + $loop->index + 1 }}
                                            </td>
                                            <td>
                                                @php
                                                    $status_kelulusan = $akunPendaftar->hasilSeleksi->hasil_kelulusan ?? null;
                                                @endphp
                                            
                                                @if ($status_kelulusan == 1)
                                                    <span class="badge badge-success">LULUS</span>
                                                @elseif ($status_kelulusan == 2)
                                                    <span class="badge badge-danger">TIDAK LULUS</span>
                                                @elseif ($status_kelulusan == 3)
                                                    <span class="badge badge-warning">CADANGAN</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum Ditentukan</span>
                                                @endif
                                            </td>
                                            <td>{{ $akunPendaftar->no_pendaftaran }}</td>
                                            <!-- <td>{{ $akunPendaftar->gelombang }}</td> -->
                                            <td>{{ ($akunPendaftar->gelombang ?? 1) == 2 ? 'Gelombang 2' : 'Gelombang 1' }}</td>
                                            <td>{{ optional(optional($akunPendaftar->pendaftarJenjang)->jenjang)->tingkat_jenjang ?? 'Tidak ada data' }}
                                            </td>
                                            <td>{{ optional(optional($akunPendaftar->pendaftarJalur)->jalur)->nama_jalur ?? 'Tidak ada data' }}
                                            </td>
                                            <td>{{ $akunPendaftar->nama_lengkap }}</td>
                                            <td>{{ $akunPendaftar->nisn }}</td>
                                            <td>{{ $akunPendaftar->asal_sekolah }}</td>
                                            <td>
                                                <a href="https://wa.me/{{ str_replace('08', '62', $akunPendaftar->no_hp) }}"
                                                    target="_blank">
                                                    <i class="fab fa-whatsapp"></i> <!-- FontAwesome WhatsApp Icon -->
                                                    {{ $akunPendaftar->no_hp }}
                                                </a>
                                            </td>
                                            <td>
                                                @if (optional($akunPendaftar->transaksi)->status_pembayaran === null)
                                                    <span class="badge badge-danger">Belum Membayar</span>
                                                @elseif(optional($akunPendaftar->transaksi)->status_pembayaran === '0')
                                                    <span class="badge badge-warning">Sedang Proses Verifikasi</span>
                                                @elseif(optional($akunPendaftar->transaksi)->status_pembayaran === '1')
                                                    <span class="badge badge-success">Sudah Diterima</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('operator.pendaftar.edit', $akunPendaftar->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <form
                                                    action="{{ route('operator.pendaftar.destroy', $akunPendaftar->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="delete-form-{{ $akunPendaftar->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete('{{ $akunPendaftar->id }}');">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                <link rel="stylesheet"
                                                    href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                                                            dangerMode: true,
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('delete-form-' + id).submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- Link Paginasi -->
                        <div class="d-flex justify-content-center">
                            {{ $akunPendaftars->appends(request()->input())->links('vendor.pagination.custom') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".pendaftarCheckbox");
            const selectAllCheckbox = document.getElementById("selectAll");
            const setKelulusanBtn = document.getElementById("setKelulusanBtn");
            const selectedPendaftarIdsInput = document.getElementById("selectedPendaftarIds");

            function updateButtonState() {
                const checked = document.querySelectorAll(".pendaftarCheckbox:checked");
                setKelulusanBtn.disabled = checked.length === 0;
            }

            selectAllCheckbox.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateButtonState();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    updateButtonState();
                });
            });

            setKelulusanBtn.addEventListener("click", function() {
                const selectedIds = Array.from(document.querySelectorAll(".pendaftarCheckbox:checked"))
                    .map(checkbox => checkbox.value);
                selectedPendaftarIdsInput.value = selectedIds.join(",");
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Simpan posisi scroll sebelum halaman di-refresh
            if (localStorage.getItem("scrollPos")) {
                window.scrollTo(0, localStorage.getItem("scrollPos"));
            }

            // Simpan posisi scroll sebelum pindah halaman
            window.addEventListener("beforeunload", function() {
                localStorage.setItem("scrollPos", window.scrollY);
            });
        });
    </script>

@endsection
