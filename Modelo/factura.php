<?php date_default_timezone_set('America/Bogota');
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include 'conexion.php';

class factura{

    function __construct()
    {
    }

    function registrarFactura($idCita, $descuento, $subtotal, $iva, $total){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){    

            $fecha = date('yy-m-d');
            $hora = date('h:m:s');
           
            $columnas = "idCita,fecha,hora,subtotal,impuesto,descuento,total";
            $datos = "" . $idCita .",'".$fecha."','".$hora."'," . $subtotal . "," . $iva . ",". $descuento.", ".$total." ";

            $rsData = $conexion->insertar('factura',$columnas, $datos);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha generado la factura correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al generar la factura .";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base de datos.";
        }

        return true;
    }

    function consultarFactura($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $sql = 'SELECT f.*, c.*, cl.nombre as cliente, e.nombre as estilista, p.nombreProducto, p.desProducto, cl.email, cl.telefono    
                    FROM factura f 
                    INNER JOIN cita c on f.idCita = c.idCita
                    INNER JOIN cliente cl on c.idCliente = cl.id
                    INNER JOIN estilista e on c.idEstilista = e.id
                    INNER JOIN producto p on c.idProducto = p.idProducto ';

            if($id != 0){
                $sql .= 'WHERE f.idFactura = '. $id;
            }

            $rsData = $conexion->generarConsulta($sql); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function consultarCitasRealizadas(){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $sql = 'SELECT c.idCita, c.fecha, c.hora, cl.nombre, c.descripcion 
                            FROM cita c 
                            INNER JOIN cliente cl on c.idCliente = cl.id
                            WHERE c.estado = "Realizado" ';

            $rsData = $conexion->generarConsulta($sql); 
            return $rsData;            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
            return false;
        }
    }

    function consultarCitaById($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 

            $sql = 'SELECT c.*, cl.nombre as cliente, e.nombre as estilista, p.nombreProducto,  p.desProducto, cl.telefono as celular, cl.email, cl.direccion as direcliente, e.nombre as estilista, e.telefono as telestilista, p.* 
                FROM cita c 
                INNER JOIN cliente cl on c.idCliente = cl.id
                INNER JOIN estilista e on c.idEstilista = e.id
                INNER JOIN producto p on c.idProducto = p.idProducto 
                WHERE c.idCita = '.$id;
            
            $rsData = $conexion->generarConsulta($sql); 
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