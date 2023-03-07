<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_Disparu extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("req_stock_disparu");
      $user['data']=$information;
      $this->load->view('Stock_Disparu_View', $user);
   }
   public function inserting()
   {

    $cat=$this->Model->getList("saisie_produit");

    $data['categ']=$cat;

      $this->load->view('Stock_Disparu_Insert_View',$data);
   }
   public function insert()
   {
      $ID_PRODUIT=$this->input->post('ID_PRODUIT');
      $QUANTITE=$this->input->post('QUANTITE');
      $PRIX_VENTE=$this->input->post('PRIX_VENTE');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');


  $this->form_validation->set_rules('ID_PRODUIT', 'ID_PRODUIT', 'required');
  $this->form_validation->set_rules('QUANTITE', 'QUANTITE', 'required');
  $this->form_validation->set_rules('PRIX_VENTE', 'PRIX_VENTE', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `req_stock_disparu` order by ID_PRODUIT');

    $cat=$this->Model->getList("saisie_produit");
    $data['categ']=$cat;

    $this->load->view('Stock_Disparu_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'ID_PRODUIT'=>$ID_PRODUIT,
                       'QUANTITE'=>$QUANTITE,
                       'PRIX_VENTE'=>$PRIX_VENTE,
                      );
                      
    $this->Model->insert_last_id('req_stock_disparu',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Disparu'));  
   }

 }

   public function deleting($ID_STOCK_DISPARU)
   {
      $this->Model->delete("req_stock_disparu",array("ID_STOCK_DISPARU"=>$ID_STOCK_DISPARU));
      redirect(base_url('configuration/Stock_Disparu'));  

   }
   public function updating($ID_STOCK_DISPARU)
   {
      $info=$this->Model->getOne("req_stock_disparu", array("ID_STOCK_DISPARU"=>$ID_STOCK_DISPARU));
      $data['data']=$info;

      $cat=$this->Model->getList("saisie_produit");
      $data['categ']=$cat;

      $this->load->view('Stock_Disparu_Update_View', $data);
   }
   public function update()
   {

   $ID_STOCK_DISPARU=$this->input->post('ID_STOCK_DISPARU');
   $ID_PRODUIT=$this->input->post('ID_PRODUIT');
   $QUANTITE=$this->input->post('QUANTITE');
   $PRIX_VENTE=$this->input->post('PRIX_VENTE');
  
  $this->form_validation->set_rules('ID_PRODUIT', 'ID_PRODUIT', 'required');
  $this->form_validation->set_rules('QUANTITE', 'QUANTITE', 'required');
  $this->form_validation->set_rules('PRIX_VENTE', 'PRIX_VENTE', 'required');

  
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `req_stock_disparu` WHERE ID_STOCK_DISPARU = '.$ID_STOCK_DISPARU.'');

        $cat=$this->Model->getList("saisie_produit");
        $data['categ']=$cat;
        
        $this->load->view('Stock_Disparu_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'ID_PRODUIT'=>$ID_PRODUIT,
                           'QUANTITE'=>$QUANTITE,
                           'PRIX_VENTE'=>$PRIX_VENTE,
                           'ID_SOCIETE'=>$ID_SOCIETE,"ENVOIE"=>0
                          );
                          
        $this->Model->update('req_stock_disparu',array('ID_STOCK_DISPARU'=>$ID_STOCK_DISPARU),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Stock_Disparu'));  
       }
    
  
    }

   public function reactiver($ID_STOCK_DISPARU)
    {
      $this->Model->update('req_stock_disparu',array('ID_STOCK_DISPARU'=>$ID_STOCK_DISPARU),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Disparu'));  
    }
    public function desactiver($ID_STOCK_DISPARU)
    {
      $this->Model->update('req_stock_disparu',array('ID_STOCK_DISPARU'=>$ID_STOCK_DISPARU),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Stock_Disparu'));  
    }

    

}