<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_seleksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id'); // Foreign key dari tabel akun_pendaftars
            $table->string('hasil_kelulusan');
            $table->boolean('status')->default(true); // Status otomatis bernilai true
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_seleksis');
    }
};
