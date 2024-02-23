<div class="modal fade" id="reporte_vacacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form id="basic-form" method="POST" action="{{ url('infraestructura/vacaciones/reporte') }}">            
            @csrf            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Mostrar Reporte Vacaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="form-label col-md-3" align="right"><strong>Fecha
                                    Inicio</strong></label>
                            <div class="col-6">
                                <input type="date" name="fecha_inicio" id="fecha_inicio" required class="form-control">
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="form-label col-md-3" align="right"><strong>Fecha
                                    final</strong></label>
                            <div class="col-6">
                                <input type="date" name="fecha_fin" id="fecha_fin" required class="form-control">
                            </div>
                        </div>
                    </div>
                    &nbsp;
                    <div>
                        &nbsp;</div>
                    
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
