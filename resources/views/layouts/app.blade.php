<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title', 'Sistema de Seguimiento de Proyectos')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />



    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    @yield('styles')







</head>

<body class="@yield('body-class')">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="{{ url('/') }}">COMPRAR</a> -->
            </div>

            <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-right">



                    <!-- <li>
    <a href="../components-documentation.html" target="_blank">
    Components
    </a>
    </li>
    <li>
      <a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
       <i class="material-icons">unarchive</i> Upgrade to PRO
      </a>
    </li> -->


                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registro</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>



                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul class="dropdown-menu" role="menu">
                                    @if (auth()->user()->rol_id == 3)
                                        <li class="nav-item">
                                            <a href="{{ url('/usuario/actividades') }}">Mis Actividades</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/usuario/' . Auth::user()->id . '/edit') }}">Mis Datos</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>
                                    @endif
                                    @if (auth()->user()->rol_id == 2)
                                        <li class="nav-item">
                                            <a href="{{ url('/actividades') }}">Mis Actividades</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/usuario/' . Auth::user()->id . '/edit') }}">Mis Datos</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>
                                    @endif
                                    @if (auth()->user()->rol_id == 1)
                                        <li class="nav-item">
                                            <a href="{{ url('/home') }}">Inicio</a>
                                        </li>
                                        <li class="nav-item">
                                            <hr>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ url('/admin/estados') }}">Estados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/admin/proyectos') }}">Proyectos</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ url('/admin/categorias') }}">Categorias Ticket</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/admin/prioridades') }}">Prioridades Ticket</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/admin/actividades') }}">Actividades</a>
                                        </li>
                                        <li>
                                            <hr>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ url('/admin/roles') }}">Roles</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
							                             document.getElementById('logout-form').submit();">
                                            Cerrar sesion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>



                            </div>
                        </li>
                    @endguest

                    <!-- <li>
  <a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
       <i class="fa fa-twitter"></i>
      </a>
  </li>
  <li>
  <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
       <i class="fa fa-facebook-square"></i>
      </a>
  </li>
     <li>
  <a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-simple btn-white btn-just-icon">
       <i class="fa fa-instagram"></i>
      </a>
  </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        @yield('content')
    </div>


</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/jquery.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }} "></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/nouislider.min.js') }} " type="text/javascript"></script>

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="{{ asset('js/bootstrap-datepicker.js') }} " type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="{{ asset('js/material-kit.js') }} " type="text/javascript"></script>

@include('sweetalert::alert')
@yield('scripts')

</html>
