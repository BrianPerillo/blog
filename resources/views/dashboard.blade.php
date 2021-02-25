<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-1" style="background-color:white;padding-bottom:80px">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">

           @if(!isset($categoria)) {{$categoria=''}} @endif

           @if(!isset($fecha)) {{$fecha=''}} @endif

           @if(!isset($search)) @php $search='Buscar por Título, Autor, Categoría o Tag' @endphp @endif
            
            <div style="margin-bottom: 40px">
                <x-search :categoria="$categoria" :fecha="$fecha" :search="$search">

                </x-search>
            </div>
            <div class="container" style="margin-bottom:50px">


                <div class="row">
                    
                    @if(isset($posts))
                        @foreach($posts as $post)
                            <div class="col-md-4 mb-4" style="display:flex;align-items: center;width:30%">
                                <a href="{{route('posts.show', [$post->id, $post->name])}}" style="color:white">
                                    <div class="" style="position:relative; width:100%;">
                                        <img src="{{$post->image->url}}" style="border-radius:8px; width: 100%;height:100%;object-fit: cover;" alt="">
                                        <div class="card-title text-center m-0 " style="display:flex;align-items:center;border-radius:0px 0px 8px 8px;width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p class="m-auto">{{$post->name}}</p></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    @elseif(isset($users))
                        @foreach($users as $user)
                            <div class="col-md-4">
                                <a href="{{route('user.posts', $user->id)}}" style="color:white">
                                    <div class="" style="position:relative; width:100%;">
                                        <!--<img src="" style="border-radius:8px; width: 100%;height:100%;object-fit: cover;" alt="">-->
                                        <div class="card-title text-center m-0" style="border-radius:0px 0px 8px 8px;width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p>{{$user->name}}</p></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
        
                    
                    @elseif (!isset($posts) && !isset($posts_array))

                        <div class="d-flex justify-content-center">
                            <p class="text-center">
                                No se encontraron resultados
                            </p>
                        </div>
                        
                    @endif

                </div>
                <hr><br>
                
                @if(isset($posts))
                    <div class="">
                        <form action="{{route('dashboard.filtros')}}" class="" action="" method="get">
                            <button id="button_anterior" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                type="submit"  
                                onclick="prev('button_anterior')">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                                <input id="anterior" hidden name="" value="">
                            <button id="button_siguiente" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                type="submit"  
                                onclick="next('button_siguiente')"
                                @if(isset($disabled) && $disabled==true) {{'disabled'}} @endif>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                                <input hidden id="siguiente" name="" value="">

                            <!-- Filtros preexistentes -->
                            <input hidden id="filtro_preexistente_1_pagina" type="text" name="" value="">
                            <input hidden id="filtro_preexistente_2_pagina" type="text" name="" value="">
                        </form>
                    </div>

                @elseif(isset($users))
                    <div class="">
                        <form action="{{route('dashboard.filtros')}}" class="" action="" method="get">
                            <button type="submit" class="btn btn-primary">Anterior</button>
                            <button type="submit" class="btn btn-primary" @if(isset($disabled) && $disabled==true) {{'disabled'}} @endif>Siguente</button>
 
                        </form>
                    </div>


            </div>

            @endif

        </div>


    </div>

   

</x-app-layout>

