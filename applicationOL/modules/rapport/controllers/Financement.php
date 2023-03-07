<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financement extends CI_Controller
{
	
	function __construct()
	{
		 parent::__construct();
        // $this->is_Oauth();
      
	}
    public function is_Oauth()
    {
       if($this->session->userdata('USERNAME') == NULL)
        redirect(base_url('rapport/Financement'));
    }

    public function index(){

             $rapport=$this->Model->getRequete('SELECT* from financement r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID_RAPPORT DESC');
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();
      foreach ($rapport as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        $date=date_create($val['DATE']);
        $data=Null;
        $data[]=date_format($date,"d-m-Y H:i");;
        $data[]=$val['TITRE'];
        $data[]='<a href="'.base_url('rapport/Financement').'uploads/rapport/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("rapport/Financement/update/").$val["ID_RAPPORT"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
        $data['option'].="<li style='text-align:center'><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" .$val["ID_RAPPORT"]. "'><span class='lnr lnr-trash' style='color:red'></span></a></li></ul>
                  </div>
                                    <div class='modal fade' id='mydelete" .$val["ID_RAPPORT"]. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Voulez-vous vraiment supprimer?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('rapport/Financement/delete/'.$val["ID_RAPPORT"]). "'>Supprimer</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
              }    
       $resultat[]=$data;
          // }
    }
 
    $template=array(
        'table_open'=>'<table id="mytable" class="table  table-striped table-bordered ">',
        '<table_close'=>'</table>'
        );
      if($this->session->userdata('PROFIL')){
        $this->table->set_heading('DATE','TITRE DU RAPPORT','FICHIER A TELECHARGER','AJOUTER PAR','action');
      }else
       $this->table->set_heading('DATE','TITRE DU RAPPORT','FICHIER A TELECHARGER');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['profil']=$profil;
    $id=$this->session->userdata('ID');

     $services=$this->Model->getList("financement_type");
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
    $datas['services'] = $services;
   
        $datas['error'] = "";
            $this->load->view('Financement_View', $datas);

    }

      public function add(){
        $titre=$_POST['titre'];
 $config['upload_path']='./uploads/rapport/';
    $config['allowed_types']='*';
    // $this->load->library('upload',$config,'upload_pieceJointe');
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    // $this->upload_pieceJointe->initialize($config);
 if ($this->upload->do_upload('pj')) {
    # code...

      $upload_data = $this->upload->data(); 
$file_name = $upload_data['file_name'];

      date_default_timezone_set('Africa/Bujumbura');

// $data1=array('upload_data'=>$this->upload_pieceJointe->data());
$this->Model->create('financement',array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'FAIT_PAR'=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
                $data['message']='<div class="alert alert-danger text-center"> Echec d\'uploader le fichier</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Financement'));
        
    }
      public function delete($id){

$rapport=$this->Model->getOne('financement',array('ID_RAPPORT'=>$id));
$path=FCPATH. "uploads/rapport/".$rapport['FILE'];
      unlink($path);

    $this->Model->delete('financement',array('ID_RAPPORT'=>$id));
    $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer un rapport de financement","USER_ID"=>$this->session->userdata('ID')));
    
    $data['message']='<div class="alert alert-success text-center"> Suppréssion avec succès</div>';
  
    $this->session->set_flashdata($data);
  redirect(base_url('rapport/Financement'));
  }
  public function update($id){
              $rapport=$this->Model->getRequete('SELECT* from financement r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID_RAPPORT DESC');
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();
      foreach ($rapport as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        $date=date_create($val['DATE']);
        $data=Null;
        $data[]=date_format($date,"d-m-Y H:i");;
        $data[]=$val['TITRE'];
        $data[]='<a href="'.base_url('rapport/Financement').'uploads/rapport/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("rapport/Financement/update/").$val["ID_RAPPORT"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
        $data['option'].="<li style='text-align:center'><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" .$val["ID_RAPPORT"]. "'><span class='lnr lnr-trash' style='color:red'></span></a></li></ul>
                  </div>
                                    <div class='modal fade' id='mydelete" .$val["ID_RAPPORT"]. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Voulez-vous vraiment supprimer?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('rapport/Financement/delete/'.$val["ID_RAPPORT"]). "'>Supprimer</a>
                                                    <button class='btn btn-primary btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
              }    
       $resultat[]=$data;
          // }
    }
 
    $template=array(
        'table_open'=>'<table id="mytable" class="table  table-striped table-bordered ">',
        '<table_close'=>'</table>'
        );
      if($this->session->userdata('PROFIL')){
        $this->table->set_heading('DATE','TITRE DU RAPPORT','FICHIER A TELECHARGER','AJOUTER PAR','action');
      }else
       $this->table->set_heading('DATE','TITRE DU RAPPORT','FICHIER A TELECHARGER');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;

    $rapport=$this->Model->getOne("financement",array("ID_RAPPORT"=>$id));
    $datas['profil']=$profil;
    $datas['rapport']=$rapport;
    $id=$this->session->userdata('ID');
    $services=$this->Model->getList("financement_type");
$datas['services'] = $services;
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   
    $this->load->view('Financement_View1',$datas);
  }

  public function modifier($id){
            $titre=$_POST['titre'];
 $config['upload_path']='./uploads/rapport/';
    $config['allowed_types']='*';
    // $this->load->library('upload',$config,'upload_pieceJointe');
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    // $this->upload_pieceJointe->initialize($config);
 if ($this->upload->do_upload('pj')) {
    # code...
    $rapport=$this->Model->getOne('financement',array('ID_RAPPORT'=>$id));
$path=FCPATH. "uploads/rapport/".$rapport['FILE'];
      unlink($path);


      $upload_data = $this->upload->data(); 
$file_name = $upload_data['file_name'];

      date_default_timezone_set('Africa/Bujumbura');

// $data1=array('upload_data'=>$this->upload_pieceJointe->data());
$this->Model->update('financement',array("ID_RAPPORT"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'FAIT_PAR'=>$this->session->userdata('ID')));
    $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un rapport de financement","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
                $this->Model->update('financement',array("ID_RAPPORT"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FAIT_PAR'=>$this->session->userdata('ID')));
                    $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un rapport de financement","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Financement'));
  }

  public function ajout_reduise(){

     $config['upload_path']='./uploads/financement_type/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS BONNEE</div>';
        //   echo $_POST['titre'];exit();
    $this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
      }else { 


        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/financement_type/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
    $path=FCPATH."uploads/financement_type/".$uploadedImage['file_name'];
      unlink($path);
      $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->create("financement_type", array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],"FOTO"=>$new_name."_thumb.".$ext));
            $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter un rapport de financement","USER_ID"=>$this->session->userdata('ID')));

      $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
    $this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
    $this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
       }

      } 
  }
  public function update_reduise($id){

     $config['upload_path']='./uploads/financement_type/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
 if (!$this->upload->do_upload('fotos')) {

          $this->Model->update("financement_type",array("ID"=>$id),array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description']));

   $data['message']='<div class="alert alert-success text-center"> Modification avec succèssss</div>';
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Financement'));
    $this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
      }else { //financement_type


        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/financement_type/'.$uploadedImage['file_name'])){
        $image=$this->Model->getOne("financement_type",array("ID"=>$id));
        $path1=FCPATH."uploads/financement_type/".$image['FOTO'];
      unlink($path1);
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
    $path=FCPATH."uploads/financement_type/".$uploadedImage['file_name'];
      unlink($path);
      $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->update("financement_type",array("ID"=>$id),array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description'],'FOTO'=>$new_name."_thumb.".$ext));

   $data['message']='<div class="alert alert-success text-center"> Modification avec succès</div>';
$this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> MODIFICATION AVEC SUCCES MAIS FOTO N\'EST PAS UPLOADER</div>';
         $this->Model->update("financement_type",array("ID"=>$id),array("TITRE"=>$_POST['titre'],"DESCRIPTION"=>$_POST['description']));
    $this->session->set_flashdata($data);
      redirect(base_url('rapport/Financement'));
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
  redirect(base_url('rapport/Financement'));
  }else{
    return true;
    $this->image_lib->clear();
  }

   // var_dump(gd_info());
    $this->image_lib->clear();

   }

  public function delete_type($id){
      $service=$this->Model->getOne('financement_type',array('ID'=>$id));

        $path=FCPATH."uploads/financement_type/".$service['FOTO'];
      unlink($path);
      $this->Model->delete('financement_type',array('ID'=>$id));
      $data['message']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Financement'));
  }


}
?>