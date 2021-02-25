<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatForm extends Component
{

    public $nombre;
    public $mensaje;

    public function mount()
    {
       $this->nombre = ""; 
       $this->mensaje = "";
    }

    public function render()
    {
        return view('livewire.chat-form');
    }

    public function enviarMensaje()
    {
        //Envío un evento, esto se hace con emit:
        $this->emit("mensajeEnviado"); 
    }
}
