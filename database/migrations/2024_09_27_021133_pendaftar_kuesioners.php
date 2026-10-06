<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftar_kuesioners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');
            $table->text('masuk_insan_mulia')->nullable(); // Alasan atau pertanyaan 'Masuk Insan Mulia'
            $table->string('dari_mana')->nullable(); // Informasi 'Dari Mana'
            $table->boolean('status')->default(true); // Status default true saat insert
            $table->uuid('created_by')->nullable(); // ID creator (opsional)
            $table->uuid('updated_by')->nullable(); // ID updater (opsional)
            $table->timestamps(); // timestamps created_at and updated_at
            
            // Foreign key untuk pendaftar_id
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftar_kuesioners');
    }
};
