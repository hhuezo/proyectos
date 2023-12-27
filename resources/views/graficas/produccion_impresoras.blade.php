<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de stock de armas nucleares de EE. UU. y la
        URSS/Rusia</title>
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
</head>

<body>
    <figure class="highcharts-figure">
        <div id="container_produccion_impresoras"></div>

    </figure>
    <script>

        // Convert PHP variable to JavaScript
        var fecha_inicio = "<?php echo $fecha_inicio; ?>";

        // Split the date string into an array
        var dateArray = fecha_inicio.split("-");

        // Extract year, month, and day
        var year = parseInt(dateArray[0], 10);
        var month = parseInt(dateArray[1], 10) - 1; // Subtract 1 for 0-based months (JavaScript Date uses 0-based months)
        var day = parseInt(dateArray[2], 10);

        Highcharts.chart('container_produccion_impresoras', {

            title: {
                text: 'Producción diaria',
                align: 'left'
            },

            subtitle: {
                text: '',
                align: 'left'
            },

            yAxis: {
                //visible: false, // Oculta el eje Y
                title: {
                    text: ''
                }
            },

            xAxis: {
                type: 'datetime', // Assuming your dates are in a datetime format
                accessibility: {
                    rangeDescription: `Range: {$fecha_inicio} to {$fecha_final}`
                },
                labels: {
                    format: '{value:%d/%m/%Y}', // Format the date as needed
                },
            },

            legend: {
                enabled: false, // Desactiva la leyenda
            },


            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    // Specify the pointStart as the start date of your data
                    pointStart: Date.UTC(year, month, day),
                    // Specify the pointInterval as the interval between data points in milliseconds
                    pointInterval: 24 * 3600 * 1000, // Assuming daily data
                }
            },

            series:@json($data),

            // series: [{
            //         name: 'Installation & Developers',
            //         data: [43934, 48656, 65165, 81827, 112143, 142383,
            //             171533, 165174, 155157, 161454, 154610
            //         ]
            //     }, {
            //         name: 'Manufacturing',
            //         data: [24916, 37941, 29742, 29851, 32490, 30282,
            //             38121, 36885, 33726, 34243, 31050
            //         ]
            //     }, {
            //         name: 'Sales & Distribution',
            //         data: [11744, 30000, 16005, 19771, 20185, 24377,
            //             32147, 30912, 29243, 29213, 25663
            //         ]
            //     }, {
            //         name: 'Operations & Maintenance',
            //         data: [null, null, null, null, null, null, null,
            //             null, 11164, 11218, 10077
            //         ]
            //     }, {
            //         name: 'Other',
            //         data: [21908, 5548, 8105, 11248, 8989, 11816, 18274,
            //             17300, 13053, 11906, 10073
            //         ]
            //     },
            //     {
            //         name: 'test1',
            //         data: [12567, 28976, 17890, 20543, 19876, 23789,
            //             31000, 30567, 28543, 29567, 25000
            //         ]
            //     },
            //     {
            //         name: 'test2',
            //         data: [13456, 27890, 18900, 21000, 19834, 23000,
            //             32000, 30000, 28000, 29000, 25000
            //         ]
            //     }


            // ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }


        });
    </script>

</body>

</html>
