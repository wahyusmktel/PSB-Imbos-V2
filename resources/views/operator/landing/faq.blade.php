@extends('layouts.app_operator')

@section('title', 'Kelola Tanya Jawab (FAQ)')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Kelola Tanya Jawab (FAQ)</h2>
                <h5 class="text-white op-7 mb-2">Daftar pertanyaan yang sering diajukan wali santri di landing page</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <button class="btn btn-white btn-border btn-round" data-toggle="modal" data-target="#modalTambahFaq">
                    <i class="fas fa-plus mr-1"></i> Tambah Pertanyaan FAQ
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title font-weight-bold mb-0">
                        <i class="fas fa-question-circle mr-2 text-primary"></i>Daftar Pertanyaan & Jawaban
                    </h4>
                    <span class="text-muted">Total: {{ $faqs->count() }} Pertanyaan</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 30%;">Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th style="width: 80px;" class="text-center">Status</th>
                                    <th style="width: 140px;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faqs as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="font-weight-bold text-dark">{{ $item->pertanyaan }}</td>
                                    <td class="text-muted">{{ $item->jawaban }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $item->status ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modalEditFaq_{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('operator.landing.faq.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit FAQ -->
                                <div class="modal fade" id="modalEditFaq_{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('operator.landing.faq.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold">Edit Pertanyaan FAQ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Pertanyaan</label>
                                                        <input type="text" name="pertanyaan" class="form-control" value="{{ $item->pertanyaan }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Jawaban</label>
                                                        <textarea name="jawaban" class="form-control" rows="4" required>{{ $item->jawaban }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Urutan Tampil</label>
                                                                <input type="number" name="urutan" class="form-control" value="{{ $item->urutan }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold d-block">Status</label>
                                                                <div class="custom-control custom-switch mt-2">
                                                                    <input type="checkbox" class="custom-control-input" id="status_faq_{{ $item->id }}" name="status" value="1" {{ $item->status ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="status_faq_{{ $item->id }}">Tampilkan di Landing Page</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada pertanyaan FAQ. Silakan tambahkan pertanyaan baru.</td>
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

<!-- Modal Tambah FAQ -->
<div class="modal fade" id="modalTambahFaq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('operator.landing.faq.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus mr-2 text-primary"></i>Tambah Pertanyaan FAQ Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Pertanyaan</label>
                        <input type="text" name="pertanyaan" class="form-control" placeholder="Contoh: Kapan pendaftaran santri baru ditutup?" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Jawaban</label>
                        <textarea name="jawaban" class="form-control" rows="4" placeholder="Tuliskan jawaban yang ramah dan informatif..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor Urutan Tampil</label>
                                <input type="number" name="urutan" class="form-control" value="{{ $faqs->count() + 1 }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">Status</label>
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="status_new" name="status" value="1" checked>
                                    <label class="custom-control-label" for="status_new">Langsung Aktifkan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
