<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assurance extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("saisie_assurance");
      $user['all_users']=$information;
      $this->load->view('Assurance_View', $user);
   }
   public function inserting()
   {
      $this->load->view('Assurance_Insert_View');
   }
   public function insert()
   {
      $NOM_ASS=$this->input->post('NOM_ASSURANCE');
      $NIF_ASS=$this->input->post('NIF_ASSURANCE');
      $RC_ASS=$this->input->post('RC_ASSURANCE');
      $TEL_ASS=$this->input->post('TEL_ASSURANCE');
      $EMAIL_ASS=$this->input->post('EMAIL_ASSURANCE');
      $ADRESSE_ASS=$this->input->post('ADRESSE_ASSURANCE');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');


  $this->form_validation->set_rules('NOM_ASSURANCE', 'NOM_ASSURANCE', 'required');
  // $this->form_validation->set_rules('NIF_ASSURANCE', 'NIF_ASSURANCE', 'required');
  // $this->form_validation->set_rules('RC_ASSURANCE', 'RC_ASSURANCE', 'required');
  // $this->form_validation->set_rules('TEL_ASSURANCE', 'TEL_ASSURANCE', 'required');
  // $this->form_validation->set_rules('EMAIL_ASSURANCE', 'EMAIL_ASSURANCE', 'required');
  // $this->form_validation->set_rules('ADRESSE_ASSURANCE', 'ADRESSE_ASSURANCE', 'required');
   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `saisie_assurance` order by NOM_ASSURANCE');
    $this->load->view('Assurance_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'NOM_ASSURANCE'=>$NOM_ASS,
                       'NIF_ASSURANCE'=>$NIF_ASS,
                       'RC_ASSURANCE'=>$RC_ASS,
                       'TEL_ASSURANCE'=>$TEL_ASS,
                       'EMAIL_ASSURANCE'=>$EMAIL_ASS,
                       'ADRESSE_ASSURANCE'=>$ADRESSE_ASS,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                      );
                      
    $this->Model->insert_last_id('saisie_assurance',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Assurance'));  
   }

 }

   public function deleting($ID_ASSURANCE)
   {
      $this->Model->delete("saisie_assurance",array("ID_ASSURANCE"=>$ID_ASSURANCE));
      redirect(base_url('configuration/Assurance'));  

   }
   public function updating($ID_ASSURANCE)
   {
      $info=$this->Model->getOne("saisie_assurance", array("ID_ASSURANCE"=>$ID_ASSURANCE));
      $user['data']=$info;
      $this->load->view('Assurance_Update_View', $user);
   }
   public function update()
   {
   $ID_ASSURANCE=$this->input->post('ID_ASSURANCE');
   $NOM_ASSURANCE=$this->input->post('NOM_ASSURANCE');
   $NIF_ASSURANCE=$this->input->post('NIF_ASSURANCE');
   $RC_ASSURANCE=$this->input->post('RC_ASSURANCE');
   $TEL_ASSURANCE=$this->input->post('TEL_ASSURANCE');
   $EMAIL_ASSURANCE=$this->input->post('EMAIL_ASSURANCE');
   $ADRESSE_ASSURANCE=$this->input->post('ADRESSE_ASSURANCE');
   // $this->Model->update("saisie_assurance",array("ID_ASSURANCE"=>$ID_ASS),array("NOM_ASSURANCE"=>$NOM_ASS, "NIF_ASSURANCE"=>$NIF_ASS, "RC_ASSURANCE"=>$RC_ASS, "TEL_ASSURANCE"=>$TEL_ASS, "EMAIL_ASSURANCE"=>$EMAIL_ASS, "ADRESSE_ASSURANCE"=>$ADRESSE_ASS, "ID_SOCIETE"=>$ID_SOCIETE));
   //  redirect(base_url('configuration/Assurance'));  


$this->form_validation->set_rules('NOM_ASSURANCE', 'NOM_ASSURANCE', 'required');
$this->form_validation->set_rules('NIF_ASSURANCE', 'NIF_ASSURANCE', 'required');
$this->form_validation->set_rules('RC_ASSURANCE', 'RC_ASSURANCE', 'required');
$this->form_validation->set_rules('TEL_ASSURANCE', 'TEL_ASSURANCE', 'required');
$this->form_validation->set_rules('EMAIL_ASSURANCE', 'EMAIL_ASSURANCE', 'required');
$this->form_validation->set_rules('ADRESSE_ASSURANCE', 'ADRESSE_ASSURANCE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saisie_assurance` WHERE ID_ASSURANCE = '.$ID_ASSURANCE.'');
        $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
        $this->load->view('Assurance_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'NOM_ASSURANCE'=>$NOM_ASSURANCE,
                           'NIF_ASSURANCE'=>$NIF_ASSURANCE,
                           'RC_ASSURANCE'=>$RC_ASSURANCE,
                           'TEL_ASSURANCE'=>$TEL_ASSURANCE,
                           'EMAIL_ASSURANCE'=>$EMAIL_ASSURANCE,
                           'ADRESSE_ASSURANCE'=>$ADRESSE_ASSURANCE,
                           'ID_SOCIETE'=>$ID_SOCIETE,"ENVOIE"=>0
                          );
                          
        $this->Model->update('saisie_assurance',array('ID_ASSURANCE'=>$ID_ASSURANCE),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Assurance'));  
       }
    
  
    }

   public function reactiver($ID_ASSURANCE)
    {
      $this->Model->update('saisie_assurance',array('ID_ASSURANCE'=>$ID_ASSURANCE),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Assurance'));  
    }
    public function desactiver($ID_ASSURANCE)
    {
      $this->Model->update('saisie_assurance',array('ID_ASSURANCE'=>$ID_ASSURANCE),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Assurance'));  
    }

    

}