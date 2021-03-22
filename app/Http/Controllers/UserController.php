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

        return view('user.profile', with(compact('user', 'lasts_posts')));

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

        return dd($creator);

    }

}
