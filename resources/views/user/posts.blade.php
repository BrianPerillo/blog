<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8" style="padding-left:20%;padding-right:20%;padding-top:30px;padding-bottom:40px;background-color:white">
            
            <div style="margin-bottom:40px">
                <h3>Mis Posts: </h3>
            </div>

                @foreach($posts as $post)  

                <a class="" href="{{route('posts.show', [$post->id, $post->name])}}">
                    <div class="col mb-1" style="overflow:hidden">

                            <div style="float:left;width:100%;margin-right:30px">

                                <!-- Cover -->
                                <div style="float:left;margin-right:30px"><img src="{{$post->image->url}}" style="width:140px;border-radius:5px;"></div>
                                <div class="d-flex justify-content-center" style="float:left;margin-top:30px"><p>{{$post->name}}</p></div>

                                <!-- Botones Edit y Delete -->
                                @if(auth()->user() && auth()->user()->id == $user->id)
                                    <div class="d-flex justify-content-center float-right">
                                        <div class="float-left mr-2">
                                            <form action="{{route('posts.edit', $post)}}" method="get">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="far fa-edit"></i>
                                                </button> 
                                            </form>
                                        </div>
                                        <div class="float-left mr-2">
                                            <form class="formulario-eliminar" action="{{route('posts.delete', [$post,$user])}}" method="post">
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
                    </div>
                    <hr>
                </a>

                @endforeach
          
                {{ $posts->links() }}

        </div>
    </div>
</x-app-layout>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    $(".formulario-eliminar").submit(function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            this.submit();
            }

        })      

    });

    </script>