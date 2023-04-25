<?php 
 /**
  * 
  */
 class Rapport_vente_text extends CI_Controller
 {
   
  function __construct()
  {
    parent::__construct();
    // $this->load->library('Mylibrary');
    $this->ci = & get_instance();
    // $this->ci->load->library("user_agent");
    $this->Is_Connected();

    }

  public function Is_Connected()
       {

       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
  }

  public function index($typ='1',$p='1',$dt='',$dt1=''){

      $data = array();
      $data['stitle']='Accueil';
    // RAPPORT REQUISITI

    if($dt&&!$dt1){
      $condition=" AND DATE_TIME LIKE '%".$dt."%' ";
    }else if($dt&&$dt1){
      $condition=" AND DATE_TIME>= '".$dt."' and DATE_TIME<='".$dt1."'";
    }else $condition='';

if($typ>0){
      $condition_type=" and ID_CATEGORIE_PRODUIT=".$typ." ";
    }else  $condition_type='';
   $tabledata=array();
       $i=1;

    // $query_pro=$this->Model->getRequete("SELECT* from saisie_produit pro order by NOM_PRODUIT LIMIT 100");

    if($p==1){
     $query=$this->Model->getRequete("SELECT NOM_PRODUIT,(select SUM(PRIX_UNITAIRE) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")m,(select count(ID_VENTE_DETAIL) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")q from saisie_produit pro where (select count(*) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")>0 ".$condition_type." order by NOM_PRODUIT ");
    }else if($p==2){
      $query=$this->Model->getRequete("SELECT NOM_PRODUIT,(select SUM(PRIX_UNITAIRE) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")m,(select count(ID_VENTE_DETAIL) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")q from saisie_produit pro where (select count(*) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")=0 ".$condition_type." order by NOM_PRODUIT ");
    }else
    $query=$this->Model->getRequete("SELECT NOM_PRODUIT,(select SUM(PRIX_UNITAIRE) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")m,(select count(ID_VENTE_DETAIL) from vente_detail where ID_PRODUIT=pro.ID_PRODUIT and `ID_VENTE`>0 AND ID_SOCIETE=".$this->session->userdata('STRAPH_ID_SOCIETE').$condition.")q from saisie_produit pro where 1 ".$condition_type." order by NOM_PRODUIT ");


    
  foreach ($query as $key){


     $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['m'];
              $point[]=$key['q'];
              
              

               $tabledata[]=$point;
               $i++;
  }

  $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','MONTANT TOTAL','QUATITE VENDUE'));


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
        $this->load->view('Rapport_vente_text_views',$data);
  }

}