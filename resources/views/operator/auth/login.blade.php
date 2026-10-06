<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login Operator &amp; Super Admin | {{ $configPpdb->nama_sekolah ?? 'IMBOS Pringsewu' }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('theme/images/favicon.png') }}" type="image/x-icon" />

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        :root {
            --brand-primary: #ea580c;
            --brand-primary-dark: #c2410c;
            --brand-accent: #f97316;
            --brand-amber: #f59e0b;
            --brand-light: #fff7ed;
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
            background-color: #0c0a09;
            color: var(--text-dark);
            overflow-x: hidden;
            position: relative;
        }

        /* ==========================================================================
           FULL-PAGE GLASSMORPHISM CANVAS (DOMINAN WARM ORANGE)
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
                radial-gradient(at 0% 0%, #c2410c 0px, transparent 55%),
                radial-gradient(at 100% 0%, #7c2d12 0px, transparent 55%),
                radial-gradient(at 50% 50%, #ea580c 0px, transparent 65%),
                radial-gradient(at 100% 100%, #431407 0px, transparent 50%),
                radial-gradient(at 0% 100%, #1c1917 0px, transparent 50%),
                #0c0a09;
        }

        /* Subtle Islamic Abstract Watermark */
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

        /* Floating Warm Orange Aurora Gradient Glow Spheres */
        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(80px);
            opacity: 0.65;
            animation: orbFloat 10s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 440px;
            height: 440px;
            top: 5%;
            left: 5%;
            background: linear-gradient(135deg, #f97316, #fbbf24);
            animation-duration: 12s;
        }

        .orb-2 {
            width: 480px;
            height: 480px;
            bottom: 5%;
            right: 5%;
            background: linear-gradient(135deg, #ea580c, #f59e0b);
            animation-duration: 14s;
            animation-delay: -3s;
        }

        .orb-3 {
            width: 320px;
            height: 320px;
            top: 45%;
            left: 50%;
            background: linear-gradient(135deg, #c2410c, #ea580c);
            animation-duration: 9s;
            animation-delay: -5s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.08); }
            100% { transform: translate(-25px, 25px) scale(0.95); }
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
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
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
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(28px) saturate(190%);
            -webkit-backdrop-filter: blur(28px) saturate(190%);
            border: 1.5px solid rgba(255, 237, 213, 0.95);
            border-radius: 14px;
            box-shadow: 
                0 30px 60px -12px rgba(0, 0, 0, 0.45),
                0 0 0 1px rgba(251, 146, 60, 0.25) inset,
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
            background: #1c1917;
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

        /* Gradient Dark Overlay over Image with Warm Orange Tint */
        .auth-slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(28, 25, 23, 0.25) 0%, rgba(28, 25, 23, 0.5) 50%, rgba(12, 10, 9, 0.92) 100%);
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
            color: #fb923c;
            background: rgba(234, 88, 12, 0.22);
            border: 1px solid rgba(251, 146, 60, 0.45);
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
            margin-bottom: 8px;
            letter-spacing: -0.01em;
            color: #ffffff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        .auth-slide-desc {
            font-size: 0.82rem;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.82);
            margin-bottom: 16px;
        }

        /* Slider Indicators */
        .carousel-indicators {
            bottom: 14px;
            margin-bottom: 0;
            justify-content: flex-start;
            padding-left: 28px;
            margin-left: 0;
            margin-right: 0;
            z-index: 5;
        }

        .carousel-indicators li {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.45);
            border: none;
            margin-right: 6px;
            transition: all 0.3s ease;
        }

        .carousel-indicators li.active {
            width: 24px;
            border-radius: 4px;
            background-color: #f97316;
            box-shadow: 0 0 8px rgba(249, 115, 22, 0.6);
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
            background: rgba(255, 255, 255, 0.80);
        }

        /* Header & Identity */
        .glass-header {
            text-align: left;
            margin-bottom: 24px;
        }

        .glass-logo-badge {
            width: 62px;
            height: 62px;
            background: #ffffff;
            border-radius: 10px;
            padding: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 10px 24px -6px rgba(234, 88, 12, 0.25),
                0 0 0 1px rgba(254, 215, 170, 0.9);
            margin-bottom: 12px;
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

        .glass-badge-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #ea580c;
            background: rgba(234, 88, 12, 0.10);
            border: 1px solid rgba(251, 146, 60, 0.35);
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 8px;
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
            font-size: 0.86rem;
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
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.20);
        }

        .glass-input-wrapper:focus-within .glass-input-icon {
            color: #ea580c;
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
            color: #ea580c;
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
            user-select: none;
            font-weight: 600;
            margin-bottom: 0;
        }

        .glass-checkbox-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            accent-color: #ea580c;
            cursor: pointer;
        }

        /* Submit Button - Warm Orange Modern */
        .btn-glass-submit {
            width: 100%;
            background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #c2410c 100%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 
                0 8px 24px -4px rgba(234, 88, 12, 0.45),
                0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
        }

        .btn-glass-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 
                0 12px 30px -4px rgba(234, 88, 12, 0.60),
                0 4px 10px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #fb923c 0%, #ea580c 50%, #9a3412 100%);
            color: #ffffff;
        }

        .btn-glass-submit:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-glass-submit:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }

        /* Divider */
        .glass-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(203, 213, 225, 0.6), transparent);
            margin: 20px 0 16px 0;
        }

        /* Footer Links */
        .glass-footer-links {
            text-align: center;
            font-size: 0.82rem;
            color: #64748b;
        }

        .glass-footer-links a {
            color: #ea580c;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .glass-footer-links a:hover {
            color: #c2410c;
            text-decoration: underline;
        }

        /* Responsive Breakpoints */
        @media (max-width: 900px) {
            .glass-card-split {
                flex-direction: column;
                max-width: 480px;
            }

            .auth-slider-col {
                flex: 0 0 auto;
                max-width: 100%;
                min-height: 240px;
                max-height: 260px;
            }

            .auth-slider,
            .auth-slider .carousel-inner,
            .auth-slider .carousel-item {
                min-height: 240px;
                max-height: 260px;
            }

            .auth-slide-overlay {
                padding: 20px 22px;
            }

            .auth-slide-title {
                font-size: 1.15rem;
                margin-bottom: 4px;
            }

            .auth-slide-desc {
                display: none;
            }

            .auth-form-col {
                flex: 0 0 auto;
                max-width: 100%;
                padding: 28px 24px;
            }

            .btn-glass-back {
                top: 14px;
                left: 14px;
                padding: 6px 12px;
                font-size: 0.78rem;
            }
        }
    </style>
</head>
<body>

    <div class="glass-canvas">
        <!-- Floating Ambient Glow Spheres (Warm Orange/Amber Theme) -->
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>
        <div class="ambient-orb orb-3"></div>

        <!-- Subtle Islamic Watermark Texture -->
        <div class="glass-watermark-bg"></div>

        <!-- Tombol Kembali ke Landing Page -->
        <a href="/" class="btn-glass-back" title="Kembali ke Beranda Utama">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

        <!-- Main Split Glassmorphism Card -->
        <div class="glass-card-split">

            <!-- ===================================================================
                 LEFT COLUMN: IMAGE SLIDER (DYNAMIC CMS / RELEVANT FALLBACK)
                 =================================================================== -->
            <div class="auth-slider-col">
                <div id="authCarousel" class="carousel slide auth-slider" data-ride="carousel" data-interval="5000" data-pause="hover">
                    
                    @php
                        // Cek apakah ada sliders dari database
                        $activeSliders = (isset($sliders) && count($sliders) > 0) ? $sliders : collect([
                            (object)[
                                'image' => 'theme/images/hero-santri.png',
                                'pill_tag' => 'PANEL ADMINISTRASI',
                                'title' => 'Sistem Informasi PSB Terpadu',
                                'description' => 'Akses terpusat untuk verifikasi pendaftar, monitoring berkas, validasi pembayaran, dan seleksi santri.'
                            ],
                            (object)[
                                'image' => 'theme/images/jenjang-smpit-full.jpg',
                                'pill_tag' => 'KAMPUS PUTRA & PUTRI',
                                'title' => 'Insan Mulia Boarding School',
                                'description' => 'Mencetak generasi santri unggul berkarakter Qur\'ani, mandiri, dan berprestasi global.'
                            ],
                            (object)[
                                'image' => 'theme/images/jenjang-smait-full.jpg',
                                'pill_tag' => 'KONTROL DATABASE & CMS',
                                'title' => 'Pencadangan & Kustomisasi',
                                'description' => 'Kelola seluruh konten landing page secara dinamis serta fitur backup database SQL yang aman.'
                            ]
                        ]);
                    @endphp

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($activeSliders as $idx => $slide)
                            <li data-target="#authCarousel" data-slide-to="{{ $idx }}" class="{{ $idx === 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>

                    <!-- Slides Inner -->
                    <div class="carousel-inner">
                        @foreach($activeSliders as $idx => $slide)
                            <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                                <img src="{{ asset($slide->image) }}" class="d-block w-100 auth-slide-img" alt="{{ $slide->title }}">
                                <div class="auth-slide-overlay">
                                    @if(!empty($slide->pill_tag))
                                        <div class="auth-slide-pill">
                                            <i class="fas fa-circle" style="font-size: 6px;"></i> {{ $slide->pill_tag }}
                                        </div>
                                    @endif
                                    <h3 class="auth-slide-title">{{ $slide->title }}</h3>
                                    @if(!empty($slide->description))
                                        <p class="auth-slide-desc">{{ $slide->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ===================================================================
                 RIGHT COLUMN: FORM LOGIN OPERATOR & SUPER ADMIN
                 =================================================================== -->
            <div class="auth-form-col">
                <!-- Header Identitas -->
                <div class="glass-header">
                    <div class="glass-logo-badge">
                        <img src="{{ asset('theme/images/favicon.png') }}" alt="Logo IMBoS" onerror="this.onerror=null;this.src='{{ asset('img/logo.png') }}';">
                    </div>
                    <div>
                        <div class="glass-badge-admin">
                            <i class="fas fa-user-shield"></i> PORTAL OPERATOR &amp; SUPER ADMIN
                        </div>
                        <h2 class="glass-title">Masuk ke Dashboard</h2>
                        <p class="glass-subtitle">Masukkan username dan kata sandi untuk mengelola pendaftaran.</p>
                    </div>
                </div>

                <!-- Alert Validation Error -->
                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3 border-0 small" style="border-radius: 8px; background: rgba(239, 68, 68, 0.12); color: #b91c1c;">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form Login -->
                <form method="POST" action="{{ route('operator.login.post') }}" id="formLoginOperator">
                    @csrf

                    <!-- Field Username -->
                    <div class="glass-form-group">
                        <label for="username" class="glass-label">Username Pengguna</label>
                        <div class="glass-input-wrapper">
                            <i class="fas fa-user glass-input-icon"></i>
                            <input id="username" 
                                   name="username" 
                                   type="text" 
                                   class="glass-input" 
                                   placeholder="Masukkan username Anda (misal: admin)" 
                                   value="{{ old('username') }}" 
                                   required 
                                   autocomplete="username" 
                                   autofocus>
                        </div>
                    </div>

                    <!-- Field Password -->
                    <div class="glass-form-group">
                        <label for="password" class="glass-label">Kata Sandi</label>
                        <div class="glass-input-wrapper">
                            <i class="fas fa-lock glass-input-icon"></i>
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   class="glass-input" 
                                   placeholder="Masukkan kata sandi akun" 
                                   required 
                                   autocomplete="current-password">
                            <button type="button" class="btn-toggle-password" id="btnTogglePassword" aria-label="Lihat Password" title="Tampilkan/Sembunyikan Sandi">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="glass-remember">
                        <label class="glass-checkbox-label" for="rememberme">
                            <input type="checkbox" id="rememberme" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Ingat Sesi Masuk</span>
                        </label>
                        <span class="text-muted small">Akses Aman &amp; Terenkripsi</span>
                    </div>

                    <!-- Submit Button (Orange Vibrant) -->
                    <div class="form-action mb-2">
                        <button id="btnLogin" type="submit" class="btn-glass-submit">
                            <i class="fas fa-sign-in-alt"></i> Masuk ke Panel Kontrol
                        </button>
                    </div>
                </form>

                <div class="glass-divider"></div>

                <!-- Footer Links & Help Desk -->
                <div class="glass-footer-links">
                    <p class="mb-2 text-muted small">
                        Halaman ini khusus untuk panitia pendaftaran, operator, dan super administrator.
                    </p>

                    @if(!empty($configPpdb->no_wa_humas))
                        <div>
                            <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($configPpdb->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Panitia PSB, saya operator menemui kendala saat login panel.') }}" target="_blank" class="text-decoration-none small text-secondary">
                                <i class="fab fa-whatsapp text-success mr-1"></i> Bantuan Sistem? Hubungi WA IT Support
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
            $('#formLoginOperator').on('submit', function() {
                $('#btnLogin').attr('disabled', true);
                $('#btnLogin').html('<i class="fas fa-spinner fa-spin mr-2"></i> Memvalidasi Kredensial...');
            });
        });
    </script>
</body>
</html>
