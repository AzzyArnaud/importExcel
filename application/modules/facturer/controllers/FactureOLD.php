<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

    
   
   public function index()
   {

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
    $info=array();
    $info['DATE_FACTURE']='';
      $info['CLIENT']='';
      $info['NUMERO_FACTURE']='';
      $data['info']=$info;
    $data['categ']=$cat;
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
      $info['DATE_FACTURE']=$DATE_FACTURE;
      $info['CLIENT']=$CLIENT;
      $info['NUMERO_FACTURE']=$NUMERO_FACTURE;

  $this->form_validation->set_rules('ID_CLIENT', 'ID_CLIENT', 'required');
  $this->form_validation->set_rules('DATE_FACTURE', 'DATE_FACTURE', 'required');
  $this->form_validation->set_rules('NUMERO_FACTURE', 'NUMERO_FACTURE', 'required|is_unique[facture.NUMERO_FACTURE]');
  // $this->form_validation->set_rules('TEL', 'TEL', 'required|is_unique[client.TEL]');

   if ($this->form_validation->run() == FALSE||empty($this->cart->contents())){
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
         "AUTO_SEND"=>$AUTO_SEND,
      );

      $id=$this->Model->insert_last_id("facture",$info_facture);
      foreach ($this->cart->contents() as $infos){
         $this->Model->create(
            "facture_detail",
            array(
               "ID_FACTURE"=>$id,
               "DESIGNATION"=>$infos['design'],
               "PU"=>$infos['price'],
               "QT"=>$infos['qty'],
               "PT"=>$infos['tot'],
            )
         );
      }

      $this->cart->destroy();

redirect(base_url("facturer/Facture/viewing"));
// redirect(base_url("facturer/Facture/listing"));
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
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Image(FCPATH . 'uploads/images/entete.PNG',1,1,210,30);
$pdf->Image(FCPATH . 'uploads/images/pied.PNG',1,270,210,25);
$pdf->Image(FCPATH . 'uploads/images/center.PNG',30,70,150,100);
$pdf->ln(30);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,"      A.  Identification du vendeur",8,1,'L');
$pdf->Cell(30,6,"Raison Social :",8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6," INVEST AND PAY TECHNOLOGIES",8,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,"NIF:",8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6,"4001199647",8,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,utf8_decode("Registre du Commerce N° :"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(80,6,"03071",8,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,6,"Centre Fiscal:",8,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,"DMC",8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,utf8_decode("BP:"),8,0,'L');
$pdf->Cell(10,6,utf8_decode("TEL:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(80,6,"71310736",8,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,6,utf8_decode("Secteur d'activités :"),8,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,"INFORMATIQUE",8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,utf8_decode("Commune:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,"Mukaza",8,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,utf8_decode("Zone:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(80,6,"Rohero",8,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,utf8_decode("Forme Juridique :"),8,0,'');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,"SURL",8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,utf8_decode("Av:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,6,"AVENUE DE L'ONU ",8,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,utf8_decode("N°:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(80,6,"3",8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,utf8_decode("Assujetti à la TVA :"),8,0,'L');

$pdf->Cell(3,6,"X",8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,utf8_decode("OUI                     NON"),8,1,'L');


$pdf->ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,"      B.  Client",8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,6,utf8_decode("Raison social:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,6,utf8_decode($facture['RAISON']),8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,utf8_decode("NIF:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,utf8_decode($facture['NIF']),8,1,'L');


$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,utf8_decode("Adresse:"),8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,6,utf8_decode($facture['COMMUNE']." ".$facture['ZONE']." ".$facture['QUARTIER']." ".$facture['AV']),8,1,'L');



$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,utf8_decode("Assujetti à la TVA :"),8,0,'L');

if($facture['A_TVA']){
  $pdf->Cell(3,6,"X",8,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,utf8_decode("OUI                     NON"),8,1,'L');
}else{

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(10,6,utf8_decode("OUI"),8,0,'L');
   $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,6,"X",8,0,'R');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(5,6,utf8_decode("NON"),8,1,'L');
}

$pdf->ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,6,utf8_decode("Facture  N° ".$facture['NUMERO_FACTURE']),8,1,'C');

$pdf->ln(5);
// $html=''; // <td width='300' height='50' ALIGN='RIGHT'>".utf8_decode('Désignation')."</td>
$pdf->SetFont('Arial','',12);

$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("C","C","C","C"));
$pdf->Row(array(utf8_decode('Désignation'),utf8_decode('Quantité'),utf8_decode('Prix unitaire'),'Prix Total'));
$pdf->SetFont('Arial','',12);


$detail=$this->Model->getList("facture_detail",array("ID_FACTURE"=>$id));

$tot=0;
foreach ($detail as  $value) {
  $pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$pdf->Row(array(utf8_decode($value['DESIGNATION']),utf8_decode($value['QT']),number_format($value['PU'],0,","," "),number_format($value['PT'],0,","," ")));

$tot+=$value['PT'];
}

$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$pdf->Row(array('Total','','',number_format($tot,0,","," ")));

$pdf->SetFont('Arial','',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$tva=$tot*18/100;
$pdf->Row(array('TVA(18%)','','',number_format($tva,0,","," ")));

$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(array(90,25,35,40));
$pdf->SetAligns(array("L","R","R","R"));
$tvaC=$tot+$tva;
$pdf->Row(array('TOTAL TVAC','','',number_format($tvaC,0,","," ")));

$pdf->ln(10);
$pdf->Cell(190,6,$facture['SIGNATURE_FACTURE'],8,1,'C');
$pdf->ln(10);
$pdf->SetFont('Arial','',12);
$newDate = date("d/m/Y", strtotime($facture['DATE_FACTURE'])); 
$pdf->Cell(190,6,utf8_decode("Fait à Bujumbura le ".$newDate),8,1,'R');
$pdf->Cell(190,6,utf8_decode("Pour la société INVEST AND PAY TECHNOLOGIES"),8,1,'R');


$pdf->Output();
 } 
}

