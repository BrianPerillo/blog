<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <body>
        <div class="col-md-12"><br>
            <form action="{{route('posts.store')}}" method="POST">

                @csrf

                <div class="form-group col-md-3">
                    <input class="form-control" name="name" type="text" placeholder="Titulo del Post" value={{old('name')}}>
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
                
                <div class="form-group col-md-3">
                    <select class="form-control" name="category">
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                     {{$message}}
                    @enderror
                </div>

                
                <div class="form-group col-md-3">
                    <input class="form-control" name="cover" type="text" placeholder="Url Imagen de Portada" value={{old('cover')}}>
                    @error('cover')
                    {{$message}}
                    @enderror
                </div>

               
                <div class="form-group col-md-8">
                    <textarea name="body" id="editor" placeholder="Escribe tu Post..." rows="10" cols="20">
                           {{old('body')}}
                    </textarea>

                    <script>
                        ClassicEditor
                            .create( document.querySelector( '#editor' ) )
                            .catch( error => {
                                console.error( error );
                            } );
                    </script>
                </div>

                <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>

                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit">Crear</button>
                </div>
            </form>

        </div>
    </body>

</x-app-layout>