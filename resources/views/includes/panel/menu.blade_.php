<!-- Navigation -->
<ul class="navbar-nav">

    <!-- rol_id==1 admin
rol_id==2 analista  -->

    @if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 4)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">
                <i class="ni ni-chart-bar-32 text-primary"></i> DASHBOARD
            </a>
        </li>

        @if (auth()->user()->unidadId() == 1 && auth()->user()->rol_id == 1)
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ni ni-books text-orange"></i>CATALOGOS
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ url('/admin/estados') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Estados</span>
                    </a>
                    <a href="{{ url('/admin/categorias') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Categorias</span>
                    </a>
                    <a href="{{ url('/admin/prioridades') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Prioridades</span>
                    </a>
                    <a href="{{ url('/admin/roles') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Roles</span>
                    </a>
                </div>

            </li>
        @endif

        @if (auth()->user()->unidadId() > 1 &&
                (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 4))
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ni ni-books text-orange"></i>CATALOGOS
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                    <a href="{{ url('/admin/categorias') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Categorias</span>
                    </a>

                </div>

            </li>
        @endif


        @if (auth()->user()->unidadId() > 1 && auth()->user()->rol_id == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/usuarios') }}">
                    <i class="fa fa-users"></i> USUARIOS
                </a>
            </li>
        @endif


        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/coordinador') }}">
                <i class="fa fa-users"></i> COORDINADOR
            </a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="ni ni-trophy text-green"></i>PROYECTOS
            </a>

            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <a href="{{ url('/admin/proyectos') }}" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Proyectos</span>
                </a>
                <a href="{{ url('/finalizado/proyectos') }}" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Finalizados</span>
                </a>


            </div>

        </li>



        <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="ni ni-user-run text-blue"></i>ACTIVIDADES
            </a>

            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                <a href="{{ url('/actual/actividades/' . auth()->user()->id . '/edit') }}" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Mis Actividades</span>
                </a>
                <a href="{{ url('/actual/actividades') }}" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>En Proceso</span>
                </a>

                @if (auth()->user()->unidadId() == 1 && auth()->user()->rol_id == 1)
                    <a href="{{ url('/facturar/actividades') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Facturar</span>
                    </a>
                @endif

            </div>

        </li>

        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/proyectos') }}">
            <i class="ni ni-trophy text-blue"></i> Proyectos
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/finalizado/proyectos') }}">
            <i class="ni ni-trophy text-green"></i> Proyectos Finalizados
        </a>
        </li> -->
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/actual/actividades') }}">
            <i class="ni ni-user-run text-green"></i> Actividades en Proceso
        </a>
        </li> -->
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/categorias') }}">
            <i class="ni ni-bullet-list-67 text-yellow"></i> Categorias ticket
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/prioridades') }}">
            <i class="ni ni-ambulance text-red text-red"></i> Prioridades ticket
        </a>
        </li> -->
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/actividades') }}">
            <i class="ni ni-user-run text-blue"></i> Actividades
        </a>
        </li> -->
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/roles') }}">
            <i class="ni ni-badge text-orange"></i> Roles
        </a>
        </li> -->

        <!-- <li class="nav-item">
        <a class="nav-link" href="proyecto">
            <i class="ni ni-badge text-orange"></i> Comentarios
        </a>
        </li> -->

        <!-- <li class="nav-item">
            <a class="nav-link nav-link-icon" href="{{ route('register') }}">
            <i class="ni ni-circle-08"></i>
            <span class="nav-link-inner--text">Registro</span>
            </a>
        </li> -->

        {{-- @if (auth()->user()->unidadId() == 1 &&
    auth()->user()->rol_id == 1) --}}
        @if (auth()->user()->unidadId() == 1)
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ni ni-books text-orange"></i> ISO
                </a>


                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Documentacion</h6>
                    </div>



                    <a href="{{ URL::action('Admin\IsoMatrizController@index') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Documentos</span>
                    </a>

                    <a href="{{ url('/admin/bitacora_rendimiento_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-139 BITACORA <br>REPORTES SOBRE <br>RENDIMIENTO DE <br>BASE DE DATOS</span>
                    </a>

                    <a href="{{ url('/admin/bitacora_cambio_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-129 BITACORA <br>DE CAMBIOS EN BDs </span>
                    </a>

                    <a href="{{ url('/admin/creacion_objetos_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-131 CREACION <br>DE OBJETOS DE <br></span> BASE DE DATOS
                    </a>

                    <a href="{{ url('/admin/certificacion_objetos_sistema') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-126 CERTIFICACION <br>DE OBJETOS DE <br></span> DEL SISTEMA
                    </a>

                    <a href="{{ url('/categoria/finalizadas') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>CONSULTA DE <br>CATEGORIAS DE <br></span> TICKETS
                    </a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/usuarios') }}">
                    <i class="fa fa-users"></i> USUARIOS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/unidades') }}">
                    <i class="fa fa-users"></i> UNIDADES
                </a>
            </li>


            </li>
        @endif




    @endif


    @if (auth()->user()->rol_id == 2)
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/proyectos') }}">
            <i class="ni ni-pin-3 text-orange"></i> Proyectos
        </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/analista/actividades') }}">
                <i class="ni ni-bullet-list-67 text-red"></i> ACTIVIDADES
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/analista/actividades/1/edit') }}">
                <i class="ni ni-bullet-list-67 text-red"></i> ACTIVIDADES FINALIZADAS
            </a>
        </li>


        @if (auth()->user()->admin == '1')
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ni ni-books text-orange"></i> ISO
                </a>

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Fomularios ISO</h6>
                    </div>

                    <a href="{{ url('/admin/bitacora_rendimiento_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-139 BITACORA <br>REPORTES SOBRE <br>RENDIMIENTO DE <br>BASE DE DATOS</span>
                    </a>

                    <a href="{{ url('/admin/bitacora_cambio_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-129 BITACORA <br>DE CAMBIOS EN BDs </span>
                    </a>

                    <a href="{{ url('/admin/creacion_objetos_base_datos') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-131 CREACION <br>DE OBJETOS DE <br></span> BASE DE DATOS
                    </a>

                    <a href="{{ url('/admin/certificacion_objetos_sistema') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>SFA-126 CERTIFICACION <br>DE OBJETOS DE <br></span> DEL SISTEMA
                    </a>
                </div>
            </li>
        @endif
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/proyecto') }}">
            <i class="ni ni-badge text-orange"></i> Comentarios
        </a>
        </li> -->
    @endif


    @if (auth()->user()->rol_id == 5)
        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/proyectos') }}">
            <i class="ni ni-pin-3 text-orange"></i> Proyectos
        </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/mayra/actividades') }}">
                <i class="ni ni-bullet-list-67 text-red"></i> ACTIVIDADES
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/mayra/actividades/1/edit') }}">
                <i class="ni ni-bullet-list-67 text-red"></i> ACTIVIDADES FINALIZADAS
            </a>
        </li>

        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/proyecto') }}">
            <i class="ni ni-badge text-orange"></i> Comentarios
        </a>
        </li> -->
    @endif

    @if (auth()->user()->rol_id == 6)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">
                <i class="ni ni-tv-2 text-primary"></i> DASHBOARD
            </a>
        </li>
    @endif


    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="ni ni-key-25 text-red"></i> CERRAR SESION
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
            @csrf
        </form>
    </li>

</ul>
