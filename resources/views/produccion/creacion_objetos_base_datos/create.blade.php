@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Agregar nuevo objeto de base de datos</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('creacion_objetos_base_datos') }}">
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
                            <form id="basic-form" method="POST" action="{{ url('creacion_objetos_base_datos') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Nombre especialista</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="nombre_especialista"
                                                    value="{{ old('nombre_especialista') }}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Tipo objeto</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="tipo_objeto" value="{{ old('tipo_objeto') }}"
                                                    required class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Funciones</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="funciones" value="{{ old('funciones') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Num formulario</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="num_formulario"
                                                    value="{{ old('num_formulario') }}" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Fecha creacion</strong></label>
                                            <div class="col-12">
                                                <input type="date" name="fecha_creacion"
                                                    value="{{ old('fecha_creacion') }}" required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Nombre objeto
                                                    asignar</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="nombre_objeto_asignar"
                                                    value="{{ old('nombre_objeto_asignar') }}" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Descripcion</strong></label>
                                            <div class="col-12">

                                                <textarea class="form-control" name="descripcion" value="{{ old('descripcion') }}" cols="30" rows="6">

                                                    </textarea>
                                            </div>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Grants</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="grants" value="{{ old('grants') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Synonyms</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="synonyms" value="{{ old('synonyms') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label class="form-label"><strong>Proyectos</strong></label>

                                            <select class="form-control select2" name="proyecto_relacionado" required>
                                                @foreach ($proyectos as $obj)
                                                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <br>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12">

                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Base de datos</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="base_datos" value="{{ old('base_datos') }}"
                                                    required class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Roles</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="roles" value="{{ old('roles') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label col-md-3"><strong>Comentario</strong></label>
                                            <div class="col-12">
                                                <input type="text" name="comentario" value="{{ old('comentario') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="form-label col-md-3"><b>Adjunto 1</b></label>
                                            <input type="file" name="adjunto1" placeholder="adjunto 1">
                                        </div>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="form-label col-md-3"><b>Adjunto 2</b></label>
                                            <input type="file" name="adjunto2" placeholder="adjunto 2">
                                        </div>
                                        <br>
                                        <br>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="form-label col-md-3"><b>Adjunto 3</b></label>
                                            <input type="file" name="adjunto3" placeholder="adjunto 3">
                                        </div>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group label-floating">
                                            <label class="form-label col-md-3"><b>Adjunto 4</b></label>
                                            <input type="file" name="adjunto4" placeholder="adjunto 4">
                                        </div>
                                        <br>
                                        <br>
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
