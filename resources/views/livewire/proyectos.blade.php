<div style="text-align: center">
    <style>
        .dd-handle:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .contenedor {
            style="width: 90px;
        height: 240px;
        position: absolute;
        right: 0px;
        bottom: 0px;"
        }

        .botonF1 {
            width: 60px;
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
            transition: .3s;
        }
    </style>

    <div id="create_proyecto" wire:ignore.self tabindex="-1" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nuevo proyecto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model.defer="estado_id"
                            aria-label="Default select Project Category">
                            @foreach ($estados as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" wire:model.defer="nombre" name="nombre" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlTextarea786" class="form-label">Descripción</label>
                        <textarea class="form-control" wire:model.defer="descripcion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="store()">Create</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Fullscreen -->
    <div class="modal fade" wire:ignore.self id="exampleModalFullscreen" tabindex="-1"
        aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Proyecto</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="list-view">

                            <div class="row clearfix g-3">
                                <div class="col-lg-4">
                                    <div class="card">

                                        <div class="card-body">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger" id="error-proyecto">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="row g-3 mb-3">

                                                <div class="col-sm-12">
                                                    <label for="depone" class="form-label"
                                                        style="text-align: left">Nombre</label>
                                                    <input type="text" wire:model.defer="nombre"
                                                        class="form-control">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="abc" class="form-label">Descripción</label>
                                                    <textarea class="form-control" wire:model.defer="descripcion" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" wire:model.defer="id_proyecto">
                                                <label class="form-label">Estado</label>
                                                <select class="form-select" wire:model.defer="estado_id"
                                                    aria-label="Default select Project Category">
                                                    @foreach ($estados as $obj)
                                                        <option value="{{ $obj->id }}">{{ $obj->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="guardar" wire:click="update()" class="btn btn-primary"
                                                type="button">Modificar</button>
                                            <br>


                                        </div>
                                        <div role="alert" id="update_message" style="display: none"
                                            class="alert alert-success mx-auto">Registro modificado correctamente</div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-3">

                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Buscar"
                                                        wire:model="busqueda_actividad">
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"
                                                    style="text-align: left">
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#create_actividad"
                                                        wire:click="create_actividad()">+</button>
                                                </div>
                                            </div>

                                            <br>
                                            <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Ticket</th>
                                                        <th>Usuario</th>
                                                        <th>Descripción</th>
                                                        <th>Avance</th>
                                                        <th>Ponderación</th>
                                                        <th>Estado</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($actividades)
                                                        @foreach ($actividades as $actividad)
                                                            <tr>
                                                                <td>{{ $actividad->id }}</td>
                                                                <td>{{ $actividad->numero_ticket }}</td>
                                                                <td style="text-align: left"><img
                                                                        src="{{ URL('/') . '/images/xs/avatar3.jpg' }}"
                                                                        class="avatar sm rounded-circle me-2"
                                                                        alt="profile-image"><span>
                                                                        @if ($actividad->usuario)
                                                                            {{ $actividad->usuario->name }}
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td style="text-align: left">
                                                                    {{ $actividad->descripcion }}</td>
                                                                <td>
                                                                    <div class="progress" style="height: 20px;">
                                                                        <div class="progress-bar progress-bar-warning"
                                                                            role="progressbar" aria-valuenow="40"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: 100%;">
                                                                            {{ $actividad->porcentaje }}%
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $actividad->ponderacion }}</td>
                                                                <td><span class="badge bg-info">
                                                                        @if ($actividad->estado_id)
                                                                            {{ $actividad->estado->nombre }}
                                                                        @endif
                                                                    </span>

                                                                </td>
                                                                <td>
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic outlined example">
                                                                        <button type="button"
                                                                            class="btn btn-success"><i
                                                                                class="icofont-edit fa-lg"
                                                                                data-bs-toggle="modal"
                                                                                wire:click="edit_actividad({{ $actividad->id }})"
                                                                                data-bs-target="#edit_actividad"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Row End -->
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div id="create_actividad" wire:ignore.self class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nueva actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Ticket</label>
                            <input type="number" wire:model.defer="numero_ticket" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Ponderacion</label>
                            <input type="number" step="0.01" wire:model.defer="ponderacion"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea class="form-control" wire:model.defer="descripcion_actividad"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" wire:model.defer="fecha_inicio" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select wire:model.defer="categoria_id" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($categorias as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" wire:model.defer="estado_actividad_id"
                                aria-label="Default select Project Category">
                                @foreach ($estados_actividad as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prioridad</label>
                            <select class="form-select" wire:model.defer="prioridad_id"
                                aria-label="Default select Project Category">
                                @foreach ($prioridades as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Fecha final</label>
                            <input type="date" wire:model.defer="fecha_fin" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Forma</label>
                            <input type="text" wire:model.defer="forma" class="form-control">
                        </div>




                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <select class="form-select" wire:model.defer="users_id"
                                aria-label="Default select Project Category">
                                <option value="">Seleccione</option>
                                @foreach ($usuarios as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="store_actividad()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_actividad" wire:ignore.self class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel">Modificar actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <input type="hidden" wire:model.defer="id_actividad">
                        <div class="mb-3">
                            <label class="form-label">Ticket</label>
                            <input type="number" wire:model.defer="numero_ticket" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Ponderacion</label>
                            <input type="number" step="0.01" wire:model.defer="ponderacion"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea class="form-control" wire:model.defer="descripcion_actividad"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" wire:model.defer="fecha_inicio" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select wire:model.defer="categoria_id" class="form-control select2">
                                <option value="">Seleccione</option>
                                @foreach ($categorias as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" wire:model.defer="estado_actividad_id"
                                aria-label="Default select Project Category">
                                @foreach ($estados as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prioridad</label>
                            <select class="form-select" wire:model.defer="prioridad_id"
                                aria-label="Default select Project Category">
                                @foreach ($prioridades as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="mb-3">
                            <label class="form-label">Fecha final</label>
                            <input type="date" wire:model.defer="fecha_fin" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Forma</label>
                            <input type="text" wire:model.defer="forma" class="form-control">
                        </div>




                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <select class="form-select" wire:model.defer="users_id"
                                aria-label="Default select Project Category">
                                <option value="">Seleccione</option>
                                @foreach ($usuarios as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="update_actividad()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                                <h5 class="fw-bold mb-0"> PROYECTOS
                                    @if (auth()->user()->rol_id == 6)
                                        DE {{ $unidad->nombre }}<br>
                                    @endif



                                </h5>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-11  col-11">
                                <input type="text" class="form-control" placeholder="Buscar"
                                    wire:model="busqueda">
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1" style="text-align: left">
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



                <div class="row taskboard ">
                    @if ($tipo == 1)
                        @foreach ($estados as $estado)
                            <div
                                class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4">
                                <div class="card border-{{ $estado->color }}">
                                    <h6 class="fw-bold py-3 mb-0">{{ $estado->nombre }}</h6>
                                </div>
                                <div class="{{ $colors[$estado->id] }} col-lg-12 col-md-12">
                                    <div class="dd" data-plugin="nestable">
                                        <ol class="dd-list">
                                            @foreach ($proyectos as $proyecto)
                                                @if ($proyecto->estado_id == $estado->id)
                                                    <div class="dd-handle" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalFullscreen"
                                                        wire:click="edit({{ $proyecto->id }})">
                                                        <div
                                                            class="task-info d-flex align-items-center justify-content-between">
                                                            <!--<h6
                                                        class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                        <i class="icofont-ui-edit fa-lg"
                                                            wire:click="edit({{ $proyecto->id }})"
                                                            class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_proyecto"></i>

                                                    </h6>
                                                    <span>
                                                        <h6><strong>{{ $proyecto->id }}</strong></h6>
                                                    </span>-->
                                                        </div>
                                                        <p class="py-2 mb-0"> <strong>{{ $proyecto->nombre }}</strong>
                                                        </p>
                                                        <p class="py-2 mb-0">{{ $proyecto->descripcion }}</p>
                                                        <div class="tikit-info row g-3 align-items-center">

                                                            <div class="col-sm text-end">

                                                                <div class="d-flex align-items-center">
                                                                    @if ($proyecto->id != 9 && $proyecto->id != 11)
                                                                        @if ($proyecto->avance < 50)
                                                                            <div class="progress"
                                                                                style="height: 20px; width: 150px;">
                                                                                <div class="progress-bar bg-danger"
                                                                                    role="progressbar"
                                                                                    style="width: 50%"
                                                                                    aria-valuenow="60"
                                                                                    aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    {{ $proyecto->avance }}%</div>
                                                                            </div>
                                                                        @elseif($proyecto->avance < 70)
                                                                            <div class="progress"
                                                                                style="height: 20px; width: 150px;">
                                                                                <div class="progress-bar bg-warning"
                                                                                    role="progressbar"
                                                                                    style="width: {{ $proyecto->avance }}%"
                                                                                    aria-valuenow="60"
                                                                                    aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    {{ $proyecto->avance }}%</div>
                                                                            </div>
                                                                        @else
                                                                            <div class="progress"
                                                                                style="height: 20px; width: 150px;">
                                                                                <div class="progress-bar bg-success"
                                                                                    role="progressbar"
                                                                                    style="width: {{ $proyecto->avance }}%"
                                                                                    aria-valuenow="60"
                                                                                    aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    {{ $proyecto->avance }}%</div>
                                                                            </div>
                                                                        @endif
                                                                    @endif


                                                                </div>
                                                            </div>
                                                            <div class="col-sm text-end">
                                                                <!--<div class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"
                                                            wire:click="actividad_show({{ $proyecto->id }})">
                                                            <strong><i class="icofont-eye fa-lg"></i>
                                                                Actividades</strong>
                                                        </div>-->

                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach


                                        </ol>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($estados as $estado)
                            <div class="card"  data-plugin="nestable">
                                <h6 class="fw-bold py-3 mb-0" style="text-align: left; border-top-color: coral">{{ $estado->nombre }}</h6>

                                <table class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Avance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proyectos as $proyecto)
                                            @if ($proyecto->estado_id == $estado->id)
                                                <tr style="text-align: left"  data-bs-toggle="modal"
                                                data-bs-target="#exampleModalFullscreen"
                                                wire:click="edit({{ $proyecto->id }})">
                                                    <td>{{ $proyecto->id }}</td>
                                                    <td>{{ $proyecto->nombre }}</td>
                                                    <td>{{ $proyecto->descripcion }}</td>
                                                    <td>
                                                        @if ($proyecto->id != 9 && $proyecto->id != 11)
                                                            @if ($proyecto->avance < 50)
                                                                <div class="progress"
                                                                    style="height: 20px; width: 150px;">
                                                                    <div class="progress-bar bg-danger"
                                                                        role="progressbar"
                                                                        style="width: 50%"
                                                                        aria-valuenow="60"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        {{ $proyecto->avance }}%</div>
                                                                </div>
                                                            @elseif($proyecto->avance < 70)
                                                                <div class="progress"
                                                                    style="height: 20px; width: 150px;">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar"
                                                                        style="width: {{ $proyecto->avance }}%"
                                                                        aria-valuenow="60"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        {{ $proyecto->avance }}%</div>
                                                                </div>
                                                            @else
                                                                <div class="progress"
                                                                    style="height: 20px; width: 150px;">
                                                                    <div class="progress-bar bg-success"
                                                                        role="progressbar"
                                                                        style="width: {{ $proyecto->avance }}%"
                                                                        aria-valuenow="60"
                                                                        aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        {{ $proyecto->avance }}%</div>
                                                                </div>
                                                            @endif
                                                        @endif


                                                    </div>


                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                           <div>&nbsp;</div>
                        @endforeach
                </div>

                @endif





            </div>

        </div>
    </div>
</div>


@if (auth()->user()->rol_id != 6)
    <div class="contenedor">
        <button class="botonF1" wire:click="create()" data-bs-toggle="modal" data-bs-target="#create_proyecto">
            <span>+</span>
        </button>
    </div>
@endif


</div>


<script type="text/javascript">
    window.addEventListener('close-modal', (e) => {
        $('#create_proyecto').modal('hide')
    });

    window.addEventListener('close-modal-edit', (e) => {
        $('#edit_proyecto').modal('hide')
    });

    window.addEventListener('update-message-show', (e) => {
        $('#update_message').show();
    });

    window.addEventListener('update-message-hide', (e) => {
        $('#update_message').hide();
    });

    window.addEventListener('close-modal-create-actividad', (e) => {
        $('#create_actividad').modal('hide');
    });

    window.addEventListener('close-modal-edit-actividad', (e) => {
        $('#edit_actividad').modal('hide');
    });

    window.addEventListener('error-message-proyecto', (e) => {
        $('#error-proyecto').hide();
    });

    window.addEventListener('error-message-proyecto-show', (e) => {
        $('#error-proyecto').show();
    });
</script>
