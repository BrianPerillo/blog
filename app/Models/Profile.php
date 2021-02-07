<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //Acceder a Users desde Profile:
    public function user(){

        /*
        $user = User::find($this->user_id);

        return $user;
        */

        //Si bien se puede hacer como está arriba otra manera de conseguir el mismo resultado es la siguiente:

        //!! belognsTo para recuperar registros en Rels 1 a 1 desde la tabla débil, de perfil traer user:

        return $this->belongsTo(User::class);




    }

}
