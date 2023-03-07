<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Dashboard extends CI_Model{


	public function get_montant_credit($critere)
    {
      $this->db->select("SUM(fc.MONTANT) as credit, SUM(fc.MONTANT_RETENU) as cotisation, count(fc.ID_CREDIT) as nbPerson");
      $this->db->from('FONDS_CREDIT fc');
      $this->db->join('ACTEURS_MIFA am','fc.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($critere);
      //echo $this->db->last_query();
      $query = $this->db->get(); 

      if($query){
        return $query->row_array();
      }
    }

    public function get_montant_fond($critere)
    {
      $this->db->select("SUM(fcot.MONTANT) as montant");
      $this->db->from('FONDS_COTISATION fcot');
      $this->db->join('FONDS_CREDIT fc','fc.ID_CREDIT=fcot.ID_CREDIT');
      $this->db->join('ACTEURS_MIFA am','fc.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($critere);
      //echo $this->db->last_query();
      $query = $this->db->get(); 

      if($query){
        return $query->row_array();
      }
    }

    public function get_nb_sinistre($critere)
    {
      $this->db->select("COUNT(inc.ID_INCIDENT) as nbSinistres");
      $this->db->from('INCIDENT inc');
      $this->db->join('ACTEURS_MIFA am','inc.DECLARANT=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($critere);
      //echo $this->db->last_query();
      $query = $this->db->get(); 

      if($query){
        return $query->row_array();
      }
    }

    public function get_machine($critere)
    {
      $this->db->select("COUNT(rma.ID_ACTEUR) as nbmachine");
      $this->db->from('RISK_MACHINE_ACTEURS rma');
      $this->db->join('FONDS_CREDIT fc','fc.ID_ACTEUR=rma.ID_ACTEUR');
      $this->db->join('ACTEURS_MIFA am','fc.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($critere);
      $query = $this->db->get(); 

      if($query){
        return $query->row_array();
      }
    }

    public function get_top_declarant_incident($critere)
    {
      $this->db->select("COUNT(inc.ID_INCIDENT) as nbSinistres,am.NOM,am.PRENOM,am.TEL1");
      $this->db->from('INCIDENT inc');
      $this->db->join('ACTEURS_MIFA am','inc.DECLARANT=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      if(!empty($critere))
        $this->db->where($critere);
      $this->db->group_by("inc.DECLARANT");
      $this->db->order_by("nbSinistres");
      $this->db->limit("10");
      $query = $this->db->get(); 

      //echo $this->db->last_query();

      if($query){
        return $query->result_array();
      }
    }
}