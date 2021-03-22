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
