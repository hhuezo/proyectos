
<figure class="highcharts-figure">

    <div id="container_dispositivos"></div>
    <p class="highcharts-description">
        Chart showing browser market shares. Clicking on individual columns
        brings up more detailed data. This chart makes use of the drilldown
        feature in Highcharts to easily switch between datasets.
    </p>
</figure>

<script>
    Highcharts.chart('container_dispositivos', {
        chart: {
            type: 'bar',
            height: {{count($data) > 4 ? count($data)*35 : 140 }}
        },
        title: {
            align: 'left',
            text: 'Impresiones restantes'
        },
        subtitle: {
            align: 'left',
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: ''
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">Impresiones restantes</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
        },

        series: [{
            name: 'Browsers',
            colorByPoint: true,
            data: @json($data)
        }]
    });
</script>
