@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
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
                                Actividades finalizadas<br>


                            </h5>

                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            @if (auth()->user()->hasPermissionTo('ver finalizadas'))
                                <select name="usuario" id="usuario" class="form-control" wire:model="usuario">
                                    @foreach ($usuarios as $obj)
                                        @if ($obj->estado = 'A')
                                            <option value="{{ $obj->user_name }}">{{ $obj->user_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                &nbsp;
                            @endif
                            <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">


                            &nbsp;
                            <input type="date" class="form-control" wire:model="fechainicio">
                            &nbsp;
                            <input type="date" class="form-control" wire:model="fechafin">
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="text-align: left">

                        </div>

                    </div>
                </div>
            </div>

            <div class="row taskboard g-3 py-xxl-4">
                <!--taskboard-->

                <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ticket</th>
                            <th>Proyecto</th>
                            <th>Actividad</th>
                            <th>Usuario</th>
                            <th>Porcentaje</th>
                            <th>Estado</th>
                            <th>Tiempo (minutos)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actividades as $actividad)
                            <tr style="text-align: left">
                                <td>{{ $actividad->id }}</td>
                                <td>{{ $actividad->numero_ticket }}</td>
                                <td>{{ $actividad->proyecto }}</td>
                                <td>{{ $actividad->actividad }}</td>
                                <td><img src="{{ URL('/') . '/images/xs/avatar3.jpg' }}"
                                        class="avatar sm rounded-circle me-2" alt="profile-image"><span>
                                        {{ $actividad->user_name }}
                                    </span>
                                </td>

                                <td>
                                    <div class="progress" style="height: 20px;"
                                        @if ($actividad->estado_id == 3) onclick="modal_avance()" @endif>
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 100%;">
                                            {{ $actividad->porcentaje }}%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $actividad->estado }}
                                </td>
                                <td style="text-align: center"> {{ $actividad->minutos }}</td>
                                <td align="center">
                                    <button type="button" data-bs-toggle="modal"
                                        wire:click="edit({{ $actividad->id }})" data-bs-target="#modal_proyectos"><i
                                            class="icofont-edit"></i></button>
                                            &nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('actividades_finalizadas') }}/{{ $actividad->id }}"> <i
                                            class="icofont-search-2 fa-2x"></i></a>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
        <div id="modal_proyectos" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Modificar el
                            proyecto en la Actividad Seleccionada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body row">

                        <div class="card">
                            <div class="modal-body">
                                <p>
                                    Seleccionar el Proyecto
                                <div class="input-area relative">
                                    <label for="largeInput" class="form-label">Proyectos</label>
                                    <select class="form-control" wire:model="id_proyecto">
                                        @foreach ($proyectos as $obj)
                                            <option value="{{ $obj->id }}" selected>
                                                {{ $obj->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-primary" wire:click="update()">Guardar</button>
                                </div>
                            </div>





                        </div>


                    </div>

                </div>
            </div>
        </div>



    </div>
    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('close-modal', (e) => {
            $('#modal_proyectos').modal('hide')
        });
    </script>

</div>
