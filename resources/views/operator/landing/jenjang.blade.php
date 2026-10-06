@extends('layouts.app_operator')

@section('title', 'Kelola Jenjang Pendidikan')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Jenjang Pendidikan</h2>
                <h5 class="text-white op-7 mb-2">Atur foto, lokasi kampus, deskripsi, dan poin keunggulan SMPIT &amp; SMAIT</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="/#jenjang" target="_blank" class="btn btn-white btn-border btn-round">
                    <i class="fas fa-external-link-alt mr-1"></i> Preview Bagian Jenjang
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @foreach ($jenjangs as $jenjang)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h4 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-school mr-2 text-primary"></i>{{ $jenjang->nama_jenjang }}
                    </h4>
                    <span class="badge badge-primary px-3 py-2 font-weight-bold">{{ $jenjang->tingkat_jenjang }}</span>
                </div>
                <form action="{{ route('operator.landing.jenjang.update', $jenjang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group px-0 pt-0">
                            <label class="font-weight-bold">Status Tampil di Landing Page</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status_{{ $jenjang->id }}" name="status" value="1" {{ $jenjang->status ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="status_{{ $jenjang->id }}">
                                    {{ $jenjang->status ? 'Aktif Ditampilkan' : 'Disembunyikan' }}
                                </label>
                            </div>
                        </div>

                        <!-- Foto Cover Jenjang (Vertical Media Drag & Drop) -->
                        <div class="form-group px-0">
                            <label class="font-weight-bold d-block">Foto Banner / Cover Jenjang</label>
                            
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="current-img-wrapper" style="width: 84px; height: 118px; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0; background: #f8fafc; position: relative;">
                                        <img src="{{ !empty($jenjang->photo_cover) ? asset($jenjang->photo_cover) : asset('theme/images/jenjang-' . strtolower($jenjang->tingkat_jenjang) . 'it-full.jpg') }}" alt="Cover Saat Ini" id="currentJenjangImg{{ $jenjang->id }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        <span class="badge badge-dark" style="position: absolute; bottom: 0; left: 0; right: 0; font-size: 0.65rem; border-radius: 0; opacity: 0.85;">Saat Ini</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="drag-drop-box" id="dropBoxJenjang{{ $jenjang->id }}">
                                        <input type="file" name="photo_cover" id="inputJenjang{{ $jenjang->id }}" class="drag-drop-file-input" accept="image/png, image/jpeg, image/webp">
                                        <div class="drag-drop-idle" id="idleBoxJenjang{{ $jenjang->id }}">
                                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-1"></i>
                                            <div class="font-weight-bold text-dark small">Tarik &amp; lepas cover baru di sini</div>
                                            <div class="small text-muted">atau <span class="text-primary font-weight-bold">klik untuk memilih file</span></div>
                                            <div class="small text-muted" style="font-size: 0.72rem;">(JPG, PNG, WEBP &bull; Portrait &bull; Max 5MB)</div>
                                        </div>
                                        <div class="drag-drop-active-preview d-none" id="previewBoxJenjang{{ $jenjang->id }}">
                                            <img src="" alt="Preview" class="drag-preview-thumb" id="thumbJenjang{{ $jenjang->id }}">
                                            <div class="preview-meta">
                                                <div class="font-weight-bold text-dark text-truncate small" id="filenameJenjang{{ $jenjang->id }}" style="max-width: 180px;"></div>
                                                <div class="small text-muted" id="filesizeJenjang{{ $jenjang->id }}" style="font-size: 0.72rem;"></div>
                                                <button type="button" class="btn btn-xs btn-outline-danger mt-1" id="btnCancelJenjang{{ $jenjang->id }}">
                                                    <i class="fas fa-times mr-1"></i> Batal Ganti
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Nama Unit Jenjang</label>
                                    <input type="text" class="form-control" name="nama_jenjang" value="{{ $jenjang->nama_jenjang }}" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Tingkat Jenjang</label>
                                    <select name="tingkat_jenjang" class="form-control" required>
                                        <option value="SMP" {{ $jenjang->tingkat_jenjang == 'SMP' ? 'selected' : '' }}>SMP / MTs</option>
                                        <option value="SMA" {{ $jenjang->tingkat_jenjang == 'SMA' ? 'selected' : '' }}>SMA / MA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Label / Tag Lokasi Kampus</label>
                            <input type="text" class="form-control" name="tag_lokasi" value="{{ $jenjang->tag_lokasi }}" placeholder="Contoh: Kampus Putra & Putri Terpisah · Pringsewu, Lampung">
                            <small class="form-text text-muted">Ditampilkan di atas foto pada banner jenjang.</small>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Deskripsi Ringkas Jenjang</label>
                            <textarea class="form-control" name="deskripsi_jenjang" rows="3" required>{{ $jenjang->deskripsi_jenjang }}</textarea>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Poin Keunggulan (Checklist)</label>
                            <textarea class="form-control" name="poin_keunggulan" rows="4" placeholder="Judul Poin: Penjelasan singkat&#10;Contoh:&#10;Kurikulum Terpadu: Perpaduan kurikulum nasional & diniyah&#10;Halaqah Qur'an: Bimbingan tahfizh mutqin">{{ $jenjang->poin_keunggulan }}</textarea>
                            <small class="form-text text-muted">Pisahkan setiap poin dengan baris baru (Enter). Gunakan format <code>Judul Poin: Penjelasan</code> untuk teks tebal.</small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Jenjang {{ $jenjang->tingkat_jenjang }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
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
        min-height: 118px;
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
        width: 55px;
        height: 75px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        flex-shrink: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($jenjangs as $jenjang)
        setupDragDrop(
            'dropBoxJenjang{{ $jenjang->id }}',
            'inputJenjang{{ $jenjang->id }}',
            'idleBoxJenjang{{ $jenjang->id }}',
            'previewBoxJenjang{{ $jenjang->id }}',
            'thumbJenjang{{ $jenjang->id }}',
            'filenameJenjang{{ $jenjang->id }}',
            'filesizeJenjang{{ $jenjang->id }}',
            'btnCancelJenjang{{ $jenjang->id }}'
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
