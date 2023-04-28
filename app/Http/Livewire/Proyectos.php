<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\CategoriaTicket;
use Livewire\Component;
use App\Estado;
use App\PrioridadTicket;
use App\Proyecto;
use App\Unidad;
use App\User;
use Carbon\Carbon;

class Proyectos extends Component
{
    public $id_proyecto = 0, $estado_id = 2, $nombre, $descripcion, $busqueda, $busqueda_actividad;
    public $proyectos, $id_unidad, $actividades, $tipo = 1;

    public $id_actividad, $numero_ticket = 0, $ponderacion = 0.01, $descripcion_actividad,
        $fecha_inicio, $categoria_id, $estado_actividad_id, $prioridad_id, $fecha_fin, $forma = "NO APLICA", $users_id;


    public function changeType()
    {
        if ($this->tipo == 1) {
            $this->tipo = 2;
        } else {
            $this->tipo = 1;
        }
    }
    public function mount()
    {
        if (session('id_unidad')) {
            $this->id_unidad = session('id_unidad');
        } else {
            $this->id_unidad = auth()->user()->unidad_id;
        }
    }

    public function render()
    {
        $estados =  Estado::where('id', '<>', 7)->where('id', '<>', 1)->get();
        $estados_actividad =  Estado::where('id', '<>', 7)->get();
        $unidad = Unidad::findOrFail($this->id_unidad);

        $this->proyectos = Proyecto::join('estados', 'proyectos.estado_id', '=', 'estados.id')
            ->select(
                'proyectos.id',
                'proyectos.nombre',
                'proyectos.descripcion',
                'estados.nombre as estado',
                'estados.color',
                'proyectos.destacado',
                'proyectos.avance',
                'proyectos.finalizado',
                'proyectos.estado_id'
            )
            ->where('proyectos.unidad_id', '=', $this->id_unidad)
            ->where('proyectos.finalizado', '=', 0)
            ->where('proyectos.estado_id', '<>', 7)
            ->where('proyectos.estado_id', '>', 1)
            ->where('proyectos.id', '<>', 28)
            ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy('proyectos.id', 'desc')
            ->get();


        if ($this->id_proyecto != 0) {
            $this->actividades = Actividad::where('proyecto_id', '=', $this->id_proyecto)
                ->where('unidad_id', '=', $this->id_unidad)
                ->where('descripcion', 'LIKE', '%' . $this->busqueda_actividad . '%')
                ->orderBy('id', 'desc')
                ->get();
        }

        $categorias = CategoriaTicket::where('unidad_id', '=', $this->id_unidad)->get();
        $prioridades = PrioridadTicket::get();
        $usuarios = User::where('id', '>', 1)->where('unidad_id', '=', $this->id_unidad)->get();


        $colors = ["", "#0dcaf0", "#F19828", "#0dcaf0", "#198754", "##0d6efd",  "#0d6efd", "#dc3545"];

        return view('livewire.proyectos', compact('estados', 'colors', 'unidad', 'categorias', 'prioridades', 'usuarios', 'estados_actividad'));
    }


    private function resetInput()
    {
        $this->id_proyecto = 0;
        $this->nombre = '';
        $this->descripcion = '';
        $this->estado_id = 2;
    }

    public function create()
    {
        $this->resetInput();
    }


    public function store()
    {
        $messages = [
            'estado_id.required' => 'El estado es requerido',
            'nombre.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerida',
        ];
        $validateData = $this->validate([
            'estado_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], $messages);

        $proyecto = new Proyecto();
        $proyecto->estado_id = $this->estado_id;
        $proyecto->nombre = $this->nombre;
        $proyecto->descripcion = $this->descripcion;
        $proyecto->unidad_id = auth()->user()->unidad_id;
        $proyecto->avance = 0;
        $proyecto->save();
        session()->flash('message', 'Registro creado correctamente');
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->id_proyecto = $proyecto->id;
        $this->nombre = $proyecto->nombre;
        $this->descripcion = $proyecto->descripcion;
        $this->estado_id = $proyecto->estado_id;
        $this->actividades = Actividad::where('proyecto_id', '=', $id)->get();
        $this->busqueda_actividad = "";
    }


    public function update()
    {
        $this->dispatchBrowserEvent('error-message-proyecto-show');
        $messages = [
            'estado_id.required' => 'El estado es requerido',
            'nombre.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerida',
        ];

        $validateData = $this->validate([
            'estado_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], $messages);

        $proyecto = Proyecto::findOrFail($this->id_proyecto);
        $proyecto->nombre = $this->nombre;
        $proyecto->descripcion = $this->descripcion;
        $proyecto->estado_id = $this->estado_id;
        $proyecto->update();
        //$this->reset();

        $this->dispatchBrowserEvent('update-message-show');
    }

    public function create_actividad()
    {
        $time = Carbon::now('America/El_Salvador');
        $this->fecha_inicio = $time->format('Y-m-d');
        $this->fecha_fin = $time->format('Y-m-d');
        $this->numero_ticket = 0;
        $this->ponderacion = 0.01;
        $this->categoria_id = "";
        $this->estado_actividad_id = 1;
        $this->prioridad_id = 1;



        /*
         public $id_actividad, $numero_ticket = 0, $ponderacion = 0.01, $descripcion_actividad,
        $fecha_inicio, $categoria_id, $estado_actividad_id, $prioridad_id, $fecha_fin, $forma = "NO APLICA", $users_id;*/
    }
    public function store_actividad()
    {
        $this->dispatchBrowserEvent('error-message-proyecto');
        $messages = [
            'numero_ticket.required' => 'El número de ticket es requerido',
            'ponderacion.required' => 'La ponderación es requerida',
            'descripcion_actividad.required' => 'La descripcion es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'estado_id.required' => 'El estado  es requerido',
            'prioridad_id.required' => 'La prioridad es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'forma.required' => 'La forma final es requerida',
            'users_id.required' => 'El usuario es requerido',
        ];
        $validate = $this->validate([
            'id_proyecto' => 'required',
            'numero_ticket' => 'required',
            'ponderacion' => 'required',
            'descripcion_actividad' => 'required',
            'fecha_inicio' => 'required',
            'categoria_id' => 'required',
            'estado_id' => 'required',
            'prioridad_id' => 'required',
            'fecha_fin' => 'required',
            'forma' => 'required',
            'users_id' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');


        Actividad::create([
            'proyecto_id' => $this->id_proyecto,
            'numero_ticket' => $this->numero_ticket,
            'ponderacion' => $this->ponderacion,
            'descripcion' => strtoupper($this->descripcion_actividad),
            'fecha_inicio' => $this->fecha_inicio,
            'categoria_id' => $this->categoria_id,
            'estado_id' => $this->estado_actividad_id,
            'prioridad_id' => $this->prioridad_id,
            'fecha_fin' => $this->fecha_fin,
            'forma' => $this->forma,
            'users_id' => $this->users_id,
            'porcentaje' => 0.00,
            'unidad_id' => $this->id_unidad,
            'fecha_asignacion' => $time->toDateTimeString(),
        ]);


        $this->dispatchBrowserEvent('close-modal-create-actividad');
    }
    public function edit_actividad($id)
    {
        $this->dispatchBrowserEvent('error-message-proyecto');
        $actividad = Actividad::findOrFail($id);
        $this->id_actividad = $id;
        $this->id_proyecto = $actividad->proyecto_id;
        $this->numero_ticket = $actividad->numero_ticket;
        $this->ponderacion = $actividad->ponderacion;
        $this->descripcion_actividad = $actividad->descripcion;
        $this->fecha_inicio = substr($actividad->fecha_inicio, 0, 10);
        $this->categoria_id = $actividad->categoria_id;
        $this->estado_actividad_id = $actividad->estado_id;
        $this->prioridad_id = $actividad->prioridad_id;
        $this->fecha_fin = substr($actividad->fecha_fin, 0, 10);
        $this->forma = $actividad->forma;
        $this->users_id = $actividad->users_id;
    }

    public function update_actividad()
    {
        $messages = [
            'numero_ticket.required' => 'El número de ticket es requerido',
            'ponderacion.required' => 'La ponderación es requerida',
            'descripcion_actividad.required' => 'La descripcion es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'estado_actividad_id.required' => 'El estado  es requerido',
            'prioridad_id.required' => 'La prioridad es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'forma.required' => 'La forma final es requerida',
            'users_id.required' => 'El usuario es requerido',
        ];
        $validate = $this->validate([
            'id_proyecto' => 'required',
            'numero_ticket' => 'required',
            'ponderacion' => 'required',
            'descripcion_actividad' => 'required',
            'fecha_inicio' => 'required',
            'categoria_id' => 'required',
            'estado_actividad_id' => 'required',
            'prioridad_id' => 'required',
            'fecha_fin' => 'required',
            'forma' => 'required',
            'users_id' => 'required',
        ], $messages);


        $actividad = Actividad::findOrFail($this->id_actividad);
        $actividad->numero_ticket = $this->numero_ticket;
        $actividad->ponderacion = $this->ponderacion;
        $actividad->descripcion = strtoupper($this->descripcion_actividad);
        $actividad->fecha_inicio = $this->fecha_inicio;
        $actividad->categoria_id = $this->categoria_id;
        $actividad->estado_id = $this->estado_actividad_id;
        $actividad->prioridad_id = $this->prioridad_id;
        $actividad->fecha_fin = $this->fecha_fin;
        $actividad->forma = $this->forma;
        $actividad->users_id = $this->users_id;
        $actividad->update();

        $this->dispatchBrowserEvent('close-modal-edit-actividad');
    }
}
