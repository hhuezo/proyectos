@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

    <link rel="stylesheet" href="{{ asset('jqwidgets/jqwidgets/styles/jqx.base.css') }}" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />

    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxcore.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxdata.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxdata.export.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxbuttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxscrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxmenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxgrid.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxgrid.edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxgrid.selection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/jqwidgets/jqxgrid.export.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jqwidgets/scripts/demos.js') }}"></script>


    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>


    <script type="text/javascript">
        $(document).ready(function() {



            $("#enviarDatos").jqxButton({
                theme: theme
            });

            // Manejar clic del botón "Enviar Datos"
            $("#enviarDatos").click(function() {
                $.ajax({
                    url: "{{ url('dashboard') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cellValues": cellValues
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                    // No es necesario el bloque 'complete' aquí, ya que no estamos actualizando la cuadrícula
                });
            });







            var datos = <?php echo json_encode($grafica); ?>;
            //console.log("hola", @json($grafica));
            var cellValues = {}; // Cambié a un objeto en lugar de un array

            // renderer for grid cells.
            var numberrenderer = function(row, column, value) {
                return '<div style="text-align: center; margin-top: 5px;">' + (1 + value) + '</div>';
            }

            // Function to update cell value and store in the object
            var updateCellValue = function(rowid, column, value) {
                var cellKey = rowid + '-' + column;
                cellValues[cellKey] = value;
                //console.log("hola ",cellValues);
            }

            // create Grid datafields and columns arrays.
            var datafields = [];
            var columns = [];
            for (var i = 0; i < 26; i++) {
                var text = String.fromCharCode(65 + i);
                if (i == 0) {
                    var cssclass = 'jqx-widget-header';
                    if (theme != '') cssclass += ' jqx-widget-header-' + theme;
                    columns[columns.length] = {
                        pinned: true,
                        exportable: false,
                        text: "",
                        columntype: 'number',
                        cellclassname: cssclass,
                        cellsrenderer: numberrenderer
                    };
                }
                datafields[datafields.length] = {
                    name: text
                };
                columns[columns.length] = {
                    text: text,
                    datafield: text,
                    width: 60,
                    align: 'center'
                };
            }

            var source = {
                unboundmode: true,
                totalrecords: 25,
                datafields: datafields,
                updaterow: function(rowid, rowdata, commit) {
                    for (var i = 0; i < columns.length; i++) {
                        updateCellValue(rowid, columns[i].datafield, rowdata[columns[i].datafield]);
                    }
                    commit(true);

                }
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            // initialize jqxGrid
            $("#grid").jqxGrid({
                width: getWidth('Grid'),
                source: dataAdapter,
                editable: true,
                columnsresize: true,
                selectionmode: 'multiplecellsadvanced',
                columns: columns
            });

            $("#excelExport").jqxButton({
                theme: theme
            });

            // Llenar todas las celdas con los valores de datos
            for (var row = 0; row < 25; row++) {
                for (var col = 1; col <= 26; col++) {
                    var columnName = columns[col].datafield;
                    var cellKey = row + '-' + columnName;

                    // Obtener el valor correspondiente a la celda desde datos
                    var cellValue = datos[cellKey];

                    // Asignar el valor a la celda en la cuadrícula
                    $("#grid").jqxGrid('setcellvalue', row, columnName, cellValue);
                }
            }

            // Manejar el evento 'bindingcomplete' para llenar las celdas después de la inicialización
            $("#grid").on('bindingcomplete', function() {
                console.log("hola");
            });


            $("#excelExport").click(function() {
                $("#grid").jqxGrid('exportdata', 'xls', 'jqxGrid', false);
            });


        });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2FX5PV9DNT">
        < /> <
        script >
            window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-2FX5PV9DNT');
    </script>


    <div id='jqxWidget'>
        <div id="grid"></div>
        <div style='margin-top: 20px;'>
            <div style='float: left;'>
                <input type="button" value="Export to Excel" id='excelExport' />
            </div>

            <div style='float: left; margin-left: 10px;'>
                <input type="button" value="Enviar Datos" id='enviarDatos' />
            </div>
        </div>
    </div>
    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Chart showing browser market shares. Clicking on individual columns
            brings up more detailed data. This chart makes use of the drilldown
            feature in Highcharts to easily switch between datasets.
        </p>
    </figure>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Corn vs wheat estimated production for 2020',
        align: 'left'
    },
    subtitle: {
        text:
            'Source: <a target="_blank" ' +
            'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
        align: 'left'
    },
    xAxis: {
        categories: @json($encabezados),
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: '1000 metric tons (MT)'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 MT)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: @json($data_grafico)

    // [
    //     {
    //         name: 'Corn',
    //         data: [406292, 260000, 107000, 68300, 27500, 14500]
    //     },
    //     {
    //         name: 'Wheat',
    //         data: [51086, 136000, 5500, 141000, 107180, 77000]
    //     }
    // ]
});

    </script>
@endsection
