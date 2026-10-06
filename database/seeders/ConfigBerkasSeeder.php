<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ConfigBerkasModel;

class ConfigBerkasSeeder extends Seeder
{
    public function run()
    {
        // Data 1
        ConfigBerkasModel::create([
            'id' => Str::uuid(),
            'jalur_id' => 'eea1417c-89cc-494b-84a6-2f94795ab272', // ID dari jalur tertentu
            'nama_berkas' => 'Ijazah',
            'deskripsi_berkas' => 'Scan Ijazah asli yang telah dilegalisir',
            'ekstensi_berkas' => 'jpg,png,pdf',
            'ukuran_maksimum' => 2048, // Ukuran maksimum dalam KB
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        // Data 2
        ConfigBerkasModel::create([
            'id' => Str::uuid(),
            'jalur_id' => '88d68e79-678e-4680-8b2a-213dd62af8ff', // ID dari jalur tertentu
            'nama_berkas' => 'Kartu Keluarga',
            'deskripsi_berkas' => 'Scan Kartu Keluarga',
            'ekstensi_berkas' => 'jpg,png,pdf',
            'ukuran_maksimum' => 2048, // Ukuran maksimum dalam KB
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        // Data 3
        ConfigBerkasModel::create([
            'id' => Str::uuid(),
            'jalur_id' => '67c9c796-cd73-415d-b9bc-c0c3e810d4e6', // ID dari jalur tertentu
            'nama_berkas' => 'Akta Kelahiran',
            'deskripsi_berkas' => 'Scan Akta Kelahiran asli',
            'ekstensi_berkas' => 'jpg,png,pdf',
            'ukuran_maksimum' => 1024, // Ukuran maksimum dalam KB
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);
    }
}
