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
                                Usuarios
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
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Unidad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr style="text-align: left">
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>
                                    @if ($usuario->image)
                                        <img src="{{ URL('/') . '/images/users/' . $usuario->image }}"
                                            class="avatar sm rounded-circle me-2" alt="profile-image">
                                    @endif

                                    <span>
                                        {{ $usuario->user_name }}
                                    </span>
                                </td>
                                <td style="text-align: left">{{ $usuario->email }}</td>
                                <td>
                                    @if ($usuario->rol_id)
                                        {{ $usuario->rol->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($usuario->unidad_id)
                                        {{ $usuario->unidad->nombre }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success"><i class="icofont-edit  fa-lg"
                                            data-bs-toggle="modal" wire:click="edit({{ $usuario->id }})"
                                            data-bs-target="#modal_edit"></i></button>

                                    <button type="button" class="btn btn-warning"><i class="icofont-lock  fa-lg"
                                            data-bs-toggle="modal" wire:click="edit({{ $usuario->id }})"
                                            data-bs-target="#modal_reset"></i></button>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>






            </div>


        </div>





        <div class="contenedor"
            style="width: 90px;
        height: 240px;
        position: absolute;
        right: 0px;
        bottom: 0px;">

            <button class="botonF1" wire:click="create()" data-bs-toggle="modal" data-bs-target="#modal_create"
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





    <div id="modal_create" wire:ignore.self class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nuevo usuario</h5>
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
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Nombre</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Usuario</label>
                            <input type="text" step="0.01" wire:model.defer="user_name" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">email</label>
                            <input type="email" wire:model.defer="email" class="form-control">
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Password</label>
                            <input type="text" wire:model.defer="password" class="form-control">
                        </div>





                    </div>

                    <div class="mb-3" style="text-align: left">
                        <label class="form-label">Rol</label>
                        <select wire:model.defer="rol_id" class="form-select">
                            <option value="">Seleccione</option>
                            @foreach ($roles as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" style="text-align: left">
                        <label class="form-label">Unidad</label>
                        <select class="form-select" wire:model.defer="unidad_id"
                            aria-label="Default select Project Category">
                            <option value="">Seleccione</option>
                            @foreach ($unidades as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="store()">Guardar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modal_edit" wire:ignore.self class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Editar usuario</h5>
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
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Nombre</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Usuario</label>
                            <input type="text" step="0.01" wire:model.defer="user_name" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">email</label>
                            <input type="email" wire:model.defer="email" class="form-control">
                        </div>
                    </div>


                    <div class="mb-3" style="text-align: left">
                        <label class="form-label">Rol</label>
                        <select wire:model.defer="rol_id" class="form-select">
                            <option value="">Seleccione</option>
                            @foreach ($roles as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3" style="text-align: left">
                        <label class="form-label">Unidad</label>
                        <select class="form-select" wire:model.defer="unidad_id"
                            aria-label="Default select Project Category">
                            <option value="">Seleccione</option>
                            @foreach ($unidades as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="update()">Guardar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modal_reset" wire:ignore.self class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Reset password</h5>
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
                        <div class="mb-3" style="text-align: left">
                            <label class="form-label">Password</label>
                            <input type="text" wire:model.defer="password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="reset_pass()">Guardar</button>
                </div>
            </div>

        </div>
    </div>
</div>










<script type="text/javascript">
    window.addEventListener('success-alert', (e) => {
        Swal.fire({
            //position: 'top-end',
            icon: 'success',
            title: 'Registro ingresado correctamente',
            showConfirmButton: false,
            timer: 1500
        })
    });

    window.addEventListener('success-alert-edit', (e) => {
        Swal.fire({
            //position: 'top-end',
            icon: 'success',
            title: 'Registro modificado correctamente',
            showConfirmButton: false,
            timer: 1500
        })
    });

    window.addEventListener('close-modal', (e) => {
        $('#modal_create').modal('hide')
    });

    window.addEventListener('close-modal-edit', (e) => {
        $('#modal_edit').modal('hide')
    });

    window.addEventListener('close-modal-reset', (e) => {
        $('#modal_reset').modal('hide')
    });
</script>
</div>
