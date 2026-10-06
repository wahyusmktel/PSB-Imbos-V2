@extends('layouts.app')

@section('title', 'Alamat Pendaftar')

@section('content')
    <style>
        .spinner-custom {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        @keyframes spinner-border {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container">
        <h3 class="text-center">Form Alamat Pendaftar</h3>

        <form method="POST"
            action="{{ $alamat ? route('pendaftar.alamat.update', $alamat->id) : route('pendaftar.alamat.store') }}">
            @csrf
            @if ($alamat)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="alamat_tempat_tinggal">Alamat Tempat Tinggal</label>
                <input type="text" name="alamat_tempat_tinggal" class="form-control"
                    value="{{ $alamat->alamat_tempat_tinggal ?? old('alamat_tempat_tinggal') }}">
            </div>

            <div class="form-group">
                <label for="provinsi_id">Provinsi</label>
                <select name="provinsi_id" id="provinsi_id" class="form-control select2" required>
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}"
                            {{ $alamat && $alamat->provinsi_id == $province->id ? 'selected' : '' }}>{{ $province->name }}
                        </option>
                    @endforeach
                </select>
                <!-- Spinner untuk Provinsi -->
                <div id="spinner-provinsi" class="spinner-border text-primary" role="status" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="form-group">
                <label for="kabupaten_id">Kabupaten/Kota</label>
                <select name="kabupaten_id" id="kabupaten_id" class="form-control select2" required>
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @if ($alamat && $kabupatens)
                        @foreach ($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id }}"
                                {{ $alamat && $alamat->kabupaten_id == $kabupaten->id ? 'selected' : '' }}>
                                {{ $kabupaten->name }}</option>
                        @endforeach
                    @endif
                </select>
                <!-- Spinner untuk Kabupaten -->
                <div id="spinner-kabupaten" class="spinner-border text-primary" role="status" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="form-group">
                <label for="kecamatan_id">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-control select2" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @if ($alamat && $kecamatans)
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}"
                                {{ $alamat && $alamat->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->name }}</option>
                        @endforeach
                    @endif
                </select>
                <!-- Spinner untuk Kecamatan -->
                <div id="spinner-kecamatan" class="spinner-border text-primary" role="status" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="form-group">
                <label for="desa_id">Desa/Kelurahan</label>
                <select name="desa_id" id="desa_id" class="form-control select2" required>
                    <option value="">-- Pilih Desa/Kelurahan --</option>
                    @if ($alamat && $desas)
                        @foreach ($desas as $desa)
                            <option value="{{ $desa->id }}"
                                {{ $alamat && $alamat->desa_id == $desa->id ? 'selected' : '' }}>{{ $desa->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <!-- Spinner untuk Desa -->
                <div id="spinner-desa" class="spinner-border text-primary" role="status" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="form-group">
                <label for="rt">RT</label>
                <input type="text" name="rt" class="form-control" value="{{ $alamat->rt ?? old('rt') }}">
            </div>

            <div class="form-group">
                <label for="rw">RW</label>
                <input type="text" name="rw" class="form-control" value="{{ $alamat->rw ?? old('rw') }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            function updateOptions(element, data, placeholder) {
                element.empty();
                element.append('<option value="">' + placeholder + '</option>');
                $.each(data, function(key, value) {
                    element.append('<option value="' + key + '">' + value + '</option>');
                });
            }

            // Show/Hide spinner
            function toggleSpinner(spinnerId, show) {
                if (show) {
                    $(spinnerId).show();
                } else {
                    $(spinnerId).hide();
                }
            }

            // Load Kabupaten when Provinsi is selected
            $('#provinsi_id').on('change', function() {
                var provinsi_id = $(this).val();
                if (provinsi_id) {
                    toggleSpinner('#spinner-kabupaten', true); // Show spinner
                    $.ajax({
                        url: '/get-kabupaten/' + provinsi_id,
                        type: 'GET',
                        success: function(res) {
                            updateOptions($('#kabupaten_id'), res, 'Silahkan pilih kabupaten');
                            $('#kecamatan_id').empty().append(
                                '<option value="">Silahkan pilih kecamatan</option>');
                            $('#desa_id').empty().append(
                                '<option value="">Silahkan pilih desa</option>');
                            toggleSpinner('#spinner-kabupaten', false); // Hide spinner
                        },
                        error: function() {
                            toggleSpinner('#spinner-kabupaten', false); // Hide spinner on error
                        }
                    });
                }
            });

            // Load Kecamatan when Kabupaten is selected
            $('#kabupaten_id').on('change', function() {
                var kabupaten_id = $(this).val();
                if (kabupaten_id) {
                    toggleSpinner('#spinner-kecamatan', true); // Show spinner
                    $.ajax({
                        url: '/get-kecamatan/' + kabupaten_id,
                        type: 'GET',
                        success: function(res) {
                            updateOptions($('#kecamatan_id'), res, 'Silahkan pilih kecamatan');
                            $('#desa_id').empty().append(
                                '<option value="">Silahkan pilih desa</option>');
                            toggleSpinner('#spinner-kecamatan', false); // Hide spinner
                        },
                        error: function() {
                            toggleSpinner('#spinner-kecamatan', false); // Hide spinner on error
                        }
                    });
                }
            });

            // Load Desa when Kecamatan is selected
            $('#kecamatan_id').on('change', function() {
                var kecamatan_id = $(this).val();
                if (kecamatan_id) {
                    toggleSpinner('#spinner-desa', true); // Show spinner
                    $.ajax({
                        url: '/get-desa/' + kecamatan_id,
                        type: 'GET',
                        success: function(res) {
                            updateOptions($('#desa_id'), res, 'Silahkan pilih desa');
                            toggleSpinner('#spinner-desa', false); // Hide spinner
                        },
                        error: function() {
                            toggleSpinner('#spinner-desa', false); // Hide spinner on error
                        }
                    });
                }
            });
        });
    </script>
@endsection
