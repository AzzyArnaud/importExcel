<?php 
 /**
  * 
  */
 class Sortie_Stock extends CI_Controller
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
          $data['conddateun'] = ' AND DATE_TIME_VENTE BETWEEN "'.$DATE_DEBUT.'" AND "'.$DATE_FIN.'"';
          $data['conddatedeux'] = ' AND DATE_TIME BETWEEN "'.$DATE_DEBUT.'" AND "'.$DATE_FIN.'"';
        }
        else{
          $data['DATE_DEBUTS']= $this->input->post('DATE_DEBUT');
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddateun'] = ' AND DATE_TIME_VENTE BETWEEN "'.$DATE_DEBUT.'" AND "'.date("Y-m-d").'"';
          $data['conddatedeux'] = ' AND DATE_TIME BETWEEN "'.$DATE_DEBUT.'" AND "'.date("Y-m-d").'"';
        }

        
      }
      else{
          $data['DATE_DEBUTS']= date("Y-m-d");
          $data['DATE_FINS']= date("Y-m-d");
          $data['conddateun'] = ' AND DATE_TIME_VENTE BETWEEN "'.date("Y-m-d").'" AND "'.date("Y-m-d").'"';
          $data['conddatedeux'] = ' AND DATE_TIME BETWEEN "'.date("Y-m-d").'" AND "'.date("Y-m-d").'"';
      }

      $MODE = $this->input->post('MODE');
      $data['MODES']= $this->input->post('MODE');

      if ($MODE !=NULL) {
        $data['MODE']= $MODE;
      }
      else{
        $data['MODE']=0;
      }

        $data['title'] = "Liste sortie stock ";
        $this->load->view('Sortie_Stock_View',$data);

    }



 }


?>