<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <body>
        <div class="col-md-12"><br>
            <form action="{{route('posts.update', $post)}}" method="POST">

                @method('put')

                @csrf

                <div class="form-group col-md-3">
                    <input class="form-control" name="name" type="text" placeholder="Nombre del Curso" value="{{$post->name}}">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <textarea class="form-control" name="body" placeholder="Descripción del curso" id="" cols="30" rows="7">{{$post->body}}</textarea>
                    @error('body')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <select name="category" id="">
                        <option value="1" @if($post->category->id == 1) selected @endif>Desarrollo Web</option>
                        <option value="2" @if($post->category->id == 2) selected @endif>Diseño Web</option>
                    </select>
                    @error('category')
                     {{$message}}
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </body>

</x-app-layout>