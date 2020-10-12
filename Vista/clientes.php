<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                        <li  class="active">
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
                        </div>
                    </header>
                </div>

                 <div class="user-dashboard">
                    <h1>Clientes </h1>


                    <div class="container">

                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
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

    </div>
<?php  unset($_SESSION['status']);unset($_SESSION['statusAlert']);unset($_SESSION['statusMessage']) ?>
</body>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="../js/dashboard.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="../js/clientes.js"></script>


</html>