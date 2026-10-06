<!-- layouts/app.blade.php -->
@include('partials.head')

<div class="wrapper">
    @include('partials.header')

    @include('partials.sidebar_operator')

    <div class="main-panel">
        <div class="container">
            @yield('content')
        </div>
        @include('partials.footer')
    </div>
</div>

@include('partials.scripts')
<!-- Script to handle SweetAlert -->
@include('sweetalert::alert')
</body>
</html>
