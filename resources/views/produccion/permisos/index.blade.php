@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="card">
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0"> Permisos</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('produccion/permisos/create') }}">
                                    {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                            class="icofont-plus-circle me-2 fs-6"></i>Nuevo</button>
                                </a>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>nombre</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($permissions->count() > 0)
                                                @foreach ($permissions as $obj)
                                                    <tr class="even:bg-slate-50 black:even:bg-slate-700">
                                                        <td align="center">{{ $obj->id }}</td>
                                                        <td align="center">{{ $obj->name }}</td>
                                                        <td align="center">
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <a href="{{url('produccion/permisos')}}/{{$obj->id}}/edit">
                                                                    {{-- data-bs-toggle="modal" data-bs-target="#edittickit" --}}
                                                                    <button type="button" class="btn btn-outline-secondary"><i
                                                                            class="icofont-edit text-success btn-lg"></i></button>
                                                                </a>
                                                                <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{$obj->id}}" class="btn btn-outline-secondary"><i
                                                                        class="icofont-ui-delete text-danger btn-lg"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                      @include('produccion.permisos.modal')
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="usuario_create_modal" tabindex="-1" aria-labelledby="usuario_create_modal" aria-hidden="true">
                    <div class="modal-dialog relative w-auto pointer-events-none">
                        <div
                            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                rounded-md outline-none text-current">
                            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                                <!-- Modal header -->
                                <form action="{{ url('produccion/permisos') }}" method="POST" class="forms-sample">
                                    @csrf
                                    <div
                                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                            Nuevo permiso
                                        </h3>
                                        <button type="button"
                                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                            dark:hover:bg-slate-600 dark:hover:text-white"
                                            data-bs-dismiss="modal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                            11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Nuevo permiso</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Permiso</label>
                                            <input type="text" class="form-control" required name="name">
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                        <button type="submit"
                                            class="btn inline-flex justify-center text-white bg-black-500">Aceptar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                id="usuario_edit_modal" tabindex="-1" aria-labelledby="usuario_edit_modal" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
         rounded-md outline-none text-current">
                        <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                            <!-- Modal header -->

                            <form action="{{ url('produccion/permisos/update_permission') }}" method="POST"
                                class="forms-sample">
                                @csrf
                                <div
                                    class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                    <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                        Editar permiso
                                    </h3>
                                    <button type="button"
                                        class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                    dark:hover:bg-slate-600 dark:hover:text-white"
                                        data-bs-dismiss="modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                    11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Nuevo permiso</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-4">
                                    <div class="input-area">
                                        <label for="name" class="form-label">Permiso</label>
                                        <input type="hidden" class="form-control" required id="id" name="id">
                                        <input type="text" class="form-control" required id="name" name="name">
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                    <button type="submit"
                                        class="btn inline-flex justify-center text-white bg-black-500">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <script>
        // project data table
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
