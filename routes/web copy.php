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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('markAsRead', function () {

    auth()->user()->unreadNotifications->markAsRead();
    
    return redirect()->back();

})->name('markRead');


Route::get('/fire', function(){
    event(new OrderStatusChangedEvent);
    return 'Fired';
});

Route::get('/iso/matriz_riesgo2022/', 'Admin\IsoMatrizController@iso2022'); // listado

Route::group(['middleware' => ['guest']], function (){

    Route::get('/', 'TestController@welcome')->name('welcome');
    // Route::get('/', function () {

    //     //$when = Carbon::now()->addSeconds(10);        
    
    //     $user = user::find(1);
    
    //     //dd($user);
    
    //     User::find(1)->notify(new TaskCompleted);
    
    //     return view('welcome')->with(compact('user'));
    // });



    // lista de proyectos
    Route::get('/proyecto', [App\Http\Controllers\FrontController::class, 'index']);

    // lista de actividades de un proyecto
    Route::get('/proyecto/{proyecto}', [App\Http\Controllers\FrontController::class, 'proyecto']);

    // lista de comentarios de una actividad
    Route::get('/proyecto/{proyecto}/{actividad}', [App\Http\Controllers\FrontController::class, 'actividad']);



    Route::post('/comentario/{actividad}', [App\Http\Controllers\ComentariosController::class,'store'])->name('store');

});

Route::group(['middleware' => ['auth']], function (){

    
    Route::group(['middleware' => ['Gerente']], function (){

        Route::get('/home', 'HomeController@index')->name('home');
    
    });
    
    //
    //
    Route::group(['middleware' => ['Usuario']], function (){

        Route::get('/usuario/actividades', 'Usuario\ActividadController@index'); // listado        
        Route::resource('/usuario/comentarios', 'ComentarioController');

        Route::get('/usuario/edit', 'UsuarioController@edit'); // form edit
        Route::post('/usuario/edit', 'UsuarioController@update'); //update
    
    });


    Route::group(['middleware' => ['Analista']], function (){
        Route::get('/home', 'HomeController@index')->name('home');

        // lista de proyectos
        Route::get('/proyecto', [App\Http\Controllers\FrontController::class, 'index']);

        // lista de actividades de un proyecto
        Route::get('/proyecto/{proyecto}', [App\Http\Controllers\FrontController::class, 'proyecto']);

        // lista de comentarios de una actividad
        Route::get('/proyecto/{proyecto}/{actividad}', [App\Http\Controllers\FrontController::class, 'actividad']);
        

        Route::post('/comentario/{actividad}', [App\Http\Controllers\Admin\ComentariosController::class,'store']);

        Route::get('/analista/actividades', 'Analista\ActividadController@index')->middleware('auth', 'Analista'); // listado        
        Route::get('/analista/actividades/create', 'Analista\ActividadController@create')->middleware('auth', 'Analista'); // form create
        Route::post('/analista/actividades', 'Analista\ActividadController@store')->middleware('auth', 'Analista');; // registrar
        Route::get('/analista/actividades/{id}', 'Analista\ActividadController@pausar')->middleware('auth', 'Analista');

        Route::get('/analista/actividades/{id}/edit', 'Analista\ActividadController@edit'); // form edit
        Route::get('/analista/actividades_tiempo', 'Analista\ActividadController@actividades_tiempo'); // form edit
                            
        Route::resource('/movimiento_actividades', 'Analista\MovimientoActividadController')->middleware('auth', 'Analista');
        Route::post('/analista/movimiento_actividades', 'Analista\MovimientoActividadController@store')->middleware('auth', 'Analista'); // registrar

        Route::get('/usuario/{id}/edit', 'UsuarioController@edit')->middleware('auth', 'Analista'); // form edit
        Route::post('/usuario/{id}/edit', 'UsuarioController@update')->middleware('auth', 'Analista'); //update


        //Mantenimiento de Proyectos
        Route::get('/proyectos', 'ProyectoController@index')->middleware('auth', 'Analista'); // listado
        //Route::get('/admin/proyectos/create', 'Admin\ProyectoController@create'); // form create
        //Route::post('/admin/proyectos', 'Admin\ProyectoController@store'); // registrar
        Route::get('/proyectos/{id}/edit', 'ProyectoController@edit')->middleware('auth', 'Analista'); // form edit
        //Route::post('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@update'); //update
        //Route::delete('/admin/proyectos/{id}', 'Admin\ProyectoController@destroy'); //delete
        Route::get('/proyectos/show/{id}', 'ProyectoController@show')->middleware('auth', 'Analista'); // listado

        //ver comentarios
        //Route::get('/comentarios/show/{id}', 'ComentarioController@show')->middleware('auth', 'Analista'); // listado    
        Route::resource('/analista/comentarios', 'Analista\ComentarioController');





        

        //Mantenimiento de bitacora BD
        Route::get('/analista/bitacora_rendimiento_base_datos', 'Analista\BitacoraRendimientoBaseDatosController@index'); // listado
        Route::get('/analista/bitacora_rendimiento_base_datos/create', 'Analista\BitacoraRendimientoBaseDatosController@create'); // form create
        Route::post('/analista/bitacora_rendimiento_base_datos', 'Analista\BitacoraRendimientoBaseDatosController@store'); // registrar
        Route::get('/analista/bitacora_rendimiento_base_datos/{id}/edit', 'Analista\BitacoraRendimientoBaseDatosController@edit'); // form edit
        Route::post('/analista/bitacora_rendimiento_base_datos/{id}/edit', 'Analista\BitacoraRendimientoBaseDatosController@update'); //update
        Route::delete('/analista/bitacora_rendimiento_base_datos/{id}', 'Analista\BitacoraRendimientoBaseDatosController@destroy'); //delete


        //Mantenimiento de cambio BD
        Route::get('/analista/bitacora_cambio_base_datos', 'Analista\BitacoraCambioBaseDatosController@index'); // listado
        Route::get('/analista/bitacora_cambio_base_datos/create', 'Analista\BitacoraCambioBaseDatosController@create'); // form create
        Route::post('/analista/bitacora_cambio_base_datos', 'Analista\BitacoraCambioBaseDatosController@store'); // registrar
        Route::get('/analista/bitacora_cambio_base_datos/{id}/edit', 'Analista\BitacoraCambioBaseDatosController@edit'); // form edit
        Route::post('/analista/bitacora_cambio_base_datos/{id}/edit', 'Analista\BitacoraCambioBaseDatosController@update'); //update
        Route::delete('/analista/bitacora_cambio_base_datos/{id}', 'Analista\BitacoraCambioBaseDatosController@destroy'); //delete
        

        //Mantenimiento de cambio BD
        Route::get('/analista/creacion_objetos_base_datos', 'Analista\CreacionObjetoBaseDatosController@index'); // listado
        Route::get('/analista/creacion_objetos_base_datos/create', 'Analista\CreacionObjetoBaseDatosController@create'); // form create
        Route::post('/analista/creacion_objetos_base_datos', 'Analista\CreacionObjetoBaseDatosController@store'); // registrar
        Route::get('/analista/creacion_objetos_base_datos/{id}/edit', 'Analista\CreacionObjetoBaseDatosController@edit'); // form edit
        Route::post('/analista/creacion_objetos_base_datos/{id}/edit', 'Analista\CreacionObjetoBaseDatosController@update'); //update
        Route::delete('/analista/creacion_objetos_base_datos/{id}', 'Analista\CreacionObjetoBaseDatosController@destroy'); //delete


        
        //Mantenimiento de cambio BD
        Route::get('/analista/certificacion_objetos_sistema', 'Analista\CertificacionObjetoSistemaController@index'); // listado
        Route::get('/analista/certificacion_objetos_sistema/create', 'Analista\CertificacionObjetoSistemaController@create'); // form create
        Route::post('/analista/certificacion_objetos_sistema', 'Analista\CertificacionObjetoSistemaController@store'); // registrar
        Route::get('/analista/certificacion_objetos_sistema/{id}/edit', 'Analista\CertificacionObjetoSistemaController@edit'); // form edit
        Route::post('/analista/certificacion_objetos_sistema/{id}/edit', 'Analista\CertificacionObjetoSistemaController@update'); //update
        Route::delete('/analista/certificacion_objetos_sistema/{id}', 'Analista\CertificacionObjetoSistemaController@destroy'); //delete
    
    });


    Route::group(['middleware' => ['ArquitectoSoluciones']], function (){
        Route::get('/home', 'HomeController@index')->name('home');

        // lista de proyectos
        Route::get('/proyecto', [App\Http\Controllers\FrontController::class, 'index']);

        // lista de actividades de un proyecto
        Route::get('/proyecto/{proyecto}', [App\Http\Controllers\FrontController::class, 'proyecto']);

        // lista de comentarios de una actividad
        Route::get('/proyecto/{proyecto}/{actividad}', [App\Http\Controllers\FrontController::class, 'actividad']);
        

        Route::post('/comentario/{actividad}', [App\Http\Controllers\Admin\ComentariosController::class,'store']);

        Route::get('/mayra/actividades', 'Mayra\ActividadController@index'); // listado        
        Route::get('/mayra/actividades/create', 'Mayra\ActividadController@create'); // form create
        Route::post('/mayra/actividades', 'Mayra\ActividadController@store'); // registrar
        Route::get('/mayra/actividades/{id}', 'Mayra\ActividadController@pausar');

        Route::get('/mayra/actividades/{id}/edit', 'Mayra\ActividadController@edit'); // form edit

        Route::resource('/movimiento_actividades', 'Mayra\MovimientoActividadController');

        Route::get('/usuario/{id}/edit', 'UsuarioController@edit'); // form edit
        Route::post('/usuario/{id}/edit', 'UsuarioController@update'); //update


        //Mantenimiento de Proyectos
        Route::get('/proyectos', 'ProyectoController@index'); // listado
        //Route::get('/admin/proyectos/create', 'Admin\ProyectoController@create'); // form create
        //Route::post('/admin/proyectos', 'Admin\ProyectoController@store'); // registrar
        Route::get('/proyectos/{id}/edit', 'ProyectoController@edit'); // form edit
        //Route::post('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@update'); //update
        //Route::delete('/admin/proyectos/{id}', 'Admin\ProyectoController@destroy'); //delete
        Route::get('/proyectos/show/{id}', 'ProyectoController@show'); // listado

        //ver comentarios
        //Route::get('/comentarios/show/{id}', 'ComentarioController@show'); // listado   
        Route::resource('/mayra/comentarios', 'Mayra\ComentarioController'); 
    
    });



    Route::group(['middleware' => ['Administrador']], function (){
        Route::get('/home', 'HomeController@index')->name('home');
        
        Route::get('/consolidado_mensual', 'HomeController@consolidado_mensual');

        // lista de proyectos
        Route::get('/proyecto', [App\Http\Controllers\FrontController::class, 'index']);

        // lista de actividades de un proyecto
        Route::get('/proyecto/{proyecto}', [App\Http\Controllers\FrontController::class, 'proyecto']);

        // lista de comentarios de una actividad
        Route::get('/proyecto/{proyecto}/{actividad}', [App\Http\Controllers\FrontController::class, 'actividad']);



        Route::post('/comentario/{actividad}', [App\Http\Controllers\Admin\ComentariosController::class,'store']);



        //Mantenimiento de Coordinador
        Route::get('/admin/coordinador', 'Admin\CoordinadorController@index'); // listado
        Route::get('/admin/coordinador/{id}/edit', 'Admin\CoordinadorController@edit'); // form edit
 
        

        //ver comentarios
        //Route::get('/admin/comentarios/show/{id}', 'Admin\ComentarioController@show'); // listado    
        Route::resource('/admin/comentarios', 'Admin\ComentarioController'); 

        //Mantenimiento de Estados
        Route::get('/admin/estados', 'Admin\EstadoController@index'); // listado
        Route::get('/admin/estados/create', 'Admin\EstadoController@create'); // form create
        Route::post('/admin/estados', 'Admin\EstadoController@store'); // registrar
        Route::get('/admin/estados/{id}/edit', 'Admin\EstadoController@edit'); // form edit
        Route::post('/admin/estados/{id}/edit', 'Admin\EstadoController@update'); //update
        Route::delete('/admin/estados/{id}', 'Admin\EstadoController@destroy'); //delete

        //Mantenimiento de Proyectos
        Route::get('/admin/proyectos', 'Admin\ProyectoController@index'); // listado
        Route::get('/admin/proyectos/create', 'Admin\ProyectoController@create'); // form create
        Route::post('/admin/proyectos', 'Admin\ProyectoController@store'); // registrar
        Route::get('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@edit'); // form edit
        Route::post('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@update'); //update
        Route::delete('/admin/proyectos/{id}', 'Admin\ProyectoController@destroy'); //delete
        Route::get('/admin/proyectos/show/{id}', 'Admin\ProyectoController@show'); // listado
        Route::get('/admin/proyectos/{id}', 'Admin\ProyectoController@destacar');
        Route::post('/admin/proyectos/{id}', 'Admin\ProyectoController@cambiarPorcentaje');
        Route::get('/admin/proyectos/{id}/update', 'Admin\ProyectoController@finalizar');
        Route::get('/finalizado/proyectos', 'Admin\ProyectoFinalizadoController@index'); // listado
        Route::get('/finalizado/actividades/{id}', 'Admin\ActividadFinalizadaController@index'); // listado
        Route::get('/finalizado/actividades/{id}/edit', 'Admin\ActividadFinalizadaController@edit'); // listado
        Route::get('/iso/matriz_riesgo/', 'Admin\IsoMatrizController@index'); // listado
       
        Route::get('/Admin/pivoteTable/', 'Admin\IsoMatrizController@pivoteTable'); // listado
        Route::post('/Admin/proyectos/cambio_estado', 'Admin\ProyectoController@cambio_estado');

        //Mantenimiento de Actividades
        Route::get('/admin/actividades', 'Admin\ActividadController@index'); // listado
        Route::get('/admin/actividades/create', 'Admin\ActividadController@create'); // form create
        Route::post('/admin/actividades', 'Admin\ActividadController@store'); // registrar
        Route::get('/admin/actividades/{id}/edit', 'Admin\ActividadController@edit'); // form edit
        Route::post('/admin/actividades/{id}/edit', 'Admin\ActividadController@update'); //update
        Route::delete('/admin/actividades/{id}', 'Admin\ActividadController@destroy'); //delete
        Route::get('/admin/actividades/{id}', 'Admin\ActividadController@pausar');
        Route::get('/actual/actividades', 'Admin\ActividadActualController@index'); // listado
        Route::get('/actual/actividades/{id}/edit', 'Admin\ActividadActualController@edit'); // form edit
        
        Route::get('/actual/actividades/{id}', 'Admin\ActividadActualController@pausar');


        Route::get('/facturar/actividades', 'Admin\ActividadActualFacturarController@index'); // listado
        Route::get('/listarProductoPdf/{id}', 'Admin\ActividadActualFacturarController@listarPdf')->name('lista_pdf'); // listado


        Route::get('/categoria/finalizadas', 'Admin\CategoriaFinalizadaController@index'); // listado


        //Mantenimiento de Categorias
        Route::get('/admin/categorias', 'Admin\CategoriaController@index'); // listado
        Route::get('/admin/categorias/create', 'Admin\CategoriaController@create'); // form create
        Route::post('/admin/categorias', 'Admin\CategoriaController@store'); // registrar
        Route::get('/admin/categorias/{id}/edit', 'Admin\CategoriaController@edit'); // form edit
        Route::post('/admin/categorias/{id}/edit', 'Admin\CategoriaController@update'); //update
        Route::delete('/admin/categorias/{id}', 'Admin\CategoriaController@destroy'); //delete

        //Mantenimiento de Prioridades
        Route::get('/admin/prioridades', 'Admin\PrioridadController@index'); // listado
        Route::get('/admin/prioridades/create', 'Admin\PrioridadController@create'); // form create
        Route::post('/admin/prioridades', 'Admin\PrioridadController@store'); // registrar
        Route::get('/admin/prioridades/{id}/edit', 'Admin\PrioridadController@edit'); // form edit
        Route::post('/admin/prioridades/{id}/edit', 'Admin\PrioridadController@update'); //update
        Route::delete('/admin/prioridades/{id}', 'Admin\PrioridadController@destroy'); //delete

        //Mantenimiento de Roles
        Route::get('/admin/roles', 'Admin\RolController@index'); // listado
        Route::get('/admin/roles/create', 'Admin\RolController@create'); // form create
        Route::post('/admin/roles', 'Admin\RolController@store'); // registrar
        Route::get('/admin/roles/{id}/edit', 'Admin\RolController@edit'); // form edit
        Route::post('/admin/roles/{id}/edit', 'Admin\RolController@update'); //update
        Route::delete('/admin/roles/{id}', 'Admin\RolController@destroy'); //delete
 

        //Mantenimiento de Unidades
        Route::get('/admin/unidades', 'Admin\UnidadController@index'); // listado
        Route::get('/admin/unidades/create', 'Admin\UnidadController@create'); // form create
        Route::post('/admin/unidades', 'Admin\UnidadController@store'); // registrar
        Route::get('/admin/unidades/{id}/edit', 'Admin\UnidadController@edit'); // form edit
        Route::post('/admin/unidades/{id}/edit', 'Admin\UnidadController@update'); //update
        Route::delete('/admin/unidades/{id}', 'Admin\UnidadController@destroy'); //delete

        
        //Mantenimiento de Movimiento Actividades
        // Route::get('/admin/movimiento_actividades/show/{id}', 'Admin\MovimientoActividadController@show'); // listado
        // Route::post('/admin/movimiento_actividades/', 'Admin\MovimientoActividadController@store'); // store

        Route::resource('/admin/movimiento_actividades', 'Admin\MovimientoActividadController');

        //Mantenimiento de Coordinador
        Route::get('/admin/usuarios', 'Admin\UsuarioController@index'); // listado
        Route::get('/admin/usuarios/{id}/edit', 'Admin\UsuarioController@edit'); // form edit

        Route::get('/admin/usuarios/{id}/edit', 'Admin\UsuarioController@edit'); // form edit
        Route::post('/admin/usuarios/{id}/edit', 'Admin\UsuarioController@update'); //update




        //Mantenimiento de bitacora BD
        Route::get('/admin/bitacora_rendimiento_base_datos', 'Admin\BitacoraRendimientoBaseDatosController@index'); // listado
        Route::get('/admin/bitacora_rendimiento_base_datos/create', 'Admin\BitacoraRendimientoBaseDatosController@create'); // form create
        Route::post('/admin/bitacora_rendimiento_base_datos', 'Admin\BitacoraRendimientoBaseDatosController@store'); // registrar
        Route::get('/admin/bitacora_rendimiento_base_datos/{id}/edit', 'Admin\BitacoraRendimientoBaseDatosController@edit'); // form edit
        Route::post('/admin/bitacora_rendimiento_base_datos/{id}/edit', 'Admin\BitacoraRendimientoBaseDatosController@update'); //update
        Route::delete('/admin/bitacora_rendimiento_base_datos/{id}', 'Admin\BitacoraRendimientoBaseDatosController@destroy'); //delete


        //Mantenimiento de cambio BD
        Route::get('/admin/bitacora_cambio_base_datos', 'Admin\BitacoraCambioBaseDatosController@index'); // listado
        Route::get('/admin/bitacora_cambio_base_datos/create', 'Admin\BitacoraCambioBaseDatosController@create'); // form create
        Route::post('/admin/bitacora_cambio_base_datos', 'Admin\BitacoraCambioBaseDatosController@store'); // registrar
        Route::get('/admin/bitacora_cambio_base_datos/{id}/edit', 'Admin\BitacoraCambioBaseDatosController@edit'); // form edit
        Route::post('/admin/bitacora_cambio_base_datos/{id}/edit', 'Admin\BitacoraCambioBaseDatosController@update'); //update
        Route::delete('/admin/bitacora_cambio_base_datos/{id}', 'Admin\BitacoraCambioBaseDatosController@destroy'); //delete
        

        //Mantenimiento de cambio BD
        Route::get('/admin/creacion_objetos_base_datos', 'Admin\CreacionObjetoBaseDatosController@index'); // listado
        Route::get('/admin/creacion_objetos_base_datos/create', 'Admin\CreacionObjetoBaseDatosController@create'); // form create
        Route::post('/admin/creacion_objetos_base_datos', 'Admin\CreacionObjetoBaseDatosController@store'); // registrar
        Route::get('/admin/creacion_objetos_base_datos/{id}/edit', 'Admin\CreacionObjetoBaseDatosController@edit'); // form edit
        Route::post('/admin/creacion_objetos_base_datos/{id}/edit', 'Admin\CreacionObjetoBaseDatosController@update'); //update
        Route::delete('/admin/creacion_objetos_base_datos/{id}', 'Admin\CreacionObjetoBaseDatosController@destroy'); //delete


        
        //Mantenimiento de cambio BD
        Route::get('/admin/certificacion_objetos_sistema', 'Admin\CertificacionObjetoSistemaController@index'); // listado
        Route::get('/admin/certificacion_objetos_sistema/create', 'Admin\CertificacionObjetoSistemaController@create'); // form create
        Route::post('/admin/certificacion_objetos_sistema', 'Admin\CertificacionObjetoSistemaController@store'); // registrar
        Route::get('/admin/certificacion_objetos_sistema/{id}/edit', 'Admin\CertificacionObjetoSistemaController@edit'); // form edit
        Route::post('/admin/certificacion_objetos_sistema/{id}/edit', 'Admin\CertificacionObjetoSistemaController@update'); //update
        Route::delete('/admin/certificacion_objetos_sistema/{id}', 'Admin\CertificacionObjetoSistemaController@destroy'); //delete



        
    });



    Route::group(['middleware' => ['Coordinador']], function (){
        Route::get('/home', 'HomeController@index')->name('home');

        //ver comentarios
        Route::get('/admin/comentarios/show/{id}', 'Admin\ComentarioController@show'); // listado    
        
            
        //Mantenimiento de Estados
        Route::get('/admin/estados', 'Admin\EstadoController@index'); // listado
        Route::get('/admin/estados/create', 'Admin\EstadoController@create'); // form create
        Route::post('/admin/estados', 'Admin\EstadoController@store'); // registrar
        Route::get('/admin/estados/{id}/edit', 'Admin\EstadoController@edit'); // form edit
        Route::post('/admin/estados/{id}/edit', 'Admin\EstadoController@update'); //update
        Route::delete('/admin/estados/{id}', 'Admin\EstadoController@destroy'); //delete

        //Mantenimiento de Proyectos
        Route::get('/admin/proyectos', 'Admin\ProyectoController@index'); // listado
        Route::get('/admin/proyectos/create', 'Admin\ProyectoController@create'); // form create
        Route::post('/admin/proyectos', 'Admin\ProyectoController@store'); // registrar
        Route::get('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@edit'); // form edit
        Route::post('/admin/proyectos/{id}/edit', 'Admin\ProyectoController@update'); //update
        Route::delete('/admin/proyectos/{id}', 'Admin\ProyectoController@destroy'); //delete
        Route::get('/admin/proyectos/show/{id}', 'Admin\ProyectoController@show'); // listado

        //Mantenimiento de Actividades
        Route::get('/admin/actividades', 'Admin\ActividadController@index'); // listado
        Route::get('/admin/actividades/create', 'Admin\ActividadController@create'); // form create
        Route::post('/admin/actividades', 'Admin\ActividadController@store'); // registrar
        Route::get('/admin/actividades/{id}/edit', 'Admin\ActividadController@edit'); // form edit
        Route::post('/admin/actividades/{id}/edit', 'Admin\ActividadController@update'); //update
        Route::delete('/admin/actividades/{id}', 'Admin\ActividadController@destroy'); //delete

        //Mantenimiento de Categorias
        Route::get('/admin/categorias', 'Admin\CategoriaController@index'); // listado
        Route::get('/admin/categorias/create', 'Admin\CategoriaController@create'); // form create
        Route::post('/admin/categorias', 'Admin\CategoriaController@store'); // registrar
        Route::get('/admin/categorias/{id}/edit', 'Admin\CategoriaController@edit'); // form edit
        Route::post('/admin/categorias/{id}/edit', 'Admin\CategoriaController@update'); //update
        Route::delete('/admin/categorias/{id}', 'Admin\CategoriaController@destroy'); //delete

        //Mantenimiento de Prioridades
        Route::get('/admin/prioridades', 'Admin\PrioridadController@index'); // listado
        Route::get('/admin/prioridades/create', 'Admin\PrioridadController@create'); // form create
        Route::post('/admin/prioridades', 'Admin\PrioridadController@store'); // registrar
        Route::get('/admin/prioridades/{id}/edit', 'Admin\PrioridadController@edit'); // form edit
        Route::post('/admin/prioridades/{id}/edit', 'Admin\PrioridadController@update'); //update
        Route::delete('/admin/prioridades/{id}', 'Admin\PrioridadController@destroy'); //delete


        //Mantenimiento de Movimiento Actividades
        // Route::get('/admin/movimiento_actividades/show/{id}', 'Admin\MovimientoActividadController@show'); // listado
        // Route::post('/admin/movimiento_actividades/', 'Admin\MovimientoActividadController@store'); // store

        Route::resource('/admin/movimiento_actividades', 'Admin\MovimientoActividadController');
    });
    
    

});








//Mantenimiento de Movimiento Actividades
// Route::get('/admin/movimiento_actividades', 'Admin\MovimientoActividadController@index'); // listado
// Route::get('/admin/movimiento_actividades/create', 'Admin\MovimientoActividadController@create'); // form create
// Route::post('/admin/movimiento_actividades', 'Admin\MovimientoActividadController@store'); // registrar
// Route::get('/admin/movimiento_actividades/{id}/edit', 'Admin\MovimientoActividadController@edit'); // form edit
// Route::post('/admin/movimiento_actividades/{id}/edit', 'Admin\MovimientoActividadController@update'); //update
// Route::get('/admin/actividades/{id}/edit', 'Admin\ActividadController@edit'); // form edit
// Route::post('/admin/actividades/{id}/edit', 'Admin\ActividadController@update'); //update
// Route::delete('/admin/actividades/{id}', 'Admin\ActividadController@destroy'); //delete

//Route::post('/admin/movimiento_actividades', 'MovimientoActividadController@store'); //add

// Route::get('/login', function () {
//     return view('auth/login');
// });
