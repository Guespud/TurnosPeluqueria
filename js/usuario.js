$(function() {
    var url = window.location.origin + '/' + window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarUsuario();

    $("#example tbody").on('click', '#eliminar', function() {

        console.log("eliminar click ");
        var id = $(this).attr("data-id");

        console.log("id >> " + id);

        $.ajax({
            url: url + '/Controlador/usuarioControlador.php',
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
            url: url + '/Controlador/usuarioControlador.php',
            type: 'POST',
            data: { action: 'consultarById', id: id },
            dataType: 'json',
            success: function(json) {

                document.getElementById("nombre").value = json[0].nombre;
                document.getElementById("apellido").value = json[0].apellido;
                document.getElementById("usuario").value = json[0].usuario;
                document.getElementById("id").value = json[0].id;
            }
        });
    });


    function consultarUsuario() {

        $.ajax({
            url: url + '/Controlador/usuarioControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {

                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.id + '</td>' +
                        '<td>' + value.nombre + '</td>' +
                        '<td>' + value.apellido + '</td>' +
                        '<td>' + value.created_at + '</td>' +
                        '<td>' + value.usuario + '</td>' +
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