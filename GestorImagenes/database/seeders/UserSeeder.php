<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nombre'   => 'usuario0',
            'email'    => 'usuario0@mail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'nombre'   => 'Yanina',
            'email'    => 'yanina@mail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}