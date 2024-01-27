@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])






    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Modificar usuario</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('usuario') }}">
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form id="basic-form" method="POST" action="{{ route('usuario.update', $user->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="p-6 space-y-4">
                                    <div class="input-area">
                                        <label for="name" class="form-label">Nombre</label>

                                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                                            required class="form-control">

                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" required name="user_name"
                                                id="user_name" value="{{ $user->user_name }}" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Correo</label>
                                            <input type="text" class="form-control" required name="email"
                                                id="email" value="{{ $user->email }}" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Clave</label>
                                            <input type="password" class="form-control" name="password " id="password "
                                                class="form-control">
                                        </div>
                                    </div>




                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Unidades</label>
                                            <select name="unidad_id" id ="unidad_id" class="form-control" required>
                                                @foreach ($unidad as $obj)
                                                    @if ($obj->id == $user->unidad_id)
                                                        <option value="{{ $obj->id }}" selected>
                                                            {{ $obj->nombre }}</option>
                                                    @else
                                                        <option value="{{ $obj->id }}">
                                                            {{ $obj->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Estado</label>
                                            <select name="estado" id="estado" required class="form-control">
                                                <option value="I">Inactivo</option>
                                                <option value="A" selected>Activo</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div>&nbsp;</div>
                                    <div class="p-6 space-y-4">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3" align="right"></label>
                                                <div class="col-12" align="right">
                                                    <button type="submit"
                                                        class="btn btn-primary float-right">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                            </form>
                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->

        </div>
    </div>




    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Roles</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                                        data-bs-target="#modal-add-rol">Agregar rol</button>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            @if ($rol->count() > 0)

                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead class=" border-t border-slate-100 dark:border-slate-800">
                                        <tr>
                                            <th style="text-align: center">Id</th>
                                            <th style="text-align: center">Rol</th>
                                            <th style="text-align: center">opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $obj)
                                            <tr>
                                                <td align="center">{{ $obj->id }}</td>
                                                <td align="center">{{ $obj->name }}</td>
                                                <td align="center">
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic outlined example">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modal-rol-{{ $obj->id }}"
                                                            class="btn btn-outline-secondary"><i
                                                                class="icofont-ui-delete text-danger btn-lg"></i></button>
                                                    </div>
                                                    &nbsp;&nbsp;

                                                </td>
                                            </tr>
                                            @include('produccion.usuario.modal_delete_rol')
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
    @include('produccion.usuario.agregar_roles')





    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
