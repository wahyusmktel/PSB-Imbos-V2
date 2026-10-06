<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class config_ppdbs_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('config_ppdbs')->insert([
            'id' => Str::uuid(),
            'link_group_smp' => 'https://example.com/group-smp',
            'link_group_sma' => 'https://example.com/group-sma',
            'status' => true,
            'created_by' => null,  // atau masukkan UUID sesuai jika ada user yang membuat
            'updated_by' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
