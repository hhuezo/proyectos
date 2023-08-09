@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="section text-center">
    <h2 class="title">Control de tiempo</h2>

    <table>
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Minutos</td>
            </tr>
        </thead>
        <tbody>
            @php($tiempo = 0)
            @foreach ($actividades as $obj)
            <tr>
                <td>{{ date('d/m/Y', strtotime($obj->fecha)) }}</td>
                <td>{{$obj->tiempo_minutos}}</td>
            </tr>
            @php($tiempo += $obj->tiempo_minutos)
            @endforeach   
            
            <tr>
                <td>Total</td>
                <td>{{$tiempo}}</td>
            </tr>
              
            <tr>
                <td>Horas</td>
                <td>{{intval($tiempo/60)}} : {{$tiempo - (intval($tiempo/60) * 60)}}</td>
            </tr>
        </tbody>
    </table>



</div>


@endsection
