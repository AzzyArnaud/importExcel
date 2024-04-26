<?php
require('fpdf.php');



class PDF extends FPDF
{
function Header()
{

   
    // Logo
    $this->Image(''.base_url('upload/old_logo.png').'',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Fiche des Consultations',1,0,'C');
    // Line break
    $this->Ln(20);
}
// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-20);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,$this->PageNo(),0,0,'C');
    
    
 $this->Image('upload/old_logo.png',10,280,220);
}

}
?>