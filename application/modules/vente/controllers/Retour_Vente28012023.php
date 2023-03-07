<?php 
 /**
  * 
  */
 class Retour_Vente extends CI_Controller
 {
  
  function __construct()
  {
    parent::__construct();
    $this->load->library('Mylibrary');
    $this->ci = & get_instance();
    $this->ci->load->library("user_agent");
    $this->Is_Connected();

    }

  public function Is_Connected()
       {

       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

          public function Is_permis()
       {

       // if ($this->mylibrary->get_permission('Mettre_Carburant') ==0)
       //  {
       //   redirect(base_url('Login/'));
       //  }
       }









  public function index()
  {
  
      $DATE_DEBUT = $this->input->post('DATE_DEBUT');
      $DATE_FIN = $this->input->post('DATE_FIN');

      

      if ($DATE_DEBUT != NULL) {
        

        if ($DATE_FIN != NULL) {
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= $this->input->post('DATE_FIN');
          $conddatedebut = ' AND DATE_TIME_VENTE BETWEEN "'.$DATE_DEBUT.'" AND "'.$DATE_FIN.'"';
        }
        else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $conddatedebut = ' AND DATE_TIME_VENTE BETWEEN "'.$DATE_DEBUT.'" AND "'.date("Y-m-d").'"';
        }

        
      }
      else{
          $data['DATE_DEBUTS']= date("Y-m-d");
          $data['DATE_FINS']= date("Y-m-d");
          $conddatedebut = ' AND DATE_TIME_VENTE LIKE "'.date("Y-m-d").'%" ';
      }

      $ID_USER = $this->input->post('ID_USER');
      $data['ID_USERS']= $this->input->post('ID_USER');

      if ($ID_USER !=NULL) {
        $conduser='AND ID_USER_VENDEUR ='.$ID_USER.' ';
      }
      else{
        $conduser='';
      }


     $data['title'] = "Vente ";
     $data['produit']='';
     $data['client'] = $this->Model->getRequete('SELECT * FROM `saisie_client` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_CLIENT');
     $data['vente'] = $this->Model->getRequete('SELECT ID_USER_VENDEUR, config_user.NOM, config_user.PRENOM,`DATE_TIME_VENTE`,  `MONTANT_TOTAL`, `MONTANT_PAYE`, `MONTANT_REMISE`, saisie_client.NOM_CLIENT, saisie_client.PRENOM_CLIENT, `ID_VENTE` FROM `vente_vente` JOIN config_user ON config_user.ID_USER = vente_vente.ID_USER_VENDEUR LEFT JOIN saisie_client ON saisie_client.ID_CLIENT = vente_vente.ID_CLIENT WHERE 1 AND vente_vente.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' '.$conduser.' '.$conddatedebut.'  ');
    

    $this->load->view("Retour_Vente_List_View",$data);
  }


  public function delete_items($ID_VENTE_DETAIL)
  {
    

    $det_vente = $this->Model->getRequeteOne('SELECT vente_detail.ID_VENTE_DETAIL, vente_detail.ID_VENTE, vente_detail.ID_BARCODE, vente_detail.ID_PRODUIT, vente_detail.PRIX_UNITAIRE, vente_detail.CUNIQUE, vente_vente.MONTANT_TOTAL, vente_vente.ID_CLIENT, vente_vente.ID_USER_VENDEUR, vente_vente.MONTANT_PAYE, vente_vente.MONTANT_REMISE FROM `vente_detail` JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE WHERE ID_VENTE_DETAIL = '.$ID_VENTE_DETAIL.'');
    echo "<pre>";
    print_r($det_vente);

    
    $remise_ass = $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NOT NULL');
    $remise_client = $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NULL');



     $CUNIQUE =$det_vente['CUNIQUE'];
     $ID_CLIENT =$det_vente['ID_CLIENT'];
     $MONTANT_TOTAL =$det_vente['MONTANT_TOTAL'];
     $MONTANT_REMISE =$det_vente['MONTANT_REMISE'];
     $MONTANT_PAYE =$det_vente['MONTANT_PAYE'];

//      $ID_ASSURANCE =$this->input->post('ID_ASSURANCE');
//      $ID_TYPE_REMISE_ASS =$this->input->post('ID_TYPE_REMISE_ASS');
//      $ID_TYPE_REMISE_CLIENT =$this->input->post('ID_TYPE_REMISE_CLIENT');
//      $MONTANT_ASSURANCE =$this->input->post('MONTANT_ASSURANCE');
     


//      $data_vente= array(
//                   'ID_USER_VENDEUR'=>$this->session->userdata('STRAPH_ID_USER'),  
//                   'MONTANT_TOTAL'=>$MONTANT_TOTAL,  
//                   'MONTANT_PAYE'=>$MONTANT_PAYE,  
//                   'MONTANT_REMISE'=>$MONTANT_REMISE + $MONTANT_ASSURANCE,  
//                   'ID_CLIENT'=>$ID_CLIENT,  
//                   'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
//                   );

//      // echo "<pre>";
//      // print_r($data_vente);

//      $ID_VENTE = $this->Model->insert_last_id('vente_vente',$data_vente);

//      $det_produit = $this->Model->getRequete('SELECT ID_VENTE_DETAIL, ID_BARCODE FROM `vente_detail` WHERE 1 AND CUNIQUE like "'.$CUNIQUE.'" AND ID_VENTE = 0');
//      foreach ($det_produit as $value) {

//          $dataupdate_v_detail = array('ID_VENTE' => $ID_VENTE);
//          $critere_v_detail = array('ID_VENTE_DETAIL' => $value['ID_VENTE_DETAIL']);
//          // print_r($dataupdate_v_detail);
//          // print_r($critere_v_detail);


         
//          $dataupdate_bar_detail = array('STATUS' => 2);
//          $critere_bar_detail = array('ID_BARCODE' => $value['ID_BARCODE']);

//          // print_r($dataupdate_bar_detail);
//          // print_r($critere_bar_detail);

//          $this->Model->update('vente_detail', $critere_v_detail, $dataupdate_v_detail);
//          $this->Model->update('req_barcode', $critere_bar_detail, $dataupdate_bar_detail);

//          $barcode = $this->Model->getRequeteOne('SELECT ID_PRODUIT, PRIX_VENTE FROM `req_barcode` WHERE 1 AND ID_BARCODE ='.$value['ID_BARCODE'].' ');
//          $stock = $this->Model->getRequeteOne('SELECT ID_STOCK, QUANTITE FROM `req_stock` WHERE 1 AND STATUS = 1 AND ID_PRODUIT = '.$barcode['ID_PRODUIT'].' AND PRIX_VENTE = '.$barcode['PRIX_VENTE'].' ');


//          $this->Model->update('req_stock', array('ID_STOCK'=>$stock['ID_STOCK']), array('QUANTITE'=>$stock['QUANTITE']-1));


//      }

     
     
     
//      if ($MONTANT_REMISE > 0) {
//          $remise_client= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_CLIENT));
//      $MONTANT_TOTAL_CL =  ($MONTANT_REMISE * 100 )/$remise_client['POURCENTAGE'];
   

//      $data_remise_client= array(
//                   'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
//                   'ENVOIE'=>0,
//                   'ID_VENTE'=>$ID_VENTE,
//                   'ID_REMISE'=>$ID_TYPE_REMISE_CLIENT,
//                   'MONTANT_REMISE'=>$MONTANT_REMISE,
//                   'MONTANT_TOTAL'=>$MONTANT_TOTAL_CL,
//                   'POURCENTAGE_REMISE'=>$remise_client['POURCENTAGE'],
//                   );
//      $this->Model->create('vente_remise',$data_remise_client);
//      // print_r($data_remise_client);

//      }
     
     
     
    


//      if ($MONTANT_ASSURANCE > 0) {
//          $remise_ass= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_ASS));
//      $MONTANT_TOTAL_ASS =  ($MONTANT_ASSURANCE * 100 )/$remise_ass['POURCENTAGE'];
   
//      $data_remise_ass= array(
//                   'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
//                   'ENVOIE'=>0,
//                   'ID_VENTE'=>$ID_VENTE,
//                   'ID_REMISE'=>$ID_TYPE_REMISE_ASS,
//                   'MONTANT_REMISE'=>$MONTANT_ASSURANCE,
//                   'MONTANT_TOTAL'=>$MONTANT_TOTAL_ASS,
//                   'ID_ASSURANCE'=>$ID_ASSURANCE,
//                   'POURCENTAGE_REMISE'=>$remise_ass['POURCENTAGE'],
//                   );
//      $this->Model->create('vente_remise',$data_remise_ass);
//      // print_r($data_remise_ass);

//      }


// // $message = "<div class='row alert alert-success' role='alert' id='message'>
// //                         <div class='col-md-6'>
// //                         Enregistrement fait avec succès.
// //                         </div>
// //                         <div class='col-md-6 text-right'>
// //                         <a class='btn btn-success btn-sm' href='".base_url('vente/Pdf/print_facture/'.$ID_VENTE.'')."' target='_blank' role='button'><i class='fa fa-print' aria-hidden='true'></i> Imprimer la facture de ".$MONTANT_TOTAL." </a>
// //                         </div>
// //             </div>";    


// $message = "<div class='row alert alert-success' role='alert' id='message'>
//                         <div class='col-md-6'>
//                         Enregistrement fait avec succès.
//                         </div>
//                         <div class='col-md-6 text-right'>
//                         <button id='facture-".$ID_VENTE."' class='btn btn-success btn-sm facture'  role='button'><i class='fa fa-print' aria-hidden='true'></i> Imprimer la facture de ".$MONTANT_TOTAL." </button>
//                         </div>
//             </div>";    
//         $this->session->set_flashdata(array('message'=>$message));
//         redirect(base_url('vente/Vente'));

     

//      // ;
//      // if ($exist) {
//      //    echo "exist";
//      //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
//      // }
//      // else{
//      //    echo "not exist";
//      //    $this->Model->create('req_barcode',$data_qr);
//      //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
//      // }

  }




 }


?>