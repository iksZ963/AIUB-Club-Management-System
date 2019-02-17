<?php

class Admin_model extends CI_Model
{

    public $userid;
    public $reporting_id;
    public $user_name;
    public $office_name;
    public $user_email;
    public $user_password;
    public $user_contact;
    public $profile_pic;
    public $office_location;
    public $office_type;
    public $office_address;
    public $house_address;
    public $billing_address;
    public $shipping_address;
    public $country_code;
    public $division_code;
    public $district_code;
    public $upazila_code;
    public $designation;
    public $officer_id;
    public $office_id;
    public $monthName;
    public $year;
    public $this_month_tline_avail;
    public $this_month_ss_avail;
    public $this_month_tl_avail;
    public $this_month_spf_avail;
    public $this_month_wb_avail;
    public $last_month_tline_avail;
    public $last_month_ss_avail;
    public $last_month_tl_avail;
    public $last_month_spf_avail;
    public $last_month_wb_avail;
    public $this_fy_tline_avail;
    public $this_fy_ss_avail;
    public $this_fy_tl_avail;
    public $this_fy_spf_avail;
    public $this_fy_wb_avail;
    public $last_fy_tline_avail;
    public $last_fy_ss_avail;
    public $last_fy_tl_avail;
    public $last_fy_spf_avail;
    public $last_fy_wb_avail;


    /* bank info */
    public $bank_name;
    public $bank_address;
    public $bank_phone;
    public $bank_email;

    /* loan info */
    public $bank_id;
    public $account_no;
    public $no_of_installment;
    public $amount_of_installment;
    public $last_day_of_installment;
    public $starting_day_of_notification;
    public $due_date;
    public $comments;
    public $invest_mode;
    public $investment_no;
    /* HPSM */
    public $opening_date;
    public $period_in_month;
    public $investment_made;
    public $current_installment_size;
    public $unearned_outstanding;
    public $rent_outstanding;
    public $principal_outstanding;

    /* QTDR */
    public $interest_rate;

    /* MTR */
    public $amount_of_profit_marked_up;
    public $amount_of_investment;
    public $rr_percentage;
    public $rebate_allowed;
    /* Parts Info */
    public $parts_name;
    public $parts_model;
    public $parts_provider;
    public $parts_installed_vehicle_no;
    public $parts_installed_date;
    public $parts_validity;
    public $parts_repaired_date;

    /* Blue Book & insutance */
    public $papers_name;
    public $insurance_name;
    public $papers_provider;
    public $date_of_issue;
    public $vehicle_no;
    public $validity;
    public $issue_date;
    public $trip;
    public $schedule;
    public $bus;
    public $route;
    public $supervisor;
    public $voucher_no;
    public $income_head;
    public $counter;
    public $eat_q;
    public $unit_price;
    public $discount;
    public $parts_quantity;
    public $parts_rate;
    public $parts_total_amount;
    public $repair_type;
    public $parts_origin;

    public function insert_base_info()
    {
        $data = array(
            'base_id' => $this->bank_id,
            'generic_name' => $this->bank_name,
            'name' => $this->parts_name,
            'value' => $this->user_contact
        );
        if ($this->db->insert('base_data', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all_base_info($base_id)
    {
        $this->db->where('base_id', $base_id);
        $query = $this->db->get('base_data');
        return $query->result();
    }

    public function insert_asset_info()
    {
        if ($this->repair_type >= 20 && $this->repair_type <= 22) {
            $p_balance = $this->get_prev_balance2('sub_category', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance - $this->parts_total_amount;
            } else {
                $balance = $prev_balance + $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'asset_type' => $this->parts_provider,
                'sub_category' => $this->parts_name,
                'credit_debit' => $this->parts_installed_vehicle_no,
                'asset_from' => $this->parts_model,
                'quantity' => $this->parts_quantity,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        } else if ($this->repair_type >= 23 && $this->repair_type <= 28) {
            $p_balance = $this->get_prev_balance2('asset_type', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance - $this->parts_total_amount;
            } else {
                $balance = $prev_balance + $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'asset_type' => $this->parts_provider,
                'sub_category' => '',
                'credit_debit' => $this->parts_installed_vehicle_no,
                'asset_from' => $this->parts_model,
                'quantity' => $this->parts_quantity,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        } else if ($this->repair_type == 29) {
            $p_balance = $this->get_prev_balance2('asset_type', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance - $this->parts_total_amount;
            } else {
                $balance = $prev_balance + $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'asset_type' => $this->parts_provider,
                'sub_category' => '',
                'credit_debit' => $this->parts_installed_vehicle_no,
                'asset_from' => '',
                'quantity' => 1,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        }
        if ($this->db->insert('asset_info', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insert_liability_info()
    {

        if ($this->repair_type >= 70 && $this->repair_type <= 72) {
            $p_balance = $this->get_prev_balance('sub_category', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance + $this->parts_total_amount;
            } else {
                $balance = $prev_balance - $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'liability_type' => $this->parts_provider,
                'sub_category' => $this->parts_name,
                'credit_debit' => $this->parts_installed_vehicle_no,
                'liability_from' => $this->parts_model,
                'quantity' => $this->parts_quantity,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        } else if ($this->repair_type >= 73 && $this->repair_type <= 78) {
            $p_balance = $this->get_prev_balance('liability_type', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance + $this->parts_total_amount;
            } else {
                $balance = $prev_balance - $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'liability_type' => $this->parts_provider,
                'sub_category' => '',
                'credit_debit' => $this->parts_installed_vehicle_no,
                'liability_from' => $this->parts_model,
                'quantity' => $this->parts_quantity,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        } else if ($this->repair_type == 79) {
            $p_balance = $this->get_prev_balance('liability_type', $this->parts_name);
            foreach ($p_balance as $p) {
                $prev_balance = $p->balance;
            }
            if (empty($p_balance)) {
                $prev_balance = 0;
            }
            if ($this->parts_installed_vehicle_no == 'Credit') {
                $balance = $prev_balance + $this->parts_total_amount;
            } else {
                $balance = $prev_balance - $this->parts_total_amount;
            }
            $data = array(
                'user_id' => '1',
                'date' => $this->parts_installed_date,
                'liability_type' => $this->parts_provider,
                'sub_category' => '',
                'credit_debit' => $this->parts_installed_vehicle_no,
                'liability_from' => '',
                'quantity' => 1,
                'amount' => $this->parts_total_amount,
                'balance' => $balance
            );
        }
        if ($this->db->insert('liability_info', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_prev_balance($col_name, $item)
    {
        $this->db->select('balance');
        $this->db->where($col_name, $item);
        $query = $this->db->get('liability_info');
        return $query->result();
    }

    public function get_prev_balance2($col_name, $item)
    {
        $this->db->select('balance');
        $this->db->where($col_name, $item);
        $query = $this->db->get('asset_info');
        return $query->result();
    }

    public function get_all_asset_info($date_of_issue_from, $date_of_issue_to)
    {
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('date >=', $date_of_issue_from);
            $this->db->where('date <=', $date_of_issue_to);
        }
        $this->db->from('asset_info');
        $this->db->select('*', FALSE);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_liability_info($date_of_issue_from, $date_of_issue_to)
    {

        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('date >=', $date_of_issue_from);
            $this->db->where('date <=', $date_of_issue_to);
        }
        $this->db->from('liability_info');
        $this->db->select('*', FALSE);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_parts_info_specific($name, $model, $vehicle, $repair_type, $date_of_issue_from, $date_of_issue_to)
    {
        if ($name != "") {
            $this->db->where('parts_name', $name);
            // echo $name;
        }
        if ($model != "") {
            $this->db->where('parts_model_no', $model);
        }
        if ($vehicle != "") {
            $this->db->where('parts_installed_vehicle_no', $vehicle);
        }
        if ($repair_type != "") {
            $this->db->where('repair_type', $repair_type);
            // echo $repair_type;
        }
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('parts_installed_date >=', $date_of_issue_from);
            $this->db->where('parts_installed_date <=', $date_of_issue_to);
        }

        $this->db->from('parts_info');
        // $this->db->order_by('parts_id','desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteBaseInfo()
    {
        $this->db->where('id', $this->userid);
        $this->db->delete('base_data');
    }

    public function get_all_liability_type()
    {
        $this->db->select('name');
        $this->db->where('base_id', '200');
        $query = $this->db->get('base_data');
        return $query->result();
    }

    public function get_all_asset_type()
    {
        $this->db->select('name');
        $this->db->where('base_id', '100');
        $query = $this->db->get('base_data');
        return $query->result();
    }

    public function get_liability_sub_category_by_type($name)
    {
        $this->db->select('name');
        $this->db->where('generic_name', $name);
        $query = $this->db->get('base_data');
        return $query->result();
    }

    public function get_liability_info_date_to_date($col_name, $item, $date_of_issue_from, $date_of_issue_to)
    {

//        $this->db->from('liability_info');
//        $this->db->select('*', FALSE);
//        $this->db->order_by('date', 'desc');
//        $this->db->order_by('balance', 'asc');
//        $this->db->group_by($col_name);

        $this->db->select('m1.*');
        $this->db->from('liability_info m1');
        $this->db->join('liability_info m2', 'm1.'.$col_name.'= m2.'.$col_name. ' AND m1.id < m2.id', 'left');
        $this->db->where('m2.id IS NULL');
        $this->db->where('m1.'.$col_name, $item);
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('m1.date <=', $date_of_issue_from);
//            $this->db->where('m1.date <=', $date_of_issue_to);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_liability_info_date_to_date2($col_name, $item, $date_of_issue_from, $date_of_issue_to)
    {

        $this->db->where($col_name, $item);
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('date >=', $date_of_issue_from);
            $this->db->where('date <=', $date_of_issue_to);
        }
        $this->db->from('liability_info');
        $this->db->select('*', FALSE);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_asset_info_date_to_date($col_name, $item, $date_of_issue_from, $date_of_issue_to)
    {

//        $this->db->from('liability_info');
//        $this->db->select('*', FALSE);
//        $this->db->order_by('date', 'desc');
//        $this->db->order_by('balance', 'asc');
//        $this->db->group_by($col_name);

        $this->db->select('m1.*');
        $this->db->from('asset_info m1');
        $this->db->join('asset_info m2', 'm1.'.$col_name.'= m2.'.$col_name. ' AND m1.id < m2.id', 'left');
        $this->db->where('m2.id IS NULL');
        $this->db->where('m1.'.$col_name, $item);
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('m1.date <=', $date_of_issue_from);
//            $this->db->where('m1.date <=', $date_of_issue_to);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_asset_info_date_to_date2($col_name, $item, $date_of_issue_from, $date_of_issue_to)
    {

        $this->db->where($col_name, $item);
        if ($date_of_issue_from != "" && $date_of_issue_to != "") {
            $this->db->where('date >=', $date_of_issue_from);
            $this->db->where('date <=', $date_of_issue_to);
        }
        $this->db->from('asset_info');
        $this->db->select('*', FALSE);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_all_asset_info_by_asset($asset_type, $date_of_issue_from, $date_of_issue_to) {
        if ($asset_type == "1") {
            if ($date_of_issue_from != "" && $date_of_issue_to != "") {
                $this->db->where('fa_date >=', $date_of_issue_from);
                $this->db->where('fa_date <=', $date_of_issue_to);
            }
            $this->db->from('fixed_asset_info');
        } else if ($asset_type == "2") {
            if ($date_of_issue_from != "" && $date_of_issue_to != "") {
                $this->db->where('ca_date >=', $date_of_issue_from);
                $this->db->where('ca_date <=', $date_of_issue_to);
            }
            $this->db->from('current_asset_info');
        } else if ($asset_type == "3") {
            if ($date_of_issue_from != "" && $date_of_issue_to != "") {
                $this->db->where('lsa_date >=', $date_of_issue_from);
                $this->db->where('lsa_date <=', $date_of_issue_to);
            }
            $this->db->from('lost_stolen_asset_info');
        } else if ($asset_type == "4") {
            if ($date_of_issue_from != "" && $date_of_issue_to != "") {
                $this->db->where('dra_date >=', $date_of_issue_from);
                $this->db->where('dra_date <=', $date_of_issue_to);
            }
            $this->db->from('damage_repair_asset_info');
        }
        $this->db->select('*', FALSE);
        $this->db->order_by('issue_date', 'desc');
        $query = $this->db->get();
        return $query;
    }

}
