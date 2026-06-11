<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_nombre',
        'foto_descripcion',
        'foto_ruta',
        'album_id',
    ];

    // Una foto pertenece a un álbum
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}