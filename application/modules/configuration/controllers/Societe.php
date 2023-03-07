<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Societe extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("config_societe");
      $user['data']=$information;
      $this->load->view('Societe_View', $user);
   }
   public function inserting()
   {
      $this->load->view('Societe_Insert_View');
   }
   public function insert()
   {
      $SOCIETE=$this->input->post('SOCIETE');
      // $this->Model->create("config_societe", array('SOCIETE'=>$SOCIETE, 'ENVOIE'=>$ENVOIE,));
      // redirect(base_url('configuration/Societe'));  
   
 $this->form_validation->set_rules('SOCIETE', 'SOCIETE', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `config_societe` order by SOCIETE');
    $this->load->view('Societe_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'SOCIETE'=>$SOCIETE,
                      );
                      
    $this->Model->insert_last_id('config_societe',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Societe'));  
   }

 }



   public function deleting($ID_SOCIETE)
   {
      $this->Model->delete("config_societe",array("ID_SOCIETE"=>$ID_SOCIETE));
      redirect(base_url('configuration/Societe'));  

   }
   public function updating($ID_SOCIETE)
   {
      $info=$this->Model->getOne("config_societe", array("ID_SOCIETE"=>$ID_SOCIETE));
      $user['data']=$info;
      $this->load->view('Societe_Update_View', $user);
   }
   public function update()
   {
   $ID_SOCIETE=$this->input->post('ID_SOCIETE');
   $SOCIETE=$this->input->post('SOCIETE');
   // $this->Model->update("config_societe",array("ID_SOCIETE"=>$ID_SOCIETE),array( "SOCIETE"=>$SOCIETE, "ENVOIE"=>$ENVOIE));
   //  redirect(base_url('configuration/Societe')); 

      $this->form_validation->set_rules('SOCIETE', 'SOCIETE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_societe` WHERE ID_SOCIETE = '.$ID_SOCIETE.'');
        $this->load->view('Societe_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'SOCIETE'=>$SOCIETE,"ENVOIE"=>0
                          );
                          
        $this->Model->update('config_societe',array('ID_SOCIETE'=>$ID_SOCIETE),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Societe'));  
       }
    
  
    }


   public function reactiver($ID_SOCIETE)
    {
      $this->Model->update('config_societe',array('ID_SOCIETE'=>$ID_SOCIETE),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Societe'));  
    }
    public function desactiver($ID_SOCIETE)
    {
      $this->Model->update('config_societe',array('ID_SOCIETE'=>$ID_SOCIETE),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Societe'));  
    }


}