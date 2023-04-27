@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">Unidades</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2 row-deck">
                        @foreach ($unidades as $unidad)
                        <a href="{{url('home')}}/{{$unidad->id}}">
                        <div class="col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <i class="icofont-checked fs-3"></i>
                                        <h6 class="mt-3 mb-0 fw-bold small-14">{{$unidad->nombre}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                        <!--<div class="col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <i class="icofont-stopwatch fs-3"></i>
                                        <h6 class="mt-3 mb-0 fw-bold small-14">Late Coming</h6>
                                        <span class="text-muted">17</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <i class="icofont-ban fs-3"></i>
                                        <h6 class="mt-3 mb-0 fw-bold small-14">Absent</h6>
                                        <span class="text-muted">06</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body ">
                                        <i class="icofont-beach-bed fs-3"></i>
                                        <h6 class="mt-3 mb-0 fw-bold small-14">Leave Apply</h6>
                                        <span class="text-muted">14</span>
                                    </div>
                                </div>
                            </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>

    @livewireScripts

@endsection
