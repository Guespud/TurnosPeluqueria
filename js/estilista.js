$(function() {
    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarEstilista();

    $("#example tbody").on('click', '#eliminar', function() {

        console.log("eliminar click ");
        var id = $(this).attr("data-id");

        console.log("id >> " + id);

        $.ajax({
            url: url + '/Controlador/estilistaControlador.php',
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
            url: url +'/Controlador/estilistaControlador.php',
            type: 'POST',
            data: { action: 'consultarById', id: id },
            dataType: 'json',
            success: function(json) {

                document.getElementById("nombre").value = json[0].nombre;
                document.getElementById("direccion").value = json[0].apellido;
                document.getElementById("telefono").value = json[0].correo;
            }
        });
    });


    function consultarEstilista() {

        $.ajax({
            url: url +'/Controlador/estilistaControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {
           
                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.id + '</td>' +
                        '<td>' + value.nombre + '</td>' +
                        '<td>' + value.direccion + '</td>' +
                        '<td>' + value.telefono + '</td>' +
                        '<td><button class="btn btn-danger" id="eliminar"  data-id="' + value.id + '"  >Eliminar</button>' +
                        '<button class="btn btn-warning" id="editar"  data-id="' + value.id + '"  >Editar</button></td>' +
                        '</tr>';
                });

                table.destroy();
                $("#example tbody").html(datos);
                table = $('#example').DataTable();
            }
        });
    }



});