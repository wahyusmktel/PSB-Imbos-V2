<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->string('nama_sekolah')->nullable()->after('atas_nama');
            $table->string('alamat_sekolah')->nullable()->after('nama_sekolah');
            $table->date('ppdb_open')->nullable()->after('alamat_sekolah');
            $table->date('ppdb_tutup')->nullable()->after('ppdb_open');
            $table->date('ppdb_pengumuman')->nullable()->after('ppdb_tutup');
            $table->date('tgl_mulai_daftar_ulang')->nullable()->after('ppdb_pengumuman');
            $table->date('tgl_akhir_daftar_ulang')->nullable()->after('tgl_mulai_daftar_ulang');
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
            $table->dropColumn([
                'nama_sekolah', 
                'alamat_sekolah', 
                'ppdb_open', 
                'ppdb_tutup', 
                'ppdb_pengumuman', 
                'tgl_mulai_daftar_ulang', 
                'tgl_akhir_daftar_ulang'
            ]);
        });
    }
};
