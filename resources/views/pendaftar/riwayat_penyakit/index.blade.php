@extends('layouts.app')

@section('title', 'Riwayat Penyakit')

@section('content')
<div class="container">
    <h3 class="text-center">Form Riwayat Penyakit</h3>

    <form method="POST" action="{{ $riwayat_penyakit ? route('pendaftar.riwayat.penyakit.update', $riwayat_penyakit->id) : route('pendaftar.riwayat.penyakit.store') }}">
        @csrf
        @if ($riwayat_penyakit)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nama_penyakit">Nama Penyakit</label>
            <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" value="{{ old('nama_penyakit', $riwayat_penyakit->nama_penyakit ?? '') }}">
            @error('nama_penyakit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="sejak_kapan">Sejak Kapan</label>
            <input type="date" name="sejak_kapan" id="sejak_kapan" class="form-control" value="{{ old('sejak_kapan', $riwayat_penyakit->sejak_kapan ?? '') }}">
            @error('sejak_kapan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status_kesembuhan">Status Kesembuhan</label>
            <input type="text" name="status_kesembuhan" id="status_kesembuhan" class="form-control" value="{{ old('status_kesembuhan', $riwayat_penyakit->status_kesembuhan ?? '') }}">
            @error('status_kesembuhan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="penanganan">Penanganan</label>
            <input type="text" name="penanganan" id="penanganan" class="form-control" value="{{ old('penanganan', $riwayat_penyakit->penanganan ?? '') }}">
            @error('penanganan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $riwayat_penyakit ? 'Update Data' : 'Simpan Data' }}</button>
    </form>
</div>
@endsection
