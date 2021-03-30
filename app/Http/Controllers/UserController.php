<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Notification;


class UserController extends Controller
{

    public function user_profile(User $user){

        $lasts_posts = Post::where('user_id', '=', "$user->id")->orderBy('id', 'DESC')->limit(3)->get()->all(); 

        if(auth()->user()){

            $user_id = auth()->user()->id;
                    // Consulto si el usuario ya se encuentra suscrito al perfil del creador, si la consulta no trae resultados es porque no está suscrito.
            $subscription = Subscription::where('subscriber_id', '=', "$user_id")->where('creator_id', '=', "$user->id")->get()->all();
            // creo variable booleana según esté suscrito o no para que la vista elija el formulario a mostrar (Suscribirme o Desuscribirme)
            if(sizeof($subscription)>0){
                $esta_subscripto = true;
            }
            else{
                $esta_subscripto = false;
            }

        }
        else{
            $esta_subscripto = null;
        }



        // if(){

        // }

        return view('user.profile', with(compact('user', 'lasts_posts', 'esta_subscripto')));

    }

    public function posts_user(User $user){

        if(User::find(auth()->user()) && auth()->user()->id == $user->id){
            $posts = $user->posts()->orderBy('id','DESC')->paginate(7);
            $authorized = true;
            return view('user.posts', with(compact('posts', 'user', 'authorized')));
        }
        else{
            $posts = $user->posts()->get()->all();
            $authorized = false;
            return view('user.posts', with(compact('posts', 'user', 'authorized')));
        }

        
    }

    public function favoritos_user(User $user){

        $posts = $user->posts_likes()->paginate(7);

        return view('user.favoritos', with(compact('posts', 'user')));

    }

    public function user_subscribe(User $subscriber, User $creator){

        $subscription = new Subscription;

        $subscription->subscriber_id = $subscriber->id; 
        $subscription->creator_id = $creator->id; 
        $subscription->save();

        return redirect()->back();

    }

    public function user_unsubscribe(User $subscriber, User $creator){

        $subscription = Subscription::where('subscriber_id', '=', "$subscriber->id")->where('creator_id', '=', "$creator->id")->first();
        $subscription->delete();

        return redirect()->back();

    }

}
