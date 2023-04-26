@extends('layouts.panel')

@section('title', 'Sistema de Seguimiento de Proyectos')

<head>
    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
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

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
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
        $(document).ready(function() {















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


                                        @if (auth()->user()->rol_id == 1)
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a href="{{ asset('iso/matriz/SFA-011 MATRIZ DE COMPETENCIAS.pdf') }}">SFA-011
                                                    MATRIZ DE COMPETENCIAS</a>
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
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ asset('iso/matriz/SFG-148 PROCESO.pdf') }}">SFG-148
                                                            PROCESO</a>
                                                    </li>

                                                    <li>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ asset('iso/formatos/ESA-SGC-P5-F4-FODA+ANALISIS DE RIESGO DE INNOVACION Y DESARROLLO.xlsx') }}">ESA-SGC-P5-F4-FODA+ANALISIS
                                                            DE RIESGO DE INNOVACION Y DESARROLLO</a>
                                                    </li>

                                                    <!--  <li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ asset('iso/matriz/SFG-149 ANALISIS FODA ID.pdf') }}">SFG-149 ANALISIS FODA ID</a>
                                            </li>-->
                                                </ul>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>


                                        <!--   <tr class="row100 body">
                                    <td class="cell100 column3">
                                        <a href="#">SFA-147 ANÁLISIS DE RIESGO INNOVACIÓN Y DESARROLLO</a>
                                    </td>
                                </tr>
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                        <ul>
                                            <li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ asset('iso/matriz/SFG-146 VARIABLES.pdf') }}">SFG-146 VARIABLES</a>
                                            </li>
                                            <li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ asset('iso/matriz/SFG-147 ANALISIS DE RIESGOS.pdf') }}">SFG-147 ANALISIS DE RIESGOS</a>
                                            </li>
                                            <li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ asset('iso/matriz/21 ANALISIS DE RIESGOS SS I+D3.pdf') }}">TABLA DE NIVELES</a>
                                            </li>
                                        </ul>

                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <hr>
                                    </td>
                                </tr>


                            -->



                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a href="#">SFG-153 MATRIZ DE RIESGO I+D COVID19</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <ul>
                                                    <li>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ asset('iso/matriz/SFG-153 VARIABLE COVID.pdf') }}">SFG-153
                                                            VARIABLES COVID</a>
                                                    </li>
                                                    <li>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ asset('iso/matriz/SFG-153 ANALISIS DE RIESGO COVID-19.pdf') }}">SFG-153
                                                            ANALISIS DE RIESGO COVID-19</a>
                                                    </li>
                                                    <li>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{ asset('iso/matriz/15 ANALISIS DE RIESGO COVID 19 I+D3.pdf') }}">TABLA
                                                            DE NIVELES</a>
                                                    </li>
                                                </ul>

                                            </td>
                                        </tr>



                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>



                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SMS-004 GERENCIA I+D.pdf') }}">SMS-004 GERENCIA I+D</a>
                                    </td>
                                </tr>-->

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/28 ESA-DH-P3-F1 Perfil Gerencia Investigacion y Desarrollo.docx') }}">ESA-DH-P3-F1
                                                    PERFIL GERENCIA INVESTIGACIÓN Y DESARROLLO </a>
                                            </td>
                                        </tr>
                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/procedimientos/24 ESA-DH-P3-F1 Perfil Analista programador.docx') }}">ESA-DH-P3-F1 PERFIL ANALISTA PROGRAMADOR</a>
                                    </td>
                                </tr>-->

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/1. ESA-DH-P3-F1 Analista-Desarrollador Backend Senior de Sistemas.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-DESARROLLADOR BACKEND SENIOR DE SISTEMAS</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/2. ESA-DH-P3-F1 Analista-Desarrollador Backend Junior de Sistemas.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-DESARROLLADOR BACKEND JUNIOR DE SISTEMAS</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/3. ESA-DH-P3-F1 Analista-Desarrollador Web Frontend Senior.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-DESARROLLADOR WEB FRONTEND SENIOR</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/4. ESA-DH-P3-F1 Analista-Desarrollador Web Frontend Junior.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-DESARROLLADOR WEB FRONTEND JUNIOR</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/5. ESA-DH-P3-F1 Analista-Desarrollador Web Full Stack.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-DESARROLLADOR WEB FULL STACK</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/6. ESA-DH-P3-F1 Analista-Programador de Sistemas.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-PROGRAMADOR DE SISTEMAS</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/7. ESA-DH-P3-F1 Analista-Programador de Sistemas-Nuevas Tecnologías.docx') }}">ESA-DH-P3-F1
                                                    ANALISTA-PROGRAMADOR DE SISTEMAS-NUEVAS TECNOLOGÍAS</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/8. ESA-DH-P3-F1 DBA-Administrador de base de datos.docx') }}">ESA-DH-P3-F1
                                                    DBA-ADMINISTRADOR DE BASE DE DATOS</a>
                                            </td>
                                        </tr>



                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/25 ESA-DH-P3-F1 Perfil Arquitecto Senior de proyectos y sistemas.docx') }}">ESA-DH-P3-F1
                                                    PERFIL ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS</a>
                                            </td>
                                        </tr>

                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SMS-028 ANALISTA PROGRAMADOR I+D.pdf') }}">SMS-028 ANALISTA PROGRAMADOR I+D</a>
                                    </td>
                                </tr>
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SMS-048 ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS.pdf') }}">SMS-048 ARQUITECTO DE SOLUCIONES</a>
                                    </td>
                                </tr>-->

                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SMS-058 COORDINADOR APIS I+D.pdf') }}">SMS-058 COORDINADOR APIS I+D</a>
                                    </td>
                                </tr>

                              <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SMS-059 COORDINADOR DE PROCESOS I+D.pdf') }}">SMS-059 COORDINADOR DE PROCESOS I+D</a>
                                    </td>
                                </tr>
                            -->


                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/26 ESA-DH-P3-F1 Perfil Coordinador APIS de innovacion y desarrollo.docx') }}">ESA-DH-P3-F1
                                                    PERFIL COORDINADOR APIS DE INNOVACIÓN Y DESARROLLO</a>
                                            </td>
                                        </tr>

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/27 ESA-DH-P3-F1 Perfil Coordinador de Procesos de Innovacion y Desarrollo de Sistemas.docx') }}">ESA-DH-P3-F1
                                                    PERFIL COORDINADOR DE PROCESOS DE INNOVACIÓN Y DESARROLLO DE
                                                    SISTEMAS</a>
                                            </td>
                                        </tr>

                                        @endif

                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>

                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-008 CREACION DE OBJETOS AL SISTEMA.pdf') }}">SPA-008 CREACION DE OBJETOS AL SISTEMA</a>
                                    </td>
                                </tr>
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/formatos/SPA-009 MODIFICACIONES A OBJ DEL SISTEMA.pdf') }}">SPA-009 MODIFICACIONES A OBJ DEL SISTEMA</a>
                                    </td>
                                </tr> -->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/1 ESA-ID-P1 Creación-Modificación de objetos en Sistema Informático.docx') }}">
                                                    ESA-ID-P1 CREACIÓN-MODIFICACIÓN DE OBJETOS EN SISTEMA INFORMÁTICO</a>
                                            </td>
                                        </tr>

                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-010 PROC CAMBIOS A DATOS DE LOS SISTEMAS.pdf') }}">SPA-010 PROC CAMBIOS A DATOS DE LOS SISTEMAS</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/9 ESA-ID-P9 Cambios a datos en los sistemas.docx') }}">ESA-ID-P9
                                                    CAMBIOS A DATOS EN LOS SISTEMAS</a>
                                            </td>
                                        </tr>

                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-013 PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS.pdf') }}">SPA-013 PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS</a>
                                    </td>
                                </tr>
                            -->

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/11 ESA-ID-P11 Creación y administración de usuarios con acceso a la base de datos.docx') }}">ESA-ID-P11
                                                    CREACIÓN Y ADMINISTRACIÓN DE USUARIOS CON ACCESO A LA BASE DE DATOS</a>
                                            </td>
                                        </tr>

                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-021 POLITICA SEGURIDAD INF.pdf') }}">SPA-021 POLITICA SEGURIDAD INF</a>
                                    </td>
                                </tr>-->

                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-024 Politica de cambio de claves de acceso.pdf') }}">SPA-024 POLITICA DE CAMBIO DE CLAVES DE ACCESO</a>
                                    </td>
                                </tr>
                              </tr>
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-025 POLITICA DE CAMBIOS EN APLICACIONES.pdf') }}">SPA-025 POLITICA DE CAMBIOS EN APLICACIONES</a>
                                    </td>
                                </tr>

                            -->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/6 ESA-ID-P6 Política de cambios de claves de acceso.docx') }}">ESA-ID-P6
                                                    POLITICA DE CAMBIO DE CLAVES DE ACCESO</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/7 ESA-ID-P7 Política de cambios en las aplicaciones.pdf') }}">ESA-ID-P7
                                                    POLITICA DE CAMBIOS EN APLICACIONES</a>
                                            </td>
                                        </tr>
                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-031 INSTALACION DE SOFTWARE Y APLICACIONES.pdf') }}">SPA-031 INSTALACION DE SOFTWARE Y APLICACIONES</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/10 ESA-ID-P10 Instalación y desinstalación de aplicaciones.docx') }}">ESA-ID-P10
                                                    INSTALACIÓN Y DESINSTALACIÓN DE APLICACIONES</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/19 ESA-ID-P19 Habilitación y deshabilitación de la base de datos.docx') }}">ESA-ID-P19
                                                    HABILITACIÓN Y DES HABILITACIÓN DE LA BASE DE DATOS</a>
                                            </td>
                                        </tr>
                                        <!--
                                     <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-055 PROCED HABILIT Y DESHAB BASE DE DATOS.pdf') }}">SPA-055 PROCED HABILIT Y DESHAB BASE DE DATOS</a>
                                    </td>
                                </tr>
                                    <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-062 CORRECCIONES EMERGENTES DE LA OPERACION.pdf') }}">SPA-062 CORRECCIONES EMERGENTES DE LA OPERACION</a>
                                    </td>
                                </tr>

                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-070 METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES.pdf') }}">SPA-070 METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES</a>
                                    </td>
                                </tr>
                            -->

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/4 ESA-ID-P4 Correcciones emergentes de la operación.docx') }}">ESA-ID-P4
                                                    CORRECCIONES EMERGENTES DE LA OPERACIÓN</a>
                                            </td>
                                        </tr>

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/3 ESA-ID-P3 Metodología de trabajo para analistas-programadores de Sistemas Informáticos.docx') }}">ESA-ID-P3
                                                    METODOLOGÍA DE TRABAJO PARA ANALISTAS-PROGRAMADORES DE SISTEMAS
                                                    INFORMÁTICOS</a>
                                            </td>
                                        </tr>


                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-073 ANALISIS TECNICO DE PROCESOS INFORMATICOS.pdf') }}">SPA-073 ANALISIS TECNICO DE PROCESOS INFORMATICOS</a>
                                    </td>
                                </tr>-->




                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/ESA-ID-P12 Solicitud de información clasificada.docx') }}">ESA-ID-P12
                                                    SOLICITUD DE INFORMACIÓN CLASIFICADA</a>
                                            </td>
                                        </tr>

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/ESA-ID-P17 Planificacion de desarrollos de aplicaciones.docx') }}">ESA-ID-P17
                                                    PLANIFICACION DE DESARROLLOS DE APLICACIONES</a>
                                            </td>
                                        </tr>

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/ESA-IT-P1 Política de seguridad de informática.docx') }}">ESA-IT-P1
                                                    POLÍTICA DE SEGURIDAD DE INFORMÁTICA</a>
                                            </td>
                                        </tr>












                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/21 ESA-ID-P21 Proceso de volcado de datos a VMT.docx') }}">ESA-ID-P21
                                                    PROCESO DE VOLCADO DE DATOS A VMT</a>
                                            </td>
                                        </tr>

                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-104 PROCESO DE VOLCADO DE DATOS A VMT.pdf') }}">SPA-104 PROCESO DE VOLCADO DE DATOS A VMT</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/8 ESA-ID-P8 Incorporación de nuevas marcas y modelos a programas en operación.docx') }}">ESA-ID-P8
                                                    INCORPORACIÓN DE NUEVAS MARCAS Y MODELOS A PROGRAMAS EN OPERACIÓN</a>
                                            </td>
                                        </tr>
                                        <!--  <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-105 INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS.pdf') }}">SPA-105 INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS</a>
                                    </td>
                                </tr>
                              <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-106 ESTANDARES DE PROGRAMACION.pdf') }}">SPA-106 ESTANDARES DE PROGRAMACION</a>
                                    </td>
                                </tr>-->

                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/5 ESA-ID-P5 Estandares de programacion.docx') }}">ESA-ID-P5
                                                    ESTANDARES DE PROGRAMACION</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/22 ESA-ID-P22 Manual de seguridad y prevencion de riesgos en ID.docx') }}">ESA-ID-P22
                                                    MANUAL DE SEGURIDAD Y PREVENCIÓN DE RIESGOS EN ID</a>
                                            </td>
                                        </tr>


                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-121 MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D.pdf') }}">SPA-121 MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/20 ESA-ID-P20 Procesos, servicios y pruebas sobre Dermalog.docx') }}">ESA-ID-P20
                                                    PROCESOS, SERVICIOS Y PRUEBAS SOBRE DERMALOG</a>
                                            </td>
                                        </tr>
                                        <!--
                                     <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-146 PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG.pdf') }}">SPA-146 PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG</a>
                                    </td>
                                </tr>
                                    <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-150 POLITICA DE BASE DE DATOS.pdf') }}">SPA-150 POLITICA DE BASE DE DATOS</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/13 ESA-ID-P13 Política de base de datos.docx') }}">ESA-ID-P13
                                                    POLITICA DE BASE DE DATOS</a>
                                            </td>
                                        </tr>
                                        <!-- <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-152 PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS.pdf') }}">SPA-152 PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/14 ESA-ID-P14 Cambio en catálogo en la base de datos.docx') }}">ESA-ID-P14
                                                    CAMBIO EN CATÁLOGO EN LA BASE DE DATOS</a>
                                            </td>
                                        </tr>
                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-154 REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS.pdf') }}">SPA-154 REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS</a>
                                    </td>
                                </tr>-->


                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/18 ESA-ID-P18 Registro de procesos automaticos en bases de datos.docx') }}">ESA-ID-P18
                                                    REGISTRO DE PROCESOS AUTOMÁTICOS EN BASES DE DATOS</a>
                                            </td>
                                        </tr>

                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-158 ESTANDARD DE MANEJO DE IMAGENES.pdf') }}">SPA-158 ESTANDARD DE MANEJO DE IMAGENES</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/15 ESA-ID-P15 Estándar de manejo de imágenes.docx') }}">ESA-ID-P15
                                                    ESTÁNDAR DE MANEJO DE IMÁGENES</a>
                                            </td>
                                        </tr>
                                        <!--<tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-160 GENERACION DE ARCHIVOS PARA PNC.pdf') }}">SPA-160 GENERACION DE ARCHIVOS PARA PNC</a>
                                    </td>
                                </tr>-->
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/16 ESA-ID-P16 Generación de archivo para la PNC.docx') }}">ESA-ID-P16
                                                    GENERACIÓN DE ARCHIVO PARA LA PNC</a>
                                            </td>
                                        </tr>
                                        <tr class="row100 body">
                                            <td class="cell100 column3">
                                                <a
                                                    href="{{ asset('iso/procedimientos/17 ESA-ID-P17 Planificacion de desarrollos de aplicaciones.docx') }}">ESA-ID-P17
                                                    PLANIFICACIÓN DE DESARROLLOS DE APLICACIONES</a>
                                            </td>
                                        </tr>
                                        <!--
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPA-161 CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D.pdf') }}">SPA-161 CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D</a>
                                    </td>
                                </tr>-->




                                        <tr>
                                            <td>
                                                <hr>
                                            </td>
                                        </tr>

                                        <!--
                                <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SPG-022 SOLICITUD DE INFORMACION CLASIFICADA.pdf') }}">SPG-022 SOLICITUD DE INFORMACION CLASIFICADA</a>
                                    </td>
                                </tr>
                               <tr class="row100 body">
                                    <td class="cell100 column3">
                                    <a href="{{ asset('iso/matriz/SSO-032 PROTOCOLO PREVENCION I+D.pdf') }}">SSO-032 PROTOCOLO PREVENCION I+D</a>
                                    </td>
                                </tr>-->
                                @if (auth()->user()->rol_id == 1)
                                    <tr class="row100 body">
                                        <td class="cell100 column3">
                                            <a
                                                href="{{ asset('iso/procedimientos/23 ESA-ID-P23 Protocolo de prevencion Covid-19 para I+D.docx') }}">ESA-ID-P23
                                                PROTOCOLO DE PREVENCIÓN COVID-19 PARA I+D</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <hr>
                                        </td>
                                    </tr>
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>










            </div>
        </div>









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
