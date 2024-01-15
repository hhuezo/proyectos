@extends('backend.layouts.app')

@section('title', __('Dashboard'))
@section('content')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="grid grid-cols-12 gap-5 mb-5">
        <div class="2xl:col-span-12 lg:col-span-12 col-span-12">
            <div class="card">

                <div class="card-body flex flex-col p-6">
                    <div class="col-md-12">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Modificar Inventario</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('inventario_despliegues') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>

                            </div> <!-- Row end  -->


                            <div class="transition-all duration-150 container-fluid" id="page_layout">
                                <div id="content_layout">
                                    <div class="space-y-5">
                                        <div class="grid grid-cols-12 gap-5">

                                            <div class="row taskboard g-3">
                                                @if (count($errors) > 0)
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
                                                        action="{{ route('inventario_despliegues.update', $inventario_despliegue->id) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Nombre</strong></label>
                                                                    <input type="text" name="nombre"
                                                                        value="{{ $inventario_despliegue->nombre }}"
                                                                        required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>IP</strong></label>
                                                                    <input type="text" name="ip"
                                                                        value="{{ $inventario_despliegue->ip }}" required
                                                                        class="form-control">

                                                                </div>
                                                            </div>
                                                        </div> &nbsp;

                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Conocido Por</strong></label>

                                                                    <input type="text" name="conocido_por"
                                                                        value="{{ $inventario_despliegue->conocido_por }}"
                                                                         class="form-control">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Tipo de
                                                                            Servidor</strong></label>
                                                                    <input type="text" name="tipo_de_servidor"
                                                                        value="{{ $inventario_despliegue->tipo_de_servidor }}"
                                                                         class="form-control">

                                                                </div>
                                                            </div>
                                                        </div> &nbsp;

                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Version del
                                                                            Servidor</strong></label>
                                                                        <input type="text" name="version_servidor"
                                                                            value="{{ $inventario_despliegue->version_servidor }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Ambiente</strong></label>

                                                                        <input type="text" name="ambiente"
                                                                            value="{{ $inventario_despliegue->ambiente }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>
                                                        </div> &nbsp;
                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>War
                                                                            Instalado</strong></label>

                                                                        <input type="text" name="war_instalado"
                                                                            value="{{ $inventario_despliegue->war_instalado }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Proyecto</strong></label>

                                                                        <input type="text" name="proyecto"
                                                                            value="{{ $inventario_despliegue->proyecto }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        &nbsp;
                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Puerto</strong></label>

                                                                        <input type="text" name="puerto"
                                                                            value="{{ $inventario_despliegue->puerto }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Virtualizacion</strong></label>

                                                                        <input type="text" name="virtualizacion"
                                                                            value="{{ $inventario_despliegue->virtualizacion }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>
                                                        </div> &nbsp;
                                                        <div class="row g-3">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label class="form-label col-md-3"
                                                                        align="left"><strong>Endpoint </strong></label>

                                                                        <input type="text" name="endpoint"
                                                                            value="{{ $inventario_despliegue->endpoint }}"
                                                                             class="form-control">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
                                                                <div class="input-area relative">
                                                                    <label for="largeInput" class="form-label"><strong>Nombre log</strong></label>
                                                                    <input type="text" name="nombre_log" required
                                                                        class="form-control"
                                                                        value="{{ $inventario_despliegue->nombre_log }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label class="form-label col-md-3"
                                                                        align="right"></label>
                                                                    <div class="col-12" align="right">
                                                                        <button type="submit"
                                                                            class="btn btn-primary float-right">Aceptar</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Row end  -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
