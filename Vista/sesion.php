<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" href="../css/sesion.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body style="background-image: url('../images/bg-1.jpg');">

    <div class="container" >
        <div class="row">
            <div class="col-md-offset-5 col-md-3">
                <div class="form-login">
                    <?php  if(isset($_SESSION['status'])){?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Error!</strong> <?php  echo $_SESSION['status']; ?>
                        </div> 
                    <?php session_destroy(); session_unset(); }?>

                    <form action="../Controlador/dashboard.php" method="POST"> 
                        <h4>Bienvenido Estilista.</h4>
                        <input type="text" name="userName" id="userName" class="form-control input-sm chat-input" placeholder="username" />
                        </br>
                        <input type="password" name="userPassword" id="userPassword" class="form-control input-sm chat-input" placeholder="password" />
                        </br>
                        <div class="wrapper">
                        <span class="group-btn">                 
                            <button type="submit" name="accion" value="btnLogin" class="btn btn-primary btn-md">
                                login <i class="fa fa-sign-in"></i>
                            </button>      
                            <a href="../index.html"><input type="button" value="Inicio"></a>                                                            
                        </span>
                        </div>
                    </form>               
                </div>            
            </div>
        </div>
    </div>
</body>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</html>