<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_nombre',
        'album_descripcion',
        'user_id',
    ];

    // Un álbum pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un álbum tiene muchas fotos
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}