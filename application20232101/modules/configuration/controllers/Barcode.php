<?php
class Barcode  extends CI_Controller{
    function __construct() {
        parent::__construct();
        

      }

  
    public function index()
    {

      $files = glob(FCPATH . 'barCode//{,.}*', GLOB_BRACE);// get all file names
      foreach($files as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }



      $principal= time(); 
      $nombre=$this->input->post('NOMBRE');
      for ($i=0; $i < $nombre; $i++) {
      // GENERATE
          $string =  $principal.'-'.$i;;
        $this->set_barcode($string);
      }

      
      $data['barcode']=$nombre;
      $data['nombre']=$nombre;
      $data['principal']=$principal;
      $this->load->view('Barcode_View',$data);

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