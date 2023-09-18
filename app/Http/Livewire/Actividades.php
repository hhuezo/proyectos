<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\CategoriaTicket;
use App\MovimientoActividad;
use App\PrioridadTicket;
use App\Proyecto;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

class Actividades extends Component
{
    public $id_proyecto = 9, $proyectos, $catalogo_proyectos, $proyecto_id, $numero_ticket = 0, $ponderacion = 0.01, $descripcion,
        $fecha_inicio, $categoria_id, $estado_id, $prioridad_id = 1, $fecha_fin, $forma = "NO APLICA",  $tipo = 1, $busqueda,
        $id_actividad, $nombre_actividad, $porcentaje_diario = 0, $porcentaje_actual, $porcentaje_anterior = 0, $tiempo_minutos, $detalle;



    public function load_edit_actividad($id)
    {
        $actividad = Actividad::findOrFail($id);
        if ($actividad) {
            $this->id_actividad = $id;
            $this->nombre_actividad = $actividad->descripcion;
            $this->proyecto_id = $actividad->proyecto_id;
        }
    }

    public function edit_actividad()
    {
        $actividad = Actividad::findOrFail($this->id_actividad);
        $actividad->proyecto_id = $this->proyecto_id;
        $actividad->update();
        $this->dispatchBrowserEvent('close-modal-edit');
    }

    public function render()
    {
        $busqueda_temp = $this->busqueda;
        $this->proyectos =  Actividad::join('proyectos', 'actividades.proyecto_id', '=', 'proyectos.id')
            ->select('proyectos.id as proyecto_id', 'proyectos.nombre', 'proyectos.avance')
            ->where(function ($query) use ($busqueda_temp) {
                $query->where('actividades.descripcion', 'like', '%' . $busqueda_temp . '%')
                    ->orWhere('proyectos.nombre', 'like', '%' . $busqueda_temp . '%');
            })
            ->where('actividades.users_id', '=', auth()->user()->id)
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
            ->where(function ($query) use ($busqueda_temp) {
                $query->where('actividades.descripcion', 'like', '%' . $busqueda_temp . '%')
                    ->orWhere('proyectos.nombre', 'like', '%' . $busqueda_temp . '%');
            })
            ->where('actividades.estado_id', '<>', 7)
            ->where('actividades.estado_id', '<>', 4)
            ->where('actividades.users_id', '=', auth()->user()->id)
            ->orderBy('actividades.id', 'desc')->get();

        $categorias = CategoriaTicket::where('categoria_tickets.unidad_id', '=', auth()->user()->unidad_id)->get();
        $prioridades = PrioridadTicket::get();
        $this->catalogo_proyectos = Proyecto::where('unidad_id', '=', auth()->user()->unidad_id)
        ->whereIn('estado_id', [1, 2, 3,4, 6])->where('finalizado', '<>', 1)->orderBy('nombre')->get();


        return view('livewire.actividades', compact('actividades', 'categorias', 'prioridades'));
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
        $this->reset();
        $this->id_proyecto = session('id_proyecto');
        $this->tipo =  $tipo_temp;
    }


    public function create()
    {
        return Redirect::to('actividades/create');
        // $this->resetInput();

        // $time = Carbon::now('America/El_Salvador');
        // $this->fecha_inicio = $time->format('Y-m-d');
        // $this->fecha_fin = $time->format('Y-m-d');
        // $this->numero_ticket = 0;
        // $this->ponderacion = 0.01;
        // $this->categoria_id = "";
        // $this->prioridad_id = 1;
    }

    public function store()
    {
        $messages = [
            'numero_ticket.required' => 'El número de ticket es requerido',
            'ponderacion.required' => 'La ponderación es requerida',
            'descripcion.required' => 'La descripcion es requerida',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'prioridad_id.required' => 'La prioridad es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'forma.required' => 'La forma final es requerida',
            'id_proyecto.required' => 'El proyecto es requerido',
        ];
        $validate = $this->validate([
            'numero_ticket' => 'required',
            'ponderacion' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'categoria_id' => 'required',
            'prioridad_id' => 'required',
            'fecha_fin' => 'required',
            'forma' => 'required',
            'id_proyecto' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');



        $actividad = new Actividad();
        $actividad->proyecto_id = $this->id_proyecto;
        $actividad->numero_ticket = $this->numero_ticket;
        $actividad->ponderacion = $this->ponderacion;
        $actividad->descripcion = $this->descripcion;
        $actividad->fecha_inicio = $this->fecha_inicio;
        $actividad->categoria_id = $this->categoria_id;
        $actividad->estado_id = 1;
        $actividad->prioridad_id = $this->prioridad_id;
        $actividad->fecha_fin = $this->fecha_fin;
        $actividad->unidad_id = auth()->user()->unidad_id;
        $actividad->forma = $this->forma;
        $actividad->porcentaje = 0;
        $actividad->users_id = auth()->user()->id;
        $actividad->fecha_asignacion = $time->toDateTimeString();
        $actividad->save();



        $movimientoActividad = new MovimientoActividad();
        $time = Carbon::now('America/El_Salvador');
        $movimientoActividad->fecha =  $time->toDateTimeString();
        //$movimientoActividad->fecha = $mytime->toDateString();
        $movimientoActividad->porcentaje = '0';
        $movimientoActividad->porcentaje_acum = '0';
        $movimientoActividad->actividad_id = $actividad->id;
        $movimientoActividad->estado_id = 3;
        $movimientoActividad->detalle = '';
        $movimientoActividad->tiempo = '0';

        $movimientoActividad->save();


        $this->dispatchBrowserEvent('close-modal');
    }


    public function pausar($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->estado_id = 2;
        $actividad->save();

        $actividades = Actividad::join('movimiento_actividades', 'actividades.id', '=', 'movimiento_actividades.actividad_id')
            ->select('movimiento_actividades.fecha')
            ->where('actividades.users_id', '=', auth()->user()->id)
            ->orderBy('movimiento_actividades.id', 'desc')->first();

        //obteniendo fecha anterior y actividad id
        $fecha_ant = $actividades->fecha;
        $actividad_id = $id;




        $actividad = Actividad::find($id);
        $actividad->estado_id = 2;
        $actividad->save();

        $movimientoActividad = new MovimientoActividad();
        $time = Carbon::now('America/El_Salvador');
        $movimientoActividad->fecha = $time->toDateTimeString();
        //$movimientoActividad->fecha = $mytime->toDateString();
        $movimientoActividad->porcentaje = '0';
        $movimientoActividad->porcentaje_acum = '0';
        $movimientoActividad->actividad_id = $actividad->id;
        $movimientoActividad->estado_id = 2;
        $movimientoActividad->detalle = '';
        $movimientoActividad->tiempo = '0';

        $movimientoActividad->save();


        //obteniendo fecha actual y movimiento actividad id
        $fecha_act = $movimientoActividad->fecha;
        $mov_actividad_id = $movimientoActividad->id;

        $dsb_actividades2a = DB::select("call spCalculaTiempoEntreDias2('$mov_actividad_id','$actividad_id','$fecha_ant','$fecha_act')");
        $dsb_actividades2b = DB::select("call spActualizarMovimientoActividadesTiempo('$actividad_id')");
        $dsb_actividades2c = DB::select("call spActualizaTiempoActividades('$actividad_id')");
    }



    public function activar($id)
    {
        $count = Actividad::where('users_id', '=', auth()->user()->id)->where('estado_id', '=', 3)->where('id', '<>', $id)->count('id');

        if ($count > 0) {
            $this->dispatchBrowserEvent('error-alert');
        } else {
            $actividad = Actividad::findOrFail($id);
            $actividad->estado_id = 3;
            $actividad->save();




            $actividades = Actividad::join('movimiento_actividades', 'actividades.id', '=', 'movimiento_actividades.actividad_id')
                ->select('movimiento_actividades.fecha')
                ->where('actividades.users_id', '=', auth()->user()->id)
                ->orderBy('movimiento_actividades.id', 'desc')->first();



            //obteniendo fecha anterior y actividad id
            $fecha_ant = $actividades->fecha;
            $actividad_id = $id;

            $movimientoActividad = new MovimientoActividad();
            $time = Carbon::now('America/El_Salvador');
            $movimientoActividad->fecha =  $time->toDateTimeString();
            //$movimientoActividad->fecha = $mytime->toDateString();
            $movimientoActividad->porcentaje = '0';
            $movimientoActividad->porcentaje_acum = '0';
            $movimientoActividad->actividad_id = $actividad->id;
            $movimientoActividad->estado_id = 3;
            $movimientoActividad->detalle = '';
            $movimientoActividad->tiempo = '0';

            $movimientoActividad->save();


            //obteniendo fecha actual y movimiento actividad id
            $fecha_act = $movimientoActividad->fecha;
            $mov_actividad_id = $movimientoActividad->id;

            $dsb_actividades1a = DB::select("call spCalculaTiempoEntreDias2('$mov_actividad_id','$actividad_id','$fecha_ant','$fecha_act')");
            $dsb_actividades1b = DB::select("call spActualizarMovimientoActividadesTiempo('$actividad_id')");
            $dsb_actividades1c = DB::select("call spActualizaTiempoActividades('$actividad_id')");
        }
    }



    public function load_actividad($id)
    {

        $actividad = Actividad::findOrFail($id);

        if ($actividad) {
            $this->id_actividad = $id;
            $this->nombre_actividad = $actividad->descripcion;
            $this->porcentaje_anterior = $actividad->porcentaje;
            $this->porcentaje_actual = 0;
        }
    }

    public function calculo_porcentaje()
    {
        try {
            if ($this->porcentaje_diario) {
                $this->porcentaje_actual = $this->porcentaje_anterior + $this->porcentaje_diario;
            } else {
                $this->porcentaje_actual = $this->porcentaje_anterior;
            }
        } catch (Exception $e) {
        }
    }

    public function store_movimiento()
    {
        $messages = [
            'id_actividad.required' => 'La actividad es requerida',
            'porcentaje_diario.min' => 'El porcentaje diario debe ser mayor a 0',
            'porcentaje_diario.required' => 'El pórcentaje diario es requerido',
            'porcentaje_actual.max' => 'El porcentaje actual no puede ser mayor a 100',
            'porcentaje_actual.min' => 'El pórcentaje debe ser mayor a 0',
            'tiempo_minutos.required' => 'El tiempo es requerido',
            'tiempo_minutos.min' => 'El tiempo debe ser mayor a 0',
            'detalle.required' => 'El detalle es requerido',
        ];
        $validate = $this->validate([
            'id_actividad' => 'required',
            'porcentaje_diario' => 'required|numeric|min:1',
            'porcentaje_actual' => 'required|numeric|max:100|min:1',
            'tiempo_minutos' => 'required|numeric|min:1',
            'detalle' => 'required',
        ], $messages);

        $actividad = Actividad::findOrFail($this->id_actividad);
        $actividad->porcentaje = $this->porcentaje_actual;
        if ($this->porcentaje_actual == 100) {
            $actividad->estado_id = 4; // en certificacion
            $time = Carbon::now('America/El_Salvador');
            $actividad->fecha_liberacion = $time->toDateTimeString();
        }
        $actividad->update();


        if ($this->porcentaje_actual < 100) {
            $actividades = Actividad::join('movimiento_actividades', 'actividades.id', '=', 'movimiento_actividades.actividad_id')
                ->select('movimiento_actividades.fecha')
                ->where('actividades.users_id', '=', auth()->user()->id)
                ->orderBy('movimiento_actividades.id', 'desc')->first();


            //obteniendo fecha anterior y actividad id
            $fecha_ant = $actividades->fecha;
            $actividad_id = $this->id_actividad;



            $movimientoActividad = new MovimientoActividad();
            $time = Carbon::now('America/El_Salvador');
            $movimientoActividad->fecha = $time->toDateTimeString();
            $movimientoActividad->porcentaje = $this->porcentaje_diario;
            $movimientoActividad->porcentaje_acum = $this->porcentaje_actual;
            $movimientoActividad->actividad_id = $actividad_id;
            $movimientoActividad->estado_id = '3'; // en desarrollo
            $movimientoActividad->detalle = $this->detalle;
            $movimientoActividad->tiempo = '0';
            $movimientoActividad->tiempo_minutos = $this->tiempo_minutos;
            $movimientoActividad->save();
        } else if ($this->porcentaje_actual == 100) {
            $actividades = Actividad::join('movimiento_actividades', 'actividades.id', '=', 'movimiento_actividades.actividad_id')
                ->select('movimiento_actividades.fecha')
                ->where('actividades.users_id', '=', auth()->user()->id)
                ->orderBy('movimiento_actividades.id', 'desc')->first();


            //obteniendo fecha anterior y actividad id
            $fecha_ant = $actividades->fecha;
            $actividad_id = $this->id_actividad;



            $movimientoActividad = new MovimientoActividad();
            $time = Carbon::now('America/El_Salvador');
            $movimientoActividad->fecha = $time->toDateTimeString();
            $movimientoActividad->porcentaje = $this->porcentaje_diario;
            $movimientoActividad->porcentaje_acum = $this->porcentaje_actual;
            $movimientoActividad->actividad_id = $actividad_id;
            $movimientoActividad->estado_id = '4'; // certificacion
            $movimientoActividad->detalle = $this->detalle;
            $movimientoActividad->tiempo = '0';
            $movimientoActividad->tiempo_minutos = $this->tiempo_minutos;
            $movimientoActividad->save();
        }

        $this->id_actividad = 0;
        $this->nombre_actividad = "";
        $this->porcentaje_diario = 0;
        $this->porcentaje_actual = 0;
        $this->porcentaje_anterior = 0;
        $this->tiempo_minutos = 0;
        $this->detalle = "";

        $this->dispatchBrowserEvent('');
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
        ];
        $validate = $this->validate([
            'id_proyecto' => 'required',
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
