<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\MovimientoActividad;
use Illuminate\Http\Request;

class ActividadFinalizadaController extends Controller
{

    public function __construct()
    {
          $this->middleware('auth');
    }
    public function index()
    {
        return view('produccion.actividades_finalizada.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $movimientos = MovimientoActividad::join('actividades', 'movimiento_actividades.actividad_id', '=', 'actividades.id')
            ->join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
            ->join('users', 'actividades.users_id', '=', 'users.id')
            ->join('estados', 'movimiento_actividades.estado_id', '=', 'estados.id')
            ->join('categoria_tickets', 'actividades.categoria_id', '=', 'categoria_tickets.id')
            ->join('prioridad_tickets', 'actividades.prioridad_id', '=', 'prioridad_tickets.id')
            ->select(
                'actividades.id',
                'actividades.numero_ticket',
                'proyectos.nombre as proyecto',
                'actividades.descripcion as actividad',
                'categoria_tickets.nombre as categoria',
                'prioridad_tickets.nombre as prioridad',
                'actividades.fecha_inicio',
                'actividades.fecha_fin',
                'movimiento_actividades.porcentaje',
                'users.user_name',
                'estados.nombre as estado',
                'estados.color',
                'movimiento_actividades.porcentaje_acum',
                'movimiento_actividades.fecha'
            )
            ->where('actividades.id', '=', $id)
            ->orderBy('movimiento_actividades.id')->get();
        return view('produccion.actividades_finalizada.show', compact('movimientos'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
