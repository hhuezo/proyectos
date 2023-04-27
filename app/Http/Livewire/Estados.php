<?php

namespace App\Http\Livewire;

use App\Estado;
use Livewire\Component;

class Estados extends Component
{
    public $id_estado, $nombre, $color, $prioridad, $busqueda;


    public function render()
    {
        $estados = Estado::where('nombre', 'LIKE', '%' . $this->busqueda . '%')->get();
        return view('livewire.estados',compact('estados'));
    }

    public function create()
    {
        $busqueda_tmp = $this->busqueda;
        $this->reset();
        $this->busqueda = $busqueda_tmp;
    }


    public function store()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);

        Estado::create([
            'nombre' => $this->nombre,
            'color' => $this->color,
            'prioridad' => $this->prioridad,
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $estado = Estado::findOrFail($id);

        $this->id_estado =  $estado->id;
        $this->nombre =  $estado->nombre;
        $this->color =  $estado->color;
        $this->prioridad =  $estado->prioridad;

    }

    public function update()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);


        $estado = Estado::findOrFail($this->id_estado);
        $estado->nombre = $this->nombre;
        $estado->color = $this->color;
        $estado->prioridad = $this->prioridad;
        $estado->update();


        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }


}
