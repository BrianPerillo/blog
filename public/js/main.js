function responder(idnumber){
    $("#responder_"+idnumber).append("<textarea name='answer' cols='50' rows='5'></textarea><input type='submit' style='float: right' class='bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100' value='Responder'>");
    $("#responder"+idnumber).remove()
}


//TAGS:

//ENDTAGS  

//

function prueba(id){

    if(id=="button_mas_recientes"){
        $('#mas_recientes').val("DESC");
        $('#mas_recientes').attr('name', 'fecha');
    }
    else if(id=="button_mas_antiguos"){
        $('#mas_antiguos').val("ASC");
        $('#mas_antiguos').attr('name', 'fecha');
    }
    else if(id=="button_noticias"){
        $('#noticias').val("1");
        $('#noticias').attr('name', 'categoria');
    }
    else if(id=="button_actualidad"){
        $('#actualidad').val("2");
        $('#actualidad').attr('name', 'categoria');
    }
    else if(id=="button_tecnologia"){
        $('#tecnologia').val("3");
        $('#tecnologia').attr('name', 'categoria');
    }
    else if(id=="button_ocio"){
        $('#ocio').val("4");
        $('#ocio').attr('name', 'categoria');
    }
    else if(id=="button_deportes"){
        $('#deportes').val("5");
        $('#deportes').attr('name', 'categoria');
    }
    else if(id=="button_musica"){
        $('#musica').val("6");
        $('#musica').attr('name', 'categoria');
    }
    else if(id=="button_fotografia"){
        $('#fotografia').val("7");
        $('#fotografia').attr('name', 'categoria');
    }
    else if(id=="button_politica"){
        $('#politica').val("8");
        $('#politica').attr('name', 'categoria');
    }
    else if(id=="button_educativo"){
        $('#educativo').val("9");
        $('#educativo').attr('name', 'categoria');
    }

}