<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

  public function index()
  {
    $information=$this->Model->getRequete('SELECT ID_FACTURE, NOM_ASSURANCE, MOIS,DATE_INSERTION,STATU FROM facture JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE=facture.ID_ASSURANCE WHERE 1');
    $data['data']=$information;
    $this->load->view("Facture_View",$data);
  }

  public function Insert() 
  {
    $data['assurance']=$this->Model->getRequete('SELECT ID_ASSURANCE,NOM_ASSURANCE FROM `saisie_assurance`  WHERE 1');

    $ID_ASSURANCE=$this->input->post("ID_ASSURANCE");
    $MOIS=$this->input->post("MOIS");

    $new_name = time();
    $config = array(
      'upload_path' => "uploads/facture/",
      'allowed_types' => "*",
    );
    $this->load->library('upload', $config);

    $this->upload->initialize($config);

    if ($this->upload->do_upload('FILES')) {

      $image = $this->upload->data('file_name');
    }else $image ='non';
$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
$file_name = $upload_data['file_name'];

$this->form_validation->set_rules('ID_ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
$this->form_validation->set_rules('MOIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));


if(!isset($_FILES['FILES']) || empty($_FILES['FILES']['name']))
{
  $this->form_validation->set_rules('FILES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
}
if ($this->form_validation->run() == false) {
# code...
  $this->add();
}else{
  $data_insert = array(

    'ID_ASSURANCE'=> $ID_ASSURANCE,
    'MOIS'=> $MOIS,
    'FILES'=> $image,
  );

  $table='facture';                

  $check = $this->Model->getOne($table,$data_insert);

  if(!empty($check))
  {

    $data['message'] = '<div class="text-center  alert-success " id="message" style="color:#007bac">'."La culture/filière  existe déjà".'</div>';

    $this->session->set_flashdata($data);

    $this->add();
  }else
  {
    $create=$this->Model->create($table,$data_insert);

    if($create) {
      $data['message']='<div class="text-center alert-success " id="message" style="color:#007bac">Enregistrement éffectuée avec succes</div>';
      $this->session->set_flashdata($data);
      redirect(base_url('facture/Facture/'));
    }else
    {
      $message['message']='<div class="text-center  alert-danger " id="message" style="color:#007bac">Enregistrement échouée</div>';
      $this->session->set_flashdata($data);
      $this->add();
    }
  }

  $this->Model->create($table,$data_insert);
  $data['message']='<div class="alert alert-success text-center" id="message">'."Enrengistrement effectuée avec succès".'</div>';
  $this->session->set_flashdata($data);
  redirect(base_url('facture/Facture/'));
}
}

function add()
{
  $data['title'] = 'Enregistrement de culture/filière';
  $this->load->view('Facture_Insert',$data);
}


public function reactiver($ID_FACTURE)
{
  $this->Model->update('facture',array('ID_FACTURE'=>$ID_FACTURE),array('STATU'=>1));
  $message = "<div class='alert alert-success' id='message'>
  Utilisateur Réactivé avec succés
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  </div>";
  $this->session->set_flashdata(array('message'=>$message));
  redirect(base_url('facture/Facture'));  
}
public function desactiver($ID_FACTURE)
{
  $this->Model->update('facture',array('ID_FACTURE'=>$ID_FACTURE),array('STATU'=>0));
  $message = "<div class='alert alert-success' id='message'>
  Utilisateur désactivé avec succés
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  </div>";
  $this->session->set_flashdata(array('message'=>$message));
  redirect(base_url('facture/Facture'));  
}

























function updating($ID_FACTURE)
{
 $info=$this->Model->getOne("facture", array("ID_FACTURE"=>$ID_FACTURE));
 $data['data']=$info;

 $cat=$this->Model->getList("saisie_assurance");
 $data['categ']=$cat;

 $this->load->view('Facture_Update', $data);

}

public function update()
{
  $ID_FACTURE=$this->input->post('ID_FACTURE');
  $ID_ASSURANCE=$this->input->post('ID_ASSURANCE');
  $MOIS=$this->input->post('MOIS');
  
  if (!empty($_FILES["FILES"]["tmp_name"])) {
    $FILES=$this->upload_filee('FILES');
  }else{
    $FILES=$this->do_upload('FILES');
  }


  $this->form_validation->set_rules('ID_ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
  $this->form_validation->set_rules('MOIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

  if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
    Utilisateur non modifi&eacute; de cong&eacute; non enregistr&eacute;
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['data']=$this->Model->getRequeteOne('SELECT * FROM `facture` WHERE ID_FACTURE = '.$ID_FACTURE.'');

    $cat=$this->Model->getList("saisie_assurance");
    $data['categ']=$cat;

    $this->load->view('Facture_Update',$data);
  }
  else{

    $datasuser=array(
     'ID_ASSURANCE'=>$ID_ASSURANCE,
     'MOIS'=>$MOIS,
     'FILES'=>$FILES,
   );
    print_r($datasuser);die(); 
    $this->Model->update('facture',array('ID_FACTURE'=>$ID_FACTURE),$datasuser);  
    
    $message = "<div class='alert alert-success' id='message'>
    Utilisateur modifi&eacute; avec succés
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
    $this->session->set_flashdata(array('message'=>$message));
    redirect(base_url('facture/Facture'));  
  }


}

function getOne($ID_FACTURE)
{
  $data['title']="Modification d'une culture/filière";
  $facture=$this->Model->getRequeteOne('SELECT ID_FACTURE, NOM_ASSURANCE, MOIS,DATE_INSERTION,STATU,FILES FROM facture JOIN saisie_assurance ON saisie_assurance.ID_ASSURANCE=facture.ID_ASSURANCE WHERE ID_FACTURE='.$ID_FACTURE);
  $data['data']=$facture;
        //echo json_encode(array('info'=>$data));
  $this->load->view('Facture_Update',$data);

}


function upload_filee($input_name)
{
  $nom_file = $_FILES[$input_name]['tmp_name'];
  $nom_champ = $_FILES[$input_name]['name'];
  $repertoire_fichier = FCPATH . 'uploads/facture/';
  $code = uniqid();
  $ext=explode('.',$nom_file);
       // print_r($ext);die();
  $fichier = basename($code.$ext[1]).'.xlsx';

  if (!is_dir($repertoire_fichier)) {
    mkdir($repertoire_fichier, 0777, TRUE);
  }
  move_uploaded_file($nom_file, $repertoire_fichier . $fichier);
  return $fichier;
}


}