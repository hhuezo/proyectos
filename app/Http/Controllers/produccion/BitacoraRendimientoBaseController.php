<?php

namespace App\Http\Controllers\produccion;

use App\BitacoraRendimientoBaseDatos;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BitacoraRendimientoBaseController extends Controller
{

    public function index()
    {
        $bitacora = BitacoraRendimientoBaseDatos::get();
        return view('produccion.bitacora_rendimiento_base.index', compact('bitacora'));
    }


    public function create()
    {
        return view('produccion.bitacora_rendimiento_base.create');
    }


    public function store(Request $request)
    {
        $max = BitacoraRendimientoBaseDatos::select(DB::raw('MAX(CAST(id_excell AS SIGNED)) AS max'))->first();
        $fechaActual = Carbon::now();
        $bitacora = new BitacoraRendimientoBaseDatos();
        $bitacora->id_excell =  $max->max +1;
        $bitacora->fecha =  $request->fecha;
        $bitacora->hora =  $request->hora;
        $bitacora->tiempo =  $request->tiempo;
        $bitacora->tipo_reporte =  $request->tipo_reporte;
        $bitacora->unidad =  $request->unidad;
        $bitacora->programa =  $request->programa;
        $bitacora->referencia =  $request->referencia;
        $bitacora->evento =  $request->evento;
        $bitacora->accion_ejecutada =  $request->accion_ejecutada;
        $bitacora->diagnostico =  $request->diagnostico;
        $bitacora->responsable =  $request->responsable;
        $bitacora->fecha_ymd =  $fechaActual->toDateTimeString();
        $bitacora->save();

        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $bitacora = BitacoraRendimientoBaseDatos::findOrFail($id);
        return view('produccion.bitacora_rendimiento_base.edit', compact('bitacora'));
    }

    public function update(Request $request, $id)
    {
        $bitacora = BitacoraRendimientoBaseDatos::findOrFail($id);
        $bitacora->fecha =  $request->fecha;
        $bitacora->hora =  $request->hora;
        $bitacora->tiempo =  $request->tiempo;
        $bitacora->tipo_reporte =  $request->tipo_reporte;
        $bitacora->unidad =  $request->unidad;
        $bitacora->programa =  $request->programa;
        $bitacora->referencia =  $request->referencia;
        $bitacora->evento =  $request->evento;
        $bitacora->accion_ejecutada =  $request->accion_ejecutada;
        $bitacora->diagnostico =  $request->diagnostico;
        $bitacora->responsable =  $request->responsable;
        $bitacora->save();

        alert()->success('El registro ha sido modificado correctamente');
        return back();
    }


    public function destroy($id)
    {
        $bitacora = BitacoraRendimientoBaseDatos::findOrFail($id);
        $bitacora->delete();

        alert()->success('El registro ha sido eliminado correctamente');
        return back();
    }
}
