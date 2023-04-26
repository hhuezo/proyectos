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
<html lang="en">

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
                        {{ $tiempo_total_minutos }}

                    </td>
                    <td class="arial">
                        {{ $minutos_excedente }}

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
                        del {{ $fecha_inicio }} al {{ $fecha_final }}
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
        <hr>
        <br>


        <div>
            <table border="0">
                <thead>
                    <tr>
                        <td colspan="4" align="center" class="arial">DETALLE DE HORAS TRABAJADAS
                        </td>
                    </tr>

                    <tr>
                        <td align='left' class="arial" width="10px">Id</td>
                        <td align='left' class="arial" width="20px">Fecha</td>
                        <td align='center' class="arial" width="10px">Numero Ticket</td>
                        <td align='left' class="arial" width="110px">Descripcion</td>
                        <td align='right' class="arial" width="10px">Tiempo (en Horas)</td>
                    </tr>

                </thead>
                <tbody>

                    @foreach ($actividades as $obj)
                        <tr>
                            <td align='left' class="arial" width="10px">{{ $obj->id }}</td>
                            <td align='left' class="arial" width="20px">{{ $obj->fecha }}</td>


                            <td align='center' class="arial" width="10px">{{ $obj->numero_ticket }}</td>
                            <td align='left' class="arial" width="110px">{{ $obj->descripcion }}</td>

                            <td align='right' class="arial" width="10px">{{ $obj->tiempo_desarrollo }}</td>
                        </tr>
                    @endforeach

                    <?php
                    /*   $tiempo_horas = 0 ;
                                                                            $num_actividades = 0;

                                                                        while ($row = $res->fetch_assoc()) {
                                                                            ?>
                    ?>
                    ?>
                    ?>
                    <tr>
                        <td align='left' class="arial" width="10px"><?php echo $row['id']; ?></td>
                        <td align='left' class="arial" width="20px"><?php echo $row['fecha']; ?></td>
                        <td align='center' class="arial" width="10px"><?php echo $row['numero_ticket']; ?></td>
                        <td align='left' class="arial" width="110px"><?php echo utf8_decode(utf8_encode($row['descripcion'])); ?></td>
                        <td align='right' class="arial" width="10px"><?php echo number_format($row['tiempo_desarrollo'] / 60, 2); ?></td>
                    </tr>
                    <?php
                $tiempo_horas = $tiempo_horas + $row['tiempo_desarrollo'];
                $num_actividades++;
            }
            $res->close();
            $con->close();*/

            ?>
                    <tr>
                        <td colspan="4" align='right' class="arial" width="150px">
                            <b>Total</b>
                        </td>
                        <td class="arial" width="10px" align='right'>
                            <b>{{ $tiempo_total_minutos }}</b>
                        </td>
                    </tr>
            </table>



            <br>
        </div>
</body>

</html>
