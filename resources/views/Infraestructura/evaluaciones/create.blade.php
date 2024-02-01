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
                        <form method="POST" action="{{ url('evaluaciones') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>Proveedor</strong></label>
                                            <div class="col-9">
                                                <select name="proveedor_id" class="form-select">
                                                    @foreach ($proveedores as $obj)
                                                        <option value="{{ $obj->id }}">
                                                            {{ $obj->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>Periodo</strong></label>
                                            <div class="col-9">
                                                <select name="periodo" class="form-select">
                                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;



                                <div class="row g-3">
                                    <table class="table" border="1">
                                        <thead>
                                            <tr>

                                                <th scope="col" border="1">cumplimiento</th>
                                                <th scope="col" border="1">caracteristicas</th>
                                                <th scope="col" border="1">criterios</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cumplimientos as $cumplimiento)
                                                @foreach ($cumplimiento->cumplimiento_has_caracteristica as $caracteristica_caracteristica)
                                                    <tr border="1">
                                                        <th scope="row">{{ $cumplimiento->nombre }}</th>
                                                        <td border="1">
                                                            {{ $caracteristica_caracteristica->caracteristica->nombre }}"*"
                                                            {{ $caracteristica_caracteristica->caracteristica_id }}
                                                        </td>

                                                        <td border="1">
                                                            <select name="criterios_id" id="criterio" class="form-select"
                                                                onchange="CrearItem({{ $detalle->id }},this.value)">
                                                                @foreach ($detalle->cumplimiento_caracteristica->caracteristica->criterios as $criterio)
                                                                    <option value="{{ $criterio->id }}" {{$criterio->id == $detalle->criterio_caracteristica_id ? 'selected':''}}>
                                                                        {{ $criterio->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                       {{-- <td border="1">
                                                            <select name="criterios_id" class="form-select">
                                                                @foreach ($criterioscaracteristicas as $criterios)
                                                                    @if ($criterios->caracteristica_id == $caracteristica_caracteristica->caracteristica_id)
                                                                        <option
                                                                            value="{{ $criterios->caracteristica_id }}">
                                                                            {{ $criterios->nombre }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>--}}
                                                    </tr>
                                                @endforeach
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
                        </form>

                    </div>
                </div>
            </div><!-- Row End -->

            &nbsp;

        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {

        });

        function CrearItem(id, criterio,idvealuacion) {
            $.ajax({
                url: "{{ url('infraestructura/evaluaciones/CrearItem') }}/" + id+ "/"+ criterio+ "/"+ idvealuacion,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    criterio:criterio,
                    idvealuacion:idvealuacion,
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
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
