@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg shadow">

                <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 rounded-t-lg">
                    <h2 class="text-lg font-semibold text-gray-800">Actualizar Usuario</h2>
                </div>

                <div class="px-6 py-6">
                    <form method="POST" action="{{ route('usuario.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <div class="flex items-center mb-4">
                            <label for="nombre"
                                class="w-40 text-sm font-medium text-gray-700 text-right pr-4">
                                Nombre
                            </label>
                            <div class="flex-1">
                                <input id="nombre" type="text" name="nombre"
                                    value="{{ old('nombre', Auth::user()->nombre) }}"
                                    required autofocus
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                    @error('nombre') border-red-500 @enderror">
                                @error('nombre')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="flex items-center mb-4">
                            <label for="password"
                                class="w-40 text-sm font-medium text-gray-700 text-right pr-4">
                                Contraseña
                            </label>
                            <div class="flex-1">
                                <input id="password" type="password" name="password"
                                    autocomplete="new-password"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                                    @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirmar Password --}}
                        <div class="flex items-center mb-6">
                            <label for="password_confirmation"
                                class="w-40 text-sm font-medium text-gray-700 text-right pr-4">
                                Confirmar contraseña
                            </label>
                            <div class="flex-1">
                                <input id="password_confirmation" type="password"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        {{-- Botón --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2 rounded transition">
                                Actualizar
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection