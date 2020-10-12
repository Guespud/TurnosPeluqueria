<?php 

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include '../Modelo/estilista.php';

    class estilistaControlador{

        function __construct()
        {
            
        }

        function registrarEstilista(){

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            
            $ModeloEstilista = new estilista();

            if($id != ""){                
                $ModeloEstilista->actualizarEstilista($id,$nombre,$direccion,$telefono);
            }else{
                $ModeloEstilista->registrarEstilista($nombre,$direccion,$telefono);
            }

            header('Location: ../Vista/estilista.php');

        }

        function consultarEstilista(){

            $ModeloEstilista = new estilista();
            $productos =  $ModeloEstilista->consultarestilista('');

            if(is_array($productos)){
                echo json_encode($productos);
            }
        }

       function consultarEstilistaById(){

      
            $id = $_POST['id'];

            $ModeloEstilista = new estilista();

            // echo "<pre>";
            // print_r($id);
            // die();
    
            $condicion = " id = ". $id;

    
            $productos =  $ModeloEstilista->consultarEstilista($condicion);

            if(is_array($productos)){
                echo json_encode($productos);
            }
        }    

        function eliminarEstilista(){

            $id = $_POST['id'];
            $ModeloEstilista = new estilista();
            $productos = $ModeloEstilista->eliminarestilista($id);

            echo $productos;
        }

    }

    $objEstilistaControlador = new estilistaControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objEstilistaControlador->registrarEstilista();
            break;
        case 'consultar':
            $objEstilistaControlador->consultarEstilista();
            break;  
        case 'consultarById':
            $objEstilistaControlador->consultarEstilistaById();
            break;       
        case 'eliminar':
            $objEstilistaControlador->eliminarEstilista();
            break;
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>