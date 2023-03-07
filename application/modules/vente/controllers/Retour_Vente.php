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

    
    // $to_delete_det = $this->Model->getRequete('SELECT vente_vente.ID_VENTE FROM `vente_vente` LEFT JOIN vente_detail ON vente_detail.ID_VENTE = vente_vente.ID_VENTE WHERE vente_detail.ID_VENTE IS NULL');
    // foreach ($to_delete_det as $details) {
    //   // vente_vente

    //   // echo $details['ID_VENTE'].'-<br>';
    //   $this->Model->delete('vente_vente',array('ID_VENTE' =>$details['ID_VENTE']));
    // }

    // SELECT * FROM `vente_vente` LEFT JOIN vente_remise ON vente_remise.ID_VENTE = vente_vente.ID_VENTE WHERE vente_remise.ID_VENTE IS NULL
    // $to_delete_remise = $this->Model->getRequete('SELECT vente_vente.ID_VENTE FROM `vente_vente` LEFT JOIN vente_detail ON vente_detail.ID_VENTE = vente_vente.ID_VENTE WHERE vente_detail.ID_VENTE IS NULL');
    // foreach ($to_delete_remise as $remise) {
    //   // code...
    //   // echo $remise['ID_VENTE'].'-<br>';
    //    $this->Model->delete('vente_vente',array('ID_VENTE' =>$remise['ID_VENTE']));


    // }
// exit();
  
      $DATE_DEBUT = $this->input->post('DATE_DEBUT');
      $DATE_FIN = $this->input->post('DATE_FIN');

      

      if ($DATE_DEBUT != NULL) {
        

        if ($DATE_FIN != NULL) {
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= $this->input->post('DATE_FIN');
          $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";
        }
        else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $conddatedebut=" AND DATE_FORMAT(DATE_TIME_VENTE,'%Y-%m-%d') BETWEEN '".$DATE_DEBUT."' and '".$DATE_FIN."'";



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
    
// echo "string";
    $det_vente = $this->Model->getRequeteOne('SELECT vente_detail.ID_VENTE_DETAIL, vente_detail.ID_VENTE, vente_detail.ID_BARCODE, vente_detail.ID_PRODUIT, vente_detail.PRIX_UNITAIRE, vente_detail.CUNIQUE, vente_vente.MONTANT_TOTAL, vente_vente.ID_CLIENT, vente_vente.ID_USER_VENDEUR, vente_vente.MONTANT_PAYE, vente_vente.MONTANT_REMISE FROM `vente_detail` JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE WHERE ID_VENTE_DETAIL = '.$ID_VENTE_DETAIL.'');
    echo "<pre>";
    print_r($det_vente);

    


    
    $data_vente = $this->Model->getRequeteOne('SELECT * FROM vente_vente WHERE ID_VENTE ='.$det_vente['ID_VENTE'].' ');
    

     // $ID_ASSURANCE =$this->input->post('ID_ASSURANCE');
     // $ID_TYPE_REMISE_ASS =$this->input->post('ID_TYPE_REMISE_ASS');
     // $ID_TYPE_REMISE_CLIENT =$this->input->post('ID_TYPE_REMISE_CLIENT');
     // $MONTANT_ASSURANCE =$this->input->post('MONTANT_ASSURANCE');
     


     $delete_data_vente= array(
                  'ID_VENTE'=>$data_vente['ID_VENTE'],  
                  'ID_USER_VENDEUR'=>$data_vente['ID_USER_VENDEUR'],  
                  'DATE_TIME_VENTE'=>$data_vente['DATE_TIME_VENTE'], 
                  'MONTANT_TOTAL'=>$data_vente['MONTANT_TOTAL'],  
                  'MONTANT_PAYE'=>$data_vente['MONTANT_PAYE'],  
                  'MONTANT_REMISE'=>$data_vente['MONTANT_REMISE'],  
                  'ID_CLIENT'=>$data_vente['ID_CLIENT'],  
                  'ID_SOCIETE'=>$data_vente['ID_CLIENT'],
                  'IS_LIVRAISON'=>$data_vente['IS_LIVRAISON'],
                  'IS_DETTE'=>$data_vente['IS_DETTE'],
                  );

     // print_r($delete_data_vente);

    
   

    $this->Model->create('delete_vente_vente',$delete_data_vente);
    $this->Model->delete('vente_vente',array('ID_VENTE' =>$det_vente['ID_VENTE']));

     $data_vente_details = $this->Model->getRequete('SELECT * FROM vente_detail WHERE ID_VENTE ='.$det_vente['ID_VENTE'].' ');

     foreach ($data_vente_details as $data_vente_detail) {
      if ($data_vente_detail['ID_VENTE_DETAIL'] == $ID_VENTE_DETAIL) {
        $IS_DELETED = 1;
      }
      else{
       $IS_DELETED = 0;
      }

      $delete_data_vente_detail= array(
                  'ID_VENTE_DETAIL'=>$data_vente_detail['ID_VENTE_DETAIL'],  
                  'ID_VENTE'=>$data_vente_detail['ID_VENTE'],  
                  'ID_BARCODE'=>$data_vente_detail['ID_BARCODE'], 
                  'ID_PRODUIT'=>$data_vente_detail['ID_PRODUIT'],  
                  'ID_SOCIETE'=>$data_vente_detail['ID_SOCIETE'],  
                  'ENVOIE'=>$data_vente_detail['ENVOIE'],  
                  'PRIX_UNITAIRE'=>$data_vente_detail['PRIX_UNITAIRE'],  
                  'CUNIQUE'=>$data_vente_detail['CUNIQUE'],
                  'SOURCE'=>$data_vente_detail['SOURCE'],
                  'IS_DELETED'=>$IS_DELETED
                  );

      
      // print_r($delete_data_vente_detail);

      
     
     if ($this->Model->checkvalue('delete_vente_detail',array('ID_VENTE_DETAIL'=>$data_vente_detail['ID_VENTE_DETAIL']))) {
      
          $this->Model->update('delete_vente_detail',array('ID_VENTE_DETAIL'=>$data_vente_detail['ID_VENTE_DETAIL']),$delete_data_vente_detail);
      // echo "<br>Mofication dans delete_vente_detail ".$data_vente_detail['ID_VENTE_DETAIL'];
        }
        else{
      // echo "<br>Enregistrement dans delete_vente_detail ".$data_vente_detail['ID_VENTE_DETAIL'];

          $this->Model->create('delete_vente_detail',$delete_data_vente_detail);
        }

     $this->Model->delete('vente_detail',array('ID_VENTE_DETAIL' =>$data_vente_detail['ID_VENTE_DETAIL']));
        // echo "<br>Delete dans vente_detail ".$data_vente_detail['ID_VENTE_DETAIL'];
     }

     // exit();




     $data_vente_remises = $this->Model->getRequete('SELECT * FROM vente_remise WHERE ID_VENTE ='.$det_vente['ID_VENTE'].' ');

     foreach ($data_vente_remises as $data_vente_remise) {
       $delete_data_vente_remise= array(
                  'ID_VENTE_REMISE'=>$data_vente_remise['ID_VENTE_REMISE'],  
                  'ID_VENTE'=>$data_vente_remise['ID_VENTE'],  
                  'ID_REMISE'=>$data_vente_remise['ID_REMISE'], 
                  'MONTANT_TOTAL'=>$data_vente_remise['MONTANT_TOTAL'],  
                  'MONTANT_REMISE'=>$data_vente_remise['MONTANT_REMISE'],  
                  'POURCENTAGE_REMISE'=>$data_vente_remise['POURCENTAGE_REMISE'],  
                  'ID_ASSURANCE'=>$data_vente_remise['ID_ASSURANCE'],  
                  'ID_SOCIETE'=>$data_vente_remise['ID_SOCIETE'],
                  'ENVOIE'=>$data_vente_remise['ENVOIE'],
                  );

     // echo "<pre>";
     // print_r($delete_data_vente_remise);

     
     if (!$this->Model->checkvalue('delete_vente_remise',array('ID_VENTE_REMISE'=>$data_vente_remise['ID_VENTE_REMISE']))) {
          $this->Model->create('delete_vente_remise',$delete_data_vente_remise);
        }
        $this->Model->delete('vente_remise',array('ID_VENTE_REMISE' =>$data_vente_remise['ID_VENTE_REMISE']));
     

     }

     // exit();



     


         
    // $remise_client = $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NULL');



     $CUNIQUE =$det_vente['CUNIQUE'];
     $ID_CLIENT =$det_vente['ID_CLIENT'];
     // $MONTANT_TOTAL =$det_vente['MONTANT_TOTAL'];
     // $MONTANT_REMISE =$det_vente['MONTANT_REMISE'];
     // $MONTANT_PAYE =$det_vente['MONTANT_PAYE'];


     // $ID_ASSURANCE =$this->input->post('ID_ASSURANCE');
     // $ID_TYPE_REMISE_ASS =$this->input->post('ID_TYPE_REMISE_ASS');
     // $ID_TYPE_REMISE_CLIENT =$this->input->post('ID_TYPE_REMISE_CLIENT');
     // $MONTANT_TOTAL =$this->input->post('MONTANT_TOTAL');
     // $MONTANT_REMISE =$this->input->post('MONTANT_REMISE');
     // $MONTANT_ASSURANCE =$this->input->post('MONTANT_ASSURANCE');
     // $MONTANT_PAYE =$this->input->post('MONTANT_PAYE');
     // $IS_LIVRAISON =$this->input->post('IS_LIVRAISON');
     // $IS_DETTE =$this->input->post('IS_DETTE');



    // $sum = $this->Model->getRequeteOne('SELECT SUM(PRIX_UNITAIRE) AS PRIX_UNITAIRE FROM delete_vente_detail WHERE 1 AND ID_VENTE = '.$data_vente['ID_VENTE'].' AND IS_DELETED != 0');
    $sum = $this->Model->getRequeteOne('SELECT SUM(PRIX_UNITAIRE) AS PRIX_UNITAIRE FROM delete_vente_detail WHERE 1 AND ID_VENTE = '.$data_vente['ID_VENTE'].' AND IS_DELETED = 0');
    // print_r($sum);
// delete_vente_remise
    $remise_ass = $this->Model->getRequeteOne('SELECT POURCENTAGE_REMISE, ID_VENTE_REMISE, ID_REMISE, ID_SOCIETE, ID_ASSURANCE FROM delete_vente_remise WHERE ID_VENTE = '.$data_vente['ID_VENTE'].' AND delete_vente_remise.ID_ASSURANCE IS NOT NULL');
    $remise_cli = $this->Model->getRequeteOne('SELECT POURCENTAGE_REMISE, ID_VENTE_REMISE, ID_REMISE, ID_SOCIETE, ID_ASSURANCE FROM delete_vente_remise WHERE ID_VENTE = '.$data_vente['ID_VENTE'].' AND delete_vente_remise.ID_ASSURANCE IS NULL');

    if (!empty($remise_ass)) {
      // code...
      $MONTANT_ASSURANCE = $sum['PRIX_UNITAIRE'] * $remise_ass['POURCENTAGE_REMISE']/100;
      $NEW_TOTAL = $sum['PRIX_UNITAIRE'] - $MONTANT_ASSURANCE;

      $data_remise_ass= array(
                  'ID_VENTE_REMISE'=>$remise_ass['ID_VENTE_REMISE'],
                  'ID_SOCIETE'=>$remise_ass['ID_SOCIETE'],
                  'ENVOIE'=>0,
                  'ID_VENTE'=>$data_vente['ID_VENTE'],
                  'ID_REMISE'=>$remise_ass['ID_REMISE'],
                  'MONTANT_REMISE'=>$MONTANT_ASSURANCE,
                  'MONTANT_TOTAL'=>$sum['PRIX_UNITAIRE'],
                  'ID_ASSURANCE'=>$remise_ass['ID_ASSURANCE'],
                  'POURCENTAGE_REMISE'=>$remise_ass['POURCENTAGE_REMISE'],
                  );
      // print_r($data_remise_ass);
     if (!empty($MONTANT_ASSURANCE)) {
        $this->Model->create('vente_remise',$data_remise_cli);
      }

    }
    else{
      $MONTANT_ASSURANCE = 0;
      $NEW_TOTAL = $sum['PRIX_UNITAIRE'];
    }

    if (!empty($remise_cli)) {
      // code...
      $MONTANT_REMISE = $NEW_TOTAL * $remise_cli['POURCENTAGE_REMISE']/100;
      $data_remise_cli= array(
                  'ID_VENTE_REMISE'=>$remise_cli['ID_VENTE_REMISE'],
                  'ID_SOCIETE'=>$remise_cli['ID_SOCIETE'],
                  'ENVOIE'=>0,
                  'ID_VENTE'=>$data_vente['ID_VENTE'],
                  'ID_REMISE'=>$remise_cli['ID_REMISE'],
                  'MONTANT_REMISE'=>$MONTANT_REMISE,
                  'MONTANT_TOTAL'=>$NEW_TOTAL,
                  'ID_ASSURANCE'=>$remise_cli['ID_ASSURANCE'],
                  'POURCENTAGE_REMISE'=>$remise_cli['POURCENTAGE_REMISE'],
                  );
      // print_r($data_remise_cli);
      if (!empty($MONTANT_REMISE)) {
        $this->Model->create('vente_remise',$data_remise_cli);
      }
      
    }
    else{
      $MONTANT_REMISE = 0;
    }

    $MONTANT_PAYE = $sum['PRIX_UNITAIRE'] - $MONTANT_ASSURANCE - $MONTANT_REMISE;

    

    // $this->Model->getRequeteOne('SELECT * FROM vente_detail JOIN vente_remise ON vente_remise.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_VENTE_DETAIL ='.$ID_VENTE_DETAIL.' AND vente_remise.ID_ASSURANCE IS NULL');



     $data_vente= array(
                  'ID_VENTE'=>$data_vente['ID_VENTE'],  
                  'ID_USER_VENDEUR'=>$data_vente['ID_USER_VENDEUR'], 
                  'DATE_TIME_VENTE' =>$data_vente['DATE_TIME_VENTE'], 
                  'MONTANT_TOTAL'=>$sum['PRIX_UNITAIRE'],  
                  'MONTANT_PAYE'=>$MONTANT_PAYE,  
                  'MONTANT_REMISE'=>$MONTANT_REMISE + $MONTANT_ASSURANCE,  
                  'ID_CLIENT'=>$data_vente['ID_CLIENT'],  
                  'ENVOIE'=>0,
                  'IS_LIVRAISON'=>$data_vente['IS_LIVRAISON'],
                  'IS_DETTE'=>$data_vente['IS_DETTE'],
                  'ID_SOCIETE'=>$data_vente['ID_SOCIETE'],
                  );

     // echo "<pre>";
     // print_r($data_vente);

     
     if (!empty($sum['PRIX_UNITAIRE']) || $sum['PRIX_UNITAIRE'] != 0) {
       $this->Model->insert_last_id('vente_vente',$data_vente);
     }
     

     $ndata_vente_details = $this->Model->getRequete('SELECT * FROM delete_vente_detail WHERE ID_VENTE ='.$det_vente['ID_VENTE'].'');

     foreach ($ndata_vente_details as $data_vente_detail) {
      
      if ($data_vente_detail['IS_DELETED'] == 0) {
        $ndelete_data_vente_detail= array(
                  'ID_VENTE_DETAIL'=>$data_vente_detail['ID_VENTE_DETAIL'],  
                  'ID_VENTE'=>$data_vente_detail['ID_VENTE'],  
                  'ID_BARCODE'=>$data_vente_detail['ID_BARCODE'], 
                  'ID_PRODUIT'=>$data_vente_detail['ID_PRODUIT'],  
                  'ID_SOCIETE'=>$data_vente_detail['ID_SOCIETE'],  
                  'ENVOIE'=>$data_vente_detail['ENVOIE'],  
                  'PRIX_UNITAIRE'=>$data_vente_detail['PRIX_UNITAIRE'],  
                  'CUNIQUE'=>$data_vente_detail['CUNIQUE'],
                  'SOURCE'=>$data_vente_detail['SOURCE'],
                  );

     // echo "<pre>";
     // print_r($ndelete_data_vente_detail);
        if (!$this->Model->checkvalue('vente_detail',array('ID_VENTE_DETAIL'=>$data_vente_detail['ID_VENTE_DETAIL']))) {
          $this->Model->create('vente_detail',$ndelete_data_vente_detail);
        }
     
      }
      else{

             // if ($value['SOURCE']==1 || $value['SOURCE']==2) {
             // code...
            // $stock = $this->Model->getRequeteOne('SELECT ID_STOCK, QUANTITE FROM `req_stock` WHERE 1 AND STATUS = 1 AND ID_PRODUIT = '.$value['ID_PRODUIT'].' AND PRIX_VENTE = '.$value['PRIX_UNITAIRE'].' ');
            $this->Model->update('req_barcode', array('ID_BARCODE'=>$data_vente_detail['ID_BARCODE']), array('STATUS' => 1,"ENVOIE"=>0));

            $stock = $this->Model->getRequeteOne('SELECT ID_STOCK, QUANTITE FROM `req_stock` WHERE 1 AND STATUS = 1 AND ID_PRODUIT = '.$data_vente_detail['ID_PRODUIT'].' AND PRIX_VENTE = '.$data_vente_detail['PRIX_UNITAIRE'].' ');
            if (!empty($stock)) {
              // code...
              $this->Model->update('req_stock', array('ID_STOCK'=>$stock['ID_STOCK']), array('QUANTITE'=>$stock['QUANTITE']+1,"ENVOIE"=>0));
            }
          
         // }

      }

      
     }


     // exit();


     $message = "<div class='row alert alert-success' role='alert' id='message'>      
                        Retours fait avec succès.
                </div>";    
     $this->session->set_flashdata(array('message'=>$message));
     redirect(base_url('vente/Retour_Vente'));




  }




 }


?>