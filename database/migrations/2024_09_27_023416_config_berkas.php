<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('config_berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jalur_id'); // Foreign key ke config_jalurs
            $table->string('nama_berkas');
            $table->text('deskripsi_berkas')->nullable();
            $table->string('ekstensi_berkas');
            $table->integer('ukuran_maksimum');
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('jalur_id')->references('id')->on('config_jalurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_berkas');
    }
};
