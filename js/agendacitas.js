$(function() {
    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];


    consultarTipoServicios();
    consultarEstilistas();

    function consultarTipoServicios() {

        $.ajax({
            url: url + '/Controlador/agendaCitasControlador.php',
            type: 'POST',
            data: { action: 'consultarTipoServicio' },
            dataType: 'json',
            success: function(json) {
  
                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<option value=' + value.idProducto + '>' + value.nombreProducto + '</option>';
                });

                $("#idservicio").html(datos);

            }
        });
    }

    function consultarEstilistas() {

        $.ajax({
            url: url + '/Controlador/agendaCitasControlador.php',
            type: 'POST',
            data: { action: 'consultarEstilista' },
            dataType: 'json',
            success: function(json) {
              
                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<option value=' + value.id + '>' + value.nombre + '</option>';
                });

                $("#idestilista").html(datos);

            }
        });
    }


    $("#registrar").on('click',function() {
    
        var nombre = $("#nombre").val();
        var direccion = $("#direccion").val();
        var telefono= $("#telefono").val();
        var email = $("#email").val();
        var fecha= $("#fecha").val();
        var hora= $("#hora").val();
        var mensaje= $("#mensaje").val();
        var idservicio= $("#idservicio").val();
        var idestilista= $("#idestilista").val();

        $.ajax({
            url: url + '/Controlador/agendaCitasControlador.php',
            type: 'POST',
            data: { action: 'registrar',
                nombre: nombre,
                direccion:direccion,
                telefono:telefono,
                email:email,
                fecha:fecha,
                hora:hora,
                mensaje:mensaje,
                idservicio:idservicio,
                idestilista:idestilista
            },
            dataType: 'json',
            success: function(json) {
                
                var html = '<div class="alert '+json.statusAlert +' alert-dismissable">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<strong>'+ json.status +'!</strong>' + json.statusMessage +
                        '</div> ';

                $("#frmAgendaCita").prepend(html);

                limpiarRegistroCita();
            }
        });
    });

    function limpiarRegistroCita(){

        $("#nombre").val("");
        $("#direccion").val("");
        $("#telefono").val("");
        $("#email").val("");
        $("#fecha").val("");
        $("#hora").val("");
        $("#mensaje").val("");
        $("#idservicio").val("");
        $("#idestilista").val("");

    }

});