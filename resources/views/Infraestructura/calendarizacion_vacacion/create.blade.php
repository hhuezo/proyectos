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
                                <h4 class="fw-bold mb-0"> Nueva Vacacion </h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('infraestructura/vacaciones') }}">
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
                            <form id="basic-form" method="POST" action="{{ url('infraestructura/vacaciones') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>Nombre</strong></label>
                                            <div class="col-6">
                                                <select name="personal_id" id="personal_id" class="form-control">
                                                    @foreach ($personal as $obj)
                                                        <option value="{{ $obj->id }}">{{ $obj->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"><strong>Area</strong></label>
                                            <div class="col-6">
                                                <input type="text" name="area" id="area" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"><strong>cargo</strong></label>
                                            <div class="col-6">
                                                <input type="text" name="cargo" id="cargo" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>periodo</strong></label>
                                            <div class="col-6">
                                                <select name="periodo" id='periodo' class="form-control" required>
                                                    @for ($i = date('Y'); $i >= 2018; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3" align="right"><strong>Fecha
                                                        Inicio</strong></label>
                                                <div class="col-6">
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3" align="right"><strong>Fecha
                                                        final</strong></label>
                                                <div class="col-6">
                                                    <input type="date" name="fecha_fin" id="fecha_fin" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3"
                                                    align="right"><strong>Observacion</strong></label>
                                                <div class="col-6">
                                                    <input type="text" name="observacion" id="observacion" required
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="form-label col-md-3" align="right"></label>
                                                    <div class="col-6" align="right">
                                                        <button type="submit"
                                                            class="btn btn-primary float-right">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
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
