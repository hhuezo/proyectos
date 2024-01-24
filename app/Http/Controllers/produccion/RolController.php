<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\Rol;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{

    public function __construct()
    {
          $this->middleware('auth');
    }

public function index()
{
    $roles = Rol::get();
    return view('produccion.rol.index', compact('roles'));

}

public function create()
{

    $roles = Rol::get();
    return view('produccion.rol.create', compact('roles'));

}



public function show($id)
{
    //
}

public function edit($id)
{


    $rol = Rol::findOrFail($id);
     $permissions = Permission::get();

    //$permission_in_role = $role->role_has_permissions;


    return view('produccion.rol.edit', compact('rol','permissions'));




}

public function link_permission(Request $request)
{

    $role = Role::findOrFail($request->role_id);
    $permission = Permission::findOrFail($request->permission_id);
    $role->givePermissionTo($permission->name);
    alert()->success('El registro ha sido eliminado correctamente');
    return back();
}

public function unlink_permission(Request $request)
{


    $role = Role::findOrFail($request->role_id);
    $permission = Permission::findOrFail($request->permission_id);
    $role->revokePermissionTo($permission->name);
    alert()->error('El registro ha sido eliminado correctamente');
    return back();
}


public function store(Request $request)
{
    $messages = [
        'name.required' => 'ingresar nombre',


    ];


    $request->validate([
        'name' => 'required',

    ], $messages);



    $time = Carbon::now('America/El_Salvador');
    $rol = new Rol();
    $rol->name = $request->name;
    $rol->guard_name ='web';
    $rol->created_at= $time->toDateTimeString();
    $rol->updated_at= $time->toDateTimeString();
    $rol->save();
    alert()->success('se han sido Agregado correctamente');
    return back();
}


public function update(Request $request, $id)
{
    $messages = [
        'name.required' => 'ingresar nombre',


    ];


    $request->validate([
        'name' => 'required',

    ], $messages);

    $time = Carbon::now('America/El_Salvador');
    $rol = Rol::findorFail($id);
    $rol->name = $request->name;
  //  $rol->guard_name ='web';
   // $rol->created_at= $time->toDateTimeString();
    $rol->updated_at= $time->toDateTimeString();
    $rol->update();
    alert()->success('se ha sido Actualizado correctamente');
    return back();
}

public function destroy($id)
{
    //
}
}
