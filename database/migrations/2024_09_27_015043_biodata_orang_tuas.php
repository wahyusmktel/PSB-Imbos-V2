<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('biodata_orang_tuas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');
            
            // Data Ayah
            $table->string('nama_ayah')->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->string('agama_ayah')->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->string('pendidikan_terakhir_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('range_gaji_ayah')->nullable();
            $table->text('alamat_lengkap_ayah')->nullable();
            $table->string('telp_ayah')->nullable();
            $table->string('email_ayah')->nullable();
            
            // Data Ibu
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->string('agama_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('range_gaji_ibu')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->string('telp_ibu')->nullable();
            $table->string('email_ibu')->nullable();

            // Hubungan dengan Santri
            $table->string('hubungan_santri')->nullable();
            
            // Kolom lainnya
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('biodata_orang_tuas');
    }
};
