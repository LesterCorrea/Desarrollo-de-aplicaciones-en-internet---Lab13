@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Mis Álbumes</h2>
        <a href="{{ route('albums.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded transition">
            Crear Álbum
        </a>
    </div>

    @if (sizeof($albums) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($albums as $album)
                <div class="bg-white rounded-lg shadow">

                    <div class="bg-gray-50 border-b border-gray-200 px-4 py-3 rounded-t-lg">
                        <h5 class="font-semibold text-gray-800">{{ $album->album_nombre }}</h5>
                    </div>

                    <div class="px-4 py-3">
                        <p class="text-sm text-gray-600 mb-4">{{ $album->album_descripcion }}</p>

                        <div class="flex gap-2 flex-wrap">

                            {{-- Ver Fotos --}}
                            <a href="{{ route('fotos.index', ['album_id' => $album->id]) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Ver Fotos
                            </a>

                            {{-- Editar --}}
                            <a href="{{ route('albums.edit', $album->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                Editar
                            </a>

                            {{-- Eliminar --}}
                            <form method="POST" action="{{ route('albums.destroy', $album->id) }}"
                                onsubmit="return confirm('¿Está seguro que desea eliminar este álbum? Recuerde que se eliminarán todas las fotos de este álbum.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded transition">
                                    Eliminar
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
            <p>Al parecer no tiene álbumes. ¡Cree uno!</p>
        </div>
    @endif

@endsection