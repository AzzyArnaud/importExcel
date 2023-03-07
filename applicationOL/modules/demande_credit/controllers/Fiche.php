<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiche extends CI_Controller
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

    public function groupements($type=''){
                 $fiche=$this->Model->getRequete('SELECT r.*,NOM,PRENOM,TELEPHONE from fiche_credit r left join utilisateur u on r.FAIT_PAR=u.ID WHERE TYPE='.$type);
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();
      foreach ($fiche as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        $date=date_create($val['DATE']);
        $data=Null;
        // $data[]=date_format($date,"d-m-Y H:i");;
        $data[]=$val['TITRE'];
        $data[]='<a href="'.base_url().'uploads/fiche_credit/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("demande_credit/Fiche/update/").$val["ID"].'/'.$type.'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
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
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('demande_credit/Fiche/delete/'.$val["ID"].'/'.$type). "'>Supprimer</a>
                                                    <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
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
        $this->table->set_heading('FICHES','FICHIER A TELECHARGER','AJOUTER PAR','ACTION');
      }else
       $this->table->set_heading('FICHES','FICHIER A TELECHARGER');
        $this->table->set_template($template);
        
    $datas['type']=$type;
    $datas['table']=$resultat;
    $datas['profil']=$profil;
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
   
            $this->load->view('Fiche_View', $datas);

    }

  public function add($type){
            $titre=$_POST['titre'];
 $config['upload_path']='./uploads/fiche_credit/';
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
$this->Model->create('fiche_credit',array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'TYPE'=>$type,'FAIT_PAR'=>$this->session->userdata('ID')));
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter une fiche de crédit","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
                $data['message']='<div class="alert alert-danger text-center"> Echec d\'uploader le fichier</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('demande_credit/Fiche/groupements/'.$type));
        
  }

   public function update($id,$type){

    $getOne=$this->Model->getOne('fiche_credit',array("ID"=>$id));
                 $fiche=$this->Model->getRequete('SELECT r.*,NOM,PRENOM,TELEPHONE from fiche_credit r left join utilisateur u on r.FAIT_PAR=u.ID WHERE TYPE='.$type);
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();
      foreach ($fiche as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        $date=date_create($val['DATE']);
        $data=Null;
        // $data[]=date_format($date,"d-m-Y H:i");;
        $data[]=$val['TITRE'];
        $data[]='<a href="'.base_url().'uploads/fiche_credit/'.$val['FILE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['FILE'].'</a>';
if($this->session->userdata('PROFIL')){
        $data[]=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE'];        
        // $data[]='<i style="color:red" class="fas fa-trash-alt"></i>'

                 $data['option']='<div class="dropdown ">
                    <a class="btn btn-light active  btn-sm dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-left">';
        

        // $data['option'].='<li><a href='.base_url("zone/Zone_localisation/details/").$localisation["LOCALISATION_ID"].'>Détails</li>'; 
         $data['option'].='<li style="text-align:center"><a href='.base_url("demande_credit/Fiche/update/").$val["ID"].'/'.$type.'><span class="lnr lnr-pencil"style="text-alin:center"></li>';
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
                                                    <a class='btn btn-danger btn-md ' href='" . base_url('demande_credit/Fiche/delete/'.$val["ID"].'/'.$type). "'>Supprimer</a>
                                                    <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
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
        $this->table->set_heading('FICHES','FICHIER A TELECHARGER','AJOUTER PAR','ACTION');
      }else
       $this->table->set_heading('FICHES','FICHIER A TELECHARGER');
        $this->table->set_template($template);
        
    $datas['type']=$type;
    $datas['table']=$resultat;
    $datas['profil']=$profil;
    $datas['getOne']=$getOne;
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();

    $this->load->view('Fiche_update_View', $datas);
   
   }

         public function delete($id,$type){

$rapport=$this->Model->getOne('fiche_credit',array('ID'=>$id));
$path=FCPATH. "uploads/fiche_credit/".$rapport['FILE'];
      unlink($path);

    $this->Model->delete('fiche_credit',array('ID'=>$id));
    $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Supprimer une fiche de crédit","USER_ID"=>$this->session->userdata('ID')));
    
    $data['message']='<div class="alert alert-success text-center"> Suppréssion avec succès</div>';
  
    $this->session->set_flashdata($data);
  redirect(base_url('demande_credit/Fiche/groupements/'.$type));
  }

    public function modifier($id,$type){
            $titre=$_POST['titre'];
 $config['upload_path']='./uploads/fiche_credit/';
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
$this->Model->update('fiche_credit',array("ID"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'FILE'=>$file_name,'TYPE'=>$type,'FAIT_PAR'=>$this->session->userdata('ID')));
$this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une fiche de crédit","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }else{
               $this->Model->update('fiche_credit',array("ID"=>$id),array('TITRE'=>$titre,'DATE'=>date('Y-m-d H:i:s'),'TYPE'=>$type,'FAIT_PAR'=>$this->session->userdata('ID')));
               $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Modifier une fiche de crédit","USER_ID"=>$this->session->userdata('ID')));
             $data['message']='<div class="alert alert-success text-center"> Enregistrement avec succès</div>';
              }
$this->session->set_flashdata($data);
  redirect(base_url('demande_credit/Fiche/groupements/'.$type));
        
  }
}
?>