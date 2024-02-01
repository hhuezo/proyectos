@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Nueva evaluacion</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('infraestructura/evaluaciones') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Row end  -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="form-label col-md-3" align="right"><strong>Proveedor:   {{$evaluacion->proveedor->nombre}} </strong></label>
                                        <div class="col-9">


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="form-label col-md-3" align="right"><strong>Periodo:   {{$evaluacion->periodo_evaluacion}}   </strong></label>
                                        <div class="col-9">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp;
                            <input type="hidden" name="evaluacion" id="evaluacion" value="{{ $evaluacion->id }}" required
                                class="form-control">


                            <div class="row g-3">
                                <table class="table" border="1">
                                    <thead>
                                        <tr>

                                            <th scope="col" border="1">cumplimiento</th>
                                            <th scope="col" border="1">caracteristicas</th>
                                            <th scope="col" border="1">criterios</th>
                                            <th scope="col" border="1">Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluacion->detalles as $detalle)
                                            <tr border="1">
                                                <th scope="row"> <input type="text" name="detalle_id" id="detalle_id"
                                                        value="{{ $detalle->id }}" required class="form-control"> </th>
                                                <th scope="row">
                                                    {{ $detalle->cumplimiento_caracteristica->cumplimiento->nombre }}</th>
                                                <th scope="row">
                                                    {{ $detalle->cumplimiento_caracteristica->caracteristica->nombre }}</th>
                                                <td border="1">
                                                    <select name="criterios_id" id="criterio" class="form-select"
                                                        onchange="updateData({{ $detalle->id }},this.value)">
                                                        @foreach ($detalle->cumplimiento_caracteristica->caracteristica->criterios as $criterio)
                                                            <option value="{{ $criterio->id }}" {{$criterio->id == $detalle->criterio_caracteristica_id ? 'selected':''}}>
                                                                {{ $criterio->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>


                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-md-3" align="right"></label>
                                    <div class="col-12" align="right">
                                        <button type="submit" class="btn btn-primary float-right">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div><!-- Row End -->

            &nbsp;

        </div>

    </div>





    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });

        function updateData(id, criterio) {
            $.ajax({
                url: "{{ url('infraestructura/evaluaciones/updateData') }}/" + id+ "/"+ criterio,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    criterio:criterio,
                },
                success: function(data) {

                    //ballpark_up
                    console.log(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud POST:', error);
                }
            });

        }
    </script>
@endsection
