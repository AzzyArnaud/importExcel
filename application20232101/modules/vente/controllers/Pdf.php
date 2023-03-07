<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Pdf extends CI_Controller {

  function __construct() {
    parent::__construct();
    // $this->load->library('Corporate');

  }

  


  public function print_facture($NUMERO_FATURE){

      //print_r($semaine1.' <br>'.$semaine2.' <br>');

    include 'pdfinclude/fpdf/mc_table.php';
    include 'pdfinclude/fpdf/pdf_config.php';


    $pdf = new PDF_CONFIG('P','mm','A4');
    $pdf->addPage();
    $url = base_url();

    $pdf->Image(''.$url.'dist/straphael_favicon.png',80,1,40,35);
    $pdf->ln(14);

    $pdf->SetFont('Arial','B',18);
    // $pdf->SetFillColor(96, 49, 49);
    // $pdf->SetTextColor(4,4,4);
    // $pdf->SetDrawColor(4,4,4);

$donne_facture = $this->Model->getRequeteOne('SELECT config_user.NOM, config_user.PRENOM, DATE_TIME_VENTE, MONTANT_TOTAL, MONTANT_PAYE, MONTANT_REMISE, saisie_client.NOM_CLIENT, saisie_client.PRENOM_CLIENT FROM `vente_vente` JOIN config_user ON config_user.ID_USER = vente_vente.ID_USER_VENDEUR LEFT JOIN saisie_client ON saisie_client.ID_CLIENT = vente_vente.ID_CLIENT WHERE 1 AND ID_VENTE = "'.$NUMERO_FATURE.'"');

$det_medicam = $this->Model->getRequete('SELECT DISTINCT(NOM_PRODUIT) AS NOM_PRODUIT, COUNT(NOM_PRODUIT) AS QUANTITE, (SUM(PRIX_UNITAIRE) / COUNT(NOM_PRODUIT)) AS PRIX_UNITAIRE,  SUM(PRIX_UNITAIRE) AS PRIX_TOTAL FROM `vente_detail` JOIN saisie_produit ON saisie_produit.ID_PRODUIT=vente_detail.ID_PRODUIT WHERE `ID_VENTE` = '.$NUMERO_FATURE.' GROUP BY NOM_PRODUIT');
$det_remise = $this->Model->getRequete('SELECT MONTANT_TOTAL, MONTANT_REMISE, POURCENTAGE_REMISE, NOM_ASSURANCE FROM `vente_remise` LEFT JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE = vente_remise.ID_ASSURANCE WHERE `ID_VENTE` = '.$NUMERO_FATURE.' ');

$date=date_create($donne_facture['DATE_TIME_VENTE']);
$DATE_INSERT = date_format($date,"d/m/Y H:i:s");

$pdf->ln(14);
$pdf->Cell(192,10,utf8_decode('Pharmacie Saint-Raphaël'),0,1,'C');
$pdf->SetFont('Arial','',18);
$pdf->Cell(192,10,utf8_decode('26 avenue de l\'agriculture '),0,1,'C');
$pdf->Cell(192,10,utf8_decode('Bujumbura, Burundi '),0,1,'C');
$pdf->Cell(192,10,utf8_decode('Tel: 72364573 '),0,1,'C');
$pdf->Cell(192,10,utf8_decode('NIF: 4000425589 '),0,1,'C');
$pdf->Cell(192,10,utf8_decode('Registre du commerce N: 03071 '),0,1,'C');
$pdf->Cell(192,10,utf8_decode('Date '.$DATE_INSERT.' '),0,1,'L');
$pdf->Cell(192,10,utf8_decode('Vente Num/Ref : '.$NUMERO_FATURE.' '),0,1,'L');
$pdf->Cell(192,10,utf8_decode('Associer des ventes: '.$donne_facture['NOM'].' '.$donne_facture['PRENOM'].' '),0,1,'L');
$pdf->Cell(192,10,utf8_decode('Client : '.$donne_facture['NOM_CLIENT'].' '.$donne_facture['PRENOM_CLIENT'].' '),0,1,'L');
$pdf->Cell(192,10,utf8_decode('-------------------------------------------------'),0,1,'C');

$i = 1;
  foreach ($det_medicam as  $key) {
    $pdf->Cell(192,10,utf8_decode('# '.$i.' '.$key['NOM_PRODUIT'].' '),0,1,'L');
    $pdf->Cell(12,10,utf8_decode(''),0,0,'L');
    $pdf->Cell(90,10,utf8_decode(number_format($key['QUANTITE'],0,',',' ').' pc * '.number_format($key['PRIX_UNITAIRE'],0,',',' ').' BIF'),0,0,'L');
    $pdf->Cell(90,10,utf8_decode(number_format($key['PRIX_TOTAL'],0,',',' ').' BIF'),0,1,'R');
    $i++;
}

$pdf->Cell(192,10,utf8_decode('-------------------------------------------------'),0,1,'C');
$pdf->Cell(102,10,utf8_decode('Total'),0,0,'L');
$pdf->Cell(90,10,utf8_decode(number_format($donne_facture['MONTANT_TOTAL'],0,',',' ').' BIF'),0,1,'R');

foreach ($det_remise as  $rem) {
  if ($rem['NOM_ASSURANCE'] == NULL) {
    $pdf->Cell(102,10,utf8_decode(' Remise'),0,0,'L');
    $pdf->Cell(90,10,utf8_decode(' '.number_format($rem['MONTANT_REMISE'],0,',',' ').' BIF'),0,1,'R');
  }
  else{
    $pdf->Cell(102,10,utf8_decode(' Assurance ('.$rem['NOM_ASSURANCE'].')'),0,0,'L');
    $pdf->Cell(90,10,utf8_decode(' '.number_format($rem['MONTANT_REMISE'],0,',',' ').' BIF'),0,1,'R');
  }
    
    
}

$pdf->Cell(102,10,utf8_decode('Total Remise'),0,0,'L');
$pdf->Cell(90,10,utf8_decode(number_format($donne_facture['MONTANT_REMISE'],0,',',' ').' BIF'),0,1,'R');

$pdf->Cell(102,10,utf8_decode('Montant A paye'),0,0,'L');
$pdf->Cell(90,10,utf8_decode(number_format($donne_facture['MONTANT_PAYE'],0,',',' ').' BIF'),0,1,'R');


$pdf->Cell(102,10,utf8_decode('Paye par'),0,0,'L');
$pdf->Cell(90,10,utf8_decode(' Cash'),0,1,'R');

$pdf->Cell(192,10,utf8_decode('Merci pour votre confiance'),0,1,'C');







$pdf->Ln(30);
$pdf->Cell(192,5,utf8_decode(''),0,1,'L');
$pdf->Output('Facture '.$NUMERO_FATURE.'.pdf','I');

}


}
