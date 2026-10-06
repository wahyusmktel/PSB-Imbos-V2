@extends('layouts.app_operator')

@section('title', 'Kelola Slider Login & Register')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Slider Login &amp; Register</h2>
                <h5 class="text-white op-7 mb-2">Atur gambar, tag, judul, dan kalimat slider interaktif di halaman login dan registrasi santri</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0 d-flex gap-2">
                <a href="/pendaftar/login" target="_blank" class="btn btn-white btn-border btn-round mr-2">
                    <i class="fas fa-sign-in-alt mr-1"></i> Preview Login
                </a>
                <button type="button" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#modalTambahSlide">
                    <i class="fas fa-plus mr-1"></i> Tambah Slide Baru
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @forelse ($sliders as $slide)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <!-- Image Header with Tag Overlay -->
                <div style="height: 220px; position: relative; overflow: hidden; background: #0f172a;">
                    <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; top: 12px; left: 12px; z-index: 2;">
                        @if(!empty($slide->pill_tag))
                            <span class="badge badge-info px-2 py-1 font-weight-bold" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                {{ $slide->pill_tag }}
                            </span>
                        @endif
                    </div>
                    <div style="position: absolute; top: 12px; right: 12px; z-index: 2;">
                        <span class="badge {{ $slide->status ? 'badge-success' : 'badge-danger' }} px-2 py-1 font-weight-bold">
                            {{ $slide->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div style="position: absolute; bottom: 8px; left: 12px; color: #ffffff; font-size: 0.75rem; background: rgba(0,0,0,0.5); padding: 2px 8px; border-radius: 4px;">
                        Urutan Ke-{{ $slide->urutan }}
                    </div>
                </div>

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="font-weight-bold text-dark mb-2">{{ $slide->title }}</h4>
                        <p class="text-muted small mb-3" style="line-height: 1.5;">
                            {{ $slide->description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalEditSlide{{ $slide->id }}">
                            <i class="fas fa-edit mr-1"></i> Edit Slide
                        </button>

                        <form action="{{ route('operator.landing.slider.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Slide -->
        <div class="modal fade" id="modalEditSlide{{ $slide->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 12px;">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-edit mr-1 text-primary"></i> Edit Slide Gambar
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('operator.landing.slider.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group px-0 pt-0">
                                <label class="font-weight-bold d-block">Ganti Foto Slide (Opsional)</label>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div style="width: 74px; height: 96px; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0; background: #f8fafc; position: relative;">
                                            <img src="{{ asset($slide->image) }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                            <span class="badge badge-dark" style="position: absolute; bottom: 0; left: 0; right: 0; font-size: 0.60rem; border-radius: 0; opacity: 0.85;">Saat Ini</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="drag-drop-box" id="dropBoxSlideEdit{{ $slide->id }}">
                                            <input type="file" name="image" id="inputSlideEdit{{ $slide->id }}" class="drag-drop-file-input" accept="image/png, image/jpeg, image/webp">
                                            <div class="drag-drop-idle" id="idleSlideEdit{{ $slide->id }}">
                                                <i class="fas fa-cloud-upload-alt text-primary mb-1"></i>
                                                <div class="font-weight-bold text-dark small" style="font-size: 0.8rem;">Tarik gambar baru ke sini</div>
                                                <div class="text-muted" style="font-size: 0.72rem;">atau <span class="text-primary font-weight-bold">klik pilih file</span></div>
                                            </div>
                                            <div class="drag-drop-active-preview d-none" id="previewSlideEdit{{ $slide->id }}">
                                                <img src="" alt="Preview" class="drag-preview-thumb" id="thumbSlideEdit{{ $slide->id }}">
                                                <div class="preview-meta">
                                                    <div class="font-weight-bold text-dark text-truncate small" id="filenameSlideEdit{{ $slide->id }}" style="max-width: 150px;"></div>
                                                    <div class="small text-muted" id="filesizeSlideEdit{{ $slide->id }}" style="font-size: 0.70rem;"></div>
                                                    <button type="button" class="btn btn-xs btn-outline-danger mt-1" id="btnCancelSlideEdit{{ $slide->id }}">
                                                        <i class="fas fa-times mr-1"></i> Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group px-0">
                                        <label class="font-weight-bold">Badge / Pill Tag</label>
                                        <input type="text" class="form-control" name="pill_tag" value="{{ $slide->pill_tag }}" placeholder="Contoh: Kampus Representatif">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group px-0">
                                        <label class="font-weight-bold">Urutan Tampil</label>
                                        <input type="number" class="form-control" name="urutan" value="{{ $slide->urutan }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group px-0">
                                <label class="font-weight-bold">Judul Slide</label>
                                <input type="text" class="form-control" name="title" value="{{ $slide->title }}" required>
                            </div>

                            <div class="form-group px-0">
                                <label class="font-weight-bold">Deskripsi / Kalimat Pendukung</label>
                                <textarea class="form-control" name="description" rows="3">{{ $slide->description }}</textarea>
                            </div>

                            <div class="form-group px-0 mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="statusEdit{{ $slide->id }}" name="status" value="1" {{ $slide->status ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="statusEdit{{ $slide->id }}">
                                        Aktifkan slide ini di halaman login &amp; register
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
                <i class="fas fa-images fa-3x mb-3 text-secondary"></i>
                <h4>Belum ada slide gambar yang ditambahkan.</h4>
                <p>Klik tombol "Tambah Slide Baru" di pojok kanan atas untuk menambahkan slide.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Slide Baru -->
<div class="modal fade" id="modalTambahSlide" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold text-white">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Slide Gambar Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operator.landing.slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group px-0 pt-0">
                        <label class="font-weight-bold d-block">Pilih Gambar Slide <span class="text-danger">*</span></label>
                        <div class="drag-drop-box" id="dropBoxSlideTambah">
                            <input type="file" name="image" id="inputSlideTambah" class="drag-drop-file-input" accept="image/png, image/jpeg, image/webp" required>
                            <div class="drag-drop-idle" id="idleSlideTambah">
                                <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                <div class="font-weight-bold text-dark">Tarik &amp; lepas gambar di sini</div>
                                <div class="small text-muted">atau <span class="text-primary font-weight-bold">klik untuk memilih file</span></div>
                                <div class="small text-muted mt-1">(JPG, PNG, WEBP &bull; Portrait 3:4 &bull; Max 5MB)</div>
                            </div>
                            <div class="drag-drop-active-preview d-none" id="previewSlideTambah">
                                <img src="" alt="Preview Slide" class="drag-preview-thumb" id="thumbSlideTambah" style="width: 70px; height: 95px;">
                                <div class="preview-meta">
                                    <div class="font-weight-bold text-dark text-truncate" id="filenameSlideTambah" style="max-width: 200px;"></div>
                                    <div class="small text-muted" id="filesizeSlideTambah"></div>
                                    <button type="button" class="btn btn-xs btn-outline-danger mt-1" id="btnCancelSlideTambah">
                                        <i class="fas fa-times mr-1"></i> Ganti File
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group px-0">
                                <label class="font-weight-bold">Badge / Pill Tag</label>
                                <input type="text" class="form-control" name="pill_tag" placeholder="Contoh: Sains & Teknologi">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group px-0">
                                <label class="font-weight-bold">Urutan</label>
                                <input type="number" class="form-control" name="urutan" value="{{ count($sliders) + 1 }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold">Judul Slide <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Contoh: Integrasi IPTEK & Al-Qur'an" required>
                    </div>

                    <div class="form-group px-0">
                        <label class="font-weight-bold">Deskripsi / Kalimat Pendukung</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Contoh: Kurikulum seimbang yang mengasah kompetensi digital dan hafalan santri."></textarea>
                    </div>

                    <div class="form-group px-0 mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="statusTambah" name="status" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="statusTambah">
                                Langsung aktifkan slide ini
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

<style>
    .drag-drop-box {
        position: relative;
        border: 2px dashed #93c5fd;
        background: #f0f7ff;
        border-radius: 10px;
        padding: 16px 12px;
        text-align: center;
        transition: all 0.25s ease;
        cursor: pointer;
        min-height: 96px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .drag-drop-box:hover, .drag-drop-box.drag-over {
        border-color: #0284c7;
        background: #e0f2fe;
        transform: translateY(-1px);
    }
    .drag-drop-file-input {
        position: absolute;
        top: 0;
        left: 0;
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
        text-align: left;
        position: relative;
        z-index: 6;
    }
    .drag-preview-thumb {
        width: 50px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        flex-shrink: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Setup Tambah Slide
        setupDragDrop(
            'dropBoxSlideTambah',
            'inputSlideTambah',
            'idleSlideTambah',
            'previewSlideTambah',
            'thumbSlideTambah',
            'filenameSlideTambah',
            'filesizeSlideTambah',
            'btnCancelSlideTambah'
        );

        // Setup Edit Slide tiap item
        @foreach ($sliders as $slide)
        setupDragDrop(
            'dropBoxSlideEdit{{ $slide->id }}',
            'inputSlideEdit{{ $slide->id }}',
            'idleSlideEdit{{ $slide->id }}',
            'previewSlideEdit{{ $slide->id }}',
            'thumbSlideEdit{{ $slide->id }}',
            'filenameSlideEdit{{ $slide->id }}',
            'filesizeSlideEdit{{ $slide->id }}',
            'btnCancelSlideEdit{{ $slide->id }}'
        );
        @endforeach
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
