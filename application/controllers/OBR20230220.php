<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');

/**
 * 
 */
class OBR extends CI_Controller
{



  function login()
  {


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://ebms.obr.gov.bi:9443/ebms_api/login/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "username":"ws400042558900232",
        "password":"vh7W\'PA,"
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;

    $data=json_decode($response,true);
    $token=$data['result']['token'];

    $set_session=array('token'=>$token);

    $this->session->set_userdata($set_session);

    // echo $token;

    return $token;
  }

  
  function addInvoice()
  {


    $token=$this->login();

    // $getInvoice=$this->Model->getRequete("SELECT `ID`, `DATE`, `NUMERO_ABONE`, `NOM`, `ADRESSE`, `NIF`, `CATEGORIE`, `NUMERO_FACTURE`, `MONTANT_HT`, `MONTANT_TVA`, `MONTANT_TTC`, `COMMENTAIRE`, `STATUT` FROM `facture` WHERE STATUT=0");

$getInvoice=$this->Model->getRequete("SELECT* FROM vente_vente vv left join saisie_client sc on vv.ID_CLIENT=sc.ID_CLIENT where  vv.DATE_TIME_VENTE>'2023-02-09' and (select count(ID_VENTE_DETAIL) from vente_detail where ID_VENTE=vv.ID_VENTE and ID_BARCODE not in(select ID_BARCODE from req_barcode where HAVE_FACTURE=0) and ID_PRODUIT not in(select ID_PRODUIT from saisie_produit where AGREE_LOCAL=0))>0");

print_r($getInvoice);exit();

    $tableau_principal=array();
    $facture=array();
$i=1;
$NUM=$this->Model->getRequeteOne("SELECT MAX(OBR_NUM) n FROM vente_vente ");
    if($token)

      foreach ($getInvoice as $value) 
      {
        $curl = curl_init();

$OBR_NUM=$NUM[0]['n']+1;
        $newDate = date("YmdHis", strtotime($value['DATE_TIME_VENTE'])); 

      // echo $value['DATE']." ".$newDate;

        $invoice_signature="4000425589/ws400042558900232/".$newDate."/".$OBR_NUM;

        $facture["invoice_number"]= $OBR_NUM;
        $facture["invoice_date"]= $value['DATE_TIME_VENTE'].date('H:i:s');
        $facture["invoice_type"]= "FN";
        $facture["tp_type"]= 2;
        $facture["tp_name"]= "PHARMACIE SAINT RAPHAEL";
        $facture["tp_TIN"]= "4000425589";
        $facture["tp_trade_number"]= "03071";
        $facture["tp_postal_number"]= "";
        $facture["tp_phone_number"]= "72364573";
        $facture["tp_address_province"]= "BUJUMBURA MAIRIE";
        $facture["tp_address_commune"]= "NTAHANGWA";
        $facture["tp_address_quartier"]= "GIHOSHA";
        $facture["tp_address_avenue"]= "Avenue de l\'agriculture";
        $facture["tp_address_number"]= " no 26 ";
        $facture["vat_taxpayer"]= "0";
        $facture["ct_taxpayer"]= "0";//A FORNIR PAR ONATEL
        $facture["tl_taxpayer"]= "0";//A FORNIR PAR ONATEL
        $facture["tp_fiscal_center"]= "DPMC";
        $facture["tp_activity_sector"]= "SANTE";
        $facture["tp_legal_form"]= "PRIVE";
        $facture["payment_type"]= "1";//1 EN ESPECE 3 A CREDIT
        $facture["invoice_currency"]= "BIF";
        $facture["customer_name"]= $value['NOM'];
        // $facture["customer_TIN"]= $value['NIF'];
        $facture["customer_address"]= $value['ADRESSE'];
        $facture["vat_customer_payer"]= "";
        $facture["cancelled_invoice_ref"]= "";
        $facture["Invoice_ref"]= $OBR_NUM;
        $facture["invoice_signature"]= $invoice_signature;
        $facture["invoice_signature_date"]=date('Y-m-d h:i:s');

          // print_r($tableau_principal);exit();

          $items=array();

          $getInvoiceItems=$this->Model->getRequete("SELECT NOM_PRODUIT, from vente_detail vd join saisie_produit sp on vd.ID_PRODUIT=sp.ID_PRODUIT where ID_VENTE=$value['ID_VENTE']");

          
          foreach ($getInvoiceItems as $detail) 
          {
            $items["item_designation"]= $detail['NOM_PRODUIT'];
            $items["item_quantity"]=$detail['QTE'];
            $items["item_price"]= $detail['PU_HT'];
            $items["item_ct"]= 0 ;// TAXE DE CONSOMMATION A IDENTIFIE PAR ONATEL,
            $items["item_tl"]= 0;// PRELEVEMENT FORFAITAIREA IDENTIFIE PAR ONATEL,
            $items["item_price_nvat"]= ($detail['PU_HT']*$detail['QTE'])+$items["item_ct"];
            // $items["vat"]= $items["item_price_nvat"]*18/100;
            $items["vat"]= 0;
            $items["item_price_wvat"]= $items["item_price_nvat"]+$items["vat"];
            $items["item_total_amount"]= $items["item_price_wvat"]+$items["item_tl"];
            $facture["invoice_items"][]=$items;

            $items=array();
          }




      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://41.79.226.28:8345/ebms_api/addInvoice/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($facture,JSON_UNESCAPED_SLASHES),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: Bearer '.$token
        ),
      ));




      $response = curl_exec($curl);

      $response=json_decode( $response,JSON_UNESCAPED_SLASHES);
    // print_r($response['msg']);exit();

      if($response['success'])
      {
        $this->Model->update('facture',array('NUMERO_FACTURE'=>$value['NUMERO_FACTURE']),array('STATUT'=>1,'DATE_ENVOYE_OBR'=>date('Y-m-d h:i:s'),'SIGNATURE_FACTURE'=>$invoice_signature));
      }


      $tableau_principal[]=$facture;

      

      curl_close($curl);


    // echo "<pre>";

    //    print_r(json_encode($facture,JSON_UNESCAPED_SLASHES));

    // echo "</pre>";
      $facture=array();

      print_r( "FACTURE No ".$value['NUMERO_FACTURE'].":".$response['msg']."<br>");

      // $this->Model->create('facture_captcha_message',array('MESSAGES'=>$response['msg'],'NUMERO_FACTURE'=>$value['NUMERO_FACTURE']));

$i++;
    }

  }



  function getInvoice($value="")
  {

    $token=$this->login();

    $curl = curl_init();

    //recuperation de la valeur
    $getInvoice=$this->Model->getOne('facture',array('STATUT'=>1,'ID'=>$value));

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://41.79.226.28:8345/ebms_api/getInvoice/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "invoice_signature":"'.$getInvoice['SIGNATURE_FACTURE'].'"

      }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
      ),
    ));



    $response = curl_exec($curl);
    curl_close($curl);
    echo '<pre>'.$response.'</pre>';

  }




  function cancelInvoice($value="")
  {

    $token=$this->login();
    $curl = curl_init();

    //recuperation de la valeur
    $cancel=$this->Model->getOne('facture',array('STATUT'=>1,'ID'=>$value));

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://41.79.226.28:8345/ebms_api/cancelInvoice/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "invoice_signature":"'.$cancel['SIGNATURE_FACTURE'].'"

      }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

     $this->Model->update('facture',array('ID'=>$cancel['ID']),array('EST_ANNULLE'=>1));
    echo '<pre>'.$response.'</pre>';

    

  }











}

