<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

 public function index()
 {

  $this->load->view("Facture_Insert");

}

 //THIS IS THE FUNCTION TO LINK TO AN INSERTING PAGE AND ITS CONFIGURATIONS TO BRING DATA INTO OUR INPUTS
function inserting_page(){
  $data['assurance']=$this->Model->getRequete('SELECT ID_ASSURANCE,NOM_ASSURANCE FROM `saisie_assurance`  WHERE 1');

  $this->load->view('Facture_Insert',$data);
}



















  function upload_filee($input_name)
  {
    $nom_file = $_FILES[$input_name]['tmp_name'];
    $nom_champ = $_FILES[$input_name]['name'];
    $repertoire_fichier = FCPATH . 'uploads/facture/';
    $code = uniqid();
    $ext=explode('.',$nom_file);
       // print_r($ext);die();
    $fichier = basename($code.$ext[1]).'xlsx|xls|jpg|png';

    if (!is_dir($repertoire_fichier)) {
      mkdir($repertoire_fichier, 0777, TRUE);
    }
    move_uploaded_file($nom_file, $repertoire_fichier . $fichier);
    return $fichier;
  }

  //Ajout d'une filière
  function add()
  {
    $data['title'] = 'Enregistrement de culture/filière';
    $this->load->view('Add_Filiere_View',$data);
  }


  //form_validations
  function save()
  {

    $this->form_validation->set_rules('MOIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    $this->form_validation->set_rules('ID_ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    $this->form_validation->set_rules('ID_ASSURANCE','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));

    // if(!isset($_FILES['MOIS']) || empty($_FILES['MOIS']['name']))
    // {
    //   $this->form_validation->set_rules('MOIS','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    // }if(!isset($_FILES['FILES']) || empty($_FILES['FILES']['name']))
    // {
    //   $this->form_validation->set_rules('FILES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    // }
    if(!isset($_FILES['FILES']) || empty($_FILES['FILES']['name']))
    {
      $this->form_validation->set_rules('FILES','', 'trim|required',array('required'=>'<font style="color:red;size:2px;">Le champ est Obligatoire</font>'));
    }

    if ($this->form_validation->run() == false) {
            # code...
      $this->add();
    }else{
      
      $data_insert=array(
        
        'MOIS'=>$this->input->post('MOIS'),
        'ID_ASSURANCE'=>$this->input->post('ID_ASSURANCE'),
        'FILES'=>$this->upload_filee('FILES'),
      );    
      // print_r($data_insert);die();      
      $table='facture';                


      $check = $this->Model->getOne($table,$data_insert);
      
      if(!empty($check))
      {

        $data['message'] = '<div class="text-center  alert-success " id="message" style="color:#007bac">'."La culture/filière  existe déjà".'</div>';

        $this->session->set_flashdata($data);
        
            //redirect(base_url('filiere/Filieres/add'));
        $this->add();
      }else
      {
        $create=$this->Model->create($table,$data_insert);


        if($create)

        {
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
























}