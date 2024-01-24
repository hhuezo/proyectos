<?php

namespace App\Http\Livewire;

use App\Actividad;
use App\AreaActividad;
use App\AreaAdministrativa;
use App\catalogo\Propietario;
use App\CategoriaTicket;
use Livewire\Component;
use App\Estado;
use App\PrioridadTicket;
use App\Proyecto;
use App\ProyectoHistorial;
use App\Unidad;
use App\User;
use Carbon\Carbon;

class Proyectos extends Component
{
    public $id_proyecto = 0, $estado_id = 2, $nombre, $descripcion, $busqueda, $busqueda_actividad, $ponderacion_proyecto, $avance_proyecto;
    public $proyectos, $id_unidad, $actividades,$historial, $tipo = 1, $finalizado = 0, $modificado = 0,$fecha_inicio_proyecto,$fecha_fin_proyecto;

    public $id_actividad, $numero_ticket = 0, $ponderacion = 0.01, $descripcion_actividad,
        $fecha_inicio, $categoria_id, $estado_actividad_id, $prioridad_id, $prioridad, $fecha_fin, $forma = "NO APLICA", $users_id, $avance, $propietario_id = 1, $area_id;


    public $tab1 = 1, $tab2 = 0;


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
        $estados =  Estado::whereNotIn('id', [1,7,8])->get();
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
                'proyectos.finalizado',
                'proyectos.estado_id',
                'proyectos.prioridad',
                'proyectos.fecha_inicio',
                'proyectos.fecha_fin',
                'proyectos.propietario_id',
                \DB::raw('(select ifnull(sum((act.porcentaje/100) * act.ponderacion),0) from actividades act where act.proyecto_id = proyectos.id) as avance')
            )
            ->where('proyectos.unidad_id', '=', $this->id_unidad)
            ->where('proyectos.finalizado', '=', 0)
            ->where('proyectos.estado_id', '<>', 7)
            ->where('proyectos.estado_id', '>', 1)
            ->where('proyectos.estado_id', '<>', 8)
            ->where('proyectos.id', '<>', 28)
            ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy('proyectos.prioridad')
            ->orderBy('proyectos.id', 'desc')
            ->get();
         //   dd($this->proyectos);

        if ($this->id_proyecto != 0) {
            $this->actividades = Actividad::where('proyecto_id', '=', $this->id_proyecto)
                ->where('unidad_id', '=', $this->id_unidad)
                ->where('descripcion', 'LIKE', '%' . $this->busqueda_actividad . '%')
                ->orderBy('id', 'desc')
                ->get();

            $this->historial = ProyectoHistorial::where('proyecto_id','=',$this->id_proyecto)->get();
        }

        $propietarios = Propietario::where('activo','=',1)->get();

        $categorias = CategoriaTicket::where('unidad_id', '=', $this->id_unidad)->get();
        $prioridades = PrioridadTicket::get();
        $usuarios = User::where('id', '>', 1)->where('unidad_id', '=', $this->id_unidad)->get();


        $colors = ["", "#0dcaf0", "#F19828", "#0dcaf0", "#198754", "##0d6efd",  "#0d6efd", "#dc3545", "#dc3545"];
        $areas = AreaAdministrativa::where('id', '>', 0)->get();

        return view('livewire.proyectos', compact('estados', 'colors', 'unidad', 'categorias', 'prioridades', 'usuarios', 'estados_actividad','propietarios','areas'));
    }




    private function resetInput()
    {
        $this->id_proyecto = 0;
        $this->nombre = '';
        $this->descripcion = '';
        $this->estado_id = 2;
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
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
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_fin.required' => 'La fecha final es requerida',
            'propietario_id. required' => 'El Propietario es requerido',
        ];
        $validateData = $this->validate([
            'estado_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'propietario_id' => 'required',
        ], $messages);

        $proyecto = new Proyecto();
        $proyecto->estado_id = $this->estado_id;
        $proyecto->nombre = $this->nombre;
        $proyecto->descripcion = $this->descripcion;
        $proyecto->unidad_id = $this->id_unidad;
        $proyecto->avance = 0;
        $proyecto->fecha_inicio = $this->fecha_inicio;
        $proyecto->fecha_fin = $this->fecha_fin;
        $proyecto->propietario_id = $this->propietario_id;
        $proyecto->save();
        session()->flash('message', 'Registro creado correctamente');



        $historial = new ProyectoHistorial();
        $historial->proyecto_id = $proyecto->id;
        $historial->estado_id = $this->estado_id;
        $historial->nombre = $this->nombre;
        $historial->descripcion = $this->descripcion;
        $historial->unidad_id = $this->id_unidad;
        $historial->avance = 0;
        $historial->fecha_inicio = $this->fecha_inicio;
        $historial->fecha_fin = $this->fecha_fin;
        $historial->users_id = auth()->user()->id;
        $historial->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::select('id', 'nombre', 'descripcion', 'estado_id', 'prioridad', 'fecha_inicio', 'fecha_fin','propietario_id')->findOrFail($id);

        $this->actividades = Actividad::where('proyecto_id', '=', $id)->where('estado_id', '<>', 7)->get();

        $porcentaje = 0;

        foreach ($this->actividades as $actividad) {
            if ($actividad->ponderacion > 0) {
                $porcentaje += ($actividad->ponderacion / 100 * $actividad->porcentaje / 100) * 100;
            }
        }


        $this->ponderacion_proyecto = Actividad::where('proyecto_id', '=', $id)->where('estado_id', '<>', 7)->sum('ponderacion');
        $this->id_proyecto = $proyecto->id;
        $this->nombre = $proyecto->nombre;
        $this->descripcion = $proyecto->descripcion;
        $this->estado_id = $proyecto->estado_id;
        $this->propietario_id = $proyecto->propietario_id;

        $this->avance_proyecto = $porcentaje;
        $this->busqueda_actividad = "";
        $this->finalizado = $proyecto->finalizado;
        $this->prioridad = $proyecto->prioridad;

        $this->fecha_inicio_proyecto = $proyecto->fecha_inicio;
        $this->fecha_fin_proyecto = $proyecto->fecha_fin;

        $this->modificado = 0;
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



        // Actividad::create([
        //     'proyecto_id' => $this->id_proyecto,
        //     'numero_ticket' => $this->numero_ticket,
        //     'ponderacion' => $this->ponderacion,
        //     'descripcion' => strtoupper($this->descripcion_actividad),
        //     'fecha_inicio' => $this->fecha_inicio,
        //     'categoria_id' => $this->categoria_id,
        //     'estado_id' => $this->estado_actividad_id,
        //     'prioridad_id' => $this->prioridad_id,
        //     'fecha_fin' => $this->fecha_fin,
        //     'forma' => $this->forma,
        //     'users_id' => $this->users_id,
        //     'porcentaje' => 0.00,
        //     'unidad_id' => $this->id_unidad,
        //     'fecha_asignacion' => $time->toDateTimeString(),
        // ]);


        $actividad = new Actividad();
        $actividad->proyecto_id = $this->id_proyecto;
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
        $actividad->porcentaje = 0.00;
        $actividad->unidad_id = $this->id_unidad;
        $actividad->fecha_asignacion = $time->toDateTimeString();
        $actividad->save();


        if (auth()->user()->unidad_id == 9) { //auditoria interna
            $area_id = $this->area_id;

            $area_actividad = new AreaActividad();
            $area_actividad->area_id = $area_id;
            $area_actividad->actividad_id = $actividad->id;
            $area_actividad->save();

        }

        $this->edit($this->id_proyecto);

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


        $area_actividad = AreaActividad::where('actividad_id','=',$id)->get()->first();

        if ($area_actividad) {
            $this->area_id = $area_actividad->area_id;
        }else{
            $this->area_id = "";
        }


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




        if (auth()->user()->unidad_id == 9) {
            $area_actividades = AreaActividad::where('actividad_id', '=', $actividad->id)->get();

            if ($area_actividades->count() > 0) {
                foreach ($area_actividades as $area_actividad) {
                    $area_act = AreaActividad::findOrFail($area_actividad->id);
                    $area_act->area_id = $this->area_id;
                    $area_act->update();
                }
            } else {
                    $area_new = new AreaActividad();
                    $area_new->actividad_id = $actividad->id;
                    $area_new->area_id = $this->area_id;
                    $area_new->save();
            }

        }






        $proyecto = Proyecto::select(\DB::raw('(select ifnull(sum((act.porcentaje/100) * act.ponderacion),0) from actividades act where act.proyecto_id = proyectos.id) as porcentaje'))
            ->findOrFail($actividad->proyecto_id);
        $this->ponderacion_proyecto = Actividad::where('proyecto_id', '=', $actividad->proyecto_id)->sum('ponderacion');
        $this->avance_proyecto = $proyecto->porcentaje;

        $this->dispatchBrowserEvent('close-modal-edit-actividad');
    }

    public function finalizar_proyecto()
    {
        $proyecto = Proyecto::findOrFail($this->id_proyecto);
        $proyecto->finalizado = 1;
        $proyecto->update();

        //186
        $this->finalizado = 1;

        $historial = new ProyectoHistorial();
        $historial->proyecto_id = $proyecto->id;
        $historial->estado_id = $proyecto->estado_id;
        $historial->nombre = $proyecto->nombre;
        $historial->descripcion = $proyecto->descripcion;
        $historial->prioridad = $proyecto->prioridad;
        if ($proyecto->fecha_inicio_proyecto != null) {
            $historial->fecha_inicio = $proyecto->fecha_inicio_proyecto;
        }

        if ($proyecto->fecha_fin_proyecto != null) {
            $historial->fecha_fin = $proyecto->fecha_fin_proyecto;
        }
        $historial->users_id = auth()->user()->id;
        $historial->avance = $proyecto->avance;
        $historial->unidad_id = auth()->user()->unidad_id;
        $historial->finalizado = 1;
        $historial->save();


        $this->dispatchBrowserEvent('hide-proyecto');
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
        $proyecto->prioridad = $this->prioridad;
        $proyecto->fecha_inicio = $this->fecha_inicio_proyecto;
        $proyecto->fecha_fin = $this->fecha_fin_proyecto;
        $proyecto->propietario_id = $this->propietario_id;
        $proyecto->update();


        $historial = new ProyectoHistorial();
        $historial->proyecto_id = $proyecto->id;
        $historial->estado_id = $this->estado_id;
        $historial->nombre = $this->nombre;
        $historial->descripcion = $this->descripcion;
        $historial->prioridad = $this->prioridad;
        $historial->fecha_inicio = $this->fecha_inicio_proyecto;
        $historial->fecha_fin = $this->fecha_fin_proyecto;
        $historial->users_id = auth()->user()->id;
        $historial->avance = $proyecto->avance;
        $historial->unidad_id = auth()->user()->unidad_id;
        $historial->propietario_id = $this->propietario_id;
        $historial->save();


        $this->modificado = 1;
    }


    public function show_callapse_tab($id)
    {
        if ($id == 1) {
            if ($this->tab1 == 1) {
                $this->tab1 = 0;
            } else {
                $this->tab1 = 1;
            }
        }


        if ($id == 2) {
            if ($this->tab2 == 1) {
                $this->tab2 = 0;
            } else {
                $this->tab2 = 1;
            }
        }
    }
}
