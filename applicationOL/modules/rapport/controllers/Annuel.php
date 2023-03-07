<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annuel extends CI_Controller
{
	
	function __construct()
	{
		 parent::__construct();
        // $this->is_Oauth();
         $this->breadcrumb = $this->make_bread->output();
      
	}
    public function is_Oauth()
    {
       if($this->session->userdata('USERNAME') == NULL)
        redirect(base_url());
    }

    // public function index(){
    //     $datas['error'] = "";
    //         $this->load->view('Annuel_View', $datas);

    // }
    public function index(){
          $rapport=$this->Model->getRequete('SELECT* from rapport_d_activite r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID_RAPPORT DESC');
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
        $data[]='<a href="'.base_url().'uploads/rapport/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("rapport/Annuel/update/").$val["ID_RAPPORT"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
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
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('rapport/Annuel/delete/'.$val["ID_RAPPORT"]). "'>Supprimer</a>
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
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   
   $this->load->view('Annuel_View', $datas);
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
$this->Model->create('rapport_d_activite',array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'FAIT_PAR'=>$this->session->userdata('ID')));
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter un rapport annuel","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
                $data['message']='<div class="alert alert-danger text-center"> Echec d\'uploader le fichier</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Annuel'));
        
    }
      public function delete($id){

$rapport=$this->Model->getOne('rapport_d_activite',array('ID_RAPPORT'=>$id));
$path=FCPATH. "uploads/rapport/".$rapport['FILE'];
      unlink($path);

    $this->Model->delete('rapport_d_activite',array('ID_RAPPORT'=>$id));
    $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer un rapport annuel","USER_ID"=>$this->session->userdata('ID')));
    
    $data['message']='<div class="alert alert-success text-center"> Suppréssion avec succès</div>';
  
    $this->session->set_flashdata($data);
  redirect(base_url('rapport/Annuel'));
  }
  public function update($id){
              $rapport=$this->Model->getRequete('SELECT* from rapport_d_activite r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID_RAPPORT DESC');
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
        $data[]='<a href="'.base_url().'uploads/rapport/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("rapport/Annuel/update/").$val["ID_RAPPORT"].'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
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
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('rapport/Annuel/delete/'.$val["ID_RAPPORT"]). "'>Supprimer</a>
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

    $rapport=$this->Model->getOne("rapport_d_activite",array("ID_RAPPORT"=>$id));
    $datas['profil']=$profil;
    $datas['rapport']=$rapport;
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   
    $this->load->view('Annuel_View1',$datas);
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
    $rapport=$this->Model->getOne('rapport_d_activite',array('ID_RAPPORT'=>$id));
$path=FCPATH. "uploads/rapport/".$rapport['FILE'];
      unlink($path);


      $upload_data = $this->upload->data(); 
$file_name = $upload_data['file_name'];

      date_default_timezone_set('Africa/Bujumbura');

// $data1=array('upload_data'=>$this->upload_pieceJointe->data());
$this->Model->update('rapport_d_activite',array("ID_RAPPORT"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'FAIT_PAR'=>$this->session->userdata('ID')));
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un rapport annuel","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
                $this->Model->update('rapport_d_activite',array("ID_RAPPORT"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FAIT_PAR'=>$this->session->userdata('ID')));
                $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier un rapport annuel","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('rapport/Annuel'));
  }


}
?>