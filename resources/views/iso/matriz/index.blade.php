@extends('layouts.panel')

@section('title','Sistema de Seguimiento de Proyectos')

<head>
<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


input[type="number"] {
	min-width: 50px;
}





		</style>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->




    
    <script src="{{ asset('js/jquery.min.js') }}"></script>

  <script src="{{ asset('code/highcharts.js') }}"></script>
  <script src="{{ asset('code/modules/exporting.js') }}"></script>
  <script src="{{ asset('code/modules/export-data.js') }}"></script>
  <script src="{{ asset('code/modules/accessibility.js') }}"></script>


<script type="text/javascript">






$(document).ready(function(){















});

</script>




</head>

@section('content')



</div>


<br>
<br>
<br>
<br>
<br>



@if (auth()->user()->rol_id == 1)
<div class="main main-raised">
  <div class="container">




  <div class="limiter">
    <h2>ARCHIVOS</h2>

    
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column3"><b>Nombre</b></th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <a href="{{asset('iso/matriz/SFA-011 MATRIZ DE COMPETENCIAS.pdf')}}">SFA-011 MATRIZ DE COMPETENCIAS</a>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <a href="#">FODA ID</a>
                                </td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <ul>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-148 PROCESO.pdf')}}">SFG-148 PROCESO</a>
                                        </li>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-149 ANALISIS FODA ID.pdf')}}">SFG-149 ANALISIS FODA ID</a>
                                        </li>
                                    </ul>                                    
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            
                            
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <a href="#">SFA-147 ANÁLISIS DE RIESGO INNOVACIÓN Y DESARROLLO</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <ul>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-146 VARIABLES.pdf')}}">SFG-146 VARIABLES</a>
                                        </li>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-147 ANALISIS DE RIESGOS.pdf')}}">SFG-147 ANALISIS DE RIESGOS</a>
                                        </li>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/21 ANALISIS DE RIESGOS SS I+D3.pdf')}}">TABLA DE NIVELES</a>
                                        </li>
                                    </ul>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>


                               <tr class="row100 body">
                                <td class="cell100 column3">
                                    <a href="#">SFG-153 MATRIZ DE RIESGO I+D COVID19</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <ul>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-153 VARIABLE COVID.pdf')}}">SFG-153 VARIABLES COVID</a>
                                        </li>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/SFG-153 ANALISIS DE RIESGO COVID-19.pdf')}}">SFG-153 ANALISIS DE RIESGO COVID-19</a>
                                        </li>
                                        <li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{asset('iso/matriz/15 ANALISIS DE RIESGO COVID 19 I+D3.pdf')}}">TABLA DE NIVELES</a>
                                        </li>
                                    </ul>
                                    
                                </td>
                            </tr>
                            
                            <!-- <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr> -->
<!-- 
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                    <a href="{{asset('iso/matriz/21 ANALISIS DE RIESGOS SS I+D.pdf')}}">21 ANALISIS DE RIESGOS SS I+D</a>
                                </td>
                            </tr> -->

                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                            <!-- <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SFA-027 DESC TECNICA DE OBJETOS DEL SISTEMA.pdf')}}">SFA-027 DESC TECNICA DE OBJETOS DEL SISTEMA</a>
                                </td>
                            </tr> -->

                            <!-- <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr> -->

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-004 GERENCIA I+D.pdf')}}">SMS-004 GERENCIA I+D</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-028 ANALISTA PROGRAMADOR I+D.pdf')}}">SMS-028 ANALISTA PROGRAMADOR I+D</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-048 ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS.pdf')}}">SMS-048 ARQUITECTO DE SOLUCIONES</a>
                                </td>
                            </tr>
                          
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-058 COORDINADOR APIS I+D.pdf')}}">SMS-058 COORDINADOR APIS I+D</a>
                                </td>
                            </tr>

                                                        
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-059 COORDINADOR DE PROCESOS I+D.pdf')}}">SMS-059 COORDINADOR DE PROCESOS I+D</a>
                                </td>
                            </tr>  
                            
                            <!-- <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SMS-048 ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS.pdf')}}">SMS-048 ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS</a>
                                </td>
                            </tr> -->

                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-008 CREACION DE OBJETOS AL SISTEMA.pdf')}}">SPA-008 CREACION DE OBJETOS AL SISTEMA</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-009 MODIFICACIONES A OBJ DEL SISTEMA.pdf')}}">SPA-009 MODIFICACIONES A OBJ DEL SISTEMA</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-010 PROC CAMBIOS A DATOS DE LOS SISTEMAS.pdf')}}">SPA-010 PROC CAMBIOS A DATOS DE LOS SISTEMAS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-013 PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS.pdf')}}">SPA-013 PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-021 POLITICA SEGURIDAD INF.pdf')}}">SPA-021 POLITICA SEGURIDAD INF</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-024 Politica de cambio de claves de acceso.pdf')}}">SPA-024 POLITICA DE CAMBIO DE CLAVES DE ACCESO</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-025 POLITICA DE CAMBIOS EN APLICACIONES.pdf')}}">SPA-025 POLITICA DE CAMBIOS EN APLICACIONES</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-031 INSTALACION DE SOFTWARE Y APLICACIONES.pdf')}}">SPA-031 INSTALACION DE SOFTWARE Y APLICACIONES</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-055 PROCED HABILIT Y DESHAB BASE DE DATOS.pdf')}}">SPA-055 PROCED HABILIT Y DESHAB BASE DE DATOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-062 CORRECCIONES EMERGENTES DE LA OPERACION.pdf')}}">SPA-062 CORRECCIONES EMERGENTES DE LA OPERACION</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-070 METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES.pdf')}}">SPA-070 METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-073 ANALISIS TECNICO DE PROCESOS INFORMATICOS.pdf')}}">SPA-073 ANALISIS TECNICO DE PROCESOS INFORMATICOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-104 PROCESO DE VOLCADO DE DATOS A VMT.pdf')}}">SPA-104 PROCESO DE VOLCADO DE DATOS A VMT</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-105 INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS.pdf')}}">SPA-105 INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-106 ESTANDARES DE PROGRAMACION.pdf')}}">SPA-106 ESTANDARES DE PROGRAMACION</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-121 MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D.pdf')}}">SPA-121 MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-146 PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG.pdf')}}">SPA-146 PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-150 POLITICA DE BASE DE DATOS.pdf')}}">SPA-150 POLITICA DE BASE DE DATOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-152 PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS.pdf')}}">SPA-152 PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-154 REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS.pdf')}}">SPA-154 REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-158 ESTANDARD DE MANEJO DE IMAGENES.pdf')}}">SPA-158 ESTANDARD DE MANEJO DE IMAGENES</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-160 GENERACION DE ARCHIVOS PARA PNC.pdf')}}">SPA-160 GENERACION DE ARCHIVOS PARA PNC</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPA-161 CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D.pdf')}}">SPA-161 CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SPG-022 SOLICITUD DE INFORMACION CLASIFICADA.pdf')}}">SPG-022 SOLICITUD DE INFORMACION CLASIFICADA</a>
                                </td>
                            </tr>
                            <tr class="row100 body">
                                <td class="cell100 column3">
                                <a href="{{asset('iso/matriz/SSO-032 PROTOCOLO PREVENCION I+D.pdf')}}">SSO-032 PROTOCOLO PREVENCION I+D</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</div>










  </div>
</div>


@endif








@include('includes.footer')

@endsection

<!-- <section class="chat-container">
  <div class="chat-button">
    Chat de facebook
  </div>
  <div class="chat-content">
    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FVenta-de-productos-y-servicios-varios-108862064177201%2F&tabs=messages&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=1098417433874797"
      width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media">
    </iframe>
  </div>
</section> -->