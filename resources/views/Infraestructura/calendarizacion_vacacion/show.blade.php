@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0"> Reporte Vacacional </h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('infraestructura/vacaciones') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Row end  -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form id="basic-form" method="POST" action="{{ url('infraestructura/vacaciones') }}">
                                @csrf
                                <div class="row g-3">
                                
                           

                              
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>Periodo</strong></label>
                                            <div class="col-6">
                                                <select name="periodo" id='periodo' class="form-control" required>
                                                    @for ($i = date('Y'); $i >= 2018; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="form-label col-md-3"
                                                align="right"><strong>Mes</strong></label>
                                            <div class="col-6">
                                                <select name="mes" id='mes' class="form-control" required>
                                                    @for ($m =1; $m < 13; $m++)
                                                        <option value="{{ $m }}">{{ $m }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3" align="right"></label>
                                                <div class="col-6" align="right">
                                                    <button type="button"
                                                        class="btn btn-primary float-right">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr align="center">
                                                <th align="center"> Nombre </th>
                                                <th align="center"> Cargo </th>
                                                <th align="center"> area </th>
                                                <th align="center"> Fecha inicio </th>
                                                <th align="center">Fecha final </th>                                           
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                            @foreach ($calendario as $obj)
                                                <tr>
                                                    
                                                            <td align="center">
                                                                @foreach ($user as $usuarios)
                                                                    @if ($obj->personal_id == $usuarios->id)
                                                                        {{ $usuarios->name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td align="center">
                                                                {{ $obj->cargo }}</td>
                                                            <td align="center">
                                                                {{ $obj->area }}</td>
                                                            <td align="center">
                                                                {{ $obj->fecha_inicio }}</td>
    
                                                            <td align="center">
                                                                {{ $obj->fecha_fin }}</td>
                                                           
                                                            
    
                                                             
                                                              
                                                       
                                                </tr>
                                              
                                            @endforeach
                                        </tbody>
                                    </table>
    
                                 
                                                                       
                                       
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div><!-- Row end  -->

        </div>
    </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
