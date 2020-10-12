<?php

class conexion{

    //declaración de variables
    public $host; // para conectarnos a localhost o el ip del servidor de postgres
    public $db; // seleccionar la base de datos que vamos a utilizar
    public $user; // seleccionar el usuario con el que nos vamos a conectar
    public $pass; // la clave del usuario
    public $conexion;  //donde se guardara la conexión
    public $url; //dirección de la conexión que se usara para destruirla mas adelante

    //creación del constructor
    function __construct(){

    }

    //creación de la función para cargar los valores de la conexión.
    public function cargarValores(){

        $this->host="localhost";    
        $this->db="ProyectoGradoSena";
        $this->user="root";
        $this->pass="";
       // $this->conexion = "host=".$this->host." dbname=".$this->db." user=".$this->user." password=".$this->pass;

        $this->conexion = new mysqli($this->host,$this->user,$this->pass,$this->db);

        if ($this->conexion->connect_error) {
            echo "Error de Connexion ($this->conexion->connect_errno)
            $this->conexion->connect_error\n";
            header('Location: error-conexion.php');
            exit;
        } else {
            return $this->conexion;
        }
    }

    //función que se utilizara al momento de hacer la instancia de la clase
    function conectar(){
        $this->cargarValores();
       // $this->url=pg_connect($this->conexion);
        return true;
    }

    function insertar ($tabla,$columnas,$datos){

        $sql = "insert into $tabla ($columnas) Values($datos)";    

        $resultado = $this->conexion->query($sql);

        if($resultado){
            return true;
        }
        return false;
    }

    public function buscar($tabla, $condicion){

        $sql = "select * from $tabla ";

        if($condicion != ""){
            $sql.= "where $condicion";
        }

        $resultado = $this->conexion->query($sql);

        if($resultado){
            if (mysqli_num_rows($resultado) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($resultado)) {
                    $data[] = $row;
                }
                return $data;
            }
        }
        return false;
    }

    public function generarConsulta($sql){
       
        $resultado = $this->conexion->query($sql);

        if($resultado){
            if (mysqli_num_rows($resultado) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($resultado)) {
                    $data[] = $row;
                }
                return $data;
            }
        }
        return false;
    }

    public function  actualizar($tabla, $datos, $campoWhere, $id){

        $sql = "update $tabla set $datos WHERE $campoWhere = $id ";    

        $resultado = $this->conexion->query($sql);

        if($resultado){
            return true;
        }
        return false;
    }

   public function  eliminar($tabla, $campoWhere, $id){

        $sql = "DELETE FROM $tabla WHERE $campoWhere = $id ";    

        $resultado = $this->conexion->query($sql);

        if($resultado){
            return true;
        }
        return false;
   }

   public function  eliminarAgendaCita($tabla, $id){

    $sql = "DELETE FROM $tabla WHERE idregistro = $id ";    

    $resultado = $this->conexion->query($sql);

    if($resultado){
        return true;
    }
    return false;
}


    //función para destruir la conexión.
    function destruir(){
       //pg_close($this->url);
    }
}

