@extends('layouts.app')

@section('title', 'Data Orang Tua')

@section('content')
    <div class="container">
        <h3 class="text-center">Form Data Orang Tua</h3>

        <form method="POST"
            action="{{ $biodata_orang_tua ? route('pendaftar.orang_tua.update', $biodata_orang_tua->id) : route('pendaftar.orang_tua.store') }}">
            @csrf
            @if ($biodata_orang_tua)
                @method('PUT')
            @endif

            <h4>Data Ayah</h4>
            <div class="form-group">
                <label for="nama_ayah">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control"
                    value="{{ $biodata_orang_tua->nama_ayah ?? old('nama_ayah') }}">
                @error('nama_ayah')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                <input type="text" name="tempat_lahir_ayah" class="form-control"
                    value="{{ $biodata_orang_tua->tempat_lahir_ayah ?? old('tempat_lahir_ayah') }}">
                @error('tempat_lahir_ayah')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Add more fields for data ayah -->

            <h4>Data Ibu</h4>
            <div class="form-group">
                <label for="nama_ibu">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control"
                    value="{{ $biodata_orang_tua->nama_ibu ?? old('nama_ibu') }}">
                @error('nama_ibu')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                <input type="text" name="tempat_lahir_ibu" class="form-control"
                    value="{{ $biodata_orang_tua->tempat_lahir_ibu ?? old('tempat_lahir_ibu') }}">
                @error('tempat_lahir_ibu')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Add more fields for data ibu -->

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
