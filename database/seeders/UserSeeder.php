<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Admin No. 1',
            'tanggal_lahir' => '1990-01-01',
            'domisili' => 'Jakarta'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user12345'),
            'role' => 'user',
            'jenis_kelamin' => 'Laki-Laki',
            'no_telepon' => '089876543210',
            'alamat' => 'Jl. Contoh No. 2',
            'tanggal_lahir' => '1995-01-01',
            'domisili' => 'Bandung'
        ]);
        User::create([
            'name' => 'Pengelola',
            'email' => 'pengelola@gmail.com',
            'password' => Hash::make('pengelola12345'),
            'role' => 'pengelola',
            'jenis_kelamin' => 'Laki-Laki',
            'no_telepon' => '089876543210',
            'alamat' => 'Jl. Contoh No. 2',
            'tanggal_lahir' => '1995-01-01',
            'domisili' => 'Bandung'
        ]);
    }
} 