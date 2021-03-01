<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;



class Buscador extends Component
{

    public $posts;
    public $categoria = '';
    public $fecha = 'desc';
    public $valoracion = '';
    public $search = '';

    public $offset = 0; //Se reseteará cada vez que se aplique un flitro, para mostrar la nueva búsqueda desde la primera pagina
    public $disabled = false;
    public $contador_pagina = 1;

    public $categorias;

    public function render()
    {
        //Cargo las categorias para hacer el foreach en la vista:
        $this->categorias = Category::get()->all();
        
        //Las consultas se hacen todas en este método (render); los otros (filtrarCategoría y filtrarFecha) lo que hacen es solamente setear lo que corresponda

        //Acá se busca x search:

            //Tomo los filtros x defecto: 
                $fecha = $this->fecha;
                $valoracion = $this->valoracion;
                $categoria = $this->categoria;
                $offset = $this->offset;
                $disabled = $this->disabled;
                $contador_pagina = $this->contador_pagina;

            //Si llega algo por search (es decir no está vacío (strlen es mayor a 0))

                if(strlen($this->search)>0){

                //Reseteo offset
                $this->offset = 0;

                //Guardo lo que llega en $search
                    $search = $this->search;

                    //Busco por nombre y por categoria
                        $result_nombre = Post::where('name','like',"%$search%")->get()->all();
                        $result_categoria = Category::where('name',"=","$search")->get()->first();

                        //Si hay resultados por nombre, hago la consulta, incluyendo tags:
                            if(sizeof($result_nombre)>0){

                            //Si hay categoría
                                if($categoria!=''){
                                    $categoria = $this->categoria;

                                    //Si hay filtro x valoración:
                                    if(strlen($this->valoracion) > 0){
                                        $categoria_activa = Category::where('name',"=","$categoria")->get()->first();
                                        $categoria_activa_id=$categoria_activa->id;

                                         //Paginado
                                         $results = $this->posts = Post::where('category_id','=',"$categoria_activa_id")->where("name","like","%$search%")->orwhere("tags", "=", "%$search%")->orderBy('likes', "$valoracion")
                                         ->get()->all();

                                         $cantidad_paginas = ceil(sizeof($results) / 12);

                                         if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                                         
                                             $this->disabled = true;
                                         
                                         }
                                         else{
                                             $this->disabled = false;
                                         }

                                         $this->posts = Post::where('category_id','=',"$categoria_activa_id")->where("name","like","%$search%")->orwhere("tags", "=", "%$search%")->orderBy('likes', "$valoracion")
                                         ->offset($offset)->limit(12)->get()->all();

                                    }
                                    //Si no hay filtro x valoración:
                                    else{
                                        $categoria_activa = Category::where('name',"=","$categoria")->get()->first();
                                        $categoria_activa_id=$categoria_activa->id;

                                        //Paginado
                                        $results = $this->posts = Post::where('category_id','=',"$categoria_activa_id")->where("name","like","%$search%")->orwhere("tags", "=", "%$search%")->orderBy('id', "$fecha")
                                        ->get()->all();
                                        
                                        $cantidad_paginas = ceil(sizeof($results) / 12);

                                        if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                                        
                                            $this->disabled = true;
                                        
                                        }
                                        else{
                                            $this->disabled = false;
                                        }

                                        $this->posts = Post::where('category_id','=',"$categoria_activa_id")->where("name","like","%$search%")->orwhere("tags", "=", "%$search%")->orderBy('id', "$fecha")
                                        ->offset($offset)->limit(12)->get()->all();

                                    }

                                }

                            //Si no hay categoría 
                                else if($categoria==''){

                                //Si hay filtro x valoración:
                                    if(strlen($this->valoracion) > 0){
                                        //Paginado
                                        $results = $this->posts = Post::where("name","like","%$search%")->orwhere("tags", "like", "%$search%")->orderBy('likes', "$valoracion")
                                        ->get()->all();
                                        
                                        $cantidad_paginas = ceil(sizeof($results) / 12);

                                        if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                                        
                                            $this->disabled = true;
                                        
                                        }
                                        else{
                                            $this->disabled = false;
                                        }

                                        $this->posts = Post::where("name","like","%$search%")->orwhere("tags", "like", "%$search%")->orderBy('likes', "$valoracion")
                                        ->offset($offset)->limit(12)->get()->all();

                                        
                                    }
                                //Si no lo hay
                                    else{
                                        //Paginado
                                        $results = $this->posts = Post::where("name","like","%$search%")->orwhere("tags", "like", "%$search%")->orderBy('id', "$fecha")
                                        ->get()->all();
                                        
                                        $cantidad_paginas = ceil(sizeof($results) / 12);

                                        if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                                        
                                            $this->disabled = true;
                                        
                                        }
                                        else{
                                            $this->disabled = false;
                                        }

                                        $this->posts = Post::where("name","like","%$search%")->orwhere("tags", "like", "%$search%")->orderBy('id', "$fecha")
                                        ->offset($offset)->limit(12)->get()->all();

                                    }
                                }
                                
                            }
                     
                        //Sino, si hay resultados por categoría: 

                            else if(strlen($result_categoria)>0){

                                $this->categoria = $result_categoria->name;
                                $categoria = $result_categoria->id;

                                //Paginado
                                $results = $this->posts = Post::where('category_id', '=', "$categoria")->orderBy('id', "$fecha")
                                ->get()->all();
                                
                                $cantidad_paginas = ceil(sizeof($results) / 12);

                                if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                                
                                    $this->disabled = true;
                                
                                }
                                else{
                                    $this->disabled = false;
                                }

                                $this->posts = Post::where('category_id', '=', "$categoria")->orderBy('id', "$fecha")
                                ->offset($offset)->limit(12)->get()->all();
                            }
                        
                    //Si no hay coincidencias de ningún tipo:
                        else if(sizeof($result_nombre)==0 && strlen($result_categoria)==0) {
                            $this->posts=[]; 
                        }
                }

                
                    

            //Si no llega nada por search
                else if(strlen($this->search)==0){
                //Vaciá posts
                    $this->posts=[]; 
                    $search = $this->search;

                //Si hay categoria:     NOTA: No hace falta preguntar si hay o no hay fecha, solo categoría
                    if($categoria!=''){

                        $categoria = $this->categoria;
                    //Fecha va a haber siempre, x defcto es desc: Tabmién guarda la que haya.
                        $this->fecha=$fecha;
                        $fecha = $this->fecha;
                    //Buscá x esa categoría
                        $categoria_activa = Category::where('name',"=","$categoria")->get()->first();
                        $categoria_activa_id=$categoria_activa->id;
                    //Si hay filtro por valoración:
                        if(strlen($this->valoracion) > 0){

                            //Paginado
                            $results = $this->posts = Post::where('category_id','=',"$categoria_activa_id")->orderBy('likes', "$valoracion")
                            ->get()->all();
                            
                            $cantidad_paginas = ceil(sizeof($results) / 12);

                            if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                            
                                $this->disabled = true;
                            
                            }
                            else{
                                $this->disabled = false;
                            }

                            $this->posts = Post::where('category_id','=',"$categoria_activa_id")->orderBy('likes', "$valoracion")
                            ->offset($offset)->limit(12)->get()->all();
                        }
                        //Si no hay filtro x valoración:
                        else{

                            //Paginado
                            $results =  $this->posts = Post::where('category_id','=',"$categoria_activa_id")->orderBy('id', "$fecha")
                            ->get()->all();

                            $cantidad_paginas = ceil(sizeof($results) / 12);

                            if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                            
                                $this->disabled = true;
                            
                            }
                            else{
                                $this->disabled = false;
                            }

                            $this->posts = Post::where('category_id','=',"$categoria_activa_id")->orderBy('id', "$fecha")
                            ->offset($offset)->limit(12)->get()->all();
                            
                        }
                        
                    }

                //Si no hay categoría 
                    if($categoria==''){
                    //Fecha va a haber siempre, x defcto es desc: Tabmién guarda la que haya.

                        $fecha = $this->fecha; 

                    //Si hay valoración:
                        if(strlen($this->valoracion) > 0){
                            
                            $valoracion = $this->valoracion; 

                            //Paginado
                            $results = $this->posts = Post::where("name","like","%$search%")->where("tags", "like", "%$search%")->orderBy('likes', "$valoracion")
                            ->get()->all();

                            $cantidad_paginas = ceil(sizeof($results) / 12);

                            if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                            
                                $this->disabled = true;
                            
                            }
                            else{
                                $this->disabled = false;
                            }

                            $this->posts = Post::where("name","like","%$search%")->where("tags", "like", "%$search%")->orderBy('likes', "$valoracion")
                            ->offset($offset)->limit(12)->get()->all();
                        }
                        
                        else{
                    //Buscá x esa fecha

                    //Consulto cantidad de resultados para deshabilitar o no los botónes de paginación
                            //En la pagina pagina
                            $results = $this->posts = Post::where("name","like","%$search%")->where("tags", "like", "%$search%")->orderBy('id', "$fecha")
                            ->get()->all();

                            $cantidad_paginas = ceil(sizeof($results) / 12);

                            if($contador_pagina==$cantidad_paginas || sizeof($results)<12){
                            
                                $this->disabled = true;
                            
                            }
                            else{
                                $this->disabled = false;
                            }

                            $this->posts = Post::where("name","like","%$search%")->where("tags", "like", "%$search%")->orderBy('id', "$fecha")
                            ->offset($offset)->limit(12)->get()->all();
    
                            
                    }
                    }
                }

        return view('livewire.buscador');
    }

    public function filtrarCategoria($categoria){

        //Reseteo offset 
        $this->offset = 0;
        //Reseteo Contador de página
        $this->contador_pagina = 1;

        //Si la categoría que llega ya está activa
            if($categoria==$this->categoria){ 
                $this->categoria = ''; // ==> Eliminala (Volvé al valor x default - haciendo esto se eliminará el filtro).
            }

        //Sino, si la categoría no está activa, seteá la nueva categoría
            else if ($categoria!=$this->categoria){
                $this->categoria=$categoria;
            }
    }

    public function filtrarFecha($fecha){

        //Reseteo offset 
        $this->offset = 0;
        //Reseteo Contador de página
        $this->contador_pagina = 1;

        //Al filtrar por fecha (filtro de orden - orderBy()) vacío el otro filtro x orden por si está activo 
        $this->valoracion = '';

        //Si la fecha recibida es la misma que está activa:
            if($fecha==$this->fecha){ 
                $this->fecha = 'desc'; // ==> Eliminala (Volvé al valor x default - haciendo esto se eliminará el filtro).
            }

        //Sino, si la fecha recibida no es la misma que está activa:
            else if($fecha!=$this->fecha){
                $this->fecha=$fecha; // ==> Reemplazala
            }

    }

    public function filtrarValoracion($valoracion){

        //Reseteo offset 
        $this->offset = 0;
        //Reseteo Contador de página
        $this->contador_pagina = 1;

        //Si el orden de valoración recibido es el mismo que está activo:
            if($valoracion==$this->valoracion){ 
                $this->valoracion = ''; // ==> Eliminala (Volvé al valor x default - haciendo esto se eliminará el filtro).
            }

        //Sino, si el orden de valoración no es el mismo que está activa:
            else if($valoracion!=$this->valoracion){
                $this->valoracion=$valoracion; // ==> Reemplazala
            }

    }

    public function pagina($pagina){

        if($pagina=="siguiente"){
            $this->offset = $this->offset + 12;
            $this->contador_pagina = $this->contador_pagina + 1;
        }

        if($pagina=="anterior"){
            $this->offset = $this->offset - 12;
            $this->contador_pagina = $this->contador_pagina - 1;
        }

    }


}
