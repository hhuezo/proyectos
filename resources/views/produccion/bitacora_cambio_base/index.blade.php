@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <div class="card">
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Bitacora cambio base de datos</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('bitacora_cambio_base/create') }}">
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
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>NUM EXCELL</th>
                                                <th>ESQUEMA</th>
                                                <th>ORIGEN CAMBIO</th>
                                                <th>USO NEGOCIO</th>
                                                {{-- <th>ACCION</th> --}}
                                                <th>FECHA IMPLEMENTACION</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bitacora as $obj)
                                                <tr>
                                                    <td>{{ $obj->id }}</td>
                                                    <td>{{ $obj->num_excell }}</td>
                                                    <td>{{ $obj->esquema }}</td>
                                                    <td>{{ $obj->origen_cambio }}</td>
                                                    <td>{{ $obj->uso_negocio }}</td>
                                                    {{-- <td>{{ $obj->accion }}</td> --}}
                                                    <td>{{ $obj->fecha_implementacion }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic outlined example">
                                                            <a
                                                                href="{{ url('bitacora_cambio_base') }}/{{ $obj->id }}/edit">
                                                                <button class="btn btn-success"><i
                                                                        class="icofont-edit btn-lg"></i></button>
                                                            </a>
                                                            &nbsp;&nbsp;
                                                            {{-- data-bs-toggle="modal" data-bs-target="#edittickit"
                                                        <button type="button" class="btn "><i class="icofont-edit text-success btn-lg"></i></button> --}}

                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $obj->id }}"
                                                                class="btn btn-danger"><i
                                                                    class="icofont-ui-delete  btn-lg"></i></button>
                                                        </div>



                                                    </td>
                                                </tr>
                                                @include('produccion.bitacora_cambio_base.modal')
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
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
                        order: false,
                        columnDefs: [{
                            targets: [-1, -3],
                            className: 'dt-body-right'
                        }]
                    });

                $('#myProjectTable').DataTable().order([1, 'desc']).draw();
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
