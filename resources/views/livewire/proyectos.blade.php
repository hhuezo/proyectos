<div style="text-align: center">
    <style>
        .dd-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>

    <div id="create_proyecto" wire:ignore.self tabindex="-1" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Nuevo proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model.defer="estado_id"
                            aria-label="Default select Project Category">
                            @foreach ($estados as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" wire:model.defer="nombre" name="nombre" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlTextarea786" class="form-label">Descripción</label>
                        <textarea class="form-control" wire:model.defer="descripcion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="store()">Create</button>
                </div>
            </div>
        </div>
    </div>



    <div id="edit_proyecto" wire:ignore.self tabindex="-1" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header col">
                    <h5 class="modal-title  fw-bold" id="createprojectlLabel">Modificar proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <input type="hidden" wire:model.defer="id_proyecto">
                        <label class="form-label">Estado</label>
                        <select class="form-select" wire:model.defer="estado_id"
                            aria-label="Default select Project Category">
                            @foreach ($estados as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" wire:model.defer="nombre" name="nombre" class="form-control">
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlTextarea786" class="form-label">Descripción</label>
                        <textarea class="form-control" wire:model.defer="descripcion" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" wire:click="update()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                                <h5 class="fw-bold mb-0">Proyectos</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
                            </div>


                        </div>
                    </div>

                </div>


                <div class="row taskboard g-3 py-xxl-4">
                    @foreach ($estados as $estado)
                        <div
                            class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4">
                            <h6 class="fw-bold py-3 mb-0">{{ $estado->nombre }}</h6>
                            <div class="{{$colors[$estado->id]}} col-lg-12 col-md-12">
                                <div class="dd" data-plugin="nestable">
                                    <ol class="dd-list">
                                        @foreach ($proyectos as $proyecto)
                                            @if ($proyecto->estado_id == $estado->id)
                                              
                                                    <div class="dd-handle">
                                                        <div
                                                            class="task-info d-flex align-items-center justify-content-between">
                                                            <h6
                                                                class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0" >
                                                                <i class="icofont-ui-edit fa-lg"
                                                                wire:click="edit({{ $proyecto->id }})"
                                                                class="btn btn-outline-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit_proyecto"
                                                                ></i> 

                                                            </h6>                                                            
                                                            <span >
                                                                <h6><strong>{{ $proyecto->id }}</strong></h6>
                                                             </span>
                                                        </div>
                                                       
                                                        <p class="py-2 mb-0"> <strong>{{$proyecto->nombre}}</strong></p>
                                                        <p class="py-2 mb-0">{{$proyecto->descripcion}}</p>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            
                                                            <div class="col-sm text-end">

                                                                <div class="d-flex align-items-center">
                                                                    @if ($proyecto->id != 9 && $proyecto->id != 11)
                                                                        @if ($proyecto->avance <50)
                                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                                            {{$proyecto->avance}}%</div>
                                                                        </div>
                                                                        @elseif($proyecto->avance <70)
                                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$proyecto->avance}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                                                {{$proyecto->avance}}%</div>
                                                                        </div>
                                                                        @else
                                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$proyecto->avance}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                                                {{$proyecto->avance}}%</div>
                                                                        </div>
                                                                        @endif
                                                                    @endif
                                                                   
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="col-sm text-end">
                                                                <div class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"  wire:click="actividad_show({{ $proyecto->id }})"> <strong><i class="icofont-eye fa-lg"></i> Actividades</strong></div>
                                                               
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                   

                                               
                                            @endif
                                        @endforeach


                                    </ol>
                                </div>
                            </div>
                        </div>
                    @endforeach




                </div>

            </div>
        </div>
    </div>



    <div class="contenedor"
        style="width: 90px;
        height: 240px;
        position: absolute;
        right: 0px;
        bottom: 0px;">

        <button class="botonF1" wire:click="create()" data-bs-toggle="modal" data-bs-target="#create_proyecto"
            style=" width: 60px;
    height: 60px;
    border-radius: 100%;
    background: #484c7f;
    right: 0;
    bottom: 0;
    position: absolute;
    margin-right: 16px;
    margin-bottom: 16px;
    border: none;
    outline: none;
    color: #FFF;
    font-size: 36px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: .3s;">
            <span>+</span>
        </button>

    </div>

</div>


<script type="text/javascript">
    window.addEventListener('close-modal', (e) => {
        $('#create_proyecto').modal('hide')
    });

    window.addEventListener('close-modal-edit', (e) => {
        $('#edit_proyecto').modal('hide')
    });
</script>
