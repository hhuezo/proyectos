@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')




    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Modificar rol</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('produccion/rol') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
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
                            <form method="POST" action="{{ route('rol.update', $rol->id) }}" enctype="multipart/form-data">
                                @method('PUT')

                                @csrf
                                <div class="input-area relative pl-28">
                                    <label for="largeInput" class="inline-inputLabel">Nombre</label>
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ $rol->name }}"
                                        class="form-control">
                                </div>

                                <div class="col-12">
                                    &nbsp;
                                </div>

                                <div class="input-area relative pl-28">
                                    <div style="text-align: right;">
                                        <button type="submit"
                                            class="btn inline-flex justify-center btn-dark">Aceptar</button>
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
                                <h4 class="fw-bold mb-0">Permisos</h4>
                                <div class="col-auto d-flex w-sm-100">

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
                            <form action="{{ url('produccion/rol/link_permission') }}" method="POST" class="space-y-4">
                                @csrf

                                <div class="input-area relative pl-28">
                                    <input type="hidden" name="role_id" id="role_id" value="{{ $rol->id }}">
                                    <label for="largeInput" class="inline-inputLabel">Agregar permiso</label>
                                    <div class="col-12">
                                        &nbsp;
                                    </div>
                                    <select name="permission_id" class="form-control select2">
                                        @foreach ($permissions as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                &nbsp;
                                <div
                                    class=" items-center p-6 space-x-2 border-t border-slate-200 rounded-b black:border-slate-600">
                                    <button style="margin-bottom: 15px"
                                        class="btn inline-flex justify-center btn-dark ml-28 float-right">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>

    <div class="card mb-3">
<div class="card-body">
    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>permiso</th>
                <th>eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rol->permissions_has_role as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->name }}</td>
                    <td> <button type="button" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-{{ $obj->id }}"
                            class="btn btn-outline-secondary"><i
                                class="icofont-ui-delete text-danger btn-lg"></i></button>
                    </td>
                </tr>
                @include('produccion.rol.modal')
            @endforeach

        </tbody>
    </table>
</div>
</div>


    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>

    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    order: false,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });

           // $('#myProjectTable').DataTable().order([1, 'asc']).draw();
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
