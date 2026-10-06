<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('config_biayas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_biaya');
            $table->string('nama_biaya');
            $table->decimal('nominal', 15, 2);

            // Tambahkan kolom jalur_id
            $table->uuid('jalur_id');

            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Tambahkan foreign key untuk jalur_id
            $table->foreign('jalur_id')->references('id')->on('config_jalurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_biayas');
    }
};
