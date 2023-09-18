@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">

        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex px-0  border-bottom flex-wrap">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                            <h5 class="fw-bold mb-0">
                                Nueva actividad
                            </h5>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row taskboard g-3 py-xxl-4">
                <!--taskboard-->


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
                <form method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="form-label col-md-3"
                                    align="right"><strong>Ticket</strong></label>
                                <div class="col-6">
                                    <input type="text" name="numero_ticket" value="0" class="form-control" required>

                                </div>
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="form-label col-md-3"
                                    align="right"><strong>Proyecto</strong></label>
                                <div class="col-6">
                                    <select name="proyecto_id" class="form-control" required>

                                    </select>

                                </div>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
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
                </form>

                &nbsp;
                &nbsp;

            </div>






            </div>


        </div>









    </div>






@endsection
