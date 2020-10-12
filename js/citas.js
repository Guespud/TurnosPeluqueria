$(function() {

    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarCita();

    $("#registroCita").on('click',function() {

        event.preventDefault();

        var nombre = $("#nombre").val();
        var direccion = $("#direccion").val();
        var telefono= $("#telefono").val();
        var email = $("#email").val();
        var fecha= $("#fecha").val();
        var hora= $("#hora").val();
        var mensaje= $("#mensaje").val();
        var idservicio= $("#idservicio").val();
        var idestilista= $("#idestilista").val();
        var idregistro = $("#idregistro").val();
        var idcliente = $("#idcliente").val();

        $.ajax({
            url: url + '/Controlador/citasControlador.php',
            type: 'POST',
            data: { action: 'registrar',
                nombre: nombre,
                direccion: direccion,
                telefono: telefono,
                email: email,
                fecha: fecha,
                hora: hora,
                mensaje: mensaje,
                idservicio: idservicio,
                idestilista: idestilista,
                idregistro: idregistro,
                idcliente: idcliente
            },
            dataType: 'json',
            success: function(json) {
             
                var html = '<div class="alert '+json.statusAlert +' alert-dismissable">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<strong>'+ json.status +'!</strong>' + json.statusMessage +
                        '</div> ';

                $("#frmAgendaCita").prepend(html);

                limpiarRegistroCita();
                consultarCita();
            }
        });
    });

    $("#cancelar").on('click',function() {
        event.preventDefault();
        limpiarRegistroCita();
    });

    function limpiarRegistroCita(){

        $('#idregistro').val("");
        $('#direccion').val("");
        $('#telefono').val("");
        $('#email').val("");
        $('#fecha').val("");
        $('#hora').val("");
        $('#idservicio').val("");
        $('#idestilista').val("");
        $('#mensaje').val("");
        $('#idcliente').val("");
        $('#nombre').val("");

        $('#nombre').removeAttr('disabled');
        $('#direccion').removeAttr('disabled');
        $('#telefono').removeAttr('disabled');
        $('#email').removeAttr('disabled');
    }

    $("#example tbody").on('click', '#eliminar', function() {

        var id = $(this).attr("data-id");
    
        $.ajax({
            url: url +'/Controlador/citasControlador.php',
            type: 'POST',
            data: { action: 'eliminar', id: id },
            dataType: 'json',
            success: function(json) {                
                location.reload(true);
            }
        });
    });

    $("#example tbody").on('click', '#editar', function() {

        var id = $(this).attr("data-id");

        $.ajax({
            url: url +'/Controlador/citasControlador.php',
            type: 'POST',
            data: { action: 'consultarCitaById', id: id },
            dataType: 'json',
            success: function(json) {

                $('#idregistro').val(json[0].idCita);
                $('#direccion').val(json[0].direccion);
                $('#telefono').val(json[0].celular);
                $('#email').val(json[0].email);
                $('#fecha').val(json[0].fecha);
                $('#hora').val(json[0].hora);
                $('#idservicio').val(json[0].idProducto);
                $('#idestilista').val(json[0].idEstilista);
                $('#mensaje').val(json[0].descripcion);
                $('#idcliente').val(json[0].idCliente);
                $('#nombre').val(json[0].cliente);

                $('#nombre').attr('disabled','true');
                $('#direccion').attr('disabled','true');
                $('#telefono').attr('disabled','true');
                $('#email').attr('disabled','true');
            }
        });
    });

    $("#example tbody").on('click', '#atender', function() {

        var id = $(this).attr("data-id");

        $.ajax({
            url: url +'/Controlador/citasControlador.php',
            type: 'POST',
            data: { action: 'atenderCita', id: id },
            dataType: 'json',
            success: function(json) {

                var html = '<div class="alert '+json.statusAlert +' alert-dismissable">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            '<strong>'+ json.status +'!</strong>' + json.statusMessage +
                        '</div> ';

                $("#frmAgendaCita").prepend(html);

                consultarCita();
            }
        });
    });

    function consultarCita() {

        $.ajax({
            url: url + '/Controlador/citasControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {          
                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.idCita + '</td>' +
                        '<td>' + value.cliente + '</td>' +                        
                        '<td>' + value.fecha + '</td>' +
                        '<td>' + value.hora + '</td>' +
                        '<td>' + value.celular + '</td>' +                         
                        '<td>' + value.descripcion + '</td>' +
                        '<td>' + value.nombreProducto + ' - ' + value.desProducto + '</td>' +
                        '<td>' + value.estilista + '</td>' +
                        '<td>' + value.estado + '</td>' +
                        '<td>'+
                            '<button class="btn btn-warning" id="editar"  data-id="' + value.idCita + '"  ><i class="fa fa-pencil-square" aria-hidden="true"></i></button> '+
                            '<button class="btn btn-info" id="atender"  data-id="' + value.idCita + '"  ><i class="fa fa-check-square-o" aria-hidden="true"></i></button> '+
                            '<button class="btn btn-danger" id="eliminar"  data-id="' + value.idCita + '"  ><i class="fa fa-trash" aria-hidden="true"></i></button>'+
                        '</td>' +
                        '</tr>';
                });

                table.destroy();
                $("#example tbody").html(datos);
                table = $('#example').DataTable();
            }
        });
    }


});