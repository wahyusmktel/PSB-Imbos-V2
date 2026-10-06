<!-- partials/sidebar_operator.blade.php -->
<div class="sidebar sidebar-style-2 ios-styled-sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary ios-nav-list">
                <!-- Dashboard -->
                <li class="nav-item {{ Request::is('operator/dashboard') ? 'active' : '' }}">
                    <a href="/operator/dashboard" class="ios-menu-link">
                        <span class="ios-icon-box ios-bg-blue">
                            <i class="fas fa-th-large"></i>
                        </span>
                        <span class="ios-menu-title">Dashboard</span>
                    </a>
                </li>

                <!-- Section: MAIN MENU -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section ios-section-label">MAIN MENU</h4>
                </li>

                <!-- Pendaftar -->
                <li class="nav-item {{ Request::is('operator/pendaftar*') ? 'active' : '' }}">
                    <a href="/operator/pendaftar" class="ios-menu-link">
                        <span class="ios-icon-box ios-bg-purple">
                            <i class="fas fa-user-graduate"></i>
                        </span>
                        <span class="ios-menu-title">Pendaftar</span>
                    </a>
                </li>

                <!-- Transaksi -->
                <li class="nav-item {{ Request::is('operator/transaksi*') ? 'active' : '' }}">
                    <a href="/operator/transaksi" class="ios-menu-link">
                        <span class="ios-icon-box ios-bg-green">
                            <i class="fas fa-wallet"></i>
                        </span>
                        <span class="ios-menu-title">Transaksi</span>
                    </a>
                </li>

                <!-- MENU UTAMA DENGAN SUBMENU TREEVIEW: KELOLA LANDING PAGE -->
                <li class="nav-item {{ Request::is('operator/landing*') ? 'active submenu ios-parent-active' : '' }}">
                    <a data-toggle="collapse" href="#menuKelolaLanding" class="ios-menu-link ios-collapse-trigger {{ Request::is('operator/landing*') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is('operator/landing*') ? 'true' : 'false' }}">
                        <span class="ios-icon-box ios-bg-cyan">
                            <i class="fas fa-desktop"></i>
                        </span>
                        <span class="ios-menu-title">Kelola Landing Page</span>
                        <i class="fas fa-chevron-right ios-caret ml-auto"></i>
                    </a>
                    
                    <div class="collapse {{ Request::is('operator/landing*') ? 'show' : '' }}" id="menuKelolaLanding">
                        <div class="ios-treeview-box">
                            <ul class="ios-treeview-list">
                                <!-- Konten Utama -->
                                <li class="{{ Request::is('operator/landing/konten*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.konten') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Konten Landing Page</span>
                                    </a>
                                </li>

                                <!-- Slider Login & Register -->
                                <li class="{{ Request::is('operator/landing/slider*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.slider') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Slider Login &amp; Register</span>
                                    </a>
                                </li>

                                <!-- Alur Seleksi -->
                                <li class="{{ Request::is('operator/landing/alur*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.alur') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Alur Seleksi</span>
                                    </a>
                                </li>

                                <!-- Jenjang Pendidikan -->
                                <li class="{{ Request::is('operator/landing/jenjang*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.jenjang') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Jenjang Pendidikan</span>
                                    </a>
                                </li>

                                <!-- Jalur Pendaftaran -->
                                <li class="{{ Request::is('operator/landing/jalur*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.jalur') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Jalur Pendaftaran</span>
                                    </a>
                                </li>

                                <!-- Pengaturan & Rekening -->
                                <li class="{{ Request::is('operator/landing/pengaturan*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.pengaturan') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Pengaturan &amp; Rekening</span>
                                    </a>
                                </li>

                                <!-- Kelola FAQ -->
                                <li class="{{ Request::is('operator/landing/faq*') ? 'active' : '' }}">
                                    <a href="{{ route('operator.landing.faq') }}" class="ios-tree-link">
                                        <span class="ios-tree-dot"></span>
                                        <span class="ios-tree-text">Kelola FAQ</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- SECTION KHUSUS SUPER ADMIN -->
                @if(Auth::guard('operator')->check() && Auth::guard('operator')->user()->isSuperAdmin())
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-shield-alt ios-mini-shield"></i>
                    </span>
                    <h4 class="text-section ios-section-label" style="color: #ea580c !important;">SUPER ADMIN</h4>
                </li>
                <li class="nav-item {{ Request::is('superadmin/database*') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.database.index') }}" class="ios-menu-link">
                        <span class="ios-icon-box ios-bg-amber">
                            <i class="fas fa-database"></i>
                        </span>
                        <span class="ios-menu-title">Backup &amp; Restore SQL</span>
                    </a>
                </li>
                @endif

                <!-- Tautan Eksternal Preview -->
                <li class="nav-item">
                    <a href="/" target="_blank" class="ios-menu-link">
                        <span class="ios-icon-box ios-bg-gray">
                            <i class="fas fa-external-link-alt"></i>
                        </span>
                        <span class="ios-menu-title">Lihat Landing Page</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    /* =========================================================
       CLEAN APPLE iOS MODERN SIDEBAR - SINKRON & PRESISI
       ========================================================= */

    /* Container nav */
    .sidebar.ios-styled-sidebar .nav.nav-primary {
        padding: 0 4px !important;
    }

    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item {
        margin-bottom: 2px !important;
    }

    /* Menu Link */
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a.ios-menu-link {
        background: transparent !important;
        box-shadow: none !important;
        border-radius: 9px !important;
        padding: 7px 10px !important;
        margin: 1px 4px !important;
        display: flex !important;
        align-items: center !important;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        border: 1px solid transparent !important;
        white-space: nowrap !important;
    }

    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a.ios-menu-link:hover {
        background: #f1f5f9 !important;
        transform: translateX(2px);
    }

    /* Force correct text colors (Anti-override Atlantis CSS) */
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item a .ios-menu-title,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active > a .ios-menu-title,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item a p,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active > a p {
        color: #1e293b !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        margin: 0 !important;
        white-space: nowrap !important;
        letter-spacing: -0.1px !important;
    }

    /* Active Single Menu Item */
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active:not(.submenu) > a {
        background: #f0f7ff !important;
        border-color: #bae6fd !important;
    }
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active:not(.submenu) > a .ios-menu-title {
        color: #0284c7 !important;
        font-weight: 600 !important;
    }

    /* Parent Collapsible (Kelola Landing Page) Active/Expanded */
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active.submenu > a,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.ios-parent-active > a {
        background: #f8fafc !important;
        border-color: #e2e8f0 !important;
    }
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active.submenu > a .ios-menu-title,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.ios-parent-active > a .ios-menu-title {
        color: #0f172a !important;
        font-weight: 600 !important;
    }

    /* Hide standard Atlantis caret */
    .sidebar.ios-styled-sidebar .nav-item .caret {
        display: none !important;
    }

    /* Section Label */
    .ios-section-label {
        font-size: 10.5px !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        color: #94a3b8 !important;
        padding-left: 12px !important;
        margin-top: 12px !important;
        margin-bottom: 5px !important;
        text-transform: uppercase !important;
    }

    /* =========================================================
       iOS SQUIRCLE ICON BOX (SINKRON, TERPUSAT & WARNA PUTIH BERSILAU)
       ========================================================= */
    .ios-icon-box {
        width: 28px !important;
        height: 28px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-right: 10px !important;
        flex-shrink: 0 !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        position: relative !important;
    }

    .ios-menu-link:hover .ios-icon-box {
        transform: scale(1.06);
    }

    /* CRITICAL: FORCE ALL ICONS INSIDE .ios-icon-box TO BE PURE WHITE (#ffffff) */
    .sidebar.ios-styled-sidebar .nav .nav-item a .ios-icon-box i,
    .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a .ios-icon-box i,
    .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item > a .ios-icon-box i,
    .sidebar.sidebar-style-2 .nav .nav-item a .ios-icon-box i,
    .ios-icon-box i {
        color: #ffffff !important;
        font-size: 12.5px !important;
        line-height: 1 !important;
        display: inline-block !important;
        margin: 0 !important;
        padding: 0 !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    /* Apple-Inspired Unified Soft Gradients */
    .ios-bg-blue   { background: linear-gradient(135deg, #007aff, #0056b3) !important; box-shadow: 0 2px 6px rgba(0, 122, 255, 0.3) !important; }
    .ios-bg-purple { background: linear-gradient(135deg, #5856d6, #3b3a98) !important; box-shadow: 0 2px 6px rgba(88, 86, 214, 0.3) !important; }
    .ios-bg-green  { background: linear-gradient(135deg, #34c759, #248a3d) !important; box-shadow: 0 2px 6px rgba(52, 199, 89, 0.3) !important; }
    .ios-bg-cyan   { background: linear-gradient(135deg, #0284c7, #0369a1) !important; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.3) !important; }
    .ios-bg-amber  { background: linear-gradient(135deg, #ff9500, #cc7700) !important; box-shadow: 0 2px 6px rgba(255, 149, 0, 0.3) !important; }
    .ios-bg-gray   { background: linear-gradient(135deg, #8e8e93, #636366) !important; box-shadow: 0 2px 6px rgba(142, 142, 147, 0.25) !important; }

    /* Rotating Chevron Indicator */
    .ios-caret {
        font-size: 10.5px !important;
        color: #94a3b8 !important;
        margin-left: auto !important;
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), color 0.2s ease !important;
    }

    .ios-collapse-trigger:not(.collapsed) .ios-caret {
        transform: rotate(90deg) !important;
        color: #0284c7 !important;
    }

    /* =========================================================
       100% SINKRON & MENYATU TREEVIEW SUBMENU
       ========================================================= */
    .ios-treeview-box {
        position: relative;
        padding-left: 28px;
        margin: 2px 4px 6px 4px;
    }

    /* Continuous Soft Guide Rail (Tepat Segaris dengan Tengah Icon Kelola Landing Page) */
    .ios-treeview-box::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 12px;
        left: 23px; /* Garis vertikal persis segaris */
        width: 1.5px;
        background: #cbd5e1;
        border-radius: 99px;
        z-index: 1;
    }

    .ios-treeview-list {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        position: relative;
        z-index: 2;
    }

    .ios-treeview-list li {
        position: relative;
        margin-bottom: 2px;
    }

    /* Garis Cabang Horizontal Menempel 100% Presisi ke Garis Vertikal */
    .ios-treeview-list li::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -5px; /* Menempel langsung dari garis vertikal (23px) ke titik dot */
        width: 10px;
        height: 1.5px;
        background: #cbd5e1;
        transform: translateY(-50%);
        transition: background 0.2s ease;
    }

    /* Link Submenu */
    .ios-tree-link {
        display: flex !important;
        align-items: center !important;
        padding: 6px 10px 6px 8px !important;
        border-radius: 7px !important;
        text-decoration: none !important;
        transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    /* Titik Dot Node Menempel di Ujung Cabang */
    .ios-tree-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #94a3b8;
        margin-right: 8px;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    /* Teks Submenu */
    .ios-tree-text {
        font-size: 12.8px !important;
        font-weight: 500 !important;
        color: #475569 !important;
        letter-spacing: -0.1px !important;
        transition: color 0.18s ease;
        white-space: nowrap !important;
    }

    /* Submenu Hover State */
    .ios-treeview-list li:hover::before {
        background: #93c5fd;
    }
    .ios-tree-link:hover {
        background: #f8fafc !important;
        transform: translateX(2px);
    }
    .ios-tree-link:hover .ios-tree-dot {
        background: #0284c7;
        transform: scale(1.3);
    }
    .ios-tree-link:hover .ios-tree-text {
        color: #0284c7 !important;
    }

    /* ACTIVE SUBMENU STATE (Sinkron, Rapi & Elegan) */
    .ios-treeview-list li.active::before {
        background: #0284c7;
        height: 2px;
    }
    .ios-treeview-list li.active .ios-tree-link {
        background: #eff6ff !important;
        box-shadow: 0 1px 3px rgba(2, 132, 199, 0.08) !important;
    }
    .ios-treeview-list li.active .ios-tree-dot {
        background: #0284c7 !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.25) !important;
        transform: scale(1.2);
    }
    .ios-treeview-list li.active .ios-tree-text {
        color: #0284c7 !important;
        font-weight: 600 !important;
    }

    /* =========================================================
       SIDEBAR SAAT DISEMBUNYIKAN / COLLAPSED (PRESISI & PERSIS DI TENGAH)
       ========================================================= */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) {
        width: 75px !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .sidebar-wrapper,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .sidebar-wrapper {
        width: 75px !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary > .nav-item {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        margin: 3px 0 !important;
        padding: 0 !important;
        text-align: center !important;
    }

    /* Tombol Item Menu Saat Disembunyikan: Kotak Rapi Presisi 44x44px Tepat di Tengah */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a.ios-menu-link,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary > .nav-item > a.ios-menu-link {
        width: 44px !important;
        height: 44px !important;
        min-width: 44px !important;
        max-width: 44px !important;
        padding: 0 !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 12px !important;
        border: 1px solid transparent !important;
        transform: none !important;
        text-align: center !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a.ios-menu-link:hover,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary > .nav-item > a.ios-menu-link:hover {
        background: #f1f5f9 !important;
        transform: none !important;
    }

    /* Active Highlight Saat Disembunyikan: Melingkari Icon Presisi di Tengah */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.active > a.ios-menu-link,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary > .nav-item.active > a.ios-menu-link,
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item.ios-parent-active > a.ios-menu-link,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav.nav-primary > .nav-item.ios-parent-active > a.ios-menu-link {
        background: #f0f7ff !important;
        border: 1px solid #bae6fd !important;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.15) !important;
        width: 44px !important;
        height: 44px !important;
        margin: 0 auto !important;
    }

    /* Icon Box Squircle iOS: Hapus margin-right, Posisi Persis Tengah */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .ios-icon-box,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .ios-icon-box {
        margin: 0 !important;
        margin-right: 0 !important;
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transform: none !important;
        flex-shrink: 0 !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .ios-icon-box i,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .ios-icon-box i {
        color: #ffffff !important;
        font-size: 13.5px !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
        text-align: center !important;
    }

    /* Sembunyikan Teks, Caret, & Treeview Accordion Saat Collapsed */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .ios-menu-title,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .ios-menu-title,
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .ios-caret,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .ios-caret,
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .ios-treeview-box,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .ios-treeview-box,
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .collapse,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .collapse {
        display: none !important;
    }

    /* Nav Section (Separator Titik-titik & Shield): Sentris Sempurna */
    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav-section,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav-section {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
        margin: 14px 0 6px 0 !important;
        padding: 0 !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav-section .sidebar-mini-icon,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav-section .sidebar-mini-icon {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 32px !important;
        height: 20px !important;
        margin: 0 auto !important;
        text-align: center !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav-section .sidebar-mini-icon i,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav-section .sidebar-mini-icon i {
        display: inline-block !important;
        margin: 0 auto !important;
        text-align: center !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .nav-section .sidebar-mini-icon .ios-mini-shield,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .nav-section .sidebar-mini-icon .ios-mini-shield {
        color: #ea580c !important;
        font-size: 13px !important;
    }

    .sidebar_minimize:not(.sidebar_minimize_hover) .sidebar.ios-styled-sidebar .text-section,
    .sidebar_minimize .sidebar.ios-styled-sidebar:not(:hover) .text-section {
        display: none !important;
    }

    /* =========================================================
       HOVER EXPAND STATE SAAT SIDEBAR DIMINIMALKAN
       ========================================================= */
    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover {
        width: 250px !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .sidebar-wrapper,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .sidebar-wrapper {
        width: 250px !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .nav.nav-primary,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .nav.nav-primary {
        padding: 0 4px !important;
        align-items: stretch !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .nav.nav-primary > .nav-item {
        justify-content: flex-start !important;
        text-align: left !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .nav.nav-primary > .nav-item > a.ios-menu-link,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .nav.nav-primary > .nav-item > a.ios-menu-link {
        width: auto !important;
        height: auto !important;
        min-width: unset !important;
        max-width: unset !important;
        padding: 7px 10px !important;
        margin: 1px 4px !important;
        justify-content: flex-start !important;
        border-radius: 9px !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .ios-icon-box,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .ios-icon-box {
        margin-right: 10px !important;
        width: 28px !important;
        height: 28px !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .ios-menu-title,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .ios-menu-title {
        display: inline-block !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .ios-caret,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .ios-caret {
        display: inline-block !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .text-section,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .text-section {
        display: block !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .nav-section .sidebar-mini-icon,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .nav-section .sidebar-mini-icon {
        display: none !important;
    }

    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .collapse.show,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .collapse.show,
    .sidebar_minimize.sidebar_minimize_hover .sidebar.ios-styled-sidebar .ios-treeview-box,
    .sidebar_minimize .sidebar.ios-styled-sidebar:hover .ios-treeview-box {
        display: block !important;
    }
</style>
