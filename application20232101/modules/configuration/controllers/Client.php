<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    
   
   public function index()
   {
    $information=$this->Model->getList("saisie_client");
    $user['all_users']=$information;
    $this->load->view('Client_View', $user);
   }
   public function inserting()
   {
      $this->load->view('Client_Insert_View');
   }
   public function insert()
   {
      $NOM_CL=$this->input->post('NOM_CLIENT');
      $PRENOM_CL=$this->input->post('PRENOM_CLIENT');
      $NIF_CL=$this->input->post('NIF_CLIENT');
      $RC_CL=$this->input->post('RC_CLIENT');
      $TEL_CL=$this->input->post('TEL_CLIENT');
      $EMAIL_CL=$this->input->post('EMAIL_CLIENT');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');

  $this->form_validation->set_rules('NOM_CLIENT', 'NOM_CLIENT', 'required');
  $this->form_validation->set_rules('PRENOM_CLIENT', 'PRENOM_CLIENT', 'required');
  $this->form_validation->set_rules('NIF_CLIENT', 'NIF_CLIENT', 'required');
  $this->form_validation->set_rules('RC_CLIENT', 'RC_CLIENT', 'required');
  $this->form_validation->set_rules('TEL_CLIENT', 'TEL_CLIENT', 'required');
  $this->form_validation->set_rules('EMAIL_CLIENT', 'EMAIL_CLIENT', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `saisie_client` order by NOM_CLIENT');
    $this->load->view('Client_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'NOM_CLIENT'=>$NOM_CL,
                       'PRENOM_CLIENT'=>$PRENOM_CL,
                       'NIF_CLIENT'=>$NIF_CL,
                       'RC_CLIENT'=>$RC_CL,
                       'TEL_CLIENT'=>$TEL_CL,
                       'EMAIL_CLIENT'=>$EMAIL_CL,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                      );
                      
    $this->Model->insert_last_id('saisie_client',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Client'));  
   }

 }

   public function deleting($ID_CLIENT)
   {
      $this->Model->delete("saisie_client",array("ID_CLIENT"=>$ID_CLIENT));
      redirect(base_url('configuration/Client'));  

   }
   public function updating($ID_CLIENT)
   {
      $info=$this->Model->getOne("saisie_client", array("ID_CLIENT"=>$ID_CLIENT));
      $user['data']=$info;
      $this->load->view('Client_Update_View', $user);
   }
   public function update()
   {
   $ID_CLIENT=$this->input->post('ID_CLIENT');
   $NOM_CLIENT=$this->input->post('NOM_CLIENT');
   $PRENOM_CLIENT=$this->input->post('PRENOM_CLIENT');
   $NIF_CLIENT=$this->input->post('NIF_CLIENT');
   $RC_CLIENT=$this->input->post('RC_CLIENT');
   $TEL_CLIENT=$this->input->post('TEL_CLIENT');
   $EMAIL_CLIENT=$this->input->post('EMAIL_CLIENT');
   // $this->Model->update("saisie_client",array("ID_CLIENT"=>$ID_CL),array("NOM_CLIENT"=>$NOM_CL, "PRENOM_CLIENT"=>$PRENOM_CL, "NIF_CLIENT"=>$NIF_CL, "RC_CLIENT"=>$RC_CL, "TEL_CLIENT"=>$TEL_CL, "EMAIL_CLIENT"=>$EMAIL_CL, "ID_SOCIETE"=>$ID_SOCIETE));
   //  redirect(base_url('configuration/Client'));


$this->form_validation->set_rules('NOM_CLIENT', 'NOM_CLIENT', 'required');
$this->form_validation->set_rules('PRENOM_CLIENT', 'PRENOM_CLIENT', 'required');
$this->form_validation->set_rules('NIF_CLIENT', 'NIF_CLIENT', 'required');
$this->form_validation->set_rules('RC_CLIENT', 'RC_CLIENT', 'required');
$this->form_validation->set_rules('TEL_CLIENT', 'TEL_CLIENT', 'required');
$this->form_validation->set_rules('EMAIL_CLIENT', 'EMAIL_CLIENT', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saisie_client` WHERE ID_CLIENT = '.$ID_CLIENT.'');
        $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
        $this->load->view('Client_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'NOM_CLIENT'=>$NOM_CLIENT,
                           'PRENOM_CLIENT'=>$PRENOM_CLIENT,
                           'NIF_CLIENT'=>$NIF_CLIENT,
                           'RC_CLIENT'=>$RC_CLIENT,
                           'TEL_CLIENT'=>$TEL_CLIENT,
                           'EMAIL_CLIENT'=>$EMAIL_CLIENT,
                           'ID_SOCIETE'=>$ID_SOCIETE,
                          );
                          
        $this->Model->update('saisie_client',array('ID_CLIENT'=>$ID_CLIENT),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Client'));  
       }
    
  
    }

   public function reactiver($ID_CLIENT)
    {
      $this->Model->update('saisie_client',array('ID_CLIENT'=>$ID_CLIENT),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Client'));  
    }
    public function desactiver($ID_CLIENT)
    {
      $this->Model->update('saisie_client',array('ID_CLIENT'=>$ID_CLIENT),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Client'));  
    }
   

}