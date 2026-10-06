@extends('layouts.app_operator')

@section('title', 'Kelola Jalur Pendaftaran')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Jalur Pendaftaran</h2>
                <h5 class="text-white op-7 mb-2">Atur syarat, biaya, dan status penerimaan tiap jalur di landing page</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        @foreach ($jalurs as $jalur)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-route mr-2 text-primary"></i>{{ $jalur->nama_jalur }}
                    </h4>
                    <span class="badge {{ $jalur->status ? 'badge-success' : 'badge-danger' }} p-2">
                        {{ $jalur->status ? 'DIBUKA' : 'DITUTUP' }}
                    </span>
                </div>
                <form action="{{ route('operator.landing.jalur.update', $jalur->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group px-0 pt-0">
                            <label class="font-weight-bold">Status Jalur</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status_{{ $jalur->id }}" name="status" value="1" {{ $jalur->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status_{{ $jalur->id }}">
                                    {{ $jalur->status ? 'Jalur Dibuka untuk Calon Santri' : 'Jalur Ditutup Sementara' }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Nama Jalur</label>
                            <input type="text" class="form-control" name="nama_jalur" value="{{ $jalur->nama_jalur }}" required>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Deskripsi Singkat</label>
                            <input type="text" class="form-control" name="deskripsi_jalur" value="{{ $jalur->deskripsi_jalur }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Biaya Pendaftaran (Rp)</label>
                                    <input type="number" class="form-control" name="biaya" value="{{ $jalur->biaya ?? 350000 }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group px-0">
                                    <label class="font-weight-bold">Kelebihan Jalur</label>
                                    <input type="text" class="form-control" name="kelebihan" value="{{ $jalur->kelebihan }}" placeholder="Contoh: Bebas Tes TPA">
                                </div>
                            </div>
                        </div>

                        <div class="form-group px-0">
                            <label class="font-weight-bold">Syarat & Berkas Pendaftaran (Satu per baris)</label>
                            <textarea class="form-control" name="persyaratan" rows="5" placeholder="Fotokopi Kartu Keluarga&#10;NISN Sekolah Asal&#10;Pas foto 3x4">{{ $jalur->persyaratan }}</textarea>
                            <small class="form-text text-muted">Setiap baris baru akan otomatis ditampilkan sebagai poin checklist di landing page.</small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan Jalur
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
