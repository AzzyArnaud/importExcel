<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture_cart extends CI_Controller {

    
   
   public function index()
   {

   }

   public function insert_cart() 
   {
      $ID_PRODUIT=$this->input->post("ID_PRODUIT");
      if($ID_PRODUIT>0){
         $DESIGNATION="produit";
      }else
      $DESIGNATION=$this->input->post("DESIGN");
      $PU=$this->input->post("PRICE");
      $QTY=$this->input->post("QTY");
      $TOT=$this->input->post("TOT");
// print_r($ID_PRODUIT);die();
if($PU>$QTY){
   $data = array(
        'id'      => uniqid(),
        'qty'     => $QTY,
        'price'   => $PU,
        'name'    => $DESIGNATION,
        'design'    => $DESIGNATION,
        'tot'    => $TOT,
        'ID_PRODUIT'  =>$ID_PRODUIT,


      );
// print_r($data);die();
$this->cart->insert($data);

$this->view_cart();

}else{
   echo "<div class='alert alert-danger'>ECHEC! VERIFIER BIEN LES QUATITES ET LES MONTANTS</div>";
}
      

   }

   public function view_cart(){

      // echo "result cart";
      $table="<table class='table table-bordered table-striped' style='width:100%'>
      <tr class='text-center'>
              <th>DESIGNATION</th>
              <th>PRIX UNITAIRE</th>
              <th>QUANTITE</th>
              <th>PRIX TOTAL</th>
              <th></th>
            </tr>";

      foreach ($this->cart->contents() as $infos){
         if($infos['ID_PRODUIT']>0){
         $produit=$this->Model->getOne("saisie_produit",array('ID_PRODUIT'=>$infos['ID_PRODUIT']));
         $DESIGNATION=$produit['NOM_PRODUIT'];
      } else $DESIGNATION=$infos['design'];
// echo $infos['ID_PRODUIT'];
$table.="<tr><td>".$DESIGNATION."</td><td>".$infos['price']."</td><td>".$infos['qty']."</td><td>".$infos['tot']."</td><td><a class='btn btn-danger delete' id='".$infos['rowid']."'   role='button'><i class='fa fa-minus-circle' aria-hidden='true'></i> Enlever </a></td'</tr>";

      }

      $table.="<tr><td colspan='3'>MONTANT HTVA</td><td>".$this->cart->total()."</td><td></td'</tr>";
      $tva=round($this->cart->total()*18/100);
      $tvac=$this->cart->total()+$tva;

      $table.="<tr><td colspan='3'>TVA</td><td>".$tva."</td><td></td'</tr>";
      $table.="<tr><td colspan='3'>MONATANT TVAC</td><td>".$tvac."</td><td></td'</tr>";

      $table.="</table>";

      echo $table."||".$tvac;
   }

   public function delete_item(){
      $ID_CLIENT=$this->input->post("ID_CLIENT");
      $this->cart->remove($ID_CLIENT);
      $this->view_cart();

   }
}


