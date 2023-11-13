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

Route::get('/home/{axo}/{month}', 'HomeController@home_soporte')->name('home_soporte');
Route::get('/home/soporte_activos/{sucursal}/{estado}/{categoria}', 'HomeController@soporte_activos')->name('soporte_activos');
Route::get('/home/soporte_activos/get_data/{sucursal}', 'HomeController@get_data')->name('get_data');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/{id}', 'HomeController@unidad')->name('unidad');

Route::get('/load_unidades', 'HomeController@load_unidades')->name('load_unidades');


Route::resource('usuario', 'produccion\UsuarioController');
Route::resource('rol', 'produccion\RolController');

Route::resource('proyecto', 'produccion\ProyectoController');
Route::resource('proyecto_finalizado', 'produccion\ProyectoFinalizadoController');
Route::get('actividades_tiempo', 'produccion\ActividadController@actividades_tiempo');
Route::resource('actividades', 'produccion\ActividadController');
Route::resource('actividades_finalizadas', 'produccion\ActividadFinalizadaController');
Route::resource('actividades_coordinador', 'produccion\ActividadCoordinadorController');

Route::resource('bitacora_cambio_base', 'produccion\BitacoraCambioBaseController');
Route::resource('bitacora_rendimiento_base', 'produccion\BitacoraRendimientoBaseController');


Route::post('facturar/get_data', 'produccion\FacturarController@get_data');
Route::resource('facturar', 'produccion\FacturarController');
Route::get('facturar/{mes}/{anio}', 'produccion\FacturarController@facturar');


Route::get('iso/matriz_riesgo2022', 'produccion\IsoMatrizController@iso2022');
Route::get('iso/matriz_riesgo', 'produccion\IsoMatrizController@index');

//catalogos
Route::resource('unidad', 'catalogo\UnidadController');
Route::resource('estado', 'catalogo\EstadoController');
Route::resource('categoria', 'catalogo\CategoriaController');
Route::resource('prioridad', 'catalogo\PrioridadController');

Route::post('prueba', 'TestController@update');
Route::get('prueba', 'TestController@index');
Route::get('prueba/resultado/{usuario}/{fecha}', 'TestController@resultado');
Route::resource('catalogo/propietario', 'catalogo\PropietarioController');

Route::get('calendarizacion/get_data/{fecha}', 'produccion\CalendarizacionController@get_data');
Route::resource('calendarizacion','produccion\CalendarizacionController');




