<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        // Álbumes del usuario 1 (usuario0)
        for ($i = 1; $i <= 9; $i++) {
            Album::create([
                'album_nombre'       => "Nombre Album $i",
                'album_descripcion'  => "Descripción álbum $i",
                'user_id'            => 1,
            ]);
        }

        // Álbumes del usuario 2 (Yanina)
        for ($i = 1; $i <= 3; $i++) {
            Album::create([
                'album_nombre'       => "Álbum Yanina $i",
                'album_descripcion'  => "Descripción álbum Yanina $i",
                'user_id'            => 2,
            ]);
        }
    }
}