<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.titulo{
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	text-align: center;
}
.parrafo{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
  .center-text {
	text-align: center;
  }
.align-center {
	text-align: center;
}
</style>
</head>

<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" rowspan="3"><span class="titulo"><img src="{{ public_path('img/sertracen.png') }}" width="185" height="40" /></span></td>
    <td colspan="3" rowspan="3"><span class="titulo"><center>EVALUACION DE PROVEEDORES</center></span></td>
    <td colspan="2" ><span class="titulo">Código:</span></td>
  </tr>
  <tr>
    <td colspan="2" ><span class="titulo">Versión:</span></td>
  </tr>
  <tr>
    <td colspan="2" ><span class="titulo">Registro:</span></td>
  </tr>
  <tr>
    <td colspan="2" ><span class="titulo">NOMBRE DEL PROVEEDOR:</span></td>
    <td colspan="2" ><span class="titulo">{{$evaluacion->proveedor->nombre}}</span></td>
    <td width="32%">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="2"><span class="titulo">FECHA:</span></td>
    <td colspan="2"><span class="titulo">{{$evaluacion->fecha_evalua}}</span></td>
    <td><span class="titulo">PERIODO DE EVALUACIÓN</span></td>
    <td colspan="3"><span class="titulo">{{$evaluacion->periodo_evaluacion}}</span></td>
  </tr>
  <tr>
    <td colspan="8" class="text_center"><span class="titulo">Marque con una &quot;x&quot; para seleccionar el criterio de cada característica de cumplimiento.</span></td>
  </tr>
  <tr class="text_center">
    <td colspan="2"><span class="titulo">CARACTERÍSTICAS</span></td>
    <td colspan="5"><span class="titulo">CRITERIOS</span></td>
    <td width="16%"><span class="titulo">CALIFICACION</span></td>
  </tr>
  @foreach ($resultado as $eval)
  <tr>
    <td width="10%">{{$eval->cumplimiento}} </td>
    <td width="9%">{{$eval->caracteristica}} </td>
    <td colspan="5">{{$eval->criterio}} </td>
    <td width="16%">{{$eval->calificacion}} </td>
  </tr>

  @endforeach
</table>



<br />

<table border=1 width="100%" >
<tdead>
    <tr border=1>
      <td colspan="3" align="center">CALIFICACION OBTENIDA</td>
    </tr>
    <tr border=1>CALIFICACION OBTENIDA
        <td align="center">PUNTAJE</td>
        <td align="center">¿PROVEEDOR ES ACEPTADO?</td>
        <td align="center">CATEGORIA</td>
    </tr>
</tdead>
<tbody>
        <tr>
            <td>{{ $data_calificacion->calificacion}}</td>
            <td>{{ $califica_obtenida->aceptado}}</td>
            <td>{{ $califica_obtenida->categoria}}</td>
        </tr>

</tbody>
</table>
<br />
<table border=1 width="100%">

    <tr >

        <td align="center">Puntaje</td>
        <td align="center">Categoría</td>
        <td align="center">Criterios de Calificación</td>



  <tr>
    <td align="center"><span>100 - 90</span></td>
      <td align="center"><span>Confiable</span></td>
      <td><span>Confiable, cumple ampliamente los requisitos para asegurar la calidad de los productos. Preferirlo al comprar.</span></td>
  </tr>
  <tr>
      <td align="center"><span>89 - 70</span></td>
      <td align="center"><span>Aceptable</span></td>
      <td><span>Aceptable, cumple satisfactoriamente con requisitos para asegurar la calidad de lo suministrado. </span></td>
  </tr>
  <tr>

        <td align="center"><span>&lt; 70</span></td>
        <td align="center"><span>No Confiable</span></td>
        <td>No confiable, los productos suministrados deben ser sometidos a inspecciones rigurosas.  Requiere de asesoria y seguimiento permanente. Comprarle cuando el proveedor de CATEGORÍA A y B no pueda cumplir.</td>

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
  <tr class="text_center">
    <td colspan="2">ELABORADO POR</td>
    <td colspan="2">REVISADO POR</td>
    <td colspan="2">APROBADO POR</td>
  </tr>
  <tr>
    <td height="82" colspan="2" class="text_center">Carlos Quinteros</td>
    <td colspan="2" class="text_center">Reynaldo Ceron</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">CARGO</td>
    <td colspan="2">CARGO</td>
    <td colspan="2">CARGO</td>
  </tr>
  <tr>
    <td colspan="2">Encargado de IT</td>
    <td colspan="2">Gerente de Innovacion y desarrollo</td>
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
