//V14

$(document).ready(function() {

    var getCiudades = function() {
        $.ajax({
            url: '/ajax/getCiudades',
            type: "post",
            dataType: "json",
            data: 'pais=' + $("#pais").val(),
            success: function(datos) {
                $("#ciudad").html('');
                for (var i = 0; i < datos.length; i++) {
                    $("#ciudad").append('<option value="' + datos[i].id + '">' + datos[i].ciudad + '</option>');
                }
            }
        });
    }

    $("#pais").change(function() {
        if (!$("#pais").val()) {
            $("#ciudad").html('');
        } else {
            getCiudades();
        }
        return false;
    });

    $("#btn_insertar").click(function() {
        //InsertaCiudades();
        //getCiudades();
        $.post('/ajax/insertarCiudad', 'pais=' + $("#pais").val() + '&ciudad=' + $("#ins_ciudad").val(), function(data) {
            //alert("Data: " + data + "\nStatus: " + status);
            //console.log(data);
            $("#ins_ciudad").val('');
            getCiudades();
            //alertify.success('Tus datos han sido insertados correctamente!'); //Mensaje de Datos Correctamente Insertados
        });
        //alert(" es 1 ");

        //alert(" es 2 ");

        //alert(" es 3 ");
        return false;
    });

});

/*
var x;
x=$(document);
x.ready(inicializarEventos);
function inicializarEventos()
{
  var x;
  x=$('#pais');
  x.change(cambioSelect);
  $('#btn_insertar').click(function(){
  	//alert("inicializarEventos presionado boton");
  	    $.post('/ajax/insertarCiudad',
        'pais=' + $("#pais").val() + '&ciudad=' + $("#ins_ciudad").val())
        
        $("#ins_ciudad").val('');
    });
  cambioSelect();
}
function cambioSelect()
{
	//alert("cambioSelect");
	var v = $('#pais').val();
	if(!$('#pais').val()){
		$('#ciudad').html('');
	} else {
		getCiudadesNuevo();
	}
}
function getCiudadesNuevo()
{
	
	//alert("getCiudadesNuevo");
	var v=$("#pais").val();
	$.post('/ajax/getCiudades','pais=' + $('#pais').val(),function(data, status){
		//alert("getCiudadesNuevo luego getCiudades");
		//alert("Data: " + data + "\nStatus: " + status);
		llegadaDatos(data);
	},'json'); 
}
function llegadaDatos(datos)
{
	//alert("llegadaDatos");
  	//alert("Data: " + datos + "\nStatus: " + status);
  	var cantDatos = datos.length;
  	$('#ciudad').html('');
  	
	for(var i=0; i< datos.length; i++){
		$('#ciudad').append('<option value="' + datos[i].id + '">' + datos[i].ciudad + '</option>');
	}
}
function despliegaRespuestaDatos(datos)
{
  	alert("Data: " + datos + "\nStatus: " + status);
}
*/
/*
$(document).ready(function(){
	var getCiudades = function(){
		$.post('/plantilla_mvc.net/ajax/getCiudades','pais=' + $('#pais').val(),function(datos, status){
			alert("Data: " + datos + "\nStatus: " + status);
			$('#ciudad').html('');
			for(var i=0; i< datos.length; i++){
				$('#ciudad').append('<option value="' + datos[i].id + '">' + datos[i].ciudad + '</option>');
			}
		},'json');
	}
		//programación del evento
	$('#pais').change(function(){
		//validacion para cuando se selecciona un pais sin valor
		if(!$('#pais').val()){
			$('#ciudad').html('');
		} else {
			getCiudades();
		}
	});
});
*/
//llena select de las ciudades dependiendo del pais seleccionado
//1ro. url a donde va a mandar los datos
//2do. variables enviadas por post (.val devuelve valor seleccionado en select)
//3ro. parametro datos, es donde van a estar contenidos los datos
//     limpia el select de ciudad: html()
//     
//4to. queremos q lo devuelto sea json
/*
$(document).ready(function() {
    var getCiudades = function() {
            // alert("entro");
            $.post('/ajax/getCiudades', 'pais=' + $('#pais').val(), function(datos, status) {
                // alert("Data: " + datos + "\nStatus: " + status);
                $('#ciudad').html('');
                for (var i = 0; i < datos.length; i++) {
                    $('#ciudad').append('<option value="' + datos[i].id + '">' + datos[i].ciudad + '</option>');
                }
            }, 'json');
        }
        //programación del evento
    $('#pais').change(function() {
        //validacion para cuando se selecciona un pais sin valor
        if (!$('#pais').val()) {
            $('#ciudad').html('');
        } else {
            getCiudades();
        }
    });

    $('#btn_insertar').click(function() {
        //alert("inicializarEventos presionado boton");
        $.post('/ajax/insertarCiudad',
            'pais=' + $("#pais").val() + '&ciudad=' + $("#ins_ciudad").val())

        $("#ins_ciudad").val('');
        getCiudades();
    });

}
});
*/
//llena select de las ciudades dependiendo del pais seleccionado
//1ro. url a donde va a mandar los datos
//2do. variables enviadas por post (.val devuelve valor seleccionado en select)
//3ro. parametro datos, es donde van a estar contenidos los datos
//     limpia el select de ciudad: html()
//     
//4to. queremos q lo devuelto sea json