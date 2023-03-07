<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offres extends CI_Controller
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
 
    $this->db->select("*");
    //filte
    $this->db->where(array("EXPIRATION>"=>date("Y-m-d H:i:s")));
    $this->db->order_by('ID','DESC');
     $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $query =$this->db->get('emploi','10',$segment);
    $datas['emploi']=$query->result();
    $datas['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('emploi');

    $total=$this->Model->getList('emploi',array("EXPIRATION>"=>date("Y-m-d H:i:s")));

    $config=array();
    $config['base_url']=base_url()."opportunite/Offres/index";
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
            $this->load->view('Offres_View', $datas);

    }

      public function pagination(){
    
  }

  public function edit(){
      $id=$_POST['id'];

    $info=$this->Model->getOne('Emploi',array('ID'=>$id));
    // echo $id;

    echo $info['TITRE']."|".$info['DESCRIPTION']."|".$info['PIECE_JOINTE']."|".$info['EXPIRATION'];

  }
  public function ajout(){
        $titre=$_POST['titre'];
    $description=$_POST['description'];
    $expiration=$_POST['date'];

  $config['upload_path']='./uploads/emploi/';
    
        $config['allowed_types']='pdf';
        // $config['max_width']="1024";
        // $config['max_height']="786";
        $this->load->library('upload',$config);
    
    $this->upload->initialize($config);

        // if($this->upload->do_upload('pj')){
    $this->upload->do_upload('pj');
$data=array('upload_data'=>$this->upload->data());
      date_default_timezone_set('Africa/Bujumbura');

if (!empty($expiration)) {
 $this->Model->create('emploi',array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'EXPIRATION'=>$expiration,'PIECE_JOINTE'=>$data['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> La publication est enregistré avec succès</div>';
}else{

             $data['message']='<div class="alert alert-danger text-center"> Echec!! veuillez choisir la date d\'expiration de publication</div>';
}
      
    
    $this->session->set_flashdata($data);
  redirect(base_url('opportunite/Offres'));
//   }else{
// $data['message']='<div class="alert alert-danger text-center"> Echec! verifier votre piece jointe si c\'est du PDF</div>';
    
//     $this->session->set_flashdata($data);
//   redirect(base_url('opportunite/Offres'));
//   }
  }
     
     public function modifier(){
        $id=$_POST['id'];
        $titre=$_POST['titre1'];
    $description=$_POST['description1'];
    $expiration=$_POST['date1'];

  $config['upload_path']='./uploads/emploi/';
    
        $config['allowed_types']='pdf';
        // $config['max_width']="1024";
        // $config['max_height']="786";
        $this->load->library('upload',$config);
    
    $this->upload->initialize($config);

        if($this->upload->do_upload('pj1')){
$data=array('upload_data'=>$this->upload->data());
      date_default_timezone_set('Africa/Bujumbura');
 $emploi=$this->Model->getOne('emploi',array('ID'=>$id));


      $this->Model->update('emploi',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'EXPIRATION'=>$expiration,'PIECE_JOINTE'=>$data['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
      $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une publication d'emploie","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Modification avec succès</div>';

             if (!empty($emploi['PIECE_JOINTE'])) {
     $path=FCPATH. "uploads/emploi/".$emploi['PIECE_JOINTE'];
    unlink($path);
  }
    $this->session->set_flashdata($data);
  redirect(base_url('opportunite/Offres'));
  }else{
     $this->Model->update('emploi',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'EXPIRATION'=>$expiration,'AJOUTER_PAR'=>$this->session->userdata('ID')));

     $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une publication d'emploie","USER_ID"=>$this->session->userdata('ID')));

$data['message']='<div class="alert alert-success text-center">Modification avec succès</div>';
    
    $this->session->set_flashdata($data);
  redirect(base_url('opportunite/Offres'));
  } 
     }
      public function delete($id){
if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {  
$emploi=$this->Model->getOne('emploi',array('ID'=>$id));
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer une publication d'emploie","USER_ID"=>$this->session->userdata('ID')));

    $this->Model->delete('emploi',array('ID'=>$id));
    $data['message']='<div class="alert alert-success text-center"> Suppréssion avec succès</div>';
    
    if (!empty($emploi['PIECE_JOINTE'])) {
    $path=FCPATH. "uploads/emploi/".$emploi['PIECE_JOINTE'];
    unlink($path); 
  }
    
    $this->session->set_flashdata($data);
  redirect(base_url('opportunite/Offres'));
}
  }
  public function recherche_emploi(){
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
   $this->db->or_like('EXPIRATION', $date->format('Y-m-d')); 
    $this->db->or_like('TITRE', $mot_cle);
    $this->db->or_like('DESCRIPTION', $mot_cle);
    
    $this->db->order_by('ID','DESC');
     $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $query =$this->db->get('emploi','10',$segment);
    $data['emploi']=$query->result();
    $data['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('emploi');

     $total=$this->Model->getList('emploi',array("EXPIRATION>"=>date("Y-m-d H:i:s")));

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

    $this->load->view('Recherche_emploi_view',$data);
  }
}
?>