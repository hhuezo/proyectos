<div class="modal fade" id="modal-delete-{{ $documento->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('matriz_riesgo.destroy', $documento->id) }}">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Eliminar ISO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>¿Desea eliminar el registro?</h6>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>

    </div>
</div>
