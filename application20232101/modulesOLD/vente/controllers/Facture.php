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

$info.='<img src="'.base_url().'dist/straphael_favicon.png"><br>';
$info.='<h3>Pharmacie Saint-Raphaël</h3><br>';
$info.='26 avenue de l\'agriculture <br>';
$info.='Bujumbura, Burundi <br>';
$info.='Tel: 72364573 <br>';
$info.='NIF: 4000425589 <br>';
$info.='Registre du commerce N: 03071 <br>';
$info.='Date '.$DATE_INSERT.'<br><br>';
$info.="</center>";
$info.='Vente Num/Ref : <b>'.$NUMERO_FATURE.'</b><br>';
$info.='Associer des ventes: <b>'.$donne_facture['NOM'].' '.$donne_facture['PRENOM'].'</b><br>';
$info.='Client : <b>'.$donne_facture['NOM_CLIENT'].' '.$donne_facture['PRENOM_CLIENT'].'</b><br>';
$info.='-------------------------------------------------<br><br>';
$info.='<table style="width:100%"><tr><th>#</th><th>Px</th><th>Qt</th><th>PU</th><th>PT</th></tr>';

$i = 1;
  foreach ($det_medicam as  $key) {
  	$info.='<tr>';
  	$info.='<td>'.$i .'</td>';
  	$info.='<td>'.$key['NOM_PRODUIT'].'</td>';
  	$info.='<td align ="right">'.$key['QUANTITE'].'</td>';
  	$info.='<td align ="right">'.$key['PRIX_UNITAIRE'].'</td>';
  	$info.='<td align ="right">'.$key['PRIX_TOTAL'].'</td>';
    // $info.='# '.$i.' '.$key['NOM_PRODUIT'].' '),0,1,'L');
    // $info.=number_format($key['QUANTITE'],0,',',' ').' pc * '.number_format($key['PRIX_UNITAIRE'],0,',',' ').' BIF'),0,0,'L');
    // $pdf->Cell(90,10,utf8_decode(number_format($key['PRIX_TOTAL'],0,',',' ').' BIF'),0,1,'R');
     $i++;

    $info.='</tr>';
}
$info.='<tr><th></th><th>TOTAL</th><th></th><th></th><th align ="right">'.$donne_facture['MONTANT_TOTAL'].'</th></tr>';

foreach ($det_remise as  $rem) {
  if ($rem['NOM_ASSURANCE'] == NULL) {
    
    $info.='<tr><td></td><td>Remise</td><td></td><td></td><td align ="right">'.number_format($rem['MONTANT_REMISE'],0,',',' ').'</td></tr>';

  }
  else{
    $pdf->Cell(102,10,utf8_decode(' Assurance ('.$rem['NOM_ASSURANCE'].')'),0,0,'L');
    $pdf->Cell(90,10,utf8_decode(' '.number_format($rem['MONTANT_REMISE'],0,',',' ').' BIF'),0,1,'R');
     $info.='<tr><td></td><td>Assurance ('.$rem['NOM_ASSURANCE'].')</td><td></td><td></td><td align ="right">'.number_format($rem['MONTANT_REMISE'],0,',',' ').'</td></tr>';
  }
    

$info.='</table>';
echo $info;
  }


}