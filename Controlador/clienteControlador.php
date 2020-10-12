<?php 

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include '../Modelo/cliente.php';

    class clienteControlador{

        function __construct()
        {
            
        }

        function crearCliente(){

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $valor = $_POST['valor'];
            
            $ModeloCliente = new cliente();

            if($id != ""){                
                $ModeloCliente->actualizarCliente($id,$nombre,$descripcion,$valor);
            }else{
                $ModeloCliente->registrarCliente($nombre,$descripcion,$valor);
            }

            header('Location: ../Vista/cliente.php');

        }

        function consultarcliente(){

            $ModeloCliente = new cliente();
            $clientes =  $ModeloCliente->consultarClientes('');

            if(is_array($clientes)){
                echo json_encode($clientes);
            }
        }

        function consultarClienteById(){

            $id = $_POST['id'];

            $ModeloCliente = new cliente();

            $condicion = " idcliente = ". $id;

            $clientes =  $ModeloCliente->consultarClientes($condicion);

            if(is_array($clientes)){
                echo json_encode($clientes);
            }
        }        

        function eliminarCliente(){

            $id = $_POST['id'];
            $ModeloCliente = new cliente();
            $clientes = $ModeloCliente->eliminarCliente($id);

            echo $clientes;
        }

    }

    $objclienteControlador = new clienteControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objclienteControlador->crearcliente();
            break;
        case 'consultar':
            $objclienteControlador->consultarcliente();
            break;  
        case 'consultarById':
            $objclienteControlador->consultarclienteById();
            break;       
        case 'eliminar':
            $objclienteControlador->eliminarcliente();
            break;
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>