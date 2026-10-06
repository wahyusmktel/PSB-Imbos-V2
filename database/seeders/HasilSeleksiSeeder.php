<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\HasilSeleksiModel;

class HasilSeleksiSeeder extends Seeder
{
    public function run()
    {
        HasilSeleksiModel::create([
            'id' => Str::uuid(),
            'pendaftar_id' => '93f4bc7a-d385-469b-b3e7-3f1e45452e18', // Pendaftar ID sesuai permintaan
            'hasil_kelulusan' => 1, // 1 untuk Lulus
            'status' => true,
            'created_by' => Str::uuid(),
        ]);
    }
}
