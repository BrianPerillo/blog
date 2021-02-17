<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container max-w-9xl mx-auto sm:px-6 lg:px-8">

            {{auth()->user()->name}}</br>
            
            Mis Posts: </br>

            <div class="row m-2">
                @foreach($posts as $post)
                <div class="col-md-4">
                    <a class="col-sm-3 m-1 p-2" href="{{route('posts.show', [$post->id, $post->name])}}">
                        <div  style="background-color:rgb(223, 226, 223)">
                            <img class="mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Boca_Juniors_logo18.svg/1200px-Boca_Juniors_logo18.svg.png" style="width:100px; alt="">
                            <div class="text-center"><p>{{$post->name}}</p></div>
                        </div>
                    </a>
                   
                        <div>
                            <div class="float-left mr-2">
                                <form action="{{route('posts.edit', $post)}}" method="get">
                                    <button class="btn btn-primary" type="submit">Editar</button> 
                                </form>
                            </div>
                            <div class="float-left mr-2">
                                <form action="{{route('posts.delete', $post)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-primary" type="submit">Eliminar</button> 

                                </form>
                            </div>
                        </div>
                </div>
                    
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
