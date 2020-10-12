$(function() {
    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarClientes();

    function consultarClientes() {

        $.ajax({
            url: url +'/Controlador/clienteControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {
                console.log("success >>>>");

                console.log(json);

                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.id + '</td>' +
                        '<td>' + value.nombre + '</td>' +
                        '<td>' + value.direccion + '</td>' +
                        '<td>' + value.telefono + '</td>' +
                        '<td>' + value.email + '</td>' +                                                
                        '</tr>';
                });

                table.destroy();
                $("#example tbody").html(datos);
                table = $('#example').DataTable();
            }
        });
    }
});