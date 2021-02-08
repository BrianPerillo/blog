<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $guarded = [];

    use HasFactory;

    //Rel 1:1 Polimórfica - 1 Img puede ser de 1 user o 1 post en particular entonces ===> morphTo();
    public function imageable(){
        return $this->morphTo(); //morphTo() para indicar que usamos esta tabla para crear una Rel Polimórfica.
    }

}
