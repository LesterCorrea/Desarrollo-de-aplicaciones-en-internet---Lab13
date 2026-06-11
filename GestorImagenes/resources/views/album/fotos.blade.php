@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            Fotos de: {{ $album->album_nombre }}
        </h2>
        <div class="flex gap-2">
            <a href="{{ route('albums.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold px-4 py-2 rounded transition">
                ← Volver
            </a>
            <a href="{{ route('fotos.create', ['album_id' => $album->id]) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded transition">
                Crear Foto
            </a>
        </div>
    </div>

    @if (sizeof($fotos) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($fotos as $foto)
                <div class="bg-white rounded-lg shadow">

                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 rounded-t-lg">
                        <h5 class="font-semibold text-gray-800">{{ $foto->foto_nombre }}</h5>
                    </div>

                    {{-- Imagen --}}
                    <div class="px-4 pt-4">
                        <img src="{{ Storage::url($foto->foto_ruta) }}"
                            alt="{{ $foto->foto_nombre }}"
                            class="w-full object-cover rounded">
                    </div>

                    <div class="px-4 py-3">
                        <p class="text-sm text-gray-600 mb-3">{{ $foto->foto_descripcion }}</p>

                        <div class="flex gap-2">
                            {{-- Editar --}}
                            <a href="{{ route('fotos.edit', ['foto_id' => $foto->id]) }}"
                                class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Editar
                            </a>

                            {{-- Eliminar --}}
                            <a href="{{ route('fotos.destroy', ['foto_id' => $foto->id]) }}"
                                onclick="return confirm('¿Está seguro que desea eliminar esta foto?')"
                                class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Eliminar
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
            <p>Al parecer no tiene fotos. ¡Cree una!</p>
        </div>
    @endif

@endsection