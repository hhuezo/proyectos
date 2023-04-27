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
                                                        <h5 class="mb-0 ">
                                                            INCREMENTO PRODUCCION</h5>
                                                    @endif

                                                    @if ($numero_incremento_prod < 0)
                                                        <h5 class="mb-0 ">
                                                            DECREMENTO PRODUCCION</h5>
                                                    @endif

                                                    @if ($numero_incremento_prod == 0)
                                                        <h5 class="mb-0 ">
                                                            INICIANDO ACTIVIDADES</h5>
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
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Estado de proyectos</h6>
                        </div>
                        <canvas id="char_estado_proyectos"></canvas>
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
                                <div id="apex-ActividadesFinalizadasDia"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Proyectos</h6>
                                </div>

                                <div class="card-body">
                                    <div class="row g-2 row-deck">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-checked fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Desarrollo</h6>
                                                    <span
                                                        style="font-size:large">{{ $numero_proyectos_desarrollo }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-ban fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Pausa</h6>
                                                    <span style="font-size:large">{{ $numero_proyectos_pausa }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-stopwatch fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Certificacion</h6>
                                                    <span
                                                        style="font-size:large">{{ $numero_proyectos_certificacion }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-beach-bed fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Total</h6>
                                                    <span
                                                        style="font-size:large">{{ $numero_proyectos_desarrollo + $numero_proyectos_certificacion + $numero_proyectos_pausa }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- <div class="card">
                                <div class="mt-3" id="container_estado_proyectos"></div>
                            </div> --}}
                            <div class="card">
                                <br>
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Total Proyectos</h6>
                                    <h4 class="mb-0 fw-bold ">
                                        {{ $numero_proyectos_desarrollo + $numero_proyectos_certificacion + $numero_proyectos_pausa }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="mt-3" id="apex-EstadoProyectos"></div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold "></h6>
                                </div>
                                <div class="card-body">
                                    <div id="container_actividades_finalizadas"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold "></h6>
                                </div>
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="mb-0 fw-bold ">Avance de Proyectos</h6>
                                    </div>
                                    <div class="card-body mem-list">
                                        @foreach ($proyectos_avance as $proyecto_avance)
                                            <div class="progress-count mb-4">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">
                                                        {{ $proyecto_avance->nombre }}</h6>
                                                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                                                        {{ $proyecto_avance->avance }}%</h5>
                                                    <span class="small text-muted">{{ $proyecto_avance->tiempo }}
                                                        dias</span>
                                                </div>
                                                @if ($proyecto_avance->avance > 70)
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar light-success-bg" role="progressbar"
                                                            style="width: {{ $proyecto_avance->avance }}%"
                                                            aria-valuenow="{{ $proyecto_avance->avance }}"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                @endif

                                                @if ($proyecto_avance->avance >= 50 && $proyecto_avance->avance <= 70)
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar bg-lightyellow" role="progressbar"
                                                            style="width: {{ $proyecto_avance->avance }}%"
                                                            aria-valuenow="{{ $proyecto_avance->avance }}"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                @endif

                                                @if ($proyecto_avance->avance < 50)
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar light-orange-bg" role="progressbar"
                                                            style="width: {{ $proyecto_avance->avance }}%"
                                                            aria-valuenow="{{ $proyecto_avance->avance }}"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                @endif

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>




                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold "></h6>
                                </div>
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="mb-0 fw-bold ">Tiempo de Desarrollo en Proyectos Finalizados</h6>
                                    </div>
                                    <div class="card-body mem-list">
                                        @foreach ($data_proyectos_tiempo as $data_proyecto_tiempo)
                                            <div class="progress-count mb-4">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold d-flex align-items-center">
                                                        {{ $data_proyecto_tiempo->proyecto }}</h6>
                                                    <h5 class="mb-0 fw-bold d-flex align-items-center">100%</h5>
                                                    <span class="small text-muted">{{ $data_proyecto_tiempo->tiempo }}
                                                        dias</span>
                                                </div>

                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar light-success-bg" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>


                                <div id="container_horas_meses_end"></div>

                                <br>

                                <div id="container_meses_end"></div>

                                <br>

                                <div id="container_errores_tecnicos_2021"></div>

                                <br>

                                <div id="container_errores_tecnicos_2022"></div>

                                <br>

                                <div id="container_category"></div>


                            </div>




                        </div>





                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="row g-3 row-deck">

                        <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                            <div class="card mb-3">
                                <div class="card-body">



                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div id="container_users_week_end"></div>

                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">

                                    <div id="container_users_end"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Upcomming Interviews</h6>
                                </div>
                                <div class="card-body">
                                    <div class="flex-grow-1">
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar2.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Natalie Gibson</h6>
                                                    <span class="text-muted">Ui/UX Designer</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 1.30 - 1:30
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar9.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Peter Piperg</h6>
                                                    <span class="text-muted">Web Design</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 9.00 - 1:30
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar12.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Robert Young</h6>
                                                    <span class="text-muted">PHP Developer</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 1.30 - 2:30
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar8.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Victoria Vbell</h6>
                                                    <span class="text-muted">IOS Developer</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 2.00 - 3:30
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar7.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Mary Butler</h6>
                                                    <span class="text-muted">Writer</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 4.00 - 4:30
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar3.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Youn Bel</h6>
                                                    <span class="text-muted">Unity 3d</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 7.00 - 8.00
                                            </div>
                                        </div>
                                        <div class="py-2 d-flex align-items-center  flex-wrap">
                                            <div class="d-flex align-items-center flex-fill">
                                                <img class="avatar lg rounded-circle img-thumbnail"
                                                    src="{{ url('/') . '/images/lg/avatar2.jpg' }}" alt="profile">
                                                <div class="d-flex flex-column ps-3">
                                                    <h6 class="fw-bold mb-0 small-14">Gibson Butler</h6>
                                                    <span class="text-muted">Networking</span>
                                                </div>
                                            </div>
                                            <div class="time-block text-truncate">
                                                <i class="icofont-clock-time"></i> 8.00 - 9.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card light-danger-bg">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Top Perfrormers</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-2">
                                    <p>You have 140 <span class="fw-bold">influencers </span> in your company.</p>
                                    <div class="d-flex  justify-content-between text-center">
                                        <div class="">
                                            <h3 class="fw-bold">350</h3>
                                            <span class="small">New Task</span>
                                        </div>
                                        <div class="">
                                            <h3 class="fw-bold">130</h3>
                                            <span class="small">Task Completed</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10">
                                    <div
                                        class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-6 row-deck top-perfomer">
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar2.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">Luke Short</h6>
                                                    <span class="text-muted mb-2">@Short</span>
                                                    <h4 class="fw-bold text-primary fs-3">80%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar5.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">John Hard</h6>
                                                    <span class="text-muted mb-2">@rdacre</span>
                                                    <h4 class="fw-bold text-primary fs-3">70%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar8.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">Paul Rees</h6>
                                                    <span class="text-muted mb-2">@Rees</span>
                                                    <h4 class="fw-bold text-primary fs-3">77%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar9.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">Rachel Parr</h6>
                                                    <span class="text-muted mb-2">@Parr</span>
                                                    <h4 class="fw-bold text-primary fs-3">85%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar12.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">Eric Reid</h6>
                                                    <span class="text-muted mb-2">@Eric</span>
                                                    <h4 class="fw-bold text-primary fs-3">95%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card shadow">
                                                <div
                                                    class="card-body text-center d-flex flex-column justify-content-center">
                                                    <img class="avatar lg rounded-circle img-thumbnail mx-auto"
                                                        src="{{ url('/') . '/images/lg/avatar3.jpg' }}" alt="profile">
                                                    <h6 class="fw-bold my-2 small-14">Jan Ince</h6>
                                                    <span class="text-muted mb-2">@Ince</span>
                                                    <h4 class="fw-bold text-primary fs-3">97%</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </script>

@endsection
