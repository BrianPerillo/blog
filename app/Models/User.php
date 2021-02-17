<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Profile;
use App\Models\Post;
use App\Models\Video;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Answer;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Relación 1 a 1 - Acceder a Profiles desde User:
    public function profile(){  
        
        /*$profile = Profile::where('user_id', $this->id)->first();
        return $profile;*/

        //Si bien se puede hacer como está arriba otra manera de conseguir el mismo resultado es la siguiente:

        //!!! hasOne para rels 1 a 1 y recuperar registro desde tabla fuerte a tabla debil, de user traer perfil:

        return $this->hasOne(Profile::class); //el hasOne se usa para Rels 1 a 1, asume esa rel y se encarga de todo el sql para traer
                                              //el registro correspondiente. Funciona gracas a seguir las convenciones como que la clave
    }                                         //primaria sea un id integer automático y no por ej un dato como email o que la foránea
                                              //es user_id. Si no seguimos la convención y no la llamamos user_id, tendríamos que
                                              //pasarle un segundo parámetro con el nombre de la columno ej:(Profil::class,'foreign_key');
                                              //y lo mismo para el id el cuál sería el 3er parámetro ej:(Profil::class,'foreign_key','key');

    //Relación 1:N - Acceder a Posts desde User:
    public function posts(){                //posts en plural porque un usuario puede tener muchos posts.
        return $this->hasMany(Post::class); //Para Relación 1:N se usa el hasMany() de un lado y el belongsTo() del otro.
    }
    
    public function last_post(){                
        return $this->hasMany(Post::class)->orderBy('id', 'DESC')->first();
    }

    //Relación 1:N - Acceder a Videos desde User:
    public function videos(){                //videos en plural porque un usuario puede tener muchos videos.
        return $this->hasMany(Video::class); //Para Relación 1:N se usa el hasMany() de un lado y el belongsTo() del otro.
    } 

    //Relación N:N - Acceder a Roles de un Usuario:
    public function roles(){            //En este caso el método que usamos de ambos lados es belongsToMany()
        return $this->belongsToMany(Role::class);
    }

    //Relación 1:1 Polimórfica - 1 user puede tener 1 img entonces ===> morphOne();
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
  
    //Relación 1:N - 1 User puede tener/realizar N Comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Relación 1:N - 1 User puede tener/realizar N Respuestas
    public function answers(){
        return $this->hasMany(Answer::class);
    }

}
