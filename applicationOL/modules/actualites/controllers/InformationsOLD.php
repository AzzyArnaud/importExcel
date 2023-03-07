<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informations extends CI_Controller
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
             $this->load->library('pagination');

$info_total =$this->Model->getList('actualites_info');
foreach ($info_total as $value) {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip= $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip= $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip= $_SERVER['REMOTE_ADDR'];
    }

    $check=$this->Model->checkvalue('actualites_info_view',array('ADRESSE_IP'=>$ip,'ID_ACTUALITE'=>$value['ID']));
    if($check!=1){
       $this->Model->create('actualites_info_view',array('ADRESSE_IP'=>$ip,'ID_ACTUALITE'=>$value['ID']));

    }
}



 
    $this->db->select("*");
   
    $this->db->order_by('ID','DESC');
     $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $query =$this->db->get('actualites_info','10',$segment);
    $datas['info']=$query->result();
    $datas['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('actualites_info');

    $total=$this->Model->getList('actualites_info');

    $config=array();
    $config['base_url']=base_url()."actualites/Informations/index";
    $config['total_rows']=sizeof($total);
    $config['per_page']=10;
    $config['uri_segment']=4;
    $config['use_page_numbers']=TRUE;
    $config['full_tag_open']="<nav><ul class='pagination'>";
    $config['full_tag_close']="</ul></nav>";
    $config['first_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['first_tag_close']="</li>";
    $config['last_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['last_tag_close']="</li>";
    $config['num_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['num_tag_close']="</li>";
    $config['next_link']="&raquo;";
    $config['next_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['next_tag_close']="</li>";
    $config['prev_link']="&laquo;";
    $config['prev_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['prev_tag_close']="</li>";
    $config['cur_tag_open']="<li class='active page-item' style='padding:0px 10px 0px 10px'><span><b>";
    $config['cur_tag_close']="</span></b></li>";
    // $config['num_links']=1;

    $this->pagination->initialize($config);
        $datas['error'] = "";
      
            $this->load->view('Informations_View', $datas);

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

       public function add(){
     $config['upload_path']='./uploads/actualite/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center"> Enregistrement sans FOTO</div>';
          $this->Model->create("actualites_info", array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],'FAIT_PAR'=>$this->session->userdata('ID')));
          $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
      }else { 

        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/actualite/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/actualite/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->create("actualites_info", array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],"FOTO"=>$new_name."_thumb.".$ext,'FAIT_PAR'=>$this->session->userdata('ID')));
         $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
         $this->Model->create("actualites_info", array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],'FAIT_PAR'=>$this->session->userdata('ID')));
          $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
       }

      } 
    }

    public function update($id){
          $config['upload_path']='./uploads/actualite/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center"> Enregistrement sans FOTO</div>';
          $this->Model->update("actualites_info",array("ID"=>$id), array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],'FAIT_PAR'=>$this->session->userdata('ID')));
           $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
      }else { 

        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/actualite/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/actualite/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->update("actualites_info",array("ID"=>$id), array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],"FOTO"=>$new_name."_thumb.".$ext,'FAIT_PAR'=>$this->session->userdata('ID')));
         $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
         $this->Model->update("actualites_info",array("ID"=>$id), array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],'FAIT_PAR'=>$this->session->userdata('ID')));
          $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Informations"));
       }

      } 
    }

    public function delete($id){
 $service=$this->Model->getOne('actualites_info',array('ID'=>$id));

if (!empty($service['FOTO'])) {
            $path=FCPATH."uploads/actualite/".$service['FOTO'];
      unlink($path);
}

      $this->Model->delete('actualites_info',array('ID'=>$id));
       $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer une publication d'actualite'","USER_ID"=>$this->session->userdata('ID')));
      $data['message']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url("actualites/Informations"));
    }

      public function recherche_info(){
$mot_cle=$this->input->post('mot_cle');
      if (DateTime::createFromFormat('d/m/Y', $mot_cle) !== FALSE){
    $mot=str_replace("/","-",$mot_cle);
    $date=new DateTime($mot);
}else{
   $date=new DateTime('0-0-0-0'); 
}

    $this->load->library('pagination');
 
    $this->db->select("*");

   $this->db->like('DATE', $date->format('Y-m-d')); 
   
    $this->db->or_like('TITRE', $mot_cle);
    $this->db->or_like('DESCRIPTION', $mot_cle);
    $this->db->order_by('ID','DESC');
     $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $query =$this->db->get('actualites_info','10',$segment);
    $data['info']=$query->result();
    $data['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('actualites_info');

    $total=$this->Model->getList('actualites_info');

    $config=array();
    $config['base_url']=base_url()."Emploi/index";
    $config['total_rows']=sizeof($total);
    $config['per_page']=10;
    $config['uri_segment']=4;
    $config['use_page_numbers']=TRUE;
    $config['full_tag_open']="<nav><ul class='pagination'>";
    $config['full_tag_close']="</ul></nav>";
    $config['first_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['first_tag_close']="</li>";
    $config['last_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['last_tag_close']="</li>";
    $config['num_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['num_tag_close']="</li>";
    $config['next_link']="&raquo;";
    $config['next_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['next_tag_close']="</li>";
    $config['prev_link']="&laquo;";
    $config['prev_tag_open']="<li class='page-item' style='padding:0px 10px 0px 10px'>";
    $config['prev_tag_close']="</li>";
    $config['cur_tag_open']="<li class='active page-item' style='padding:0px 10px 0px 10px'><span><b>";
    $config['cur_tag_close']="</span></b></li>";
    // $config['num_links']=1;

    $this->pagination->initialize($config);

    $this->load->view('Recherche_info_view',$data);
  }
}
?>