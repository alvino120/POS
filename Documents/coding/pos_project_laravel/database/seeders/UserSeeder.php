<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'nama' => 'Administrator',
            'email' => 'admin@tokojaya.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'level' => 'admin',
            'alamat' => 'Dlanggu, Mojokerto',
            'status' => 'pegawai'
        ]);

        User::create([
            'nama' => 'Vino',
            'email' => 'vino@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'level' => 'customer',
            'alamat' => 'Gondang, Mojokerto',
            'status' => 'member'
        ]);

        User::create([
            'nama' => 'Haikal',
            'email' => 'haikal@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'level' => 'manager',
            'alamat' => 'Bloto, Mojokerto',
            'status' => 'pegawai'
        ]);
    }
}
