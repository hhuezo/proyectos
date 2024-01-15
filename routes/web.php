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


Route::get('/home/soporte/get_produccion_impresoras/{serial}', 'HomeController@get_produccion_impresoras')->name('get_produccion_impresoras');
Route::get('/home/{axo}/{month}', 'HomeController@home_soporte')->name('home_soporte');

Route::get('home/soporte_activos_iso/', 'HomeController@soporte_activos_iso');
Route::get('home/soporte_activos/get_data_activos/{sucursal}/{area}', 'HomeController@get_data_activos');
Route::get('/home/soporte_activos/{sucursal}/{estado}/{categoria}/{area}', 'HomeController@soporte_activos')->name('soporte_activos');
Route::get('/home/soporte_activos_categoria/{sucursal}/{estado}/{categoria}/{area}', 'HomeController@soporte_activos_sucursal')->name('soporte_activos_sucursal');
Route::get('/home/soporte_mantenimientos_auditoria/{sucursal}/{area}/{activo}', 'HomeController@soporte_mantenimientos_auditoria')->name('soporte_mantenimientos_auditoria');


Route::get('/home/soporte_mantenimientos/{sucursal}/{area}/{activo}', 'HomeController@soporte_mantenimientos')->name('soporte_mantenimientos');
Route::get('/home/soporte_ribbon/{sucursal}/{banco}', 'HomeController@soporte_ribbon')->name('soporte_ribbon');
Route::get('/home/soporte_dispositivos/{sucursal}/{banco}', 'HomeController@soporte_dispositivos')->name('soporte_dispositivos');
Route::get('/home/soporte_activos/get_data_banco/{sucursal}', 'HomeController@get_data_banco')->name('get_data_banco');


Route::get('/home/soporte_activos/get_data/{sucursal}', 'HomeController@get_data')->name('get_data');
Route::get('/home/soporte_activos_categoria/get_data/{sucursal}', 'HomeController@get_data_categoria')->name('get_data_categoria');

Route::get('/home/charts/get_tiempo_invertido_anual/{anio}', 'HomeController@get_tiempo_invertido_anual')->name('get_tiempo_invertido_anual');
Route::get('/home/charts/get_tiempo_invertido/{anio}', 'HomeController@get_tiempo_invertido')->name('get_tiempo_invertido');
Route::get('/home/charts/get_rendimiento_bd/{anio}', 'HomeController@get_data_rendimiento_bd')->name('get_data_rendimiento_bd');
Route::get('/home/charts/get_modal_rendimiento_bd/{anio}/{categoria}/{mes}', 'HomeController@get_modal_rendimiento_bd')->name('get_modal_rendimiento_bd');

Route::get('/home/soporte_activos/get_data_mantenimiento/{sucursal}', 'HomeController@get_data_mantenimiento')->name('get_data_mantenimiento');
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
Route::resource('iso/matriz_riesgo', 'produccion\IsoMatrizController');

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
Route::get('calendarizacion/{year}', 'produccion\CalendarizacionController@get_data_year');
Route::resource('calendarizacion', 'produccion\CalendarizacionController');
Route::resource('inventario_despliegues', 'catalogo\InventarioDespliegueController');
