<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Import_model extends CI_Model {
 
        public function __construct()
        {
            $this->load->database();
        }
        
        public function importData($data) {
  
            $res = $this->db->insert_batch('client',$data);
            if($res){
                return TRUE;
            }else{
                return FALSE;
            }
      
        }
//   function insert($data)
// 	{
// 		$this->db->insert_batch('client', $data);
//         if($this->db->affected_rows()>0){
//             return 1;
//         }else{
//             return 0; 
//         }
// 	}
    }
?>