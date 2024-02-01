@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <style>
        .highcharts-credits {
            display: none;
        }
    </style>

    <div class="mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">

                <div class="row align-item-center">

                        <div class="card">
                            <div class="body d-flex py-lg-3 py-md-2">
                                <div class="container-xxl">
                                    <div class="row align-items-center">
                                        <div class="border-0 mb-4">
                                            <div
                                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                                <h3 class="fw-bold mb-0"> Projects</h3>
                                                <div class="col-auto d-flex w-sm-100">
                                                    <a href="{{ url('project/create') }}">
                                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                                class="icofont-plus-circle me-2 fs-6"></i>Nuevo</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> <!-- Row end  -->
                                        <div class="row clearfix g-3">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <div class="card-body">
                                                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    <th>Level of confidence</th>
                                                                    <th>Requestor</th>
                                                                    <th>Estimator</th>
                                                                    <th>Version</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if ($projects->count() > 0)
                                                                    @foreach ($projects as $obj)
                                                                        <tr class="even:bg-slate-50 black:even:bg-slate-700">
                                                                            <td>{{ $obj->title }}</td>
                                                                            <td>{{ $levels[$obj->level_confidence] }}</td>
                                                                            <td>{{ $obj->requestor }}</td>
                                                                            <td>{{ $obj->estimator }}</td>
                                                                            <td>{{ $obj->version }}</td>
                                                                            <td align="center">
                                                                              <a href="{{url('project')}}/{{$obj->id}}" target="_blank">
                                                                                        <button type="button" class="btn btn-outline-secondary"><i
                                                                                                class="icofont-eye-alt text-success btn-lg"></i></button>
                                                                                    </a>
                                                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                                    <a href="{{url('project')}}/{{$obj->id}}/edit">
                                                                                        <button type="button" class="btn btn-outline-secondary"><i
                                                                                                class="icofont-edit text-success btn-lg"></i></button>
                                                                                    </a>
                                                                                    <button type="button" data-bs-toggle="modal"
                                                                                    data-bs-target="#modal-delete-{{$obj->id}}" class="btn btn-outline-secondary"><i
                                                                                            class="icofont-ui-delete text-danger btn-lg"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                          @include('projects.project.modal')
                                                                    @endforeach
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                </div>
            </div>
        </div>

    </div>


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
