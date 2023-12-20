
<figure class="highcharts-figure">
    <div id="container_tiempo_invertido_cliente"></div>
    <p class="highcharts-description">
    </p>
</figure>


<script>
    Highcharts.chart('container_tiempo_invertido_cliente', {
        chart: {
            type: 'column',

        },

        title: {
            text: '',
            align: 'left'
        },
        colors: ['#2A3F96', '#FA916B', '#64748b', '#0CE7FA', '#50C793'],
        subtitle: {
            text: '',
            align: 'left'
        },
        xAxis: {
            categories: @json($meses),
            crosshair: true,
            accessibility: {
                description: 'Countries'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Horas'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: @json($records)
    });









    function modal_rendimiento_bd(categoria, mes) {
        var anio = document.getElementById('anio').value;
        $.ajax({
            url: "{{ url('/home/charts/get_modal_rendimiento_bd') }}/" + anio + '/' + categoria + '/' + mes,
            method: 'GET',
            success: function(data) {
                console.log(data);
                $('#modal-content').html(data);
                $("#modalRendimientoBD").modal("show");
            },
            error: function(error) {
                console.error('Error en la solicitud:', error);
            }
        });
    }
</script>
