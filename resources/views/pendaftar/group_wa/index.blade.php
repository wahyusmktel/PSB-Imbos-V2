@extends('layouts.app')

@section('title', 'Group WhatsApp')

@section('content')

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Gabung Group WhatsApp</h2>
                <h5 class="text-white op-7 mb-2">Sebelum melanjutkan ke tahap berikutnya silahkan untuk dapat bergabung di group WhatsApp dibawah ini</h5>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Silahkan Gabung Group Calon Santri</h4>
                </div>
                <div class="card-body text-center">
                    @if ($groupLink)
                        <p>Seluruh pendaftar calon santri diwajibkan bergabung ke dalam Group WhatsApp, silahkan klik tombol GABUNG GROUP dibawah ini atau Scan QR Code dibawah ini menggunakan Handphone.</p>
                        @if ($qrCode)
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $qrCode) }}" alt="QR Code" class="img-fluid" style="max-width: 200px;">
                            </div>
                        @else
                            <p class="text-center text-danger">Tidak ada QR Code untuk jenjang ini.</p>
                        @endif
                        <a href="{{ $groupLink }}" class="btn btn-primary btn-block mt-4" target="_blank">Gabung Group</a>
                    @else
                        <p>Tidak ada link grup yang tersedia untuk jenjang ini.</p>
                    @endif
                    
                </div>
                
                <div class="card-footer">
                    <div class="alert alert-info mt-2">Setelah tergabung kedalam group, silahkan kembali lagi ke website dan lengkapi formulir pendaftaran melalui <b>Menu Formulir</b> atau <a href="/pendaftar/data-diri">KLIK DISINI</a></div>
                </div>                    
                
            </div>
        </div>
    </div>
</div>

@endsection
