<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulletin extends CI_Controller
{
	
	function __construct()
	{
		 parent::__construct();
        $this->is_Oauth();
      
	}
    public function is_Oauth()
    {
       if($this->session->userdata('USERNAME') == NULL)
        redirect(base_url());
    }

    public function index(){
                $rapport=$this->Model->getRequete('SELECT* from bulletin r left join utilisateur u on r.FAIT_PAR=u.ID order by r.ID_BULLETIN DESC');
      $profil=$this->session->userdata('PROFIL');

    $resultat=array();
      foreach ($rapport as $val) {
       // $email= $this->session->userdata('USERNAME');
       // $profil= $this->session->userdata('PROFIL');
      // if($val['USERNAME']!=$email) {
        $date=date_create($val['DATE']);
        $data=Null;
        $data['date']=date_format($date,"d-m-Y H:i");;
        $data['obtet']=$val['OBTET'];
        $data['msg']=$val['MESSAGE'];

        $list_sub=$this->Model->getRequete("SELECT* FROM bulletin_subscriber b JOIN subscriber s on b.ID_SUBSCRIBER=s.ID_SUB WHERE ID_BULLETIN=".$val["ID_BULLETIN"]);

        $tab="<table id='mytable' class='table  table-striped table-bordered '>";
        $i=1;
        foreach ($list_sub as $key) {
            $tab.="<tr><td>".$i."</td><td>".$key['EMAIL']."</td></tr>";
            $i++;
        }
        $tab.="</table>";
        
        
        $data['option']="<a href='#' data-toggle='modal' 
                                  data-target='#mydelete" .$val["ID_BULLETIN"]. "' style='color:green'>".sizeof($list_sub)."</a>
                  
                                    <div class='modal fade' id='mydelete" .$val["ID_BULLETIN"]. "'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                    ".$tab."
                                                </div>

                                                <div class='modal-footer'>
                                                   
                                                    <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
        if (!empty($val['PIECE_POINTE'])) {
          $data['pj']='<a href="'.base_url().'uploads/'.$val['PIECE_POINTE'].'" download><span class="lnr lnr-download" style="color:#266C67;font-size:16px"></span>
                '.$val['PIECE_POINTE'].'</a>';
        }else{
          $data['pj']='';
        }
        
        if($this->session->userdata('PROFIL')){
        $data['fait_par']=$val['NOM']." ".$val['PRENOM']." ".$val['TELEPHONE']; 
              }    
       $resultat[]=$data;
          // }
    }
 
    $template=array(
        'table_open'=>'<table id="mytable" class="table  table-striped table-bordered ">',
        '<table_close'=>'</table>'
        );
      if($this->session->userdata('PROFIL')){
        $this->table->set_heading('DATE','OBTET','MESSAGE','ABONNES','PIECE JOINT','AJOUTER PAR');
      }else
       $this->table->set_heading('DATE','OBTET','MESSAGE','ABONNES','PIECE JOINT');
        $this->table->set_template($template);
        
    $datas['table']=$resultat;
    $datas['profil']=$profil;
    $id=$this->session->userdata('ID');
    // $this->make_bread->add('Editer mon identification', "editer_identification/".$id, 1);
    $datas['breadcrumb'] = $this->make_bread->output();
        $datas['error'] = "";
            $this->load->view('Bulletin_View', $datas);

    }

    public function add(){
       $config['upload_path']='./uploads/';
    
        $config['allowed_types']='*';
        // $config['max_width']="1024";
        // $config['max_height']="786";
        $this->load->library('upload',$config);
    
    $this->upload->initialize($config);

        // if($this->upload->do_upload('pj')){
    $path="";
    $pj="";
    $array=array();
    if ($this->upload->do_upload('pj')) {
      $data=array('upload_data'=>$this->upload->data());
      $path='./uploads/'.$data['upload_data']['file_name'];
      $pj=$data['upload_data']['file_name'];
      array_push($array, $path);
    }


        $id=$this->Model->insert_last_id("bulletin",array("MESSAGE"=>$_POST['msg'],"OBTET"=>$_POST['titre'],'FAIT_PAR'=>$this->session->userdata('ID'),"PIECE_POINTE"=>$pj));
        $subscriber=$this->Model->getList("subscriber");

        foreach ($subscriber as $value) {
            $this->Model->create("bulletin_subscriber",array("ID_BULLETIN"=>$id,"ID_SUBSCRIBER"=>$value['ID_SUB']));
            $this->Model->create("historique_navigation",array("DESCRIPTION"=>"Ajouter une une bulletin d'information","USER_ID"=>$this->session->userdata('ID')));

             $this->email_controller->send_mail($value['EMAIL'],$_POST['titre'],array(),$_POST['msg'],$array);

              // echo $value['EMAIL'];
        }
        $data['message']='<div class="alert alert-success text-center">Bulletin électronique envoyée avec succès</div>';
        $this->session->set_flashdata($data);
        redirect(base_url("actualites/Bulletin"));
    }
}
?>