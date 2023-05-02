<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class UsuariosCoordinador extends Component
{
    public $busqueda;
    public function render()
    {
        $usuarios = User::whereNotIn('id', [1, 3, 6, 7, 25])->where('unidad_id', '=', auth()->user()->id)
            ->where('user_name', 'like', '%' . $this->busqueda . '%')
            ->orWhere('name', 'like', '%' . $this->busqueda . '%')
            ->get();
        return view('livewire.usuarios-coordinador', compact('usuarios'));
    }
}
