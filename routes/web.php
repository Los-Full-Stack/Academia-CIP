<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/cursos', function () {
    return view('cursos.index');
});

Route::get('/cursos/{id}', function ($id) {
    return view('cursos.show');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

use App\Http\Controllers\MatriculaController;

Route::post('/matricula/validar-colegiado', [MatriculaController::class, 'validarColegiado'])->name('matricula.validar-colegiado');