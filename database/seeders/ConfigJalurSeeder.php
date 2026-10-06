<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigJalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config_jalurs')->insert([
            [
                'id' => Str::uuid(),
                'nama_jalur' => 'Jalur Reguler',
                'deskripsi_jalur' => 'Jalur reguler untuk penerimaan peserta didik baru.',
                'photo_cover' => null, // Kosongkan jika belum ada gambar
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jalur' => 'Jalur Prestasi Akademik Dan Non Akademik',
                'deskripsi_jalur' => 'Jalur untuk peserta didik yang memiliki prestasi baik akademik maupun non-akademik.',
                'photo_cover' => null,
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jalur' => 'Jalur Tahfizh Al-Qur\'an',
                'deskripsi_jalur' => 'Jalur khusus bagi peserta didik yang memiliki kemampuan menghafal Al-Qur\'an.',
                'photo_cover' => null,
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jalur' => 'Jalur Alumni IMBOS',
                'deskripsi_jalur' => 'Jalur khusus untuk alumni sekolah IMBOS.',
                'photo_cover' => null,
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
