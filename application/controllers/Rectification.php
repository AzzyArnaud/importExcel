<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rectification extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function vente_detail()
       {

      		$infos1=$this->Model->getList("vente_detailold",array("ID_LOCAL"=>0));

      		// print_r(count($infos1));

      		foreach ($infos1 as $key) {
      			$this->Model->delete("vente_detail",array("CUNIQUE"=>$key['CUNIQUE']));
      		}

      }
    public function vider_vente_detail(){
      $this->Model->delete("vente_detail",array("ID_VENTE"=>0));
      echo "fin";
    }

    public function equilibre_prix(){
      $infos=$this->Model->getRequete("select* from vente_detail where DATE_TIME>'2023-02-25'");
      foreach ($infos as $value) {
        $prod=$this->Model->getOne("saisie_produit",array("ID_PRODUIT"=>$value["ID_PRODUIT"]));

        $this->Model->update("vente_detail",array("ID_PRODUIT"=>$value["ID_PRODUIT"],"CUNIQUE"=>$value["CUNIQUE"]),array("PRIX_UNITAIRE"=>$prod['PRIX_PRODUIT']));
      }
    }
    public function equilibre_prix1(){
      $infos=$this->Model->getRequete("select* from vente_vente where DATE_TIME_VENTE>'2023-02-25'");
      foreach ($infos as $value) {
        $prod=$this->Model->getRequeteOne("select sum(PRIX_UNITAIRE) n from vente_detail where ID_VENTE=".$value["ID_VENTE"]);

        $this->Model->update("vente_vente",array("ID_VENTE"=>$value["ID_VENTE"]),array("MONTANT_TOTAL"=>$prod['n']));
      }
    }
}