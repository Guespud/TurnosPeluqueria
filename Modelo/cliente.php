<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include 'conexion.php';

class cliente{

    function __construct()
    {
    }

    function registrarCliente($nombre,$apellido,$correo,$password,$created_at,$cliente){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            

            $columnas = "nombre,apellido,correo,password,created_at,cliente";
            $datos = " '" . $nombre ."','".$apellido."','".$correo."','".$password." ','" . $created_at . "' , '". $cliente."'";

            $rsData = $conexion->insertar('cliente',$columnas, $datos);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha registrado el cliente correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al registrar el cliente.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }
    
    function actualizarCliente($id,$nombre,$apellido,$correo,$password,$created_at,$cliente){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            
            
            $datos = " nombre='" . $nombre ."',apellido='".$apellido."',correo='".$correo."',password='".$password." ',created_at='" . $created_at . "' ,cliente='". $cliente."'";

            $rsData = $conexion->actualizar('cliente',$datos, $id);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha actualizado el cliente correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al actualizar el cliente.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;

    }

    function consultarClientes($condicion){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 
            $rsData = $conexion->buscar('cliente',$condicion); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function eliminarCliente($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){             
            $rsData = $conexion->eliminar('cliente',$id); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }
}