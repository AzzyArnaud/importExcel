<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leadership extends CI_Controller
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
        $staff=$this->Model->getList("staff");
$datas['staff'] = $staff;
        $datas['error'] = "";
            $this->load->view('Leadership_View', $datas);

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


    public function ajout_staff_reduise(){
      if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {   
     $config['upload_path']='./uploads/staff/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message_staff']='<div class="alert alert-danger text-center"> Echec !! Veuillez ajouter une photo</div>';
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/staff/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/staff/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

      $this->Model->create("staff", array("NOM"=>$_POST['nom'],"PRENOM"=>$_POST['prenom'],"POST"=>$_POST['post'],"FACEBOOK"=>$_POST['face'],"TWITTER"=>$_POST['twitter'],'HISTORIQUE'=>$_POST['historique'],"FOTO"=>$new_name."_thumb.".$ext));
       $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter un membre du staff ","USER_ID"=>$this->session->userdata('ID')));

        $data['message_staff']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
       }else{
         $data['message_staff']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
       }

      } 
    }
    }

    public function update_staff_reduise($id){
      if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {   
             $config['upload_path']='./uploads/staff/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message_staff']='<div class="alert alert-danger text-center"> MODIFICATION AVEC SUCCES SANS CHANGEMENT DE PHOTO</div>';

         $this->Model->update("staff",array("ID_STAFF"=>$id),array("NOM"=>$_POST['nom'],"PRENOM"=>$_POST['prenom'],"POST"=>$_POST['post'],"FACEBOOK"=>$_POST['face'],'HISTORIQUE'=>$_POST['historique'],"TWITTER"=>$_POST['twitter']));
         $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un membre du staff ","USER_ID"=>$this->session->userdata('ID')));
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/staff/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/staff/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

          $this->Model->update("staff",array("ID_STAFF"=>$id), array("NOM"=>$_POST['nom'],"PRENOM"=>$_POST['prenom'],"POST"=>$_POST['post'],"FACEBOOK"=>$_POST['face'],"TWITTER"=>$_POST['twitter'],'HISTORIQUE'=>$_POST['historique'],"FOTO"=>$new_name."_thumb.".$ext));
          $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un membre du staff ","USER_ID"=>$this->session->userdata('ID')));

        $data['message_staff']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url());
       }else{
        $this->Model->update("staff",array("ID_STAFF"=>$id), array("NOM"=>$_POST['nom'],"PRENOM"=>$_POST['prenom'],"POST"=>$_POST['post'],"FACEBOOK"=>$_POST['face'],"TWITTER"=>$_POST['twitter'],'HISTORIQUE'=>$_POST['historique'],"FOTO"=>$new_name."_thumb.".$ext));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un membre du staff ","USER_ID"=>$this->session->userdata('ID')));
          $data['message_staff']='<div class="alert alert-danger text-center"> MODIFICATION AVEC SUCCES SANS FOTO</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
       }

      }
    }
    }

        public function delete_staff($id){
          if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {   
          $service=$this->Model->getOne('staff',array('ID_STAFF'=>$id));

        $path=FCPATH."uploads/staff/".$service['FOTO'];
      unlink($path);
      $this->Model->delete('staff',array('ID_STAFF'=>$id));
      $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer un membre du staff ","USER_ID"=>$this->session->userdata('ID')));
      $data['message_staff']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url("qui_sommes_nous/Leadership"));
    }
  }


    public function add_noeud(){
      if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {   
         $config['upload_path']='./uploads/chef/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message_noeud']='<div class="alert alert-danger text-center"> Echec !! Veuillez ajouter une photo</div>';
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Leadership"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/chef/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/chef/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->create("noeud_service", array("APPELATION"=>$_POST['appelation'],"NOM_RESPONSABLE"=>$_POST['nom'],"PRENOM_RESPONSABLE"=>$_POST['prenom'],"TELEPHONE"=>$_POST['tel'],"EMAIL"=>$_POST['email'],"NIVEAU"=>$_POST['niveau'],"MERE_ID"=>$_POST['mere'],"AJOUTER_PAR"=>$this->session->userdata('ID'),"FOTO"=>$new_name."_thumb.".$ext));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter un noeud ".$_POST['appelation']." de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));

        $data['message_noeud']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url()."#chart_div");
       }else{
         $data['message_noeud']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
        $this->session->set_flashdata($data);
         redirect(base_url("qui_sommes_nous/Leadership"));
       }

      } 
    }
    }
}
?>