<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login Portal Santri Baru | {{ $configPpdb->nama_sekolah ?? 'IMBOS Pringsewu' }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('theme/images/favicon.png') }}" type="image/x-icon" />

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        :root {
            --brand-primary: #0f78c2;
            --brand-primary-dark: #0369a1;
            --brand-cyan: #38bdf8;
            --brand-accent: #0284c7;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background-color: #0b1329;
            color: var(--text-dark);
            overflow-x: hidden;
            position: relative;
        }

        /* ==========================================================================
           FULL-PAGE GLASSMORPHISM CANVAS & AMBIENT GLOW ORBS
           ========================================================================== */
        .glass-canvas {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 40px 16px;
            background: 
                radial-gradient(at 0% 0%, #0c4a6e 0px, transparent 55%),
                radial-gradient(at 100% 0%, #1e1b4b 0px, transparent 55%),
                radial-gradient(at 50% 50%, #0369a1 0px, transparent 65%),
                radial-gradient(at 100% 100%, #042f2e 0px, transparent 50%),
                radial-gradient(at 0% 100%, #0f172a 0px, transparent 50%),
                #070d1e;
        }

        /* Subtle Islamic Abstract Watermark in Background */
        .glass-watermark-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('theme/images/islamic-watermark-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.12;
            pointer-events: none;
            mix-blend-mode: screen;
        }

        /* Floating Aurora Gradient Glow Spheres */
        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(80px);
            opacity: 0.65;
            animation: orbFloat 10s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 420px;
            height: 420px;
            top: 5%;
            left: 5%;
            background: linear-gradient(135deg, #0284c7, #38bdf8);
            animation-duration: 12s;
        }

        .orb-2 {
            width: 460px;
            height: 460px;
            bottom: 5%;
            right: 5%;
            background: linear-gradient(135deg, #059669, #0284c7);
            animation-duration: 14s;
            animation-delay: -3s;
        }

        .orb-3 {
            width: 320px;
            height: 320px;
            top: 45%;
            left: 50%;
            background: linear-gradient(135deg, #6366f1, #0ea5e9);
            animation-duration: 9s;
            animation-delay: -5s;
        }

        @keyframes orbFloat {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            50% {
                transform: translate(30px, -40px) scale(1.08);
            }
            100% {
                transform: translate(-25px, 25px) scale(0.95);
            }
        }

        /* Back to Home Floating Button - Slightly boxy */
        .btn-glass-back {
            position: absolute;
            top: 24px;
            left: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 8px;
            color: #ffffff !important;
            font-size: 0.84rem;
            font-weight: 700;
            text-decoration: none !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            z-index: 20;
        }

        .btn-glass-back:hover {
            background: rgba(255, 255, 255, 0.24);
            border-color: rgba(255, 255, 255, 0.45);
            transform: translateX(-3px);
            color: #ffffff !important;
        }

        /* ==========================================================================
           MAIN SPLIT GLASSMORPHISM CARD (Slightly boxy border-radius: 14px)
           ========================================================================== */
        .glass-card-split {
            width: 100%;
            max-width: 960px;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(28px) saturate(190%);
            -webkit-backdrop-filter: blur(28px) saturate(190%);
            border: 1.5px solid rgba(255, 255, 255, 0.95);
            border-radius: 14px;
            box-shadow: 
                0 30px 60px -12px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.6) inset,
                0 1px 3px rgba(255, 255, 255, 0.8) inset;
            position: relative;
            z-index: 10;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            animation: glassFadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes glassFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.97);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ==========================================================================
           LEFT COLUMN: IMAGE SLIDER
           ========================================================================== */
        .auth-slider-col {
            flex: 0 0 44%;
            max-width: 44%;
            position: relative;
            overflow: hidden;
            background: #0f172a;
        }

        .auth-slider,
        .auth-slider .carousel-inner,
        .auth-slider .carousel-item {
            height: 100%;
            min-height: 540px;
        }

        .auth-slide-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transform: scale(1.02);
            transition: transform 6s ease;
        }

        .carousel-item.active .auth-slide-img {
            transform: scale(1.08);
        }

        /* Gradient Dark Overlay over Image */
        .auth-slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(7, 13, 30, 0.25) 0%, rgba(7, 13, 30, 0.45) 50%, rgba(7, 13, 30, 0.92) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 32px 28px;
            color: #ffffff;
            z-index: 2;
        }

        .auth-slide-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.70rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #38bdf8;
            background: rgba(14, 165, 233, 0.18);
            border: 1px solid rgba(56, 189, 248, 0.4);
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            align-self: flex-start;
            backdrop-filter: blur(8px);
        }

        .auth-slide-title {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.3;
            color: #ffffff;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        .auth-slide-desc {
            font-size: 0.85rem;
            color: #cbd5e1;
            line-height: 1.5;
            margin-bottom: 24px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        /* Carousel Indicators */
        .auth-slider .carousel-indicators {
            position: static;
            margin: 0;
            justify-content: flex-start;
            gap: 6px;
            z-index: 3;
        }

        .auth-slider .carousel-indicators li {
            width: 24px;
            height: 4px;
            border-radius: 2px;
            background-color: rgba(255, 255, 255, 0.4);
            border: none;
            margin: 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .auth-slider .carousel-indicators li.active {
            width: 38px;
            background-color: #38bdf8;
        }

        /* ==========================================================================
           RIGHT COLUMN: FORM CONTENT
           ========================================================================== */
        .auth-form-col {
            flex: 0 0 56%;
            max-width: 56%;
            padding: clamp(28px, 4vw, 40px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.75);
        }

        /* Header & Identity */
        .glass-header {
            text-align: left;
            margin-bottom: 24px;
        }

        .glass-logo-badge {
            width: 64px;
            height: 64px;
            background: #ffffff;
            border-radius: 10px;
            padding: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 10px 24px -6px rgba(15, 120, 194, 0.25),
                0 0 0 1px rgba(226, 232, 240, 0.9);
            margin-bottom: 14px;
            transition: transform 0.25s ease;
        }

        .glass-logo-badge:hover {
            transform: scale(1.05);
        }

        .glass-logo-badge img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .glass-title {
            font-size: 1.52rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .glass-subtitle {
            font-size: 0.88rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Form Controls - Slightly boxy (border-radius: 8px) */
        .glass-form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .glass-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        .glass-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .glass-input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 0.95rem;
            transition: color 0.25s ease;
            pointer-events: none;
            z-index: 2;
        }

        .glass-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px 14px 11px 42px;
            font-size: 0.92rem;
            font-weight: 600;
            color: #0f172a;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .glass-input:focus {
            background: #ffffff;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.16);
        }

        .glass-input-wrapper:focus-within .glass-input-icon {
            color: #0284c7;
        }

        .btn-toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            font-size: 0.92rem;
            transition: color 0.2s ease;
            outline: none !important;
            z-index: 3;
        }

        .btn-toggle-password:hover {
            color: #0284c7;
        }

        /* Checkbox Styling */
        .glass-remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 20px 0;
            font-size: 0.84rem;
            color: #475569;
        }

        .glass-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            margin-bottom: 0;
            font-weight: 600;
        }

        .glass-checkbox-label input {
            cursor: pointer;
            width: 15px;
            height: 15px;
            accent-color: #0f78c2;
            border-radius: 3px;
        }

        /* Main Submit Button - Slightly boxy (border-radius: 8px) */
        .btn-glass-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            color: #ffffff !important;
            border: none;
            border-radius: 8px;
            padding: 13px 20px;
            font-size: 0.96rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            box-shadow: 0 8px 20px -4px rgba(15, 120, 194, 0.42);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none !important;
        }

        .btn-glass-submit:hover:not(:disabled) {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -4px rgba(15, 120, 194, 0.52);
        }

        .btn-glass-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Divider & Footer */
        .glass-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 20px 0 16px 0;
        }

        .glass-footer-links {
            text-align: center;
            font-size: 0.86rem;
            color: #64748b;
        }

        .glass-action-link {
            color: #0f78c2;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .glass-action-link:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        .glass-wa-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 6px 14px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            color: #166534;
            font-size: 0.80rem;
            font-weight: 700;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        .glass-wa-badge:hover {
            background: #dcfce7;
            color: #15803d;
            transform: translateY(-1px);
        }

        /* ==========================================================================
           RESPONSIVE STYLES
           ========================================================================== */
        @media (max-width: 991px) {
            .glass-card-split {
                flex-direction: column;
                max-width: 520px;
            }

            .auth-slider-col {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .auth-slider,
            .auth-slider .carousel-inner,
            .auth-slider .carousel-item {
                min-height: 240px;
                height: 240px;
            }

            .auth-slide-title {
                font-size: 1.15rem;
            }

            .auth-slide-desc {
                display: none;
            }

            .auth-slide-overlay {
                padding: 20px;
            }

            .auth-form-col {
                flex: 0 0 100%;
                max-width: 100%;
                padding: 28px 22px;
            }
        }

        @media (max-width: 576px) {
            .btn-glass-back {
                top: 14px;
                left: 14px;
                padding: 6px 12px;
                font-size: 0.78rem;
            }

            .glass-canvas {
                padding: 60px 12px 20px 12px;
            }

            .glass-card-split {
                border-radius: 12px;
            }

            .glass-title {
                font-size: 1.35rem;
            }
        }
    </style>
</head>
<body>
    <div class="glass-canvas">
        <!-- Floating Back Button -->
        <a href="/" class="btn-glass-back">
            <i class="fas fa-arrow-left"></i> Beranda
        </a>

        <!-- Background Islamic Watermark & Ambient Blur Orbs -->
        <div class="glass-watermark-bg" aria-hidden="true"></div>
        <div class="ambient-orb orb-1" aria-hidden="true"></div>
        <div class="ambient-orb orb-2" aria-hidden="true"></div>
        <div class="ambient-orb orb-3" aria-hidden="true"></div>

        <!-- Main Split Glassmorphism Card -->
        <div class="glass-card-split">
            
            <!-- LEFT: IMAGE SLIDER -->
            <div class="auth-slider-col">
                <div id="authSlider" class="carousel slide carousel-fade auth-slider" data-ride="carousel" data-interval="4500">
                    <div class="carousel-inner">
                        @forelse($sliders ?? [] as $sIdx => $slide)
                        <div class="carousel-item {{ $sIdx === 0 ? 'active' : '' }}">
                            <img src="{{ asset($slide->image) }}" alt="{{ $slide->title ?? 'IMBOS' }}" class="auth-slide-img">
                            <div class="auth-slide-overlay">
                                @if(!empty($slide->pill_tag))
                                <span class="auth-slide-pill">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $slide->pill_tag }}
                                </span>
                                @endif
                                <h3 class="auth-slide-title">{{ $slide->title }}</h3>
                                <p class="auth-slide-desc">{{ $slide->description }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="carousel-item active">
                            <img src="{{ asset('theme/images/auth-slide-1.jpg') }}" alt="Kampus Pesantren IMBOS" class="auth-slide-img">
                            <div class="auth-slide-overlay">
                                <span class="auth-slide-pill">
                                    <i class="fas fa-mosque mr-1"></i> Kampus Representatif
                                </span>
                                <h3 class="auth-slide-title">Lingkungan Asri & Terpadu</h3>
                                <p class="auth-slide-desc">Fasilitas modern penunjang iklim belajar dan kenyamanan santri.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Slider Indicators -->
                    <ol class="carousel-indicators">
                        @if(!empty($sliders) && count($sliders) > 0)
                            @foreach($sliders as $sIdx => $slide)
                                <li data-target="#authSlider" data-slide-to="{{ $sIdx }}" class="{{ $sIdx === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        @else
                            <li data-target="#authSlider" data-slide-to="0" class="active"></li>
                            <li data-target="#authSlider" data-slide-to="1"></li>
                            <li data-target="#authSlider" data-slide-to="2"></li>
                        @endif
                    </ol>
                </div>
            </div>

            <!-- RIGHT: LOGIN FORM -->
            <div class="auth-form-col">
                <!-- Header Identity (PORTAL SANTRI BARU removed) -->
                <div class="glass-header">
                    <div class="glass-logo-badge">
                        <img src="{{ asset('theme/images/logo271.png') }}" alt="Logo {{ $configPpdb->nama_sekolah ?? 'IMBOS' }}">
                    </div>
                    <h1 class="glass-title">Masuk ke Akun</h1>
                    <p class="glass-subtitle">
                        Masukkan Nomor Pendaftaran dan NISN yang terdaftar untuk melanjutkan proses seleksi.
                    </p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('pendaftar.login') }}" id="formLoginPendaftar">
                    @csrf

                    <!-- Username / No Pendaftaran Field -->
                    <div class="glass-form-group">
                        <label for="username" class="glass-label">Nomor Pendaftaran</label>
                        <div class="glass-input-wrapper">
                            <i class="fas fa-id-card glass-input-icon"></i>
                            <input id="username" 
                                   name="username" 
                                   type="text" 
                                   class="glass-input" 
                                   placeholder="Contoh: PSB-2-IMBOS-001" 
                                   value="{{ old('username') }}" 
                                   required 
                                   autocomplete="username" 
                                   autofocus>
                        </div>
                    </div>

                    <!-- Password / NISN Field -->
                    <div class="glass-form-group">
                        <label for="password" class="glass-label">NISN (Nomor Induk Siswa Nasional)</label>
                        <div class="glass-input-wrapper">
                            <i class="fas fa-lock glass-input-icon"></i>
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   class="glass-input" 
                                   placeholder="Masukkan 10 digit NISN Anda" 
                                   required 
                                   autocomplete="current-password">
                            <button type="button" class="btn-toggle-password" id="btnTogglePassword" aria-label="Lihat Password" title="Tampilkan/Sembunyikan NISN">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="glass-remember">
                        <label class="glass-checkbox-label" for="rememberme">
                            <input type="checkbox" id="rememberme" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Ingat Saya</span>
                        </label>
                        <span class="text-muted small">Default Sandi: NISN</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-action mb-2">
                        <button id="btnLogin" type="submit" class="btn-glass-submit">
                            <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                        </button>
                    </div>
                </form>

                <div class="glass-divider"></div>

                <!-- Footer Links & Help Desk -->
                <div class="glass-footer-links">
                    <p class="mb-2">
                        Belum memiliki akun pendaftaran? 
                        <a href="/pendaftar/register" class="glass-action-link">Daftar Akun Baru <i class="fas fa-arrow-right ml-1"></i></a>
                    </p>

                    @if($configPpdb && $configPpdb->no_wa_humas)
                        <div>
                            <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($configPpdb->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Humas IMBOS, saya menemui kendala saat login pendaftaran.') }}" target="_blank" class="glass-wa-badge">
                                <i class="fab fa-whatsapp text-success"></i> Kendala Akun? Chat WA Humas
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Core Scripts -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

    <!-- SweetAlert Integration -->
    @include('sweetalert::alert')

    <script>
        $(document).ready(function() {
            // Password Visibility Toggle
            $('#btnTogglePassword').on('click', function() {
                var $pwd = $('#password');
                var $icon = $('#toggleIcon');
                if ($pwd.attr('type') === 'password') {
                    $pwd.attr('type', 'text');
                    $icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $pwd.attr('type', 'password');
                    $icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Handle Form Submit State to Prevent Double Clicks
            $('#formLoginPendaftar').on('submit', function() {
                $('#btnLogin').attr('disabled', true);
                $('#btnLogin').html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses Masuk...');
            });
        });
    </script>
</body>
</html>
