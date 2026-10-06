@extends('layouts.app_operator')

@section('title', 'Manajemen Database & Backup SQL')

@section('content')
<div class="panel-header" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <div class="d-flex align-items-center mb-1">
                    <span class="badge badge-warning font-weight-bold px-3 py-1 mr-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i class="fas fa-shield-alt mr-1"></i> SUPER ADMIN ONLY
                    </span>
                    <h2 class="text-white pb-0 mb-0 fw-bold">Manajemen Database &amp; Cadangan SQL</h2>
                </div>
                <h5 class="text-white op-7 mb-0">Kelola cadangan (backup), pemulihan (restore), serta pengosongan data transaksional sistem PSB IMBoS</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0 d-flex gap-2">
                <form action="{{ route('superadmin.database.backup') }}" method="POST" class="d-inline" id="formQuickBackup">
                    @csrf
                    <button type="submit" class="btn btn-white btn-round font-weight-bold shadow-sm" id="btnQuickBackup">
                        <i class="fas fa-cloud-download-alt text-primary mr-1"></i> Buat Backup SQL Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <!-- Ringkasan Database & Data -->
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Database</p>
                                <h4 class="card-title text-truncate" title="{{ $dbName }}">{{ $dbName }}</h4>
                                <small class="text-muted">{{ $totalTables }} Tabel</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-server"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Ukuran Database</p>
                                <h4 class="card-title">{{ $dbSize }}</h4>
                                <small class="text-muted">Data &amp; Indeks MySQL</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Data Pendaftar</p>
                                <h4 class="card-title">{{ number_format($totalPendaftar) }}</h4>
                                <small class="text-muted">{{ number_format($totalBerkas) }} Berkas Upload</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Data Transaksi</p>
                                <h4 class="card-title">{{ number_format($totalTransaksi) }}</h4>
                                <small class="text-muted">Transaksi Pembayaran</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tiga Card Aksi Utama: Backup, Restore, Kosongkan Data -->
    <div class="row">
        <!-- 1. CARD BACKUP -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px; border-top: 4px solid #3b82f6;">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 text-primary"><i class="fas fa-download fa-2x"></i></div>
                        <div>
                            <h4 class="card-title font-weight-bold mb-0">1. Backup Database</h4>
                            <small class="text-muted">Ekspor data ke format file .SQL</small>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="text-muted small" style="line-height: 1.6;">
                        Mencadangkan seluruh skema tabel (DDL) dan isi data (DML) ke file MySQL standar (.sql). File cadangan dapat diunduh langsung atau disimpan di server untuk pemulihan sewaktu-waktu.
                    </p>
                    <div class="alert alert-light border small text-secondary py-2 mb-3">
                        <i class="fas fa-info-circle text-primary mr-1"></i> Mendukung seluruh tabel (Akun, Pendaftar, Pengaturan, CMS Landing Page).
                    </div>
                    <div>
                        <form action="{{ route('superadmin.database.backup') }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Simpan Backup ke Server
                            </button>
                        </form>
                        <a href="{{ route('superadmin.database.backup') }}?download=1" class="btn btn-outline-primary btn-block btn-sm">
                            <i class="fas fa-file-download mr-1"></i> Unduh Langsung ke Komputer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. CARD RESTORE -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px; border-top: 4px solid #f59e0b;">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 text-warning"><i class="fas fa-upload fa-2x"></i></div>
                        <div>
                            <h4 class="card-title font-weight-bold mb-0">2. Restore Database</h4>
                            <small class="text-muted">Pulihkan data dari berkas .SQL</small>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="text-muted small" style="line-height: 1.6;">
                        Unggah berkas cadangan database (format <code>.sql</code>) dari komputer Anda untuk memulihkan seluruh struktur dan rekaman data ke kondisi sebelumnya.
                    </p>
                    <form action="{{ route('superadmin.database.restore') }}" method="POST" enctype="multipart/form-data" id="formRestoreUpload">
                        @csrf
                        <div class="form-group px-0 pt-0 mb-3">
                            <label class="font-weight-bold small">Pilih File SQL dari Komputer:</label>
                            <input type="file" name="sql_file" id="inputSqlRestore" class="form-control-file border p-2 rounded w-100 bg-light" accept=".sql" required>
                            <small class="form-text text-muted">Format didukung: .sql (Maks. 50 MB)</small>
                        </div>
                        <button type="button" class="btn btn-warning btn-block font-weight-bold text-dark" onclick="confirmRestoreUpload()">
                            <i class="fas fa-history mr-1"></i> Pulihkan dari File Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. CARD KOSONGKAN DATA (DANGER ZONE) -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px; border-top: 4px solid #ef4444;">
                <div class="card-header bg-white">
                    <div class="d-flex align-items-center">
                        <div class="mr-3 text-danger"><i class="fas fa-trash-alt fa-2x"></i></div>
                        <div>
                            <h4 class="card-title font-weight-bold mb-0 text-danger">3. Kosongkan Data</h4>
                            <small class="text-muted">Reset data pendaftar &amp; transaksi</small>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <p class="text-muted small" style="line-height: 1.6;">
                            Digunakan untuk persiapan <strong>Tahun Ajaran Baru</strong>. Menghapus data akun santri, formulir biodata, berkas unggahan, dan bukti transfer.
                        </p>
                        <div class="alert alert-danger py-2 px-3 small mb-3" style="border-radius: 8px;">
                            <strong><i class="fas fa-shield-alt mr-1"></i> Proteksi Otomatis:</strong><br>
                            Sistem akan <em>secara otomatis membuat cadangan SQL</em> terlebih dahulu sebelum pengosongan dilakukan.
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-block font-weight-bold" data-toggle="modal" data-target="#modalTruncateData">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Kosongkan Data Pendaftar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Berkas Backup di Server -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title font-weight-bold mb-0">
                            <i class="fas fa-folder-open text-primary mr-2"></i>Daftar File Cadangan di Server
                        </h4>
                        <small class="text-muted">Daftar arsip database .sql yang tersimpan di direktori storage server</small>
                    </div>
                    <span class="badge badge-info px-3 py-2 font-weight-bold">{{ count($backups) }} File Cadangan</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50px;" class="text-center">#</th>
                                    <th>Nama Berkas (.SQL)</th>
                                    <th>Ukuran Berkas</th>
                                    <th>Waktu Dibuat</th>
                                    <th style="width: 280px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($backups as $index => $backup)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-code fa-2x text-primary mr-3"></i>
                                            <div>
                                                <div class="font-weight-bold text-dark">{{ $backup['filename'] }}</div>
                                                <small class="text-muted">Tipe: MySQL SQL Dump File</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border px-2 py-1 font-weight-bold text-dark">
                                            {{ $backup['size'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div><i class="far fa-clock mr-1 text-muted"></i>{{ $backup['created_at'] }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <!-- Download -->
                                            <a href="{{ route('superadmin.database.download', $backup['filename']) }}" class="btn btn-sm btn-info" title="Unduh File SQL">
                                                <i class="fas fa-download mr-1"></i> Unduh
                                            </a>

                                            <!-- Restore dari server -->
                                            <form action="{{ route('superadmin.database.restore') }}" method="POST" class="d-inline" onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin memulihkan database dari file {{ $backup['filename'] }}? Seluruh data saat ini akan ditimpa dengan data cadangan ini.');">
                                                @csrf
                                                <input type="hidden" name="filename" value="{{ $backup['filename'] }}">
                                                <button type="submit" class="btn btn-sm btn-warning text-dark font-weight-bold mx-1" title="Restore Database dari File Ini">
                                                    <i class="fas fa-history mr-1"></i> Restore
                                                </button>
                                            </form>

                                            <!-- Hapus Backup -->
                                            <form action="{{ route('superadmin.database.destroy', $backup['filename']) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus file cadangan {{ $backup['filename'] }} dari server? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus File Cadangan">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                        <h5>Belum ada file cadangan database di server</h5>
                                        <p class="small">Klik tombol <strong>"Buat Backup SQL Sekarang"</strong> di atas untuk membuat cadangan database pertama Anda.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Kosongkan Data -->
<div class="modal fade" id="modalTruncateData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger" style="border-radius: 14px; overflow: hidden; border-width: 2px;">
            <div class="modal-header bg-danger text-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x mr-3 text-white"></i>
                    <div>
                        <h5 class="modal-title font-weight-bold text-white mb-0">Konfirmasi Kosongkan Data</h5>
                        <small class="text-white op-8">Tindakan ini memerlukan perhatian khusus</small>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('superadmin.database.truncate') }}" method="POST" id="formTruncateData">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-warning border small text-dark mb-3">
                        <strong><i class="fas fa-info-circle mr-1"></i> Apa yang akan terjadi:</strong>
                        <ul class="mb-0 pl-3 mt-1">
                            <li>Seluruh akun santri &amp; pendaftar baru akan dihapus.</li>
                            <li>Semua formulir biodata, berkas dokumen, dan riwayat transaksi pendaftar akan dikosongkan.</li>
                            <li><strong>Akun Super Admin &amp; Operator, Pengaturan PSB, CMS Landing Page, dan Data Wilayah TETAP AMAN.</strong></li>
                            <li>Sistem akan <strong>otomatis membuat file cadangan SQL</strong> sebelum proses pengosongan.</li>
                        </ul>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold text-dark">
                            Ketik kata <span class="text-danger font-weight-bold">KOSONGKAN DATA</span> di bawah untuk menyetujui:
                        </label>
                        <input type="text" class="form-control border-danger font-weight-bold text-center" name="confirm_text" id="confirmText" placeholder="KOSONGKAN DATA" autocomplete="off" required>
                        <small class="text-muted">Gunakan huruf kapital sesuai petunjuk di atas.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger font-weight-bold" id="btnSubmitTruncate" disabled>
                        <i class="fas fa-trash-alt mr-1"></i> Ya, Kosongkan Data Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var confirmInput = document.getElementById('confirmText');
        var submitBtn = document.getElementById('btnSubmitTruncate');

        if (confirmInput && submitBtn) {
            confirmInput.addEventListener('input', function () {
                if (this.value.trim() === 'KOSONGKAN DATA') {
                    submitBtn.removeAttribute('disabled');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                }
            });
        }
    });

    function confirmRestoreUpload() {
        var fileInput = document.getElementById('inputSqlRestore');
        if (!fileInput.files || fileInput.files.length === 0) {
            alert('Silakan pilih berkas .sql terlebih dahulu!');
            return;
        }

        var fileName = fileInput.files[0].name;
        if (!fileName.toLowerCase().endsWith('.sql')) {
            alert('File harus berekstensi .sql!');
            return;
        }

        if (confirm('PERINGATAN KERAS:\n\nApakah Anda yakin ingin memulihkan database dari berkas "' + fileName + '"?\nSeluruh data yang ada saat ini akan ditimpa dengan data di dalam berkas cadangan ini.')) {
            document.getElementById('formRestoreUpload').submit();
        }
    }
</script>
@endsection
