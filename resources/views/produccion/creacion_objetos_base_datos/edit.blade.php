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
                                <h4 class="fw-bold mb-0">Modificar bitacora de cambio base de datos</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('bitacora_cambio_base') }}">
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
                                action="{{ route('bitacora_cambio_base.update', $bitacora->id) }}">
                                @method('PUT')
                                @csrf

                                <div class="col-md-12 row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Esquema</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="esquema" value="{{$bitacora->esquema}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Objeto referencia</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="objeto_referencia" value="{{$bitacora->objeto_referencia}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Accion</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="accion" value="{{$bitacora->accion}}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Origen cambio</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="origen_cambio" value="{{$bitacora->origen_cambio}}" required class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Objeto creado cambiado</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="objeto_creado_cambiado" value="{{$bitacora->objeto_creado_cambiado}}" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Uso negocio</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="uso_negocio"  value="{{$bitacora->uso_negocio}}" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Fecha implementacion</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="fecha_implementacion" value="{{$bitacora->fecha_implementacion}}" required class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Observación</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="observacion" value="{{$bitacora->observacion}}" required
                                                    class="form-control">
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
