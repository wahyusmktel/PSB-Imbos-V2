<!-- partials/sidebar.blade.php -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('pendaftar/dashboard') ? 'active' : '' }}">
                    <a href="/pendaftar/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Main Menu</h4>
                </li>
                <li class="nav-item {{ Request::is('pendaftar-jenjang*') ? 'active' : '' }}">
                    <a href="/pendaftar-jenjang">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Pilih Jenjang</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pendaftar/jalur*') ? 'active' : '' }}">
                    <a href="/pendaftar/jalur">
                        <i class="fas fa-route"></i>
                        <p>Pilih Jalur</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('pendaftar/data-diri*') ? 'active' : '' }}">
                    <a href="/pendaftar/data-diri">
                        <i class="fas fa-user"></i>
                        <p>Formulir</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('pendaftar/transaksi*') ? 'active' : '' }}">
                    <a href="/pendaftar/transaksi">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pendaftar/group-wa*') ? 'active' : '' }}">
                    <a href="/pendaftar/group-wa">
                        <i class="fab fa-whatsapp"></i>
                        <p>Group WA</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ Request::is('pendaftar/formulir/cetak*') ? 'active' : '' }}">
                    <a href="/pendaftar/formulir/cetak">
                        <i class="fas fa-print"></i>
                        <p>Cetak</p>
                    </a>
                </li> --}}
                <li class="nav-item {{ Request::is('pendaftar/info-seleksi*') ? 'active' : '' }}">
                    <a href="/pendaftar/info-seleksi">
                        <i class="fas fa-info-circle"></i>
                        <p>Info Seleksi</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pendaftar/hasil-seleksi*') ? 'active' : '' }}">
                    <a href="/pendaftar/hasil-seleksi">
                        <i class="fas fa-check-circle"></i>
                        <p>Hasil Seleksi</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
