@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')


    <?php
    
    $cantidad_codigo_3_1 = 0;
    $cantidad_codigo_3_2 = 0;
    $cantidad_codigo_3_3 = 0;
    $cantidad_codigo_3_4 = 0;
    $cantidad_codigo_3_5 = 0;
    $cantidad_codigo_3_6 = 0;
    $cantidad_codigo_3_7 = 0;
    $cantidad_codigo_3_8 = 0;
    $cantidad_codigo_3_9 = 0;
    $cantidad_codigo_3_10 = 0;
    $cantidad_codigo_3_11 = 0;
    $cantidad_codigo_3_12 = 0;
    
    $cantidad_codigo_8_1 = 0;
    $cantidad_codigo_8_2 = 0;
    $cantidad_codigo_8_3 = 0;
    $cantidad_codigo_8_4 = 0;
    $cantidad_codigo_8_5 = 0;
    $cantidad_codigo_8_6 = 0;
    $cantidad_codigo_8_7 = 0;
    $cantidad_codigo_8_8 = 0;
    $cantidad_codigo_8_9 = 0;
    $cantidad_codigo_8_10 = 0;
    $cantidad_codigo_8_11 = 0;
    $cantidad_codigo_8_12 = 0;
    
    $cantidad_codigo_9_1 = 0;
    $cantidad_codigo_9_2 = 0;
    $cantidad_codigo_9_3 = 0;
    $cantidad_codigo_9_4 = 0;
    $cantidad_codigo_9_5 = 0;
    $cantidad_codigo_9_6 = 0;
    $cantidad_codigo_9_7 = 0;
    $cantidad_codigo_9_8 = 0;
    $cantidad_codigo_9_9 = 0;
    $cantidad_codigo_9_10 = 0;
    $cantidad_codigo_9_11 = 0;
    $cantidad_codigo_9_12 = 0;
    
    foreach ($dsb_tot_actividades_categorias as $dsb_actividad_categoria) {
        if ($dsb_actividad_categoria->id == '3') {
            $nombre_codigo_3 = $dsb_actividad_categoria->nombre;
            $url_codigo_3 = $dsb_actividad_categoria->url;
    
            if ($dsb_actividad_categoria->mes == '1') {
                $cantidad_codigo_3_1 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '2') {
                $cantidad_codigo_3_2 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '3') {
                $cantidad_codigo_3_3 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '4') {
                $cantidad_codigo_3_4 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '5') {
                $cantidad_codigo_3_5 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '6') {
                $cantidad_codigo_3_6 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '7') {
                $cantidad_codigo_3_7 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '8') {
                $cantidad_codigo_3_8 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '9') {
                $cantidad_codigo_3_9 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '10') {
                $cantidad_codigo_3_10 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '11') {
                $cantidad_codigo_3_11 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '12') {
                $cantidad_codigo_3_12 = $dsb_actividad_categoria->cantidad;
            }
        }
    
        if ($dsb_actividad_categoria->id == '8') {
            $nombre_codigo_8 = $dsb_actividad_categoria->nombre;
            $url_codigo_8 = $dsb_actividad_categoria->url;
    
            if ($dsb_actividad_categoria->mes == '1') {
                $cantidad_codigo_8_1 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '2') {
                $cantidad_codigo_8_2 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '3') {
                $cantidad_codigo_8_3 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '4') {
                $cantidad_codigo_8_4 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '5') {
                $cantidad_codigo_8_5 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '6') {
                $cantidad_codigo_8_6 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '7') {
                $cantidad_codigo_8_7 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '8') {
                $cantidad_codigo_8_8 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '9') {
                $cantidad_codigo_8_9 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '10') {
                $cantidad_codigo_8_10 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '11') {
                $cantidad_codigo_8_11 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '12') {
                $cantidad_codigo_8_12 = $dsb_actividad_categoria->cantidad;
            }
        }
    
        if ($dsb_actividad_categoria->id == '9') {
            $nombre_codigo_9 = $dsb_actividad_categoria->nombre;
            $url_codigo_9 = $dsb_actividad_categoria->url;
    
            if ($dsb_actividad_categoria->mes == '1') {
                $cantidad_codigo_9_1 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '2') {
                $cantidad_codigo_9_2 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '3') {
                $cantidad_codigo_9_3 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '4') {
                $cantidad_codigo_9_4 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '5') {
                $cantidad_codigo_9_5 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '6') {
                $cantidad_codigo_9_6 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '7') {
                $cantidad_codigo_9_7 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '8') {
                $cantidad_codigo_9_8 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '9') {
                $cantidad_codigo_9_9 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '10') {
                $cantidad_codigo_9_10 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '11') {
                $cantidad_codigo_9_11 = $dsb_actividad_categoria->cantidad;
            }
    
            if ($dsb_actividad_categoria->mes == '12') {
                $cantidad_codigo_9_12 = $dsb_actividad_categoria->cantidad;
            }
        }
    }
    
    $array_cantidad_codigo_3 = [];
    
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_3);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_4);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_5);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_6);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_7);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_8);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_9);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_10);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_11);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_12);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_1);
    array_push($array_cantidad_codigo_3, $cantidad_codigo_3_2);
    
    $array_cantidad_codigo_8 = [];
    
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_3);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_4);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_5);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_6);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_7);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_8);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_9);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_10);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_11);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_12);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_1);
    array_push($array_cantidad_codigo_8, $cantidad_codigo_8_2);
    
    $array_cantidad_codigo_9 = [];
    
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_3);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_4);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_5);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_6);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_7);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_8);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_9);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_10);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_11);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_12);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_1);
    array_push($array_cantidad_codigo_9, $cantidad_codigo_9_2);
    
    ?>



    {{-- 1 13 32 14 22 20 --}}
    {{-- @foreach ($data_actividades_diarias as $data_actividad_diaria)
        {{ $data_actividad_diaria }}
    @endforeach --}}



    @if (auth()->user()->rol_id != 1)
        @php($visibility = 'none')
        @else
        @php($visibility = 'block')
    @endif
    <div class="body d-flex py-3">
        <div class="container-xxl" style="display: {{$visibility}}">
            <div class="row clearfix g-3">
                <div class="col-xl-12 col-lg-12 col-md-12 flex-column">
                    <div class="row g-3">
                        <div class="col-md-12 col-lg-3 col-xl-3 col-xxl-3">

                            <div class="card ">

                                <div class="card-body">

                                    <div class="d-flex align-items-center">
                                        <div class="avatar lg  rounded-1 no-thumbnail bg-lightyellow color-defult"><i
                                                class="bi bi-journal-check fs-4"></i></div>
                                        <div class="flex-fill ms-4">
                                            <div class="">
                                                SEMANA PASADA
                                            </div>
                                            <h5 class="mb-0 ">{{ $numero_tickets_anterior }}</h5>
                                        </div>
                                        <a href="#" title="view-members"
                                            class="btn btn-link text-decoration-none  rounded-1"><i
                                                class="icofont-hand-drawn-right fs-2 "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar lg  rounded-1 no-thumbnail bg-lightblue color-defult"><i
                                                class="bi bi-list-check fs-4"></i></div>
                                        <div class="flex-fill ms-4">
                                            <div class="">
                                                SEMANA ACTUAL
                                            </div>
                                            <h5 class="mb-0 ">{{ $numero_tickets_actual }}</h5>
                                        </div>
                                        <a href="#" title="space-used"
                                            class="btn btn-link text-decoration-none  rounded-1"><i
                                                class="icofont-hand-drawn-right fs-2 "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        @if ($numero_incremento_prod == 0)
                                            <div class="avatar lg  rounded-1 no-thumbnail bg-warning color-defult"><i
                                                    class="bi bi-clipboard-data fs-4"></i></div>
                                        @endif

                                        @if ($numero_incremento_prod < 0)
                                            <div class="avatar lg  rounded-1 no-thumbnail bg-danger color-red"><i
                                                    class="bi bi-clipboard-data fs-4"></i></div>
                                        @endif

                                        @if ($numero_incremento_prod > 0)
                                            <div class="avatar lg  rounded-1 no-thumbnail bg-success color-defult"><i
                                                    class="bi bi-clipboard-data fs-4"></i></div>
                                        @endif

                                        <div class="flex-fill ms-4">
                                            <h5 class="mb-0 ">

                                                <div class="col mr-2">
                                                    @if ($numero_incremento_prod > 0)
                                                        <h6 class="mb-0 ">
                                                            INCREMENTO PRODUCCION {{ $numero_incremento_prod }} %</h6>
                                                    @endif

                                                    @if ($numero_incremento_prod < 0)
                                                        <h6 class="mb-0 ">
                                                            DECREMENTO PRODUCCION {{ $numero_incremento_prod }} %</h6>
                                                    @endif

                                                    @if ($numero_incremento_prod == 0)
                                                        <h6 class="mb-0 ">
                                                            INICIANDO ACTIVIDADES</h6>
                                                    @endif

                                                </div>

                                            </h5>
                                        </div>
                                        <a href="#" title="renewal-date"
                                            class="btn btn-link text-decoration-none  rounded-1"><i
                                                class="icofont-hand-drawn-right fs-2 "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">


                                        <div class="avatar lg  rounded-1 no-thumbnail bg-success color-defult"><i
                                                class="bi bi-list fs-4"></i></div>


                                        <div class="flex-fill ms-4">
                                            <h5 class="mb-0 ">

                                                <div class="col mr-2">
                                                    <h5 class="mb-0 ">
                                                        {{ $numero_proyectos_desarrollo }} PROYECTOS EN DESARROLLO
                                                    </h5>
                                                </div>

                                            </h5>
                                        </div>
                                        <a href="#" title="renewal-date"
                                            class="btn btn-link text-decoration-none  rounded-1"><i
                                                class="icofont-hand-drawn-right fs-2 "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="body d-flex g-3">



        <div class="row">
            
            <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6" style="display: {{$visibility}}">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold ">Avance de Proyectos</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($proyectos_avance as $proyecto_avance)
                            <div class="progress-count mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold d-flex align-items-center">{{ $proyecto_avance->nombre }}</h6>
                                    <span class="small text-muted"><strong>{{ $proyecto_avance->tiempo }}
                                            dias</strong></span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    @if ($proyecto_avance->avance < 50)
                                        <div class="progress-bar light-danger-bg " role="progressbar"
                                            style="width: {{ $proyecto_avance->avance }}%"
                                            aria-valuenow="{{ $proyecto_avance->avance }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    @elseif ($proyecto_avance->avance < 70)
                                        <div class="progress-bar bg-lightyellow" role="progressbar"
                                            style="width: {{ $proyecto_avance->avance }}%"
                                            aria-valuenow="{{ $proyecto_avance->avance }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar success-bg" role="progressbar"
                                            style="width: {{ $proyecto_avance->avance }}%"
                                            aria-valuenow="{{ $proyecto_avance->avance }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    @endif

                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold d-flex align-items-center"></h6>
                                    <span
                                        class="small text-muted float-right"><strong>{{ $proyecto_avance->avance }}%</strong></span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            
            <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12" style="display: {{$visibility}}">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="mb-0 fw-bold ">Actividades finalizadas por día</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="char_actividades_finalizadas"></canvas>
                        </div>
                    </div>
                </div>



                <div class="row" style="display: {{$visibility}}">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Estado de proyectos</h6>
                            </div>
                            <canvas id="char_estado_proyectos"></canvas>
                        </div>
                    </div>


                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Numero de proyectos</h6>
                            </div>



                            <div class="card-body">
                                <div class="row g-2 row-deck">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="card">
                                            <div class="card-body ">
                                                <i class="icofont-stopwatch fs-3"></i>
                                                <h6 class="mt-3 mb-0 fw-bold small-14">En Desarrollo</h6>
                                                <span style="font-size:46px">{{ $numero_proyectos_desarrollo }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="card">
                                            <div class="card-body ">
                                                <i class="icofont-beach-bed fs-3"></i>
                                                <h6 class="mt-3 mb-0 fw-bold small-14">En Pausa</h6>
                                                <span style="font-size:46px">{{ $numero_proyectos_pausa }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="card">
                                            <div class="card-body ">
                                                <i class="icofont-stopwatch fs-3"></i>
                                                <h6 class="mt-3 mb-0 fw-bold small-14">En Certificacion</h6>
                                                <span style="font-size:46px">{{ $numero_proyectos_certificacion }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="card">
                                            <div class="card-body ">
                                                <i class="icofont-beach-bed fs-3"></i>
                                                <h6 class="mt-3 mb-0 fw-bold small-14">Total</h6>
                                                <span
                                                    style="font-size:46px">{{ $numero_proyectos_desarrollo + $numero_proyectos_certificacion + $numero_proyectos_pausa }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

               









                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Actividades finalizadas por analista</h6>
                        </div>
                        <canvas id="char_actividades_finalizadas_analista"></canvas>
                    </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Actividades asignadas por analista</h6>
                        </div>
                        <canvas id="char_actividades_finalizadas_analista4"></canvas>
                    </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12" style="display: {{$visibility}}">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Actividades finalizadas por analista (Ultimos 15 dias)</h6>
                        </div>
                        <canvas id="char_actividades_finalizadas_analista5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>





























    <!-- Body: Body -->
    <div class="body d-flex py-3" >
        <div class="container-xxl" style="display: {{$visibility}}">
            <div class="row clearfix g-3">
                <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Bolson Horas Operatoria Diaria</h5>
                                    <h6>Numero de horas operatoria diaria</h6>
                                </div>
                                <canvas id="char_bolson_horas_operatoria_diaria"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Actividades Finalizadas por Mes</h5>
                                    <h6>Numero de actividades resueltas por Mes</h6>
                                </div>
                                <canvas id="char_actividades_finalizadas_mes"></canvas>
                            </div>
                        </div>
                    </div>


                    @if (Session::get('id_unidad') == 1)
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h5 class="mb-0 fw-bold ">INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y
                                            MODIFICADOS 2021</h5>
                                    </div>
                                    <canvas id="char_indice_error_meses_2021"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h5 class="mb-0 fw-bold ">INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y
                                            MODIFICADOS 2022</h5>
                                    </div>
                                    <canvas id="char_indice_error_meses_2022"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h5 class="mb-0 fw-bold ">Actividades por Categoria Finalizadas por Mes</h5>
                                    </div>
                                    <canvas id="char_actividades_finalizadas_categoria_mes"></canvas>
                                </div>
                            </div>
                        </div>
                    @endif




                </div>


            </div><!-- Row End -->
        </div>
    </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('char_actividades_finalizadas');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($actividades_finalizadas_label),
                datasets: [{
                    label: '',
                    data: @json($actividades_finalizadas_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('char_estado_proyectos');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: @json($data_estado_proyectos_label),
                datasets: [{
                    label: '',
                    data: @json($data_estado_proyectos_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx3 = document.getElementById('char_actividades_finalizadas_analista');

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($data_users_end_label),
                datasets: [{
                    label: '',
                    data: @json($data_users_end_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx4 = document.getElementById('char_actividades_finalizadas_analista4');

        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: @json($data_users_dev_label),
                datasets: [{
                    label: '',
                    data: @json($data_users_dev_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx5 = document.getElementById('char_actividades_finalizadas_analista5');

        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: @json($data_users_week_end_label),
                datasets: [{
                    label: '',
                    data: @json($data_users_week_end_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx6 = document.getElementById('char_bolson_horas_operatoria_diaria');

        new Chart(ctx6, {
            type: 'bar',
            data: {
                labels: @json($data_horas_meses_end_label),
                datasets: [{
                    label: '',
                    data: @json($data_horas_meses_end_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        const ctx7 = document.getElementById('char_actividades_finalizadas_mes');

        new Chart(ctx7, {
            type: 'bar',
            data: {
                labels: @json($data_meses_end_mes_anio_label),
                datasets: [{
                    label: '',
                    data: @json($data_meses_end_mes_anio_value),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx8 = document.getElementById('char_indice_error_meses_2021');

        new Chart(ctx8, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [3.45, 4.65, 7.32, 1.04, 0.00, 0.00, 0.00, 2.70, 0.00, 4.54, 1.75, 0.00]
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: [5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00]
                }],
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



        const ctx9 = document.getElementById('char_indice_error_meses_2022');

        new Chart(ctx9, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [1.47, 0.72, 0.64, 1.23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: [5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00]
                }],
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx10 = document.getElementById('char_actividades_finalizadas_categoria_mes');

        new Chart(ctx10, {
            type: 'bar',
            data: {
                labels: [<?php echo $data_categorias; ?>],
                datasets: [{
                        label: '<?php echo $nombre_codigo_3; ?>',
                        data: @json($array_cantidad_codigo_3),
                        backgroundColor: [
                            'rgba(255,99,132,0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                            'rgba(153,102,255,1)',
                            'rgba(255,159,64,1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '<?php echo $nombre_codigo_8; ?>',
                        data: @json($array_cantidad_codigo_8),
                        backgroundColor: [
                            'rgba(54,162,235,0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                            'rgba(153,102,255,1)',
                            'rgba(255,159,64,1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '<?php echo $nombre_codigo_9; ?>',
                        data: @json($array_cantidad_codigo_9),
                        backgroundColor: [
                            'rgba(255,206,86,0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                            'rgba(153,102,255,1)',
                            'rgba(255,159,64,1)',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
