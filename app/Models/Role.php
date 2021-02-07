<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

        //Relación N:N - Acceder a Usuarios de un Rol:
        public function roles(){         //En este caso (N:N) el método que usamos de ambos lados es belongsToMany()
            return $this->belongsToMany(User::class);
        }

        //Relación N:N - Acceder a Permisos de un Rol:
        public function permissions(){         //En este caso (N:N) el método que usamos de ambos lados es belongsToMany()
            return $this->belongsToMany(Permission::class);
        }

        
}
