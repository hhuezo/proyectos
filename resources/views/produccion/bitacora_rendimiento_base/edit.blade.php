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
                                <h4 class="fw-bold mb-0">Modificar bitacora de rendimiento base de datos</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('bitacora_rendimiento_base') }}">
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
                            <form id="basic-form" method="POST"
                                action="{{ route('bitacora_rendimiento_base.update', $bitacora->id) }}">
                                @method('PUT')
                                @csrf

                                <div class="col-md-12 row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Fecha</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="fecha" value="{{$bitacora->fecha}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Hora</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="hora" value="{{$bitacora->hora}}" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Tiempo</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="tiempo" value="{{$bitacora->tiempo}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Tipo reporte</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="tipo_reporte" value="{{$bitacora->tipo_reporte}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Unidad</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="unidad"  value="{{$bitacora->unidad}}" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>


                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Programa</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="programa" value="{{$bitacora->programa}}" required
                                                    class="form-control">
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        {{-- <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Num. excel</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="num_excell" value="{{$bitacora->num_excell}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br> --}}


                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Referencia</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="referencia" value="{{$bitacora->referencia}}" required class="form-control">
                                            </div>
                                        </div>



                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Evento</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="evento" value="{{$bitacora->evento}}" required
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Accion ejecutada</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="accion_ejecutada" value="{{$bitacora->accion_ejecutada}}" required class="form-control">
                                            </div>
                                        </div>



                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Diagnostico</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="diagnostico" value="{{$bitacora->diagnostico}}" required
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Responsable</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="responsable" value="{{$bitacora->responsable}}" required class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <br>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div align="right">
                                            <button type="submit" class="btn btn-primary float-right">Aceptar</button>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
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
