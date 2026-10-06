<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('pendaftar_alamats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');
            $table->string('alamat_tempat_tinggal')->nullable();
            $table->uuid('provinsi_id');
            $table->uuid('kabupaten_id');
            $table->uuid('kecamatan_id');
            $table->uuid('desa_id');
            $table->string('rt');
            $table->string('rw');
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key relations
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('pendaftar_alamats');
    }
};
