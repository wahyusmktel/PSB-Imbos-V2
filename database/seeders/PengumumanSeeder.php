<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengumumans')->insert([
            [
                'id' => Str::uuid(),
                'jenjang_id' => null, // Bisa disesuaikan dengan UUID dari config_jenjangs jika ada
                'jalur_id' => null, // Bisa disesuaikan dengan UUID dari config_jalurs jika ada
                'judul_pengumuman' => 'Pengumuman Penerimaan Peserta Didik Baru 2024',
                'isi_pengumuman' => 'Pengumuman penerimaan peserta didik baru tahun 2024 telah dibuka. Silakan periksa jadwal dan persyaratan pendaftaran.',
                'photo' => 'pengumuman_1.jpg', // Bisa disesuaikan dengan file yang ada
                'status' => true,
                'created_by' => null, // Sesuaikan dengan user yang membuat jika ada
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'jenjang_id' => null, // Bisa disesuaikan dengan UUID dari config_jenjangs jika ada
                'jalur_id' => null, // Bisa disesuaikan dengan UUID dari config_jalurs jika ada
                'judul_pengumuman' => 'Pengumuman Hasil Seleksi Tahap Pertama',
                'isi_pengumuman' => 'Hasil seleksi tahap pertama telah diumumkan. Silakan cek hasilnya di portal seleksi.',
                'photo' => 'pengumuman_2.jpg', // Bisa disesuaikan dengan file yang ada
                'status' => true,
                'created_by' => null, // Sesuaikan dengan user yang membuat jika ada
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
