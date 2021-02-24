<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;

class LikeComponent extends Component
{

    public Post $post;
    public Like $registro_like;

    public function render()
    {

        return view('livewire.like-component');
    }

    public function add_like()
    {   

        $user_id = auth()->user()->id;
        $post_id = $this->post->id;
        $like_preexistente = Like::where("post_id", "=", "$post_id")->where("user_id","=","$user_id")->get()->all();

        //Si ese usuario  no tiene registrado un like a este post:
        if(sizeof($like_preexistente)<1){
            //Guardo el registro de Like:
            $like = new Like;

            $like->post_id = $this->post->id;
            $like->user_id = $user_id;
            $like->save();

            //Aumento en 1 la cantidad de likes del post - (Columna like de tabla Posts).
            $likes = $this->post->likes;
            $this->post->likes = $likes+1;
            $this->post->save();
        }
        else{
            $registro_like = Like::where("post_id", "=", "$post_id")->where("user_id","=","$user_id");
            $registro_like->delete();
            $likes = $this->post->likes;
            $this->post->likes = $likes-1;
            $this->post->save();
        }


       
    }

}
