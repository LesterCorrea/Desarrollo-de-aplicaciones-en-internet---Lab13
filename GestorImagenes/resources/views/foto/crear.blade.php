@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg shadow">

                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 rounded-t-lg">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Agregar Foto — {{ $album->album_nombre }}
                    </h2>
                </div>

                <div class="px-6 py-6">
                    <form method="POST" action="{{ route('fotos.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- album_id oculto --}}
                        <input type="hidden" name="album_id" value="{{ $album->id }}">

                        {{-- Nombre --}}
                        <div class="mb-4">
                            <label for="foto_nombre"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre de la foto
                            </label>
                            <input id="foto_nombre" type="text" name="foto_nombre"
                                value="{{ old('foto_nombre') }}" required autofocus
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                @error('foto_nombre') border-red-500 @enderror">
                            @error('foto_nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-4">
                            <label for="foto_descripcion"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="foto_descripcion" name="foto_descripcion" rows="2"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('foto_descripcion') }}</textarea>
                        </div>

                        {{-- Archivo --}}
                        <div class="mb-6">
                            <label for="foto_archivo"
                                class="block text-sm font-medium text-gray-700 mb-1">
                                Imagen
                            </label>
                            <input id="foto_archivo" type="file" name="foto_archivo"
                                accept="image/*" required
                                class="w-full text-sm text-gray-600 border border-gray-300 rounded px-3 py-2
                                @error('foto_archivo') border-red-500 @enderror">
                            @error('foto_archivo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Preview de imagen --}}
                        <div id="preview-container" class="mb-4 hidden">
                            <img id="preview-img" src="#" alt="Preview"
                                class="w-full h-48 object-cover rounded border border-gray-200">
                        </div>

                        {{-- Botones --}}
                        <div class="flex justify-between">
                            <a href="{{ route('fotos.index', ['album_id' => $album->id]) }}"
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

    {{-- Preview JS --}}
    <script>
        document.getElementById('foto_archivo').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    document.getElementById('preview-img').src = ev.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection