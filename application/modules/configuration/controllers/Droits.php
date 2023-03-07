<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Droits extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("config_droits");
      $user['data']=$information;
      $this->load->view('Droits_View', $user);
   }
   public function inserting()
   {
      $cat=$this->Model->getList("config_societe");
      $data['categ']=$cat;

      $this->load->view('Droits_Insert_View',$data);
   }
   public function insert()
   {
      $DESCRIPTION=$this->input->post('DESCRIPTION');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');

      // $this->Model->create("config_droits", array('DESCRIPTION'=>$DESCRIPTION, 'ID_SOCIETE'=>$ID_SOCIETE,));
      // redirect(base_url('configuration/Droits'));  



  $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `config_droits` order by DESCRIPTION');

    $cat=$this->Model->getList("config_societe");
    $data['categ']=$cat;

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
      $data['data']=$info;

     $cat=$this->Model->getList("config_societe");
     $data['categ']=$cat;

      $this->load->view('Droits_Update_View', $data);
   }
   public function update()
   {
   $ID_DROIT=$this->input->post('ID_DROIT');
   $DESCRIPTION=$this->input->post('DESCRIPTION');
   $ID_SOCIETE=$this->input->post('ID_SOCIETE');
   // $this->Model->update("config_droits",array("ID_DROIT"=>$ID_DROIT),array("DESCRIPTION"=>$DESCRIPTION, "ID_SOCIETE"=>$ID_SOCIETE));
   //  redirect(base_url('configuration/Droits'));



      $this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `config_droits` WHERE ID_DROIT = '.$ID_DROIT.'');

        $cat=$this->Model->getList("config_societe");
        $data['categ']=$cat;

        $this->load->view('Droits_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'DESCRIPTION'=>$DESCRIPTION,
                           'ID_SOCIETE'=>$ID_SOCIETE,"ENVOIE"=>0
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
      $this->Model->update('config_droits',array('ID_DROIT'=>$ID_DROIT),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Droits'));  
    }
    public function desactiver($ID_DROIT)
    {
      $this->Model->update('config_droits',array('ID_DROIT'=>$ID_DROIT),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Droits'));  
    }




}