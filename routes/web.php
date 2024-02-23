<?php

use Illuminate\Support\Facades\Route;
use App\Events\OrderStatusChangedEvent;
use App\Http\Controllers\HomeController;
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


//seguridad
Route::post('usuario/attach_roles','produccion\UsuarioController@attach_roles');
Route::post('usuario/dettach_roles','produccion\UsuarioController@dettach_roles');
Route::resource('usuario', 'produccion\UsuarioController');

Route::post('produccion/rol/unlink_permission', 'produccion\RolController@unlink_permission');
Route::post('produccion/rol/link_permission', 'produccion\RolController@link_permission');
Route::resource('produccion/rol', 'produccion\RolController');
Route::resource('produccion/permisos', 'produccion\PermissionController');

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



//graficas
Route::post('dashboard/update_grafica','DashboardController@update_grafica');
Route::resource('dashboard','DashboardController');

Route::post('project/send_data_role','project\ProjectController@send_data_role');
Route::get('project/set_sesion/{id}','project\ProjectController@set_sesion');
Route::post('project/summary','project\ProjectController@summary');
Route::post('project/assumptions','project\ProjectController@assumptions');
Route::post('project/team_activate','project\ProjectController@team_activate');
Route::post('project/team_inactivate','project\ProjectController@team_inactivate');
Route::post('project/team_update','project\ProjectController@team_update');
Route::post('project/send_data/{id}','project\ProjectController@send_data');
Route::post('project/send_data_requirement','project\ProjectController@send_data_requirement');


Route::resource('project','project\ProjectController');

Route::resource('infraestructura/proveedores', 'infraestructura\ProveedoresController');
Route::get('infraestructura/evaluaciones/edit_evaluacion/{id}','infraestructura\EvalProveedoresController@edit_evaluacion');
Route::post('infraestructura/evaluaciones/modificar_evaluacion/{id}','infraestructura\EvalProveedoresController@modificar_evaluacion');
Route::post('infraestructura/evaluaciones/updateData/{id}/{criterio}', 'infraestructura\EvalProveedoresController@updateData');
Route::get('infraestructura/evaluaciones/guardar_mensaje/{id}','infraestructura\EvalProveedoresController@guardar_mensaje');
//Route::get('infraestructura/evaluaciones/graficos', 'infraestructura\EvalProveedoresController@grafico');
Route::get('infraestructura/evaluaciones/reporte/{axo}/{month}','infraestructura\EvalProveedoresController@reporte')->name('reporte');;
Route::resource('infraestructura/evaluaciones', 'infraestructura\EvalProveedoresController');

Route::post('infraestructura/vacaciones/reporte', 'infraestructura\CalendarioVacacioncontroller@reporte');
Route::resource('infraestructura/vacaciones', 'infraestructura\CalendarioVacacioncontroller');

#actividades finalizadas
Route::get('get_actividades_finalizadas/{id}', [HomeController::class, 'get_actividades_finalizadas']);
Route::post('usuario/perfil', 'produccion\UsuarioController@update_perfil');
Route::post('/upload', 'produccion\UsuarioController@store_file')->name('dropzone.store');

