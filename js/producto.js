$(function() {
    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarProductos();

    $("#example tbody").on('click', '#eliminar', function() {

        console.log("eliminar click ");
        var id = $(this).attr("data-id");

        console.log("id >> " + id);

        $.ajax({
            url: url + '/Controlador/productoControlador.php',
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
            url: url + '/Controlador/productoControlador.php',
            type: 'POST',
            data: { action: 'consultarById', id: id },
            dataType: 'json',
            success: function(json) {

                document.getElementById("nombre").value = json[0].nombreProducto;
                document.getElementById("descripcion").value = json[0].desProducto;
                document.getElementById("valor").value = json[0].valorProducto;  
                document.getElementById("id").value = json[0].idProducto;                
            }
        });
    });

    function consultarProductos() {

        $.ajax({
            url: url +'/Controlador/productoControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {
           
                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.idProducto + '</td>' +
                        '<td>' + value.nombreProducto + '</td>' +
                        '<td>' + value.desProducto + '</td>' +
                        '<td>' + value.valorProducto + '</td>' +                        
                        '<td>'+
                            '<button class="btn btn-warning" id="editar"  data-id="' + value.idProducto + '"  >Editar</button> ' +
                            '<button class="btn btn-danger" id="eliminar"  data-id="' + value.idProducto + '"  >Eliminar</button>' +
                        '</td>'+
                        '</tr>';
                });

                table.destroy();
                $("#example tbody").html(datos);
                table = $('#example').DataTable();
            }
        });
    }
});