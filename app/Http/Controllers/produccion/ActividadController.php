<?php

namespace App\Http\Controllers\produccion;

use App\Actividad;
use App\CategoriaTicket;
use App\Http\Controllers\Controller;
use App\MovimientoActividad;
use App\PrioridadTicket;
use App\Proyecto;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ActividadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('produccion.actividades.index');
    }


    public function actividades_tiempo(Request $request)
    {
        if ($request->get('fecha')) {
            $now = Carbon::parse($request->get('fecha'));
            $fecha = $request->get('fecha');
        } else {
            $now = Carbon::now();
            $fecha = $now->format('Y-m-d');
        }


        $actividades = MovimientoActividad::join('actividades', 'actividades.Id', '=', 'movimiento_actividades.actividad_id')
            ->whereBetween('movimiento_actividades.fecha', [$now->format('Y-m-d 00:00:00'), $now->format('Y-m-d 23:00:00')])
            ->where('movimiento_actividades.tiempo_minutos', '>', 0)
            ->where('actividades.users_id', '=', auth()->user()->id)
            ->get();

        return view('produccion.actividades.actividades_tiempo', ["actividades" => $actividades, 'fecha' => $fecha]);
    }
    public function create()
    {
        $proyectos = Proyecto::where('unidad_id', '=', auth()->user()->unidad_id)->whereIn('estado_id', [1, 2, 3,4, 6])->where('finalizado', '<>', 1)->orderBy('nombre')->get();
        $categorias = CategoriaTicket::where('categoria_tickets.unidad_id', '=', auth()->user()->unidad_id)->get();
        $prioridades = PrioridadTicket::get();
        return view('produccion.actividades.create',compact('proyectos','categorias','prioridades'));
    }

    public function store(Request $request)
    {
        $messages = [
            'numero_ticket.required' => 'ingresar el numero de ticket',
            'proyecto_id.required' => 'ingresar el proyecto',
            'descripcion.required' => 'ingresar la descripción',
            'ponderacion.required' => 'ingresar la ponderación',
            'fecha_inicio.required' => 'ingresar la fecha de inicio',
            'fecha_fin.required' => 'ingresar la fecha final',
            'categoria_id.required' => 'ingresar la categoria',
            'forma.required' => 'ingresar la forma',
            'prioridad_id.required' => 'ingresar la prioridad',
        ];



        $request->validate([

            'numero_ticket' => 'required',
            'proyecto_id' => 'required',
            'descripcion' => 'required',
            'ponderacion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'categoria_id' => 'required',
            'forma' => 'required',
            'prioridad_id' => 'required',

        ], $messages);


        $time = Carbon::now('America/El_Salvador');

        $actividad = new Actividad();
        $actividad->proyecto_id = $request->proyecto_id;
        $actividad->numero_ticket = $request->numero_ticket;
        $actividad->ponderacion = $request->ponderacion;
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->categoria_id = $request->categoria_id;
        $actividad->estado_id = 1;
        $actividad->prioridad_id = $request->prioridad_id;
        $actividad->fecha_fin = $request->fecha_fin;
        $actividad->unidad_id = auth()->user()->unidad_id;
        $actividad->forma = $request->forma;
        $actividad->porcentaje = 0;
        $actividad->users_id = auth()->user()->id;
        $actividad->fecha_asignacion = $time->toDateTimeString();
        $actividad->save();

        $movimientoActividad = new MovimientoActividad();
        $time = Carbon::now('America/El_Salvador');
        $movimientoActividad->fecha =  $time->toDateTimeString();
        $movimientoActividad->porcentaje = '0';
        $movimientoActividad->porcentaje_acum = '0';
        $movimientoActividad->actividad_id = $actividad->id;
        $movimientoActividad->estado_id = 3;
        $movimientoActividad->detalle = '';
        $movimientoActividad->tiempo = '0';

        $movimientoActividad->save();

        alert()->success('El registro ha sido agregado correctamente');
        return redirect('/actividades');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('produccion.actividades.actual');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
