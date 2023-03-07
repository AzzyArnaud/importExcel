<?php 
 /**
  * 
  */
 class Declassement extends CI_Controller
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
     
     $data['title'] = "Declassement ";
     $data['ID_PRODUIT']=NULL;
     $data['ID_BARCODE']=NULL;
     $data['BARCODE']=NULL;
     $data['PRODUIT']=NULL;

    $this->load->view("Declassement_Add_View",$data);
  }


  public function save_scan()
  {
   


    $bar_produit = $this->Model->getOne('req_barcode',array('BARCODE'=>$this->input->post('BARCODE')));
      if (empty($bar_produit)) {
        
     $message = "<div class='alert alert-danger' role='alert' id='message'>
                        Barre code non-enregistrer dans le système, veuillez revérifier
                 </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        $data['ID_PRODUIT']=NULL;
        $data['ID_BARCODE']=NULL;
        $data['BARCODE']=NULL;
        $data['PRODUIT']=NULL;

     }
     else{
        if ($bar_produit['STATUS'] == 2) {
            $message = "<div class='alert alert-danger' role='alert' id='message'>
                        Barre code déjà scannée et sortie du stock. Veuillez chercher un autre produit
                 </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        $data['ID_PRODUIT']=NULL;
        $data['ID_BARCODE']=NULL;
        $data['BARCODE']=NULL;
        $data['PRODUIT']=NULL;

        }
        else{
            $message = "<div class='alert alert-success' role='alert' id='message'>
                        Produit pret a etre declasser. Veuillez completez le pourquoi du Declassement en commentaire
                        </div>";       
            $this->session->set_flashdata(array('message'=>$message));
            $data['ID_PRODUIT']=$bar_produit['ID_PRODUIT'];
            $data['ID_BARCODE']=$bar_produit['ID_BARCODE'];
            $data['BARCODE']=$bar_produit['BARCODE'];
            $produit = $this->Model->getOne('saisie_produit',array('ID_PRODUIT'=>$bar_produit['ID_PRODUIT']));
            $data['PRODUIT']=$produit['NOM_PRODUIT'];
           

        }

        
     }
        $data['title'] = "Declassement ";
        $this->load->view("Declassement_Add_View",$data);

  }




  public function save_declassement()
  {

    $ID_PRODUIT =$this->input->post('ID_PRODUIT');
    $ID_BARCODE =$this->input->post('ID_BARCODE');
    $BARCODE =$this->input->post('BARCODE');
      
      
     $this->form_validation->set_rules('BARCODE', 'Bar code', 'required');
     $this->form_validation->set_rules('ID_PRODUIT', 'produit', 'required');
     $this->form_validation->set_rules('BARCODE', 'Bar code', 'required');

    //SI Valide
     if ($this->form_validation->run() == FALSE){        
        

        $message = "<div class='alert alert-danger' id='message'>
                            Donne manquantes, Processus échoué. Veuillez bien rescanner
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";

     $data['title'] = "Declassement ";
     $data['ID_PRODUIT']=NULL;
     $data['ID_BARCODE']=NULL;
     $data['BARCODE']=NULL;
    $this->load->view("Declassement_Add_View",$data);

      }else{

        // print_r($data);
        // exit();
        $bardata = $this->Model->getRequeteOne('SELECT PRIX_VENTE, DATE_PERAMPTION FROM `req_barcode` JOIN req_requisition ON req_requisition.ID_REQUISITION = req_barcode.ID_REQUISITION WHERE req_barcode.ID_BARCODE ='.$this->input->post('ID_BARCODE').'');
        $data = array(          
        'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),                                 
        'QUANTITE'=>1,                                   
        'PRIX_VENTE'=>$bardata['PRIX_VENTE'],
        'BARCODE'=>$this->input->post('BARCODE'),
        'ID_BARCODE'=>$this->input->post('ID_BARCODE'),
        'DATE_PERAMPTION'=>$bardata['DATE_PERAMPTION'],
        'COMMENTAIRE'=>$this->input->post('COMMENTAIRE'),
        'ID_USER'=>$this->session->userdata('STRAPH_ID_USER'),
        );
        $this->Model->insert_last_id('req_stock_endomage',$data);
        $this->Model->update('req_barcode',array('ID_BARCODE'=>$this->input->post('ID_BARCODE')),array('STATUS'=>2,"ENVOIE"=>0));
        
          $message = "<div class='alert alert-success'  id='message'>
                            Declassement fait avec succès.
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('requisition/Declassement'));
      }
  }


  public function listing()
    {


        $PERIODE = $this->input->post('PERIODE');
      // $ID_FOURNISSEUR = $this->input->post('ID_FOURNISSEUR');
      // $data['ID_FOURNISSEURS']= $this->input->post('ID_FOURNISSEUR');
      $ID_USER = $this->input->post('ID_USER');
      $data['ID_USERS']= $this->input->post('ID_USER');

      
      $DATE_DEBUT = $this->input->post('DATE_DEBUT');
      $DATE_FIN = $this->input->post('DATE_FIN');

      

      if ($DATE_DEBUT != NULL) {
        

        if ($DATE_FIN != NULL) {
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= $this->input->post('DATE_FIN');
          $data['conddatedebut'] = ' AND req_stock_endomage.DATE_TIME BETWEEN "'.$DATE_DEBUT.'" AND "'.$DATE_FIN.'"';
        }
        else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddatedebut'] = ' AND req_stock_endomage.DATE_TIME BETWEEN "'.$DATE_DEBUT.'" AND "'.date("Y-m-d").'"';
        }

        
      }
      else{
          $data['DATE_DEBUTS']= date("Y-m-d");
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddatedebut'] = ' AND req_stock_endomage.DATE_TIME BETWEEN "'.date("Y-m-d").'" AND "'.date("Y-m-d").'"';
      }
      
      // if ($ID_FOURNISSEUR != NULL) {
      //   $data['condfournisseur'] = 'AND req_requisition.ID_FOURNISSEUR ='.$ID_FOURNISSEUR.' ';
      // }
      // else{
      //   $data['condfournisseur'] = '';
      // }
      
      if ($ID_USER !=NULL) {
        $data['conduser']='AND req_stock_endomage.ID_USER ='.$ID_USER.' ';
      }
      else{
        $data['conduser']='';
      }
        $data['title'] = "Stock Declass&eacute;";
        $this->load->view('Declassement_List_View',$data);

    }

  

 }


?>