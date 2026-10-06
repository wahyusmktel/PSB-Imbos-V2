@extends('layouts.app_operator')

@section('title', 'Dashboard Operator')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Assalamualaikum</h2>
                    <h5 class="text-white op-7 mb-2">Selamat datang di halaman dashboard Operator
                        {{ $operator->nama_operator }}</h5>
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
                        <div class="card-category">Ini adalah halaman dashboard operator. Silakan kelola sistem sesuai tugas
                            Anda.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Widget: Total Jumlah Pendaftar -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-secondary mr-3">
                            <i class="fa fa-users"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftar }} <small>Pendaftar</small></a></b>
                            </h5>
                            <small class="text-muted">Total pendaftar</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Jumlah Pendaftar Jenjang SMP -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-success mr-3">
                            <i class="fa fa-school"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftarSMP }} <small>Pendaftar
                                            SMP</small></a></b></h5>
                            <small class="text-muted">Pendaftar jenjang SMP</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Jumlah Pendaftar Jenjang SMA -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-danger mr-3">
                            <i class="fa fa-graduation-cap"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftarSMA }} <small>Pendaftar
                                            SMA</small></a></b></h5>
                            <small class="text-muted">Pendaftar jenjang SMA</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Pendaftar Sudah Membayar -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-warning mr-3">
                            <i class="fa fa-credit-card"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahSudahBayar }} <small>Sudah
                                            Membayar</small></a></b></h5>
                            <small class="text-muted">Jumlah yang sudah membayar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm" style="border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <!-- Card Header dengan Switcher & Badges -->
                    <div class="card-header bg-white py-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center" style="gap: 12px;">
                        <div>
                            <div class="d-flex align-items-center">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                    <i class="fas fa-chart-line fa-lg"></i>
                                </div>
                                <div>
                                    <h4 class="card-title font-weight-bold text-dark mb-0">Statistik &amp; Tren Pendaftar</h4>
                                    <small class="text-muted">Grafik pertumbuhan pendaftaran santri baru dalam 6 bulan terakhir</small>
                                </div>
                            </div>
                        </div>

                        <!-- Kontrol Switcher Tipe Chart & Legend Badges -->
                        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                            <!-- Jenjang Badges (Clickable Legend) -->
                            <div class="d-flex flex-wrap" style="gap: 6px;">
                                <button type="button" class="btn btn-xs chart-legend-toggle active" data-dataset="0" id="legendSma" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-weight: 600; border-radius: 6px; padding: 4px 10px;">
                                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #0284c7; margin-right: 5px;"></span>
                                    SMA ({{ $jumlahPendaftarSMA }})
                                </button>
                                <button type="button" class="btn btn-xs chart-legend-toggle active" data-dataset="1" id="legendSmp" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-weight: 600; border-radius: 6px; padding: 4px 10px;">
                                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #f59e0b; margin-right: 5px;"></span>
                                    SMP ({{ $jumlahPendaftarSMP }})
                                </button>
                                <button type="button" class="btn btn-xs chart-legend-toggle active" data-dataset="2" id="legendNoJenjang" style="background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; font-weight: 600; border-radius: 6px; padding: 4px 10px;">
                                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #a855f7; margin-right: 5px;"></span>
                                    Belum Memilih ({{ max(0, $jumlahPendaftar - $jumlahPendaftarSMA - $jumlahPendaftarSMP) }})
                                </button>
                            </div>

                            <!-- Switcher Tipe Chart -->
                            <div class="btn-group btn-group-toggle ml-md-2" data-toggle="buttons" style="background: #f1f5f9; padding: 3px; border-radius: 8px;">
                                <label class="btn btn-xs btn-white active shadow-none font-weight-bold" id="btnTypeArea" style="border-radius: 6px; border: none; padding: 5px 10px; cursor: pointer;">
                                    <input type="radio" name="chartType" checked> <i class="fas fa-chart-area mr-1"></i> Area
                                </label>
                                <label class="btn btn-xs text-muted shadow-none font-weight-bold" id="btnTypeBar" style="border-radius: 6px; border: none; padding: 5px 10px; cursor: pointer;">
                                    <input type="radio" name="chartType"> <i class="fas fa-chart-bar mr-1"></i> Bar
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <div class="chart-container position-relative" style="min-height: 380px; height: 380px;">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load jQuery & Chart.js -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var canvas = document.getElementById('statisticsChart');
                if (!canvas) return;
                var ctx = canvas.getContext('2d');

                // Generate Modern Linear Gradients
                var gradientSma = ctx.createLinearGradient(0, 0, 0, 360);
                gradientSma.addColorStop(0, 'rgba(2, 132, 199, 0.40)');
                gradientSma.addColorStop(0.7, 'rgba(2, 132, 199, 0.08)');
                gradientSma.addColorStop(1, 'rgba(2, 132, 199, 0.00)');

                var gradientSmp = ctx.createLinearGradient(0, 0, 0, 360);
                gradientSmp.addColorStop(0, 'rgba(245, 158, 11, 0.40)');
                gradientSmp.addColorStop(0.7, 'rgba(245, 158, 11, 0.08)');
                gradientSmp.addColorStop(1, 'rgba(245, 158, 11, 0.00)');

                var gradientNoJenjang = ctx.createLinearGradient(0, 0, 0, 360);
                gradientNoJenjang.addColorStop(0, 'rgba(168, 85, 247, 0.35)');
                gradientNoJenjang.addColorStop(0.7, 'rgba(168, 85, 247, 0.06)');
                gradientNoJenjang.addColorStop(1, 'rgba(168, 85, 247, 0.00)');

                var labels = {!! json_encode($months) !!};
                var smaData = {!! json_encode($smaCounts) !!};
                var smpData = {!! json_encode($smpCounts) !!};
                var noJenjangData = {!! json_encode($noJenjangCounts) !!};

                var chartConfig = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Jenjang SMA",
                                data: smaData,
                                borderColor: '#0284c7',
                                borderWidth: 3,
                                backgroundColor: gradientSma,
                                fill: true,
                                tension: 0.42,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#0284c7',
                                pointBorderWidth: 2.5,
                                pointRadius: 4,
                                pointHoverRadius: 7,
                                pointHoverBackgroundColor: '#0284c7',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 3
                            },
                            {
                                label: "Jenjang SMP",
                                data: smpData,
                                borderColor: '#f59e0b',
                                borderWidth: 3,
                                backgroundColor: gradientSmp,
                                fill: true,
                                tension: 0.42,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#f59e0b',
                                pointBorderWidth: 2.5,
                                pointRadius: 4,
                                pointHoverRadius: 7,
                                pointHoverBackgroundColor: '#f59e0b',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 3
                            },
                            {
                                label: "Belum Memilih Jenjang",
                                data: noJenjangData,
                                borderColor: '#a855f7',
                                borderWidth: 2.5,
                                backgroundColor: gradientNoJenjang,
                                fill: true,
                                tension: 0.42,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#a855f7',
                                pointBorderWidth: 2,
                                pointRadius: 3,
                                pointHoverRadius: 6,
                                pointHoverBackgroundColor: '#a855f7',
                                pointHoverBorderColor: '#ffffff',
                                pointHoverBorderWidth: 3
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false // Menggunakan interactive header legend buatan
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.94)',
                                titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13, weight: '700' },
                                bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '500' },
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: true,
                                boxWidth: 8,
                                boxHeight: 8,
                                boxPadding: 4,
                                usePointStyle: true,
                                callbacks: {
                                    label: function(context) {
                                        var label = context.dataset.label || '';
                                        return ' ' + label + ': ' + context.parsed.y + ' Santri';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#64748b',
                                    font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '500' },
                                    padding: 8
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f1f5f9',
                                    borderDash: [5, 5],
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#64748b',
                                    font: { family: "'Plus Jakarta Sans', sans-serif", size: 12, weight: '500' },
                                    padding: 10,
                                    precision: 0
                                }
                            }
                        },
                        animation: {
                            duration: 1100,
                            easing: 'easeOutQuart'
                        }
                    }
                };

                var myChart = new Chart(ctx, chartConfig);

                // Switcher Tipe Chart (Area vs Bar)
                $('#btnTypeArea').on('click', function() {
                    $(this).addClass('btn-white active text-dark').removeClass('text-muted');
                    $('#btnTypeBar').removeClass('btn-white active text-dark').addClass('text-muted');
                    
                    myChart.config.type = 'line';
                    myChart.data.datasets.forEach(function(ds, idx) {
                        ds.fill = true;
                        ds.borderRadius = 0;
                        if (idx === 0) ds.backgroundColor = gradientSma;
                        if (idx === 1) ds.backgroundColor = gradientSmp;
                        if (idx === 2) ds.backgroundColor = gradientNoJenjang;
                    });
                    myChart.update();
                });

                $('#btnTypeBar').on('click', function() {
                    $(this).addClass('btn-white active text-dark').removeClass('text-muted');
                    $('#btnTypeArea').removeClass('btn-white active text-dark').addClass('text-muted');

                    myChart.config.type = 'bar';
                    myChart.data.datasets.forEach(function(ds, idx) {
                        ds.fill = false;
                        ds.borderRadius = 6;
                        if (idx === 0) ds.backgroundColor = '#0284c7';
                        if (idx === 1) ds.backgroundColor = '#f59e0b';
                        if (idx === 2) ds.backgroundColor = '#a855f7';
                    });
                    myChart.update();
                });

                // Interactive Legend Toggle
                $('.chart-legend-toggle').on('click', function() {
                    var dsIndex = $(this).data('dataset');
                    var isVisible = myChart.isDatasetVisible(dsIndex);

                    if (isVisible) {
                        myChart.hide(dsIndex);
                        $(this).removeClass('active').css('opacity', '0.45');
                    } else {
                        myChart.show(dsIndex);
                        $(this).addClass('active').css('opacity', '1');
                    }
                });
            });
        </script>


        {{-- Timeline --}}
        {{-- <div class="row mt--2">
            <div class="col-md-12">
                <h4 class="page-title">Pusat Informasi Sistem</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="timeline">
                            @foreach ($informasi as $info)
                                <li class="{{ $loop->iteration % 2 == 0 ? 'timeline-inverted' : '' }}">
                                    <div class="timeline-badge {{ $info->status ? 'success' : 'danger' }}">
                                        <i class="flaticon-alarm-1"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">{{ $info->judul_informasi }}</h4>
                                            <p><small class="text-muted"><i class="flaticon-alarm-1"></i> 
                                                {{ $info->created_at->diffForHumans() }}</small></p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>{{ $info->isi_informasi }}</p>
                                            @if ($info->photo)
                                                <img src="{{ asset('storage/' . $info->photo) }}" alt="Informasi Image" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- End --}}
    </div>
@endsection
