<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestorImagenes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('albums.index') }}" class="text-lg font-bold text-blue-600">
                GestorImagenes
            </a>

            {{-- Links de navegación --}}
            @auth
                <div class="flex items-center gap-4">

                    <a href="{{ route('albums.index') }}"
                        class="text-sm text-gray-600 hover:text-blue-600 transition">
                        Mis Álbumes
                    </a>

                    {{-- Dropdown usuario --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-1 text-sm text-gray-700 hover:text-blue-600 transition focus:outline-none">
                            {{ Auth::user()->nombre }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-10">

                            <a href="{{ route('usuario.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Actualizar perfil
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @else
                <div class="flex gap-3">
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-600 hover:text-blue-600 transition">Iniciar sesión</a>
                    <a href="{{ route('register') }}"
                        class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Registrarse</a>
                </div>
            @endauth

        </div>
    </nav>

    {{-- Contenido principal --}}
    <main class="max-w-6xl mx-auto px-4 pb-10">

        {{-- Mensaje de éxito global --}}
        @if (session('correcto'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4 text-sm">
                <strong>¡Realizado!</strong> {{ session('correcto') }}
            </div>
        @endif

        {{-- Mensaje de error global --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>