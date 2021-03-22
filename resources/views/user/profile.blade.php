<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">

        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8" style="padding-left:20%;padding-right:20%;padding-top:30px;padding-bottom:40px;background-color:white">
            
            <div style="margin-bottom:40px">
                <h3>Perfil: </h3>
            </div>

            {{-- Datos Personales --}}

            <div>
                <p>Nombre {{$user->name}} </p>
            </div>

            {{-- Ultimos Posts --}}

            <div>
                <p> Ultimos Posts </p>

                <div class="m-2">
                    @foreach ($lasts_posts as $last_post)
                    
                        <p>{{$last_post->name}}</p>

                    @endforeach
                </div>
            </div>

            {{-- Posts --}}

            <div>
                <p> <a href=""> Ver todos los posts </a> </p>
            </div>           
           
            {{-- Suscribirse --}}

            <form action="{{route("user.subscribe", [auth()->user(), $user])}}">
                <button class="btn btn-danger">Suscribirse</button>
            </form>
        </div>

    </div>

</x-app-layout>