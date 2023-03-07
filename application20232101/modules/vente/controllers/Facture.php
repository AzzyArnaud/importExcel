<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Facture extends CI_Controller {

  function __construct() {
    parent::__construct();
    // $this->load->library('Corporate');

  }


  public function design_facture(){
	$NUMERO_FATURE=$this->input->post('id');
	$donne_facture = $this->Model->getRequeteOne('SELECT config_user.NOM, config_user.PRENOM, DATE_TIME_VENTE, MONTANT_TOTAL, MONTANT_PAYE, MONTANT_REMISE, saisie_client.NOM_CLIENT, saisie_client.PRENOM_CLIENT FROM `vente_vente` JOIN config_user ON config_user.ID_USER = vente_vente.ID_USER_VENDEUR LEFT JOIN saisie_client ON saisie_client.ID_CLIENT = vente_vente.ID_CLIENT WHERE 1 AND ID_VENTE = "'.$NUMERO_FATURE.'"');

	$det_medicam = $this->Model->getRequete('SELECT DISTINCT(NOM_PRODUIT) AS NOM_PRODUIT, COUNT(NOM_PRODUIT) AS QUANTITE, (SUM(PRIX_UNITAIRE) / COUNT(NOM_PRODUIT)) AS PRIX_UNITAIRE,  SUM(PRIX_UNITAIRE) AS PRIX_TOTAL FROM `vente_detail` JOIN saisie_produit ON saisie_produit.ID_PRODUIT=vente_detail.ID_PRODUIT WHERE `ID_VENTE` = '.$NUMERO_FATURE.' GROUP BY NOM_PRODUIT');
	$det_remise = $this->Model->getRequete('SELECT MONTANT_TOTAL, MONTANT_REMISE, POURCENTAGE_REMISE, NOM_ASSURANCE FROM `vente_remise` LEFT JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE = vente_remise.ID_ASSURANCE WHERE `ID_VENTE` = '.$NUMERO_FATURE.' ');

	$date=date_create($donne_facture['DATE_TIME_VENTE']);
	$DATE_INSERT = date_format($date,"d/m/Y H:i:s");

$info="<center>";

$info.='<div style="font-size:13px"><img src="'.base_url().'dist/straphael_favicon.png"><br>';
$info.='<h3>Pharmacie Saint-Raphaël</h3>';
$info.='26 avenue de l\'agriculture ';
$info.='Bujumbura, Burundi <br>';
$info.='Tel: 72364573 ';
$info.='NIF: 4000425589 ';
$info.='RC: 03071 <br>';
$info.='Date '.$DATE_INSERT.'<br><br>';
$info.="</center>";
$info.='Vente Num/Ref : <b>'.$NUMERO_FATURE.'</b><br>';
$info.='Associer des ventes: <b>'.$donne_facture['NOM'].' '.$donne_facture['PRENOM'].'</b><br>';
$info.='Client : <b>'.$donne_facture['NOM_CLIENT'].' '.$donne_facture['PRENOM_CLIENT'].'</b><br>';
$info.='-------------------------------------------------<br><br>';
$info.='</div><table style="width:100%"><tr><th  align ="left" style="width:10px">#</th><th style="width:25%" align ="left">Px</th><th style="width:20%" align ="right">Qt</th><th style="width:20%" align ="right">PU</th><th style="width:25%" align ="right">PT</th></tr>';

$i = 1;
  foreach ($det_medicam as  $key) {
  	$info.='<tr>';
  	$info.='<td  style="width:10pxstyle="width:20%"x">'.$i .')</td>';
  	$info.='<td style="width:25%">'.$key['NOM_PRODUIT'].'</td>';
  	$info.='<td style="width:20%" align ="right">'.$key['QUANTITE'].'</td>';
  	$info.='<td style="width:20%" align ="right">'.number_format($key['PRIX_UNITAIRE'],0,',',' ').'</td>';
  	$info.='<td style="width:25%" align ="right">'.number_format($key['PRIX_TOTAL'],0,',',' ').'</td>';
    // $info.='# '.$i.' '.$key['NOM_PRODUIT'].' '),0,1,'L');
    // $info.=number_format($key['QUANTITE'],0,',',' ').' pc * '.number_format($key['PRIX_UNITAIRE'],0,',',' ').' BIF'),0,0,'L');
    // $pdf->Cell(90,10,utf8_decode(number_format($key['PRIX_TOTAL'],0,',',' ').' BIF'),0,1,'R');
     $i++;

    $info.='</tr>';
}

$info.='<tr><td colspan="5">-------------------------------------------------<br></td></tr>';
$info.='<tr><th align ="left" colspan="3">TOTAL</th><th align ="right" colspan="2">'.number_format($donne_facture['MONTANT_TOTAL'],0,',',' ').'</th></tr>';

foreach ($det_remise as  $rem) {
  if ($rem['NOM_ASSURANCE'] == NULL) {
    
    $info.='<tr><td colspan="3">Remise</td><td  colspan="2" align ="right">'.number_format($rem['MONTANT_REMISE'],0,',',' ').'</td></tr>';

  }
  else{
    
     $info.='<tr><td colspan="3">Assurance ('.$rem['NOM_ASSURANCE'].')</td><td  colspan="2" align ="right">'.number_format($rem['MONTANT_REMISE'],0,',',' ').'</td></tr>';
  }
}

$info.='</table><table style="width:100%">';

$info.='<tr><td>Total Remise</td><td align ="right">'.number_format($donne_facture['MONTANT_REMISE'],0,',',' ').'</td>';
$info.='<tr><td>Montant A paye</td><td align ="right"><b>'.number_format($donne_facture['MONTANT_PAYE'],0,',',' ').'</b></td>';


$info.='</table><br>';
$info.='<center>Merci pour votre confiance</center?';


echo $info;
  


}
}