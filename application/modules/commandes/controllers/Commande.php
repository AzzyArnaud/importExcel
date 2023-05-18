<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Controller {

    
   
   public function index()
   {
      $data['data']= $this->Model->getRequete('SELECT ID_COMMANDE,commandes.USER_ID as USER,config_user.NOM as NOM,config_user.PRENOM as PRENOM,NOM_USER,PRENOM_USER,DATETIME,PRIX_COMMANDE,STATUT,users.TELEPHONE,(select count(ID_COMMANDE_DETAIL) from commande_detail where ID_COMMANDE=commandes.ID_COMMANDE) as DETAIL FROM commandes join users ON commandes.ID_CLIENT=users.USER_ID left join config_user ON commandes.USER_ID=config_user.ID_USER WHERE 1 GROUP BY ID_COMMANDE');

      $this->load->view('Commande_View', $data);
   }

   public function commande_non_traite()
   {
      $data['data']= $this->Model->getRequete('SELECT ID_COMMANDE,commandes.USER_ID as USER,config_user.NOM as NOM,config_user.PRENOM as PRENOM,NOM_USER,PRENOM_USER,DATETIME,PRIX_COMMANDE,STATUT,users.TELEPHONE,(select count(ID_COMMANDE_DETAIL) from commande_detail where ID_COMMANDE=commandes.ID_COMMANDE) as DETAIL FROM commandes join users ON commandes.ID_CLIENT=users.USER_ID left join config_user ON commandes.USER_ID=config_user.ID_USER WHERE STATUT=0 GROUP BY ID_COMMANDE');

      $this->load->view('Commande_Non_Traite.php', $data);
   }

   public function personne_non_trouve()
   {
      $data['data']= $this->Model->getRequete('SELECT ID_COMMANDE,commandes.USER_ID as USER,config_user.NOM as NOM,config_user.PRENOM as PRENOM,NOM_USER,PRENOM_USER,DATETIME,PRIX_COMMANDE,STATUT,users.TELEPHONE,(select count(ID_COMMANDE_DETAIL) from commande_detail where ID_COMMANDE=commandes.ID_COMMANDE) as DETAIL FROM commandes join users ON commandes.ID_CLIENT=users.USER_ID left join config_user ON commandes.USER_ID=config_user.ID_USER WHERE STATUT=2 GROUP BY ID_COMMANDE');

      $this->load->view('Personne_Non_Trouve.php', $data);
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
    public function traite($statut,$ID_COMMANDE)
    {
      $this->Model->update('commandes',array('ID_COMMANDE'=>$ID_COMMANDE),array('STATUT'=>$statut,'USER_ID'=>$this->session->userdata('STRAPH_ID_USER')));

      
      $message = "<div class='alert alert-success' id='message'>
                            Utilisateur désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('commandes/Commande'));  
    }
  
  function get($id)
    {
    
    $query_principal = 'SELECT commande_detail.ID_PRODUIT,NOM_PRODUIT,PU,QUANTITE,PT FROM commande_detail join saisie_produit ON commande_detail.ID_PRODUIT=saisie_produit.ID_PRODUIT where commande_detail.ID_COMMANDE=' . $id;

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
    // print_r($fetch_cov_frais);
    foreach ($fetch_cov_frais as $row) {
    $post = array();
    $post[] = $u++;
    $post[] = $row->NOM_PRODUIT;
    $post[] = $row->PU;
    $post[] = $row->QUANTITE;
    $post[] = $row->PT;
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
}