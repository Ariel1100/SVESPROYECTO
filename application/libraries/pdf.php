<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {		
      // El encabezado del PDF
      public function Header(){
        if ($this->PageNo() == 1){
          $this->Image('img/logo1.jpeg',15,12,30);
          $this->SetFont('Arial','B',13);
          $this->Cell(30);
          $this->Cell(120,10,utf8_decode('SELECTRONIK SEGURIDAD'),0,0,'C');
          $this->Ln('5');
        }
     }
      public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
      }
}
