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
                                <h4 class="fw-bold mb-0">Modificar Evaluacion</h4>
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
                        <div class="card-body">

                <form id="basic-form" method="POST" action="{{ url('infraestructura/evaluaciones/modificar_evaluacion', $evaluacion->id) }}">
                                    @method('POST')
                                    @csrf
                                <div class="row g-3">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">


                                                <div class="form-group">
                                                    <label class="form-label"><strong>Nombre</strong></label>
                                                    <input type="text" class="form-control" required name="nombre"
                                                        id="nombre" value={{ $evaluacion->proveedor->nombre }}>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Periodo {{$evaluacion->periodo_evaluacion}}
                                                    </strong></label>
                                                <select name="periodo"  id="periodo" class="form-select">
                                                    @for ($i =  date('Y'); $i >= 2018; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><strong>Fecha Revisado</strong></label>
                                                <input type="date" class="form-control" required name="fecha_revisado"
                                                    id="fecha_revisado" value={{ $evaluacion->fecha_revisado }}>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Fecha Aprobado </strong></label>
                                                <input type="date" class="form-control" required name="fecha_aprobado"
                                                    id="fecha_aprobado" value={{ $evaluacion->fecha_aprobado }}>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Nombre Aprobado</strong></label>
                                                <input type="text" class="form-control" required name="nombre_aprobado"
                                                    id="nombre_aprobado" value={{  $evaluacion->nombre_aprobado }}>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Notificado (S/N) </strong> </label>
                                                <select name="notificado" value={{ $evaluacion->notificado }}
                                                    class="form-control">
                                                    <option>S</option>
                                                    <option>N</option>
                                                </select>
                                            </div>



                                        </div>
                                        <div class="col-6">

                                            <div class="form-group">
                                                <label class="form-label"><strong>Nombre Elaborado</strong></label>
                                                <input type="text" class="form-control" required name="nombre_elaborado"
                                                    id="nombre_elaborado" value={{ $evaluacion->nombre_elaborado }}>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label"><strong>Cargo Elaborado</strong></label>
                                                <input type="text" class="form-control" required name="cargo_elaborado"
                                                    id="cargo_elaborado" value={{ $evaluacion->cargo_elaborado }}>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Nombre Revisado</strong></label>
                                                <input type="text" class="form-control" required name="nombre_revisado"
                                                    id="nombre_revisado" value={{ $evaluacion->nombre_revisado }}>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Cargo Revisado</strong></label>
                                                <input type="text" class="form-control" required name="cargo_revisado"
                                                    id="cargo_revisado" value={{ $evaluacion->cargo_revisado }}>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label"><strong>Observaciones</strong></label>
                                                <input type="text" class="form-control" required name="observaciones"
                                                    id="observaciones" value={{ $evaluacion->observaciones }}>
                                            </div>

                                            <div>&nbsp;</div>
                                            <div class="p-6 space-y-4">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="form-label col-md-3" align="right"></label>
                                                        <div class="col-12" align="right">
                                                            <button type="submit"
                                                                class="btn btn-primary float-right">Aceptar</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>


                        </div> <!-- Row end  -->


                        </form>

                    </div>

                </div>
            </div><!-- Row end  -->

        </div>
    </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
