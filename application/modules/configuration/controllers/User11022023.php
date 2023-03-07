<?php
class User  extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->Is_Connected();

      }

      public function Is_Connected()
       {
       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

        


  
    public function index()
    {

      $data['title']='Utilisateur';
      $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
      $this->load->view('User_Add_View',$data);

    }



    public function add()
    {

  $NOM=$this->input->post('NOM');
  $PRENOM=$this->input->post('PRENOM');
  $USERNAME=$this->input->post('USERNAME');
  $PASSWORD=$this->input->post('PASSWORD');
  $PROFIL_ID=$this->input->post('PROFIL_ID');

  $this->form_validation->set_rules('NOM', 'Nom', 'required');
  $this->form_validation->set_rules('PRENOM', 'Prenom', 'required');
  $this->form_validation->set_rules('USERNAME', 'Username', 'required|is_unique[config_user.USERNAME]');
  $this->form_validation->set_rules('PASSWORD', 'Mot de passe', 'required');
  $this->form_validation->set_rules('PROFIL_ID', 'Profil', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
    $this->load->view('User_Add_View',$data);
   }
   else{

    $datasuser=array(
                       'NOM'=>$NOM,
                       'PRENOM'=>$PRENOM,
                       'USERNAME'=>$USERNAME,
                       'PASSWORD'=>md5($PASSWORD),
                       'PROFIL_ID'=>$PROFIL_ID,
                       'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
                      );
                      
    $this->Model->insert_last_id('config_user',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/User/listing'));  
   }

    }

    

    public function listing()
    {
      

      $data['resultat']=$this->Model->getRequete('SELECT ID_USER, NOM, PRENOM, USERNAME, DESCRIPTION, STATUS FROM `config_user` JOIN config_profil ON config_profil.PROFIL_ID = config_user.PROFIL_ID');
      $tabledata=array();
      

      $data['title']='Utilisateur';
      $this->load->view('User_List_View',$data);

    }



    public function index_update($id)
    {

      $data['title']='Utilisateur';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_user` WHERE ID_USER = '.$id.'');
      $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
      $this->load->view('User_Update_View',$data);

    }



    public function update()
    {

      $NOM=$this->input->post('NOM');
      $PRENOM=$this->input->post('PRENOM');
      $USERNAME=$this->input->post('USERNAME');
      $ID_USER=$this->input->post('ID_USER');
      $PROFIL_ID=$this->input->post('PROFIL_ID');
    
      $this->form_validation->set_rules('NOM', 'Nom', 'required');
      $this->form_validation->set_rules('PRENOM', 'Prenom', 'required');
      $this->form_validation->set_rules('USERNAME', 'Username', 'required');
      $this->form_validation->set_rules('PROFIL_ID', 'Profile', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_user` WHERE ID_USER = '.$ID_USER.'');
        $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
        $this->load->view('User_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'NOM'=>$NOM,
                           'PRENOM'=>$PRENOM,
                           'USERNAME'=>$USERNAME,
                           'PROFIL_ID'=>$PROFIL_ID,"ENVOIE"=>0
                          );
                          
        $this->Model->update('config_user',array('ID_USER'=>$ID_USER),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/User/listing'));  
       }
    
  
    }


    public function desactiver($id)
    {
      $this->Model->update('config_user',array('ID_USER'=>$id),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/User/listing'));  
    }

  public function reactiver($id)
    {
      $this->Model->update('config_user',array('ID_USER'=>$id),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/User/listing'));  
    }

    
    


}