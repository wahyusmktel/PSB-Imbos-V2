<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftar_penyakits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');
            $table->string('nama_penyakit')->nullable();
            $table->date('sejak_kapan')->nullable();
            $table->string('status_kesembuhan')->nullable();
            $table->string('penanganan')->nullable();
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key relations
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftar_penyakits');
    }
};
