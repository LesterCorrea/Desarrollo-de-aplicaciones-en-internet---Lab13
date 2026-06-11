<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // GET /albums — listar álbumes del usuario logueado
    public function index()
    {
        $user   = Auth::user();
        $albums = $user->albums;

        return view('album.mostrar', ['albums' => $albums]);
    }

    // GET /albums/create — formulario para crear álbum
    public function create()
    {
        return view('album.crear');
    }

    // POST /albums — guardar nuevo álbum
    public function store(Request $request)
    {
        $request->validate([
            'album_nombre'      => ['required', 'string', 'max:255'],
            'album_descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'album_nombre.required' => 'El nombre del álbum es obligatorio.',
            'album_nombre.max'      => 'El nombre no puede superar los 255 caracteres.',
        ]);

        Album::create([
            'album_nombre'      => $request->album_nombre,
            'album_descripcion' => $request->album_descripcion,
            'user_id'           => Auth::id(),
        ]);

        return redirect()->route('albums.index')
            ->with('correcto', 'Álbum creado correctamente.');
    }

    // GET /albums/{id}/edit — formulario para editar álbum
    public function edit(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        return view('album.editar', ['album' => $album]);
    }

    // PUT /albums/{id} — actualizar álbum
    public function update(Request $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'album_nombre'      => ['required', 'string', 'max:255'],
            'album_descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'album_nombre.required' => 'El nombre del álbum es obligatorio.',
        ]);

        $album->update([
            'album_nombre'      => $request->album_nombre,
            'album_descripcion' => $request->album_descripcion,
        ]);

        return redirect()->route('albums.index')
            ->with('correcto', 'Álbum actualizado correctamente.');
    }

    // DELETE /albums/{id} — eliminar álbum
    public function destroy(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $album->delete();

        return redirect()->route('albums.index')
            ->with('correcto', 'Álbum eliminado correctamente.');
    }
}