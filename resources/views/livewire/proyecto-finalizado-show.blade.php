<div style="text-align: center">
    <style>
        .dd-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
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
                                <a href="{{ url('proyecto_finalizado/') }}"><i class="icofont-arrow-left fa-lg"></i></a>
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

                    </div>
                </div>
            </div>

            <div class="row taskboard g-3 py-xxl-4">
                <!--taskboard-->


                @if ($tipo == 1)




                    <div class="row col-lg-12 col-md-12 col-md-12 col-xs-12">


                        @foreach ($actividades as $actividad)
                            <div class=" taskboard g-3 col-lg-3 col-md-3 col-md-6 col-xs-6">

                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle">

                                        <div class="task-info d-flex align-items-center justify-content-between">
                                            <div
                                                class="task-priority d-flex flex-column align-items-center justify-content-center">

                                                <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"
                                                    data-bs-toggle="modal" wire:click="edit({{ $actividad->id }})"
                                                    data-bs-target="#edit_actividad">

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
                                        <p class="py-2 mb-0" style="text-align: left;">{{ $actividad->descripcion }}
                                        </p>
                                        <div class="tikit-info row g-3 align-items-center">
                                            <div class="col-sm">
                                                <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                    <li class="me-6">
                                                        <div class="d-flex align-items-center">
                                                            <strong>{{ date('d/m/Y', strtotime($actividad->fecha_inicio)) }}
                                                                - {{ date('d/m/Y', strtotime($actividad->fecha_fin)) }}
                                                            </strong>
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
                                                                        role="progressbar" style="width: 50%"
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
                                                                        aria-valuenow="60" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        {{ $actividad->porcentaje }}%</div>
                                                                </div>
                                                            @else
                                                                <div class="progress"
                                                                    style="height: 20px; width: 150px;">
                                                                    <div class="progress-bar bg-success"
                                                                        role="progressbar"
                                                                        style="width: {{ $actividad->porcentaje }}%"
                                                                        aria-valuenow="60" aria-valuemin="0"
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
                            </div>
                        @endforeach


                    </div>
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
                                    <td><span class="badge bg-info">
                                            @if ($actividad->estado_id)
                                                {{ $actividad->estado->nombre }}
                                            @endif
                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>



                @endif


            </div>


        </div>


    </div>
</div>
