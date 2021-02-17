<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            
                <!--<x-jet-welcome />-->
            <div class="container">
                <div class="container-masonry">
                
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

                </div>
            </div>


        </div>
    </div>
</x-app-layout>
