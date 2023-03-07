<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller
{
	
	function __construct()
	{
		 parent::__construct();
        // $this->is_Oauth();
      
	}
    public function is_Oauth()
    {
       if($this->session->userdata('USERNAME') == NULL)
        redirect(base_url());
    }

    public function groupements(){
        $datas['error'] = "";
        $descr=$this->Model->getOne("credit_groupements",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Groupements_View', $datas);

    }

        public function modifier_groupement(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("credit_groupements",array("ID"=>1),array("DESCRIPTION"=>$_GET["description"]));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description  crédit aux groupements","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/groupements'));
}
    }

      public function vider_groupement(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("credit_groupements",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer description  crédit aux groupements","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/groupements'));
}
    }

        public function autre_credit(){
        $datas['error'] = "";
        $descr=$this->Model->getOne("credit_autre",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Autre_credit_View', $datas);

    }

        public function modifier_autre_credit(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("credit_autre",array("ID"=>1),array("DESCRIPTION"=>$_GET["description"]));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description autre crédit","USER_ID"=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/autre_credit'));
}
    }

      public function vider_autre_credit(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("credit_autre",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer description autre crédit","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/autre_credit'));
}
    }

      public function depot(){
        $datas['error'] = "";
        $descr=$this->Model->getOne("depot_terme",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Depot_View', $datas);

    }

        public function modifier_depot(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("depot_terme",array("ID"=>1),array("DESCRIPTION"=>$_GET["description"]));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description depot au terme","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/depot'));
}
    }

      public function vider_depot(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("depot_terme",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer description depot au terme","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/depot'));
}
    }


      public function autre_produit(){
        $datas['error'] = "";
        $descr=$this->Model->getOne("autre_produit_service",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Autre_produit_View', $datas);

    }

        public function modifier_autre_produit(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("autre_produit_service",array("ID"=>1),array("DESCRIPTION"=>$_GET["description"]));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description  pour autres preoduits","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/autre_produit'));
}
    }

      public function vider_autre_produit(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("autre_produit_service",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer description pour autres produits","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/autre_produit'));
}
    }

 
          public function critrere_jeune(){
            
        $datas['error'] = "";
        $descr=$this->Model->getOne("critrere_jeune",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Critrere_jeune_View', $datas);

    }

        public function modifier_critrere_jeune(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("critrere_jeune",array("ID"=>1),array("DESCRIPTION"=>$_POST["description"]));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description critreres credit jeune","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/critrere_jeune'));
}
    }

      public function vider_critrere_jeune(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("critrere_jeune",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer ddescription critreres credit jeune","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/critrere_jeune'));
}
    }



          public function twige(){
        $datas['error'] = "";
        $descr=$this->Model->getOne("twige",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('twige_View', $datas);

    }

        public function modifier_twige(){ 
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("twige",array("ID"=>1),array("DESCRIPTION"=>$_GET["description"]));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier description critreres TWIGE NA BIJE","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/twige'));
}
    }

      public function vider_twige(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
             // print_r($_POST);exit();
        $this->Model->update("twige",array("ID"=>1),array("DESCRIPTION"=>""));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer ddescription critreres TWIGE NA BIJE","USER_ID"=>$this->session->userdata('ID')));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('produit_service/Credit/twige'));
}
    }

}
?>