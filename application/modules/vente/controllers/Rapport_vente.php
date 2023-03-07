<?php 
 /**
  * 
  */
 class Rapport_vente extends CI_Controller
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

  public function index($date='',$date2=''){



    // RAPPORT VENT USER





if($date2){
  
      $condition=" AND DATE_TIME_VENTE >= '".$date."' AND DATE_TIME_VENTE <= '".$date2."' ";
    
  }else{
    if($date){
      $condition=" AND DATE_TIME_VENTE LIKE '%".$date."%' ";
    }else $condition='';
  }

    


 
    $query_pro=$this->Model->getRequete("SELECT* from config_user pro order by NOM ");
    $query=$this->Model->getRequete("SELECT* from config_user pro order by NOM ");

    
    $users="";
    $vente_m="";
    $vente_m_p="";
    $remise_assurence="";
    $remise_autre="";

    $montant_t=0;
    $montant_p=0;
    $montant_r=0;
    $montant_a=0;
    $qt_t=0;
    
  $data['nombre'] =(count($query)*100)+200;
  
  foreach ($query as $key){

    $query_m=$this->Model->getRequeteOne("SELECT sum(MONTANT_TOTAL) as m from vente_vente req where ID_USER_VENDEUR=".$key["ID_USER"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_p=$this->Model->getRequeteOne("SELECT sum(MONTANT_PAYE) as m from vente_vente req where ID_USER_VENDEUR=".$key["ID_USER"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_remise_assurance=$this->Model->getRequeteOne("SELECT sum(vr.MONTANT_REMISE) as m from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where ID_ASSURANCE is not null and ID_USER_VENDEUR=".$key["ID_USER"]." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_m_remise_autre=$this->Model->getRequeteOne("SELECT sum(vr.MONTANT_REMISE) as m from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where ID_ASSURANCE is null and ID_USER_VENDEUR=".$key["ID_USER"]." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
 
$nom=str_replace("'", "\'", $key['NOM']);
$pre=str_replace("'", "\'", $key['PRENOM']);
    // print_r($query_m);
    $users.="'".$nom." ".$pre."',";
    $montant_t+=round($query_m['m']);
    $montant_p+=round($query_m_p['m']);
    $montant_r+=round($query_m_remise_assurance['m']);
    $montant_a+=round($query_m_remise_autre['m']);
    

    $vente_m.=round($query_m['m']).",";
    $vente_m_p.=round($query_m_p['m']).",";
    $remise_assurence.=round($query_m_remise_assurance['m']).",";
    $remise_autre.=round($query_m_remise_autre['m']).",";
    
  }

  $users.="|";
  $vente_m.="|";
  $vente_m_p.="|";
  $remise_assurence.="|";
  $remise_autre.="|";




// echo $products;
// exit();

$users=str_replace(",|","",$users);
$vente_m=str_replace(",|","",$vente_m);
$vente_m_p=str_replace(",|","",$vente_m_p);
$remise_assurence=str_replace(",|","",$remise_assurence);
$remise_autre=str_replace(",|","",$remise_autre);


    $data['users'] =$users;
    $data['vente_m'] =$vente_m;
    $data['vente_m_p'] =$vente_m_p;
    $data['remise_assurence'] =$remise_assurence;
    $data['remise_autre'] =$remise_autre;
    $data['montant_t'] =$montant_t;
    $data['montant_p'] =$montant_p;
    $data['montant_r'] =$montant_r;
    $data['montant_a'] =$montant_a;
    $data['qt_t'] =$qt_t;
    $data['dt'] =$date;
    $data['date2'] =$date2;
    // print_r($remise_autre);
    // echo$qt_t;
    // exit();






//FIN RAPPORT VENT USER
//RAPPORT VENT ASSURANCE

$resultat=$this->Model->getRequete("SELECT ass.*, (SELECT IFNULL(SUM(vr.MONTANT_REMISE),0) from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where vr.ID_ASSURANCE=ass.ID_ASSURANCE  ".$condition." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').") as NOMBRE  FROM saisie_assurance ass WHERE 1 ORDER BY NOM_ASSURANCE");

$infos='';

foreach ($resultat as $value) {
  $pro=str_replace("'", "\'", $value['NOM_ASSURANCE']);
  if($value['NOMBRE']>0){
    $value['NOMBRE']=$value['NOMBRE'];
  }else{$value['NOMBRE']=0;}
  $infos.='{name: "'.$pro.'",y:'.$value['NOMBRE'].', drilldown: "'.$pro.'"},';
  // $infos.='{name: "jj",y:1, drilldown: "kkk"},';

  // if($value['NOMBRE']!=0)echo $value['NOMBRE'];  exit(); 
}
$infos.="|";

$data['infos'] =str_replace(",|", "", $infos);
$data['num_pro'] =(count($resultat)*30)+200;


  //FIN RAPPORT VENTE ASSURANCE


//RAPPORT VENT REDUCTION

$resultat_c=$this->Model->getRequete("SELECT ass.*, (SELECT IFNULL(SUM(vr.MONTANT_REMISE),0) from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where v.ID_CLIENT=ass.ID_CLIENT AND vr.ID_ASSURANCE IS NULL ".$condition." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').") as NOMBRE  FROM saisie_client ass WHERE ID_CLIENT IN (SELECT ID_CLIENT from vente_vente v join vente_remise vr on v.ID_VENTE=vr.ID_VENTE where v.ID_CLIENT=ass.ID_CLIENT  ".$condition." AND v.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').") ORDER BY NOM_CLIENT");

$infos_c='';

foreach ($resultat_c as $value) {
  $pro=str_replace("'", "\'", $value['NOM_CLIENT']." ".$value['PRENOM_CLIENT']."(".$value['TEL_CLIENT'].")");
  if($value['NOMBRE']>0){
    $value['NOMBRE']=$value['NOMBRE'];
  }else{$value['NOMBRE']=0;}
  $infos_c.='{name: "'.$pro.'",y:'.$value['NOMBRE'].', drilldown: "'.$pro.'"},';
  // $infos.='{name: "jj",y:1, drilldown: "kkk"},';

  // if($value['NOMBRE']!=0)echo $value['NOMBRE'];  exit(); 
}
$infos_c.="|";

$data['infos_c'] =str_replace(",|", "", $infos_c);
$data['num_c'] =(count($resultat_c)*30)+200;


  //FIN RAPPORT VENTE REDUCTION



$data['$dt'] =$date;
// echo $infos; 
 // exit();  
        $this->load->view('Rapport_Vente_view',$data);
  }

}