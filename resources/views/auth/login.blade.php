@extends('layouts.form')

@section('title','Inicio de sesion')
@section('subtitle','Ingresa tus datos para iniciar sesion')


@section('content')
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
              <form class="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                <input id="user_name" type="text" class="form-control" placeholder="Usuario..." name="user_name"
                value="{{ old('user_name') }}" required autofocus>

                @if ($errors->has('user_name'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_name') }}</strong>
                      </span>
                @endif

                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input placeholder="Clave..." id="password" type="password"  class="form-control" name="password" required />

                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                
                <div class="form-check" >
                  <input class="form-check-input" type="checkbox" name="remember"  id="remember" 
                  {{ old('remember') ? 'checked' : '' }} >
                  <label class="form-check-label" for="remember">
                    <span class="text-muted">Recordar sesion</span>
                  </label>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-light"><small>Olvidaste tu clave?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="text-light"><small>Aun no te has registrado?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
