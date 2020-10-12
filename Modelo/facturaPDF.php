<?php

include '../librerias/plantilla.php';
include '../librerias/Tools.php';

class facturaPDF extends PDF {


    public $APP_FILES_DIR = '';

    function __construct(){
        $this->APP_FILES_DIR =  '../reportes/';
    }

    public function draw($data = array()) {
        try {
            
            if (!is_array($data) || !array_change_key_case($data, CASE_UPPER))
                throw new InvalidArgumentException("Argumentos invalidos");

            $nuTamanoCelda = 10;
            $nuAnchoCelda = 5;

            $this->AddPage('L');   
            $this->Cell(40, $nuAnchoCelda, 'idcliente', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'fecha', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'hora', 1, 0, 'C');
            $this->Cell(70, $nuAnchoCelda, 'subtotal', 1, 0, 'C');
            //$this->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'impuesto', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'descuento', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'total', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'descripcion', 1, 0, 'C');
            $this->Cell(70, $nuAnchoCelda, 'idCliente', 1, 0, 'C');
            $this->Ln(2);
            //$this->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'idEstilista', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'idProducto', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'estado', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'cliente', 1, 0, 'C');
            $this->Cell(70, $nuAnchoCelda, 'estilista', 1, 0, 'C');
            //$this->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'nombreProducto', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'desProducto', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'email', 1, 0, 'C');
            $this->Cell(40, $nuAnchoCelda, 'telefono', 1, 1, 'C');

            foreach ($data['Data'] as $indice => $val) {

               // $this->SetFont('Arial', '', 9);             
                                
                $this->Cell(40 ,$nuAnchoCelda, $val['idCita'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['fecha'], 1, 0, 'C');
                $this->Cell(70 ,$nuAnchoCelda, $val['hora'], 1, 0, 'C');
                //$this->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['subtotal'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['impuesto'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['descuento'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['total'], 1, 0, 'C');
                $this->Cell(70 ,$nuAnchoCelda, $val['descripcion'], 1, 0, 'C');
                //$this->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['idCliente'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['idEstilista'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['idProducto'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['estado'], 1, 0, 'C');
                $this->Cell(70 ,$nuAnchoCelda, $val['cliente'], 1, 0, 'C');
                //$this->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['estilista'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['nombreProducto'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['desProducto'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['email'], 1, 0, 'C');
                $this->Cell(40 ,$nuAnchoCelda, $val['telefono'], 1, 1, 'C');
       
            }           

            $sbName = (isset($data['Nombre']) ? strval($data['Nombre']) : 'pdf') . '.pdf';
            $sbPath =  $this->APP_FILES_DIR . $sbName;           

            $this->Output($sbPath, 'F');

            
            return $sbName;
        } catch (Exception $e) {
            Tools::ThrowError($e);
        }
    }

}