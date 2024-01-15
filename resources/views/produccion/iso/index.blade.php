@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">


        @foreach ($documentos_titulo as $titulo)
            <div class="card">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="mb-0 fw-bold ">{{ $titulo->nombre != 'NO APLICA' ? $titulo->nombre : '' }}</h6>
                        </div>

                        <div class="col-6" style="text-align: right;">
                            @if (auth()->user()->modificar_documentos == true)
                                <button class="btn btn-primary float-right" data-bs-toggle="modal"
                                    data-bs-target="#modal-create-{{ $titulo->id }}">+ Agregar</button>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @foreach ($titulo->documentos->where('activo', '=', 1) as $documento)
                        @php($color = rand(0, 6))

                        <div class="timeline-item ti-danger border-bottom ms-2">
                            <div class="row col-12">
                                <div class="d-flex col-6">
                                    <!-- Primer botón -->
                                    <span
                                        class="avatar d-flex justify-content-center align-items-center rounded-circle {{$colores[$color]}}">
                                        <i class="icofont-check fa-lg"></i>
                                    </span>

                                    <!-- Información del documento -->
                                    <div class="flex-fill ms-3">
                                        <div class="mb-1">
                                            <strong>
                                                <a target="_blank"
                                                    href="{{ asset('iso') }}/{{ $documento->ruta }}">{{ $documento->nombre }}</a>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" style="text-align: right;">
                                    @if (auth()->user()->modificar_documentos == true)
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modal-{{ $documento->id }}">
                                            <i class="fa fa-pencil fa-2x"></i>
                                        </button>
                                        &nbsp;&nbsp;
                                        <button data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $documento->id }}"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash fa-2x"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('produccion.iso.modal')
                        @include('produccion.iso.modal_delete')
                    @endforeach
                </div>
            </div>
            @include('produccion.iso.modal_create')
            <br>
        @endforeach



        {{-- <div class="card">
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
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SFA-011 MATRIZ DE COMPETENCIAS.pdf') }}">SFA-011 MATRIZ
                                        DE COMPETENCIAS</a></strong></div>
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
                                        href="{{ asset('iso/matriz/SFG-149 ANALISIS FODA ID.pdf') }}">SFG-149 ANALISIS FODA
                                        ID</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-bold ">SFA-147 ANÁLISIS DE RIESGO INNOVACIÓN Y DESARROLLO</h6>
            </div>
            <div class="card-body">
                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a href="{{ asset('iso/matriz/SFG-146 VARIABLES.pdf') }}">SFG-146
                                        VARIABLES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFG-147 ANALISIS DE RIESGOS.pdf') }}">SFG-147 ANALISIS
                                        DE
                                        RIESGOS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->


                <div class="timeline-item ti-warning ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/21 ANALISIS DE RIESGOS SS I+D3.pdf') }}">TABLA DE
                                        NIVELES</a></strong></div>
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
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFG-153 VARIABLE COVID.pdf') }}">SFG-153 VARIABLES
                                        COVID</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SFG-153 ANALISIS DE RIESGO COVID-19.pdf') }}">SFG-153
                                        ANALISIS DE RIESGO COVID-19</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->


                <div class="timeline-item ti-warning ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/15 ANALISIS DE RIESGO COVID 19 I+D3.pdf') }}">TABLA DE
                                        NIVELES</a></strong></div>
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
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SMS-004 GERENCIA I+D.pdf') }}">SMS-004 GERENCIA
                                        I+D</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SMS-028 ANALISTA PROGRAMADOR I+D.pdf') }}">SMS-028
                                        ANALISTA PROGRAMADOR I+D</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SMS-048 ARQUITECTO SENIOR DE PROYECTOS Y SISTEMAS.pdf') }}">SMS-048
                                        ARQUITECTO DE SOLUCIONES</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SMS-058 COORDINADOR APIS I+D.pdf') }}">SMS-058
                                        COORDINADOR APIS I+D</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SMS-059 COORDINADOR DE PROCESOS I+D.pdf') }}">SMS-059
                                        COORDINADOR DE PROCESOS I+D</a></strong></div>
                        </div>
                    </div>
                </div>



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
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-008 CREACION DE OBJETOS AL SISTEMA.pdf') }}">SPA-008
                                        CREACION DE OBJETOS AL SISTEMA</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-009 MODIFICACIONES A OBJ DEL SISTEMA.pdf') }}">SPA-009
                                        MODIFICACIONES A OBJ DEL SISTEMA</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->




                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-010 PROC CAMBIOS A DATOS DE LOS SISTEMAS.pdf') }}">SPA-010
                                        PROC CAMBIOS A DATOS DE LOS SISTEMAS</a></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-013 PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS.pdf') }}">SPA-013
                                        PROCED CREACION Y ADMON DE USUARIOS DE BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>




                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-021 POLITICA SEGURIDAD INF.pdf') }}">SPA-021
                                        POLITICA SEGURIDAD INF</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-024 Politica de cambio de claves de acceso.pdf') }}">SPA-024
                                        POLITICA DE CAMBIO DE CLAVES DE ACCESO</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-025 POLITICA DE CAMBIOS EN APLICACIONES.pdf') }}">SPA-025
                                        POLITICA DE CAMBIOS EN APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-031 INSTALACION DE SOFTWARE Y APLICACIONES.pdf') }}">SPA-031
                                        INSTALACION DE SOFTWARE Y APLICACIONES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-055 PROCED HABILIT Y DESHAB BASE DE DATOS.pdf') }}">SPA-055
                                        PROCED HABILIT Y DESHAB BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-062 CORRECCIONES EMERGENTES DE LA OPERACION.pdf') }}">SPA-062
                                        CORRECCIONES EMERGENTES DE LA OPERACION</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-070 METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES.pdf') }}">SPA-070
                                        METODOLOGIA DE TRABAJO DE ANALISTAS PROGRAMADORES</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-073 ANALISIS TECNICO DE PROCESOS INFORMATICOS.pdf') }}">SPA-073
                                        ANALISIS TECNICO DE PROCESOS INFORMATICOS</a></strong></div>
                        </div>
                    </div>
                </div>



                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-104 PROCESO DE VOLCADO DE DATOS A VMT.pdf') }}">SPA-104
                                        PROCESO DE VOLCADO DE DATOS A VMT</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-105 INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS.pdf') }}">SPA-105
                                        INCORPORACION DE NUEVAS MARCAS Y MODELOS DE EQUIPOS A PROGRAMAS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-106 ESTANDARES DE PROGRAMACION.pdf') }}">SPA-106
                                        ESTANDARES DE PROGRAMACION</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-121 MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D.pdf') }}">SPA-121
                                        MEDIDAS DE SEGURIDAD Y PREVENCION DE RIESGOS I+D</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-146 PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG.pdf') }}">SPA-146
                                        PROCESOS SERVICIOS Y PRUEBAS EN DERMALOG</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-150 POLITICA DE BASE DE DATOS.pdf') }}">SPA-150
                                        POLITICA DE BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>





                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-152 PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS.pdf') }}">SPA-152
                                        PROC CAMBIOS EN CATALOGOS DE LAS BASES DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-154 REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS.pdf') }}">SPA-154
                                        REGISTRO DE PROCESOS AUTOMATICOS EN BASE DE DATOS</a></strong></div>
                        </div>
                    </div>
                </div> <!-- timeline item end  -->
                <div class="timeline-item ti-info border-bottom ms-2">
                    <div class="d-flex">
                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-warning"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-158 ESTANDARD DE MANEJO DE IMAGENES.pdf') }}">SPA-158
                                        ESTANDARD DE MANEJO DE IMAGENES</a></strong></div>
                        </div>
                    </div>
                </div>


                <div class="timeline-item ti-success  border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPA-160 GENERACION DE ARCHIVOS PARA PNC.pdf') }}">SPA-160
                                        GENERACION DE ARCHIVOS PARA PNC</a></strong></div>
                        </div>
                    </div>
                </div>




                <div class="timeline-item ti-info ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong><a
                                        href="{{ asset('iso/matriz/SPA-161 CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D.pdf') }}">SPA-161
                                        CONTROL DE TIEMPO DE RESOLUCION DE DESARROLLOS A I+D</a></strong></div>
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
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SPG-022 SOLICITUD DE INFORMACION CLASIFICADA.pdf') }}">SPG-022
                                        SOLICITUD DE INFORMACION CLASIFICADA</a></strong></div>
                        </div>
                    </div>
                </div>

                <div class="timeline-item ti-danger border-bottom ms-2">
                    <div class="d-flex">
                        <span
                            class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg"><i
                                class="icofont-check fa-lg"></i></span>
                        <div class="flex-fill ms-3">
                            <div class="mb-1"><strong> <a
                                        href="{{ asset('iso/matriz/SSO-032 PROTOCOLO PREVENCION I+D.pdf') }}">SSO-032
                                        PROTOCOLO PREVENCION I+D</a></strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <br>
--}}





    </div>


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>
@endsection
