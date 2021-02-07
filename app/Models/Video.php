<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    //Relación 1:N(inversa) - Acceder a Posts desde User:
    public function user(){                    //user en singular porque un video pertenece a un usuario.
        return $this->belongsTo(User::class);  //Para Relación 1:N inversa se usa el belongsTo();
    } 
    

}
