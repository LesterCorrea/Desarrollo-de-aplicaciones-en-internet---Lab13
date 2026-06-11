<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // GET /album/fotos?album_id={id} — listar fotos de un álbum
    public function index(Request $request)
    {
        $album_id = $request->get('album_id');
        $album    = Album::findOrFail($album_id);

        // Verificar que el álbum pertenece al usuario logueado
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $fotos = $album->fotos;

        return view('album.fotos', [
            'fotos' => $fotos,
            'album' => $album,
        ]);
    }

    // GET /foto/crear?album_id={id} — formulario para crear foto
    public function create(Request $request)
    {
        $album_id = $request->get('album_id');
        $album    = Album::findOrFail($album_id);

        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        return view('foto.crear', ['album' => $album]);
    }

    // POST /foto/crear — guardar nueva foto
    public function store(Request $request)
    {
        $request->validate([
            'foto_nombre'      => ['required', 'string', 'max:255'],
            'foto_descripcion' => ['nullable', 'string', 'max:500'],
            'foto_archivo'     => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:4096'],
            'album_id'         => ['required', 'exists:albums,id'],
        ], [
            'foto_nombre.required'  => 'El nombre de la foto es obligatorio.',
            'foto_archivo.required' => 'Debes seleccionar una imagen.',
            'foto_archivo.image'    => 'El archivo debe ser una imagen.',
            'foto_archivo.mimes'    => 'Solo se permiten imágenes jpg, jpeg, png, gif o webp.',
            'foto_archivo.max'      => 'La imagen no puede superar los 4MB.',
        ]);

        // Guardar la imagen en storage/app/public/fotos/
        $ruta = $request->file('foto_archivo')->store('fotos', 'public');

        Foto::create([
            'foto_nombre'      => $request->foto_nombre,
            'foto_descripcion' => $request->foto_descripcion,
            'foto_ruta'        => $ruta,
            'album_id'         => $request->album_id,
        ]);

        return redirect()->route('fotos.index', ['album_id' => $request->album_id])
            ->with('correcto', 'Foto agregada correctamente.');
    }

    // GET /foto/actualizar?foto_id={id} — formulario para editar foto
    public function edit(Request $request)
    {
        $foto  = Foto::findOrFail($request->get('foto_id'));
        $album = $foto->album;

        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        return view('foto.editar', [
            'foto'  => $foto,
            'album' => $album,
        ]);
    }

    // PUT /foto/actualizar — actualizar foto
    public function update(Request $request)
    {
        $foto  = Foto::findOrFail($request->foto_id);
        $album = $foto->album;

        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'foto_nombre'      => ['required', 'string', 'max:255'],
            'foto_descripcion' => ['nullable', 'string', 'max:500'],
            'foto_archivo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:4096'],
        ], [
            'foto_nombre.required' => 'El nombre de la foto es obligatorio.',
            'foto_archivo.image'   => 'El archivo debe ser una imagen.',
            'foto_archivo.mimes'   => 'Solo se permiten imágenes jpg, jpeg, png, gif o webp.',
            'foto_archivo.max'     => 'La imagen no puede superar los 4MB.',
        ]);

        // Si subió una nueva imagen, reemplazar la anterior
        if ($request->hasFile('foto_archivo')) {
            Storage::disk('public')->delete($foto->foto_ruta);
            $ruta = $request->file('foto_archivo')->store('fotos', 'public');
            $foto->foto_ruta = $ruta;
        }

        $foto->foto_nombre      = $request->foto_nombre;
        $foto->foto_descripcion = $request->foto_descripcion;
        $foto->save();

        return redirect()->route('fotos.index', ['album_id' => $album->id])
            ->with('correcto', 'Foto actualizada correctamente.');
    }

    // GET /foto/eliminar?foto_id={id} — eliminar foto
    public function destroy(Request $request)
    {
        $foto  = Foto::findOrFail($request->get('foto_id'));
        $album = $foto->album;

        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        // Eliminar el archivo físico del storage
        Storage::disk('public')->delete($foto->foto_ruta);
        $foto->delete();

        return redirect()->route('fotos.index', ['album_id' => $album->id])
            ->with('correcto', 'Foto eliminada correctamente.');
    }
}