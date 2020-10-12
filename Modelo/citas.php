<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include 'conexion.php';

class citas{

    function __construct()
    {
    }

    function consultarCitas($id){
        
        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $sql = 'SELECT c.*, cl.nombre as cliente, e.nombre as estilista, p.nombreProducto,  p.desProducto, cl.telefono as celular, cl.email, cl.direccion  
                FROM cita c 
                INNER JOIN cliente cl on c.idCliente = cl.id
                INNER JOIN estilista e on c.idEstilista = e.id
                INNER JOIN producto p on c.idProducto = p.idProducto ';

            if ($id != 0) {
                $sql .= 'WHERE c.idCita = '.$id;
            }

            $rsData = $conexion->generarConsulta($sql); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base de datos.";
            return false;
        }
    }

    function eliminarCita($idregistro){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){             
            $rsData = $conexion->eliminar('cita',$idregistro); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function actualizarCita($id,$nombre,$direccion,$telefono, $email,$fecha,$hora,$mensaje,$idservicio, $idestilista,$idcliente){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            
                    
            $datosCita = " fecha='" . $fecha ."',hora='".$hora."',descripcion ='".$mensaje."', idEstilista=".$idestilista.",idProducto=".$idservicio." ";

            $rsData = $conexion->actualizar('cita',$datosCita, $this->campoWhere, $id);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se han actualizado los datos de la cita correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al actualizar los datos de la cita.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }
}