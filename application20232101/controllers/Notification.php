<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

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



    public function rupture()
    {
      $data = array();
      $data['stitle']='Accueil';

                
                $resultat=$this->Model->getRequete("SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT  )-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<=0 ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]="piece(s)";
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','NOMBRE','UNITE'));

             //    $data['an']=$annee;
             //  $data['ms']=$mois;
             //  $data['dt']=$date;
             //  $data['titl']="Ventes (". $dt.")";
             //  $data['annee'] =$this->Model->getRequete("SELECT DISTINCT YEAR(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by `DATE`");
             // $data['mois'] =$this->Model->getRequete("SELECT DISTINCT MONTH(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by MONTH(`DATE`)");
             // $data['jour'] =$this->Model->getRequete("SELECT DISTINCT DAY(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by DAY(`DATE`)");
$data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;


      $this->load->view('Rupture_View',$data);
    }

    public function Seuil()
    {
      $data = array();
      $data['stitle']='Accueil';

                
                $resultat=$this->Model->getRequete("SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))>0 AND ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<10  ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]="piece(s)";
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','NOMBRE','UNITE'));

             //    $data['an']=$annee;
             //  $data['ms']=$mois;
             //  $data['dt']=$date;
             //  $data['titl']="Ventes (". $dt.")";
             //  $data['annee'] =$this->Model->getRequete("SELECT DISTINCT YEAR(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by `DATE`");
             // $data['mois'] =$this->Model->getRequete("SELECT DISTINCT MONTH(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by MONTH(`DATE`)");
             // $data['jour'] =$this->Model->getRequete("SELECT DISTINCT DAY(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by DAY(`DATE`)");
$data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;


      $this->load->view('Seuil_View',$data);
    }



    public function peremption()
    {
      $data = array();
      $data['stitle']='Accueil';
$today=date("Y-m-d");

                
                $resultat=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$today."'");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['BARCODE'];
              $point[]=$key['DATE_PERAMPTION'];
              // $point[]="piece(s)";
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','BARCODE','PEREMPTION'));

             //    $data['an']=$annee;
             //  $data['ms']=$mois;
             //  $data['dt']=$date;
             //  $data['titl']="Ventes (". $dt.")";
             //  $data['annee'] =$this->Model->getRequete("SELECT DISTINCT YEAR(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by `DATE`");
             // $data['mois'] =$this->Model->getRequete("SELECT DISTINCT MONTH(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by MONTH(`DATE`)");
             // $data['jour'] =$this->Model->getRequete("SELECT DISTINCT DAY(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by DAY(`DATE`)");
$data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;

// exit();
      $this->load->view('Peremption_View',$data);
    }


    public function peremption_day()
    {
      $data = array();
      $data['stitle']='Accueil';
$today=date("Y-m-d");
$date = new DateTime($today); // Y-m-d
$date->add(new DateInterval('P30D'));
$new_date=$date->format('Y-m-d');
                
                $resultat=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date."' and DATE_PERAMPTION>='".$today."'");


       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['BARCODE'];
              $point[]=$key['DATE_PERAMPTION'];
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','BARCODE','PEREMTION'));

             //    $data['an']=$annee;
             //  $data['ms']=$mois;
             //  $data['dt']=$date;
             //  $data['titl']="Ventes (". $dt.")";
             //  $data['annee'] =$this->Model->getRequete("SELECT DISTINCT YEAR(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by `DATE`");
             // $data['mois'] =$this->Model->getRequete("SELECT DISTINCT MONTH(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by MONTH(`DATE`)");
             // $data['jour'] =$this->Model->getRequete("SELECT DISTINCT DAY(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by DAY(`DATE`)");
$data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;

// exit();
      $this->load->view('Peremption_day_View',$data);
    }  
      


    public function peremption_day_180()
    {
      $data = array();
      $data['stitle']='Accueil';
$today=date("Y-m-d");
$date = new DateTime($today); // Y-m-d
$date->add(new DateInterval('P30D'));
$new_date=$date->format('Y-m-d');

$date1 = new DateTime($today); // Y-m-d
$date1->add(new DateInterval('P180D'));
$new_date1=$date1->format('Y-m-d');
                $resultat=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date1."' and DATE_PERAMPTION>='".$new_date."'");


       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['BARCODE'];
              $point[]=$key['DATE_PERAMPTION'];
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','BARCODE','PEREMTION'));

             //    $data['an']=$annee;
             //  $data['ms']=$mois;
             //  $data['dt']=$date;
             //  $data['titl']="Ventes (". $dt.")";
             //  $data['annee'] =$this->Model->getRequete("SELECT DISTINCT YEAR(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by `DATE`");
             // $data['mois'] =$this->Model->getRequete("SELECT DISTINCT MONTH(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by MONTH(`DATE`)");
             // $data['jour'] =$this->Model->getRequete("SELECT DISTINCT DAY(`DATE`) as DATE FROM `vente` WHERE 1 ORDER by DAY(`DATE`)");
$data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;

// exit();
      $this->load->view('peremption_day_180_View',$data);
    }
}
?>