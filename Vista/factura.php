<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!------ Include the above in your HEAD tag ---------->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>

<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html">
                        <!-- <img src="http://jskrishna.com/work/merkury/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm"> -->
                        <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li  class="active">
                            <a href="dashboard.php">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="usuario.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Administradores</span></a>
                        </li>
                        <li>
                            <a href="estilista.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Estilista</span></a>
                        </li>
                        <li>
                            <a href="clientes.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Clientes</span></a>
                        </li>
                        <li>
                            <a href="citas.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Citas</span></a>
                        </li>                       
                        <li>
                            <a href="producto.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Productos</span></a>
                        </li>
                        <li>
                            <a href="factura.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Facturas</span></a>
                        </li> 
                        <li>
                            <a href="exit.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Exit</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <!--  <div class="search hidden-xs hidden-sm">
                                <input type="text" placeholder="Search" id="search">
                            </div> -->
                        </div>

                    </header>
                </div>

                <h3>Facturación</h3>


                <form action="../Controlador/facturaControlador.php" id="frmFactura" method="POST">  

                    <div class="container">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Cita</label>
                                <select name="cita" id="cita" class="form-control">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label>Nombre Cliente</label>
                                <input type="text" name="cliente" id="cliente" size="50" required class="form-control"/>
                            </div>
                           
                            <div class="form-group">
                                <label>Email Cliente</label>
                                <input type="text" name="email" id="email" size="50" required class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label>Estilista</label>
                                <input type="text" name="estilista" id="estilista" size="50" required class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección Cliente</label>
                                <input type="text" name="direcliente" id="direcliente" size="50" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Telefono Cliente</label>
                                <input type="text" name="telcliente" id="telcliente" size="50" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Telefono Estilista</label>
                                <input type="text" name="telestilista" id="telestilista" size="50" required class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="col-md-12">                            
                            <table class="table table-bordered table-striped" id="tbServicios">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th colspan="2">Producto</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                </tbody>
                                <tfoot>
                                    <tr>                                        
                                        <th colspan="3" style="text-align: right;">Descuentos</th>
                                        <td> <input type="number" name="descuento" id="descuento" class="form-control" value="0" min="0"></td>
                                    </tr>
                                    <tr>                                        
                                        <th colspan="3" style="text-align: right;">Subtotal 
                                            <input type="hidden" name="subtotal">
                                            <input type="hidden" name="subtotalini">
                                        </th>
                                        <td id="subtotal"></td>
                                    </tr>                                   
                                    <tr>                                        
                                        <th colspan="3" style="text-align: right;">Iva                                             
                                        </th>
                                        <td><input type="number" name="iva" id="iva" class="form-control" value="0"  min="0"></td>
                                    </tr>
                                    <tr>                                    
                                        <th colspan="3" style="text-align: right;">Total 
                                            <input type="hidden" name="total">
                                            <input type="hidden" name="totalini">
                                        </th>
                                        <td id="total"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    <button type="submit" name="action" value="registrar" class="btn btn-success">Registrar</button>
                   <button type="button" name="action" id="cancelar" class="btn btn-danger">Cancelar</button>

                </form>
                <br><br><br><br>


<h1>LOS RECIBOS SE GUARDAN EN LA CARPETA REPORTES EN LA RAIZ DEL PROYECTO</h1>

                <div class="container">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No. Fact</th>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Fecha</th>
                                <th>Hora</th>                                
                                <th>Mensaje</th>
                                <th>Servicio</th>
                                <th>Estilista</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Project Title" name="name">
                    <input type="text" placeholder="Post of Post" name="mail">
                    <input type="text" placeholder="Author" name="passsword">
                    <textarea placeholder="Desicrption"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>

</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="../js/dashboard.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="../js/factura.js"></script>

</html>