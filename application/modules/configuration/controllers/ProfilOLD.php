<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("config_profil");
      $user['all_users']=$information;
      $this->load->view('Profil_View', $user);
   }
   public function inserting()
   {
      $this->load->view('Profil_Insert_View');
   }
   public function insert()
   {
      $DESCRIPTION=$this->input->post('DESCRIPTION');
      $ID_SOCIETE=$this->input->post('ID_SOCIETE');
      // $this->Model->create("config_profil", array('DESCRIPTION'=>$DESCRIPTION, 'ID_SOCIETE'=>$ID_SOCIETE,));
      // redirect(base_url('configuration/Profil'));  

  $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');
  $this->form_validation->set_rules('ID_SOCIETE', 'ID_SOCIETE', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
    $this->load->view('Profil_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'DESCRIPTION'=>$DESCRIPTION,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                      );
                      
    $this->Model->insert_last_id('config_profil',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Profil'));  
   }

 }

 
   public function deleting($PROFIL_ID)
   {
      $this->Model->delete("config_profil",array("PROFIL_ID"=>$PROFIL_ID));
      redirect(base_url('configuration/Profil'));  

   }
   public function updating($PROFIL_ID)
   {
      $info=$this->Model->getOne("config_profil", array("PROFIL_ID"=>$PROFIL_ID));
      $user['data']=$info;
      $this->load->view('Profil_Update_View', $user);
   }
   public function update()
   {
   $PROFIL_ID=$this->input->post('PROFIL_ID');
   $DESCRIPTION=$this->input->post('DESCRIPTION');
   $ID_SOCIETE=$this->input->post('ID_SOCIETE');
   // $this->Model->update("config_profil",array("PROFIL_ID"=>$PROFIL_ID),array("DESCRIPTION"=>$DESCRIPTION, "ID_SOCIETE"=>$ID_SOCIETE));
   //  redirect(base_url('configuration/Profil')); 


      $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');
      $this->form_validation->set_rules('ID_SOCIETE', 'ID_SOCIETE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_profil` WHERE PROFIL_ID = '.$PROFIL_ID.'');
        $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
        $this->load->view('Profil_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'DESCRIPTION'=>$DESCRIPTION,
                           'ID_SOCIETE'=>$ID_SOCIETE,
                          );
                          
        $this->Model->update('config_profil',array('PROFIL_ID'=>$PROFIL_ID),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Profil'));  
       }
    
  
    }

   public function reactiver($PROFIL_ID)
    {
      $this->Model->update('config_profil',array('PROFIL_ID'=>$PROFIL_ID),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Profil'));  
    }
    public function desactiver($PROFIL_ID)
    {
      $this->Model->update('config_profil',array('PROFIL_ID'=>$PROFIL_ID),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Profil'));  
    }



}