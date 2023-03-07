<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->Is_Connected();
    }

    public function Is_Connected()
       {
       if (empty($this->session->userdata('STRAPH_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }



    public function index()
    {
      $data = array();
      
      if ($this->session->userdata('BANCOBU_PROFIL_ID') == 0) {
          $BANCOBU_ID_USER = $this->session->userdata('BANCOBU_ID_USER');
          $employe = ' AND `ID_EMPLOYE` = '.$BANCOBU_ID_USER.'';
        }
        else{
          $BANCOBU_ID_USER = $this->session->userdata('BANCOBU_ID_USER');  
          $employe = ' ';

        }
        
   
         $data['creditconge']=$this->Model->getRequete(' SELECT conge_credit.ID_CREDIT, config_exercice.DESCRIPTION AS EXERCICE, conge_credit.ID_EMPLOYE, conge_credit.NB_JOURS_CREDITE, conge_credit.NB_JOURS_RESTANT, conge_credit.DEBUT_CREDIT, conge_credit.FIN_CREDIT, IF(conge_credit.STATUS = 1, "Actif", "Innactif") AS STATUS, config_type_conge.NOM_CONGE FROM `conge_credit` JOIN config_exercice ON config_exercice.ID_EXERCICE = conge_credit.ID_EXERCICE JOIN config_type_conge ON config_type_conge.ID_TYPE_CONGE = conge_credit.ID_TYPE_CONGE WHERE  1  '.$employe.' ');

         $data['listconge']=$this->Model->getRequete('SELECT conge_demande_conge.ID_DEMANDE_CONGE, config_type_conge.NOM_CONGE, config_exercice.DESCRIPTION AS EXERCICE, conge_demande_conge.ID_CREDIT, conge_demande_conge.ID_EMPLOYE, conge_demande_conge.DATE_SYSTEME_DEMANDE, conge_status_conge.DESCRIPTION , conge_demande_conge.NB_JOURS_DEMANDE, conge_demande_conge.NB_JOURS_ACCORDE, conge_demande_conge.DATE_DERNIER_REPOSE, DATEDIFF(conge_demande_conge.DATE_DERNIER_REPOSE , conge_demande_conge.DATE_SYSTEME_DEMANDE) AS DIFF, conge_demande_conge.DATE_DEBUT_CONGE_ACCORDE FROM conge_demande_conge JOIN config_exercice ON config_exercice.ID_EXERCICE = conge_demande_conge.ID_EXERCICE JOIN config_type_conge ON config_type_conge.ID_TYPE_CONGE = conge_demande_conge.ID_TYPE_CONGE JOIN conge_status_conge ON conge_status_conge.STATUS_CONGE = conge_demande_conge.STATUS_CONGE WHERE  1  '.$employe.' ');

         
      $data['stitle']='Profil';
      $this->load->view('Profil_View',$data);
    }




}
?>