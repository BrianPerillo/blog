function responder(idnumber){
    $("#responder_"+idnumber).append("<textarea name='answer' cols='50' rows='5'></textarea><input type='submit' style='float: right' class='bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100' value='Responder'>");
    $("#responder"+idnumber).remove()
}


//LIKES


//FILTROS Y SEARCH:

//En caso que usen el search paso el dato a minúsculas con toLowerCase. Esto sirve para el ifs que están más abajo donde se consulta el value
function lowerCase(id){ //  ... value=="noticias" || value=="actualidad"|| value=="tecnologia" etc...

    var searchBruto = $("#search").val();
    var search = searchBruto.toLowerCase();
    $("#search").val(search);
    
}

function prueba(id){

    //ENVIAR FILTRO PREEXISTENTE SI ES QUE LO HAY:

        var name = null; //name null sirve para + abajo consultarlo y poder saber si existe un filtro previo. De mantenerse = a null es porque no existe.
        var nameFiltro1 = null;
        var nameFiltro2 = null;
            //Tomo la URL y la paso a Sting para poder editarla.
                var url = window.location.toString();

            //Consulto cuantas veces aparece el caracter = en la URL:
                var matchesCount = url.split("=").length - 1;

                //NOTA: 
                //También funciona hacer:
                    //var matchesCount = url.match(/=/g).length;

            //SI APARECE 1 es porque hay un filtro preexistente entonces lo tomo y se lo guardo al input hidden para que llegue al Controller:
                if(matchesCount==1){
                    //Tomo de la URL lo que esté después del "?"
                        var posicionInterrog = url.indexOf("?");
                        var filtro = url.slice(posicionInterrog+1); //+1 Para que no incluya al ?. Daría como resultado el filtro por ej: categoria=9
                    
                    //Guardo el name y el value correspondiente al filtro separando el contenido a ambos lados del "="
                        var posicionIgual = filtro.indexOf("=");
                        var name = filtro.slice(0, posicionIgual); //Cargo el name, del filtro previo
                        var value = (filtro.slice(posicionIgual+1).toLowerCase()); //Cargo el value, del filtro previo EN MINÚSCULAS para que coincida
                        //con el value que consultan los ifs de abajo.

                        //alert(" name: " + name + ", value: " + value);

                    //Guardo el name y el value en el index hidden para que llegue al PostController:
                        $('#filtro_preexistente').val(value);
                        $('#filtro_preexistente').attr('name', name);
                }

                //SI APARECEN 2:
                if(matchesCount==2){
                    var posicionInterrog = url.indexOf("?");
                    var filtro = url.slice(posicionInterrog+1);

                    //Tomo los 2 filtros
                        var posicionY = filtro.indexOf("&");
                        var filtro1 = filtro.slice(0, posicionY); //Acá ya tengo uno Ej: fecha=ASC
                        var filtro2 = filtro.slice(posicionY+1); //Acpa guardo el otro Ej: tag=Uno
                        //alert("filtro1: " + filtro1 + " filtro2: " + filtro2);

                    //Tomo el name y el value de cada filtro separando el contenido a ambos lados del "="
                        var posicionIgual1 = filtro1.indexOf("=");
                        var posicionIgual2 = filtro2.indexOf("=");

                        var nameFiltro1 = filtro1.slice(0, posicionIgual1); 
                        var valueFiltro1 = (filtro1.slice(posicionIgual1+1, posicionY).toLowerCase());

                        var nameFiltro2 = filtro2.slice(0, posicionIgual2); 
                        var valueFiltro2 = (filtro2.slice(posicionIgual2+1).toLowerCase());
                        //alert(" nameFiltro1: " + nameFiltro1 + ", valueFiltro1: " + valueFiltro1 + ", nameFiltro2: " + nameFiltro2 + ", valueFiltro2: " + valueFiltro2);
                    
                    //Cargo los datos a los inputs hidden para que lleguen al Controller
                        $('#filtro_preexistente').val(valueFiltro1);
                        $('#filtro_preexistente').attr('name', nameFiltro1);

                        $('#filtro_preexistente2').val(valueFiltro2);
                        $('#filtro_preexistente2').attr('name', nameFiltro2);
                    

                }

    //!!!!!IMPORTANTE: EL FILTRO SE DEBERÁ SUMÁS SOLO SI NO HAY YA UN FILTRO DE LA MISMA CATEGRÍA (CON EL MISMO NAME), ENCASO DE QUE LO HAYA, NO SE DEBE SUMAR,
    //SINO REEMPLAZARLO. ES DECIR NO QUIERO QUE QUEDE X EJ  ?fecha=DESC&&fecha=ASC o  ?categoria=1&&categoria=3 sino que en estos casos se reemplaze la 
    //fecha DESC X LA ASC y en el 2do la categoría 1 x la 3 

        if(id=="button_mas_recientes"){
            nameFecha = "mas_recientes";
            valueFecha = "desc"
            filtrarFecha(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,nameFecha,valueFecha);
        }

        //Lo mismo que hice con el da arriba lo hago con todos los demás pero no les pongo los comentarios

        else if(id=="button_mas_antiguos"){
            nameFecha = "mas_antiguos";
            valueFecha = "asc"
            filtrarFecha(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,nameFecha,valueFecha);
        }

        else if(id=="button_noticias"){
            var nameNoticias="noticias";
            var valueNoticias="1";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);
        }
        else if(id=="button_actualidad"){
            var nameNoticias="actualidad";
            var valueNoticias="2";

            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);
        }
        else if(id=="button_tecnologia"){
            var nameNoticias="tecnologia";
            var valueNoticias="3";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);
        }
        else if(id=="button_ocio"){
            var nameNoticias="ocio";
            var valueNoticias="4";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }
        else if(id=="button_deportes"){
            var nameNoticias="deportes";
            var valueNoticias="5";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }
        else if(id=="button_musica"){
            var nameNoticias="musica";
            var valueNoticias="6";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }
        else if(id=="button_fotografia"){
            var nameNoticias="fotografia";
            var valueNoticias="7";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }
        else if(id=="button_politica"){
            var nameNoticias="politica";
            var valueNoticias="8";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }
        else if(id=="button_educativo"){
            var nameNoticias="educativo";
            var valueNoticias="9";
            filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias);  
        }

    function filtrarFecha(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,nameFecha,valueFecha){
    //SOLAMENTE Si no hay filtro preexistente o -El filtro no es por fecha (su name != a fecha), o si el value == "ASC"
            if(matchesCount==0){    //Si no existen filtros aplicados:
            //Guardo el filtro nuevo
                $('#'+nameFecha).val(valueFecha);
                $('#'+nameFecha).attr('name', 'fecha');
            }

            if(matchesCount==1){  
                if(name!="fecha"){ 
                    $('#'+nameFecha).val(valueFecha);
                    $('#'+nameFecha).attr('name', 'fecha');
                }
                else if(name=="fecha" && value!=valueFecha){
                    $('#'+nameFecha).val(valueFecha);
                    $('#'+nameFecha).attr('name', 'fecha');
                    $('#filtro_preexistente').val("");                
                    $('#filtro_preexistente').attr('name', ""); 
                }
                else if(name=="fecha" && value==valueFecha){
                    $('#filtro_preexistente').val("");                
                    $('#filtro_preexistente').attr('name', "");
                }
            }

            if(matchesCount==2){  

                //Agrega el nuevo
                $('#'+nameFecha).val(valueFecha);
                $('#'+nameFecha).attr('name', 'fecha');

                if(nameFiltro1=="fecha" && valueFiltro1!=valueFecha){ //Si es el filtro 1 es la otra fecha
                    $('#filtro_preexistente').val("");                
                    $('#filtro_preexistente').attr('name', "");             
                }

                if(nameFiltro2=="fecha" && valueFiltro2!=valueFecha){ //Si es el filtro 1 es la otra fecha
                    $('#filtro_preexistente2').val("");                
                    $('#filtro_preexistente2').attr('name', "");             
                }

                if(nameFiltro1=="fecha" && valueFiltro1==valueFecha){ //Si el filtro1 es el mismo que el nuevo
                    $('#filtro_preexistente').val("");                
                    $('#filtro_preexistente').attr('name', ""); 
                    $('#'+nameFecha).val("");
                    $('#'+nameFecha).attr('name', '');                 
                }

                if(nameFiltro2=="fecha" && valueFiltro2==valueFecha){ //Si el filtro2 es el mismo que el nuevo
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");    
                    $('#'+nameFecha).val("");
                    $('#'+nameFecha).attr('name', '');        
                }
        }
    }


//Función filtrar:

    function filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias){
        if(matchesCount==0){    //Si no existen filtros aplicados:
            if(name!="categoria" || value!=valueNoticias){ //(if redundante)
                $('#'+nameNoticias).val(valueNoticias); // Agregá el filtro
                $('#'+nameNoticias).attr('name', 'categoria');
            }
            if(name=="categoria" || value==valueNoticias){ // Agregá el filtro
                $('#filtro_preexistente').val("");
                $('#filtro_preexistente').attr('name', "");               
            }
        }
        else if(matchesCount==1){ //Si existe 1 filtro
            if(name!="categoria" || value!=valueNoticias){  // Si ese filtro preexistente no es este mismo
                $('#'+nameNoticias).val(valueNoticias);     // Agregalo
                $('#'+nameNoticias).attr('name', 'categoria');
                if(name=="categoria"                        //Si ese filtro preexistente pertenece a OTRA categoría
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");  //Eliminalo
                        $('#filtro_preexistente').attr('name', "");
                }
            }
            if(name=="categoria" || value==valueNoticias){ //Si el filtro preexistente es el mismo eliminalo
                $('#filtro_preexistente').val("");
                $('#filtro_preexistente').attr('name', "");               
            }

        }
        else if(matchesCount==2){ //Si existen 2 filtros
                    //Agregalo el nuevo
                    $('#'+nameNoticias).val(valueNoticias);     
                    $('#'+nameNoticias).attr('name', 'categoria');
                    
                    if(nameFiltro1=="categoria" || valueFiltro1=="noticias" || valueFiltro1=="actualidad"|| valueFiltro1=="tecnologia" //Si el Filtro 1 pertenece a OTRA categoría
                        || valueFiltro1=="ocio"|| valueFiltro1=="deportes"|| valueFiltro1=="musica"
                        || valueFiltro1=="fotografia"|| valueFiltro1=="politica" || valueFiltro1=="educativo"){ 
                        $('#filtro_preexistente').val("");           //Eliminalo   
                        $('#filtro_preexistente').attr('name', "");           
                    }
                   else if(nameFiltro2=="categoria" || valueFiltro2=="noticias" || valueFiltro2=="actualidad"|| valueFiltro2=="tecnologia" //Si el Filtro 2 pertenece a OTRA categoría
                        || valueFiltro2=="ocio"|| valueFiltro2=="deportes"|| valueFiltro2=="musica"
                        || valueFiltro2=="fotografia"|| valueFiltro2=="politica" || valueFiltro2=="educativo"){ 
                        $('#filtro_preexistente2').val("");     //Eliminalo                     
                        $('#filtro_preexistente2').attr('name', "");           
                    }   
                
                if(nameFiltro1=="categoria" && valueFiltro1==valueNoticias){ //Si el filtro preexistente 1 es el mismo eliminalo
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                    $('#'+nameNoticias).val(""); //Vaciá también el dato que había cargado al principio para el nuevo filtro
                    $('#'+nameNoticias).attr('name', '');
                }
                else if(nameFiltro2=="categoria" && valueFiltro1==valueNoticias){ //Si el filtro preexistente 2 es el mismo eliminalo
                    $('#filtro_preexistente2').val(""); //Eliminalo
                    $('#filtro_preexistente2').attr('name', "");
                    $('#'+nameNoticias).val("");     //Vaciá también el dato que había cargado al principio para el nuevo filtro
                    $('#'+nameNoticias).attr('name', '');
          
                }  
        }
    }
}  

function next(id){

    var name = null; //name null sirve para + abajo consultarlo y poder saber si existe un filtro previo. De mantenerse = a null es porque no existe.
    var nameFiltro1 = null;
    var nameFiltro2 = null;
        //Tomo la URL y la paso a Sting para poder editarla.
            var url = window.location.toString();

        //Consulto cuantas veces aparece el caracter = en la URL:
            var matchesCount = url.split("=").length - 1;

            //NOTA: 
            //También funciona hacer:
                //var matchesCount = url.match(/=/g).length;

        //SI APARECE 1 es porque hay un filtro preexistente entonces lo tomo y se lo guardo al input hidden para que llegue al Controller:
            if(matchesCount==1){
                //Tomo de la URL lo que esté después del "?"
                    var posicionInterrog = url.indexOf("?");
                    var filtro = url.slice(posicionInterrog+1); //+1 Para que no incluya al ?. Daría como resultado el filtro por ej: categoria=9
                
                //Guardo el name y el value correspondiente al filtro separando el contenido a ambos lados del "="
                    var posicionIgual = filtro.indexOf("=");
                    var name = filtro.slice(0, posicionIgual); //Cargo el name, del filtro previo
                    var value = (filtro.slice(posicionIgual+1).toLowerCase()); //Cargo el value, del filtro previo EN MINÚSCULAS para que coincida
                    //con el value que consultan los ifs de abajo.

                    //alert(" name: " + name + ", value: " + value);

                //Guardo el name y el value en el index hidden para que llegue al PostController:
                    $('#filtro_preexistente_1_pagina').val(value);
                    $('#filtro_preexistente_1_pagina').attr('name', name);
            }

            //SI APARECEN 2:
            if(matchesCount==2){
                var posicionInterrog = url.indexOf("?");
                var filtro = url.slice(posicionInterrog+1);

                //Tomo los 2 filtros
                    var posicionY = filtro.indexOf("&");
                    var filtro1 = filtro.slice(0, posicionY); //Acá ya tengo uno Ej: fecha=ASC
                    var filtro2 = filtro.slice(posicionY+1); //Acpa guardo el otro Ej: tag=Uno
                    //alert("filtro1: " + filtro1 + " filtro2: " + filtro2);

                //Tomo el name y el value de cada filtro separando el contenido a ambos lados del "="
                    var posicionIgual1 = filtro1.indexOf("=");
                    var posicionIgual2 = filtro2.indexOf("=");

                    var nameFiltro1 = filtro1.slice(0, posicionIgual1); 
                    var valueFiltro1 = (filtro1.slice(posicionIgual1+1, posicionY).toLowerCase());

                    var nameFiltro2 = filtro2.slice(0, posicionIgual2); 
                    var valueFiltro2 = (filtro2.slice(posicionIgual2+1).toLowerCase());
                    //alert(" nameFiltro1: " + nameFiltro1 + ", valueFiltro1: " + valueFiltro1 + ", nameFiltro2: " + nameFiltro2 + ", valueFiltro2: " + valueFiltro2);
                
                //Cargo los datos a los inputs hidden para que lleguen al Controller
                    $('#filtro_preexistente_1_pagina').val(valueFiltro1);
                    $('#filtro_preexistente_1_pagina').attr('name', nameFiltro1);

                    $('#filtro_preexistente_2_pagina').val(valueFiltro2);
                    $('#filtro_preexistente_2_pagina').attr('name', nameFiltro2);
                

            }

            if(id=="button_siguiente"){
                //Si no hay un filtro preexistente:
                if(matchesCount==0){
                    $('#siguiente').attr('name', 'offset');
                    $('#siguiente').val(12);
                }
                //Si hay un filtro preexistente pero no es pagina:
                else if(matchesCount==1){ 
                    if(name==null || name!="offset"){
                        $('#siguiente').attr('name', 'offset');
                        $('#siguiente').val(12);
                        //Envío el filtro nuevo
                    }
                    else if(name=="offset"){

                        $('#siguiente').attr('name', 'offset');
                        var pagina_actual = Number(value);
                        $('#siguiente').val(pagina_actual+12);

                        $('#filtro_preexistente_1_pagina').val("");
                        $('#filtro_preexistente_1_pagina').attr('name', "");
                    }
                }
                //Si ya hay filtro x pagina:
                else if(matchesCount==2){
                    if(nameFiltro1!="offset" && nameFiltro2!="offset"){
                        $('#siguiente').attr('name', 'offset');
                        $('#siguiente').val(12);
                    }
                    else if(nameFiltro1=="offset"){

                        $('#siguiente').attr('name', 'offset');
                        var pagina_actual = Number(valueFiltro1);
                        $('#siguiente').val(pagina_actual+12);

                        $('#filtro_preexistente_1_pagina').val("");
                        $('#filtro_preexistente_1_pagina').attr('name', "");
                    }
                    else if(nameFiltro2=="offset"){

                        $('#siguiente').attr('name', 'offset');
                        var pagina_actual = Number(valueFiltro2);
                        $('#siguiente').val(pagina_actual+12);

                        $('#filtro_preexistente_2_pagina').val("");
                        $('#filtro_preexistente_2_pagina').attr('name', "");
                    }
                }
            }

}



/*BACKUP DE FUNCIÓN FILTRAR: 
   function filtrar(name,value,nameFiltro1,nameFiltro2,valueFiltro1,valueFiltro2,matchesCount,nameNoticias,valueNoticias){
        if(matchesCount==0){
            if(name!="categoria" || value!=valueNoticias){
                $('#'+nameNoticias).val(valueNoticias);
                $('#'+nameNoticias).attr('name', 'categoria');
            }
            if(name=="categoria" || value==valueNoticias){
                $('#filtro_preexistente').val("");
                $('#filtro_preexistente').attr('name', "");               
            }
        }
        else if(matchesCount==1){ //Si existe un filtro
            if(name!="categoria" || value!=valueNoticias){ //Si  no es este mismo
                $('#'+nameNoticias).val(valueNoticias);    //agregarlo
                $('#'+nameNoticias).attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");
                        $('#filtro_preexistente').attr('name', "");
                }
            }
            if(name=="categoria" || value==valueNoticias){
                $('#filtro_preexistente').val("");
                $('#filtro_preexistente').attr('name', "");               
            }

        }
        else if(matchesCount==2){ //Si existen dos filtros
                if(nameFiltro1!="categoria" || valueFiltro1!=valueNoticias && nameFiltro2!="categoria" || valueFiltro2!=valueNoticias){
                    $('#'+nameNoticias).val(valueNoticias);
                    $('#'+nameNoticias).attr('name', 'categoria');
                }

                if(nameFiltro1=="categoria" && valueFiltro1=="1" || nameFiltro2=="categoria" && valueFiltro2=="1"){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");               
                }
                else if(nameFiltro1=="categoria" || valueFiltro1=="noticias" || valueFiltro1=="actualidad"|| valueFiltro1=="tecnologia"
                    || valueFiltro1=="ocio"|| valueFiltro1=="deportes"|| valueFiltro1=="musica"
                    || valueFiltro1=="fotografia"|| valueFiltro1=="politica" || valueFiltro1=="educativo"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2=="categoria" || valueFiltro2=="noticias" || valueFiltro2=="actualidad"|| valueFiltro2=="tecnologia"
                    || valueFiltro2=="ocio"|| valueFiltro2=="deportes"|| valueFiltro2=="musica"
                    || valueFiltro2=="fotografia"|| valueFiltro2=="politica" || valueFiltro2=="educativo"){ 
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
        }
    }
*/

/*BACKUP FUNCIÓN ORIGINAL DE LA FECHA DESC */
/*
    if(name==null || name!="fecha" || value!="DESC"){ //Que name sea = a null significa que no existe un filtro previo!!!
        //Envío el filtro nuevo
            $('#mas_recientes').val("DESC");
            $('#mas_recientes').attr('name', 'fecha');
        //Elimino el otro filtro por del mismo tipo ==> ESTO ES PARA UNA FECHA REEMPLAZE A LA OTRA Y EVITAR QUE QUEDE X EJ: ?fecha=DESC&&fecha=ASC 
        if(name=="fecha"){ //Solo si el filtro preexsitente es una fecha lo elimino, en caso que sea una categoría no se elimina porque en ese caso 
            $('#filtro_preexistente').val(""); //si quiero que se sumen en lugar de reemplazarse (fecha+fecha NO fecha+categoría SI)
            $('#filtro_preexistente').attr('name', "");
        }
        //Para los casos en los q haya 2 filtros elimina el que corresponde nameFiltro1 o nameFiltro2:
        if(nameFiltro1=="fecha"){ 
            $('#filtro_preexistente').val("");                
            $('#filtro_preexistente').attr('name', "");           
        }
        else if(nameFiltro2 == "fecha"){
            $('#filtro_preexistente2').val("");                     
            $('#filtro_preexistente2').attr('name', "");           
        }
    }
*/