<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\Permission;
use Spatie\Permission\Models\Permission as ModelPermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $permissions=Permission::get();
      return view('produccion.permisos.index', compact('permissions'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::get();
        return view('produccion.permisos.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'ingresar nombre',


        ];


        $request->validate([
            'name' => 'required',

        ], $messages);



        $permission = ModelPermission::create(['name' => $request->get('name')]);
        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function update_permission(Request $request)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions= Permission::findOrFail($id);
        return view('produccion.permisos.edit', compact('permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'name.required' => 'ingresar nombre',


        ];


        $request->validate([
            'name' => 'required',

        ], $messages);


        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();
        alert()->success('El registro ha sido modificado correctamente');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $permission = Permission::findOrFail($id);
            $permission->delete();
            alert()->error('El registro ha sido eliminado correctamente');
            return back();


    }
}
