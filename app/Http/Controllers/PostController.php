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

    public function posts_filtrados(Request $request){

        // Consultas para el search
        if(isset($request->search)){

            // Por Autor
            $users = User::where("name","like","%$request->search%")->get()->all();

            $posts_array=[];

            foreach($users as $user){
                array_push($posts_array, $user->posts()->get()->all());
            }

            if(sizeof($posts_array)>0){
                return view('dashboard', compact('posts_array'));
            }

            // Por titulo (name)
            $posts = Post::where("name","like","%$request->search%")->get()->all();

            if(sizeof($posts)>0){
                return view('dashboard', compact('posts'));
            }

            // Por Categoría
            $categoria = Category::where("name","=","$request->search")->get()->all(); //Si bien tiene all() siempre va a traer una sola categoría (where con "=")
                                                                                       //siempre va a traer un solo resultado, pero igual uso all() en lugar de first()
            if(sizeof($categoria)>0){                                                  //para que el dato lo guarde dentro de un array, y esto lo hago para poder
                $posts = $categoria[0]->posts()->get()->all();                         //user el sizeof luego ya que solo funcionar con arrays o ciertos objetos.
                if(sizeof($posts)>0){                                                  //el first devuelve un resultado al que no se le puede consultar sizeof.
                    return view('dashboard', compact('posts'));
                }
            }


            //En caso de no entcontrar resultados:
            return view('dashboard');
            

        }

        else{
            $request->simbolo = "=";
            // En caso que no llegue $request->fecha porque clickearon otro filtro entonces le doy un valor por defecto
            if(!isset($request->fecha)){
                $request->fecha = "DESC";
            }
            if(!isset($request->categoria)){
                $request->categoria = "0";
                $request->simbolo = ">=";
            }
            if(!isset($request->tag)){
                $request->tag = "%%";
            }
            
            // Consulta para filtros del menú desplegable
            $posts = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('id', "$request->fecha")->get()->all(); //Tiene que ser la mas compleja posible para reemplazar los datos
            
            return view('dashboard', compact('posts'));
        }
        
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

        //los tags llegan en un string separados por coma(tag1,tag2,tag3) para convertir eso en un array donde cada palabra ocupe una posición se utiliza explode().
        //return var_dump(explode(",",$request->tag_2));
        //NOTA!: No hace falta igualmente, ya que lo más conveniente es que se guarden así como string en una columna "tags" dentro de la tabla post
        //       ya que cuando se filtre por tag se usará el LIKE %nombre_tag% y por ende da igual que sea todo un solo string con comas

        $request->validate([                
            'name' => 'required|max:10',
            'body' => 'required|min:5',
            'category' => 'required',
            //'cover' => 'required'
        ]);
        
        $post = new Post();
        
        $post->name = "$request->name";
        $post->body = "$request->body";
        $post->category_id = "$request->category";
        $post->user_id = "$request->user_id";
        $post->tags = "$request->tag_2"; 
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
