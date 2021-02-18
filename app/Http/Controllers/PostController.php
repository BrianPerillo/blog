<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Answer;

class PostController extends Controller
{

    public function posts(){
        $posts = Post::orderBy('id', 'DESC')->get()->all();
        return view('dashboard', compact('posts'));
    }

    public function posts_user($name){

        $user = User::find(auth()->user()->id);
        $posts = $user->posts()->get()->all();

        return view('user.posts', compact('posts'));
    }

    public function show($id, $post){
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create(){
        $categorias = Category::get()->all();
        return view('posts.create', compact('categorias'));
    }

    public function store(Request $request){

        $request->validate([                
            'name' => 'required|max:10',
            'body' => 'required|min:5',
            'category' => 'required',
            'cover' => 'required'
        ]);
        
        $post = new Post();
        
        $post->name = "$request->name";
        $post->body = "$request->body";
        $post->category_id = "$request->category";
        $post->user_id = "$request->user_id";
        $post->save();

        $id_post = auth()->user()->last_post()->id;

        $cover = new Image();
        $cover->url = "$request->cover_url";
        $cover->imageable_id = "$id_post";
        $cover->imageable_type = "App\Models\Post";
        $cover->save();

        return redirect()->route('posts.show', [$post->id, $post->name]);
        
    }

    
    public function edit(Post $post){
        return view('posts.edit')->with(compact('post'));
    }

    public function update(Request $request, Post $post){

        $request->validate([                
            'name' => 'required|max:10',
            'body' => 'required|min:5',
            'category' => 'required'
        ]);
        
        $post->name = "$request->name";
        $post->body = "$request->body";
        $post->category_id = "$request->category";
        $post->save();

        return redirect()->route('posts.show', [$post->id, $post->name]);
        
    }

    
    public function destroy(Post $post){

        $post->delete();
        return redirect()->route('dashboard');
    }

    public function store_comment(Post $post, Request $request){

        $comment = new Comment();

        $comment->message = "$request->comment";
        $comment->commentable_id = "$post->id";
        $comment->commentable_type = "App\Models\Post";
        $comment->user_id = auth()->user()->id; //Este dato al ser un DATO SENSIBLE aunque podría pasarlo la vista con un input hidden directamente lo pide el Controller
        $comment->save();

        return redirect()->route('posts.show', [$post->id, $post->name]);
    }

    public function store_answer(Post $post, Comment $comment, Request $request){

        $answer = new Answer();

        $answer->body = "$request->answer";
        $answer->user_id = auth()->user()->id; //Este dato al ser un DATO SENSIBLE aunque podría pasarlo la vista con un input hidden directamente lo pide el Controller
        $answer->comment_id = "$comment->id";
        $answer->save();

        return redirect()->route('posts.show', [$post->id, $post->name]);
    }


}
