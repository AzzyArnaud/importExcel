<?php 
 /**
  * 
  */
 class Entree_Stock extends CI_Controller
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

        $data['title'] = "Liste des Requisitions non mis dans le stock ";
        $this->load->view('Entree_Stock_Add_View',$data);

    }


    public function index_annulation()
    {

        $data['title'] = "Liste des Requisitions mis dans le stock non vendu";
        $this->load->view('Entree_Stock_Annuler_Add_View',$data);

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


  public function scan()
  {
     $ID_REQUISITION =$this->uri->segment(4);
     $ID_PRODUIT =$this->uri->segment(5);

     $data['unique'] = $this->Model->getRequeteOne('SELECT ID_REQUISITION,DATE_REQUISITION,PRIX_VENTE_UNITAIRE,req_requisition.ID_PRODUIT,saisie_produit.NOM_PRODUIT,QUANTITE FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND saisie_produit.ID_PRODUIT = '.$ID_PRODUIT.'  ');
     $data['deja_in_qr'] = $this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND req_barcode.ID_PRODUIT = '.$ID_PRODUIT.' ');
     
     $data['title'] = "Details ";
    $this->load->view("Entree_Stock_Scan_View",$data);
  }


  
  public function listannuler()
  {
     $ID_REQUISITION =$this->uri->segment(4);
     $ID_PRODUIT =$this->uri->segment(5);

     $data['listepro'] = $this->Model->getRequete('SELECT *  FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND ID_PRODUIT = '.$ID_PRODUIT.' AND STATUS !=2');
     $data['unique'] = $this->Model->getRequeteOne('SELECT ID_REQUISITION,DATE_REQUISITION,PRIX_VENTE_UNITAIRE,req_requisition.ID_PRODUIT,saisie_produit.NOM_PRODUIT,QUANTITE FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND saisie_produit.ID_PRODUIT = '.$ID_PRODUIT.'  ');
     $data['deja_in_qr'] = $this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND req_barcode.ID_PRODUIT = '.$ID_PRODUIT.' AND STATUS !=2 ');
     
     $data['title'] = "Details ";
    $this->load->view("Entree_Stock_Annuler_View",$data);
  }


  public function save_scan()
  {
     // $BARCODE =$this->input->post('BARCODE');
     // $ID_REQUISITION =$this->input->post('ID_REQUISITION');
     // $ID_PRODUIT =$this->input->post('ID_PRODUIT');
     // $PRIX_VENTE =$this->input->post('PRIX_VENTE');



     $data_qr = array(
               'BARCODE'=>$this->input->post('BARCODE'),                                   
               'ID_REQUISITION'=>$this->input->post('ID_REQUISITION'),                                   
               'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),                                   
               'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),
               'STATUS'=>1,
               'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
              );


     // print_r($data_qr);

     $exist = $this->Model->checkvalue('req_barcode',array('BARCODE'=>$this->input->post('BARCODE')));
     if ($exist) {
        // echo "exist";
        $message = "<div class='alert alert-danger' role='alert' id='message'>
                        Barre code déjà enregistré, veuillez chercher un autre
                        
            </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     }
     else{
        
        $message = "<div class='alert alert-success' role='alert' id='message'>
                        Scan et entrée dans le stock enregistre avec succès
                        
            </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        $this->Model->create('req_barcode',$data_qr);
        $pexist = $this->Model->checkvalue('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE')));
        if ($pexist) {
           $tupdate = $this->Model->getOne('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE')));
           $crit = array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'));
           $datacr = array('QUANTITE'=>$tupdate['QUANTITE']+1,'STATUS'=>1);
           $this->Model->update('req_stock',$crit,$datacr);

        }
            else{
            $this->Model->create('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),'QUANTITE'=>1,'STATUS'=>1));
            }

        
        redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     }

    //  $data['deja_in_qr'] = $this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$ID_REQUISITION.' AND req_barcode.ID_PRODUIT = '.$ID_PRODUIT.' ');
     
    //  $data['title'] = "Details ";
    // $this->load->view("Entree_Stock_Scan_View",$data);
  }


  
  public function annuler_action($ID_BARCODE)
  {

    $barcode_data = $this->Model->getOne('req_barcode',array('ID_BARCODE'=>$ID_BARCODE));
    print_r($barcode_data);
    $pexist = $this->Model->getOne('req_stock',array('ID_PRODUIT'=>$barcode_data['ID_PRODUIT'],'PRIX_VENTE'=>$barcode_data['PRIX_VENTE']));
    if (!empty($pexist)) {
        $crit = array('ID_PRODUIT'=>$barcode_data['ID_PRODUIT'],'PRIX_VENTE'=>$barcode_data['PRIX_VENTE']);
        if ($pexist['QUANTITE'] == 1) {
            $NSTATUS = 0;
        }
        else{
            $NSTATUS = 1;
        }
        $datacr = array('QUANTITE'=>$pexist['QUANTITE']-1,'STATUS'=>$NSTATUS);
        

        $data_qr = array(
               'BARCODE'=>$barcode_data['BARCODE'],                                   
               'ID_REQUISITION'=>$barcode_data['ID_REQUISITION'],                                   
               'ID_PRODUIT'=>$barcode_data['ID_PRODUIT'],                                   
               'ID_BARCODE'=>$barcode_data['ID_BARCODE'],
               'PRIX_VENTE'=>$barcode_data['PRIX_VENTE'],
               'STATUS'=>1,
               'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
              );
        $this->Model->create('req_barcode_efface',$data_qr);
        $this->Model->update('req_stock',$crit,$datacr);
        $this->Model->delete('req_barcode',array('ID_BARCODE'=>$ID_BARCODE));

        $message = "<div class='alert alert-success' role='alert' id='message'>
                        Code Barre bien effacé
                    </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Entree_Stock/listannuler/'.$barcode_data['ID_REQUISITION'].'/'.$barcode_data['ID_PRODUIT'].''));
    }
    else{
        $message = "<div class='alert alert-danger' role='alert' id='message'>
                        Code Barre non effacé
                    </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Entree_Stock/listannuler/'.$barcode_data['ID_REQUISITION'].'/'.$barcode_data['ID_PRODUIT'].''));
    }

    // 
        // $pexist = $this->Model->checkvalue('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE')));
        // if ($pexist) {
    // $this->Model->create('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),'QUANTITE'=>1,'STATUS'=>1));
        // }

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