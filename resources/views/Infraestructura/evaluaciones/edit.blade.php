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
                                <h4 class="fw-bold mb-0">Evaluacion</h4>
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
                            <div class="row g-12">
                                <div class="col-md-4">
                                    <label class="form-label col-md-8" align="left"><strong>Proveedor:
                                            {{ $evaluacion->proveedor->nombre }} </strong></label>
                                    <label class="form-label col-md-8"
                                        align="left"><strong>Notificado:{{ $evaluacion->notificado }} </strong></label>
                                    <label>Notificado (S/N) </label>
                                    <select name="notificado" id="notificado">
                                        <option>S</option>
                                        <option>N</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label col-md-8" align="right"><strong>Periodo:
                                            {{ $evaluacion->periodo_evaluacion }} </strong></label>

                                </div>
                            </div>
                            &nbsp;
                            <input type="hidden" name="evaluacion" id="evaluacion" value="{{ $evaluacion->id }}" required
                                class="form-control">


                            <div class="row g-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" border="1">cumplimiento</th>
                                            <th scope="col" border="1">caracteristicas</th>
                                            <th scope="col" border="1">criterios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evaluacion->detalles as $detalle)
                                            <tr border="1">
                                                <th scope="row">
                                                    {{ $detalle->cumplimiento_caracteristica->cumplimiento->nombre }}</th>
                                                <th scope="row">
                                                    {{ $detalle->cumplimiento_caracteristica->caracteristica->nombre }}</th>
                                                <td border="1">
                                                    <select name="criterios_id" id="criterio" class="form-select"
                                                        onchange="updateData({{ $detalle->id }},this.value)">
                                                        @foreach ($detalle->cumplimiento_caracteristica->caracteristica->criterios as $criterio)
                                                            <option value="{{ $criterio->id }}"
                                                                {{ $criterio->id == $detalle->criterio_caracteristica_id ? 'selected' : '' }}>
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

                                        <a
                                            href="{{ url('infraestructura/evaluaciones/guardar_mensaje') }}/{{ $evaluacion->id }}">
                                            <button type="button" class="btn btn-primary float-right">Aceptar</button></a>
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
                url: "{{ url('infraestructura/evaluaciones/updateData') }}/" + id + "/" + criterio,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    criterio: criterio,
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
