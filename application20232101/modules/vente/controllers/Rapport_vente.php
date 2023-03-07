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

  public function index($date=''){



    // RAPPORT VENTE

if($date){
      $condition_req=" AND DATE_REQUISITION <= '".$date."' ";
      $condition_p=" AND DATE_TIME <= '".$date."' ";
      $condition_v=" AND DATE_TIME_VENTE <= '".$date."' ";
    }else {
      $condition_req='';
      $condition_p='';
      $condition_v='';
    }

$resultat=$this->Model->getRequete("");
// print_r($resultat); exit();
$infos='';

foreach ($resultat as $value) {
  $infos.='{name: "'.$value['NOM_PRODUIT'].'",y:'.$value['NOMBRE'].', drilldown: "'.$value['NOM_PRODUIT'].'"},';
}
$infos.="|";

$data['infos'] =str_replace(",|", "", $infos);
$data['num_pro'] =(count($resultat)*30)+200;

 // FIN RAPPORT VENTE

    // RAPPORT REQUISITION

    if($date){
      $condition=" AND DATE_REQUISITION LIKE '%".$date."%' ";
    }else $condition='';


 
    $query_pro=$this->Model->getRequete("SELECT* from saisie_produit pro order by NOM_PRODUIT ");
    $query=$this->Model->getRequete("SELECT* from saisie_produit pro where ID_PRODUIT in(SELECT ID_PRODUIT FROM req_requisition WHERE 1 ".$condition.") order by NOM_PRODUIT ");

    
    $products="";
    $requisition_m="";
    $requisition_q="";
    $q_entre="";
    $q_n_entre="";

    $montant_t=0;
    $qt_t=0;
    
if(count($query)>0){
  $data['nombre'] =(count($query)*100)+200;
  
  foreach ($query as $key){

    $query_m=$this->Model->getRequeteOne("SELECT sum(MONTANT_TOTAL_ACHAT) as m from req_requisition req where ID_PRODUIT=".$key["ID_PRODUIT"].$condition);
    $query_q=$this->Model->getRequeteOne("SELECT sum(QUANTITE) as q from req_requisition req where ID_PRODUIT=".$key["ID_PRODUIT"].$condition);
    $query_q_entre=$this->Model->getRequeteOne("SELECT count(ID_BARCODE) as q from req_barcode req where ID_PRODUIT=".$key["ID_PRODUIT"]);
    $query_q_non_entre=$query_q['q']-$query_q_entre['q'];

    // print_r($query_m);
    $products.="'".$key['NOM_PRODUIT']."',";
    $montant_t+=$query_m['m'];
    $requisition_m.=$query_m['m'].",";
    $requisition_q.=$query_q['q'].",";
    $q_entre.=$query_q_entre['q'].",";
    $q_n_entre.=$query_q_non_entre.",";
    $qt_t+=$query_q['q'];
  }

  $products.="|";
  $requisition_m.="|";
  $requisition_q.="|";
  $q_entre.="|";
  $q_n_entre.="|";



}else{
  $data['nombre'] =(count($query_pro)*30)+200;

  foreach ($query_pro as $key){
    $products.="'".$key['NOM_PRODUIT']."',";

    $requisition_m.="0,";
    $requisition_q.="0,";
    $q_entre.="0,";
    $q_n_entre.="0,";
  }
  $products.="|";
  $requisition_m.="|";
  $requisition_q.="|";
  $q_entre.="|";
  $q_n_entre.="|";

}
// echo $products;
// exit();

$products=str_replace(",|","",$products);
$products=str_replace("|","",$products);
$requisition_m=str_replace(",|","",$requisition_m);
$requisition_q=str_replace(",|","",$requisition_q);
$q_entre=str_replace(",|","",$q_entre);
$q_n_entre=str_replace(",|","",$q_n_entre);

    $data['products'] =$products;
    $data['requisition_m'] =$requisition_m;
    $data['requisition_q'] =$requisition_q;
    $data['q_entre'] =$q_entre;
    $data['q_n_entre'] =$q_n_entre;
    $data['montant_t'] =$montant_t;
    $data['qt_t'] =$qt_t;
    $data['date1'] =$date;
    // print_r($q_n_entré);
    // echo$qt_t;
    // exit();


    // FIN RAPPORT REQUISITION

    // RAPPORT STOCK

if($date){
      $condition_req=" AND DATE_REQUISITION <= '".$date."' ";
      $condition_p=" AND DATE_TIME <= '".$date."' ";
      $condition_v=" AND DATE_TIME_VENTE <= '".$date."' ";
    }else {
      $condition_req='';
      $condition_p='';
      $condition_v='';
    }

$resultat=$this->Model->getRequete("SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT  ".$condition_req.")-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT ".$condition_v.")-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT ".$condition_p.")-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT ".$condition_p.")) as NOMBRE  FROM saisie_produit p ORDER BY NOM_PRODUIT");
// print_r($resultat); exit();
$infos='';

foreach ($resultat as $value) {
  $infos.='{name: "'.$value['NOM_PRODUIT'].'",y:'.$value['NOMBRE'].', drilldown: "'.$value['NOM_PRODUIT'].'"},';
}
$infos.="|";

$data['infos'] =str_replace(",|", "", $infos);
$data['num_pro'] =(count($resultat)*30)+200;

// echo $infos;  exit();  
        $this->load->view('Rapport_Vente_view',$data);
  }

}