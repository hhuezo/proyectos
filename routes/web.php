<?php

use Illuminate\Support\Facades\Route;
use App\Events\OrderStatusChangedEvent;

use App\User;
use App\Notifications\TaskCompleted;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();

Route::get('/', 'TestController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuario', 'produccion\UsuarioController');

Route::resource('proyecto', 'produccion\ProyectoController');
Route::resource('proyecto_finalizado', 'produccion\ProyectoFinalizadoController');
Route::resource('actividades', 'produccion\ActividadController');
Route::resource('actividades_finalizadas', 'produccion\ActividadFinalizadaController');
Route::resource('actividades_coordinador', 'produccion\ActividadCoordinadorController');

Route::get('iso/matriz_riesgo2022', 'produccion\IsoMatrizController@iso2022');
Route::get('iso/matriz_riesgo', 'produccion\IsoMatrizController@index');

//catalogos
Route::resource('unidad', 'catalogo\UnidadController');
Route::resource('estado', 'catalogo\EstadoController');
Route::resource('categoria', 'catalogo\CategoriaController');





