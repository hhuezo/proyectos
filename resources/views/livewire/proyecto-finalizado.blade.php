<div style="text-align: center">
    <style>
        .dd-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>




    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                                <h5 class="fw-bold mb-0">PROYECTOS FINALIZADOS
                                    @if (auth()->user()->rol_id == 6)
                                        DE {{ $unidad->nombre }}<br>
                                    @endif
                                </h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
                            </div>


                        </div>
                    </div>

                </div>

                <div class="row col-lg-12 col-md-12 col-md-12 col-xs-12">
                    @foreach ($proyectos as $proyecto)
                        <div class=" taskboard g-3 col-lg-3 col-md-3 col-md-6 col-xs-6">
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen"
                                    wire:click="edit({{ $proyecto->id }})">
                                    <div class="task-info d-flex align-items-center justify-content-between">

                                    </div>
                                    <p class="py-2 mb-0"> <strong>{{ $proyecto->nombre }}</strong>
                                    </p>
                                    <p class="py-2 mb-0">{{ $proyecto->descripcion }}</p>
                                    <div class="tikit-info row g-3 align-items-center">

                                        <div class="col-sm text-end">

                                            <div class="d-flex align-items-center">
                                                @if ($proyecto->id != 9 && $proyecto->id != 11)
                                                    @if ($proyecto->avance < 50)
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 50%" aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $proyecto->avance }}%</div>
                                                        </div>
                                                    @elseif($proyecto->avance < 70)
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: {{ $proyecto->avance }}%"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $proyecto->avance }}%</div>
                                                        </div>
                                                    @else
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: {{ $proyecto->avance }}%"
                                                                aria-valuenow="60" aria-valuemin="0"
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


                            </li>
                        </div>
                    @endforeach

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
                    <h5 class="modal-title h4" id="exampleModalFullscreenLabel" style="text-align: left;">{{$nombre}} <br>

                        <div class="col-12">

                            @if ($avance < 50)
                                <div class="progress" style="height: 20px; width: 250px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        {{ $avance }}% de {{ $ponderacion }}</div>
                                </div>
                            @elseif($avance < 70)
                                <div class="progress" style="height: 20px; width: 250px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $avance }}%" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ $avance }}% de {{ $ponderacion }}</div>
                                </div>
                            @else
                                <div class="progress" style="height: 20px; width: 250px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $avance }}%" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ $avance }}% de {{ $ponderacion }}</div>
                                </div>
                            @endif
                        </div>
                    </h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="list-view">

                            <div class="row clearfix g-3">


                                    <div class="card mb-3">

                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Buscar"
                                                        wire:model="busqueda_actividad">
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
</div>
