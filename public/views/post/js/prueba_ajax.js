/* V20 */
/*
$(document).on('ready', function() {
    $(".pagina").click(function() {
        alert($(this).attr('pagina'));
    });
});
*/
$(document).ready(function() {
    $(".pagina").click(function() {
        //alert($(this).attr('pagina'));
        paginacion($(this).attr('pagina'));
    });

    $(document).on("click", ".pagina", function() {
        //Esto es para que funcione los otros de paginacion
        //una vez presionada la primera vez
        //x q se cargaron dinamicamente
        paginacion($(this).attr("pagina"));
    });
    var paginacion = function(pagina) {
        var pagina = 'pagina=' + pagina;
        //alert('Dentro var paginacion ' + pagina);
        $.post(_root_ + 'post/pruebaAjax', pagina, function(data) {
            $("#lista_registros").html('');
            $("#lista_registros").html(data);
        });
    }
});