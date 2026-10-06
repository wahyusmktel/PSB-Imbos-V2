<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunPendaftarsTable extends Migration
{
    public function up()
    {
        Schema::create('akun_pendaftars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_lengkap');
            $table->string('nisn');
            $table->string('asal_sekolah');
            $table->string('no_hp');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('no_pendaftaran')->unique();
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun_pendaftars');
    }
}

