@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <style>
        .form-control,
        .form-select {
            border-color: #d3d2d2;
            background-color: transparent;
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            background-color: var(--primary-color) !important;
            color: #fff;
        }
    </style>

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #484c7f;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #484c7f;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .nav-tabs .nav-link {
            color: #484c7f;
            border-top-left-radius: 10px;
            /* ajusta el valor según sea necesario */
            border-top-right-radius: 10px;
        }
    </style>

    @if (session()->has('tab'))
        @php
            $tab = session('tab');
        @endphp
    @else
        @php
            $tab = 1;
        @endphp
    @endif

    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">{{ $project->title }}</h4>
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
                                <a class="nav-link {{ $tab == 1 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#summary">Main</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 2 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#teamEngagementSummary">Engagement
                                    Summary</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 3 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#teamSummary">Team Summary</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 4 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#teamPlannerNativo">Team Planner Nativo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 5 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#securityRequirements">Security
                                    Requirements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 6 ? 'active' : '' }} border" data-bs-toggle="tab"
                                    href="#assumptions">Assumptions</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="summary" class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }} border">
                                <div>&nbsp;</div>
                                <form method="POST" action="{{ route('project.update', $project->id) }}">
                                    @method('PUT')
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
                                                                <input type="text" value="{{ $project->title }}"
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
                                                                        {{ $project->level_confidence == 1 ? 'selected' : '' }}>
                                                                        Low</option>
                                                                    <option value="2"
                                                                        {{ $project->level_confidence == 2 ? 'selected' : '' }}>
                                                                        Medium</option>
                                                                    <option value="3"
                                                                        {{ $project->level_confidence == 3 ? 'selected' : '' }}>
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
                                                                    value="{{ $project->requestor }}" required
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
                                                                    value="{{ $project->estimator }}" required
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
                                                                    value="{{ $project->version }}" required
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
                                                                    onchange="calculateMonths()"
                                                                    value="{{ $project->start_date }}"
                                                                    class="form-control">
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
                                                                    onchange="calculateMonths()"
                                                                    value="{{ $project->end_date }}"
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
                                                                align="right"><strong>Number
                                                                    of months</strong></label>
                                                            <div class="col-9">
                                                                <input type="number" name="number_months"
                                                                    id="number_months" readonly
                                                                    value="{{ $project->number_months }}" step="1"
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
                                                                    value="{{ $project->estimated_hours }}"
                                                                    step="1" required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="estimated_investment" step="1" required
                                                    class="form-control">
                                                <div>&nbsp;</div>




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

                            <div id="teamEngagementSummary" class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}">
                                <div>&nbsp;</div>
                                <form method="post" action="{{ url('project/summary') }}">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" name="project" value="{{ $project->id }}">
                                        <textarea id="summernote" name="summary">
                                            {{ $project->summary }}
                                        </textarea>


                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
                                </form>

                            </div>

                            <div id="teamSummary" class="tab-pane fade {{ $tab == 3 ? 'show active' : '' }}">

                                <div class="card-body">
                                    <table class="table table-hover table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Role</th>
                                                <th>HR</th>
                                                <th>HA</th>
                                                <th>amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($roles as $role)
                                                @php($hr = $role->getHr($project->id,$role->id ))
                                                @php($ha = $role->getHA($project->id,$role->id ))
                                                @php($number = $role->getNumber($project->id,$role->id ))
                                                @php($team_id = $role->getIdTeam($project->id,$role->id ))
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    <td contenteditable="true" id="{{ $role->id }}-hr"
                                                        onblur="sendTeamHR({{ $project->id }},{{ $role->id }},this.textContent,{{ $team_id }})"
                                                        onkeypress="return isDecimalKey(event)">{{ $hr }}</td>
                                                    <td contenteditable="true" id="{{ $role->id }}-ha"
                                                        onblur="sendTeamHA({{ $project->id }},{{ $role->id }},this.textContent,{{ $team_id }})"
                                                        onkeypress="return isDecimalKey(event)">
                                                        {{ $ha }}</td>
                                                    <td contenteditable="true" id="role{{ $role->id }}"
                                                        onblur="sendRole({{ $project->id }},{{ $role->id }},this.textContent)"
                                                        onkeypress="return isNumberKey(event)">
                                                        {{ $number != null ? $number : '' }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <div class="modal-footer">
                                    <a href="{{ url('project/set_sesion/4') }}">
                                        <button type="button" class="btn btn-primary">Next</button>
                                    </a>
                                </div>
                            </div>


                            <div id="teamPlannerNativo" class="tab-pane fade {{ $tab == 4 ? 'show active' : '' }}">

                                @include('projects.project.team')

                            </div>

                            <div id="securityRequirements" class="tab-pane fade {{ $tab == 5 ? 'show active' : '' }}">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Secure Development Practice</th>
                                                <th scope="col">Required</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($security_requirements as $requirement)
                                                @php($value_requirement = $requirement->getRequirement($requirement->id, $project->id))
                                                <tr>
                                                    <td>{{ $requirement->description }}</td>
                                                    <td><label class="switch">
                                                            <input type="checkbox"
                                                                onchange="sendDataRequirement({{ $requirement->id }},{{ $project->id }})"
                                                                id="requirement{{ $requirement->id }}"
                                                                {{ $value_requirement === '1' ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ url('project/set_sesion/6') }}">
                                        <button type="button" class="btn btn-primary">Next</button>
                                    </a>
                                </div>
                            </div>
                            <div id="assumptions" class="tab-pane fade {{ $tab == 6 ? 'show active' : '' }}">
                                <form method="post" action="{{ url('project/assumptions') }}">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" name="project" value="{{ $project->id }}">
                                        <textarea id="summernoteAssumptions" name="assumptions">
                                            {{ $project->assumptions }}
                                        </textarea>


                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>


        <script>
            $(document).ready(function() {
                // getTotales();
            });


            $('#summernote').summernote({
                placeholder: 'Digite aca el contenido....',
                tabsize: 2,
                height: 400
            });

            $('#summernoteAssumptions').summernote({
                placeholder: 'Digite aca el contenido....',
                tabsize: 2,
                height: 400
            });



            function sendDataRequirement(id, project) {
                $.ajax({
                    url: "{{ url('project/send_data_requirement') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        project: project,
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.error('Error en la solicitud POST:', error);
                    }
                });
            }

            function calculateMonths() {
                var start_date = document.getElementById('start_date').value;
                var end_date = document.getElementById('end_date').value;

                if (start_date != "" && end_date != "") {
                    var monthsDiff = moment(end_date).diff(moment(start_date), 'months');

                    console.log(monthsDiff);
                    document.getElementById('number_months').value = monthsDiff + 1;

                }
            }

            function sendRole(project, role, value) {
                //console.log(role, " ", value, " ", project);
                var element_hr = document.getElementById(role + '-hr');

                if (element_hr) {
                    var hr = element_hr.textContent.trim();
                    console.log("*", hr);
                } else {
                    console.log("Element not found");
                }

                var element_ha = document.getElementById(role + '-ha');

                if (element_ha) {
                    var ha = element_ha.textContent.trim();
                    console.log("*", ha);
                } else {
                    console.log("Element not found");
                }


                $.ajax({
                    url: "{{ url('project/send_data_role') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        value: value.trim(),
                        project: project,
                        role: role,
                        hr: hr,
                        ha: ha,
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.error('Error en la solicitud POST:', error);
                    }
                });
            }

            function sendTeamHR(project, role, value, team_id) {
                console.log(role, value, project, team_id);
                if (team_id !== undefined) {
                    $.ajax({
                        url: "{{ url('project/update_data_role_hr') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            value: value.trim(),
                            project: project,
                            role: role,
                        },
                        success: function(data) {
                            console.log("data: ",data);
                        },
                        error: function(error) {
                            console.error('Error en la solicitud POST:', error);
                        }
                    });
                }
            }

            function sendTeamHA(project, role, value, team_id) {
                console.log(role, value, project, team_id);

                if (team_id !== undefined) {

                    $.ajax({
                        url: "{{ url('project/update_data_role_ha') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            value: value.trim(),
                            project: project,
                            role: role,
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(error) {
                            console.error('Error en la solicitud POST:', error);
                        }
                    });
                }
            }


            function isDecimalKey(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;

                // Permitir números del 0 al 9
                if (charCode >= 48 && charCode <= 57) {
                    return true;
                }

                // Permitir solo un punto decimal y verificar si ya hay uno presente
                if (charCode === 46 && evt.target.value.indexOf('.') === -1) {
                    return true;
                }

                return false; // Bloquear cualquier otro carácter
            }
        </script>

        <!-- Jquery Page Js -->
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
    @endsection
