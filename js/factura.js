$(function() {
    
    var url = window.location.origin + '/'+ window.location.pathname.split('/')[1];
    var table = $('#example').DataTable();

    consultarCitaRealizada();
    consultarFaturas();

    $("#example tbody").on('click', '#generarPDF', function() {

        console.log("generar click ");
        var id = $(this).attr("data-id");

        console.log("id >> " + id);

        $.ajax({
            url: url +'/Controlador/facturaControlador.php',
            type: 'POST',
            data: { action: 'generarPDF', id: id },
            dataType: 'json',
            success: function(json) {
                console.log(json);
            }
        });
    });

    $("#frmFactura").on('change', '#cita', function() {

        console.log("cita change ");
        var id = $(this).val();

        console.log("id >> " + id);

        $.ajax({
            url: url + '/Controlador/facturaControlador.php',
            type: 'POST',
            data: { action: 'consultarCitaById', id: id },
            dataType: 'json',
            success: function(json) {
                console.log(json);

                $('#cliente').val(json[0].cliente);
                $('#email').val(json[0].email);
                $('#estilista').val(json[0].estilista);
                $('#direcliente').val(json[0].direcliente);
                $('#telcliente').val(json[0].celular);
                $('#telestilista').val(json[0].telestilista);

                numberFormat = new Intl.NumberFormat('es-ES');

                var html = '<tr>'+
                                '<td  style="text-align: right;">'+json[0].idProducto +'</td>'+
                                '<td colspan="2">'+json[0].nombreProducto + ' - '+ json[0].desProducto +'</td>'+
                                '<td  style="text-align: right;">'+numberFormat.format(json[0].valorProducto) +'</td>'+
                            '</tr>';

                $('#tbServicios tbody').html(html);
                $('input[name=subtotal]').val(json[0].valorProducto);
                $('input[name=total]').val(json[0].valorProducto);
                $('input[name=subtotalini]').val(json[0].valorProducto);
                $('input[name=totalini]').val(json[0].valorProducto);
                $('#subtotal').html(numberFormat.format(json[0].valorProducto));
                $('#total').html(numberFormat.format(json[0].valorProducto));

                $('#descuento').attr('max',json[0].valorProducto);
            }
        });
    });

    $("#tbServicios").on('change', '#descuento', function() {
       
        var valor = $(this).val();    
        var subtotal = $("input[name=subtotalini]").val();
        var nuevosubtotal = (subtotal - valor);
        $("input[name=subtotal]").val(nuevosubtotal);
        $("#subtotal").text(numberFormat.format(nuevosubtotal));

        var valoriva =  $("input[name=iva]").val();
        valoriva = parseInt(valoriva);        
        var nuevototal = parseInt(nuevosubtotal + valoriva);        
        $("input[name=total]").val(nuevototal);
        $("td#total").html(numberFormat.format(nuevototal));
    });

    $("#tbServicios").on('change', '#iva', function() {
        
        var valor = $(this).val();
        valor = parseInt(valor);    
        var subtotal = $("input[name=subtotal]").val();
        subtotal = parseInt(subtotal);        
        var nuevototal = parseInt(subtotal + valor);        
        $("input[name=total]").val(nuevototal);
        $("#total").html(numberFormat.format(nuevototal));
    });

    function consultarFaturas () {

        $.ajax({
            url: url + '/Controlador/facturaControlador.php',
            type: 'POST',
            data: { action: 'consultar' },
            dataType: 'json',
            success: function(json) {
                
                console.log("success >>>>");

                console.log(json);

                var datos = '';

                $.each(json, function(ind, value) {
                    datos += '<tr>' +
                        '<td>' + value.idFactura + '</td>' +
                        '<td>' + value.cliente + '</td>' +
                        '<td>' + value.email + '</td>' +
                        '<td>' + value.telefono + '</td>' +
                        '<td>' + value.fecha + '</td>' +
                        '<td>' + value.hora + '</td>' +
                        '<td>' + value.descripcion + '</td>' +
                        '<td>' + value.nombreProducto + '</td>' +
                        '<td>' + value.estilista + '</td>' +
                        '<td>'+
                            '<button class="btn btn-info" id="generarPDF" data-id="' + value.idFactura + '"  >'+
                                '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>'+
                            '</button>'+
                        '</td>' +
                        '</tr>';
                });
                 
                table.destroy();
        
                $("#example tbody").html(datos);
                
                table = $('#example').DataTable();
            }
        });
    }

    function consultarCitaRealizada() {

        $.ajax({
            url: url +'/Controlador/facturaControlador.php',
            type: 'POST',
            data: { action: 'consultarCitasRealizadas' },
            dataType: 'json',
            success: function(json) {
               
                var datos = '<option value="">Seleccione...</option>';

                $.each(json, function(ind, value) {
                    datos += '<option value=' + value.idCita + '>' + value.nombre + ' - ' + value.fecha + ' '+ value.hora + ' - '+ value.descripcion +'</option>';
                });

                $("#cita").html(datos);

            }
        });
    }

});