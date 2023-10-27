@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @include('sweetalert::alert')
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0"> Administración</h4>
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

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="form-label col-md-3" align="right"><strong>Usuario</strong></label>
                                        <div class="col-6">
                                            <select class="form-select" id="users_id" name="users_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $user->id == 50 ? 'selected' : '' }}>{{ $user->user_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="form-label col-md-3" align="right"><strong>Fecha</strong></label>
                                        <div class="col-6">
                                            <input type="date" name="fecha" id="fecha" value="{{ date('Y-m-d') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3" align="right"></label>
                                            <div class="col-6" align="right">
                                                <button type="button" onclick="get_resultado()"
                                                    class="btn btn-primary float-right">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="div_resultado"></div>

                    </div>
                </div>

            </div>
        </div><!-- Row end  -->





    </div>






    @include('sweet::alert')
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>

    <script>
        $(document).ready(function() {


        });

        function get_resultado() {
            var usuario = document.getElementById('users_id').value;
            var fecha = document.getElementById('fecha').value;
            $.get("{{ url('prueba/resultado') }}" + '/' + usuario + '/' + fecha, function(data) {
                $('#div_resultado').empty(); // Limpia el contenido existente en el div
                $('#div_resultado').append(data); // Agrega la nueva data al div
            });
        }
    </script>


@endsection
