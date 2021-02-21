function responder(idnumber){
    $("#responder_"+idnumber).append("<textarea name='answer' cols='50' rows='5'></textarea><input type='submit' style='float: right' class='bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100' value='Responder'>");
    $("#responder"+idnumber).remove()
}


//TAGS:

//ENDTAGS  

//

function prueba(id){

    //ENVIAR FILTRO PREEXISTENTE SI ES QUE LO HAY:

        var name = null; //name null sirve para + abajo consultarlo y poder saber si existe un filtro previo. De mantenerse = a null es porque no existe.

            //Tomo la URL y la paso a Sting para poder editarla.
                var url = window.location.toString();

            //Consulto cuantas veces aparece el caracter = en la URL:
                var matchesCount = url.split("=").length - 1;

                //NOTA: 
                //También funciona hacer:
                    //var matchesCount = url.match(/=/g).length;

            //Si aparece 1 es porque hay un filtro preexistente entonces lo tomo:
                if(matchesCount==1){
                    //Tomo de la URL lo que esté después del "?"
                        var posicion1 = url.indexOf("?");
                        var filtro = url.slice(posicion1+1); //+1 Para que no incluya al ?. Daría como resultado el filtro por ej: categoria=9
                    
                    //Guardo el name y el value correspondiente al filtro separando el contenido a ambos lados del "="
                        var posicionIgual = filtro.indexOf("=");
                        var name = filtro.slice(0, posicionIgual); //Cargo el name, del filtro previo
                        var value = filtro.slice(posicionIgual+1); //Cargo el value, del filtro previo
                        //alert(" name: " + name + ", value: " + value);

                    //Guardo el name y el value en el index hidden para que llegue al PostController:
                        $('#filtro_preexistente').val(value);
                        $('#filtro_preexistente').attr('name', name);
                }

    //ENVIAR FILTRO NUEVO QUE SE SUMARÁ AL PREEXISTENTE SI ES QUE LO HAY

    //!!!!!IMPORTANTE: EL FILTRO SE DEBERÁ SUMÁS SOLO SI NO HAY YA UN FILTRO DE LA MISMA CATEGRÍA (CON EL MISMO NAME), ENCASO DE QUE LO HAYA, NO SE DEBE SUMAR,
    //SINO REEMPLAZARLO. ES DECIR NO QUIERO QUE QUEDE X EJ  ?fecha=DESC&&fecha=ASC o  ?categoria=1&&categoria=3 sino que en estos casos se reemplaze la 
    //fecha DESC X LA ASC y en el 2do la categoría 1 x la 3 

        if(id=="button_mas_recientes"){
            //SOLAMENTE Si no hay filtro preexistente o -El filtro no es por fecha (su name != a fecha), o si el value == "ASC"
                if(name==null || name!="fecha" || value!="DESC"){ //Que name sea = a null significa que no existe un filtro previo!!!
                    //Envío el filtro nuevo
                        $('#mas_recientes').val("DESC");
                        $('#mas_recientes').attr('name', 'fecha');
                    //Elimino el otro filtro por del mismo tipo ==> ESTO ES PARA UNA FECHA REEMPLAZE A LA OTRA Y EVITAR QUE QUEDE X EJ: ?fecha=DESC&&fecha=ASC 
                    if(name=="fecha"){ //Solo si el filtro preexsitente es una fecha lo elimino, en caso que sea una categoría no se elimina porque en ese caso 
                        $('#filtro_preexistente').val(""); //si quiero que se sumen en lugar de reemplazarse (fecha+fecha NO fecha+categoría SI)
                        $('#filtro_preexistente').attr('name', "");
                    }
                }
        }

        //Lo mismo que hice con el da arriba lo hago con todos los demás pero no les pongo los comentarios

        else if(id=="button_mas_antiguos"){
            if(name==null || name!="fecha" || value!="ASC"){
                $('#mas_antiguos').val("ASC");
                $('#mas_antiguos').attr('name', 'fecha');
                if(name=="fecha"){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }

        else if(id=="button_noticias"){
            if(name==null || name!="categoria" || value!="noticias"){
                $('#noticias').val("1");
                $('#noticias').attr('name', 'categoria');
                if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                    || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                    || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                    || value=="Ocio" || value=="OCIO" || value=="ocio"
                    || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                    || value=="Musica" || value=="MUSICA" || value=="musica"
                    || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                    || value=="Politica" || value=="POLITICA"  || value=="politica" 
                    || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
                    ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_actualidad"){
            if(name==null || name!="categoria" || value!="actualidad"){
                $('#actualidad').val("2");
                $('#actualidad').attr('name', 'categoria');
                if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                    || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                    || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                    || value=="Ocio" || value=="OCIO" || value=="ocio"
                    || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                    || value=="Musica" || value=="MUSICA" || value=="musica"
                    || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                    || value=="Politica" || value=="POLITICA"  || value=="politica" 
                    || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_tecnologia"){
            if(name==null || name!="categoria" || value!="tecnologia"){
                $('#tecnologia').val("3");
                $('#tecnologia').attr('name', 'categoria');
                if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                    || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                    || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                    || value=="Ocio" || value=="OCIO" || value=="ocio"
                    || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                    || value=="Musica" || value=="MUSICA" || value=="musica"
                    || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                    || value=="Politica" || value=="POLITICA"  || value=="politica" 
                    || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_ocio"){
            if(name==null || name!="categoria" || value!="ocio"){
                $('#ocio').val("4");
                $('#ocio').attr('name', 'categoria');
                if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                    || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                    || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                    || value=="Ocio" || value=="OCIO" || value=="ocio"
                    || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                    || value=="Musica" || value=="MUSICA" || value=="musica"
                    || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                    || value=="Politica" || value=="POLITICA"  || value=="politica" 
                    || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_deportes"){
            if(name==null || name!="categoria" || value!="deportes"){
                $('#deportes').val("5");
                $('#deportes').attr('name', 'categoria');
                if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                    || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                    || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                    || value=="Ocio" || value=="OCIO" || value=="ocio"
                    || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                    || value=="Musica" || value=="MUSICA" || value=="musica"
                    || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                    || value=="Politica" || value=="POLITICA"  || value=="politica" 
                    || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_musica"){
            if(name==null || name!="categoria" || value!="musica"){
            $('#musica').val("6");
            $('#musica').attr('name', 'categoria');
            if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                || value=="Ocio" || value=="OCIO" || value=="ocio"
                || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                || value=="Musica" || value=="MUSICA" || value=="musica"
                || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                || value=="Politica" || value=="POLITICA"  || value=="politica" 
                || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
            ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_fotografia"){
            if(name==null || name!="categoria" || value!="fotografia"){
            $('#fotografia').val("7");
            $('#fotografia').attr('name', 'categoria');
            if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                || value=="Ocio" || value=="OCIO" || value=="ocio"
                || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                || value=="Musica" || value=="MUSICA" || value=="musica"
                || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                || value=="Politica" || value=="POLITICA"  || value=="politica" 
                || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo" 
            ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_politica"){
            if(name==null || name!="categoria" || value!="politica"){
            $('#politica').val("8");
            $('#politica').attr('name', 'categoria');
            if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                || value=="Ocio" || value=="OCIO" || value=="ocio"
                || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                || value=="Musica" || value=="MUSICA" || value=="musica"
                || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                || value=="Politica" || value=="POLITICA"  || value=="politica" 
                || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo"
            ){ 
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        else if(id=="button_educativo"){
            if(name==null || name!="categoria" || value!="educativo"){
            $('#educativo').val("9");
            $('#educativo').attr('name', 'categoria');
            if(name=="categoria" || value=="Noticias" || value=="NOTICIAS" 
                || value=="noticias" || value=="Actualidad" || value=="ACTUALIDAD" || value=="actualidad"
                || value=="Tecnologia" || value=="TECNOLOGIA"  || value=="tecnologia"
                || value=="Ocio" || value=="OCIO" || value=="ocio"
                || value=="Deportes" || value=="DEPORTES" || value=="deportes"
                || value=="Musica" || value=="MUSICA" || value=="musica"
                || value=="Fotografia" || value=="FOTOGARFIA" || value=="fotografia"
                || value=="Politica" || value=="POLITICA"  || value=="politica" 
                || value=="educativo" || value=="EDUCATIVO"  || value=="Educativo"
            ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
            }
        }
        
  
}