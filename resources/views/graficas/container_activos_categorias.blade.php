<table id="datatable_activos_categorias" class="table" style="display: none">
    <thead>
        <tr>
            <th>Sucursal</th>
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

<script>
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
