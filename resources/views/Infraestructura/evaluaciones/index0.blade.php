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
                            <h3 class="fw-bold mb-0"> Proveedores Evaluaciones</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add"
                                    class="btn btn-outline-secondary">
                                    Nuevo</button>

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

                                                <th align="center">Id</th>
                                                <th align="center">Proveedor</th>
                                                <th align="center">Periodos</th>
                                                <th align="center">Fecha Evaluacion</th>
                                                <th align="center">Notificacion</th>
                                                <th align="center"> Edicion / Reporte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($evaluacion as $obj)
                                                <tr>
                                                    <td>{{ $obj->id }}</td>
                                                    <td>{{ $obj->proveedor ? $obj->proveedor->nombre : '' }}</td>
                                                    <td>{{ $obj->periodo_evaluacion }}</td>
                                                    <td> {{ date('d/m/Y', strtotime( $obj->fecha_evalua)) }} </td>
                                                    <td> {{ $obj->notificado }} </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="{{url('infraestructura/evaluaciones')}}/{{$obj->id}}/edit" class="list-group-item list-group-item-action border-0 " >
                                                                <button type="button" class="btn btn-outline-secondary"><i
                                                                        class="icofont-edit text-success  btn-lg" ></i></button>
                                                            </a>

                                                            <a href="{{ url('infraestructura/evaluaciones') }}/{{ $obj->id }}" target="_blank"
                                                                class="list-group-item list-group-item-action border-0 ">
                                                                <button type="button" class="btn btn-outline-secondary"><i
                                                                        class="icofont-printer text-success btn-lg"></i></button>
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>
            @include('infraestructura.evaluaciones.modal_create_evaluacion')
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
