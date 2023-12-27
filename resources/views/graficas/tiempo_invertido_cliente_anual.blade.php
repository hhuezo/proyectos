
<figure class="highcharts-figure">

    <div id="container_tiempo_invertido_cliente_anual"></div>
    <p class="highcharts-description">
    </p>
</figure>


<script>
    Highcharts.chart('container_tiempo_invertido_cliente_anual', {
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        colors: ['#2A3F96', '#FA916B', '#64748b', '#0CE7FA', '#50C793'],
        tooltip: {
            valueSuffix: ''
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                     },
                    // filter: {
                    //     operator: '>',
                    //     property: 'Horas',
                    //     value: 10
                    // }
                }]
            }
        },


        series: [{
            name: 'Horas',
            colorByPoint: true,
            data: @json($data_anual)
        }]
    });
</script>
