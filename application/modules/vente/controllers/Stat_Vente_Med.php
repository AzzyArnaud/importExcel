<?php 
 /**
  * 
  */
 class Stat_Vente_Med extends CI_Controller
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

  public function index(){



 
     $DATE = $this->input->post('DATE');
     $DATE1=$this->input->post('DATE1');
     $TYPES=$this->input->post('TYPES');
     $NOMBRE=$this->input->post('NOMBRE');
     $BIF_NOMBRE=$this->input->post('BIF_NOMBRE');

      if($DATE1){
            $condition1=" AND vente_vente.DATE_TIME_VENTE >= '".$DATE."' AND vente_vente.DATE_TIME_VENTE <= '".$DATE1."' ";
        }else{
          if($DATE){
            $condition1=" AND vente_vente.DATE_TIME_VENTE LIKE '%".$DATE."%' ";
          }
          else $condition1='';
        }

        
        if($TYPES){
          if($TYPES == 1){
            $condition2="DESC";
          }
          else{
            $condition2="ASC";
          }
            
        }else{
            $condition2="DESC";
        }


        if($NOMBRE){
            $condition3=" LIMIT ".$NOMBRE."";
            $data['NOMBRE'] =$NOMBRE;
        }else{
            $condition3=" LIMIT 10";
            $data['NOMBRE'] =10;
        }



        if($BIF_NOMBRE){
          if($BIF_NOMBRE == 1){
            $condition4="COUNT(vente_detail.ID_PRODUIT)";
            $data['types'] ='Nombre';
            $data['mes'] ='pieces';
          }
          else{
            $condition4="SUM(vente_detail.PRIX_UNITAIRE)";
            $data['mes'] ='BIF';
            $data['types'] ='Montant';
          }
            
        }else{
            $condition4="COUNT(vente_detail.ID_PRODUIT)";
            $data['types'] ='Nombre';
            $data['mes'] ='pieces';
        }
        
    
    $data_med=$this->Model->getRequete("SELECT DISTINCT(vente_detail.ID_PRODUIT), ".$condition4." AS NUMBERS, saisie_produit.NOM_PRODUIT FROM `vente_detail`JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE JOIN saisie_produit ON saisie_produit.ID_PRODUIT = vente_detail.ID_PRODUIT WHERE 1 ".$condition1." GROUP BY vente_detail.ID_PRODUIT, saisie_produit.NOM_PRODUIT ORDER BY NUMBERS ".$condition2." ".$condition3."");
    $all_vente=$this->Model->getRequeteOne("SELECT ".$condition4." AS NUMBERS FROM `vente_detail`JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE JOIN saisie_produit ON saisie_produit.ID_PRODUIT = vente_detail.ID_PRODUIT WHERE 1 ".$condition1."");


    $categories1 = '';
    $categories2 = '';
    $nombres ='';
    $tot_select =0;
    foreach ($data_med as $med) {
      $nom=str_replace("'", "\'", $med['NOM_PRODUIT']);
      $categories1.="'".$nom."',";
      $nombres.=round($med['NUMBERS']).",";
      $tot_select += round($med['NUMBERS']);



      // $users=$this->Model->getRequete("SELECT DISTINCT(vente_vente.ID_USER_VENDEUR), config_user.NOM, config_user.PRENOM FROM vente_vente JOIN config_user ON config_user.ID_USER = vente_vente.ID_USER_VENDEUR");

      // foreach ($users as $use) {
      //   $nom_phar=str_replace("'", "\'", $use['NOM']);
      //   $pre_phar=str_replace("'", "\'", $use['PRENOM']);
      //   $categories2.="'".$nom_phar." ".$pre_phar."',";
      //   $vente_user=$this->Model->getRequeteOne("SELECT SUM(vente_detail.ID_PRODUIT) AS NOMBRE_PRO, vente_vente.ID_USER_VENDEUR FROM vente_detail JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE WHERE vente_detail.ID_PRODUIT =".$med['ID_PRODUIT']." AND vente_vente.ID_USER_VENDEUR = ".$use['ID_USER_VENDEUR']." ");
      // //   // exit();
      // }

      
      




    }
    $categories1.="|";
    $categories1=str_replace(",|","",$categories1);
    $data['categories1'] =$categories1;
    $nombres.="|";
    $nombres=str_replace(",|","",$nombres);
    $data['nombres'] =$nombres;
    $data['tot_select'] = $tot_select;
    $data['not_select'] = $all_vente['NUMBERS'] - $tot_select;

    $categories2.="|";
    $categories2=str_replace(",|","",$categories2);
    $data['categories2'] =$categories2;
    




    
    
    $users="";
    $vente_m="";

    $montant_p=0;
    $qt_t=0;
    


  $users.="|";
  $vente_m.="|";




// echo $products;
// exit();

$users=str_replace(",|","",$users);
$vente_m=str_replace(",|","",$vente_m);


    $data['users'] =$users;
    $data['vente_m'] =$vente_m;
    $data['montant_p'] =$montant_p;
    $data['qt_t'] =$qt_t;
    $data['DATE'] =$DATE;
    $data['DATE1'] =$DATE1;
    $data['TYPES'] =$TYPES;
    
    $data['BIF_NOMBRE'] =$BIF_NOMBRE;






$infos='';

$infos.="|";

$data['infos'] =str_replace(",|", "", $infos);
$data['num_pro'] =0;


$infos_c='';

$data['infos_c'] =$infos_c;
$data['num_c'] =0;


  //FIN RAPPORT VENTE REDUCTION



$data['$dt'] =$DATE;
// echo $infos; 
 // exit();  
        $this->load->view('Stat_Vente_Med_View',$data);
  }

}