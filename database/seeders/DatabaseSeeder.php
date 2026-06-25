<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // 👈 Wajib di-import untuk enkripsi password

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin resmi untuk Bengkel POS
        User::create([
            'name'      => 'Admin Bengkel',
            'email'     => 'admin@gmail.com', // 👈 Sesuaikan dengan email login Anda
            'password'  => Hash::make('admin123'), // 👈 Tulis password baru Anda di sini
            'role'      => 'admin',
        ]);
        
        // Anda juga bisa menambahkan user kasir di sini jika perlu
        User::create([
            'name'      => 'Kasir Bengkel',
            'email'     => 'kasir@gmail.com',
            'password'  => Hash::make('kasir123'),
            'role'      => 'kasir',
        ]);
    }
}