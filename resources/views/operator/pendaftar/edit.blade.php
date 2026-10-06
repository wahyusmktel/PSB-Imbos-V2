@extends('layouts.app_operator')

@section('title', 'Edit Pendaftar')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Detail Pendaftar {{ $akunPendaftar->nama_lengkap }}</h2>
                    <h5 class="text-white op-7 mb-2">Dibawah ini adalah menampilkan detail data dari pendaftar</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('operator.pendaftar.cetak', $akunPendaftar->id) }}" target="_blank"
                        class="btn btn-white btn-border btn-round mr-2"><i class="fas fa-print"></i> Cetak Formulir</a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-akunpendaftar-tab-nobd" data-toggle="pill"
                                    href="#pills-akunpendaftar-nobd" role="tab" aria-controls="pills-akunpendaftar-nobd"
                                    aria-selected="true"><i class="fas fa-user"></i> Akun Pendaftar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-datadiri-tab-nobd" data-toggle="pill"
                                    href="#pills-datadiri-nobd" role="tab" aria-controls="pills-datadiri-nobd"
                                    aria-selected="false"><i class="fas fa-id-card"></i> Data Diri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-alamat-tab-nobd" data-toggle="pill" href="#pills-alamat-nobd"
                                    role="tab" aria-controls="pills-alamat-nobd" aria-selected="false"><i
                                        class="fas fa-map-marker-alt"></i> Alamat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-orangtua-tab-nobd" data-toggle="pill"
                                    href="#pills-orangtua-nobd" role="tab" aria-controls="pills-orangtua-nobd"
                                    aria-selected="false"><i class="fas fa-users"></i> Orang Tua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-riwayatpenyakit-tab-nobd" data-toggle="pill"
                                    href="#pills-riwayatpenyakit-nobd" role="tab"
                                    aria-controls="pills-riwayatpenyakit-nobd" aria-selected="false"><i
                                        class="fas fa-heartbeat"></i> Riwayat Penyakit</a>
                            </li>
                            @if ($akunPendaftar->pendaftarJalur && optional($akunPendaftar->pendaftarJalur->jalur)->nama_jalur !== 'Jalur Reguler')
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-uploadberkas-tab-nobd" data-toggle="pill"
                                        href="#pills-uploadberkas-nobd" role="tab"
                                        aria-controls="pills-uploadberkas-nobd" aria-selected="false"><i
                                            class="fas fa-upload"></i> Upload Berkas</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" id="pills-jenjang-tab-nobd" data-toggle="pill"
                                    href="#pills-jenjang-nobd" role="tab" aria-controls="pills-jenjang-nobd"
                                    aria-selected="false"><i class="fas fa-graduation-cap"></i> Jenjang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-jalur-tab-nobd" data-toggle="pill" href="#pills-jalur-nobd"
                                    role="tab" aria-controls="pills-jalur-nobd" aria-selected="false"><i
                                        class="fas fa-route"></i> Jalur</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="pills-akunpendaftar-nobd" role="tabpanel"
                                aria-labelledby="pills-akunpendaftar-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui data akun pendaftar langsung dibawah ini.
                                </div>

                                @if ($errors->any())
                                    <br>
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('operator.pendaftar.update', $akunPendaftar->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="no_pendaftaran">No. Pendaftaran</label>
                                        <input type="text" class="form-control" id="no_pendaftaran"
                                            name="no_pendaftaran" value="{{ $akunPendaftar->no_pendaftaran }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                            value="{{ $akunPendaftar->nama_lengkap }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="number" class="form-control" id="nisn" name="nisn"
                                            value="{{ $akunPendaftar->nisn }}" required>
                                        <span><i>Saat merubah NISN pastikan pendaftar diberikan informasi untuk menggunakan
                                                NISN baru pada saat login</i></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="asal_sekolah">Asal Sekolah</label>
                                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                                            value="{{ $akunPendaftar->asal_sekolah }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp">No HP</label>
                                        <input type="number" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ $akunPendaftar->no_hp }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                                            Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-datadiri-nobd" role="tabpanel"
                                aria-labelledby="pills-datadiri-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui data diri pendaftar langsung dibawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateDatadiri', $akunPendaftar->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <duv class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" class="form-control" name="tempat_lahir"
                                                    value="{{ $akunPendaftar->biodataDiri->tempat_lahir ?? old('tempat_lahir') }}">
                                            </div>
                                            @error('tempat_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="form-group">
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tgl_lahir"
                                                    value="{{ $akunPendaftar->biodataDiri->tgl_lahir ?? old('tgl_lahir') }}">
                                            </div>
                                            @error('tgl_lahir')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control" name="jenis_kelamin">
                                                    <option value="L"
                                                        {{ isset($akunPendaftar->biodataDiri) && $akunPendaftar->biodataDiri->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="P"
                                                        {{ isset($akunPendaftar->biodataDiri) && $akunPendaftar->biodataDiri->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                            @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <!-- <div class="form-group">
                                                <div class="avatar avatar-xxl">
                                                    <img class="avatar-img rounded-circle" width="100" height="100"
                                                        src="{{ $akunPendaftar->biodataDiri && $akunPendaftar->biodataDiri->pas_photo ? asset('storage/' . $akunPendaftar->biodataDiri->pas_photo) : 'https://placehold.co/472x709' }}"
                                                        alt="preview" id="preview-image">
                                                </div><br><br>
                                                <label for="pas_photo">Pas Photo</label>
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
                                            </div> -->
                                        </div>
                                    </duv>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Data Diri</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-alamat-nobd" role="tabpanel"
                                aria-labelledby="pills-alamat-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui data alamat pendaftar langsung dibawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateAlamat', $akunPendaftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_tempat_tinggal">Alamat Lengkap</label>
                                                <input type="text" class="form-control" id="alamat_tempat_tinggal"
                                                    name="alamat_tempat_tinggal"
                                                    value="{{ $akunPendaftar->alamat->alamat_tempat_tinggal ?? '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="rt">RT</label>
                                                <input type="number" class="form-control" id="rt" name="rt"
                                                    value="{{ $akunPendaftar->alamat->rt ?? '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="rw">RW</label>
                                                <input type="number" class="form-control" id="rw" name="rw"
                                                    value="{{ $akunPendaftar->alamat->rw ?? '' }}">
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
                                            <div class="form-group">
                                                <label for="provinsi_id">Provinsi</label>
                                                <select name="provinsi_id" id="provinsi_id" class="form-control select2"
                                                    style="width: 100%" required>
                                                    <option value="">-- Pilih Provinsi --</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}"
                                                            {{ $akunPendaftar->alamat && $akunPendaftar->alamat->provinsi_id == $province->id ? 'selected' : '' }}>
                                                            {{ $province->name }}</option>
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
                                                    @if ($akunPendaftar->alamat && $kabupatens)
                                                        @foreach ($kabupatens as $kabupaten)
                                                            <option value="{{ $kabupaten->id }}"
                                                                {{ $akunPendaftar->alamat && $akunPendaftar->alamat->kabupaten_id == $kabupaten->id ? 'selected' : '' }}>
                                                                {{ $kabupaten->name }}</option>
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
                                                    @if ($akunPendaftar->alamat && $kecamatans)
                                                        @foreach ($kecamatans as $kecamatan)
                                                            <option value="{{ $kecamatan->id }}"
                                                                {{ $akunPendaftar->alamat && $akunPendaftar->alamat->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                                                                {{ $kecamatan->name }}</option>
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
                                                    @if ($akunPendaftar->alamat && $desas)
                                                        @foreach ($desas as $desa)
                                                            <option value="{{ $desa->id }}"
                                                                {{ $akunPendaftar->alamat && $akunPendaftar->alamat->desa_id == $desa->id ? 'selected' : '' }}>
                                                                {{ $desa->name }}</option>
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
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Alamat</button>
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

                            <div class="tab-pane fade" id="pills-orangtua-nobd" role="tabpanel"
                                aria-labelledby="pills-orangtua-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui data orang tua pendaftar langsung dibawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateOrangTua', $akunPendaftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4>Data Ayah</h4>
                                            </div>

                                            <div class="form-group">
                                                <label for="nama_ayah">Nama Ayah</label>
                                                <input type="text" name="nama_ayah" class="form-control"
                                                    value="{{ $akunPendaftar->biodataOrangTua->nama_ayah ?? old('nama_ayah') }}">
                                                @error('nama_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat_lengkap_ayah">Alamat Lengkap Ayah</label>
                                                <textarea name="alamat_lengkap_ayah" class="form-control" rows="4">{{ $akunPendaftar->biodataOrangTua->alamat_lengkap_ayah ?? old('alamat_lengkap_ayah') }}</textarea>
                                                @error('alamat_lengkap_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                <select name="pekerjaan_ayah" class="form-control">
                                                    <option value="">-- Pilih Pekerjaan Ayah --</option>
                                                    <option value="PNS"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'PNS' ? 'selected' : '' }}>
                                                        PNS</option>
                                                    <option value="Swasta"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'Swasta' ? 'selected' : '' }}>
                                                        Swasta</option>
                                                    <option value="Petani"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'Petani' ? 'selected' : '' }}>
                                                        Petani</option>
                                                    <option value="Wiraswasta"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'Wiraswasta' ? 'selected' : '' }}>
                                                        Wiraswasta</option>
                                                    <option value="Buruh"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'Buruh' ? 'selected' : '' }}>
                                                        Buruh</option>
                                                    <option value="Lainnya"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ayah) && $akunPendaftar->biodataOrangTua->pekerjaan_ayah == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                </select>
                                                @error('pekerjaan_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="telp_ayah">Telepon Ayah</label>
                                                <input type="number" name="telp_ayah" class="form-control"
                                                    value="{{ $akunPendaftar->biodataOrangTua->telp_ayah ?? old('telp_ayah') }}">
                                                @error('telp_ayah')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4>Data Ibu</h4>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_ibu">Nama Ibu</label>
                                                <input type="text" name="nama_ibu" class="form-control"
                                                    value="{{ $akunPendaftar->biodataOrangTua->nama_ibu ?? old('nama_ibu') }}">
                                                @error('nama_ibu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat_ibu">Alamat Lengkap Ibu</label>
                                                <textarea name="alamat_ibu" rows="4" class="form-control">{{ $akunPendaftar->biodataOrangTua->alamat_ibu ?? old('alamat_ibu') }}</textarea>
                                                @error('alamat_ibu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                                <select name="pekerjaan_ibu" class="form-control">
                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                    <option value="Ibu Rumah Tangga"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ibu) && $akunPendaftar->biodataOrangTua->pekerjaan_ibu == 'Ibu Rumah Tangga' ? 'selected' : '' }}>
                                                        Ibu Rumah Tangga</option>
                                                    <option value="PNS"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ibu) && $akunPendaftar->biodataOrangTua->pekerjaan_ibu == 'PNS' ? 'selected' : '' }}>
                                                        PNS</option>
                                                    <option value="Wiraswasta"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ibu) && $akunPendaftar->biodataOrangTua->pekerjaan_ibu == 'Wiraswasta' ? 'selected' : '' }}>
                                                        Wiraswasta</option>
                                                    <option value="Pegawai Swasta"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ibu) && $akunPendaftar->biodataOrangTua->pekerjaan_ibu == 'Pegawai Swasta' ? 'selected' : '' }}>
                                                        Pegawai Swasta</option>
                                                    <option value="Lainnya"
                                                        {{ isset($akunPendaftar->biodataOrangTua->pekerjaan_ibu) && $akunPendaftar->biodataOrangTua->pekerjaan_ibu == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                </select>
                                                @error('pekerjaan_ibu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="telp_ibu">No. Telp Ibu</label>
                                                <input type="number" name="telp_ibu" class="form-control"
                                                    value="{{ $akunPendaftar->biodataOrangTua->telp_ibu ?? old('telp_ibu') }}">
                                                @error('telp_ibu')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Orang Tua</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-riwayatpenyakit-nobd" role="tabpanel"
                                aria-labelledby="pills-riwayatpenyakit-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui data riwayat penyakit pendaftar langsung dibawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateRiwayatpenyakit', $akunPendaftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_penyakit">Nama Penyakit</label>
                                                <input type="text" name="nama_penyakit" id="nama_penyakit"
                                                    class="form-control"
                                                    value="{{ old('nama_penyakit', $akunPendaftar->pendaftarPenyakit->nama_penyakit ?? '') }}">
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
                                                    value="{{ old('sejak_kapan', $akunPendaftar->pendaftarPenyakit->sejak_kapan ?? '') }}">
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
                                                <select name="status_kesembuhan" id="status_kesembuhan"
                                                    class="form-control">
                                                    <option value="">-- Pilih Status Kesembuhan --</option>
                                                    <option value="Sudah"
                                                        {{ old('status_kesembuhan', $akunPendaftar->pendaftarPenyakit->status_kesembuhan ?? '') == 'Sudah' ? 'selected' : '' }}>
                                                        Sudah</option>
                                                    <option value="Belum"
                                                        {{ old('status_kesembuhan', $akunPendaftar->pendaftarPenyakit->status_kesembuhan ?? '') == 'Belum' ? 'selected' : '' }}>
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
                                                <input type="text" name="penanganan" id="penanganan"
                                                    class="form-control"
                                                    value="{{ old('penanganan', $akunPendaftar->pendaftarPenyakit->penanganan ?? '') }}">
                                                <small id="penanganan" class="form-text text-muted">Kosongkan jika tidak
                                                    ada.</small>
                                                @error('penanganan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Riwayat Penyakit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-uploadberkas-nobd" role="tabpanel"
                                aria-labelledby="pills-uploadberkas-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui atau mengunggah berkas pendaftar di bawah ini.
                                </div>
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
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#uploadModal{{ $b->id }}">
                                                        {{ $b->uploaded ? 'Perbaharui Berkas' : 'Upload Berkas' }}
                                                    </button>

                                                    <!-- Modal Upload -->
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
                                                                        action="{{ route('operator.pendaftar.berkas.update', $akunPendaftar->id) }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="berkas_id"
                                                                            value="{{ $b->id }}">

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

                                                        <!-- Modal Preview -->
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

                            <div class="tab-pane fade" id="pills-jenjang-nobd" role="tabpanel"
                                aria-labelledby="pills-jenjang-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui jenjang pendidikan pendaftar di bawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateJenjang', $akunPendaftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="jenjang">Pilih Jenjang</label>
                                        <select class="form-control" id="jenjang" name="jenjang_id">
                                            @foreach ($jenjangs as $jenjang)
                                                <option value="{{ $jenjang->id }}"
                                                    {{ isset($akunPendaftar->pendaftarJenjang) && $akunPendaftar->pendaftarJenjang->jenjang_id == $jenjang->id ? 'selected' : '' }}>
                                                    {{ $jenjang->tingkat_jenjang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Jenjang</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="pills-jalur-nobd" role="tabpanel"
                                aria-labelledby="pills-jalur-tab-nobd">
                                <div class="card-sub">
                                    Anda dapat memperbaharui jalur pendaftar di bawah ini.
                                </div>
                                <form action="{{ route('operator.pendaftar.updateJalur', $akunPendaftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="jalur">Pilih Jalur</label>
                                        <select class="form-control" id="jalur" name="jalur_id">
                                            @foreach ($jalurs as $jalur)
                                                <option value="{{ $jalur->id }}"
                                                    {{ isset($akunPendaftar->pendaftarJalur) && $akunPendaftar->pendaftarJalur->jalur_id == $jalur->id ? 'selected' : '' }}>
                                                    {{ $jalur->nama_jalur }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update
                                            Jalur</button>
                                    </div>
                                </form>
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
