<?php

namespace App\Http\Controllers\infraestructura;

use App\Http\Controllers\Controller;
use App\infraestructura\Proveedores;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedores::where('activo' ,'=', 'A')->get();
        return view('infraestructura.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infraestructura.proveedores.create');
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
            'nombre.required' => 'ingresar nombre del Proveedor',
            'telefono.required' => 'ingresar numero de  de Telefono',
            'correo.required' => 'ingresar el Correo',
            'direccion.required' => 'ingresar Direccion',
            'producto.required' => 'ingresar nombre del producto',
        ];



        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'producto' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');
        $proveedores = new proveedores();
        $proveedores->nombre = $request->get('nombre');
        $proveedores->telefono = $request->get('telefono');
        $proveedores->correo = $request->get('correo');
        $proveedores->direccion = $request->get('direccion');
        $proveedores->producto = $request->get('producto');
        $proveedores->activo = 'A';
        $proveedores->fecha_ingreso = $time->toDateTimeString();
        $proveedores->fecha_desarrollo = $time->toDateTimeString();
        $proveedores->usuario_ingreso = auth()->user()->id;
        $proveedores->usuario_modifica = auth()->user()->id;
        $proveedores->save();
        alert()->success('El Proveedor ha sido agregado correctamente');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $proveedores = Proveedores::findOrFail($id);

        return view('infraestructura.proveedores.edit', compact('proveedores'));
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
            'nombre.required' => 'ingresar nombre del Proveedor',
            'telefono.required' => 'ingresar numero de  de Telefono',
            'correo.required' => 'ingresar el Correo',
            'direccion.required' => 'ingresar Direccion',
            'producto.required' => 'ingresar nombre del producto',



        ];



        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'producto' => 'required',
        ], $messages);



        $proveedores =  Proveedores::findOrFail($id);
        $proveedores->nombre = $request->get('nombre');
        $proveedores->telefono = $request->get('telefono');
        $proveedores->correo = $request->get('correo');
        $proveedores->direccion = $request->get('direccion');
        $proveedores->producto = $request->get('producto');
        $proveedores->activo = 'A';
        $proveedores->usuario_modifica = auth()->user()->id;
        $proveedores->update();
        alert()->success('El Proveedor ha sido Modificado correctamente');
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
        $proveedores = Proveedores::findOrFail($id);
        $proveedores->activo = 'I';
        $proveedores->update();
        alert()->error('El Proveedor ha sido desactivado correctamente');
        return back();
    }
}
