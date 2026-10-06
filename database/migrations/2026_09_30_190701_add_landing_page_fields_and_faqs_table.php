<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->string('tahun_ajaran', 50)->default('2026/2027')->after('nama_sekolah');
            $table->string('gelombang', 50)->default('Gelombang 1')->after('tahun_ajaran');
            $table->string('video_profil_url')->default('https://www.youtube.com/watch?v=fv_Oogwy_8s')->after('alamat_sekolah');
            $table->string('email_sekolah')->default('psb@imbos.sch.id')->after('video_profil_url');
            $table->string('link_facebook')->nullable()->default('https://www.facebook.com/imbospringsewu/')->after('email_sekolah');
            $table->string('link_instagram')->nullable()->default('https://www.instagram.com/imbospringsewu/?hl=id')->after('link_facebook');
            $table->string('link_youtube')->nullable()->default('https://www.youtube.com/@imbospringsewu')->after('link_instagram');
            $table->unsignedBigInteger('biaya_pendaftaran_default')->default(350000)->after('atas_nama');
        });

        Schema::table('config_jalurs', function (Blueprint $table) {
            $table->unsignedBigInteger('biaya')->default(350000)->after('deskripsi_jalur');
            $table->text('persyaratan')->nullable()->after('biaya');
            $table->string('kelebihan')->nullable()->after('persyaratan');
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->integer('urutan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');

        Schema::table('config_jalurs', function (Blueprint $table) {
            $table->dropColumn(['biaya', 'persyaratan', 'kelebihan']);
        });

        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->dropColumn([
                'tahun_ajaran',
                'gelombang',
                'video_profil_url',
                'email_sekolah',
                'link_facebook',
                'link_instagram',
                'link_youtube',
                'biaya_pendaftaran_default',
            ]);
        });
    }
};
