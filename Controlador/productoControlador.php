<?php 

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include '../Modelo/producto.php';

    class productoControlador{

        function __construct()
        {
            
        }

        function crearProducto(){

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $valor = $_POST['valor'];
            
            $ModeloProducto = new producto();

            if($id != ""){                
                $ModeloProducto->actualizarProducto($id,$nombre,$descripcion,$valor);
            }else{
                $ModeloProducto->registrarProducto($nombre,$descripcion,$valor);
            }

            header('Location: ../Vista/producto.php');

        }

        function consultarProducto(){

            $ModeloProducto = new producto();
            $productos =  $ModeloProducto->consultarProductos('');

            if(is_array($productos)){
                echo json_encode($productos);
            }
        }

        function consultarProductoById(){

            $id = $_POST['id'];

            $ModeloProducto = new producto();

            $condicion = " idProducto = ". $id;

            $productos =  $ModeloProducto->consultarProductos($condicion);

            if(is_array($productos)){
                echo json_encode($productos);
            }
        }        

        function eliminarProducto(){

            $id = $_POST['id'];
            $ModeloProducto = new producto();
            $productos =  $ModeloProducto->eliminarProducto($id);

            echo $productos;
        }

    }

    $objProductoControlador = new productoControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objProductoControlador->crearProducto();
            break;
        case 'consultar':
            $objProductoControlador->consultarProducto();
            break;  
        case 'consultarById':
            $objProductoControlador->consultarProductoById();
            break;       
        case 'eliminar':
            $objProductoControlador->eliminarProducto();
            break;
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>