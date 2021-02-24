<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;
use App\Models\Like;

class LikeComponent extends Component
{

    public $post;

    public function render()
    {
        return view('livewire.like-component',['post']);
    }

    public function add_like()
    {   

        $this->post->likes = 5;
        $this->post->save();
       
    }

}
