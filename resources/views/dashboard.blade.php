<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-1" style="background-color:white;">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">

            <x-search>

            </x-search>

            <div class="container">
                <div class="container-masonry">
                
                @if(isset($posts))
                    @foreach($posts as $post)
                        <div class="item">
                            <a href="{{route('posts.show', [$post->id, $post->name])}}">
                                <div class="" style="position:relative; width:100%;">
                                    <img src="{{$post->image->url}}" style="width: 100%;height:100%;object-fit: cover;" alt="">
                                    <div class="card-title text-center m-0" style="width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p>{{$post->name}}</p></div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                

                @elseif(isset($posts_array))
                    @foreach($posts_array as $posts)
                        @foreach($posts as $post)
                            <div class="item">
                                <a href="{{route('posts.show', [$post->id, $post->name])}}">
                                    <div class="" style="position:relative; width:100%;">
                                        <img src="{{$post->image->url}}" style="width: 100%;height:100%;object-fit: cover;" alt="">
                                        <div class="card-title text-center m-0" style="width:100%;height:31%;background-color: rgba(0, 0, 0, 0.5);position:absolute;bottom:0px;left:0px"><p>{{$post->name}}</p></div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                

                @elseif (!isset($posts) && !isset($posts_array))

                    <div class="d-flex justify-content-center">
                        <p class="text-center">
                            No se encontraron resultados
                        </p>
                    </div>
                    
                @endif

                </div>
            </div>


        </div>
    </div>
</x-app-layout>
