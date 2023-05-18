<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Controller {

  function index(){
    $this->load->view('Commande_View');
  }

  function listing(){
    $query_principal='SELECT ID_COMMANDE,NOM_USER,PRENOM_USER,DATETIME,PRIX_COMMANDE,STATUT,COUNT(ID_COMMANDE) as DETAIL FROM commandes join users ON commandes.ID_CLIENT=users.USER_ID WHERE 1 GROUP BY NOM_USER';

    $var_search= !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $limit='LIMIT 0,10';
    $draw = isset($_POST['draw']);
    $start = isset($postData['start']);

    if(isset($_POST["length"]) && $_POST["length"] != -1)
    {
      $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
    }
    $order_by='';
    $order_column='';
    $order_column = array('NOM_USER');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_USER ASC';

    //This is for searching the information in a search bar
    $search = !empty($_POST['search']['value']) ?  (" AND (NOM_USER LIKE '%$var_search%' OR PRENOM_USER LIKE '%$var_search%')") :'';   

    $critaire = ' ';
    $query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;

    $query_filter = $query_principal.' '.$search.' '.$critaire;

    $fetch_cov_frais = $this->Model->datatable($query_secondaire);
    $data = array();
    $u=1;
    foreach($fetch_cov_frais as $info)
    {
    //This foreach is for displaying the information of listing
      // $regionprovince = $this->Model->getRequeteOne('SELECT NOM_PRODUIT,PU,QUANTITE,PT FROM commande_detail join saisie_produit ON commande_detail.ID_PRODUIT=saisie_produit.ID_PRODUIT where commande_detail.ID_PRODUIT =' . $info->ID_PRODUIT . '');

      $post=array();
      $post[]=$u++; 
      $post[]=$info->PRIX_COMMANDE;

      $responsable='';

      $responsable = "<center><a href='javascript:;'  class='btn btn-secondary btn-md' onclick='get_commande(" . $info->ID_PRODUIT . ")'>
      " . $regionprovince['regio'] . "

      </a></center>";
      $post[]=$responsable;

      $action='';
      $action = '<div class="dropdown" style="color:#fff;">
      <a class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Options  <span class="caret"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-left">';


      $post[]=$action;
      $data[] = $post;
    }

    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" =>$this->Model->all_data($query_principal),
      "recordsFiltered" => $this->Model->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }
























































  public function nontraite($ID_COMMANDE)
  {
    $this->Model->update('commandes',array('ID_COMMANDE'=>$ID_COMMANDE),array('STATUT'=>1,"ENVOIE"=>0));
    $message = "<div class='alert alert-success' id='message'>
    Utilisateur Réactivé avec succés
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
    $this->session->set_flashdata(array('message'=>$message));
    redirect(base_url('commandes/Commande'));  
  }
  public function traite($ID_COMMANDE)
  {
    $this->Model->update('commandes',array('ID_COMMANDE'=>$ID_COMMANDE),array('STATUT'=>0,"ENVOIE"=>0));
    $message = "<div class='alert alert-success' id='message'>
    Utilisateur désactivé avec succés
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    </div>";
    $this->session->set_flashdata(array('message'=>$message));
    redirect(base_url('commandes/Commande'));  
  }



}



  // This "get" function is for bringing the information from our tables into our inputs
function get($id)
{
    // $query_principal = 'SELECT NOM_PRODUIT,PU,QUANTITE,PT FROM commande_detail join saisie_produit ON commande_detail.ID_PRODUIT=saisie_produit.ID_PRODUIT where commande_detail.ID_PRODUIT=' . $id  GROUP BY NOM_PRODUIT;

  $query_principal = 'SELECT NOM_PRODUIT,PU,QUANTITE,PT FROM commande_detail join saisie_produit ON commande_detail.ID_PRODUIT=saisie_produit.ID_PRODUIT where commande_detail.ID_PRODUIT=' . $id;

  $var_search = !empty($_POST["search"]["value"]) ? $_POST["search"]["value"] : null;
  $limit = 'LIMIT 0,10';

  $draw = isset($_POST['draw']);
  $start = isset($postData['start']);

  if (isset($_POST["length"]) && $_POST["length"] != -1) {
    $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
  }
  $order_by = '';
  $search = !empty($_POST['search']['value']) ? (" AND (NOM_PRODUIT  LIKE '%$var_search%')") : '';
  $order_column='';
  $order_column = array('NOM_PRODUIT');
  $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY NOM_PRODUIT ASC';

  $critaire = ' ';

  $query_secondaire=$query_principal.' '.$search.' '.$critaire.' '.$order_by.'   '.$limit;
  $query_filter = $query_principal.' '.$search.' '.$critaire;
  $fetch_cov_frais = $this->Model->datatable($query_secondaire);
  $data = array();
  $u = 1;
  foreach ($fetch_cov_frais as $row) {
    $post = array();
    $post[] = $u++;
    $post[] = $info->NOM_PRODUIT;
    $post[] = $row->PU;
    $data[] = $post;
  }

  $output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" =>$this->Model->all_data($query_principal),
    "recordsFiltered" => $this->Model->filtrer($query_filter),
    "data" => $data
  );
  echo json_encode($output);
}