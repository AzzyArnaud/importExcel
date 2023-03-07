<?php 
 /**
  * 
  */
 class Vente extends CI_Controller
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







  // public function index()
  //   {

  //       $data['title'] = "Liste des Requisitions non mis dans le stock ";
  //       $this->load->view('Vente_Add_View',$data);

  //   }

  // public function detail()
  // {
  //    $DATE_REQUISITION =$this->uri->segment(4);
  //    $ID_USER_REQUISITION =$this->uri->segment(5);
  //    $ID_FOURNISSEUR =$this->uri->segment(6);

  //    $data['listdetail'] = $this->Model->getRequete('SELECT ID_REQUISITION, saisie_produit.NOM_PRODUIT, PRIX_ACHAT_UNITAIRE,QUANTITE,QUANTITE_RESTANT, MONTANT_TOTAL_ACHAT, ID_USER_SAISIE, DATE_PERAMPTION FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
  //    $data['unique'] = $this->Model->getRequeteOne('SELECT DATE_SAISIE,DATE_REQUISITION, saisie_fournisseur.NOM, saisi.NOM AS SNOM , saisi.PRENOM SPRENOM, requi.NOM AS RNOM, requi.PRENOM AS RPRENOM FROM `req_requisition` JOIN config_user as saisi ON saisi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN config_user as requi ON requi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND req_requisition.ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
  //    $data['title'] = "Details ";
  //   $this->load->view("Requisition_List_Detail_View",$data);
  // }


  public function index()
  {
     // $ID_REQUISITION =$this->uri->segment(4);
     // $ID_PRODUIT =$this->uri->segment(5);

     // $data['unique'] = $this->Model->getRequeteOne('SELECT ID_REQUISITION,DATE_REQUISITION,PRIX_VENTE_UNITAIRE,req_requisition.ID_PRODUIT,saisie_produit.NOM_PRODUIT,QUANTITE FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND saisie_produit.ID_PRODUIT = '.$ID_PRODUIT.'  ');
     


     $data['CUNIQUE']=$this->notifications->generate_UIID(13);
     $data['title'] = "Vente ";
     $data['produit']='';
     $data['client'] = $this->Model->getRequete('SELECT * FROM `saisie_client` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_CLIENT');
     $data['assurance'] = $this->Model->getRequete('SELECT * FROM `saisie_assurance` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_ASSURANCE');
     $data['remise'] = $this->Model->getRequete('SELECT * FROM `saisie_type_remise` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" AND ID_ASSURANCE = 0 ORDER BY POURCENTAGE');
     $data['totvente']=0;




    $this->load->view("Vente_Add_View",$data);
  }


  public function save_tempovente()
  {
     $BARCODE =$this->input->post('BARCODE');
     $CUNIQUE =$this->input->post('CUNIQUE');
     // $ID_PRODUIT =$this->input->post('ID_PRODUIT');
     // $PRIX_VENTE =$this->input->post('PRIX_VENTE');

     $bar_produit = $this->Model->getOne('req_barcode',array('BARCODE'=>$BARCODE));

// exit();

     $data_qr = array(
               'ID_VENTE'=>0,                                   
               'ID_BARCODE'=>$bar_produit['ID_BARCODE'],                                   
               'ID_PRODUIT'=>$bar_produit['ID_PRODUIT'],    
               'PRIX_UNITAIRE'=>$bar_produit['PRIX_VENTE'], 
               'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),                              
               'CUNIQUE'=>$this->input->post('CUNIQUE'),               
              );

     $this->Model->create('vente_detail',$data_qr);

    //  // print_r($data_qr);

     $data['CUNIQUE']=$this->input->post('CUNIQUE');

     
     $bar_produit = $this->Model->getRequete('SELECT saisie_produit.NOM_PRODUIT,COUNT(*) AS NOMBRE, vente_detail.PRIX_UNITAIRE FROM `vente_detail` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = vente_detail.ID_PRODUIT WHERE 1 AND CUNIQUE like "'.$CUNIQUE.'" GROUP BY saisie_produit.NOM_PRODUIT, PRIX_UNITAIRE ');

     $data['title'] = "Vente ";

     $produit = '<table class="table">';
     $produit .= '<tr><td colspan="4" class="text-center">Produit enregistre</td></tr>';
     $produit .= '<tr><td>Produit</td><td>Quantite</td><td>PU</td><td>PT</td></tr>';
     $tot = 0;
     foreach ($bar_produit as $key) {

        $sub_tot = $key['NOMBRE'] * $key['PRIX_UNITAIRE'];
        $tot +=$sub_tot;
        $produit .= '<tr><td>'.$key['NOM_PRODUIT'].'</td><td class="text-right">'.$key['NOMBRE'].'</td><td  class="text-right">'.$key['PRIX_UNITAIRE'].'</td><td  class="text-right">'.$sub_tot.'</td></tr>';
     }
     $produit .= '<tr><td colspan="3">Total</td><td class="text-right">'.$tot.'</td></tr>';
     $produit.='</table>';

     $data['produit'] = $produit;
     $data['totvente']=$tot;
     // echo $tot;
     // exit();
     $data['client'] = $this->Model->getRequete('SELECT * FROM `saisie_client` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_CLIENT');
     $data['assurance'] = $this->Model->getRequete('SELECT * FROM `saisie_assurance` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_ASSURANCE');
     $data['remise'] = $this->Model->getRequete('SELECT * FROM `saisie_type_remise` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" AND ID_ASSURANCE = 0 ORDER BY POURCENTAGE');

    $this->load->view("Vente_Add_View",$data);




     // $exist = $this->Model->checkvalue('req_barcode',array('BARCODE'=>$this->input->post('BARCODE')));
     // if ($exist) {
     //    echo "exist";
     //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     // }
     // else{
     //    echo "not exist";
     //    $this->Model->create('req_barcode',$data_qr);
     //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     // }

   
  }


  

 public function getassurance()
    {
    $commune= $this->Model->getList("saisie_type_remise",array('ID_ASSURANCE'=>$this->input->post('ID_ASSURANCE')));
    $datas= '<option value="">-- Sélectionner --</option>';
    foreach($commune as $commun){
    $datas.= '<option value="'.$commun["ID_TYPE_REMISE"].'">'.$commun["POURCENTAGE"].'</option>';
    }
    $datas.= '';
    echo $datas;
    }

public function getremiseassurance()
    {
    $remise= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$this->input->post('ID_TYPE_REMISE_ASS')));
    
    echo $remise['POURCENTAGE'];
    }

    public function getremiseclient()
    {
    $remise= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$this->input->post('ID_TYPE_REMISE_CLIENT')));
    
    echo $remise['POURCENTAGE'];
    }

    

    

  public function save_vente()
  {
     $CUNIQUE =$this->input->post('CUNIQUE');
     $ID_ASSURANCE =$this->input->post('ID_ASSURANCE');
     $ID_CLIENT =$this->input->post('ID_CLIENT');
     $ID_TYPE_REMISE_ASS =$this->input->post('ID_TYPE_REMISE_ASS');
     $ID_TYPE_REMISE_CLIENT =$this->input->post('ID_TYPE_REMISE_CLIENT');
     $MONTANT_TOTAL =$this->input->post('MONTANT_TOTAL');
     $MONTANT_REMISE =$this->input->post('MONTANT_REMISE');
     $MONTANT_ASSURANCE =$this->input->post('MONTANT_ASSURANCE');
     $MONTANT_PAYE =$this->input->post('MONTANT_PAYE');


     $data_vente= array(
                  'ID_USER_VENDEUR'=>$this->session->userdata('STRAPH_ID_USER'),  
                  'MONTANT_TOTAL'=>$MONTANT_TOTAL,  
                  'MONTANT_PAYE'=>$MONTANT_PAYE,  
                  'MONTANT_REMISE'=>$MONTANT_REMISE + $MONTANT_ASSURANCE,  
                  'ID_CLIENT'=>$ID_CLIENT,  
                  'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
                  );

     // echo "<pre>";
     // print_r($data_vente);

     $ID_VENTE = $this->Model->insert_last_id('vente_vente',$data_vente);

     $det_produit = $this->Model->getRequete('SELECT ID_VENTE_DETAIL, ID_BARCODE FROM `vente_detail` WHERE 1 AND CUNIQUE like "'.$CUNIQUE.'" AND ID_VENTE = 0');
     foreach ($det_produit as $value) {

         $dataupdate_v_detail = array('ID_VENTE' => $ID_VENTE);
         $critere_v_detail = array('ID_VENTE_DETAIL' => $value['ID_VENTE_DETAIL']);
         // print_r($dataupdate_v_detail);
         // print_r($critere_v_detail);


         
         $dataupdate_bar_detail = array('STATUS' => 2);
         $critere_bar_detail = array('ID_BARCODE' => $value['ID_BARCODE']);

         // print_r($dataupdate_bar_detail);
         // print_r($critere_bar_detail);

         $this->Model->update('vente_detail', $critere_v_detail, $dataupdate_v_detail);
         $this->Model->update('req_barcode', $critere_bar_detail, $dataupdate_bar_detail);


     }

     
     
     
     if ($MONTANT_REMISE > 0) {
         $remise_client= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_CLIENT));
     $MONTANT_TOTAL_CL =  ($MONTANT_REMISE * 100 )/$remise_client['POURCENTAGE'];
   

     $data_remise_client= array(
                  'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
                  'ENVOIE'=>0,
                  'ID_VENTE'=>$ID_VENTE,
                  'ID_REMISE'=>$ID_TYPE_REMISE_CLIENT,
                  'MONTANT_REMISE'=>$MONTANT_REMISE,
                  'MONTANT_TOTAL'=>$MONTANT_TOTAL_CL,
                  'POURCENTAGE_REMISE'=>$remise_client['POURCENTAGE'],
                  );
     $this->Model->create('vente_remise',$data_remise_client);
     // print_r($data_remise_client);

     }
     
     
     
    


     if ($MONTANT_ASSURANCE > 0) {
         $remise_ass= $this->Model->getOne("saisie_type_remise",array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE_ASS));
     $MONTANT_TOTAL_ASS =  ($MONTANT_ASSURANCE * 100 )/$remise_ass['POURCENTAGE'];
   
     $data_remise_ass= array(
                  'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
                  'ENVOIE'=>0,
                  'ID_VENTE'=>$ID_VENTE,
                  'ID_REMISE'=>$ID_TYPE_REMISE_ASS,
                  'MONTANT_REMISE'=>$MONTANT_ASSURANCE,
                  'MONTANT_TOTAL'=>$MONTANT_TOTAL_ASS,
                  'ID_ASSURANCE'=>$ID_ASSURANCE,
                  'POURCENTAGE_REMISE'=>$remise_ass['POURCENTAGE'],
                  );
     $this->Model->create('vente_remise',$data_remise_ass);
     // print_r($data_remise_ass);

     }


$message = "<div class='alert alert-success'  id='message'>
                            Enregistrement fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('vente/Vente/listing'));

     

     // ;
     // if ($exist) {
     //    echo "exist";
     //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     // }
     // else{
     //    echo "not exist";
     //    $this->Model->create('req_barcode',$data_qr);
     //    redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     // }
  }


 }


?>