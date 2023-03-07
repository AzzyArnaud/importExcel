<?php 
 /**
  * 
  */
 class Stock extends CI_Controller
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

        $data['title'] = "Stock Actuel ";
        $this->load->view('Stock_View',$data);

    }

    public function index_up($ID_PRODUIT)
    {
        $data['data']=$this->Model->getRequeteOne('SELECT saisie_produit.ID_PRODUIT, saisie_produit.NOM_PRODUIT, PRIX_PRODUIT FROM saisie_produit where saisie_produit.ID_PRODUIT = '.$ID_PRODUIT.'');
        $this->load->view('Stock_Upade_Prix_View',$data);
    }

    public function save_update($value='')
    {
         
        $ID_PRODUIT=$this->input->post('ID_PRODUIT'); 
        $PRIX_VENTE=$this->input->post('PRIX_VENTE'); 

        
        $this->Model->update('saisie_produit',array('ID_PRODUIT'=>$ID_PRODUIT),array('PRIX_PRODUIT'=>$PRIX_VENTE));


        $message = "<div class='alert alert-danger' role='alert' id='message'>
                        Prix modifie
                    </div>";       
        $this->session->set_flashdata(array('message'=>$message));
        redirect(base_url('configuration/Produit'));
    }



 }


?>