<?php

namespace App\Http\Livewire;

use App\Unidad;
use Livewire\Component;

class Unidades extends Component
{
    public $id_unidad, $nombre, $busqueda;


    public function render()
    {
        $unidades = Unidad::where('nombre', 'LIKE', '%' . $this->busqueda . '%')->get();
        return view('livewire.unidades',compact('unidades'));
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

        Unidad::create([
            'nombre' => $this->nombre,
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);

        $this->id_unidad =  $unidad->id;
        $this->nombre =  $unidad->nombre;

    }

    public function update()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);


        $unidad = Unidad::findOrFail($this->id_unidad);
        $unidad->nombre = $this->nombre;
        $unidad->update();


        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }


}
