@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">

                <div class="row align-item-center">

                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#nav-dashboard" role="tab">Dasboard</a>
                            </li>
                            <li class="nav-item" onclick="sendGetRequest(1)"><a class="nav-link" data-bs-toggle="tab" href="#nav-config"
                                    role="tab">Configuración</a></li>
                        </ul>


                        <div class="tab-content mt-2">
                            <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                <div class="row col-12 g-3">
                                    <div class="card">
                                        <div id="container"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-config" role="tabpanel">
                                <div class="row col-8 g-3">
                                    <div class="card">
                                        <div  id="div_config">
                                    </div>
                                </div>
                            </div>



                        </div>





                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('dashboard.modal')


    {{-- <script src="{{ asset('assets/jquery.min.js') }}"></script> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



    <script>
        $(document).ready(function() {
            //alert('');
        });

        function sendGetRequest(id) {
            var url = "{{ url('dashboard') }}/" + id;
            $.get(url, function(data) {
                console.log(data);
                $("#div_config").html(data);
            });

            $.get(url, function(data) {
                console.log(data);
                $("#div_config").html(data);
            });
        }
    </script>


    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Corn vs wheat estimated production for 2020',
                align: 'left'
            },
            subtitle: {
                text: 'Source: <a target="_blank" ' +
                    'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                align: 'left'
            },
            xAxis: {
                categories: @json($encabezados),
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '1000 metric tons (MT)'
                }
            },
            tooltip: {
                valueSuffix: ' (1000 MT)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: @json($data_grafico)
        });
    </script>


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
