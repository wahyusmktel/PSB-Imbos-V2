@extends('layouts.app')

@section('title', 'Pilih Jalur')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Pilih Jalur Pendaftaran</h2>
                    <h5 class="text-white op-7 mb-2">Pilihlah jalur seleksi yang ingin anda ikuti, tersedia berbagai jalur
                        pendaftaran yang dapat anda pilih sesuai keinginan.</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row row-projects">
            @foreach ($jalurs as $jalur)
                <div class="col-xs-4 col-sm-4 col-lg-4">
                    <div class="card" style="height: 280px; position: relative;">
                        {{-- <div class="p-2">
                    <img class="card-img-top rounded" src="{{ asset('storage/' . $jalur->photo_cover) }}" alt="{{ $jalur->nama_jalur }}">
                </div> --}}
                        <div class="card-header">
                            <h4 class="mb-1 fw-bold text-center">{{ $jalur->nama_jalur }}</h4>
                        </div>
                        <div class="card-body pt-2">
                            <p class="text-muted small mb-2">{{ $jalur->deskripsi_jalur }}</p>
                            <div class="avatar-group" style="position: absolute; bottom: 15px; left: 20px; right: 20px;">
                                @if ($selectedJalur && $selectedJalur->jalur_id == $jalur->id)
                                    <button class="btn btn-success btn-rounded w-100" disabled>Sudah Dipilih</button>
                                @else
                                    <button class="btn btn-primary btn-rounded w-100 pilih-jalur"
                                        data-id="{{ $jalur->id }}">Pilih</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal konfirmasi perubahan jalur -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Perubahan Jalur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengganti jalur yang telah dipilih?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="updateJalurForm" method="POST" action="{{ route('pendaftar.jalur.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jalur_id" id="jalurIdInput">
                        <button type="submit" class="btn btn-danger">Ganti Jalur</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.pilih-jalur').forEach(button => {
            button.addEventListener('click', function() {
                let jalurId = this.getAttribute('data-id');

                @if ($selectedJalur)
                    // Jika sudah ada jalur yang dipilih, tampilkan modal konfirmasi
                    $('#jalurIdInput').val(jalurId);
                    $('#confirmModal').modal('show');
                @else
                    // Jika belum ada jalur, langsung submit
                    document.getElementById('jalurIdInput').value = jalurId;
                    document.getElementById('updateJalurForm').submit();
                @endif
            });
        });
    </script>

@endsection
