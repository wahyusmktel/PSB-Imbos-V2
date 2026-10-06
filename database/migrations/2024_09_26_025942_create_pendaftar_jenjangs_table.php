<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('pendaftar_jenjangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // Foreign key to akun_pendaftars table
            $table->uuid('pendaftar_id');
            $table->foreign('pendaftar_id')->references('id')->on('akun_pendaftars')->onDelete('cascade');
            
            // Foreign key to config_jenjangs table
            $table->uuid('jenjang_id');
            $table->foreign('jenjang_id')->references('id')->on('config_jenjangs')->onDelete('cascade');
            
            // Other fields
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pendaftar_jenjangs');
    }
};
