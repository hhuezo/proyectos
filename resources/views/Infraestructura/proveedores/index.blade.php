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
                            <h3 class="fw-bold mb-0"> Proveedores</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('infraestructura/proveedores/create') }}">
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
                                                <th align="center">nombre</th>
                                                <th align="center">Telefono</th>
                                                <th align="center">correo</th>
                                                <th align="center">Direccion</th>
                                                <th align="center">Producto </th>
                                                <th align="center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proveedores as $obj)
                                                <tr>
                                                    <td>{{ $obj->id }}</td>
                                                    <td>{{ $obj->nombre }}</td>
                                                    <td> {{ $obj->telefono }} </td>
                                                    <td> {{ $obj->correo }} </td>
                                                    <td> {{ $obj->direccion }} </td>
                                                    <td> {{ $obj->producto }} </td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic outlined example">
                                                            <a
                                                                href="{{ url('infraestructura/proveedores') }}/{{ $obj->id }}/edit">
                                                                {{-- data-bs-toggle="modal" data-bs-target="#edittickit" --}}
                                                                <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                                        class="icofont-edit text-success btn-lg"></i></button>
                                                            </a>
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $obj->id }}"
                                                                class="btn btn-dark btn-set-task w-sm-100"><i
                                                                    class="icofont-ui-delete text-danger btn-lg"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('infraestructura.proveedores.modal')
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
