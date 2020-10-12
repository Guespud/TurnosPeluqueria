<?php
	
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			//$this->Image('images/logo.png', 5, 5, 30 );
			$this->SetFont('Arial','B',3);
			$this->Cell(5);
			$this->Cell(5,5, 'Recibo De Pago ',0,0,'C');
			$this->Ln(5);
		}
		
		function Footer()
		{
			$this->SetY(-5);
			$this->SetFont('Arial','I', 3);
			$this->Cell(0,5, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>