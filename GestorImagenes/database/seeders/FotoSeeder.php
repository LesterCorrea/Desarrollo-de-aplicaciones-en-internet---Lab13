<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foto;

class FotoSeeder extends Seeder
{
    public function run(): void
    {
        // 5 fotos en el álbum 1 (para poder ver la vista de fotos del lab)
        for ($i = 1; $i <= 5; $i++) {
            Foto::create([
                'foto_nombre'       => "Nombre Foto $i",
                'foto_descripcion'  => "Descripción foto $i",
                'foto_ruta'         => "uploads/placeholder.jpg",
                'album_id'          => 1,
            ]);
        }

        // 3 fotos en el álbum 2
        for ($i = 1; $i <= 3; $i++) {
            Foto::create([
                'foto_nombre'       => "Nombre Foto $i",
                'foto_descripcion'  => "Descripción foto $i",
                'foto_ruta'         => "uploads/placeholder.jpg",
                'album_id'          => 2,
            ]);
        }
    }
}