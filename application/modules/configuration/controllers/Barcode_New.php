<?php
class Barcode_New  extends CI_Controller{
    function __construct() {
        parent::__construct();
        

      }

  
    public function index($id)
    { 
      // $data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');
      $data['prod'] = $this->Model->getRequeteOne('SELECT * FROM req_requisition JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT where ID_REQUISITION ='.$id.' ');


      $files = glob(FCPATH . 'barCode//{,.}*', GLOB_BRACE);// get all file names
      foreach($files as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }



      $principal= time(); 
      $ID_PRODUIT=$this->input->post('ID_PRODUIT');
      $nombre=$this->input->post('NOMBRE');
      for ($i=0; $i < $nombre; $i++) {
      // GENERATE
          $string =  $principal.'-'.$i;
        $this->set_barcode($string);
      }
      $produit = $this->Model->getOne('saisie_produit',array('ID_PRODUIT'=>$ID_PRODUIT));
      
      $data['produit']=$produit;
      $data['product_id']=$ID_PRODUIT;
      $data['barcode']=$nombre;
      $data['nombre']=$nombre;
      $data['principal']=$principal;
      $this->load->view('Barcode_New_View',$data);

    }

    private function set_barcode($code)
    {

      // Load library
      $this->load->library('zend');
      // Load in folder Zend
      $this->zend->load('Zend/Barcode');
      // Generate barcode
      // Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
         $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
     // $code = time().$code;
     $store_image = imagepng($file,FCPATH . "barCode/{$code}.png");
    }

  }