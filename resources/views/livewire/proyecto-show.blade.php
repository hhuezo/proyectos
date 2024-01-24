<div style="text-align: center">
    <style>
        .dd-item:hover {
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
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">

        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                            <h5 class="fw-bold mb-0">
                                <a href="{{ url('proyecto/') }}"><i class="icofont-arrow-left fa-lg"></i></a>
                                {{ $proyecto->nombre }}
                            </h5>
                            @if ($proyecto->avance < 50)
                                <div class="progress" style="height: 20px; width: 400px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        <strong> {{ number_format($proyecto->avance, 2, '.', '') }}% de
                                            {{ $ponderacion_total }}</strong>
                                    </div>
                                </div>
                            @elseif($proyecto->avance < 70)
                                <div class="progress" style="height: 20px; width: 400px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $proyecto->avance }}%" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <strong> {{ number_format($proyecto->avance, 2, '.', '') }}% de
                                            {{ $ponderacion_total }}</strong>
                                    </div>
                                </div>
                            @else
                                <div class="progress" style="height: 20px; width: 400px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $proyecto->avance }}%" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <strong> {{ number_format($proyecto->avance, 2, '.', '') }}% de
                                            {{ $ponderacion_total }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
                        </div>
                        @if ($tipo == 1)
                            <button class="btn btn-primary" style="height: 38px" wire:click="changeType"><i
                                    class="icofont-listine-dots fa-lg"></i></button>
                        @else
                            <button class="btn btn-primary" style="height: 38px" wire:click="changeType"><i
                                    class="icofont-penalty-card fa-lg"></i></button>
                        @endif
                        <div class="btn btn-info" style="height: 38px" data-bs-toggle="modal"
                        wire:click="edit_proyecto({{ $proyecto->id }})"
                        data-bs-target="#edit_proyecto"><i class="icofont-edit"></i></div>
                    </div>
                </div>
            </div>

            <div class="row taskboard g-3 py-xxl-4">
                <!--taskboard-->


                @if ($tipo == 1)



                    @foreach ($estados as $estado)
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 mt-xxl-3 mt-xl-3 mt-lg-3 mt-md-3 mt-sm-6 mt-6">
                            <div class="col-lg-12 col-md-12">
                                <h6 class="fw-bold py-3 mb-0">{{ $estado->nombre }}</h6>
                            </div>

                            <div class="{{ $colors[$estado->id] }} col-lg-12 col-md-12">

                                <ol class="dd-list">
                                    @foreach ($actividades as $actividad)
                                        @if ($actividad->estado_id == $estado->id)
                                            <li class="dd-item" data-id="1">
                                                <div class="dd-handle">

                                                    <div
                                                        class="task-info d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="task-priority d-flex flex-column align-items-center justify-content-center">

                                                            <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"
                                                                data-bs-toggle="modal"
                                                                wire:click="edit({{ $actividad->id }})"
                                                                data-bs-target="#edit_actividad">
                                                                <i class="icofont-ui-edit fa-lg"></i> &nbsp;
                                                                {{ $actividad->id }}
                                                            </h6>
                                                        </div>
                                                        <div
                                                            class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                @if ($actividad->users_id)
                                                                    @if ($actividad->usuario)
                                                                        <img class="avatar rounded-circle small-avt"
                                                                            src="{{ url('/images/users') }}/{{ $actividad->usuario->image }}"
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
                                                                @if ($actividad->users_id)
                                                                    @if ($actividad->usuario)
                                                                        {{ $actividad->usuario->name }}
                                                                    @endif
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0" style="text-align: left;">
                                                        {{ $actividad->descripcion }}</p>
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
                                                                        class="d-flex align-items-center text-{{ $actividad->prioridad->color }}">
                                                                        <i class="icofont-flag"></i>
                                                                        <span class="ms-1"><strong>
                                                                                @if ($actividad->prioridad)
                                                                                    {{ $actividad->prioridad->nombre }}
                                                                                @endif
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
                                                                    <div class="d-flex align-items-center">

                                                                        @if ($actividad->porcentaje < 50)
                                                                            <div class="progress"
                                                                                style="height: 20px; width: 150px;">
                                                                                <div class="progress-bar bg-danger"
                                                                                    role="progressbar"
                                                                                    style="width: 50%"
                                                                                    aria-valuenow="60" aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    {{ $actividad->porcentaje }}%</div>
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
                                                                                    {{ $actividad->porcentaje }}%</div>
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
                                                                                    {{ $actividad->porcentaje }}%</div>
                                                                            </div>
                                                                        @endif

                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm text-end">

                                                            <i class="icofont-check-circled"></i>
                                                            <span class="ms-1"><strong>Ponderacion:
                                                                    {{ $actividad->ponderacion }}</strong></span>
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
                @else
                    <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
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
                            @foreach ($actividades as $actividad)
                                <tr>
                                    <td>{{ $actividad->id }}</td>
                                    <td>{{ $actividad->numero_ticket }}</td>
                                    <td><img src="{{ URL('/') . '/images/xs/avatar3.jpg' }}"
                                            class="avatar sm rounded-circle me-2" alt="profile-image"><span>
                                            @if ($actividad->usuario)
                                                {{ $actividad->usuario->name }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $actividad->descripcion }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 100%;">
                                                {{ $actividad->porcentaje }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $actividad->ponderacion }}</td>
                                    <td><span class="badge bg-{{ $actividad->estado->color }}">
                                            @if ($actividad->estado_id)
                                                {{ $actividad->estado->nombre }}
                                            @endif
                                        </span>

                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-secondary"><i
                                                    class="icofont-edit text-success" data-bs-toggle="modal"
                                                    wire:click="edit({{ $actividad->id }})"
                                                    data-bs-target="#edit_actividad"></i></button>
                                            <button type="button" class="btn btn-outline-secondary deleterow"><i
                                                    class="icofont-ui-delete text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>



                @endif


            </div>


        </div>
        @if (auth()->user()->rol_id != 6)
            <div class="contenedor">

                <button class="botonF1" wire:click="create()" data-bs-toggle="modal"
                    data-bs-target="#create_actividad">
                    <span>+</span>
                </button>

            </div>
        @endif






        <div id="edit_actividad" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel">Modificar actividad</h5>
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
                                <textarea class="form-control" wire:model.defer="descripcion"></textarea>
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
                                <select class="form-select" wire:model.defer="estado_id"
                                    aria-label="Default select Project Category">
                                    <option value="">Seleccione</option>
                                    @foreach ($estados as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prioridad</label>
                                <select class="form-select" wire:model.defer="prioridad_id"
                                    aria-label="Default select Project Category">
                                    <option value="">Seleccione</option>
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
                                @if (auth()->user()->unidad_id == 9)
                                    <label for="multiSelect" class="form-label">Area Administrativa</label>
                                    <select wire:model.defer="area_id" required
                                        class="select2 form-control w-full mt-2 py-2">
                                        <option value="">Seleccione</option>

                                        @if (isset($areas))
                                            @foreach ($areas as $obj)
                                                <option value="{{ $obj->id }}"
                                                    class=" inline-block font-Inter font-normal text-sm text-slate-600">
                                                    {{ $obj->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" name="forma" value="NO APLICA" class="form-control">
                                @else
                                    <label class="form-label">Forma</label>
                                    <input type="text" wire:model.defer="forma" class="form-control">
                                @endif
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
                        <button class="btn btn-primary" wire:click="update()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="create_actividad" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nueva actividad</h5>
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
                                <textarea class="form-control" wire:model.defer="descripcion"></textarea>
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
                                <select class="form-select" wire:model.defer="estado_id"
                                    aria-label="Default select Project Category">
                                    <option value="">Seleccione</option>
                                    @foreach ($estados as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prioridad</label>
                                <select class="form-select" wire:model.defer="prioridad_id"
                                    aria-label="Default select Project Category">
                                    <option value="">Seleccione</option>
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
                                @if (auth()->user()->unidad_id == 9)
                                    <label for="multiSelect" class="form-label">Area Administrativa</label>
                                    <select wire:model.defer="area_id" required
                                        class="select2 form-control w-full mt-2 py-2">
                                        <option value="">Seleccione</option>

                                        @if (isset($areas))
                                            @foreach ($areas as $obj)
                                                <option value="{{ $obj->id }}"
                                                    class=" inline-block font-Inter font-normal text-sm text-slate-600">
                                                    {{ $obj->nombre }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <input type="hidden" name="forma" value="NO APLICA" class="form-control">
                                @else
                                    <label class="form-label">Forma</label>
                                    <input type="text" wire:model.defer="forma" class="form-control">
                                @endif
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
                        <button class="btn btn-primary" wire:click="store()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


        <div id="edit_proyecto" wire:ignore.self tabindex="-1" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel">Modificar proyecto</h5>
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
                            <input type="hidden" wire:model.defer="id_proyecto">
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
                        <button class="btn btn-primary" wire:click="update_proyecto()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        window.addEventListener('close-modal', (e) => {
            $('#create_actividad').modal('hide')
        });

        window.addEventListener('close-modal-edit', (e) => {
            $('#edit_actividad').modal('hide')
        });

        window.addEventListener('close-modal-proyecto', (e) => {
            $('#edit_proyecto').modal('hide')
        });

        //edit_proyecto
    </script>
</div>
