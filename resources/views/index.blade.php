@extends('layouts.app')

@section('content')
<!-- Banner -->
<section class="bg-gradient-to-r from-red-800 to-red-900 text-white py-16 px-4">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Capacitación Profesional Especializada</h1>
        <p class="mt-4 text-lg text-red-100 max-w-2xl mx-auto">Potencia tus competencias técnicas con los cursos de especialización de la Academia CIP Cusco.</p>
        <a href="{{ url('/cursos') }}" class="mt-6 inline-block bg-white text-red-800 font-bold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition-all">Explorar Todos los Cursos</a>
    </div>
</section>

<!-- Top Cursos -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-red-700 pb-2 inline-block">Top Cursos</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($topCursos ?? [1, 2, 3] as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="h-44 bg-gray-200 flex items-center justify-center text-gray-400 font-medium">
                    Imagen del Curso
                </div>
                <div class="p-5">
                    <span class="text-xs font-semibold uppercase tracking-wider text-red-600">Ingeniería</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-1">Gestión y Dirección de Proyectos</h3>
                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">Aprende metodologías clave bajo los estándares de la academia CIP.</p>
                    <a href="{{ url('/cursos/1') }}" class="mt-4 block text-center bg-gray-100 hover:bg-red-700 hover:text-white text-gray-700 font-semibold py-2 rounded-lg text-sm transition-colors">
                        Ver Detalles
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No hay cursos destacados en este momento.</p>
        @endforelse
    </div>
</section>
@endsection