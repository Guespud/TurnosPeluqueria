<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include 'conexion.php';

class agendaCitas{

    public $campoWhere = "idCita";

    function __construct()
    {
    }

    function registrarCitas($nombre,$direccion,$telefono, $email,$fecha,$hora,$mensaje,$idservicio, $idestilista){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){    

           $idCliente = $this->validarCliente($nombre,$direccion,$telefono, $email);

            $columnas = "fecha,hora,descripcion,idCliente,idEstilista,idProducto";
            $datos = "'".$fecha."','".$hora." ','" . $mensaje . "' ,'" . $idCliente . "' , ". $idestilista.", ".$idservicio." ";

            $rsData = $conexion->insertar('cita',$columnas, $datos);

            if($rsData){
                $respuesta["status"] = "OK";
                $respuesta["statusAlert"] = "alert-success";
                $respuesta["statusMessage"] = "Se ha registrado la cita correctamente.";                
            }
            else{
                $respuesta["status"] = "Error";
                $respuesta["statusAlert"] = "alert-danger";
                $respuesta["statusMessage"] = "Ha ocurrido un error al registrar la cita .";
            }            
        }
        else{
            $respuesta["status"] = "Error";
            $respuesta["statusAlert"] = "alert-danger";
            $respuesta["statusMessage"] = "Ha ocurrido un error de conexion con la base de datos.";
        }

        return $respuesta;
    }

    function validarCliente($nombre,$direccion,$telefono, $email){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();
      
        if($blconexion){

            $condicion = ' email = "'.$email.'"';
            $rsCliente =  $conexion->buscar('cliente',$condicion); 
            
            if (is_array($rsCliente) ){                
               return $idCliente = $rsCliente[0]['id'];
            }else{

                $columnasCliente = "nombre,direccion,telefono,email";
                $datosCliente = "'".$nombre."','".$direccion." ','" . $telefono . "' ,'" . $email . "'";

                $rsDataCliente = $conexion->insertar('cliente',$columnasCliente, $datosCliente);

                if ($rsDataCliente){                    
                   return $this->validarCliente($nombre,$direccion,$telefono, $email);
                }
            }
        }
    }

    function consultarTipoServicio(){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $condicion = '';
            $rsData = $conexion->buscar('producto',$condicion); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function consultarEstilista(){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $condicion = '';
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
                $sql .= 'WHERE idCita = '.$id;
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
            $datosCita  = "estado='Cancelado' ";
            $rsData = $conexion->actualizar('cita',$datosCita, $this->campoWhere,$idregistro); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

     function atenderCita($idregistro){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){       
            $datosCita  = "estado='Realizado' ";
            $rsData = $conexion->actualizar('cita', $datosCita, $this->campoWhere,$idregistro); 
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
                $respuesta["status"] = "OK";
                $respuesta["statusAlert"] = "alert-success";
                $respuesta["statusMessage"] = "Se han actualizado los datos de la cita correctamente.";                
            }
            else{
                $respuesta["status"] = "Error";
                $respuesta["statusAlert"] = "alert-danger";
                $respuesta["statusMessage"] = "Ha ocurrido un error al actualizar los datos de la cita.";
            }            
        }
        else{
            $respuesta["status"] = "Error";
            $respuesta["statusAlert"] = "alert-danger";
            $respuesta["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return $respuesta;
    }
}