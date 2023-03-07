<?php 
 /**
  * 
  */
 class Rapport_vente_par_utilisateur extends CI_Controller
 {
   
  function __construct()
  {
    parent::__construct();
    $this->load->library('Mylibrary');
    $this->ci = & get_instance();
    $this->ci->load->library("user_agent");
    $this->Is_Connected();

    }

  public function Is_Connected()
       {

       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
  }

  public function index($dt='.'){

      $data = array();
      $data['stitle']='Accueil';
    // RAPPORT REQUISITION

    if($dt){
      $condition=" AND DATE_TIME_VENTE LIKE '%".$dt."%' ";
    }else  $condition='';


   $tabledata=array();
       $i=1;

   
    $query=$this->Model->getRequete("SELECT* from config_user  where 1 order by NOM");

    
    $products="";
    $requisition_m="";
    $requisition_q="";
    $q_entre="";
    $q_n_entre="";

    $montant_t=0;
    $montant_p=0;
    $montant_r=0;
    $montant_a=0;
    $qt_t=0;

  $data['nombre'] =(count($query)*30)+200;
  
  $date_array=array();
  foreach ($query as $key){
// echo $i;
$query_m=$this->Model->getRequeteOne("SELECT sum(MONTANT_TOTAL) as m from vente_vente req where ID_USER_VENDEUR=".$key["ID_USER"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_p=$this->Model->getRequeteOne("SELECT sum(MONTANT_PAYE) as m from vente_vente req where ID_USER_VENDEUR=".$key["ID_USER"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_remise_assurance=$this->Model->getRequeteOne("SELECT sum(vr.MONTANT_REMISE) as m from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where ID_ASSURANCE is not null and ID_USER_VENDEUR=".$key["ID_USER"]." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_remise_autre=$this->Model->getRequeteOne("SELECT sum(vr.MONTANT_REMISE) as m from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where ID_ASSURANCE is null and ID_USER_VENDEUR=".$key["ID_USER"]." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);

  $query_caisse=$this->Model->getRequete("SELECT DISTINCT CAST(DATE_TIME_VENTE AS DATE) as dt from vente_vente v where ID_USER_VENDEUR=".$key["ID_USER"]." AND CAST(DATE_TIME_VENTE AS DATE) not in (SELECT DATE from vente_caisse_utilisateur where ID_USER=".$key["ID_USER"].")");

  // print_r($query_caisse);
  // echo "<br

  foreach ($query_caisse as $val) {
    if(!in_array($val['dt'], $date_array))
    $date_array[]=$val['dt'];
  }
$nom=str_replace("'", "\'", $key['NOM']);
$pre=str_replace("'", "\'", $key['PRENOM']);
   
    $montant_t+=round($query_m['m']);
    $montant_p+=round($query_m_p['m']);
    $montant_r+=round($query_m_remise_assurance['m']);
    $montant_a+=round($query_m_remise_autre['m']);
    
    $mont=$this->Model->getOne("vente_caisse_utilisateur",array("ID_USER"=>$key["ID_USER"],"DATE"=>$dt));

    if($mont){
      $excdent=$mont['MONTANT_CAISSE']>$query_m_p['m']?$mont['MONTANT_CAISSE']-$query_m_p['m']:'';
      $manq=$mont['MONTANT_CAISSE']<$query_m_p['m']?$mont['MONTANT_CAISSE']-$query_m_p['m']:'';
    }else{
      $excdent='';
      $manq='';
    }

if($query_caisse){
  $nam="<span style='color:red'>".$nom." ".$pre."(".$key['USERNAME'].")</span>";
}else $nam="".$nom." ".$pre."(".$key['USERNAME'].")";
$css=$mont?$mont['MONTANT_CAISSE']:'';
     $point=array();
              $point[]=$i++;
              $point[]=$nam;
              $point[]=$query_m_p['m'];
              $point[]=$mont?$mont['MONTANT_CAISSE']:'';
              $point[]=$excdent;
              $point[]=$manq;
              $point[]="<div class='modal fade' id='desactcat".$key["ID_USER"]."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'></h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                           <h6></h6>
                           <form action=".base_url('vente/Rapport_vente_par_utilisateur/Save_caisse/').$key["ID_USER"]."/".$dt." method='POST'>
                              <div class='row'>
                                

                                <div class='form-group col-lg-12'>
                                  <label for='exampleInputEmail1'>Montant caisse de ".$nom." ".$pre."(".$key['USERNAME'].") du ".$dt."</label>
                                  <input type='number' name='montant' class='form-control' id='montant' value='".$mont['MONTANT_CAISSE']."'/>
                                  <button type='submit' class='btn btn-success btn-block'>Enregistrer</button>
                                </div>
                                

                              </div>
                            </form>
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                           <a href='' class='btn '></a>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class='modal fade' id='printer".$key["ID_USER"]."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'></h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body' id='print".$key["ID_USER"]."'>
                           <b>Rapport vente de ".$nom." ".$pre."(".$key['USERNAME'].") du ".$dt."</b>

                           <table style='width:100%'>
                           <tr><td>MONTANT SYSTEME</td><th>".$query_m_p['m']."</th></tr>
                           <tr><td>MONTANT CAISSE</td><th>".$css."</th></tr>
                           <tr><td>EXCEDENT</td><th>".$excdent."</th></tr>
                           <tr><td>MANQANT </td><th>".$manq."</th></tr>
                           </table>
                           
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                           <a href='' class='btn '></a>
                         </div>
                       </div>
                     </div>
                   </div>
                   
                             <div class='dropdown '>
                                       <a class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       
                                       <li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#desactcat".$key["ID_USER"]."'> Montant caisse </a> </li>

                                       <li onclick='printDiv(".$key["ID_USER"].")'><a class='dropdown-item' href='#' data-toggle='modal' data-target='#printer".$key["ID_USER"]."'> Imprimer </a> </li>
                                       </ul>
                                     </div>";
              
              

               $tabledata[]=$point;
               // $i++;
  }

  $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed"  data-display-length="-1">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','UTILISATEUR','MONTANT SYSTEME','MONTANT CAISSE','EXCEDENT','MANQANT','OPTION'));


    $data['requisition_m'] =$requisition_m;
    $data['requisition_q'] =$requisition_q;
    $data['q_entre'] =$q_entre;
    $data['q_n_entre'] =$q_n_entre;
    $data['montant_t'] =$montant_t;
    $data['qt_t'] =$qt_t;
    $data['dt'] =$dt;
    // print_r($q_n_entré);
    // echo$qt_t;
    // exit();


    // FIN RAPPORT REQUISITION

$data['titl']="Situation du ". date('d-m-Y');
                $data['points']=$tabledata;
                $data['date_array']=$date_array;


// echo $infos;  
                // exit();  
        $this->load->view('Rapport_vente_par_utilisateur_views',$data);
  }
public function Save_caisse($id,$date){
  $mont=$this->input->post("montant");

  $check=$this->Model->getOne("vente_caisse_utilisateur",array("ID_USER"=>$id,"DATE"=>$date));

  if($check){
    $this->Model->update("vente_caisse_utilisateur",array("ID_USER"=>$id,"DATE"=>$date),array("MONTANT_CAISSE"=>$mont,"ENVOIE"=>0));
  }else{
    $this->Model->create("vente_caisse_utilisateur",array("ID_USER"=>$id,"DATE"=>$date,"MONTANT_CAISSE"=>$mont));
  }

$message = "<div class='alert alert-success' id='message'>
                            Utilisateur enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('vente/Rapport_vente_par_utilisateur/index/'.$date)); 
}



}