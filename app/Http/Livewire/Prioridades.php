<?php

namespace App\Http\Livewire;

use App\PrioridadTicket;
use Livewire\Component;

class Prioridades extends Component
{
    public $id_prioridad, $nombre, $color, $busqueda;


    public function render()
    {
        $prioridades = PrioridadTicket::where('nombre', 'LIKE', '%' . $this->busqueda . '%')->get();
        return view('livewire.prioridades',compact('prioridades'));
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

        PrioridadTicket::create([
            'nombre' => $this->nombre,
            'color' => $this->color,
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $prioridad = PrioridadTicket::findOrFail($id);

        $this->id_prioridad =  $prioridad->id;
        $this->nombre =  $prioridad->nombre;
        $this->color =  $prioridad->color;

    }

    public function update()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);


        $prioridad = PrioridadTicket::findOrFail($this->id_prioridad);
        $prioridad->nombre = $this->nombre;
        $prioridad->color = $this->color;
        $prioridad->update();


        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }


}
