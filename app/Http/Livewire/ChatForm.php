<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\EnviarMensaje;

class ChatForm extends Component
{

    public $usuario;
    public $mensaje;

    public function mount()
    {
        $this->usuario = "";
        $this->mensaje = "";
    }

    public function render()
    {
        return view('livewire.chat-form');
    }

    public function updated($field)
    {
        // Solo validamos el campo que genera el update
        $validatedData = $this->validate([
            'usuario' => 'required',
            'mensaje' => 'required',
        ]);
    }


    public function enviarMensaje()
    {
        $this->validate([
            "usuario" => "required|min:3",
            "mensaje" => "required"
        ]);


        $this->emit('mensajeEnviado');

        $datos = [
            "usuario" => $this->usuario,
            "mensaje" => $this->mensaje
        ];

        $this->emit("mensajeRecibido", $datos);
        
        event(new \App\Events\EnviarMensaje($this->usuario, $this->mensaje));

        



        
    }
    
}

