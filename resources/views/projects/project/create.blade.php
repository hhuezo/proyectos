@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        .form-control,
        .form-select {
            border-color: #d3d2d2;
            background-color: transparent;
        }
        .nav-tabs .nav-link {
            color :  #484c7f;
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            background-color: var(--primary-color) !important;
            color: #fff;
        }
    </style>

    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Create project</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('project') }}">
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active border" data-bs-toggle="tab" href="#summary">Main</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" data-bs-toggle="tab" disabled href="#teamEngagementSummary">Engagement
                                    Summary</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border" data-bs-toggle="tab" disabled href="#teamSummary">Team Summary</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border" data-bs-toggle="tab" disabled href="#teamPlannerNativo">Team Planner
                                    Nativo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link border" data-bs-toggle="tab" disabled href="#securityRequirements">Security
                                    Requirements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" data-bs-toggle="tab" disabled href="#assumptions">Assumptions</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="summary" class="tab-pane fade show active">
                                <div>&nbsp;</div>
                                <form  method="POST" action="{{ route('project.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Engagement
                                                                    Title</strong></label>
                                                            <div class="col-9">
                                                                <input type="text" value="{{ old('title') }}"
                                                                    name="title" required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3" align="right"><strong>Level
                                                                    of
                                                                    Confidence</strong></label>
                                                            <div class="col-9">
                                                                <select name="level_confidence" required
                                                                    class="form-select">
                                                                    <option value="1"
                                                                        {{ old('level_confidence') == 1 ? 'selected' : '' }}>
                                                                        Low</option>
                                                                    <option value="2"
                                                                        {{ old('level_confidence') == 2 ? 'selected' : '' }}>
                                                                        Medium</option>
                                                                    <option value="3"
                                                                        {{ old('level_confidence') == 3 ? 'selected' : '' }}>
                                                                        High</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>

                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Requestor</strong></label>
                                                            <div class="col-9">
                                                                <input type="text" name="requestor"
                                                                    value="{{ old('requestor') }}" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>

                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Estimator</strong></label>
                                                            <div class="col-9">
                                                                <input type="text" name="estimator"
                                                                    value="{{ old('estimator') }}" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>

                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Version</strong></label>
                                                            <div class="col-9">
                                                                <input type="text" name="version"
                                                                    value="{{ old('version') }}" required
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>
                                            </div>

                                            <div class="col-md-6">


                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Start date</strong></label>
                                                            <div class="col-9">
                                                                <input type="date" name="start_date" id="start_date"
                                                                    required onchange="calculateMonths()"
                                                                    value="{{ old('start_date') }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>

                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3" align="right"><strong>End
                                                                    date</strong></label>
                                                            <div class="col-9">
                                                                <input type="date" name="end_date" id="end_date"
                                                                    required onchange="calculateMonths()"
                                                                    value="{{ old('end_date') }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>


                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Number
                                                                    of months</strong></label>
                                                            <div class="col-9">
                                                                <input type="number" name="number_months" required
                                                                    id="number_months" readonly
                                                                    value="{{ old('number_months') }}" step="1"
                                                                    required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>


                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Estimated
                                                                    hours</strong></label>
                                                            <div class="col-9">
                                                                <input type="number" name="estimated_hours"
                                                                    value="{{ old('estimated_hours') }}" step="1"
                                                                    required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>


                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="form-label col-md-3"
                                                                align="right"><strong>Estimated
                                                                    investment</strong></label>
                                                            <div class="col-9">
                                                                <input type="number" name="estimated_investment"
                                                                    value="{{ old('estimated_investment') }}"
                                                                    step="1" required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>&nbsp;</div>
                                            </div>

                                        </div>




                                        <div class="modal-footer">
                                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                                            <button type="submit" class="btn btn-primary">Next</button>
                                        </div>



                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>






    <script>
        function calculateMonths() {
            var start_date = document.getElementById('start_date').value;
            var end_date = document.getElementById('end_date').value;

            if (start_date != "" && end_date != "") {
                var monthsDiff = moment(end_date).diff(moment(start_date), 'months');

                console.log(monthsDiff);
                document.getElementById('number_months').value = monthsDiff + 1;

            }
        }
    </script>


@endsection
