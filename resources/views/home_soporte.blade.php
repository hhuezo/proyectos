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
        <div class='buttons'>
            {{-- recorrido de botones de meses --}}
            @foreach ($meses as $key => $value)
                <a href="{{ url('home') }}/{{ $year }}/{{ $key }}">
                    <button id='{{ $value }}' class="{{ $month == $key ? 'active' : '' }}">
                        {{ $value }}
                    </button>
                </a>
            @endforeach

        </div>


        <br>




        <div class="row col-12">
            <div class="col-9 card"  style="max-height: 600px; overflow-y: auto;">
                <div id="container"></div>
            </div>
            <div class="col-3 card">
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th>Técnico</th>
                            <th>Pendiente</th>
                            <th>Realizado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($resultados as $resultado)
                            <tr>
                                <th>{{ $resultado->nombre_tecnico }}</th>
                                <td>{{ $resultado->pendiente }}</td>
                                <td>{{ $resultado->realizado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>&nbsp;</div>
        <div class="row col-12">
            <div class="col-9 card">
                <div id="container_sucursal"></div>
            </div>
            <div class="col-3 card">
                <table id="datatable_sucursal" class="table">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Pendiente</th>
                            <th>Realizado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($resultados_sucursal as $resultado)
                            <tr>
                                <th>{{ $resultado->sucursal }}</th>
                                <td>{{ $resultado->pendiente }}</td>
                                <td>{{ $resultado->realizado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div>&nbsp;</div>
        <div class="row col-12">
            <div class="col-9 card">
                <div id="container_correctivo"></div>
            </div>
            <div class="col-3 card">
                <table id="datatable_correctivo" class="table">
                    <thead>
                        <tr>
                            <th>Técnico</th>
                            <th>Pendiente</th>
                            <th>Realizado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($resultados_correctivos as $resultado)
                            <tr>
                                <th>{{ $resultado->nombre_tecnico }}</th>
                                <td>{{ $resultado->pendiente }}</td>
                                <td>{{ $resultado->realizado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>&nbsp;</div>
        <div class="row col-12">
            <div class="col-9 card">
                <div id="container_sucursal_correctivo"></div>
            </div>
            <div class="col-3 card">
                <table id="datatable_sucursal_correctivo" class="table">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Pendiente</th>
                            <th>Realizado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($resultados_sucursal_correctivos as $resultado)
                            <tr>
                                <th>{{ $resultado->sucursal }}</th>
                                <td>{{ $resultado->pendiente }}</td>
                                <td>{{ $resultado->realizado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>&nbsp;</div>



        <div id="container_activos">

        </div>
        <br>

        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-mantenimientos-frecuentes"
                    role="tab">Mantenimientos</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-auditoria" role="tab">Auditoria</a>
            </li>
        </ul>

        <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="nav-mantenimientos-frecuentes" role="tabpanel">
                <div class="card g-3">
                    <div class="row">
                        <div class="col-md-9">
                            <div id="container_mantenimientos"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Sucursal</strong></label>
                                    <div>
                                        <select id="mtto_sucursales" onchange="get_area_activo(this.value)"
                                            class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_sucursales as $sucursal)
                                                <option value="{{ $sucursal }}">{{ $sucursal }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Areas</strong></label>
                                    <div>
                                        <select id="mtto_areas" onchange="get_data_activos(this.value)"
                                            class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_areas as $area)
                                                <option value="{{ $area }}">{{ $area }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Activos</strong></label>
                                    <div>
                                        <select id="mtto_activos" class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_activos as $activo)
                                                <option value="{{ $activo }}">{{ $activo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12" style="text-align: right">
                                <button type="button" class="btn btn-primary"
                                    onclick="get_mantenimientos()">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-auditoria" role="tabpanel">
                <div class="card g-3">
                    <div class="row">
                        <div class="col-md-9">
                            <div id="container_mantenimientos_auditoria"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Sucursal</strong></label>
                                    <div>
                                        <select id="mtto_sucursales_auditoria" onchange="get_area_activo(this.value)"
                                            class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_sucursales as $sucursal)
                                                <option value="{{ $sucursal }}">{{ $sucursal }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Areas</strong></label>
                                    <div>
                                        <select id="mtto_areas_auditoria" onchange="get_data_activos(this.value)"
                                            class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_areas as $area)
                                                <option value="{{ $area }}">{{ $area }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" align="right"><strong>Activos</strong></label>
                                    <div>
                                        <select id="mtto_activos_auditoria" class="form-control">
                                            <option value="0">SELECCIONE</option>
                                            @foreach ($mtto_activos as $activo)
                                                <option value="{{ $activo }}">{{ $activo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp; </div>
                            <div class="col-md-12" style="text-align: right">
                                <button type="button" class="btn btn-primary"
                                    onclick="get_mantenimientos_auditoria()">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <br>




        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-impresiones-restantes"
                    role="tab">Impresiones restantes</a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-ribbon" role="tab">Ribbon
                    restante</a>
            </li>
        </ul>

        <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="nav-impresiones-restantes" role="tabpanel">
                <div class="card g-3">
                    <div class="row col-12">
                        <div class="col-9 card" id="container_dispositivos">
                        </div>
                        <div class="col-3 card">
                            <form method="GET" id="form_dispositivos">
                                <div class="col-md-12">&nbsp; </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" align="right"><strong>Sucursal</strong></label>
                                        <div>
                                            <select id="disp_sucursales" onchange="get_banco(this.value)"
                                                class="form-control">
                                                <option value="0">SELECCIONE</option>
                                                @foreach ($disp_sucursales as $sucursal)
                                                    <option value="{{ $sucursal }}">{{ $sucursal }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">&nbsp; </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" align="right"><strong>Bancos</strong></label>
                                        <div>
                                            <select id="disp_bancos" class="form-control">
                                                <option value="0">SELECCIONE</option>
                                                @foreach ($disp_bancos as $area)
                                                    <option value="{{ $area }}">{{ $area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">&nbsp; </div>
                                <div class="col-md-12" style="text-align: right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="get_dispositivos()">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-ribbon" role="tabpanel">
                <div class="card g-3">
                    <div class="row">
                        <div class="row col-12">
                            <div id="container_ribbon"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <br>

        <div class="row col-12">
            <div class="col-9 card" id="container_dispositivos">
            </div>
            <div class="col-3 card">

            </div>
        </div>


        <br>



        <div class="row col-12">
            <input type="hidden" id="seriales">
            <div class="col-9 card" id="container_produccion_impresoras">
            </div>
            <div class="col-3 card " style="max-height: 600px; overflow-y: auto;">
                <div class="col-12">&nbsp;</div>
                <ul class="list-group">
                    @foreach ($uniqueProduccion as $obj)
                        <li class="list-group-item"><input type="checkbox"
                                onclick="array_produccion_impresoras({{ $obj->serial }})"> {{ $obj->sucursal }} -
                            {{ $obj->serial }} </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </figure>


    @foreach ($graficas as $grafica)
        <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
            <div class="row col-12 g-3">
                <div class="card">
                    <div id="container{{ $grafica->id }}"></div>
                </div>
            </div>
        </div>
    @endforeach




    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            get_activos_iso();
            get_mantenimientos();
            get_mantenimientos_auditoria();
            get_dispositivos();
            get_produccion_impresoras();
            get_ribbon();
        });

        Highcharts.chart('container', {
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Mantenimientos preventivos(Técnicos)'
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
                    text: 'Mantenimientos'
                }
            }
        });

        Highcharts.chart('container_sucursal', {
            data: {
                table: 'datatable_sucursal'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Mantenimientos preventivos(Sucursales)'
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
                    text: 'Mantenimientos'
                }
            }
        });

        Highcharts.chart('container_correctivo', {
            data: {
                table: 'datatable_correctivo'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Mantenimientos correctivos(Técnicos)'
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
                    text: 'Mantenimientos'
                }
            }
        });

        Highcharts.chart('container_sucursal_correctivo', {
            data: {
                table: 'datatable_sucursal_correctivo'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Mantenimientos correctivos(Sucursales)'
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
                    text: 'Mantenimientos'
                }
            }
        });

        Highcharts.chart('container_dispositivos', {
            data: {
                table: 'datatable_dispositivos'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Mantenimientos correctivos(Sucursales)'
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
                    text: 'Mantenimientos'
                }
            }
        });

        function get_activos_iso() {
            $.ajax({
                url: "{{ url('/home/soporte_activos_iso') }}",
                method: 'GET',
                success: function(data) {
                    $('#container_activos').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });

        }

        function get_activos() {
            var sucursal = document.getElementById('sucursal').value;
            var estado = document.getElementById('estado').value;
            var categoria = document.getElementById('categoria').value;
            var area = document.getElementById('area').value;

            $.ajax({
                url: "{{ url('/home/soporte_activos') }}/" + sucursal + "/" + estado + "/" + categoria + "/" +
                    area,
                method: 'GET',
                success: function(data) {
                    $('#container_activos_iso').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function get_activos_categoria() {
            var sucursal = document.getElementById('sucursal_categoria').value;
            var estado = document.getElementById('estado_categoria').value;
            var categoria = document.getElementById('categoria_categoria').value;
            var area = document.getElementById('area_categoria').value;

            $.ajax({
                url: "{{ url('/home/soporte_activos_categoria') }}/" + sucursal + "/" + estado + "/" + categoria +
                    "/" +
                    area,
                method: 'GET',
                success: function(data) {
                    $('#container_activos_categorias').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function get_estado_categoria(sucursal) {
            $.ajax({
                url: "{{ url('home/soporte_activos/get_data') }}/" + sucursal,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.categorias.length; i++) {
                        _select += '<option value="' + data.categorias[i] + '" >' + data.categorias[i] +
                            '</option>';
                    }
                    $("#categoria").html(_select);

                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.estados.length; i++) {
                        _select += '<option value="' + data.estados[i] + '" >' + data.estados[i] + '</option>';
                    }
                    $("#estado").html(_select);


                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.areas.length; i++) {
                        _select += '<option value="' + data.areas[i] + '" >' + data.areas[i] + '</option>';
                    }
                    $("#area").html(_select);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }


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

        function get_mantenimientos_auditoria() {

            var mtto_sucursales = document.getElementById('mtto_sucursales_auditoria').value;
            var mtto_areas = document.getElementById('mtto_areas_auditoria').value;
            var mtto_activos = document.getElementById('mtto_activos_auditoria').value;

            $.ajax({
                url: "{{ url('/home/soporte_mantenimientos_auditoria') }}/" + mtto_sucursales + "/" + mtto_areas +
                    "/" +
                    mtto_activos,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    $('#container_mantenimientos_auditoria').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });

        }

        function get_dispositivos() {

            //$('#container_dispositivos').html('<div><img src="../../public/img/ajax-loader.gif"/></div>');
            $('#container_dispositivos').html(
                '<div align="center" style="margin-top:50px;"><img src="{{ asset('img/ajax-loader.gif') }}" /></div>');




            var sucursal = document.getElementById('disp_sucursales').value;
            var banco = document.getElementById('disp_bancos').value;
            //console.log(sucursal, banco);

            $.ajax({
                url: "{{ url('/home/soporte_dispositivos') }}/" + sucursal + "/" + banco,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    $('#container_dispositivos').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function get_ribbon() {

            //$('#container_dispositivos').html('<div><img src="../../public/img/ajax-loader.gif"/></div>');
            $('#container_dispositivos').html(
                '<div align="center" style="margin-top:50px;"><img src="{{ asset('img/ajax-loader.gif') }}" /></div>');




            var sucursal = document.getElementById('disp_sucursales').value;
            var banco = document.getElementById('disp_bancos').value;
            //console.log(sucursal, banco);

            $.ajax({
                url: "{{ url('/home/soporte_ribbon') }}/" + sucursal + "/" + banco,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    $('#container_ribbon').html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }


        function get_area_activo(sucursal) {
            $.ajax({
                url: "{{ url('home/soporte_activos/get_data_mantenimiento') }}/" + sucursal,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.areas.length; i++) {
                        _select += '<option value="' + data.areas[i] + '" >' + data.areas[i] +
                            '</option>';
                    }
                    $("#mtto_areas").html(_select);

                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.activos.length; i++) {
                        _select += '<option value="' + data.activos[i] + '" >' + data.activos[i] + '</option>';
                    }
                    $("#mtto_activos").html(_select);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }


        function get_data_activos(area) {
            var sucursal = document.getElementById('mtto_sucursales').value;
            $.ajax({
                url: "{{ url('home/soporte_activos/get_data_activos') }}/" + sucursal + "/" + area,
                method: 'GET',
                success: function(data) {

                    // Initialize the select element with a default option
                    var _select = '<option value="0">SELECCIONE</option>';

                    // Loop through the data.activos array and create options for each item
                    for (var i = 0; i < data.activos.length; i++) {
                        _select += '<option value="' + data.activos[i] + '" >' + data.activos[i] + '</option>';
                    }

                    // Set the HTML content of the #mtto_activos element with the generated options
                    $("#mtto_activos").html(_select);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function get_data_categoria(sucursal) {
            $.ajax({
                url: "{{ url('home/soporte_activos_categoria/get_data') }}/" + sucursal,
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.categorias.length; i++) {
                        _select += '<option value="' + data.categorias[i] + '" >' + data.categorias[i] +
                            '</option>';
                    }
                    $("#categoria_categoria").html(_select);

                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.estados.length; i++) {
                        _select += '<option value="' + data.estados[i] + '" >' + data.estados[i] + '</option>';
                    }
                    $("#estado_categoria").html(_select);


                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.areas.length; i++) {
                        _select += '<option value="' + data.areas[i] + '" >' + data.areas[i] + '</option>';
                    }
                    $("#area_categoria").html(_select);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }


        function get_banco(sucursal) {
            $.ajax({
                url: "{{ url('home/soporte_activos/get_data_banco') }}/" + sucursal,
                method: 'GET',
                success: function(data) {
                    //  console.log(data);
                    var _select = '<option value="0">SELECCIONE</option>';
                    for (var i = 0; i < data.bancos.length; i++) {
                        _select += '<option value="' + data.bancos[i] + '" >' + data.bancos[i] +
                            '</option>';
                    }
                    $("#disp_bancos").html(_select);


                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function get_produccion_impresoras() {
            var serialString = $("#seriales").val().split(",");
            if (serialString == "") {
                serialString = ["0"];
            }

            $.ajax({
                // url: "{{ url('home/soporte/get_produccion_impresoras') }}"+ "/".serialString,
                url: "{{ url('home/soporte/get_produccion_impresoras') }}/" + serialString,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $("#container_produccion_impresoras").html(data);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }

        function array_produccion_impresoras(serial) {
            // Convertir serial a cadena (string)
            var serialString = String(serial);

            var array_data = $("#seriales").val().split(",");
            var index = array_data.indexOf(serialString);

            if (index !== -1) {
                // El serial ya existe, eliminarlo
                array_data.splice(index, 1);
            } else {
                // El serial no existe, agregarlo
                array_data.push(serialString);
            }

            // Filtrar elementos vacíos del array
            array_data = array_data.filter(function(element) {
                return element.trim() !== '';
            });

            // Actualizar el valor del campo oculto con el nuevo array_data
            $("#seriales").val(array_data.join(","));
            get_produccion_impresoras();
            //console.log(array_data);
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


    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>

@endsection
