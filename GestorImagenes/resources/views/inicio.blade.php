@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Dashboard</h2>

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded text-sm mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-gray-600">
                    {{ __('Bienvenido') }}, {{ Auth::user()->nombre }}
                </p>
            </div>
        </div>
    </div>
@endsection