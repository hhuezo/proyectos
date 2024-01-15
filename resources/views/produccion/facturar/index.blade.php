@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')




    <div class="body d-flex py-lg-3 py-md-2 card">

        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4"></div>
                <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                        <h5 class="fw-bold mb-0">
                            Actividades facturar ({{ date('Y') }})
                        </h5>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                    </div>


                </div>
            </div>
        </div>

        <div class="row taskboard g-0 py-xxl-4">


            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Reporte</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 13; $i++)
                        <tr>
                            <td>{{ $meses[$i] }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i
                                        class="icofont-ui-file fa-2x"></i></button>
                                {{-- <a href="{{ url('facturar') }}/{{ $i }}/{{ date('Y') }}" target="_blank">
                                        <i class="icofont-ui-file fa-2x"></i></a> --}}
                            </td>
                        </tr>
                    @endfor


                </tbody>

            </table>



        </div>
    </div>
    </div>



    <div id="modal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel">Generar reporte mensual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('facturar') }}">
                    @csrf
                    <div class="modal-body row">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Fecha inicio</label>
                                <input type="date" name="fecha_inicio" required class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <input type="hidden" id="proyectos" name="proyectos">
                                <label class="form-label">Fecha final</label>
                                <input type="date" name="fecha_final" required class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Proyectos</label>
                                <select class="form-select" onchange="seleccionar(this)">
                                    <option value="" disabled selected hidden>Seleccione</option>
                                    @foreach ($proyectos as $proyecto)
                                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">&nbsp;</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mb-3" id="targetDiv">


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
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
        let id_array = [];
        let nombre_array = [];
        $(document).ready(function() {
            var table = $('#example').DataTable({
                fixedHeader: true
            });



        });

        function seleccionar(proyecto) {
            var id = proyecto.value;
            var descripcion = proyecto.options[proyecto.selectedIndex].text;

            id_array.push(id);
            nombre_array.push(descripcion);

            document.getElementById("proyectos").value = id_array;

            $.ajax({
                url: '{{ url('facturar/get_data') }}',
                type: 'POST',
                data: {
                    proyectos: document.getElementById("proyectos").value,
                    _token: '{{ csrf_token() }}',

                    // Aquí van los demás datos que quieras enviar
                },
                success: function(response) {
                    // Aquí manejas la respuesta del servidor
                    $('#targetDiv').html(response);
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Aquí manejas los errores
                    console.log(textStatus, errorThrown);
                }
            });

        }

        function unlink(id) {
            let valueToRemove = id;

            id_array = id_array.filter(item => item != valueToRemove);


            document.getElementById("proyectos").value = id_array;

            $.ajax({
                url: '{{ url('facturar/get_data') }}',
                type: 'POST',
                data: {
                    proyectos: document.getElementById("proyectos").value,
                    _token: '{{ csrf_token() }}',

                    // Aquí van los demás datos que quieras enviar
                },
                success: function(response) {
                    // Aquí manejas la respuesta del servidor
                    $('#targetDiv').html(response);
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Aquí manejas los errores
                    console.log(textStatus, errorThrown);
                }
            });
        }

        //console.log(nombre_array[i]);
    </script>



@endsection
