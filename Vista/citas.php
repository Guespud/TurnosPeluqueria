<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
     
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
                        <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li>
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
                        <li  class="active">
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
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navbar-content">
                                                    <span>GUESPUD BARBER</span>
                                                    <p class="text-muted small">
                                                        GUESPUDBARBER@gmail.com
                                                    </p>
                                                    <div class="divider">
                                                    </div>
                                               
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>

                <div class="user-dashboard">
                    <h1>Citas </h1>

                    <form id="frmAgendaCita" method="POST">
                                           
                        <input type="hidden" name="idregistro" id="idregistro">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" size="50" placeholder="Nombre">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" size="50" placeholder="Direccion">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" class="form-control" name="telefono" id="telefono" placeholder="telefono">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="email" size="50" placeholder="Email">
                                </div>
                            </div>
                            <input type="hidden" name="idcliente" id="idcliente">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha </label>
                                    <input type="date" class="form-control " name="fecha" id="fecha">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="time" class="form-control" name="hora" id="hora" placeholder="Hora">
                                </div>
                            </div>                            

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select name="idservicio" id="idservicio" class="form-control"></select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estilista</label>
                                    <select name="idestilista" id="idestilista" class="form-control"></select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">                                    
                                    <textarea name="mensaje" id="mensaje" cols="30" rows="7" class="form-control " placeholder="Mensaje">
                                    </textarea>
                                </div>
                            </div>

                       <button type="button" name="action" id="registroCita" class="btn btn-success">Registrar</button>
                       <button type="button" name="action" id="cancelar" class="btn btn-danger">Cancelar</button>

                    <br>
                        <br>
                        <br>
                        <br>
                        <br>

                    </form>


                    <div class="container">

                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No. Cita</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Celular</th>
                                    <th>Mensaje</th>
                                    <th>Servicio</th> 
                                    <th>Estilista</th>
                                    <th>Estado</th>
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
    </div>
</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


<script src="../js/dashboard.js"></script>
<script src="../js/agendacitas.js"></script>
<script src="../js/citas.js"></script>
</html>