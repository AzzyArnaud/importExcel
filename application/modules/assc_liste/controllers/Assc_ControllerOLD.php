<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assc_Controller extends CI_Controller {


   public function index()
   {
    $approvisionnement = array(
     // 'ID_ASSURANCE'=>$this->Model->getRequete('SELECT * FROM saisie_assurance where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM_ASSURANCE'),
    );
    $data['approv'] = $approvisionnement;




    $ID_ASSURANCE = $this->input->post('ID_ASSURANCE');
    $data['ID_ASSURANCES']= $this->input->post('ID_ASSURANCE');

    $DATE_DEBUT = $this->input->post('DATE_DEBUT');
    $DATE_FIN = $this->input->post('DATE_FIN');

    if ($ID_ASSURANCE != NULL) {
        $data['condfournisseur'] = 'AND vente_remise.ID_ASSURANCE ='.$ID_ASSURANCE.' ';
        $data['ID_ASSURANCES']= $this->input->post('ID_ASSURANCE');
    }
    else{
        $data['condfournisseur'] = '';
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



  // if ($ID_FOURNISSEUR != NULL) {
  //       $data['condfournisseur'] = 'AND req_requisition.ID_FOURNISSEUR ='.$ID_FOURNISSEUR.' ';
  //       }
  //   else{
  //       $data['condfournisseur'] = '';
  //   }

  $conduser='';

  $data['vente'] = $this->Model->getRequete('SELECT ID_VENTE_REMISE, vente_vente.ID_VENTE,vente_vente.MONTANT_TOTAL,vente_vente.MONTANT_REMISE,vente_vente.DATE_TIME_VENTE,POURCENTAGE_REMISE,saisie_assurance.NOM_ASSURANCE, saisie_client.NOM_CLIENT,saisie_client.PRENOM_CLIENT,vente_vente.DATE_TIME, vente_vente.IS_LIVRAISON, vente_vente.IS_DETTE FROM vente_remise JOIN vente_vente ON vente_vente.ID_VENTE=vente_remise.ID_VENTE JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE=vente_remise.ID_ASSURANCE LEFT JOIN saisie_client ON saisie_client.ID_CLIENT=vente_vente.ID_CLIENT WHERE 1 AND vente_remise.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' '.$conduser.' '.$conddatedebut.' order by ID_VENTE DESC');


  $this->load->view("Assc_View",$data);
}

// function listing()
// {
//     $query_principal = 'SELECT * FROM vente_vente JOIN vente_remise ON vente_vente.ID_VENTE=vente_remise.ID_VENTE JOIN saisie_assurance ON vente_remise.ID_ASSURANCE=saisie_assurance.ID_ASSURANCE LEFT JOIN saisie_client ON vente_vente.ID_CLIENT=saisie_client.ID_CLIENT WHERE 1';

//     $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
//     $limit = 'LIMIT 0,10';

//     if ($_POST['length'] != -1) {
//         $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
//     }

//     $order_by = '';
//     $order_column = array('NOM_ASSURANCE','NOM_CLIENT','PRENOM_CLIENT','POURCENTAGE_REMISE','MONTANT_TOTAL',);
//     if (!empty($order_by)) {
//         $order_by = isset($_POST['order']) ? ' ORDER BY ' . $_POST['order']['0']['column'] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_ASSURANCE   ASC';
//     }


//     $search = !empty($_POST['search']['value']) ?  (" AND (NOM_ASSURANCE LIKE '%$var_search%' OR NOM_CLIENT LIKE '%$var_search%' OR PRENOM_CLIENT LIKE '%$var_search%' OR POURCENTAGE_REMISE LIKE '%$var_search%' OR MONTANT_TOTAL LIKE '%$var_search%')") :'';
//     $critaire = '';
//     $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
//     $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;
//     $fetch_cov_frais = $this->Model->datatable($query_secondaire);
//     $data = array();
//     $u = 1;

//     foreach ($fetch_cov_frais as $info) {

//         $post = array();
//         $post[] = $u++;
//         $post[] = $info->NOM_ASSURANCE;
//         $post[] = $info->NOM_CLIENT.' '.$info->PRENOM_CLIENT;
//         $post[] = $info->POURCENTAGE_REMISE;
//         $post[] = $info->MONTANT_TOTAL;



//         $data[] = $post;


//     }
//     $output = array(
//         "draw" => intval($_POST['draw']),
//         "recordsTotal" => $this->Model->all_data($query_principal),
//         "recordsFiltered" => $this->Model->filtrer($query_filter),
//         "data" => $data,
//     );
//     echo json_encode($output);
// }

}