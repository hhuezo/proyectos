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
                            <h3 class="fw-bold mb-0"> Inventario despliegues</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('inventario_despliegues/create') }}">
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
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th align="center">Ip</th>
                                                <th align="center">Log</th>
                                                <th align="center">Nombre</th>
                                                <th align="center"> Conocido por</th>
                                                <th align="center"> Tipo de Servidor</th>
                                                <th align="center"> Version Servidor</th>
                                                <th align="center"> Ambiente</th>
                                                <th align="center"> Nombre log</th>
                                                <th align="center"> War Instalado</th>
                                                <th align="center"> proyecto</th>
                                                <th align="center"> puerto</th>
                                                <th align="center"> virtualizacion</th>
                                                <th align="center"> Endpoint</th>
                                                <th align="center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventario_despliegue as $obj)
                                                @php($war = 'http://' . $obj->ip . ':6688/#{"1699567131640":["' . $obj->nombre_log . '|' . $obj->conocido_por . '-' . $obj->nombre . '"]}')
                                                <tr>

                                                    <td>{{ $obj->ip }}</td>
                                                    <td><a target="_blank" href='{{ $war }}'>
                                                            <iconify-icon icon="teenyicons:terminal-solid"
                                                                width="35"></iconify-icon></a>
                                                    </td>
                                                    <td>{{ $obj->nombre }}</td>
                                                    <td>{{ $obj->conocido_por }}</td>
                                                    <td>{{ $obj->tipo_de_servidor }}</td>
                                                    <td>{{ $obj->version_servidor }}</td>
                                                    <td>{{ $obj->ambiente }}</td>
                                                    <td>{{ $obj->nombre_log }}</td>
                                                    <td>{{ $obj->war_instalado }}</td>
                                                    <td>{{ $obj->proyecto }}</td>
                                                    <td>{{ $obj->puerto }}</td>
                                                    <td>{{ $obj->virtualizacion }}</td>
                                                    <td>{{ $obj->endpoint }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic outlined example">
                                                            <a
                                                                href="{{ url('inventario_despliegues') }}/{{ $obj->id }}/edit">
                                                                {{-- data-bs-toggle="modal" data-bs-target="#edittickit" --}}
                                                                <button type="button" class="btn "><i
                                                                        class="icofont-edit text-success btn-lg"></i></button>
                                                            </a>

                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-{{ $obj->id }}"
                                                                class="btn btn-outline-secondary">
                                                                <i
                                                                    class="icofont-ui-delete text-danger btn-lg"></i></button>

                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('catalogo.inventario_despliegues.modal')
                                            @endforeach

                                        </tbody>
                                    </table>


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
