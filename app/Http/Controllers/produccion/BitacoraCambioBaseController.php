<?php

namespace App\Http\Controllers\produccion;

use App\BitacoraCambioBaseDatos;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BitacoraCambioBaseController extends Controller
{

    public function index()
    {
        $bitacora = BitacoraCambioBaseDatos::get();

        return view('produccion.bitacora_cambio_base.index', compact('bitacora'));
    }


    public function create()
    {
        return view('produccion.bitacora_cambio_base.create');
    }


    public function store(Request $request)
    {
        $max = BitacoraCambioBaseDatos::select(DB::raw('MAX(CAST(num_excell AS SIGNED)) AS max'))->first();
        $fechaActual = Carbon::now();
        $bitacora = new BitacoraCambioBaseDatos();
        $bitacora->num_excell =  $max->max +1;
        $bitacora->esquema =  $request->esquema;
        $bitacora->objeto_creado_cambiado =  $request->objeto_creado_cambiado;
        $bitacora->objeto_referencia =  $request->objeto_referencia;
        $bitacora->uso_negocio =  $request->uso_negocio;
        $bitacora->accion =  $request->accion;
        $bitacora->fecha_implementacion =  $request->fecha_implementacion;
        $bitacora->origen_cambio =  $request->origen_cambio;
        $bitacora->observacion =  $request->observacion;
        $bitacora->fecha_ymd =  $fechaActual->toDateTimeString();
        $bitacora->save();

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bitacora = BitacoraCambioBaseDatos::findOrFail($id);
        return view('produccion.bitacora_cambio_base.edit', compact('bitacora'));
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
        $bitacora = BitacoraCambioBaseDatos::findOrFail($id);
       // $bitacora->num_excell =  $request->num_excell;
        $bitacora->esquema =  $request->esquema;
        $bitacora->objeto_creado_cambiado =  $request->objeto_creado_cambiado;
        $bitacora->objeto_referencia =  $request->objeto_referencia;
        $bitacora->uso_negocio =  $request->uso_negocio;
        $bitacora->accion =  $request->accion;
        $bitacora->fecha_implementacion =  $request->fecha_implementacion;
        $bitacora->origen_cambio =  $request->origen_cambio;
        $bitacora->observacion =  $request->observacion;
        $bitacora->save();

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
        $bitacora = BitacoraCambioBaseDatos::findOrFail($id);
        $bitacora->delete();

        alert()->success('El registro ha sido eliminado correctamente');
        return back();
    }
}
