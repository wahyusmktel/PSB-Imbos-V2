@extends('layouts.app_operator')

@section('title', 'Kelola Alur Seleksi Penerimaan')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Alur Seleksi Penerimaan</h2>
                <h5 class="text-white op-7 mb-2">Atur urutan, nomor, judul, ikon, dan penjelasan langkah pendaftaran di landing page</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0 d-flex gap-2">
                <a href="/#alur" target="_blank" class="btn btn-white btn-border btn-round mr-2">
                    <i class="fas fa-external-link-alt mr-1"></i> Preview Bagian Alur
                </a>
                <button type="button" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#modalTambahAlur">
                    <i class="fas fa-plus mr-1"></i> Tambah Tahap Baru
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @forelse ($alurs as $alur)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div style="width: 38px; height: 38px; border-radius: 8px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem;" class="mr-2">
                            {{ $alur->step_number }}
                        </div>
                        <div>
                            <span class="badge badge-secondary px-2 py-1" style="font-size: 0.70rem;">{{ $alur->step_tag }}</span>
                        </div>
                    </div>
                    <span class="badge {{ $alur->status ? 'badge-success' : 'badge-danger' }} px-2 py-1 font-weight-bold">
                        {{ $alur->status ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="{{ $alur->icon }} text-primary fa-lg mr-2"></i>
                            <h4 class="font-weight-bold text-dark mb-0">{{ $alur->title }}</h4>
                        </div>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            {{ $alur->description }}
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <span class="text-muted small">Urutan Ke-{{ $alur->urutan }}</span>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#modalEditAlur{{ $alur->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('operator.landing.alur.destroy', $alur->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tahap alur ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Alur -->
        <div class="modal fade" id="modalEditAlur{{ $alur->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 12px;">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-edit mr-1 text-primary"></i> Edit Tahap Alur Pendaftaran
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('operator.landing.alur.update', $alur->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group px-0 pt-0">
                                        <label class="font-weight-bold">Nomor Tahap</label>
                                        <input type="text" class="form-control font-weight-bold text-center" name="step_number" value="{{ $alur->step_number }}" placeholder="01" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group px-0 pt-0">
                                        <label class="font-weight-bold">Tag Tahap</label>
                                        <input type="text" class="form-control" name="step_tag" value="{{ $alur->step_tag }}" placeholder="Contoh: Tahap Awal" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group px-0 pt-0">
                                        <label class="font-weight-bold">Urutan</label>
                                        <input type="number" class="form-control text-center" name="urutan" value="{{ $alur->urutan }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group px-0">
                                <label class="font-weight-bold">Judul Tahap</label>
                                <input type="text" class="form-control" name="title" value="{{ $alur->title }}" required>
                            </div>

                            <div class="form-group px-0">
                                <label class="font-weight-bold">Ikon FontAwesome</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light text-primary" id="previewIconEdit{{ $alur->id }}" style="font-size: 1.15rem; width: 48px; justify-content: center;">
                                            <i class="{{ $alur->icon }}"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="icon" id="inputIconEdit{{ $alur->id }}" value="{{ $alur->icon }}" placeholder="Contoh: fas fa-user-plus" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary btn-open-icon-picker" data-target-input="#inputIconEdit{{ $alur->id }}" data-target-preview="#previewIconEdit{{ $alur->id }}">
                                            <i class="fas fa-icons mr-1"></i> Pilih Icon
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Pilih icon dari galeri visual atau ketik langsung class FontAwesome.</small>
                            </div>

                            <div class="form-group px-0">
                                <label class="font-weight-bold">Deskripsi / Penjelasan Tahap</label>
                                <textarea class="form-control" name="description" rows="4" required>{{ $alur->description }}</textarea>
                            </div>

                            <div class="form-group px-0 mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="statusEditAlur{{ $alur->id }}" name="status" value="1" {{ $alur->status ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="statusEditAlur{{ $alur->id }}">
                                        Aktifkan tahap ini di alur landing page
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card p-5 text-center text-muted">
                <i class="fas fa-stream fa-3x mb-3 text-secondary"></i>
                <h4>Belum ada tahapan alur yang ditambahkan.</h4>
                <p>Klik tombol "Tambah Tahap Baru" di pojok kanan atas untuk menambahkan.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Alur Baru -->
<div class="modal fade" id="modalTambahAlur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold text-white">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Tahap Alur Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operator.landing.alur.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group px-0 pt-0">
                                <label class="font-weight-bold">Nomor Tahap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-weight-bold text-center" name="step_number" placeholder="01" value="{{ str_pad(count($alurs) + 1, 2, '0', STR_PAD_LEFT) }}" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group px-0 pt-0">
                                <label class="font-weight-bold">Tag Tahap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="step_tag" placeholder="Contoh: Tahap Awal" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group px-0 pt-0">
                                <label class="font-weight-bold">Urutan</label>
                                <input type="number" class="form-control text-center" name="urutan" value="{{ count($alurs) + 1 }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold">Judul Tahap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Contoh: Registrasi Akun" required>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold">Ikon FontAwesome <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light text-primary" id="previewIconTambah" style="font-size: 1.15rem; width: 48px; justify-content: center;">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="icon" id="inputIconTambah" value="fas fa-user-plus" placeholder="Contoh: fas fa-user-plus" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary btn-open-icon-picker" data-target-input="#inputIconTambah" data-target-preview="#previewIconTambah">
                                    <i class="fas fa-icons mr-1"></i> Pilih Icon
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Pilih icon dari galeri visual atau ketik langsung class FontAwesome.</small>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold">Deskripsi / Penjelasan Tahap <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Jelaskan langkah yang harus dilakukan calon santri/wali..." required></textarea>
                    </div>

                    <div class="form-group px-0 mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="statusTambahAlur" name="status" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="statusTambahAlur">
                                Langsung aktifkan tahap ini di landing page
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-check mr-1"></i> Simpan &amp; Tambahkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Universal Icon Picker -->
<div class="modal fade" id="modalIconPicker" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.25);">
            <div class="modal-header bg-dark text-white py-3">
                <div class="d-flex align-items-center">
                    <div style="width: 38px; height: 38px; border-radius: 8px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas fa-icons text-warning"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0 text-white">Pilih Icon FontAwesome</h5>
                        <small class="text-light op-8">Klik icon untuk langsung menerapkannya pada alur pendaftaran</small>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-3" style="background: #f8fafc;">
                <!-- Search & Filter Bar -->
                <div class="bg-white p-3 rounded shadow-sm mb-3 border">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0 text-muted"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0" id="iconSearchInput" placeholder="Cari nama icon... (misal: user, card, check, book, wallet)">
                    </div>
                    
                    <!-- Category Pills -->
                    <div class="d-flex flex-wrap gap-1" id="iconCategoryPills" style="gap: 6px;">
                        <button type="button" class="btn btn-xs btn-primary icon-cat-filter active" data-cat="all">Semua Icon</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="user">Akun &amp; Santri</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="file">Formulir &amp; Berkas</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="edu">Sekolah &amp; Ujian</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="money">Biaya &amp; Bayar</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="agenda">Jadwal &amp; Hasil</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary icon-cat-filter" data-cat="comm">Kontak &amp; Asrama</button>
                    </div>
                </div>

                <!-- Icon Grid Container -->
                <div class="icon-grid-container" id="iconGrid" style="max-height: 380px; overflow-y: auto; padding-right: 4px;">
                    <!-- Grid items injected by JS -->
                </div>
            </div>
            
            <div class="modal-footer bg-light py-2 justify-content-between">
                <span class="text-muted small" id="iconCountInfo">Menampilkan 0 icon</span>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(105px, 1fr));
        gap: 10px;
    }
    .icon-card-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 6px 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .icon-card-item:hover {
        border-color: #0f78c2;
        background: #e0f2fe;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(15, 120, 194, 0.15);
    }
    .icon-card-item i {
        font-size: 1.5rem;
        margin-bottom: 6px;
        color: #1e293b;
        transition: color 0.2s ease;
    }
    .icon-card-item:hover i {
        color: #0f78c2;
    }
    .icon-card-item .icon-name {
        font-size: 0.68rem;
        color: #64748b;
        word-break: break-all;
        line-height: 1.2;
    }
</style>

<script>
    // Database Icon FontAwesome untuk PSB
    var faIconDatabase = [
        // Akun & Santri
        { cls: "fas fa-user-plus", name: "user-plus", label: "Daftar Akun", cat: "user" },
        { cls: "fas fa-user", name: "user", label: "Profil", cat: "user" },
        { cls: "fas fa-user-circle", name: "user-circle", label: "Akun Santri", cat: "user" },
        { cls: "fas fa-users", name: "users", label: "Santri & Wali", cat: "user" },
        { cls: "fas fa-user-check", name: "user-check", label: "Verifikasi Santri", cat: "user" },
        { cls: "fas fa-user-graduate", name: "user-graduate", label: "Lulusan / Santri", cat: "user" },
        { cls: "fas fa-id-card", name: "id-card", label: "NISN / KTP", cat: "user" },
        { cls: "fas fa-id-card-alt", name: "id-card-alt", label: "Kartu Pelajar", cat: "user" },
        { cls: "fas fa-fingerprint", name: "fingerprint", label: "Otentikasi", cat: "user" },
        { cls: "fas fa-key", name: "key", label: "Kunci Masuk", cat: "user" },
        { cls: "fas fa-lock", name: "lock", label: "Sandi Aman", cat: "user" },
        { cls: "fas fa-user-shield", name: "user-shield", label: "Proteksi Akun", cat: "user" },

        // Formulir & Berkas
        { cls: "fas fa-file-alt", name: "file-alt", label: "Formulir", cat: "file" },
        { cls: "fas fa-file-invoice", name: "file-invoice", label: "Biodata", cat: "file" },
        { cls: "fas fa-file-signature", name: "file-signature", label: "Surat Pernyataan", cat: "file" },
        { cls: "fas fa-folder-open", name: "folder-open", label: "Berkas Syarat", cat: "file" },
        { cls: "fas fa-cloud-upload-alt", name: "cloud-upload-alt", label: "Unggah Dokumen", cat: "file" },
        { cls: "fas fa-clipboard-check", name: "clipboard-check", label: "Validasi Berkas", cat: "file" },
        { cls: "fas fa-clipboard-list", name: "clipboard-list", label: "Checklist Syarat", cat: "file" },
        { cls: "fas fa-tasks", name: "tasks", label: "Kelengkapan", cat: "file" },
        { cls: "fas fa-edit", name: "edit", label: "Isi Data", cat: "file" },
        { cls: "fas fa-file-contract", name: "file-contract", label: "Kontrak Belajar", cat: "file" },
        { cls: "fas fa-file-medical", name: "file-medical", label: "Surat Sehat", cat: "file" },
        { cls: "fas fa-paperclip", name: "paperclip", label: "Lampiran", cat: "file" },

        // Sekolah & Ujian
        { cls: "fas fa-school", name: "school", label: "Sekolah", cat: "edu" },
        { cls: "fas fa-graduation-cap", name: "graduation-cap", label: "Pendidikan", cat: "edu" },
        { cls: "fas fa-quran", name: "quran", label: "Al-Qur'an", cat: "edu" },
        { cls: "fas fa-book-reader", name: "book-reader", label: "Tahfizh", cat: "edu" },
        { cls: "fas fa-book-open", name: "book-open", label: "Ujian Tulis", cat: "edu" },
        { cls: "fas fa-book", name: "book", label: "Kitab & Buku", cat: "edu" },
        { cls: "fas fa-laptop", name: "laptop", label: "Tes CBT Online", cat: "edu" },
        { cls: "fas fa-pen-fancy", name: "pen-fancy", label: "Tes Tulis", cat: "edu" },
        { cls: "fas fa-brain", name: "brain", label: "Psikotes / Potensi", cat: "edu" },
        { cls: "fas fa-certificate", name: "certificate", label: "Sertifikat", cat: "edu" },
        { cls: "fas fa-award", name: "award", label: "Penghargaan", cat: "edu" },
        { cls: "fas fa-medal", name: "medal", label: "Prestasi", cat: "edu" },
        { cls: "fas fa-trophy", name: "trophy", label: "Juara", cat: "edu" },
        { cls: "fas fa-chalkboard-teacher", name: "chalkboard-teacher", label: "Penguji / Guru", cat: "edu" },

        // Biaya & Pembayaran
        { cls: "fas fa-wallet", name: "wallet", label: "Dompet / Biaya", cat: "money" },
        { cls: "fas fa-money-bill-wave", name: "money-bill-wave", label: "Pembayaran", cat: "money" },
        { cls: "fas fa-credit-card", name: "credit-card", label: "Transfer Bank", cat: "money" },
        { cls: "fas fa-receipt", name: "receipt", label: "Kwitansi / Bukti", cat: "money" },
        { cls: "fas fa-coins", name: "coins", label: "Infaq", cat: "money" },
        { cls: "fas fa-donate", name: "donate", label: "Daftar Ulang", cat: "money" },
        { cls: "fas fa-hand-holding-usd", name: "hand-holding-usd", label: "Bantuan Finansial", cat: "money" },
        { cls: "fas fa-money-check-alt", name: "money-check-alt", label: "Cek Keuangan", cat: "money" },

        // Jadwal & Hasil
        { cls: "fas fa-bullhorn", name: "bullhorn", label: "Pengumuman", cat: "agenda" },
        { cls: "fas fa-calendar-alt", name: "calendar-alt", label: "Jadwal", cat: "agenda" },
        { cls: "fas fa-calendar-check", name: "calendar-check", label: "Agenda Seleksi", cat: "agenda" },
        { cls: "fas fa-clock", name: "clock", label: "Waktu Batas", cat: "agenda" },
        { cls: "fas fa-bell", name: "bell", label: "Pemberitahuan", cat: "agenda" },
        { cls: "fas fa-check-circle", name: "check-circle", label: "Dinyatakan Lulus", cat: "agenda" },
        { cls: "fas fa-check-double", name: "check-double", label: "Finalisasi", cat: "agenda" },
        { cls: "fas fa-flag-checkered", name: "flag-checkered", label: "Tahap Selesai", cat: "agenda" },
        { cls: "fas fa-star", name: "star", label: "Rekomendasi", cat: "agenda" },

        // Kontak, Wawancara & Asrama
        { cls: "fas fa-comments", name: "comments", label: "Wawancara", cat: "comm" },
        { cls: "fas fa-headset", name: "headset", label: "Layanan Humas", cat: "comm" },
        { cls: "fas fa-phone-alt", name: "phone-alt", label: "Telepon Panitia", cat: "comm" },
        { cls: "fas fa-mosque", name: "mosque", label: "Masjid Pesantren", cat: "comm" },
        { cls: "fas fa-home", name: "home", label: "Asrama Santri", cat: "comm" },
        { cls: "fas fa-building", name: "building", label: "Kampus", cat: "comm" },
        { cls: "fas fa-map-marked-alt", name: "map-marked-alt", label: "Lokasi Pesantren", cat: "comm" },
        { cls: "fas fa-heartbeat", name: "heartbeat", label: "Cek Kesehatan", cat: "comm" },
        { cls: "fas fa-stethoscope", name: "stethoscope", label: "Tes Medis", cat: "comm" },
        { cls: "fas fa-luggage-cart", name: "luggage-cart", label: "Kedatangan Santri", cat: "comm" },
        { cls: "fas fa-info-circle", name: "info-circle", label: "Informasi", cat: "comm" }
    ];

    var currentTargetInput = null;
    var currentTargetPreview = null;
    var activeCategory = "all";

    document.addEventListener('DOMContentLoaded', function () {
        renderIconGrid();

        // Handler untuk tombol "Pilih Icon"
        $(document).on('click', '.btn-open-icon-picker', function () {
            currentTargetInput = $(this).data('target-input');
            currentTargetPreview = $(this).data('target-preview');
            $('#modalIconPicker').modal('show');
        });

        // Search filter
        $('#iconSearchInput').on('keyup', function () {
            renderIconGrid($(this).val().toLowerCase());
        });

        // Category pills filter
        $('.icon-cat-filter').on('click', function () {
            $('.icon-cat-filter').removeClass('btn-primary active').addClass('btn-outline-secondary');
            $(this).removeClass('btn-outline-secondary').addClass('btn-primary active');
            activeCategory = $(this).data('cat');
            renderIconGrid($('#iconSearchInput').val().toLowerCase());
        });

        // Icon click handler
        $(document).on('click', '.icon-card-item', function () {
            var selectedCls = $(this).data('cls');
            if (currentTargetInput) {
                $(currentTargetInput).val(selectedCls);
            }
            if (currentTargetPreview) {
                $(currentTargetPreview).html('<i class="' + selectedCls + '"></i>');
            }
            $('#modalIconPicker').modal('hide');
        });
    });

    function renderIconGrid(keyword) {
        keyword = keyword || '';
        var container = document.getElementById('iconGrid');
        if (!container) return;

        var html = '';
        var count = 0;

        faIconDatabase.forEach(function (icon) {
            var matchesCat = (activeCategory === 'all' || icon.cat === activeCategory);
            var matchesKey = (keyword === '' || icon.name.indexOf(keyword) !== -1 || icon.cls.indexOf(keyword) !== -1 || icon.label.toLowerCase().indexOf(keyword) !== -1);

            if (matchesCat && matchesKey) {
                count++;
                html += '<div class="icon-card-item" data-cls="' + icon.cls + '" title="' + icon.label + ' (' + icon.cls + ')">' +
                            '<i class="' + icon.cls + '"></i>' +
                            '<div class="icon-name text-truncate w-100">' + icon.name + '</div>' +
                        '</div>';
            }
        });

        if (count === 0) {
            html = '<div class="col-12 py-5 text-center text-muted" style="grid-column: 1 / -1;">' +
                        '<i class="fas fa-search-minus fa-2x mb-2 text-secondary"></i>' +
                        '<div class="font-weight-bold">Icon tidak ditemukan</div>' +
                        '<div class="small">Coba gunakan kata kunci lain</div>' +
                   '</div>';
        }

        container.innerHTML = html;
        var infoElem = document.getElementById('iconCountInfo');
        if (infoElem) {
            infoElem.textContent = 'Menampilkan ' + count + ' icon';
        }
    }
</script>
@endsection
