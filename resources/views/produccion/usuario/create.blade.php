@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">

                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0"> Crear Usuario</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('usuario') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Row end  -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="basic-form" method="POST" action="{{ url('usuario') }}">
                            @csrf
                            <!-- Modal body -->
                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" required name="name" id="name">
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" required name="user_name" id="user_name">
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Correo</label>
                                    <input type="text" class="form-control" required name="email" id="email">
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Clave</label>
                                    <input type="password" class="form-control" required name="password">
                                </div>
                            </div>


                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Roles</label>
                                    <select name="rol_id" id ="rol_id" class="form-control" required>
                                        @foreach ($rol as $object)
                                            <option value="{{ $object->id }}">{{ $object->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label for="name" class="form-label">Unidades</label>
                                    <select name="unidad_id" id ="unidad_id" class="form-control" required>
                                        @foreach ($unidad as $object)
                                            <option value="{{ $object->id }}">{{ $object->nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="p-6 space-y-4">
                                <div class="input-area">
                                    <label class="form-label col-md-3" align="right"></label>
                                    <div class="col-12" align="right">
                                        <button type="submit" class="btn btn-primary float-right">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <script>
        // project data table id bigint UN AI PK







        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
        });
    </script>

@endsection
