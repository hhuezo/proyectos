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
                            <h3 class="fw-bold mb-0"> {{ $proyecto->nombre }}</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('proyecto_facturado') }}">
                                    {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                            class="icofont-arrow-left me-2 fs-6"></i></button>
                                </a>
                            </div>
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
                                            <th>numero_ticket</th>
                                            <th>Descripción</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actividades as $obj)
                                                <tr>
                                                    <td>{{ $obj->id }}</td>
                                                    <td>{{ $obj->numero_ticket }}</td>
                                                    <td>{{ $obj->descripcion }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($obj->fecha_inicio)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($obj->fecha_fin)) }}</td>
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
