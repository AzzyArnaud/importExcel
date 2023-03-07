<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Synchonisation extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index()
       {
        
       $infos=$this->Model->getRequete("show tables");
       // print_r($infos);
       $data=array();
       foreach ($infos as $key ) {
           $tmp=array($key['Tables_in_pharmacie_st_raphael']=>$this->Model->getList($key['Tables_in_pharmacie_st_raphael'],array("ENVOIE"=>0)));
           array_push($data,$tmp);
       }
       // array_push($data,array('response'=>'ok'));
// echo json_encode($data);



    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://pharmaciesaintraphael.com/app/Synchonisation/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>array("INFO"=>json_encode($data)),
     
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;

    $result=json_decode($response,true);
    // $token=$data['result']['token'];

    // $set_session=array('token'=>$token);

    // $this->session->set_userdata($set_session);

    echo $response;

    if ($response=="ok") {
             foreach ($data as $val) {
                

                   foreach ($val as $key1=>$val1) {
                    // print_r($val1);
                    // echo"<p>";
                    foreach ($val1 as $value) {
                      $firstKey = key($value);

                          $this->Model->update($key1,array($firstKey=>$value[$firstKey]), array("ENVOIE"=>1));

                      }
                    }
              }
    }
    // print_r($result);




       }


    public function localToRemote() {
   $db2 = $this->load->database('remote', TRUE);

      $data=array();

$config_droits=array("config_droits"=>$this->Model->getList("config_droits",array("ENVOIE"=>0)));
$config_profil=array("config_profil"=>$this->Model->getList("config_profil",array("ENVOIE"=>0)));
$config_profil_droit=array("config_profil_droit"=>$this->Model->getList("config_profil_droit",array("ENVOIE"=>0)));
$config_societe=array("config_societe"=>$this->Model->getList("config_societe",array("ENVOIE"=>0)));
$config_user=array("config_user"=>$this->Model->getList("config_user",array("ENVOIE"=>0)));
$req_barcode=array("req_barcode"=>$this->Model->getList("req_barcode",array("ENVOIE"=>0)));
$req_requisition=array("req_requisition"=>$this->Model->getList("req_requisition",array("ENVOIE"=>0)));
$req_stock=array("req_stock"=>$this->Model->getList("req_stock",array("ENVOIE"=>0)));
$req_stock_disparu=array("req_stock_disparu"=>$this->Model->getList("req_stock_disparu",array("ENVOIE"=>0)));
$req_stock_endomage=array("req_stock_endomage"=>$this->Model->getList("req_stock_endomage",array("ENVOIE"=>0)));
$saisie_assurance=array("saisie_assurance"=>$this->Model->getList("saisie_assurance",array("ENVOIE"=>0)));
$saisie_categorie_produit=array("saisie_categorie_produit"=>$this->Model->getList("saisie_categorie_produit",array("ENVOIE"=>0)));
$saisie_client=array("saisie_client"=>$this->Model->getList("saisie_client",array("ENVOIE"=>0)));
$saisie_fournisseur=array("saisie_fournisseur"=>$this->Model->getList("saisie_fournisseur",array("ENVOIE"=>0)));
$saisie_produit=array("saisie_produit"=>$this->Model->getList("saisie_produit",array("ENVOIE"=>0)));
$saisie_type_remise=array("saisie_type_remise"=>$this->Model->getList("saisie_type_remise",array("ENVOIE"=>0)));
$vente_detail=array("vente_detail"=>$this->Model->getList("vente_detail",array("ENVOIE"=>0)));
$vente_remise=array("vente_remise"=>$this->Model->getList("vente_remise",array("ENVOIE"=>0)));
$vente_vente=array("vente_vente"=>$this->Model->getList("vente_vente",array("ENVOIE"=>0)));


// $achat_points=$this->Model->getList("achat_points");
// print_r($achat_points);
array_push($data,$config_droits);
array_push($data,$config_profil);
array_push($data,$config_profil_droit);
array_push($data,$config_societe);
array_push($data,$config_user);
array_push($data,$req_barcode);
array_push($data,$req_requisition);
array_push($data,$req_stock);
array_push($data,$req_stock_disparu);
array_push($data,$req_stock_endomage);
array_push($data,$saisie_assurance);
array_push($data,$saisie_categorie_produit);
array_push($data,$saisie_client);
array_push($data,$saisie_fournisseur);
array_push($data,$saisie_produit);
array_push($data,$saisie_type_remise);
array_push($data,$vente_detail);
array_push($data,$vente_remise);
array_push($data,$vente_vente);


 

              foreach ($data as $val) {
                

                   foreach ($val as $key1=>$val1) {
                    // print_r($val1);
                    // echo"<p>";
                    foreach ($val1 as $value) {
                      $firstKey = key($value);

                      
                      if($value['ENVOIE']==0){
                          $this->Model->update($key1,array($firstKey=>$value[$firstKey]), array("ENVOIE"=>1));
                        // print_r($value);
                      unset($value[$firstKey]);
                      // print_r($value);
                      // echo"<p>";

                           // $value = array_shift($value);
                          $value['ENVOIE']=1;
                          // print_r($value);
                          $db2->insert($key1, $value);
                        
                        
                      // echo $firstKey;

                        // print_r($db2);
                      }
                       

                      }
                    }
              }
              
array_push($data,array('response'=>'ok'));
// echo json_encode($data);

    }

    public function remoteToLocal() {
   $db2 = $this->load->database('remote', TRUE);
$this->load->Model('Model_remote');
      $data=array();

$config_droits=array("config_droits"=>$this->Model_remote->getList($db2,"config_droits",array("ENVOIE"=>0)));
$config_profil=array("config_profil"=>$this->Model_remote->getList($db2,"config_profil",array("ENVOIE"=>0)));
$config_profil_droit=array("config_profil_droit"=>$this->Model_remote->getList($db2,"config_profil_droit",array("ENVOIE"=>0)));
$config_societe=array("config_societe"=>$this->Model_remote->getList($db2,"config_societe",array("ENVOIE"=>0)));
$config_user=array("config_user"=>$this->Model_remote->getList($db2,"config_user",array("ENVOIE"=>0)));
$req_barcode=array("req_barcode"=>$this->Model_remote->getList($db2,"req_barcode",array("ENVOIE"=>0)));
$req_requisition=array("req_requisition"=>$this->Model_remote->getList($db2,"req_requisition",array("ENVOIE"=>0)));
$req_stock=array("req_stock"=>$this->Model_remote->getList($db2,"req_stock",array("ENVOIE"=>0)));
$req_stock_disparu=array("req_stock_disparu"=>$this->Model_remote->getList($db2,"req_stock_disparu",array("ENVOIE"=>0)));
$req_stock_endomage=array("req_stock_endomage"=>$this->Model_remote->getList($db2,"req_stock_endomage",array("ENVOIE"=>0)));
$saisie_assurance=array("saisie_assurance"=>$this->Model_remote->getList($db2,"saisie_assurance",array("ENVOIE"=>0)));
$saisie_categorie_produit=array("saisie_categorie_produit"=>$this->Model_remote->getList($db2,"saisie_categorie_produit",array("ENVOIE"=>0)));
$saisie_client=array("saisie_client"=>$this->Model_remote->getList($db2,"saisie_client",array("ENVOIE"=>0)));
$saisie_fournisseur=array("saisie_fournisseur"=>$this->Model_remote->getList($db2,"saisie_fournisseur",array("ENVOIE"=>0)));
$saisie_produit=array("saisie_produit"=>$this->Model_remote->getList($db2,"saisie_produit",array("ENVOIE"=>0)));
$saisie_type_remise=array("saisie_type_remise"=>$this->Model_remote->getList($db2,"saisie_type_remise",array("ENVOIE"=>0)));
$vente_detail=array("vente_detail"=>$this->Model_remote->getList($db2,"vente_detail",array("ENVOIE"=>0)));
$vente_remise=array("vente_remise"=>$this->Model_remote->getList($db2,"vente_remise",array("ENVOIE"=>0)));
$vente_vente=array("vente_vente"=>$this->Model_remote->getList($db2,"vente_vente",array("ENVOIE"=>0)));


// $achat_points=$this->Model->getList("achat_points");
// print_r($achat_points);
array_push($data,$config_droits);
array_push($data,$config_profil);
array_push($data,$config_profil_droit);
array_push($data,$config_societe);
array_push($data,$config_user);
array_push($data,$req_barcode);
array_push($data,$req_requisition);
array_push($data,$req_stock);
array_push($data,$req_stock_disparu);
array_push($data,$req_stock_endomage);
array_push($data,$saisie_assurance);
array_push($data,$saisie_categorie_produit);
array_push($data,$saisie_client);
array_push($data,$saisie_fournisseur);
array_push($data,$saisie_produit);
array_push($data,$saisie_type_remise);
array_push($data,$vente_detail);
array_push($data,$vente_remise);
array_push($data,$vente_vente);


 

              foreach ($data as $val) {
                

                   foreach ($val as $key1=>$val1) {
                    // print_r($val1);
                    // echo"<p>";
                    foreach ($val1 as $value) {
                      $firstKey = key($value);

                      
                      if($value['ENVOIE']==0){
                          $this->Model_remote->update($db2,$key1,array($firstKey=>$value[$firstKey]), array("ENVOIE"=>1));
                        // print_r($value);
                      unset($value[$firstKey]);
                      // print_r($value);
                      // echo"<p>";

                           // $value = array_shift($value);
                          $value['ENVOIE']=1;
                          // print_r($value);
                          $this->Model->create($key1, $value);
                          $db2->insert($key1, $value);
                        
                        
                      // echo $firstKey;

                        // print_r($db2);
                      }
                       

                      }
                    }
              }
              
array_push($data,array('response'=>'ok'));
// echo json_encode($data);

    }
}