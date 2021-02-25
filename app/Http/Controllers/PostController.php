<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Answer;
use App\Models\Like;

class PostController extends Controller
{

    public function posts(){
        $posts = Post::orderBy('id', 'DESC')->offset(0)->limit(15)->get();
        $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
        return view('dashboard', with(compact('posts', 'masonry_results')));
    }

    public function posts_filtrados(Request $request){
        
        // Establezco valores por defecto:
            
            $masonry_results=1;
            $request->simbolo = "=";
            if(!isset($request->fecha)){
                
            }
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
            $offset=0;

        //Cambiar de Página
        if(isset($request->offset)){
            $offset = $request->offset;
            $disabled = false; //Si cambia a true se desabilitará el button siguiente en la vista.

            $resultados = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('id', "$request->fecha")->get()->all();
            $cantidad_resultados = sizeof($resultados);
            if($offset>$cantidad_resultados){
                $offset=$cantidad_resultados-1;
                $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
            }
            if($cantidad_resultados<12){
                $offset=0;
                $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
            }
            $posts = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('id', "$request->fecha")->offset($offset)->limit(12)->get(); 
            $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
            return view('dashboard', with(compact('posts','masonry_results','disabled')));
        }

        // Consultas para el search
        if(isset($request->search)){
            
            // Por Autor

                $users = User::where("name","like","%$request->search%")->offset($offset)->limit(12)->get();

                //Compruebo si trajo resultados:
                if(sizeof($users)>0){

                    //Corroboro la cantidad total de resultados para en caso de ser menor a 12 desabilitar el button de siguiente
                        $disabled = false;

                        $resultados = User::where("name","like","%$request->search%")->get()->all();
                        $cantidad_resultados = sizeof($resultados);
                        if($cantidad_resultados<12){
                            $offset=0;
                            $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
                        }
                        if($request->categoria!==0 || $request->fecha == 'ASC' || $request->fecha == 'DESC' || $request->fecha == 'asc' || $request->fecha == 'desc'){
                            $categoria = $request->categoria;
                            $fecha = $request->fecha;
                            $search=$request->search;
                        }
                    //Se lo paso a la vista:
                    $masonry_results=sizeOf($users);//Cantidad de resultados para calcular el height estimativo del masonry.
                    return view('dashboard', with(compact('users','search', 'masonry_results','disabled')));
                }

            // Por titulo (name)  - Tengo que pdrile que primero busque x nombre y desp x tags, sin los traen resultados $EstanLosDos = true y hace una
                                //  nueva búsqueda por ambos where name y where tags orderBy categoria alfabético sino están los 2 hace la búsqueda por
                                //  el que haya
                $posts = Post::where("category_id","$request->simbolo","$request->categoria")
                    ->where("name","like","%$request->search%")
                    ->orwhere("tags", "like", "%$request->search%")
                    ->orderBy('id', "$request->fecha")
                    ->offset($offset)
                    ->limit(12)
                    ->get();

                if(sizeof($posts)>0){
                    //Corroboro la cantidad total de resultados para en caso de ser menor a 12 desabilitar el button de siguiente
                        $disabled = false;
                        
                        $resultados = Post::where("category_id","$request->simbolo","$request->categoria")->where("name","like","%$request->search%")->orwhere("tags", "like", "%$request->search%")->orderBy('id', "$request->fecha")->get()->all();
                        $cantidad_resultados = sizeof($resultados);
                        if($cantidad_resultados<12){
                            $offset=0;
                            $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
                        }
                                                            
                    if($request->categoria!==0 || $request->fecha == 'ASC' || $request->fecha == 'DESC' || $request->fecha == 'asc' || $request->fecha == 'desc'){
                        $categoria = $request->categoria;
                        $fecha = $request->fecha;
                        $search=$request->search;
                    }
                    $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
                    return view('dashboard', with(compact('posts', 'categoria', 'fecha', 'search', 'masonry_results','disabled')));
                }

            // Por Categoría
                $categoria = Category::where("name","=","$request->search")->get()->all(); 
                //Si bien tiene all() siempre va a traer una sola categoría (where con "=")                                                                        
                //siempre va a traer un solo resultado, pero igual uso all() en lugar de first()                  
                //para que el dato lo guarde dentro de un array, y esto lo hago para poder                  
                //user el sizeof luego ya que solo funcionar con arrays o ciertos objetos.      
                //el first devuelve un resultado al que no se le puede consultar sizeof.

                if(sizeof($categoria)>0){
                    $disabled = false;
                    
                    $resultados = $categoria[0]->posts()->orderBy('id', "$request->fecha")->get()->all();   
                    $cantidad_resultados = sizeof($resultados);
                    if($cantidad_resultados<12){
                        $offset=0;
                        $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
                    }

                    $posts = $categoria[0]->posts()->orderBy('id', "$request->fecha")->offset($offset)->limit(12)->get();                         
                    if(sizeof($posts)>0){                                                 
                                                                
                        if($request->categoria!==0 || $request->fecha == 'ASC' || $request->fecha == 'DESC' || $request->fecha == 'asc' || $request->fecha == 'desc'
                            ){
                            $categoria = $request->categoria;
                            $fecha = $request->fecha;
                            $search=$request->search;
                        }
                        $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.

                        return view('dashboard', with(compact('posts', 'categoria', 'fecha', 'search','masonry_results','disabled')));

                    }
                }

            // Por tags 
                $posts = Post::where("tags","like","%$request->search%")->where("category_id","$request->simbolo","$request->categoria")->orderBy('id', "$request->fecha")->offset($offset)->limit(12)->get();

                if(sizeof($posts)>0){
                    $disabled = false;
                    
                    $resultados = $posts = Post::where("tags","like","%$request->search%")->where("category_id","$request->simbolo","$request->categoria")->orderBy('id', "$request->fecha")->get()->all(); 
                    $cantidad_resultados = sizeof($resultados);
                    if($cantidad_resultados<12){
                        $offset=0;
                        $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
                    }
                                        
                    if($request->categoria!==0 || $request->fecha == 'ASC' || $request->fecha == 'DESC' || $request->fecha == 'asc' || $request->fecha == 'desc'){
                        $categoria = $request->categoria;
                        $fecha = $request->fecha;
                        $search=$request->search;
                    }
                    $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
                    return view('dashboard', with(compact('posts', 'categoria', 'fecha', 'search','masonry_results', 'disabled')));
                }

                //En caso de no entcontrar resultados:
                return view('dashboard', compact('masonry_results'));
            
        }


        // Consulta para filtros del menú desplegable
        else{
                //Si filtro por likes la consulta es otra, se reemplaza el orderBy id por orderBy Likes
                $like_activo = false;

                if(isset($request->like)){
                    $posts = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('likes', "$request->like")->offset($offset)->limit(12)->get(); //Tiene que ser la mas compleja posible para reemplazar los datos
                    $like_activo = true;
                }

                else{
                    $posts = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('id', "$request->fecha")->offset($offset)->limit(12)->get(); //Tiene que ser la mas compleja posible para reemplazar los datos
                }
            
                if(sizeof($posts)>0){

                     //Corroboro la cantidad total de resultados para en caso de ser menor a 12 desabilitar el button de siguiente
                        $disabled = false;
        
                        $resultados = Post::where("category_id","$request->simbolo","$request->categoria")->where("tags","like","$request->tag")->orderBy('id', "$request->fecha")->get(); 
                        $cantidad_resultados = sizeof($resultados);
                        if($cantidad_resultados<12){
                            $offset=0;
                            $disabled = true; //Se lo paso a la vista, le digo si disabled = true que desabilite el button de siguiente
                        }

                    if($request->categoria!==0 || $request->fecha == 'ASC' || $request->fecha == 'DESC' || $request->fecha == 'asc' || $request->fecha == 'desc'){
                        $categoria = $request->categoria;
                        $fecha = $request->fecha;
                    }
        
                    $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
        
                    return view('dashboard', with(compact('posts', 'categoria', 'fecha', 'masonry_results', 'disabled', 'like_activo')));
                }

                else {
                $posts = Post::orderBy('id', 'DESC')->offset(0)->limit(12)->get();
                $masonry_results=sizeOf($posts);//Cantidad de resultados para calcular el height estimativo del masonry.
                return view('dashboard', with(compact('posts', 'masonry_results','like_activo')));
               }     

        }
        
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

    public function show($id, $post){
        $post = Post::find($id);

        //Si quisiera mostrar acá quienes le dieron like:antes del return hago: 
        //COMENTO QUERY CON JOIN MÁS FACIL CREE VÍNCULO BELONGS TO MANY.
        /*
        $likers = User::select("users.*")->join("likes","users.id","=","likes.user_id")->join("posts","posts.id","=","likes.post_id")->where("posts.id","=","$id")->get()->all();
        */

        $likers = $post->users_likes;

        if(sizeof($likers)>0){
            return view('posts.show', with(compact('post','likers')));
        }
        
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
            'name' => 'required|max:50',
            'body' => 'required|min:5',
            'category' => 'required',
            //'cover' => 'required'
        ]);

        $imageSize = getimagesize("$request->cover_url");
        if(($imageSize[0]>1200 && $imageSize[1]>800) || $imageSize[0]<$imageSize[1] ||$imageSize[1]<500){ 
            $categorias = Category::get()->all();
            $failed_image_size = true;
            $message_image_size = "La imagen excede tamaño máximo permitido";
            return view('posts.create', compact('categorias','failed_image_size','message_image_size'));

    }
        
        $post = new Post();
        
        $post->name = "$request->name";
        $post->body = "$request->body";
        $post->category_id = "$request->category";
        $post->user_id = "$request->user_id";
        $post->tags = "$request->tag_2"; 
        $post->likes = 0; 
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
        $categorias = Category::get()->all();
        return view('posts.edit')->with(compact('post','categorias'));
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

    
    public function destroy(Post $post, User $user){

        $post->delete();
        $posts=$user->posts()->get()->all();
        $user = User::find($user->id);
        $authorized=true;
        return redirect()->route('user.posts', with(compact('posts', 'user', 'authorized')));
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
