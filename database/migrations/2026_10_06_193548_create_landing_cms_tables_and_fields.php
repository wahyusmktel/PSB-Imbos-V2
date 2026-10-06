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
        // 1. Tambah kolom konten pada config_ppdbs jika belum ada
        Schema::table('config_ppdbs', function (Blueprint $table) {
            if (!Schema::hasColumn('config_ppdbs', 'hero_tag')) {
                $table->string('hero_tag')->nullable()->after('nama_sekolah');
            }
            if (!Schema::hasColumn('config_ppdbs', 'hero_title')) {
                $table->string('hero_title')->nullable()->after('hero_tag');
            }
            if (!Schema::hasColumn('config_ppdbs', 'hero_subtitle')) {
                $table->string('hero_subtitle')->nullable()->after('hero_title');
            }
            if (!Schema::hasColumn('config_ppdbs', 'hero_desc')) {
                $table->text('hero_desc')->nullable()->after('hero_subtitle');
            }
            if (!Schema::hasColumn('config_ppdbs', 'hero_image')) {
                $table->string('hero_image')->nullable()->after('hero_desc');
            }
            if (!Schema::hasColumn('config_ppdbs', 'quran_surah')) {
                $table->string('quran_surah')->nullable()->after('hero_image');
            }
            if (!Schema::hasColumn('config_ppdbs', 'quran_arabic')) {
                $table->text('quran_arabic')->nullable()->after('quran_surah');
            }
            if (!Schema::hasColumn('config_ppdbs', 'quran_translation')) {
                $table->text('quran_translation')->nullable()->after('quran_arabic');
            }
            if (!Schema::hasColumn('config_ppdbs', 'jam_kerja')) {
                $table->string('jam_kerja')->nullable()->after('alamat_sekolah');
            }
            if (!Schema::hasColumn('config_ppdbs', 'maps_embed_url')) {
                $table->text('maps_embed_url')->nullable()->after('jam_kerja');
            }
            if (!Schema::hasColumn('config_ppdbs', 'running_text')) {
                $table->text('running_text')->nullable()->after('maps_embed_url');
            }
            if (!Schema::hasColumn('config_ppdbs', 'footer_title')) {
                $table->string('footer_title')->nullable()->after('running_text');
            }
            if (!Schema::hasColumn('config_ppdbs', 'footer_subtitle')) {
                $table->string('footer_subtitle')->nullable()->after('footer_title');
            }
            if (!Schema::hasColumn('config_ppdbs', 'footer_desc')) {
                $table->text('footer_desc')->nullable()->after('footer_subtitle');
            }
        });

        // 2. Tambah kolom tambahan pada config_jenjangs jika belum ada
        Schema::table('config_jenjangs', function (Blueprint $table) {
            if (!Schema::hasColumn('config_jenjangs', 'poin_keunggulan')) {
                $table->text('poin_keunggulan')->nullable()->after('deskripsi_jenjang');
            }
            if (!Schema::hasColumn('config_jenjangs', 'tag_lokasi')) {
                $table->string('tag_lokasi')->nullable()->after('poin_keunggulan');
            }
        });

        // 3. Tabel alur seleksi landing page
        if (!Schema::hasTable('landing_alurs')) {
            Schema::create('landing_alurs', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('step_number', 10)->default('01');
                $table->string('step_tag', 100)->default('Tahap');
                $table->string('title');
                $table->text('description');
                $table->string('icon', 100)->default('fas fa-check-circle');
                $table->integer('urutan')->default(1);
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        // 4. Tabel slider (auth login/register & landing page)
        if (!Schema::hasTable('landing_sliders')) {
            Schema::create('landing_sliders', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type', 50)->default('auth'); // 'auth' atau 'home'
                $table->string('image');
                $table->string('pill_tag')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->integer('urutan')->default(1);
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_sliders');
        Schema::dropIfExists('landing_alurs');

        Schema::table('config_jenjangs', function (Blueprint $table) {
            $table->dropColumn(['poin_keunggulan', 'tag_lokasi']);
        });

        Schema::table('config_ppdbs', function (Blueprint $table) {
            $table->dropColumn([
                'hero_tag',
                'hero_title',
                'hero_subtitle',
                'hero_desc',
                'hero_image',
                'quran_surah',
                'quran_arabic',
                'quran_translation',
                'jam_kerja',
                'maps_embed_url',
                'running_text',
                'footer_title',
                'footer_subtitle',
                'footer_desc',
            ]);
        });
    }
};
