<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    //Relación 1:1 - 1 Respuesta puede pertenecer a un comentario
    //NOTA: AL SABER A QUE COMMENT PERTENECE PUEDO SABER A LA VEZ EN QUE POST SE ENCUENTRA PORQUE SE LO PUEDO PREGUNTAR AL COMENT.
    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    //Relación 1:1 - 1 Respuesta puede pertenecer a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

}
