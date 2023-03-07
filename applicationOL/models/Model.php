<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model{

  function create($table, $data) {

        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;

    }
    function insert($table,$data)
  {
    $query= $this->db->insert($table,$data);
    return($query)? true:false;
  }

   
    function insert_batch($table,$data){
      
    $query=$this->db->insert_batch($table, $data);
    return ($query) ? true : false;
    //return ($query)? true:false;

    }
    function getListLimitold($table,$limit)
    {
     $this->db->limit($limit);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

    function getListLimi($table,$limit,$cond=array())
    {
     $this->db->limit($limit);
     $this->db->where($cond);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

    function getListLimitwhere($table,$criteres = array(),$limit = NULL)
    {
      $this->db->limit($limit);
      $this->db->where($criteres);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }

  

    function getList_distinct($table,$distinct_champ='',$criteres=array()) {
        $this->db->select($distinct_champ);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function getList_distinct2($table,$distinct=array(),$criteres=array()) {
      $this->db->where($criteres);
        $this->db->select($distinct);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function getList_between($table,$critere=array(),$criteres=array()){
        $this->db->where('NBRE_PIECES_PRINCIPALES >=', $critere);
$this->db->where('NBRE_PIECES_PRINCIPALES <=', $criteres);
return $this->db->get($table);
    }

  function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
    function update_batch($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update_batch($table, $data);
        return ($query) ? true : false;
    }
  function update_table($table, $criteres, $data) {
        foreach ($data as $key => $value) {
          $this->db->set($key,$value);
        }
        $this->db->where($criteres);
        $query = $this->db->update($table);
        return ($query) ? true : false;
    }  

    function insert_last_id($table, $data) {

        $query = $this->db->insert($table, $data);
       
       if ($query) {
            return $this->db->insert_id();
        }

    }

    public function getOneOrder($table,$array= array(),$order_champ,$order_value = 'DESC')
       {
         $this->db->where($array);
         $this->db->order_by($order_champ,$order_value);

         $query = $this->db->get($table);

         if($query){
          return $query->row_array();
         }
       }   


    function getList($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }
     function getListOne($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
         return $query->row_array();
    }

    function getListTime($table,$criteres = array(),$time = NULL) {
        $this->db->where($criteres);
        $this->db->where($time);
        $query = $this->db->get($table);
        return $query->result_array();
    }


    function getListOrdertwo($table,$criteres = array(),$order) {
        $this->db->order_by($order,'ASC');
        $this->db->where($criteres);
        
        $query = $this->db->get($table);
        return $query->result_array();
    }


    function checkvalue($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
        {
           return true ;
        }
        else{
    return false;
    }
    }



    function getOne($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    function getOneSearch($table, $criteres) {
        $this->db->like($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    function getOneSearch1($table, $criteres) {
        $this->db->like($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

   function delete($table,$criteres){
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }



    function record_count($table)
    {
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }


    function record_countsome($table, $criteres)
    {
      $this->db->where($criteres);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }



        function getListOrder($table,$criteres)
    {
        $this->db->order_by($criteres);
      $query= $this->db->get($table);
      if($query)
      {
          return $query->result_array();
      }
    }


    
  



     function fetch_table($table,$limit,$start,$order,$ordervalue)
    {
     $this->db->limit($limit,$start);
     $this->db->order_by($order,$ordervalue);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }




        function getToutList($requete) {
        //$this->db->where($criteres);
       $query = $this->db->query($requete);
       $result=$query->result_array();
        return $result;
    }
    
    function checkvalue1($table,$champ, $criteres) {
        
        $this->db->where($champ, $criteres);
        $query = $this->db->get($table);

        if ($query) {
            return $query->row_array();
        }
       
    }

    public function Listdelegationpersonnel(){
    $data = array();
    $this->db->select('pd.ID_DELEGATION');
    
    $this->db->from('personnel_delegation pd');

    $this->db->group_by('pd.ID_DELEGATION');
    $query=$this->db->get();
       
    if ($query) {
            return $query->result_array();
        }
    }

    function ListOrder_personnel($table,$condition= array(),$criteres)
    {
        $this->db->where($condition);
        $this->db->order_by($criteres);
      $query= $this->db->get($table);
      if($query)
      {
          return $query->result_array();
      }
    }

public function get_elements($criterepieces=array()){

      /* $this->db->select('NOM_ELEMENT');
       
      $this->db->group_by('NOM_ELEMENT');
      $query=$this->db->get($table);
      return $query->result_array()  ;*/
      
  $this->db->select("*");
  $this->db->from('element e');
  $this->db->join('elements_piece ep', 'ep.CODE_ELEMENT = e.CODE_ELEMENT');
   $this->db->where("CODE_PIECE",$criterepieces);
  $query = $this->db->get();
  return $query->result_array();
 
       }
    public function get_ones($table, $champ, $value) {
        $this->db->where($champ, $value);
        $query = $this->db->get($table);
        if ($query) {
            return $query->result_array();
        }
    }

//fonction ghislain
function getList_distinct_some($table,$distinct=array(), $value) {
        $this->db->where($value);
        $this->db->select($distinct);
        $query = $this->db->get($table);
        return $query->result_array();
    }


function fetch_table_new($table,$limit,$start,$order,$ordervalue,$criteres)
    {
     $this->db->where($criteres);
     $this->db->limit($limit,$start);
     $this->db->order_by($order,$ordervalue);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->row_array();
       }   
    }

    function findNext($table,$primary_key,$current_id) {
        $sql = "select * from $table where $primary_key = (select min($primary_key) from $table where $primary_key > $current_id)";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    function findPrevious($table,$primary_key,$current_id) {
        $sql = "select * from $table where $primary_key = (select max($primary_key) from $table where $primary_key < $current_id)";
        $query = $this->db->query($sql);
        return $query->row_array();
    }



    //fonction permettant de se connecter
function login($email,$password)
    {
   $this->db->where('EMAIL_PRENEUR',$email);
   $this->db->where('PASSWORD',$password);
   $query=$this->db->get('preneur');

  if($query->num_rows()==1)
   {
      return $query->row();
    }
  else{
      return false;
      }
   }


   function getListOrdered($table,$order=array(),$criteres = array()) {
        $this->db->where($criteres);
        $this->db->order_by($order,"ASC");
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function record_countsome22($table, $criteres=array(),$cond=array())
    {
      $this->db->where($criteres);
      $this->db->where($cond);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }
    //alain
     function getCond_distinct($table,$distinct=array(),$where=array(),$where2=array()) {
        $this->db->select($distinct);
        $this->db->where($where);
        $this->db->where($where2);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    
    function getsomme($table, $column=array(), $cond=array(),$cond2=array())
    {
       $this->db->select($column);
       $this->db->where($cond);
       $this->db->where($cond2);
       $query = $this->db->get($table);
       return $query->row_array();
    }  

    function getSommes($table, $criteres = array(),$reste) {
        $this->db->select_sum($reste);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function getListDistinct($table,$criteres = array(),$distinctions) {
        $this->db->select("DISTINCT($distinctions)");
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }


   function getDate($table, $whereDate,$criteres = array()) {
        $this->db->where($whereDate);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }

          function get_somme($sum=array(), $table=array(),$cond=array())
    {
        $this->db->where($cond);
        $this->db->select($sum);
        $query = $this->db->get($table);

        if ($query) {
            return $query->row_array();
        }
    }
    public function ListMinute($idReunion){
    $data = array();

     $this->db->select('titre');
    
    $this->db->from('points_du_jour');
    $this->db->where( array('idReunion'=>$idReunion));

    $this->db->group_by('titre');
    $query=$this->db->get();
       
    if ($query) {
            return $query->result_array();
        }
    }
public function ListMinute1($idReunion){
    $data = array();

     //$this->db->select('idPoint');
      $this->db->distinct('idPoint');

     //$this->db->select('titre');
    
    $this->db->from('points_du_jour');
    $this->db->where( 'idReunion',$idReunion);

   // $this->db->group_by('idPoint');
    $query=$this->db->get();
       
    if ($query) {
            return $query->result_array();
        }
    }



    function get_sum2($table, $criteres = array(),$reste) {
        $this->db->select($reste);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function getListo($table,$criteres = array(),$order) {
        $this->db->where($criteres);
        $this->db->order_by($order,'DESC');
        $query = $this->db->get($table);
        return $query->result_array();
    }

      function record_countsome222($table, $criteres=array(),$cond=array(),$cond2=array())
    {
      $this->db->where($criteres);
      $this->db->where($cond);
      $this->db->where($cond2);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
    }


   

    function get_sum22($table, $criteres = array(),$cond2 = array(),$reste) {
        $this->db->select($reste);
        $this->db->where($criteres);
        $this->db->where($cond2);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    

public function make_datatables($table,$select_column,$critere_txt,$critere_array=array(),$order_by)
    {
        $this->make_query($table,$select_column,$critere_txt,$critere_array,$order_by);
        if($_POST['length'] != -1){
           $this->db->limit($_POST["length"],$_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }

   public function make_query($table,$select_column=array(),$critere_txt = NULL,$critere_array=array(),$order_by=array())
    {
        $this->db->select($select_column);
        $this->db->from($table);

        if($critere_txt != NULL){
            $this->db->where($critere_txt);
        }
        if(!empty($critere_array))
          $this->db->where($critere_array);

        if(!empty($order_by)){
            $key = key($order_by);
          $this->db->order_by($key,$order_by[$key]);  
        }        
          
    }
    public function count_all_data($table,$critere = array())
    {
       $this->db->select('*');
       $this->db->where($critere);
       $this->db->from($table);
       return $this->db->count_all_results();   
    }
  public function get_filtered_data($table,$select_column,$critere_txt,$critere_array,$order_by)
    {
        $this->make_query($table,$select_column,$critere_txt,$critere_array,$order_by);
        $query = $this->db->get();
        return $query->num_rows();
        
    }

    public function getListRequest($requete)
    {
      $query=$this->db->query($requete);
      if($query){
         return $query->result_array();
      }
    }

    function getOne_cond($table, $criteres=array(),$cond2=array()) {
        $this->db->where($criteres);
        $this->db->where($cond2);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function getList_cond($table,$criteres = array(),$cond=array()) {
        $this->db->where($criteres);
        $this->db->where($cond);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function getList_distinct22($table,$distinct=array(),$criteres=array(),$cond2=array()) {
      $this->db->where($criteres);
      $this->db->where($cond2);
        $this->db->select($distinct);
        $query = $this->db->get($table);
        return $query->result_array();
    }

        function getRequete($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->result_array();
      }
    }
     function getRequeteOne($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->row_array();
      }
    }
    function getRequeteCount($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->num_rows();
      }
    }

   

    public  function getMax($table,$champ,$condition=array())
    {
        $this->db->select('MAX('.$champ.')as MAX');
        $this->db->from($table);
        $this->db->where($condition);
         $query = $this->db->get();
        return $query->row_array(); 
    } 

    public function get_Moyenne_age($critere)
    {
      $this->db->select("AVG(DATEDIFF(NOW(),DATE_NAISS)) AS moyenneAge");
      $this->db->from('ACTEURS_MIFA am');
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
    public function get_acteurs_grpment($criteres)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('GROUPEMENTS_ACTEURS gm','gm.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('GROUPEMENTS grm','grm.ID_GROUPEMENT=gm.ID_GROUPEMENT');
      //$this->db->join('GROUPEMENTS_TYPE grty','grty.ID_TYPE=grm.TYPE_GROUPEMENT');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      //$this->db->group_by('grty.DESCR_TYPE');
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      }
    }
    
    public function get_acteurs_profession($criteres)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur,am.PROFESSION");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      $this->db->group_by('am.PROFESSION');
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      } 
    }

    public function get_acteurs_etude($criteres)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur,am.NIVEAU_INSTRUCTION");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      $this->db->group_by('am.NIVEAU_INSTRUCTION');
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      } 
    }
    public function get_acteurs_mobile_money($criteres)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('MOBILE_MONEY_ACTEUR mma','mma.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      }
    }
    public function get_acteurs_operateur($criteres)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      }
    }
    public function get_acteurs_sex($criteres,$sex)
    {
      $this->db->select("COUNT(am.ID_ACTEUR) as nbActeur");
      $this->db->from('ACTEURS_MIFA am');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);
      $this->db->where('am.SEXE',$sex);
      $query = $this->db->get();

      if($query){
        return $query->row_array()['nbActeur'];
      }
    }

    public function get_prodution($criteres)
    {
      $this->db->select("SUM(fp.PRODUCTION_TO) as nbProd");
      $this->db->from('FAIT_PRODUCTION fp');
      $this->db->join('ACTEURS_MIFA am','fp.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('CULTURES clt','clt.ID_CULTURE=fp.ID_CULTURE');
      $this->db->join('GEO_LOCALITES gl','gl.ID_LOCALITE=am.ID_LOCALITE');
      $this->db->join('GEO_CANTONS gc','gl.ID_CANTON=gc.ID_CANTON');
      $this->db->join('GEO_PREFECTURES gp','gp.ID_PREFECTURE=gc.ID_PREFECTURE');
      $this->db->join('GEO_REGIONS gr','gr.ID_REGION=gp.ID_REGION');
      $this->db->where($criteres);

      //echo $this->db->last_query();
      $query = $this->db->get();

      if($query){
        return $query->row_array();
      }
    }

    public function get_mobile_money($acteur_id)
    {
       $this->db->select("DISTINCT(mm.ID_MOBILE_MONEY),mm.*");
       $this->db->from('MOBILE_MONEY mm');
       $this->db->join('MOBILE_MONEY_ACTEUR mma','mma.ID_MOBILE_MONEY=mm.ID_MOBILE_MONEY');
       $this->db->where('mma.ID_ACTEUR',$acteur_id);

       $query = $this->db->get();
       if($query){
        return $query->result_array();
       }
    }
    public function get_groupments($acteur_id)
    {
       $this->db->select('gr.*');
       $this->db->from('GROUPEMENTS gr');
       $this->db->join('GROUPEMENTS_ACTEURS ga','ga.ID_GROUPEMENT=gr.ID_GROUPEMENT');
       $this->db->where('ga.ID_ACTEUR',$acteur_id);

       $query = $this->db->get();
       if($query){
        return $query->result_array();
       } 
    }

    public function get_production_acteur($acteur_id,$annee)
    {
      $this->db->select("SUM(fp.PRODUCTION_TO) as qty,SUM(fp.PV_KILO*PRODUCTION_TO*1000) as montant,clt.DESCR_CULTURE");
      $this->db->from('FAIT_PRODUCTION fp');
      $this->db->join('ACTEURS_MIFA am','fp.ID_ACTEUR=am.ID_ACTEUR');
      $this->db->join('CULTURES clt','clt.ID_CULTURE=fp.ID_CULTURE');
      $this->db->where('am.ID_ACTEUR',$acteur_id);
      $this->db->where('fp.ANNEE',$annee);
      $this->db->group_by('clt.DESCR_CULTURE');
      $query = $this->db->get();

      if($query){
        return $query->result_array();
      }
    }

    public function get_all_traitement_acteur($acteur_id)
    {
      $this->db->select("tr.*,SUM(trd.MONTANT) as montant,ass.NOM_COMPAGNIE");
      $this->db->from("SN_TRAITEMENT tr");
      $this->db->join("SN_TRAITEMENT_DETAIL trd","trd.TRAITEMENT_ID=tr.TRAITEMENT_ID");
      $this->db->join("ASSUREURS_MIFA ass","ass.ID_ASSURANCE=tr.ID_ASSURANCE");
      $this->db->where("tr.ID_ACTEUR",$acteur_id);
      $this->db->group_by("tr.TRAITEMENT_ID");

      $query = $this->db->get();
      if($query){
        return $query->result_array();
      }
    }

    public function get_all_credits($acteur_id)
    {
      $this->db->select("fc.*,fsc.*");
      $this->db->from("FONDS_CREDIT fc");
      $this->db->join("FONDS_STATUT_CREDIT fsc","fsc.ID_STATUT=fc.STATUT");
      $this->db->where("fc.ID_ACTEUR",$acteur_id);

      $query = $this->db->get();
      if($query){
         return $query->result_array();
      }
    }

    public function mes_cotisations($credit_id)
    {
      $this->db->select("fc.*,fm.*");
      $this->db->from("FONDS_COTISATION fc");
      $this->db->join("FONDS_MIFA fm","fm.ID_FONDS=fc.ID_FONDS");
      $this->db->where('fc.ID_CREDIT',$credit_id);
      
      $query = $this->db->get();
      if($query){
         return $query->result_array();
      }
    }

    public function getMesProductions($ID_ACTEUR)
    {
      $this->db->select("pro.*,cl.DESCR_CULTURE,tsl.DESCRIPTION,fert.DESCRIPTION as FERT_DESCRIPTION");
      $this->db->from('FAIT_PRODUCTION as pro');
      $this->db->join("CULTURES cl","cl.ID_CULTURE = pro.ID_CULTURE","LEFT");
      $this->db->join("TYPE_SOL tsl","tsl.ID_TYPE_SOL = pro.ID_TYPE_SOL","LEFT");
      $this->db->join("TYPE_FERTILISANT fert","fert.TYPE_FERTILISANT_ID = pro.TYPE_FERTILISANT_ID","LEFT");
      $this->db->where("pro.ID_ACTEUR",$ID_ACTEUR);

      $query = $this->db->get();
      if($query){
        return $query->result_array();
      }
    }
    public function mes_machines($RISK_CREDIT_ID)
    {
      $this->db->select('mact.*,mtyp.*');
      $this->db->from('RISK_MACHINE_ACTEURS mact');
      $this->db->join('MACHINES_TYPES mtyp','mtyp.ID_TYPE_MACHINE =mact.ID_TYPE_MACHINE');
      $this->db->where('mact.RISK_CREDIT_ID',$RISK_CREDIT_ID);

      $query = $this->db->get();
      if($query){
        return $query->result_array();
      }
    }

    public function mes_lien_parentes($ID_ACTEUR)
    {
      $this->db->select('parent.*,lien.*');
      $this->db->from('RISK_CREDIT_PARENTE parent');
      $this->db->join('LIEN_PARENTE lien','lien.LIEN_PARANTE_ID =parent.LIEN_PARANTE_ID');
      $this->db->where('parent.ID_ACTEUR',$ID_ACTEUR);

      $query = $this->db->get();
      if($query){
        return $query->result_array();
      }
    }
    public function getLast($table,$criteres=array(),$champ)
    {
      $this->db->select();
      $this->db->where($criteres);
      $this->db->order_by($champ,'DESC');
      $query = $this->db->get($table);

      if($query){
        return $query->row_array();
      }
    }
    
     function getListLimit2($table,$limit,$cond=array())
    {
     $this->db->limit($limit);
     $this->db->where($cond);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }
} 