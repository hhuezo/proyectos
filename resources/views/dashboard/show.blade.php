<link rel="stylesheet" href="{{ asset('jqwidgets/jqwidgets/styles/jqx.base.css') }}" type="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />

<!-- jQuery -->
<script src="{{ asset('assets/jquery.min.js') }}"></script>

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



<script>
    $(document).ready(function() {
        console.log(<?php echo json_encode($grafica); ?>);
        var datos = <?php echo json_encode($grafica); ?>;
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




        // Manejar clic del botón "Enviar Datos"
        $("#enviarDatos").click(function() {

            console.log(document.getElementById('id').value);
            var id = document.getElementById('id').value;
            $.ajax({
                url: "{{ url('dashboard') }}/" + id,
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cellValues": cellValues
                },
                success: function(response) {
                    console.log(response);
                    window.location.href = "{{ url('dashboard') }}";
                },
                error: function(error) {
                    console.error(error);
                }
                // No es necesario el bloque 'complete' aquí, ya que no estamos actualizando la cuadrícula
            });

        });

    });
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-2FX5PV9DNT"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-2FX5PV9DNT');
</script>
</head>





<div id='jqxWidget'>
    <div id="grid"></div>
    <input type="hidden" value="{{ $id }}" id="id">
    <div style='margin-top: 20px;'>
        <button style="display: none" class="btn btn-primary" id='excelExport'><i class="fa fa-excel"></i>
            Exportar</button>
    </div>

    <div class="d-flex">
        <button id='enviarDatos' class="btn w-100 ms-1 py-2 btn-dark">Guardar</button>
    </div>


</div>
