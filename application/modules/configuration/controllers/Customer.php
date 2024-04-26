<?php
class Customer  extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->Is_Connected();

      }

      public function Is_Connected()
       {
       if (empty($this->session->userdata('STRAPH1_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

    public function index()
    {

      $data['title']='Client';
      $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by CUSTOMER_ID');
      $this->load->view('includes/customer_add_view',$data);

    }



    public function add()
    {

  $CUSTOMER_NAME=$this->input->post('CUSTOMER_NAME');
  $IDENTITY_NUMBER=$this->input->post('IDENTITY_NUMBER');
  $COLLINE=$this->input->post('COLLINE');
  $COMMUNE=$this->input->post('COMMUNE');
  $PROVINCE=$this->input->post('PROVINCE');
  $BIRTH_DAY=$this->input->post('BIRTH_DAY');
  $GENDER=$this->input->post('GENDER');
  $CATEGORY=$this->input->post('CATEGORY');
  $REPRESENT_BY=$this->input->post('REPRESENT_BY');
  $MOBILE_NUMBER=$this->input->post('MOBILE_NUMBER');
  $NBRE_MEMBER=$this->input->post('NBRE_MEMBER');
  $ZONE=$this->input->post('ZONE');

  $this->form_validation->set_rules('CUSTOMER_NAME', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('IDENTITY_NUMBER', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('COLLINE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('COMMUNE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('PROVINCE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('BIRTH_DAY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('GENDER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('CATEGORY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('REPRESENT_BY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('MOBILE_NUMBER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('NBRE_MEMBER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('ZONE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $gender;
  if ($GENDER==1) {
    $gender=1;
  }elseif ($GENDER==2) {
    $gender=0;
  }
   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Client non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    // $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Client';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by CUSTOMER_ID');
    $this->load->view('includes/customer_add_view',$data);
   }
   else{
    

    $dataClient=array(
                       'CUSTOMER_NAME'=>$CUSTOMER_NAME,
                       'IDENTITY_NUMBER'=>$IDENTITY_NUMBER,
                       'COLLINE'=>$COLLINE,
                       'COMMUNE'=>$COMMUNE,
                       'PROVINCE'=>$PROVINCE,
                       'BIRTH_DAY'=>$BIRTH_DAY,
                       'GENDER' => $gender,
                       'CATEGORY'=>$CATEGORY,
                       'REPRESENT_BY'=>$REPRESENT_BY,
                       'MOBILE_NUMBER'=>$MOBILE_NUMBER,
                       'NBRE_MEMBER'=>$NBRE_MEMBER,
                       'ZONE'=>$ZONE
                      );
                      
    $this->Model->insert_last_id('client',$dataClient);  

    $message = "<div class='alert alert-success' id='message'>
                            client enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Customer/listing'));  
   }

    }

    

    public function listing()
    {
      

      $data['resultat']=$this->Model->getRequete('SELECT * from client');
      $tabledata=array();
      
      
      $data['title']='Client';
      $this->load->view('includes/customer_view',$data);

    }



    public function index_update($id)
    {

      $data['title']='Client';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `client` WHERE CUSTOMER_ID = '.$id.'');
      $data['gender']=$this->Model->getRequete('SELECT GENDER FROM `client` order by CUSTOMER_ID');

      $this->load->view('includes/customer_update_view',$data);

    }



    public function update()
    {

      $CUSTOMER_NAME=$this->input->post('CUSTOMER_NAME');
      $IDENTITY_NUMBER=$this->input->post('IDENTITY_NUMBER');
      $COLLINE=$this->input->post('COLLINE');
      $COMMUNE=$this->input->post('COMMUNE');
      $PROVINCE=$this->input->post('PROVINCE');
      $BIRTH_DAY=$this->input->post('BIRTH_DAY');
      $GENDER=$this->input->post('GENDER');
      $CATEGORY=$this->input->post('CATEGORY');
      $REPRESENT_BY=$this->input->post('REPRESENT_BY');
      $MOBILE_NUMBER=$this->input->post('MOBILE_NUMBER');
      $NBRE_MEMBER=$this->input->post('NBRE_MEMBER');
      $ZONE=$this->input->post('ZONE');
      $ID_USER=$this->input->post('CUSTOMER_ID');
      
    
  $this->form_validation->set_rules('CUSTOMER_NAME', '', 'required',array('required'=>'le champs  est obligatoire!!'));
  $this->form_validation->set_rules('IDENTITY_NUMBER', '', 'required',array('required'=>'le champs  est obligatoire!!'));
  $this->form_validation->set_rules('COLLINE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('COMMUNE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('PROVINCE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('BIRTH_DAY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('GENDER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('CATEGORY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('REPRESENT_BY', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('MOBILE_NUMBER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('NBRE_MEMBER', '', 'required',array('required'=>'le champs est  obligatoire!!'));
  $this->form_validation->set_rules('ZONE', '', 'required',array('required'=>'le champs est  obligatoire!!'));
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Client non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Client';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `client` WHERE CUSTOMER_ID = '.$ID_USER.'');
        $this->load->view('includes/customer_update_view',$data);
       }
       else{
    
        $datasuser=array(
          'CUSTOMER_NAME'=>$CUSTOMER_NAME,
          'IDENTITY_NUMBER'=>$IDENTITY_NUMBER,
          'COLLINE'=>$COLLINE,
          'COMMUNE'=>$COMMUNE,
          'PROVINCE'=>$PROVINCE,
          'BIRTH_DAY'=>$BIRTH_DAY,
          'GENDER' => $GENDER,
          'CATEGORY'=>$CATEGORY,
          'REPRESENT_BY'=>$REPRESENT_BY,
          'MOBILE_NUMBER'=>$MOBILE_NUMBER,
          'NBRE_MEMBER'=>$NBRE_MEMBER,
          'ZONE'=>$ZONE
          );
                          
        $this->Model->update('client',array('CUSTOMER_ID'=>$ID_USER),$datasuser); 
        $message = "<div class='alert alert-success' id='message'>
                                Client modifi&eacute; avec succés (".$mdp.")
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Customer/listing'));  
       }
    
  
    }


    public function desactiver($id)
    {
      $this->Model->update('client',array('CUSTOMER_ID'=>$id),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Client désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Customer/listing'));  
    }

  public function reactiver($id)
    {
      $this->Model->update('client',array('CUSTOMER_ID'=>$id),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Client Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Customer/listing'));  
    }

    
    


}