<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_remote extends CI_Model{

  // $remote= $this->load->database('remote', TRUE);

	function create($table, $data) {

        $query = $this->remote->insert($table, $data);
        return ($query) ? true : false;

    }

    public function get_permission($url)
    {
        $this->remote->select('af.*');
        $this->remote->from('admin_fonctionnalites af');
        $this->remote->join('admin_profil_fonctionnalite afp','afp.FONCTIONNALITE_ID = af.FONCTIONNALITE_ID');
        $this->remote->where('af.FONCTIONNALITE_URL',$url);
        $this->remote->where('afp.PROFIL_ID',$this->session->userdata('PEA_PROFIL_ID'));

        $query = $this->remote->get();
      //  echo $this->remote->last_query();
        if($query){
            return $query->row_array();
        }
    }



    public function verify_colline($colline_id)
    {
       $this->remote->select("cl.*,zn.COMMUNE_ID");
       $this->remote->from("collines cl");
       $this->remote->join("zones zn",'zn.ZONE_ID=cl.ZONE_ID');
       $this->remote->where("cl.COLLINE_ID",$colline_id);

       $query = $this->remote->get();
       if($query){
        return $query->row_array();
       }
    }

    function verification($nom_societe,$adresse_societe, $nom_collaborateur, $prenom_collaborateur)
   {
      $this->remote->where('NOM_SOCIETE', $nom_societe);
      $this->remote->where('ADRESSE_SOCIETE', $adresse_societe);
      $this->remote->where('NOM_COLLABORATEUR', $nom_collaborateur);
      $this->remote->where('PRENOM_COLLABORATEUR', $prenom_collaborateur);
      $query=$this->remote->get('societe_carte_visite');

      if($query->num_rows() == 0)
      {
        return true;
      }else{
        return false;
      }

    }
    public function countHeureMission($critere)
    {
      $this->remote->select('SUM(NB_HEURE_PREVUES) as nbre')
                ->from('phases')
                ->where($critere);
        $query = $this->remote->get();

        if ($query) {
            return $query->row()->nbre;
        }
    }

   public function getDiligencesMacac($ID_MACAC)
    {
       $this->remote->select('dlg.*');
       $this->remote->from('diligences dlg');
       $this->remote->join('phases ph','ph.ID_PHASE=dlg.ID_PHASE');
       $this->remote->where('ph.ID_MACAC',$ID_MACAC);

       $query = $this->remote->get();
       if($query){
         return $query->result_array();
       }
    }
    public function getDataCraDiligence($ID_DILIGENCE,$date)
  {
    $this->remote->select();
    $this->remote->where('ID_DILIGENCE',$ID_DILIGENCE);
    $this->remote->where("DATE_CRA LIKE '%$date%'");
    $this->remote->order_by('ID_CRA','DESC');
    $query = $this->remote->get('cra');

   if($query){
      return $query->row_array();
   }
  }
    public function collaboPhase($ID_PHASE)
    {
      $this->remote->distinct('af.ID_COLLABORATEUR');
      $this->remote->select('af.ID_COLLABORATEUR');
      $this->remote->from('affectations af');
      $this->remote->join('diligences dl','dl.ID_DILIGENCE = af.ID_DILIGENCE');
      $this->remote->where('dl.ID_PHASE',$ID_PHASE);
      
      $query = $this->remote->get();

      if($query){
        return $query->result_array();
      }
    }

    public function collaboMacac($ID_MACAC)
    {
      $this->remote->distinct('af.ID_COLLABORATEUR');
      $this->remote->select('af.ID_COLLABORATEUR');
      $this->remote->from('affectations af');
      $this->remote->join('diligences dl','dl.ID_DILIGENCE = af.ID_DILIGENCE');
      $this->remote->join('phases ph','dl.ID_PHASE = ph.ID_PHASE');
      $this->remote->where('ph.ID_MACAC',$ID_MACAC);
      
      $query = $this->remote->get();

      if($query){
        return $query->result_array();
      }
    }
//SELECT COUNT(*) AS nombre,APPELANT FROM `appels` GROUP BY `APPELANT` , `APPELANT`  2018-10-31

    public function count_nb_appel_par_appelant_critair($DATE_APPEL,$CODE_SOCIETE){

      $this->remote->select('COUNT(*) AS nombre,APPELANT,DATE_APPEL,CODE_SOCIETE');
      $this->remote->from('appels');
      $this->remote->where('DATE_APPEL',$DATE_APPEL);
      $this->remote->where('CODE_SOCIETE',$CODE_SOCIETE);
      $this->remote->group_by('APPELANT');

      $query=$this->remote->get();
      if($query){
        return $query->result_array();
      }
    }

    public function count_nb_appel_par_appelant($CODE_SOCIETE){

      $this->remote->select('COUNT(*) AS nombre,APPELANT');
      $this->remote->from('appels');
      $this->remote->where('CODE_SOCIETE',$CODE_SOCIETE);
      $this->remote->group_by('APPELANT');

      $query=$this->remote->get();
      if($query){
        return $query->result_array();
      }
    }
    public function getCollaboPhase($ID_COLLABORATEUR,$ID_PHASE)
    {
       $this->remote->select("SUM(cr.NB_HEURE_INVEST) as nb_hr_invest");
       $this->remote->from('cra cr');
       $this->remote->join('diligences dlg',"cr.ID_DILIGENCE = dlg.ID_DILIGENCE");
       $this->remote->where("cr.ID_COLLABO",$ID_COLLABORATEUR);
       $this->remote->where("dlg.ID_PHASE",$ID_PHASE);
       $this->remote->group_by("dlg.ID_PHASE");
       
       $query = $this->remote->get();
       if($query){
        return $query->row_array();
       }
    }

    public function getCollaboHeureMacac($ID_COLLABORATEUR,$ID_MACAC)
    {
       $this->remote->select("SUM(cr.NB_HEURE_INVEST) as nb_hr_invest");
       $this->remote->from('phases ph');
       $this->remote->join('diligences dlg','ph.ID_PHASE=dlg.ID_PHASE');
       $this->remote->join('cra cr',"cr.ID_DILIGENCE = dlg.ID_DILIGENCE");
       $this->remote->where("cr.ID_COLLABO",$ID_COLLABORATEUR);
       $this->remote->where("ph.ID_MACAC",$ID_MACAC);
       $this->remote->group_by("ph.ID_PHASE");
       
       $query = $this->remote->get();
       if($query){
        return $query->row_array();
       }
    }


    
    function insert_batch($table,$data){
      
    $query=$this->remote->insert_batch($table, $data);
    return ($query) ? true : false;
    //return ($query)? true:false;

    }
    function getListLimit($table,$limit)
    {
     $this->remote->limit($limit);
     $query= $this->remote->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }
    function getListLimit2($table,$limit,$cond=array())
    {
     $this->remote->limit($limit);
     $this->remote->where($cond);
     $query= $this->remote->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

    function getListLimitwhere($table,$criteres = array(),$limit = NULL)
    {
      $this->remote->limit($limit);
      $this->remote->where($criteres);
     $query= $this->remote->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

  

    function getList_distinct($table,$distinct=array()) {
        $this->remote->select($distinct);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

    function getList_distinct2($table,$distinct=array(),$criteres=array()) {
      $this->remote->where($criteres);
        $this->remote->select($distinct);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

     function getList_distinct_agent($distinct=array(),$criteres=array()) {
      
      $this->remote->select($distinct);
      $this->remote->from('fiche_pulverisation fp');
      $this->remote->join('agn_definition ad', 'ad.DEVICE_ID = fp.DEVICE_ID');
      $this->remote->where($criteres);
      $query = $this->remote->get();
      return $query->result_array();
    }

    function getList_between($table,$critere=array(),$criteres=array()){
        $this->remote->where('NBRE_PIECES_PRINCIPALES >=', $critere);
$this->remote->where('NBRE_PIECES_PRINCIPALES <=', $criteres);
return $this->remote->get($table);
    }

  function update($db2,$table, $criteres, $data) {
        $db2->where($criteres);
        $query = $db2->update($table, $data);
        return ($query) ? true : false;
    }
    function update_batch($table, $criteres, $data) {
        $this->remote->where($criteres);
        $query = $this->remote->update_batch($table, $data);
        return ($query) ? true : false;
    }
  function update_table($table, $criteres, $data) {
        foreach ($data as $key => $value) {
          $this->remote->set($key,$value);
        }
        $this->remote->where($criteres);
        $query = $this->remote->update($table);
        return ($query) ? true : false;
    }  

    function insert_last_id($table, $data) {

        $query = $this->remote->insert($table, $data);
       
       if ($query) {
            return $this->remote->insert_id();
        }

    }

    public function getOneOrder($table,$array= array(),$order_champ,$order_value = 'DESC')
       {
         $this->remote->where($array);
         $this->remote->order_by($order_champ,$order_value);

         $query = $this->remote->get($table);

         if($query){
          return $query->row_array();
         }
       }   


    function getList($db2,$table,$criteres = array()) {
        $db2->where($criteres);
        $query = $db2->get($table);
        return $query->result_array();
    }

    function getListTime($table,$criteres = array(),$time = NULL) {
        $this->remote->where($criteres);
        $this->remote->where($time);
        $query = $this->remote->get($table);
        return $query->result_array();
    }


    function getListOrdertwo($table,$criteres = array(),$order) {
        $this->remote->order_by($order,'ASC');
        $this->remote->where($criteres);
        
        $query = $this->remote->get($table);
        return $query->result_array();
    }


    function checkvalue($table, $criteres) {
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        if($query->num_rows() > 0)
        {
           return true ;
        }
        else{
    return false;
    }
    }



    function getOne($table, $criteres) {
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->row_array();
    }
    function getOneSearch($table, $criteres) {
        $this->remote->like($criteres);
        $query = $this->remote->get($table);
        return $query->row_array();
    }
    function getOneSearch1($table, $criteres) {
        $this->remote->like($criteres);
        $query = $this->remote->get($table);
        return $query->row_array();
    }

   function delete($table,$criteres){
        $this->remote->where($criteres);
        $query = $this->remote->delete($table);
        return ($query) ? true : false;
    }



    function record_count($table)
    {
       $query= $this->remote->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }


    function record_countsome($table, $criteres)
    {
      $this->remote->where($criteres);
       $query= $this->remote->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }



        function getListOrder($table,$criteres)
    {
        $this->remote->order_by($criteres);
      $query= $this->remote->get($table);
      if($query)
      {
          return $query->result_array();
      }
    }


    
	



     function fetch_table($table,$limit,$start,$order,$ordervalue)
    {
     $this->remote->limit($limit,$start);
     $this->remote->order_by($order,$ordervalue);
     $query= $this->remote->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }




        function getToutList($requete) {
        //$this->remote->where($criteres);
       $query = $this->remote->query($requete);
       $result=$query->result_array();
        return $result;
    }
    
    function checkvalue1($table,$champ, $criteres) {
        
        $this->remote->where($champ, $criteres);
        $query = $this->remote->get($table);

        if ($query) {
            return $query->row_array();
        }
       
    }

    public function Listdelegationpersonnel(){
    $data = array();
    $this->remote->select('pd.ID_DELEGATION');
    
    $this->remote->from('personnel_delegation pd');

    $this->remote->group_by('pd.ID_DELEGATION');
    $query=$this->remote->get();
       
    if ($query) {
            return $query->result_array();
        }
    }

    function ListOrder_personnel($table,$condition= array(),$criteres)
    {
        $this->remote->where($condition);
        $this->remote->order_by($criteres);
      $query= $this->remote->get($table);
      if($query)
      {
          return $query->result_array();
      }
    }

public function get_elements($criterepieces=array()){

      /* $this->remote->select('NOM_ELEMENT');
       
      $this->remote->group_by('NOM_ELEMENT');
      $query=$this->remote->get($table);
      return $query->result_array()  ;*/
      
  $this->remote->select("*");
  $this->remote->from('element e');
  $this->remote->join('elements_piece ep', 'ep.CODE_ELEMENT = e.CODE_ELEMENT');
   $this->remote->where("CODE_PIECE",$criterepieces);
  $query = $this->remote->get();
  return $query->result_array();
 
       }
    public function get_ones($table, $champ, $value) {
        $this->remote->where($champ, $value);
        $query = $this->remote->get($table);
        if ($query) {
            return $query->result_array();
        }
    }

//fonction ghislain
function getList_distinct_some($table,$distinct=array(), $value) {
        $this->remote->where($value);
        $this->remote->select($distinct);
        $query = $this->remote->get($table);
        return $query->result_array();
    }


function fetch_table_new($table,$limit,$start,$order,$ordervalue,$criteres)
    {
     $this->remote->where($criteres);
     $this->remote->limit($limit,$start);
     $this->remote->order_by($order,$ordervalue);
     $query= $this->remote->get($table);
     
      if($query)
       {
           return $query->row_array();
       }   
    }

    function findNext($table,$primary_key,$current_id) {
        $sql = "select * from $table where $primary_key = (select min($primary_key) from $table where $primary_key > $current_id)";
        $query = $this->remote->query($sql);
        return $query->row_array();
    }
    function findPrevious($table,$primary_key,$current_id) {
        $sql = "select * from $table where $primary_key = (select max($primary_key) from $table where $primary_key < $current_id)";
        $query = $this->remote->query($sql);
        return $query->row_array();
    }


     function str_sql($sql) {
       
        $query = $this->remote->query($sql);
        return $query->num_rows();
    }



      function str_sql_non_pulveriser($sql) {
       
        $query = $this->remote->query($sql);
        return $query->result_array();
    }

   






    //fonction permettant de se connecter
function login($email,$password)
    {
   $this->remote->where('EMAIL_PRENEUR',$email);
   $this->remote->where('PASSWORD',$password);
   $query=$this->remote->get('preneur');

  if($query->num_rows()==1)
   {
      return $query->row();
    }
  else{
      return false;
      }
   }


   function getListOrdered($table,$order=array(),$criteres = array()) {
        $this->remote->where($criteres);
        $this->remote->order_by($order,"ASC");
        $query = $this->remote->get($table);
        return $query->result_array();
    }

    function record_countsome22($table, $criteres=array(),$cond=array())
    {
      $this->remote->where($criteres);
      $this->remote->where($cond);
       $query= $this->remote->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }
    //alain
     function getCond_distinct($table,$distinct=array(),$where=array(),$where2=array()) {
        $this->remote->select($distinct);
        $this->remote->where($where);
        $this->remote->where($where2);
        $query = $this->remote->get($table);
        return $query->result_array();
    }
    
    function getsomme($table, $column=array(), $cond=array(),$cond2=array())
    {
       $this->remote->select($column);
       $this->remote->where($cond);
       $this->remote->where($cond2);
       $query = $this->remote->get($table);
       return $query->row_array();
    }  

    function getSommes($table, $criteres = array(),$reste) {
        $this->remote->select($reste);
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->row_array();
    }

    function getListDistinct($table,$criteres = array(),$distinctions) {
        $this->remote->select("DISTINCT($distinctions)");
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->result_array();
    }


   function getDate($table, $whereDate,$criteres = array()) {
        $this->remote->where($whereDate);
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

          function get_somme($sum=array(), $table=array(),$cond=array())
    {
        $this->remote->where($cond);
        $this->remote->select($sum);
        $query = $this->remote->get($table);

        if ($query) {
            return $query->row_array();
        }
    }
    public function ListMinute($idReunion){
    $data = array();

     $this->remote->select('titre');
    
    $this->remote->from('points_du_jour');
    $this->remote->where( array('idReunion'=>$idReunion));

    $this->remote->group_by('titre');
    $query=$this->remote->get();
       
    if ($query) {
            return $query->result_array();
        }
    }
public function ListMinute1($idReunion){
    $data = array();

     //$this->remote->select('idPoint');
      $this->remote->distinct('idPoint');

     //$this->remote->select('titre');
    
    $this->remote->from('points_du_jour');
    $this->remote->where( 'idReunion',$idReunion);

   // $this->remote->group_by('idPoint');
    $query=$this->remote->get();
       
    if ($query) {
            return $query->result_array();
        }
    }



    function get_sum2($table, $criteres = array(),$reste) {
        $this->remote->select($reste);
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->row_array();
    }

    function getListo($table,$criteres = array(),$order) {
        $this->remote->where($criteres);
        $this->remote->order_by($order,'ASC');
        $query = $this->remote->get($table);
        return $query->result_array();
    }

      function record_countsome222($table, $criteres=array(),$cond=array(),$cond2=array())
    {
      $this->remote->where($criteres);
      $this->remote->where($cond);
      $this->remote->where($cond2);
       $query= $this->remote->get($table);
       if($query)
       {
           return $query->num_rows();
       }
    }

    public function dsbd_dnmbrma_data($criteres=array(),$group_by,$critere_txt)
    {
      $this->remote->select("COUNT(FICHE_ID) as nbr,SUM(NOMBRE_HABITANTS_MOINS_05) as mois5,SUM(NOMBRE_HABITANTS_PLUS_05) as plus5");
      $this->remote->select($group_by);
      $this->remote->where($criteres);
      $this->remote->where($critere_txt);
      $this->remote->group_by($group_by);

      $query = $this->remote->get('fiche_denombrement_valide_view');

      if($query){
        return $query->result_array();
      } 
    }

    public function dsbd_moyen_habitation_menage($criteres=array(),$critere_txt)
    {
       $this->remote->select("COUNT('mh.ID') as nbhabtmng, th.DESCR,mh.TYPE_HABITATION_ID");
       $this->remote->from('menages_habitation mh');
       $this->remote->join("fiche_denombrement_valide_view fd","fd.CODE_UNIQUE = mh.MENAGES_UNIQ_ID");
       $this->remote->join("type_habitation th","th.TYPE_ID = mh.TYPE_HABITATION_ID");
       if(!empty($criteres)){
         foreach ($criteres as $key => $value) {
           $this->remote->where($key,$value);
         }
       }        
       $this->remote->where("fd.".$critere_txt);
       $this->remote->group_by("mh.TYPE_HABITATION_ID");
       $this->remote->group_by("th.TYPE_ID","ASC");

       $query = $this->remote->get();

       if($query){
          return $query->result_array();
       }
    } 

    public function dsbd_moyen_dependance_menage($criteres=array(),$critere_txt)
    {
       $this->remote->select("COUNT('md.ID') as nbhabtmng, dp.DESCR,md.DEPENDANT_ID");
       $this->remote->from('menages_dependant md');
       $this->remote->join("fiche_denombrement_valide_view fd","fd.CODE_UNIQUE = md.MENAGES_UNIQ_ID");
       $this->remote->join("dependants dp","dp.DEPENDANT_ID = md.DEPENDANT_ID");
       if(!empty($criteres)){
         foreach ($criteres as $key => $value) {
           $this->remote->where($key,$value);
         }
       }        
       $this->remote->where("fd.".$critere_txt);
       $this->remote->group_by("md.DEPENDANT_ID");
       $this->remote->order_by("dp.DEPENDANT_ID","ASC");

       $query = $this->remote->get();

       if($query){
          return $query->result_array();
       }
    }

    public function getCommunesData($PROVINCE_ID,$critere_txt)
    {
       $this->remote->select("SUM(fd.NOMBRE_HABITANTS_MOINS_05) as nbre1,SUM(fd.NOMBRE_HABITANTS_PLUS_05) as nbre2,c.COMMUNE_NAME,c.OBJECTIF");
       $this->remote->from('fiche_denombrement_valide_view fd');
       $this->remote->join('communes c','c.COMMUNE_ID =fd.COMMUNE_ID');
       if($PROVINCE_ID >0)
         $this->remote->where("fd.PROVINCE_ID",$PROVINCE_ID);
       $this->remote->where($critere_txt);
       $this->remote->group_by("fd.COMMUNE_ID");

       $query = $this->remote->get();
       if($query){
         return $query->result_array();
       }
    }
    public function getRejetRaison($critere = array(),$critere_txt='')
    {
       $this->remote->select("COUNT(FICHE_ID) as nbRejets,RAISON");
       if(!empty($critere_txt))
        $this->remote->where($critere_txt);
       $this->remote->where($critere);
       $this->remote->group_by('RAISON');
       $query = $this->remote->get('fiche_denombrement');

       if($query){
        return $query->result_array();
       }

    }

    function get_sum22($table, $criteres = array(),$cond2 = array(),$reste) {
        $this->remote->select($reste);
        $this->remote->where($criteres);
        $this->remote->where($cond2);
        $query = $this->remote->get($table);
        return $query->row_array();
    }
    

public function make_datatables($table,$select_column,$critere_txt,$critere_array=array(),$order_by)
    {
        $this->make_query($table,$select_column,$critere_txt,$critere_array,$order_by);
        if($_POST['length'] != -1){
           $this->remote->limit($_POST["length"],$_POST["start"]);
        }
        $query = $this->remote->get();
        return $query->result();
    }

   public function make_query($table,$select_column=array(),$critere_txt = NULL,$critere_array=array(),$order_by=array())
    {
        $this->remote->select($select_column);
        $this->remote->from($table);

        if($critere_txt != NULL){
            $this->remote->where($critere_txt);
        }
        if(!empty($critere_array))
          $this->remote->where($critere_array);

        if(!empty($order_by)){
            $key = key($order_by);
          $this->remote->order_by($key,$order_by[$key]);  
        }        
          
    }
    public function count_all_data($table,$critere = array(),$critere_txt=NULL)
    {
       $this->remote->select('*');
       $this->remote->where($critere);
       if($critere_txt != NULL)
         $this->remote->where($critere);
       $this->remote->from($table);
       
      //$sql = $this->remote->last_query();       

       return $this->remote->count_all_results();   
    }
  public function get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by)
    {
        $this->make_query($table,$select_column,$critere_txt,$critere_array,$order_by);
        $query = $this->remote->get();
        return $query->num_rows();
        
    }

    function getOne_cond($table, $criteres=array(),$cond2=array()) {
        $this->remote->where($criteres);
        $this->remote->where($cond2);
        $query = $this->remote->get($table);
        return $query->row_array();
    }

    function getList_cond($table,$criteres = array(),$cond=array()) {
        $this->remote->where($criteres);
        $this->remote->where($cond);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

    function getList_distinct22($table,$distinct=array(),$criteres=array(),$cond2=array()) {
      $this->remote->where($criteres);
      $this->remote->where($cond2);
        $this->remote->select($distinct);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

    // public function all_join_valide($cond1,$cond2=array())
    // {
    //    $this->remote->select("PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME, CHEF_MENAGE, ENQUETEUR, fd.LATITUDE, fd.LONGITUDE, count(FICHE_ID) as som");
    //    $this->remote->from('fiche_denombrement_coo fd');
    //    $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
    //    $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
    //    $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
    //    $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
    //    $this->remote->where($cond1);
    //    $this->remote->where($cond2);
    //    $this->remote->group_by("fd.FICHE_ID");
    //    $query = $this->remote->get();
    //    if($query){
    //       return $query->result_array();
    //    }
    // }

    // public function all_join_invalide($cond1,$cond2=array())
    // {
    //    $this->remote->select("PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME, CHEF_MENAGE, ENQUETEUR, RAISON, fd.LATITUDE, fd.LONGITUDE, count(FICHE_ID) as som");
    //    $this->remote->from('fiche_denombrement_rejets_coo fd');
    //    $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
    //    $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
    //    $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
    //    $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
    //    $this->remote->where($cond1);
    //    $this->remote->where($cond2);
    //    $this->remote->group_by("fd.FICHE_ID");
    //    $query = $this->remote->get();
    //    if($query){
    //       return $query->result_array();
    //    }
    // }

    public function all_join_valide($cond1,$cond2=array())
    {
       $this->remote->select("PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME, CHEF_MENAGE, ENQUETEUR, fd.LATITUDE, fd.LONGITUDE, count(FICHE_ID) as som");
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->group_by("PROVINCE_NAME");
       $this->remote->group_by("COMMUNE_NAME");
       $this->remote->group_by("ZONE_NAME");
       $this->remote->group_by("COLLINE_NAME");
       $this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();
       }
    }

    public function all_join_invalide($cond1,$cond2=array())
    {
       $this->remote->select("PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME, CHEF_MENAGE, ENQUETEUR, RAISON, fd.LATITUDE, fd.LONGITUDE, count(FICHE_ID) as som");
       $this->remote->from('fiche_denombrement_rejets_coo fd');
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->group_by("PROVINCE_NAME");
       $this->remote->group_by("COMMUNE_NAME");
       $this->remote->group_by("ZONE_NAME");
       $this->remote->group_by("COLLINE_NAME");
       $this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();
       }
    }
    public function all_by_enqueteur($table,$select,$group,$condi=array())
    {
       $this->remote->select($select);
       $this->remote->where($condi);
       $this->remote->group_by($group);
       $query = $this->remote->get($table);
       if($query){
          return $query->result_array();
       }
    }

    //   public function all_join_enqueteur($cond1,$cond2=array())
    // {
    //    $this->remote->select("fd.PROVINCE_ID,fd.COMMUNE_ID,fd.ZONE_ID,fd.COLLINE_ID,PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME, CHEF_MENAGE,fd.ENQUETEUR, fd.LATITUDE, fd.LONGITUDE,DATE_DENOMBREMENT_D, count(ENQUETEUR) as nbFiches");
    //    $this->remote->from('fiche_denombrement_coo fd');
    //    $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
    //    $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
    //    $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
    //    $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
    //    $this->remote->where($cond1);
    //    $this->remote->where($cond2);
    //    $this->remote->group_by("fd.ENQUETEUR");
    //    $query = $this->remote->get();
    //    if($query){
    //       return $query->result_array();
    //    }
    // }

    public function all_join_enqueteur($cond1,$cond2=array())
    {
       $this->remote->select("fd.PROVINCE_ID,PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME,fd.ENQUETEUR,fd.DATE_DENOMBREMENT_D, count(ENQUETEUR) as nbFiches");
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->group_by("ENQUETEUR");
       $this->remote->group_by("PROVINCE_NAME");
       $this->remote->group_by("COMMUNE_NAME");
       $this->remote->group_by("ZONE_NAME");
       $this->remote->group_by("COLLINE_NAME");
       $this->remote->group_by("DATE_DENOMBREMENT_D");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();
       }
    }

    public function group_all_enqueteur()
    {  
       $this->remote->select("fd.PROVINCE_ID,PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME, COLLINE_NAME,fd.ENQUETEUR, count(ENQUETEUR) as nbEnq");
       $this->remote->from('fiche_denombrement_coo fd');
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->group_by("PROVINCE_NAME, COMMUNE_NAME, ZONE_NAME,COLLINE_NAME,fd.PROVINCE_ID,fd.ENQUETEUR");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();
       }
    }
    //JUDDE

//JUDE


    
    public function all_plus_avg($cond1,$cond2=array())
    {
       $this->remote->select("avg(NOMBRE_HABITANTS_PLUS_05) as moyenne");
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $query = $this->remote->get();
       if($query){
          return $query->row_array();
       }
    }

    public function all_moins_avg($cond1,$cond2=array())
    {
       $this->remote->select("avg(NOMBRE_HABITANTS_MOINS_05) as moyenne");
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $query = $this->remote->get();
       if($query){
          return $query->row_array();
       }
    }

    public function all_structure_avg($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME, avg(NOMBRE_STRUCTURES) as moy");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
        $this->remote->select("ZONE_NAME, avg(NOMBRE_STRUCTURES) as moy");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
        $this->remote->select("COLLINE_NAME, avg(NOMBRE_STRUCTURES) as moy");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, avg(NOMBRE_STRUCTURES) as moy");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    public function all_habitation_avg($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME, avg(NOMBRE_HABITATIONS) as moy");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
        $this->remote->select("ZONE_NAME, avg(NOMBRE_HABITATIONS) as moy");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
        $this->remote->select("COLLINE_NAME, avg(NOMBRE_HABITATIONS) as moy");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, avg(NOMBRE_HABITATIONS) as moy");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }



     public function pulveriser_menage($criteres=array(),$criteres2=array())
    {
       $this->remote->select("fd.CODE_UNIQUE");
       $this->remote->from('fiche_denombrement_coo fd');
       
       $this->remote->join("fiche_pulverisation fp","fp.CODE_UNIQUE = fd.CODE_UNIQUE");
              
       $this->remote->where($criteres);
       $this->remote->where($criteres2);
       //$this->remote->group_by("fd.CODE_UNIQUE");
     

       $query = $this->remote->get();

       if($query){
         return $query->result_array();
       }
    } 


     public function pulveriser_menage_nmbre($criteres=array())
    {
       $this->remote->select("COUNT(fd.FICHE_ID)");
       $this->remote->from('fiche_denombrement_coo fd');
       
       $this->remote->join("fiche_pulverisation fp","fp.CODE_UNIQUE = fd.CODE_UNIQUE");
              
       $this->remote->where($criteres);
       //$this->remote->group_by("fd.CODE_UNIQUE");
     

       $query = $this->remote->get();

       if($query){
         return $query->num_rows();
       }
    } 



  

     public function habitant_pulv_plus($cond1,$cond2=array())
    {
       $this->remote->select("sum(fd.NOMBRE_HABITANTS_PLUS_05) as nbr");
       $this->remote->from('fiche_pulverisation fp');
       $this->remote->join("fiche_denombrement_coo fd","fp.CODE_UNIQUE = fd.CODE_UNIQUE");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $query = $this->remote->get();
       if($query){
          return $query->row_array();
       }
    }

    public function habitant_pulv_moins($cond1,$cond2=array())
    {
       $this->remote->select("sum(fd.NOMBRE_HABITANTS_MOINS_05) as nbr");
       $this->remote->from('fiche_pulverisation fp');
       $this->remote->join("fiche_denombrement_coo fd","fp.CODE_UNIQUE = fd.CODE_UNIQUE");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $query = $this->remote->get();
       if($query){
          return $query->row_array();
       }
    }
    
    public function all_pulverisation_count($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME, count(CODE_UNIQUE) as nbr");
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
          $this->remote->select("ZONE_NAME, count(CODE_UNIQUE) as nbr");
          $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
         $this->remote->select("COLLINE_NAME, count(CODE_UNIQUE) as nbr");
         $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, count(CODE_UNIQUE) as nbr");
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    public function habitation_avg_pulv($cond1,$cond2=array(),$type=array(),$type_hab=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, count(FICHE_ID) as cont");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("PROVINCE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    } 

    public function habitation_avg_pulv_details($cond1,$cond2=array(),$type_hab=array())
    {
       $this->remote->select("count(".$type_hab.") as som");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->where(array($type_hab=>1));
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->row_array();   
       }
    }

    public function dependance_avg_pulv($cond1,$cond2=array(),$type=array(),$type_hab=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, count(DISTINCT(CODE_UNIQUE)) as cont,co.COMMUNE_ID AS ID");
          $this->remote->group_by("fd.COMMUNE_ID");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, count(DISTINCT(CODE_UNIQUE)) as cont,zo.ZONE_ID AS ID");
          $this->remote->group_by("fd.ZONE_ID");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, count(DISTINCT(CODE_UNIQUE)) as cont,col.COLLINE_ID AS ID");
         $this->remote->group_by("fd.COLLINE_ID");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("pr.PROVINCE_NAME, count(DISTINCT(CODE_UNIQUE)) as cont,pr.PROVINCE_ID AS ID");
          $this->remote->group_by("fd.PROVINCE_ID,pr.PROVINCE_IDS");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    } 
    
    public function dependance_avg_pulv_details_un($cond1,$cond2=array(),$type_hab)
    {
       $this->remote->select("count(DISTINCT(CODE_UNIQUE)) as som");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->where($type_hab,1);
       $query = $this->remote->get('fiche_pulverisation fd');
       //echo $this->remote->last_query();

       if($query){
          return $query->row_array();   
       }
    }

    public function dependance_avg_pulv_details($cond1,$cond2=array(),$type_hab,$cond3)
    {
       $this->remote->select("count(DISTINCT(CODE_UNIQUE)) as som");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->where($cond3);
       $this->remote->where($type_hab,1);
       $query = $this->remote->get('fiche_pulverisation fd');
       //echo $this->remote->last_query();

       if($query){
          return $query->row_array();   
       }
    }

    public function all_sachet_count($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
          $this->remote->select("ZONE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
          $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
         $this->remote->select("COLLINE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
         $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->group_by("PROVINCE_NAME");
       }
       //print_r($this->remote->querysql());
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    public function all_count_nonpulv($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME");
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
          $this->remote->select("ZONE_NAME");
          $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
         $this->remote->select("COLLINE_NAME");
         $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME");
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    public function all_count_pulv($cond1,$cond2=array())
    {
        $this->remote->from('fiche_pulverisation fd');
        $this->remote->where($cond2);
        $this->remote->where($cond1);
        $query = $this->remote->get();
        return $query->result_array();
    }



//     function nbrfiche($condition=array())

// {

// $this->remote->select('V.ENQUETEUR, V.NbFichValide, R_Dbl.NbFichInValide_Doublons, R_Inv.NbFichInValide, 
// V.NbFichValide+R_Dbl.NbFichInValide_Doublons+R_Inv.NbFichInValide as NbTotalFiches
// from (
//   select ENQUETEUR, PROVINCE_ID,COMMUNE_ID,ZONE_ID,COLLINE_ID,DATE_DENOMBREMENT, count(*) as NbFichValide
//   from fiche_denombrement_coo
//   group by ENQUETEUR
//   ) V
// left join (
//   select ENQUETEUR,PROVINCE_ID,COMMUNE_ID,ZONE_ID,COLLINE_ID,DATE_DENOMBREMENT, count(*) as NbFichInValide_Doublons
//   from fiche_denombrement_rejets_coo
//   where is_doublon=1
//   group by ENQUETEUR
//   ) R_Dbl
// on V.ENQUETEUR=R_Dbl.ENQUETEUR
// left join (
//   select ENQUETEUR,PROVINCE_ID,COMMUNE_ID,ZONE_ID,COLLINE_ID,DATE_DENOMBREMENT, count(*) as NbFichInValide
//   from fiche_denombrement_rejets_coo  
//   where is_doublon=0 
//   group by ENQUETEUR
//   ) R_Inv
// on V.ENQUETEUR=R_Inv.ENQUETEUR');

// $this->remote->where($condition);
// $query = $this->remote->get();
//     if($query)
//     {
//       return $query->result_array();
//     }

// }




function nbrfiche($condition=array())

{

$this->remote->select('V.ENQUETEUR, V.NbFichValide, R_Dbl.NbFichInValide_Doublons, R_Inv.NbFichInValide, 
V.NbFichValide+R_Dbl.NbFichInValide_Doublons+R_Inv.NbFichInValide as NbTotalFiches
from (
  select ENQUETEUR, count(*) as NbFichValide 
  from fiche_denombrement_coo 
  group by ENQUETEUR
  ) V
left join (
  select ENQUETEUR, count(*) as NbFichInValide_Doublons
  from fiche_denombrement_rejets_coo 
  where is_doublon=1
  group by ENQUETEUR
  ) R_Dbl
on V.ENQUETEUR=R_Dbl.ENQUETEUR
left join (
  select ENQUETEUR, count(*) as NbFichInValide
  from fiche_denombrement_rejets_coo 
  where is_doublon=0
  group by ENQUETEUR
  ) R_Inv
on V.ENQUETEUR=R_Inv.ENQUETEUR');
$this->remote->where($condition);
$query = $this->remote->get();
    if($query){
          return $query->result_array();
       }

}

function getRequete($requete){
      $query=$this->remote->query($requete);
      if ($query) {
         return $query->result_array();
      }
    }

    function getRequeteOne($requete){
      $query=$this->remote->query($requete);
      if ($query) {
         // return $query->result_array();
        return $query->row_array();
      }
    }



     public function collines_zones($cond2=array())
    {
       $this->remote->select("*");
       $this->remote->from('zones z');
       $this->remote->join("collines c","c.ZONE_ID = z.ZONE_ID");
       
       $this->remote->where($cond2);
       $this->remote->order_by('COLLINE_NAME','ASC');
       $query = $this->remote->get();
       if($query){
          return $query->result_array();
       }
    }

    function getListo_order($table,$criteres = array(),$order) {
        $this->remote->where($criteres);
        $this->remote->order_by($order,'ASC');
        $query = $this->remote->get($table);
        return $query->result_array();
    }

    function getListSearch($table,$criteres = array(),$search) {
        $this->remote->where($criteres);
        $this->remote->like($search);
        $query = $this->remote->get($table);
        return $query->result_array();
    }



    
function pulverisations_all($critere_txt=array())
{

$sql = "SELECT
    p.code_unique p_code_unique,
    r.code_unique r_code_unique,
    d.code_unique d_code_unique,
    d.chef_menage,
    d.nombre_habitants_moins_05,
    d.nombre_habitants_plus_05,
    p.nombre_habitation,
    p.nombre_sachet,
    p.DEVICE_ID,
    p.FICHE_ID,
    p.PULVERISER_HABITATION1,
    p.PULVERISER_HABITATION2,
    p.PULVERISER_HABITATION3,
    p.PULVERISER_HABITATION4,
    
    p.PULVERISER_CUISINE,
    p.PULVERISER_DOUCHE,
    p.PULVERISER_TOILETTE,
    p.PULVERISER_ETABLE,
    p.PULVERISER_AUTRES,
    prov.province_name,
    c.commune_name,
    z.zone_name,
    col.colline_name,
    d.date_denombrement,
    p.date_pulverisation,
    a.nom,
    m.descr
FROM
    fiche_pulverisation p
LEFT JOIN fiche_denombrement_coo d ON
    p.code_unique = d.code_unique
LEFT JOIN fiche_denombrement_rejets_coo r ON
    p.code_unique = r.code_unique
LEFT JOIN agn_definition a ON
    a.device_id = p.device_id
LEFT JOIN motif_non_pulverisation m ON
    p.motif_non_pulverisation = m.id
LEFT JOIN provinces prov ON
    p.province_id = prov.province_id
LEFT JOIN communes c ON
    p.commune_id = c.commune_id
LEFT JOIN zones z ON
    p.zone_id = z.zone_id
LEFT JOIN collines col ON
p.colline_id = col.colline_id ";

$query = $this->remote->query($sql);
return $query->result_array();

    }



function getListinconu($critere_txt = array()) {
     $sql = "
SELECT
    *
FROM
    pulverisation_closeup
WHERE
    d_code_unique IS NULL AND r_code_unique IS NULL ".$critere_txt;
        $query = $this->remote->query($sql);
        return $query->result_array();
    }




function pulverisations_menage_valide($critere_txt=array())
{

$sql = "SELECT
    p.code_unique p_code_unique,
    r.code_unique r_code_unique,
    d.code_unique d_code_unique,
    d.chef_menage,
    d.nombre_habitants_moins_05,
    d.nombre_habitants_plus_05,
    p.nombre_habitation,
    p.nombre_sachet,
    p.DEVICE_ID,
    p.FICHE_ID,
    p.PULVERISER_HABITATION1,
    p.PULVERISER_HABITATION2,
    p.PULVERISER_HABITATION3,
    p.PULVERISER_HABITATION4,
    
    p.PULVERISER_CUISINE,
    p.PULVERISER_DOUCHE,
    p.PULVERISER_TOILETTE,
    p.PULVERISER_ETABLE,
    p.PULVERISER_AUTRES,
    prov.province_name,
    c.commune_name,
    z.zone_name,
    col.colline_name,
    d.date_denombrement,
    p.date_pulverisation,
    a.nom,
    m.descr
FROM
    fiche_pulverisation p
LEFT JOIN fiche_denombrement_coo d ON
    p.code_unique = d.code_unique
LEFT JOIN fiche_denombrement_rejets_coo r ON
    p.code_unique = r.code_unique
LEFT JOIN agn_definition a ON
    a.device_id = p.device_id
LEFT JOIN motif_non_pulverisation m ON
    p.motif_non_pulverisation = m.id
LEFT JOIN provinces prov ON
    p.province_id = prov.province_id
LEFT JOIN communes c ON
    p.commune_id = c.commune_id
LEFT JOIN zones z ON
    p.zone_id = z.zone_id
LEFT JOIN collines col ON
p.colline_id = col.colline_id
 WHERE d.code_unique is not null
  AND r.code_unique is null ".$critere_txt ;

$query = $this->remote->query($sql);
return $query->result_array();

    }



function pulverisations_menage_inconu($critere_txt=array())
{

$sql = "SELECT
    p.code_unique p_code_unique,
    r.code_unique r_code_unique,
    d.code_unique d_code_unique,
    d.chef_menage,
    d.nombre_habitants_moins_05,
    d.nombre_habitants_plus_05,
    p.nombre_habitation,
    p.nombre_sachet,
    p.DEVICE_ID,
    p.FICHE_ID,
    p.PULVERISER_HABITATION1,
    p.PULVERISER_HABITATION2,
    p.PULVERISER_HABITATION3,
    p.PULVERISER_HABITATION4,
    
    p.PULVERISER_CUISINE,
    p.PULVERISER_DOUCHE,
    p.PULVERISER_TOILETTE,
    p.PULVERISER_ETABLE,
    p.PULVERISER_AUTRES,
    prov.province_name,
    c.commune_name,
    z.zone_name,
    col.colline_name,
    d.date_denombrement,
    p.date_pulverisation,
    a.nom,
    m.descr
FROM
    fiche_pulverisation p
LEFT JOIN fiche_denombrement_coo d ON
    p.code_unique = d.code_unique
LEFT JOIN fiche_denombrement_rejets_coo r ON
    p.code_unique = r.code_unique
LEFT JOIN agn_definition a ON
    a.device_id = p.device_id
LEFT JOIN motif_non_pulverisation m ON
    p.motif_non_pulverisation = m.id
LEFT JOIN provinces prov ON
    p.province_id = prov.province_id
LEFT JOIN communes c ON
    p.commune_id = c.commune_id
LEFT JOIN zones z ON
    p.zone_id = z.zone_id
LEFT JOIN collines col ON
p.colline_id = col.colline_id
 WHERE d.code_unique is null
  AND r.code_unique is null ".$critere_txt ;

$query = $this->remote->query($sql);
return $query->result_array();

    }



function pulverisations_menage_rejet($critere_txt=array())
{

$sql = "SELECT
    p.code_unique p_code_unique,
    r.code_unique r_code_unique,
    d.code_unique d_code_unique,
    d.chef_menage,
    d.nombre_habitants_moins_05,
    d.nombre_habitants_plus_05,
    p.nombre_habitation,
    p.nombre_sachet,
    p.DEVICE_ID,
    p.FICHE_ID,
    p.PULVERISER_HABITATION1,
    p.PULVERISER_HABITATION2,
    p.PULVERISER_HABITATION3,
    p.PULVERISER_HABITATION4,
   
    p.PULVERISER_CUISINE,
    p.PULVERISER_DOUCHE,
    p.PULVERISER_TOILETTE,
    p.PULVERISER_ETABLE,
    p.PULVERISER_AUTRES,
    prov.province_name,
    c.commune_name,
    z.zone_name,
    col.colline_name,
    d.date_denombrement,
    p.date_pulverisation,
    a.nom,
    m.descr
FROM
    fiche_pulverisation p
LEFT JOIN fiche_denombrement_coo d ON
    p.code_unique = d.code_unique
LEFT JOIN fiche_denombrement_rejets_coo r ON
    p.code_unique = r.code_unique
LEFT JOIN agn_definition a ON
    a.device_id = p.device_id
LEFT JOIN motif_non_pulverisation m ON
    p.motif_non_pulverisation = m.id
LEFT JOIN provinces prov ON
    p.province_id = prov.province_id
LEFT JOIN communes c ON
    p.commune_id = c.commune_id
LEFT JOIN zones z ON
    p.zone_id = z.zone_id
LEFT JOIN collines col ON
p.colline_id = col.colline_id
 WHERE d.code_unique is null
  AND r.code_unique is not null ".$critere_txt ;

$query = $this->remote->query($sql);
return $query->result_array();

    }

    public function count_item_cond($table,$critere = array())
    {
     
       $this->remote->where($critere);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    }


    public function count_item_cond_search($table,$critere = array(),$search)
    {
     
      $this->remote->like($search);
       $this->remote->where($critere);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    }

    public function count_item_notIn($table,$table2,$colone,$critere = array())
    {
     $info=$this->getList($table2);
     $CODE_UNIQUE = array_column($colone, $info);
      // print_r($CODE_UNIQUE);
       $this->remote->where($critere);
       $this->remote->where_not_in($colone, $CODE_UNIQUE);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    }
     public function count_item_notIn_search($table,$table2,$colone,$critere = array(),$search = array())
    {
     $info=$this->getList($table2);
     $CODE_UNIQUE = array_column($colone, $info);
      // print_r($CODE_UNIQUE);
     $this->remote->like($search);
       $this->remote->where($critere);
       $this->remote->where_not_in($colone, $CODE_UNIQUE);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    }

    public function all_places_denombrement($cond1,$type=array())
    {
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->where($cond1);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, fd.COMMUNE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("COMMUNE_NAME, fd.COMMUNE_ID");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, fd.ZONE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("ZONE_NAME, fd.ZONE_ID");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, fd.COLLINE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
         $this->remote->group_by("COLLINE_NAME, fd.COLLINE_ID");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("PROVINCE_NAME, fd.PROVINCE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("PROVINCE_NAME ,fd.PROVINCE_ID");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    } 

    

    

    

    



    public function all_places_pulv_visite($cond1,$type=array(),$cond3=array())
    {
       $this->remote->select("count(FICHE_ID) as cont");
       $this->remote->where($cond1);
       $this->remote->where($cond3);
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->result_array();   
       }
    }

    public function all_pulv_total($cond1,$type=array(),$cond3=array())
    {
       $this->remote->select("count(FICHE_ID) as cont");
       $this->remote->where($cond1);
       $this->remote->where($cond3);
       $this->remote->where('fd.STATUT_PULVERISATION = 1');
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->result_array();   
       }
    }

    public function all_pulv_partiel($cond1,$type=array(),$cond3=array())
    {
       $this->remote->select("count(FICHE_ID) as cont");
       $this->remote->where($cond1);
       $this->remote->where($cond3);
       $this->remote->where('fd.STATUT_PULVERISATION = 2');
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->result_array();   
       }
    }
    function getListDistinctOrderedDate($table,$criteres = array()) {

        $this->remote->select("DISTINCT(date_format(DATE_PULVERISATION,'%Y-%m-%d')) as jour");
        $this->remote->order_by('jour','ASC');
        $this->remote->where($criteres);
        $query = $this->remote->get($table);
        return $query->result_array();
    }

   public function all_pulv_non($cond1,$type=array(),$cond3=array())
    {
       $this->remote->select("count(FICHE_ID) as cont");
       $this->remote->where($cond1);
        $this->remote->where($cond3);
       $this->remote->where('fd.STATUT_PULVERISATION = 3');
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->result_array();   
       }
    }  

    function querysql($sql){
    $query=$this->remote->query($sql);
    return $query->result_array();
    //return $query->row_array();

  }

  public function make_datatables1($table,$select_column,$critere_txt,$critere_array=array(),$order_by,$critaire_search=array())
    {
        $this->make_query($table,$select_column,$critere_txt,$critere_array,$order_by,$critaire_search=array());
        if($_POST['length'] != -1){
           $this->remote->limit($_POST["length"],$_POST["start"]);
        }
        $query = $this->remote->get();
        return $query->result();
    }

   public function make_query1($table,$select_column=array(),$critere_txt = NULL,$critere_array=array(),$order_by=array(),$critaire_search=array())
    {
        $this->remote->select($select_column);
        $this->remote->from($table);

        if($critere_txt != NULL){
            $this->remote->where($critere_txt);
        }
        if(!empty($critere_array))
          $this->remote->where($critere_array);

        if(!empty($order_by)){
            $key = key($order_by);
          $this->remote->order_by($key,$order_by[$key]);  
        }   

        if(!empty($critaire_search)){
            $key = key($order_by);
          $this->remote->like($critaire_search);  
        }      
          
    }
   
 public function get_filtered_data1($table,$select_column,$critere_txt,$critere_array,$order_by,$critere_seach=array())
    {
        $this->make_query1($table,$select_column,$critere_txt,$critere_array,$order_by,$critere_seach);
        $query = $this->remote->get();
        return $query->num_rows();
        
    }
    public function count_all_data1($table,$critere = array(),$critere_txt=NULL,$critere_seach=NULL)
    {
       $this->remote->select('*');
       $this->remote->where($critere);
       if($critere_txt != NULL)
         $this->remote->where($critere_txt);
       if($critere_seach != NULL)
         $this->remote->like($critere_seach);
       $this->remote->from($table);
       
      //$sql = $this->remote->last_query();       

       return $this->remote->count_all_results();   
    }

    public function all_moy_sachet($cond1,$cond2=array(),$type=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
        if($type == 2){
          $this->remote->select("COMMUNE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
          $this->remote->select("ZONE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
          $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
         $this->remote->select("COLLINE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
         $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, sum(NOMBRE_SACHET) as nbr, count(FICHE_ID) as menage");
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }
    
    public function all_places_denombrement2($cond1,$type=array())
    {
       $this->remote->from('fiche_denombrement_coo fd');
       $this->remote->where($cond1);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, fd.COMMUNE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, fd.ZONE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, fd.COLLINE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("PROVINCE_NAME, fd.PROVINCE_ID, count(FICHE_ID) as cont, sum(NOMBRE_HABITANTS_MOINS_05) as moins5, sum(NOMBRE_HABITANTS_PLUS_05) as plus5");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }



     public function habitant_pulverise_par($type=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->join("fiche_denombrement_coo fde","fde.CODE_UNIQUE = fd.CODE_UNIQUE");
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");

        if($type == 2){
          $this->remote->select("COMMUNE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
        $this->remote->select("ZONE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
        $this->remote->select("COLLINE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    function getRequeteOne22($requete,$cond=array(), $cond2=array()){
      $query=$this->remote->query($requete);
      $this->remote->where($cond);
      $this->remote->where($cond2);
      if ($query) {
         // return $query->result_array();
        return $query->row_array();
      }
    }


  public function habitant_pulverise_par_rejet($cond=array())
    {  
       $this->remote->select("sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
       $this->remote->where($cond);
       $this->remote->where("denrej.CODE_UNIQUE NOT IN (SELECT CODE_UNIQUE FROM fiche_denombrement_coo) AND denrej.IS_DOUBLON =0");
       $this->remote->from('fiche_pulverisation as pulv');
       $this->remote->join("fiche_denombrement_rejets_coo as denrej","denrej.CODE_UNIQUE = pulv.CODE_UNIQUE");

       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->row_array();   
       }
    }
     public function habitation_avg_pulvV2($cond1,$cond2=array(),$type=array(),$type_hab=array(),$cond3=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->where($cond3);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, count(FICHE_ID) as cont");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("PROVINCE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    } 

     public function habitation_avg_pulv_detailsV2($cond1,$cond2=array(),$type_hab=array(),$cond3=array())
    {
       $this->remote->select("count(".$type_hab.") as som");
       $this->remote->where($cond1);
       $this->remote->where($cond2);
       $this->remote->where($cond3);
       $this->remote->where(array($type_hab=>1));
       $query = $this->remote->get('fiche_pulverisation fd');
       if($query){
          return $query->row_array();   
       }
    }


  public function habitant_pulverise_par1($type=array(),$v)
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->join("fiche_denombrement_coo fde","fde.CODE_UNIQUE = fd.CODE_UNIQUE");
       $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
       $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
       $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
       $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->where(array('ETAPE'=>$v));

        if($type == 2){
          $this->remote->select("COMMUNE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 3){
        $this->remote->select("ZONE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 4){
        $this->remote->select("COLLINE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->select("PROVINCE_NAME, sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }

    public function habitant_pulverise_par_rejet1($cond=array(),$v)
    {  
       $this->remote->select("sum(NOMBRE_HABITANTS_PLUS_05) as plus5, sum(NOMBRE_HABITANTS_MOINS_05) as moins5");
       $this->remote->where($cond);
       $this->remote->where("denrej.CODE_UNIQUE NOT IN (SELECT CODE_UNIQUE FROM fiche_denombrement_coo) AND denrej.IS_DOUBLON =0");
       $this->remote->where(array('ETAPE'=>$v));
       $this->remote->from('fiche_pulverisation as pulv');
       $this->remote->join("fiche_denombrement_rejets_coo as denrej","denrej.CODE_UNIQUE = pulv.CODE_UNIQUE");

       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->row_array();   
       }
    }

    
     public function habitation_avg_pulvV1($cond1,$type=array(),$type_hab=array(),$cond3=array())
    {
       $this->remote->from('fiche_pulverisation fd');
       $this->remote->where($cond1);
       $this->remote->where($cond3);
        if($type == 1){
          $this->remote->join("communes co","fd.COMMUNE_ID = co.COMMUNE_ID");
          $this->remote->select("COMMUNE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("COMMUNE_NAME");
       }else if($type == 2){
        $this->remote->join("zones zo","fd.ZONE_ID = zo.ZONE_ID");
        $this->remote->select("ZONE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("ZONE_NAME");
       }else if($type == 3){
        $this->remote->join("collines col","fd.COLLINE_ID = col.COLLINE_ID");
        $this->remote->select("COLLINE_NAME, count(FICHE_ID) as cont");
         $this->remote->group_by("COLLINE_NAME");
       }else{
        $this->remote->join("provinces pr","fd.PROVINCE_ID = pr.PROVINCE_ID");
        $this->remote->select("PROVINCE_NAME, count(FICHE_ID) as cont");
          $this->remote->group_by("PROVINCE_NAME");
       }
       //$this->remote->group_by("fd.FICHE_ID");
       $query = $this->remote->get();
       if($query){
          return $query->result_array();   
       }
    }
    public function count_item_cond_critaire($table,$selection=array(),$critere = array())
    {
       $this->remote->where($selection);
       $this->remote->where($critere);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    }

    public function count_item_cond_search_critaire($table,$selection=array(),$critere = array(),$search)
    {
       $this->remote->where($selection);
       $this->remote->like($search);
       $this->remote->where($critere);
       $this->remote->from($table);
       return $this->remote->count_all_results();   
    } 



 public function datatable($requete)//make_datatables : requete avec Condition,LIMIT start,length
 { 
        $query =$this->maker($requete);//call function make query
        return $query->result();
      }  
    public function maker($requete)//make query
    {
      return $this->remote->query($requete);
    }

    public function all_data($requete)//count_all_data : requete sans Condition sans LIMIT start,length
    {
       $query =$this->maker($requete); //call function make query
       return $query->num_rows();   
     }
     public function filtrer($requete)//get_filtered_data : requete avec Condition sans LIMIT start,length
     {
         $query =$this->maker($requete);//call function make query
         return $query->num_rows();
         
       }

    
}