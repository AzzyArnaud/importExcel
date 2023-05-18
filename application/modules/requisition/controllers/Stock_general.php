<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_general extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->Is_Connected();
    }

    public function Is_Connected()
    {
       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
    }

     public function index($dt='')
    {
      $data = array();
      $data['stitle']='Accueil';

      if($dt){
        $cond=" AND DATE_TIME<='".$dt."' ";
        $condv=" AND v.DATE_TIME<='".$dt."' ";
      }else{
        $cond="";
        $condv="";
      }

                
                // $resultat=$this->Model->getRequete("SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT ".$cond.")-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT  ".$condv.")-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT ".$cond.")-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT ".$cond.")+(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_entrer_ajustement where ID_PRODUIT=p.ID_PRODUIT ".$cond.")) as NOMBRE, (SELECT MIN(PRIX_ACHAT_UNITAIRE) from req_requisition where ID_PRODUIT=p.ID_PRODUIT ".$cond.") PRIX  FROM saisie_produit p WHERE 1   ORDER BY NOM_PRODUIT LIMIT 10");

                // print_r($resultat); exit();

      //  $tabledata=array();
      //  $i=1;
      // foreach ($resultat as $key)
      //      {
             
      //         $point=array();
      //         $point[]=$i;
      //         $point[]=$key['NOM_PRODUIT'];
      //         $point[]=$key['NOMBRE']; 
      //         $point[]=$key['PRIX'];
              
              

      //          $tabledata[]=$point;
      //          $i++;
      //              }

      //           $template = array(
      //               'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
      //               'table_close' => '</table>'
      //           );
      //           $this->table->set_template($template); 
      //           $this->table->set_heading(array('#','PRODUIT','QUANTITE','PRIX D\'ACHAT'));

     $data['dt']=$dt;
      $data['titl']="Stock du ". date('d-m-Y');
                // $data['points']=$tabledata;


      $this->load->view('Stock_general_View',$data);
    }


public function get_info()
    {

if($this->input->post("DT1")){
        $cond=" AND DATE_TIME<='".$this->input->post("DT1")."' ";
        $condv=" AND v.DATE_TIME<='".$this->input->post("DT1")."' ";
      }else{
        $cond="";
        $condv="";
      }

$i = 1;
$table = "saisie_produit";
$select_column = array('ID_PRODUIT');
// $gen=$this->Model->getRequeteOne("SELECT sum(`PRIX_UNITAIRE`-IFNULL((`PRIX_UNITAIRE`*(SELECT max(POURCENTAGE_REMISE) from vente_remise where ID_VENTE=vd.ID_VENTE and ID_ASSURANCE is null))/100,0)-IFNULL((`PRIX_UNITAIRE`*(SELECT max(POURCENTAGE_REMISE) from vente_remise where ID_VENTE=vd.ID_VENTE and ID_ASSURANCE is not null))/100,0)) as n,(SELECT max(POURCENTAGE_REMISE) from vente_remise where ID_VENTE=vd.ID_VENTE) as m from vente_detail vd where ID_VENTE>0 and DATE_TIME>'2023-04-03 00:00:00'".$filtre_Date_sum);
// $env=$this->Model->getRequeteOne("SELECT SUM(DECLA_PRIX) as n from vente_detail where ID_VENTE>0 and DATE_TIME>'2023-04-03 00:00:00' ".$filtre_Date_sum);

// $query_principal = "SELECT vv.*,sc.*,vr.ID_ASSURANCE,NOM_ASSURANCE,POURCENTAGE_REMISE FROM vente_vente vv left join saisie_client sc on vv.ID_CLIENT=sc.ID_CLIENT left join vente_remise vr on vv.ID_VENTE=vr.ID_VENTE left join saisie_assurance ass on vr.ID_ASSURANCE=ass.ID_ASSURANCE where DATE_TIME_ENVOI_OBR>'2023-04-03 00:00:00' and ".$filtre_Date;
$where = !empty($_POST['search']['value']) ? 'where 1 AND ' : '';
$query_principal="SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT ".$cond.")-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT  ".$condv.")-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT ".$cond.")-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT ".$cond.")+(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_entrer_ajustement where ID_PRODUIT=p.ID_PRODUIT ".$cond.")) as NOMBRE, (SELECT MIN(PRIX_ACHAT_UNITAIRE) from req_requisition where ID_PRODUIT=p.ID_PRODUIT ".$cond.") PRIX  FROM saisie_produit p ".$where;

            $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

            $limit = 'LIMIT 0,10';


            if ($_POST['length'] != -1) {
                $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
            }
            $order_by = '';

            $order_column = array( 'NOM_PRODUIT');

            $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_PRODUIT ';

            $search = !empty($_POST['search']['value']) ? (" NOM_PRODUIT LIKE'%$var_search%' ") : '';

            $critaire = '';
            $critere_array = array();

            $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
            $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;


            $fetch_= $this->Model->datatable($query_secondaire);
            $data = array();
            $i=1;

            foreach ($fetch_ as $row) {
             
                $sub_array = array();
               
                $sub_array[] =$i ;
                $sub_array[] = $row->NOM_PRODUIT;
                $sub_array[] = $row->NOMBRE;
                $sub_array[] = $row->PRIX;
               

        $data[] = $sub_array;
        $i++;
    }

    // $output = array(
    //     "draw" => intval($_POST['draw']),
    //     "recordsTotal" => $this->Model->all_data($query_principal),
    //     "recordsFiltered" => $this->Model->filtrer($query_filter),
    //     "data" => $data
    // );
      $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->Model->count_all_data($table, $critere_array ),
            "recordsFiltered" => $this->Model->get_filtered_data($table, $select_column, $search, $critere_array, array()),
            "data" => $data
        );
    echo json_encode($output);
}
}

