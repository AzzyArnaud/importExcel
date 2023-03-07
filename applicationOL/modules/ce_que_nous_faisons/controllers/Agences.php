<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agences extends CI_Controller
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
         $rapport=$this->Model->getRequete('SELECT r.*,u.NOM,u.PRENOM,u.TELEPHONE from agence r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID DESC');
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();

      foreach ($rapport as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        // $date=date_create($val['DATE']);
        $data=Null;
        // $data[]=date_format($date,"d-m-Y H:i");;
        $data['ADRESSE']=$val['ADRESSE'];
        if (!empty($val['FOTO'])) {
           $data['foto']="<img src='".base_url()."uploads/agence/".$val['FOTO']."' width='150'>";
        }else
        $data['foto']="";
        $data['tel']=$val['TEL'];
        // $data[]='<a href="'.base_url().'uploads/projet/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
        //         '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data['fait_par']=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("ce_que_nous_faisons/Agences/update/").$val["ID"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
        $data['option'].="<li style='text-align:center'><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" .$val["ID"]. "'><span class='lnr lnr-trash' style='color:red'></span></a></li></ul>
                  </div>
                                    <div class='modal fade' id='mydelete" .$val["ID"]. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Voulez-vous vraiment supprimer?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('ce_que_nous_faisons/Agences/delete/'.$val["ID"]). "'>Supprimer</a>
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
        $this->table->set_heading('ADRESSE','PHOTO','TELEPHONE','AJOUTER PAR','ACTION');
      }else
       $this->table->set_heading('ADRESSE','PHOTO','TELEPHONE');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['profil']=$profil;
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   
        $datas['error'] = "";
            $this->load->view('Agences_View', $datas);

    }


    public function update($id){
    $rapport=$this->Model->getRequete('SELECT* from agence r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID DESC');
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();

      foreach ($rapport as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        // $date=date_create($val['DATE']);
        $data=Null;
        // $data[]=date_format($date,"d-m-Y H:i");;
        $data['ADRESSE']=$val['ADRESSE'];
        if (!empty($val['FOTO'])) {
           $data['foto']="<img src='".base_url()."uploads/agence/".$val['FOTO']."' width='150'>";
        }else
        $data['foto']="";
        $data['tel']=$val['TEL'];
        // $data[]='<a href="'.base_url().'uploads/projet/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
        //         '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data['fait_par']=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("ce_que_nous_faisons/Agences/update/").$val["ID"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
        $data['option'].="<li style='text-align:center'><a hre='#' data-toggle='modal' 
                                  data-target='#mydelete" .$val["ID"]. "'><span class='lnr lnr-trash' style='color:red'></span></a></li></ul>
                  </div>
                                    <div class='modal fade' id='mydelete" .$val["ID"]. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    <h5>Voulez-vous vraiment supprimer?</h5>
                                                </div>

                                                <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('ce_que_nous_faisons/Agences/delete/'.$val["ID"]). "'>Supprimer</a>
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
        $this->table->set_heading('ADRESSE','PHOTO','TELEPHONE','AJOUTER PAR','ACTION');
      }else
       $this->table->set_heading('ADRESSE','PHOTO','TELEPHONE');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['profil']=$profil;

    $agence=$this->Model->getOne("agence",array("ID"=>$id));
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();

    // print_r($agence);exit();
   
        $datas['agence'] = $agence;
        $datas['error'] = "";
            $this->load->view('Agences_View1', $datas);

    }

    public function add(){
     $config['upload_path']='./uploads/agence/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center"> Enregistrement sans photo</div>';
        //   echo $_POST['titre'];exit();
          $this->Model->create("agence", array("ADRESSE"=>$_POST['ADRESSE'],"TEL"=>$_POST['tel'],'FAIT_PAR'=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/agence/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/agence/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->create("agence", array("ADRESSE"=>$_POST['ADRESSE'],"TEL"=>$_POST['tel'],"FOTO"=>$new_name."_thumb.".$ext,'FAIT_PAR'=>$this->session->userdata('ID')));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
       }else{
         $data['message']='<div class="alert alert-danger text-center"> ECHEC! FOTO N\'EST PAS UPLOADER</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
       }

      } 
    }

    public function update_agence($id){
       $config['upload_path']='./uploads/agence/';
    $config['allowed_types']='*';
    $this->load->library('upload',$config);
    $this->upload->initialize($config);
    
    
 if (!$this->upload->do_upload('fotos')) {

          $data['message']='<div class="alert alert-danger text-center">Modification sans changement de photo</div>';
          $this->Model->update("agence",array("ID"=>$id), array("ADRESSE"=>$_POST['ADRESSE'],"TEL"=>$_POST['tel'],'FAIT_PAR'=>$this->session->userdata('ID')));
        //   echo $_POST['titre'];exit();
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
      }else { 


        
        // echo $uploadedImage['file_name'];exit();
        $uploadedImage = $this->upload->data();
       if($this->resizeImage('./uploads/agence/'.$uploadedImage['file_name'])){
        $ext = pathinfo($uploadedImage['file_name'], PATHINFO_EXTENSION);
        $path=FCPATH."uploads/agence/".$uploadedImage['file_name'];
        unlink($path);


        $new_name=str_replace(".".$ext, "", $uploadedImage['file_name']);

        $this->Model->update("agence",array("ID"=>$id), array("ADRESSE"=>$_POST['ADRESSE'],"TEL"=>$_POST['tel'],"FOTO"=>$new_name."_thumb.".$ext,'FAIT_PAR'=>$this->session->userdata('ID')));

        $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
       }else{
         $data['message']='<div class="alert alert-danger text-center">FOTO N\'EST PAS UPLOADER</div>';
         $this->Model->update("agence",array("ID"=>$id), array("ADRESSE"=>$_POST['ADRESSE'],"TEL"=>$_POST['tel'],'FAIT_PAR'=>$this->session->userdata('ID')));
        $this->session->set_flashdata($data);
        redirect(base_url("ce_que_nous_faisons/Agences"));
       }

      } 
    }

        public function delete($id){
          $service=$this->Model->getOne('agence',array('ID'=>$id));

if (!empty($service['FOTO'])) {
  $path=FCPATH."uploads/agence/".$service['FOTO'];
      unlink($path);
}
        
      $this->Model->delete('agence',array('ID'=>$id));
      $data['message']='<div class="alert alert-success text-center"> Supression avec succès</div>';
$this->session->set_flashdata($data);
  redirect(base_url("ce_que_nous_faisons/Agences"));
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
