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

                <!-- Va a aparecer el button suscribirme o desuscribirme cuando siempre y cuando esté viendo el perfil de otro usuario no el suyo propio  -->
                <!-- ya que no debería poder suscribirse a su propio "canal". Esto lo controlo desde el if y elseif de abajo-->

            @if($esta_subscripto && auth()->user()->id !== $user->id) <!-- Si está suscrito y el perfil NO ES EL PROPIO -->
                <form action="{{route("user.unsubscribe", [auth()->user(), $user])}}" method="post">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger">Desuscribirme</button>
                </form>
            @elseif(!$esta_subscripto && auth()->user()->id !== $user->id) <!-- Si no está suscrito y el perfil NO ES EL PROPIO -->
                <form action="{{route("user.subscribe", [auth()->user(), $user])}}" method="post">
                    @csrf
                    
                    <button class="btn btn-danger">Suscribirme</button>
                </form>
            @endif
           
        </div>

    </div>

</x-app-layout>