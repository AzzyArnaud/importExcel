<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_entre_ajustement extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->Is_Connected();
    }

    public function Is_Connected()
    {
       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         // redirect(base_url('Login/'));
        }
    }

     public function index($dt='',$dt1='')
    {
      $data = array();
      $data['stitle']='Entrée Stock ajustement détail';

      if($dt){
$cond=" AND rd.DATE_TIME>='".$dt."' AND rd.DATE_TIME<='".$dt1."'";
      }else{
$cond="";
      }

                 
                // $resultat=$this->Model->getRequete("SELECT p.*, (SELECT IFNULL(SUM(QUANTITE),0) from req_stock_entrer_ajustement where ID_PRODUIT=p.ID_PRODUIT) as NOMBRE  FROM saisie_produit p WHERE ID_PRODUIT IN (SELECT ID_PRODUIT FROM req_stock_entrer_ajustement)   ORDER BY NOM_PRODUIT");
      $resultat=$this->Model->getRequete("SELECT NOM,PRENOM,NOM_PRODUIT,rd.ID_PRODUIT,IFNULL(SUM(QUANTITE),0) NOMBRE,PRIX_VENTE,MAX(DATE) DATE FROM req_stock_entrer_ajustement rd left join saisie_produit p on rd.ID_PRODUIT=p.ID_PRODUIT left join config_user u on rd.ID_USER=u.ID_USER WHERE 1 ".$cond." GROUP BY NOM_PRODUIT,ID_PRODUIT,PRIX_VENTE,NOM,PRENOM ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]=$key['PRIX_VENTE'];
              $point[]=$key['DATE'];
              $point[]=$key['NOM']." ".$key['PRENOM'];
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','QUANTITE','PRIX','DATE','ENREGISTRER PAR'));

            
      $data['titl']="Entrée Stock AJUSTEMENT  du ". date('d-m-Y');
      $data['points']=$tabledata;
      $data['dt']=$dt;
      $data['dt1']=$dt1;
      // exit();


      $this->load->view('Stock_Entree_ajustement_View',$data);
    }

         public function detail($dt='',$dt1='')
    {
      $data = array();
    
      $data['stitle']='Entrée Stock AJUSTEMENT detail';

      if($dt){
$cond=" AND rd.DATE_TIME>='".$dt."' AND rd.DATE_TIME<='".$dt1."'";
      }else{
$cond="";
      }

                 
                // $resultat=$this->Model->getRequete("SELECT p.*, (SELECT IFNULL(SUM(QUANTITE),0) from req_stock_entrer_ajustement where ID_PRODUIT=p.ID_PRODUIT) as NOMBRE  FROM saisie_produit p WHERE ID_PRODUIT IN (SELECT ID_PRODUIT FROM req_stock_entrer_ajustement)   ORDER BY NOM_PRODUIT");
      $resultat=$this->Model->getRequete("SELECT ID_STOCK_AJUSTEMENT,NOM,PRENOM,NOM_PRODUIT,rd.ID_PRODUIT,QUANTITE as NOMBRE,PRIX_VENTE,rd.DATE DATE FROM req_stock_entrer_ajustement rd left join saisie_produit p on rd.ID_PRODUIT=p.ID_PRODUIT left join config_user u on rd.ID_USER=u.ID_USER WHERE 1 ".$cond."  ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]=$key['PRIX_VENTE'];
              $point[]=$key['DATE'];
              $point[]=$key['NOM']." ".$key['PRENOM'];
              $point[]="<div class='modal fade' id='desactcat".$key['ID_STOCK_AJUSTEMENT']."' tabindex='-1' role='dialog'    aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'>Suppression</h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                           <h6>Voulez-vous vraiment supprimer?</h6>
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                           <a href='".base_url("requisition/Stock_entre_ajustement/delete/".$key['ID_STOCK_AJUSTEMENT'])."/".$dt."/".$dt1."' class='btn btn-primary'>Supprimer</a>
                         </div>
                       </div>
                     </div>
                   </div>
                             <div class='dropdown '>
                                       <a class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       <li><a class='dropdown-item' href='".base_url("requisition/Stock_entre_ajustement/update/".$key['ID_STOCK_AJUSTEMENT'])."'> Modifier </a> </li>
                                       <li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#desactcat".$key['ID_STOCK_AJUSTEMENT']."' style='color:red'> Supprimer </a> </li>
                                       </ul>
                                     </div>";
              
              

               $tabledata[]=$point;
               $i++;
                   }

                $template = array(
                    'table_open' => '<table id="d_table" class="table table-bordered table-striped table-hover table-condensed">',
                    'table_close' => '</table>'
                );
                $this->table->set_template($template); 
                $this->table->set_heading(array('#','PRODUIT','QUANTITE','PRIX','DATE','ENREGISTRER PAR','ACTION'));

            
      $data['titl']="Entrée Stock AJUSTEMENT du ". date('d-m-Y');
      $data['points']=$tabledata;
      $data['dt']=$dt;
      $data['dt1']=$dt1;


      $this->load->view('Stock_Entree_ajustement_View',$data);
    }

    public function delete($id,$dt='',$dt1=''){

      $check=$this->Model->getOne("stock_ob",array("ID_STOCK_AJUSTEMENT"=>$id,"statut"=>0));

      if(!empty($check)){
        $this->Model->delete("stock_ob",array("ID_STOCK_AJUSTEMENT"=>$id));
        $this->Model->delete("req_stock_entrer_ajustement",array("ID_STOCK_AJUSTEMENT"=>$id));
  $message = "<div class='alert alert-success'>
                            Suppression avec succes
                      </div>";
       $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('requisition/Stock_entre_ajustement/detail/'.$dt.'/'.$dt1));
      }else{
        // $this->Model->delete("req_stock_entrer_ajustement",array("ID_STOCK_AJUSTEMENT"=>$id));
        $message = "<div class='alert alert-danger'>
                            Echec de suppression car c'est deja envoyé chez OBR
                      </div>";
       $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('requisition/Stock_entre_ajustement/detail/'.$dt.'/'.$dt1));
      }

        
    }

    public function nouveau(){
      $data['stitle']='Enregistrer Stock disparu ';
      $data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');
      $this->load->view('Stock_Entree_ajustement_add_View',$data);
    }

    public function save_nouveau(){

       foreach ($this->cart->contents() as $items){
    
  if(preg_match("/Entrée_Stock/", $items['name'])){

      $data=array(
            "ID_PRODUIT"=>$items['ID_PRODUIT'],
            "QUANTITE"=>$items['QUANTITE'],
            "PRIX_VENTE"=>$items['PRIX_VENTE'],
            "DATE"=>$this->input->post("DATE"),
            "ID_SOCIETE"=>$this->session->userdata('STRAPH_ID_SOCIETE'),
            "ID_USER"=>$this->session->userdata('STRAPH_ID_USER'),
      );

      $id_disp=$this->Model->insert_last_id("req_stock_entrer_ajustement",$data);

      $newDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s"))); 

      $prod=$this->Model->getone("saisie_produit",array("ID_PRODUIT"=>$items['ID_PRODUIT']));

                    $this->Model->create('stock_ob',
                                            array(
                                              "item_code"=>$items['ID_PRODUIT'],
                                              "item_designation"=>$prod["NOM_PRODUIT"],
                                              "item_quantity"=>$items['QUANTITE'],
                                              "item_measurement_unit"=>'Produit',
                                              "item_purchase_or_sale_price"=>$items['PRIX_VENTE'],
                                              "item_purchase_or_sale_currency"=>'BIF',
                                              "item_movement_type"=>'EAJ',
                                              "item_movement_invoice_ref"=>'',
                                              "item_movement_description"=>'Ajustement',
                                              "item_movement_date"=>$newDate,
                                              "ID_STOCK_AJUSTEMENT"=>$id_disp
                                            )
                                          );
    }
    }

    $this->cart->destroy();
      redirect(base_url('requisition/Stock_entre_ajustement/'));  
    }

    public function update($id){
      $data['stitle']='Modification Stock Entreé Ajustement ';
      $data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');
      $data['disp']=$this->Model->getOne('req_stock_entrer_ajustement',array("ID_STOCK_AJUSTEMENT"=>$id));
      $this->load->view('Stock_Entree_ajustement_update_View',$data);
    }

    public function save_modifier($id){

$check=$this->Model->getOne("stock_ob",array("ID_STOCK_AJUSTEMENT"=>$id,"statut"=>0));

      if(!empty($check)){

       $data=array(
            "ID_PRODUIT"=>$this->input->post("ID_PRODUIT"),
            "QUANTITE"=>$this->input->post("QT"),
            "PRIX_VENTE"=>$this->input->post("PRIX_VENTE"),
            "DATE"=>$this->input->post("DATE"),
            "ID_SOCIETE"=>$this->session->userdata('STRAPH_ID_SOCIETE'),
            "ID_USER"=>$this->session->userdata('STRAPH_ID_USER'),"ENVOIE"=>0
      );
$message = "<div class='alert alert-success'>
                            Modification avec succes
                      </div>";
       $this->session->set_flashdata(array('message'=>$message));
      $this->Model->update("req_stock_entrer_ajustement",array("ID_STOCK_AJUSTEMENT"=>$id),$data);
      $this->Model->delete("stock_ob",array("ID_STOCK_AJUSTEMENT"=>$id));
      $newDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s"))); 

      $prod=$this->Model->getone("saisie_produit",array("ID_PRODUIT"=>$this->input->post("ID_PRODUIT")));

                    $this->Model->create('stock_ob',
                                            array(
                                              "item_code"=>$this->input->post("ID_PRODUIT"),
                                              "item_designation"=>$prod["NOM_PRODUIT"],
                                              "item_quantity"=>$this->input->post("QT"),
                                              "item_measurement_unit"=>'Produit',
                                              "item_purchase_or_sale_price"=>$this->input->post("PRIX_VENTE"),
                                              "item_purchase_or_sale_currency"=>'BIF',
                                              "item_movement_type"=>'EAJ',
                                              "item_movement_invoice_ref"=>'',
                                              "item_movement_description"=>'Ajustement',
                                              "item_movement_date"=>$newDate,
                                              "ID_STOCK_AJUSTEMENT"=>$id
                                            )
                                          );

      redirect(base_url('requisition/Stock_entre_ajustement/detail'));  
    }else{
        $message = "<div class='alert alert-danger'>
                            Echec de Modification car c'est deja envoyé chez OBR
                      </div>";
       $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('requisition/Stock_entre_ajustement/detail'));
      }
    }

    function add_cart(){

     // $this->cart->destroy();

      $id=$this->input->post('ID_PRODUIT');

          $data_cart = array(
              'id'      => $id,
              'qty'     => $this->input->post('QUANTITE'),
              'price'   => 0,
              'name'    => 'Entrée_Stock',
              'ID_PRODUIT'=>$this->input->post('ID_PRODUIT'),
              'PRIX_VENTE'=>$this->input->post('PRIX_VENTE'),
              'QUANTITE'=>$this->input->post('QUANTITE')
                    );
      $this->cart->insert($data_cart);

   
    $html = null;
  $i = 1;
  $html .='<table class="table table-bordered">
      <tr class="text-center"><th colspan="8" class="text-center bg-success">Liste des produits</th></tr>
        <tr>
        <th>Produit</th>
        <th>PU</th>
        <th>Q</th>
        <th>PT</th>
        </tr>' ;


              $tot = 0;
  foreach ($this->cart->contents() as $items):
    
  if(preg_match("/Entrée_Stock/", $items['name'])){

    $name = $this->Model->getRequeteOne('SELECT NOM_PRODUIT FROM saisie_produit where ID_PRODUIT = '.$items['ID_PRODUIT'].'');
      $sub_tot = $items['QUANTITE'] *$items['PRIX_VENTE'];
     
      $html .='<tr>' ;
      $html .='<td>'.$name['NOM_PRODUIT'].'</td>
               <td  class="text-right">'.$items['PRIX_VENTE'].'</td>
               <td  class="text-right">'.$items['QUANTITE'].'</td>
               <td  class="text-right">'.$sub_tot.'</td>
               
               <td>
               <button class="btn btn-danger btn-xs" type="button" onclick="remove_medicament(\''.$items['rowid'].'\')">X</button>
               </td>' ;
      $html .='</tr>' ;
      $tot +=$sub_tot;
  }

    $i++;

    

  endforeach;

     echo $html;         

  }
      public function remove_()
    {

     $rowid = $this->input->post('rowid');
    $this->cart->remove($rowid);
    $html = null;
  $i = 1;
  $html .='<table class="table table-bordered">
      <tr class="text-center"><th colspan="8" class="text-center bg-success">Liste des produits</th></tr>
        <tr>
        <th>Produit</th>
        <th>PU</th>
        <th>Q</th>
        <th>PT</th>
        </tr>' ;


              $tot = 0;
  foreach ($this->cart->contents() as $items):
    
  if(preg_match("/Entrée_Stock/", $items['name'])){

    $name = $this->Model->getRequeteOne('SELECT NOM_PRODUIT FROM saisie_produit where ID_PRODUIT = '.$items['ID_PRODUIT'].'');
      $sub_tot = $items['QUANTITE'] *$items['PRIX_VENTE'];
     
      $html .='<tr>' ;
      $html .='<td>'.$name['NOM_PRODUIT'].'</td>
               <td  class="text-right">'.$items['PRIX_VENTE'].'</td>
               <td  class="text-right">'.$items['QUANTITE'].'</td>
               <td  class="text-right">'.$sub_tot.'</td>
               
               <td>
               <button class="btn btn-danger btn-xs" type="button" onclick="remove_medicament(\''.$items['rowid'].'\')">X</button>
               </td>' ;
      $html .='</tr>' ;
      $tot +=$sub_tot;
  }

    $i++;

    

  endforeach;

     echo $html;   
    }

}
