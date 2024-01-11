
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

    </script>
