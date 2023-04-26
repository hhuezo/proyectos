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
                                Usuarios
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
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td style="text-align: center"> <a style="color:black; font-weight:bold"
                                    href="{{ url('/admin/coordinador/' . $usuario->id . '/edit') }}">
                                   {{ $usuario->id }}
                                </a></td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->user_name }}</td>
                            <td style="text-align: center">
                                <a href="{{url('actividades_coordinador')}}/{{$usuario->id}}"> <i class="icofont-search-2 fa-2x"></i></a>
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
