@extends('layouts.app')

@section('title', 'Kuesioner Pendaftar')

@section('content')
<div class="container">
    <h3 class="text-center">Form Kuesioner Pendaftar</h3>

    <form method="POST" action="{{ $kuesioner ? route('pendaftar.kuesioner.update', $kuesioner->id) : route('pendaftar.kuesioner.store') }}">
        @csrf
        @if($kuesioner) @method('PUT') @endif

        <div class="form-group">
            <label for="masuk_insan_mulia">Alasan Masuk Insan Mulia</label>
            <select name="masuk_insan_mulia" id="masuk_insan_mulia" class="form-control select2">
                <option value="">-- Pilih Alasan --</option>
                <option value="Rekomendasi Teman" {{ $kuesioner && $kuesioner->masuk_insan_mulia == 'Rekomendasi Teman' ? 'selected' : '' }}>Rekomendasi Teman</option>
                <option value="Informasi Sosial Media" {{ $kuesioner && $kuesioner->masuk_insan_mulia == 'Informasi Sosial Media' ? 'selected' : '' }}>Informasi Sosial Media</option>
                <option value="Lainnya" {{ $kuesioner && $kuesioner->masuk_insan_mulia == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="dari_mana">Dari Mana Mengetahui Sekolah Ini?</label>
            <select name="dari_mana" id="dari_mana" class="form-control select2">
                <option value="">-- Pilih Sumber Informasi --</option>
                <option value="Media Sosial" {{ $kuesioner && $kuesioner->dari_mana == 'Media Sosial' ? 'selected' : '' }}>Media Sosial</option>
                <option value="Teman" {{ $kuesioner && $kuesioner->dari_mana == 'Teman' ? 'selected' : '' }}>Teman</option>
                <option value="Pameran Pendidikan" {{ $kuesioner && $kuesioner->dari_mana == 'Pameran Pendidikan' ? 'selected' : '' }}>Pameran Pendidikan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
