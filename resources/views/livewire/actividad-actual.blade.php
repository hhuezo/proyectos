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
                                Actividades en proceso
                            </h5>

                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
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
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Proyecto</th>
                            <th width="25%">Actividad</th>
                            <th>Cuenta</th>
                            <th>Avance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($registros as $registro)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $registro->user_name }}</td>
                                <td>{{ $registro->name }}</td>
                                <td style="text-align: left">{{ $registro->proyecto}}</td>
                                <td style="text-align: left">{{ $registro->actividad }}</td>
                                <td>1</td>
                                <td>{{ $registro->porcentaje }}%</td>
                            </tr>
                            @php($i++)
                        @endforeach

                    </tbody>
                </table>






            </div>


        </div>



        <div id="create_categoria" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nueva categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Codigo</label>
                                <input type="text" wire:model.defer="codigo" class="form-control">
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Categoria</label>
                                <input type="text" wire:model.defer="nombre" class="form-control">

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

        <div id="edit_categoria" wire:ignore.self class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header col">
                        <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Editar categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Codigo</label>
                                <input type="text" wire:model.defer="codigo" class="form-control">
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Categoria</label>
                                <input type="text" wire:model.defer="nombre" class="form-control">
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





    </div>
    <script src="{{ asset('assets/jquery.min.js') }}"></script>

    <script type="text/javascript">
        window.addEventListener('success-alert', (e) => {
            Swal.fire({
                //position: 'top-end',
                icon: 'success',
                title: 'Registro agregado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        });

        window.addEventListener('success-alert-edit', (e) => {
            Swal.fire({
                //position: 'top-end',
                icon: 'success',
                title: 'Registro actualizado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        });

        window.addEventListener('close-modal', (e) => {
            $('#create_categoria').modal('hide')
        });


        window.addEventListener('close-modal-edit', (e) => {
            $('#edit_categoria').modal('hide')
        });
    </script>
</div>
