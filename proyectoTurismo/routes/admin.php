<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\LugaresController;
use Illuminate\Http\Request; 


Route::get('', [HomeController::class, 'index']);
Route::get('cargaDatos', [HomeController::class, 'cargaDatos'])->name('cargaDatos');
Route::get('metricas', [HomeController::class, 'metricas'])->name('metricas');
Route::get('graficas', [HomeController::class, 'graficas'])->name('graficas');
Route::get('visualizarDatos', [HomeController::class, 'visualizarDatos'])->name('visualizarDatos');
Route::get('turismo', [HomeController::class, 'turismo'])->name('turismo');
Route::get('profile', [HomeController::class, 'profile'])->name('admin.profile');

Route::post('cargaDatos/subirArchivo', 'App\Http\Controllers\CargaController@cargarArchivos')->name('datos.cargar');
Route::get('cargaDatos/subirArchivo', 'App\Http\Controllers\CargaController@index')->name('datos.index');
Route::get('archivos/eliminar/{id}','App\Http\Controllers\CargaController@eliminar')->name('datos.eliminar');
Route::post('archivos/descargar/{id}','App\Http\Controllers\CargaController@descargar')->name('datos.descargar');
Route::get('archivos/visualizar','App\Http\Controllers\CargaController@visualizarDatos')->name('datos.visualizar');
Route::get('archivos/eliminar/todos','App\Http\Controllers\CargaController@truncate')->name('datos.truncate');

Route::get('usuarios', 'App\Http\Controllers\UserController@index')->name('usuarios.index');
Route::post('usuarios/registrar', 'App\Http\Controllers\UserController@registrar')->name('usuarios.registrar');
Route::get('usuarios/eliminar/{id}','App\Http\Controllers\UserController@eliminar')->name('usuarios.eliminar');
Route::get('usuarios/editar/{id}', 'App\Http\Controllers\UserController@editar')->name('usuarios.editar');
Route::post('usuarios/actualizar', 'App\Http\Controllers\UserController@actualizar')->name('usuarios.actualizar');

Route::get('lugares', 'App\Http\Controllers\LugarController@index')->name('lugares.index');
Route::post('lugares', 'App\Http\Controllers\LugarController@registrar')->name('lugares.registrar');
Route::get('lugares/eliminar/{id}','App\Http\Controllers\LugarController@eliminar')->name('lugares.eliminar');
Route::get('lugares/editar/{id}', 'App\Http\Controllers\LugarController@editar')->name('lugares.editar');
Route::post('lugares/actualizar', 'App\Http\Controllers\LugarController@actualizar')->name('lugares.actualizar');

Route::get('metricas', 'App\Http\Controllers\MetricaController@index')->name('metricas.index');
Route::post('metricas', 'App\Http\Controllers\MetricaController@registrar')->name('metricas.registrar');
Route::get('metricas/eliminar/{id}','App\Http\Controllers\MetricaController@eliminar')->name('metricas.eliminar');
Route::get('metricas/editar/{id}', 'App\Http\Controllers\MetricaController@editar')->name('metricas.editar');
Route::post('metricas/actualizar', 'App\Http\Controllers\MetricaController@actualizar')->name('metricas.actualizar');

//graficas
//nombre de la vista, ruta controlador, nombre de la direccion
Route::get('graficas2','App\Http\Controllers\GraficosController@all')->name('graficas');
Route::post('store','App\Http\Controllers\GraficosController@store')->name('store');
Route::get('store','App\Http\Controllers\GraficosController@store')->name('store');
Route::get('graficas2.index', 'App\Http\Controllers\GraficosController@index')->name('graficas2.index');
Route::get('upload', 'App\Http\Controllers\uploadController@upload')->name('upload');
Route::post('upload', 'App\Http\Controllers\uploadController@upload')->name('upload');

Route::get('graficas/eliminar/{id}','App\Http\Controllers\GraficosController@eliminar')->name('graficas2.eliminar');
Route::get('graficas/editar/{id}', 'App\Http\Controllers\GraficosController@editar')->name('graficas2.editar');
Route::post('graficas/actualizar', 'App\Http\Controllers\GraficosController@actualizar')->name('graficas2.actualizar');
Route::post('graficas/graficar', 'App\Http\Controllers\GraficosController@graficar')->name('graficas2.graficar');
Route::get('graficas/graficar', 'App\Http\Controllers\GraficosController@graficar')->name('graficas2.graficar');


