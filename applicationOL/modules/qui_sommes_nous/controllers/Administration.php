<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller
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


        $noeud_service=$this->Model->getRequete("SELECT* from noeud_service order by NIVEAU ASC ");

        $data_from_to="";
        $node="";
        foreach ($noeud_service as  $value) {
    
            $sous=$this->Model->getRequete("SELECT* from noeud_service where MERE_ID=".$value['ID']." order by NIVEAU ASC");
            if ($value['MERE_ID']==0) {
                $m='';
            }else $m=$value['MERE_ID'];

            $gestion="";

            if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
                $del="<a href=\"#\" data-toggle=\"modal\" data-target=\"#delete_noeud".$value['ID']."\"><i class=\"lnr lnr-trash\" style=\"color: red\"></i></a>";
                if ($value['MERE_ID']==0) {
                    $del="";
                }
                $gestion="<a href=\"#\" data-toggle=\"modal\" data-target=\"#ajouter_noeud".$value['ID']."\">+</a><a href=\"#\" data-toggle=\"modal\" data-target=\"#update_noeud".$value['ID']."\"><i class=\"lnr lnr-pencil\"></i></a>".$del;
            }

            // $mere=$this->Model->getOne("noeud_service",array("ID"=>$value['MERE_ID']));
          $data_from_to.="[{'v':'".$value['ID']."', 'f':'<b style=\"color:black\">".$value['APPELATION']."</b><div style=\"color:red; font-style:italic\">".$gestion."</div>'},'".$m."', '".$value['APPELATION']."'],";
            // foreach ($sous as $key) {

            //  // [{'v':'Mike', 'f':'Mik<div style="color:red; font-style:italic"><a href="mm.html">President</a><img src="img.jpg"></div>'},'', 'The President']
            //  $data_from_to.="[{'v':'".$key['APPELATION']."', 'f':'Mik<div style=\"color:red; font-style:italic\"><a href=\"mm.html\">President</a><img src=\"img.jpg\"></div>'},'".$value['APPELATION']."', 'The President']";
            //  $data_from_to.="['".$value['APPELATION']."','".$key['APPELATION']."'],";
            // }
            
        }
        $node=$node."|";
        $data_from_to=$data_from_to."|";
        $nodes=str_replace(",|", "", $node);
        $data_from_tos=str_replace(",|", "", $data_from_to);
        // echo $data_from_tos;exit();

$datas['data_from_to'] = $data_from_tos;
 $noeud=$this->Model->getList("noeud_service");
$datas['noeud'] = $noeud;
        $datas['error'] = "";
            $this->load->view('Administration_View', $datas);

    }
        public function delete_noeud($id){
if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') { 
      $this->Model->delete('noeud_service',array('ID'=>$id));
      $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer un noeud de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));
      $data['message_staff']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url("qui_sommes_nous/Administration"));
}
    }

 //    public function add_noeud(){
 //         $config['upload_path']='./uploads/chef/';
 //    $config['allowed_types']='*';
 //    $this->load->library('upload',$config);
 //    $this->upload->initialize($config);
    
    
 // if (!$this->upload->do_upload('fotos')) {

 //          $data['message_noeud']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS BONNEE</div>';
 //        //   echo $_POST['titre'];exit();
 //        $this->session->set_flashdata($data);
 //        redirect(base_url("qui_sommes_nous/Administration"));
 //      }else { 


        
 //        // echo $uploadedImage['file_name'];exit();
 //        $uploadedImage = $this->upload->data();
 //       if($this->resizeImage('./uploads/chef/'.$uploadedImage['file_name'])){
 //        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
 //        $path=FCPATH."uploads/chef/".$uploadedImage['file_name'];
 //        unlink($path);


 //        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

 //        $this->Model->create("noeud_service", array("APPELATION"=>$_POST['appelation'],"NOM_RESPONSABLE"=>$_POST['nom'],"PRENOM_RESPONSABLE"=>$_POST['prenom'],"TELEPHONE"=>$_POST['tel'],"EMAIL"=>$_POST['email'],"NIVEAU"=>$_POST['niveau'],"MERE_ID"=>$_POST['mere'],"AJOUTER_PAR"=>$this->session->userdata('ID'),"FOTO"=>$new_name."_thumb.".$ext));

 //        $data['message_noeud']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
 //        $this->session->set_flashdata($data);
 //        redirect(base_url("qui_sommes_nous/Administration"));
 //       }else{
 //         $data['message_noeud']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
 //        $this->session->set_flashdata($data);
 //         redirect(base_url("qui_sommes_nous/Administration"));
 //       }

 //      } 
 //    }

      public function add_noeud(){
     $config['upload_path']='./uploads/chef/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {
          $appelation=str_replace("'", "\'", $_POST['appelation']);
          $this->Model->create("noeud_service", array("APPELATION"=>$appelation,"NIVEAU"=>$_POST['niveau'],"MERE_ID"=>$_POST['mere'],"AJOUTER_PAR"=>$this->session->userdata('ID')));
          $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter un noeud ".$appelation." de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));

      $data['message_noeud']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
    $this->session->set_flashdata($data);
        //   echo $_POST['titre'];exit();
    $this->session->set_flashdata($data);
      redirect(base_url("qui_sommes_nous/Administration"));
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
      redirect(base_url("qui_sommes_nous/Administration"));
       }else{
         $data['message_noeud']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
    $this->session->set_flashdata($data);
       redirect(base_url("qui_sommes_nous/Administration"));
       }

      } 
  }


    public function update_noeud($id){
      if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') { 
                 $config['upload_path']='./uploads/chef/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          // $data['message_noeud']='<div class="alert alert-danger text-center"> ENREGISTEMENT MAIS FOTO N\'EST PAS BONNEE</div>';
   $data['message_noeud']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        //   echo $_POST['titre'];exit();
            $this->Model->update("noeud_service",array("ID"=>$id), array("APPELATION"=>$_POST['appelation'],"AJOUTER_PAR"=>$this->session->userdata('ID')));
            $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un noeud ".$_POST['appelation']." de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Administration"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/chef/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/chef/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->update("noeud_service",array("ID"=>$id), array("APPELATION"=>$_POST['appelation'],"NOM_RESPONSABLE"=>$_POST['nom'],"PRENOM_RESPONSABLE"=>$_POST['prenom'],"TELEPHONE"=>$_POST['tel'],"EMAIL"=>$_POST['email'],"AJOUTER_PAR"=>$this->session->userdata('ID'),"FOTO"=>$new_name."_thumb.".$ext));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un noeud ".$_POST['appelation']." de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));

        $data['message_noeud']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("qui_sommes_nous/Administration"));
       }else{
         $data['message_noeud']='<div class="alert alert-danger text-center"> ENREGISTEMENT MAIS FOTO N\'EST PAS UPLOADER</div>';
        $this->session->set_flashdata($data);
        $this->Model->update("noeud_service",array("ID"=>$id), array("APPELATION"=>$_POST['appelation'],"NOM_RESPONSABLE"=>$_POST['nom'],"PRENOM_RESPONSABLE"=>$_POST['prenom'],"TELEPHONE"=>$_POST['tel'],"EMAIL"=>$_POST['email'],"NIVEAU"=>$_POST['niveau'],"AJOUTER_PAR"=>$this->session->userdata('ID')));
        $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier ".$_POST['appelation']." de l'organinigramme ","USER_ID"=>$this->session->userdata('ID')));
         redirect(base_url("qui_sommes_nous/Administration"));
       }

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

}
?>