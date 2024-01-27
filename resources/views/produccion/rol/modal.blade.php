<div class="modal fade" id="modal-delete-{{$obj->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form action="{{ url('produccion/rol/unlink_permission') }}" method="POST">

            @csrf
            <div class="modal-content">
             <input type="hidden" name="role_id" value="{{$rol->id}}">
             <input type="hidden" name="permission_id" value="{{$obj->id}}">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Eliminar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Confirme si desea eliminar el registro</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
