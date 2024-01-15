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
                                <h5 class="fw-bold mb-0"> Mantenimientos pendientes ({{ date('d/m/Y', strtotime($date)) }})
                                </h5>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('calendarizacion') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Row end  -->
                        <div class="card-body">
                            <div class="row g-3">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Activo</th>
                                            <th>Código</th>
                                            <th>Ubicación</th>
                                            <th>Tipo mantenimiento</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha final</th>
                                            <th>Técnico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenances_pending as $obj)
                                            <tr>
                                                <td>{{ $obj->name }}</td>
                                                <td class="table-td ">{{ $obj->asset_tag }}</td>
                                                <td>{{ $obj->location }} </td>
                                                <td>{{ $obj->asset_maintenance_type }}</td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($obj->start_date)) }}</td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($obj->completion_date)) }}</td>
                                                <td>{{ $obj->supplier }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div><!-- Row end  -->

    </div>

    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h5 class="fw-bold mb-0"> Mantenimientos realizados ({{ date('d/m/Y', strtotime($date)) }})
                                </h5>

                            </div>
                        </div> <!-- Row end  -->
                        <div class="card-body">
                            <div class="row g-3">
                                <table id="myProjectTable2" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Activo</th>
                                            <th>Código</th>
                                            <th>Ubicación</th>
                                            <th>Tipo mantenimiento</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha final</th>
                                            <th>Técnico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenances_done as $obj)
                                            <tr>
                                                <td>{{ $obj->name }}</td>
                                                <td class="table-td ">{{ $obj->asset_tag }}</td>
                                                <td>{{ $obj->location }} </td>
                                                <td>{{ $obj->asset_maintenance_type }}</td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($obj->start_date)) }}</td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($obj->completion_date)) }}</td>
                                                <td>{{ $obj->supplier }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div><!-- Row end  -->

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

            $('#myProjectTable').DataTable().order([1, 'asc']).draw();
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });


            $('#myProjectTable2')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    order: false,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });

            $('#myProjectTable2').DataTable().order([1, 'asc']).draw();

        });
    </script>

@endsection
