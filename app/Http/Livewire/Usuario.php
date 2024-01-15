<?php

namespace App\Http\Livewire;

use App\Rol;
use App\Unidad;
use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Usuario extends Component
{
    public $busqueda, $user_id, $name, $user_name, $email, $password, $rol_id, $unidad_id,$usuario_base_datos;
    public function render()
    {
        $usuarios = User::where('name', 'LIKE', '%' . $this->busqueda . '%')
            ->orWhere('user_name', 'LIKE', '%' . $this->busqueda . '%')->orderBy('id','desc')->get();
        $roles = Rol::get();
        $unidades = Unidad::get();
        return view('livewire.usuario', compact('usuarios', 'roles', 'unidades'));
    }

    public function create()
    {
        $this->reset();
    }


    public function store()
    {
        //dd($this->usuario_base_datos);
        $messages = [
            'name.required' => 'El nombre es requerido',
            'user_name.required' => 'El usuario es requerido',
            'user_name.unique' => 'El usuario ingresado ya existe',
            'email.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
            'rol_id.required' => 'El rol es requerido',
            'unidad_id.required' => 'La unidad es requerida',
        ];
        $validate = $this->validate([
            'name' => 'required',
            'user_name' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',
            'rol_id' => 'required',
            'unidad_id' => 'required',
        ], $messages);

        User::create([
            'name' => $this->name,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'rol_id' => $this->rol_id,
            'unidad_id' => $this->unidad_id
        ]);


        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-alert');
        $this->reset();
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        $this->user_id =  $usuario->id;
        $this->name =  $usuario->name;
        $this->user_name =  $usuario->user_name;
        $this->email =  $usuario->email;
        $this->rol_id =  $usuario->rol_id;
        $this->unidad_id =  $usuario->unidad_id;
        $this->usuario_base_datos =  $usuario->usuario_base_datos;
    }

    public function update()
    {
        $messages = [
            'name.required' => 'El nombre es requerido',
            'user_name.required' => 'El usuario es requerido',
            'email.required' => 'El correo es requerido',
            'rol_id.required' => 'El rol es requerido',
            'unidad_id.required' => 'La unidad es requerida',
        ];
        $validate = $this->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'rol_id' => 'required',
            'unidad_id' => 'required',
        ], $messages);

        $usuario = User::findOrFail($this->user_id);
        $usuario->name = $this->name;
        $usuario->user_name = $this->user_name;
        $usuario->email = $this->email;
        $usuario->rol_id = $this->rol_id;
        $usuario->unidad_id = $this->unidad_id;
        $usuario->usuario_base_datos = $this->usuario_base_datos;
        $usuario->update();


        $this->dispatchBrowserEvent('close-modal-edit');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }

    public function reset_pass()
    {
        $messages = [
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ];
        $validate = $this->validate([
            'password' => 'required|min:6',
        ], $messages);

        $usuario = User::findOrFail($this->user_id);
        $usuario->password = Hash::make($this->password);
        $usuario->update();

        $this->dispatchBrowserEvent('close-modal-reset');
        $this->dispatchBrowserEvent('success-alert-edit');
        $this->reset();
    }

}
