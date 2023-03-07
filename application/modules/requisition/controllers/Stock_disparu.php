<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_disparu extends CI_Controller {

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
      $data['stitle']='Stock disparu détail';

      if($dt){
$cond=" AND rd.DATE_TIME>='".$dt."' AND rd.DATE_TIME<='".$dt1."'";
      }else{
$cond="";
      }

                 
                // $resultat=$this->Model->getRequete("SELECT p.*, (SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT) as NOMBRE  FROM saisie_produit p WHERE ID_PRODUIT IN (SELECT ID_PRODUIT FROM req_stock_disparu)   ORDER BY NOM_PRODUIT");
      $resultat=$this->Model->getRequete("SELECT NOM,PRENOM,NOM_PRODUIT,rd.ID_PRODUIT,IFNULL(SUM(QUANTITE),0) NOMBRE,PRIX_VENTE,MAX(rd.DATE_TIME) DATE_TIME FROM req_stock_disparu rd left join saisie_produit p on rd.ID_PRODUIT=p.ID_PRODUIT left join config_user u on rd.ID_USER=u.ID_USER WHERE 1 ".$cond." GROUP BY NOM_PRODUIT,ID_PRODUIT,PRIX_VENTE,NOM,PRENOM ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]=$key['PRIX_VENTE'];
              $point[]=$key['DATE_TIME'];
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

            
      $data['titl']="Stock DISPARU du ". date('d-m-Y');
      $data['points']=$tabledata;
      $data['dt']=$dt;
      $data['dt1']=$dt1;


      $this->load->view('Stock_disparu_View',$data);
    }

         public function detail($dt='',$dt1='')
    {
      $data = array();
    
      $data['stitle']='Stock disparu detail';

      if($dt){
$cond=" AND rd.DATE_TIME>='".$dt."' AND rd.DATE_TIME<='".$dt1."'";
      }else{
$cond="";
      }

                 
                // $resultat=$this->Model->getRequete("SELECT p.*, (SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT) as NOMBRE  FROM saisie_produit p WHERE ID_PRODUIT IN (SELECT ID_PRODUIT FROM req_stock_disparu)   ORDER BY NOM_PRODUIT");
      $resultat=$this->Model->getRequete("SELECT ID_STOCK_DISPARU,NOM,PRENOM,NOM_PRODUIT,rd.ID_PRODUIT,QUANTITE as NOMBRE,PRIX_VENTE,rd.DATE_TIME DATE_TIME FROM req_stock_disparu rd left join saisie_produit p on rd.ID_PRODUIT=p.ID_PRODUIT left join config_user u on rd.ID_USER=u.ID_USER WHERE 1 ".$cond."  ORDER BY NOM_PRODUIT");
       $tabledata=array();
       $i=1;
      foreach ($resultat as $key)
           {
             
              $point=array();
              $point[]=$i;
              $point[]=$key['NOM_PRODUIT'];
              $point[]=$key['NOMBRE'];
              $point[]=$key['PRIX_VENTE'];
              $point[]=$key['DATE_TIME'];
              $point[]=$key['NOM']." ".$key['PRENOM'];
              $point[]="<div class='modal fade' id='desactcat".$key['ID_STOCK_DISPARU']."' tabindex='-1' role='dialog'    aria-labelledby='basicModal' aria-hidden='true'>
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
                           <a href='".base_url("requisition/Stock_disparu/delete/".$key['ID_STOCK_DISPARU'])."/".$dt."/".$dt1."' class='btn btn-primary'>Supprimer</a>
                         </div>
                       </div>
                     </div>
                   </div>
                             <div class='dropdown '>
                                       <a class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       <li><a class='dropdown-item' href='".base_url("requisition/Stock_disparu/update/".$key['ID_STOCK_DISPARU'])."'> Modifier </a> </li>
                                       <li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#desactcat".$key['ID_STOCK_DISPARU']."' style='color:red'> Supprimer </a> </li>
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

            
      $data['titl']="Stock DISPARU du ". date('d-m-Y');
      $data['points']=$tabledata;
      $data['dt']=$dt;
      $data['dt1']=$dt1;


      $this->load->view('Stock_disparu_View',$data);
    }

    public function delete($id,$dt='',$dt1=''){

      $this->Model->delete("req_stock_disparu",array("ID_STOCK_DISPARU"=>$id));

       $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('requisition/Stock_disparu/detail/'.$dt.'/'.$dt1));  
    }

    public function nouveau(){
      $data['stitle']='Enregistrer Stock disparu ';
      $data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');
      $this->load->view('Stock_disparu_add_View',$data);
    }

    public function save_nouveau(){
      $data=array(
            "ID_PRODUIT"=>$this->input->post("ID_PRODUIT"),
            "QUANTITE"=>$this->input->post("QT"),
            "PRIX_VENTE"=>$this->input->post("PRIX_VENTE"),
            "ID_SOCIETE"=>$this->session->userdata('STRAPH_ID_SOCIETE'),
            "ID_USER"=>$this->session->userdata('STRAPH_ID_USER'),
      );

      $this->Model->create("req_stock_disparu",$data);

      redirect(base_url('requisition/Stock_disparu/'));  
    }

    public function update($id){
      $data['stitle']='Modification Stock disparu ';
      $data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');
      $data['disp']=$this->Model->getOne('req_stock_disparu',array("ID_STOCK_DISPARU"=>$id));
      $this->load->view('Stock_disparu_update_View',$data);
    }

    public function save_modifier($id){
       $data=array(
            "ID_PRODUIT"=>$this->input->post("ID_PRODUIT"),
            "QUANTITE"=>$this->input->post("QT"),
            "PRIX_VENTE"=>$this->input->post("PRIX_VENTE"),
            "ID_SOCIETE"=>$this->session->userdata('STRAPH_ID_SOCIETE'),
            "ID_USER"=>$this->session->userdata('STRAPH_ID_USER'),"ENVOIE"=>0
      );

      $this->Model->update("req_stock_disparu",array("ID_STOCK_DISPARU"=>$id),$data);

      redirect(base_url('requisition/Stock_disparu/detail'));  
    }
}
