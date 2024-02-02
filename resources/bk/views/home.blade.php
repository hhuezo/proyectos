@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <head>

        <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}  ">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}  ">

    </head>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>





    @can('read dashboard avance proyectos')

        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row clearfix g-3">
                    <div class="col-xl-12 col-lg-12 col-md-12 flex-column">
                        <div class="row g-3">
                            <div class="col-md-12 col-lg-3 col-xl-3 col-xxl-3">

                                <div class="card " onclick="modal_actividades_finalizadas(0,'detalle')">

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
                                <div class="card " onclick="modal_actividades_finalizadas(1,'detalle')">
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


        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
            <div class="body d-flex g-3">



                <div class="row">

                    <div class="col-md-6">
                        <div class="card" style="max-height: 1000px;">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Avance de Proyectos</h6>
                            </div>
                            <div class="card-body overflow-auto">
                                @foreach ($proyectos_avance as $proyecto_avance)
                                    <div class="progress-count mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mb-0 fw-bold d-flex align-items-center">{{ $proyecto_avance->nombre }}
                                            </h6>
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



                    <div class="col-md-6">

                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="mb-0 fw-bold ">Actividades finalizadas por día</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="char_actividades_finalizadas"></canvas>
                                </div>
                            </div>
                        </div>


                        <div class="row col-xxl-12 col-xl-12 col-lg-12 col-md-12">


                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 g-3">
                                <div class="body d-flex g-3">
                                    <div class="row">

                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header py-3">
                                                    <h6 class="mb-0 fw-bold ">Estado de proyectos</h6>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="char_estado_proyectos"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header py-3">
                                                    <h6 class="mb-0 fw-bold ">Número de proyectos</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-2 row-deck">
                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <div class="card">
                                                                <div class="card-body ">
                                                                    <i class="icofont-stopwatch fs-3"></i>
                                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Desarrollo</h6>
                                                                    <span
                                                                        style="font-size:46px">{{ $data_estado_proyectos_value[0] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <div class="card">
                                                                <div class="card-body ">
                                                                    <i class="icofont-beach-bed fs-3"></i>
                                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Pausa</h6>
                                                                    <span
                                                                        style="font-size:46px">{{ $data_estado_proyectos_value[1] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <div class="card">
                                                                <div class="card-body ">
                                                                    <i class="icofont-stopwatch fs-3"></i>
                                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Certificacion
                                                                    </h6>
                                                                    <span
                                                                        style="font-size:46px">{{ $data_estado_proyectos_value[2] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-6">
                                                            <div class="card">
                                                                <div class="card-body ">
                                                                    <i class="icofont-beach-bed fs-3"></i>
                                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Total</h6>
                                                                    <span
                                                                        style="font-size:46px">{{ $data_estado_proyectos_value[0] + $data_estado_proyectos_value[1] + $data_estado_proyectos_value[2] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

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
        </script>

        <br>
    @endcan

    @if (session('id_unidad') == 1)


        @can('read dashboard analista')
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-ActividadesFinalizadas"
                            role="tab">Actividades finalizadas por analista</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-ActividadesFinalizadas15"
                            role="tab">Actividades finalizadas por analista (Ultimos 15 dias)</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-ActividadesAsignadas"
                            role="tab">Actividades asignadas por analista</a></li>
                </ul>


                <div class="tab-content mt-2">
                    <div class="tab-pane fade show active" id="nav-ActividadesFinalizadas" role="tabpanel">
                        <div class="row col-8 g-3">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Actividades finalizadas por analista</h6>
                                </div>
                                <canvas id="char_actividades_finalizadas_analista"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-ActividadesFinalizadas15" role="tabpanel">
                        <div class="row col-8 g-3">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Actividades finalizadas por analista (Ultimos 15 dias)</h6>
                                </div>
                                <canvas id="char_actividades_finalizadas_analista5"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-ActividadesAsignadas" role="tabpanel">
                        <div class="row col-8 g-3">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Actividades asignadas por analista</h6>
                                </div>
                                <canvas id="char_actividades_finalizadas_analista4"></canvas>
                            </div>
                        </div>
                    </div>

                </div>





            </div>


            <script>
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
                        },
                        plugins: {
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                formatter: function(value, context) {
                                    return value; // Display the actual value on the bar
                                }
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
            </script>
        @endcan





        @can('read dashboard actividades analista')
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">&nbsp;</div>

            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Bolson"
                            role="tab">Bolson
                            Horas Operatoria Diaria</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Finalizadas"
                            role="tab">Actividades
                            Finalizadas por Mes</a></li>
                    @if (session('id_unidad') == 1)
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Errores"
                                role="tab">Indice
                                errores 2021</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Errores2023"
                                role="tab">Indice
                                errores 2022</a></li>

                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Errores2023"
                                role="tab">Indice
                                errores 2023</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-emergentes"
                                role="tab">Act. emergentes 2023</a></li>

                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Categoria"
                                role="tab">Act.
                                por Categoria Finalizadas por Mes</a></li>
                    @endif
                </ul>

                <div class="tab-content mt-2">
                    <div class="tab-pane fade show active" id="nav-Bolson" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-8">
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
                    </div>
                    <div class="tab-pane fade" id="nav-Finalizadas" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Actividades Finalizadas por Mes</h5>
                                    <h6>Numero de actividades resueltas por Mes</h6>
                                </div>
                                <canvas id="char_actividades_finalizadas_mes"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Errores" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y
                                        MODIFICADOS 2021</h5>
                                </div>
                                <canvas id="char_indice_error_meses_2021"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Errores2022" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y
                                        MODIFICADOS 2022</h5>
                                </div>
                                <canvas id="char_indice_error_meses_2022"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Errores2023" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y
                                        MODIFICADOS 2023</h5>
                                </div>
                                <canvas id="char_indice_error_meses_2023"></canvas>
                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade" id="nav-emergentes" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Actividades emergentes 2023</h5>
                                </div>
                                <canvas id="char_emergentes"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Categoria" role="tabpanel">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Actividades por Categoria Finalizadas por Mes</h5>
                                </div>
                                <canvas id="char_actividades_finalizadas_categoria_mes"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
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


                const ctx11 = document.getElementById('char_indice_error_meses_2023');

                new Chart(ctx11, {
                    data: {
                        datasets: [{
                            type: 'bar',
                            label: 'LINEA DE DEFECTOS',

                            data: [0.0, 0.0, 0.0, 0.0, 0.0, 4.76, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                        }, {
                            type: 'line',
                            label: 'LINEA ESTANDAR ESTABLECIDO',
                            data: [3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0]
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



                const ctx12 = document.getElementById('char_emergentes');

                new Chart(ctx12, {
                    type: 'bar',
                    data: {
                        labels: @json($meses_emergente),
                        datasets: @json($data_emergente),
                    },
                    options: {
                        plugins: {
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                formatter: function(value, context) {
                                    return value; // Mostrará el valor en la parte superior de la barra
                                }
                            }
                        },
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
        @endcan






        @can('read dashboard rendimiento base datos')
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row clearfix g-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 flex-column">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div
                                            class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                            <h5 class="mb-0 fw-bold ">Rendimiento base de datos</h5>
                                            <select id="anio" onchange="load_rendimiento_db()">
                                                @for ($i = date('Y'); $i >= 2010; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div id="div_rendimiento_bd"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('read dashboard tiempo invertido')
            <div>
                <div class="col-md-8">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h5 class="mb-0 fw-bold ">Tiempo invertido por tipo cliente</h5>
                        <select id="anio_tiempo_invertido" onchange="load_tiempo_invertido_cliente()">
                            @for ($i = date('Y'); $i >= 2021; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-tiempoInvertido"
                                role="tab">Mesual</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-tiempoInvertidoAnual"
                                role="tab">Anual</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="nav-tiempoInvertido" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h5 class="mb-0 fw-bold ">Mensual</h5>
                                </div>
                                <div id="div_tiempo_invertido"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tiempoInvertidoAnual" role="tabpanel">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h5 class="mb-0 fw-bold ">Anual</h5>
                            </div>
                            <div id="div_tiempo_invertido_anual"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan



        @can('read dashboard tiempo invertido')
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">&nbsp;</div>
            @foreach ($graficas as $grafica)
                <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                    <div class="row col-12 g-3">
                        <div class="card">
                            <div id="container{{ $grafica->id }}"></div>
                        </div>
                    </div>
                </div>
            @endforeach

            <script>
                var graficas = @json($graficas);

                for (var i = 0; i < graficas.length; i++) {

                    var plotOptions = {};


                    if (graficas[i].tipo_grafico === "column") {
                        console.log(graficas[i].tipo_grafico);
                        plotOptions = {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}', // Muestra el valor de 'y' en la columna
                                    style: {
                                        fontWeight: 'bold'
                                    }
                                }
                            }
                        };
                    } else {
                        plotOptions = {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: graficas[i].encabezado[i] +
                                        ' - {point.y}', // Muestra el valor de 'y' seguido por el nombre de la columna
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        };
                    }







                    Highcharts.chart('container' + graficas[i].id, {
                        chart: {
                            //type: 'column'
                            type: graficas[i].tipo_grafico
                        },
                        title: {
                            text: graficas[i].titulo,
                            align: 'left'
                        },
                        subtitle: {
                            text: '',
                            align: 'left'
                        },
                        xAxis: {
                            categories: graficas[i].encabezado,
                            crosshair: true,
                            accessibility: {
                                description: 'Countries'
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: graficas[i].descripcion
                            },
                            plotLines: graficas[i].linea_estandar > 0 ? [{
                                color: 'red', // Color de la línea
                                dashStyle: 'solid', // Estilo de la línea (puedes cambiarlo según tus preferencias)
                                value: graficas[i].linea_estandar, // Valor del máximo permitido
                                width: 2, // Grosor de la línea
                                label: {
                                    text: 'Línea estándar establecida', // Etiqueta asociada a la línea
                                    align: 'right',
                                    x: -10
                                }
                            }] : undefined

                        },
                        tooltip: {
                            valueSuffix: ''

                        },
                        plotOptions: plotOptions,


                        series: graficas[i].data_grafico
                    });
                }
            </script>
        @endcan


    @endif


    <!-- modal update user -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="modal-actividades-finalizadas" tabindex="-1" aria-labelledby="modal-actividades-finalizadas"
        aria-hidden="true">
        <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">

                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                            dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal">

                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4">

                        <p class="text-base text-slate-600 dark:text-slate-400 leading-6">
                        <div id="detalle"></div>
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end modal update user -->




    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>




    <script>
        $(document).ready(function() {
            load_rendimiento_db();
            load_tiempo_invertido_cliente();
        });

        function load_rendimiento_db() {
            var anio = document.getElementById('anio').value;
            $.ajax({
                url: "{{ url('/home/charts/get_rendimiento_bd') }}/" + anio,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#div_rendimiento_bd').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function load_tiempo_invertido_cliente() {
            var anio = document.getElementById('anio_tiempo_invertido').value;
            $.ajax({
                url: "{{ url('/home/charts/get_tiempo_invertido') }}/" + anio,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#div_tiempo_invertido').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });

            $.ajax({
                url: "{{ url('/home/charts/get_tiempo_invertido_anual') }}/" + anio,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#div_tiempo_invertido_anual').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function modal_actividades_finalizadas(id, control) {
            get_actividades_finalizadas(id, control);
            $('#modal-actividades-finalizadas').modal('show');

        }


        function get_actividades_finalizadas(id, control) {

            var selector = "#" + control;
            //console.log(selector);
            $.get("{{ url('get_actividades_finalizadas') }}" + '/' + id, function(data) {

                var html =
                    "<div class='card'><header class=' card-header noborder'><h4 class='card-title'>Actividades Finalizadas</h4></header><div class='card-body px-6 pb-6'><div class='overflow-x-auto -mx-6'><div class='inline-block min-w-full align-middle'><div class='overflow-hidden '><table class='min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700'><thead class='bg-slate-200 dark:bg-slate-700'><thead><th scope='col' class=' table-th '>Corr</th><th scope='col' class=' table-th '>Id</th><th scope='col' class=' table-th '>User Name</th><th scope='col' class=' table-th '>Name</th><th scope='col' class=' table-th '>Numero Ticket</th><th scope='col' class=' table-th '>Actividad</th><th scope='col' class=' table-th '>Fecha inicio</th><th scope='col' class=' table-th '>Fecha fin</th></tr></thead>";

                for (var i = 0; i < data.length; i++) {
                    html = html + "<tr class='even:bg-slate-50 dark:even:bg-slate-700'><td class='table-td'>" + (i +
                            1) + "</td><td class='table-td'>" +
                        data[i].id + "</td><td class='table-td'>" + data[i].user_name +
                        "</td><td class='table-td '>" + data[i].name + "</td><td class='table-td '>" + data[i]
                        .numero_ticket + "</td><td class='table-td '>" + data[i].actividad +
                        "</td><td class='table-td '>" + data[i].fecha_inicio + "</td><td class='table-td '>" + data[
                            i].fecha_fin + "</td></tr>";
                }

                html = html + "</tbody></table></div></div></div></div></div>";

                $(selector).html(html);

            });

        }
    </script>





@endsection
