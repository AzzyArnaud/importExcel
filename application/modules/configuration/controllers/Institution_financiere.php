<?php
class Institution_financiere  extends CI_Controller{
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

      $data['title']='institution& Droit';
      $data['droits']=$this->Model->getRequete('SELECT * FROM `institution_financiere` WHERE 1 AND ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' order by DESCRIPTION');
      $this->load->view('institution financiere_Droit_Add_View',$data);

    }



    public function add()
    {

  $NOM_INSTITUTION=$this->input->post('NOM_INSTITUTION');
  $this->form_validation->set_rules('NOM_INSTITUTION', 'Nom De L\'institution', 'required',array('required'=>'le champs  est  obligatoire!!'));

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            institution financiere non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    // $this->session->set_flashdata(array('message'=>$message));
    $data['title']='institution financiere';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `institution_financiere` order by ID_INSTITUTION');
    $this->load->view('includes/institution_financiere_add_view',$data);
   }
   else{

    $datasuser=array(
                       'NOM_INSTITUTION'=>$NOM_INSTITUTION,
                      );
                      
    $this->Model->insert_last_id('institution_financiere',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            L\'institution enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Institution_financiere/listing'));  
   }

    }

 
    public function listing()
    {
      

      $data['resultat']=$this->Model->getRequete('SELECT * FROM `institution_financiere`');
      $tabledata=array();
      

      $data['title']='institution financiere';
      $this->load->view('includes/institution_financiere_list_view',$data);

    }
    public function index_update($id)
    {

      $data['title']='institution& Droit';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `institution_financiere` WHERE ID_INSTITUTION = '.$id.'');
      $this->load->view('includes/institution_update_view',$data);

    }



    public function update()
    {

  
      $NOM_INSTITUTION=$this->input->post('NOM_INSTITUTION');
      $ID_INSTITUTION=$this->input->post('ID_INSTITUTION');
      $this->form_validation->set_rules('NOM_INSTITUTION', 'Institution Financiere', 'required',array('required'=>'le champs  est  obligatoire!!'));
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                institutionest droit non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='institution& Droit';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `institution_financiere` WHERE ID_INSTITUTION = '.$ID_INSTITUTION.'');
      $this->load->view('includes/institution_update_view',$data);
       }
       else{
        $dataInstit=array(
            'NOM_INSTITUTION'=>$NOM_INSTITUTION,
           );
           
            $this->Model->update('institution_financiere',array('ID_INSTITUTION'=>$ID_INSTITUTION),$dataInstit); 
            redirect(base_url('configuration/Institution_financiere/listing'));  
    }
 }
    public function desactiver($id)
    {
      $this->Model->update('institution_financiere',array('ID_INSTITUTION'=>$id),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Type de cong&eacute; désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Institution_financiere/listing'));  
    }

  public function reactiver($id)
    {
      $this->Model->update('institution_financiere',array('ID_INSTITUTION'=>$id),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Type de cong&eacute; Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Institution_financiere/listing'));  
    }

    
    


}