<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Petuga\App\Models\s::create([
            'nama_petugas' => 'Administrator',
            'username' => 'Admin',
            'password' => Hash::make('123'),
            'telp' => '081807175316',
            'level' => 'admin',
        ]);
    }
}
