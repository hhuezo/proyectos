@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<style>
    #container {
        height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }


    .buttons {
        min-width: 310px;
        text-align: center;
        margin: 1rem 0;
        font-size: 0;
    }

    .buttons button {
        cursor: pointer;
        border: 1px solid silver;
        border-right-width: 0;
        background-color: #f8f8f8;
        font-size: 1rem;
        padding: 0.5rem;
        transition-duration: 0.3s;
        margin: 0;
    }

    .buttons button:first-child {
        border-top-left-radius: 0.3em;
        border-bottom-left-radius: 0.3em;
    }

    .buttons button:last-child {
        border-top-right-radius: 0.3em;
        border-bottom-right-radius: 0.3em;
        border-right-width: 1px;
    }

    .buttons button:hover {
        color: white;
        background-color: rgb(158 159 163);
        outline: none;
    }

    .buttons button.active {
        background-color: #0051b4;
        color: white;
    }
</style>


<figure>
    <div class='buttons'>
        {{-- recorrido de botones de meses --}}
        @foreach ($meses as $key => $value)
            <a href="{{ url('home') }}/{{ $year }}/{{ $key }}">
                <button id='{{ $value }}' class="{{ $month == $key ? 'active' : '' }}">
                    {{ $value }}
                </button>
            </a>
        @endforeach

    </div>

    <div class="row col-12">
        <div class="col-9 card">
            <div id="container"></div>
        </div>
        <div class="col-3 card">
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>Técnico</th>
                        <th>Pendiente</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($resultados as $resultado)
                        <tr>
                            <th>{{ $resultado->nombre_tecnico }}</th>
                            <td>{{ $resultado->pendiente }}</td>
                            <td>{{ $resultado->realizado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="row col-12">
        <div class="col-9 card">
            <div id="container_sucursal"></div>
        </div>
        <div class="col-3 card">
            <table id="datatable_sucursal" class="table">
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Pendiente</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($resultados_sucursal as $resultado)
                        <tr>
                            <th>{{ $resultado->sucursal }}</th>
                            <td>{{ $resultado->pendiente }}</td>
                            <td>{{ $resultado->realizado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div>&nbsp;</div>
    <div class="row col-12">
        <div class="col-9 card">
            <div id="container_correctivo"></div>
        </div>
        <div class="col-3 card">
            <table id="datatable_correctivo" class="table">
                <thead>
                    <tr>
                        <th>Técnico</th>
                        <th>Pendiente</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($resultados_correctivos as $resultado)
                        <tr>
                            <th>{{ $resultado->nombre_tecnico }}</th>
                            <td>{{ $resultado->pendiente }}</td>
                            <td>{{ $resultado->realizado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>&nbsp;</div>
    <div class="row col-12">
        <div class="col-9 card">
            <div id="container_sucursal_correctivo"></div>
        </div>
        <div class="col-3 card">
            <table id="datatable_sucursal_correctivo" class="table">
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Pendiente</th>
                        <th>Realizado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($resultados_sucursal_correctivos as $resultado)
                        <tr>
                            <th>{{ $resultado->sucursal }}</th>
                            <td>{{ $resultado->pendiente }}</td>
                            <td>{{ $resultado->realizado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>







</figure>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>

<script>
    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mantenimientos preventivos(Técnicos)'
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
                text: 'Mantenimientos'
            }
        }
    });


    Highcharts.chart('container_sucursal', {
        data: {
            table: 'datatable_sucursal'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mantenimientos preventivos(Sucursales)'
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
                text: 'Mantenimientos'
            }
        }
    });

    Highcharts.chart('container_correctivo', {
        data: {
            table: 'datatable_correctivo'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mantenimientos correctivos(Técnicos)'
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
                text: 'Mantenimientos'
            }
        }
    });

    Highcharts.chart('container_sucursal_correctivo', {
        data: {
            table: 'datatable_sucursal_correctivo'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mantenimientos correctivos(Sucursales)'
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
                text: 'Mantenimientos'
            }
        }
    });
</script>



   <!-- Jquery Page Js -->
   <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
   <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
   <script src="{{ asset('js/template.js') }}"></script>
   <script src="{{ asset('js/page/hr.js') }}"></script>

@endsection
