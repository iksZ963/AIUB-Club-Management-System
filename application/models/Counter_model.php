<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Counter_model extends CI_Model {
    
  function get_counter_value() {
   $this->db->insert_id('count');
   $query = $this->db->get('27_counter');
   return $query->result();
  }  
  function update_counter_value($one_count) {
    $data = array(
         'count' => $one_count
    );
    $this->db->where('counter_id', 1);
    $this->db->update('27_counter', $data);
  }   
}
?>