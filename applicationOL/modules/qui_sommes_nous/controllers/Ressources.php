<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ressources extends CI_Controller
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

    public function index(){
        $descr=$this->Model->getOne("ressource",array("ID"=>1));
         $datas['descr'] = $descr;
        $datas['error'] = "";
            $this->load->view('Ressources_View', $datas);

    }
       public function modifier(){
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') { 
        $this->Model->update("ressource",array("ID"=>1),array("DESCRIPTION"=>$_POST["description"]));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('qui_sommes_nous/Ressources'));
}
    }
         public function vider(){
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') { 
        $this->Model->update("ressource",array("ID"=>1),array("DESCRIPTION"=>""));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('qui_sommes_nous/Ressources'));
}
    }
}


?>