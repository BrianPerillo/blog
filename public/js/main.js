function responder(idnumber){
    $("#responder_"+idnumber).append("<textarea name='answer' cols='50' rows='5'></textarea><input type='submit' style='float: right' class='bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100' value='Responder'>");
    $("#responder"+idnumber).remove()
}


//TAGS:

//ENDTAGS  

//

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

            //SI APARECE 1 es porque hay un filtro preexistente entonces lo tomo:
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

                    $('#filtro_preexistente').val(valueFiltro1);
                    $('#filtro_preexistente').attr('name', nameFiltro1);

                    $('#filtro_preexistente2').val(valueFiltro2);
                    $('#filtro_preexistente2').attr('name', nameFiltro2);
                    

                }

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
                if(nameFiltro1=="fecha"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "fecha"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }

        else if(id=="button_noticias"){
            if(name==null || name!="categoria" || value!="noticias"){
                $('#noticias').val("1");
                $('#noticias').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"   //En caso que la búsqueda previa se haya realizado por el search
                    || value=="ocio"|| value=="deportes"|| value=="musica"              //No voy a tener un name identificativo sea categoria o tag x ej el name
                    || value=="fotografia"|| value=="politica" || value=="educativo"    //va a ser search, por ende filtro por el value, si es actualidad, noticias,
                    ){                                                                  //etc.. limpiá el #fiiltro_preexistente
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_actualidad"){
            if(name==null || name!="categoria" || value!="actualidad"){
                $('#actualidad').val("2");
                $('#actualidad').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_tecnologia"){
            if(name==null || name!="categoria" || value!="tecnologia"){
                $('#tecnologia').val("3");
                $('#tecnologia').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_ocio"){
            if(name==null || name!="categoria" || value!="ocio"){
                $('#ocio').val("4");
                $('#ocio').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_deportes"){
            if(name==null || name!="categoria" || value!="deportes"){
                $('#deportes').val("5");
                $('#deportes').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                    $('#filtro_preexistente').val("");
                    $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_musica"){
            if(name==null || name!="categoria" || value!="musica"){
                $('#musica').val("6");
                $('#musica').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");
                        $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_fotografia"){
            if(name==null || name!="categoria" || value!="fotografia"){
                $('#fotografia').val("7");
                $('#fotografia').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");
                        $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        else if(id=="button_politica"){
            if(name==null || name!="categoria" || value!="politica"){
                $('#politica').val("8");
                $('#politica').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");
                        $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
                    
            }
        }
        else if(id=="button_educativo"){
            if(name==null || name!="categoria" || value!="educativo"){
                $('#educativo').val("9");
                $('#educativo').attr('name', 'categoria');
                if(name=="categoria" 
                    || value=="noticias" || value=="actualidad"|| value=="tecnologia"
                    || value=="ocio"|| value=="deportes"|| value=="musica"
                    || value=="fotografia"|| value=="politica" || value=="educativo" 
                ){
                        $('#filtro_preexistente').val("");
                        $('#filtro_preexistente').attr('name', "");
                }
                if(nameFiltro1=="categoria"){ 
                    $('#filtro_preexistente').val("");              
                    $('#filtro_preexistente').attr('name', "");           
                }
                else if(nameFiltro2 == "categoria"){
                    $('#filtro_preexistente2').val("");                     
                    $('#filtro_preexistente2').attr('name', "");           
                }
            }
        }
        
  
}