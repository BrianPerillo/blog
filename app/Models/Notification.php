<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\Comment;

class Notification extends Model
{
    use HasFactory;

    public function notificationable(){
        return $this->morphTo();    //morphTo() para indicar que usamos esta tabla para crear una Rel Polimórfica.
    }


}
