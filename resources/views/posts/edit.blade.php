<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <body>
        <div class="col-md-12 "><br>
            <form action="{{route('posts.update', $post)}}" method="POST">

                @method('put')

                @csrf
               
                <div class="form-group col-md-3" style="margin-bottom:50px">
                    <p><strong>Editar Titulo</strong></p>
                    <input class="form-control" name="name" type="text" placeholder="Nombre del Curso" value="{{$post->name}}">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group col-md-6 p-0">
                        <div class="form-group col-md-12  p-0 m-0">
                            <p><strong>Editar Post</strong></p>
                            <textarea id="editor" name="body" placeholder="Escribe tu Post..." rows="10" cols="20">
                                    {{$post->body}}
                            </textarea>
                                
                            <script>

                                CKEDITOR.replace( 'editor', {
                                });
                                CKEDITOR.config.toolbar = 'full';
                                CKEDITOR.plugins.addExternal( 'youtube', 'plugins/youtube/youtube/plugin.js' );
                                CKFinder.setupCKEditor();
                                CKEDITOR.config.height = 400;

                            </script>
                        </div> 

                    </div>
                    @error('body')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group col-md-6" style="margin-bottom:100px">
                    <p><strong>Seleccioná una categoría</strong></p>
                    @foreach ($categorias as $categoria)
                    <div class="float-left" style="width:125px">
                        <label class="m-auto" for="{{$categoria->name}}">
                            <input id="{{$categoria->name}}" class="mb-1 mr-1" type="radio" name="category" value="{{$categoria->id}}" @if ($post->category->id == $categoria->id) {{"checked=checked"}} @endif >
                            {{$categoria->name}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </body>

</x-app-layout>