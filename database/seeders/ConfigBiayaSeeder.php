<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfigBiayaModel;
use Illuminate\Support\Str;

class ConfigBiayaSeeder extends Seeder
{
    public function run()
    {
        // Data pertama
        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B001',
            'nama_biaya' => 'Biaya Pendaftaran SMP',
            'nominal' => 350000,
            'jalur_id' => 'eea1417c-89cc-494b-84a6-2f94795ab272',
            'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        // Data kedua
        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B002',
            'nama_biaya' => 'Biaya Pendaftaran SMP',
            'nominal' => 350000,
            'jalur_id' => '67c9c796-cd73-415d-b9bc-c0c3e810d4e6',
            'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        // Data ketiga
        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B003',
            'nama_biaya' => 'Biaya Pendaftaran SMP',
            'nominal' => 350000,
            'jalur_id' => '0d4fbd97-04c1-4272-82a1-3de0db5fb7f4',
            'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B004',
            'nama_biaya' => 'Biaya Pendaftaran SMA',
            'nominal' => 350000,
            'jalur_id' => 'eea1417c-89cc-494b-84a6-2f94795ab272',
            'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B005',
            'nama_biaya' => 'Biaya Pendaftaran SMA',
            'nominal' => 350000,
            'jalur_id' => '67c9c796-cd73-415d-b9bc-c0c3e810d4e6',
            'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        ConfigBiayaModel::create([
            'id' => Str::uuid(),
            'kode_biaya' => 'B006',
            'nama_biaya' => 'Biaya Pendaftaran SMA',
            'nominal' => 350000,
            'jalur_id' => '0d4fbd97-04c1-4272-82a1-3de0db5fb7f4',
            'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31',
            'status' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);
    }
}
