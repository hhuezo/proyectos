<div class="modal fade" id="modal-{{ $documento->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('matriz_riesgo.update', $documento->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Modificar ISO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group row">
                            <label class="form-label col-md-3" align="right"><strong>Nombre</strong></label>
                            <div class="col-9">
                                <input type="text" name="nombre" value="{{ $documento->nombre }}" required
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group row">
                            <label class="form-label col-md-3" align="right"><strong>Archivo</strong></label>
                            <div class="col-9">
                                <input type="file" name="archivo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>

    </div>
</div>
