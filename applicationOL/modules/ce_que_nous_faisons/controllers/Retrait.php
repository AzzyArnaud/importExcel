<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retrait extends CI_Controller
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
        $descr=$this->Model->getOne("retrait_versement",array("ID"=>1));
         $datas['descr'] = $descr;
        $datas['error'] = "";
        $datas['error'] = "";
            $this->load->view('Retrait_View', $datas);

    }
         public function modifier(){
        $this->Model->update("retrait_versement",array("ID"=>1),array("DESCRIPTION"=>$_POST["description"]));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('ce_que_nous_faisons/Retrait'));
    }
             public function vider(){
        $this->Model->update("retrait_versement",array("ID"=>1),array("DESCRIPTION"=>""));
        $data['message']='<div class="alert alert-success text-center">  Modification avec succès</div>';

        $this->session->set_flashdata($data);
  redirect(base_url('ce_que_nous_faisons/Retrait'));
    }
}
?>