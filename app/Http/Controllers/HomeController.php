<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actividad;
use App\Proyecto;

use App\TmpTotDsbActividadFinalizada;
use App\TmpTotDsbActividadDesarrollo;
use App\TmpDsbActividadActual;
use App\TmpDsbSemanaActividadActual;
use App\TmpDsbDato;
use App\TmpDsbActividadDiaria;
use App\TmpTotDsbActividadFinalizadaUsuarioSemana;
use App\ViewTiempoUsuarios;
use App\VWTiempoDiarioUsuariosDetalle;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->rol_id == 6 && !session('id_unidad')) {
            return view('unidades');
        }
        //auth()->user()->rol_id==2
        //$unidadId=\Auth::user()->unidadId();
        // $dsb_proyectos_estatus = DB::select("call spActualizarProyectosEstatus('" . auth()->user()->unidadId() . "')");


        if (auth()->user()->rol_id == 1) {
            $proyectos = DB::table('actividades')
                ->select(
                    'proyectos.id',
                    'proyectos.nombre as proyecto',
                    'proyectos.descripcion',
                    'estados.nombre as estado'
                )
                ->join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
                ->join('users', 'actividades.users_id', '=', 'users.id')
                ->join('estados', 'proyectos.estado_id', '=', 'estados.id')
                ->where('users.unidad_id', '=', auth()->user()->unidadId())
                ->distinct()
                ->get();
        } else {
            $proyectos = DB::table('actividades')
                ->select(
                    'proyectos.id',
                    'proyectos.nombre as proyecto',
                    'proyectos.descripcion',
                    'estados.nombre as estado'
                )
                ->join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
                ->join('users', 'actividades.users_id', '=', 'users.id')
                ->join('estados', 'proyectos.estado_id', '=', 'estados.id')
                ->where('actividades.users_id', '=', auth()->user()->id)
                ->distinct()
                ->get();
        }

        //dd($dsb_proyectos);

        //dd($proyectos_destacados_id);






        $dsb_actividades_finalizadas = DB::select("call dashboardActividadesFinalizadas('" . auth()->user()->unidadId() . "')");

        //$dsb_tot_actividades_finalizadas = TmpTotDsbActividadFinalizada::all();
        $dsb_tot_actividades_finalizadas = DB::table('tmp_tot_dsb_actividades_finalizadas')->orderBy('tmp_tot_dsb_actividades_finalizadas.numero_actividades');
        $usuarios = $dsb_tot_actividades_finalizadas->pluck('user_name');
        $numero_actividades = $dsb_tot_actividades_finalizadas->pluck('numero_actividades');

        $data_users_end = array();

        for ($i = 0; $i < count($usuarios); $i++) {
            $array_user_end = array("name" => $usuarios[$i], "y" => $numero_actividades[$i], "color" => "#4670C0");
            array_push($data_users_end, $array_user_end);
        }


        //dd($data_users_end);

        //$dsb_actividades_desarrollo = DB::select('call dashboardActividadesEnDesarrollo()');
        $dsb_actividades_desarrollo = DB::select("call dashboardActividadesEnDesarrollo('" . auth()->user()->unidadId() . "')");

        //$dsb_tot_actividades_desarrollo = TmpTotDsbActividadDesarrollo::all();

        $dsb_tot_actividades_desarrollo = DB::table('tmp_dsb_actividades_desarrollo')->orderBy('tmp_dsb_actividades_desarrollo.numero_actividades');
        $usuarios = $dsb_tot_actividades_desarrollo->pluck('user_name');
        $numero_actividades = $dsb_tot_actividades_desarrollo->pluck('numero_actividades');

        $data_users_dev = array();

        for ($i = 0; $i < count($usuarios); $i++) {
            $array_user_dev = array("name" => $usuarios[$i], "y" => $numero_actividades[$i], "color" => "#4670C0");
            array_push($data_users_dev, $array_user_dev);
        }


        //dd($data_users_dev);


        //$dsb_actividades_finalizadas_mes = DB::select('call dashboardActividadesFinalizadasMes()');
        /*  $dsb_actividades_finalizadas_mes = DB::select("call dashboardActividadesFinalizadasMes('".auth()->user()->unidadId()."')");

        $dsb_tot_actividades_finalizadas = DB::table('tmp_tot_dsb_actividades_finalizadas_mes')
        ->select('tmp_tot_dsb_actividades_finalizadas_mes.mes', 'tmp_tot_dsb_actividades_finalizadas_mes.mes_str',
        'tmp_tot_dsb_actividades_finalizadas_mes.numero_actividades')
        ->orderBy('tmp_tot_dsb_actividades_finalizadas_mes.anio','asc')
        ->orderBy('tmp_tot_dsb_actividades_finalizadas_mes.mes','asc')
        ->get();

        $meses=$dsb_tot_actividades_finalizadas->pluck('mes_str');
        $numero_actividades=$dsb_tot_actividades_finalizadas->pluck('numero_actividades');

        $data_meses_end = array();

        for ($i = 0; $i < count($meses); $i++) {
            $array_meses_end = array("name"=>$meses[$i],"y"=>$numero_actividades[$i],"color"=>"#4670C0");
            array_push($data_meses_end, $array_meses_end);
        }*/

        $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $fecha_actual = \Carbon::now()->addMonths(-11);
        $fecha_inicial = $fecha_actual->format('Y-m-') . '01 00:00:00';
        $fecha_final = \Carbon::now()->format('Y-m-d') . ' 23:59:00';

        $actividades_finalizadas_mes = Actividad::join('users', 'users.id', '=', 'actividades.users_id')
            ->where('actividades.porcentaje', '=', 100)
            ->where('actividades.fecha_inicio', '>', $fecha_inicial)
            ->where('users.unidad_id', '=', auth()->user()->unidadId())
            ->select(\DB::raw('count(actividades.id) as conteo,month(actividades.fecha_inicio) as mes,year(actividades.fecha_inicio) as anio'))
            ->groupBy(\DB::raw('year(actividades.fecha_inicio),month(actividades.fecha_inicio)'))
            ->get();

        $data_meses_end = array();

        foreach ($actividades_finalizadas_mes as $registro) {
            array_push($data_meses_end, array("name" => $meses[$registro->mes + 0] . " " . $registro->anio, "y" => intval($registro->conteo), "color" => "#4670C0"));
        }





        $actividades_categoria = Actividad::join('categoria_tickets', 'categoria_tickets.id', '=', 'actividades.categoria_id')
            ->whereBetween('actividades.fecha_liberacion', [$fecha_inicial, $fecha_final])
            ->whereIn('actividades.categoria_id', [3, 8, 9])
            ->where('actividades.numero_ticket', '<>', 1234)
            ->where('actividades.fecha_liberacion', '<>', null)
            ->select(
                'categoria_tickets.id',
                'categoria_tickets.codigo',
                'categoria_tickets.nombre',
                DB::raw('month(actividades.fecha_liberacion) as mes,year(actividades.fecha_liberacion) as anio,COUNT(actividades.id) as conteo')
            )
            ->groupBy(DB::raw('categoria_tickets.id,categoria_tickets.codigo,categoria_tickets.nombre,month(actividades.fecha_liberacion),year(actividades.fecha_liberacion)'))
            ->orderBy(DB::raw('year(actividades.fecha_liberacion),month(actividades.fecha_liberacion)'))
            ->get();

        $data_categorias = "";
        $array_cantidad_codigo_3 = array();
        $array_cantidad_codigo_8 = array();
        $array_cantidad_codigo_9 = array();

        //$localizacion = array();
        $j = 0;
        for ($i = $fecha_actual->format('m') + 0; $i <= 12; $i++) {
            $data_categorias = $data_categorias . "'" . $meses[$i] . " " . $fecha_actual->format('Y') . "',";
            array_push($array_cantidad_codigo_3, 0);
            array_push($array_cantidad_codigo_8, 0);
            array_push($array_cantidad_codigo_9, 0);
            $localizacion[$i . $fecha_actual->format('Y')] = $j;
            $j++;
        }

        for ($i = 1; $i <= $fecha_actual->format('m') + 0; $i++) {
            $data_categorias = $data_categorias . "'" . $meses[$i] . " " . Carbon::now()->format('Y') . "',";
            array_push($array_cantidad_codigo_3, 0);
            array_push($array_cantidad_codigo_8, 0);
            array_push($array_cantidad_codigo_9, 0);
            $localizacion[$i . Carbon::now()->format('Y')] = $j;
            $j++;
        }

        //dd($actividades_categoria);

        foreach ($actividades_categoria as $actividad) {
            $posicion = $localizacion[$actividad->mes . $actividad->anio];

            if ($actividad->id == 3) {
                $array_cantidad_codigo_3[$posicion] = $actividad->conteo;
                if ($actividad->nombre != null) $nombre_codigo_3 = $actividad->nombre;
                else $nombre_codigo_3 = '';

                //dd($nombre_codigo_3);

                $url_codigo_3 = "http://localhost:8000/home";
            } else  if ($actividad->id == 8) {
                $array_cantidad_codigo_8[$posicion] = $actividad->conteo;
                $nombre_codigo_8 = $actividad->nombre;
                if ($actividad->nombre != null) $nombre_codigo_8 = $actividad->nombre;
                else $nombre_codigo_8 = '';

                $url_codigo_8 = "http://localhost:8000/home";
            } else  if ($actividad->id == 9) {
                $array_cantidad_codigo_9[$posicion] = $actividad->conteo;
                $nombre_codigo_9 = $actividad->nombre;
                if ($actividad->nombre != null) $nombre_codigo_9 = $actividad->nombre;
                else $nombre_codigo_9 = '';

                $url_codigo_9 = "http://localhost:8000/home";
            }
        }


        //dd($nombre_codigo_3);






        //dd($data_users_dev);

        //dd($data_users);

        //extract($dsb_actividades);

        //$data = response()->json($data, 200, []);


        //actividades semanales proyecto 9



        //dd($data_semana_9);


        //$dsb_obtener_datos = DB::select('call dashboardObtenerDatos()');
        $dsb_obtener_datos = DB::select("call dashboardObtenerDatos('" . auth()->user()->unidadId() . "')");

        //dd($dsb_obtener_datos);

        //$numero_tickets_anterior = TmpDsbDato::all()->get()->first()->numero_tickets_anterior;
        $numero_tickets_anterior = DB::table('tmp_dsb_datos')->where('unidad_id', '=', auth()->user()->unidadId())->get()->first()->numero_tickets_anterior;
        $numero_tickets_actual = DB::table('tmp_dsb_datos')->where('unidad_id', '=', auth()->user()->unidadId())->get()->first()->numero_tickets_actual;
        $numero_incremento_prod = DB::table('tmp_dsb_datos')->where('unidad_id', '=', auth()->user()->unidadId())->get()->first()->numero_incremento_prod;
        $numero_proyectos_desarrollo = DB::table('tmp_dsb_datos')->where('unidad_id', '=', auth()->user()->unidadId())->get()->first()->numero_proyectos_desarrollo;

        //dd($numero_tickets_anterior);

        //$dsb_actividades_diarias = DB::select('call dashboardActividadesDiarias()');
        $dsb_actividades_diarias = DB::select("call dashboardActividadesDiarias('" . auth()->user()->unidadId() . "')");
        //$dsb_tot_actividades_diarias = TmpDsbActividadDiaria::all();
        $dsb_tot_actividades_diarias = DB::table('tmp_tot_dsb_actividades_diarias')->orderBy('tmp_tot_dsb_actividades_diarias.dia');

        //$usuarios=$dsb_tot_actividades_semanales_actuales->pluck('user_name');
        $dias = $dsb_tot_actividades_diarias->pluck('dia');
        $numero_actividades = $dsb_tot_actividades_diarias->pluck('numero_actividades');

        $valMin = $dsb_tot_actividades_diarias->pluck('dia')->min();
        $valMax = $dsb_tot_actividades_diarias->pluck('dia')->max();





        $data_actividades_diarias = array();

        for ($i = 0; $i < count($dias); $i++) {
            $array_actividades_diarias = array("name" => $dias[$i], "y" => $numero_actividades[$i], "color" => "#4670C0");
            array_push($data_actividades_diarias, $numero_actividades[$i]);
        }

        $numero_actividades_ok = array();
        for ($i = $valMin; $i <= $valMax; $i++) {

            //echo "i= ".$i."\n";

            // $key = array_search($i, $dias); // $key = 2;

            // echo "key= ".$key."\n";

            //echo "dias ".$dias[$i]." = ".$numero_actividades[$i]."\n";

            // if ($numero_actividades[$i]>0){
            //     array_push($numero_actividades_ok, $numero_actividades[$i]);
            // }else{
            //     array_push($numero_actividades_ok, 0);
            // }

        }



        $data_actividades_diarias = [1, 0, 13, 32, 14, 0, 0, 0, 0, 22, 20];

        //$data_actividades_diarias = [1,13,32,14,22,20];

        //$data_actividades_diarias = [34, 44, 54, 21, 12, 43, 33, 23, 66, 66, 58];



        //dd($data_actividades_diarias);

        //$dsb_estado_proyectos = DB::select('call dashboardEstadoProyectos()');
        $dsb_estado_proyectos = DB::select("call dashboardEstadoProyectos('" . auth()->user()->unidadId() . "')");

        //$numero_tickets_anterior = TmpDsbDato::all()->get()->first()->numero_tickets_anterior;
        $numero_proyectos_asignados = DB::table('tmp_dsb_proyectos_estados')->get()->first()->numero_proyectos_asignados;
        $numero_proyectos_pausa = DB::table('tmp_dsb_proyectos_estados')->get()->first()->numero_proyectos_pausa;
        $numero_proyectos_desarrollo = DB::table('tmp_dsb_proyectos_estados')->get()->first()->numero_proyectos_desarrollo;
        $numero_proyectos_certificacion = DB::table('tmp_dsb_proyectos_estados')->get()->first()->numero_proyectos_certificacion;
        $numero_proyectos_creados = DB::table('tmp_dsb_proyectos_estados')->get()->first()->numero_proyectos_creados;


        $data_estado_proyectos = array(
            //array("name"=>"Asignado","y"=>(float) $numero_proyectos_asignados,"color"=>"#4670C0"),
            //array("name"=>"En Pausa","y"=>(float) $numero_proyectos_pausa,"color"=>"#CC1C9C"),
            array("name" => "En Desarrollo", "y" => (float) $numero_proyectos_desarrollo, "color" => "#5E72E4"),
            array("name" => "En Certificacion", "y" => (float) $numero_proyectos_certificacion, "color" => "#2DCE89"),
            array("name" => "En Pausa", "y" => (float) $numero_proyectos_pausa, "color" => "#11CDEF"),
        );


        //$dsb_proyectos_desa_tiempo = DB::select('call dashboardTiempoProyectosDesarrollo()');
        $dsb_proyectos_desa_tiempo = DB::select("call dashboardTiempoProyectosDesarrollo('" . auth()->user()->unidadId() . "')");

        $proyectos_avance = DB::table('tmp_tot_dsb_proyectos_desarrollo_tiempo')
            ->select('tmp_tot_dsb_proyectos_desarrollo_tiempo.id', 'tmp_tot_dsb_proyectos_desarrollo_tiempo.nombre', 'tmp_tot_dsb_proyectos_desarrollo_tiempo.avance', 'tmp_tot_dsb_proyectos_desarrollo_tiempo.tiempo')
            ->where('id', '<>', '9')
            ->where('id', '<>', '11')
            ->where('id', '<>', '28')
            ->where('avance', '>', '0')
            //->where('finalizado','=','0')
            ->orderBy('tmp_tot_dsb_proyectos_desarrollo_tiempo.avance', 'desc')
            ->get();
        //dd($proyectos_avance);





        //$dsb_proyectos_tiempo = DB::select('call dashboardTiempoProyectos()');
        $dsb_proyectos_tiempo = DB::select("call dashboardTiempoProyectos('" . auth()->user()->unidadId() . "')");
        //$dsb_tot_proyectos_tiempo = TmpDsbActividadDiaria::all();
        $dsb_tot_proyectos_tiempo = DB::table('tmp_tot_dsb_proyectos_tiempo')->orderBy('tmp_tot_dsb_proyectos_tiempo.tiempo');



        $data_proyectos_tiempo = DB::table('tmp_tot_dsb_proyectos_tiempo')
            ->select('tmp_tot_dsb_proyectos_tiempo.id', 'tmp_tot_dsb_proyectos_tiempo.proyecto', 'tmp_tot_dsb_proyectos_tiempo.tiempo')
            ->orderBy('tmp_tot_dsb_proyectos_tiempo.tiempo', 'desc')
            ->get();


        //$usuarios=$dsb_tot_actividades_semanales_actuales->pluck('user_name');
        $proyectos_fin = $dsb_tot_proyectos_tiempo->pluck('proyecto');
        $tiempos_fin = $dsb_tot_proyectos_tiempo->pluck('tiempo');

        //dd($proyectos);
        //dd($tiempos);


        //dd($data_proyectos_tiempo);


        //$dsb_actividades_finalizadas_usuario_semana = DB::select('call dashboardActividadesFinalizadasUsuarioSemana()');
        $dsb_actividades_finalizadas_usuario_semana = DB::select("call dashboardActividadesFinalizadasUsuarioSemana('" . auth()->user()->unidadId() . "')");

        $dsb_tot_actividades_finalizadas_usuario_semana = DB::table('tmp_tot_actividades_finalizadas_usuario_semana')->orderBy('tmp_tot_actividades_finalizadas_usuario_semana.numero_actividades');
        $users = $dsb_tot_actividades_finalizadas_usuario_semana->pluck('user_name');
        $numero_actividades = $dsb_tot_actividades_finalizadas_usuario_semana->pluck('numero_actividades');

        $data_users_week_end = array();

        for ($i = 0; $i < count($users); $i++) {
            $array_user_week_end = array("name" => $users[$i], "y" => $numero_actividades[$i], "color" => "#4670C0");
            array_push($data_users_week_end, $array_user_week_end);
        }


        //dd($data_users_week_end);
        //dd($data_users_end);



        //$dsb_actividades_finalizadas_horas_mes = DB::select('call dashboardActividadesFinalizadasHorasMes()');
        $dsb_actividades_finalizadas_horas_mes = DB::select("call dashboardActividadesFinalizadasHorasMes('" . auth()->user()->unidadId() . "')");

        $dsb_tot_actividades_finalizadas = DB::table('tmp_tot_dsb_actividades_finalizadas_horas_mes')
            ->select(
                'tmp_tot_dsb_actividades_finalizadas_horas_mes.mes',
                'tmp_tot_dsb_actividades_finalizadas_horas_mes.mes_str',
                'tmp_tot_dsb_actividades_finalizadas_horas_mes.tiempo_horas'
            )
            ->orderBy('tmp_tot_dsb_actividades_finalizadas_horas_mes.anio', 'asc')
            ->orderBy('tmp_tot_dsb_actividades_finalizadas_horas_mes.mes', 'asc')
            ->get();

        $meses = $dsb_tot_actividades_finalizadas->pluck('mes_str');
        $tiempo_horas = $dsb_tot_actividades_finalizadas->pluck('tiempo_horas');

        $data_horas_meses_end = array();

        for ($i = 0; $i < count($meses); $i++) {
            $array_horas_meses_end = array("name" => $meses[$i], "y" => $tiempo_horas[$i], "color" => "#4670C0");
            array_push($data_horas_meses_end, $array_horas_meses_end);
        }







        //$dsb_actividades_desarrollo = DB::select('call dashboardActividadesEnDesarrollo()');
        $dsb_actividades_categorias = DB::select("call spGeneraNumeroActividadesCategorias()");

        //$dsb_tot_actividades_desarrollo = TmpTotDsbActividadDesarrollo::all();

        $dsb_tot_actividades_categorias = DB::table('tmp_dsb_actividades_categorias')
            ->select(
                'tmp_dsb_actividades_categorias.id',
                'tmp_dsb_actividades_categorias.codigo',
                'tmp_dsb_actividades_categorias.nombre',
                'tmp_dsb_actividades_categorias.mes',
                'tmp_dsb_actividades_categorias.cantidad',
                'tmp_dsb_actividades_categorias.url'
            )
            //->orderBy('tmp_dsb_actividades_categorias.anio', 'asc')
            ->orderBy('tmp_dsb_actividades_categorias.mes', 'asc')
            ->get();


        //dd($dsb_tot_actividades_categorias);


        /* $data_horas_meses_end = array();

        for ($i = 0; $i < count($meses); $i++) {
            $array_horas_meses_end = array("name"=>$meses[$i],"y"=>$tiempo_horas[$i],"color"=>"#4670C0");
            array_push($data_horas_meses_end, $array_horas_meses_end);
        }*/

        $fecha_actual = \Carbon::now()->addMonths(-1);
        $fecha_inicial = $fecha_actual->format('Y-m-d') . ' 00:00:00';
        $fecha_final = \Carbon::now()->format('Y-m-d') . ' 23:59:00';

        /*$sql =  "SELECT PROYECTO, `id usuario` as IdUsuario , Usuario , ifnull(SUM( `Tiempo Percibido Minutos`),0) TMP_INGRESADO
        FROM `VWTiempoDiarioUsuariosDetalle` WHERE `Fecha Movimiento` BETWEEN ? AND  ? and Usuario <> 'MVALLE_ID'
        GROUP BY PROYECTO, `id usuario` , Usuario  having TMP_INGRESADO > 0 order by PROYECTO,Usuario";

        $data_consolidado_proyectos = DB::select($sql, array($fecha_inicial, $fecha_final));*/
        $data_consolidado_proyectos = null;

        /*
        $sql =  "SELECT PROYECTO, `id usuario` as IdUsuario , Usuario ,   ifnull(sum( `Tiempo sistema Minutos`),0) TMP_INGRESADO
        FROM `VWTiempoDiarioUsuariosDetalle` WHERE `Fecha Movimiento` BETWEEN ? AND  ? and Usuario = 'MVALLE_ID'
        GROUP BY PROYECTO, `id usuario` , Usuario  having TMP_INGRESADO > 0 order by PROYECTO,Usuario";

        $data_consolidado_proyectos2 = DB::select($sql, array($fecha_inicial, $fecha_final));*/
        $data_consolidado_proyectos2 = null;

        //dd($data_categorias);
        //dd($data_estado_proyectos);

        return view(
            'home',
            [
                'proyectos' => $proyectos,
                'data_users_end' => $data_users_end,
                'data_users_dev' => $data_users_dev,

                'numero_tickets_anterior' => $numero_tickets_anterior,
                'numero_tickets_actual' => $numero_tickets_actual,
                'numero_incremento_prod' => $numero_incremento_prod,
                'numero_proyectos_desarrollo' => $numero_proyectos_desarrollo,
                'numero_proyectos_certificacion' => $numero_proyectos_certificacion,
                'numero_proyectos_pausa' => $numero_proyectos_pausa,

                'data_actividades_diarias' => $data_actividades_diarias,
                'data_estado_proyectos' => $data_estado_proyectos,
                'proyectos_avance' => $proyectos_avance,
                'data_meses_end' => $data_meses_end,
                'data_proyectos_tiempo' => $data_proyectos_tiempo,

                'proyectos_fin' => $proyectos_fin,
                'tiempos_fin' => $tiempos_fin,
                'data_users_week_end' => $data_users_week_end,
                'data_horas_meses_end' => $data_horas_meses_end,
                'dsb_tot_actividades_categorias' => $dsb_tot_actividades_categorias,

                'data_categorias' => substr($data_categorias, 0, -1),
                'array_cantidad_codigo_3' => $array_cantidad_codigo_3,
                'array_cantidad_codigo_8' => $array_cantidad_codigo_8,
                'array_cantidad_codigo_9' => $array_cantidad_codigo_9,
                'data_consolidado_proyectos' => $data_consolidado_proyectos,
                'data_consolidado_proyectos2' => $data_consolidado_proyectos2,
                'fecha_inicial' => $fecha_inicial,
                'fecha_final' => $fecha_final,

                'nombre_codigo_3' => $nombre_codigo_3,
                'url_codigo_3' => $url_codigo_3,

                'nombre_codigo_8' => $nombre_codigo_8,
                'url_codigo_8' => $url_codigo_8,

                'nombre_codigo_9' => $nombre_codigo_9,
                'url_codigo_9' => $url_codigo_9,
            ]
        ); //listado

    }


    public function  consolidado_mensual(Request $request)
    {
        $fecha_actual = Carbon::now()->addMonths(-1);
        $fecha_inicial = $fecha_actual->format('Y-m-d') . ' 00:00:00';
        $fecha_final = Carbon::now()->format('Y-m-d') . ' 23:59:00';

        $sql =  "SELECT PROYECTO,descripcion, `id usuario` as IdUsuario , Usuario , ifnull(`Tiempo Percibido Minutos`,0) TMP_INGRESADO,
        ifnull(`Tiempo sistema Minutos`,0) TMP_SISTEMA, DATE_FORMAT(`Fecha Movimiento`,'%d/%m/%Y') AS FechaMovimiento
        FROM `VWTiempoDiarioUsuariosDetalle` WHERE `Fecha Movimiento` BETWEEN ? AND  ? and Usuario = ? and PROYECTO = ?

        order by `Fecha Movimiento`";

        $data_consolidado_proyectos = DB::select($sql, array($fecha_inicial, $fecha_final, $request->get('Usuario'), $request->get('Proyecto')));

?>
        <h5 class="modal-title" id="exampleModalLabel"> Proyecto: <?php echo $request->get('Proyecto'); ?><br>
            Usuario: <?php echo $request->get('Usuario'); ?></h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Tiempo (MINUTOS)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $total = 0;
                foreach ($data_consolidado_proyectos as $obj) {

                    if ($request->get('Usuario') != 'MVALLE_ID' && $obj->TMP_INGRESADO > 0) {
                ?>
                        <tr>
                            <td><?php echo $obj->FechaMovimiento ?></td>
                            <td><?php echo $obj->descripcion ?></td>
                            <td><?php echo $obj->TMP_INGRESADO ?></td>
                        </tr>

                    <?php
                    } else if ($obj->TMP_SISTEMA > 0) {
                    ?>
                        <tr>
                            <td><?php echo $obj->FechaMovimiento ?></td>
                            <td><?php echo $obj->descripcion ?></td>
                            <td><?php echo $obj->TMP_SISTEMA ?></td>
                        </tr>

                <?php
                    }

                    $total += $obj->TMP_INGRESADO;
                }



                ?>




            </tbody>

            <tr>
                <td colspan="2"><strong>TOTAL</strong></td>
                <td><strong><?php echo $total ?></strong></td>
            </tr>
        </table>

<?php
        //return $data_consolidado_proyectos;
    }
}