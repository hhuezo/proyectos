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
use Illuminate\Support\Facades\DB;

class ProyectoFinalizado extends Component
{
    public $id_proyecto = 0, $estado_id = 2, $nombre, $descripcion, $busqueda, $busqueda_actividad;
    public $proyectos, $id_unidad, $actividades;

    public $id_actividad, $numero_ticket = 0, $ponderacion = 0.01, $descripcion_actividad,
        $fecha_inicio, $categoria_id, $estado_actividad_id, $prioridad_id, $fecha_fin, $forma = "NO APLICA", $users_id, $avance,
        $order_fecha_inicio = 0 /* 0 = sin ordenamiento, 1 = ascendente, 2 descendente */,
        $order_fecha_final = 0 /* 0 = sin ordenamiento, 1 = ascendente, 2 descendente */;


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
        $estados =  Estado::where('id', '<>', 7)->where('id', '>', 1)->get();

        $categorias =  CategoriaTicket::where('unidad_id', '=', $this->id_unidad)->get();
        $prioridades =  PrioridadTicket::get();
        $usuarios =  User::where('id', '>', 1)->where('unidad_id', '=', $this->id_unidad)->get();

        if ($this->order_fecha_inicio == 0 && $this->order_fecha_final == 0) {
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
                    'proyectos.estado_id',
                    DB::raw('(select min(fecha_asignacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_inicio, 
                (select max(fecha_liberacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_final,
                (select ifnull(sum(movimiento_actividades.tiempo),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id) + 
                (select ifnull(sum(movimiento_actividades.tiempo_minutos),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id
                ) as tiempo')
                )
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', $this->id_unidad)
                ->where('proyectos.finalizado', '=', 1)
                ->orderBy('fecha_final', 'desc')
                ->get();
        } else  if ($this->order_fecha_inicio == 1) {
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
                    'proyectos.estado_id',
                    DB::raw('(select min(fecha_asignacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_inicio, 
                (select max(fecha_liberacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_final,
                (select ifnull(sum(movimiento_actividades.tiempo),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id) + 
                (select ifnull(sum(movimiento_actividades.tiempo_minutos),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id
                ) as tiempo')
                )
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', $this->id_unidad)
                ->where('proyectos.finalizado', '=', 1)
                ->orderBy('fecha_inicio', 'asc')
                ->get();
        } else  if ($this->order_fecha_inicio == 2) {
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
                    'proyectos.estado_id',
                    DB::raw('(select min(fecha_asignacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_inicio, 
                (select max(fecha_liberacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_final,
                (select ifnull(sum(movimiento_actividades.tiempo),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id) + 
                (select ifnull(sum(movimiento_actividades.tiempo_minutos),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id
                ) as tiempo')
                )
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', $this->id_unidad)
                ->where('proyectos.finalizado', '=', 1)
                ->orderBy('fecha_inicio', 'desc')
                ->get();
        } else if ($this->order_fecha_final == 1) {
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
                    'proyectos.estado_id',
                    DB::raw('(select min(fecha_asignacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_inicio, 
                (select max(fecha_liberacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_final,
                (select ifnull(sum(movimiento_actividades.tiempo),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id) + 
                (select ifnull(sum(movimiento_actividades.tiempo_minutos),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
                where actividades.proyecto_id = proyectos.id
                ) as tiempo')
                )
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', $this->id_unidad)
                ->where('proyectos.finalizado', '=', 1)
                ->orderBy('fecha_final', 'asc')
                ->get();
        } else {
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
                    'proyectos.estado_id',
                    DB::raw('(select min(fecha_asignacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_inicio, 
            (select max(fecha_liberacion) from actividades where actividades.proyecto_id = proyectos.id) as fecha_final,
            (select ifnull(sum(movimiento_actividades.tiempo),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
            where actividades.proyecto_id = proyectos.id) + 
            (select ifnull(sum(movimiento_actividades.tiempo_minutos),0) from movimiento_actividades inner join actividades on actividades.id = movimiento_actividades.actividad_id
            where actividades.proyecto_id = proyectos.id
            ) as tiempo')
                )
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', $this->id_unidad)
                ->where('proyectos.finalizado', '=', 1)
                ->orderBy('fecha_final', 'desc')
                ->get();
        }

        $estados =  Estado::where('id', '<>', 7)->where('id', '<>', 1)->get();
        $estados_actividad =  Estado::where('id', '<>', 7)->get();
        $unidad = Unidad::findOrFail($this->id_unidad);


        return view('livewire.proyecto-finalizado', compact('estados', 'estados_actividad', 'unidad', 'categorias', 'prioridades', 'usuarios'));
    }

    public function edit_actividad($id)
    {

        //$this->dispatchBrowserEvent('error-message-proyecto');
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

        //Proyecto::create($validateData);

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
        $this->busqueda_actividad = "";
        $this->ponderacion = Actividad::where('proyecto_id', '=', $id)->sum('ponderacion');
        $this->avance = $proyecto->avance;
        $this->actividades = Actividad::where('proyecto_id', '=', $id)->get();
    }


    public function update()
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

        $proyecto = Proyecto::findOrFail($this->id_proyecto);
        $proyecto->nombre = $this->nombre;
        $proyecto->descripcion = $this->descripcion;
        $proyecto->estado_id = $this->estado_id;
        $proyecto->update();
        $this->reset();

        $this->dispatchBrowserEvent('close-modal-edit');
    }

    public function actividad_show($id)
    {
        return redirect()->to('proyecto_finalizado/' . $id);
    }

    public function orden_fecha_inicio()
    {

        if ($this->order_fecha_inicio == 2 || $this->order_fecha_inicio == 0) {
            $this->order_fecha_inicio = 1;
        } else if ($this->order_fecha_inicio == 1) {
            $this->order_fecha_inicio = 2;
        }
        $this->order_fecha_final = 0;
    }

    public function orden_fecha_final()
    {
        if ($this->order_fecha_final == 2 || $this->order_fecha_final == 0) {
            $this->order_fecha_final = 1;
        } else if ($this->order_fecha_final == 1) {
            $this->order_fecha_final = 2;
        }
        $this->order_fecha_inicio = 0;
    }
}
