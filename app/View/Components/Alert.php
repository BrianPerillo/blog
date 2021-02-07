<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    public $tipo;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($tipo='primary', $title='Holy guacamole!')//Los atributos que comportan todos los elementos son los que recibirá el constructor
    {
        $this->tipo = $tipo;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }

    public function txt(){
        if($this->tipo == 'primary'){
            return "Este es un mensaje de alerta";
        }
    }

}
