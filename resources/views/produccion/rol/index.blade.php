@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')


    <div class="card">
        <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0"> Roles</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <a href="{{ url('produccion/rol/create') }}">
                                    {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                            class="icofont-plus-circle me-2 fs-6"></i>Nuevo</button>
                                </a>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                    <div style=" margin-left:20px; margin-right:20px; ">
                        <span class=" col-span-8  hidden"></span>
                        <span class="  col-span-4 hidden"></span>
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden " style=" margin-bottom:20px ">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead class="bg-slate-200 black:bg-slate-700">
                                        <tr>
                                            <th style="text-align: center">Id</th>
                                            <th style="text-align: center">Nombre</th>
                                            <th style="text-align: center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($roles->count() > 0)
                                            @foreach ($roles as $obj)
                                                <tr>
                                                    <td align="center">{{ $obj->id }}</td>
                                                    <td align="center">{{ $obj->name }}</td>
                                                    <td align="center">
                                                        <a href="{{ url('produccion/rol') }}/{{ $obj->id }}/edit">
                                                            {{-- data-bs-toggle="modal" data-bs-target="#edittickit" --}}
                                                            <button type="button" class="btn btn-outline-secondary"><i
                                                                    class="icofont-edit text-success btn-lg"></i></button>
                                                        </a>
                                                        &nbsp;&nbsp;



                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
            <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
            <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
            <script src="{{ asset('js/template.js') }}"></script>
            <script src="{{ asset('js/page/task.js') }}"></script>

            <script>
                $(document).ready(function() {
                    $('#myProjectTable')
                        .addClass('nowrap')
                        .dataTable({
                            responsive: true,
                           // order: false,
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
