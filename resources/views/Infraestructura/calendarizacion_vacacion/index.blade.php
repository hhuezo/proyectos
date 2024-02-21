@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <style>
        .tree {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #fbfbfb;

            /*  border: 1px solid #999;*/
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);

        }

        .tree li {
            list-style-type: none;
            margin: 20;
            padding: 10px 5px 0 55px;
            position: relative;
            min-width: 400px;
        }

        .tree li::before,
        .tree li::after {
            content: '';
            left: 30px;
            position: absolute;
            right: auto
        }

        .tree li::before {
            border-left: 1px solid #999;
            bottom: 50px;
            height: 100%;
            top: 0;
            width: 1px
        }

        .tree li::after {
            border-top: 1px solid #999;
            height: 20px;
            top: 25px;
            width: 25px
        }

        .tree li span {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border: 2px solid #999;
            border-radius: 5px;
            display: inline-block;
            padding: 3px 8px;
            text-decoration: none;
            min-width: 400px;
        }

        .tree li.parent_li>span {
            cursor: pointer
        }

        .tree>ul>li::before,
        .tree>ul>li::after {
            border: 0
        }

        .tree li:last-child::before {
            height: 30px
        }

        .tree li.parent_li>span:hover,
        .tree li.parent_li>span:hover+ul li span {
            background: rgb(197, 183, 223);
            border: 2px solid #94a0b4;
            color: #000
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function(e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign')
                        .removeClass('icon-minus-sign');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign')
                        .removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });

            // Expande todos los elementos al cargar la página
            $('.tree li.parent_li > span').click();
        });
    </script>

    <!-- Row end  -->

    <div class="tree well card">

        <div class="border-0">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">


                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h4 class="fw-bold mb-0">Programacion de Vacacion</h4>
                        <div class="col-auto d-flex w-sm-100">
                            <a href="{{ url('infraestructura/vacaciones/create') }}">
                                {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100">Nuevo</button>
                            </a>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#reporte_vacacion"
                                class="btn btn-dark btn-set-task w-sm-100"><i
                                    class="icofont-eye text-secundary text-secundary btn-lg  btn-lg"></i></button>
                            @include('infraestructura.calendarizacion_vacacion.reporte_vacacion')
                        </div>
                    </div>

                </div>

            </header>

            @php($i = 1)
            @foreach ($periodo as $periodos)
                <div class="accordion" id="accordionExample"{{ $periodos }}>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne"{{ $periodos }}>
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne{{ $periodos }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                Periodo : {{ $periodos }}
                            </button>
                        </h2>

                        <div id="collapseOne{{ $periodos }}" class="accordion-collapse collapse"
                            aria-labelledby="headingOne"{{ $periodos }}
                            data-bs-parent="#accordionExample"{{ $periodos }}>
                            <div class="accordion-body"{{ $periodos }}>

                                <table class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr align="center">
                                            <th align="center"> Nombre </th>
                                            <th align="center"> Cargo </th>
                                            <th align="center"> area </th>
                                            <th align="center"> Fecha inicio </th>
                                            <th align="center">Fecha final </th>
                                            <th align="center"> Modificar </th>
                                            <th align="center"> Eliminar </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($calendario as $obj)
                                            <tr>
                                                <div id="{{ $obj->periodo }}"
                                                    class="accordion-collapse collapse {{ $periodos }}"
                                                    aria-labelledby="headingThree"
                                                    data-bs-parent="#accordionExample"{{ $periodos }}>
                                                    <div class="accordion-body"{{ $periodos }}>
                                                        @if ($obj->periodo == $periodos)
                                                            <td align="center">
                                                                @foreach ($user as $usuarios)
                                                                    @if ($obj->personal_id == $usuarios->id)
                                                                        {{ $usuarios->name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td align="center">
                                                                {{ $obj->cargo }}</td>
                                                            <td align="center">
                                                                {{ $obj->area }}</td>
                                                            <td align="center">
                                                                {{ $obj->fecha_inicio }}</td>

                                                            <td align="center">
                                                                {{ $obj->fecha_fin }}</td>
                                                            <td align="center">

                                                                <a href="{{ url('infraestructura/vacaciones') }}/{{ $obj->id }}/edit"
                                                                    class="list-group-item list-group-item-action border-0 ">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"><i
                                                                            class="icofont-edit text-success  btn-lg"></i></button>
                                                                </a>

                                                            </td>
                                                            <td align="center">
                                                                <button type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-{{ $obj->id }}"
                                                                    class="btn btn-danger"><i
                                                                        class="icofont-ui-delete  btn-lg"></i></button>
                                                            </td>



                                                    </div>

                                                </div>

                                            </tr>
                                            @include('infraestructura.calendarizacion_vacacion.modal')
                                        @endif
            @endforeach

            </tbody>
            </table>

        </div>
    </div>
    </div>
    @endforeach
    {{-- @include('infraestructura.evaluaciones.modal_create_evaluacion') --}}



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
