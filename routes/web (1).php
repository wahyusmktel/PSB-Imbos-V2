<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunPendaftarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftarBerkasController;
use App\Http\Controllers\PendaftarBiodataAlamatController;
use App\Http\Controllers\PendaftarBiodataPenyakitController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PendaftarDashboardController;
use App\Http\Controllers\PendaftarJalurController;
use App\Http\Controllers\PendaftarJenjangController;
use App\Http\Controllers\PendaftarDataDiriController;
use App\Http\Controllers\PendaftarFormulirController;
use App\Http\Controllers\PendaftarHasilSeleksiController;
use App\Http\Controllers\PendaftarInfoSeleksiController;
use App\Http\Controllers\PendaftarKuesionerController;
use App\Http\Controllers\PendaftarOrangTuaController;
use App\Http\Controllers\PendaftarTransaksiController;
use App\Models\Regency;
use App\Models\District;
use App\Models\PendaftarBerkas;
use App\Models\Village;
use App\Http\Controllers\Auth\OperatorAuthController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\OperatorHasilSeleksiController;
use App\Http\Controllers\OperatorPendaftarController;
use App\Http\Controllers\OperatorPengumumanController;
use App\Http\Controllers\OperatorTransaksiController;

// Rute untuk mendapatkan kabupaten berdasarkan provinsi
Route::get('/get-kabupaten/{provinsi_id}', function ($provinsi_id) {
    $kabupaten = Regency::where('province_id', $provinsi_id)->pluck('name', 'id');
    return response()->json($kabupaten);
});

// Rute untuk mendapatkan kecamatan berdasarkan kabupaten
Route::get('/get-kecamatan/{kabupaten_id}', function ($kabupaten_id) {
    $kecamatan = District::where('regency_id', $kabupaten_id)->pluck('name', 'id');
    return response()->json($kecamatan);
});

// Rute untuk mendapatkan desa berdasarkan kecamatan
Route::get('/get-desa/{kecamatan_id}', function ($kecamatan_id) {
    $desa = Village::where('district_id', $kecamatan_id)->pluck('name', 'id');
    return response()->json($desa);
});

// Rute Login untuk operator
Route::middleware('guest.operator')->group(function () {
    Route::get('operator/login', [OperatorAuthController::class, 'showLoginForm'])->name('operator.login');
    Route::post('operator/login', [OperatorAuthController::class, 'login'])->name('operator.login.post');
});

// Halaman setelah login
Route::middleware(['auth.operator'])->group(function () {
    // Logout operator
    Route::post('operator/logout', [OperatorAuthController::class, 'logout'])->name('operator.logout');

    // Operator Dashboard
    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])->name('operator.dashboard');

    // Data Pendaftar
    Route::get('/operator/pendaftar', [OperatorPendaftarController::class, 'index'])->name('operator.pendaftar.index');
    Route::get('/operator/pendaftar/{id}/edit', [OperatorPendaftarController::class, 'edit'])->name('operator.pendaftar.edit');
    Route::put('/operator/pendaftar/{id}', [OperatorPendaftarController::class, 'updateAkunPendaftar'])->name('operator.pendaftar.update');
    Route::put('/operator/pendaftar/{id}/updateAlamat', [OperatorPendaftarController::class, 'updateAlamat'])->name('operator.pendaftar.updateAlamat');
    Route::put('/operator/pendaftar/{id}/updateDatadiri', [OperatorPendaftarController::class, 'updateDatadiri'])->name('operator.pendaftar.updateDatadiri');
    Route::put('/operator/pendaftar/{id}/updateOrangTua', [OperatorPendaftarController::class, 'updateOrangTua'])->name('operator.pendaftar.updateOrangTua');
    Route::put('/operator/pendaftar/{id}/updateRiwayatpenyakit', [OperatorPendaftarController::class, 'updateRiwayatpenyakit'])->name('operator.pendaftar.updateRiwayatpenyakit');
    Route::put('/operator/pendaftar/{id}/updateBerkas', [OperatorPendaftarController::class, 'updateBerkas'])->name('operator.pendaftar.updateBerkas');
    Route::put('/operator/pendaftar/{id}/updateJenjang', [OperatorPendaftarController::class, 'updateJenjang'])->name('operator.pendaftar.updateJenjang');
    Route::put('/operator/pendaftar/{id}/updateJalur', [OperatorPendaftarController::class, 'updateJalur'])->name('operator.pendaftar.updateJalur');
    Route::get('/operator/pendaftar/{id}/cetak', [OperatorPendaftarController::class, 'cetakFormulir'])->name('operator.pendaftar.cetak');
    Route::put('/operator/pendaftar/{id}/berkas/update', [OperatorPendaftarController::class, 'updateBerkas'])->name('operator.pendaftar.berkas.update');
    Route::get('/operator/pendaftar/export-pendaftar', [OperatorPendaftarController::class, 'export'])->name('operator.pendaftar.export');
    Route::delete('operator/pendaftar/{id}', [OperatorPendaftarController::class, 'destroy'])->name('operator.pendaftar.destroy');

    //Transaksi
    Route::get('/operator/transaksi', [OperatorTransaksiController::class, 'index'])->name('operator.transaksi.index');
    Route::put('/operator/transaksi/{id}', [OperatorTransaksiController::class, 'updateTransaksi'])->name('operator.transaksi.update');
    Route::get('/operator/transaksi/kwitansi/{id}', [OperatorTransaksiController::class, 'downloadKwitansi'])->name('operator.transaksi.download');
    Route::get('/operator/transaksi/export', [OperatorTransaksiController::class, 'exportExcel'])->name('operator.transaksi.export');
    Route::delete('/operator/transaksi/{id}/delete', [OperatorTransaksiController::class, 'destroy'])->name('operator.transaksi.delete');

    // Tampilkan halaman index untuk pengumuman
    Route::get('/operator/pengumuman', [OperatorPengumumanController::class, 'index'])->name('operator.pengumuman.index');
    Route::post('/operator/pengumuman', [OperatorPengumumanController::class, 'store'])->name('operator.pengumuman.store');
    Route::get('/operator/pengumuman/{id}/edit', [OperatorPengumumanController::class, 'edit'])->name('operator.pengumuman.edit');
    Route::put('/operator/pengumuman/{id}', [OperatorPengumumanController::class, 'update'])->name('operator.pengumuman.update');
    Route::put('/operator/pengumuman/{id}/delete', [OperatorPengumumanController::class, 'delete'])->name('operator.pengumuman.delete');
    Route::post('/operator/pengumuman/upload', [OperatorPengumumanController::class, 'uploadImage'])->name('pengumuman.upload');

    Route::post('/operator/hasil-seleksi/store', [OperatorHasilSeleksiController::class, 'store'])
        ->name('operator.hasil-seleksi.store');
});

// Rute login dan register untuk pendaftar
Route::middleware('pendaftar.guest')->group(function () {
    //Homepage
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route untuk form login
    Route::get('/pendaftar/login', [AkunPendaftarController::class, 'showLoginForm'])->name('pendaftar.login.form');
    Route::post('/pendaftar/login', [AkunPendaftarController::class, 'login'])->name('pendaftar.login');
    Route::post('/pendaftar/autologin', [AkunPendaftarController::class, 'autoLogin'])->name('pendaftar.autologin');
    Route::get('/pendaftar/kartu/{id}', [AkunPendaftarController::class, 'downloadKartuAkun'])->name('pendaftar.download.kartu');

    // Route untuk form pendaftaran
    Route::get('/pendaftar/register', [AkunPendaftarController::class, 'showRegistrationForm'])->name('pendaftar.register.form');
    Route::post('/pendaftar/register', [AkunPendaftarController::class, 'register'])->name('pendaftar.register');
});

// Route yang diproteksi oleh middleware pendaftar
Route::middleware(['pendaftar'])->group(function () {
    Route::post('/pendaftar/logout', [AkunPendaftarController::class, 'logout'])->name('pendaftar.logout');

    Route::get('/pendaftar/dashboard', [PendaftarDashboardController::class, 'index'])->name('pendaftar.dashboard');

    //Jenjang
    Route::post('/pendaftar-jenjang/store', [PendaftarJenjangController::class, 'store'])->name('pendaftar.jenjang.store');
    Route::put('/pendaftar-jenjang/update', [PendaftarJenjangController::class, 'update'])->name('pendaftar.jenjang.update');
    Route::get('/pendaftar-jenjang', [PendaftarJenjangController::class, 'index'])->name('pendaftar.jenjang.index');

    //Jalur
    Route::get('/pendaftar/jalur', [PendaftarJalurController::class, 'index'])->name('pendaftar.jalur.index');
    Route::post('/pendaftar/jalur', [PendaftarJalurController::class, 'store'])->name('pendaftar.jalur.store');
    Route::put('/pendaftar/jalur/update', [PendaftarJalurController::class, 'update'])->name('pendaftar.jalur.update');

    //Group Wa
    Route::get('/pendaftar/group-wa', [App\Http\Controllers\PendaftarGroupWaController::class, 'index'])->name('pendaftar.group_wa.index');

    //Data Diri
    Route::get('/pendaftar/data-diri', [PendaftarDataDiriController::class, 'index'])->name('pendaftar.data_diri.index');
    Route::post('/pendaftar/data-diri/store', [PendaftarDataDiriController::class, 'store'])->name('pendaftar.data_diri.store');
    Route::put('/pendaftar/data-diri/update/{id}', [PendaftarDataDiriController::class, 'update'])->name('pendaftar.data_diri.update');

    //Riwayat Penyakit
    Route::get('/pendaftar/riwayat-penyakit', [PendaftarBiodataPenyakitController::class, 'index'])->name('pendaftar.riwayat.penyakit.index');
    Route::post('/pendaftar/riwayat-penyakit', [PendaftarBiodataPenyakitController::class, 'store'])->name('pendaftar.riwayat.penyakit.store');
    Route::put('/pendaftar/riwayat-penyakit/{id}', [PendaftarBiodataPenyakitController::class, 'update'])->name('pendaftar.riwayat.penyakit.update');

    //Alamat


    // Menampilkan form data alamat (index)
    Route::get('/pendaftar/alamat', [PendaftarBiodataAlamatController::class, 'index'])->name('pendaftar.alamat.index');
    Route::post('/pendaftar/alamat/store', [PendaftarBiodataAlamatController::class, 'store'])->name('pendaftar.alamat.store');
    Route::put('/pendaftar/alamat/update/{id}', [PendaftarBiodataAlamatController::class, 'update'])->name('pendaftar.alamat.update');

    //Orang Tua
    Route::get('/pendaftar/orang_tua', [PendaftarOrangTuaController::class, 'index'])->name('pendaftar.orang_tua.index');
    Route::post('/pendaftar/orang_tua', [PendaftarOrangTuaController::class, 'store'])->name('pendaftar.orang_tua.store');
    Route::put('/pendaftar/orang_tua/{id}', [PendaftarOrangTuaController::class, 'update'])->name('pendaftar.orang_tua.update');

    //Kuesioner
    Route::get('/pendaftar/kuesioner', [PendaftarKuesionerController::class, 'index'])->name('pendaftar.kuesioner.index');
    Route::post('/pendaftar/kuesioner/store', [PendaftarKuesionerController::class, 'store'])->name('pendaftar.kuesioner.store');
    Route::put('/pendaftar/kuesioner/update/{id}', [PendaftarKuesionerController::class, 'update'])->name('pendaftar.kuesioner.update');

    //Berkas
    Route::get('/pendaftar/berkas', [PendaftarBerkasController::class, 'index'])->name('pendaftar.berkas.index');
    Route::post('/pendaftar/berkas', [PendaftarBerkasController::class, 'store'])->name('pendaftar.berkas.store');
    Route::put('/pendaftar/berkas/{id}', [PendaftarBerkasController::class, 'update'])->name('pendaftar.berkas.update');

    //Transaksi
    Route::get('/pendaftar/transaksi', [PendaftarTransaksiController::class, 'index'])->name('pendaftar.transaksi.index');
    Route::post('/pendaftar/transaksi', [PendaftarTransaksiController::class, 'store'])->name('pendaftar.transaksi.store');
    Route::put('/pendaftar/transaksi/{id}', [PendaftarTransaksiController::class, 'update'])->name('pendaftar.transaksi.update');
    Route::get('/pendaftar/transaksi/{id}/download', [PendaftarTransaksiController::class, 'downloadKwitansi'])->name('pendaftar.transaksi.download');
    Route::delete('/pendaftar/transaksi/{id}', [PendaftarTransaksiController::class, 'destroy'])->name('operator.pendaftar.transaksi.destroy');

    //Cetak Formulir
    Route::get('/pendaftar/formulir/cetak', [PendaftarFormulirController::class, 'cetakFormulir'])->name('pendaftar.formulir.cetak');

    //Info Seleksi
    Route::get('/pendaftar/info-seleksi', [PendaftarInfoSeleksiController::class, 'index'])->name('pendaftar.info_seleksi.index');

    //Hasil Seleksi
    Route::get('/pendaftar/hasil-seleksi', [PendaftarHasilSeleksiController::class, 'index'])->name('pendaftar.hasil_seleksi.index');
    Route::get('/pendaftar/hasil-seleksi/download', [PendaftarHasilSeleksiController::class, 'downloadHasilSeleksi'])->name('pendaftar.hasil_seleksi.download');
});
