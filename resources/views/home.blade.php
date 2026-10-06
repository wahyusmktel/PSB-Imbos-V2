<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Penerimaan Santri Baru Online {{ $config->nama_sekolah ?? 'SMPIT & SMAIT Insan Mulia Boarding School' }}">
    <meta name="author" content="IMBOS Pringsewu">
    <title>PSB Online {{ $config->tahun_ajaran ?? '2026/2027' }} - {{ $config->nama_sekolah ?? 'Insan Mulia Boarding School' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans, Amiri for Quranic verses, and Lora for refined Latin calligraphy text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&family=Lora:ital,wght@1,400;1,500;1,600&display=swap" rel="stylesheet">

    <!-- CSS Dependencies -->
    <link href="{{ asset('theme/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/fontawesome-all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('theme/images/logo271.png') }}">

    <style>
        /* ========================================================
           DESIGN SYSTEM: SOFT EDUCATIONAL MODERN (ZERO BORDER RADIUS)
           Clean, Soft, Human-Centric, Elegant Architectural Lines
        ======================================================== */
        :root {
            --edu-primary: #0f78c2;         /* Primary Ocean Blue */
            --edu-primary-light: #e6f4fb;   /* Soft blue background */
            --edu-primary-hover: #0b5e98;
            --edu-secondary: #0f8ac2;       /* Bright Ocean Blue */
            --edu-secondary-light: #e0f2fe;
            --edu-accent: #FFD444;          /* Warm Sun Gold */
            --edu-accent-light: #fffbeb;
            --edu-dark: #1e293b;            /* Soft Charcoal / Slate 800 */
            --edu-body: #334155;            /* Slate 700 */
            --edu-muted: #64748b;           /* Slate 500 */
            --edu-bg: #f8fafc;              /* Soft Warm Canvas */
            --edu-card: #ffffff;
            --edu-border: #e2e8f0;          /* Soft Subtle Line */
            --edu-border-focus: #0f78c2;
            --soft-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.03);
            --soft-shadow-hover: 0 16px 32px -4px rgba(15, 120, 194, 0.15), 0 4px 12px -2px rgba(15, 23, 42, 0.06);
        }

        /* BASE GEOMETRY WITH SOFT REFINEMENT */
        .card, .form-control, .badge, .alert, .modal-content,
        .dropdown-menu, .input-group-text, .accordion .card-header, .accordion .card {
            border-radius: 0px;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--edu-body);
            background-color: var(--edu-bg);
            line-height: 1.7;
            overflow-x: clip;
            scroll-behavior: smooth;
        }

        .font-arabic {
            font-family: 'Amiri', serif;
            letter-spacing: 0;
            line-height: 2.2;
        }

        /* --- Top Bar Announcement with Running Text (Palette: #0f78c2, #0f8ac2, #FFD444) --- */
        .top-edu-bar {
            background: linear-gradient(90deg, #0f78c2 0%, #0f8ac2 100%);
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 0.86rem;
            padding: 7px 0;
            font-weight: 500;
        }

        .top-edu-bar a {
            color: #FFD444;
            text-decoration: underline;
            font-weight: 700;
        }

        .badge-informasi {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #FFD444;
            color: #0f2d48;
            padding: 4px 12px;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 6px;
            white-space: nowrap;
            box-shadow: none !important;
        }

        .marquee-text {
            color: #ffffff;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        /* --- Navbar (Frosted Glass Transparency on Scroll) --- */
        .navbar-edu {
            background-color: rgba(255, 255, 255, 0.98);
            border-bottom: 1px solid var(--edu-border);
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .navbar-edu.navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom-color: rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
            padding: 10px 0;
        }

        .navbar-brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--edu-dark);
        }

        .navbar-brand-logo img {
            height: 46px;
            margin-right: 14px;
        }

        .navbar-brand-title {
            font-weight: 800;
            font-size: 1.15rem;
            line-height: 1.2;
            color: var(--edu-dark);
            letter-spacing: -0.3px;
        }

        .navbar-brand-sub {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--edu-primary);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .nav-link-edu {
            font-weight: 600;
            font-size: 0.90rem;
            color: var(--edu-body) !important;
            padding: 8px 12px !important;
            margin: 0 2px;
            border: 1.5px solid transparent;
            border-radius: 6px !important;
            box-shadow: none !important;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            white-space: nowrap !important;
            transition: color 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
        }

        /* Shining light beam animation gliding from left to right on hover */
        .nav-link-edu::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 80%;
            height: 100%;
            background: linear-gradient(
                105deg,
                transparent 20%,
                rgba(56, 189, 248, 0.35) 50%,
                rgba(255, 255, 255, 0.85) 60%,
                transparent 80%
            );
            transform: skewX(-25deg);
            pointer-events: none;
            z-index: 2;
        }

        .nav-link-edu:hover {
            color: #0f78c2 !important;
            background-color: #f0f9ff;
            border-color: #0f8ac2;
            box-shadow: none !important;
            transform: none;
        }

        .nav-link-edu:hover::before {
            left: 170%;
            transition: left 0.65s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* --- Soft Educational Buttons --- */
        .btn-edu {
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.3px;
            padding: 8px 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 1.5px solid transparent;
            border-radius: 6px !important;
            cursor: pointer;
            text-decoration: none !important;
            position: relative;
            overflow: hidden;
            white-space: nowrap !important;
            box-shadow: none !important;
            transition: all 0.25s ease;
        }

        .btn-edu-primary {
            background-color: var(--edu-primary);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
        }

        .btn-edu-primary:hover {
            background-color: var(--edu-primary-hover);
            border: none !important;
            box-shadow: none !important;
            color: #ffffff !important;
        }

        .btn-edu-secondary {
            background-color: var(--edu-secondary);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
        }

        .btn-edu-secondary:hover {
            background-color: #0c6a96;
            border: none !important;
            box-shadow: none !important;
            color: #ffffff !important;
        }

        /* Tombol Masuk Outline dengan Efek Mengkilap Tanpa Shadow */
        .btn-edu-outline {
            background-color: #ffffff;
            color: var(--edu-dark) !important;
            border: 1.5px solid #cbd5e1;
            box-shadow: none !important;
        }

        .btn-edu-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 80%;
            height: 100%;
            background: linear-gradient(
                105deg,
                transparent 20%,
                rgba(15, 138, 194, 0.3) 50%,
                rgba(255, 255, 255, 0.8) 60%,
                transparent 80%
            );
            transform: skewX(-25deg);
            pointer-events: none;
            z-index: 2;
        }

        .btn-edu-outline:hover {
            background-color: #f0f9ff;
            color: #0f78c2 !important;
            border-color: #0f8ac2;
            box-shadow: none !important;
            transform: none;
        }

        .btn-edu-outline:hover::before {
            left: 170%;
            transition: left 0.65s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Tombol Daftar Fresh: Background Palette #0f8ac2 - #0f78c2, TANPA COLOR BORDER */
        .btn-edu-lightblue {
            background: linear-gradient(135deg, #0f8ac2 0%, #0f78c2 100%);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
        }

        .btn-edu-lightblue::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 80%;
            height: 100%;
            background: linear-gradient(
                105deg,
                transparent 20%,
                rgba(255, 212, 68, 0.35) 45%,
                rgba(255, 255, 255, 0.9) 60%,
                transparent 80%
            );
            transform: skewX(-25deg);
            pointer-events: none;
            z-index: 2;
        }

        .btn-edu-lightblue:hover {
            background: linear-gradient(135deg, #0b71a0 0%, #0c629f 100%);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
            transform: none;
        }

        .btn-edu-lightblue:hover::before {
            left: 170%;
            transition: left 0.65s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Tombol Hubungi Kami Dark Gray */
        .btn-edu-darkgray {
            background: linear-gradient(135deg, #475569 0%, #1e293b 100%);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
        }

        .btn-edu-darkgray::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 80%;
            height: 100%;
            background: linear-gradient(
                105deg,
                transparent 20%,
                rgba(255, 255, 255, 0.25) 50%,
                rgba(255, 255, 255, 0.7) 60%,
                transparent 80%
            );
            transform: skewX(-25deg);
            pointer-events: none;
            z-index: 2;
        }

        .btn-edu-darkgray:hover {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
            transform: none;
        }

        .btn-edu-darkgray:hover::before {
            left: 170%;
            transition: left 0.65s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-edu-accent {
            background-color: var(--edu-accent);
            color: #ffffff !important;
            border-color: var(--edu-accent);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
        }

        .btn-edu-accent:hover {
            background-color: #b45309;
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        .btn-edu-lg {
            padding: 13px 26px;
            font-size: 0.95rem;
        }

        /* --- Section Titles & Badges --- */
        .section-tag-soft {
            display: inline-block;
            background-color: var(--edu-primary-light);
            color: var(--edu-primary);
            border: 1px solid rgba(13, 92, 70, 0.2);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 5px 14px;
            margin-bottom: 12px;
        }

        .section-title-edu {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--edu-dark);
            letter-spacing: -0.5px;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .section-subtitle-edu {
            font-size: 1.05rem;
            color: var(--edu-muted);
            max-width: 680px;
            margin: 0 auto;
        }

        /* --- Hero Section (Animated Shimmering Gradient with Fast Glitter & Abstract Glow) --- */
        .hero-edu {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                125deg,
                #f0f9ff 0%,
                #e0f2fe 20%,
                #fef9c3 40%,
                #e0f2fe 60%,
                #f0fdf4 80%,
                #f0f9ff 100%
            );
            background-size: 260% 260%;
            animation: gradientShift 4.2s ease-in-out infinite;
            border-bottom: 1px solid #bae6fd;
            padding: 55px 0 75px 0;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Fast Shimmering Light Sweep across hero */
        .hero-shimmer-sweep {
            position: absolute;
            top: 0;
            left: -150%;
            width: 130%;
            height: 100%;
            background: linear-gradient(
                115deg,
                transparent 30%,
                rgba(255, 255, 255, 0.45) 45%,
                rgba(255, 212, 68, 0.3) 50%,
                rgba(255, 255, 255, 0.55) 55%,
                transparent 70%
            );
            transform: skewX(-22deg);
            pointer-events: none;
            z-index: 1;
            animation: backgroundSweep 3.6s ease-in-out infinite;
        }

        @keyframes backgroundSweep {
            0% { left: -150%; opacity: 0; }
            15% { opacity: 0.9; }
            85% { opacity: 0.9; }
            100% { left: 160%; opacity: 0; }
        }

        /* Glittering sparkling light points */
        .hero-glitter-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            background: radial-gradient(circle at 18% 28%, rgba(255, 255, 255, 0.95) 0%, transparent 8%),
                        radial-gradient(circle at 78% 18%, rgba(255, 212, 68, 0.9) 0%, transparent 10%),
                        radial-gradient(circle at 62% 68%, rgba(56, 189, 248, 0.85) 0%, transparent 8%),
                        radial-gradient(circle at 32% 78%, rgba(255, 255, 255, 0.95) 0%, transparent 10%),
                        radial-gradient(circle at 48% 42%, rgba(255, 212, 68, 0.8) 0%, transparent 12%),
                        radial-gradient(circle at 88% 82%, rgba(56, 189, 248, 0.85) 0%, transparent 9%);
            filter: blur(6px);
            animation: sparkleFlicker 2s ease-in-out infinite alternate;
        }

        @keyframes sparkleFlicker {
            0% { opacity: 0.25; transform: scale(0.98); }
            50% { opacity: 0.95; transform: scale(1.03); }
            100% { opacity: 0.35; transform: scale(0.99); }
        }

        /* Abstract glowing light effects (Faster & Brighter) */
        .hero-glow-orb-1, .hero-glow-orb-2, .hero-glow-orb-3 {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(65px);
            z-index: 1;
        }

        .hero-glow-orb-1 {
            width: 440px;
            height: 440px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.5) 0%, rgba(15, 120, 194, 0.2) 60%, transparent 80%);
            top: -100px;
            right: -50px;
            animation: orbFloat1 4.5s ease-in-out infinite alternate;
        }

        .hero-glow-orb-2 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(255, 212, 68, 0.35) 0%, rgba(56, 189, 248, 0.2) 55%, transparent 75%);
            bottom: -70px;
            left: -50px;
            animation: orbFloat2 4.8s ease-in-out infinite alternate;
        }

        .hero-glow-orb-3 {
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.9) 0%, rgba(15, 138, 194, 0.25) 65%, transparent 80%);
            top: 40%;
            left: 45%;
            transform: translate(-50%, -50%);
            animation: orbPulse 3.2s ease-in-out infinite alternate;
        }

        @keyframes orbFloat1 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(25px, 25px) scale(1.1); }
            100% { transform: translate(-20px, 15px) scale(0.96); }
        }

        @keyframes orbFloat2 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-25px, -20px) scale(1.12); }
            100% { transform: translate(20px, -25px) scale(0.94); }
        }

        @keyframes orbPulse {
            0% { opacity: 0.4; transform: translate(-50%, -50%) scale(0.9); }
            100% { opacity: 0.85; transform: translate(-50%, -50%) scale(1.18); }
        }

        /* Twinkling Sparkle Stars (Gemerlip Cepat) */
        .hero-sparkle {
            position: absolute;
            color: #FFD444;
            font-size: 1.15rem;
            pointer-events: none;
            z-index: 2;
            filter: drop-shadow(0 0 8px rgba(255, 212, 68, 0.85));
            animation: starTwinkle 2.2s ease-in-out infinite alternate;
        }

        @keyframes starTwinkle {
            0% { transform: scale(0.3) rotate(0deg); opacity: 0.2; }
            50% { transform: scale(1.35) rotate(45deg); opacity: 1; }
            100% { transform: scale(0.5) rotate(90deg); opacity: 0.3; }
        }

        .hero-edu .container {
            position: relative;
            z-index: 2;
        }

        .hero-main-title {
            font-size: 2.45rem;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.5px;
            color: #1e293b;
        }

        /* Hero Quran Box: Semi-transparan dengan Frosted Glass Blur & outline seragam */
        .hero-quran-box {
            background: rgba(255, 255, 255, 0.45) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border: 1.5px solid rgba(186, 230, 253, 0.8) !important;
            border-radius: 8px !important;
            padding: 18px 22px;
            margin-bottom: 22px;
            box-shadow: 0 8px 24px rgba(15, 120, 194, 0.05) !important;
        }

        .hero-quran-arabic {
            font-size: 1.75rem;
            color: #0f78c2;
            line-height: 2.2;
            font-weight: 700;
            white-space: nowrap !important;
        }

        @media (max-width: 991px) {
            .hero-quran-arabic {
                font-size: 1.55rem;
                line-height: 2.1;
                white-space: nowrap !important;
            }
        }

        @media (max-width: 576px) {
            .hero-quran-box {
                padding: 12px 14px !important;
            }
            .hero-quran-arabic {
                font-size: clamp(0.90rem, 3.7vw, 1.25rem) !important;
                line-height: 1.9 !important;
                white-space: nowrap !important;
            }
        }

        .quran-latin-text {
            font-family: 'Lora', Georgia, 'Times New Roman', serif;
            font-style: italic;
            font-weight: 500;
            font-size: 0.96rem;
            color: #334155;
            line-height: 1.65;
            letter-spacing: 0.2px;
        }

        .hero-image-wrapper {
            position: relative;
            display: inline-block;
            max-width: 100%;
            text-align: center;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .hero-illustration {
            max-height: 520px;
            width: 100%;
            max-width: 520px;
            object-fit: contain;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            filter: drop-shadow(0 18px 35px rgba(15, 120, 194, 0.15));
            animation: gentleFloat 6s ease-in-out infinite alternate;
        }

        @keyframes gentleFloat {
            0% {
                transform: translateY(0px);
            }
            100% {
                transform: translateY(-8px);
            }
        }

        /* Hero Responsive Ordering (Mobile vs Desktop) */
        @media (min-width: 992px) {
            .hero-right-col {
                display: flex;
                flex-direction: column;
            }
            .hero-right-col .hero-quran-box {
                order: 1;
            }
            .hero-right-col .hero-image-container {
                order: 2;
            }
        }

        @media (max-width: 991px) {
            .hero-row {
                display: flex;
                flex-direction: column;
            }
            .hero-right-col {
                order: 1 !important;
                display: flex;
                flex-direction: column;
                margin-top: 0 !important;
                margin-bottom: 24px !important;
            }
            .hero-right-col .hero-image-container {
                order: 1 !important;
                margin-bottom: 16px;
            }
            .hero-right-col .hero-illustration {
                max-height: 290px !important;
                max-width: 290px !important;
            }
            .hero-right-col .hero-quran-box {
                order: 2 !important;
                margin-bottom: 0 !important;
            }
            .hero-left-col {
                order: 2 !important;
                margin-bottom: 8px !important;
            }
        }

        /* Feature Chips / Stats */
        .feature-chips-bar {
            background-color: #ffffff;
            border: 1px solid var(--edu-border);
            box-shadow: var(--soft-shadow);
            padding: 24px 20px;
            margin-top: -35px;
            position: relative;
            z-index: 20;
        }

        .chip-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px;
        }

        .chip-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background-color: var(--edu-primary-light);
            color: var(--edu-primary);
            border: 1px solid rgba(13, 92, 70, 0.15);
            flex-shrink: 0;
        }

        /* --- Card Styles (Soft Architecture) --- */
        .card-edu {
            background-color: #ffffff;
            border: 1px solid var(--edu-border);
            box-shadow: var(--soft-shadow);
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-edu:hover {
            transform: translateY(-4px);
            box-shadow: var(--soft-shadow-hover);
            border-color: #cbd5e1;
        }

        .card-edu-header {
            padding: 24px;
            border-bottom: 1px solid var(--edu-border);
            background-color: #ffffff;
        }

        .card-edu-body {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* --- Timeline UI (Alur Seleksi Penerimaan Santri) --- */
        .timeline-edu {
            position: relative;
            max-width: 1040px;
            margin: 30px auto 0 auto;
            padding: 20px 0;
        }

        /* Continuous Spine Line */
        .timeline-edu::before {
            content: '';
            position: absolute;
            top: 25px;
            bottom: 40px;
            left: 50%;
            width: 3px;
            background: linear-gradient(180deg, #bae6fd 0%, #0f8ac2 30%, #0f78c2 70%, #bae6fd 100%);
            transform: translateX(-50%);
            border-radius: 3px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 44px;
            display: flex;
            align-items: center;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row;
        }

        /* Center Circular Node */
        .timeline-node {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f8ac2 0%, #0f78c2 100%);
            border: 4px solid #ffffff;
            box-shadow: 0 4px 18px rgba(15, 120, 194, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            font-weight: 800;
            color: #ffffff;
            z-index: 3;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .timeline-item:hover .timeline-node {
            background: #FFD444;
            color: #1e293b;
            transform: translate(-50%, -50%) scale(1.12);
            box-shadow: 0 6px 24px rgba(255, 212, 68, 0.55);
        }

        /* Content Card */
        .timeline-card {
            width: calc(50% - 50px);
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 26px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .timeline-card:hover {
            transform: translateY(-4px);
            border-color: #0f8ac2;
            box-shadow: 0 14px 32px rgba(15, 120, 194, 0.14);
        }

        .timeline-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .timeline-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #f0f9ff;
            color: #0f78c2;
            border: 1px solid #bae6fd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            transition: all 0.25s ease;
        }

        .timeline-card:hover .timeline-icon-box {
            background: linear-gradient(135deg, #0f8ac2 0%, #0f78c2 100%);
            color: #ffffff;
            border-color: #0f8ac2;
            transform: scale(1.05);
        }

        .timeline-step-tag {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 11px;
            border-radius: 20px;
            background: #e0f2fe;
            color: #0369a1;
        }

        .timeline-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .timeline-card-desc {
            font-size: 0.88rem;
            color: #64748b;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* Desktop Pointing Arrow (Oriented Inward Toward Center Node) */
        @media (min-width: 768px) {
            /* Odd Items: Card is on the RIGHT, arrow must be on the LEFT edge pointing LEFT toward center */
            .timeline-item:nth-child(odd) .timeline-card::after {
                content: '';
                position: absolute;
                left: -8px;
                top: 50%;
                transform: translateY(-50%) rotate(45deg);
                width: 14px;
                height: 14px;
                background: #ffffff;
                border-bottom: 1.5px solid #e2e8f0;
                border-left: 1.5px solid #e2e8f0;
                border-top: none;
                border-right: none;
                transition: border-color 0.3s ease;
            }
            .timeline-item:nth-child(odd):hover .timeline-card::after {
                border-bottom-color: #0f8ac2;
                border-left-color: #0f8ac2;
            }

            /* Even Items: Card is on the LEFT, arrow must be on the RIGHT edge pointing RIGHT toward center */
            .timeline-item:nth-child(even) .timeline-card::after {
                content: '';
                position: absolute;
                right: -8px;
                top: 50%;
                transform: translateY(-50%) rotate(45deg);
                width: 14px;
                height: 14px;
                background: #ffffff;
                border-top: 1.5px solid #e2e8f0;
                border-right: 1.5px solid #e2e8f0;
                border-bottom: none;
                border-left: none;
                transition: border-color 0.3s ease;
            }
            .timeline-item:nth-child(even):hover .timeline-card::after {
                border-top-color: #0f8ac2;
                border-right-color: #0f8ac2;
            }
        }

        /* Mobile Layout (< 768px) */
        @media (max-width: 767px) {
            .timeline-edu {
                padding-left: 0;
            }

            .timeline-edu::before {
                left: 22px;
                transform: none;
            }

            .timeline-item {
                flex-direction: row !important;
                margin-bottom: 28px;
                align-items: flex-start;
            }

            .timeline-node {
                left: 22px;
                top: 22px;
                transform: translate(-50%, 0);
                width: 44px;
                height: 44px;
                font-size: 0.95rem;
            }

            .timeline-item:hover .timeline-node {
                transform: translate(-50%, 0) scale(1.08);
            }

            .timeline-card {
                width: calc(100% - 58px);
                margin-left: 58px;
                padding: 20px 18px;
            }

            /* Mobile Arrow: Perfectly centered to the vertical midpoint of the circle node (y = 44px) */
            .timeline-card::after {
                content: '';
                position: absolute;
                left: -7px;
                top: 44px;
                transform: translateY(-50%) rotate(45deg);
                width: 12px;
                height: 12px;
                background: #ffffff;
                border-bottom: 1.5px solid #e2e8f0;
                border-left: 1.5px solid #e2e8f0;
                border-top: none;
                border-right: none;
                transition: border-color 0.3s ease;
            }

            .timeline-item:hover .timeline-card::after {
                border-bottom-color: #0f8ac2;
                border-left-color: #0f8ac2;
            }
        }

        /* --- Fullpage Edge-to-Edge Sticky Section with Vertical Scroll-Driven Slides --- */
        .jenjang-sticky-section {
            position: relative;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }

        /* Desktop Fullpage Presentation Layout */
        @media (min-width: 992px) {
            .jenjang-sticky-section {
                height: calc(100vh - 74px);
                min-height: 640px;
                display: flex;
                flex-direction: column;
            }

            .jenjang-sticky-viewport {
                position: relative;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                background: #ffffff;
            }

            .jenjang-sticky-header {
                padding: 16px 48px;
                border-bottom: 1px solid #f1f5f9;
                background: #ffffff;
                display: flex;
                align-items: center;
                justify-content: space-between;
                z-index: 10;
                flex-shrink: 0;
            }

            .jenjang-deck-stage {
                position: relative;
                width: 100%;
                flex-grow: 1;
                overflow: hidden;
            }

            .jenjang-slide-panel {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: row;
                opacity: 0;
                transform: translateX(40px);
                transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.4s;
                pointer-events: none;
                visibility: hidden;
            }

            .jenjang-slide-panel.active {
                opacity: 1;
                transform: translateX(0);
                pointer-events: auto;
                visibility: visible;
                z-index: 2;
            }

            .jenjang-slide-panel.is-past {
                opacity: 0;
                transform: translateX(-40px);
                pointer-events: none;
                visibility: hidden;
                z-index: 1;
            }

            .jenjang-full-media-side {
                width: 50%;
                height: 100%;
                position: relative;
                overflow: hidden;
                background: #0f172a;
                flex-shrink: 0;
            }

            .jenjang-full-content-side {
                width: 50%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: clamp(24px, 3.5vh, 40px) clamp(32px, 3.8vw, 54px);
                background: #ffffff;
                overflow: hidden;
            }
        }

        /* Mono Header & Rail Controls */
        .academic-mono-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #0369a1;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 4px 12px;
            border-radius: 6px;
            margin-bottom: 6px;
        }

        .academic-section-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 0;
        }

        .academic-section-title span {
            color: #0f78c2;
        }

        .jenjang-rail-nav {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 4px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
            gap: 4px;
        }

        .rail-step-btn {
            border: none;
            background: transparent;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            outline: none !important;
            user-select: none;
        }

        .rail-step-btn .rail-num {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-weight: 800;
            font-size: 0.78rem;
            padding: 2px 6px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.25s ease;
        }

        .rail-step-btn .rail-label {
            font-size: 0.86rem;
            font-weight: 700;
            color: #64748b;
            transition: all 0.25s ease;
        }

        .rail-step-btn:hover:not(.active) {
            background: #f8fafc;
        }

        .rail-step-btn.active {
            background: #0f78c2;
        }

        .rail-step-btn.active .rail-num {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        .rail-step-btn.active .rail-label {
            color: #ffffff;
        }

        /* Fullpage Media Styling */
        .jenjang-full-media-side {
            position: relative;
            overflow: hidden;
            background: #0f172a;
        }

        .jenjang-full-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .jenjang-slide-panel:hover .jenjang-full-img {
            transform: scale(1.03);
        }

        .jenjang-full-media-scrim {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.02) 0%, rgba(15, 23, 42, 0.25) 55%, rgba(15, 23, 42, 0.85) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 28px 36px;
            pointer-events: none;
        }

        .jenjang-media-title {
            color: #ffffff;
            font-size: 1.55rem;
            font-weight: 800;
            letter-spacing: -0.01em;
            margin-bottom: 4px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .jenjang-media-caption {
            color: #e2e8f0;
            font-size: 0.86rem;
            margin-bottom: 0;
            opacity: 0.95;
        }

        /* Fullpage Content Styling */
        .jenjang-full-title {
            font-size: clamp(1.35rem, 1.85vw, 1.75rem);
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.25;
            margin-bottom: 12px;
        }

        .jenjang-full-desc {
            font-size: clamp(0.86rem, 1.0vw, 0.94rem);
            color: #475569;
            line-height: 1.6;
            margin-bottom: 18px;
            max-width: 540px;
        }

        /* Educational Key Points */
        .jenjang-points-list {
            margin-bottom: 22px;
            max-width: 540px;
        }

        .jenjang-point-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            font-size: clamp(0.82rem, 0.92vw, 0.88rem);
            color: #334155;
            line-height: 1.45;
        }

        .jenjang-point-item:last-child {
            margin-bottom: 0;
        }

        .jenjang-point-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.74rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Single Action Button (Daftar Saja) */
        .btn-full-register {
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            color: #ffffff !important;
            font-size: 0.94rem;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            border: none;
            box-shadow: 0 6px 20px rgba(15, 120, 194, 0.28);
            transition: all 0.25s ease;
            text-decoration: none !important;
            width: fit-content;
        }

        .btn-full-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(15, 120, 194, 0.38);
            background: linear-gradient(135deg, #0d69ab 0%, #0277bd 100%);
        }

        .jenjang-btn-wrap {
            margin-top: 4px;
            display: flex;
            align-items: center;
        }

        /* Mobile & Tablet Adaptation */
        @media (max-width: 991.98px) {
            .jenjang-btn-wrap {
                margin-top: 14px;
                width: 100%;
            }
            .jenjang-sticky-section {
                padding: 2.5rem 0 3.5rem;
                height: auto;
                background: #f8fafc;
            }

            .jenjang-sticky-viewport {
                position: relative;
                height: auto;
            }

            .jenjang-sticky-header {
                padding: 0 20px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
                border-bottom: 1px solid #e2e8f0;
                margin-bottom: 24px;
            }

            .jenjang-rail-nav {
                width: 100%;
                display: flex;
            }

            .rail-step-btn {
                flex: 1;
                justify-content: center;
            }

            .jenjang-deck-stage {
                position: relative;
                padding: 0 16px;
            }

            .jenjang-slide-panel {
                display: none;
                position: relative;
                flex-direction: column;
                border-radius: 20px;
                overflow: hidden;
                border: 1.5px solid #e2e8f0;
                box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
                background: #ffffff;
                opacity: 0;
                transform: none !important;
                transition: opacity 0.35s ease;
            }

            .jenjang-slide-panel.active {
                display: flex;
                opacity: 1;
                pointer-events: auto;
                visibility: visible;
            }

            .jenjang-full-media-side {
                width: 100%;
                height: 260px;
                position: relative;
                overflow: hidden;
                border-radius: 20px 20px 0 0;
            }

            .jenjang-full-media-scrim {
                padding: 16px 20px;
            }

            .jenjang-media-title {
                font-size: 1.22rem;
                margin-bottom: 2px;
            }

            .jenjang-media-caption {
                font-size: 0.8rem;
            }

            .jenjang-full-content-side {
                width: 100%;
                padding: 22px 18px 26px;
                display: flex;
                flex-direction: column;
                overflow: visible;
            }

            .jenjang-full-title {
                font-size: 1.35rem;
                line-height: 1.3;
                margin-bottom: 10px;
            }

            .jenjang-full-desc {
                font-size: 0.88rem;
                line-height: 1.55;
                margin-bottom: 16px;
            }

            .jenjang-points-list {
                margin-bottom: 20px;
            }

            .jenjang-point-item {
                font-size: 0.85rem;
                line-height: 1.45;
                margin-bottom: 9px;
            }

            .btn-full-register {
                width: 100%;
                justify-content: center;
                padding: 13px 20px;
                font-size: 0.94rem;
                margin-top: 6px;
            }
        }

        /* ==========================================================================
           JALUR SELEKSI (VERTICAL SCROLL SLIDER - NO ICONS EXCEPT CHECKLIST)
           ========================================================================== */
        .section-jalur-slider {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 80px 0;
            position: relative;
        }

        .jalur-mono-badge {
            display: inline-flex;
            align-items: center;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #0369a1;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 5px 14px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }

        /* Vertical Rail (Left Column Navigation) */
        .jalur-vrail-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 24px;
        }

        .jalur-vrail-btn {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
            text-align: left;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        .jalur-vrail-btn:focus,
        .jalur-vrail-btn:focus-visible,
        .jalur-vrail-btn:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .jalur-vrail-btn:hover:not(.active) {
            border-color: #cbd5e1;
            background: #f8fafc;
            transform: translateX(4px);
        }

        .jalur-vrail-btn.active {
            background: #ffffff;
            border: 2px solid transparent !important;
            background-image: linear-gradient(#ffffff, #ffffff), linear-gradient(135deg, #0f78c2 0%, #38bdf8 100%) !important;
            background-origin: border-box !important;
            background-clip: padding-box, border-box !important;
            box-shadow: 0 8px 24px -4px rgba(15, 120, 194, 0.18) !important;
            transform: translateX(6px);
            outline: none !important;
        }

        .jalur-vrail-btn.active:focus,
        .jalur-vrail-btn.active:focus-visible,
        .jalur-vrail-btn.active:active {
            outline: none !important;
            box-shadow: 0 8px 24px -4px rgba(15, 120, 194, 0.18) !important;
        }

        .vrail-left-meta {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .vrail-index {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.85rem;
            font-weight: 800;
            color: #94a3b8;
            padding: 4px 8px;
            background: #f1f5f9;
            border-radius: 6px;
            transition: all 0.25s ease;
        }

        .jalur-vrail-btn.active .vrail-index {
            background: #0f78c2;
            color: #ffffff;
        }

        .vrail-title {
            font-size: 0.94rem;
            font-weight: 700;
            color: #334155;
            transition: color 0.25s ease;
            line-height: 1.35;
        }

        .jalur-vrail-btn.active .vrail-title {
            color: #0f78c2;
            font-weight: 800;
        }

        .vrail-badge {
            font-size: 0.74rem;
            font-weight: 700;
            color: #64748b;
            background: #f1f5f9;
            padding: 3px 10px;
            border-radius: 9999px;
            white-space: nowrap;
        }

        .jalur-vrail-btn.active .vrail-badge {
            background: #e0f2fe;
            color: #0369a1;
        }

        /* Slider Controls Footer */
        .jalur-vslider-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px dashed #e2e8f0;
        }

        .vslider-counter {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.88rem;
            font-weight: 800;
            color: #64748b;
        }

        .vslider-counter span {
            color: #0f78c2;
            font-size: 1.05rem;
        }

        .vslider-nav-btns {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-vslider-nav {
            background: #f1f5f9;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            color: #334155;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-vslider-nav:hover:not(:disabled) {
            background: #e0f2fe;
            color: #0369a1;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .btn-vslider-nav:focus,
        .btn-vslider-nav:focus-visible,
        .btn-vslider-nav:active {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .btn-vslider-nav:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f8fafc;
            color: #94a3b8;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Right Column (Vertical Slider Stage) */
        .jalur-vslider-stage {
            position: relative;
            min-height: 540px;
            height: 100%;
            overflow: hidden;
            border-radius: 20px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.08);
        }

        .jalur-vslide-card {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 36px 40px;
            background: #ffffff;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(60px);
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.45s;
            overflow-y: auto;
        }

        .jalur-vslide-card.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
            z-index: 2;
        }

        .jalur-vslide-card.is-past {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-60px);
            z-index: 1;
        }

        /* Slide Inner Components (No icons except checklist) */
        .vslide-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .vslide-track-tag {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #0f78c2;
        }

        .vslide-status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.74rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 9999px;
            letter-spacing: 0.2px;
        }

        .vslide-status-pill.open {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .vslide-status-pill.closed {
            background-color: #f1f5f9;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }

        .vslide-pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #10b981;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 1.8s infinite;
        }

        .vslide-title {
            font-size: 1.65rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            letter-spacing: -0.02em;
            margin-bottom: 10px;
        }

        .vslide-desc {
            font-size: 0.94rem;
            color: #475569;
            line-height: 1.65;
            margin-bottom: 20px;
        }

        /* Privilege Box */
        .vslide-privilege-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 20px;
        }

        .vslide-privilege-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #b45309;
            margin-bottom: 2px;
        }

        .vslide-privilege-text {
            font-size: 0.9rem;
            font-weight: 700;
            color: #78350f;
            line-height: 1.45;
        }

        /* Fee Box */
        .vslide-fee-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .vslide-fee-label {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
        }

        .vslide-fee-amount {
            font-size: 1.28rem;
            font-weight: 800;
            color: #0f172a;
            font-feature-settings: "tnum";
        }

        .vslide-fee-amount span {
            font-size: 0.88rem;
            font-weight: 600;
            color: #64748b;
            margin-right: 2px;
        }

        /* Requirements Checklist (Only allowed icon: checklist icon) */
        .vslide-req-title {
            font-size: 0.78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #475569;
            margin-bottom: 12px;
        }

        .vslide-req-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 26px;
        }

        .vslide-req-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.88rem;
            color: #334155;
            line-height: 1.5;
        }

        .vslide-req-icon {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* CTA Button (No icons) */
        .btn-vslide-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 13px 28px;
            font-size: 0.98rem;
            font-weight: 700;
            border-radius: 12px;
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 18px rgba(15, 120, 194, 0.25);
            transition: all 0.25s ease;
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-vslide-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 120, 194, 0.35);
            background: linear-gradient(135deg, #0d69ab 0%, #0277bd 100%);
        }

        .btn-vslide-disabled {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 13px 28px;
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 12px;
            background: #f1f5f9;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
            cursor: not-allowed;
        }

        /* Responsive on mobile */
        @media (max-width: 991.98px) {
            .section-jalur-slider {
                padding: 48px 0;
            }

            .jalur-vrail-list {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 8px;
                gap: 8px;
            }

            .jalur-vrail-btn {
                flex: 0 0 auto;
                min-width: 220px;
                padding: 10px 14px;
                transform: none !important;
            }

            .jalur-vslider-stage {
                min-height: 480px;
                margin-top: 20px;
            }

            .jalur-vslide-card {
                padding: 24px 20px;
            }

            .vslide-title {
                font-size: 1.35rem;
            }

            .jalur-vslider-controls {
                margin-top: 14px;
                margin-bottom: 8px;
            }
        }

        /* ==========================================================================
           INFORMASI KONTAK (MODERN LAYOUT & SQUARE BOX SOCIAL UI)
           ========================================================================== */
        .section-kontak-modern {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 85px 0;
            position: relative;
        }

        .contact-info-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .contact-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .contact-feature-item:last-of-type {
            border-bottom: none;
            padding-bottom: 8px;
        }

        .contact-feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #f0f9ff;
            color: #0f78c2;
            border: 1px solid #bae6fd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .contact-feature-label {
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 4px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }

        .contact-feature-val {
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .contact-feature-val a {
            color: #0f172a;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-feature-val a:hover {
            color: #0f78c2;
        }

        /* Modern Square Box Social Media Icons (Single Color System) */
        .social-box-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid #f1f5f9;
        }

        .social-box-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-right: 4px;
        }

        .social-square-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #f0f9ff;
            border: 1.5px solid #bae6fd;
            color: #0f78c2 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            text-decoration: none !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        .social-square-btn:hover {
            background: #0f78c2;
            border-color: #0f78c2;
            color: #ffffff !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px -2px rgba(15, 120, 194, 0.35);
        }

        /* Map Card Wrapper */
        .contact-map-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
            height: 100%;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .contact-map-header {
            padding: 16px 22px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .contact-map-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.74rem;
            font-weight: 700;
            color: #0369a1;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .contact-map-frame {
            flex-grow: 1;
            width: 100%;
            min-height: 360px;
            border: 0;
        }

        /* ==========================================================================
           FRESH MODERN FOOTER
           ========================================================================== */
        /* ==========================================================================
           FRESH MODERN FOOTER (LIGHT & LUMINOUS THEME WITH SUBTLE ISLAMIC WATERMARK)
           ========================================================================== */
        .footer-fresh {
            background: linear-gradient(180deg, #f0f7fe 0%, #f8fafc 35%, #ffffff 100%);
            color: #475569;
            border-top: 1.5px solid #e2e8f0;
            padding: 65px 0 32px 0;
            position: relative;
            overflow: hidden;
        }

        /* Full page subtle light Islamic abstract watermark */
        .footer-islamic-watermark {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            min-height: 480px;
            background-image: url("{{ asset('theme/images/islamic-watermark-light.jpg') }}");
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            opacity: 0.16;
            pointer-events: none;
            z-index: 1;
            mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.6) 45%, rgba(0, 0, 0, 0) 90%);
            -webkit-mask-image: linear-gradient(180deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.6) 45%, rgba(0, 0, 0, 0) 90%);
        }

        .footer-fresh::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 280px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        .footer-islamic-badge {
            display: inline-flex;
            align-items: center;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #0369a1;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 4px 14px;
            border-radius: 9999px;
        }

        .footer-brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .footer-brand-logo-box {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .footer-brand-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .footer-brand-divider {
            width: 1.5px;
            height: 48px;
            background: linear-gradient(180deg, rgba(203, 213, 225, 0.05) 0%, #cbd5e1 50%, rgba(203, 213, 225, 0.05) 100%);
            border-radius: 9999px;
            flex-shrink: 0;
        }

        .footer-brand-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.01em;
            line-height: 1.35;
            margin: 0;
        }

        .footer-brand-desc {
            font-size: 0.88rem;
            line-height: 1.7;
            color: #64748b;
            margin-bottom: 16px;
        }

        .footer-col-title {
            font-size: 0.88rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-col-title::after {
            content: '';
            flex-grow: 1;
            height: 1.5px;
            background: #e2e8f0;
        }

        .footer-fresh-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-fresh-list li {
            margin-bottom: 11px;
        }

        .footer-fresh-link {
            color: #475569;
            text-decoration: none !important;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-fresh-link:hover {
            color: #0f78c2;
            transform: translateX(4px);
        }

        .footer-contact-box {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
        }

        .footer-wa-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            color: #ffffff !important;
            font-size: 0.86rem;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none !important;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(15, 120, 194, 0.25);
            margin-top: 10px;
        }

        .footer-wa-action:hover {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 120, 194, 0.35);
        }

        .footer-fresh-bottom {
            margin-top: 54px;
            padding-top: 24px;
            border-top: 1.5px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.84rem;
            color: #64748b;
        }

        .footer-fresh-badge {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 0.74rem;
            font-weight: 700;
            color: #0369a1;
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 4px 12px;
            border-radius: 9999px;
        }

        /* ==========================================================================
           SAMSUNG EDGE FLOATING HANDLE & ONE UI POPUP CTA
           ========================================================================== */
        .samsung-edge-tab {
            position: fixed;
            right: 0;
            top: 55%;
            z-index: 1045;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            color: #ffffff;
            border-radius: 18px 0 0 18px;
            padding: 9px 8px 9px 11px;
            box-shadow: -4px 6px 20px rgba(15, 120, 194, 0.35);
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            border-right: none;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
            touch-action: none;
            transform: translateX(0);
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease, opacity 0.35s ease;
        }

        /* Samsung Edge Auto-hide / Docked state */
        .samsung-edge-tab.edge-docked {
            transform: translateX(18px);
            opacity: 0.85;
        }

        .samsung-edge-tab:hover,
        .samsung-edge-tab:focus-visible,
        .samsung-edge-tab.is-dragging {
            transform: translateX(0) !important;
            opacity: 1 !important;
            box-shadow: -6px 8px 26px rgba(15, 120, 194, 0.5) !important;
        }

        .samsung-edge-tab.is-dragging {
            cursor: grabbing;
            transition: none !important;
        }

        .samsung-edge-handle-bar {
            width: 3.5px;
            height: 22px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 9999px;
            margin-right: 7px;
            flex-shrink: 0;
        }

        .samsung-edge-icon-wrap {
            width: 36px;
            height: 36px;
            background: #ffffff;
            color: #059669;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.14);
            position: relative;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        .samsung-edge-tab:hover .samsung-edge-icon-wrap {
            transform: scale(1.08);
        }

        .samsung-edge-online-dot {
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 10px;
            height: 10px;
            background-color: #22c55e;
            border: 2px solid #ffffff;
            border-radius: 50%;
        }

        /* Samsung One UI Popup Modal */
        .edge-popup-backdrop {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 1060;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s;
        }

        .edge-popup-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        .edge-popup-card {
            position: fixed;
            right: 22px;
            top: 50%;
            transform: translateY(-50%) scale(0.92) translateX(40px);
            width: calc(100% - 44px);
            max-width: 390px;
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 20px 48px -10px rgba(15, 23, 42, 0.25);
            z-index: 1065;
            opacity: 0;
            visibility: hidden;
            overflow: hidden;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease, visibility 0.35s;
        }

        .edge-popup-card.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) scale(1) translateX(0);
        }

        .edge-popup-header {
            background: linear-gradient(135deg, #0f78c2 0%, #0284c7 100%);
            padding: 18px 22px 18px;
            color: #ffffff;
            position: relative;
        }

        .edge-popup-header-handle {
            width: 38px;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 9999px;
            margin: 0 auto 12px;
        }

        .edge-popup-close-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .edge-popup-close-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: scale(1.08);
        }

        .edge-popup-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            padding: 3px;
            object-fit: contain;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .edge-popup-avatar-dot {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 12px;
            height: 12px;
            background: #22c55e;
            border: 2px solid #ffffff;
            border-radius: 50%;
        }

        .edge-popup-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.70rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #e0f2fe;
            background: rgba(255, 255, 255, 0.18);
            padding: 2px 8px;
            border-radius: 6px;
            margin-bottom: 3px;
        }

        .edge-popup-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .edge-popup-body {
            padding: 22px 24px 24px;
        }

        .edge-chat-bubble {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 16px;
            border-top-left-radius: 4px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-size: 0.89rem;
            color: #166534;
            line-height: 1.55;
        }

        .edge-info-row {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 14px;
        }

        .btn-edge-whatsapp {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            font-size: 0.95rem;
            font-weight: 700;
            padding: 13px 20px;
            border-radius: 14px;
            text-decoration: none !important;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
        }

        .btn-edge-whatsapp:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(16, 185, 129, 0.45);
        }

        @media (max-width: 576px) {
            .edge-popup-card {
                right: 14px;
                left: 14px;
                width: auto;
                max-width: none;
            }
        }

        /* Mobile App Bottom Navigation Bar (Animated Curved Notch & Floating Indicator) */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 64px;
            background: linear-gradient(135deg, #0f8ac2 0%, #0f78c2 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 18px 18px 0 0;
            box-shadow: 0 -6px 28px rgba(15, 120, 194, 0.38);
            z-index: 1045;
            padding: 0 4px calc(env(safe-area-inset-bottom, 0px));
            align-items: center;
            justify-content: space-around;
        }

        /* Animated Notch Slider (Glides horizontally) */
        .curved-notch-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 20%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform: translateX(calc(100% * 2)); /* Default to center (Beranda) */
        }

        /* U-shaped Curved Cutout Notch (Carved into the top edge) */
        .notch-cutout-svg {
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 78px;
            height: 26px;
            pointer-events: none;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.12));
        }

        /* Floating Circular Bubble with active icon */
        .notch-bubble {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #FFD444;
            background: linear-gradient(135deg, #FFE177 0%, #FFD444 100%);
            box-shadow: 0 8px 22px rgba(255, 212, 68, 0.45), inset 0 1px 2px rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            font-size: 1.25rem;
            border: 3.5px solid #0f82bd;
            transition: transform 0.25s ease, background 0.3s ease;
        }

        .notch-bubble-icon {
            color: #1e293b;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.2s ease;
        }

        /* Navigation item slots (20% width each) */
        .curved-nav-item {
            position: relative;
            z-index: 2;
            flex: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            background: transparent;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            cursor: pointer;
            padding: 4px 2px 6px 2px;
            transition: all 0.25s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent !important;
            -webkit-touch-callout: none;
        }

        .curved-nav-item:focus,
        .curved-nav-item:focus-visible,
        .curved-nav-item:active,
        .curved-nav-item:visited,
        #btnOpenMobileMore:focus,
        #btnOpenMobileMore:focus-visible,
        #btnOpenMobileMore:active {
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .curved-nav-item i.nav-icon {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.78);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            margin-bottom: 3px;
        }

        .curved-nav-item span.nav-label {
            font-size: 0.66rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.88);
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        /* Active Item: Dock icon shrinks/fades, label glows */
        .curved-nav-item.active i.nav-icon {
            opacity: 0;
            transform: translateY(-8px) scale(0.3);
            pointer-events: none;
        }

        .curved-nav-item.active span.nav-label {
            color: #FFD444;
            font-weight: 700;
            transform: translateY(12px);
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .curved-nav-item:hover i.nav-icon,
        .curved-nav-item:active i.nav-icon {
            color: #ffffff;
        }

        /* Samsung One UI Floating Submenu Sheet */
        .mobile-more-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1048;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-more-backdrop.show {
            display: block;
            opacity: 1;
        }

        .mobile-samsung-menu {
            display: none;
            position: fixed;
            bottom: 72px;
            right: 14px;
            left: 14px;
            max-width: 400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(186, 230, 253, 0.95);
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.18);
            z-index: 1050;
            padding: 16px 18px 18px 18px;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .mobile-samsung-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .samsung-handle-bar {
            width: 40px;
            height: 4px;
            border-radius: 4px;
            background: #cbd5e1;
            margin: 0 auto 12px auto;
        }

        .samsung-tile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-decoration: none !important;
            color: #1e293b;
            font-weight: 600;
            font-size: 0.90rem;
            margin-bottom: 9px;
            transition: all 0.2s ease;
        }

        .samsung-tile:active, .samsung-tile:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateY(-1px);
        }

        .samsung-tile-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        /* Responsive Mobile Header & Logo Centering */
        @media (max-width: 991px) {
            .navbar-edu .container {
                justify-content: center !important;
                display: flex !important;
            }

            .navbar-brand-logo {
                margin: 0 auto !important;
                display: flex !important;
                justify-content: center !important;
                animation: logoMoveToCenter 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .navbar-brand-logo img {
                margin-right: 0 !important;
            }

            @keyframes logoMoveToCenter {
                0% {
                    opacity: 0.2;
                    transform: translateX(-60px);
                }
                100% {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .navbar-toggler {
                display: none !important;
            }

            .mobile-bottom-nav {
                display: flex !important;
            }

            body {
                padding-bottom: 74px !important;
            }
        }
    </style>
</head>

<body>

    <!-- Top Announcement Bar with Running Text (Warna Biru Muda) -->
    <div class="top-edu-bar">
        <div class="container d-flex align-items-center">
            <div class="badge-informasi mr-3 flex-shrink-0">
                <i class="fas fa-bullhorn mr-1"></i> Informasi
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="6" class="marquee-text m-0">
                    <span class="mr-4">
                        <i class="fas fa-calendar-check mr-1" style="color: #FFD444;"></i> <b>Penerimaan Santri Baru (PSB) Tahun Ajaran {{ $config->tahun_ajaran ?? '2026/2027' }} ({{ $config->gelombang ?? 'Gelombang 1' }})</b> &bull; Status: 
                        @if($config->status)
                            <span class="badge ml-1 px-2 py-1" style="background-color: #10b981; color: #ffffff; border-radius: 4px; font-weight: 700;">Pendaftaran Dibuka</span>
                        @else
                            <span class="badge ml-1 px-2 py-1" style="background-color: #ef4444; color: #ffffff; border-radius: 4px; font-weight: 700;">Pendaftaran Ditutup</span>
                        @endif
                    </span>
                    @if(!empty($config->running_text))
                        <span class="mr-4"><i class="fas fa-bullhorn mr-1" style="color: #FFD444;"></i> {{ $config->running_text }}</span>
                    @elseif(!empty($config->pengumuman))
                        <span class="mr-4"><i class="fas fa-bell mr-1" style="color: #FFD444;"></i> {{ strip_tags($config->pengumuman) }}</span>
                    @endif
                    <span class="mr-4"><i class="fab fa-whatsapp mr-1" style="color: #25D366;"></i> Layanan Konsultasi & Humas: <b style="color: #FFD444;">{{ $config->no_wa_humas ?? '082371877887' }}</b></span>
                    <span class="mr-4"><i class="fas fa-school mr-1" style="color: #FFD444;"></i> Kampus {{ $config->nama_sekolah ?? 'Insan Mulia Boarding School (IMBOS)' }}</span>
                </marquee>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-edu">
        <div class="container">
            <a class="navbar-brand navbar-brand-logo py-1" href="/" title="{{ $config->nama_sekolah ?? 'SMPIT & SMAIT IMBOS' }}">
                <img src="{{ asset('theme/images/logo-imbos.png') }}" alt="{{ $config->nama_sekolah ?? 'IMBOS' }}" style="height: 50px; max-height: 52px; width: auto; object-fit: contain;">
            </a>

            <button class="navbar-toggler p-2 border" type="button" data-toggle="collapse" data-target="#mainNavbarNav" aria-controls="mainNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbarNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-edu" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-edu" href="#alur">Alur Seleksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-edu" href="#jenjang">Jenjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-edu" href="#jalur">Jalur Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-edu" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item ml-lg-2 mt-2 mt-lg-0">
                        <a href="/pendaftar/login" class="btn-edu btn-edu-outline py-2 px-3">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item ml-lg-2 mt-2 mt-lg-0">
                        @if($config->status)
                            <a href="/pendaftar/register" class="btn-edu btn-edu-lightblue py-2 px-3">
                                <i class="fas fa-user-plus"></i> Daftar
                            </a>
                        @else
                            <button class="btn-edu btn-edu-outline py-2 px-3" disabled>
                                <i class="fas fa-lock text-muted"></i> Ditutup
                            </button>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Animated Shimmering Light & Fast Glitter -->
    <header id="beranda" class="hero-edu">
        <!-- Abstract Shimmer Sweep & Glittering Light Layer -->
        <div class="hero-shimmer-sweep"></div>
        <div class="hero-glitter-layer"></div>
        <div class="hero-glow-orb-1"></div>
        <div class="hero-glow-orb-2"></div>
        <div class="hero-glow-orb-3"></div>

        <!-- Twinkling Sparkle Stars -->
        <span class="hero-sparkle" style="top: 14%; left: 8%; animation-delay: 0s;">✦</span>
        <span class="hero-sparkle" style="top: 26%; left: 46%; animation-delay: 0.7s; font-size: 0.85rem;">✧</span>
        <span class="hero-sparkle" style="top: 78%; left: 12%; animation-delay: 1.3s; font-size: 1.35rem;">✦</span>
        <span class="hero-sparkle" style="top: 16%; right: 14%; animation-delay: 0.4s;">✦</span>
        <span class="hero-sparkle" style="top: 72%; right: 22%; animation-delay: 1.1s; font-size: 0.95rem;">✧</span>

        <div class="container">
            <div class="row align-items-center hero-row">
                <!-- Sisi Kiri: Judul PSB, Deskripsi, dan Tombol CTA -->
                <div class="col-lg-6 mb-4 mb-lg-0 hero-left-col">
                    <h1 class="hero-main-title mb-3">
                        <span style="color: #0f78c2;">{{ $config->hero_tag ?? 'PSB Online' }}</span><br>
                        <span>{{ $config->hero_title ?? 'SMP/SMA IT Insan Mulia' }}</span><br>
                        <span style="font-size: 1.75rem; color: #475569; font-weight: 700; display: inline-block; margin-top: 4px;">{{ $config->hero_subtitle ?? 'Boarding School Pringsewu 2027-2028' }}</span>
                    </h1>

                    <p class="lead mb-4" style="color: var(--edu-body); font-size: 1.05rem; line-height: 1.8;">
                        {{ $config->hero_desc ?? ('Selamat datang di portal Penerimaan Santri Baru ' . ($config->nama_sekolah ?? 'SMPIT & SMAIT Insan Mulia Boarding School') . '. Daftarkan dirimu sekarang juga melalui tombol di bawah ini.') }}
                    </p>

                    <div class="d-flex flex-wrap align-items-center" style="gap: 12px;">
                        @if($config->status)
                            <a href="/pendaftar/register" class="btn-edu btn-edu-lightblue btn-edu-lg">
                                <i class="fas fa-user-plus mr-1"></i> Daftar Sekarang
                            </a>
                        @else
                            <button class="btn-edu btn-edu-outline btn-edu-lg" disabled>
                                <i class="fas fa-lock text-muted mr-1"></i> Pendaftaran Ditutup
                            </button>
                        @endif
                        @if(!empty($config->no_wa_humas))
                            <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($config->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Humas IMBOS, saya ingin bertanya seputar Penerimaan Santri Baru') }}" target="_blank" class="btn-edu btn-edu-darkgray btn-edu-lg">
                                <i class="fab fa-whatsapp mr-1"></i> Hubungi Kami
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Sisi Kanan: Kotak Kalam Quran & Gambar Ilustrasi Santri -->
                <div class="col-lg-6 mt-4 mt-lg-0 hero-right-col">
                    <div class="hero-quran-box mb-3 text-left">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="small font-weight-bold" style="color: #0f8ac2; letter-spacing: 0.5px;">
                                <i class="fas fa-book-open mr-1"></i> {{ $config->quran_surah ?? "QS. Ar-Ra'd: 11" }}
                            </span>
                        </div>
                        <div class="font-arabic text-right mb-2 hero-quran-arabic">
                            {{ $config->quran_arabic ?? 'إِنَّ اللَّهَ لَا يُغَيِّرُ مَا بِقَوْمٍ حَتَّى يُغَيِّرُوا مَا بِأَنْفُسِهِمْ' }}
                        </div>
                        <div class="quran-latin-text">
                            &ldquo;{{ $config->quran_translation ?? 'Sesungguhnya Allah tidak akan mengubah keadaan suatu kaum sebelum mereka mengubah keadaan diri mereka sendiri.' }}&rdquo;
                        </div>
                    </div>

                    <!-- Gambar Ilustrasi Santri Fresh -->
                    <div class="text-center hero-image-container">
                        <div class="hero-image-wrapper">
                            <img src="{{ !empty($config->hero_image) ? asset($config->hero_image) : asset('theme/images/hero-santri.png') }}" alt="Santri {{ $config->nama_sekolah ?? 'Insan Mulia Boarding School' }}" class="img-fluid hero-illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Alur Pendaftaran Section (Modern Timeline UI) -->
    <section id="alur" class="py-5 mt-4" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="section-tag-soft">
                    <i class="fas fa-stream mr-1"></i> Panduan Wali Santri
                </span>
                <h2 class="section-title-edu">Alur Seleksi Penerimaan Santri</h2>
                <p class="section-subtitle-edu">
                    Proses pendaftaran santri baru dirancang terstruktur, transparan, dan mudah dipandu langkah demi langkah secara online.
                </p>
            </div>

            <!-- Timeline Container -->
            <div class="timeline-edu">
                @forelse($alurs as $idx => $alur)
                <div class="timeline-item">
                    <div class="timeline-node">{{ $alur->step_number ?? str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="timeline-card">
                        <div class="timeline-card-header">
                            <div class="timeline-icon-box">
                                <i class="{{ $alur->icon ?? 'fas fa-check-circle' }}"></i>
                            </div>
                            <span class="timeline-step-tag">{{ $alur->step_tag ?? ('Tahap ' . ($idx + 1)) }}</span>
                        </div>
                        <h3 class="timeline-card-title">{{ $alur->title }}</h3>
                        <p class="timeline-card-desc">
                            {!! nl2br(e($alur->description)) !!}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center p-4 text-muted w-100">
                    Tahapan alur pendaftaran belum tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Jenjang Pendidikan Section (Fullpage Edge-to-Edge Sticky Section with Vertical Scroll-Driven Slides) -->
    <section id="jenjang" class="jenjang-sticky-section">
        <div class="jenjang-sticky-viewport">
            <!-- Sticky Section Header & Dynamic Scroll Navigation Rail -->
            <div class="jenjang-sticky-header">
                <div>
                    <h2 class="academic-section-title">
                        Dua Jenjang Pendidikan. <span>Satu Visi Generasi Qur'ani.</span>
                    </h2>
                </div>

                <!-- Scroll-Driven Navigation Rail (Click to jump, updates on scroll) -->
                <div class="jenjang-rail-nav" role="tablist">
                    <button type="button" class="rail-step-btn active" id="railBtn0" data-slide="0">
                        <span class="rail-num">01</span>
                        <span class="rail-label">SMP IT Insan Mulia</span>
                    </button>
                    <button type="button" class="rail-step-btn" id="railBtn1" data-slide="1">
                        <span class="rail-num">02</span>
                        <span class="rail-label">SMA IT Insan Mulia</span>
                    </button>
                </div>
            </div>

            @php
                $smp = $jenjangs->first(function($j) { return strtoupper($j->tingkat_jenjang) == 'SMP'; }) ?? ($jenjangs[0] ?? null);
                $sma = $jenjangs->first(function($j) { return strtoupper($j->tingkat_jenjang) == 'SMA'; }) ?? ($jenjangs[1] ?? null);
            @endphp

            <!-- Scroll-Driven Slides Stage (Full Width & Full Height) -->
            <div class="jenjang-deck-stage">
                <!-- Slide 1: SMPIT Insan Mulia -->
                <div class="jenjang-slide-panel active" id="jenjangSlide0">
                    <!-- Left: Full Page Vertical Image -->
                    <div class="jenjang-full-media-side">
                        <img src="{{ !empty($smp->photo_cover) ? asset($smp->photo_cover) : asset('theme/images/jenjang-smpit-full.jpg') }}" alt="{{ $smp->nama_jenjang ?? 'SMPIT Insan Mulia Boarding School' }}" class="jenjang-full-img">
                        <div class="jenjang-full-media-scrim">
                            <h3 class="jenjang-media-title">{{ $smp->nama_jenjang ?? 'SMP IT Insan Mulia' }}</h3>
                            <p class="jenjang-media-caption">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $smp->tag_lokasi ?? 'Kampus Putra & Putri Terpisah · Pringsewu, Lampung' }}
                            </p>
                        </div>
                    </div>

                    <!-- Right: Full Page Editorial Content -->
                    <div class="jenjang-full-content-side">
                        <h3 class="jenjang-full-title">
                            {{ $smp->nama_jenjang ?? 'SMP Islam Terpadu Insan Mulia Boarding School' }}
                        </h3>

                        <p class="jenjang-full-desc">
                            {{ $smp->deskripsi_jenjang ?? 'Pendidikan tingkat menengah pertama berbasis kepesantrenan terpadu yang memfokuskan santri pada fondasi adab islami, pembiasaan ibadah, bilingual Arab-Inggris, dan hafalan Al-Qur\'an mutqin.' }}
                        </p>

                        <div class="jenjang-points-list">
                            @if(!empty($smp->poin_keunggulan))
                                @foreach(explode("\n", str_replace("\r", "", $smp->poin_keunggulan)) as $point)
                                    @if(trim($point) != '')
                                        @php
                                            $parts = explode(':', $point, 2);
                                        @endphp
                                        <div class="jenjang-point-item">
                                            <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                            <div>
                                                @if(count($parts) == 2)
                                                    <b>{{ trim($parts[0]) }}:</b> {{ trim($parts[1]) }}
                                                @else
                                                    {{ trim($point) }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Kurikulum Terpadu:</b> Perpaduan kurikulum nasional Kemendikbudristek &amp; kurikulum diniyah kepesantrenan.</div>
                                </div>
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Halaqah Al-Qur'an Intensif:</b> Talaqqi makharijul huruf, kaidah tajwid bersanad, dan bimbingan tahfizh harian.</div>
                                </div>
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Kemandirian &amp; Karakter:</b> Pembinaan adab islami, kepemimpinan santri, dan pembiasaan bilingual Arab-Inggris.</div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Button (Hanya Tombol Daftar) -->
                        <div class="jenjang-btn-wrap">
                            @if($config->status)
                                <a href="/pendaftar/register" class="btn-full-register">
                                    <i class="fas fa-user-plus mr-1"></i> Daftar SMPIT Sekarang
                                </a>
                            @else
                                <span class="badge badge-secondary p-3">Pendaftaran Ditutup</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Slide 2: SMAIT Insan Mulia -->
                <div class="jenjang-slide-panel" id="jenjangSlide1">
                    <!-- Left: Full Page Vertical Image -->
                    <div class="jenjang-full-media-side">
                        <img src="{{ !empty($sma->photo_cover) ? asset($sma->photo_cover) : asset('theme/images/jenjang-smait-full.jpg') }}" alt="{{ $sma->nama_jenjang ?? 'SMAIT Insan Mulia Boarding School' }}" class="jenjang-full-img">
                        <div class="jenjang-full-media-scrim">
                            <h3 class="jenjang-media-title">{{ $sma->nama_jenjang ?? 'SMA IT Insan Mulia' }}</h3>
                            <p class="jenjang-media-caption">
                                <i class="fas fa-globe-asia mr-1"></i> {{ $sma->tag_lokasi ?? 'Persiapan PTN & Studi Global · Pringsewu, Lampung' }}
                            </p>
                        </div>
                    </div>

                    <!-- Right: Full Page Editorial Content -->
                    <div class="jenjang-full-content-side">
                        <h3 class="jenjang-full-title">
                            {{ $sma->nama_jenjang ?? 'SMA IT Insan Mulia Boarding School Pringsewu' }}
                        </h3>

                        <p class="jenjang-full-desc">
                            {{ $sma->deskripsi_jenjang ?? 'Jenjang pendidikan menengah atas dengan kurikulum terpadu yang memfokuskan santri pada kesiapan menembus PTN favorit, universitas internasional, kepemimpinan berintegritas, serta tahfizh Al-Qur\'an 30 Juz.' }}
                        </p>

                        <div class="jenjang-points-list">
                            @if(!empty($sma->poin_keunggulan))
                                @foreach(explode("\n", str_replace("\r", "", $sma->poin_keunggulan)) as $point)
                                    @if(trim($point) != '')
                                        @php
                                            $parts = explode(':', $point, 2);
                                        @endphp
                                        <div class="jenjang-point-item">
                                            <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                            <div>
                                                @if(count($parts) == 2)
                                                    <b>{{ trim($parts[0]) }}:</b> {{ trim($parts[1]) }}
                                                @else
                                                    {{ trim($point) }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Kesiapan UTBK-SNBT &amp; Kedinasan:</b> Pembekalan intensif, klinik bedah soal, dan pemetaan minat karier santri.</div>
                                </div>
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Program Takhassus 30 Juz:</b> Jalur percepatan tahfizh Al-Qur'an mutqin bersanad dengan tasmi' terbuka.</div>
                                </div>
                                <div class="jenjang-point-item">
                                    <div class="jenjang-point-icon"><i class="fas fa-check"></i></div>
                                    <div><b>Riset &amp; Studi Global:</b> Pembinaan riset sains remaja, literasi teknologi informasi, dan persiapan beasiswa luar negeri.</div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Button (Hanya Tombol Daftar) -->
                        <div class="jenjang-btn-wrap">
                            @if($config->status)
                                <a href="/pendaftar/register" class="btn-full-register">
                                    <i class="fas fa-user-plus mr-1"></i> Daftar SMAIT Sekarang
                                </a>
                            @else
                                <span class="badge badge-secondary p-3">Pendaftaran Ditutup</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jalur Pendaftaran Section (Vertical Scroll Slider - No icons except checklist) -->
    <section id="jalur" class="section-jalur-slider">
        <div class="container">
            <div class="row align-items-stretch">
                <!-- Left Column: Header & Vertical Interactive Rail Navigation -->
                <div class="col-lg-5 mb-4 mb-lg-0 d-flex flex-column justify-content-between">
                    <div>
                        <span class="jalur-mono-badge">
                            JALUR PENERIMAAN SANTRI BARU T.A 2027/2028
                        </span>
                        <h2 class="academic-section-title mt-2 mb-3" style="font-size: 2.2rem;">
                            Pilihan Jalur Masuk. <span>Peluang Terbaik Bagi Ananda.</span>
                        </h2>
                        <p class="section-subtitle-edu mx-0 text-left" style="font-size: 0.98rem; max-width: 100%;">
                            Pilih jalur seleksi sesuai potensi, prestasi akademik, bakat non-akademik, alumni keluarga IMBOS, atau jalur reguler santri baru.
                        </p>

                        <!-- Vertical Interactive Rail -->
                        <div class="jalur-vrail-list" role="tablist">
                            @foreach ($jalurs as $idx => $jalur)
                            <button type="button" 
                                    class="jalur-vrail-btn {{ $idx === 0 ? 'active' : '' }}" 
                                    data-slide="{{ $idx }}"
                                    role="tab"
                                    aria-selected="{{ $idx === 0 ? 'true' : 'false' }}">
                                <div class="vrail-left-meta">
                                    <span class="vrail-index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="vrail-title">{{ $jalur->nama_jalur }}</span>
                                </div>
                                <span class="vrail-badge">
                                    {{ $jalur->status ? 'Dibuka' : 'Ditutup' }}
                                </span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slider Controls Footer -->
                    <div class="jalur-vslider-controls">
                        <div class="vslider-counter">
                            JALUR <span id="jalurCounterCurrent">01</span> / {{ str_pad(count($jalurs), 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="vslider-nav-btns">
                            <button type="button" class="btn-vslider-nav" id="btnJalurPrev" disabled>
                                Sebelumnya
                            </button>
                            <button type="button" class="btn-vslider-nav" id="btnJalurNext" {{ count($jalurs) <= 1 ? 'disabled' : '' }}>
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Vertical Slider Stage -->
                <div class="col-lg-7">
                    <div class="jalur-vslider-stage">
                        @forelse ($jalurs as $idx => $jalur)
                        <div class="jalur-vslide-card {{ $idx === 0 ? 'active' : '' }}" id="jalurSlide{{ $idx }}" data-index="{{ $idx }}">
                            <div>
                                <!-- Top Bar (No icons) -->
                                <div class="vslide-top-bar">
                                    <span class="vslide-track-tag">
                                        JALUR SELEKSI {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }} DARI {{ str_pad(count($jalurs), 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="vslide-status-pill {{ $jalur->status ? 'open' : 'closed' }}">
                                        @if($jalur->status)
                                            <span class="vslide-pulse-dot"></span> Pendaftaran Dibuka
                                        @else
                                            Pendaftaran Ditutup
                                        @endif
                                    </span>
                                </div>

                                <!-- Title & Description -->
                                <h3 class="vslide-title">
                                    {{ $jalur->nama_jalur }}
                                </h3>
                                <p class="vslide-desc">
                                    {{ $jalur->deskripsi_jalur }}
                                </p>

                                <!-- Privilege / Keunggulan (No icons) -->
                                @if(!empty($jalur->kelebihan))
                                <div class="vslide-privilege-box">
                                    <span class="vslide-privilege-label">Keunggulan Utama Jalur</span>
                                    <div class="vslide-privilege-text">{{ $jalur->kelebihan }}</div>
                                </div>
                                @endif

                                <!-- Fee Box (No icons) -->
                                <div class="vslide-fee-box">
                                    <span class="vslide-fee-label">Biaya Pendaftaran &amp; Seleksi</span>
                                    <div class="vslide-fee-amount">
                                        <span>Rp</span>{{ number_format($jalur->biaya ?? $config->biaya_pendaftaran_default ?? 350000, 0, ',', '.') }}
                                    </div>
                                </div>

                                <!-- Requirements (Checklist icon ONLY) -->
                                <div class="vslide-req-title">
                                    Berkas &amp; Dokumen Persyaratan
                                </div>

                                <div class="vslide-req-list">
                                    @if(!empty($jalur->persyaratan))
                                        @php
                                            $syaratList = explode("\n", str_replace("\r", "", $jalur->persyaratan));
                                        @endphp
                                        @foreach($syaratList as $syarat)
                                            @if(trim($syarat) != '')
                                            <div class="vslide-req-item">
                                                <span class="vslide-req-icon"><i class="fas fa-check"></i></span>
                                                <span>{{ trim($syarat) }}</span>
                                            </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="vslide-req-item">
                                            <span class="vslide-req-icon"><i class="fas fa-check"></i></span>
                                            <span>Fotokopi Kartu Keluarga &amp; Akta Lahir</span>
                                        </div>
                                        <div class="vslide-req-item">
                                            <span class="vslide-req-icon"><i class="fas fa-check"></i></span>
                                            <span>NISN dari sekolah asal</span>
                                        </div>
                                        <div class="vslide-req-item">
                                            <span class="vslide-req-icon"><i class="fas fa-check"></i></span>
                                            <span>Pas foto resmi santri</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- CTA Button (No icons) -->
                            <div class="pt-3">
                                @if($config->status && $jalur->status)
                                    <a href="/pendaftar/register" class="btn-vslide-action">
                                        Daftar Jalur Ini
                                    </a>
                                @else
                                    <button class="btn-vslide-disabled" disabled>
                                        Jalur Tidak Aktif
                                    </button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-muted">
                            Data jalur seleksi belum tersedia.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi & Informasi Kontak Section (Modern Layout & Square Box Social Media UI) -->
    <section id="kontak" class="section-kontak-modern">
        <div class="container">
            <div class="row align-items-stretch">
                <!-- Left Column: Informasi Kontak & Layanan -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="contact-info-card">
                        <div>
                            <span class="academic-mono-tag">
                                PUSAT LAYANAN &amp; INFORMASI
                            </span>
                            <h2 class="academic-section-title mt-2 mb-3" style="font-size: 2.1rem;">
                                Kunjungi Kampus IMBOS. <span>Layanan Terpadu.</span>
                            </h2>
                            <p class="section-subtitle-edu mx-0 text-left mb-4" style="font-size: 0.95rem; line-height: 1.7; max-width: 100%;">
                                Kami menyambut silaturahmi calon wali santri untuk berkonsultasi, melihat lingkungan asrama, masjid, sarana olahraga, dan fasilitas belajar santri.
                            </p>

                            <div class="contact-features-list">
                                <div class="contact-feature-item">
                                    <div class="contact-feature-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <div class="contact-feature-label">Alamat Kampus Pesantren</div>
                                        <p class="contact-feature-val">
                                            {{ $config->alamat_sekolah ?? 'Jl. Hiu Latsitarda Dusun Krakatau RT/RW 007/001 Margakaya, Pringsewu, Lampung' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-feature-item">
                                    <div class="contact-feature-icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <div>
                                        <div class="contact-feature-label">Layanan WhatsApp Humas &amp; PSB</div>
                                        <p class="contact-feature-val">
                                            @if(!empty($config->no_wa_humas))
                                                <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($config->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Humas IMBOS, saya ingin berkonsultasi mengenai pendaftaran santri baru.') }}" target="_blank">
                                                    {{ $config->no_wa_humas }} <span class="badge badge-success ml-2 px-2 py-1" style="font-size: 0.72rem; vertical-align: middle;">Chat Langsung</span>
                                                </a>
                                            @else
                                                0823-7187-7887
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-feature-item">
                                    <div class="contact-feature-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="contact-feature-label">Surat Elektronik Resmi</div>
                                        <p class="contact-feature-val">
                                            <a href="mailto:{{ $config->email_sekolah ?? 'psb@imbos.sch.id' }}">
                                                {{ $config->email_sekolah ?? 'psb@imbos.sch.id' }}
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-feature-item">
                                    <div class="contact-feature-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <div class="contact-feature-label">Jam Layanan Kantor Sekretariat</div>
                                        <p class="contact-feature-val">
                                            {{ $config->jam_kerja ?? 'Senin - Sabtu: 08.00 - 16.00 WIB' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modern Square Box Social Media Icons (Single Color System) -->
                        <div class="social-box-row">
                            <span class="social-box-label">Ikuti Kami:</span>
                            @if(!empty($config->link_facebook))
                                <a href="{{ $config->link_facebook }}" target="_blank" class="social-square-btn" title="Facebook IMBOS" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @else
                                <a href="https://facebook.com" target="_blank" class="social-square-btn" title="Facebook" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            @if(!empty($config->link_instagram))
                                <a href="{{ $config->link_instagram }}" target="_blank" class="social-square-btn" title="Instagram IMBOS" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @else
                                <a href="https://instagram.com" target="_blank" class="social-square-btn" title="Instagram" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if(!empty($config->link_youtube))
                                <a href="{{ $config->link_youtube }}" target="_blank" class="social-square-btn" title="YouTube IMBOS" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @else
                                <a href="https://youtube.com" target="_blank" class="social-square-btn" title="YouTube" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Embedded Campus Map Card -->
                <div class="col-lg-7">
                    <div class="contact-map-card">
                        <div class="contact-map-header">
                            <span class="contact-map-badge">
                                <i class="fas fa-map-marked-alt mr-1"></i> Google Maps Pringsewu
                            </span>
                            <a href="https://maps.google.com/?q=INSAN+MULIA+BOARDING+SCHOOL+PRINGSEWU" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-3" style="border-radius: 8px; font-weight: 700; font-size: 0.8rem;">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka Rute
                            </a>
                        </div>
                        <iframe 
                            src="{{ !empty($config->maps_embed_url) ? $config->maps_embed_url : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3035238136476!2d104.9698578147651!3d-5.370597696104457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4732773b51fbfd%3A0x7a90c7aa4e69d1d0!2sINSAN%20MULIA%20BOARDING%20SCHOOL%20PRINGSEWU!5e0!3m2!1sid!2sid!4v1632987004618!5m2!1sid!2sid!4v1632987004618' }}" 
                            class="contact-map-frame"
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Fresh & Modern Architectural Design with Islamic Abstract Watermark) -->
    <footer class="footer-fresh">
        <!-- Full-Page Width Islamic Abstract Watermark Background Layer from Left to Right -->
        <div class="footer-islamic-watermark" aria-hidden="true"></div>

        <div class="container position-relative" style="z-index: 2;">
            <!-- Top Islamic Crest / Accent Bar directly below PUSAT LAYANAN & INFORMASI -->
            <div class="footer-islamic-crest mb-5 pb-4 border-bottom" style="border-color: #e2e8f0 !important;">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <span class="footer-islamic-badge">
                            <i class="fas fa-mosque mr-2"></i> PONDOK PESANTREN MODERN IMBOS PRINGSEWU
                        </span>
                        <h4 class="font-weight-bold mt-2 mb-1" style="color: #0f172a; letter-spacing: -0.01em;">
                            {{ $config->footer_title ?? 'Mencetak Generasi Cendikiawan Qurani & Berakhlak Mulia' }}
                        </h4>
                        <p class="text-muted small mb-0">
                            {{ $config->footer_subtitle ?? 'Pendidikan Terpadu SMPIT & SMAIT Berbasis Karakter Islami, Tahfizh Mutqin, & Kurikulum Global.' }}
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        @if($config->status)
                            <a href="/pendaftar/register" class="btn btn-sm btn-info px-3 py-2 font-weight-bold shadow-sm" style="border-radius: 10px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border: none;">
                                <i class="fas fa-user-plus mr-1"></i> Daftar Santri Baru
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Column 1: School Identity & Accreditations -->
                <div class="col-lg-4 mb-4 mb-lg-0 pr-lg-4">
                    <div class="footer-brand-header">
                        <div class="footer-brand-logo-box">
                            <img src="{{ asset('theme/images/logo271.png') }}" alt="Logo IMBOS" class="footer-brand-logo">
                        </div>
                        <div class="footer-brand-divider" aria-hidden="true"></div>
                        <h4 class="footer-brand-title">
                            {{ $config->nama_sekolah ?? 'SMPIT & SMAIT Insan Mulia Boarding School' }}
                        </h4>
                    </div>
                    <p class="footer-brand-desc">
                        {{ $config->footer_desc ?? "Pesantren Modern yang mengintegrasikan kurikulum nasional terpadu, tahfizh Al-Qur'an mutqin, bahasa internasional, dan wawasan global untuk melahirkan generasi Cendikiawan Qurani." }}
                    </p>
                    <div class="small text-muted mb-2">
                        <i class="fas fa-map-pin mr-2 text-primary"></i> {{ $config->alamat_sekolah }}
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
                    <div class="footer-col-title">Navigasi</div>
                    <ul class="footer-fresh-list">
                        <li><a href="#beranda" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Beranda</a></li>
                        <li><a href="#alur" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Alur Seleksi</a></li>
                        <li><a href="#jenjang" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Unit Jenjang</a></li>
                        <li><a href="#jalur" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Jalur Masuk</a></li>
                        <li><a href="#kontak" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Kontak &amp; Lokasi</a></li>
                    </ul>
                </div>

                <!-- Column 3: Portal Pendaftaran -->
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="footer-col-title">Portal Pendaftar</div>
                    <ul class="footer-fresh-list">
                        @if($config->status)
                            <li><a href="/pendaftar/register" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Registrasi Calon Santri</a></li>
                        @endif
                        <li><a href="/pendaftar/login" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Login Portal Santri</a></li>
                        <li><a href="/pendaftar/login" class="footer-fresh-link"><i class="fas fa-angle-right"></i> Pengumuman Kelulusan</a></li>
                        <li><a href="/operator/login" class="footer-fresh-link text-muted"><i class="fas fa-angle-right"></i> Login Panel Operator</a></li>
                    </ul>
                </div>

                <!-- Column 4: Helpdesk & WA Center -->
                <div class="col-lg-3">
                    <div class="footer-col-title">Layanan Panitia</div>
                    <div class="footer-contact-box">
                        <div class="small font-weight-bold mb-1" style="color: #0f172a;">Konsultasi Pendaftaran PSB</div>
                        <p class="small text-muted mb-2" style="line-height: 1.5;">
                            Butuh bantuan pengisian formulir, syarat berkas, atau jadwal survei kampus?
                        </p>
                        @if(!empty($config->no_wa_humas))
                            <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($config->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Humas IMBOS, saya ingin bertanya seputar pendaftaran santri baru.') }}" target="_blank" class="footer-wa-action">
                                <i class="fab fa-whatsapp"></i> Chat Humas PSB ({{ $config->no_wa_humas }})
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Row -->
            <div class="footer-fresh-bottom">
                <div>
                    &copy; {{ date('Y') }} <b>Panitia PSB {{ $config->nama_sekolah ?? 'IMBOS Pringsewu' }}</b>. Seluruh Hak Cipta Dilindungi.
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="footer-fresh-badge">
                        T.A. {{ $config->tahun_ajaran ?? '2027/2028' }} &bull; {{ $config->gelombang ?? 'Gelombang 1' }}
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile App Bottom Navigation Bar with Curved Notch Slider -->
    <nav class="mobile-bottom-nav">
        <!-- Sliding Notch Cutout & Floating Indicator Bubble -->
        <div class="curved-notch-slider" id="curvedNotchSlider">
            <svg class="notch-cutout-svg" viewBox="0 0 78 26" preserveAspectRatio="none">
                <path d="M 0,0 C 16,0 22,24 39,24 C 56,24 62,0 78,0 Z" fill="#f8fafc" />
            </svg>
            <div class="notch-bubble" id="notchBubble">
                <i class="notch-bubble-icon fas fa-home" id="curvedNotchIcon"></i>
            </div>
        </div>

        <a href="#alur" class="curved-nav-item" data-index="0" data-icon="fas fa-stream">
            <i class="fas fa-stream nav-icon"></i>
            <span class="nav-label">Alur</span>
        </a>
        <a href="#jenjang" class="curved-nav-item" data-index="1" data-icon="fas fa-graduation-cap">
            <i class="fas fa-graduation-cap nav-icon"></i>
            <span class="nav-label">Jenjang</span>
        </a>
        <a href="#beranda" class="curved-nav-item active" data-index="2" data-icon="fas fa-home">
            <i class="fas fa-home nav-icon"></i>
            <span class="nav-label">Beranda</span>
        </a>
        <a href="#jalur" class="curved-nav-item" data-index="3" data-icon="fas fa-door-open">
            <i class="fas fa-door-open nav-icon"></i>
            <span class="nav-label">Jalur</span>
        </a>
        <button type="button" class="curved-nav-item" id="btnOpenMobileMore" data-index="4" data-icon="fas fa-th-large" aria-label="Menu Lainnya" style="outline: none !important; border: none !important; box-shadow: none !important;">
            <i class="fas fa-th-large nav-icon" id="iconMobileMore"></i>
            <span class="nav-label">Lainnya</span>
        </button>
    </nav>

    <!-- Samsung One UI Floating Submenu Panel -->
    <div class="mobile-more-backdrop" id="mobileMoreBackdrop"></div>
    <div class="mobile-samsung-menu" id="mobileSamsungMenu">
        <div class="samsung-handle-bar"></div>
        <div class="d-flex align-items-center justify-content-between mb-3 px-1">
            <div class="font-weight-bold text-dark" style="font-size: 0.96rem;">
                <i class="fas fa-th-large text-primary mr-2"></i> Menu Layanan PSB
            </div>
            <button type="button" class="btn btn-sm btn-light py-1 px-2 border" id="btnCloseMobileMore" style="border-radius: 50%; font-size: 0.85rem; line-height: 1;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="row no-gutters mb-2" style="margin-left: -4px; margin-right: -4px;">
            <div class="col-6 px-1">
                <a href="#alur" class="samsung-tile d-flex align-items-center mb-2 samsung-nav-link">
                    <div class="samsung-tile-icon mr-2" style="background-color: #e0f2fe; color: #0284c7;">
                        <i class="fas fa-stream"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 700;">Alur</div>
                        <small class="text-muted" style="font-size: 0.72rem;">Tahapan PSB</small>
                    </div>
                </a>
            </div>
            <div class="col-6 px-1">
                <a href="#kontak" class="samsung-tile d-flex align-items-center mb-2 samsung-nav-link">
                    <div class="samsung-tile-icon mr-2" style="background-color: #fef3c7; color: #d97706;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 700;">Kontak</div>
                        <small class="text-muted" style="font-size: 0.72rem;">Lokasi &amp; Info</small>
                    </div>
                </a>
            </div>
            <div class="col-6 px-1">
                <a href="/pendaftar/login" class="samsung-tile d-flex align-items-center mb-2">
                    <div class="samsung-tile-icon mr-2" style="background-color: #f1f5f9; color: #334155;">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 700;">Masuk</div>
                        <small class="text-muted" style="font-size: 0.72rem;">Portal Santri</small>
                    </div>
                </a>
            </div>
            <div class="col-6 px-1">
                @if(!empty($config->no_wa_humas))
                <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($config->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Humas IMBOS, saya ingin bertanya tentang PSB.') }}" target="_blank" class="samsung-tile d-flex align-items-center mb-2">
                    <div class="samsung-tile-icon mr-2" style="background-color: #ecfdf5; color: #059669;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 700;">Humas</div>
                        <small class="text-muted" style="font-size: 0.72rem;">Chat WA</small>
                    </div>
                </a>
                @endif
            </div>
        </div>

        @if($config->status)
        <a href="/pendaftar/register" class="btn-edu btn-edu-lightblue btn-block text-center py-2 mt-1" style="font-size: 0.90rem; border-radius: 12px !important;">
            <i class="fas fa-user-plus mr-1"></i> Daftar Santri Baru Sekarang
        </a>
        @endif
    </div>

    <!-- Samsung Edge Panel Floating Tab & One UI Flyout Modal (Chat Humas PSB) -->
    @if(!empty($config->no_wa_humas))
    <!-- Floating Samsung Edge Handle Tab on Right Screen Edge -->
    <div id="samsungEdgeTab" class="samsung-edge-tab edge-docked" role="button" aria-label="Buka Chat Humas PSB" title="Geser untuk mengatur posisi vertikal, klik untuk Chat Humas">
        <div class="samsung-edge-handle-bar"></div>
        <div class="samsung-edge-icon-wrap">
            <i class="fab fa-whatsapp"></i>
            <span class="samsung-edge-online-dot"></span>
        </div>
    </div>

    <!-- Backdrop Overlay for Edge Modal -->
    <div id="edgePopupBackdrop" class="edge-popup-backdrop"></div>

    <!-- Samsung One UI Style Flyout CTA Card -->
    <div id="edgePopupCard" class="edge-popup-card" role="dialog" aria-modal="true" aria-labelledby="edgePopupTitle">
        <div class="edge-popup-header">
            <div class="edge-popup-header-handle"></div>
            <button type="button" class="edge-popup-close-btn" id="btnEdgePopupClose" aria-label="Tutup Popup">
                <i class="fas fa-times"></i>
            </button>
            <div class="d-flex align-items-center">
                <div class="mr-3 position-relative">
                    <img src="{{ asset('theme/images/logo271.png') }}" alt="Logo Humas IMBOS" class="edge-popup-avatar">
                    <span class="edge-popup-avatar-dot"></span>
                </div>
                <div>
                    <span class="edge-popup-badge"><i class="fas fa-headset mr-1"></i> Panitia PSB Online</span>
                    <h5 class="edge-popup-title mb-0" id="edgePopupTitle">Layanan Humas IMBOS</h5>
                </div>
            </div>
        </div>

        <div class="edge-popup-body">
            <div class="edge-chat-bubble">
                <div class="font-weight-bold mb-1" style="color: #065f46;">
                    <i class="fas fa-comment-dots mr-1 text-success"></i> Assalamu'alaikum Ayah/Bunda!
                </div>
                <div>
                    Ada yang ingin ditanyakan seputar pendaftaran santri baru SMPIT &amp; SMAIT Insan Mulia Boarding School? Tim panitia kami siap membantu.
                </div>
                <div class="text-right mt-1">
                    <small class="text-muted" style="font-size: 0.72rem;">Humas IMBOS &bull; Biasanya membalas cepat</small>
                </div>
            </div>

            <div class="edge-info-row mb-3">
                <div class="small text-muted font-weight-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.05em;">Nomor WhatsApp Resmi:</div>
                <div class="font-weight-bold text-dark" style="font-size: 1.05rem;">
                    {{ $config->no_wa_humas ?? '0823-7187-7887' }}
                </div>
            </div>

            <a href="https://api.whatsapp.com/send?phone=62{{ ltrim($config->no_wa_humas, '0') }}&text={{ urlencode('Assalamualaikum Wr. Wb. Saya ingin menanyakan informasi PSB ' . ($config->nama_sekolah ?? 'IMBOS Pringsewu')) }}" 
               target="_blank" 
               class="btn-edge-whatsapp" 
               id="btnConnectWhatsApp">
                <i class="fab fa-whatsapp" style="font-size: 1.35rem;"></i>
                <span>Hubungkan ke WhatsApp</span>
            </a>

            <div class="text-center mt-2">
                <small class="text-muted" style="font-size: 0.72rem;">Klik untuk langsung membuka aplikasi WhatsApp</small>
            </div>
        </div>
    </div>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>

    <script>
        // Header menu scroll transparency effect
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 25) {
                $('.navbar-edu').addClass('navbar-scrolled');
            } else {
                $('.navbar-edu').removeClass('navbar-scrolled');
            }

            // Mobile bottom nav active indicator on scroll (only if Samsung menu is not open)
            if (!$('#mobileSamsungMenu').hasClass('show')) {
                var scrollPos = $(document).scrollTop() + 140;
                var currentSectionIdx = 2; // Default Beranda
                var currentSectionIcon = 'fas fa-home';

                var alurTop = $('#alur').length ? $('#alur').offset().top : 99999;
                var jenjangTop = $('#jenjang').length ? $('#jenjang').offset().top : 99999;
                var jalurTop = $('#jalur').length ? $('#jalur').offset().top : 99999;

                if (scrollPos < alurTop) {
                    currentSectionIdx = 2; // Beranda
                    currentSectionIcon = 'fas fa-home';
                } else if (jalurTop !== 99999 && scrollPos >= jalurTop) {
                    currentSectionIdx = 3; // Jalur
                    currentSectionIcon = 'fas fa-door-open';
                } else if (jenjangTop !== 99999 && scrollPos >= jenjangTop) {
                    currentSectionIdx = 1; // Jenjang
                    currentSectionIcon = 'fas fa-graduation-cap';
                } else if (alurTop !== 99999 && scrollPos >= alurTop) {
                    currentSectionIdx = 0; // Alur
                    currentSectionIcon = 'fas fa-stream';
                }

                if (!$('.curved-nav-item[data-index="' + currentSectionIdx + '"]').hasClass('active')) {
                    setCurvedNavActive(currentSectionIdx, currentSectionIcon, false);
                }
            }
        });

        if ($(window).scrollTop() > 25) {
            $('.navbar-edu').addClass('navbar-scrolled');
        }

        // Active state and slider animation helper
        var previousSectionIdx = 2;
        var previousSectionIcon = 'fas fa-home';

        function setCurvedNavActive(index, iconClass, recordHistory) {
            if (recordHistory !== false && index !== 4) {
                previousSectionIdx = index;
                previousSectionIcon = iconClass;
            }

            $('#curvedNotchSlider').css('transform', 'translateX(' + (index * 100) + '%)');
            $('.curved-nav-item').removeClass('active');
            $('.curved-nav-item[data-index="' + index + '"]').addClass('active');

            if (iconClass) {
                var $icon = $('#curvedNotchIcon');
                $icon.css({ opacity: 0, transform: 'scale(0.5)' });
                setTimeout(function() {
                    $icon.attr('class', 'notch-bubble-icon ' + iconClass);
                    $icon.css({ opacity: 1, transform: 'scale(1)' });
                }, 140);
            }
        }

        // Smooth scroll for curved bottom nav hash links
        $('.curved-nav-item[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var targetId = $(this).attr('href');
            var index = parseInt($(this).data('index'), 10);
            var icon = $(this).data('icon');

            toggleMobileMore(false);
            setCurvedNavActive(index, icon, true);

            if (targetId === '#beranda') {
                $('html, body').stop().animate({ scrollTop: 0 }, 450);
            } else {
                var target = $(targetId);
                if (target.length) {
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 450);
                }
            }
        });

        // Toggle Samsung One UI Mobile More Submenu
        function toggleMobileMore(show) {
            if (show) {
                $('#mobileMoreBackdrop').addClass('show');
                $('#mobileSamsungMenu').addClass('show');
                $('#iconMobileMore').removeClass('fa-th-large').addClass('fa-times text-danger');
                setCurvedNavActive(4, 'fas fa-th-large', false);
            } else {
                $('#mobileMoreBackdrop').removeClass('show');
                $('#mobileSamsungMenu').removeClass('show');
                $('#iconMobileMore').removeClass('fa-times text-danger').addClass('fa-th-large');
                setCurvedNavActive(previousSectionIdx, previousSectionIcon, false);
            }
        }

        $('#btnOpenMobileMore').on('click', function(e) {
            e.preventDefault();
            $(this).blur();
            var isOpen = $('#mobileSamsungMenu').hasClass('show');
            toggleMobileMore(!isOpen);
        });

        $('#btnCloseMobileMore, #mobileMoreBackdrop').on('click', function() {
            toggleMobileMore(false);
        });

        // Smooth scroll for submenu hash links
        $('.samsung-nav-link').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                toggleMobileMore(false);
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 70
                }, 450);
            }
        });

        // Interactive Jenjang Slide Controller (Smooth in-place switching, zero empty space)
        var currentJenjangSlide = 0;

        function setJenjangSlide(slideIdx) {
            currentJenjangSlide = slideIdx;

            if (slideIdx === 0) {
                $('#jenjangSlide0').addClass('active').removeClass('is-past');
                $('#jenjangSlide1').removeClass('active is-past');
                $('#railBtn0').addClass('active');
                $('#railBtn1').removeClass('active');
            } else {
                $('#jenjangSlide0').removeClass('active').addClass('is-past');
                $('#jenjangSlide1').addClass('active').removeClass('is-past');
                $('#railBtn1').addClass('active');
                $('#railBtn0').removeClass('active');
            }
        }

        // Click handler on rail tabs: direct slide change without jumping or scrolling into empty space!
        $('.rail-step-btn').on('click', function(e) {
            e.preventDefault();
            var slideIdx = parseInt($(this).data('slide'), 10);
            setJenjangSlide(slideIdx);
        });

        // Mousewheel listener on desktop: smooth slide transition between 0 and 1, without page jumping
        var jenjangWheelThrottled = false;
        $('#jenjang').on('wheel', function(e) {
            if ($(window).width() >= 992) {
                var delta = e.originalEvent.deltaY;
                if (!jenjangWheelThrottled) {
                    if (delta > 40 && currentJenjangSlide === 0) {
                        e.preventDefault();
                        jenjangWheelThrottled = true;
                        setJenjangSlide(1);
                        setTimeout(function() { jenjangWheelThrottled = false; }, 450);
                    } else if (delta < -40 && currentJenjangSlide === 1) {
                        e.preventDefault();
                        jenjangWheelThrottled = true;
                        setJenjangSlide(0);
                        setTimeout(function() { jenjangWheelThrottled = false; }, 450);
                    }
                }
            }
        });

        // Touch swipe listener on mobile
        var jenjangTouchStartX = 0;
        $('#jenjang').on('touchstart', function(e) {
            if (e.originalEvent.touches && e.originalEvent.touches.length) {
                jenjangTouchStartX = e.originalEvent.touches[0].screenX;
            }
        });
        $('#jenjang').on('touchend', function(e) {
            if (e.originalEvent.changedTouches && e.originalEvent.changedTouches.length) {
                var diff = jenjangTouchStartX - e.originalEvent.changedTouches[0].screenX;
                if (Math.abs(diff) > 45) {
                    if (diff > 0 && currentJenjangSlide === 0) {
                        setJenjangSlide(1);
                    } else if (diff < 0 && currentJenjangSlide === 1) {
                        setJenjangSlide(0);
                    }
                }
            }
        });

        // Vertical Scroll Slider Controller for Jalur Seleksi
        var currentJalurSlide = 0;
        var totalJalurSlides = $('.jalur-vslide-card').length;

        function setJalurSlide(idx) {
            if (idx < 0 || idx >= totalJalurSlides) return;
            currentJalurSlide = idx;

            // Update Slide Cards
            $('.jalur-vslide-card').each(function(i) {
                if (i === currentJalurSlide) {
                    $(this).addClass('active').removeClass('is-past');
                } else if (i < currentJalurSlide) {
                    $(this).removeClass('active').addClass('is-past');
                } else {
                    $(this).removeClass('active is-past');
                }
            });

            // Update Rail Buttons
            $('.jalur-vrail-btn').removeClass('active').attr('aria-selected', 'false');
            var $activeBtn = $('.jalur-vrail-btn[data-slide="' + currentJalurSlide + '"]');
            $activeBtn.addClass('active').attr('aria-selected', 'true');

            // On mobile horizontal rail, scroll active button into view
            if ($(window).width() < 992 && $activeBtn.length) {
                var $container = $('.jalur-vrail-list');
                var scrollLeft = $activeBtn.position().left + $container.scrollLeft() - ($container.width() / 2) + ($activeBtn.width() / 2);
                $container.stop().animate({ scrollLeft: scrollLeft }, 250);
            }

            // Update Counter
            $('#jalurCounterCurrent').text(('0' + (currentJalurSlide + 1)).slice(-2));

            // Update Prev/Next Buttons
            $('#btnJalurPrev').prop('disabled', currentJalurSlide === 0);
            $('#btnJalurNext').prop('disabled', currentJalurSlide === totalJalurSlides - 1);
        }

        // Rail button click
        $(document).on('click', '.jalur-vrail-btn', function(e) {
            e.preventDefault();
            var slideIdx = parseInt($(this).data('slide'), 10);
            setJalurSlide(slideIdx);
        });

        // Prev / Next button click
        $('#btnJalurPrev').on('click', function(e) {
            e.preventDefault();
            if (currentJalurSlide > 0) {
                setJalurSlide(currentJalurSlide - 1);
            }
        });

        $('#btnJalurNext').on('click', function(e) {
            e.preventDefault();
            if (currentJalurSlide < totalJalurSlides - 1) {
                setJalurSlide(currentJalurSlide + 1);
            }
        });

        // Mousewheel listener over the vertical slider stage
        var jalurWheelCooldown = false;
        $('.jalur-vslider-stage').on('wheel', function(e) {
            var delta = e.originalEvent.deltaY;
            if (!jalurWheelCooldown) {
                if (delta > 40 && currentJalurSlide < totalJalurSlides - 1) {
                    e.preventDefault();
                    jalurWheelCooldown = true;
                    setJalurSlide(currentJalurSlide + 1);
                    setTimeout(function() { jalurWheelCooldown = false; }, 400);
                } else if (delta < -40 && currentJalurSlide > 0) {
                    e.preventDefault();
                    jalurWheelCooldown = true;
                    setJalurSlide(currentJalurSlide - 1);
                    setTimeout(function() { jalurWheelCooldown = false; }, 400);
                }
            }
        });

        // Mobile touch swipe vertically over the stage
        var jalurTouchStartY = 0;
        $('.jalur-vslider-stage').on('touchstart', function(e) {
            if (e.originalEvent.touches && e.originalEvent.touches.length) {
                jalurTouchStartY = e.originalEvent.touches[0].screenY;
            }
        });
        $('.jalur-vslider-stage').on('touchend', function(e) {
            if (e.originalEvent.changedTouches && e.originalEvent.changedTouches.length) {
                var diffY = jalurTouchStartY - e.originalEvent.changedTouches[0].screenY;
                if (Math.abs(diffY) > 40) {
                    if (diffY > 0 && currentJalurSlide < totalJalurSlides - 1) {
                        setJalurSlide(currentJalurSlide + 1);
                    } else if (diffY < 0 && currentJalurSlide > 0) {
                        setJalurSlide(currentJalurSlide - 1);
                    }
                }
            }
        });

        // ==========================================================================
        // Samsung Edge Panel Floating Tab & One UI Popup Controller
        // ==========================================================================
        (function() {
            var $tab = $('#samsungEdgeTab');
            var $card = $('#edgePopupCard');
            var $backdrop = $('#edgePopupBackdrop');
            if (!$tab.length) return;

            var isDragging = false;
            var hasMoved = false;
            var startY = 0;
            var initialTop = 0;
            var autoDockTimer = null;

            // Auto-dock to edge after 3.5 seconds of inactivity
            function scheduleAutoDock() {
                clearTimeout(autoDockTimer);
                autoDockTimer = setTimeout(function() {
                    if (!isDragging && !$card.hasClass('show')) {
                        $tab.addClass('edge-docked');
                    }
                }, 3500);
            }

            scheduleAutoDock();

            $tab.on('mouseenter', function() {
                clearTimeout(autoDockTimer);
                $tab.removeClass('edge-docked');
            });

            $tab.on('mouseleave', function() {
                scheduleAutoDock();
            });

            // Drag Start
            function onDragStart(clientY) {
                isDragging = true;
                hasMoved = false;
                startY = clientY;
                initialTop = $tab.offset().top - $(window).scrollTop();
                $tab.addClass('is-dragging').removeClass('edge-docked');
                clearTimeout(autoDockTimer);
            }

            // Drag Move
            function onDragMove(clientY) {
                if (!isDragging) return;
                var deltaY = clientY - startY;
                if (Math.abs(deltaY) > 6) {
                    hasMoved = true;
                }
                if (hasMoved) {
                    var newTop = initialTop + deltaY;
                    var winHeight = $(window).height();
                    var tabHeight = $tab.outerHeight() || 50;
                    var minTop = 75; // below top navbar
                    var maxTop = winHeight - tabHeight - 75; // above bottom
                    newTop = Math.max(minTop, Math.min(newTop, maxTop));
                    $tab.css({ top: newTop + 'px' });
                }
            }

            // Drag End
            function onDragEnd() {
                if (!isDragging) return;
                isDragging = false;
                $tab.removeClass('is-dragging');
                scheduleAutoDock();
            }

            // Mouse Drag Listeners
            $tab.on('mousedown', function(e) {
                if (e.which !== 1) return; // Left click only
                onDragStart(e.clientY);
                $(document).on('mousemove.edgeDrag', function(e) {
                    onDragMove(e.clientY);
                });
                $(document).on('mouseup.edgeDrag', function() {
                    $(document).off('.edgeDrag');
                    onDragEnd();
                });
            });

            // Touch Drag Listeners (Mobile & Tablet)
            $tab.on('touchstart', function(e) {
                if (e.originalEvent.touches && e.originalEvent.touches.length) {
                    onDragStart(e.originalEvent.touches[0].clientY);
                }
            });

            $(document).on('touchmove', function(e) {
                if (isDragging && e.originalEvent.touches && e.originalEvent.touches.length) {
                    onDragMove(e.originalEvent.touches[0].clientY);
                }
            });

            $(document).on('touchend touchcancel', function() {
                if (isDragging) {
                    onDragEnd();
                }
            });

            // Click / Tap Handler: open popup only if not dragged
            $tab.on('click', function(e) {
                if (hasMoved) {
                    e.preventDefault();
                    hasMoved = false;
                    return;
                }
                openEdgePopup();
            });

            function openEdgePopup() {
                clearTimeout(autoDockTimer);
                $tab.removeClass('edge-docked');
                $backdrop.addClass('show');
                $card.addClass('show');
            }

            function closeEdgePopup() {
                $backdrop.removeClass('show');
                $card.removeClass('show');
                scheduleAutoDock();
            }

            $('#btnEdgePopupClose, #edgePopupBackdrop').on('click', function(e) {
                e.preventDefault();
                closeEdgePopup();
            });

            // Keyboard ESC to close
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $card.hasClass('show')) {
                    closeEdgePopup();
                }
            });
        })();
    </script>
</body>
</html>
