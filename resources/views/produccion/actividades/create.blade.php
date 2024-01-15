@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .select2-container .select2-selection--single {
            height: 35px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">

        <div class="container-xxl card">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                            <h5 class="fw-bold mb-0">
                                Nueva actividad
                            </h5>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: right;">
                            <a href="{{ url('actividades') }}"><button class="btn btn-primary float-right"><i
                                        class="fa fa-arrow-left"></i></button></a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row taskboard g-3">
                <!--taskboard-->


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ url('actividades') }}">
                        @csrf

                        <div class="row g-3">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Ticket</strong></label>

                                    <input type="number" name="numero_ticket" value="0" class="form-control" required>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Ponderacion</strong></label>

                                    <input type="number" name="ponderacion" value="0.01" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Proyectos</strong></label>

                                    <select name="proyecto_id" class="form-control select2" required>
                                        @foreach ($proyectos as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row g-3 taskboard py-xxl-4">

                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Descripcion</strong></label>
                                    <textarea class="form-control" name="descripcion" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Fecha inicio</strong></label>
                                    <input type="date" name="fecha_inicio" value="{{date('Y-m-d')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Fecha final</strong></label>
                                    <div class="col-12">
                                        <input type="date" name="fecha_fin" value="{{date('Y-m-d')}}" class="form-control"
                                            >
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row g-3 taskboard">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Categoria</strong></label>
                                    <div class="col-12">
                                        <select name="categoria_id" class="form-select">
                                            @foreach ($categorias as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Forma</strong></label>
                                    <div class="col-12">
                                        <input type="text" name="forma" value="NO APLICA" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-sx-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Prioridad</strong></label>

                                    <select name="prioridad_id" class="form-select">
                                        @foreach ($prioridades as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row g-3 py-xxl-4">
                            <div class="modal-footer">
                                <a href="{{ url('actividades') }}">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                </a>
                                <button type="submit" class="btn btn-primary float-right">Aceptar</button>
                            </div>

                        </div>
                </div>
                </form>

                &nbsp;
                &nbsp;

            </div>






        </div>


    </div>









    </div>






@endsection
