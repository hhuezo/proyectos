@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')




    <div class="body d-flex py-lg-3 py-md-2">

        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                            <h5 class="fw-bold mb-0">
                                <a href="{{ url('actividades_finalizadas') }}"> <i class="icofont-arrow-left fa-lg"></i></a>
                                Movimiento de actividades
                            </h5>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                        </div>


                    </div>
                </div>
            </div>

            <div class="row taskboard g-3 py-xxl-4">


                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NumTicket</th>
                            <th>Proyecto</th>
                            <th>Actividad</th>
                            <th>Categoria</th>
                            <th>Prioridad</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Avance</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td class="text-center">
                                    {{ $movimiento->id }}
                                </td>
                                </td>
                                <td>{{ $movimiento->numero_ticket }}</td>
                                <td>
                                    <div>
                                        {{ $movimiento->proyecto }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $movimiento->actividad }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $movimiento->categoria }}
                                    </div>
                                </td>
                                <td>{{ $movimiento->prioridad }}</td>
                                <td>{{ date('d/m/Y', strtotime($movimiento->fecha)) }}</td>
                                <td>{{ $movimiento->user_name }}</td>
                                <td>
                                    <span class="badge badge-dot mr-4">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">
                                                <div>
                                                    @if ($movimiento->porcentaje < 50)
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 50%" aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">{{ $movimiento->porcentaje }}%
                                                            </div>
                                                        </div>
                                                    @elseif ($movimiento->porcentaje < 70)
                                                    <div class="progress" style="height: 20px; width: 150px;">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: {{$movimiento->porcentaje}}%" aria-valuenow="60" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $movimiento->porcentaje }}%
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="progress" style="height: 20px; width: 150px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{$movimiento->porcentaje}}%" aria-valuenow="60" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $movimiento->porcentaje }}%
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                        </div>
                                    </span>
                                </td>
                                <td>
                                    <span>
                                        <div align='left'>
                                            {{ $movimiento->estado }}
                                        </div>

                                    </span>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>



            </div>
        </div>
    </div>



    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>

    <script src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                fixedHeader: true
            });
        });
    </script>



@endsection
