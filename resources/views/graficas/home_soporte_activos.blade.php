<ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-activos-iso"
            role="tab">Activos ISO</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-activos" role="tab">Activos por categoria</a>
    </li>
</ul>

 <div class="tab-content mt-2">
    <div class="tab-pane fade show active" id="nav-activos-iso" role="tabpanel">
        <div class="card g-3">
            <div class="row col-12">
                <div class="col-9 card" id="container_activos_iso">
                </div>
                <div class="col-3 card">
                    <form method="GET" id="form_activos">
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Sucursal</strong></label>
                                <div>
                                    <select id="sucursal" onchange="get_estado_categoria(this.value)" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value="{{ $sucursal }}">{{ $sucursal }}</option>
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
                                    <select id="area" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Estados</strong></label>
                                <div>
                                    <select id="estado" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado }}">{{ $estado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Categoria</strong></label>
                                <div>
                                    <select id="categoria" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($categorias as $catagoria)
                                            <option value="{{ $catagoria }}">{{ $catagoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12" style="text-align: right">
                            <button type="button" class="btn btn-primary" onclick="get_activos()">Aceptar</button>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-activos" role="tabpanel">
        <div class="card g-3">
            <div class="row col-12">
                <div class="col-9 card" id="container_activos_categorias">
                </div>
                <div class="col-3 card">
                    <form method="GET" id="form_activos">
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Sucursal</strong></label>
                                <div>
                                    <select id="sucursal_categoria" onchange="get_data_categoria(this.value)" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value="{{ $sucursal }}">{{ $sucursal }}</option>
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
                                    <select id="area_categoria" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Estados</strong></label>
                                <div>
                                    <select id="estado_categoria" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado }}">{{ $estado }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" align="right"><strong>Categoria</strong></label>
                                <div>
                                    <select id="categoria_categoria" class="form-control">
                                        <option value="0">SELECCIONE</option>
                                        @foreach ($categorias as $catagoria)
                                            <option value="{{ $catagoria }}">{{ $catagoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">&nbsp; </div>
                        <div class="col-md-12" style="text-align: right">
                            <button type="button" class="btn btn-primary" onclick="get_activos_categoria()">Aceptar</button>
                        </div>
                        <div class="col-md-12">&nbsp; </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>











<div>
    <table id="datatable_activos_iso" class="table" style="display: none">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Conteo</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($activos_iso as $resultado)
                <tr>
                    <th>{{ $resultado->sucursal_std }}</th>
                    <td>{{ $resultado->conteo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table id="datatable_activos_categorias" class="table" style="display: none">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Conteo</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($activos as $resultado)
                <tr>
                    <th>{{ $resultado->categoria }}</th>
                    <td>{{ $resultado->conteo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    Highcharts.chart('container_activos_iso', {
        data: {
            table: 'datatable_activos_iso'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Activos ISO'
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
                text: 'No de activos'
            }
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true, // Habilitar etiquetas de datos
                    format: '{y}', // Formato de la etiqueta de datos (valor del punto)
                    style: {
                        fontWeight: 'bold'
                    }
                }
            }
        }
    });

    Highcharts.chart('container_activos_categorias', {
        data: {
            table: 'datatable_activos_categorias'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Activos por categoria'
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
                text: 'No de activos'
            }
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true, // Habilitar etiquetas de datos
                    format: '{y}', // Formato de la etiqueta de datos (valor del punto)
                    style: {
                        fontWeight: 'bold'
                    }
                }
            }
        }
    });
</script>


