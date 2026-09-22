@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-gray-100 rounded-xl p-6 mb-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-gray-900">Catálogo de Cursos</h1>
        <p class="text-gray-600 mt-1">Encuentra y matricúlate en los programas de actualización disponibles.</p>
    </div>

    <!-- Grid de Cursos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cursos ?? [1, 2, 3, 4, 5, 6] as $curso)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
                    Miniatura Curso
                </div>
                <div class="p-5 flex-grow">
                    <h2 class="font-bold text-lg text-gray-900">Curso Especializado {{ is_numeric($curso) ? $curso : $curso->titulo }}</h2>
                    <p class="text-sm text-gray-500 mt-2">Módulos prácticos dictados por especialistas colegiados.</p>
                </div>
                <div class="p-5 pt-0">
                    <a href="{{ url('/cursos/' . (is_numeric($curso) ? $curso : $curso->id)) }}" class="w-full block text-center bg-red-700 hover:bg-red-800 text-white font-medium py-2 rounded-lg transition-colors text-sm">
                        Ver Curso
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No se encontraron cursos disponibles.
            </div>
        @endforelse
    </div>
</div>
@endsection