<?php

namespace App\Http\Controllers\produccion;


use App\Http\Controllers\Controller;
use App\MovimientoActividad;
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produccion.actividades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
