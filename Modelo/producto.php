<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include 'conexion.php';

class producto{

    public $campoWhere = "idProducto";

    function __construct()
    {

    }

    function registrarProducto($nombre,$descripcion,$valor){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            

            $columnas = "nombreProducto,desProducto,valorProducto";
            $datos = " '" . $nombre ."','".$descripcion."','".$valor."'";

            $rsData = $conexion->insertar('producto',$columnas, $datos);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha registrado el producto correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al registrar el producto.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }
    
    function actualizarProducto($id,$nombre,$descripcion,$valor){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){            
            
            $datos = " nombreProducto='" . $nombre ."',desProducto='".$descripcion."',valorProducto='".$valor."'";

            $rsData = $conexion->actualizar('producto',$datos, $this->campoWhere, $id);

            if($rsData){
                $_SESSION["status"] = "OK";
                $_SESSION["statusAlert"] = "alert-success";
                $_SESSION["statusMessage"] = "Se ha actualizado el producto correctamente.";                
            }
            else{
                $_SESSION["status"] = "Error";
                $_SESSION["statusAlert"] = "alert-danger";
                $_SESSION["statusMessage"] = "Ha ocurrido un error al actualizar el producto.";
            }            
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base ded datos.";
        }

        return true;
    }

    function consultarProductos($condicion){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){ 
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

    function eliminarProducto($id){

        $conexion = new conexion();
        $blconexion = $conexion->conectar();

        if($blconexion){             
            $rsData = $conexion->eliminar('producto', $this->campoWhere, $id); 
                    
            $_SESSION["status"] = "OK";
            $_SESSION["statusAlert"] = "alert-success";
            $_SESSION["statusMessage"] = "Se ha eliminado el producto exitosamente.";
            return $rsData;  
        }
        else{
            $_SESSION["status"] = "Error";
            $_SESSION["statusAlert"] = "alert-danger";
            $_SESSION["statusMessage"] = "Ha ocurrido un error de conexion con la base de datos.";
            return false;
        }
    }
}