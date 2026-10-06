@extends('layouts.app_operator')

@section('title', 'Kelola Konten Landing Page')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Konten Landing Page</h2>
                <h5 class="text-white op-7 mb-2">Kustomisasi teks, ayat Al-Qur'an, gambar hero, jam operasional, peta, dan footer</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="/" target="_blank" class="btn btn-white btn-border btn-round">
                    <i class="fas fa-external-link-alt mr-1"></i> Preview Landing Page
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <form action="{{ route('operator.landing.konten.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kolom Kiri: Hero Section & Kalam Quran -->
            <div class="col-lg-7">
                <!-- Card 1: Hero Section -->
                <div class="card shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-light">
                        <div class="card-title font-weight-bold text-primary">
                            <i class="fas fa-bullhorn mr-2"></i>Bagian Utama (Hero Section)
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Tag / Kategori</label>
                                    <input type="text" class="form-control" name="hero_tag" value="{{ $config->hero_tag ?? 'PSB Online' }}" placeholder="Contoh: PSB Online" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Judul Utama Hero</label>
                                    <input type="text" class="form-control" name="hero_title" value="{{ $config->hero_title ?? 'SMP/SMA IT Insan Mulia' }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Sub-Judul / Keterangan Tahun</label>
                            <input type="text" class="form-control" name="hero_subtitle" value="{{ $config->hero_subtitle ?? 'Boarding School Pringsewu 2027-2028' }}" required>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Deskripsi Pengantar Hero</label>
                            <textarea class="form-control" name="hero_desc" rows="3" required>{{ $config->hero_desc }}</textarea>
                            <small class="form-text text-muted">Paragraf pengantar sambutan yang muncul tepat di bawah judul utama.</small>
                        </div>

                        <!-- Gambar Hero Ilustrasi dengan Drag & Drop Zone -->
                        <div class="form-group px-0">
                            <label class="font-weight-bold d-block">Gambar / Ilustrasi Hero</label>
                            <div class="row align-items-center mb-2">
                                <div class="col-auto">
                                    <div class="current-img-badge">
                                        <div class="text-muted small mb-1 font-weight-bold">Saat Ini:</div>
                                        <div class="img-preview-box">
                                            <img src="{{ !empty($config->hero_image) ? asset($config->hero_image) : asset('theme/images/hero-santri.png') }}" alt="Hero Current" id="currentHeroImg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Drag and Drop Box -->
                                    <div class="drag-drop-box" id="dropBoxHero">
                                        <input type="file" name="hero_image" id="inputHeroImg" class="drag-drop-file-input" accept="image/png, image/jpeg, image/webp">
                                        <div class="drag-drop-idle" id="idleBoxHero">
                                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                            <div class="font-weight-bold text-dark">Tarik &amp; lepas gambar baru di sini</div>
                                            <div class="small text-muted">atau <span class="text-primary font-weight-bold">klik untuk memilih file</span></div>
                                            <div class="small text-muted mt-1">(PNG, JPG, WEBP &bull; Maks. 5MB)</div>
                                        </div>
                                        <div class="drag-drop-active-preview d-none" id="previewBoxHero">
                                            <img src="" alt="Preview Hero" class="drag-preview-thumb" id="thumbHero">
                                            <div class="preview-meta">
                                                <div class="font-weight-bold text-dark text-truncate" id="filenameHero" style="max-width: 220px;"></div>
                                                <div class="small text-muted" id="filesizeHero"></div>
                                                <button type="button" class="btn btn-xs btn-outline-danger mt-1" id="btnCancelHero">
                                                    <i class="fas fa-times mr-1"></i> Batal Ganti
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Kalam Quran Box -->
                <div class="card shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-light">
                        <div class="card-title font-weight-bold text-primary">
                            <i class="fas fa-quran mr-2"></i>Kotak Kalam Al-Qur'an (Hero Section)
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group px-0">
                            <label class="font-weight-bold">Surah &amp; Ayat</label>
                            <input type="text" class="form-control" name="quran_surah" value="{{ $config->quran_surah ?? "QS. Ar-Ra'd: 11" }}" placeholder="Contoh: QS. Ar-Ra'd: 11" required>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Teks Ayat Arab</label>
                            <textarea class="form-control font-weight-bold text-right" name="quran_arabic" rows="2" style="font-size: 1.25rem; font-family: 'Amiri', serif; direction: rtl;" required>{{ $config->quran_arabic }}</textarea>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Terjemahan Arti Ayat</label>
                            <textarea class="form-control font-italic" name="quran_translation" rows="2" required>{{ $config->quran_translation }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Running Text, Jam Layanan, Maps & Footer -->
            <div class="col-lg-5">
                <!-- Card 3: Running Text & Jam Layanan -->
                <div class="card shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-light">
                        <div class="card-title font-weight-bold text-primary">
                            <i class="fas fa-clock mr-2"></i>Pengumuman &amp; Jam Layanan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group px-0">
                            <label class="font-weight-bold">Teks Berjalan (Running Marquee)</label>
                            <textarea class="form-control" name="running_text" rows="2" placeholder="Kosongkan jika ingin memakai pengumuman default">{{ $config->running_text }}</textarea>
                            <small class="form-text text-muted">Akan muncul di bilah atas (top-bar) halaman landing page.</small>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Jam Layanan Kantor Sekretariat</label>
                            <input type="text" class="form-control" name="jam_kerja" value="{{ $config->jam_kerja ?? 'Senin - Sabtu: 08.00 - 16.00 WIB' }}" required>
                            <small class="form-text text-muted">Ditampilkan pada kotak kontak &amp; pusat informasi.</small>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Link Embed Google Maps (Iframe URL)</label>
                            <textarea class="form-control" name="maps_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?...">{{ $config->maps_embed_url }}</textarea>
                            <small class="form-text text-muted">Masukkan atribut <code>src</code> dari embed Google Maps resmi kampus.</small>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Footer Section -->
                <div class="card shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-light">
                        <div class="card-title font-weight-bold text-primary">
                            <i class="fas fa-feather-alt mr-2"></i>Konten Footer Halaman
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group px-0">
                            <label class="font-weight-bold">Judul Slogan Footer</label>
                            <input type="text" class="form-control" name="footer_title" value="{{ $config->footer_title }}" required>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Sub-Judul Slogan Footer</label>
                            <textarea class="form-control" name="footer_subtitle" rows="2" required>{{ $config->footer_subtitle }}</textarea>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Deskripsi Ringkas Lembaga di Footer</label>
                            <textarea class="form-control" name="footer_desc" rows="3" required>{{ $config->footer_desc }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Semua Konten
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .img-preview-box {
        width: 90px;
        height: 90px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-preview-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .drag-drop-box {
        position: relative;
        border: 2px dashed #94a3b8;
        border-radius: 10px;
        background: #f8fafc;
        padding: 16px 14px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .drag-drop-box:hover, .drag-drop-box.drag-over {
        border-color: #0f78c2;
        background: #eff6ff;
    }
    .drag-drop-file-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 5;
    }
    .drag-drop-active-preview {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        text-align: left;
        position: relative;
        z-index: 6;
    }
    .drag-preview-thumb {
        width: 70px;
        height: 70px;
        object-fit: contain;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        flex-shrink: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setupDragDrop('dropBoxHero', 'inputHeroImg', 'idleBoxHero', 'previewBoxHero', 'thumbHero', 'filenameHero', 'filesizeHero', 'btnCancelHero');
    });

    function setupDragDrop(boxId, inputId, idleId, previewId, thumbId, nameId, sizeId, cancelBtnId) {
        var box = document.getElementById(boxId);
        var input = document.getElementById(inputId);
        var idle = document.getElementById(idleId);
        var preview = document.getElementById(previewId);
        var thumb = document.getElementById(thumbId);
        var nameElem = document.getElementById(nameId);
        var sizeElem = document.getElementById(sizeId);
        var cancelBtn = document.getElementById(cancelBtnId);

        if (!box || !input) return;

        ['dragenter', 'dragover'].forEach(function (eventName) {
            box.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                box.classList.add('drag-over');
            }, false);
        });

        ['dragleave', 'drop'].forEach(function (eventName) {
            box.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                box.classList.remove('drag-over');
            }, false);
        });

        box.addEventListener('drop', function (e) {
            var dt = e.dataTransfer;
            var files = dt.files;
            if (files.length > 0) {
                input.files = files;
                handleFiles(files[0]);
            }
        }, false);

        input.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                handleFiles(this.files[0]);
            }
        });

        function handleFiles(file) {
            if (!file.type.match('image.*')) {
                alert('Silakan pilih file gambar (JPG, PNG, WEBP)');
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                thumb.src = e.target.result;
                nameElem.textContent = file.name;
                sizeElem.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                idle.classList.add('d-none');
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                input.value = '';
                thumb.src = '';
                preview.classList.add('d-none');
                idle.classList.remove('d-none');
            });
        }
    }
</script>
@endsection
