<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="../css/dashboard.css">
<!------ Include the above in your HEAD tag ---------->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html"><!-- <img src="http://jskrishna.com/work/merkury/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm"> -->
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
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <!-- <li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Add Project</a></li>
                                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            <span class="label label-primary">3</span>
                                        </a>
                                    </li> -->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- <img src="http://jskrishna.com/work/merkury/images/user-pic.jpg" alt="user"> -->
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navbar-content">
                                                    <span>G BARBER</span>
                                                    <p class="text-muted small">
                                                     GBARBER@gmail.com
                                                    </p>
                                                    <div class="divider">
                                                    </div>
                                                  <!--   <a href="#" class="view btn-sm active">Perfil</a> -->
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
                

                    <h1>Barber Guespud </h2>
                    <br>
                        <p>- Eres un artista que con tus manos trabajas la pasión, el perfeccionamiento y la belleza, buscas en esta profesión realzar lo extraordinario que hay en cada uno de tus clientes.</p>
<br>
                        <p>-Agradezco tus atenciones, siempre que voy a tu peluquería me atiendes de manera muy grata, el look siempre es original e impresionante y la calidad de servicio es inigualable. Estoy segura que tus clientes están satisfechos por tu grandiosa labor y espectacular talento.</p>
<br>
                        <p>-Valoramos la labor que tienen los peluqueros, porque gracias a ellos tenemos una mejor imagen y apariencia, nos deja dentro de la vanguardia y la moda lo que nos ayuda a atrapar miradas. </p>
                   <!--  <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">

                            <div class="sales">
                                <h2>Your Sale</h2>

                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">

                            <div class="sales report">
                                <h2>Report</h2>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Period:</span> Last Year
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#">2012</a>
                                        <a href="#">2014</a>
                                        <a href="#">2015</a>
                                        <a href="#">2016</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
</html>