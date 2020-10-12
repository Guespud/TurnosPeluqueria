<?php 
session_start();

include '../Modelo/factura.php';
include '../librerias/plantilla.php';

    class facturaControlador{

        function __construct()
        {
            
        }

        function crearFactura(){

            $idCita = $_POST['cita'];            
            $descuento = $_POST['descuento'];
            $subtotal = $_POST['subtotal'];
            $iva = $_POST['iva'];
            $total = $_POST['total'];
            
            $Modelofactura = new factura();          
            $Modelofactura->registrarFactura($idCita, $descuento,$subtotal, $iva, $total);
            
            header('Location: ../Vista/factura.php');
        }

        function consultarFacturas(){

            $Modelofactura = new factura();
            $factura =  $Modelofactura->consultarFactura(0);

            if(is_array($factura)){
                echo json_encode($factura);               
            }
        }

        function consultarCitasRealizadas(){

            $Modelofactura = new factura();
            $citas =  $Modelofactura->consultarCitasRealizadas();    

            if(is_array($citas)){
                echo json_encode($citas);
            }
        }

        function consultarCitaById(){

            $id = $_POST['id'];
            $Modelofactura = new factura();
            $cita =  $Modelofactura->consultarCitaById($id);    

            if(is_array($cita)){
                echo json_encode($cita);
            }
        }

        // function generarPDF(){

        //     $id = $_POST['id'];
        //     $Modelofactura = new factura();
        //     $factura =  $Modelofactura->consultarFactura($id);

        //     if(is_array($factura)){
        //         $data['Data'] = $factura;
        //         $data['Nombre'] = 'FacturaPeluqueriaGuespud_No.'.$id.'_'.date('yy-m-d').'_'.date('h_m_s');
        //         $facturapdf = new facturaPDF();
        //         $facturapdf->draw($data);
        //     }
        // }
    }

    $objfacturaControlador = new facturaControlador();


    switch($_REQUEST['action']){
        case 'registrar':
            $objfacturaControlador->crearFactura();
            break;
        case 'consultar':
            $objfacturaControlador->consultarfacturas();
            break;       
       /*  case 'eliminar':
            $objfacturaControlador->eliminarFactura();
            break; */
        case 'consultarCitasRealizadas':
            $objfacturaControlador->consultarCitasRealizadas();
            break;
        case 'consultarCitaById':
            $objfacturaControlador->consultarCitaById();
            break;                        
        case 'generarPDF':
           // $objfacturaControlador->generarPDF();

            $id = $_POST['id'];
            $Modelofactura = new factura();
            $factura =  $Modelofactura->consultarFactura($id);

            $pdf = new PDF();

            $pdf->AddPage('L');   
            $nuTamanoCelda = 5;
            $nuAnchoCelda = 5;

            $data['Data'] = $factura;
            $data['Nombre'] = 'FacturaPeluqueriaGuespud_No.'.$id.'_'.date('yy-m-d').'_'.date('h_m_s');

            $pdf->Cell(15, $nuAnchoCelda, 'idcliente', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'fecha', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'hora', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'subtotal', 1, 0, 'C');
            //$pdf->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'impuesto', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'descuento', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'total', 1, 0, 'C');
       
            $pdf->Cell(15, $nuAnchoCelda, 'descripcion', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'idCliente', 1, 0, 'C');
            //$pdf->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'idEstilista', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'idProducto', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'estado', 1, 0, 'C');
    
            $pdf->Cell(15, $nuAnchoCelda, 'cliente', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'estilista', 1, 0, 'C');
       
            //$pdf->Cell(40, $nuAnchoCelda, 'Punto de Venta', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'nombreProducto', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'desProducto', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'email', 1, 0, 'C');
            $pdf->Cell(15, $nuAnchoCelda, 'telefono', 1, 1, 'C');

            foreach ($data['Data'] as $indice => $val) {

               // $pdf->SetFont('Arial', '', 9);             
                                
                $pdf->Cell(15 ,$nuAnchoCelda, $val['idCita'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['fecha'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['hora'], 1, 0, 'C');
                //$pdf->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['subtotal'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['impuesto'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['descuento'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['total'], 1, 0, 'C');
       
                $pdf->Cell(15 ,$nuAnchoCelda, $val['descripcion'], 1, 0, 'C');
                //$pdf->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['idCliente'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['idEstilista'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['idProducto'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['estado'], 1, 0, 'C');
           
                $pdf->Cell(15 ,$nuAnchoCelda, $val['cliente'], 1, 0, 'C');
                //$pdf->Cell(40 ,$nuAnchoCelda, $data['nuidpuntoventa'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['estilista'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['nombreProducto'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['desProducto'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['email'], 1, 0, 'C');
                $pdf->Cell(15 ,$nuAnchoCelda, $val['telefono'], 1, 1, 'C');

                $pdf->Ln(3);
                //$this->SetFont('Arial', 'B', 9);
                $pdf->Cell(30, $nuAnchoCelda , 'GRACIAS POR USAR NUESTROS SERVICIOS', 1, 1, 'C');
                
                $pdf->Ln(3);
       
              
            }           

            $sbName = (isset($data['Nombre']) ? strval($data['Nombre']) : 'pdf') . '.pdf';
            $sbPath =   '../reportes/' . $sbName;           

            $pdf->Output($sbPath, 'F');

            break;      
        default:
            echo 'No se ha encontrado ninguna funcion con la accion solicitada.';
            break;
    }


?>