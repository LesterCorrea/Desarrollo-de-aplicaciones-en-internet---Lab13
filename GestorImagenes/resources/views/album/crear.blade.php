@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg shadow">

                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 rounded-t-lg">
                    <h2 class="text-lg font-semibold text-gray-800">Crear Álbum</h2>
                </div>

                <div class="px-6 py-6">
                    <form method="POST" action="{{ route('albums.store') }}">
                        @csrf

                        {{-- Nombre --}}
                        <div class="mb-4">
                            <label for="album_nombre"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre del álbum
                            </label>
                            <input id="album_nombre" type="text" name="album_nombre"
                                value="{{ old('album_nombre') }}" required autofocus
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                @error('album_nombre') border-red-500 @enderror">
                            @error('album_nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-6">
                            <label for="album_descripcion"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="album_descripcion" name="album_descripcion" rows="3"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                @error('album_descripcion') border-red-500 @enderror">{{ old('album_descripcion') }}</textarea>
                            @error('album_descripcion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="flex justify-between">
                            <a href="{{ route('albums.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold px-5 py-2 rounded transition">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded transition">
                                Guardar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection