<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actualite extends CI_Controller
{
	
	function __construct() 
	{
		 parent::__construct(); 
        // $this->is_Oauth();
           $email_User=$this->session->userdata('USERNAME');

        $this->make_bread->add('Actualités', "Actualite/read", 0);
     
        // $this->make_bread->add('Trombinoscope', "trombinoscope", 1);
     
        $this->breadcrumb = $this->make_bread->output();
      
	}
	public function index(){
 // $datas['services'] = $this->Model->getList("services");
	$actualite=$this->Model->getList('actualites');

    $datas['actualite'] =$actualite;
    
    $datas['breadcrumb'] = $this->make_bread->output();
   
    $this->load->view('Actualite_view',$datas);
	}

 public function ajout(){
 	$titre=$this->input->post('titre');
 	$description=$this->input->post('description');

  // $config['upload_path']='./uploads/actualite/';
 	
		// $config['allowed_types']='gif|jpg|png';
		// $config['max_width']="1024";
		// $config['max_height']="786";
		// $this->load->library('upload',$config,'upload_foto');
    
    // $this->upload_foto->initialize($config);
		
    $config['upload_path']='./uploads/actualite/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    // $this->upload_pieceJointe->initialize($config);
    $this->upload->initialize($config);


		// if(!$this->upload_foto->do_upload('foto')){
      // $this->upload_pieceJointe->do_upload('pj');
      $this->upload->do_upload('pj');

      date_default_timezone_set('Africa/Bujumbura');

$data1=array('upload_data'=>$this->upload->data());
$id_actualite=$this->Model->insert_last_id('actualites',array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'PIECE_JOINTE'=>$data1['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
			 $data['message']='<div class="alert alert-success text-center"> L\'actualité est enregistré avec succès</div>';
 // print_r($_FILES['foto']);exit();
   $filesCount = count($_FILES['foto']['name']);
    // print_r($filesCount);exit();
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['foto']['name'][$i];
                $_FILES['file']['type']     = $_FILES['foto']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['foto']['error'][$i];
                $_FILES['file']['size']     = $_FILES['foto']['size'][$i];
                
                // File upload configuration
                 $uploadPath = 'uploads/actualite/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $data=array('upload_data'=>$this->upload->data());
                   
      $this->Model->create('actualites_foto',array('FOTO'=>$data['upload_data']['file_name'],'ACTUALITE_ID'=>$id_actualite));
       
      }else{ $data['message']='<div class="alert alert-danger text-center"> Certaine(s) image(s) non enregistré(s)</div>';}

                } 
    $this->session->set_flashdata($data);
  redirect(base_url('actualites/Actualite/read'));
		

 }
  public function pagination(){
  	
  }

  public function read(){
    $this->load->library('pagination');
 
    $this->db->select("*");
    $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $this->db->order_by('ID','DESC');
    $query =$this->db->get('actualites','10',$segment);
    $data['actualites']=$query->result();
    $data['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('actualites');

    $total=$this->Model->getList('actualites');

    $config=array();
    $config['base_url']=base_url()."actualites/Actualite/read";
    $config['total_rows']=sizeof($total);
    $config['per_page']=10;
    $config['uri_segment']=3;
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

    $this->load->view('Actualite_view',$data);
  }

  public function edit(){
    $id=$_POST['id'];

    $info=$this->Model->getOne('actualites',array('ID'=>$id));
    // echo $id;

    echo $info['TITRE']."|".$info['DESCRIPTION']."|".$info['PIECE_JOINTE'];

  }
  public function modifier(){
    $id=$_POST['id'];
      $titre=$_POST['titre1'];
  $description=$_POST['description1'];

//   $config['upload_path']='./uploads/actualite/';
  
//     $config['allowed_types']='gif|jpg|png';
//     // $config['max_width']="1024";
//     // $config['max_height']="786";
//     $this->load->library('upload',$config,'upload_foto');
    
//     $this->upload_foto->initialize($config);
    
//     $config['upload_path']='./uploads/actualite/';
//     $config['allowed_types']='*';
//     $this->load->library('upload',$config,'upload_pieceJointe');
//     $this->upload_pieceJointe->initialize($config);

//     $actualite=$this->Model->getOne('actualites',array('ID'=>$id));

//     $download_foto=$this->upload_foto->do_upload('foto1');
//     $download_pj=$this->upload_pieceJointe->do_upload('p_j');

//     if(($download_foto)&&($download_pj)){
//     // $this->upload_pieceJointe->do_upload('p_j');
//       $data=array('upload_data'=>$this->upload_foto->data());
//       $data1=array('upload_data'=>$this->upload_pieceJointe->data());  
      
//       date_default_timezone_set('Africa/Bujumbura');

// // $data1=array('upload_data'=>$this->upload_pieceJointe->data());
//       $this->Model->update('actualites',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'FOTO'=>$data['upload_data']['file_name'],'PIECE_JOINTE'=>$data1['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
//        $data['message']='<div class="alert alert-success text-center">Modification avec succès</div>';
   
//    $path=FCPATH. "uploads/actualite/".$actualite['FOTO'];
//    $path1=FCPATH. "uploads/actualite/".$actualite['PIECE_JOINTE'];
//     unlink($path); 
//     unlink($path1); 
//     $this->session->set_flashdata($data);
//   redirect(base_url('Actualite/read'));
//     }elseif((!$download_foto)&&($download_pj)){
//       // $this->upload_pieceJointe->do_upload('p_j');
//       $data=array('upload_data'=>$this->upload_foto->data());
//       $data1=array('upload_data'=>$this->upload_pieceJointe->data());
//       // var_dump($data);exit();
//  date_default_timezone_set('Africa/Bujumbura');
//       $this->Model->update('actualites',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'PIECE_JOINTE'=>$data1['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
//        $data['message']='<div class="alert alert-success text-center">Modification avec succès</div>';
//    $path1=FCPATH. "uploads/actualite/".$actualite['PIECE_JOINTE'];
//    unlink($path1); 
//     $this->session->set_flashdata($data);
//   redirect(base_url('Actualite/read'));
//     }elseif(($download_foto)&&(!$download_pj)){
//       // $this->upload_pieceJointe->do_upload('p_j');
//       $data=array('upload_data'=>$this->upload_foto->data());
//       $data1=array('upload_data'=>$this->upload_pieceJointe->data());
//       // var_dump($data);exit();
//  date_default_timezone_set('Africa/Bujumbura');
//       $this->Model->update('actualites',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'FOTO'=>$data['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
//        $data['message']='<div class="alert alert-success text-center">Modification avec succès</div>';

//     $path=FCPATH. "uploads/actualite/".$actualite['FOTO'];
//     unlink($path);
//     $this->session->set_flashdata($data);
//   redirect(base_url('Actualite/read'));




   $config['upload_path']='./uploads/actualite/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config,'upload_pieceJointe');
    $this->upload_pieceJointe->initialize($config);


    // if(!$this->upload_foto->do_upload('foto')){
      if($this->upload_pieceJointe->do_upload('p_j')){
      $pieceJ=$this->Model->getOne('actualites',array('ID'=>$id));
      $path=FCPATH. "uploads/actualite/".$pieceJ['PIECE_JOINTE'];
        unlink($path);
        $data1=array('upload_data'=>$this->upload_pieceJointe->data());
$id_actualite=$this->Model->update('actualites',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'PIECE_JOINTE'=>$data1['upload_data']['file_name'],'AJOUTER_PAR'=>$this->session->userdata('ID')));
}else{
$id_actualite=$this->Model->update('actualites',array('ID'=>$id),array('TITRE'=>$titre,'DESCRIPTION'=>$description,'DATE'=>date('Y-m-d H:i:s'),'AJOUTER_PAR'=>$this->session->userdata('ID')));}
      date_default_timezone_set('Africa/Bujumbura');


       $data['message']='<div class="alert alert-success text-center"> Modification avec succès</div>';
       $filesCount = count($_FILES['foto1']['name']);
       // echo $filesCount;exit(); 
       if (!empty($_FILES['foto1']['name'][0])) {
         # code...
       
 // print_r($_FILES['foto']);exit();
       $ft_act=$this->Model->getList('actualites_foto',array('ACTUALITE_ID'=>$id));
       foreach ($ft_act as $key) {
         $path1=FCPATH. "uploads/actualite/".$key['FOTO'];
        unlink($path1);
       }
       $this->Model->delete('actualites_foto',array('ACTUALITE_ID'=>$id));

   $filesCount = count($_FILES['foto1']['name']);
    // print_r($filesCount);exit();
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['foto1']['name'][$i];
                $_FILES['file']['type']     = $_FILES['foto1']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['foto1']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['foto1']['error'][$i];
                $_FILES['file']['size']     = $_FILES['foto1']['size'][$i];
                
                // File upload configuration
                 $uploadPath = 'uploads/actualite/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $data=array('upload_data'=>$this->upload->data());
                   
      $this->Model->create('actualites_foto',array('FOTO'=>$data['upload_data']['file_name'],'ACTUALITE_ID'=>$id));
       
      }else{ $data['message']='<div class="alert alert-danger text-center"> Certaine(s) image(s) non enregistré(s)</div>';}

                } 

                }
    $this->session->set_flashdata($data);
  redirect(base_url('Actualite/read'));
    
  }
  public function delete($id){
    print_r($this->session->userdata('USERNAME'));

if(!empty($this->session->userdata('USERNAME'))){
$actualite=$this->Model->getList('actualites_foto',array('ACTUALITE_ID'=>$id));

foreach ($actualite as  $value) {
    if(!empty($this->session->userdata('USERNAME'))){
      $path=FCPATH. "uploads/actualite/".$value['FOTO'];
      unlink($path);
    }  
    
  
    // $path1=FCPATH. "uploads/actualite/".$actualite['FOTO'];
    
    
    // unlink($path1); 

    $this->Model->delete('actualites',array('ID'=>$id));
    $this->Model->delete('actualites_foto',array('ACTUALITE_ID'=>$id));
    $data['message']='<div class="alert alert-success text-center"> Suppréssion avec succès</div>';
  

     
    $this->session->set_flashdata($data);
  
}
$this->Model->delete('actualites',array('ID'=>$id));
redirect(base_url('actualites/Actualite/read'));
}
  }
  public function recherche_actualite(){
      $mot_cle=$this->input->post('mot_cle');

    // if($date=new DateTime($mot_cle))
    if (DateTime::createFromFormat('d/m/Y', $mot_cle) !== FALSE){
        $mot=str_replace("/","-",$mot_cle);
    $date=new DateTime($mot);
}else{
   $date=new DateTime('0-0-0-0'); 
}
    $this->load->library('pagination');
 
    $this->db->select("*");
   
    // $this->db->order_by('ID','DESC');
    $this->db->like('DATE', $date->format('Y-m-d')); 
    $this->db->or_like('TITRE', $mot_cle); 
    $this->db->or_like('DESCRIPTION', $mot_cle); 
     $segment=0;
   if ($this->uri->segment(4)) {
     $seg=$this->uri->segment(4)-1;
     $segment=$seg."0";
   }
    $query =$this->db->get('actualites','10',$segment);
    $data['actualites']=$query->result();
    $data['breadcrumb'] = $this->make_bread->output();
    // $query=$this->db->get('actualites');

    $total=$this->Model->getList('actualites');

    $config=array();
    $config['base_url']=base_url()."actualites/Actualite/read";
    $config['total_rows']=sizeof($total);
    $config['per_page']=10;
    $config['uri_segment']=3;
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

    $this->load->view('Actualite_view1',$data);
  }
}
?>