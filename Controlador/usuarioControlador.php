<?php 
session_start();

include '../Modelo/usuario.php';

    class usuarioControlador{

        function __construct()
        {
            
        }

        function crearUsuario(){

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];           
            $password = $_POST['password'];
            $usuario = $_POST['usuario'];
            
            $ModeloUsuario = new usuario();

            if($id != ""){                
                $ModeloUsuario->actualizarUsuario($id,$nombre,$apellido,$password,$usuario);
            }else{
                $ModeloUsuario->registrarUsuario($nombre,$apellido,$password,$usuario);
            }

            header('Location: ../Vista/usuario.php');

        }

        function consultarUsuario(){

            $ModeloUsuario = new usuario();
            $usuarios =  $ModeloUsuario->consultarUsuarios('');

            if(is_array($usuarios)){
                echo json_encode($usuarios);
            }
        }

        function consultarUsuarioById(){

            $id = $_POST['id'];

            $ModeloUsuario = new usuario();

            $condicion = " id = ". $id;

            $usuarios =  $ModeloUsuario->consultarUsuarios($condicion);

            if(is_array($usuarios)){
                echo json_encode($usuarios);
            }
        }        

        function eliminarUsuario(){

            $id = $_POST['id'];
            $ModeloUsuario = new usuario();
            $usuario =  $ModeloUsuario->eliminarUsuario($id);

            echo $usuario;
        }

    }

    $objUsuarioControlador = new usuarioControlador();
    
    switch($_REQUEST['action']){
        case 'registrar':
            $objUsuarioControlador->crearUsuario();
            break;
        case 'consultar':
            $objUsuarioControlador->consultarUsuario();
            break;  
        case 'consultarById':
            $objUsuarioControlador->consultarUsuarioById();
            break;       
        case 'eliminar':
            $objUsuarioControlador->eliminarUsuario();
            break;
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>