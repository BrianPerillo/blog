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

    //Relación 1:1 Polimórfica - 1 post puede tener 1 img entonces ===> morphOne();
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    //Relación 1:N Polimórfica - 1 post puede tener N comments, entonces ===> morphMany();
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->orderBy('id', 'DESC');
    }
    
}
