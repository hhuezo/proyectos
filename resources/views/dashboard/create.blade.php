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
                                <h4 class="fw-bold mb-0"> Nuevo gráfico</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('catalogo/propietario') }}">
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
                            <form method="POST" action="{{ url('dashboard') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"><strong>Tipo
                                                    gráfico</strong></label>
                                            <div class="col-6">
                                                <select name="tipo_grafica_id" required class="form-select">
                                                    <option value="1">Barra</option>
                                                    <option value="2">Pastel</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>&nbsp;</div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"><strong>Título</strong></label>
                                            <div class="col-6">
                                                <input type="text" name="titulo" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>&nbsp;</div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"><strong>Descripción para eje
                                                    Y</strong></label>
                                            <div class="col-6">
                                                <input type="text" name="descripcion" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>&nbsp;</div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"></label>
                                            <div class="col-6" align="right">
                                                <button type="submit" class="btn btn-primary float-right">Aceptar</button>
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
