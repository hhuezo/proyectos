@if (Request::segment(2) != 'ui-components')


    <div class="sidebar px-4 py-4 py-md-5 me-0">
        <div class="d-flex flex-column h-100">
            <a href="#" class="mb-0 brand-icon">
                <span class="logo-icon">
                    <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                </span>
                <span class="logo-text">Proyectos</span>
            </a>
            <!-- Menu: main ul -->

            <ul class="menu-list flex-grow-1 mt-3">
                @can('read menu inicio')
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'hr-dashboard' || Request::segment(2) == 'project-dashboard' ? 'active' : '' }}"
                            href="{{ url('home') }}">
                            <i class="icofont-home fs-5"></i> <span>Inicio </span> </a>
                        <!-- Menu: Sub menu ul -->

                    </li>
                @endcan




                @can('read menu unidades')
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'hr-dashboard' || Request::segment(2) == 'project-dashboard' ? 'active' : '' }}"
                            href="{{ url('load_unidades') }}">
                            <i class="icofont-ui-office fs-5"></i> <span>Unidades</span> </a>
                        <!-- Menu: Sub menu ul -->

                    </li>
                @endcan

                @can('read menu seguridad')
                <li class="collapsed">
                    <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}" data-bs-toggle="collapse"
                        data-bs-target="#project-Components2" href="#">
                        <i class="icofont-user"></i><span>Seguridad</span> <span
                            class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu {{ Request::segment(2) == 'project' ? 'collapsed show' : 'collapse' }}"
                        id="project-Components2">
                        <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                href="{{ url('usuario') }}"><span>Usuario</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'tasks' ? 'active' : '' }}"
                                href="{{ url('produccion/rol') }}"><span>Roles </span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'tasks' ? 'active' : '' }}"
                                href="{{ url('produccion/permisos') }}"><span>Permisos </span></a></li>

                    </ul>
                </li>
                @endcan


                @can('read menu catalogos')
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}" data-bs-toggle="collapse"
                            data-bs-target="#project-Components3" href="#">
                            <i class="icofont-ui-folder"></i><span>Catalogo</span> <span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ Request::segment(2) == 'project' ? 'collapsed show' : 'collapse' }}"
                            id="project-Components3">
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('unidad') }}"><span>Unidades</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('estado') }}"><span>Estados</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('categoria') }}"><span>Categorias</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('prioridad') }}"><span>Prioridades</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('catalogo/propietario') }}"><span>Propietario</span></a></li>

                        </ul>
                    </li>
                @endcan




                @if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 4 || auth()->user()->rol_id == 7)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#project-Components" href="#">
                            <i class="icofont-briefcase"></i><span>Proyectos</span> <span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ Request::segment(2) == 'project' ? 'collapsed show' : 'collapse' }}"
                            id="project-Components">
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('proyecto') }}"><span>Proyectos</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'tasks' ? 'active' : '' }}"
                                    href="{{ url('proyecto_finalizado') }}"><span>Finalizados </span></a></li>

                        </ul>
                    </li>
                @endif


                @if (auth()->user()->rol_id == 6 && session('id_unidad'))
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#project-Components" href="#">
                            <i class="icofont-briefcase"></i><span>Proyectos</span> <span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ Request::segment(2) == 'project' ? 'collapsed show' : 'collapse' }}"
                            id="project-Components">
                            <li><a class="ms-link {{ Request::segment(3) == 'index' ? 'active' : '' }}"
                                    href="{{ url('proyecto') }}"><span>Proyectos</span></a></li>
                            <li><a class="ms-link {{ Request::segment(3) == 'tasks' ? 'active' : '' }}"
                                    href="{{ url('proyecto_finalizado') }}"><span>Finalizados </span></a></li>

                        </ul>
                    </li>
                @endif



                @if (auth()->user()->rol_id != 6 && auth()->user()->rol_id != 7)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('actividades') }}">
                            <i class="icofont-list"></i><span>Actividades</span></a>
                    </li>

                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('actividades_finalizadas') }}">
                            <i class="icofont-check-circled"></i><span>Actividades finalizadas</span></a>
                    </li>
                @endif

                @if ((auth()->user()->rol_id == 1 && auth()->user()->unidad_id == 1) || auth()->user()->rol_id == 4)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('actividades/1') }}">
                            <i class="icofont-check-circled"></i><span>Actividades en proceso</span></a>
                    </li>
                @endif


                @if (auth()->user()->rol_id == 1 && auth()->user()->unidad_id == 1)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('facturar') }}">
                            <i class="icofont-notepad"></i><span>Facturar</span></a>
                    </li>
                @endif

                @if (auth()->user()->rol_id == 2)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('iso/matriz_riesgo2022') }}">
                            <i class="icofont-notepad"></i><span>Iso 2022</span></a>
                    </li>

                    @if (auth()->user()->usuario_base_datos)
                        <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                href="{{ url('bitacora_rendimiento_base') }}">ESA-ID-P13-F2 BITACORA REPORTES
                                SOBRE
                                RENDIMIENTO DE BASE DE DATOS</a></li>
                        <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                href="{{ url('bitacora_cambio_base') }}">ESA-ID-P13-F1 BITACORA DE CAMBIOS EN BDs
                            </a>
                        </li>
                        <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                href="{{ url('creacion_objetos_base_datos') }}">ESA-ID-P1-F3 CREACION DE OBJETOS
                                DE BASE DE DATOS</a>
                        </li>
                    @endif
                @endif




                @if (auth()->user()->rol_id == 1 || auth()->user()->rol_id == 4)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('actividades_coordinador') }}">
                            <i class="icofont-paperclip"></i><span>Coordinador</span></a>
                    </li>
                @endif


                @if (auth()->user()->rol_id == 1 && auth()->user()->unidad_id == 1)
                    <li
                        class=" {{ Request::is('admin/auth/user') || Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? '' : ' collapsed' }}">
                        <a class="m-link {{ Request::is('admin/auth/user') || Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? 'collapse show active' : '' }}{{ Request::is('admin/auth/role') ? 'collapse show active' : '' }}"
                            data-bs-toggle="collapse" data-bs-target="#access" href="#"><i
                                class="fa fa-lock"></i>
                            <span>ISO</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>

                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse {{ Request::is('admin/auth/user') || Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? 'show' : '' }}"
                            id="access">

                            <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                    href="{{ url('iso/matriz_riesgo') }}">Documentos</a></li>
                            {{-- <li><a class="ms-link {{ Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? 'active' : '' }}"
                                    href="{{ url('iso/matriz_riesgo2022') }}">Documentos 2022</a></li> --}}

                            <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                    href="{{ url('bitacora_rendimiento_base') }}">ESA-ID-P13-F2 BITACORA REPORTES
                                    SOBRE
                                    RENDIMIENTO DE BASE DE DATOS</a></li>
                            <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                    href="{{ url('bitacora_cambio_base') }}">ESA-ID-P13-F1 BITACORA DE CAMBIOS EN BDs
                                </a>
                            </li>
                            <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}"
                                    href="{{ url('creacion_objetos_base_datos') }}">ESA-ID-P1-F3 CREACION DE OBJETOS
                                    DE BASE DE DATOS</a></li>
                        </ul>
                    </li>
                @endif


                @if (auth()->user()->rol_id == 1 && auth()->user()->unidad_id == 1)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('calendarizacion') }}">
                            <i class="icofont-notepad"></i><span>Calendarización de mantenimientos</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('inventario_despliegues') }}">
                            <i class="icofont-notepad"></i><span>Inventario despliegues</span></a>
                    </li>
                @endif

                @if (auth()->user()->rol_id == 4 && auth()->user()->unidad_id == 1)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('calendarizacion') }}">
                            <i class="icofont-notepad"></i><span>Calendarización de mantenimientos</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('inventario_despliegues') }}">
                            <i class="icofont-notepad"></i><span>Inventario despliegues</span></a>
                    </li>
                @endif

                @if (auth()->user()->rol_id == 4 && auth()->user()->unidad_id == 6)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('calendarizacion') }}">
                            <i class="icofont-notepad"></i><span>Calendarización de mantenimientos</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('inventario_despliegues') }}">
                            <i class="icofont-notepad"></i><span>Inventario despliegues</span></a>
                    </li>
                @endif
                @if ((auth()->user()->rol_id == 1 && auth()->user()->unidad_id == 1) || auth()->user()->unidad_id == 6)
                    <li class="collapsed">
                        <a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"
                            href="{{ url('dashboard') }}">
                            <i class="fa fa-line-chart"></i><span>Indicadores</span></a>
                    </li>
                @endif
                <?php
                /*
            <li class=" {{ Request::is('admin/auth/user') || Request::is('admin/auth/role')  || Request::is('admin/auth/role/create') ? '' : ' collapsed' }}">
                <a class="m-link {{ Request::is('admin/auth/user') || Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? 'collapse show active' : '' }}{{ Request::is('admin/auth/role') ? 'collapse show active' : '' }}" data-bs-toggle="collapse" data-bs-target="#access" href="#"><i class="fa fa-lock"></i> <span>Access</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>

                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse {{ Request::is('admin/auth/user') || Request::is('admin/auth/role')  || Request::is('admin/auth/role/create') ? 'show' : '' }}" id="access">

                    <li><a class="ms-link {{ Request::is('admin/auth/user') ? 'active' : '' }}" href="#">User Management</a></li>
                    <li><a class="ms-link {{ Request::is('admin/auth/role') || Request::is('admin/auth/role/create') ? 'active' : '' }}" href="#">Role Management</a></li>
                </ul>
            </li>
            <li  class="collapsed">
                <a class="m-link {{ Request::segment(2)=='project' ? 'active' : '' }}"  data-bs-toggle="collapse" data-bs-target="#project-Components" href="#">
                    <i class="icofont-briefcase"></i><span>Projects</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='project' ? 'collapsed show' : 'collapse' }}" id="project-Components">
                    <li><a class="ms-link {{ Request::segment(3)=='index' ? 'active' : '' }}" href="{{ url('/admin/proyectos') }}"><span>Projects</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3)=='tasks' ? 'active' : '' }}" href="#"><span>Tasks</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3)=='timesheet' ? 'active' : '' }}" href="#"><span>Timesheet</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3)=='leaders' ? 'active' : '' }}" href="#"><span>Leaders</span></a></li>
                </ul>
            </li>

            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='ticket' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#"><i
                        class="icofont-ticket"></i> <span>Tickets</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='ticket' ? 'collapsed show' : 'collapse' }}" id="tikit-Components">
                    <li><a class="ms-link {{  Request::segment(3) == 'ticket-view' ? 'active' : '' }}" href="#"> <span>Tickets View</span></a></li>
                    <li><a class="ms-link {{  Request::segment(3) == 'ticket-detail' ? 'active' : '' }}" href="#"> <span>Ticket Detail</span></a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='out-client' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#client-Components" href="#"><i
                        class="icofont-user-male"></i> <span>Our Clients</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='out-client' ? 'collapsed show' : 'collapse' }}" id="client-Components">
                    <li><a class="ms-link {{ Request::segment(3) == 'clients' ? 'active' : '' }}" href="#"> <span>Clients</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'clients-profile' ? 'active' : '' }}" href="#"> <span>Client Profile</span></a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='our-employee' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#emp-Components" href="#"><i
                        class="icofont-users-alt-5"></i> <span>Employees</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu  {{ Request::segment(2)=='our-employee' ? 'collapsed show' : 'collapse' }}" id="emp-Components">
                    <li><a class="ms-link {{ Request::segment(3) == 'members' ? 'active' : '' }}" href="@"> <span>Members</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'members-profile' ? 'active' : '' }}" href="#"> <span>Members Profile</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'holidays' ? 'active' : '' }}" href="#"> <span>Holidays</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'attendance-employee' ? 'active' : '' }}" href="#"> <span>Attendance Employees </span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'attendance' ? 'active' : '' }}" href="#"> <span>Attendance</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'leave-request' ? 'active' : '' }}" href="#"> <span>Leave Request</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'department' ? 'active' : '' }}" href="#"> <span>Department</span></a></li>
                </ul>
            </li>

            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='accounts' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#menu-Componentsone" href="#"><i
                        class="icofont-ui-calculator"></i> <span>Accounts</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='accounts' ? 'collapsed show' : 'collapse' }}" id="menu-Componentsone">
                    <li><a class="ms-link {{ Request::segment(3) == 'invocies' ? 'active' : '' }}" href="#"><span>Invoices</span> </a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'payments' ? 'active' : '' }}" href="#"><span>Payments</span> </a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'expenses' ? 'active' : '' }}" href="#"><span>Expenses</span> </a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='payroll' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#payroll-Components" href="#"><i
                        class="icofont-users-alt-5"></i> <span>Payroll</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='payroll' ? 'collapsed show' : 'collapse' }}" id="payroll-Components">
                    <li><a class="ms-link {{ Request::segment(3) == 'employee-salary' ? 'active' : '' }}" href="#"><span>Employee Salary</span> </a></li>

                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='app' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#app-Components" href="#">
                    <i class="icofont-contrast"></i> <span>App</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='app' ? 'collapsed show' : 'collapse' }}" id="app-Components">
                    <li><a class="ms-link {{ Request::segment(3) == 'calender' ? 'active' : '' }}" href="#"> <span>Calander</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'messages' ? 'active' : '' }}" href="#"><span>Massages</span></a></li>
                </ul>
            </li>

            <li class="collapsed">
                <a class="m-link {{ Request::segment(2)=='other-pages' ? 'active' : '' }} " data-bs-toggle="collapse" data-bs-target="#other-pages" href="#">
                    <i class="icofont-code-alt"></i> <span>Other Pages</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ Request::segment(2)=='other-pages' ? 'collapsed show' : 'collapse' }}" id="other-pages">
                    <li><a class="ms-link {{ Request::segment(3) == 'apex-charts' ? 'active' : '' }}" href="#"> <span>Apex Charts</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'form-example' ? 'active' : '' }}" href="#"><span>Form Example</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'table-example' ? 'active' : '' }}" href="#"> <span>Table Example</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'review-page' ? 'active' : '' }}" href="#"><span>Review Page</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'icons' ? 'active' : '' }}" href="#"><span>Icons</span></a></li>
                    <li><a class="ms-link {{ Request::segment(3) == 'contact' ? 'active' : '' }}" href="#"><span>Contact</span></a></li>
                </ul>
            </li>
            <li><a class="m-link {{ Request::segment(3) == 'alerts' ? 'active' : '' }}" href="#"><i class="icofont-paint"></i> <span>UI Components</span></a></li>
       */
                ?>
            </ul>

            <!-- Theme: Switch Theme -->



            <!--<ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center justify-content-center">
                    <div class="form-check form-switch theme-switch">
                        <input class="form-check-input" type="checkbox" id="theme-switch">
                        <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                    </div>
                </li>
                <li class="d-flex align-items-center justify-content-center">
                    <div class="form-check form-switch theme-rtl">
                        <input class="form-check-input" type="checkbox" id="theme-rtl">
                        <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                    </div>
                </li>
            </ul>

           <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                <span class="ms-2"><i class="icofont-bubble-right"></i></span>
            </button>
        -->

            <!-- Menu: menu collepce btn -->


        </div>
    </div>

@endif
@if (Request::segment(2) == 'ui-components')
    <div class="sidebar px-4 py-2 py-md-4 me-0">
        <div class="d-flex flex-column h-100">
            <a href="{{ route('admin.dashboard') }}" class="mb-0 brand-icon">
                <span class="logo-icon">
                    <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                </span>
                <span class="logo-text">my-Task</span>
            </a>
            <!-- Menu: main ul -->
            <ul class="menu-list flex-grow-1 mt-3">
                <li><a class="m-link " href="{{ route('admin.dashboard') }}"><i
                            class="icofont-ui-home"></i><span>Home</span></a></li>
                <li class="collapsed">
                    <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Authentication"
                        href="#"><i class="icofont-ui-lock"></i> <span>Authentication</span> <span
                            class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="{{ route('admin.authentication.signin') }}"><span>Sign
                                    in</span></a></li>
                        <li><a class="ms-link" href="{{ route('admin.authentication.signup') }}"><span>Sign
                                    up</span></a></li>
                        <li><a class="ms-link"
                                href="{{ route('admin.authentication.password-reset') }}"><span>Password
                                    reset</span></a></li>
                        <li><a class="ms-link"
                                href="{{ route('admin.authentication.two-step-authentication') }}"><span>2-Step
                                    Authentication</span></a></li>
                        <li><a class="ms-link"
                                href="{{ route('admin.authentication.bad-request') }}"><span>404</span></a></li>
                    </ul>
                </li>
                <li><a class="m-link {{ Request::segment(3) == 'stater-page' ? 'active' : '' }}"
                        href="{{ route('admin.ui-components.index') }}"><i class="icofont-code"></i> <span>Stater
                            page</span></a></li>
                <li
                    class="{{ Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page' ? '' : ' collapsed' }}">
                    <a class="m-link {{ Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page' ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#menu-Components" href="#"><i
                            class="icofont-paint"></i> <span>UI Components</span> <span
                            class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu {{ Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page' ? 'collapsed show' : 'collapse' }}"
                        id="menu-Components">
                        <li><a class="ms-link {{ Request::segment(3) == 'alerts' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.alerts') }}"><span>Alerts</span> </a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'badge' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.badge') }}"><span>Badge</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'breadcrumb' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.breadcrumb') }}"><span>Breadcrumb</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'buttons' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.buttons') }}"><span>Buttons</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'card' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.card') }}"><span>Card</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'carousel' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.carousel') }}"><span>Carousel</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'collapse' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.collapse') }}"><span>Collapse</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'dropdowns' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.dropdowns') }}"><span>Dropdowns</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'list' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.list') }}"><span>List</span> group</a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'modal' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.modal') }}"><span>Modal</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'navs' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.navs') }}"><span>Navs</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'navbar' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.navbar') }}"><span>Navbar</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'pagination' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.pagination') }}"><span>Pagination</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'popovers' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.popovers') }}"><span>Popovers</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'progress' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.progress') }}"><span>Progress</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'scrollspy' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.scrollspy') }}"><span>Scrollspy</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'spinners' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.spinners') }}"><span>Spinners</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'toasts' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.toasts') }}"><span>Toasts</span></a></li>
                        <li><a class="ms-link {{ Request::segment(3) == 'tooltips' ? 'active' : '' }}"
                                href="{{ route('admin.ui-components.tooltips') }}"><span>Tooltips</span></a></li>
                    </ul>
                </li>
                <li><a class="m-link" href="{{ route('admin.document') }}"><i class="icofont-law-document"></i>
                        <span>Documentation</span></a></li>
                <li><a class="m-link" href="{{ route('admin.changelog') }}"><i class="icofont-edit"></i>
                        <span>Changelog</span> <span class="badge rounded-pill ms-auto">v1.0.0</span></a></li>
            </ul>

            <!-- Theme: Switch Theme -->
            <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center justify-content-center">
                    <div class="form-check form-switch theme-switch">
                        <input class="form-check-input" type="checkbox" id="theme-switch">
                        <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                    </div>
                </li>
                <li class="d-flex align-items-center justify-content-center">
                    <div class="form-check form-switch theme-rtl">
                        <input class="form-check-input" type="checkbox" id="theme-rtl">
                        <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                    </div>
                </li>
            </ul>
            <!-- Menu: menu collepce btn -->
            <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                <span class="ms-2"><i class="icofont-bubble-right"></i></span>
            </button>
        </div>
    </div>
@endif
