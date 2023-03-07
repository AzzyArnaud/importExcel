<?php 
 /**
  * 
  */
 class View_Stock extends CI_Controller
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
  
    $BARCODE = $this->input->post('BARCODE');

      if (empty($BARCODE)) {
        $data['resultat']='';
      }
      else{
      

      
      $detail = $this->Model->getRequeteOne('SELECT BARCODE, req_requisition.ID_REQUISITION, NB_SCANABLE, PRIX_VENTE, PRIX_VENTE_DETAIL, IF(req_barcode.STATUS = 0, "Non Atribue", IF(req_barcode.STATUS = 1,"Correcte", IF(req_barcode.STATUS = 2,"Deja scanne", IF(req_barcode.STATUS = 3,"Scanable Plusieur Fois","")))) AS STATUS, req_requisition.DATE_REQUISITION, saisie_produit.NOM_PRODUIT, config_user.NOM, config_user.PRENOM, saisie_fournisseur.NOM AS FOURNISSEUR, req_requisition.DATE_PERAMPTION FROM `req_barcode` JOIN req_requisition ON req_requisition.ID_REQUISITION = req_barcode.ID_REQUISITION JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_barcode.ID_PRODUIT JOIN config_user ON config_user.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE `BARCODE` LIKE "'.$BARCODE.'" ');
      
     $data['title'] = "Details ";
     $data['produit']='';

     if ($BARCODE == NULL) {

       $data['resultat']='<div class="alert alert-danger" role="alert" id="message">Mauvais format du Barre code</div>';
     }
     else{
      if (empty($detail)) {
        $data['resultat']='<div class="alert alert-danger" role="alert" id="message">Mauvais Barre code</div>';
      }
      else{

      

      $resultat='<table class="table">
      <tr>
      <td>Nom</td>
      <td>'.$detail['NOM_PRODUIT'].'</td>
      <td>Status</td>
      <td>'.$detail['STATUS'].'</td>
      </tr>
      <tr>
      <td>Num Requisition</td>
      <td>'.$detail['ID_REQUISITION'].'</td>
      <td>Date Requisition</td>
      <td>'.$detail['DATE_REQUISITION'].'</td>
      </tr>

      <tr>
      <td>Requisition Par</td>
      <td>'.$detail['NOM'].' '.$detail['PRENOM'].'</td>
      <td>Bar Code</td>
      <td>'.$detail['BARCODE'].'</td>
      </tr>
      <tr>
      <td>Nb scanable</td>
      <td>'.$detail['NB_SCANABLE'].'</td>
      <td>Prix de vente</td>
      <td>'.$detail['PRIX_VENTE'].' '.$detail['PRIX_VENTE_DETAIL'].'</td>
      </tr>

      <tr>
      <td>Nb scanable</td>
      <td>'.$detail['FOURNISSEUR'].'</td>
      <td>Date peramption</td>
      <td>'.$detail['DATE_PERAMPTION'].'</td>
      </tr>
      
      </table>';
      $data['resultat']=$resultat;
     }
     }
     }

     

    $this->load->view("View_Stock_View",$data);
  }


  public function delete_items($ID_VENTE_DETAIL)
  {
    

    $det_vente = $this->Model->getRequeteOne('SELECT vente_detail.ID_VENTE_DETAIL, vente_detail.ID_VENTE, vente_detail.ID_BARCODE, vente_detail.ID_PRODUIT, vente_detail.PRIX_UNITAIRE, vente_detail.CUNIQUE, vente_vente.MONTANT_TOTAL, vente_vente.ID_CLIENT, vente_vente.ID_USER_VENDEUR, vente_vente.MONTANT_PAYE, vente_vente.MONTANT_REMISE, vente_detail.ID_SOCIETE FROM `vente_detail` JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE WHERE ID_VENTE_DETAIL = '.$ID_VENTE_DETAIL.'');
    // echo "<pre>";
    // print_r($det_vente);

    
    $remise_ass = $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NOT NULL');
    $remise_client = $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NULL');



     $CUNIQUE =$det_vente['CUNIQUE'];
     $ID_CLIENT =$det_vente['ID_CLIENT'];
     $MONTANT_TOTAL =$det_vente['MONTANT_TOTAL'];
     $MONTANT_REMISE =$det_vente['MONTANT_REMISE'];
     $MONTANT_PAYE =$det_vente['MONTANT_PAYE'];

     if (!empty($remise_ass)) {
            $ID_ASSURANCE =$remise_ass['ID_ASSURANCE'];
            $ID_TYPE_REMISE_ASS =$remise_ass['ID_REMISE'];
            $MONTANT_ASSURANCE =$remise_ass['MONTANT_REMISE'];
     }
     else{
            $ID_ASSURANCE =NULL;
            $ID_TYPE_REMISE_ASS =NULL;
            $MONTANT_ASSURANCE =NULL;
     }

     if (!empty($remise_client)) {
           $ID_TYPE_REMISE_CLIENT =$remise_client['ID_REMISE'];
     }
     else{
        $ID_TYPE_REMISE_CLIENT =NULL;
     }

     // $det_produit = $this->Model->getRequete('SELECT ID_VENTE_DETAIL, ID_BARCODE FROM `vente_detail` WHERE 1 AND CUNIQUE like "'.$CUNIQUE.'" AND ID_VENTE = 0');
     // foreach ($det_produit as $value) {

         $dataupdate_v_detail = array('ID_VENTE' => $det_vente['ID_VENTE']);
         $critere_v_detail = array('ID_VENTE_DETAIL' => $det_vente['ID_VENTE_DETAIL']);
         // print_r($dataupdate_v_detail);
         // print_r($critere_v_detail);
         
         $dataupdate_bar_detail = array('STATUS' => 1,"ENVOIE"=>0);
         $critere_bar_detail = array('ID_BARCODE' => $det_vente['ID_BARCODE']);

         
         $detaildel = array(
          'ID_BARCODE' =>$det_vente['ID_BARCODE'],
          'ID_VENTE_DETAIL' =>$det_vente['ID_VENTE_DETAIL'],
          'ID_VENTE' =>$det_vente['ID_VENTE'],
          'ID_PRODUIT' =>$det_vente['ID_PRODUIT'],
          'PRIX_UNITAIRE' =>$det_vente['PRIX_UNITAIRE'],
          'CUNIQUE' =>$det_vente['CUNIQUE'],
          'ID_SOCIETE' =>$det_vente['ID_SOCIETE'],
         );

         
    

         print_r($dataupdate_bar_detail);
         print_r($critere_bar_detail);
         print_r($detaildel);

         $this->Model->insert_last_id('vente_detail_deleted',$detaildel);
         $this->Model->delete('vente_detail', $critere_v_detail);
         $this->Model->update('req_barcode', $critere_bar_detail, $dataupdate_bar_detail);

         $barcode = $this->Model->getRequeteOne('SELECT ID_PRODUIT, PRIX_VENTE FROM `req_barcode` WHERE 1 AND ID_BARCODE ='.$det_vente['ID_BARCODE'].' ');
         $stock = $this->Model->getRequeteOne('SELECT ID_STOCK, QUANTITE FROM `req_stock` WHERE 1 AND STATUS = 1 AND ID_PRODUIT = '.$barcode['ID_PRODUIT'].' AND PRIX_VENTE = '.$barcode['PRIX_VENTE'].' ');


         $this->Model->update('req_stock', array('ID_STOCK'=>$stock['ID_STOCK']), array('QUANTITE'=>$stock['QUANTITE']+1,"ENVOIE"=>0));


     // // }

        $ntotal = $this->Model->getRequeteOne('SELECT SUM(PRIX_UNITAIRE) AS NPRIX_VENTE FROM `vente_detail` WHERE 1 AND ID_VENTE ='.$det_vente['ID_VENTE'].' ');
        $NMONTANT_TOTAL = $ntotal['NPRIX_VENTE'];

     if (!empty($remise_ass)) {
       $remise_ass= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_ASS));
      $MONTANT_ASSURANCE = ($NMONTANT_TOTAL *  $remise_ass['POURCENTAGE'] )/100;
      // echo '-'.$remise_ass['POURCENTAGE'].'-'.$ID_TYPE_REMISE_ASS;
      
     $data_remise_ass= array(
                  'MONTANT_REMISE'=>$MONTANT_ASSURANCE,
                  'MONTANT_TOTAL'=>$NMONTANT_TOTAL,"ENVOIE"=>0

                  );
     $this->Model->update('vente_remise',array('ID_VENTE_REMISE'=>$remise_ass['ID_VENTE_REMISE']),$data_remise_ass);
     // print_r($data_remise_ass);
     $MONTANT_TOTAL_RESTANT= $NMONTANT_TOTAL - $MONTANT_ASSURANCE;

     }
     else{
      $MONTANT_TOTAL_RESTANT= $NMONTANT_TOTAL;
      $MONTANT_ASSURANCE =0;
     }


     if (!empty($remise_client)) {
       // $remise_ass= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_ASS));
      // $MONTANT_ASSURANCE = ($NMONTANT_TOTAL *  $remise_ass['POURCENTAGE'] )/100;
      
         $remise_client= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_CLIENT));
         // echo '-'.$remise_client['POURCENTAGE'].'-'.$ID_TYPE_REMISE_CLIENT;
     $MONTANT_TOTAL_CL =  ($MONTANT_TOTAL_RESTANT * $remise_client['POURCENTAGE'])/100;
     $data_remise_client= array(
                  // 'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
                  // 'ENVOIE'=>0,
                  // 'ID_VENTE'=>$ID_VENTE,
                  // 'ID_REMISE'=>$ID_TYPE_REMISE_CLIENT,
                  'MONTANT_REMISE'=>$MONTANT_TOTAL_CL,
                  'MONTANT_TOTAL'=>$MONTANT_TOTAL_RESTANT,"ENVOIE"=>0
                  );
     // $MONTANT_TOTAL_ASS= $NMONTANT_TOTAL - $MONTANT_ASSURANCE;

     // print_r($data_remise_client);
     $this->Model->update('vente_remise',array('ID_VENTE_REMISE'=>$remise_client['ID_VENTE_REMISE']),$data_remise_client);

     }
     else{
      $MONTANT_TOTAL_CL= 0;
     }


     $data_vente= array(
                  'MONTANT_TOTAL'=>$NMONTANT_TOTAL,  
                  'MONTANT_PAYE'=>$NMONTANT_TOTAL - $MONTANT_TOTAL_CL - $MONTANT_ASSURANCE,  
                  'MONTANT_REMISE'=>$MONTANT_TOTAL_CL + $MONTANT_ASSURANCE,"ENVOIE"=>0  
                  );

     // echo "<pre>";
     // print_r($data_vente);

     $this->Model->update('vente_vente',array('ID_VENTE'=>$det_vente['ID_VENTE']),$data_vente);



     
     
     
     // if ($ID_TYPE_REMISE_CLIENT != NULL) {
     //     $remise_client= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_CLIENT));

     // $MONTANT_TOTAL_CL =  ($MONTANT_REMISE * 100 )/$remise_client['POURCENTAGE'];
     // $data_remise_client= array(
     //              // 'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
     //              // 'ENVOIE'=>0,
     //              // 'ID_VENTE'=>$ID_VENTE,
     //              // 'ID_REMISE'=>$ID_TYPE_REMISE_CLIENT,
     //              'MONTANT_REMISE'=>$MONTANT_REMISE,
     //              'MONTANT_TOTAL'=>$MONTANT_TOTAL_CL,
     //              'POURCENTAGE_REMISE'=>$remise_client['POURCENTAGE'],
     //              );
     // // $this->Model->update('vente_remise',$data_remise_client);
     // // print_r($data_remise_client);

     // }
     
     
     
    




// // $message = "<div class='row alert alert-success' role='alert' id='message'>
// //                         <div class='col-md-6'>
// //                         Enregistrement fait avec succès.
// //                         </div>
// //                         <div class='col-md-6 text-right'>
// //                         <a class='btn btn-success btn-sm' href='".base_url('vente/Pdf/print_facture/'.$ID_VENTE.'')."' target='_blank' role='button'><i class='fa fa-print' aria-hidden='true'></i> Imprimer la facture de ".$MONTANT_TOTAL." </a>
// //                         </div>
// //             </div>";    


$message = "<div class='row alert alert-success' role='alert' id='message'>
                        Retour Enregistrer avec succès.
            </div>";    
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('vente/Retour_Vente'));

     

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