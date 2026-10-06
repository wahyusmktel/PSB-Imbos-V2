<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('info_seleksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jenjang_id')->nullable();
            $table->uuid('jalur_id')->nullable();
            $table->string('tempat')->nullable();
            $table->timestamp('waktu')->nullable();
            $table->text('komponen_test_potensi')->nullable();
            $table->text('komponen_test_membaca')->nullable();
            $table->text('komponen_wawancara')->nullable();
            $table->date('tgl_pengumuman')->nullable();
            $table->date('tgl_mulai_du')->nullable();
            $table->date('tgl_akhir_ud')->nullable();
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Foreign key relations
            $table->foreign('jenjang_id')->references('id')->on('config_jenjangs')->onDelete('cascade');
            $table->foreign('jalur_id')->references('id')->on('config_jalurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('info_seleksis');
    }
};
