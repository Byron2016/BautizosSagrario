/* V20 - V21 */
/*
$(document).on('ready', function() {
    $(".pagina").click(function() {
        alert($(this).attr('pagina'));
    });
});
*/
$(document).ready(function() {
    /*
    $(".pagina").click(function() {
        //alert($(this).attr('pagina'));
        paginacion($(this).attr('pagina'));
    });
    */

    $(document).on("click", ".pagina", function() {
        //Esto es para que funcione los otros de paginacion
        //una vez presionada la primera vez
        //x q se cargaron dinamicamente
        paginacion($(this).attr("pagina"));
    });
    var paginacion = function(pagina) {
        var pagina = 'pagina=' + pagina;
        var nombre = '&nombre=' + $('#nombre').val(); //V21
        var pais = '&pais=' + $('#pais').val(); //V21
        var ciudad = '&ciudad=' + $('#ciudad').val(); //V21
        var registros = '&registros=' + $('#registros').val(); //V21
        //alert('Dentro var paginacion ' + pagina);
        /*
        //cometado V21
        $.post(_root_ + 'post/pruebaAjax', pagina, function(data) {
            $("#lista_registros").html('');
            $("#lista_registros").html(data);
        });
        */
        //V21
        //alert('Dentro var paginacion ' + _root_ + 'post/pruebaAjax', pagina + nombre + pais + ciudad + registros);
        $.post(_root_ + 'post/pruebaAjax', pagina + nombre + pais + ciudad + registros, function(data) {
            $("#lista_registros").html('');
            $("#lista_registros").html(data);
        });
    }


    $('#pais').change(function() {
        $.ajax({
            url: _root_ + '/ajax/getCiudades',
            type: "post",
            dataType: "json",
            data: 'pais=' + $("#pais").val(),
            success: function(datos) {
                $("#ciudad").html('<option value=""> - Seleccione un país - </option>');
                for (var i = 0; i < datos.length; i++) {
                    $("#ciudad").append('<option value="' + datos[i].id + '">' + datos[i].ciudad + '</option>');
                }
                //alert('entro pais cambio ');
                $('#ciudad').val() = '';
                paginacion();
            }
        });
        //alert('2');
        $("#ciudad").html('<option value=""> - Seleccione un país - </option>');
        //alert('3');
        paginacion();
    });

    $('#btnEnviar').click(function() {
        paginacion();

    });

    $('#ciudad').change(function() {
        if ($('#pais').val()) {
            paginacion()
        };
    });


    $(document).on("click", "#registros", function() {
        paginacion();
    });


});