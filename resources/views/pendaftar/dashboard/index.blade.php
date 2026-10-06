@extends('layouts.app')

@section('title', 'Dashboard Pendaftar')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Assalamualaikum</h2>
                    <h5 class="text-white op-7 mb-2">Selamat datang di halaman dashboard Pendaftaran Santri Baru Nama Sekolah
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Perhatian !</div>
                        <div class="card-category">Silahkan Lengkapi Proses Pendaftaran anda !</div>
                        {{-- <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <h6 class="fw-bold mt-3 mb-0">New Users</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Sales</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Subscribers</h6>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt--2">
            <div class="col-md-12">

                {{-- Timeline --}}
                <!-- TimeLine -->
                <h4 class="page-title">Pusat Informasi PSB</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="timeline">
                            @foreach ($pengumumans as $pengumuman)
                                <li class="{{ $loop->iteration % 2 == 0 ? 'timeline-inverted' : '' }}">
                                    <div class="timeline-badge {{ $pengumuman->status ? 'success' : 'danger' }}">
                                        <i class="flaticon-alarm-1"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">{{ $pengumuman->judul_pengumuman }}</h4>
                                            <p><small class="text-muted"><i class="flaticon-alarm-1"></i>
                                                    {{ $pengumuman->created_at->diffForHumans() }}</small></p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>{{ $pengumuman->isi_pengumuman }}</p>
                                            @if ($pengumuman->photo)
                                                <img src="{{ asset('storage/' . $pengumuman->photo) }}"
                                                    alt="Pengumuman Image" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{-- End --}}

            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:60,
        maxValue:100,
        width:7,
        text: 5,
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    });

    Circles.create({
        id:'circles-2',
        radius:45,
        value:70,
        maxValue:100,
        width:7,
        text: 36,
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    });

    Circles.create({
        id:'circles-3',
        radius:45,
        value:40,
        maxValue:100,
        width:7,
        text: 12,
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    });
</script>
@endsection --}}


{{-- <div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Selamat datang di Dashboard Pendaftar</h1>
            <p>Anda telah berhasil login sebagai pendaftar.</p>
        </div>
    </div>
    <div class="row">
        <h3 class="text-center">Pengumuman</h3>

        @if ($pengumumans->isEmpty())
            <p class="text-center">Belum ada pengumuman.</p>
        @else
            @foreach ($pengumumans as $pengumuman)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $pengumuman->judul_pengumuman }}</h5>
                    <p class="card-text">{{ $pengumuman->isi_pengumuman }}</p>
                    @if ($pengumuman->photo)
                        <img src="{{ asset('storage/' . $pengumuman->photo) }}" class="img-fluid" alt="Pengumuman">
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div> --}}
