@extends('layouts.app')

@section('title', 'Upload Berkas')

@section('content')
<div class="container">
    <h3 class="text-center">Upload Berkas Pendaftaran</h3>

    <!-- Tabel Berkas yang harus di-upload -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Berkas</th>
                <th>Upload</th>
                <th>Preview</th>
            </tr>
        </thead>
        <tbody>
            @foreach($berkas as $b)
            <tr>
                <td>{{ $b->nama_berkas }}</td>
                
                <!-- Upload Berkas -->
                <td>
                    <form method="POST" action="{{ route('pendaftar.berkas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="berkas_id" value="{{ $b->id }}">
                        <input type="file" name="file" class="form-control mb-2" required>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary">
                            {{ $b->uploaded ? 'Perbaharui Berkas' : 'Upload Berkas' }}
                        </button>
                    </form>
                </td>

                <!-- Preview Berkas -->
                <td>
                    @if($b->uploaded)
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#previewModal{{ $b->uploaded->id }}">
                            Lihat Berkas
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="previewModal{{ $b->uploaded->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $b->nama_berkas }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Preview file, PDF atau gambar -->
                                        @if(pathinfo($b->uploaded->file, PATHINFO_EXTENSION) == 'pdf')
                                            <embed src="{{ asset('storage/' . $b->uploaded->file) }}" type="application/pdf" width="100%" height="600px" />
                                        @else
                                            <img src="{{ asset('storage/' . $b->uploaded->file) }}" class="img-fluid" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="text-muted">Belum ada berkas</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include JS untuk modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

@endsection
