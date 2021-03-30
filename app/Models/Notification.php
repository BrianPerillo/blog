<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\Comment;

class Notification extends Model
{
    use HasFactory;

    public function notificationable(){ // Este método si se lo usamos a una notificación (Ej: $notification->notificationable) al indicar rel polimórfica mediante
                                        // el morphTo lo que hace es detectar el type, es decir, si se trata de un Comentario o de un Post y entonces trae los datos
                                        // de ese post o comentario según el caso. 
        return $this->morphTo();    //morphTo() para indicar que usamos esta tabla para crear una Rel Polimórfica.
    }


}
