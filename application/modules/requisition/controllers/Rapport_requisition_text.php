<?php 
 /**
  * 
  */
 class Rapport_requisition_text extends CI_Controller
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

  public function index($typ='',$p='',$dt='',$dt1=''){

      $data = array();
      $data['stitle']='Accueil';
    // RAPPORT REQUISITION

    if($dt&&!$dt1){
      $condition=" AND DATE_REQUISITION LIKE '%".$dt."%' ";
    }else if($dt&&$dt1){
      $condition=" AND DATE_REQUISITION>= '".$dt."' and DATE_REQUISITION<='".$dt1."'";
    }else $condition='';

if($typ>0){
      $condition_type=" and ID_CATEGORIE_PRODUIT=".$typ." ";
    }else  $condition_type='';
   $tabledata=array();
       $i=1;

    // $query_pro=$this->Model->getRequete("SELECT* from saisie_produit pro order by NOM_PRODUIT LIMIT 100");

    if($p==1){
     $query=$this->Model->getRequete("SELECT* from saisie_produit pro where ID_PRODUIT in(SELECT ID_PRODUIT FROM req_requisition WHERE 1  AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")".$condition_type." order by NOM_PRODUIT ");
    }else if($p==2){
      $query=$this->Model->getRequete("SELECT* from saisie_produit pro where ID_PRODUIT not in(SELECT ID_PRODUIT FROM req_requisition WHERE 1  AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")".$condition_type." order by NOM_PRODUIT ");
    }else
    $query=$this->Model->getRequete("SELECT* from saisie_produit pro where 1 ".$condition_type." order by NOM_PRODUIT ");

    
    $products="";
    $requisition_m="";
    $requisition_q="";
    $q_entre="";
    $q_n_entre="";

    $montant_t=0;
    $qt_t=0;

  $data['nombre'] =(count($query)*30)+200;
  
  foreach ($query as $key){

    $query_m=$this->Model->getRequeteOne("SELECT sum(MONTANT_TOTAL_ACHAT) as m from req_requisition req where ID_PRODUIT=".$key["ID_PRODUIT"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_q=$this->Model->getRequeteOne("SELECT sum(QUANTITE) as q from req_requisition req where ID_PRODUIT=".$key["ID_PRODUIT"]." AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_q_entre=$this->Model->getRequeteOne("SELECT count(ID_BARCODE) as q from req_barcode req JOIN req_requisition req1 ON req.ID_REQUISITION=req1.ID_REQUISITION where req.ID_PRODUIT=".$key["ID_PRODUIT"]." AND req.ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition);
    $query_q_non_entre=$query_q['q']-$query_q_entre['q'];
$pro=str_replace("'", "\'", $key['NOM_PRODUIT']);
    // print_r($query_m);
    $products.="'".$pro."',";
    $montant_t+=$query_m['m'];
    $requisition_m.=$query_m['m'].",";
    $requisition_q.=$query_q['q'].",";
    $q_entre.=$query_q_entre['q'].",";
    $q_n_entre.=$query_q_non_entre.",";
    $qt_t+=$query_q['q'];

     $point=array();
              $point[]=$i;
              $point[]=$pro;
              $point[]=$query_m['m'];
              $point[]=$query_q['q'];
              $point[]=$query_q_entre['q'];
              $point[]=$query_q_non_entre;
              
              

               $tabledata[]=$point;
               $i++;
  }

  $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','MONTANT TOTAL','QUATITE REQUISITIONNE','QUATITE SCANNEE','QUATITE NON SCANNEE'));


  $products.="|";
  $requisition_m.="|";
  $requisition_q.="|";
  $q_entre.="|";
  $q_n_entre.="|";



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
    $data['p'] =$p;
    $data['dt'] =$dt;
    $data['dt1'] =$dt1;
    $data['typ'] =$typ;
    // print_r($q_n_entré);
    // echo$qt_t;
    // exit();


    // FIN RAPPORT REQUISITION

$data['titl']="Situation du ". date('d-m-Y');
                $data['points']=$tabledata;

// echo $infos;  exit();  
        $this->load->view('Rapport_requisition_text_views',$data);
  }

}