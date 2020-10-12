<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include '../Modelo/agendacitas.php';

    class agendaCitasControlador{

        function __construct()
        {
            
        }

        function crearcita(){
                        
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $mensaje = $_POST['mensaje'];
            $idservicio = $_POST['idservicio'];
            $idestilista = $_POST['idestilista'];
            
            $ModeloCita = new agendaCitas();
            
            $regcita = $ModeloCita->registrarCitas($nombre,$direccion,$telefono, $email,$fecha,$hora,$mensaje,$idservicio, $idestilista);
            
            echo json_encode($regcita);
        }
       
        function consultarTipoServicio(){

            $ModeloCita = new agendaCitas();
            $tipoServicio =  $ModeloCita->consultarTipoServicio();

            if(is_array($tipoServicio)){
                echo json_encode($tipoServicio);
            }
        }

        function consultarEstilista(){

            $ModeloCita = new agendaCitas();
            $estilistas =  $ModeloCita->consultarEstilista();

            if(is_array($estilistas)){
                echo json_encode($estilistas);
            }
        }
    }

    $objcitasControlador = new agendaCitasControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objcitasControlador->crearcita();
            break;        
        case 'consultarTipoServicio':
            $objcitasControlador->consultarTipoServicio();
            break;
        case 'consultarEstilista':
            $objcitasControlador->consultarEstilista();
            break;
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>