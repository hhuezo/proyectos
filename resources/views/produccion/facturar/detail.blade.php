<label class="form-label"><strong>Proyectos</strong></label>
<ul class="list-group">
    @foreach ($proyectos as $proyecto)
        <li class="list-group-item list-group-item-action"><button class="btn btn-danger"
                onclick="unlink({{ $proyecto->id }})"><i
                    class="fa fa-trash fa-lg"></i></button>&nbsp;&nbsp;&nbsp;{{ $proyecto->nombre }} </li>
    @endforeach
</ul>
