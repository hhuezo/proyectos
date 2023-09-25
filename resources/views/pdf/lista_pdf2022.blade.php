<!DOCTYPE html>
<?php
date_default_timezone_set('America/El_Salvador');

/*$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
//$con=new mysqli('localhost','root','','seguimiento_proyectos');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT id, date(fecha) as fecha, numero_ticket, descripcion, tiempo_desarrollo FROM tmp_dsb_actividades_finalizadas_horas_mes t
                    where tiempo_desarrollo > 0 and year(fecha)='2022' order by fecha desc ");
$sel->execute();
$res=$sel->get_result();



$sel_tot=$con->prepare("SELECT sum(tiempo_desarrollo) as total ,
    DATE_FORMAT(date(min(fecha)),'%d/%m/%Y') as fecha_min,
    DATE_FORMAT(date(max(fecha)),'%d/%m/%Y') as fecha_max
 FROM tmp_dsb_actividades_finalizadas_horas_mes t  where year(fecha)='2022'");
$sel_tot->execute();
$res_tot=$sel_tot->get_result();



while ($row_tot = $res_tot->fetch_assoc()) {
    $fecha_min = $row_tot['fecha_min'];
    $fecha_max = $row_tot['fecha_max'];
    $tiempo_total = $row_tot['total'];
}
$res_tot->close();*/

// echo "tiempo_total=$tiempo_total<br>";
// echo "excedente_horas=$excedente_horas<br>";
// echo "whole=$whole<br>";
// echo "fraction=$fraction<br>";

/*
if ($tiempo_total>500) {
    $excedente_horas = ($tiempo_total - (500*60))/60;

    $whole = floor($excedente_horas); // 1 $fraction = $n - $whole; // .25

    $fraction = $excedente_horas - $whole; // .25

    //echo "fraction=$fraction<br>";

} else {
    $excedente_horas = 0;
}*/

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle de Horas Trabajadas</title>


    <style>
        .arial {
            font-family: Arial Narrow, Arial, sans-serif;
            font-size: 12px;
        }

        table.colapsado {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <header>
        <!--<div id="logo">
          <img src="img/logo.png" alt="" id="imagen">
      </div>-->
        <br>


        <div>
            <table border='0' width='100%'>
                <tr>
                    <td align='left' class="arial" width="110px">
                        Emprendimientos Mundiales <br>
                        gmartinez@em.com.sv <br>
                        +503 2261-7356; 7805-0488
                    </td>
                    <td align='right' class="arial" width="10px">
                        <img src="../public/img/logo_emprendimiento.PNG" alt="Imagen no encontrada">
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <br>

        <div>
            <table border='1' class="colapsado" border="1">
                <tr>
                    <td class="arial">
                        EMPRESA
                    </td>
                    <td class="arial">
                        HORAS TRABAJADAS
                    </td>
                    <td class="arial">
                        EXCEDENTE DE HORAS
                    </td>
                </tr>
                <tr>
                    <td class="arial">
                        SERTRACEN S.A de C.V.
                    </td>
                    <td class="arial">
                        {{ number_format($tiempo_total_minutos, 2) }}

                    </td>
                    <td class="arial">
                        {{ number_format($minutos_excedente, 2) }}

                    </td>
                </tr>
            </table>
        </div>


        <br>
        <hr>
        <br>


        <div>
            <table border='1' class="colapsado" border="1">
                <tr>
                    <td class="arial">
                        Período de facturación
                    </td>
                    <td class="arial">
                        {{-- del {{ $fecha_inicio }} al {{ $fecha_final }} --}}
                        del {{ date('d/m/Y', strtotime($fecha_inicio)) }} al
                        {{ date('d/m/Y', strtotime($fecha_final)) }}
                    </td>
                </tr>
                <tr>
                    <td class="arial">
                        Bolsón soporte 500 horas
                    </td>
                    <td class="arial" align='right'>
                        <?php
                        $cantidadBase = 500;
                        echo '$' . number_format($cantidadBase * 65, 2);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="arial">
                        Excedente de horas
                    </td>
                    <td class="arial" align='right'>
                        <?php
                        echo '$' . number_format($valor_extra, 2);
                        ?>

                    </td>
                </tr>
                <tr>
                    <td class="arial">
                        Total a pagar
                    </td>
                    <td class="arial" align='right'>
                        <?php
                        $cantidadBase = 500;
                        echo '$' . number_format($cantidadBase * 65 + $valor_extra, 2);
                        // echo '$'.number_format(($valorBase+$excedente),2);
                        ?>

                    </td>
                </tr>

            </table>
        </div>

        <br>
        <br>


        <div>
            <table border="0" width='40%' class="colapsado">
                <tr>
                    <td class="arial">
                        <br>
                        <br>

                        <hr>
                        <center>
                            Firma del Cliente
                        </center>
                        <br>
                        <center>
                            Ing. Reynaldo Ceron
                        </center>
                    </td>
                </tr>
            </table>
        </div>

        <br>
        <hr>
        <br>




        <div>
            @php($total_general = 0)
            <table border="0" width="100%">

                @foreach ($proyectos_fijos as $proyecto)
                    @php($total_proyecto = 0)

                    {{-- <thead> --}}
                    <tr>
                        <td colspan="4" align="center" class="arial">DETALLE DE HORAS TRABAJADAS
                            ({{ $proyecto->nombre }}) </td>
                    </tr>

                    <tr>
                        <td align='left' class="arial">Id</td>
                        <td align='left' class="arial">Fecha</td>
                        <td align='center' class="arial">Numero Ticket</td>
                        <td align='left' class="arial">Descripcion</td>
                        <td align='right' class="arial">Tiempo (en Horas)</td>
                    </tr>


                    @foreach ($actividades as $obj)
                        @if ($obj->proyecto_id == $proyecto->id)
                            <tr>
                                <td align='left' class="arial" style="font-size:9px">
                                    {{ $obj->id }}
                                </td>
                                <td align='left' class="arial" style="font-size:9px">
                                    {{ $obj->fecha }}
                                </td>


                                <td align='center' class="arial" style="font-size:9px">
                                    {{ $obj->numero_ticket }}</td>
                                <td align='left' class="arial" style="font-size:9px">
                                    {{ $obj->descripcion }}</td>

                                <td align='right' class="arial" style="font-size:9px">
                                    {{ number_format($obj->tiempo_desarrollo, 2) }}</td>
                            </tr>

                            @php($total_proyecto += $obj->tiempo_minutos)
                            @php($total_general += $obj->tiempo_minutos)
                        @endif
                    @endforeach





                    <tr>
                        <td colspan="4" align='right' class="arial">
                            <b>Total por Proyecto</b>
                        </td>
                        <td class="arial" align='right'>
                            <b>{{ number_format($total_proyecto / 60, 2) }}</b>
                        </td>
                    </tr>
                @endforeach



                @foreach ($proyectos as $proyecto)
                    @php($total_proyecto = 0)

                    @if ($proyecto->count > 0)
                        {{-- <thead> --}}
                        <tr>
                            <td colspan="4" align="center" class="arial">DETALLE DE HORAS TRABAJADAS
                                ({{ $proyecto->nombre }}) </td>
                        </tr>

                        <tr>
                            <td align='left' class="arial">Id</td>
                            <td align='left' class="arial">Fecha</td>
                            <td align='center' class="arial">Numero Ticket</td>
                            <td align='left' class="arial">Descripcion</td>
                            <td align='right' class="arial">Tiempo (en Horas)</td>
                        </tr>





                        @foreach ($actividades_otros as $obj)
                            @if ($obj->proyecto_id == $proyecto->id)
                                <tr>
                                    <td align='left' class="arial" style="font-size:9px">
                                        {{ $obj->id }}
                                    </td>
                                    <td align='left' class="arial" style="font-size:9px">
                                        {{ $obj->fecha }}
                                    </td>


                                    <td align='center' class="arial" style="font-size:9px">
                                        {{ $obj->numero_ticket }}</td>
                                    <td align='left' class="arial" style="font-size:9px">
                                        {{ $obj->descripcion }}</td>

                                    <td align='right' class="arial" style="font-size:9px">
                                        {{ number_format($obj->tiempo_desarrollo, 2) }}</td>
                                </tr>
                                @php($total_proyecto += $obj->tiempo_minutos)
                                @php($total_general += $obj->tiempo_minutos)
                            @endif
                        @endforeach


                        <tr>
                            <td colspan="4" align='right' class="arial">
                                <b>Total por Proyecto</b>
                            </td>
                            <td class="arial" align='right'>
                                <b>{{ number_format($total_proyecto / 60, 2) }}</b>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <table border="0" width="100%">
                <tr>
                    <td colspan="4" align='right' class="arial" style="font-size: 14px">
                        <b>Total General:</b>
                    </td>
                    <td class="arial" align='right' style="font-size: 14px">
                        <b>{{ number_format($tiempo_total_minutos, 2) }}</b>
                    </td>
                </tr>
            </table>





            <br>
        </div>
</body>

</html>
