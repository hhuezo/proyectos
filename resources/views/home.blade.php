@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')


    {{-- 1 13 32 14 22 20 --}}
    {{-- @foreach ($data_actividades_diarias as $data_actividad_diaria)
        {{ $data_actividad_diaria }}
    @endforeach --}}




    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row clearfix g-3">
                <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                    <div class="row g-3">


                        <div class="row g-3 mb-3 row-deck">

                            <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">

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
                            <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
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
                            <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
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
                        </div><!-- Row End -->


                        <div class="col-md-12">
                            <div class="card">
                                <div id="apex-ActividadesFinalizadasDia"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Proyectos</h6>
                                </div>

                                <div class="card-body">
                                    <div class="row g-2 row-deck">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-checked fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">En Desarrollo</h6>
                                                    <span style="font-size:large">{{ $numero_proyectos_desarrollo }}</span>
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
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
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
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
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
                        <div class="col-md-6 col-lg-6 col-xl-12">
                            <div class="card bg-primary">
                                <div class="card-body row">
                                    <div class="col">
                                        <span
                                            class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center"><i
                                                class="icofont-file-text fs-5"></i></span>
                                        <h1 class="mt-3 mb-0 fw-bold text-white">{{ $numero_proyectos_desarrollo }}</h1>
                                        <span class="text-white">Proyectos en desarrollo</span>
                                    </div>
                                    <div class="col">
                                        <img class="img-fluid" src="{{ url('/') . '/images/interview.svg' }}"
                                            alt="interview">
                                    </div>
                                </div>
                            </div>
                        </div>
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

    {{-- <script src="{{ asset('js/dayjs.min.js') }}"></script> --}}


    {{-- <script src="{{ asset('code/highcharts.js') }}"></script>
    <script src="{{ asset('code/modules/exporting.js') }}"></script>
    <script src="{{ asset('code/modules/export-data.js') }}"></script>
    <script src="{{ asset('code/modules/accessibility.js') }}"></script>

    <script src="{{ asset('js/highcharts.js') }}"></script> --}}

    <script language="JavaScript">
        // Employees Data
        $(document).ready(function() {

            mostrarEstadoProyectos();

        });

        function mostrarEstadoProyectos() {
            alert('hi');
        });
        }


        // Highcharts.chart('container_estado_proyectos', {
        //     legend: {
        //         layout: 'vertical',
        //         align: 'right',
        //         verticalAlign: 'middle',
        //         labelFormatter: function() {
        //             return this.y + '<br>';
        //         }
        //     },
        //     title: {
        //         text: 'Estado de Proyectos'
        //     },
        //     series: [{
        //         type: 'pie',
        //         size: '80%',
        //         innerSize: '60%',
        //         showInLegend: true,
        //         dataLabels: {
        //             enabled: false
        //         },
        //         data: @json($data_estado_proyectos)
        //         // data: [{
        //         //   'name': 'Avance',
        //         //   'y': 95,
        //         //   'color': '#138999'
        //         // }, {
        //         //   'name': 'Falta',
        //         //   'y': 5,
        //         //   'color': '#6dd3ed'
        //         // }]
        //     }]
        // });

        // // Create the chart
        // Highcharts.chart('container_actividades_finalizadas', {
        //     chart: {
        //         type: 'spline'
        //     },
        //     title: {
        //         text: 'Actividades Finalizadas por día'
        //     },
        //     subtitle: {
        //         text: ''
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades resueltas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },


        //     series: [{
        //         name: "Numero de actividades resueltas",
        //         colorByPoint: true,
        //         data: @json($data_actividades_diarias),
        //     }],

        // });

        // // Create the chart
        // Highcharts.chart('container_user_dev', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Actividades Asignadas por Analista'
        //     },
        //     subtitle: {
        //         text: 'Numero de actividades Asignadas por Analista'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades asignadas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },



        //     series: [{
        //         name: "Numero de actividades en desarrollo",
        //         colorByPoint: true,
        //         data: @json($data_users_dev),

        //     }],

        // });

        // // Create the chart
        // Highcharts.chart('container_users_week_end', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Actividades Finalizadas por Analista '
        //     },
        //     subtitle: {
        //         text: 'Numero de actividades resueltas por Analista (Ultimos 15 dias)'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades resueltas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },


        //     series: [{
        //         name: "Numero de actividades resueltas",
        //         colorByPoint: true,
        //         data: @json($data_users_week_end),
        //     }],

        // });

        // // Create the chart
        // Highcharts.chart('container_users_end', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Actividades Finalizadas por Analista'
        //     },
        //     subtitle: {
        //         text: 'Numero de actividades Finalizadas por Analista'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades finalizadas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },



        //     series: [{
        //         name: "Numero de actividades finalizadas",
        //         colorByPoint: true,
        //         data: @json($data_users_end),
        //     }],
        //     drilldown: {

        //     }
        // });

        // // Create the chart
        // Highcharts.chart('container_horas_meses_end', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Bolson Horas Operatoria Diaria'
        //     },
        //     subtitle: {
        //         text: 'Numero de horas operatoria diaria'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades resueltas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },


        //     series: [{
        //         name: "Numero de actividades resueltas",
        //         colorByPoint: true,
        //         data: @json($data_horas_meses_end),
        //     }],

        // });

        // // Create the chart
        // Highcharts.chart('container_meses_end', {
        //     chart: {
        //         type: 'spline'
        //     },
        //     title: {
        //         text: 'Actividades Finalizadas por Mes'
        //     },
        //     subtitle: {
        //         text: 'Numero de actividades resueltas por Mes'
        //     },
        //     accessibility: {
        //         announceNewData: {
        //             enabled: true
        //         }
        //     },
        //     xAxis: {
        //         type: 'category'
        //     },
        //     yAxis: {
        //         title: {
        //             text: 'Total de actividades resueltas'
        //         }

        //     },
        //     legend: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         series: {
        //             borderWidth: 0,
        //             dataLabels: {
        //                 enabled: true,

        //             }
        //         }
        //     },


        //     series: [{
        //         name: "Numero de actividades resueltas",
        //         colorByPoint: true,
        //         data: @json($data_meses_end),
        //     }],
        //     drilldown: {

        //     }
        // });

        // Highcharts.chart('container_errores_tecnicos_2021', {
        //     chart: {
        //         type: 'areaspline'
        //     },
        //     title: {
        //         text: 'INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y MODIFICADOS 2021'
        //     },
        //     legend: {
        //         layout: 'vertical',
        //         align: 'left',
        //         verticalAlign: 'top',
        //         x: 150,
        //         y: 100,
        //         floating: true,
        //         borderWidth: 1,
        //         backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        //     },
        //     xAxis: {
        //         categories: [
        //             'ENERO',
        //             'FEBRERO',
        //             'MARZO',
        //             'ABRIL',
        //             'MAYO',
        //             'JUNIO',
        //             'JULIO',
        //             'AGOSTO',
        //             'SEPTIEMBRE',
        //             'OCTUBRE',
        //             'NOVIEMBRE',
        //             'DICIEMBRE'
        //         ],

        //     },
        //     yAxis: {
        //         title: {
        //             text: ''
        //         }
        //     },
        //     tooltip: {
        //         shared: true,
        //         valueSuffix: ' %'
        //     },
        //     credits: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         areaspline: {
        //             fillOpacity: 0.1
        //         }
        //     },
        //     series: [{
        //         name: 'LINEA DE DEFECTOS',
        //         data: [3.45, 4.65, 7.32, 1.04, 0.00, 0.00, 0.00, 2.70, 0.00, 4.54, 1.75, 0.00]
        //     }, {
        //         name: 'LINEA ESTANDAR ESTABLECIDO',
        //         data: [5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00]
        //     }]
        // });

        // Highcharts.chart('container_errores_tecnicos_2022', {
        //     chart: {
        //         type: 'areaspline'
        //     },
        //     title: {
        //         text: 'INDICE DE ERROR SOBRE TOTAL DE PROGRAMAS CREADOS Y MODIFICADOS 2022'
        //     },
        //     legend: {
        //         layout: 'vertical',
        //         align: 'left',
        //         verticalAlign: 'top',
        //         x: 150,
        //         y: 100,
        //         floating: true,
        //         borderWidth: 1,
        //         backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        //     },
        //     xAxis: {
        //         categories: [
        //             'ENERO',
        //             'FEBRERO',
        //             'MARZO',
        //             'ABRIL',
        //             'MAYO',
        //             'JUNIO',
        //             'JULIO',
        //             'AGOSTO',
        //             'SEPTIEMBRE',
        //             'OCTUBRE',
        //             'NOVIEMBRE',
        //             'DICIEMBRE'
        //         ],

        //     },
        //     yAxis: {
        //         title: {
        //             text: ''
        //         }
        //     },
        //     tooltip: {
        //         shared: true,
        //         valueSuffix: ' %'
        //     },
        //     credits: {
        //         enabled: false
        //     },
        //     plotOptions: {
        //         areaspline: {
        //             fillOpacity: 0.1
        //         }
        //     },
        //     series: [{
        //         name: 'LINEA DE DEFECTOS',
        //         data: [1.47, 0.72, 0.64, 1.23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
        //     }, {
        //         name: 'LINEA ESTANDAR ESTABLECIDO',
        //         data: [5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00]
        //     }]
        // });

        // Highcharts.chart('container_category', {

        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'Actividades por Categoria Finalizadas por Mes'
        //     },
        //     subtitle: {
        //         text: ''
        //     },
        //     xAxis: {
        //         categories: [<?php echo $data_categorias; ?>],
        //         crosshair: true
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'total de actividades resueltas'
        //         }
        //     },
        //     tooltip: {
        //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //             '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        //         footerFormat: '</table>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0
        //         }
        //     },
        //     series: [{
        //             name: '<?php echo $nombre_codigo_3; ?>',
        //             url: '<?php echo $url_codigo_3; ?>',
        //             data: @json($array_cantidad_codigo_3)
        //         },
        //         {
        //             name: '<?php echo $nombre_codigo_8; ?>',
        //             url: '<?php echo $url_codigo_8; ?>',
        //             data: @json($array_cantidad_codigo_8)
        //         },
        //         {
        //             name: '<?php echo $nombre_codigo_9; ?>',
        //             url: '<?php echo $url_codigo_9; ?>',
        //             data: @json($array_cantidad_codigo_9)
        //         },

        //     ],

        // });
    </script>

@endsection
