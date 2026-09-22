@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb / Header de la vista -->
    <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
        <a href="{{ url('/cursos') }}" class="hover:text-red-700">Cursos</a>
        <span>/</span>
        <span class="text-gray-900 font-semibold">{{ $curso->titulo ?? 'Nombre Curso' }}</span>
    </nav>

    <!-- Ficha del Curso -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- Foto Curso -->
            <div class="md:col-span-5">
                <div class="w-full aspect-[4/3] bg-gray-200 rounded-xl overflow-hidden flex items-center justify-center text-gray-400 font-medium">
                    Foto del Curso
                </div>
            </div>

            <!-- Info Curso + Botón Inscribirse -->
            <div class="md:col-span-7 flex flex-col justify-between h-full space-y-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $curso->titulo ?? 'Nombre del Curso Seleccionado' }}</h1>
                    <p class="text-sm text-red-700 font-semibold mt-1">Colegio de Ingenieros del Perú - Filial Cusco</p>
                    
                    <div class="mt-4 text-gray-600 space-y-3 leading-relaxed">
                        <p>{{ $curso->descripcion ?? 'Descripción general del temario, requerimientos técnicos, perfil del participante y competencias a desarrollar durante el programa.' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-6 pt-4 border-t border-gray-100 text-sm">
                        <div>
                            <span class="text-gray-500 block">Modalidad</span>
                            <span class="font-semibold text-gray-800">Virtual / Presencial</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block">Certificación</span>
                            <span class="font-semibold text-gray-800">Acreditada por CIP</span>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="{{ url('/inscripcion/' . ($curso->id ?? 1)) }}" class="w-full sm:w-auto inline-block text-center bg-red-700 hover:bg-red-800 text-white font-bold px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all">
                        Inscribirse
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection