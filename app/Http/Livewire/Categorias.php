<?php

namespace App\Http\Livewire;

use App\CategoriaTicket;
use Livewire\Component;

class Categorias extends Component
{
    public $id_categoria, $codigo, $nombre, $unidad_id, $busqueda;


    public function render()
    {
        $categorias = CategoriaTicket::where('nombre', 'LIKE', '%' . $this->busqueda . '%')->get();
        return view('livewire.categorias',compact('categorias'));
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

        CategoriaTicket::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'unidad_id' => $this->unidad_id
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $categoria = CategoriaTicket::findOrFail($id);

        $this->id_categoria =  $categoria->id;
        $this->codigo =  $categoria->codigo;
        $this->nombre =  $categoria->nombre;
        $this->unidad_id =  $categoria->unidad_id;

    }

    public function update()
    {
        $messages = [
            'nombre.required' => 'El nombre es requerido',
        ];
        $validate = $this->validate([
            'nombre' => 'required',
        ], $messages);

        $categoria = CategoriaTicket::findOrFail($this->id_categoria);
        $categoria->codigo = $this->codigo;
        $categoria->nombre = $this->nombre;
        $categoria->unidad_id = $this->unidad_id;
        $categoria->update();

        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }


}
