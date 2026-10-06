@extends('layouts.app')

@section('title', 'Hasil Seleksi')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Pengumuman Hasil Seleksi Santri Baru</h2>
                    <h5 class="text-white op-7 mb-2">Dibawah ini adalah halaman pengumuman hasil seleksi masuk santri baru
                        Insan Mulia Boarding School Pringsewu.</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Pengumuman Penerimaan Calon Santri Baru
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!empty($configPPDB) && $configPPDB->ppdb_pengumuman)
                            <div id="countdown-container" class="alert alert-info text-center">
                                <h4>Pengumuman akan tersedia dalam:</h4>
                                <h3 id="countdown"></h3>
                            </div>
                            <div id="hasil-seleksi-container" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_pendaftaran">No. Pendaftaran</label>
                                            <input class="form-control" type="text"
                                                value="{{ $akun_pendaftar->no_pendaftaran }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_pendaftaran">No. Pendaftaran</label>
                                            <input class="form-control" type="text" value="{{ $akun_pendaftar->nisn }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_pendaftaran">Tempat Lahir</label>
                                            <input class="form-control" type="text"
                                                value="{{ $biodata_diri->tempat_lahir }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_pendaftaran">Tanggal Lahir</label>
                                            <input class="form-control" type="text"
                                                value="{{ \Carbon\Carbon::parse($biodata_diri->tgl_lahir)->translatedFormat('d F Y') }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Informasi Hasil Seleksi -->
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            @if ($hasil_seleksi)
                                                <p><strong>Status Kelulusan:</strong>
                                                    {{-- @if ($hasil_seleksi->hasil_kelulusan == 1)
                                                <div class="badge badge-success">Lulus</div>
                                            @elseif ($hasil_seleksi->hasil_kelulusan == 2)
                                                <div class="badge badge-danger">Tidak Lulus</div>
                                            @elseif ($hasil_seleksi->hasil_kelulusan == 3)
                                                <div class="badge badge-warning">Cadangan</div>
                                            @else
                                                <div class="badge badge-info">Belum Ada Hasil</div>
                                            @endif --}}
                                                </p>
                                                <div class="alert alert-info">
                                                    Untuk melihat status kelulusan, silahkan unduh surat hasil seleksi
                                                    dengan
                                                    menekan tombol dibawah ini.
                                                </div>
                                                <a href="{{ route('pendaftar.hasil_seleksi.download') }}"
                                                    class="btn btn-primary"><i class="fas fa-print"></i> Download Surat
                                                    Hasil Seleksi</a>
                                            @else
                                                <div class="alert alert-warning">
                                                    Hasil seleksi belum tersedia. Silakan cek kembali nanti.
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <script>
                                // Ambil tanggal pengumuman dari database
                                var pengumumanDate = new Date("{{ $configPPDB->ppdb_pengumuman }}").getTime();
                                var countdownContainer = document.getElementById("countdown-container");
                                var hasilSeleksiContainer = document.getElementById("hasil-seleksi-container");

                                // Update countdown setiap detik
                                var countdownInterval = setInterval(function() {
                                    var now = new Date().getTime();
                                    var distance = pengumumanDate - now;

                                    if (distance > 0) {
                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        document.getElementById("countdown").innerHTML =
                                            days + " hari " + hours + " jam " + minutes + " menit " + seconds + " detik ";
                                    } else {
                                        clearInterval(countdownInterval);
                                        countdownContainer.style.display = "none"; // Sembunyikan countdown
                                        hasilSeleksiContainer.style.display = "block"; // Tampilkan hasil seleksi
                                    }
                                }, 1000);
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
