@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <style>
        .highcharts-credits {
            display: none;
        }
    </style>

    <div class="mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">

                <div class="row align-item-center">

                    @if ($graficas->count() > 0)


                        @foreach ($graficas as $grafica)
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">


                                <div class="tab-content mt-2">
                                    <div
                                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                        <button class="btn btn-primary"
                                            onclick="sendGetRequest({{ $grafica->id }})">configuracion</button>
                                        <div class="col-auto d-flex w-sm-100">
                                                <button class="btn btn-primary  float-right"  data-bs-toggle="modal" onclick="get_edit_grafico({{$grafica->id}})"
                                                data-bs-target="#modal-edit-grafico"><i
                                                        class="fa fa-edit"></i></button>

                                            &nbsp;&nbsp;
                                            <button class="btn btn-danger  float-right" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $grafica->id }}"><i
                                                    class="fa fa-trash"></i></button>

                                        </div>
                                    </div>





                                    <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                                        <div class="row col-12 g-3">
                                            <div class="card">
                                                <div id="container{{ $grafica->id }}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-config{{ $grafica->id }}" role="tabpanel">
                                        <div class="row col-8 g-3">
                                            <div class="card">

                                            </div>
                                        </div>



                                    </div>

                                </div>

                                @include('dashboard.modal')

                            </div>
                            <div>&nbsp;</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>


    <div class="offcanvas offcanvas-end hide" tabindex="-1" id="offcanvas_setting" aria-labelledby="offcanvas_setting"
        style="visibility: hidden; width:800px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Configuración</h5>
            <button type="button" class="btn-close" onclick="hideToggleOffcanvas()" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">

            <div class="mb-4 flex-grow-1" id="div_config">

            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-nuevo-grafico" tabindex="-1" aria-labelledby="exampleModalLgLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ url('dashboard') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="leaveaddLabel">Nuevo grafico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-md-3" align="right"><strong>Tipo
                                            gráfico</strong></label>
                                    <div class="col-9">
                                        <select name="tipo_grafica_id" required class="form-select">
                                            <option value="1">Barra</option>
                                            {{-- <option value="2">Pastel</option> --}}
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
                                    <div class="col-9">
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
                                    <div class="col-9">
                                        <input type="text" name="descripcion" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-md-3" align="right"><strong>Linea estandar establecida
                                            Y</strong></label>
                                    <div class="col-9">
                                        <input type="number" name="linea_estandar" step="0.01" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="modal-edit-grafico" tabindex="-1" aria-labelledby="exampleModalLgLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST"  action="{{ url('dashboard/update_grafica') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="leaveaddLabel">Modificar grafico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-md-3" align="right"><strong>Tipo
                                            gráfico</strong></label>
                                    <div class="col-9">
                                        <select name="tipo_grafica_id" required class="form-select">
                                            <option value="1">Barra</option>
                                            {{-- <option value="2">Pastel</option> --}}
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
                                    <div class="col-9">
                                        <input type="hidden" name="id" id="id_grafico" class="form-control">
                                        <input type="text" name="titulo" id="titulo" required class="form-control">
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
                                    <div class="col-9">
                                        <input type="text" name="descripcion" id="descripcion" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="form-label col-md-3" align="right"><strong>Linea estandar establecida
                                            Y</strong></label>
                                    <div class="col-9">
                                        <input type="number" name="linea_estandar" id="linea_estandar" step="0.01" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <div class="contenedor"
        style="width: 90px;
        height: 240px;
        position: absolute;
        right: 0px;
        bottom: 0px;">
        <button class="botonF1" data-bs-toggle="modal" data-bs-target="#modal-nuevo-grafico"
            style=" width: 60px;
        height: 60px;
        border-radius: 100%;
        background: #484c7f;
        right: 0;
        bottom: 0;
        position: absolute;
        margin-right: 16px;
        margin-bottom: 16px;
        border: none;
        outline: none;
        color: #FFF;
        font-size: 36px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: .3s;">
            <span>+</span>
        </button>

    </div>

    {{-- <script src="{{ asset('assets/jquery.min.js') }}"></script> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



    <script>
        $(document).ready(function() {
            hideToggleOffcanvas();
        });

        function sendGetRequest(id) {
            //var div_config = "#div_config" + id;
            var url = "{{ url('dashboard') }}/" + id;
            $.get(url, function(data) {
                //console.log(data);
                $("#div_config").html(data);
            });

            // $.get(url, function(data) {
            //     //console.log(data);
            //     $("#div_config").html(data);
            // });

            toggleOffcanvas();
        }


        function get_edit_grafico(id)
        {
            var url = "{{ url('dashboard') }}/" + id+'/edit';
            $.get(url, function(data) {
                document.getElementById('titulo').value = data.titulo;
                document.getElementById('id_grafico').value = data.id;
                document.getElementById('descripcion').value = data.descripcion;
                document.getElementById('linea_estandar').value = data.linea_estandar;
            });
        }
    </script>



    <script>
        var graficas = @json($graficas);

        for (var i = 0; i < graficas.length; i++) {

            var plotOptions = {};


            if (graficas[i].tipo_grafico === "column") {
                console.log(graficas[i].tipo_grafico);
                plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}', // Muestra el valor de 'y' en la columna
                            style: {
                                fontWeight: 'bold'
                            }
                        }
                    }
                };
            } else {
                plotOptions = {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: graficas[i].encabezado[i] +
                                ' - {point.y}', // Muestra el valor de 'y' seguido por el nombre de la columna
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                };
            }







            Highcharts.chart('container' + graficas[i].id, {
                chart: {
                    //type: 'column'
                    type: graficas[i].tipo_grafico
                },
                title: {
                    text: graficas[i].titulo,
                    align: 'left'
                },
                subtitle: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: graficas[i].encabezado,
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: graficas[i].descripcion
                    },
                    plotLines: graficas[i].linea_estandar > 0 ? [{
                        color: 'red', // Color de la línea
                        dashStyle: 'solid', // Estilo de la línea (puedes cambiarlo según tus preferencias)
                        value: graficas[i].linea_estandar, // Valor del máximo permitido
                        width: 2, // Grosor de la línea
                        label: {
                            text: 'Línea estándar establecida', // Etiqueta asociada a la línea
                            align: 'right',
                            x: -10
                        }
                    }] : undefined

                },


                tooltip: {
                    valueSuffix: ''

                },
                plotOptions: plotOptions,


                series: graficas[i].data_grafico
            });
        }
    </script>

    <script>
        function toggleOffcanvas() {
            // Obtén el elemento offcanvas por su id
            var offcanvasElement = document.getElementById("offcanvas_setting");

            // Agrega la clase "show" al offcanvas
            offcanvasElement.classList.add("show");
            if (offcanvasElement) {
                offcanvasElement.style.display = "block";
                offcanvasElement.style.visibility = "visible";
            } else {
                console.error("El elemento con el ID 'offcanvas_setting' no fue encontrado.");
            }
        }

        function hideToggleOffcanvas() {
            var offcanvasElement = document.getElementById("offcanvas_setting");
            offcanvasElement.classList.add("hide");
            if (offcanvasElement) {
                offcanvasElement.style.display = "none";
                offcanvasElement.style.visibility = "hide";
            } else {
                console.error("El elemento con el ID 'offcanvas_setting' no fue encontrado.");
            }
        }
    </script>


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
