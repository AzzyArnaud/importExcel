<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_Remise extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("saisie_type_remise");
      $user['data']=$information;
      $this->load->view('Type_Remise_View', $user);
   }
   public function inserting()
   {

    $cat=$this->Model->getList("saisie_assurance");

    $data['categ']=$cat;

      $this->load->view('Type_Remise_Insert_View',$data);
   }
   public function insert()
   {
      $ID_ASSURANCE=$this->input->post('ID_ASSURANCE');
      $POURCENTAGE=$this->input->post('POURCENTAGE');
  
  $this->form_validation->set_rules('ID_ASSURANCE', 'ID_ASSURANCE', 'required');
  $this->form_validation->set_rules('POURCENTAGE', 'POURCENTAGE', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `saisie_type_remise` order by ID_ASSURANCE');

    $cat=$this->Model->getList("saisie_assurance");
    $data['categ']=$cat;

    $this->load->view('Type_Remise_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'ID_ASSURANCE'=>$ID_ASSURANCE,
                       'POURCENTAGE'=>$POURCENTAGE,
                      );
                      
    $this->Model->insert_last_id('saisie_type_remise',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Type_Remise'));  
   }

 }

   public function deleting($ID_TYPE_REMISE)
   {
      $this->Model->delete("saisie_type_remise",array("ID_TYPE_REMISE"=>$ID_TYPE_REMISE));
      redirect(base_url('configuration/Type_Remise'));  

   }
   public function updating($ID_TYPE_REMISE)
   {
      $info=$this->Model->getOne("saisie_type_remise", array("ID_TYPE_REMISE"=>$ID_TYPE_REMISE));
      $data['data']=$info;

      $cat=$this->Model->getList("saisie_assurance");
      $data['categ']=$cat;
      $this->load->view('Type_Remise_Update_View', $data);
   }
   public function update()
   {
   $ID_TYPE_REMISE=$this->input->post('ID_TYPE_REMISE');
   $ID_ASSURANCE=$this->input->post('ID_ASSURANCE');
   $POURCENTAGE=$this->input->post('POURCENTAGE');

      $this->form_validation->set_rules('ID_ASSURANCE', 'ID_ASSURANCE', 'required');
      $this->form_validation->set_rules('POURCENTAGE', 'POURCENTAGE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saisie_type_remise` WHERE ID_TYPE_REMISE = '.$ID_TYPE_REMISE.'');

        $cat=$this->Model->getList("saisie_assurance");
        $data['categ']=$cat;

        $this->load->view('Type_Remise_Update_View',$data);
       }
       else{
        $datasuser=array(
                           'ID_ASSURANCE'=>$ID_ASSURANCE,
                           'POURCENTAGE'=>$POURCENTAGE,
                          );
                          
        $this->Model->update('saisie_type_remise',array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Type_Remise'));  
       }
    
  
    }

   public function reactiver($ID_TYPE_REMISE)
    {
      $this->Model->update('saisie_type_remise',array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Type_Remise'));  
    }
    public function desactiver($ID_TYPE_REMISE)
    {
      $this->Model->update('saisie_type_remise',array('ID_TYPE_REMISE'=>$ID_TYPE_REMISE),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Type_Remise'));  
    }



}