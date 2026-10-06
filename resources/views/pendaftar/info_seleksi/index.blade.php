@extends('layouts.app')

@section('title', 'Informasi Seleksi')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Informasi Seleksi</h2>
                    <h5 class="text-white op-7 mb-2">Dibawah ini adalah informasi seleksi calon Santri Baru.</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-calendar-alt"></i> Jadwal Tes Masuk, Wawancara, Pengumuman Dan Daftar Ulang
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            Pelaksanaan Tes Tertulis akan dilaksanakan secara Offline.
                        </div>
                        @foreach ($infoSeleksi as $info)
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th style="width: 150px;">Tempat</th>
                                        <td style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">:</span>
                                            <span>{{ $info->tempat ?? 'Belum ditentukan' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
                                        <td style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">:</span>
                                            <span>{{ $info->waktu ? \Carbon\Carbon::parse($info->waktu)->translatedFormat('d F Y') : 'Belum ditentukan' }}</span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                <th>Komponen Penilaian</th>
                                <td style="display: flex; align-items: center;">
                                    <span style="margin-right: 5px;">:</span>
                                    <ul style="list-style: none; padding-left: 0; margin: 0;">
                                        <li>Tes Potensi Akademik (TPA) : {{ $info->komponen_test_potensi ?? 'Tidak ada' }}</li>
                                    </ul>
                                </td>
                            </tr> --}}
                                    {{-- <tr>
                                <th></th>
                                <td style="display: flex; align-items: center;">
                                    <span style="margin-right: 5px;">:</span>
                                    <ul style="list-style: none; padding-left: 0; margin: 0;">
                                        <li>Membaca Al Qur'an : {{ $info->komponen_test_membaca ?? 'Tidak ada' }}</li>
                                    </ul>
                                </td>
                            </tr> --}}
                                    {{-- <tr>
                                <th></th>
                                <td style="display: flex; align-items: center;">
                                    <span style="margin-right: 5px;">:</span>
                                    <ul style="list-style: none; padding-left: 0; margin: 0;">
                                        <li>Wawancara : {{ $info->komponen_wawancara ?? 'Tidak ada' }}</li>
                                    </ul>
                                </td>
                            </tr> --}}
                                    <tr>
                                        <th>Pengumuman</th>
                                        <td style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">:</span>
                                            <span>{{ $info->tgl_pengumuman ? \Carbon\Carbon::parse($info->tgl_pengumuman)->translatedFormat('d F Y') : 'Belum ditentukan' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Daftar Ulang</th>
                                        <td style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">:</span>
                                            <span>
                                                @if ($info->tgl_mulai_du && $info->tgl_akhir_ud)
                                                    {{ \Carbon\Carbon::parse($info->tgl_mulai_du)->translatedFormat('d F Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($info->tgl_akhir_ud)->translatedFormat('d F Y') }}
                                                @else
                                                    'Belum ditentukan'
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
