<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123'),
            'jk' => 'P',
            'phone' => '081234567891',
            'is_active' => 1,
        ]);

        $penulis = User::create([
            'name' => 'penulis',
            'username' => 'penulis',
            'email' => 'penulis@gmail.com',
            'role' => 'penulis',
            'password' => Hash::make('123'),
            'jk' => 'L',
            'phone' => '08123456789',
            'is_active' => 1,
        ]);
    }
}
