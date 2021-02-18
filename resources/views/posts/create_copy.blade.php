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

{{--
                <!-- Create the editor container -->
                <div id="toolbar">

                </div>
                <!-- Create the editor container -->
                <div id="editor">

                </div>
  
                 <!-- Initialize Quill editor -->
                <script>
                    
                    var toolbarOptions =[

                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{'header':[1,2,3,4,5,6,false] }]
                        [{'list':'ordered'},{'list':'bullet'}],
                        [{'script':'sub'},{'script':'super'}],
                        [{'indent':'-1'},{'indent':'+1'}],
                        [{'direction':'rtl'}],
                        [{'size':['small', false, 'large', 'huge'] }],
                        ['link', 'image', 'video', 'formula'],
                        [{'color':[] }, {'background':[]}],
                        [{'font':[] }],
                        [{'align':[]}],
                    ];
                    

                    var quill = new Quill('#editor', {
                    
                    modules:{
                        toolbar:toolbarOptions
                    },

                    theme: 'snow'

                    });


                </script> 
                
--}}


                <div class="form-group col-md-8">
                    <textarea id="editor" name="body" placeholder="Escribe tu Post..." rows="10" cols="20">
                           {{old('body')}}
                    </textarea>
                    <script>
                        ClassicEditor
                            .create( document.querySelector( '#editor' ), {
                                
                                extraplugins: 'filebrowser',
                                filebrowserBrowseUrl:'browser.php',
                                filebrowserBrowseUrl:'upload.php',

                                plugins: ["Essentials", "CKFinderUploadAdapter", "Autoformat", "Bold", "Italic", "BlockQuote", "CKFinder", "EasyImage", "Heading", 
                                "Image", "ImageCaption", "ImageStyle", "ImageToolbar", "ImageUpload", "Indent", "Link", "List", "MediaEmbed", "Paragraph", 
                                "PasteFromOffice", "Table", "TableToolbar", "TextTransformation"],

                                toolbar: [ 'heading', '|', "Bold", "Italic", "BlockQuote", "CKFinder",
                                "Heading", "ImageUpload", "Indent", "Link", "MediaEmbed"],
     
                                heading: {
                                    options: [
                                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                                    ]
                                },
                            
                            } )
                            .then( editor => {
                                console.log( 'Editor was initialized', editor );
                            } )
                            .catch( error => {
                                console.error( error.stack );
                            } );
   
                            console.log(ClassicEditor.builtinPlugins.map( plugin => plugin.pluginName)); 

                           
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