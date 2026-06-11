<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarPerfilRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // GET /usuario/actualizar
    public function edit()
    {
        return view('usuario.actualizar');
    }

    // PUT /usuario/actualizar
    public function update(ActualizarPerfilRequest $request)
    {
        $user = Auth::user();

        $user->nombre = $request->nombre;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('inicio')
            ->with('correcto', 'Su perfil ha sido actualizado.');
    }
}