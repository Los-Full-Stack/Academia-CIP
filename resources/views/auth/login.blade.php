@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Iniciar Sesión</h2>

        <!-- Botón Google -->
        <a href="{{ url('/auth/google') }}" class="w-full flex items-center justify-center gap-3 border border-gray-300 py-2.5 px-4 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.26 21.36 7.35 24 12 24z"/>
                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.16 0 9.98 0 12c0 2.02.46 3.84 1.26 5.42l4.02-3.15z"/>
                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.35 0 3.26 2.64 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
            </svg>
            Continuar con Google
        </a>

        <div class="relative my-6 text-center">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <span class="relative bg-white px-3 text-xs uppercase text-gray-400 tracking-wider">o correo electrónico</span>
        </div>

        <!-- Formulario Tradicional -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase mb-1">Correo Electrónico</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-700 focus:bg-white transition-all">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase mb-1">Contraseña</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-red-700 focus:bg-white transition-all">
            </div>

            <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-xl text-sm transition-colors mt-2 shadow">
                Iniciar Sesión
            </button>
        </form>

    </div>
</div>
@endsection