<?php

namespace App\Http\Controllers\catalogo;

use App\Http\Controllers\Controller;
use App\InventarioDespliegues;
use Illuminate\Http\Request;

class InventarioDespliegueController extends Controller
{

    public function __construct()
    {
          $this->middleware('auth');
    }

    public function index()
    {
        $inventario_despliegue = InventarioDespliegues::get();
        return view('catalogo.inventario_despliegues.index', compact('inventario_despliegue'));
    }

    public function create()
    {

        $inventario_despliegue = InventarioDespliegues::get();
        return view('catalogo.inventario_despliegues.create', compact('inventario_despliegue'));
    }

    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'ingresar nombre',
            'ip.required' => 'ingresar ip',
            'tipo_de_servidor.required' => 'ingresar tipo de servidor',
            'version_servidor.required' => 'version de servidor',
        ];



        $request->validate([
            'nombre' => 'required',
            'ip' => 'required',
            'tipo_de_servidor' => 'required',
            'version_servidor' => 'required',

        ], $messages);



        $inventario_despliegue = new InventarioDespliegues();
        $inventario_despliegue->ip = $request->ip;
        $inventario_despliegue->nombre = $request->nombre;
        $inventario_despliegue->conocido_por = $request->conocido_por;
        $inventario_despliegue->tipo_de_servidor = $request->tipo_de_servidor;
        $inventario_despliegue->version_servidor = $request->version_servidor;
        $inventario_despliegue->ambiente = $request->ambiente;
        $inventario_despliegue->war_instalado = $request->war_instalado;
        $inventario_despliegue->proyecto = $request->proyecto;
        $inventario_despliegue->puerto = $request->puerto;
        $inventario_despliegue->virtualizacion = $request->virtualizacion;
        $inventario_despliegue->endpoint = $request->endpoint;
        $inventario_despliegue->nombre_log = $request->nombre_log;
        $inventario_despliegue->save();
        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $inventario_despliegue = InventarioDespliegues::findOrFail($id);
        // dd($tipo_servidores);
        return view('catalogo.inventario_despliegues.edit', compact('inventario_despliegue'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'ingresar nombre',
            'ip.required' => 'ingresar ip',
            'tipo_de_servidor.required' => 'ingresar tipo de servidor',
            'version_servidor.required' => 'version de servidor',
        ];



        $request->validate([
            'nombre' => 'required',
            'ip' => 'required',
            'tipo_de_servidor' => 'required',
            'version_servidor' => 'required',
        ], $messages);


        $inventario_despliegue = InventarioDespliegues::findOrFail($id);
        $inventario_despliegue->ip = $request->ip;
        $inventario_despliegue->nombre = $request->nombre;
        $inventario_despliegue->conocido_por = $request->conocido_por;
        $inventario_despliegue->tipo_de_servidor = $request->tipo_de_servidor;
        $inventario_despliegue->version_servidor = $request->version_servidor;
        $inventario_despliegue->ambiente = $request->ambiente;
        $inventario_despliegue->war_instalado = $request->war_instalado;
        $inventario_despliegue->proyecto = $request->proyecto;
        $inventario_despliegue->puerto = $request->puerto;
        $inventario_despliegue->virtualizacion = $request->virtualizacion;
        $inventario_despliegue->endpoint = $request->endpoint;
        $inventario_despliegue->nombre_log = $request->nombre_log;
        $inventario_despliegue->update();
        alert()->success('El registro ha sido actualizado correctamente');
        return back();
    }


    public function destroy($id)
    {
        $inventario_despliegue = InventarioDespliegues::findOrFail($id);
        $inventario_despliegue->delete();
        alert()->error('El registro ha sido eliminado correctamente');
        return back();
    }
}
