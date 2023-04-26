@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">



    @if (auth()->user()->rol_id == 1)
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold "></h6>
            </div>
            <div class="card-body">
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFA-011 MATRIZ DE COMPETENCIAS.pdf') }}">SFA-011
                                        MATRIZ DE COMPETENCIAS</a></strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold ">FODA ID</h6>
            </div>
            <div class="card-body">
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a href="{{ asset('iso/matriz/SFG-148 PROCESO.pdf') }}">SFG-148
                                        PROCESO</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->

                <div class="timeline-item ti-info ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/formatos/ESA-SGC-P5-F4-FODA+ANALISIS DE RIESGO DE INNOVACION Y DESARROLLO.xlsx') }}">ESA-SGC-P5-F4-FODA+ANALISIS
                                        DE RIESGO DE INNOVACION Y DESARROLLO</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold ">SFG-153 MATRIZ DE RIESGO I+D COVID19</h6>
            </div>
            <div class="card-body">
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFG-153 VARIABLE COVID.pdf') }}">SFG-153
                                        VARIABLES COVID</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFG-153 ANALISIS DE RIESGO COVID-19.pdf') }}">SFG-153
                                        ANALISIS DE RIESGO COVID-19</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->


                <div class="timeline-item ti-warning ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/15 ANALISIS DE RIESGO COVID 19 I+D3.pdf') }}">TABLA
                                        DE NIVELES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold "></h6>
            </div>
            <div class="card-body">
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/28 ESA-DH-P3-F1 Perfil Gerencia Investigacion y Desarrollo.docx') }}">ESA-DH-P3-F1
                                        PERFIL GERENCIA INVESTIGACIÓN Y DESARROLLO </a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/1. ESA-DH-P3-F1 Analista-Desarrollador Backend Senior de Sistemas.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-DESARROLLADOR BACKEND SENIOR DE SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/procedimientos/2. ESA-DH-P3-F1 Analista-Desarrollador Backend Junior de Sistemas.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-DESARROLLADOR BACKEND JUNIOR DE SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/procedimientos/3. ESA-DH-P3-F1 Analista-Desarrollador Web Frontend Senior.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-DESARROLLADOR WEB FRONTEND SENIOR</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/procedimientos/4. ESA-DH-P3-F1 Analista-Desarrollador Web Frontend Junior.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-DESARROLLADOR WEB FRONTEND JUNIOR</a></strong></div>
                        </div>
                    </div>
                </div>


                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/procedimientos/5. ESA-DH-P3-F1 Analista-Desarrollador Web Full Stack.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-DESARROLLADOR WEB FULL STACK</a></strong></div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/6. ESA-DH-P3-F1 Analista-Programador de Sistemas.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-PROGRAMADOR DE SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/7. ESA-DH-P3-F1 Analista-Programador de Sistemas-Nuevas Tecnologías.docx') }}">ESA-DH-P3-F1
                                        ANALISTA-PROGRAMADOR DE SISTEMAS-NUEVAS TECNOLOGÍAS</a></strong></div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/8. ESA-DH-P3-F1 DBA-Administrador de base de datos.docx') }}">ESA-DH-P3-F1
                                        DBA-ADMINISTRADOR DE BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>


                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/25 ESA-DH-P3-F1 Perfil Arquitecto Senior de proyectos y sistemas.docx') }}">ESA-DH-P3-F1
                                        PERFIL ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/26 ESA-DH-P3-F1 Perfil Coordinador APIS de innovacion y desarrollo.docx') }}">ESA-DH-P3-F1
                                        PERFIL COORDINADOR APIS DE INNOVACIÓN Y DESARROLLO</a></strong></div>
                        </div>
                    </div>
                </div>


                <div class="timeline-item ti-info ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/27 ESA-DH-P3-F1 Perfil Coordinador de Procesos de Innovacion y Desarrollo de Sistemas.docx') }}">ESA-DH-P3-F1
                                        PERFIL COORDINADOR DE PROCESOS DE INNOVACIÓN Y DESARROLLO DE
                                        SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
            </div>
        </div>
@endif
        <br>
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold "></h6>
            </div>
            <div class="card-body">

                @if (auth()->user()->rol_id == 1)
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/1 ESA-ID-P1 Creación-Modificación de objetos en Sistema Informático.docx') }}">
                                        ESA-ID-P1 CREACIÓN-MODIFICACIÓN DE OBJETOS EN SISTEMA INFORMÁTICO</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/procedimientos/9 ESA-ID-P9 Cambios a datos en los sistemas.docx') }}">ESA-ID-P9
                                        CAMBIOS A DATOS EN LOS SISTEMAS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->






                @endif


                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/11 ESA-ID-P11 Creación y administración de usuarios con acceso a la base de datos.docx') }}">ESA-ID-P11
                                        CREACIÓN Y ADMINISTRACIÓN DE USUARIOS CON ACCESO A LA BASE DE DATOS</a></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/6 ESA-ID-P6 Política de cambios de claves de acceso.docx') }}">ESA-ID-P6
                                        POLITICA DE CAMBIO DE CLAVES DE ACCESO</a></strong></div>
                        </div>
                    </div>
                </div>




                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/7 ESA-ID-P7 Política de cambios en las aplicaciones.pdf') }}">ESA-ID-P7
                                        POLITICA DE CAMBIOS EN APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/procedimientos/10 ESA-ID-P10 Instalación y desinstalación de aplicaciones.docx') }}">ESA-ID-P10
                                        INSTALACIÓN Y DESINSTALACIÓN DE APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/19 ESA-ID-P19 Habilitación y deshabilitación de la base de datos.docx') }}">ESA-ID-P19
                                HABILITACIÓN Y DES HABILITACIÓN DE LA BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>  <a
                                href="{{ asset('iso/procedimientos/4 ESA-ID-P4 Correcciones emergentes de la operación.docx') }}">ESA-ID-P4
                                CORRECCIONES EMERGENTES DE LA OPERACIÓN</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/3 ESA-ID-P3 Metodología de trabajo para analistas-programadores de Sistemas Informáticos.docx') }}">ESA-ID-P3
                                METODOLOGÍA DE TRABAJO PARA ANALISTAS-PROGRAMADORES DE SISTEMAS
                                INFORMÁTICOS</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/ESA-ID-P12 Solicitud de información clasificada.docx') }}">ESA-ID-P12
                                SOLICITUD DE INFORMACIÓN CLASIFICADA</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>  <a
                                href="{{ asset('iso/procedimientos/ESA-ID-P17 Planificacion de desarrollos de aplicaciones.docx') }}">ESA-ID-P17
                                PLANIFICACION DE DESARROLLOS DE APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/ESA-IT-P1 Política de seguridad de informática.docx') }}">ESA-IT-P1
                                POLÍTICA DE SEGURIDAD DE INFORMÁTICA</a></strong></div>
                        </div>
                    </div>
                </div>



                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/21 ESA-ID-P21 Proceso de volcado de datos a VMT.docx') }}">ESA-ID-P21
                                PROCESO DE VOLCADO DE DATOS A VMT</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>  <a
                                href="{{ asset('iso/procedimientos/8 ESA-ID-P8 Incorporación de nuevas marcas y modelos a programas en operación.docx') }}">ESA-ID-P8
                                INCORPORACIÓN DE NUEVAS MARCAS Y MODELOS A PROGRAMAS EN OPERACIÓN</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/5 ESA-ID-P5 Estandares de programacion.docx') }}">ESA-ID-P5
                                ESTANDARES DE PROGRAMACION</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/22 ESA-ID-P22 Manual de seguridad y prevencion de riesgos en ID.docx') }}">ESA-ID-P22
                                MANUAL DE SEGURIDAD Y PREVENCIÓN DE RIESGOS EN ID</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong>  <a
                                href="{{ asset('iso/procedimientos/20 ESA-ID-P20 Procesos, servicios y pruebas sobre Dermalog.docx') }}">ESA-ID-P20
                                PROCESOS, SERVICIOS Y PRUEBAS SOBRE DERMALOG</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/13 ESA-ID-P13 Política de base de datos.docx') }}">ESA-ID-P13
                                POLITICA DE BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/14 ESA-ID-P14 Cambio en catálogo en la base de datos.docx') }}">ESA-ID-P14
                                CAMBIO EN CATÁLOGO EN LA BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/18 ESA-ID-P18 Registro de procesos automaticos en bases de datos.docx') }}">ESA-ID-P18
                                REGISTRO DE PROCESOS AUTOMÁTICOS EN BASES DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/15 ESA-ID-P15 Estándar de manejo de imágenes.docx') }}">ESA-ID-P15
                                ESTÁNDAR DE MANEJO DE IMÁGENES</a></strong></div>
                        </div>
                    </div>
                </div>


                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/16 ESA-ID-P16 Generación de archivo para la PNC.docx') }}">ESA-ID-P16
                                GENERACIÓN DE ARCHIVO PARA LA PNC</a></strong></div>
                        </div>
                    </div>
                </div>




                <div class="timeline-item ti-info ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                href="{{ asset('iso/procedimientos/17 ESA-ID-P17 Planificacion de desarrollos de aplicaciones.docx') }}">ESA-ID-P17
                                PLANIFICACIÓN DE DESARROLLOS DE APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
            </div>
        </div>




        <br>
        @if (auth()->user()->rol_id == 1)
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold "></h6>
            </div>
            <div class="card-body">


                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i  class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                href="{{ asset('iso/procedimientos/23 ESA-ID-P23 Protocolo de prevencion Covid-19 para I+D.docx') }}">ESA-ID-P23
                                PROTOCOLO DE PREVENCIÓN COVID-19 PARA I+D</a></strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <br>

        @endif




    </div>


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>
@endsection
