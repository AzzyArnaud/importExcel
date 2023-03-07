<?php 
 /**
  * 
  */
 class Entree_Stock_new extends CI_Controller
 {
  
  function __construct()
  {
    parent::__construct();
    $this->load->library('Mylibrary');
    $this->ci = & get_instance();
    $this->ci->load->library("user_agent");
    // $this->Is_Connected();

    }

  public function Is_Connected()
       {

       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

          public function Is_permis()
       {

       // if ($this->mylibrary->get_permission('Mettre_Carburant') ==0)
       //  {
       //   redirect(base_url('Login/'));
       //  }
       }




  public function save_scan()
  {


     $data_qr = array(
               'BARCODE'=>$this->input->post('BARCODE'),                                   
               'ID_REQUISITION'=>$this->input->post('ID_REQUISITION'),                                   
               'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),                                   
               'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),
               'STATUS'=>1,
               'ID_SOCIETE'=>$this->session->userdata('STRAPH_ID_SOCIETE'),
              );

     

     // print_r($data_qr);

     $exist = $this->Model->checkvalue('req_barcode',array('BARCODE'=>$this->input->post('BARCODE')));
     if ($exist) {
        // echo "exist";

      $unique = $this->Model->getRequeteOne('SELECT ID_REQUISITION,DATE_REQUISITION,PRIX_VENTE_UNITAIRE,req_requisition.ID_PRODUIT,saisie_produit.NOM_PRODUIT,QUANTITE FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1 AND ID_REQUISITION = '.$this->input->post('ID_REQUISITION').' AND saisie_produit.ID_PRODUIT = '.$this->input->post('ID_PRODUIT').'  ');
$deja_in_qr = $this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$this->input->post('ID_REQUISITION').' AND req_barcode.ID_PRODUIT = '.$this->input->post('ID_PRODUIT').' ');
     

        $message = $deja_in_qr['NUMBER']."|<div class='alert alert-danger' role='alert' id='message'>
                        Barre code déjà enregistré, veuillez chercher un autre
                        
            </div>";       
        
        // redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     }
     else{
        
       
        $this->Model->create('req_barcode',$data_qr);
        $pexist = $this->Model->checkvalue('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE')));
        if ($pexist) {
           $tupdate = $this->Model->getOne('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE')));
           $crit = array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'));
           $datacr = array('QUANTITE'=>$tupdate['QUANTITE']+1,'STATUS'=>1);
           $this->Model->update('req_stock',$crit,$datacr);
 
        }
            else{
            $this->Model->create('req_stock',array('ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),'QUANTITE'=>1,'STATUS'=>1));
            }

         $unique = $this->Model->getRequeteOne('SELECT ID_REQUISITION,DATE_REQUISITION,PRIX_VENTE_UNITAIRE,req_requisition.ID_PRODUIT,saisie_produit.NOM_PRODUIT,QUANTITE FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1 AND ID_REQUISITION = '.$this->input->post('ID_REQUISITION').' AND saisie_produit.ID_PRODUIT = '.$this->input->post('ID_PRODUIT').'  ');
$deja_in_qr = $this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$this->input->post('ID_REQUISITION').' AND req_barcode.ID_PRODUIT = '.$this->input->post('ID_PRODUIT').' ');


$message = $deja_in_qr['NUMBER']."|<div class='alert alert-success' role='alert' id='message'>
                        Scan et entrée dans le stock enregistre avec succès
                        
            </div>";   
        // redirect(base_url('requisition/Entree_Stock/scan/'.$this->input->post('ID_REQUISITION').'/'.$this->input->post('ID_PRODUIT')));
     }

   echo $message;
  }
}