<?php

namespace App\Http\Controllers\produccion;

use App\BitacoraRendimientoBaseDatos;
use App\catalogo\EstadoRendimientoBd;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BitacoraRendimientoBaseController extends Controller
{

    public function index()
    {
        $bitacora = BitacoraRendimientoBaseDatos::get();
        $estados=EstadoRendimientoBd::get();
        return view('produccion.bitacora_rendimiento_base.index', compact('bitacora','estados'));
    }


    public function create()
    {
        $estados=EstadoRendimientoBd::get();
        return view('produccion.bitacora_rendimiento_base.create',compact('estados'));
    }


    public function store(Request $request)
    {
        $max = BitacoraRendimientoBaseDatos::select(DB::raw('MAX(CAST(id_excell AS SIGNED)) AS max'))->first();
        $fechaActual = Carbon::now();
        $bitacora = new BitacoraRendimientoBaseDatos();
        $bitacora->id_excell =  $max->max +1;
        $bitacora->fecha = date('d/m/Y', strtotime($request->fecha_ymd)) ;
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
        $bitacora->fecha_ymd =  $request->fecha_ymd ;//date('d/m/Y', strtotime($request->fecha)) ;// $fechaActual->toDateTimeString();
        $bitacora->created_at= $fechaActual->toDateTimeString();
        $bitacora->updated_at= $fechaActual->toDateTimeString();
        $bitacora->estado_rendimiento_id= $request->estado_id;
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
        $estados= EstadoRendimientoBd::get();

        return view('produccion.bitacora_rendimiento_base.edit', compact('bitacora','estados'));
    }

    public function update(Request $request, $id)
    {
        $bitacora = BitacoraRendimientoBaseDatos::findOrFail($id);
        $bitacora->fecha = date('d/m/Y', strtotime($request->fecha_ymd)) ;
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
        $bitacora->fecha_ymd =   $request->fecha_ymd;//->toDateTimeString()
        $bitacora->estado_rendimiento_id= $request->estado_id;
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
