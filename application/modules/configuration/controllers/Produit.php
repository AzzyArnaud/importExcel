<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

    
   
   public function index()
   {
      $information=$this->Model->getList("saisie_produit");
      $user['data']=$information;
      $this->load->view('Produit_View', $user);
   }
   public function inserting()
   {
      $cat=$this->Model->getList("saisie_categorie_produit");
      $data['categ']=$cat;

      $this->load->view('Produit_Insert_View',$data);
   }
   public function insert()
   {
      $NOM_PRODUIT=$this->input->post('NOM_PRODUIT');
      $ID_CATEGORIE_PRODUIT=$this->input->post('ID_CATEGORIE_PRODUIT');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE');

      $AGREE_LOCAL=$this->input->post('AGREE_LOCAL');
      $PRIX_PRODUIT=$this->input->post('PRIX_PRODUIT');
  
  $this->form_validation->set_rules('NOM_PRODUIT', 'NOM_PRODUIT', 'required');
  $this->form_validation->set_rules('ID_CATEGORIE_PRODUIT', 'ID_CATEGORIE_PRODUIT', 'required');
  $this->form_validation->set_rules('AGREE_LOCAL', 'Agreement', 'required');
  $this->form_validation->set_rules('PRIX_PRODUIT', 'Prix du Produit', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    // $data['title']='Utilisateur';
    // $data['profil']=$this->Model->getRequete('SELECT * FROM `saisie_produit` order by NOM_PRODUIT');

    $cat=$this->Model->getList("saisie_categorie_produit");
    $data['categ']=$cat;

    $this->load->view('Produit_Insert_View',$data);
   }
   else{

    $datasuser=array(
                       'NOM_PRODUIT'=>$NOM_PRODUIT,
                       'ID_CATEGORIE_PRODUIT'=>$ID_CATEGORIE_PRODUIT,
                       'ID_SOCIETE'=>$ID_SOCIETE,
                       'AGREE_LOCAL'=>$AGREE_LOCAL,
                       'PRIX_PRODUIT'=>$PRIX_PRODUIT,
                      );

    // print_r($datasuser);
    // exit();
                      
    $this->Model->insert_last_id('saisie_produit',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit'));  
   }

 }

   public function deleting($ID_PRODUIT)
   {
      $this->Model->delete("saisie_produit",array("ID_PRODUIT"=>$ID_PRODUIT));
      redirect(base_url('configuration/Produit'));  

   }
   public function updating($ID_PRODUIT)
   {
      $info=$this->Model->getOne("saisie_produit", array("ID_PRODUIT"=>$ID_PRODUIT));
      $data['data']=$info;


     $cat=$this->Model->getList("saisie_categorie_produit");
     $data['categ']=$cat;

      $this->load->view('Produit_Update_View', $data);
   }
   public function update()
   {
   $ID_PRODUIT=$this->input->post('ID_PRODUIT');
   $NOM_PRODUIT=$this->input->post('NOM_PRODUIT');
   $ID_CATEGORIE_PRODUIT=$this->input->post('ID_CATEGORIE_PRODUIT');
   // $ID_SOCIETE=$this->input->post('ID_SOCIETE');

   $PRIX_PRODUIT=$this->input->post('PRIX_PRODUIT');
   $AGREE_LOCAL=$this->input->post('AGREE_LOCAL');


      $this->form_validation->set_rules('NOM_PRODUIT', 'NOM_PRODUIT', 'required');
      $this->form_validation->set_rules('ID_CATEGORIE_PRODUIT', 'ID_CATEGORIE_PRODUIT', 'required');
      // $this->form_validation->set_rules('ID_SOCIETE', 'ID_SOCIETE', 'required');
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Utilisateur';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saisie_produit` WHERE ID_PRODUIT = '.$ID_PRODUIT.'');

        $cat=$this->Model->getList("saisie_categorie_produit");
        $data['categ']=$cat;

        $this->load->view('Produit_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'NOM_PRODUIT'=>$NOM_PRODUIT,
                           'ID_CATEGORIE_PRODUIT'=>$ID_CATEGORIE_PRODUIT,
                           'PRIX_PRODUIT'=>$PRIX_PRODUIT,
                           'AGREE_LOCAL'=>$AGREE_LOCAL,"ENVOIE"=>0
                          );
                          
        $this->Model->update('saisie_produit',array('ID_PRODUIT'=>$ID_PRODUIT),$datasuser);  
    
        $message = "<div class='alert alert-success' id='message'>
                                Utilisateur modifi&eacute; avec succés
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
          redirect(base_url('configuration/Produit'));  
       }
    
  
    }

   public function reactiver($ID_PRODUIT)
    {
      $this->Model->update('saisie_produit',array('ID_PRODUIT'=>$ID_PRODUIT),array('STATUS'=>1,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit'));  
    }
    public function desactiver($ID_PRODUIT)
    {
      $this->Model->update('saisie_produit',array('ID_PRODUIT'=>$ID_PRODUIT),array('STATUS'=>0,"ENVOIE"=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit'));  
    }

    public function getProduitPrice(){
     $prod= $this->Model->getOne("saisie_produit",array("ID_PRODUIT"=>$this->input->post("ID_PRODUIT")));

     echo $prod['PRIX_PRODUIT'];
    }

    public function getProduitPrice1(){
     $prod= $this->Model->getOne("saisie_produit",array("ID_PRODUIT"=>$this->input->post("ID_PRODUIT")));

$gen=$this->Model->getRequeteOne("SELECT ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)+(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_entrer_ajustement where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE FROM saisie_produit p where p.ID_PRODUIT=".$this->input->post("ID_PRODUIT"));

     echo $prod['PRIX_PRODUIT']."|".$gen['NOMBRE'];
    }
}