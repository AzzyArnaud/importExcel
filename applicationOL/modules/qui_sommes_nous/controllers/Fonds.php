<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fonds extends CI_Controller
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
        $partenaire=$this->Model->getList("partenaire");
        $datas['error'] = "";
        $datas['partenaire'] =$partenaire;
            $this->load->view('Fonds_View', $datas);

    }

    public function add(){
           $config['upload_path']='./uploads/partenaire/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS BONNEE</div>';
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/partenaire/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/partenaire/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->create("partenaire", array("NOM"=>$_POST['nom'],"FOTO"=>$new_name."_thumb.".$ext));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
       }

      } 
    }

    public function update($id){
                 $config['upload_path']='./uploads/partenaire/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center">  FOTO N\'EST PAS BONNEE</div>';
          $this->Model->update("partenaire",array("ID"=>$id), array("NOM"=>$_POST['nom']));
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/partenaire/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/partenaire/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->update("partenaire",array("ID"=>$id), array("NOM"=>$_POST['nom'],"FOTO"=>$new_name."_thumb.".$ext));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
       }else{
         $data['message']='<div class="alert alert-danger text-center">FOTO N\'EST PAS UPLOADER</div>';
         $this->Model->update("partenaire",array("ID"=>$id), array("NOM"=>$_POST['nom']));
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Fonds"));
       }

      } 
    }

       public function resizeImage($filename)
   {

        $this->load->library('image_lib');

       $config['image_library'] ='gd2';
$config['source_image'] = $filename;
// $config['source_image'] = FCPATH.'uploads/IMG_5561.jpg';
 $config['new_image'] = $filename;

$config['create_thumb'] = TRUE;
$config['maintain_ratio'] = TRUE;
$config['width']         = 500;
$config['height']       = 500;
// $config['thumb_marker'] = false;

$this->image_lib->initialize($config);


$this->image_lib->resize();

  if ( ! $this->image_lib->resize()){
    $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
$this->session->set_flashdata($data);
  redirect(base_url());
  }else{
    return true;
    $this->image_lib->clear();
  }

     // var_dump(gd_info());
    $this->image_lib->clear();

   }

public function delete($id){

          $service=$this->Model->getOne('partenaire',array('ID'=>$id));

        $path=FCPATH."uploads/partenaire/".$service['FOTO'];
      unlink($path);
      $this->Model->delete('partenaire',array('ID'=>$id));
      $data['message']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url("qui_sommes_nous/Fonds"));
    

}

}
?>