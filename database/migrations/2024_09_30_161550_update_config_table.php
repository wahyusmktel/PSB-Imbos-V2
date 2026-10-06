<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->string('nama_bank_penerima')->nullable()->after('qr_code_sma');
            $table->string('nomor_rekening_penerima')->nullable()->after('nama_bank_penerima');
            $table->string('atas_nama')->nullable()->after('nomor_rekening_penerima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->dropColumn(['nama_bank_penerima', 'nomor_rekening_penerima', 'atas_nama']);
        });
    }
};
