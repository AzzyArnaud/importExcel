<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fournisseur extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("saisie_fournisseur");
      $user['data']=$information;
      $this->load->view('Fournisseur_View', $user);
   }
   public function inserting()
   {

    $cat=$this->Model->getList("config_societe");

    $data['categ']=$cat;

      $this->load->view('Fournisseur_Insert_View',$data);
   }
   public function insert()
   {
      $NOM=$this->input->post('NOM');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');
  
  $this->form_validation->set_rules('NOM', 'NOM', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `saisie_fournisseur` order by NOM');

    $cat=$this->Model->getList("config_societe");
    $data['categ']=$cat;

    $this->load->view('Fournisseur_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'NOM'=>$NOM,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                      );
                      
    $this->Model->insert_last_id('saisie_fournisseur',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Fournisseur'));  
   }

 }

   public function deleting($ID_FOURNISSEUR)
   {
      $this->Model->delete("saisie_fournisseur",array("ID_FOURNISSEUR"=>$ID_FOURNISSEUR));
      redirect(base_url('configuration/Fournisseur'));  

   }
   public function updating($ID_FOURNISSEUR)
   {
      $info=$this->Model->getOne("saisie_fournisseur", array("ID_FOURNISSEUR"=>$ID_FOURNISSEUR));
      $data['data']=$info;


    $cat=$this->Model->getList("config_societe");
    $data['categ']=$cat;
      $this->load->view('Fournisseur_Update_View', $data);
   }
   public function update()
   {
   $ID_FOURNISSEUR=$this->input->post('ID_FOURNISSEUR');
   $NOM=$this->input->post('NOM');
   

      $this->form_validation->set_rules('NOM', 'NOM', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saisie_fournisseur` WHERE ID_FOURNISSEUR = '.$ID_FOURNISSEUR.'');
        

        $cat=$this->Model->getList("config_societe");
        $data['categ']=$cat;
        
        $this->load->view('Fournisseur_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'NOM'=>$NOM,
                           'ID_SOCIETE'=>$ID_SOCIETE,"ENVOIE"=>0
                          );
                          
        $this->Model->update('saisie_fournisseur',array('ID_FOURNISSEUR'=>$ID_FOURNISSEUR),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Fournisseur'));  
       }
    
  
    }

   public function reactiver($ID_FOURNISSEUR)
    {
      $this->Model->update('saisie_fournisseur',array('ID_FOURNISSEUR'=>$ID_FOURNISSEUR),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Fournisseur'));  
    }
    public function desactiver($ID_FOURNISSEUR)
    {
      $this->Model->update('saisie_fournisseur',array('ID_FOURNISSEUR'=>$ID_FOURNISSEUR),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Fournisseur'));  
    }



}