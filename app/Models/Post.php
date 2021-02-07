<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//Relación 1:1 un post a un usuario = belongsTo() - Aunque a la inversa es 1:N, un user puede tener muchos Posts x es en Users es hasMany().
    public function user(){  //user en singular porque un post tiene un usuario.
        return $this->belongsTo(User::class);
    }

    //Relación 1:1 un post puede pertenecer a 1 categoría x ende usamos belongsTo()
    public function category(){ 
        return $this->belongsTo(Category::class);
    }
  
}
