<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
    <style type="text/css">
        body {
            font-family: 'Open Sans', Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        .titulo {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .parrafo {
            font-size: 10px;
        }

        .center-text {
            text-align: center;
        }

        .align-center {
            text-align: center;
        }

        td {
            padding: 2px;
        }

        .text-blue {
            color: rgb(3, 27, 97);
        }
    </style>
</head>

<body>

    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="2" rowspan="3">
                <center><img src="{{ public_path('img/sertracen.png') }}" width="185" height="40" /></center>
            </td>
            <td colspan="3" rowspan="3"><span class="titulo">
                    <center>EVALUACION DE PROVEEDORES</center>
                </span></td>
            <td colspan="2"><span class="titulo">Código: {{ $evaluacion->codigo }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="titulo">Versión:</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="titulo">Registro:</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="titulo">NOMBRE DEL PROVEEDOR:</span></td>
            <td colspan="5"><span class="titulo">{{ $evaluacion->proveedor->nombre }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="titulo">FECHA:</span></td>
            <td width="22%"><span class="titulo">{{ date('d/m/Y', strtotime($evaluacion->fecha_evalua)) }}</span></td>
            <td colspan="4"><span class="titulo">PERIODO DE EVALUACIÓN: {{ $evaluacion->periodo_evaluacion }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="7" class="text_center">Marque con una &quot;x&quot; para seleccionar el criterio de cada
                característica de cumplimiento.</td>
        </tr>
        <tr class="center-text">
            <td colspan="2"><span class="titulo">CARACTERÍSTICAS</span></td>
            <td colspan="4"><span class="titulo">CRITERIOS</span></td>
            <td width="7%"><span class="titulo">CALIFICACION</span></td>
        </tr>
        @foreach ($resultado as $eval)
            <tr>
                <td width="19%">{{ $eval->cumplimiento }} </td>
                <td width="11%">{{ $eval->caracteristica }} </td>
                <td colspan="4">{{ $eval->criterio }} </td>
                <td width="7%" class="center-text">{{ $eval->calificacion }} </td>
            </tr>
        @endforeach
    </table>



    <br />

    <table border=1 width="100%" cellspacing="0" cellpadding="0">
        <thead>
            <tr border=1>
                <td colspan="3" align="center" class="text-blue titulo">CALIFICACION OBTENIDA</td>
            </tr>
            <tr border=1>
                <td width="33%" align="center" class="text-blue center-text">PUNTAJE</td>
                <td width="33%" align="center" class="text-blue center-text">¿PROVEEDOR ES ACEPTADO?</td>
                <td width="34%" align="center" class="text-blue center-text">CATEGORIA</td>
            </tr>
        </thead>
      <tbody>
            <tr class="center-text">
                <td class="titulo">{{ intval($data_calificacion->calificacion) }}</td>
                <td class="titulo">
                @if ( $califica_obtenida->aceptado =='S')
                    SI
                @else
                    NO
                @endif

               </td>
                <td class="titulo">{{ $califica_obtenida->categoria }}</td>
            </tr>

        </tbody>
    </table>
    <br />
   <table border=1 width="100%" cellspacing="0" cellpadding="0">

        <tr>

            <td width="8%" align="center" class="titulo text-blue center-text">Puntaje</td>
            <td width="12%" align="center" class="titulo text-blue center-text">Categoría</td>
            <td width="80%" align="center" class="titulo center-text text-blue">Criterios de Calificación</td>



     <tr>
            <td align="center"><span>100 - 90</span></td>
            <td align="center"><span>Confiable</span></td>
            <td><span>Confiable, cumple ampliamente los requisitos para asegurar la calidad de los productos. Preferirlo
                    al comprar.</span></td>
        </tr>
        <tr>
            <td align="center"><span>89 - 70</span></td>
            <td align="center"><span>Aceptable</span></td>
            <td><span>Aceptable, cumple satisfactoriamente con requisitos para asegurar la calidad de lo suministrado.
                </span></td>
        </tr>
        <tr>

            <td align="center"><span>&lt; 70</span></td>
            <td align="center"><span>No Confiable</span></td>
            <td>No confiable, los productos suministrados deben ser sometidos a inspecciones rigurosas. Requiere de
                asesoria y seguimiento permanente. Comprarle cuando el proveedor de CATEGORÍA A y B no pueda cumplir.
            </td>

        </tr>

    </table>
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td height="56">&nbsp;OBSERVACIONES:</td>
        </tr>
    </table>
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr class="center-text">
            <td colspan="2">ELABORADO POR</td>
            <td colspan="2">REVISADO POR</td>
            <td colspan="2">APROBADO POR</td>
        </tr>
        <tr>
            <td height="82" colspan="2" class="center-text">{{ $evaluacion->nombre_elaborado }}</td>
            <td colspan="2" class="center-text">{{ $evaluacion->nombre_revisado }}</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="center-text">
            <td colspan="2">CARGO</td>
            <td colspan="2">CARGO</td>
            <td colspan="2">CARGO</td>
        </tr>
        <tr>
            <td colspan="2" class="center-text"> {{ $evaluacion->cargo_elaborado }}</td>
            <td colspan="2" class="center-text"> {{ $evaluacion->cargo_revisado }}</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="14%">FECHA:</td>
            <td width="14%">&nbsp;</td>
            <td width="13%">FECHA:</td>
            <td width="33%">&nbsp;</td>
            <td width="7%">FECHA:</td>
            <td width="19%">&nbsp;</td>
        </tr>
    </table>


</body>

</html>
