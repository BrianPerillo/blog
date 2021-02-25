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

                
                @if($masonry_results<=3)
                    @php $height="300px" @endphp

                @elseif($masonry_results>3 && $masonry_results<=6)
                    @php $height="680px" @endphp

                @elseif($masonry_results>6 && $masonry_results<=9)
                    @php $height="900px" @endphp

                @elseif($masonry_results>9)
                    @php $height="950px" @endphp
                    
                @endif


                <div class="container-masonry" style="height:{{$height}}">
                
                    @if(isset($posts))
                        @foreach($posts as $post)
                            <div class="item">
                                <a href="{{route('posts.show', [$post->id, $post->name])}}">
                                    <div class="" style="position:relative; width:100%;">
                                        <img src="{{$post->image->url}}" style="border-radius:8px; width: 100%;height:100%;object-fit: cover;" alt="">
                                        <div class="card-title text-center m-0" style="border-radius:0px 0px 8px 8px;width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p>{{$post->name}}</p></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    @elseif(isset($users))
                        @foreach($users as $user)
                            <div class="item">
                                <a href="{{route('user.posts', $user->id)}}">
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
                <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(28, 132, 201, 0.8), rgba(92 142 156 / 45%), rgba(207 245 255 / 10%));">
                
                @if(isset($posts))
                    <div class="">
                        <form action="{{route('dashboard.filtros')}}" class="" action="" method="get">
                            <button id="button_anterior" type="submit" class="btn btn-primary" onclick="anterior('button_anterior')">Anterior</button>
                                <input id="anterior" hidden name="" value="">
                            <button id="button_siguiente" 
                            type="submit" class="btn btn-primary" 
                            onclick="next('button_siguiente')"
                            @if(isset($disabled) && $disabled==true) {{'disabled'}} @endif>Siguente</button>
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

