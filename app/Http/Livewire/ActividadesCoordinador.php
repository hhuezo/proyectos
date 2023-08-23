<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\CategoriaTicket;
use App\Estado;
use App\PrioridadTicket;
use App\Proyecto;
use App\User;
use Livewire\Component;
use Carbon\Carbon;

class ActividadesCoordinador extends Component
{

    public $id_actividad = 0, $users_id = 0, $busqueda, $tipo = 1, $proyecto_id, $numero_ticket = 0, $ponderacion = 0.01,
        $descripcion, $fecha_inicio, $categoria_id, $estado_id, $prioridad_id = 1, $fecha_fin, $forma = "NO APLICA";
    public function mount($id)
    {
        $this->users_id = $id;
    }
    public function render()
    {

        $usuario = User::findOrFail($this->users_id);
        $proyectos = Actividad::join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
            ->select('proyectos.id as proyecto_id', 'proyectos.nombre', 'proyectos.avance')
            ->where('actividades.users_id', '=', $this->users_id)
            ->whereNotIn('actividades.estado_id', [4, 7])
            ->orderBy('proyectos.id', 'desc')->distinct()->get();

        $actividades = Actividad::join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
            ->join('users', 'actividades.users_id', '=', 'users.id')
            ->join('estados', 'actividades.estado_id', '=', 'estados.id')
            ->join('categoria_tickets', 'actividades.categoria_id', '=', 'categoria_tickets.id')
            ->join('prioridad_tickets', 'actividades.prioridad_id', '=', 'prioridad_tickets.id')
            ->select(
                'actividades.id',
                'actividades.numero_ticket',
                'proyectos.nombre as proyecto',
                'proyectos.id as proyecto_id',
                'actividades.descripcion as actividad',
                'categoria_tickets.nombre as categoria',
                'prioridad_tickets.nombre as prioridad',
                'actividades.fecha_inicio',
                'actividades.fecha_fin',
                'actividades.porcentaje',
                'users.user_name',
                'users.image',
                'estados.nombre as estado',
                'prioridad_tickets.color',
                'actividades.estado_id'
            )
            ->where('actividades.estado_id', '<>', 7)
            ->where('actividades.estado_id', '<>', 4)
            ->where('actividades.users_id', '=', $this->users_id)
            ->where('actividades.descripcion', 'like', '%' . $this->busqueda . '%')
            ->orderBy('actividades.id', 'desc')->get();

        $categorias = CategoriaTicket::where('categoria_tickets.unidad_id', '=', auth()->user()->unidad_id)->get();
        $prioridades = PrioridadTicket::get();
        $proyectos_unidad = Proyecto::where('unidad_id', '=', $usuario->unidad_id)->get();
        $estados = Estado::get();
        $usuarios = User::where('unidad_id', '=', auth()->user()->unidad_id)->get();
        return view('livewire.actividades-coordinador', compact('actividades', 'proyectos', 'categorias', 'prioridades', 'usuario', 'proyectos_unidad', 'estados', 'usuarios'));
    }

    public function changeType()
    {
        if ($this->tipo == 1) {
            $this->tipo = 2;
        } else {
            $this->tipo = 1;
        }
    }

    private function resetInput()
    {
        $tipo_temp = $this->tipo;
        //$this->reset();
        $this->tipo =  $tipo_temp;
        $time = Carbon::now('America/El_Salvador');
        $this->fecha_inicio = $time->format('Y-m-d');
        $this->fecha_fin = $time->format('Y-m-d');
        $this->numero_ticket = 0;
        $this->ponderacion = 0.01;
        $this->categoria_id = "";
        $this->prioridad_id = 1;
        $this->descripcion = "";
        $this->proyecto_id = "";

    }


    public function create()
    {
        $this->resetInput();
    }

    public function store()
    {
        $messages = [
            'numero_ticket.required' => 'El número de ticket es requerido',
            'ponderacion.required' => 'La ponderación es requerida',
            'proyecto_id.required' => 'El proyecto es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'prioridad_id.required' => 'La prioridad es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'forma.required' => 'La forma final es requerida',
        ];
        $validate = $this->validate([
            'numero_ticket' => 'required',
            'ponderacion' => 'required',
            'proyecto_id' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'categoria_id' => 'required',
            'prioridad_id' => 'required',
            'fecha_fin' => 'required',
            'forma' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');

        $user_developer = User::findOrFail($this->users_id);

        Actividad::create([
            'proyecto_id' => $this->proyecto_id,
            'numero_ticket' => $this->numero_ticket,
            'ponderacion' => $this->ponderacion,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'categoria_id' => $this->categoria_id,
            'estado_id' => 1,
            'porcentaje' => 0,
            'prioridad_id' => $this->prioridad_id,
            'fecha_fin' => $this->fecha_fin,
            'forma' => $this->forma,
            'users_id' => $this->users_id,
            'unidad_id' => $user_developer->unidad_id,
            'fecha_asignacion' => $time->toDateTimeString(),
        ]);


        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        $this->id_actividad = $id;
        $this->proyecto_id = $actividad->proyecto_id;
        $this->numero_ticket = $actividad->numero_ticket;
        $this->ponderacion = $actividad->ponderacion;
        $this->descripcion = $actividad->descripcion;
        $this->fecha_inicio = substr($actividad->fecha_inicio, 0, 10);
        $this->categoria_id = $actividad->categoria_id;
        $this->estado_id = $actividad->estado_id;
        $this->prioridad_id = $actividad->prioridad_id;
        $this->fecha_fin = substr($actividad->fecha_fin, 0, 10);
        $this->forma = $actividad->forma;
        //$this->users_id = $actividad->users_id;
    }

    public function update()
    {
        $messages = [
            'numero_ticket.required' => 'El número de ticket es requerido',
            'ponderacion.required' => 'La ponderación es requerida',
            'descripcion.required' => 'La descripcion es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'estado_id.required' => 'El estado  es requerido',
            'prioridad_id.required' => 'La prioridad es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'forma.required' => 'La forma final es requerida',
            'users_id.required' => 'El usuario es requerido',
            'proyecto_id.required' => 'El proyecto es requerido',
        ];
        $validate = $this->validate([
            'proyecto_id' => 'required',
            'numero_ticket' => 'required',
            'ponderacion' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'categoria_id' => 'required',
            'estado_id' => 'required',
            'prioridad_id' => 'required',
            'fecha_fin' => 'required',
            'forma' => 'required',
            'users_id' => 'required',
        ], $messages);


        $actividad = Actividad::findOrFail($this->id_actividad);
        $actividad->proyecto_id = $this->proyecto_id;
        $actividad->numero_ticket = $this->numero_ticket;
        $actividad->ponderacion = $this->ponderacion;
        $actividad->descripcion = $this->descripcion;
        $actividad->fecha_inicio = $this->fecha_inicio;
        $actividad->categoria_id = $this->categoria_id;
        $actividad->estado_id = $this->estado_id;
        $actividad->prioridad_id = $this->prioridad_id;
        $actividad->fecha_fin = $this->fecha_fin;
        $actividad->forma = $this->forma;
        $actividad->users_id = $this->users_id;
        $actividad->update();

        $this->dispatchBrowserEvent('close-modal-edit');
    }
}
