<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assc_Controller extends CI_Controller {

   public function index()
   {

    $ID_ASSURANCE = $this->input->post('ID_ASSURANCE');
    $data['ID_ASSURANCES']= $this->input->post('ID_ASSURANCE');

    $DATE_DEBUT = $this->input->post('DATE_DEBUT');
    $DATE_FIN = $this->input->post('DATE_FIN');

    if ($ID_ASSURANCE != NULL) {
        
        $condassurance = 'AND vente_remise.ID_ASSURANCE ='.$ID_ASSURANCE.' ';
        $data['ID_ASSURANCES']= $this->input->post('ID_ASSURANCE');
        $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";
    }
    else{
        $condassurance = '';
        $data['ID_ASSURANCES']= $this->input->post('ID_ASSURANCE');
        $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";
    }

    if ($DATE_DEBUT != NULL) {

      if ($DATE_FIN != NULL) {
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= $this->input->post('DATE_FIN');
          $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";

          $originalDate = "2010-03-21";
          $data['periodes'] = 'Entre '.date("d-m-Y", strtotime($DATE_DEBUT)).' et '.date("d-m-Y", strtotime($DATE_FIN));
      }
      else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";
          $data['periodes'] = 'Entre '.date("d-m-Y", strtotime($DATE_DEBUT)).' et '.date("d-m-Y", strtotime($DATE_FIN));
      }
  }
  else{
      $data['DATE_DEBUTS']= date("Y-m-d");
      $data['DATE_FINS']= date("Y-m-d");
      $conddatedebut = ' AND DATE_TIME_VENTE LIKE "'.date("Y-m-d").'%" ';
      $data['periodes'] = 'Le '.date("d-m-Y");
  }

  $conduser='';

  $data['vente'] = $this->Model->getRequete('SELECT ID_VENTE_REMISE, vente_vente.ID_VENTE,vente_vente.MONTANT_TOTAL,vente_vente.MONTANT_REMISE,vente_vente.DATE_TIME_VENTE,POURCENTAGE_REMISE,saisie_assurance.NOM_ASSURANCE, saisie_client.NOM_CLIENT,saisie_client.PRENOM_CLIENT,vente_vente.DATE_TIME, vente_vente.IS_LIVRAISON, vente_vente.IS_DETTE FROM vente_remise JOIN vente_vente ON vente_vente.ID_VENTE=vente_remise.ID_VENTE JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE=vente_remise.ID_ASSURANCE LEFT JOIN saisie_client ON saisie_client.ID_CLIENT=vente_vente.ID_CLIENT WHERE 1 AND vente_remise.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' '.$conduser.' '.$conddatedebut.' '.$condassurance.' order by ID_VENTE DESC');


  $this->load->view("Assc_View",$data);
}


}