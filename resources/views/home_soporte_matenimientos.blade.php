<div id="container_mantenimientos"></div>
{{-- style="display: none" --}}
<div >
    <table id="datatable_mantenimientos" class="table">
        <thead>
            <tr>
                <th>Sucursal</th>
                <th>Conteo</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($frecuencia_mtto as $resultado)
                <tr>
                    <th>{{ $resultado->area }}</th>
                    <td>{{ $resultado->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    Highcharts.chart('container_mantenimientos', {
        data: {
            table: 'datatable_mantenimientos'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mantenimientos frecuentes'
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
                text: 'No de mantenimientos'
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
