<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('biodata_diris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pendaftar'); // Mengambil data dari tabel akun_pendaftars
            $table->string('alamat_asal_sekolah')->nullable();
            $table->string('ukuran_baju')->nullable();
            $table->string('pas_photo')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->integer('jumlah_saudara_tiri')->nullable();
            $table->integer('jumlah_saudara_angkat')->nullable();
            $table->string('bahasa_sehari_hari')->nullable();
            $table->text('bakat_dan_prestasi')->nullable();
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key relation to akun_pendaftars
            $table->foreign('id_pendaftar')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('biodata_diris');
    }
};
