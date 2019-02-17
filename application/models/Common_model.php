<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Common_model extends CI_Model {
    function update_data_all_column($table_name, $data){
        $this->db->update($table_name, $data);
    }
    function group_by_sum($table_name, $distinct_column, $sum_column1, $sum_column2)
    {
        $this->db->select(''.$distinct_column.', SUM('.$sum_column1.') AS sum_result1, SUM('.$sum_column2.') AS sum_result2');
        $this->db->group_by($distinct_column);
        $query = $this->db->get($table_name);
        return $query->result();
    }
    function group_by_data_where($table_name, $where_array, $distinct_column)
    {
        $this->db->where($where_array);
        $this->db->group_by($distinct_column);
        $query = $this->db->get($table_name);
        return $query->result();
    }
    function data_date_to_date_group_by($table_name, $distinct_column, $date_column, $date_from, $date_to)
    {
        $this->db->where($date_column . '>=', $date_from);
        $this->db->where($date_column . '<=', $date_to);
        $this->db->group_by($distinct_column);
        $this->db->order_by($date_column);
        $query = $this->db->get($table_name);
        return $query->result();
    }
     function get_distinct_value_where($column_name, $table_name, $column_with_value_array){
        $this->db->select($column_name);
        $this->db->distinct();
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_distinct_value($column_name, $table_name){
        $this->db->select($column_name);
        $this->db->distinct();
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_distinct_value_order_by($column_name, $table_name){
        $this->db->order_by('record_id', 'DESC');
        $this->db->select($column_name);
        $this->db->distinct();
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_bank_name(){
        $this->db->select('bank_name');
        $this->db->distinct();
        $query=$this->db->get('create_bank_name');
        return $query->result();
    }
    function get_last_data_byid($table_name, $where_column, $where_column_value){
        $this->db->where($where_column, $where_column_value);
        $this->db->order_by('record_id', 'DESC');
        $this->db->limit(1);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_all_info_limit_offset($table_name, $limit, $offset){
        $this->db->limit($limit, $offset);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function check_value_get_data_with_guardians($table_name, $column_with_value_array){
        $this->db->select('26_grade_mark_management.*,15_insert_guardian_info.name,15_insert_guardian_info.mobile');
        $this->db->from('26_grade_mark_management');
        $this->db->join('15_insert_guardian_info', '26_grade_mark_management.student_id = 15_insert_guardian_info.student_id');
        $this->db->where($column_with_value_array);
        $query=$this->db->get();
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }

    function get_all_info_by_array($table_name, $column_with_value_array){
        $s = $this->db->where($column_with_value_array);
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_all_info_by_class_name($table_name,$where_column, $where_column_value){
        $this->db->where($where_column, $where_column_value);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_teacher_unique_id_distinct($where_column_value){
        $this->db->select('teacher_unique_id');
        $this->db->distinct();
        $this->db->where('subject_name', $where_column_value);
        $query=$this->db->get('25_teacher_subject_management');
        return $query->result();
    }
     function get_distinct_subject_classwise($class_name){
        $this->db->select('subject_name');
        $this->db->distinct();
        $this->db->where('class_name', $class_name);
        $query=$this->db->get('25_teacher_subject_management');
        return $query->result();
    }
      function get_distinct_teacher_id_classwise($class_name){
        $this->db->select('teacher_unique_id');
        $this->db->distinct();
        $this->db->where('class_name', $class_name);
        $query=$this->db->get('25_teacher_subject_management');
        return $query->result();
    }
     function get_routine_time($column_with_value_array){
        $this->db->order_by('class_time');
        $this->db->select('class_time');
        $this->db->distinct();
        $this->db->where($column_with_value_array);
        $query=$this->db->get('40_create_class_routine');
        return $query->result();
    }
    function data_date_to_date($table_name, $date_column, $date_from, $date_to){
        $this->db->where($date_column.'>=', $date_from);
        $this->db->where($date_column.'<=', $date_to);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function update_data_onerow($table_name, $data, $where_column, $where_column_value){
        $this->db->where($where_column, $where_column_value);
        $this->db->update($table_name, $data);
    }
    function insert_data($table_name, $data){
        $query=$this->db->insert($table_name, $data);
        return $query;
    }
    function one_column_one_info($column_name, $id_column, $one_id, $table_name){
        $this->db->select($column_name);
        $this->db->where($id_column, $one_id);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_allinfo_byid($table_name, $where_column, $where_column_value){
        $this->db->where($where_column, $where_column_value);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_allinfo_byid_limit_offset($limit, $offset, $table_name, $where_column, $where_column_value){
        $this->db->limit($limit, $offset);
        $this->db->where($where_column, $where_column_value);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_all_info($table_name){
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_all_info_orderby($table_name, $order_column, $order_details){
        $this->db->order_by($order_column, $order_details);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function get_userid_balance($id){
        $this->db->select('user_id, amount');
        $this->db->where('mlm_apply_agent_id', $id);
        $query=$this->db->get('mlm_apply_agent');
        return $query->result();
    }
    function check_value($table_name, $column_with_value_array){
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    function check_value_get_data($table_name, $column_with_value_array){
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }
    function get_left_right_id($table_name, $parent_id, $parent_id_value){
        $this->db->select('left_id, right_id');
        $this->db->where($parent_id, $parent_id_value);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function delete_info($table_id, $deleted_id, $table_name){
        $this->db->where($table_id, $deleted_id);
        $query=$this->db->delete($table_name);
        return $query;
    }
    function data_between_date($table_name, $column_name, $start_date, $end_date){
        $this->db->where($column_name.'<=', $start_date);
        $this->db->where($column_name.'>=', $end_date);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function data_between_date_where($table_name, $column_date, $start_date, $end_date, 
            $where_column, $where_column_value){
        $this->db->where($where_column, $where_column_value);
        $this->db->where($column_date.'<=', $start_date);
        $this->db->where($column_date.'>=', $end_date);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function weekly_user_created($table_name, $column_date, $start_date, $end_date, 
            $column_user, $column_user_value){
        $this->db->where($column_user, $column_user_value);
        $this->db->where($column_date.'<=', $start_date);
        $this->db->where($column_date.'>=', $end_date);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    function weekly_user_incentive($table_name, $column_date, $start_date, $end_date, 
            $column_user, $column_user_value){
        $this->db->where($column_user, $column_user_value);
        $this->db->where($column_date.'<=', $start_date);
        $this->db->where($column_date.'>=', $end_date);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }
    function row_number_until_date($table_name, $date_column, $date){
        $this->db->where($date_column.'<=', $date);
        $query=$this->db->get($table_name);
        return $query->num_rows();
    }
    function data_until_date_where_id($table_name, $date_column, $date, $where_column, $where_value){
        $this->db->where($date_column.'<=', $date);
        $this->db->where($where_column, $where_value);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function data_until_date($table_name, $date_column, $date){
        $this->db->where($date_column.'<=', $date);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function row_number_single_date($table_name, $date_column, $date){
        $this->db->where($date_column, $date);
        $query=$this->db->get($table_name);
        return $query->num_rows();
    }
    function commission_until_date($table_name, $date_column, $date, $select_column){
        $this->db->select_sum($select_column);
        $this->db->where($date_column.'<=', $date);
        $query=$this->db->get($table_name);
        $value=$query->row($select_column);
        if(empty($value)){
            return 0;
        }
        else{
            return $value;
        }
    }
    function commission_single_date($table_name, $date_column, $date, $select_column){
        $this->db->select_sum($select_column);
        $this->db->where($date_column, $date);
        $query=$this->db->get($table_name);
        $value=$query->row($select_column);
        if(empty($value)){
            return 0;
        }
        else{
            return $value;
        }
    }
    function toalpayment_until_date($date){
        $this->db->select_sum('getting_amount');
        $this->db->where('action', "yes");
        $this->db->where('STR_TO_DATE(date, "%d %M, %Y") <=', $date);
        $query=$this->db->get('mlm_withdraw');
        $value=$query->row('getting_amount');
        if(empty($value)){
            return 0;
        }
        else{
            return $value;
        }
    }
    function toalpayment_data_until_date($date){
        $this->db->where('action', "yes");
        $this->db->where('STR_TO_DATE(date, "%d %M, %Y") <=', $date);
        $query=$this->db->get('mlm_withdraw');
        return $query->result();
    }
    function toalpayment_data_single_date($date){
        $this->db->where('action', "yes");
        $this->db->where('STR_TO_DATE(date, "%d %M, %Y")=', $date);
        $query=$this->db->get('mlm_withdraw');
        return $query->result();
    }
    function totalpayment_single_date($date){
        $this->db->select_sum('getting_amount');
        $this->db->where('action', "yes");
        $this->db->where('STR_TO_DATE(date, "%d %M, %Y")=', $date);
        $query=$this->db->get('mlm_withdraw');
        $value=$query->row('getting_amount');
        if(empty($value)){
            return 0;
        }
        else{
            return $value;
        }
    }
    function find_last_id($column_name, $table_name) {
        $this->db->insert_id($column_name);
        $query = $this->db->get($table_name);
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    function sum_one_columm_date_to_date_with_condition($table_name, $sum_col, $column_with_value_array, $date_column, $date_from, $date_to){
        $this->db->select_sum($sum_col);
        $this->db->where($column_with_value_array);
        $this->db->where($date_column.'>=', $date_from);
        $this->db->where($date_column.'<=', $date_to);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }
    function check_value_get_one_column($column_name, $column_with_value_array, $table_name){
        $this->db->select($column_name);
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        if($query->num_rows() == 0){
            return FALSE;
        }
        else{
            return $query->result();
        }
    }
    function data_date_to_date_with_check($table_name, $column_with_value_array, $date_column, $date_from, $date_to){
        $this->db->where($column_with_value_array);
        $this->db->where($date_column.'>=', $date_from);
        $this->db->where($date_column.'<=', $date_to);
        $query=$this->db->get($table_name);
        return $query->result();
    }
     function one_column_group_by($column_name, $table_name){
        $this->db->select($column_name);
        $this->db->group_by($column_name);
        $query=$this->db->get($table_name);
        return $query->result();
    }

    function get_allinfo_byid_groupby($where_column, $where_column_value , $table_name){
        $this->db->where($where_column, $where_column_value);
        $this->db->group_by($where_column);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function simple_group_by($where_column, $table_name){
        $this->db->group_by($where_column);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    function update_data_onerow_where_array($table_name, $data, $column_with_value_array){
        $this->db->where($column_with_value_array);
        $this->db->update($table_name, $data);
    }
    function find_last_id_where($column_name, $column_with_value_array, $table_name) {
        $this->db->where($column_with_value_array);
        $this->db->insert_id($column_name);
        $query = $this->db->get($table_name);
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    function get_all_info_by_array_regex($table_name, $column_with_value_array){
        $s = $this->db->where($column_with_value_array);
        $this->db->where($column_with_value_array);
        $query=$this->db->get($table_name);
        return $query->result();
    }
}
?>