<?php 
 /**
  * 
  */
 class Requisition extends CI_Controller
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
      
      // $this->Is_permis();
      $title = "Enregistrement requisition";
      // $lastApprovisionnement = $this->Model->getOneOrder('voiture_carburant_consomation',array(),'CONSOMATION_ID');
      // $VAL = $lastApprovisionnement['CONSOMATION_ID']+1;
      // $NUM_GENERATED = 'CARB-'.$VAL;
      // echo $NUM_GENERATED;
      // exit();
      $approvisionnement = array(
               'CONSOMATION_ID'=>NULL,                                   
               // 'NUM_GENERATED'=>$NUM_GENERATED,                                   
               'PATH_FACTURE'=>NULL,                                   
               'CONSOMATION_DATE'=>NULL,
               'ID_FOURNISSEUR'=>$this->Model->getRequete('SELECT * FROM saisie_fournisseur where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM'), 
               'ID_USER_REQUISITION'=>$this->Model->getRequete('SELECT * FROM config_user where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM'),
               'ID_PRODUIT'=>$this->Model->getRequete('SELECT * FROM saisie_produit where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM_PRODUIT'),
               'QUANTITE_RECU'=>NULL, 
               // 'TRAJET_ID'=>$this->Model->getList('masque_trajet',array()), 
               // 'PRIX_CARBURANT_ID'=>$this->Model->getList('voiture_prix_carburant',array()), 
               'MONTANT_CONSOMATION'=>NULL, 
               'PRIX_UNITAIRE'=>NULL, 
               'KM_A_APROVISIONNEMENT'=>NULL, 
              );

      // print_r($approvisionnement);
      // exit();

        
        $data['title'] = $title;
        // $data['pieces'] = $this->Model->getList("masque_piece");
        $data['approv'] = $approvisionnement;
      $this->load->view("Requisition_Add_View",$data);
  }


  function add_cart_medicament(){

     // $this->cart->destroy();

      $id=$this->input->post('ID_PRODUIT')."".$this->input->post('PRIX_ACHAT_UNITAIRE')."".$this->input->post('QUANTITE')."".$this->input->post('DATE_PERAMPTION');

          $data_cart = array(
              'id'      => $id,
              'qty'     => 1,
              'price'   => 0,
              'name'    => 'R',
              'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),
              'PRIX_ACHAT_UNITAIRE'=>$this->input->post('PRIX_ACHAT_UNITAIRE'),
              'QUANTITE'=>$this->input->post('QUANTITE'),
              'DATE_PERAMPTION'=>$this->input->post('DATE_PERAMPTION'),
              'PRIX_VENTE_UNITAIRE'=>$this->input->post('PRIX_VENTE_UNITAIRE'),
                    );
      $this->cart->insert($data_cart);

   
    $html = null;
  $i = 1;
  $html .='<table class="table table-bordered">
      <tr class="text-center"><th colspan="7" class="text-center bg-success">Liste des medicaments de la requisition</th></tr>
        <tr>
        <th>Produit</th>
        <th>PU</th>
        <th>Q</th>
        <th>PT</th>
        <th>Date Peramption</th>
        <th>PV</th>
        <th></th>
        </tr>' ;


              $tot = 0;
  foreach ($this->cart->contents() as $items):
    
  if(preg_match("/R/", $items['name'])){

    $name = $this->Model->getRequeteOne('SELECT NOM_PRODUIT FROM saisie_produit where ID_PRODUIT = '.$items['ID_PRODUIT'].'');
      $sub_tot = $items['QUANTITE'] *$items['PRIX_ACHAT_UNITAIRE'];
      $html .='<tr>' ;
      $html .='<td>'.$name['NOM_PRODUIT'].'</td>
               <td  class="text-right">'.$items['PRIX_ACHAT_UNITAIRE'].'</td>
               <td  class="text-right">'.$items['QUANTITE'].'</td>
               <td  class="text-right">'.$sub_tot.'</td>
               <td>'.$items['DATE_PERAMPTION'].'</td>
               <td class="text-right">'.$items['PRIX_VENTE_UNITAIRE'].'</td>
               <td>
               <button class="btn btn-danger btn-xs" type="button" onclick="remove_medicament(\''.$items['rowid'].'\')">X</button>
               </td>' ;
      $html .='</tr>' ;
      $tot +=$sub_tot;
  }

    $i++;

    

  endforeach;
  $NET_PAYER = $tot - ($this->input->post('POURCENTAGE_R') * $tot/100);
  $html .='<tr>' ;
      $html .='<td colspan="3">TOTAL</td>
               <td class="text-right">'.$tot.'</td>
               <td></td>
               <td></td>
               <td></td></tr>';
               $html .='<tr>' ;
      $html .='<td  colspan="3">A Payer</td>
               <td class="text-right">'.$NET_PAYER.'</td>
               <td></td>
               <td></td>
               <td></td></tr></table>';
     echo $html;         

    }

    public function remove_medicament()
    {

     $rowid = $this->input->post('rowid');
    $this->cart->remove($rowid);
$html = null;
  $i = 1;
  $html .='<table class="table table-bordered">
      <tr class="text-center"><th colspan="7" class="text-center bg-success">Liste des medicaments de la requisition</th></tr>
        <tr>
        <th>Produit</th>
        <th>PU</th>
        <th>Q</th>
        <th>PT</th>
        <th>Date Peramption</th>
        <th>PV</th>
        <th></th>
        </tr>' ;


              $tot = 0;
  foreach ($this->cart->contents() as $items):
    
  if(preg_match("/R/", $items['name'])){

    $name = $this->Model->getRequeteOne('SELECT NOM_PRODUIT FROM saisie_produit where ID_PRODUIT = '.$items['ID_PRODUIT'].'');
      $sub_tot = $items['QUANTITE'] *$items['PRIX_ACHAT_UNITAIRE'];
      $html .='<tr>' ;
      $html .='<td>'.$name['NOM_PRODUIT'].'</td>
               <td  class="text-right">'.$items['PRIX_ACHAT_UNITAIRE'].'</td>
               <td  class="text-right">'.$items['QUANTITE'].'</td>
               <td  class="text-right">'.$sub_tot.'</td>
               <td>'.$items['DATE_PERAMPTION'].'</td>
               <td class="text-right">'.$items['PRIX_VENTE_UNITAIRE'].'</td>
               <td>
               <button class="btn btn-danger btn-xs" type="button" onclick="remove_medicament(\''.$items['rowid'].'\')">X</button>
               </td>' ;
      $html .='</tr>' ;
      $tot +=$sub_tot;
  }

    $i++;

  endforeach;
  $NET_PAYER = $tot - ($this->input->post('POURCENTAGE_R') * $tot/100);
  $html .='<tr>' ;
      $html .='<td colspan="3">TOTAL</td>
               <td class="text-right">'.$tot.'</td>
               <td></td>
               <td></td>
               <td></td></tr>';
               $html .='<tr>' ;
      $html .='<td  colspan="3">A Payer</td>
               <td class="text-right">'.$NET_PAYER.'</td>
               <td></td>
               <td></td>
               <td></td></tr></table>';
     echo $html;   
    }

  

  public function save_requisition()
  {

        $browser=$this->ci->agent->browser.' version '.$this->ci->agent->version;
        $os=$this->ci->agent->platform;
        $ip = $_SERVER["REMOTE_ADDR"];
        $dt = new DateTime("now", new DateTimeZone('Africa/Bujumbura'));
        $new_dt = $dt->format('Y-m-d H:i:s');


     
     $this->form_validation->set_rules('ID_USER_REQUISITION', 'La personne qui a fait requisition', 'required');
     $this->form_validation->set_rules('ID_FOURNISSEUR', 'Fournisseur', 'required');
     $this->form_validation->set_rules('DATE_REQUISITION', 'Date', 'required');

    //SI Valide
     if ($this->form_validation->run() == FALSE){        
        
        $title = "Mettre du carburant";

        $message = "<div class='alert alert-danger' id='message'>
                            Donne manquantes, Processus échoué.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";

        $data['title'] = $title;        
        $data['approv'] = $approvisionnement;
        $this->session->set_flashdata(array('message'=>$message));
       $this->load->view("Requisition_Add_View",$data);

      }else{

        foreach ($this->cart->contents() as $items):
    
  if(preg_match("/R/", $items['name'])){
    $sub_tot = $items['QUANTITE'] *$items['PRIX_ACHAT_UNITAIRE'];

    $requisition = array(          
        'DATE_REQUISITION'=>$this->input->post('DATE_REQUISITION'),       
        'DATE_SAISIE'=>$new_dt,
        'ID_PRODUIT'=>$items['ID_PRODUIT'],
        'PRIX_ACHAT_UNITAIRE'=>$items['PRIX_ACHAT_UNITAIRE'],
        'QUANTITE'=>$items['QUANTITE'],
        'QUANTITE_RESTANT'=>$items['QUANTITE'],
        'MONTANT_TOTAL_ACHAT'=>$sub_tot,
        'ID_USER_REQUISITION'=>$this->input->post('ID_USER_REQUISITION'),
        'ID_USER_SAISIE'=>$this->session->userdata('STRAPH_ID_USER'),
        'ID_FOURNISSEUR'=>$this->input->post('ID_FOURNISSEUR'),
        'DATE_PERAMPTION'=>$items['DATE_PERAMPTION'],
        'PRIX_VENTE_UNITAIRE'=>$items['PRIX_VENTE_UNITAIRE'],
        'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
        );

$this->Model->update('saisie_produit',array("ID_PRODUIT"=>$items['ID_PRODUIT']),array("PRIX_PRODUIT"=>$items['PRIX_VENTE_UNITAIRE']));
    $this->Model->create('req_requisition',$requisition);

  }


  endforeach;

     
$this->cart->destroy();
        
          $message = "<div class='alert alert-success'  id='message'>
                            Enregistrement fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
      }
  }



  public function listing()
    {
      $PERIODE = $this->input->post('PERIODE');
      $ID_FOURNISSEUR = $this->input->post('ID_FOURNISSEUR');
      $data['ID_FOURNISSEURS']= $this->input->post('ID_FOURNISSEUR');
      $ID_USER = $this->input->post('ID_USER');
      $data['ID_USERS']= $this->input->post('ID_USER');

      
      $ID_USER_SAISIE = $this->input->post('ID_USER_SAISIE');
      $data['ID_USER_SAISIES']= $this->input->post('ID_USER_SAISIE');

      
      $DATE_DEBUT = $this->input->post('DATE_DEBUT');
      $DATE_FIN = $this->input->post('DATE_FIN');

      

      if ($DATE_DEBUT != NULL) {
        

        if ($DATE_FIN != NULL) {
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= $this->input->post('DATE_FIN');
          $data['conddatedebut'] = ' AND DATE_REQUISITION BETWEEN "'.$DATE_DEBUT.'" AND "'.$DATE_FIN.'"';
        }
        else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddatedebut'] = ' AND DATE_REQUISITION BETWEEN "'.$DATE_DEBUT.'" AND "'.date("Y-m-d").'"';
        }

        
      }
      else{
          $data['DATE_DEBUTS']= date("Y-m-d");
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddatedebut'] = ' AND DATE_REQUISITION BETWEEN "'.date("Y-m-d").'" AND "'.date("Y-m-d").'"';
      }
      
      if ($ID_FOURNISSEUR != NULL) {
        $data['condfournisseur'] = 'AND req_requisition.ID_FOURNISSEUR ='.$ID_FOURNISSEUR.' ';
      }
      else{
        $data['condfournisseur'] = '';
      }
      
      if ($ID_USER !=NULL) {
        $data['conduser']='AND ID_USER_REQUISITION ='.$ID_USER.' ';
      }
      else{
        $data['conduser']='';
      }


      

      if ($ID_USER_SAISIE !=NULL) {
        $data['condusersa']='AND ID_USER_SAISIE ='.$ID_USER_SAISIE.' ';
      }
      else{
        $data['condusersa']='';
      }

      
      
        $data['title'] = "Liste des Requisitions ";
        // $data['title'] = "Ravitaillement du carburant date: ".$selectdates." ".$vehi." ".$stat." ";
        $this->load->view('Requisition_List_View',$data);

    }

  public function detail()
  {
     $DATE_REQUISITION =$this->uri->segment(4);
     $ID_USER_REQUISITION =$this->uri->segment(5);
     $ID_FOURNISSEUR =$this->uri->segment(6);
     $ID_USER_SAISIE =$this->uri->segment(7);

     $data['listdetail'] = $this->Model->getRequete('SELECT ID_REQUISITION, saisie_produit.NOM_PRODUIT, PRIX_ACHAT_UNITAIRE,QUANTITE,QUANTITE_RESTANT, MONTANT_TOTAL_ACHAT, ID_USER_SAISIE, DATE_PERAMPTION FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' AND ID_USER_SAISIE = '.$ID_USER_SAISIE.'  ');

      $data['unique'] = $this->Model->getRequeteOne('SELECT DATE_SAISIE, DATE_REQUISITION, saisie_fournisseur.NOM, saisi.NOM AS SNOM, saisi.PRENOM SPRENOM, requi.NOM AS RNOM, requi.PRENOM AS RPRENOM FROM `req_requisition` JOIN config_user AS saisi ON saisi.ID_USER = req_requisition.ID_USER_SAISIE JOIN config_user AS requi ON requi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND req_requisition.ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' AND ID_USER_SAISIE = '.$ID_USER_SAISIE.' ');
     $data['title'] = "Details ";
    $this->load->view("Requisition_List_Detail_View",$data);
  }


  
  public function index_update($ID_REQUISITION)
  {
      
      // $this->Is_permis();
      $title = "Modification requisition";
      // $lastApprovisionnement = $this->Model->getOneOrder('voiture_carburant_consomation',array(),'CONSOMATION_ID');
      // $VAL = $lastApprovisionnement['CONSOMATION_ID']+1;
      // $NUM_GENERATED = 'CARB-'.$VAL;
      // echo $NUM_GENERATED;
      // exit();
      $approvisionnement = array(
               'CONSOMATION_ID'=>NULL,                                   
               // 'NUM_GENERATED'=>$NUM_GENERATED,                                   
               'PATH_FACTURE'=>NULL,                                   
               'CONSOMATION_DATE'=>NULL,
               'ID_FOURNISSEUR'=>$this->Model->getRequete('SELECT * FROM saisie_fournisseur where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM'), 
               'ID_USER_REQUISITION'=>$this->Model->getRequete('SELECT * FROM config_user where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM'),
               'ID_PRODUIT'=>$this->Model->getRequete('SELECT * FROM saisie_produit where ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' ORDER BY NOM_PRODUIT'),
               'QUANTITE_RECU'=>NULL, 
               // 'TRAJET_ID'=>$this->Model->getList('masque_trajet',array()), 
               // 'PRIX_CARBURANT_ID'=>$this->Model->getList('voiture_prix_carburant',array()), 
               'MONTANT_CONSOMATION'=>NULL, 
               'PRIX_UNITAIRE'=>NULL, 
               'KM_A_APROVISIONNEMENT'=>NULL, 
              );

      // print_r($approvisionnement);
      // exit();

        
        $data['title'] = $title;
        // $data['pieces'] = $this->Model->getList("masque_piece");
        $data['approv'] = $approvisionnement;
        $data['olddata'] = $this->Model->getRequeteOne('SELECT * FROM req_requisition where ID_REQUISITION = '.$ID_REQUISITION.' ');
      $this->load->view("Requisition_Update_View",$data);
  }



  
  public function delete($ID_REQUISITION)
  {
    
    $olddata = $this->Model->getOne('req_requisition', array('ID_REQUISITION'=>$ID_REQUISITION));
    $requisition = array(          
        'DATE_REQUISITION'=>$olddata['DATE_REQUISITION'],       
        'DATE_SAISIE'=>$olddata['DATE_SAISIE'], 
        'ID_PRODUIT'=>$olddata['ID_PRODUIT'], 
        'PRIX_ACHAT_UNITAIRE'=>$olddata['PRIX_ACHAT_UNITAIRE'], 
        'QUANTITE'=>$olddata['QUANTITE'], 
        'ID_REQUISITION'=>$olddata['ID_REQUISITION'], 
        'QUANTITE_RESTANT'=>$olddata['QUANTITE_RESTANT'], 
        'MONTANT_TOTAL_ACHAT'=>$olddata['MONTANT_TOTAL_ACHAT'], 
        'ID_USER_REQUISITION'=>$olddata['ID_USER_REQUISITION'], 
        'ID_USER_SAISIE'=>$olddata['ID_USER_SAISIE'], 
        'ID_FOURNISSEUR'=>$olddata['ID_FOURNISSEUR'], 
        'DATE_PERAMPTION'=>$olddata['DATE_PERAMPTION'], 
        'PRIX_VENTE_UNITAIRE'=>$olddata['PRIX_VENTE_UNITAIRE'], 
        'ID_SOCIETE'=>$olddata['ID_SOCIETE'],
        );
    // print_r($requisition);


    $this->Model->create('req_requisition_efface',$requisition);


     
     $this->Model->delete('req_requisition', array('ID_REQUISITION'=>$ID_REQUISITION));

      // exit();

     // $data['listdetail'] = $this->Model->getRequete('SELECT ID_REQUISITION, saisie_produit.NOM_PRODUIT, PRIX_ACHAT_UNITAIRE,QUANTITE,QUANTITE_RESTANT, MONTANT_TOTAL_ACHAT, ID_USER_SAISIE, DATE_PERAMPTION FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
     // $data['unique'] = $this->Model->getRequeteOne('SELECT DATE_SAISIE,DATE_REQUISITION, saisie_fournisseur.NOM, saisi.NOM AS SNOM , saisi.PRENOM SPRENOM, requi.NOM AS RNOM, requi.PRENOM AS RPRENOM FROM `req_requisition` JOIN config_user as saisi ON saisi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN config_user as requi ON requi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND req_requisition.ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
      
      $message = "<div class='alert alert-success'  id='message'>
                            Effacement fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
  }


    

  public function save_update_req()
  {



     
     $this->form_validation->set_rules('ID_USER_REQUISITION', 'La personne qui a fait requisition', 'required');
     $this->form_validation->set_rules('ID_FOURNISSEUR', 'Fournisseur', 'required');
     $this->form_validation->set_rules('DATE_REQUISITION', 'Date', 'required');

    //SI Valide
     if ($this->form_validation->run() == FALSE){        
        
        $title = "Mise a jours";

        $message = "<div class='alert alert-danger' id='message'>
                            Donne manquantes, Processus échoué.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";

        $data['title'] = $title;        
        $data['approv'] = $approvisionnement;
        $this->session->set_flashdata(array('message'=>$message));
       
        redirect(base_url('requisition/Requisition/index_update/'.$this->input->post('ID_REQUISITION').''));

      }else{

    
    $sub_tot = $this->input->post('QUANTITE') *$this->input->post('PRIX_ACHAT_UNITAIRE');

    $requisition = array(          
        'DATE_REQUISITION'=>$this->input->post('DATE_REQUISITION'),  
        'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),
        'PRIX_ACHAT_UNITAIRE'=>$this->input->post('PRIX_ACHAT_UNITAIRE'),
        'QUANTITE'=>$this->input->post('QUANTITE'),
        'QUANTITE_RESTANT'=>$this->input->post('QUANTITE'),
        'MONTANT_TOTAL_ACHAT'=>$sub_tot,
        'ID_USER_REQUISITION'=>$this->input->post('ID_USER_REQUISITION'),
        'ID_FOURNISSEUR'=>$this->input->post('ID_FOURNISSEUR'),
        'DATE_PERAMPTION'=>$this->input->post('DATE_PERAMPTION'),
        'PRIX_VENTE_UNITAIRE'=>$this->input->post('PRIX_VENTE_UNITAIRE'),
        );

    $this->Model->update('req_requisition',array('ID_REQUISITION'=>$this->input->post('ID_REQUISITION')),$requisition);


        
          $message = "<div class='alert alert-success'  id='message'>
                            Modification fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
      }
  }

public function update_price(){
  $prod=$this->Model->getRequete('SELECT* FROM saisie_produit where PRIX_PRODUIT=0 AND ID_PRODUIT IN (SELECT ID_PRODUIT FROM req_requisition)');

  foreach ($prod as $fab) {
    $prix=$this->Model->getRequeteOne('SELECT MAX(PRIX_VENTE_UNITAIRE)as N FROM req_requisition where  ID_PRODUIT='.$fab['ID_PRODUIT']);

    $this->Model->update("saisie_produit",array("ID_PRODUIT"=>$fab['ID_PRODUIT']),array("PRIX_PRODUIT"=>$prix['N']));
  }

  print_r($prod) ;
}


 }


?>