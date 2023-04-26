@extends('layouts.form')

@section('title','Registro')
@section('subtitle','Ingresa tus datos para registrarte')

@section('content')
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Registro</small></div>

            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Creacion de usuarios</small>
              </div>

              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif

              <form class="form" method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-addon">
                        <i class="ni ni-app"></i>
                    </span>

       

                      <select class="form-control selectpicker" name="rol_id" id="rol_id" data-live-search="true">

                      <option value="0" >Seleccione Rol</option>

                      @foreach($roles as $rol)
                        @if ($rol->id == '2')
                          <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                        @endif
                      @endforeach

                      </select>
                  </div>
                </div>

                <br>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-addon">
                        <i class="ni ni-app"></i>
                    </span>

       

                      <select class="form-control selectpicker" name="unidad_id" id="unidad_id" data-live-search="true">

                      <option value="0" >Seleccione Unidad</option>

                      @foreach($unidades as $unidad)
                        
                          <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                        
                      @endforeach

                      </select>
                  </div>
                </div>

                <br>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                  <span class="input-group-addon">
                  <i class="ni ni-circle-08"></i>
                    </span>

                    <input type="text" class="form-control" placeholder="Nombre de Usuario" name="name"
                value="{{ old('name',$name) }}" required autofocus />

                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                  <span class="input-group-addon">
                  <i class="ni ni-circle-08"></i>
                    </span>

                    <input type="text" class="form-control" placeholder="Usuario" name="user_name"
                      value="{{ old('user_name') }}" required autofocus />

                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                  <span class="input-group-addon">
                  <i class="ni ni-email-83"></i>
                    </span>

                    <input  type="email" class="form-control" placeholder="Correo electronico" name="email"
                value="{{ old('email',$email) }}"  autofocus required />

                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                  <span class="input-group-addon">
                  <i class="ni ni-key-25"></i>
                    </span>

                    <input placeholder="Clave"  type="password"  class="form-control" name="password" required />

                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                  <span class="input-group-addon">
                  <i class="ni ni-key-25"></i>
                    </span>

                    <input placeholder="Confirmar clave" type="password"  class="form-control"
                  name="password_confirmation" required />

                  </div>
                </div>

                <div class="text-center">
                <button type="submit" class="btn btn-simple btn-primary btn-lg">Confirmar registro</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
@endsection
