<div style="text-align: center">
    <style>
        .dd-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }
    </style>




    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left;">
                                <h5 class="fw-bold mb-0">PROYECTOS FINALIZADOS
                                    @if (auth()->user()->rol_id == 6)
                                    DE {{ $unidad->nombre }}<br>
                                 @endif</h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="text" class="form-control" placeholder="Buscar" wire:model="busqueda">
                            </div>


                        </div>
                    </div>

                </div>

                <div class="row col-lg-12 col-md-12 col-md-12 col-xs-12">
                    @foreach ($proyectos as $proyecto)
                        <div class=" taskboard g-3 col-lg-3 col-md-3 col-md-6 col-xs-6">
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle">
                                    <div class="task-info d-flex align-items-center justify-content-between">
                                        <h6 class=" py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">

                                        </h6>
                                        <span>
                                            <h6><strong>{{ $proyecto->id }}</strong></h6>
                                        </span>
                                    </div>

                                    <p class="py-2 mb-0"> <strong>{{ $proyecto->nombre }}</strong></p>
                                    <p class="py-2 mb-0">{{ $proyecto->descripcion }}</p>
                                    <div class="tikit-info row g-3 align-items-center">

                                        <div class="col-sm text-end">

                                            <div class="d-flex align-items-center">
                                                @if ($proyecto->id != 9 && $proyecto->id != 11)
                                                    @if ($proyecto->avance < 50)
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 50%" aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $proyecto->avance }}%</div>
                                                        </div>
                                                    @elseif($proyecto->avance < 70)
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: {{ $proyecto->avance }}%"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $proyecto->avance }}%</div>
                                                        </div>
                                                    @else
                                                        <div class="progress" style="height: 20px; width: 150px;">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: {{ $proyecto->avance }}%"
                                                                aria-valuenow="60" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ $proyecto->avance }}%</div>
                                                        </div>
                                                    @endif
                                                @endif


                                            </div>
                                        </div>
                                        <div class="col-sm text-end">
                                            <div class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"
                                                wire:click="actividad_show({{ $proyecto->id }})"> <strong><i
                                                        class="icofont-eye fa-lg"></i> Actividades</strong>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </li>
                        </div>
                    @endforeach

                </div>


            </div>



        </div>

    </div>
</div>
