<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Synchonisation extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

// public function index()
//        {
//        $infos=$this->Model->getRequete("show tables");
//        // print_r($infos);
//        $data=array();
//        foreach ($infos as $key ) {
//            $tmp=array($key['Tables_in_pharmacie_st_raphael']=>$this->Model->getList($key['Tables_in_pharmacie_st_raphael'],array("ENVOIE"=>0)));
//            array_push($data,$tmp);

//            $this->index1($data);
//            $data=array();
//        }

// }


    public function index($data='')
       {

        if($this->is_connected()){
       $infos=$this->Model->getRequete("show tables");
       // print_r($infos);
       $data=array();
       foreach ($infos as $key ) {
          if($key['Tables_in_pharmacie_st_raphael']=='vente_detail'){
          $tmp=array($key['Tables_in_pharmacie_st_raphael']=>$this->Model->getRequete('select* from '.$key['Tables_in_pharmacie_st_raphael'].' where ENVOIE=0 and ID_VENTE>0 limit 1000'));
        }else
        $tmp=array($key['Tables_in_pharmacie_st_raphael']=>$this->Model->getRequete('select* from '.$key['Tables_in_pharmacie_st_raphael'].' where ENVOIE=0 limit 1000'));
           //$tmp=array($key['Tables_in_pharmacie_st_raphael']=>$this->Model->getList($key['Tables_in_pharmacie_st_raphael'],array("ENVOIE"=>0)));
           // if($key['Tables_in_pharmacie_st_raphael']!='saisie_produit'&&$key['Tables_in_pharmacie_st_raphael']!='vente_vente'&&$key['Tables_in_pharmacie_st_raphael']!='vente_remise'&&$key['Tables_in_pharmacie_st_raphael']!='vente_detail'&&$key['Tables_in_pharmacie_st_raphael']!='req_requisition'&&$key['Tables_in_pharmacie_st_raphael']!='req_barcode')
           // if($key['Tables_in_pharmacie_st_raphael']=='req_barcode_efface')
           array_push($data,$tmp);
       }
       // array_push($data,array('response'=>'ok'));
// echo json_encode($data);



    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.pharmaciesaintraphael.com/app/Synchonisation/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>array("INFO"=>json_encode($data),"ID_SOCIETE"=>1),
     
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;

    $result=json_decode($response,true);
    // $token=$data['result']['token'];

    // $set_session=array('token'=>$token);

    // $this->session->set_userdata($set_session);

    echo $response."<p>";

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



}else echo "PAS D'INTERNET";
       }


   public function request_Remote()
   {
  
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.pharmaciesaintraphael.com/app/Synchonisation/send_to_local',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>array("ID_SOCIETE"=>1),
       
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      // echo $response;exit();

      $result=json_decode($response,true);

      // print_r($result) ;exit();

      foreach ($result['vente_detail'] as $vd) {
        $firstKey = key($vd);
        $id=$this->Model->insert_last_id("vente_detail",array("ID_VENTE"=>''));
        // unset($vd[$firstKey]);
        $vd['ID_LOCAL']=$id;
        $this->Model->create("vente_detail_tempo",$vd);
      }

      foreach ($result['vente_remise'] as $vd) {
        $firstKey = key($vd);
        $id=$this->Model->insert_last_id("vente_remise",array("ID_VENTE"=>''));
        // unset($vd[$firstKey]);
        $vd['ID_LOCAL']=$id;
        $this->Model->create("vente_remise_tempo",$vd);
      }
       foreach ($result['vente_vente'] as $vv) {
        $firstKey = key($vv);
        $id=$this->Model->insert_last_id("vente_vente",array("DATE_TIME_VENTE"=>''));
        // unset($vd[$firstKey]);
        $vv['ID_LOCAL']=$id;
        $this->Model->create("vente_vente_tempo",$vv);
        $this->Model->update("vente_detail_tempo",array("ID_VENTE"=>$vv['ID_VENTE']),array("ID_VENTE"=>$id));
        $this->Model->update("vente_remise_tempo",array("ID_VENTE"=>$vv['ID_VENTE']),array("ID_VENTE"=>$id));
      }
      foreach ($result['saisie_client'] as $vv) {
        $firstKey = key($vv);
        $id=$this->Model->insert_last_id("saisie_client",array("NOM_CLIENT"=>''));
        // unset($vd[$firstKey]);
        $vv['ID_LOCAL']=$id;
        $this->Model->create("saisie_client_tempo",$vv);
        $this->Model->update("vente_vente_tempo",array("ID_CLIENT"=>$vv['ID_CLIENT']),array("ID_CLIENT"=>$id));
      }
      
$tables=$this->Model->getRequete("SELECT * FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_NAME LIKE '%_tempo%'");

 $dtas=array();
       foreach ($tables as $key ) {
          
        $tbl=str_replace("_tempo", "", $key['TABLE_NAME']);
          // $dtas[$tbl]=$this->Model->getList($key['TABLE_NAME'],array("ID_SOCIETE"=>1));
          $tmp=array($tbl=>$this->Model->getList($key['TABLE_NAME']));
          array_push($dtas,$tmp);
          
       }

// print_r($dtas);
      $this->update_synch($dtas);
   }

public function update_synch($data){
  $curl = curl_init();
curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.pharmaciesaintraphael.com/app/Synchonisation/update_synch',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>array("INFO"=>json_encode($data),"ID_SOCIETE"=>1),
     
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;

    $result=json_decode($response,true);
    // $token=$data['result']['token'];

    // $set_session=array('token'=>$token);

    // $this->session->set_userdata($set_session);
    // if($response=='ok'){
      foreach ($data as $key => $value) {
        # code...
        foreach ($value as $key1 => $value1) {
// echo $key1;
            foreach ($value1 as $value2) {
              $firstKey = key($value2);
           

              $value2['ENVOIE']=1;

                $id=$value2['ID_LOCAL'];
                unset($value2[$firstKey]);
                unset($value2['ID_LOCAL']);
                $this->Model->update($key1,array($firstKey=>$id),$value2);

              
            }
          
          $inf=$this->Model->truncate("TRUNCATE TABLE ".$key1."_tempo");

        }
        
      }
    // }

    echo $response;

}

   



public function is_connected()
{
    $connected = @fsockopen("www.youtube.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}
}