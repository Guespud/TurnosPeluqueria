<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include 'conexion.php';

class usuario{

    function __construct()
    {
    }

    function validarSession($usuario,$contrasenia){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            

            $condicion = ' usuario = "' . $usuario . '" and password="' . $contrasenia. '" ';

            $rsData = $conexion->buscar('usuario',$condicion);

            if(is_array($rsData)){
                
                $_SESSION['nombre'] = $rsData[0]['usuario'];
                $_SESSION['status'] = "OK";

                return true;
            }
            else{                
                $_SESSION['status'] = "Usuario ingresado no es valido";
                return false;
            }
        }
        else{
            $_SESSION['status'] = "Error en la conexion";
            return false;
        }
    }

    function registrarUsuario($nombre,$apellido,$password,$usuario){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            

            $created_at = date('yyyy-mm-dd');

            $columnas = "nombre,apellido,password,created_at,usuario";
            $datos = " '" . $nombre ."','".$apellido."','".$password." ','" . $created_at . "' , '". $usuario."'";

            $rsData = $conexion->insertar('usuario',$columnas, $datos);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha registrado el usuario correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al registrar el usuario.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }
    
    function actualizarUsuario($id,$nombre,$apellido,$password,$usuario){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            
            
            $datos = " nombre='" . $nombre ."',apellido='".$apellido."',password='".$password."',usuario='". $usuario."'";

            $rsData = $conexion->actualizar('usuario',$datos,'id', $id);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha actualizado el usuario correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al actualizar el usuario.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }
        return true;
    }

    function consultarUsuarios($condicion){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 
            $rsData = $conexion->buscar('usuario',$condicion); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function eliminarUsuario($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){             
            $rsData = $conexion->eliminar('usuario','id',$id); 
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