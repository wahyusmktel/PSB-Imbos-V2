<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('config_jenjangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_jenjang');
            $table->string('tingkat_jenjang');
            $table->string('photo_cover')->nullable();
            $table->text('deskripsi_jenjang')->nullable();
            $table->boolean('status')->default(false);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('config_jenjangs');
    }
};
