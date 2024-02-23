@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <style>
        #container {
            height: 1000px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }


        .buttons {
            min-width: 310px;
            text-align: center;
            margin: 1rem 0;
            font-size: 0;
        }

        .buttons button {
            cursor: pointer;
            border: 1px solid silver;
            border-right-width: 0;
            background-color: #f8f8f8;
            font-size: 1rem;
            padding: 0.5rem;
            transition-duration: 0.3s;
            margin: 0;
        }

        .buttons button:first-child {
            border-top-left-radius: 0.3em;
            border-bottom-left-radius: 0.3em;
        }

        .buttons button:last-child {
            border-top-right-radius: 0.3em;
            border-bottom-right-radius: 0.3em;
            border-right-width: 1px;
        }

        .buttons button:hover {
            color: white;
            background-color: rgb(158 159 163);
            outline: none;
        }

        .buttons button.active {
            background-color: #0051b4;
            color: white;
        }
    </style>



    <figure>
     
        
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h4 class="fw-bold mb-0">Evaluacion Proveedores</h4>
                    <div class="col-auto d-flex w-sm-100">
                        <a href="{{ url('infraestructura/evaluaciones') }}">
                            {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                    class="icofont-arrow-left me-2 fs-6"></i></button>
                        </a>
                    </div>
                </div>
            </div> <!-- Row end  -->

           
         
        <div class="row col-12">
            <div class="col-6 card" style="max-height: 600px; overflow-y: auto;">
                <label class="form-label" align="left"><strong>Periodo</strong></label>
                <select id="year" class="form-select" onchange="obtener_data()">
                    @for ($i = date('Y'); $i >= 2018; $i--)
                        <option value ="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-6 card">
                <label class="form-label" align="left"><strong>Mes</strong></label>
                <select id="month" class="form-select" align="left" onchange="obtener_data()">
                    @foreach ($meses as $key => $value)
                        <option value ="{{ $key }}" {{ $month == $key ? 'selected' : '' }}>{{ $value }}
                        </option>
                    @endforeach
                </select>
               
            </div>
           
        </div>



        


        <br>


        <div class="row col-12">
            <div class="col-9 card" style="max-height: 600px; overflow-y: auto;">
                <div id="container"></div>
            </div>
            <div class="col-3 card">
                <br>   Grafica de Notas</br>
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>proveedor</th>
                            <th>nota</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($resultados as $resultado)
                            <tr>
                                <th>{{ $resultado->nombre }}</th>
                                <td>{{ $resultado->puntos }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

              <br> Rango de calificacion</br>
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Aceptado</th>
                            <th>Limite Inferior</th>
                            <th>Limite Superior</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($rango_evaluacion as $rangos)
                            <tr>
                                <th>{{ $rangos->categoria }}</th>
                                <td>{{ $rangos->aceptado }}</td>
                                <td>{{ $rangos->limite_inferior }}</td>
                                <td>{{ $rangos->limite_superior }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                


            </div>
        </div>
        <div>&nbsp;</div>
 
 



    </figure>




    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {

            get_mantenimientos();


        });

        Highcharts.chart('container', {
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Evaluacion de proveedores'
            },
            subtitle: {
                text:
                    //'Source: <a href="https://www.ssb.no/en/statbank/table/04231" target="_blank">SSB</a>'
                    ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Puntaje'
                }
            }
        });

        function get_mantenimientos() {

            var mtto_sucursales = document.getElementById('mtto_sucursales').value;
            var mtto_areas = document.getElementById('mtto_areas').value;
            var mtto_activos = document.getElementById('mtto_activos').value;


            $.ajax({
                url: "{{ url('/home/soporte_mantenimientos') }}/" + mtto_sucursales + "/" + mtto_areas + "/" +
                    mtto_activos,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    $('#container_mantenimientos').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
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
        function obtener_data() {
            var anio = document.getElementById('year').value;
            var mes = document.getElementById('month').value;
            console.log(anio, mes);

            // Obtén la URL de Laravel desde PHP y redirige
            var url = "{!! url('infraestructura/evaluaciones/reporte') !!}/" + encodeURIComponent(anio) + "/" + encodeURIComponent(mes);
            window.location.replace(url);
        }
    </script>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>

@endsection
