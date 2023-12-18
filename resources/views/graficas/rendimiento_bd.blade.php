<figure class="highcharts-figure">
    <div id="container_rendimiento_bd"></div>
    <p class="highcharts-description">
    </p>
</figure>


<script>
    Highcharts.chart('container_rendimiento_bd', {
        chart: {
            type: 'column',

        },

        title: {
            text: '',
            align: 'left'
        },
        colors: ['#F1595C', '#FA916B', '#7E96FC', '#0CE7FA', '#50C793'],
        subtitle: {
            text: '',
            align: 'left'
        },
        xAxis: {
            categories: @json($nombre_meses),
            crosshair: true,
            accessibility: {
                description: 'Countries'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                point: {
                    events: {
                        click: function() {
                            modal_rendimiento_bd(this.series.name,this.category)
                            //console.log('Haz hecho click en la barra: ' + this.category+ ' '+ this.series.name);
                        }
                    }
                }
            }
        },
        series: @json($series)
    });









    function modal_rendimiento_bd(categoria, mes) {
        var anio = document.getElementById('anio').value;
        $.ajax({
            url: "{{ url('/home/charts/get_modal_rendimiento_bd') }}/" + anio+'/'+categoria+'/'+mes,
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
