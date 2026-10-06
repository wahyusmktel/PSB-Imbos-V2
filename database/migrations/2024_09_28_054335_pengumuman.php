<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jenjang_id')->nullable();
            $table->uuid('jalur_id')->nullable();
            $table->string('judul_pengumuman');
            $table->text('isi_pengumuman');
            $table->string('photo');
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            // Optionally add foreign key constraints if needed
            $table->foreign('jenjang_id')->references('id')->on('config_jenjangs')->onDelete('set null');
            $table->foreign('jalur_id')->references('id')->on('config_jalurs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengumumans');
    }
};
