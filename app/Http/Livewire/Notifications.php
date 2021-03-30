<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;
use App\Models\Notification;

class Notifications extends Component
{

    public $notifications_ids = [];
    public $notifications = [];
    public $viewed = [];
    public $doesnt_viewed;

    public function mount()
    {
        //Guardo cantidad de notificaciones sin ver/nuevas para indicar el N° al lado de la campana
        foreach(auth()->user()->notifications as $notification){
            if($notification->viewed == false){
                array_push($this->viewed, "$notification->notificationable_id");
            }
        }
        
        $this->doesnt_viewed = sizeof($this->viewed); 
    }

    public function display_notifications(){

        //Limpio los arrays por si ya habían sido cargardo anteriormente (ya le había dado click a la campana):
            $this->notifications_ids = [];
            $this->notifications = [];
            $this->viewed = [];
            $this->doesnt_viewed = 0; 

        //Traigo los datos de las notificaciones: 
            //Consulto los ids de los posts que se encuentran en notifications y los guardo en el array posts_id:
                $user_id = auth()->user()->id;
                $this->notifications = Notification::where('user_id', '=', "$user_id")->get();

                // foreach(auth()->user()->notifications as $notification){
                //     array_push($this->notifications, "$notification");
                // }

            // //Traigo los datos de c/post y los guardo en el array notifications
            //     foreach($this->posts_id as $post_id){
            //         array_push($this->notifications, Post::where('id', '=', "$post_id")->first());
            //     }

            //Cambio valor de la columna viewed (de la tabla notifications) de 0 a 1 (false a true)
                foreach(auth()->user()->notifications as $notification){
                   $notification_viewed_true = Notification::where('id', '=', "$notification->id")->first();
                   $notification_viewed_true->viewed = true;
                   $notification_viewed_true->save();
                }
       
    }



    public function render()
    {            
         
        return view('livewire.notifications');
        
    }
}
