<?php

namespace App\Http\Livewire;

use App\Rol;
use Livewire\Component;

class Roles extends Component
{
    public $id_rol, $nombre, $busqueda;


    public function render()
    {
        $roles = Rol::where('nombre', 'LIKE', '%' . $this->busqueda . '%')->get();
        return view('livewire.roles',compact('roles'));
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

        Rol::create([
            'nombre' => $this->nombre,
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $rol = Rol::findOrFail($id);

        $this->id_rol =  $rol->id;
        $this->nombre =  $rol->nombre;

    }

    public function update()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);


        $rol = Rol::findOrFail($this->id_rol);
        $rol->nombre = $this->nombre;
        $rol->update();


        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }


}
