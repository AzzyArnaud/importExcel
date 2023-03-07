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

     public function index($date='')
    {
      $data = array();
      $data['stitle']='Accueil';

                
                $resultat=$this->Model->getRequete("SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE, (SELECT MIN(PRIX_ACHAT_UNITAIRE) from req_requisition where ID_PRODUIT=p.ID_PRODUIT) PRIX  FROM saisie_produit p WHERE 1   ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]=$key['PRIX'];
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','QUANTITE','PRIX D\'ACHAT'));

            
      $data['titl']="Stock du ". date('d-m-Y');
                $data['points']=$tabledata;


      $this->load->view('Stock_general_View',$data);
    }
}

