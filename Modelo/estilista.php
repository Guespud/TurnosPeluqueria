<?php
session_start();if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include 'conexion.php';

class estilista{

    function __construct()
    {
    

    }

    function registrarEstilista($nombre,$direccion,$telefono){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            

            $columnas = "nombre,direccion,telefono";
            $datos = " '" . $nombre ."','".$direccion."', '". $telefono."'";

            $rsData = $conexion->insertar('estilista',$columnas, $datos);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha registrado el estilista correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al registrar el estilista.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }
    
    function actualizarEstilista($id,$nombre,$direccion,$telefono){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            
            
            $datos = " nombre='" . $nombre ."',direccion='".$direccion."',telefono='". $telefono."'";

            $rsData = $conexion->actualizar('estilista',$datos,'id', $id);

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

    function consultarEstilista($condicion){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            //$condicion = '';
            $rsData = $conexion->buscar('estilista',$condicion); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function eliminarEstilista($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){             
            $rsData = $conexion->eliminar('estilista','id',$id); 
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