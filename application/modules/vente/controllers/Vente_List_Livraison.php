<?php 
 /**
  * 
  */
 class Vente_List_Livraison extends CI_Controller
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


     $data['CUNIQUE']=$this->notifications->generate_UIID(13);
     $data['title'] = "Vente ";
     $data['produit']='';
     $data['client'] = $this->Model->getRequete('SELECT * FROM `saisie_client` WHERE ID_SOCIETE LIKE "'.$this->session->userdata('STRAPH_ID_SOCIETE').'" ORDER BY NOM_CLIENT');
     $data['vente'] = $this->Model->getRequete('SELECT ID_USER_VENDEUR, config_user.NOM, config_user.PRENOM,`DATE_TIME_VENTE`,  `MONTANT_TOTAL`, `MONTANT_PAYE`, `MONTANT_REMISE`, saisie_client.NOM_CLIENT, saisie_client.PRENOM_CLIENT, `ID_VENTE` FROM `vente_vente` JOIN config_user ON config_user.ID_USER = vente_vente.ID_USER_VENDEUR LEFT JOIN saisie_client ON saisie_client.ID_CLIENT = vente_vente.ID_CLIENT WHERE 1 AND vente_vente.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' '.$conduser.' '.$conddatedebut.' AND IS_LIVRAISON = 1  ');
    



    $this->load->view("Vente_List_Livraison_View",$data);
  }




 }


?>