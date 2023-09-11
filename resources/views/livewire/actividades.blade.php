<div style="text-align: center">


    <style>
        /* The heart of the matter */

        .horizontal-scrollable>.row {
            overflow-x: auto;
            white-space: nowrap;
        }

        .horizontal-scrollable>.row>.col-xs-4 {
            display: inline-block;
            float: none;
        }



        .list-group-custom .list-group-item,
        .list-group .list-group-item {
            border-color: #ffffff;
        }

        .mem-list {
            /*overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            overflow-y: scroll;*/
            height: 650px;
            overflow-y: scroll;
        }


        .body {
            margin-top: -47px;
        }

        .span.select2-dropdown.select2-dropdown--below{
            z-index: 999999 !important;
        }

    </style>



<div id="create_actividad" wire:ignore.self class="modal"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header col">
                <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nueva actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>



            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="mb-3">
                    <label class="form-label">Proyectosss</label>

                        <select class="form-control select2" style=" position: absolute; display: block;" wire:model="proyecto_id"
                            style="width: 100%" id="perdon">
                            @if ($catalogo_proyectos)
                                @foreach ($catalogo_proyectos as $obj)
                                    <option value="{{ $obj->id }}" style="z-index: 999;">{{ $obj->nombre }}</option>
                                @endforeach
                            @endif
                        </select>

                </div>
            </div>

            </div>
        </div>
    </div>
</div>








<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="mb-3">
        <label class="form-label">Proyectosss</label>
        <div wire:ignore>
            <select class="form-control select2" wire:model="proyecto_id"
                style="width: 100%">
                @if ($catalogo_proyectos)
                    @foreach ($catalogo_proyectos as $obj)
                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">


        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                            <h5 class="fw-bold mb-0">
                                Actividades
                            </h5>
                            {{--
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="mb-3">
                                    <label class="form-label">Proyectosss</label>
                                    <div wire:ignore>
                                        <select class="form-control select2" style="width: 100%">
                                            <option value="">Seleccione</option>
                                            @if ($catalogo_proyectos)
                                                @foreach ($catalogo_proyectos as $obj)
                                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div> --}}

                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="text-align: left">
                            @if ($tipo == 1)
                                <button class="btn btn-primary" wire:click="changeType"><i
                                        class="icofont-listine-dots fa-lg"></i></button>
                            @else
                                <button class="btn btn-primary" wire:click="changeType"><i
                                        class="icofont-penalty-card fa-lg"></i></button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>




            <div class="row taskboard g-3 py-xxl-4">
                <!--taskboard-->


                @if ($tipo == 1)

                    <div class="list-group list-group-horizontal position-relative  w-100 table-responsive"
                        style="margin-top: -40px;">

                        @foreach ($proyectos as $proyecto)
                            <div
                                class="col-lg-3 col-xl-3 col-lg-3 col-md-3 mt-xxl-3 mt-xl-3 mt-lg-3 mt-md-3 mt-sm-6 mt-6 list-group-item">
                                <div class="col-lg-12 col-md-12">
                                    <h6 class="fw-bold py-3 mb-0">{{ $proyecto->nombre }}</h6>
                                </div>

                                <div class="col-lg-12 col-md-12  mem-list">

                                    <ol class="dd-list">
                                        @foreach ($actividades as $actividad)
                                            @if ($actividad->proyecto_id == $proyecto->proyecto_id)
                                                <li class="dd-item" data-id="1">
                                                    <div class="dd-handle">

                                                        <div
                                                            class="task-info d-flex align-items-center justify-content-between">
                                                            <div
                                                                class="task-priority d-flex flex-column align-items-center justify-content-center">

                                                                <h6 wire:click="load_edit_actividad({{ $actividad->id }})"
                                                                    onclick="modal_edit()"
                                                                    class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                                    <i class="fa fa-edit fa-lg"></i> &nbsp;
                                                                    {{ $actividad->id }}
                                                                </h6>
                                                            </div>
                                                            <div
                                                                class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                                <div class="avatar-list avatar-list-stacked m-0">
                                                                    @if ($actividad->image)
                                                                        @if ($actividad->image)
                                                                            <img class="avatar rounded-circle small-avt"
                                                                                src="{{ url('/images/users') }}/{{ $actividad->image }}"
                                                                                alt="">
                                                                        @else
                                                                            <img class="avatar rounded-circle small-avt"
                                                                                src="{{ url('/') . '/images/xs/avatar1.jpg' }}"
                                                                                alt="">
                                                                        @endif
                                                                    @else
                                                                        <img class="avatar rounded-circle small-avt"
                                                                            src="{{ url('/') . '/images/xs/avatar1.jpg' }}"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                                <span class="badge bg-warning text-end mt-2">
                                                                    {{ $actividad->user_name }}
                                                                </span>
                                                            </div>

                                                        </div>
                                                        <p class="py-2 mb-0" style="text-align: left;">
                                                            {{ $actividad->actividad }}</p>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            <div class="col-sm">
                                                                <ul
                                                                    class="d-flex list-unstyled align-items-center flex-wrap">
                                                                    <li class="me-6">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="ms-1"><strong>{{ date('d/m/Y', strtotime($actividad->fecha_inicio)) }}
                                                                                    -
                                                                                    {{ date('d/m/Y', strtotime($actividad->fecha_fin)) }}</strong></span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="me-2">
                                                                        <div
                                                                            class="d-flex align-items-center text-{{ $actividad->color }}">
                                                                            &nbsp;&nbsp;<i class="icofont-flag"></i>
                                                                            <span class="ms-1"><strong>
                                                                                    {{ $actividad->prioridad }}
                                                                                </strong></span>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="icofont-check-circled"></i>
                                                                            <span class="ms-1">Ticket:
                                                                                {{ $actividad->numero_ticket }}</span>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="d-flex align-items-center"
                                                                            wire:click="load_actividad({{ $actividad->id }})"
                                                                            @if ($actividad->estado_id == 3) onclick="modal_avance()" @endif>

                                                                            @if ($actividad->porcentaje < 50)
                                                                                <div class="progress"
                                                                                    style="height: 20px; width: 150px;">
                                                                                    <div class="progress-bar bg-danger"
                                                                                        role="progressbar"
                                                                                        style="width: 50%"
                                                                                        aria-valuenow="60"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100">
                                                                                        {{ $actividad->porcentaje }}%
                                                                                    </div>
                                                                                </div>
                                                                            @elseif($actividad->porcentaje < 70)
                                                                                <div class="progress"
                                                                                    style="height: 20px; width: 150px;">
                                                                                    <div class="progress-bar bg-warning"
                                                                                        role="progressbar"
                                                                                        style="width: {{ $actividad->porcentaje }}%"
                                                                                        aria-valuenow="60"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100">
                                                                                        {{ $actividad->porcentaje }}%
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="progress"
                                                                                    style="height: 20px; width: 150px;">
                                                                                    <div class="progress-bar bg-success"
                                                                                        role="progressbar"
                                                                                        style="width: {{ $actividad->porcentaje }}%"
                                                                                        aria-valuenow="60"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100">
                                                                                        {{ $actividad->porcentaje }}%
                                                                                    </div>
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            <div class="col-sm">
                                                                <ul
                                                                    class="d-flex list-unstyled align-items-center flex-wrap">
                                                                    <li class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                                                                        <div class="d-flex align-items-right">
                                                                            <span
                                                                                class="ms-1 float-right"><strong>{{ $actividad->estado }}</strong></span>
                                                                        </div>
                                                                    </li>
                                                                    @if ($actividad->estado_id == 1)
                                                                        <li
                                                                            class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-items-right">
                                                                            <i class="icofont-check-circled text-danger fa-3x float-right"
                                                                                wire:click="activar({{ $actividad->id }})"></i>
                                                                        </li>
                                                                    @elseif ($actividad->estado_id == 2)
                                                                        <li
                                                                            class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-items-right">
                                                                            <i class="icofont-pause text-warning fa-3x float-right"
                                                                                wire:click="activar({{ $actividad->id }})"></i>
                                                                        </li>
                                                                    @else
                                                                        <li
                                                                            class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-items-right">
                                                                            <i class="icofont-play-alt-1 text-success fa-3x float-right"
                                                                                wire:click="pausar({{ $actividad->id }})"></i>
                                                                        </li>
                                                                    @endif





                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </li>
                                            @endif
                                        @endforeach

                                    </ol>

                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Proyecto</th>
                                <th>Ticket</th>
                                <th>Usuario</th>
                                <th>Descripción</th>
                                <th>Avance</th>
                                <th>Fechas</th>
                                <th>Estado</th>
                                <th>Prioridad</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $actividad)
                                <tr>
                                    <td>{{ $actividad->id }}</td>
                                    <td>{{ $actividad->proyecto }}</td>
                                    <td>{{ $actividad->numero_ticket }}</td>
                                    <td><img src="{{ url('/images/users') }}/{{ $actividad->image }}"
                                            class="avatar sm rounded-circle me-2" alt="profile-image"><span>
                                            {{ $actividad->user_name }}
                                        </span>
                                    </td>
                                    <td style="text-align: left">{{ $actividad->actividad }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;"
                                            wire:click="load_actividad({{ $actividad->id }})"
                                            @if ($actividad->estado_id == 3) onclick="modal_avance()" @endif>
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 100%;">
                                                {{ $actividad->porcentaje }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($actividad->fecha_inicio)) }} -
                                        {{ date('d/m/Y', strtotime($actividad->fecha_fin)) }}</td>
                                    <td>
                                        {{ $actividad->estado }}
                                    </td>
                                    <td> <span class="badge bg-{{ $actividad->color }}"> {{ $actividad->prioridad }}
                                        </span></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            @if ($actividad->estado_id == 1)
                                                <i class="icofont-check-circled text-danger fa-3x float-right"
                                                    wire:click="activar({{ $actividad->id }})"></i>
                                            @elseif ($actividad->estado_id == 2)
                                                <i class="icofont-pause text-warning fa-3x float-right"
                                                    wire:click="activar({{ $actividad->id }})"></i>
                                            @else
                                                <i class="icofont-play-alt-1 text-success fa-3x float-right"
                                                    wire:click="pausar({{ $actividad->id }})"></i>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>



                @endif


            </div>


        </div>


        <div id="edit_actividad" wire:ignore.self class="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <form wire:submit.prevent="edit_actividad()">
                    <div class="modal-content">
                        <div class="modal-header col">
                            <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Editar actividad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body row">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Proyectos</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div wire:ignore>
                                        <select class="form-select">
                                            @if ($catalogo_proyectos)
                                                @foreach ($catalogo_proyectos as $proyecto)
                                                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div id="create_avance" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel">Desea agregar porcentaje de avance a
                            esta actividad?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <input type="hidden" wire:model.defer="id_proyecto">
                    <div class="modal-body row">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Actividad</label>
                                <textarea class="form-control" wire:model.defer="nombre_actividad" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Porcentaje anterior</label>
                                <input type="text" wire:model.defer="porcentaje_anterior" readonly
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Porcentaje actual</label>
                                <input type="text" wire:model.defer="porcentaje_actual" readonly
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Porcentaje diario</label>
                                <input type="number" wire:model.defer="porcentaje_diario"
                                    wire:change="calculo_porcentaje()" step="0.01" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Tiempo (Minutos)</label>
                                <input type="number" wire:model.defer="tiempo_minutos" step="1"
                                    class="form-control">
                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Detalle</label>
                                <textarea class="form-control" wire:model.defer="detalle"></textarea>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" wire:click="store_movimiento()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="contenedor"
            style="width: 90px;
                height: 240px;
                position: absolute;
                right: 0px;
                bottom: 0px;">

            <button class="botonF1" wire:click="create()" data-bs-toggle="modal" data-bs-target="#create_actividad"
                style=" width: 60px;
                height: 60px;
                border-radius: 100%;
                background: #484c7f;
                right: 0;
                bottom: 0;
                position: absolute;
                margin-right: 16px;
                margin-bottom: 16px;
                border: none;
                outline: none;
                color: #FFF;
                font-size: 36px;
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
                transition: .3s;">
                <span>+</span>
            </button>

        </div>



    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                $('#select2').select2();
            });
        </script>
    @endpush


    <script type="text/javascript">
        window.addEventListener('error-alert', (e) => {
            Swal.fire({
                //position: 'top-end',
                icon: 'error',
                title: 'No pueden haber dos actividades en desarrollo',
                showConfirmButton: false,
                timer: 1500
            })
        });

        window.addEventListener('close-modal', (e) => {
            $('#create_actividad').modal('hide')
        });

        window.addEventListener('close-modal-edit', (e) => {
            $('#edit_actividad').modal('hide')
        });





        function modal_avance() {
            $('#create_avance').modal('show')
        }

        function modal_edit() {
            $('#edit_actividad').modal('show')
        }

        window.addEventListener('close-modal-avance', (e) => {
            $('#create_avance').modal('hide')
        });
    </script>





</div>
