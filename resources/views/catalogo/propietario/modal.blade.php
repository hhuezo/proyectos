<div class="modal fade" id="modal-delete-{{$obj->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form method="POST" action="{{ route('propietario.destroy', $obj->id) }}">
            @method('delete')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">@if($obj->activo == 1) Desactivar registro @else Activar registro @endif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>

                    @if($obj->activo == 1) Confirme si desea desactivar el registro
                    @else Confirme si desea activar el registro 
                    @endif
                    </p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
