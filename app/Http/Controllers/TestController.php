<?php

namespace App\Http\Controllers;

use App\MovimientoActividad;
use App\User;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    //
    public function index()
    {
        $users = User::where('unidad_id', '=', 1)->orderBy('user_name')->get();

        return view('prueba', compact('users'));


        // $users = User::get();
        // foreach($users as $user)
        // {
        //     $role = Rol::findOrFail($user->rol_id);
        //     $user->assignRole($role->name);
        // }

       // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
       /* DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();*/

        //menus
       /* Permission::create( ['name' => 'read menu inicio'] );
        Permission::create( ['name' => 'read menu unidades'] );
        Permission::create( ['name' => 'read  menu seguridad'] );
        Permission::create( ['name' => 'read  menu catalogos'] );
        Permission::create( ['name' => 'read  menu proyectos'] );
        Permission::create( ['name' => 'read  menu actividades'] );
        Permission::create( ['name' => 'read  menu actividades finalizadas'] );
        Permission::create( ['name' => 'read  menu actividades proceso'] );
        Permission::create( ['name' => 'read  menu facturar'] );
        Permission::create( ['name' => 'read  menu coordinador'] );
        Permission::create( ['name' => 'read  menu iso'] );
        Permission::create( ['name' => 'read  calendarizacion mantenimientos'] );
        Permission::create( ['name' => 'read  inventario despliegues'] );
        Permission::create( ['name' => 'read  indicadores'] );



        Permission::create( ['name' => 'read dashboard analista'] );
        Permission::create( ['name' => 'read actividades analista'] );
        Permission::create( ['name' => 'read actividades finalizadas analista'] );
        Permission::create( ['name' => 'read iso 2022'] );


        Permission::create( ['name' => 'read dashboard avance proyectos'] );
        Permission::create( ['name' => 'read dashboard actividades analista'] );
        Permission::create( ['name' => 'read dashboard rendimiento base datos'] );
        Permission::create( ['name' => 'read dashboard tiempo invertido'] );
        Permission::create( ['name' => 'read dashboard general desarollo'] );


        //analista
        $role = Role::findOrFail(2);
        $role->givePermissionTo( 'read dashboard analista', 'read actividades analista', 'read actividades finalizadas analista', 'read iso 2022',
        'read  menu actividades','read menu inicio');

        //Arquitecto Soluciones
        $role = Role::findOrFail(5);
        $role->givePermissionTo( 'read dashboard analista', 'read actividades analista', 'read actividades finalizadas analista', 'read iso 2022',
        'read  menu actividades','read menu inicio');

        //usuario
         $role = Role::findOrFail(3);
         $role->givePermissionTo('read  menu actividades','read menu inicio');

         //coordinador
        $role = Role::findOrFail(4);
        $role->givePermissionTo( 'read dashboard analista', 'read actividades analista', 'read actividades finalizadas analista', 'read iso 2022',
        'read  menu actividades','read menu inicio');


        $role = Role::findOrFail(1);
        $role->givePermissionTo( Permission::all() );


        $role = Role::create( ['name' => 'administrador unidad'] );
        $role->givePermissionTo( 'read dashboard analista', 'read  menu actividades','read menu inicio','read  menu actividades finalizadas',
        'read  menu coordinador');

        $role = Role::findOrFail(6);
        $role->givePermissionTo( 'read dashboard analista',
        'read actividades analista',
        'read actividades finalizadas analista',
        'read iso 2022',
        'read dashboard avance proyectos',
        'read dashboard actividades analista',
        'read dashboard rendimiento base datos',
        'read dashboard tiempo invertido',
        'read dashboard general desarollo','read menu inicio','read menu unidades');*/

    }


    public function resultado($usuario, $fecha)
    {
        $movimientos = MovimientoActividad::join('actividades', 'actividades.id', '=', 'movimiento_actividades.actividad_id')
            ->select(
                'movimiento_actividades.id',
                'movimiento_actividades.fecha',
                'actividades.descripcion',
                'movimiento_actividades.actividad_id',
                'movimiento_actividades.detalle',
                'movimiento_actividades.tiempo_minutos'
            )
            ->where('actividades.users_id', '=', $usuario)
            ->whereBetween('movimiento_actividades.fecha', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
        //return $movimientos;

        return view('prueba_resultado', compact('movimientos'));
    }

    public function update(Request $request)
    {
        $movimiento = MovimientoActividad::findOrFail($request->id);
        $movimiento->fecha = $request->fecha . ' ' . $request->hora;
        $movimiento->created_at = $request->fecha . ' ' . $request->hora;
        $movimiento->updated_at = $request->fecha . ' ' . $request->hora;
        $movimiento->detalle = $request->detalle;
        $movimiento->tiempo_minutos = $request->tiempo_minutos;
        $movimiento->update();

        return back();
    }
}
