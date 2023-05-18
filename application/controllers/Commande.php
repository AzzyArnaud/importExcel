<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Controller {
public function __construct()
{
	parent::__construct();
	
}

  public function check_nouveau(){
    $check=$this->Model->checkvalue("commandes",array("STATUT"=>0));
    if ($check==1) {
      echo "ok";
    }else{
      echo "non";
    }
  }


}
