
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
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

                        <select name="proveedor_id"  class="form-select" required>
                            @foreach ($proveedores as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    &nbsp;
                    <div class="form-group">
                        <label class="form-label"><strong>Periodo
                            </strong></label>
                      <input type="text" name="periodo" class="form-control" required>
                    </div>
                    &nbsp;

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>

