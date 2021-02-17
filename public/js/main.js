function responder(idnumber){
    $("#responder_"+idnumber).append("<textarea name='answer' cols='50' rows='5'></textarea><input type='submit' style='float: right' class='bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100' value='Responder'>");
    $("#responder"+idnumber).remove()
}