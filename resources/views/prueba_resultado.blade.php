<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Hora</th>
            <th>Actividad</th>
            <th>Detalle</th>
            <th>Tiempo</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movimientos as $obj)
            <tr>
                <td>{{ $obj->id }}</td>
                <td>{{ $obj->fecha }}</td>
                <td>{{ $obj->descripcion }}</td>
                <td>{{ $obj->detalle }}</td>
                <td>{{ $obj->tiempo_minutos }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-update"

                            onclick="modal_update('{{$obj->id}}','{{ date('Y-m-d', strtotime($obj->fecha)) }}',
                        '{{ date('H:i',strtotime($obj->fecha)) }}','{{$obj->descripcion}}','{{$obj->detalle}}','{{$obj->tiempo_minutos}}')"
                            ><i class="icofont-edit btn-lg"></i></button>

                        &nbsp;&nbsp;

                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-update"
                        onclick="modal_update('{{$obj->id}}','{{ date('Y-m-d', strtotime($obj->fecha)) }}',
                        '{{ date('H:i',strtotime($obj->fecha)) }}','{{$obj->descripcion}}','{{$obj->detalle}}','{{$obj->tiempo_minutos}}')"
                            class="btn btn-danger"><i class="icofont-ui-delete  btn-lg"></i></button>
                    </div>



                </td>
            </tr>
        @endforeach



    </tbody>
</table>


<div class="modal fade" id="modal-update" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <form method="POST" action="{{ url('prueba') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Modificar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label"><strong>Detalle</strong></label>
                        <div class="col-12">
                            <input type="hidden" name="id" id="id_modal">
                            <input type="text" name="detalle" id="detalle_modal" required class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="form-label"><strong>Fechas</strong></label>
                        <div class="col-12">
                            <input type="date" name="fecha" id="fecha_modal" required class="form-control">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label class="form-label"><strong>Hora</strong></label>
                        <div class="col-12">
                            <input type="text" name="hora" id="hora_modal" required class="form-control">
                        </div>
                    </div>
                    <br>


                    <div class="form-group">
                        <label class="form-label"><strong>Minutos</strong></label>
                        <div class="col-12">
                            <input type="number" name="tiempo_minutos" id="tiempo_minutos_modal" required
                                class="form-control">
                        </div>
                    </div>
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function modal_update(id,fecha,hora,descripcion,detalle,tiempo_minutos) {
        document.getElementById('id_modal').value = id;
        document.getElementById('fecha_modal').value = fecha;
        document.getElementById('hora_modal').value = hora;
        document.getElementById('detalle_modal').value = detalle;
        document.getElementById('tiempo_minutos_modal').value = tiempo_minutos;

    }
</script>
