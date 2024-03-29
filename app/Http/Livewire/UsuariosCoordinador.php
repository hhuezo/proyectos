<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class UsuariosCoordinador extends Component
{
    public $busqueda;
    public function render()
    {
        $usuarios = User::whereNotIn('id', [1, 3, 6, 7, 25,13])->where('unidad_id', '=', auth()->user()->unidad_id)
            //->where('user_name', 'like', '%' . $this->busqueda . '%')
            ->where('name', 'like', '%' . $this->busqueda . '%')
            ->get();
        return view('livewire.usuarios-coordinador', compact('usuarios'));
    }
}
