<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Estado;
use App\Proyecto;

class Proyectos extends Component
{
    public $id_proyecto = 0, $estado_id = 2, $nombre, $descripcion, $busqueda;
    public $proyectos;
    public function render()
    {
        $estados =  Estado::where('id', '<>', 7)->where('id', '>', 1)->get();

        if (strlen($this->busqueda) > 0) {
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
                ->where('proyectos.nombre', 'LIKE', '%' . $this->busqueda . '%')
                ->orWhere('proyectos.id', 'LIKE', '%' . $this->busqueda . '%')
                ->where('proyectos.unidad_id', '=', auth()->user()->unidadId())
                ->where('proyectos.finalizado','=',0)
                ->where('proyectos.estado_id', '<>', 7)
                ->where('proyectos.estado_id', '>', 1)
                ->where('proyectos.id', '<>', 28)
                ->orderBy('proyectos.id', 'desc')
                ->get();
        }
        else{

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
            ->where('proyectos.unidad_id', '=', auth()->user()->unidadId())
            ->where('proyectos.finalizado','=',0)
            ->where('proyectos.estado_id', '<>', 7)
            ->where('proyectos.estado_id', '>', 1)
            ->where('proyectos.id', '<>', 28)
            ->orWhere('proyectos.id', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy('proyectos.id', 'desc')
            ->get();

        }

        $colors = ["","planned_task","review_task","progress_task","completed_task","completed_task","planned_task"];

        return view('livewire.proyectos', compact('estados','colors'));
    }


    private function resetInput(){
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
        ],$messages);

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
        ],$messages);

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
        return redirect()->to('proyecto/' . $id);
    }
}
