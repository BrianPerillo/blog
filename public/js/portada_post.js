
$( "#cover_file" ).change(function() {
    var cover_file_value = $("#cover_file").val();
    $("#img_seleccionada p").remove();
    $("#img_seleccionada").append("<p>Archivo seleccionado: "+cover_file_value+"</p>");
});