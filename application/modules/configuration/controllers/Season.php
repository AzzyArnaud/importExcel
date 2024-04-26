<?php
class Season  extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->Is_Connected();

      }

      public function Is_Connected()
       {
       if (empty($this->session->userdata('STRAPH1_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

        


  
    public function index()
    {

      $data['title']='Saison';
      $data['profil']=$this->Model->getRequete('SELECT * FROM `Saison` order by ID_SAISON');
      $this->load->view('User_Add_View',$data);

    }



    public function add()
    {

  $YEAR=$this->input->post('YEAR');
  $SEASON_NAME=$this->input->post('SEASON_NAME');
  $SART_MONTH=$this->input->post('SART_MONTH');
  $END_MONTH=$this->input->post('END_MONTH');
  $saison;
  if($SEASON_NAME == 1){
    $saison="Saison A";
  }elseif($SEASON_NAME == 2){
     $saison='Saison B';
      }elseif($SEASON_NAME == 3){
      $saison="Saison C";
     }
  $this->form_validation->set_rules('YEAR', 'Annee', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('SEASON_NAME', 'Nom saison', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('SART_MONTH', 'Commencement du saison', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('END_MONTH', 'Fin du saison', 'required',array('required'=>'le champs  est  obligatoire!!'));

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Saison non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    // $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Saison';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `saison` order by ID_SAISON');
    $this->load->view('includes/saison_add_view',$data);
   }
   else{

    $datasuser=array(
                       'YEAR'=>$YEAR,
                       'SEASON_NAME'=>$saison,
                       'SART_MONTH'=>$SART_MONTH,
                       'END_MONTH'=>$END_MONTH
                      
                      );
                      
    $this->Model->insert_last_id('saison',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Saison enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Season/listing'));  
   }

    }

    

    public function listing()
    {
      

      $data['resultat']=$this->Model->getRequete('SELECT * from saison');
      $tabledata=array();
      

      $data['title']='Saison';
      $this->load->view('includes/season_list_view',$data);

    }



    public function index_update($id)
    {

      $data['title']='Saison';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saison` WHERE ID_SAISON = '.$id.'');
      $this->load->view('includes/season_Update_View',$data);

    }



    public function update()
    {

      $YEAR=$this->input->post('YEAR');
      $SEASON_NAME=$this->input->post('SEASON_NAME');
      $SART_MONTH=$this->input->post('SART_MONTH');
      $END_MONTH=$this->input->post('END_MONTH');
      $ID_USER=$this->input->post('ID_USER');
      $saison;
      if($SEASON_NAME == 1){
        $saison="Saison A";
      }elseif($SEASON_NAME == 2){
         $saison='Saison B';
          }elseif($SEASON_NAME == 3){
          $saison="Saison C";
         }
      $this->form_validation->set_rules('YEAR', 'Annee', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('SEASON_NAME', 'Nom Saison', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('SART_MONTH', 'Commencent Du Mois', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('END_MONTH', 'FIN Mois', 'required',array('required'=>'le champs  est  obligatoire!!'));
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Saison non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Saison';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `saison` WHERE ID = '.$ID_USER.'');
        $this->load->view('includes/season_Update_View',$data);
       }
       else{
    
        $datasuser=array(
                           'YEAR'=>$YEAR,
                           'SEASON_NAME'=>$saison,
                           'SART_MONTH'=>$SART_MONTH,
                           'END_MONTH'=>$END_MONTH,
                          );
                          
        $this->Model->update('saison',array('ID_SAISON'=>$ID_USER),$datasuser); 

          redirect(base_url('configuration/Season/listing'));  
       }
    
  
    }


    public function desactiver($id)
    {
      $this->Model->update('saison',array('ID_SAISON'=>$id),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Saison désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Season/listing'));  
    }

  public function reactiver($id)
    {
      $this->Model->update('saison',array('ID_SAISON'=>$id),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Saison Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Season/listing'));  
    }

    
    


}