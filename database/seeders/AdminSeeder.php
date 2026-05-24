<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin — bisa kelola admin lain
        Admin::updateOrCreate(
            ['email' => 'admin@sideni.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role'     => 'superadmin',
            ]
        );

        // Admin biasa — tidak bisa kelola admin lain
        Admin::updateOrCreate(
            ['email' => 'admin2@sideni.com'],
            [
                'name'     => 'Admin Biasa',
                'password' => Hash::make('admin456'),
                'role'     => 'admin',
            ]
        );
    }
}