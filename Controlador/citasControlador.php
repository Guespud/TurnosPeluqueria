<?php 
session_start();

include '../Modelo/agendacitas.php';

    class citasControlador{

        function __construct()
        {
            
        }

        function crearCita(){
        
            $idregistro = $_POST['idregistro'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $mensaje = $_POST['mensaje'];
            $idservicio = $_POST['idservicio'];
            $idestilista = $_POST['idestilista'];
            $idcliente = $_POST['idcliente'];
                    
            $ModeloCita = new agendaCitas();

            if($idregistro != ""){       
                $regcita = $ModeloCita->actualizarCitas($id,$nombre,$direccion,$telefono, $email,$fecha,$hora,$mensaje,$idservicio, $idestilista, $idcliente);
            }else{
               $regcita =  $ModeloCita->registrarCitas($nombre,$direccion,$telefono, $email,$fecha,$hora,$mensaje,$idservicio, $idestilista);
            }

            echo json_encode($regcita);
        }

        function consultarCitas(){

            $ModeloCita = new agendaCitas();
            $citas =  $ModeloCita->consultarCitas(0);

            if(is_array($citas)){
                echo json_encode($citas);
            }
        }

        function consultarCitaById(){

            $idCita = $_POST['id'];
            $ModeloCita = new agendaCitas();
            $citas =  $ModeloCita->consultarCitas($idCita);

            if(is_array($citas)){
                echo json_encode($citas);
            }
        }

        function eliminarCita(){

            $idregistro = $_POST['id'];
            $ModeloCita = new agendaCitas();
            $citas =  $ModeloCita->eliminarcita($idregistro);        
            echo $citas;
        }

        function atenderCita(){

            $idregistro = $_POST['id'];
            $ModeloCita = new agendaCitas();
            $citas =  $ModeloCita->atenderCita($idregistro);        
            echo $citas;
        }

    }

    $objcitasControlador = new citasControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objcitasControlador->crearCita();
            break;
        case 'consultar':
            $objcitasControlador->consultarCitas();
            break;   
        case 'consultarCitaById':
            $objcitasControlador->consultarCitaById();
            break;       
        case 'eliminar':
            $objcitasControlador->eliminarCita();
            break;     
        case 'atenderCita':
            $objcitasControlador->atenderCita();
            break;     
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>