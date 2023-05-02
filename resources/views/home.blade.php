@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')



    {{-- 1 13 32 14 22 20 --}}
    {{-- @foreach ($data_actividades_diarias as $data_actividad_diaria)
        {{ $data_actividad_diaria }}
    @endforeach --}}




    <div class="body d-flex py-3">
        <div class="container-xxl">
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
            <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6">
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



                <div class="row">
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

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
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
    <div class="body d-flex py-3">
        <div class="container-xxl">
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

                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="row g-3 row-deck">

                        <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                            <div class="card mb-3">
                                <div class="card-body">

                                    ddddddddddd

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">

                                    eeeeeeeeeee

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">

                                    ffffffffffffff

                                </div>
                            </div>
                        </div>

                    </div>
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
                    data: [10, 20, 30, 40]
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: [50, 50, 50, 50],
                }],
                labels: ['January', 'February', 'March', 'April']
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
