<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Droits extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("config_droits");
      $user['all_users']=$information;
      $this->load->view('Droits_View', $user);
   }
   public function inserting()
   {
      $this->load->view('Droits_Insert_View');
   }
   public function insert()
   {
      $DESCRIPTION=$this->input->post('DESCRIPTION');
      $ID_SOCIETE=$this->input->post('ID_SOCIETE');
      // $this->Model->create("config_droits", array('DESCRIPTION'=>$DESCRIPTION, 'ID_SOCIETE'=>$ID_SOCIETE,));
      // redirect(base_url('configuration/Droits'));  



  $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');
  $this->form_validation->set_rules('ID_SOCIETE', 'ID_SOCIETE', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `config_droits` order by DESCRIPTION');
    $this->load->view('Droits_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'DESCRIPTION'=>$DESCRIPTION,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                      );
                      
    $this->Model->insert_last_id('config_droits',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Droits'));  
   }

 }

 


   public function deleting($ID_DROIT)
   {
      $this->Model->delete("config_droits",array("ID_DROIT"=>$ID_DROIT));
      redirect(base_url('configuration/Droits'));  

   }
   public function updating($ID_DROIT)
   {
      $info=$this->Model->getOne("config_droits", array("ID_DROIT"=>$ID_DROIT));
      $user['data']=$info;
      $this->load->view('Droits_Update_View', $user);
   }
   public function update()
   {
   $ID_DROIT=$this->input->post('ID_DROIT');
   $DESCRIPTION=$this->input->post('DESCRIPTION');
   $ID_SOCIETE=$this->input->post('ID_SOCIETE');
   // $this->Model->update("config_droits",array("ID_DROIT"=>$ID_DROIT),array("DESCRIPTION"=>$DESCRIPTION, "ID_SOCIETE"=>$ID_SOCIETE));
   //  redirect(base_url('configuration/Droits'));



      $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');
      $this->form_validation->set_rules('ID_SOCIETE', 'ID_SOCIETE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_droits` WHERE ID_SOCIETE = '.$ID_SOCIETE.'');
        $data['profil']=$this->Model->getRequete('SELECT * FROM `config_profil` order by DESCRIPTION');
        $this->load->view('Droits_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'DESCRIPTION'=>$DESCRIPTION,
                           'ID_SOCIETE'=>$ID_SOCIETE,
                          );
                          
        $this->Model->update('config_droits',array('ID_DROIT'=>$ID_DROIT),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Droits'));  
       }
    
  
    }
    
    public function reactiver($ID_DROIT)
    {
      $this->Model->update('config_droits',array('ID_DROIT'=>$ID_DROIT),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Droits'));  
    }
    public function desactiver($ID_DROIT)
    {
      $this->Model->update('config_droits',array('ID_DROIT'=>$ID_DROIT),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Droits'));  
    }




}