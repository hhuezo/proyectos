@extends('layouts.app')

@section('body-class','signup-page')

@section('content')

<head>
  <script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>



  <script type="text/javascript">

  $(document).ready(function($){

    $("#nrc").mask("999999-9");
    $("#nit").mask("9999-999999-999-9");




    function cargarMunicipios() {
      //alert('hola');
      var id_depa = $('#id_depa').val();
      //alert(id_depa);
       if ($.trim(id_depa) != '0') {

         $.get('/api/departamento/'+id_depa+'/municipios', function(data){
           //alert(id_depa);
           var html_select = '<option value="">Seleccione municipio</option>';
           for (var i = 0; i < data.length; ++i)
             html_select += '<option value="'+ data[i].id +'">'+data[i].nombre+'</option>';
           $('#id_muni').html(html_select);
         });

       }
    }
    cargarMunicipios();
    $('#id_depa').on('change', cargarMunicipios);
  });

  </script>
</head>


<div class="header header-filter" style="background-image: url('{{ asset('img/fondo.jpg') }}');
  background-size: cover; background-position: top center;">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="card card-signup">


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

            <div class="header header-primary text-center">
              <h4>Registro</h4>
              <!-- <div class="social-line">
                <a href="#pablo" class="btn btn-simple btn-just-icon">
                  <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-simple btn-just-icon">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-simple btn-just-icon">
                  <i class="fa fa-google-plus"></i>
                </a>
              </div> -->
            </div>
            <div class="content">

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">face</i>
                </span>

                <input type="text" class="form-control" placeholder="Nombre" name="name"
                value="{{ old('name', $name) }}" required autofocus />

              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">fingerprint</i>
                </span>

                <input type="text" class="form-control" placeholder="Usuario" name="user_name"
                value="{{ old('user_name') }}" required autofocus />

              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">email</i>
                </span>

                <input  type="email" class="form-control" placeholder="Correo electronico" name="email"
                value="{{ old('email',$email) }}"  autofocus />

              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">phone</i>
                </span>

                <input  type="phone" class="form-control" placeholder="Telefono" name="phone"
                value="{{ old('phone') }}" required autofocus />

              </div>

              <!-- <div class="checkbox">
              	<label>
              		<input type="checkbox" name="ticket" id="ticket" onclick="
                  if(document.getElementById('ticket').checked==true){
                    document.getElementById('ticket_val').value=1;
                  }else{
                    document.getElementById('ticket_val').value=0;
                  }
                  ">
                  <input type="hidden" name="ticket_val" id="ticket_val" value="0" />
              		Desea usar tickets
              	</label>
              </div> -->

              <input type="hidden" name="ticket_val" id="ticket_val" value="0" />

            <div class="form-group row">
                <label for="id_muni" class="col-md-12 col-form-label text-md-right">Departamento</label>

                <select class="form-control" name="id_depa" id="id_depa">
                  <option value="0">Seleccione</option>
                  @foreach ($departamentos as $depa)
                    <option value="{{$depa->id}}">{{$depa->nombre}}</option>
                  @endforeach
                </select>

              </div>

              <div class="form-group row">

                  <label for="id_muni" class="col-md-12 col-form-label text-md-right">Municipio</label>

                      <select class="form-control" id="id_muni" name="id_muni" >
                        <option value="0">Seleccione</option>
                      </select>

              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">class</i>
                </span>

                <input  type="text" class="form-control" placeholder="Direccion" name="address"
                value="{{ old('address') }}" required autofocus />

              </div>


<!-- implementando modal CCF -->
              <div class="text-center">


                <button type="button" class="btn btn-primary btn-round" data-toggle="collapse"
                data-target="#ccf">Hacer click , Si eres Contribuyente!!</button>
                <div id="ccf" class="collapse">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons"></i>
                    </span>
                    <input  type="text" class="form-control" placeholder="Numero de registro de contribuyente"
                            name="nrc" id="nrc" />
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons"></i>
                    </span>
                    <input  type="text" class="form-control" placeholder="Actividad economica" name="giro" />
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons"></i>
                    </span>
                    <input  type="text" class="form-control" placeholder="NIT" name="nit" id="nit" />
                  </div>



                </div>

              </div>





              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">lock_outline</i>
                </span>
                <input placeholder="Contrasena"  type="password"  class="form-control" name="password" required />
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="material-icons">lock_outline</i>
                </span>
                <input placeholder="Confirmar contrasena" type="password"  class="form-control"
                  name="password_confirmation" required />
              </div>

            </div>
            <div class="footer text-center">
              <button type="submit" class="btn btn-simple btn-primary btn-lg">Confirmar registro</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@include('includes.footer')

</div>


<!-- Fin Modal Anular Pedido -->
@endsection
