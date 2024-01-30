<div class="modal fade" id="modal-active-{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ url('project/team_activate') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Activate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="form-label col-md-3" align="right"><strong>Amount</strong></label>
                                <div class="col-9">
                                    <input type="hidden" name="project_id" value="{{ $project->id }}"
                                        class="form-control">
                                    <input type="hidden" name="project_role_id" value="{{ $role->id }}"
                                        class="form-control">
                                    <input type="number" step="1" name="number" min="1" required
                                        class="form-control">
                                </div>
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

<div class="modal fade" id="modal-delete-{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form method="POST" action="{{ url('project/team_inactivate') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Delete record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{$role->team_id}}"
                    class="form-control">
                    <p>
                        Do you want to delete the record?
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



<div class="modal fade" id="modal-edit-{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form method="POST" action="{{ url('project/team_update') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Delete record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="team_id" value="{{$role->team_id}}"
                    class="form-control">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="form-label col-md-3" align="right"><strong>Amount</strong></label>
                                <div class="col-9">
                                    <input type="number" step="1" name="number" min="1" value="{{$role->number }}" required
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button> --}}
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>
