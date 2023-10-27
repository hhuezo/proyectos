<?php

namespace App\Http\Controllers;

use App\MovimientoActividad;
use App\User;
use Illuminate\Http\Request;


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
        $movimiento->detalle = $request->detalle;
        $movimiento->tiempo_minutos = $request->tiempo_minutos;
        $movimiento->update();

        return back();
    }
}
