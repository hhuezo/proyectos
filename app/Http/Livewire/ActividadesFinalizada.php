<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\Proyecto;
use Livewire\Component;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Auth\User;

class ActividadesFinalizada extends Component
{
    public $busqueda, $proyectos, $fechainicio, $fechafin, $usuario, $unidad, $usuarios, $id_proyecto = 0, $id_actividad = 0;


    public function mount()
    {

        $fecha_actual = Carbon::now('America/El_Salvador');
        $fecha_temp = Carbon::now('America/El_Salvador');
        $fecha_anterior =  $fecha_temp->addMonth(-1);
        $this->fechainicio =   $fecha_anterior->format('Y-m-d');
        $this->fechafin =  $fecha_actual->format('Y-m-d');

        $this->unidad =  auth()->user()->unidad_id;
        $this->proyectos = Proyecto::orderBy('nombre', 'asc')->get();


        // $listuser=User::where("unidad_id","=",$this->unidad)->get();

        $this->usuarios = User::where("unidad_id", "=", $this->unidad)->where("estado", "=","A" )->orderBy('user_name', 'asc')->get();
    }


    public function render()
    {

        //  if(auth()->user()->hasRole('Administrador unidad')){
        if (auth()->user()->hasPermissionTo('ver finalizadas')) {
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
                ->where('actividades.unidad_id', '=', $this->unidad)
                ->where('actividades.fecha_liberacion', '>=', date_create_from_format('Y-m-d', $this->fechainicio))
                ->where('actividades.fecha_liberacion', '<=', date_create_from_format('Y-m-d', $this->fechafin))
                ->where('actividades.descripcion', 'like', '%' . $this->busqueda . '%')
                ->where('users.user_name', 'like', '%' . $this->usuario . '%')
                ->where('users.estado', '=', 'A')
                ->orderBy('actividades.id', 'desc')->get();
        } else {

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
                ->where('actividades.fecha_liberacion', '>=', date_create_from_format('Y-m-d', $this->fechainicio))
                ->where('actividades.fecha_liberacion', '<=', date_create_from_format('Y-m-d', $this->fechafin))
                ->where('actividades.descripcion', 'like', '%' . $this->busqueda . '%')
                ->where('users.estado', '=', 'A')
                ->orderBy('actividades.id', 'desc')->get(); 
        }





        //dd($actividades);
        return view('livewire.actividades-finalizada', compact('actividades'));
    }


    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        $this->id_proyecto = $actividad->proyecto_id;
        $this->id_actividad = $id;
    }

    public function update(){
        $actividad=Actividad::findOrFail($this->id_actividad);
        $actividad->proyecto_id=$this->id_proyecto;
        $actividad->update();
        $this->dispatchBrowserEvent('close-modal');   
    
    
        }
}
