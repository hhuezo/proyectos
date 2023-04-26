<?php

namespace App\Http\Livewire;

use App\Actividad;
use Livewire\Component;

class ActividadesFinalizada extends Component
{
    public $busqueda;
    public function render()
    {
        $actividades =  Actividad::join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
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
                'estados.nombre as estado',
                'prioridad_tickets.color',
                'actividades.estado_id',
                \DB::raw('(select sum(m.tiempo_minutos) from movimiento_actividades m where m.actividad_id =  actividades.id) as minutos')
            )
            ->where('actividades.estado_id', '=', 4)
            ->where('actividades.users_id', '=', auth()->user()->id)
            ->where('actividades.descripcion', 'like', '%' . $this->busqueda . '%')
            ->orderBy('actividades.id', 'desc')->get();
            //dd($actividades);
        return view('livewire.actividades-finalizada',compact('actividades'));
    }


}
