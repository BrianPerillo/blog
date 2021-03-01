<div>
    
    <div class="row col-md-12 m-0 mb-3 d-flex justify-content-center">
        <!-- Search -->
        <form class="col-md-7 col-lg-6 col-xl-4 mb-5 mt-3 d-flex justify-content-center" wire:submit.prevent="filtrarSearch">
            <input class="input-text" wire:model="search" type="text" placeholder="Buscá por título o tag" >
        </form>
    </div>

    <!-- Dropdown Menu Filtros -->
    <div class="row col-md-12 m-0 mb-3 d-flex justify-content-center">
    
        <div class="hidden sm:flex col-md-12 p-0">
            <!-- Settings Dropdown -->
            <div class="relative col-md-12 p-0 d-flex justify-content-center">
                <x-dropdown_para_search align="right" width="100">
                    <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    Más Filtros
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Filtros
                        </div>
                        
                        <div class="row col-md-12 m-0 mb-5 d-flex justify-content-center">

        
                                <!-- Fecha -->
                                <div class="col-md-3" style=""> 
                                    <p class="text-center"><strong>Fecha</strong></p>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" wire:click="filtrarFecha('desc')"><p style="margin:0;padding:0"><p style="margin:0px" @if($fecha == 'desc') {{"class=font-weight-bold"}}  @endif>Más recientes</p></button>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" wire:click="filtrarFecha('asc')"><p style="margin:0;padding:0">
                                            @if($fecha == 'asc')
                                                <p style="margin:0px" class=font-weight-bold>Más antiguos x</p>
                                            @else 
                                                <p style="margin:0px">Más antiguos</p>
                                            @endif
                                        </button>
                                    </div>
                                    
                                </div>

                                <!-- Categorías -->
                                <div class="col-md-3" style=""> 
                                    <p class="text-center mr-5"><strong>Categoría</strong></p>
                                    <div class="row float-left" style="width: 100%">
                                        @php $cantidad_categorias = sizeof($categorias); @endphp
                                        <div class="col-md-7">
                                            @for($i = 0; ceil($i<$cantidad_categorias/2); $i++)
                                                <div>
                                                    <button type="submit" wire:click="filtrarCategoria('{{$categorias[$i]->name}}')"><p style="margin:0;padding:0">
                                                        @if($categoria==$categorias[$i]->name)
                                                            <p style="margin:0px" class=font-weight-bold>{{$categorias[$i]->name}} x</p>
                                                        @else 
                                                            <p style="margin:0px">{{$categorias[$i]->name}}</p>
                                                        @endif
                                                    </button>
                                                </div>
                                            @endfor
                                        </div>
                                        <div class="col-md-5">
                                            @for($i = ceil($cantidad_categorias/2); $i<$cantidad_categorias; $i++)
                                                <button type="submit" wire:click="filtrarCategoria('{{$categorias[$i]->name}}')">
                                                    @if($categoria==$categorias[$i]->name)
                                                        <p style="margin:0px" class=font-weight-bold>{{$categorias[$i]->name}} x</p>
                                                    @else 
                                                        <p style="margin:0px">{{$categorias[$i]->name}}</p>
                                                    @endif     
                                                </button>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Likes -->
                                <div class="col-md-3" style=""> 
                                    <p class="text-center"><strong>Valoración</strong></p>
                                    <div class="" style="width: 100%">
                                        <div class="">
                                            <button type="submit" style="display:block;margin:auto" wire:click="filtrarValoracion('desc')">
                                                @if($valoracion == 'desc') 
                                                    <p style="margin:0px"  class=font-weight-bold>Más Valorados x</p> 
                                                @else 
                                                    <p style="margin:0px" >Más Valorados</p>
                                                @endif
                                            </button>
                                        </div> 
                                        <div class="">
                                            <button type="submit" style="display:block;margin:auto"  wire:click="filtrarValoracion('asc')">
                                                @if($valoracion == 'asc')
                                                    <p style="margin:0px"  class=font-weight-bold>Menos Valorados x</p> 
                                                @else 
                                                    <p style="margin:0px" >Menos Valorados</p>
                                                @endif
                                            </button>
                                        </div> 
                                    </div>
                                </div>

                         

                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>
    </div>
  

</div>

<!-- Resultados --> 

<div class="" style="margin-bottom:50px;width:65%;margin:auto">


    <div class="row">
        
        @if(sizeof($posts)>0)
            @foreach($posts as $post)
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-4" style="display:flex;align-items: center">
                    <a href="{{route('posts.show', [$post->id, $post->name])}}" style="color:white">
                        <div class="" style="position:relative; width:100%;">
                            <img src="{{$post->image->url}}" style="border-radius:8px; width: 100%;height:100%;object-fit: cover;" alt="">
                            <div class="card-title text-center m-0" style="text-overflow: ellipsis;overflow: hidden;display:flex;align-items:center;border-radius:0px 0px 8px 8px;width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p class="m-auto text-overflow: ellipsis;overflow: hidden;">{{$post->name}}</p></div>
                        </div>
                    </a>
                </div>
            @endforeach

        @elseif(1==0)
            @foreach($users as $user)
                <div class="col-md-4 col-sm-12 mb-4" style="display:flex;align-items: center;width:30%">
                    <a href="{{route('user.posts', $user->id)}}" style="color:white">
                        <div class="" style="position:relative; width:100%;">
                            <!--<img src="" style="border-radius:8px; width: 100%;height:100%;object-fit: cover;" alt="">-->
                            <div class="card-title text-center m-0" style="border-radius:0px 0px 8px 8px;width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p>{{$user->name}}</p></div>
                        </div>
                    </a>
                </div>
            @endforeach

        
        @elseif (sizeof($posts)==0)

            <div class="mx-auto mt-5">
                <p class="text-center">
                    No se encontraron resultados
                </p>
            </div>
            
        @endif

    </div>
    <hr style="border:1px solid; color:rgba(207, 207, 207, 0.486)"><br>


    <!-- Paginado -->

    <button wire:click="pagina('anterior')" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 @if($offset==0) {{'off'}} @else {{"bg-white"}}  @endif border border-gray-300 cursor-default leading-5 rounded-md focus:outline-none focus:ring ring-gray-300"
    type="submit"  
    @if($offset==0) {{'disabled'}} @endif>
    « Previous    
    </button>

    <button  wire:click="pagina('siguiente')" id="button_siguiente" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 @if($disabled==true) {{'off'}} @else {{"bg-white"}} @endif  border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
    type="submit" 
    @if($disabled==true) {{'disabled'}} @endif>
    Next »
    </button>

</div>
