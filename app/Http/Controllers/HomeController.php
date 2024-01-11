<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\snipeit\ActivosIso;
use App\snipeit\VmFrecuenciaMantenimiento;
use App\snipeit\VmMantenimiento;
use App\TmpTotDsbActividadFinalizada;
use App\TmpTotDsbActividadDesarrollo;
use App\TmpDsbDato;
use App\TmpDsbActividadDiaria;
use App\Unidad;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function home_soporte($year, $month)
    {
        $meses = array(
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        );

        $resultados = VmMantenimiento::selectRaw("nombre_tecnico, sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'PENDIENTE' then total else 0 end) as pendiente,
            sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'REALIZADO' then total else 0 end) as realizado")
            ->whereYear('fecha_inicio', '=', $year)
            ->whereMonth('fecha_inicio', '=', $month)
            ->whereIn('tipo_mantenimiento', ['Maintenance', 'Mantenimiento'])
            ->groupBy('nombre_tecnico')
            ->get();


        $resultados_sucursal = VmMantenimiento::selectRaw("sucursal, sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'PENDIENTE' then total else 0 end) as pendiente,
            sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'REALIZADO' then total else 0 end) as realizado")
            ->whereYear('fecha_inicio', '=', $year)
            ->whereMonth('fecha_inicio', '=', $month)
            ->whereIn('tipo_mantenimiento', ['Maintenance', 'Mantenimiento'])
            ->groupBy('sucursal')
            ->get();

        $resultados_correctivos = VmMantenimiento::selectRaw("nombre_tecnico, sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'PENDIENTE' then total else 0 end) as pendiente,
            sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'REALIZADO' then total else 0 end) as realizado")
            ->whereYear('fecha_inicio', '=', $year)
            ->whereMonth('fecha_inicio', '=', $month)
            ->whereNotIn('tipo_mantenimiento', ['Maintenance', 'Mantenimiento'])
            ->groupBy('nombre_tecnico')
            ->get();

        $resultados_sucursal_correctivos = VmMantenimiento::selectRaw("sucursal, sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'PENDIENTE' then total else 0 end) as pendiente,
            sum(case when year(fecha_inicio) = $year and month(fecha_inicio) = $month and estado = 'REALIZADO' then total else 0 end) as realizado")
            ->whereYear('fecha_inicio', '=', $year)
            ->whereMonth('fecha_inicio', '=', $month)
            ->whereNotIn('tipo_mantenimiento', ['Maintenance', 'Mantenimiento'])
            ->groupBy('sucursal')
            ->get();


        $frecuencia_mtto = VmFrecuenciaMantenimiento::get();
        $mtto_activos = $frecuencia_mtto->pluck('nombre_activo')->unique();
        $mtto_sucursales = $frecuencia_mtto->pluck('sucursal')->unique();
        $mtto_areas = $frecuencia_mtto->pluck('area')->unique();




        $dispositivos_suc = DB::table('estadisticas_dispositivos_suc as s')
            ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
            ->select(DB::raw('SUBSTRING(s.ed_soc_codigo, 1, 3) as banco'), 'b.descripcion as sucursal', 's.eds_serial_impresora as serial', 's.eds_cantidad_restante as restante')
            ->where('s.eds_id', '=', function ($query) {
                $query->select(DB::raw('max(i.eds_id)'))
                    ->from('estadisticas_dispositivos_suc as i')
                    ->whereRaw('s.eds_id = i.eds_id');
            })
            ->orderBy('s.eds_cantidad_restante', 'asc')
            ->get();


        $disp_sucursales = $dispositivos_suc->pluck('sucursal')->unique();
        $disp_bancos = $dispositivos_suc->pluck('banco')->unique();


        $twoWeeksAgo = Carbon::now()->subWeeks(2)->toDateString();
        $uniqueProduccion = DB::table('vw_produccion_impresoras')
            ->select('sucursal', 'serial')
            ->where('fecha', '>', $twoWeeksAgo)
            ->distinct()
            ->get();


        return view('home_soporte', compact(
            'meses',
            'resultados',
            'resultados_sucursal',
            'year',
            'month',
            'resultados_correctivos',
            'resultados_sucursal_correctivos',
            'frecuencia_mtto',
            'mtto_activos',
            'mtto_sucursales',
            'mtto_areas',
            'disp_sucursales',
            'disp_bancos',
            'uniqueProduccion'
        ));
    }

    public function soporte_activos(Request $request)
    {

        if ($request->sucursal != '0' || $request->estado != '0' || $request->categoria != '0' || $request->area != '0') {
            $string_sucursal  = "";

            if ($request->sucursal != '0') {

                $string_sucursal  = $string_sucursal . " where sucursal_std = '$request->sucursal'";
            }

            if ($request->estado != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }


                $string_sucursal  = $string_sucursal . " status = '$request->estado'";
            }

            if ($request->categoria != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }

                $string_sucursal  = $string_sucursal . " categoria = '$request->categoria'";
            }


            if ($request->area != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }


                $string_sucursal  = $string_sucursal . " area = '$request->area'";
            }

            $sql = "select sucursal_std, count(*) as conteo from activos_iso " . $string_sucursal . " group by sucursal_std";
        } else {
            $sql = "select sucursal_std, count(*) as conteo from activos_iso group by sucursal_std";
        }


        $activos_iso = DB::connection('mysql2')->select($sql);

        return view('graficas.container_activos_iso', compact('activos_iso'));
    }

    public function soporte_activos_sucursal(Request $request)
    {

        if ($request->sucursal != '0' || $request->estado != '0' || $request->categoria != '0' || $request->area != '0') {
            $string_sucursal  = "";

            if ($request->sucursal != '0') {

                $string_sucursal  = $string_sucursal . " where sucursal_std = '$request->sucursal'";
            }

            if ($request->estado != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }


                $string_sucursal  = $string_sucursal . " status = '$request->estado'";
            }

            if ($request->categoria != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }

                $string_sucursal  = $string_sucursal . " categoria = '$request->categoria'";
            }


            if ($request->area != '0') {
                if ($string_sucursal == '') {
                    $string_sucursal = "where ";
                } else {
                    $string_sucursal =  $string_sucursal . ' and ';
                }


                $string_sucursal  = $string_sucursal . " area = '$request->area'";
            }

            $sql = "select categoria, count(*) as conteo from activos_iso " . $string_sucursal . " group by categoria";
        } else {
            $sql = "select categoria, count(*) as conteo from activos_iso group by categoria";
        }


        $activos = DB::connection('mysql2')->select($sql);

        return view('graficas.container_activos_categorias', compact('activos'));
    }



    public function soporte_activos_iso()
    {

        $categorias = ActivosIso::distinct('categoria')->orderBy('categoria')->pluck('categoria');
        $sucursales = ActivosIso::distinct('sucursal_std')->orderBy('sucursal_std')->pluck('sucursal_std');
        $estados = ActivosIso::distinct('status')->orderBy('status')->pluck('status');
        $areas = ActivosIso::distinct('area')->orderBy('status')->pluck('area');

        $activos_iso = DB::connection('mysql2')
            ->table('activos_iso')
            ->select('sucursal_std', DB::raw('count(*) as conteo'))
            ->groupBy('sucursal_std')
            ->get();

        $activos = DB::connection('mysql2')
            ->table('activos_iso')
            ->select('categoria', DB::raw('count(*) as conteo'))
            ->groupBy('categoria')
            ->get();

        return view('graficas.home_soporte_activos', compact(
            'activos',
            'activos_iso',
            'categorias',
            'sucursales',
            'estados',
            'areas'
        ));
    }





    public function soporte_dispositivos($sucursal, $banco)
    {


        if ($sucursal == "0" && $banco == "0") {

            $dispositivos_suc = DB::table('estadisticas_dispositivos_suc as s')
                ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
                ->select(
                    'b.descripcion as sucursal',
                    's.eds_serial_impresora as serial',
                    's.eds_cantidad_restante as restante',
                    DB::raw("(SELECT ifnull(date_format(prod.mantenimiento_proximo, '%d/%m/%Y'),'')
             as fecha from produccion_impresoras as prod where prod.serial = s.eds_serial_impresora order by  prod.id desc limit 1) as fecha")
                )
                ->where('s.eds_id', '=', function ($query) {
                    $query->select(DB::raw('max(i.eds_id)'))
                        ->from('estadisticas_dispositivos_suc as i')
                        ->whereRaw('s.eds_serial_impresora = i.eds_serial_impresora');
                })
                ->orderBy('s.eds_cantidad_restante', 'asc')
                ->get();
        } else if ($sucursal != "0" && $banco == "0") {
            $dispositivos_suc = DB::table('estadisticas_dispositivos_suc as s')
                ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
                ->join('produccion_impresoras as prod', 's.eds_serial_impresora', '=', 'prod.serial')
                ->select(
                    'b.descripcion as sucursal',
                    's.eds_serial_impresora as serial',
                    's.eds_cantidad_restante as restante',
                    DB::raw("(SELECT ifnull(date_format(prod.mantenimiento_proximo, '%d/%m/%Y'),'')
             as fecha from produccion_impresoras as prod where prod.serial = s.eds_serial_impresora order by  prod.id desc limit 1) as fecha")
                )
                ->where('s.eds_id', '=', function ($query) {
                    $query->select(DB::raw('max(i.eds_id)'))
                        ->from('estadisticas_dispositivos_suc as i')
                        ->whereRaw('s.eds_serial_impresora = i.eds_serial_impresora ');
                })
                ->where('b.descripcion', $sucursal) // Assuming $sucursal is a variable with the desired value
                ->orderBy('s.eds_cantidad_restante', 'asc')
                ->get();
        } else if ($sucursal == "0" && $banco != "0") {
            $dispositivos_suc = DB::table('estadisticas_dispositivos_suc as s')
                ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
                ->join('produccion_impresoras as prod', 's.eds_serial_impresora', '=', 'prod.serial')
                ->select(
                    'b.descripcion as sucursal',
                    's.eds_serial_impresora as serial',
                    's.eds_cantidad_restante as restante',
                    DB::raw("(SELECT ifnull(date_format(prod.mantenimiento_proximo, '%d/%m/%Y'),'')
             as fecha from produccion_impresoras as prod where prod.serial = s.eds_serial_impresora order by  prod.id desc limit 1) as fecha")
                )
                ->where('s.eds_id', '=', function ($query) {
                    $query->select(DB::raw('max(i.eds_id)'))
                        ->from('estadisticas_dispositivos_suc as i')
                        ->whereRaw('s.eds_serial_impresora = i.eds_serial_impresora ');
                })
                ->whereRaw("SUBSTRING(s.ed_soc_codigo, 1, 3) = ?", [$banco])
                ->orderBy('s.eds_cantidad_restante', 'asc')
                ->get();
        }


        $data = array();


        foreach ($dispositivos_suc as $dispositivo) {

            if ($dispositivo->restante < 300) {
                $color = "red";
            } else  if ($dispositivo->restante < 700) {
                $color = "orange";
            } else {
                $color = "green";
            }
            $array_dispositivo = array("name" => $dispositivo->sucursal . ' - ' . $dispositivo->serial . ' (' . $dispositivo->fecha . ')', "y" => $dispositivo->restante, "drilldown" =>  $dispositivo->sucursal . ' - ' . $dispositivo->serial, "color" =>  $color);
            array_push($data, $array_dispositivo);
        }


        return view('graficas.home_soporte_dispositivos', compact('dispositivos_suc', 'data'));
    }

    public function soporte_ribbon($sucursal, $banco)
    {

        $resultados = DB::table('estadisticas_dispositivos_suc as s')
            ->select([
                DB::raw('SUBSTRING(s.ed_soc_codigo, 1, 3) as banco'),
                'b.descripcion as sucursal',
                's.eds_serial_impresora as serial',
                's.eds_uso_ribbon as ribbon',
                DB::raw('DATE_FORMAT(s.eds_fecha_ingreso, "%d/%m/%Y") as fecha')
            ])
            ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
            ->where('s.eds_id', function ($query) {
                $query->select(DB::raw('max(i.eds_id)'))
                    ->from('estadisticas_dispositivos_suc as i')
                    ->whereRaw('s.eds_serial_impresora = i.eds_serial_impresora');
            })
            ->orderBy('s.eds_uso_ribbon', 'asc')  // Puedes cambiar a 'desc' si necesitas orden descendente
            ->get();

        $data = array();

        foreach ($resultados as $resultado) {
            if ($resultado->ribbon < 500) {
                $color = "red";
            } else  if ($resultado->ribbon < 1000) {
                $color = "orange";
            } else {
                $color = "green";
            }
            $array_ribbon = array("name" => $resultado->sucursal . ' - ' . $resultado->serial , "y" => $resultado->ribbon, "drilldown" =>  $resultado->sucursal . ' - ' . $resultado->serial, "color" =>  $color);
            array_push($data, $array_ribbon);
        }


        return view('graficas.ribbon_restante', compact('data'));
    }



    public function get_data_banco($sucursal)
    {
        $dispositivos_suc = DB::table('estadisticas_dispositivos_suc as s')
            ->join('bancos as b', 's.ed_soc_codigo', '=', 'b.cod_sucursal')
            ->select(DB::raw('SUBSTRING(s.ed_soc_codigo, 1, 3) as banco'), 'b.descripcion as sucursal', 's.eds_serial_impresora as serial', 's.eds_cantidad_restante as restante')
            ->where('s.eds_id', '=', function ($query) {
                $query->select(DB::raw('max(i.eds_id)'))
                    ->from('estadisticas_dispositivos_suc as i')
                    ->whereRaw('s.eds_id = i.eds_id');
            })
            ->where('b.descripcion', '=', $sucursal) // Agregamos la condición para sucursal
            ->orderBy('s.eds_cantidad_restante', 'asc')
            ->get();

        $bancos = $dispositivos_suc->pluck('banco')->unique();

        $response = ["bancos" => $bancos];

        return $response;
    }


    public function soporte_mantenimientos($mtto_sucursales, $mtto_areas, $mtto_activos)
    {

        $frecuencia_mtto = VmFrecuenciaMantenimiento::when($mtto_sucursales != '0', function ($query) use ($mtto_sucursales) {
            return $query->where('sucursal', '=', $mtto_sucursales);
        })
            ->when($mtto_areas != '0', function ($query) use ($mtto_areas) {
                return $query->where('area', '=', $mtto_areas);
            })

            ->when($mtto_activos != '0', function ($query) use ($mtto_activos) {
                return $query->where('nombre_activo', '=', $mtto_activos);
            })->get();

        return view('graficas.soporte_matenimientos', compact('frecuencia_mtto'));
    }

    public function soporte_mantenimientos_auditoria($mtto_sucursales, $mtto_areas, $mtto_activos)
    {

        $frecuencia_mtto = DB::connection('mysql2')
            ->table('vw_frecuencia_auditorias')
            ->when($mtto_sucursales != '0', function ($query) use ($mtto_sucursales) {
                return $query->where('sucursal', '=', $mtto_sucursales);
            })
            ->when($mtto_areas != '0', function ($query) use ($mtto_areas) {
                return $query->where('area', '=', $mtto_areas);
            })
            ->when($mtto_activos != '0', function ($query) use ($mtto_activos) {
                return $query->where('nombre_activo', '=', $mtto_activos);
            })
            ->get();

        return view('graficas.soporte_matenimientos_auditoria', compact('frecuencia_mtto'));
    }

    public function get_data_mantenimiento($sucursal)
    {
        $frecuencia_mtto = VmFrecuenciaMantenimiento::where('sucursal', '=', $sucursal)->get();
        $mtto_areas = $frecuencia_mtto->pluck('area')->unique()->values();
        $mtto_activos = $frecuencia_mtto->pluck('nombre_activo')->unique()->values();
        $response = ["areas" => $mtto_areas, "activos" => $mtto_activos];
        return $response;
    }

    public function get_data_activos($sucursal, $area)
    {
        $frecuencia_mtto = VmFrecuenciaMantenimiento::where('sucursal', '=', $sucursal)->where('area', '=', $area)->get();
        $mtto_activos = $frecuencia_mtto->pluck('nombre_activo')->unique()->values();
        $response = ["activos" => $mtto_activos];
        return $response;
    }

    public function get_data_rendimiento_bd($anio)
    {
        if ($anio == Carbon::now()->year) {
            $minFecha = Carbon::now()->firstOfYear();
            $maxFecha = Carbon::now();
        } else {
            $minFecha = Carbon::createFromDate($anio, 1, 1)->startOfDay();
            $maxFecha = Carbon::createFromDate($anio, 12, 31)->endOfDay();
        }

        $estado_rendimiento = DB::table('estados_rendimiento_bda')->get();
        $categorias = $estado_rendimiento->pluck('nombre')->toArray();

        $meses = array(
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        );
        $cod_meses = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

        $nombre_meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $series = [];

        foreach ($categorias as $categoria) {
            $array_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $resultados = DB::table('bitacora_rendimiento_base_datos as b')
                ->join('estados_rendimiento_bda as e', 'b.estado_rendimiento_id', '=', 'e.id')
                ->select(
                    DB::raw('DATE_FORMAT(b.fecha_ymd, "%Y") as anio'),
                    DB::raw('DATE_FORMAT(b.fecha_ymd, "%m") as mes'),
                    'e.nombre',
                    'e.id as estado_id',
                    DB::raw('COUNT(*) as total')
                )
                ->where('e.nombre', $categoria) // Filtrar por el mes "01"
                ->whereYear('b.fecha_ymd', $maxFecha->format('Y')) // Filtrar por el año "2023"
                ->groupBy('anio', 'mes', 'e.nombre')
                ->orderBy('anio')
                ->orderBy('mes')
                ->get();


            foreach ($resultados as $resultado) {
                $posicion = array_search($resultado->mes, $cod_meses);
                $array_data[$posicion] = $resultado->total;
            }

            $array = ["name" => $categoria, "data" => $array_data];

            array_push($series, $array);
        }

        return view('graficas.rendimiento_bd', compact('nombre_meses', 'series'));
    }

    public function get_modal_rendimiento_bd($anio, $categoria, $mes)
    {
        $meses = array(
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        );

        $valorMes = array_search($mes, $meses);

        $resultados = DB::table('bitacora_rendimiento_base_datos as bitacora')
            ->join('estados_rendimiento_bda as estado', 'bitacora.estado_rendimiento_id', '=', 'estado.id')
            ->whereMonth('bitacora.fecha_ymd', '=', $valorMes)
            ->whereYear('bitacora.fecha_ymd', '=', $anio)
            ->where('estado.nombre', '=', $categoria)
            ->get();


        return view('graficas.rendimiento_bd_modal', compact('resultados', 'anio', 'categoria', 'mes'));
    }

    public function get_tiempo_invertido($anio)
    {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $resultados = DB::table('vw_tiempo_x_propietario')
            ->select(
                'propietario',
                'Año',
                'mes',
                DB::raw("CAST(tiempo / 60 AS SIGNED) AS tiempo"),
                DB::raw("CASE mes
                    WHEN 1 THEN 'Enero'
                    WHEN 2 THEN 'Febrero'
                    WHEN 3 THEN 'Marzo'
                    WHEN 4 THEN 'Abril'
                    WHEN 5 THEN 'Mayo'
                    WHEN 6 THEN 'Junio'
                    WHEN 7 THEN 'Julio'
                    WHEN 8 THEN 'Agosto'
                    WHEN 9 THEN 'Septiembre'
                    WHEN 10 THEN 'Octubre'
                    WHEN 11 THEN 'Noviembre'
                    WHEN 12 THEN 'Diciembre'
                    ELSE 'Mes no válido' END AS nombre_mes")
            )
            ->where('Año', $anio)
            ->get();

        $propietarios = $resultados->pluck('propietario')->unique()->values()->toArray();

        $records = [];



        foreach ($propietarios as $propietario) {
            $array_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            foreach ($resultados->where('propietario', '=', $propietario) as $resultado) {
                $posicion = $resultado->mes - 1;
                $array_data[$posicion] = $resultado->tiempo + 0;
            }
            $array = ["name" => $propietario, "data" => $array_data];
            array_push($records, $array);
        }

        return view('graficas.tiempo_invertido_cliente', compact('meses', 'records',));
    }

    public function get_tiempo_invertido_anual($anio)
    {

        $data_anual = [];

        $resultados = DB::table('vw_tiempo_x_propietario')
            ->select('propietario', DB::raw('ROUND(SUM(tiempo) / 60) AS entero'))
            ->where('Año', $anio)
            ->groupBy('propietario')
            ->get();

        foreach ($resultados as $resultado) {
            $array = ["name" => $resultado->propietario, "y" => $resultado->entero + 0];
            array_push($data_anual, $array);
        }

        return view('graficas.tiempo_invertido_cliente_anual', compact('data_anual'));
    }

    public function get_produccion_impresoras(Request $request, $seriales)
    {
        if ($seriales != 0) {
            $arraySeriales = explode(",", $seriales);
        } else {
            $arraySeriales = [];
        }

        $twoWeeksAgo = Carbon::now()->subWeeks(2)->toDateString();

        //$seriales = ["0"];
        if (!empty($arraySeriales)) {
            $result = DB::table('vw_produccion_impresoras')
                ->select(DB::raw('MIN(fecha) as fecha_inicio, MAX(fecha) as fecha_final'))
                ->whereIn('serial', $arraySeriales)
                ->where('fecha', '>', $twoWeeksAgo)
                ->first();

            $produccion = DB::table('vw_produccion_impresoras')->whereIn('serial', $arraySeriales)->get();
        } else {
            $result = DB::table('vw_produccion_impresoras')
                ->select(DB::raw('MIN(fecha) as fecha_inicio, MAX(fecha) as fecha_final'))
                ->where('fecha', '>', $twoWeeksAgo)
                ->first();

            $produccion = DB::table('vw_produccion_impresoras')->get();
        }

        $fecha_inicio = $result->fecha_inicio;
        $fecha_final = $result->fecha_final;

        // Parse the start and end dates as Carbon instances
        $start_date = Carbon::parse($fecha_inicio);
        $end_date = Carbon::parse($fecha_final);

        // Generate an array of dates between $start_date and $end_date
        $date_range = [];
        while ($start_date->lte($end_date)) {
            $date_range[] = $start_date->toDateString();
            $start_date->addDay(); // Increment by one day
        }


        //$seriales = $produccion->pluck('serial')->unique()->toArray();

        $seriales = DB::table('vw_produccion_impresoras')
            ->select(DB::raw("DISTINCT sucursal,  serial"))
            ->get();


        $data = [];

        foreach ($seriales as $serial) {

            $data_array = [];
            foreach ($date_range as $date) {
                $produccion_diaria = $produccion->where('serial', $serial->serial)->where('fecha', $date)->first();
                if ($produccion_diaria) {
                    array_push($data_array, (int)$produccion_diaria->prod_diaria);
                } else {
                    array_push($data_array, 0);
                }
            }

            $registro_array = ["name" => $serial->sucursal . ' - ' . $serial->serial, "data" => $data_array];

            array_push($data, $registro_array);
        }
        return view('graficas.produccion_impresoras', compact('fecha_inicio', 'fecha_final', 'data'));
    }

    public function index(Request $request)
    {
        if (session('id_unidad')) {
            $id_unidad = session('id_unidad');
        } else {
            $id_unidad = auth()->user()->unidad_id;
        }

        //soporte técnico
        if ($id_unidad == 6) {

            $fecha = Carbon::now();
            $year = $fecha->format('Y');
            $month = $fecha->format('m');

            return Redirect::to('home/' . $year . '/' . $month);
        }


        if (auth()->user()->rol_id == 6 && !session('id_unidad')) {
            $unidades = Unidad::where('id', '>', 0)->where('id', '<>', 8)->get();
            return view('unidades', compact('unidades'));
        }


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
                ->where('users.unidad_id', '=', $id_unidad)
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



        //primera fila SEMANA PASADA, SEMANA ACTUAL , DECREMENTO PRODUCCION y PROYECTOS EN DESARROLLO
        $tmp_dsb_datos = DB::table('tmp_dsb_datos')->where('unidad_id', '=', $id_unidad)->select(['numero_tickets_anterior', 'numero_tickets_actual', 'numero_incremento_prod', 'numero_proyectos_desarrollo'])->first();

        $numero_tickets_anterior = $tmp_dsb_datos->numero_tickets_anterior ?? null;
        $numero_tickets_actual = $tmp_dsb_datos->numero_tickets_actual ?? null;
        $numero_incremento_prod = $tmp_dsb_datos->numero_incremento_prod ?? null;
        $numero_proyectos_desarrollo = $tmp_dsb_datos->numero_proyectos_desarrollo ?? null;

        // fin primera fila SEMANA PASADA, SEMANA ACTUAL , DECREMENTO PRODUCCION y PROYECTOS EN DESARROLLO


        //Avance de Proyectos
        $proyectos_avance = DB::table('proyectos')
            ->leftJoin('actividades as a', 'proyectos.id', '=', 'a.proyecto_id')
            ->select('proyectos.id', 'proyectos.nombre', 'proyectos.avance', DB::raw('IFNULL(SUM(a.tiempo_desarrollo) / 60 / 8, 0) as tiempo'))
            ->where('proyectos.finalizado', 0)
            ->where('proyectos.unidad_id', $id_unidad)
            ->whereNotIn('proyectos.id', [9, 11, 28])
            ->groupBy('proyectos.id', 'proyectos.nombre')
            ->orderByDesc('proyectos.avance')
            ->get();

        //fin de Avance de Proyectos

        //Actividades finalizadas por día
        $result = DB::table('actividades as a')
            ->leftJoin('users as u', 'a.users_id', '=', 'u.id')
            ->select(
                DB::raw('DAY(a.fecha_liberacion) as dia'),
                DB::raw('IFNULL(COUNT(*), 0) as cuenta')
            )
            ->whereYear('a.fecha_liberacion', now()->year)
            ->whereMonth('a.fecha_liberacion', now()->month)
            ->where('a.estado_id', 4)
            ->where('u.unidad_id', $id_unidad)
            ->groupBy(DB::raw('DAY(a.fecha_liberacion)'))
            ->orderBy(DB::raw('DAY(a.fecha_liberacion)'))
            ->get();

        $actividades_finalizadas_label = $result->pluck('dia')->toArray();
        $actividades_finalizadas_value = $result->pluck('cuenta')->toArray();
        //dd($actividades_finalizadas_label,$actividades_finalizadas_value);
        //fin Actividades finalizadas por día


        //Estado de proyectos
        $result = DB::table('proyectos as p')
            ->select(
                DB::raw('IFNULL(COUNT(DISTINCT CASE WHEN p.estado_id = 2 AND p.unidad_id = ' . $id_unidad . ' THEN p.id END), 0) as numero_proyectos_pausa'),
                DB::raw('IFNULL(COUNT(DISTINCT CASE WHEN p.estado_id = 3 AND p.unidad_id = ' . $id_unidad . ' THEN p.id END), 0) as numero_proyectos_desarrollo'),
                DB::raw('IFNULL(COUNT(DISTINCT CASE WHEN p.estado_id = 4 AND p.unidad_id = ' . $id_unidad . ' THEN p.id END), 0) as numero_proyectos_certificacion')
            )
            ->first();

        $data_estado_proyectos_label = ["En Desarrollo (" . $result->numero_proyectos_desarrollo . ")", "En Certificacion (" . $result->numero_proyectos_certificacion . ")", "En Pausa (" . $result->numero_proyectos_pausa . ")"];
        $data_estado_proyectos_value = [$result->numero_proyectos_desarrollo, $result->numero_proyectos_certificacion, $result->numero_proyectos_pausa];
        //fin Estado de proyectos

        //Actividades finalizadas por analista
        $result = DB::table('users')
            ->leftJoin('actividades', 'users.id', '=', 'actividades.users_id')
            ->select('users.user_name', DB::raw('COUNT(actividades.id) as numero_actividades'))
            ->where('actividades.porcentaje', '100')
            ->where('users.unidad_id', $id_unidad)
            ->groupBy('users.user_name')
            ->orderBy(DB::raw('COUNT(actividades.id)'))
            ->get();

        $data_users_end_label = $result->pluck('user_name')->toArray();
        $data_users_end_value = $result->pluck('numero_actividades')->toArray();

        //fin Actividades finalizadas por analista

        //Actividades finalizadas 15 dias por analista
        $result = DB::table('users')
            ->leftJoin('actividades', 'users.id', '=', 'actividades.users_id')
            ->select('users.user_name', DB::raw('SUM(CASE WHEN actividades.porcentaje = "100" AND actividades.fecha_liberacion BETWEEN NOW() - INTERVAL 15 DAY AND NOW() THEN 1 ELSE 0 END) as numero_actividades'))
            ->where('users.unidad_id', $id_unidad)
            ->groupBy('users.user_name')
            ->orderBy('numero_actividades')
            ->get();

        $data_users_week_end_label = $result->pluck('user_name')->toArray();
        $data_users_week_end_value = $result->pluck('numero_actividades')->toArray();
        //fin Actividades finalizadas 15 dias por analista


        //Actividades asignadas por analista
        $result = DB::table('users')
            ->leftJoin('actividades', 'users.id', '=', 'actividades.users_id')
            ->select('users.user_name', DB::raw('COUNT(actividades.id) as numero_actividades'))
            ->where('actividades.porcentaje', '<', '100')
            ->where('users.unidad_id', $id_unidad)
            ->where('actividades.estado_id', '<>', 7)
            ->groupBy('users.user_name')
            ->orderBy('numero_actividades')
            ->get();


        $data_users_dev_label = $result->pluck('user_name')->toArray();
        $data_users_dev_value = $result->pluck('numero_actividades')->toArray();
        //fin Actividades asignadas por analista


        //Bolson Horas Operatoria Diaria
        $result = DB::table('actividades')
            ->leftJoin('users as u', 'actividades.users_id', '=', 'u.id')
            ->select(
                DB::raw('MONTH(fecha_liberacion) as num_mes'),
                DB::raw('CASE
                    WHEN MONTH(fecha_liberacion) = 1 THEN CONCAT("Enero ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 2 THEN CONCAT("Febrero ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 3 THEN CONCAT("Marzo ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 4 THEN CONCAT("Abril ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 5 THEN CONCAT("Mayo ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 6 THEN CONCAT("Junio ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 7 THEN CONCAT("Julio ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 8 THEN CONCAT("Agosto ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 9 THEN CONCAT("Septiembre ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 10 THEN CONCAT("Octubre ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 11 THEN CONCAT("Noviembre ", YEAR(fecha_liberacion))
                    WHEN MONTH(fecha_liberacion) = 12 THEN CONCAT("Diciembre ", YEAR(fecha_liberacion))
                END as mes'),
                DB::raw('SUM(actividades.tiempo_desarrollo) / 60 as tiempo_horas'),
                DB::raw('YEAR(fecha_liberacion) as anio')
            )
            ->whereIn('proyecto_id', [9, 28])
            ->where('estado_id', 4)
            ->whereNotNull('fecha_liberacion')
            ->where('u.unidad_id', $id_unidad)
            ->groupBy('num_mes', 'mes', 'anio')
            ->orderBy('num_mes')
            ->get();

        $data_horas_meses_end_label = $result->pluck('mes')->toArray();
        $data_horas_meses_end_value = $result->pluck('tiempo_horas')->toArray();
        //fin Bolson Horas Operatoria Diaria



        //Actividades Finalizadas por Mes
        $fecha_actual = now();
        $fecha_inicial = $fecha_actual->subMonths(11)->startOfMonth();
        $fecha_final = now()->endOfDay();


        $actividades_finalizadas_mes = Actividad::join('users', 'users.id', '=', 'actividades.users_id')
            ->where('actividades.porcentaje', '=', 100)
            ->where('actividades.fecha_inicio', '>', $fecha_inicial)
            ->where('users.unidad_id', '=', $id_unidad)
            ->selectRaw('COUNT(actividades.id) as conteo,
                        CONCAT(
                            CASE
                                WHEN MONTH(actividades.fecha_inicio) = 1 THEN "Enero"
                                WHEN MONTH(actividades.fecha_inicio) = 2 THEN "Febrero"
                                WHEN MONTH(actividades.fecha_inicio) = 3 THEN "Marzo"
                                WHEN MONTH(actividades.fecha_inicio) = 4 THEN "Abril"
                                WHEN MONTH(actividades.fecha_inicio) = 5 THEN "Mayo"
                                WHEN MONTH(actividades.fecha_inicio) = 6 THEN "Junio"
                                WHEN MONTH(actividades.fecha_inicio) = 7 THEN "Julio"
                                WHEN MONTH(actividades.fecha_inicio) = 8 THEN "Agosto"
                                WHEN MONTH(actividades.fecha_inicio) = 9 THEN "Septiembre"
                                WHEN MONTH(actividades.fecha_inicio) = 10 THEN "Octubre"
                                WHEN MONTH(actividades.fecha_inicio) = 11 THEN "Noviembre"
                                WHEN MONTH(actividades.fecha_inicio) = 12 THEN "Diciembre"
                            END,
                            " ",
                            YEAR(actividades.fecha_inicio)
                        ) as mes_anio')
            ->groupBy(DB::raw('YEAR(actividades.fecha_inicio), MONTH(actividades.fecha_inicio)'))
            ->get();

        $data_meses_end_mes_anio_label = $actividades_finalizadas_mes->pluck('mes_anio')->toArray();
        $data_meses_end_mes_anio_value = $actividades_finalizadas_mes->pluck('conteo')->toArray();





        // fin Actividades Finalizadas por Mes


        //Actividades por Categoria Finalizadas por Mes

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

        $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

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
        //fin Actividades por Categoria Finalizadas por Mes







        return view('home', compact(
            'numero_tickets_anterior',
            'numero_tickets_actual',
            'numero_incremento_prod',
            'numero_proyectos_desarrollo',
            'proyectos_avance',
            'actividades_finalizadas_label',
            'actividades_finalizadas_value',
            'data_estado_proyectos_label',
            'data_estado_proyectos_value',
            'data_users_end_label',
            'data_users_end_value',
            'data_users_week_end_label',
            'data_users_week_end_value',
            'data_users_dev_label',
            'data_users_dev_value',
            'data_horas_meses_end_label',
            'data_horas_meses_end_value',
            'data_meses_end_mes_anio_label',
            'data_meses_end_mes_anio_value',
            'data_categorias',
            'array_cantidad_codigo_3',
            'array_cantidad_codigo_8',
            'array_cantidad_codigo_9',
            'nombre_codigo_3',
            'nombre_codigo_8',
            'nombre_codigo_9',
            'meses'
        ));
    }


    function generarArregloFechas($fechaInicio, $fechaFinal)
    {
        /*$fechaInicio = Carbon::parse($fechaInicio);
        $fechaFinal = Carbon::parse($fechaFinal);*/

        $arregloFechas = [];

        while ($fechaInicio->lte($fechaFinal)) {
            $anio = $fechaInicio->year;
            $mes = $fechaInicio->format('m');

            $arregloFechas[$anio][] = [
                'mes' => $mes,
                'InterrupcionTotal' => 0,
                'InterrupcionParcial' => 0,
                'Caida' => 0,
                'Lentitud' => 0,
                'SinAfectacion' => 0
            ];

            $fechaInicio->addMonth(); // Avanza al siguiente mes
        }

        return $arregloFechas;
    }

    public function unidad($id)
    {
        session(['id_unidad' => $id]);
        return redirect('/home');
    }

    public function get_data($sucursal)
    {
        $categorias = ActivosIso::distinct('categoria')->where('sucursal_std', '=', $sucursal)->orderBy('categoria')->pluck('categoria');
        $estados = ActivosIso::distinct('status')->where('sucursal_std', '=', $sucursal)->orderBy('status')->pluck('status');
        $areas = ActivosIso::distinct('area')->where('sucursal_std', '=', $sucursal)->orderBy('area')->pluck('area');

        $response = ["categorias" => $categorias, "estados" => $estados, "areas" => $areas];
        return $response;
    }

    public function get_data_categoria($sucursal)
    {
        $categorias = ActivosIso::distinct('categoria')->where('sucursal_std', '=', $sucursal)->orderBy('categoria')->pluck('categoria');
        $estados = ActivosIso::distinct('status')->where('sucursal_std', '=', $sucursal)->orderBy('status')->pluck('status');
        $areas = ActivosIso::distinct('area')->where('sucursal_std', '=', $sucursal)->orderBy('area')->pluck('area');

        $response = ["categorias" => $categorias, "estados" => $estados, "areas" => $areas];
        return $response;
    }




    public function load_unidades()
    {
        $unidades = Unidad::where('id', '>', 0)->where('id', '<>', 8)->get();
        return view('unidades', compact('unidades'));
    }
}
