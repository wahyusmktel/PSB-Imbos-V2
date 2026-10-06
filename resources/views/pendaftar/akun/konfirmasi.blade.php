<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Konfirmasi Pendaftaran</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset("assets/css/fonts.min.css") }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.css') }}">
</head>
<body class="login">
    <div class="wrapper wrapper-login">    
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-xs-6 col-lg-6">
                    <div class="card card-pricing">
                        <div class="card-header">
                            <h4 class="card-title">Konfirmasi Pendaftaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-sub">
                                Assalamualaikum, Wr, Wb {{ $akun->nama_lengkap }}, akun anda telah berhasil dibuat.
                                Silahkan login menggunakan Nomor Pendaftaran dan NISN dibawah ini. Anda dapat mendownload kartu akun pendaftaran dan disimpan untuk keperluan login selanjutnya dan klik tombol login untuk masuk ke tahap berikutnya.
                            </div>
                            <ul class="specification-list">
                                <li>
                                    <span class="name-specification">No Pendaftaran</span>
                                    <span class="status-specification">{{ $akun->no_pendaftaran }}</span>
                                </li>
                                <li>
                                    <span class="name-specification">Nama Lengkap</span>
                                    <span class="status-specification">{{ $akun->nama_lengkap }}</span>
                                </li>
                                <li>
                                    <span class="name-specification">NISN</span>
                                    <span class="status-specification">{{ $akun->nisn }}</span>
                                </li>
                                <li>
                                    <span class="name-specification">Asal Sekolah</span>
                                    <span class="status-specification">{{ $akun->asal_sekolah }}</span>
                                </li>
                                <li>
                                    <span class="name-specification">No HP</span>
                                    <span class="status-specification">{{ $akun->no_hp }}</span>
                                </li>
                                {{-- <li>
                                    <span class="name-specification">Username</span>
                                    <span class="status-specification">{{ $akun->username }}</span>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('pendaftar.download.kartu', $akun->id) }}" class="btn btn-secondary btn-block"><b>Download Kartu Akun</b></a>
                            <form method="POST" action="{{ route('pendaftar.autologin') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $akun->id }}">
                                <button type="submit" class="btn btn-dark btn-block mt-2"><b>Login</b></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/atlantis.min.js') }}"></script>
</body>
</html>
