{{-- <div class="modal fade" id="modal-add-rol" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <form method="POST" action="{{ url('usuario/attach_roles') }}">
            @csrf
            <input type="hidden" name='model_id' value="{{ $user->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Agregar </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-area relative">
                        <label for="largeInput" class="form-label">Roles</label>
                        <select name="rol_id" class="form-control select">
                            @foreach ($rol_no_asignados as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> &nbsp;&nbsp;

                </div>
                <div class="modal-footer">
                    <!-- Modal body -->
                    <div class="p-6 space-y-4">
                        <button type="submit" class="btn btn-primary">Aceptar</button>

                    </div>
                </div>
        </form>
    </div>
</div> --}}

<div class="modal fade" id="modal-add-rol" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ url('usuario/attach_roles') }}">
            @csrf
            <input type="hidden" name='model_id' value="{{ $user->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-area relative">
                        <label for="largeInput" class="form-label">Roles</label>
                        <select name="rol_id" class="form-control select">
                            @foreach ($rol_no_asignados as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
