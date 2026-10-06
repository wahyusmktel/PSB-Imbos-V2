@extends('layouts.app_operator')

@section('title', 'Pengaturan PSB & Landing Page')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Pengaturan PSB & Landing Page</h2>
                <h5 class="text-white op-7 mb-2">Kelola informasi sekolah, kontak, jadwal, dan rekening pendaftaran</h5>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <a href="/" target="_blank" class="btn btn-white btn-border btn-round">
                    <i class="fas fa-external-link-alt mr-1"></i> Preview Landing Page
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <form action="{{ route('operator.landing.pengaturan.update') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Kolom Kiri: Info Umum PSB -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-school mr-2"></i>Informasi Utama & Status PSB</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label d-block font-weight-bold">Status Pendaftaran Online</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ $config->status ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold" for="statusSwitch">
                                    {{ $config->status ? 'PENDAFTARAN SEDANG DIBUKA' : 'PENDAFTARAN DITUTUP' }}
                                </label>
                            </div>
                            <small class="form-text text-muted">Jika dinonaktifkan, tombol pendaftaran di landing page akan menampilkan status Ditutup.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran</label>
                                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ $config->tahun_ajaran ?? '2026/2027' }}" placeholder="Contoh: 2026/2027" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gelombang" class="font-weight-bold">Gelombang Aktif</label>
                                    <input type="text" class="form-control" id="gelombang" name="gelombang" value="{{ $config->gelombang ?? 'Gelombang 1' }}" placeholder="Contoh: Gelombang 1" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_sekolah" class="font-weight-bold">Nama Institusi / Lembaga</label>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ $config->nama_sekolah }}" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat_sekolah" class="font-weight-bold">Alamat Lengkap Sekolah</label>
                            <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="2" required>{{ $config->alamat_sekolah }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_wa_humas" class="font-weight-bold">No. WhatsApp Humas / PSB</label>
                                    <input type="text" class="form-control" id="no_wa_humas" name="no_wa_humas" value="{{ $config->no_wa_humas }}" placeholder="Contoh: 082371877887" required>
                                    <small class="form-text text-muted">Akan dihubungkan langsung ke tombol chat WhatsApp.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_sekolah" class="font-weight-bold">Email Informasi PSB</label>
                                    <input type="email" class="form-control" id="email_sekolah" name="email_sekolah" value="{{ $config->email_sekolah ?? 'psb@imbos.sch.id' }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="video_profil_url" class="font-weight-bold">Link Video Profil Sekolah (YouTube)</label>
                            <input type="url" class="form-control" id="video_profil_url" name="video_profil_url" value="{{ $config->video_profil_url ?? 'https://www.youtube.com/watch?v=fv_Oogwy_8s' }}" placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                    </div>
                </div>

                <!-- Media Sosial & Grup WA -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-share-alt mr-2"></i>Media Sosial & Tautan Grup WhatsApp</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="link_facebook" class="font-weight-bold">Link Halaman Facebook</label>
                            <input type="url" class="form-control" id="link_facebook" name="link_facebook" value="{{ $config->link_facebook }}">
                        </div>
                        <div class="form-group">
                            <label for="link_instagram" class="font-weight-bold">Link Profil Instagram</label>
                            <input type="url" class="form-control" id="link_instagram" name="link_instagram" value="{{ $config->link_instagram }}">
                        </div>
                        <div class="form-group">
                            <label for="link_youtube" class="font-weight-bold">Link Channel YouTube</label>
                            <input type="url" class="form-control" id="link_youtube" name="link_youtube" value="{{ $config->link_youtube }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link_group_smp" class="font-weight-bold">Link Grup WhatsApp SMP</label>
                                    <input type="url" class="form-control" id="link_group_smp" name="link_group_smp" value="{{ $config->link_group_smp }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link_group_sma" class="font-weight-bold">Link Grup WhatsApp SMA</label>
                                    <input type="url" class="form-control" id="link_group_sma" name="link_group_sma" value="{{ $config->link_group_sma }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Rekening & Biaya Pendaftaran -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-credit-card mr-2"></i>Rekening Pembayaran Resmi</div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            Informasi rekening ini akan ditampilkan pada bagian alur pembayaran di landing page & konfirmasi transfer pendaftar.
                        </div>

                        <div class="form-group">
                            <label for="nama_bank_penerima" class="font-weight-bold">Nama Bank</label>
                            <input type="text" class="form-control" id="nama_bank_penerima" name="nama_bank_penerima" value="{{ $config->nama_bank_penerima }}" placeholder="Contoh: Bank Syariah Indonesia (BSI)" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_rekening_penerima" class="font-weight-bold">Nomor Rekening</label>
                            <input type="text" class="form-control font-weight-bold" id="nomor_rekening_penerima" name="nomor_rekening_penerima" value="{{ $config->nomor_rekening_penerima }}" placeholder="Contoh: 7086012132" required>
                        </div>

                        <div class="form-group">
                            <label for="atas_nama" class="font-weight-bold">Atas Nama Rekening</label>
                            <input type="text" class="form-control" id="atas_nama" name="atas_nama" value="{{ $config->atas_nama }}" placeholder="Contoh: Dian Zunia Ningrum" required>
                        </div>

                        <div class="form-group">
                            <label for="biaya_pendaftaran_default" class="font-weight-bold">Biaya Pendaftaran Default (Rp)</label>
                            <input type="number" class="form-control" id="biaya_pendaftaran_default" name="biaya_pendaftaran_default" value="{{ $config->biaya_pendaftaran_default ?? 350000 }}" required>
                            <small class="form-text text-muted">Besaran biaya uang pendaftaran yang tertera di panduan alur.</small>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Semua Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
