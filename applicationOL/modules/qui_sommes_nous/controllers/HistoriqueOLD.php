<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historique extends CI_Controller
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
        $datas['error'] = "";
        $descr=$this->Model->getOne("historique",array("ID"=>1));
         $datas['descr'] = $descr;
            $this->load->view('Historique_View', $datas);

    }

        public function modifier(){
             // print_r($_POST);exit();
        $this->Model->update("historique",array("ID"=>1),array("DESCRIPTION"=>$_POST["description"]));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('qui_sommes_nous/Historique'));
    }

      public function vider(){
             // print_r($_POST);exit();
        $this->Model->update("historique",array("ID"=>1),array("DESCRIPTION"=>""));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('qui_sommes_nous/Historique'));
    }
}
?>