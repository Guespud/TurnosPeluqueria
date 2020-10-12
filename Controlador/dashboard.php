<?php

include '../Modelo/usuario.php';

class dashboard{

    function __construct()
    {
        
    }

    function iniciarSession(){

        $usuaario = $_POST['userName'];
        $contrasenia = $_POST['userPassword'];

        $ModelUsuario = new usuario();
        $valsession = $ModelUsuario->validarSession($usuaario,$contrasenia);

        if($valsession){ 
            header('Location: ../Vista/dashboard.php');
        }else{
            header('Location: ../Vista/sesion.php');
        }
    }
}

$objSession = new dashboard();

switch($_POST['accion']){
    case 'btnLogin':
        echo ':)';
        $objSession->iniciarSession();
    break;
    default:
        echo 'llorelo :V';
    break;
}