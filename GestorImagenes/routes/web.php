<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FotoController;

// Raíz: si ya está logueado va al inicio, si no al login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('inicio');
    }
    return redirect()->route('login');
});

// Dashboard protegido
Route::get('/inicio', function () {
    return view('inicio');
})->middleware('auth')->name('inicio');

// Rutas de auth (Breeze)
require __DIR__.'/auth.php';

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::resource('albums', AlbumController::class);

    Route::get('/usuario/actualizar', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/usuario/actualizar', [UsuarioController::class, 'update'])->name('usuario.update');

    // Rutas de fotos
    Route::get('/album/fotos',       [FotoController::class, 'index'])->name('fotos.index');
    Route::get('/foto/crear',        [FotoController::class, 'create'])->name('fotos.create');
    Route::post('/foto/crear',       [FotoController::class, 'store'])->name('fotos.store');
    Route::get('/foto/actualizar',   [FotoController::class, 'edit'])->name('fotos.edit');
    Route::put('/foto/actualizar',   [FotoController::class, 'update'])->name('fotos.update');
    Route::get('/foto/eliminar',     [FotoController::class, 'destroy'])->name('fotos.destroy');
});