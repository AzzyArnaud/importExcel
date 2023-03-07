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
               <td>'.$sub_tot.'</td>
               <td>'.$items['DATE_PERAMPTION'].'</td>
               <td class="text-right">'.$items['PRIX_VENTE_UNITAIRE'].'</td>
               <td>
                <input type="hidden" id="rowid" value='.$items['rowid'].'>
               <button class="btn btn-danger btn-xs" type="button" onclick="remove_ct()">X</button>
               </td>' ;
      $html .='</tr>' ;
      $tot +=$sub_tot;
  }

    $i++;

  endforeach;
  $html .='<tr>' ;
      $html .='<td></td>
               <td></td>
               <td></td>
               <td class="text-right">'.$tot.'</td>
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
      $VEHICULE_ID = $this->input->post('VEHICULE_ID');
      $data['ID_USERS']= $this->input->post('ID_USER');
      $STATION_ID = $this->input->post('STATION_ID');
      if ($STATION_ID != NULL) {
        $data['condstation'] = 'AND car.STATION_ID ='.$STATION_ID.' ';
        $statt = $this->Model->getOne('voiture_station',array('STATION_ID'=>$STATION_ID));
        $stat= ' ,station: '.$statt['STATION_NOM'];
      }
      else{
        $data['condstation'] = '';
        $stat= '';
      }
      $data['ID_FOURNISSEURS']= $this->input->post('ID_FOURNISSEUR');
      if ($VEHICULE_ID !=NULL) {
        $data['condvehicle']='AND car.VEHICULE_ID ='.$VEHICULE_ID.' ';
        $voiture = $this->Model->getOne('voiture_vehicules',array('VEHICULE_ID'=>$VEHICULE_ID));
        $vehi = ', voiture '.$voiture['PLAQUE_VEHICULE'];
      }
      else{
        $data['condvehicle']='';
        $vehi = '';
      }

      if ($PERIODE != null) {
      $str = $PERIODE;
      $dat=explode(" - ",$str);

     $date1 = DateTime::createFromFormat('d/m/Y', $dat[0]);
     $debut = $date1->format('Y-m-d');
     $date2 = DateTime::createFromFormat('d/m/Y', $dat[1]);
     $fin = $date2->format('Y-m-d');
     $data['conditions'] = ' AND CONSOMATION_DATE BETWEEN "'.$debut.'" AND "'.$fin.'"';
     $selectdates = 'Entre '.$debut.' et '.$fin;
     $data['selectdate'] = $PERIODE;
      }
      else{
        $thismonth = date("Y-m");
        $selectdates = date("Y-m");
        $data['conditions'] = ' AND CONSOMATION_DATE LIKE "'.$thismonth.'%"';
        $data['selectdate'] = '';
      }

      $data['options'] = $this->input->post('options');
      $options = $this->input->post('options');
      if ($options == NULL) {
        // echo "NULL";
        $data['selection'] = NULL;
          $data['a0'] ='';
          $data['a1'] ='active';
          $data['a2'] ='';
          $data['a3'] ='';
          $data['a4'] =''; 
          $data['ac0'] ='';
          $data['ac1'] ='checked';
          $data['ac2'] ='';
          $data['ac3'] ='';
          $data['ac4'] ='';  

          
          $data['condition']='car.IS_PAYE = 0';
      }
      else{
        // echo "Quelque chose";
        $data['selection'] = $options;
        // echo $options;
        // echo "<br>";
        if ($options == 0) {
          $data['a0'] ='active';
          $data['a1'] ='';
          $data['a2'] ='';
          $data['a3'] ='';
          $data['a4'] ='';
          $data['ac0'] ='checked';
          $data['ac1'] ='';
          $data['ac2'] ='';
          $data['ac3'] ='';
          $data['ac4'] =''; 
          $data['condition']=' 1';
        }
        elseif ($options == 1) {
          $data['a0'] ='';
          $data['a1'] ='active';
          $data['a2'] ='';
          $data['a3'] ='';
          $data['a4'] ='';  
          $data['ac0'] ='';
          $data['ac1'] ='checked';
          $data['ac2'] ='';
          $data['ac3'] ='';
          $data['ac4'] =''; 
          $data['condition']='car.IS_PAYE = 0';        
        }
        elseif ($options == 2) {
          $data['a0'] ='';
          $data['a1'] ='';
          $data['a2'] ='active';
          $data['a3'] ='';
          $data['a4'] ='';
          $data['ac0'] ='';
          $data['ac1'] ='';
          $data['ac2'] ='checked';
          $data['ac3'] ='';
          $data['ac4'] =''; 
          $data['condition']='car.IS_PAYE = 1';
        }
        elseif ($options == 3) {
          $data['a0'] ='';
          $data['a1'] ='';
          $data['a2'] ='';
          $data['a3'] ='active';
          $data['a4'] ='';
          $data['ac0'] ='';
          $data['ac1'] ='';
          $data['ac2'] ='';
          $data['ac3'] ='checked';
          $data['ac4'] =''; 
          $data['condition']='car.ID_STATUS = 2';
        }
        elseif ($options == 4) {
          $data['a0'] ='';
          $data['a1'] ='';
          $data['a2'] ='';
          $data['a3'] ='';
          $data['a4'] ='active';
          $data['ac0'] ='';
          $data['ac1'] ='';
          $data['ac2'] ='';
          $data['ac3'] ='';
          $data['ac4'] ='checked'; 
          $data['condition']='car.ID_STATUS = 4 or car.ID_STATUS = 3';
        }


      }

    
      
        $data['selectdate'] = $PERIODE;
        $data['title'] = "Liste des Requisitions ";
        // $data['title'] = "Ravitaillement du carburant date: ".$selectdates." ".$vehi." ".$stat." ";
        $this->load->view('Requisition_List_View',$data);

    }

  public function detail()
  {
     $DATE_REQUISITION =$this->uri->segment(4);
     $ID_USER_REQUISITION =$this->uri->segment(5);
     $ID_FOURNISSEUR =$this->uri->segment(6);

     $data['listdetail'] = $this->Model->getRequete('SELECT ID_REQUISITION, saisie_produit.NOM_PRODUIT, PRIX_ACHAT_UNITAIRE,QUANTITE,QUANTITE_RESTANT, MONTANT_TOTAL_ACHAT, ID_USER_SAISIE, DATE_PERAMPTION FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
     $data['unique'] = $this->Model->getRequeteOne('SELECT DATE_SAISIE,DATE_REQUISITION, saisie_fournisseur.NOM, saisi.NOM AS SNOM , saisi.PRENOM SPRENOM, requi.NOM AS RNOM, requi.PRENOM AS RPRENOM FROM `req_requisition` JOIN config_user as saisi ON saisi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN config_user as requi ON requi.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE  req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' AND DATE_REQUISITION like "'.$DATE_REQUISITION.'" AND ID_USER_REQUISITION = '.$ID_USER_REQUISITION.' AND req_requisition.ID_FOURNISSEUR = '.$ID_FOURNISSEUR.' ');
     $data['title'] = "Details ";
    $this->load->view("Requisition_List_Detail_View",$data);
  }

  public function update_mettre_carburant()
  {

    $CONSOMATION_ID =$this->input->post('CONSOMATION_ID');
      $title = "Modification mise du carburant";
      $onedetail = $this->Model->getOne('voiture_carburant_consomation',array('CONSOMATION_ID'=>$CONSOMATION_ID));
      if ($onedetail['PROVENANCEOUDESTINATION'] == 1) {
        $sel1 = 'checked="checked"';
        $sel2 = '';
      }
      else{
        $sel1 = '';
        $sel2 = 'checked="checked"';
      }

      $date=date_create($onedetail['CONSOMATION_DATE']);
      $ndate = date_format($date,"d/m/Y");
      

      $lastkm = $this->Model->getOneOrder('voiture_carburant_consomation',array('VEHICULE_ID'=>$onedetail['VEHICULE_ID'],'ID_STATUS'=>1),'KM_A_APROVISIONNEMENT');

      $approvisionnement = array(
               'CONSOMATION_ID'=>$onedetail['CONSOMATION_ID'],                                   
               'NUM_GENERATED'=>$onedetail['NUM_GENERATED'],                                   
               'PATH_FACTURE'=>$onedetail['PATH_FACTURE'],                                   
               'CONSOMATION_DATE'=>$ndate,
               'VEHICULE_ID'=>$this->Model->getList('voiture_vehicules',array()), 
               'VEHICULE_IDSELECTED'=>$onedetail['VEHICULE_ID'],
               'STATION_ID'=>$this->Model->getList('voiture_station',array()), 
               'STATION_IDSELECTED'=>$onedetail['STATION_ID'],
               'CHAUFFEUR_ID'=>$this->Model->getList('rh_employe',array()), 
               'CHAUFFEUR_IDSELECTED'=>$onedetail['CHAUFFEUR_ID'],
               'QUANTITE_RECU'=>$onedetail['QUANTITE_RECU'], 
               // 'TRAJET_ID'=>$this->Model->getList('masque_trajet',array()), 
               'TRAJET_IDSELECTED'=>$onedetail['TRAJET_ID'],
               'MONTANT_CONSOMATION'=>$onedetail['MONTANT_CONSOMATION'], 
               'PRIX_UNITAIRE'=>$onedetail['PRIX_UNITAIRE'], 
               'KM_A_APROVISIONNEMENT_MIN'=>$lastkm['KM_A_APROVISIONNEMENT'], 
               'KM_A_APROVISIONNEMENT'=>$onedetail['KM_A_APROVISIONNEMENT'], 
               'PROVENANCEOUDESTINATION'=>$sel1 .' '.$sel2,
               'USERSAVER'=>$onedetail['USERSAVER'],
              );




     $myDateTime = DateTime::createFromFormat('d/m/Y', $this->input->post('CONSOMATION_DATE'));
     $newdate = $myDateTime->format('Y-m-d');

     $data = array(          
        'NUM_GENERATED'=>$this->input->post('NUM_GENERATED'),                                 
        'VEHICULE_ID'=>$this->input->post('VEHICULE_ID'),                                   
        'STATION_ID'=>$this->input->post('STATION_ID'),
        'QUANTITE_RECU'=>$this->input->post('QUANTITE_RECU'),
        // 'PROVENANCEOUDESTINATION'=>$this->input->post('PROVENANCEOUDESTINATION'),
        // 'TRAJET_ID'=>$this->input->post('TRAJET_ID'),
        'MONTANT_CONSOMATION'=>$this->input->post('MONTANT_CONSOMATION'),
        'PRIX_UNITAIRE'=>$this->input->post('PRIX_UNITAIRE'),
        'CONSOMATION_DATE'=>$newdate,
        'KM_A_APROVISIONNEMENT'=>$this->input->post('KM_A_APROVISIONNEMENT'),
        'CHAUFFEUR_ID'=>$this->input->post('CHAUFFEUR_ID'),
        'PATH_FACTURE'=>$this->input->post('PATH_FACTURE'),
        'USERSAVER'=>$this->input->post('USERSAVER'),
        'OLD_VALUE_ID'=>$CONSOMATION_ID,
        );
     
     $this->form_validation->set_rules('VEHICULE_ID', 'Vehicule', 'required');
     $this->form_validation->set_rules('STATION_ID', 'Station', 'required');
     $this->form_validation->set_rules('QUANTITE_RECU', 'Nb littre', 'required');
     // $this->form_validation->set_rules('TRAJET_ID', 'Provenance ou Destination', 'required');
     $this->form_validation->set_rules('MONTANT_CONSOMATION', 'Montant consomation', 'required');
     $this->form_validation->set_rules('PRIX_UNITAIRE', 'Prix unitaire', 'required');
     $this->form_validation->set_rules('CONSOMATION_DATE', 'Date facturation', 'required');
     $this->form_validation->set_rules('KM_A_APROVISIONNEMENT', 'Km approvisionnement', 'required');
     $this->form_validation->set_rules('CHAUFFEUR_ID', 'Chauffeur', 'required');

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
       $this->load->view("Requisition_Update_View",$data);

      }else{

        // print_r($data);
        // exit();
        $this->Model->insert_last_id('voiture_carburant_consomation',$data);
        $this->Model->update('voiture_carburant_consomation',array('CONSOMATION_ID'=>$CONSOMATION_ID),array('ID_STATUS'=>2,'USERCHANGER'=>$this->session->userdata('STRAPH_ID_USER') ));
        
          $message = "<div class='alert alert-success'  id='message'>
                            Modification fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
      }
  }

  public function suppimer()
  {
    $this->Is_permis();
    $CONSOMATION_ID = $this->uri->segment(4);
    // echo $CONSOMATION_ID;
    // exit();
// annuler suppimer
    $detail = $this->Model->update('voiture_carburant_consomation',array('CONSOMATION_ID'=>$CONSOMATION_ID),array('ID_STATUS'=>3,'USERDELETE'=>$this->session->userdata('STRAPH_ID_USER')));

    $message = "<div class='alert alert-success'  id='message'>
                            Suppression fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
  }

  public function annuler()
  {
    $CONSOMATION_ID = $this->uri->segment(4);
    // echo $CONSOMATION_ID;
    // exit();
// annuler suppimer
    $detail = $this->Model->update('voiture_carburant_consomation',array('CONSOMATION_ID'=>$CONSOMATION_ID),array('ID_STATUS'=>4,'USERANNULE'=>$this->session->userdata('STRAPH_ID_USER')));

    $message = "<div class='alert alert-success'  id='message'>
                            Annullation fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
  }


  
  public function paye()
  {
    $CONSOMATION_ID = $this->uri->segment(4);
    // echo $CONSOMATION_ID;
    // exit();
// annuler suppimer
    $detail = $this->Model->update('voiture_carburant_consomation',array('CONSOMATION_ID'=>$CONSOMATION_ID),array('IS_PAYE'=>1,'USERPAYE'=>$this->session->userdata('STRAPH_ID_USER')));

    $message = "<div class='alert alert-success'  id='message'>
                            Paiement fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Requisition/listing'));
  }
 }


?>