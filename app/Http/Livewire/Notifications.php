<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;

class Notifications extends Component
{

    public $posts_id = [];
    public $notifications = [];
    public $viewed = [];
    public $doesnt_viewed;

    public function display_notifications(){

        //Limpio los arrays por si ya habían sido cargardo anteriormente (ya le había dado click a la campana):
            $this->posts_id = [];
            $this->notifications = [];
            $this->viewed = [];
            $this->doesnt_viewed = 0; 

        //Traigo los datos de los posts: 
            //Consulto los ids de los posts que hay que notificar y los guardo en el array posts_id:
                foreach(auth()->user()->notifications as $notification){
                    array_push($this->posts_id, "$notification->post_id");
                    // if($notification->viewed == 0){
                       
                    // }
                }

            //Traigo los datos de c/post
                foreach($this->posts_id as $post_id){
                    array_push($this->notifications, Post::where('id', '=', "$post_id")->first());
                }


        //Cargo las notificaciones:


       
    }



    public function render()
    {
        
        //Guardo cantidad de notificaciones sin ver/nuevas para indicar el N° al lado de la campana
        foreach(auth()->user()->notifications as $notification){
            if($notification->viewed == 0){
                array_push($this->viewed, "$notification->post_id");
            }
        }
        
        $this->doesnt_viewed = sizeof($this->viewed);  

        return view('livewire.notifications');
        
    }
}
