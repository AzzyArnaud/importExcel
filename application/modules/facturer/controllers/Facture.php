<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

    
   
   public function index()
   {
// $this->cart->destroy();
      $ID_CLIENT=$this->input->post('ID_CLIENT');
  $this->form_validation->set_rules('ID_CLIENT', 'ID_CLIENT', 'required');

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Utilisateur non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by ID_CLIENT');

    $cat=$this->Model->getList("client");
    $products=$this->Model->getList("saisie_produit");
    $info=array();
    $info['DATE_FACTURE']='';
      $info['CLIENT']='';
      $info['NUMERO_FACTURE']='';
      $info['MONTANT_LETTRE']='';
      $info['QUI_SIGNE']='';
      $info['SON_TITRE']='';
      $data['info']=$info;
    $data['categ']=$cat;
    $data['prods']=$products;
    $this->load->view('Facture_Insert_View',$data);
   }
}

  public function save_facture()
   {
$info=array();
      $DATE_FACTURE=$this->input->post('DATE_FACTURE');
      $CLIENT=$this->input->post('ID_CLIENT');
      $NUMERO_FACTURE=$this->input->post('NUMERO_FACTURE');
      $AUTO_SEND=$this->input->post('AUTO_SEND');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE1');
      $MONTANT_LETTRE=$this->input->post('MONTANT_LETTRE');
      $QUI_SIGNE=$this->input->post('QUI_SIGNE');
      $SON_TITRE=$this->input->post('SON_TITRE');
      $info['DATE_FACTURE']=$DATE_FACTURE;
      $info['CLIENT']=$CLIENT;
      $info['NUMERO_FACTURE']=$NUMERO_FACTURE;
      $info['MONTANT_LETTRE']=$MONTANT_LETTRE;
      $info['QUI_SIGNE']=$QUI_SIGNE;
      $info['SON_TITRE']=$SON_TITRE;


  $this->form_validation->set_rules('ID_CLIENT', 'ID_CLIENT', 'required');
  $this->form_validation->set_rules('DATE_FACTURE', 'DATE_FACTURE', 'required');
  $this->form_validation->set_rules('MONTANT_LETTRE', 'MONTANT_LETTRE', 'required');
  $this->form_validation->set_rules('QUI_SIGNE', 'QUI_SIGNE', 'required');
  $this->form_validation->set_rules('SON_TITRE', 'SON_TITRE', 'required');
  $this->form_validation->set_rules('NUMERO_FACTURE', 'NUMERO_FACTURE', 'required|is_unique[facture.NUMERO_FACTURE]');


   if ($this->form_validation->run() == FALSE||empty($this->cart->contents())){
   // if (empty($this->cart->contents())){
    $message = "<div class='alert alert-danger'>
                        ERREUR    
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by ID_CLIENT');

    $cat=$this->Model->getList("client");
    $data['categ']=$cat;
    $data['info']=$info;
    $this->load->view('Facture_Insert_View',$data);
   }else{

      $tva=$this->cart->total()*18/100;
      $tvac=$this->cart->total()+$tva;

      $info_facture=array(
         "ID_SOCIETE"=>$ID_SOCIETE,
         "ID_CLIENT"=>$CLIENT,
         "DATE_FACTURE"=>$DATE_FACTURE,
         "NUMERO_FACTURE"=>$NUMERO_FACTURE,
         "TVA"=>$tva,
         "MONTANT_HTVA"=>$this->cart->total(),
         "MONTANT_TVAC"=>$tvac,
         "MONTANT_LETTRE"=>$MONTANT_LETTRE,
         "QUI_SIGNE"=>$QUI_SIGNE,
         "SON_TITRE"=>$SON_TITRE,
         "AUTO_SEND"=>$AUTO_SEND,
      );
// print_r($info_facture);die();
      $id=$this->Model->insert_last_id("facture",$info_facture);
      foreach ($this->cart->contents() as $infos){
         if($infos['ID_PRODUIT']>0){
         $produit=$this->Model->getOne("saisie_produit",array('ID_PRODUIT'=>$infos['ID_PRODUIT']));
         $PRODUCT_ID=$infos['ID_PRODUIT'];
         $DESIGNATION=$produit['NOM_PRODUIT'];
      } else{
         $DESIGNATION=$infos['design'];
         $PRODUCT_ID=0;
      } 
         $this->Model->create(
            "facture_detail",
            array(
               "ID_FACTURE"=>$id,
               "ID_PRODUIT"=>$PRODUCT_ID,               "DESIGNATION"=>$DESIGNATION,
               "PU"=>$infos['price'],
               "QT"=>$infos['qty'],
               "PT"=>$infos['tot'],
            )
         );
      }
      
      $this->cart->destroy();

      echo "ok";
   }
}
public function viewing()
   {
      $information=$this->Model->getRequete("SELECT* from facture f LEFT JOIN client c on f.ID_CLIENT=c.ID_CLIENT ORDER BY ID_FACTURE DESC");
      $user['data']=$information;
      $this->load->view('Facture_Detail_View', $user);
   }

public function viewing1()
   {
    
      $this->load->view('Facture_List_View');
   }
  
 function print_invoice($id){
  // include'html_table.php';
  include 'pdfinclude/fpdf/mc_table.php';


$facture=$this->Model->getRequeteOne("SELECT* from facture f left join client c on f.ID_CLIENT=c.ID_CLIENT where ID_FACTURE=".$id);
 

// $pdf=new PDF('P', 'mm', 'A4' );
$pdf = new MC_Table('P', 'mm', 'A4' ); 
$espace=4;
$pdf->AddPage();
$pdf->SetFont('Times','',9);
// $pdf->Image(FCPATH . 'uploads/images/entete.PNG',1,1,210,30);
// $pdf->Image(FCPATH . 'uploads/images/pied.PNG',1,270,210,25);
// $pdf->Image(FCPATH . 'uploads/images/center.PNG',30,70,150,100);
$pdf->Line(105, 43, 105, 80);
// $pdf->ln(25);
$pdf->SetFont('Times','BU',14);
$pdf->SetMargins(20,20,20);
$pdf->Cell(190,4,utf8_decode("Facture  N° ".$facture['NUMERO_FACTURE']),8,1,'C');
$pdf->SetFont('Times','B',9);
$pdf->ln(3);
$y1=$pdf->GetY();

$pdf->Cell(70,4,"      A.  Identification du vendeur",8,1,'L');
$pdf->Cell(20,4,"Raison Social :",8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(100,4," INVEST AND PAY TECHNOLOGIES",8,1,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,4,"NIF:",8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(100,4,"4001199647",8,1,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(38,4,utf8_decode("Registre du Commerce N° :"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(30,4,"03071",8,1,'L');



$pdf->SetFont('Times','B',9);
$pdf->Cell(20,4,utf8_decode("BP:"),8,0,'L');
$pdf->Cell(10,4,utf8_decode("TEL:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(80,4,"71311736",8,1,'L');



$pdf->SetFont('Times','B',9);
$pdf->Cell(16,4,utf8_decode("Commune:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(12,4,"Mukaza",8,0,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,4,utf8_decode("Zone:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(80,4,"Rohero",8,1,'L');



$pdf->SetFont('Times','B',9);
$pdf->Cell(5,4,utf8_decode("Av:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(25,4,"Avenue de l'ONU ",8,0,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(5,4,utf8_decode("N°:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(80,4,"3",8,1,'L');


$pdf->SetFont('Times','B',9);
$pdf->Cell(28,4,utf8_decode("Assujetti à la TVA :"),8,0,'L');

$pdf->Cell(3,4,"X",8,0,'L');
$pdf->SetFont('Times','',9);
// $pdf->Cell(10,4,unicode("□ OUI     □ NON"),8,1,'L');
$pdf->Cell(10,4,utf8_decode("OUI     NON"),8,1,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(20,4,"Centre Fiscal:",8,0,'');
$pdf->SetFont('Times','',9);
$pdf->Cell(15,4,"DMC",8,1,'L');
$pdf->SetFont('Times','B',9);
$pdf->Cell(28,4,utf8_decode("Secteur d'activités :"),8,0,'');
$pdf->SetFont('Times','',9);
$pdf->Cell(20,4,"Informatique",8,1,'L');

// echo $y1;s


$pdf->ln(5);
$pdf->SetXY(110, $y1);

$pdf->SetFont('Times','B',9);
$pdf->Cell(30,4,utf8_decode("Forme Juridique :"),8,0,'');
$pdf->SetFont('Times','',9);
$pdf->Cell(20,4,"SURL",8,1,'L');
$pdf->SetXY(110, $y1+10);
$pdf->SetFont('Times','B',9);
$pdf->Cell(70,4,"      B.  Client",8,1,'L');

$pdf->SetXY(110, $y1+10+$espace);

$pdf->SetFont('Times','B',9);
$pdf->Cell(20,4,utf8_decode("Raison social:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(40,4,utf8_decode($facture['RAISON']),8,1,'L');

$pdf->SetXY(110, $y1+10+($espace*2));
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,4,utf8_decode("NIF:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(20,4,utf8_decode($facture['NIF']),8,1,'L');

$pdf->SetXY(110, $y1+10+($espace*3));
$pdf->SetFont('Times','B',9);
$pdf->Cell(13,4,utf8_decode("Adresse:"),8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(20,4,utf8_decode($facture['COMMUNE']." ".$facture['ZONE']." ".$facture['QUARTIER']." ".$facture['AV']),8,1,'L');


$pdf->SetXY(110, $y1+10+($espace*4));
$pdf->SetFont('Times','B',9);
$pdf->Cell(30,4,utf8_decode("Assujetti à la TVA :"),8,0,'L');

if($facture['A_TVA']){
  $pdf->Cell(3,4,"X",8,0,'L');
$pdf->SetFont('Times','',9);
$pdf->Cell(10,4,utf8_decode("OUI    NON"),8,1,'L');
}else{

  $pdf->SetFont('Times','',9);
  $pdf->Cell(10,4,utf8_decode("OUI"),8,0,'L');
   $pdf->SetFont('Times','B',9);
  $pdf->Cell(15,4,"X",8,0,'R');
    $pdf->SetFont('Times','',9);
    $pdf->Cell(5,4,utf8_decode("NON"),8,1,'L');
}

$pdf->ln(8);

$pdf->SetFont('Times','B',9);

$pdf->SetMargins(10,10,10);
$pdf->ln(10);
// $html=''; // <td width='300' height='50' ALIGN='RIGHT'>".utf8_decode('Désignation')."</td>
$pdf->SetFont('Times','',12);


$pdf->SetFont('Times','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("C","C","C","C"));
$pdf->Row(array(utf8_decode('Désignation'),utf8_decode('QT'),utf8_decode('PU'),'PT'));
$pdf->SetFont('Times','',12);


$detail=$this->Model->getList("facture_detail",array("ID_FACTURE"=>$id));

$tot=0;

foreach ($detail as  $value) {
  $pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$pdf->Row(array(utf8_decode($value['DESIGNATION']),utf8_decode($value['QT']),number_format($value['PU'],0,","," "),number_format($value['PT'],0,","," ")));

$tot+=$value['PT'];
}

$pdf->SetFont('Times','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$pdf->Row(array('Total','','',number_format($tot,0,","," ")));

$pdf->SetFont('Times','',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$tva=$tot*18/100;
$pdf->Row(array('TVA(18%)','','',number_format($tva,0,","," ")));

$pdf->SetFont('Times','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$tvaC=$tot+$tva;
$pdf->Row(array('TOTAL TVAC','','',number_format($tvaC,0,","," ")));
$pdf->ln(5);
$pdf->Cell(190,4,'***'.$facture['MONTANT_LETTRE'].'***',8,1,'C');
$pdf->ln(10);
$pdf->Cell(190,4,$facture['SIGNATURE_FACTURE'],8,1,'C');

$pdf->ln(10);
$pdf->SetFont('Times','',12);
$newDate = date("d/m/Y", strtotime($facture['DATE_FACTURE'])); 
$pdf->Cell(190,10,utf8_decode("Fait à Bujumbura le ".$newDate),8,1,'R');
$pdf->Cell(125,10,utf8_decode(''),8,0,'R');
$pdf->Cell(65,10,utf8_decode($facture['QUI_SIGNE']),8,1,'C');
$pdf->Cell(125,10,utf8_decode(''),8,0,'R');
$pdf->Cell(65,10,utf8_decode($facture['SON_TITRE']),8,1,'C');


$pdf->Output();
 }
 
public function getProduit_Price(){
 $prod= $this->Model->getOne("saisie_produit",array("ID_PRODUIT"=>$this->input->post("ID_PRODUIT")));

 $gen=$this->Model->getRequeteOne("SELECT PRIX_PRODUIT FROM saisie_produit where saisie_produit.ID_PRODUIT=".$this->input->post("ID_PRODUIT"));

 echo $prod['PRIX_PRODUIT'];
}


















































































public function updating($ID_FACTURE)
{
 $this->cart->destroy();
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by ID_CLIENT');
    
    $facture=$this->Model->getRequete('SELECT * FROM facture f join facture_detail fd on f.ID_FACTURE=fd.ID_FACTURE where f.ID_FACTURE='.$ID_FACTURE);

    

    foreach ($facture as $key) {
      if($key['ID_PRODUIT']>0){
         $ID_PRODUIT=$key['ID_PRODUIT'];
         $DESIGNATION="produit";
      }
         else {
            $ID_PRODUIT=0;
            $DESIGNATION=$key['DESIGNATION'];
         }
       $data = array(
        'id'      => uniqid(),
        'qty'     => $key['QT'],
        'price'   => $key['PU'],
        'name'    => $DESIGNATION,
        'design'    => $DESIGNATION,
        'tot'    => $key['PT'],
        'ID_PRODUIT'  =>$ID_PRODUIT,
      );
      // print_r($data);
      $this->cart->insert($data);
    }

    $cat=$this->Model->getList("client");
    $products=$this->Model->getList("saisie_produit");
    $info=array();
    $info['DATE_FACTURE']='';
      $info['CLIENT']='';
      $info['NUMERO_FACTURE']='';
      $info['MONTANT_LETTRE']='';
      $info['QUI_SIGNE']='';
      $info['SON_TITRE']='';
      $data['info']=$info;
    $data['categ']=$cat;
    $data['prods']=$products;
    $data['fact']=$this->Model->getOne('facture',array("ID_FACTURE"=>$ID_FACTURE));
    // print_r($data['fact']);
    $this->load->view('Facture_Update_View',$data);

// }

}



 public function save_update_facture($id)
   {

$info=array();
// echo "<script>alert('$message');</script>"; 
      $DATE_FACTURE=$this->input->post('DATE_FACTURE');
      $CLIENT=$this->input->post('ID_CLIENT');
      $NUMERO_FACTURE=$this->input->post('NUMERO_FACTURE');
      $AUTO_SEND=$this->input->post('AUTO_SEND');
      $ID_SOCIETE=$this->session->userdata('STRAPH_ID_SOCIETE1');
      $MONTANT_LETTRE=$this->input->post('MONTANT_LETTRE');
      $QUI_SIGNE=$this->input->post('QUI_SIGNE');
      $SON_TITRE=$this->input->post('SON_TITRE');
      $info['DATE_FACTURE']=$DATE_FACTURE;
      $info['CLIENT']=$CLIENT;
      $info['NUMERO_FACTURE']=$NUMERO_FACTURE;
      $info['MONTANT_LETTRE']=$MONTANT_LETTRE;
      $info['QUI_SIGNE']=$QUI_SIGNE;
      $info['SON_TITRE']=$SON_TITRE;
// print_r($SON_TITRE);die();


  // $this->form_validation->set_rules('ID_CLIENT', 'ID_CLIENT', 'required');
  // $this->form_validation->set_rules('DATE_FACTURE', 'DATE_FACTURE', 'required');
  // $this->form_validation->set_rules('MONTANT_LETTRE', 'MONTANT_LETTRE', 'required');
  // $this->form_validation->set_rules('QUI_SIGNE', 'QUI_SIGNE', 'required');
  // $this->form_validation->set_rules('SON_TITRE', 'SON_TITRE', 'required');
  $this->form_validation->set_rules('NUMERO_FACTURE', 'NUMERO_FACTURE', 'required|is_unique[facture.NUMERO_FACTURE]');


   // if ($this->form_validation->run() == TRUE||empty($this->cart->contents())){
   if (empty($this->cart->contents())){
    $message = "<div class='alert alert-danger'>
                        ERREUR    
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Utilisateur';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `client` order by ID_CLIENT');

    $cat=$this->Model->getList("client");
    $data['categ']=$cat;
    $data['info']=$info;
// print_r($SON_TITRE);die();

    $this->load->view('Facture_Update_View',$data);
   }else{

      $tva=$this->cart->total()*18/100;
      $tvac=$this->cart->total()+$tva;

      $info_facture=array(
         "ID_SOCIETE"=>$ID_SOCIETE,
         "ID_CLIENT"=>$CLIENT,
         "DATE_FACTURE"=>$DATE_FACTURE,
         "NUMERO_FACTURE"=>$NUMERO_FACTURE,
         "TVA"=>$tva,
         "MONTANT_HTVA"=>$this->cart->total(),
         "MONTANT_TVAC"=>$tvac,
         "MONTANT_LETTRE"=>$MONTANT_LETTRE,
         "QUI_SIGNE"=>$QUI_SIGNE,
         "SON_TITRE"=>$SON_TITRE,
         "AUTO_SEND"=>$AUTO_SEND,
      );

      // $check_num_facture= $this->Model->getOne("facture",array('NUMERO_FACTURE'=>$NUMERO_FACTURE));

      // if(!empty($NUMERO_FACTURE)&&!$check_num_facture){
      //     echo "ECHEC! CE NUMÉRO DE FACTURE DROIT RESTER LA MÉME";

      //     exit();
      // } 
// print_r($info_facture);die();
     $this->Model->update("facture",array("ID_FACTURE"=>$id),$info_facture);

      $this->Model->delete("facture_detail",array("ID_FACTURE"=>$id));
      foreach ($this->cart->contents() as $infos){
         if($infos['ID_PRODUIT']>0){
         $produit=$this->Model->getOne("saisie_produit",array('ID_PRODUIT'=>$infos['ID_PRODUIT']));
         $PRODUCT_ID=$infos['ID_PRODUIT'];
         $DESIGNATION=$produit['NOM_PRODUIT'];
      } else{
         $DESIGNATION=$infos['design'];
         $PRODUCT_ID=0;
      } 
         $this->Model->create(
            "facture_detail",
            array(
               "ID_FACTURE"=>$id,
               "ID_PRODUIT"=>$PRODUCT_ID,               
               "DESIGNATION"=>$DESIGNATION,
               "PU"=>$infos['price'],
               "QT"=>$infos['qty'],
               "PT"=>$infos['tot'],
            )
         );
      }
      
      $this->cart->destroy();

      echo "ok";
   }
}







}

