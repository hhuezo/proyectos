<?php

namespace App\Http\Controllers\produccion;

use App\Actividad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacturarController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');
    }

    public function index()
    {
        $meses = array('','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
       'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return view('produccion.facturar.index',compact('meses'));
    }

    public function get_time($minutos)
    {
        $horas = 0;
        $min = 0;
        if($minutos >= 60)
        {
            $horas =  intval($minutos/60);
            $min = $minutos - ($horas * 60);
        }
        else{
            $min = $minutos;
        }

        return $horas.':'. $min;
    }




    public function facturar($mes,$anio)
    {
        if($anio%4==0)
        {
            $dias_mes = [0,31,29,31,30,31,30,31,31,30,31,30,31];
        }
        else{
            $dias_mes = [0,31,28,31,30,31,30,31,31,30,31,30,31];
        }

        $numero_dias = $dias_mes[$mes];

        $mes_date = $mes;
        if($mes<10)
        {
            $mes_date = '0'.$mes;
        }

        $fecha_inicio = '01/'.$mes_date.'/'.$anio;
        $fecha_final = $numero_dias.'/'.$mes_date.'/'.$anio;


        $actividades = Actividad::join('movimiento_actividades','movimiento_actividades.actividad_id','=','actividades.id')
        ->join('users','actividades.users_id','=','users.id')
        ->select('actividades.id',\DB::raw('DATE_FORMAT(movimiento_actividades.fecha, "%d/%m/%Y") as fecha'),
        'actividades.numero_ticket','actividades.descripcion',
        \DB::raw('sum(movimiento_actividades.tiempo_minutos) as tiempo_minutos'))
        //->whereYear('actividades.fecha_liberacion','2023')
        //->whereMonth('actividades.fecha_liberacion','03')
        ->whereBetween('actividades.fecha_liberacion',[$anio.'-'.$mes_date.'-01',$anio.'-'.$mes_date.'-'.$numero_dias])
        ->whereIn('actividades.proyecto_id', [9, 28])
        ->where('movimiento_actividades.tiempo_minutos', '>',0)
        ->where('users.unidad_id', '=',1)
        //->orderBy('actividades.id')
        ->orderBy(\DB::raw('DATE_FORMAT(movimiento_actividades.fecha, "%d/%m/%Y")'))
        ->groupBy('actividades.id',\DB::raw('DATE_FORMAT(movimiento_actividades.fecha, "%d/%m/%Y")'),'actividades.numero_ticket','actividades.descripcion')
        ->get();

        $tiempo_total_minutos = 0;
        $minutos_meta = 500 * 60; //500 horas del mes

        foreach($actividades as $obj)
        {
            $obj->tiempo_desarrollo = $this->get_time($obj->tiempo_minutos);
            $tiempo_total_minutos = $tiempo_total_minutos + $obj->tiempo_minutos;
        }

        $minutos_excedente = $tiempo_total_minutos - $minutos_meta;
        $horas_extra = intval(($tiempo_total_minutos- $minutos_meta)/60) ;
        $minutos_extra = ($tiempo_total_minutos- $minutos_meta) - ($horas_extra * 60);


        $minutos_excedente = $this->get_time($minutos_excedente);

        $valor_horas_extra = $horas_extra * 70;
        $valor_minutos_extra = ($minutos_extra/60) * 70;

        $valor_extra = $valor_horas_extra + $valor_minutos_extra;

        //dd($horas_extra,  $minutos_extra, $valor_extra);

        $tiempo_total_minutos = $this->get_time($tiempo_total_minutos);

        if ($valor_extra <= 0){
            $minutos_excedente = 0;
            $valor_extra = 0;
        }



        //dd($valor_extra);

        $pdf = \PDF::loadView('produccion.facturar.reporte',['actividades' => $actividades, 'tiempo_total_minutos' => $tiempo_total_minutos,
        'minutos_excedente' => $minutos_excedente, 'fecha_inicio' => $fecha_inicio,
        'fecha_final' => $fecha_final, 'valor_extra' => $valor_extra]);
        return $pdf->download('lista_pdf2022');
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
