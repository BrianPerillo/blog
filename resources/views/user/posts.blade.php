<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8" style="padding-left:300px;padding-right:300px;padding-top:80px;background-color:white">
            
            <h3>Mis Posts: </h3>

            <div class="row m-2" style="overflow: scroll; width:100%; height:650px;">
                @foreach($posts as $post)
                <div class="col-md-3 mb-5">
                    <a class="col-sm-3 m-1 p-2" href="{{route('posts.show', [$post->id, $post->name])}}">
                        <div style="margin:auto">
                            <img class="mx-auto" src="{{$post->image->url}}" style="width:250px;border-radius:10px;">
                            <div class="text-center mt-2"><p>{{$post->name}}</p></div>
                        </div>
                    </a>

                        @if(auth()->user() && auth()->user()->id == $user->id)
                            <div class="d-flex justify-content-center">
                                <div class="float-left mr-2">
                                    <form action="{{route('posts.edit', $post)}}" method="get">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="far fa-edit"></i>
                                        </button> 
                                    </form>
                                </div>
                                <div class="float-left mr-2">
                                    <form action="{{route('posts.delete', [$post,$user])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            <i class="far fa-trash-alt"></i>
                                        </button> 

                                    </form>
                                </div>
                            </div>
                        @endif

                </div>
                    
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
