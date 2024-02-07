<!-- Modal XL -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="basic-form" method="POST" action="{{ url('infraestructura/evaluaciones') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Crear Evaluacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-6" >
                            <div class="form-group">
                                <label class="form-label"><strong>Proveedor
                                    </strong></label>

                                <select name="proveedor_id" class="form-select" required>
                                    @foreach ($proveedores as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Periodo
                                    </strong></label>
                                <select name="periodo" class="form-select" required>
                                    @for ($i = date('Y'); $i >= 2018; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><strong>Fecha Revisado</strong></label>
                                <input type="date" class="form-control" required name="fecha_revisado"
                                    id="fecha_revisado">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><strong>Nombre Aprobado</strong></label>
                                <input type="text" class="form-control" required name="nombre_aprobado"
                                    id="nombre_aprobado">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Fecha Aprobado </strong></label>
                                <input type="date" class="form-control" required name="fecha_aprobado"
                                    id="fecha_aprobado">
                            </div>

                            <div class="form-group">
                                <label><strong>Notificado (S/N)</strong> </label>
                                <select name="notificado" class="form-control">
                                    <option>S</option>
                                    <option>N</option>
                                </select>
                            </div>



                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label class="form-label"><strong>Nombre Elaborado</strong></label>
                                <input type="text" class="form-control" required name="nombre_elaborado"
                                    id="nombre_elaborado">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><strong>Cargo Elaborado</strong></label>
                                <input type="text" class="form-control" required name="cargo_elaborado"
                                    id="cargo_elaborado">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Nombre Revisado</strong></label>
                                <input type="text" class="form-control" required name="nombre_revisado"
                                    id="nombre_revisado">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Cargo Revisado</strong></label>
                                <input type="text" class="form-control" required name="cargo_revisado"
                                    id="cargo_revisado">
                            </div>

                            <div class="form-group">
                                <label class="form-label"><strong>Observaciones</strong></label>
                                <input type="text" class="form-control" required name="observaciones"
                                    id="observaciones">
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>





{{-- <div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form id="basic-form" method="POST" action="{{ url('infraestructura/evaluaciones') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Crear Evaluacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label"><strong>Proveedor
                            </strong></label>

                        <select name="proveedor_id" class="form-select" required>
                            @foreach ($proveedores as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Periodo
                            </strong></label>
                        <select name="periodo" class="form-select" required>
                            @for ($i = date('Y'); $i >= 2018; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="form-label"><strong>Nombre Elaborado</strong></label>
                        <input type="text" class="form-control" required name="nombre_elaborado"
                            id="nombre_elaborado">
                    </div>


                    <div class="form-group">
                        <label class="form-label"><strong>Cargo Elaborado</strong></label>
                        <input type="text" class="form-control" required name="cargo_elaborado" id="cargo_elaborado">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Nombre Revisado</strong></label>
                        <input type="text" class="form-control" required name="nombre_revisado" id="nombre_revisado">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Cargo Revisado</strong></label>
                        <input type="text" class="form-control" required name="cargo_revisado" id="cargo_revisado">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Observaciones</strong></label>
                        <input type="text" class="form-control" required name="observaciones" id="observaciones">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Fecha Revisado</strong></label>
                        <input type="date" class="form-control" required name="fecha_revisado" id="fecha_revisado">
                    </div>

                    <div class="form-group">
                        <label class="form-label"><strong>Fecha Aprobado </strong></label>
                        <input type="date" class="form-control" required name="fecha_aprobado" id="fecha_aprobado">
                    </div>
                    &nbsp;
                    <div class="form-group">
                    <label><strong>Notificado (S/N)</strong> </label>
                      <select  name="notificado" class="form-control" >
                        <option>S</option>
                        <option>N</option>
                    </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}
