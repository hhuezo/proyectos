<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\Proyecto as ProyectoModel;
use Livewire\Component;

class ProyectoFinalizadoShow extends Component
{
    public $id_proyecto = 0, $id_actividad, $numero_ticket, $ponderacion, $descripcion,
        $fecha_inicio, $categoria_id, $estado_id, $prioridad_id, $fecha_fin, $forma = "NO APLICA", $users_id, $tipo = 1, $busqueda;

    public $count = 0;

    public function mount()
    {

        if (session('id_proyecto')) {
            $this->id_proyecto = session('id_proyecto');
        }
    }
    public function render()
    {
        $proyecto = ProyectoModel::findOrFail($this->id_proyecto);

        $proyecto = ProyectoModel::join('estados', 'proyectos.estado_id', '=', 'estados.id')
        ->select('proyectos.id as id', 'proyectos.nombre', 'proyectos.avance as avance_temp',
        'proyectos.estado_id',
        
        \DB::raw('(select ifnull(sum((act.porcentaje/100) * act.ponderacion),0) from actividades act
        where act.proyecto_id = proyectos.id and act.estado_id <> 7) as avance'))
        ->where('proyectos.id', '=', $this->id_proyecto)
        ->first();
    
        $ponderacion_total =  Actividad::where('proyecto_id','=',$this->id_proyecto)->where('estado_id','<>',7)->sum('ponderacion');
        //(select ifnull(sum((act.porcentaje/100) * act.ponderacion),0)

        $colors = ["","planned_task","review_task","progress_task","completed_task"];
        if (strlen($this->busqueda) > 0) {
            $actividades = Actividad::where('descripcion', 'like', '%' . $this->busqueda . '%')->where('proyecto_id', '=', $this->id_proyecto)->orderBy('id', 'desc')->get();
        } else {
            $actividades = Actividad::where('proyecto_id', '=', $this->id_proyecto)->orderBy('id', 'desc')->get();
        }
        return view('livewire.proyecto-finalizado-show',compact('proyecto', 'actividades','ponderacion_total'));
    }

    public function changeType()
    {
        if ($this->tipo == 1) {
            $this->tipo = 2;
        } else {
            $this->tipo = 1;
        }
    }
  
}
