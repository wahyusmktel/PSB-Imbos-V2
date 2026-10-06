<!-- partials/header.blade.php -->
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="grey">
        <a href="{{ url('/pendaftar/dashboard') }}" class="logo">
            <img src="{{ asset('img/logo-header.png') }}" width="150" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue">
        <!-- Navbar content here -->
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ $biodata && $biodata->pas_photo ? asset('storage/' . $biodata->pas_photo) : asset('img/profile.jpg') }}"
                                alt="Profile" class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <!-- Cek apakah ada foto di database -->
                                        <img src="{{ $biodata && $biodata->pas_photo ? asset('storage/' . $biodata->pas_photo) : asset('img/profile.jpg') }}"
                                            alt="Profile Image" class="avatar-img rounded">
                                    </div>
                                    <div class="u-text">
                                        @if (Auth::guard('pendaftar')->check())
                                            <h4>{{ Auth::guard('pendaftar')->user()->nama_lengkap }}</h4>
                                            <!-- Tampilkan nama pendaftar -->
                                        @elseif(Auth::guard('operator')->check())
                                            <h4>{{ Auth::guard('operator')->user()->nama_operator }}</h4>
                                            @if(Auth::guard('operator')->user()->isSuperAdmin())
                                                <span class="badge badge-warning text-dark font-weight-bold" style="font-size: 0.70rem;">
                                                    <i class="fas fa-shield-alt mr-1"></i> SUPER ADMIN
                                                </span>
                                            @else
                                                <span class="badge badge-primary font-weight-bold" style="font-size: 0.70rem;">
                                                    OPERATOR
                                                </span>
                                            @endif
                                        @else
                                            <h4>Guest</h4> <!-- Atau berikan nama default jika tidak ada yang login -->
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <!-- Form logout -->
                                @if (Auth::guard('operator')->check())
                                    <form id="logout-form" action="{{ route('operator.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                @else
                                    <form id="logout-form" action="{{ route('pendaftar.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                @endif
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
