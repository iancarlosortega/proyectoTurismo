<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurismoController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/lugaresTuristicos', function () {
    return view('lugaresTuristicos');
})->name('lugaresTuristicos');

Route::get('/quienesSomos', function () {
    return view('aboutUs');
})->name('quienesSomos');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/lugaresTuristicos/parques', [TurismoController::class, 'parques'])->name('lugaresTuristicos.parques');
Route::get('/lugaresTuristicos/hoteles', [TurismoController::class, 'hoteles'])->name('lugaresTuristicos.hoteles');
Route::get('/lugaresTuristicos/restaurantes', [TurismoController::class, 'restaurantes'])->name('lugaresTuristicos.restaurantes');
Route::get('/lugaresTuristicos/iglesias', [TurismoController::class, 'iglesias'])->name('lugaresTuristicos.iglesias');

Route::get('lugaresTuristicos/{lugar}', [TurismoController::class, 'show'])->name('lugaresTuristicos.show');

Route::get('/graficas', [ChartController::class, 'index'])->name('visualizaciones');
Route::post('/graficas/actualizar', [ChartController::class, 'graficar'])->name('visualizaciones.actualizar');
Route::post('/graficas/compartiva/mes', [ChartController::class, 'compararMeses'])->name('comparativa.mes.actualizar');
Route::post('/graficas/compartiva/anio', [ChartController::class, 'compararAnios'])->name('comparativa.anio.actualizar');
Route::post('/graficas/analisis/mes', [ChartController::class, 'analisisMeses'])->name('analisis.mes.actualizar');
Route::post('/graficas/analisis/anio', [ChartController::class, 'analisisAnios'])->name('analisis.anio.actualizar');

Route::get('/prueba', [ChartController::class, 'prueba'])->name('prueba');



