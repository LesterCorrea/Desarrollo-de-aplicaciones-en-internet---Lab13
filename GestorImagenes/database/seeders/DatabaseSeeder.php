<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // El orden importa: primero usuarios, luego álbumes, luego fotos
        $this->call([
            UserSeeder::class,
            AlbumSeeder::class,
            FotoSeeder::class,
        ]);
    }
}