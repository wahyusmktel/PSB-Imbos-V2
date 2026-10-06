<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InfoSeleksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('info_seleksis')->insert([
            [
                'id' => Str::uuid(),
                'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31', // Null karena bisa nullable
                'jalur_id' => '0d4fbd97-04c1-4272-82a1-3de0db5fb7f4', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31', // Null karena bisa nullable
                'jalur_id' => '67c9c796-cd73-415d-b9bc-c0c3e810d4e6', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => '31443a53-1b24-4629-8c74-e066b19c9a31', // Null karena bisa nullable
                'jalur_id' => 'eea1417c-89cc-494b-84a6-2f94795ab272', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f', // Null karena bisa nullable
                'jalur_id' => '0d4fbd97-04c1-4272-82a1-3de0db5fb7f4', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f', // Null karena bisa nullable
                'jalur_id' => '67c9c796-cd73-415d-b9bc-c0c3e810d4e6', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => 'ed08d490-ea93-42f5-9d3b-c6710b4a056f', // Null karena bisa nullable
                'jalur_id' => 'eea1417c-89cc-494b-84a6-2f94795ab272', // Null karena bisa nullable
                'tempat' => 'IMBOS Pringsewu',
                'waktu' => '2025-02-09 09:00:00',
                'komponen_test_potensi' => 'Tes Potensi Akademik',
                'komponen_test_membaca' => 'Tes Membaca Al-Qur\'an',
                'komponen_wawancara' => 'Wawancara Psikologi',
                'tgl_pengumuman' => '2025-02-14',
                'tgl_mulai_du' => '2025-02-14',
                'tgl_akhir_ud' => '2025-03-14',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
