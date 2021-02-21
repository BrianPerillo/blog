
<div class="col-md-12">

    <div class="row col-md-12 m-0 mb-3 d-flex justify-content-center">
            <form action="{{route('dashboard.filtros')}}" class="col-md-3 mb-3" action="" method="get">
                
                <input id="search" class="col-md-12" type="text" style="border-radius:20px" name="search" 
                placeholder="Buscar por Título, Autor, Categoría o Tag" 
                value=""
                onchange="lowerCase()">
            </form>
    </div>

    <!-- Dropdown Menu Filtros -->
    <div class="row col-md-12 m-0 mb-3 d-flex justify-content-center">
    
        <div class="hidden sm:flex col-md-12 p-0">
            <!-- Settings Dropdown -->
            <div class="relative col-md-12 p-0 d-flex justify-content-center">
                <x-dropdown_para_search align="right" width="100">
                    <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    Más Filtros
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Filtros
                        </div>
                        
                        <div class="row col-md-12 m-0 mb-5 d-flex justify-content-center">
                            <form class="col-md-12 d-flex justify-content-center" action="{{route('dashboard.filtros')}}" method="get">
                                
                                <div class="col-md-4 float-left">
                                    <p class="text-center"><strong>Fecha</strong></p>
                                    <!--<label class="btn p-0 m-0 m-auto" style="display: block" for="masrecientes">MásRecientes
                                        <input hidden name="masrecientes" type="button" value="consultaSQL">
                                    </label>-->
                                    <div class="mb-2 d-flex justify-content-center">
                                        <input hidden id="mas_recientes" name="" type="text" class="" style="display: block;background-color:white" 
                                        value="">
                                        <button id="button_mas_recientes" type="submit" onclick="prueba('button_mas_recientes')">Más Recientes</button>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center">
                                        <input hidden id="mas_antiguos" name="" type="text" class="" style="display: block;background-color:white" 
                                        value="">
                                        <button id="button_mas_antiguos" type="submit" onclick="prueba('button_mas_antiguos')">Más Antiguos</button>
                                    </div>
                                </div>
                    
                                <div class="col-md-4 float-left">
                                    <p class="text-center"><strong>Categoría</strong></p>
                                    
                                    <div class="col-md-8 float-left">
                                        <div class="mb-2">
                                            <input hidden id="noticias" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_noticias" type="submit" onclick="prueba('button_noticias')">Noticias</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="actualidad" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_actualidad" type="submit" onclick="prueba('button_actualidad')">Actualidad</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="tecnologia" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_tecnologia" type="submit" onclick="prueba('button_tecnologia')">Tecnologia</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="ocio" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_ocio" type="submit" onclick="prueba('button_ocio')">Ocio</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="deportes" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_deportes" type="submit" onclick="prueba('button_deportes')">Deportes</button>
                                        </div>
                                    </div>
                    
                                    <div class="col-md-4 float-right">
                                        <div class="mb-2">
                                            <input hidden id="musica" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_musica" type="submit" onclick="prueba('button_musica')">Musica</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="fotografia" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_fotografia" type="submit" onclick="prueba('button_fotografia')">Fotogarfia</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="politica" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_politica" type="submit" onclick="prueba('button_politica')">Politica</button>
                                        </div>
                                        <div class="mb-2">
                                            <input hidden id="educativo" name="" type="text" class="" style="display: block;background-color:white" 
                                            value="">
                                            <button id="button_educativo" type="submit" onclick="prueba('button_educativo')">Educativo</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input que enciará el filtro que ya exista en la url --> 
                                <input hidden id="filtro_preexistente" type="text" name="" value="">
                                <input hidden id="filtro_preexistente2" type="text" name="" value="">
                    
                                <div class="col-md-4 float-left">
                                    <p class="text-center"><strong>Valoración</strong></p>
                                    <div class="mb-2">
                                        <input type="submit" class="m-auto " style="display: block;background-color:white" value="Más gustados">
                                    </div>
                                </div>
                    
                            </form>
                        </div>

                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>
    </div>

</div>
    