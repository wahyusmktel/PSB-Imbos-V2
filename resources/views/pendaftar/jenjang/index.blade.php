@extends('layouts.app')

@section('title', 'Pilih Jenjang')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Pilih Jenjang Pendidikan</h2>
                    <h5 class="text-white op-7 mb-2">Silahkan pilih Jenjang Pendaftaran anda terlebih dahulu.</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row row-projects">
            @foreach ($jenjangs as $jenjang)
                <div class="col-sm-6 col-lg-6">
                    <div class="card" style="height: 550px; position: relative;">
                        <div class="p-2">
                            <img class="card-img-top rounded" src="{{ asset('storage/' . $jenjang->photo_cover) }}"
                                alt="{{ $jenjang->nama_jenjang }}">
                        </div>
                        <div class="card-body pt-2">
                            <h4 class="mb-1 fw-bold text-center">{{ $jenjang->nama_jenjang }}</h4>
                            <p class="text-muted small mb-2">{{ $jenjang->deskripsi_jenjang }}</p>
                            <div class="avatar-group" style="position: absolute; bottom: 15px; left: 20px; right: 20px;">
                                @if ($selectedJenjang && $selectedJenjang->jenjang_id == $jenjang->id)
                                    <button class="btn btn-success btn-rounded w-100" disabled>Sudah Dipilih</button>
                                @else
                                    <button class="btn btn-primary btn-rounded w-100 pilih-jenjang"
                                        data-id="{{ $jenjang->id }}">Pilih</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal konfirmasi perubahan jenjang -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Perubahan Jenjang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengganti jenjang yang telah dipilih?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="updateJenjangForm" method="POST" action="{{ route('pendaftar.jenjang.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jenjang_id" id="jenjangIdInput">
                        <button type="submit" class="btn btn-danger">Ganti Jenjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.pilih-jenjang').forEach(button => {
            button.addEventListener('click', function() {
                let jenjangId = this.getAttribute('data-id');
                // Set the selected jenjang_id into the hidden input
                $('#jenjangIdInput').val(jenjangId);

                @if ($selectedJenjang)
                    // Jika sudah ada jenjang yang dipilih, tampilkan modal konfirmasi
                    $('#confirmModal').modal('show');
                @else
                    // Jika belum ada jenjang yang dipilih, langsung submit form
                    document.getElementById('updateJenjangForm').submit();
                @endif
            });
        });
    </script>

@endsection

{{-- @extends('layouts.app')

@section('title', 'Pilih Jenjang')

@section('content')


@endsection --}}
