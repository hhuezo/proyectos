<!-- Body: Header -->
<style>
    .flex-nowrap {
        flex-wrap: nowrap !important;
        display: none;
    }
</style>

<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl">

            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                <div class="d-flex">
                    <!--<a class="nav-link text-primary collapsed" href="#" title="Get Help">
                        <i class="icofont-info-square fs-5"></i>
                    </a>-->
                    @if (session('session_usuarios'))
                        <div class="avatar-list avatar-list-stacked px-3">
                            @foreach (session('session_usuarios') as $user_temp)
                                @if ($user_temp->image)
                                    <img class="avatar rounded-circle"
                                        src="{{ url('/') . '/images/users/' . $user_temp->image }}" alt="">
                                @endif
                            @endforeach
                            <!--<img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar2.jpg' }}" alt="">
                            <img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar1.jpg' }}" alt="">
                            <img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar3.jpg' }}" alt="">
                            <img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar4.jpg' }}" alt="">
                            <img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar7.jpg' }}" alt="">
                            <img class="avatar rounded-circle" src="{{ url('/') . '/images/xs/avatar8.jpg' }}" alt="">
                            <span class="avatar rounded-circle text-center pointer" data-bs-toggle="modal"
                                data-bs-target="#addUser"><i class="icofont-ui-add"></i></span>-->
                        </div>
                    @endif

                </div>
                <!-- <div class="dropdown notifications zindex-popover">
                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="icofont-alarm fs-5"></i>
                        <span class="pulse-ring"></span>
                    </a>
                  <div id="NotificationsDiv"
                        class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                        <div class="card border-0 w380">
                            <div class="card-header border-0 p-3">
                                <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                    <span>Notifications</span>
                                    <span class="badge text-white">11</span>
                                </h5>
                            </div>
                            <div class="tab-content card-body">
                                <div class="tab-pane fade show active">
                                    <ul class="list-unstyled list mb-0">
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ url('/') . '/images/xs/avatar1.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">{{ auth()->user()->user_name }}</span>
                                                        <small>2MIN</small>
                                                    </p>
                                                    <span class="">Added 2021-02-19 my-Task ui/ux Design <span
                                                            class="badge bg-success">Review</span></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <div class="avatar rounded-circle no-thumbnail">DF</div>
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Diane Fisher</span>
                                                        <small>13MIN</small>
                                                    </p>
                                                    <span class="">Task added Get Started with Fast Cad
                                                        project</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ url('/') . '/images/xs/avatar3.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Andrea Gill</span>
                                                        <small>1HR</small>
                                                    </p>
                                                    <span class="">Quality Assurance Task Completed</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ url('/') . '/images/xs/avatar5.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Diane Fisher</span>
                                                        <small>13MIN</small>
                                                    </p>
                                                    <span class="">Add New Project for App Developemnt</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ url('/') . '/images/xs/avatar6.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Andrea Gill</span>
                                                        <small>1HR</small>
                                                    </p>
                                                    <span class="">Add Timesheet For Rhinestone project</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle"
                                                    src="{{ url('/') . '/images/xs/avatar7.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span
                                                            class="font-weight-bold">Zoe Wright</span> <small
                                                            class="">1DAY</small></p>
                                                    <span class="">Add Calander Event</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                        </div>
                    </div>
                </div>-->
                <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                    <div class="u-info me-2">
                        <p class="mb-0 text-end line-height-sm "><span
                                class="font-weight-bold">{{ auth()->user()->user_name }}
                            </span></p>
                        <small>
                            @if (auth()->user()->rol_id)
                                {{ auth()->user()->rol->name }}
                            @endif

                        </small>
                    </div>
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"
                        data-bs-toggle="dropdown" data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail"
                            src="{{ url('/') . '/images/users/'.auth()->user()->image }}" alt="profile">
                    </a>
                    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    <img class="avatar rounded-circle"
                                        src="{{ url('/') .  '/images/users/'.auth()->user()->image }}" alt="profile">
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span
                                                class="font-weight-bold">{{ auth()->user()->user_name }}</span></p>
                                        <small class="">{{ auth()->user()->email }}</small>
                                    </div>
                                </div>

                                <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                            </div>
                            <div class="list-group m-2 ">
                                @if (auth()->user()->rol_id == 2 || auth()->user()->rol_id == 5)
                                    <a href="{{ url('actividades/') }}"
                                        class="list-group-item list-group-item-action border-0 "><i
                                            class="icofont-tasks fs-5 me-3"></i>Actividades</a>
                                @else
                                    <a href="{{ url('proyecto/') }}"
                                        class="list-group-item list-group-item-action border-0 "><i
                                            class="icofont-tasks fs-5 me-3"></i>Proyectos</a>
                                @endif


                                <a href="{{ url('usuario') }}/{{auth()->user()->id}}" class="list-group-item list-group-item-action border-0 "><i
                                    class="icofont-ui-user fs-6 me-3"></i>Mi perfil</a>

                                <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                                <a class="list-group-item list-group-item-action border-0 "
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                                    <i class="icofont-logout fs-6 me-3"></i>Cerrar sesión
                                </a>
                                <form action="{{ route('logout') }}" method="POST" style="display: none;"
                                    id="formLogout">
                                    @csrf
                                </form>



                                <!-- <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                                <a href="#" class="list-group-item list-group-item-action border-0 "><i
                                        class="icofont-contact-add fs-5 me-3"></i>Add personal account</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menu toggler -->
            <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainHeader">
                <span class="fa fa-bars"></span>
            </button>

            <!-- main menu Search-->
            <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                <div class="input-group flex-nowrap input-group-lg">
                    <button type="button" class="input-group-text" id="addon-wrapping"><i
                            class="fa fa-search"></i></button>
                    <input type="search" class="form-control" placeholder="Search" aria-label="search"
                        aria-describedby="addon-wrapping">
                    <button type="button" class="input-group-text add-member-top" id="addon-wrappingone"
                        data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i></button>
                </div>
            </div>

        </div>
    </nav>
</div>

