<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\OperatorModel;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OperatorModel::create([
            'id' => (string) Str::uuid(),
            'nama_operator' => 'Admin Operator',
            'username' => 'admin',
            'password' => Hash::make('password123'), // Password terenkripsi
            'status' => true,
            'created_by' => null, // Bisa disesuaikan jika diperlukan
            'updated_by' => null, // Bisa disesuaikan jika diperlukan
        ]);
    }
}
