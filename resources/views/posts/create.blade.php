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
                
                <div class="row d-flex justify-center mb-9 mt-9">

                    <div class="form-group col-md-3">
                        <p><strong>Escribí un título</strong></p>
                        <input class="col-md-10 form-control" name="name" type="text" placeholder="Titulo del Post" value={{old('name')}}>
                        @error('name')
                        {{$message}}
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-3">
                        <p><strong>Seleccioná la/s categoría/s</strong></p>
                        @foreach ($categorias as $categoria)
                        <div class="float-left" style="width:125px">
                            <label class="m-auto" for="{{$categoria->name}}">
                                <input id="{{$categoria->name}}" class="mb-1 mr-1" type="checkbox" value="{{$categoria->id}}">{{$categoria->name}}
                            </label>
                         </div>
                        @endforeach
                    </div>

                </div>
                
                <div class="mt-5 row d-flex justify-center">

                    <div class="form-group col-md-3">
                        <p class=""><strong>Previsualización</strong></p>
                        <div>
                            <img src="" alt="">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <p class=""><strong>Seleccióna una imagen de portada</strong></p>
                        <label style="display:block" for="cover_url">Cargar mediante url
                            <input class="form-control-file mt-1" name="cover_url" type="text" placeholder="Ingresar url" value={{old('cover_url')}}>
                            @error('cover_url')
                            {{$message}}
                            @enderror
                        </label>

                        <br><br>
                        <p class="text-center"><strong>ó</strong></p>
                        <br>

                        <p class="mb-1">Seleccionar una imagen</p>
                        <label class="btn btn-primary" style="display:block" 
                               for="cover_file">Cargar Imagen
                            <input id="cover_file" class="form-control pt-1" type="file" name="cover_file" style="display:none" value={{old('cover_file')}}> 
                        </label>
                        <div id="img_seleccionada"><p></p></div>
                        @error('cover_file')
                        {{$message}}
                        @enderror
                    </div>

                </div>
                    
                <div class="row d-flex justify-center">
                                    

                    <div class="form-group col-md-8">
                        <textarea id="editor" name="body" placeholder="Escribe tu Post..." rows="10" cols="20">
                                {{old('body')}}
                        </textarea>
                            
                        <script>

                            CKEDITOR.replace( 'editor', {
                            });
                            CKEDITOR.config.toolbar = 'full';
                            CKEDITOR.plugins.addExternal( 'youtube', 'plugins/youtube/youtube/plugin.js' );
                            CKFinder.setupCKEditor();

                        </script>
                    </div> 

                    <input type="text" name="user_id" value="{{auth()->user()->id}}" hidden>

                </div>

                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit">Crear</button>
                </div>

            </form>

        </div>
    </body>

</x-app-layout>

<script src="{{ asset('js/portada_post.js') }}"></script>