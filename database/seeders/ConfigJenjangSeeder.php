<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigJenjangSeeder extends Seeder
{
    public function run()
    {
        DB::table('config_jenjangs')->insert([
            [
                'id' => Str::uuid(),
                'nama_jenjang' => 'SMP',
                'tingkat_jenjang' => 'Tingkat Menengah Pertama',
                'photo_cover' => 'smp_cover.jpg',
                'deskripsi_jenjang' => 'Jenjang pendidikan untuk siswa yang berusia sekitar 12 hingga 15 tahun.',
                'status' => false,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_jenjang' => 'SMA',
                'tingkat_jenjang' => 'Tingkat Menengah Atas',
                'photo_cover' => 'sma_cover.jpg',
                'deskripsi_jenjang' => 'Jenjang pendidikan untuk siswa yang berusia sekitar 15 hingga 18 tahun.',
                'status' => false,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
