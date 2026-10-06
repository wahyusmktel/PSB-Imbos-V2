<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\OperatorModel;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari apakah akun superadmin sudah ada
        $superadmin = OperatorModel::where('username', 'superadmin')->first();

        if ($superadmin) {
            $superadmin->update([
                'nama_operator' => 'Super Administrator',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
                'status' => true,
            ]);
        } else {
            OperatorModel::create([
                'id' => (string) Str::uuid(),
                'nama_operator' => 'Super Administrator',
                'username' => 'superadmin',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
                'status' => true,
                'created_by' => null,
                'updated_by' => null,
            ]);
        }

        // Pastikan akun operator admin yang lama memiliki role 'operator'
        OperatorModel::where('username', '!=', 'superadmin')
            ->where(function ($query) {
                $query->whereNull('role')->orWhere('role', '');
            })
            ->update(['role' => 'operator']);
    }
}
