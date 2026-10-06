@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Formulir Pendaftaran</h2>
                <h5 class="text-white op-7 mb-2">Silahkan lengkapi formulir pendaftaran dibawah ini, semua isian data
                    harus di isi dengan lengkap dan benar !</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="/pendaftar/formulir/cetak" target="_blank" class="btn btn-white btn-border btn-round mr-2"><i
                        class="fas fa-print"></i> Cetak Formulir</a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills nav-info nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#data-diri"
                                role="tab" aria-controls="data-diri" aria-selected="true"><i
                                    class="fas fa-user"></i> Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#data-alamat"
                                role="tab" aria-controls="data-alamat" aria-selected="false"><i
                                    class="fas fa-map-marker-alt"></i> Data Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#data-orang-tua"
                                role="tab" aria-controls="data-orang-tua" aria-selected="false"><i
                                    class="fas fa-users"></i> Data Orang Tua</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#data-penyakit"
                                role="tab" aria-controls="data-penyakit" aria-selected="false"><i
                                    class="fas fa-heartbeat"></i> Riwayat Penyakit</a>
                        </li> -->
                        @unless (in_array($pendaftar_jalur->jalur->nama_jalur, ['Jalur Reguler', 'Jalur Alumni']))
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#kuesioner"
                                role="tab" aria-controls="kuesioner" aria-selected="false"><i
                                    class="fas fa-file-upload"></i> Upload Berkas</a>
                        </li>
                        @endunless
                        {{-- <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#berkas"
                                    role="tab" aria-controls="berkas" aria-selected="false"><i
                                        class="fas fa-file-upload"></i> Upload Berkas</a>
                            </li> --}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="data-diri" role="tabpanel"
                            aria-labelledby="pills-home-tab-nobd">
                            <form method="POST"
                                action="{{ isset($biodata) ? route('pendaftar.data_diri.update', $biodata->id) : route('pendaftar.data_diri.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if (isset($biodata))
                                @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat_asal_sekolah">NO. Pendaftaran</label>
                                            <input type="text" class="form-control" name="no_pendaftaran"
                                                value="{{ $akunPendaftar->no_pendaftaran }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat_asal_sekolah">Asal Sekolah</label>
                                            <input type="text" class="form-control" name="asal_sekolah"
                                                value="{{ $akunPendaftar->asal_sekolah }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat_asal_sekolah">NISN</label>
                                            <input type="text" class="form-control" name="nisn"
                                                value="{{ $akunPendaftar->nisn }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat_asal_sekolah">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap"
                                                value="{{ $akunPendaftar->nama_lengkap }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat_asal_sekolah">Nomor Handphone</label>
                                            <input type="text" class="form-control" name="no_hp"
                                                value="{{ $akunPendaftar->no_hp }}" disabled>
                                        </div>

                                        {{-- <div class="form-group">
                                                <label for="alamat_asal_sekolah">Alamat Asal Sekolah</label>
                                                <input type="text" class="form-control" name="alamat_asal_sekolah"
                                                    value="{{ $biodata->alamat_asal_sekolah ?? old('alamat_asal_sekolah') }}">
                                        @error('alamat_asal_sekolah')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    {{-- <div class="form-group">
                                                <label for="ukuran_baju">Ukuran Baju</label>
                                                <input type="text" class="form-control" name="ukuran_baju"
                                                    placeholder="M/L/XL/XXL/XXXL"
                                                    value="{{ $biodata->ukuran_baju ?? old('ukuran_baju') }}">
                                    @error('ukuran_baju')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                {{-- <div class="form-group">
                                                <label for="nik">NIK</label>
                                                <input type="text" class="form-control" name="nik"
                                                    value="{{ $biodata->nik ?? old('nik') }}">
                        </div>
                        @error('nik')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror --}}

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir"
                                value="{{ $biodata->tempat_lahir ?? old('tempat_lahir') }}">
                        </div>
                        @error('tempat_lahir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir"
                                value="{{ $biodata->tgl_lahir ?? old('tgl_lahir') }}">
                        </div>
                        @error('tgl_lahir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="L"
                                    {{ isset($biodata) && $biodata->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ isset($biodata) && $biodata->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        @error('jenis_kelamin')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <!-- Preview image -->
                            <div class="avatar avatar-xxl">
                                <img class="avatar-img rounded-circle" width="100" height="100"
                                    src="{{ $biodata && $biodata->pas_photo ? asset('storage/' . $biodata->pas_photo) : 'https://placehold.co/472x709' }}"
                                    alt="preview" id="preview-image">
                            </div><br><br>
                            <label for="pas_photo">Pas Photo</label>
                            <!-- File input -->
                            <input type="file" class="form-control" name="pas_photo"
                                id="pas_photo" onchange="previewImage()">

                            <div class="form-text text-muted">
                                Upload Foto yang diperbolehkan ukuran maksimun 5Mb<br>
                                <span style="color:red;">Menggunakan foto dengan pakaian rapih dan
                                    sopan</span>
                            </div>

                            @error('pas_photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                                                <label for="anak_ke">Anak Ke</label>
                                                <input type="number" class="form-control" name="anak_ke"
                                                    value="{{ $biodata->anak_ke ?? old('anak_ke') }}">
                        @error('anak_ke')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- <div class="form-group">
                                                <label for="jumlah_saudara">Jumlah Saudara</label>
                                                <input type="number" class="form-control" name="jumlah_saudara"
                                                    value="{{ $biodata->jumlah_saudara ?? old('jumlah_saudara') }}">
                    @error('jumlah_saudara')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                {{-- <div class="form-group">
                                                <label for="tinggi_badan">Tinggi Badan (cm)</label>
                                                <input type="number" class="form-control" name="tinggi_badan"
                                                    value="{{ $biodata->tinggi_badan ?? old('tinggi_badan') }}">
                @error('tinggi_badan')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            {{-- <div class="form-group">
                                                <label for="berat_badan">Berat Badan (kg)</label>
                                                <input type="number" class="form-control" name="berat_badan"
                                                    value="{{ $biodata->berat_badan ?? old('berat_badan') }}">
            @error('berat_badan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> --}}

        {{-- <div class="form-group">
                                                <label for="jumlah_saudara_tiri">Jumlah Saudara Tiri</label>
                                                <select class="form-control" name="jumlah_saudara_tiri">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}"
        {{ isset($biodata) && $biodata->jumlah_saudara_tiri == $i ? 'selected' : '' }}>
        {{ $i }}</option>
        @endfor
        </select>
        @error('jumlah_saudara_tiri')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> --}}

    {{-- <div class="form-group">
                                                <label for="jumlah_saudara_angkat">Jumlah Saudara Angkat</label>
                                                <select class="form-control" name="jumlah_saudara_angkat">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}"
    {{ isset($biodata) && $biodata->jumlah_saudara_angkat == $i ? 'selected' : '' }}>
    {{ $i }}</option>
    @endfor
    </select>
    @error('jumlah_saudara_angkat')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div> --}}

{{-- <div class="form-group">
                                                <label for="bahasa_sehari_hari">Bahasa Sehari-hari</label>
                                                <select class="form-control select2" name="bahasa_sehari_hari">
                                                    @php
                                                        $bahasaOptions = [
                                                            'Bahasa Indonesia',
                                                            'Bahasa Inggris',
                                                            'Bahasa Arab',
                                                            'Bahasa Jawa',
                                                            'Bahasa Sunda',
                                                            'Bahasa Batak',
                                                            'Bahasa Minangkabau',
                                                            'Bahasa Bali',
                                                            'Bahasa Bugis',
                                                            'Bahasa Madura',
                                                        ];
                                                    @endphp
                                                    <option value="" disabled selected>Pilih Bahasa</option>
                                                    @foreach ($bahasaOptions as $bahasa)
                                                        <option value="{{ $bahasa }}"
{{ isset($biodata->bahasa_sehari_hari) && $biodata->bahasa_sehari_hari == $bahasa ? 'selected' : '' }}>
{{ $bahasa }}
</option>
@endforeach
</select>
@error('bahasa_sehari_hari')
<span class="text-danger">{{ $message }}</span>
@enderror
</div> --}}

{{-- <div class="form-group">
                                                <label for="bakat_dan_prestasi">Bakat dan Prestasi</label>
                                                <textarea class="form-control" name="bakat_dan_prestasi" rows="3">{{ $biodata->bakat_dan_prestasi ?? old('bakat_dan_prestasi') }}</textarea>
@error('bakat_dan_prestasi')
<span class="text-danger">{{ $message }}</span>
@enderror
</div> --}}
</div>
</div>

<!-- Tambahkan form lainnya sesuai dengan field yang dibutuhkan -->

<div class="form-group">
    <button type="submit"
        class="btn btn-primary">{{ isset($biodata) ? 'Update Data Diri' : 'Simpan Data Diri' }}</button>
</div>
</form>
</div>
<div class="tab-pane fade" id="data-alamat" role="tabpanel"
    aria-labelledby="pills-profile-tab-nobd">

    <div class="row">
        <div class="col-md-6">
            <form method="POST"
                action="{{ $alamat ? route('pendaftar.alamat.update', $alamat->id) : route('pendaftar.alamat.store') }}">
                @csrf
                @if ($alamat)
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="alamat_tempat_tinggal">Alamat Tempat Tinggal</label>
                    <textarea name="alamat_tempat_tinggal" class="form-control" rows="4" required>{{ $alamat->alamat_tempat_tinggal ?? old('alamat_tempat_tinggal') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="rt">RT</label>
                    <input type="number" name="rt" class="form-control"
                        value="{{ $alamat->rt ?? old('rt') }}" required>
                </div>

                <div class="form-group">
                    <label for="rw">RW</label>
                    <input type="number" name="rw" class="form-control"
                        value="{{ $alamat->rw ?? old('rw') }}" required>
                </div>

        </div>
        <div class="col-md-6">
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
                <div class="form-group">
                    <label for="provinsi_id">Provinsi</label>
                    <select name="provinsi_id" id="provinsi_id" class="form-control select2"
                        style="width: 100%" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province->id }}"
                            {{ $alamat && $alamat->provinsi_id == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                        @endforeach
                    </select>
                    <!-- Spinner untuk Provinsi -->
                    <div id="spinner-provinsi" class="spinner-custom text-primary"
                        role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    @error('provinsi_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kabupaten_id">Kabupaten/Kota</label>
                    <select name="kabupaten_id" id="kabupaten_id"
                        class="form-control select2" style="width: 100%" required>
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                        @if ($alamat && $kabupatens)
                        @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}"
                            {{ $alamat && $alamat->kabupaten_id == $kabupaten->id ? 'selected' : '' }}>
                            {{ $kabupaten->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <!-- Spinner untuk Kabupaten -->
                    <div id="spinner-kabupaten" class="spinner-custom text-primary"
                        role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    @error('kabupaten_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kecamatan_id">Kecamatan</label>
                    <select name="kecamatan_id" id="kecamatan_id"
                        class="form-control select2" style="width: 100%" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        @if ($alamat && $kecamatans)
                        @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}"
                            {{ $alamat && $alamat->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <!-- Spinner untuk Kecamatan -->
                    <div id="spinner-kecamatan" class="spinner-custom text-primary"
                        role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    @error('kecamatan_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desa_id">Desa/Kelurahan</label>
                    <select name="desa_id" id="desa_id" class="form-control select2"
                        style="width: 100%" required>
                        <option value="">-- Pilih Desa/Kelurahan --</option>
                        @if ($alamat && $desas)
                        @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}"
                            {{ $alamat && $alamat->desa_id == $desa->id ? 'selected' : '' }}>
                            {{ $desa->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <!-- Spinner untuk Desa -->
                    <div id="spinner-desa" class="spinner-custom text-primary" role="status"
                        style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    @error('desa_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap"
            });

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
</div>
<div class="tab-pane fade" id="data-orang-tua" role="tabpanel"
    aria-labelledby="pills-contact-tab-nobd">
    <div class="row">
        <div class="col-md-6">
            <form method="POST"
                action="{{ $biodata_orang_tua ? route('pendaftar.orang_tua.update', $biodata_orang_tua->id) : route('pendaftar.orang_tua.store') }}">
                @csrf
                @if ($biodata_orang_tua)
                @method('PUT')
                @endif

                <div class="form-group">
                    <h4>Data Ayah</h4>
                </div>

                <div class="form-group">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input type="text" name="nama_ayah" class="form-control"
                        value="{{ $biodata_orang_tua->nama_ayah ?? old('nama_ayah') }}">
                    @error('nama_ayah')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- <div class="form-group">
                                                <label for="alamat_lengkap_ayah">Alamat Lengkap Ayah</label>
                                                <textarea name="alamat_lengkap_ayah" class="form-control" rows="4">{{ $biodata_orang_tua->alamat_lengkap_ayah ?? old('alamat_lengkap_ayah') }}</textarea>
                                                @error('alamat_lengkap_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                <select name="pekerjaan_ayah" class="form-control">
                                                    <option value="">-- Pilih Pekerjaan Ayah --</option>
                                                    <option value="PNS"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'PNS' ? 'selected' : '' }}>
                                                        PNS</option>
                                                    <option value="Swasta"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'Swasta' ? 'selected' : '' }}>
                                                        Swasta</option>
                                                    <option value="Petani"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'Petani' ? 'selected' : '' }}>
                                                        Petani</option>
                                                    <option value="Wiraswasta"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'Wiraswasta' ? 'selected' : '' }}>
                                                        Wiraswasta</option>
                                                    <option value="Buruh"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'Buruh' ? 'selected' : '' }}>
                                                        Buruh</option>
                                                    <option value="Lainnya"
                                                        {{ isset($biodata_orang_tua->pekerjaan_ayah) && $biodata_orang_tua->pekerjaan_ayah == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                </select>
                                                @error('pekerjaan_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="telp_ayah">Telepon Ayah</label>
                                                <input type="number" name="telp_ayah" class="form-control"
                                                    value="{{ $biodata_orang_tua->telp_ayah ?? old('telp_ayah') }}">
                                                @error('telp_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> -->

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h4>Data Ibu</h4>
            </div>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control"
                    value="{{ $biodata_orang_tua->nama_ibu ?? old('nama_ibu') }}">
                @error('nama_ibu')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="form-group">
                                            <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                                            <input type="text" name="tempat_lahir_ibu" class="form-control"
                                                value="{{ $biodata_orang_tua->tempat_lahir_ibu ?? old('tempat_lahir_ibu') }}">
            @error('tempat_lahir_ibu')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="agama_ibu">Agama Ibu</label>
            <select name="agama_ibu" class="form-control">
                <option value="">-- Pilih Agama --</option>
                <option value="Islam"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Islam' ? 'selected' : '' }}>
                    Islam</option>
                <option value="Kristen"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Kristen' ? 'selected' : '' }}>
                    Kristen</option>
                <option value="Katolik"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Katolik' ? 'selected' : '' }}>
                    Katolik</option>
                <option value="Hindu"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Hindu' ? 'selected' : '' }}>
                    Hindu</option>
                <option value="Buddha"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Buddha' ? 'selected' : '' }}>
                    Buddha</option>
                <option value="Konghucu"
                    {{ isset($biodata_orang_tua->agama_ibu) && $biodata_orang_tua->agama_ibu == 'Konghucu' ? 'selected' : '' }}>
                    Konghucu</option>
            </select>
            @error('agama_ibu')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tgl_lahir_ibu">Tanggal Lahir Ibu</label>
            <input type="date" name="tgl_lahir_ibu" class="form-control"
                value="{{ $biodata_orang_tua->tgl_lahir_ibu ?? old('tgl_lahir_ibu') }}">
            @error('tgl_lahir_ibu')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pendidikan_ibu">Pendidikan Terakhir Ibu</label>
            <select name="pendidikan_ibu" class="form-control">
                <option value="">-- Pilih Pendidikan Terakhir --</option>
                <option value="SD"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'SD' ? 'selected' : '' }}>
                    SD</option>
                <option value="SMP"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'SMP' ? 'selected' : '' }}>
                    SMP</option>
                <option value="SMA"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'SMA' ? 'selected' : '' }}>
                    SMA</option>
                <option value="D3"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'D3' ? 'selected' : '' }}>
                    D3</option>
                <option value="S1"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'S1' ? 'selected' : '' }}>
                    S1</option>
                <option value="S2"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'S2' ? 'selected' : '' }}>
                    S2</option>
                <option value="S3"
                    {{ isset($biodata_orang_tua->pendidikan_ibu) && $biodata_orang_tua->pendidikan_ibu == 'S3' ? 'selected' : '' }}>
                    S3</option>
            </select>
            @error('pendidikan_ibu')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="range_gaji_ibu">Range Gaji Ibu</label>
            <select name="range_gaji_ibu" class="form-control">
                <option value="">-- Pilih Range Gaji --</option>
                <option value="<1 Juta"
                    {{ isset($biodata_orang_tua->range_gaji_ibu) && $biodata_orang_tua->range_gaji_ibu == '<1 Juta' ? 'selected' : '' }}>
                    <1 Juta</option>
                <option value="1-3 Juta"
                    {{ isset($biodata_orang_tua->range_gaji_ibu) && $biodata_orang_tua->range_gaji_ibu == '1-3 Juta' ? 'selected' : '' }}>
                    1-3 Juta</option>
                <option value="3-5 Juta"
                    {{ isset($biodata_orang_tua->range_gaji_ibu) && $biodata_orang_tua->range_gaji_ibu == '3-5 Juta' ? 'selected' : '' }}>
                    3-5 Juta</option>
                <option value=">5 Juta"
                    {{ isset($biodata_orang_tua->range_gaji_ibu) && $biodata_orang_tua->range_gaji_ibu == '>5 Juta' ? 'selected' : '' }}>
                    >5 Juta</option>
            </select>
            @error('range_gaji_ibu')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> --}}

        <!-- <div class="form-group">
                                            <label for="alamat_ibu">Alamat Lengkap Ibu</label>
                                            <textarea name="alamat_ibu" rows="4" class="form-control">{{ $biodata_orang_tua->alamat_ibu ?? old('alamat_ibu') }}</textarea>
                                            @error('alamat_ibu')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                            <select name="pekerjaan_ibu" class="form-control">
                                                <option value="">-- Pilih Pekerjaan --</option>
                                                <option value="Ibu Rumah Tangga"
                                                    {{ isset($biodata_orang_tua->pekerjaan_ibu) && $biodata_orang_tua->pekerjaan_ibu == 'Ibu Rumah Tangga' ? 'selected' : '' }}>
                                                    Ibu Rumah Tangga</option>
                                                <option value="PNS"
                                                    {{ isset($biodata_orang_tua->pekerjaan_ibu) && $biodata_orang_tua->pekerjaan_ibu == 'PNS' ? 'selected' : '' }}>
                                                    PNS</option>
                                                <option value="Wiraswasta"
                                                    {{ isset($biodata_orang_tua->pekerjaan_ibu) && $biodata_orang_tua->pekerjaan_ibu == 'Wiraswasta' ? 'selected' : '' }}>
                                                    Wiraswasta</option>
                                                <option value="Pegawai Swasta"
                                                    {{ isset($biodata_orang_tua->pekerjaan_ibu) && $biodata_orang_tua->pekerjaan_ibu == 'Pegawai Swasta' ? 'selected' : '' }}>
                                                    Pegawai Swasta</option>
                                                <option value="Lainnya"
                                                    {{ isset($biodata_orang_tua->pekerjaan_ibu) && $biodata_orang_tua->pekerjaan_ibu == 'Lainnya' ? 'selected' : '' }}>
                                                    Lainnya</option>
                                            </select>
                                            @error('pekerjaan_ibu')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="telp_ibu">No. Telp Ibu</label>
                                            <input type="number" name="telp_ibu" class="form-control"
                                                value="{{ $biodata_orang_tua->telp_ibu ?? old('telp_ibu') }}">
                                            @error('telp_ibu')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> -->

        {{-- <div class="form-group">
                                            <label for="email_ibu">Email Ibu</label>
                                            <input type="email" name="email_ibu" class="form-control"
                                                value="{{ $biodata_orang_tua->email_ibu ?? old('email_ibu') }}">
        @error('email_ibu')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> --}}

</div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</div>

<div class="tab-pane fade" id="data-penyakit" role="tabpanel"
    aria-labelledby="pills-contact-tab-nobd">
    <div class="row">
        <div class="col-md-6">
            <form method="POST"
                action="{{ $riwayat_penyakit ? route('pendaftar.riwayat.penyakit.update', $riwayat_penyakit->id) : route('pendaftar.riwayat.penyakit.store') }}">
                @csrf
                @if ($riwayat_penyakit)
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama_penyakit">Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" id="nama_penyakit"
                        class="form-control"
                        value="{{ old('nama_penyakit', $riwayat_penyakit->nama_penyakit ?? '') }}">
                    <small id="nama_penyakit" class="form-text text-muted">Kosongkan jika
                        tidak ada.</small>
                    @error('nama_penyakit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sejak_kapan">Sejak Kapan</label>
                    <input type="date" name="sejak_kapan" id="sejak_kapan"
                        class="form-control"
                        value="{{ old('sejak_kapan', $riwayat_penyakit->sejak_kapan ?? '') }}">
                    <small id="sejak_kapan" class="form-text text-muted">Kosongkan jika tidak
                        ada.</small>
                    @error('sejak_kapan')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status_kesembuhan">Status Kesembuhan</label>
                <select name="status_kesembuhan" id="status_kesembuhan" class="form-control">
                    <option value="">-- Pilih Status Kesembuhan --</option>
                    <option value="Sudah"
                        {{ old('status_kesembuhan', $riwayat_penyakit->status_kesembuhan ?? '') == 'Sudah' ? 'selected' : '' }}>
                        Sudah</option>
                    <option value="Belum"
                        {{ old('status_kesembuhan', $riwayat_penyakit->status_kesembuhan ?? '') == 'Belum' ? 'selected' : '' }}>
                        Belum</option>
                </select>
                <small id="status_kesembuhan" class="form-text text-muted">Kosongkan jika
                    tidak ada.</small>
                @error('status_kesembuhan')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="penanganan">Penanganan</label>
                <input type="text" name="penanganan" id="penanganan" class="form-control"
                    value="{{ old('penanganan', $riwayat_penyakit->penanganan ?? '') }}">
                <small id="penanganan" class="form-text text-muted">Kosongkan jika tidak
                    ada.</small>
                @error('penanganan')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


        </div>
    </div>
    <div class="form-group">
        <button type="submit"
            class="btn btn-primary">{{ $riwayat_penyakit ? 'Update Data' : 'Simpan Data' }}</button>
        </form>
    </div>
</div>

<div class="tab-pane fade" id="kuesioner" role="tabpanel"
    aria-labelledby="pills-contact-tab-nobd">


    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Berkas</th>
                <th>Keterangan</th>
                <th>Format File</th>
                <th>Upload</th>
                <th>Preview</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berkas as $b)
            <tr>
                <td>{{ $b->nama_berkas }}</td>

                <td>{{ $b->deskripsi_berkas }}</td>

                <td>{{ $b->ekstensi_berkas }}</td>

                <!-- Upload Berkas -->
                <td>
                    <!-- Tombol untuk membuka modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#uploadModal{{ $b->id }}">
                        {{ $b->uploaded ? 'Perbaharui Berkas' : 'Upload Berkas' }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="uploadModal{{ $b->id }}"
                        tabindex="-1" role="dialog"
                        aria-labelledby="uploadModalLabel{{ $b->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="uploadModalLabel{{ $b->id }}">Upload
                                        Berkas</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST"
                                        action="{{ route('pendaftar.berkas.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="berkas_id"
                                            value="{{ $b->id }}">

                                        <!-- Input file -->
                                        <div class="form-group">
                                            <label for="file">Pilih Berkas</label>
                                            <input type="file" name="file"
                                                class="form-control" required>
                                            @error('file')
                                            <span
                                                class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit"
                                                class="btn btn-primary">{{ $b->uploaded ? 'Perbaharui Berkas' : 'Upload Berkas' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>


                <!-- Preview Berkas -->
                <td>
                    @if ($b->uploaded)
                    <button type="button" class="btn btn-info" data-toggle="modal"
                        data-target="#previewModal{{ $b->uploaded->id }}">
                        Lihat Berkas
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="previewModal{{ $b->uploaded->id }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $b->nama_berkas }}</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Preview file, PDF atau gambar -->
                                    @if (pathinfo($b->uploaded->file, PATHINFO_EXTENSION) == 'pdf')
                                    <embed
                                        src="{{ asset('storage/' . $b->uploaded->file) }}"
                                        type="application/pdf" width="100%"
                                        height="600px" />
                                    @else
                                    <img src="{{ asset('storage/' . $b->uploaded->file) }}"
                                        class="img-fluid" alt="Preview">
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


</div>

<div class="tab-pane fade" id="berkas" role="tabpanel"
    aria-labelledby="pills-contact-tab-nobd">
    <!-- Tabel Berkas yang harus di-upload -->

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- JavaScript to handle the image preview -->
<script>
    function previewImage() {
        const file = document.getElementById('pas_photo').files[0];
        const preview = document.getElementById('preview-image');

        const reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file); // Convert image file to base64 string
        } else {
            preview.src = 'http://placehold.it/100x100'; // Reset to placeholder if no file is selected
        }
    }
</script>

@endsection