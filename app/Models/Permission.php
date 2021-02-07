<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

class Permission extends Model
{
    use HasFactory;

        //Relación N:N - Acceder a Roles de Permiso:
        public function roles(){         //En este caso (N:N) el método que usamos de ambos lados es belongsToMany()
            return $this->belongsToMany(Role::class);
        }
}
