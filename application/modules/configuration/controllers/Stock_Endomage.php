<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_Endomage extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("req_stock_endomage");
      $user['data']=$information;
      $this->load->view('Stock_Endomage_View', $user);
   }
   public function inserting()
   {

    $cat=$this->Model->getList("saisie_produit");

    $data['categ']=$cat;

      $this->load->view('Stock_Endomage_Insert_View',$data);
   }
   public function insert()
   {
      $ID_PRODUIT=$this->input->post('ID_PRODUIT');
      $QUANTITE=$this->input->post('QUANTITE');
      $PRIX_VENTE=$this->input->post('PRIX_VENTE');
      $DATE_PERAMPTION=$this->input->post('DATE_PERAMPTION');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');


  $this->form_validation->set_rules('ID_PRODUIT', 'ID_PRODUIT', 'required');
  $this->form_validation->set_rules('QUANTITE', 'QUANTITE', 'required');
  $this->form_validation->set_rules('PRIX_VENTE', 'PRIX_VENTE', 'required');
  $this->form_validation->set_rules('DATE_PERAMPTION', 'DATE_PERAMPTION', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `req_stock_endomage` order by ID_PRODUIT');

    $cat=$this->Model->getList("saisie_produit");
    $data['categ']=$cat;

    $this->load->view('Stock_Endomage_Insert_View',$data);
   }
   else{

    $datasuser=array(

                       'ID_PRODUIT'=>$ID_PRODUIT,
                       'QUANTITE'=>$QUANTITE,
                       'PRIX_VENTE'=>$PRIX_VENTE,
                       'DATE_PERAMPTION'=>$DATE_PERAMPTION,
                      );
                      
    $this->Model->insert_last_id('req_stock_endomage',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Endomage'));  
   }

 }

   public function deleting($ID_STOCK_ENDOMAGE)
   {
      $this->Model->delete("req_stock_endomage",array("ID_STOCK_ENDOMAGE"=>$ID_STOCK_ENDOMAGE));
      redirect(base_url('configuration/Stock_Endomage'));  

   }
   public function updating($ID_STOCK_ENDOMAGE)
   {
      $info=$this->Model->getOne("req_stock_endomage", array("ID_STOCK_ENDOMAGE"=>$ID_STOCK_ENDOMAGE));
      $data['data']=$info;

      $cat=$this->Model->getList("saisie_produit");
      $data['categ']=$cat;

      $this->load->view('Stock_Endomage_Update_View', $data);
   }
   public function update()
   {
      $ID_STOCK_ENDOMAGE=$this->input->post('ID_STOCK_ENDOMAGE');
      $ID_PRODUIT=$this->input->post('ID_PRODUIT');
      $QUANTITE=$this->input->post('QUANTITE');
      $PRIX_VENTE=$this->input->post('PRIX_VENTE');
      $DATE_PERAMPTION=$this->input->post('DATE_PERAMPTION');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');

  

  $this->form_validation->set_rules('ID_PRODUIT', 'ID_PRODUIT', 'required');
  $this->form_validation->set_rules('QUANTITE', 'QUANTITE', 'required');
  $this->form_validation->set_rules('PRIX_VENTE', 'PRIX_VENTE', 'required');
  $this->form_validation->set_rules('DATE_PERAMPTION', 'DATE_PERAMPTION', 'required');

       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `req_stock_endomage` WHERE ID_STOCK_ENDOMAGE = '.$ID_STOCK_ENDOMAGE.'');

        $cat=$this->Model->getList("saisie_produit");
        $data['categ']=$cat;
        
        $this->load->view('Stock_Endomage_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'ID_PRODUIT'=>$ID_PRODUIT,
                           'QUANTITE'=>$QUANTITE,
                           'PRIX_VENTE'=>$PRIX_VENTE,
                           'DATE_PERAMPTION'=>$DATE_PERAMPTION,
                           'ID_SOCIETE'=>$ID_SOCIETE,"ENVOIE"=>0
                          );
                          
        $this->Model->update('req_stock_endomage',array('ID_STOCK_ENDOMAGE'=>$ID_STOCK_ENDOMAGE),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Stock_Endomage'));  
       }
    
  
    }

   public function reactiver($ID_STOCK_ENDOMAGE)
    {
      $this->Model->update('req_stock_endomage',array('ID_STOCK_ENDOMAGE'=>$ID_STOCK_ENDOMAGE),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Endomage'));  
    }
    public function desactiver($ID_STOCK_ENDOMAGE)
    {
      $this->Model->update('req_stock_endomage',array('ID_STOCK_ENDOMAGE'=>$ID_STOCK_ENDOMAGE),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Endomage'));  
    }

    

}