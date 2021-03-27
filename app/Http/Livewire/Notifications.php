<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;

class Notifications extends Component
{

    public $posts_id = [];
    public $notifications = [];

    public function display_notifications(){

        //Limpio los arrays por si ya habían sido cargardo anteriormente (ya le había dado click a la campana):
            $this->posts_id = [];
            $this->notifications = [];

        //Traigo los datos de los posts: 
            //Consulto los ids de los posts que hay que notificar y los guardo en el array posts_id:
                foreach(auth()->user()->notifications as $notification){
                    array_push($this->posts_id, "$notification->post_id");
                }
            //Traigo los datos de c/post
                foreach($this->posts_id as $post_id){
                    array_push($this->notifications, Post::where('id', '=', "$post_id")->first());
                }


        //Cargo las notificaciones:


       
    }



    public function render()
    {
        return view('livewire.notifications');
        
    }
}
