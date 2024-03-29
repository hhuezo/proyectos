<?php

namespace App\Http\Controllers\infraestructura;

use App\Http\Controllers\Controller;
use App\infraestructura\CriteriosCarateristica;
use App\infraestructura\Cumplimientos;
use App\infraestructura\CumplimientosCaracteristicas;
use App\infraestructura\EvaluacionDetalle;
use App\infraestructura\EvaluacionProveedor;
use App\infraestructura\EvaluacionPuntaje;
use App\infraestructura\Proveedores;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EvalProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedores::where('activo', '=', 'A')->get();
        // $proveedores = Proveedores::get();
        $evaluacion = EvaluacionProveedor::get();
        $PeriodosEvaluacion = DB::table('evaluacion_proveedores')
            ->select('periodo_evaluacion')
            ->groupBy('periodo_evaluacion')
            ->orderBy('periodo_evaluacion')
            ->get();

        $cantidadProveedores = DB::table('proveedores')->count();
        $evaluacionesPorPeriodo = DB::table('evaluacion_proveedores as a')
            ->join('proveedores as b', 'a.proveedor_id', '=', 'b.id')
            ->select('a.periodo_evaluacion', DB::raw('COUNT(a.proveedor_id) as evaluaciones'))
            ->groupBy('a.periodo_evaluacion')
            ->get();



        return view('infraestructura.evaluaciones.index', compact('evaluacionesPorPeriodo', 'cantidadProveedores', 'PeriodosEvaluacion', 'evaluacion', 'proveedores'));
        //return view('infraestructura.evaluaciones.show');
    }


    public function create()
    {
        $criterioscaracteristicas = CriteriosCarateristica::get();

        $proveedores = Proveedores::get();
        $cumplimientos = Cumplimientos::get();


        return view('infraestructura.evaluaciones.create', compact('proveedores', 'cumplimientos', 'criterioscaracteristicas'));
    }

    public function store(Request $request)
    {

        $Evaluacion = new EvaluacionProveedor();
        $Evaluacion->proveedor_id = $request->proveedor_id;
        $Evaluacion->periodo_evaluacion = $request->periodo;
        $Evaluacion->nombre_elaborado = $request->nombre_elaborado;
        $Evaluacion->nombre_revisado =  $request->nombre_revisado;
        $Evaluacion->cargo_elaborado  =  $request->cargo_elaborado;
        $Evaluacion->cargo_revisado  =  $request->cargo_revisado;
        $Evaluacion->observaciones  =  $request->observaciones;
        $Evaluacion->notificado = 'S';
        //$Evaluacion->notificado =  $request->notificado;
        $Evaluacion->nombre_aprobado =  $request->nombre_aprobado;
        $Evaluacion->fecha_aprobado  =  $request->fecha_aprobado;
        $Evaluacion->fecha_revisado  =  $request->fecha_revisado;
        $Evaluacion->save();


        $cumplimientos = CumplimientosCaracteristicas::get();

        foreach ($cumplimientos as $cumplimiento) {
            $criterio = $cumplimiento->caracteristica->criterios->first();
            $Evaluacion_detalle = new EvaluacionDetalle();
            $Evaluacion_detalle->evaluacion_id = $Evaluacion->id;
            $Evaluacion_detalle->cumplimiento_car_id = $cumplimiento->id;
            $Evaluacion_detalle->criterio_caracteristica_id = $criterio->id;
            $Evaluacion_detalle->save();
        }
        return redirect('infraestructura/evaluaciones/' . $Evaluacion->id . '/edit');



        // dd("");
    }



    public function create_eval(Request $request)
    {

        $Evaluacion = new EvaluacionProveedor();
        $Evaluacion->proveedor_id = $request->id;
        $Evaluacion->periodo_evaluacion = $request->periodo_evaluacion;
        $Evaluacion->nombre_elaborado = $request->nombre_elaborado;
        $Evaluacion->nombre_revisado =  $request->nombre_revisado;
        $Evaluacion->nombre_aprobado =  $request->nombre_aprobado;
        $Evaluacion->cargo_elaborado  =  $request->cargo_elaborado;
        $Evaluacion->cargo_aprobado  =  $request->cargo_aprobado;
        $Evaluacion->cargo_revisado  =  $request->cargo_revisado;
        $Evaluacion->observaciones  =  $request->observaciones;
        $Evaluacion->fecha_aprobado  =  $request->fecha_aprobado;
        $Evaluacion->fecha_revisado  =  $request->fecha_revisado;
        $Evaluacion->notificado = 'S';
        $Evaluacion->save();
    }

    public function show($id)
    {
        $evaluacion = EvaluacionProveedor::findOrfail($id);
        $rango_evaluacion = EvaluacionPuntaje::get();
        $resultado = DB::table('evaluacion_proveedores as a')
            ->join('evaluacion_detalle as ed', 'a.id', '=', 'ed.evaluacion_id')
            ->join('cumplimientos_x_caracteristicas as cc', 'ed.cumplimiento_car_id', '=', 'cc.id')
            ->join('criterios_x_carateristica as crca', 'ed.criterio_caracteristica_id', '=', 'crca.id')
            ->join('cumplimientos as c', 'cc.cumplimiento_id', '=', 'c.id')
            ->join('caracteristicas as ca', 'cc.caracteristica_id', '=', 'ca.id')
            ->select('a.id', 'c.nombre as cumplimiento', 'ca.nombre as caracteristica', 'cc.ponderacion', 'crca.nombre as criterio', 'crca.calificacion')
            ->where('a.id', '=', $id)
            ->get();
        //dd($result);

        $data_calificacion = DB::table(DB::raw("(SELECT c.nombre as cumplimiento, ca.nombre as caracteristica, cc.ponderacion, crca.nombre as criterio, crca.calificacion,
    (CASE
        WHEN crca.calificacion > 0 THEN cc.ponderacion
        ELSE 0
    END * crca.calificacion) / 100 as puntaje
    FROM cumplimientos_x_caracteristicas cc
    JOIN cumplimientos c ON cc.cumplimiento_id = c.id
    JOIN caracteristicas ca ON cc.caracteristica_id = ca.id
    JOIN criterios_x_carateristica crca ON ca.id = crca.caracteristica_id
    JOIN evaluacion_detalle ed ON ed.cumplimiento_car_id = cc.id
        AND ed.criterio_caracteristica_id = crca.id
    WHERE ed.evaluacion_id = $id) AS a"))
            ->selectRaw('ROUND(SUM(a.puntaje) / (1 - (SUM(CASE WHEN a.calificacion = 0 THEN a.ponderacion * 0.1 ELSE 0 END) * 0.1)), 2) as calificacion')
            ->first();



        $califica_obtenida = EvaluacionPuntaje::select('id', 'categoria', 'aceptado')
            ->where('limite_inferior', '<=', $data_calificacion->calificacion)
            ->where('limite_superior', '>=', $data_calificacion->calificacion)
            ->first();


        $evaluacion = EvaluacionProveedor::findOrfail($id);

        $evaluacion->puntos = $data_calificacion->calificacion;
        $evaluacion->resultado_id = $califica_obtenida->id;



        $pdf = PDF::loadView('infraestructura.evaluaciones.show', compact('resultado', 'evaluacion', 'data_calificacion', 'califica_obtenida', 'rango_evaluacion'));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('test_pdf.pdf');

        // return view('infraestructura.evaluaciones.show', compact('resultado', 'evaluacion', 'data_calificacion', 'califica_obtenida', 'rango_evaluacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluacion = EvaluacionProveedor::Findorfail($id);
        $proveedores = Proveedores::get();
        $cumplimientos = Cumplimientos::get();
        $cumplimientocaracteristica = CumplimientosCaracteristicas::get();

        return view('infraestructura.evaluaciones.edit', compact('evaluacion', 'proveedores', 'cumplimientos', 'cumplimientocaracteristica'));
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
        $EvaluacionDetalle = EvaluacionDetalle::Findorfail($id);
        foreach ($EvaluacionDetalle as $evaldeta) {
            $EvaluacionDetal = new EvaluacionDetalle();
            $EvaluacionDetal->evaluacion_id = $evaldeta->evaluacion_id;
            $EvaluacionDetal->cumplimiento_car_id  = $evaldeta->cumplimiento_car_id;
            $EvaluacionDetal->criterio_caracteristica_id = $evaldeta->criterio_caracteristica_id;
            $EvaluacionDetal->ingreso = $evaldeta->ingreso;
            $EvaluacionDetal->save();
            alert()->success('El Proveedor ha sido Modificado correctamente');
            return back();
        }
    }

    public function  edit_evaluacion($id)
    {


        $evaluacion = EvaluacionProveedor::Findorfail($id);
        $proveedores = Proveedores::get();
        return view('infraestructura.evaluaciones.modificar_eval', compact('evaluacion', 'proveedores'));
    }
    public function modificar_evaluacion(Request $request, $id)
    {
        $evaluacion_proveedor = EvaluacionProveedor::Findorfail($id);
        $evaluacion_proveedor->nombre_elaborado = $request->nombre_elaborado;
        $evaluacion_proveedor->nombre_revisado =  $request->nombre_revisado;
        $evaluacion_proveedor->nombre_aprobado =  $request->nombre_aprobado;
        $evaluacion_proveedor->cargo_elaborado  =  $request->cargo_elaborado;
        $evaluacion_proveedor->cargo_aprobado  =  $request->cargo_aprobado;
        $evaluacion_proveedor->cargo_revisado  =  $request->cargo_revisado;
        $evaluacion_proveedor->observaciones  =  $request->observaciones;
        $evaluacion_proveedor->fecha_aprobado  =  $request->fecha_aprobado;
        $evaluacion_proveedor->fecha_revisado  =  $request->fecha_revisado;
        $evaluacion_proveedor->notificado =  $request->notificado;
        $evaluacion_proveedor->update();
        alert()->success('La Evaluacion del Proveedor ha sido Modificada correctamente');
        return back();
    }






    public function  guardar_mensaje($id)
    {


        $evaluacion = EvaluacionProveedor::findOrfail($id);
        $rango_evaluacion = EvaluacionPuntaje::get();
        $resultado = DB::table('evaluacion_proveedores as a')
            ->join('evaluacion_detalle as ed', 'a.id', '=', 'ed.evaluacion_id')
            ->join('cumplimientos_x_caracteristicas as cc', 'ed.cumplimiento_car_id', '=', 'cc.id')
            ->join('criterios_x_carateristica as crca', 'ed.criterio_caracteristica_id', '=', 'crca.id')
            ->join('cumplimientos as c', 'cc.cumplimiento_id', '=', 'c.id')
            ->join('caracteristicas as ca', 'cc.caracteristica_id', '=', 'ca.id')
            ->select('a.id', 'c.nombre as cumplimiento', 'ca.nombre as caracteristica', 'cc.ponderacion', 'crca.nombre as criterio', 'crca.calificacion')
            ->where('a.id', '=', $id)
            ->get();
      //  dd($resultado);

        $data_calificacion = DB::table(DB::raw("(SELECT c.nombre as cumplimiento, ca.nombre as caracteristica, cc.ponderacion, crca.nombre as criterio, crca.calificacion,
    (CASE
        WHEN crca.calificacion > 0 THEN cc.ponderacion
        ELSE 0
    END * crca.calificacion) / 100 as puntaje
    FROM cumplimientos_x_caracteristicas cc
    JOIN cumplimientos c ON cc.cumplimiento_id = c.id
    JOIN caracteristicas ca ON cc.caracteristica_id = ca.id
    JOIN criterios_x_carateristica crca ON ca.id = crca.caracteristica_id
    JOIN evaluacion_detalle ed ON ed.cumplimiento_car_id = cc.id
        AND ed.criterio_caracteristica_id = crca.id
    WHERE ed.evaluacion_id = $id) AS a"))
            ->selectRaw('ROUND(SUM(a.puntaje) / (1 - (SUM(CASE WHEN a.calificacion = 0 THEN a.ponderacion * 0.1 ELSE 0 END) * 0.1)), 2) as calificacion')
            ->first();

        $califica_obtenida = EvaluacionPuntaje::select('id', 'categoria', 'aceptado')
            ->where('limite_inferior', '<=', $data_calificacion->calificacion)
            ->where('limite_superior', '>=', $data_calificacion->calificacion)
            ->first();



        $evaluacion = EvaluacionProveedor::findOrfail($id);
        /* if ($califica_obtenida->aceptado == 'S') {
            $evaluacion->resultado_id = 1;
        }
        if ($califica_obtenida->aceptado == 'N') {
            $evaluacion->resultado_id = 0;
        }*/
        $evaluacion->puntos = $data_calificacion->calificacion;
        // $evaluacion->notificado= $califica_obtenida->id;
        $evaluacion->resultado_id = $califica_obtenida->id;

        $evaluacion->update();
        alert()->success('La Evaluacion ha sido registrada correctamente');
        return redirect('infraestructura/evaluaciones/');
    }


    public function  updateData($id, $criterio)
    {

        try {

            $EvaluacionDetalle = EvaluacionDetalle::Findorfail($id);
            $EvaluacionDetalle->criterio_caracteristica_id = $criterio;
            $EvaluacionDetalle->update();

            $result = [$id, $criterio];
            return $result;

            // return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
