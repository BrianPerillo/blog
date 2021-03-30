<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;
use App\Models\Answer;

class Comment extends Model
{
    use HasFactory;

    //Rel 1:N Polimórfica - 1 comment solo puede pertenecer a 1 video o a 1 post en particular entonces ===> morphTo().
    //!!!!CON ESTE MÉTODO PUEDO CONSULTAR A QUE POST O VIDEO (SEGÚN EL CASO) PERTENECE EL COMENTARIO!!!!
    public function commentable(){
        return $this->morphTo();    //morphTo() para indicar que usamos esta tabla para crear una Rel Polimórfica.
    }

    //Relación N:1 - 1 Comment puede pertenecer a 1 User
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    //Relación 1:1 - 1 comentario puede pertenecer a 1 post.
    public function post(){
        return $this->belongsTo(Post::class, 'commentable_id');
    }

}
