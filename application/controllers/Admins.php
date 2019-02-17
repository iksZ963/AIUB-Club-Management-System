<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Admins extends CI_Controller {

    public function create_base_info($id) {
        $this->load->model('Admin_model');
        $data['base_id'] = $id;
        $data['baseList'] = $this->Admin_model->get_all_base_info($id);
        $this->load->view('admin/create_base_info', $data);
    }

    public function insert_base_info() {
        $this->load->model('Admin_model');
        $base_id = $this->input->post('base_id');
        $this->Admin_model->user_contact = 1;
        if ($base_id == 20) {
            $gen_name = "Cash";
        } else if ($base_id == 21) {
            $gen_name = "Investment";
        } else if ($base_id == 22) {
            $gen_name = "Other Assets";
        } else if ($base_id == 70) {
            $gen_name = "Capital";
        } else if ($base_id == 71) {
            $gen_name = "Deposits";
        } else if ($base_id == 72) {
            $gen_name = "Other Liabilities";
        } else {
            $this->session->set_flashdata('user_insert_msg_error', 'Error');
            redirect('admins/create_base_info/' . $base_id, 'refresh');
        }


        $this->Admin_model->bank_name = $gen_name; //Generic Name
        $this->Admin_model->bank_id = $base_id; //Generic Name
        $this->Admin_model->parts_name = $this->input->post('name');

        if ($this->Admin_model->insert_base_info()) {
            $this->session->set_flashdata('user_insert_msg', 'Creation Successfully Completed');
            redirect('admins/create_base_info/' . $base_id, 'refresh');
        } else {
            $this->session->set_flashdata('user_insert_msg_error', 'Error occured to save');
            redirect('admins/create_base_info/' . $base_id, 'refresh');
        }
    }

    public function search_asset_information() {
        $this->load->view('admin/search_asset_information');
    }

    public function search_liability_information() {
        $this->load->view('admin/search_liability_information');
    }

    public function search_asset_information_by_type() {
        $this->load->model('Admin_model');
        $date_of_issue_from = $this->input->post('date_of_issue_from');
        $date_of_issue_to = $this->input->post('date_of_issue_to');
        $assetList = $this->Admin_model->get_all_asset_info($date_of_issue_from, $date_of_issue_to);
        $sl = 1;

        foreach ($assetList->result() as $asset) {
            $data[] = array(
                'sl' => $sl++,
                'date' => $asset->date,
                'asset' => $asset->asset_type,
                'sub_category' => $asset->sub_category,
                'credit_debit' => $asset->credit_debit,
                'asset_from' => $asset->asset_from,
                'quantity' => $asset->quantity,
                'amount' => $asset->amount,
            );
        }

        echo json_encode($data);
    }

    public function search_liability_information_by_type() {
        $this->load->model('Admin_model');
        $date_of_issue_from = $this->input->post('date_of_issue_from');
        $date_of_issue_to = $this->input->post('date_of_issue_to');
        $liabilityList = $this->Admin_model->get_all_liability_info($date_of_issue_from, $date_of_issue_to);
        $sl = 1;

        foreach ($liabilityList->result() as $liability) {
            $data[] = array(
                'sl' => $sl++,
                'date' => $liability->date,
                'liability' => $liability->liability_type,
                'sub_category' => $liability->sub_category,
                'credit_debit' => $liability->credit_debit,
                'liability_from' => $liability->liability_from,
                'quantity' => $liability->quantity,
                'amount' => $liability->amount,
            );
        }

        echo json_encode($data);
    }

    public function search_liability_report() {
        $this->load->model('Admin_model');
        $date_of_issue_from = $this->input->post('date_from');
        $date_of_issue_to = $this->input->post('date_to');
        $data['liability_type'] = $this->Admin_model->get_all_liability_type();
        $count = 0;
        $c = 0;
        $c1 = 0;
        $c2 = 0;
        $credit = 0;
        $debit = 0;
        $grand_balancef = 0;
        $grand_credit = 0;
        $grand_debit = 0;
        $grand_balance = 0;
        $l_grand_balancef = 0;
        $l_grand_credit = 0;
        $l_grand_debit = 0;
        $l_grand_balance = 0;
        foreach ($data['liability_type'] as $d) {
            $sub_credit = 0;
            $sub_debit = 0;
            $sub_balancef = 0;
            $count++;

            $data['l_type' . $count] = $d->name;
            $data['sub_category' . $count] = $this->Admin_model->get_liability_sub_category_by_type($d->name);
            if ($d->name == 'Capital' || $d->name == 'Deposits' || $d->name == 'Other Liabilities') {

                foreach ($data['sub_category' . $count] as $s) {
                    $c2++;
                    $data['sub_c' . $count] = $s->name;
                    $balance = $this->Admin_model->get_liability_info_date_to_date('sub_category', $s->name, $date_of_issue_from, $date_of_issue_to);
                    $credit_debit = $this->Admin_model->get_liability_info_date_to_date2('sub_category', $s->name, $date_of_issue_from, $date_of_issue_to);

                    if (empty($balance)) {
                        $data['balancef' . $c2] = 0;
                    }
                    foreach ($balance as $b) {
                        $data['balancef' . $c2] = $b->balance;
                        $sub_balancef += $data['balancef' . $c2];
                    }

                    foreach ($credit_debit as $cd) {

                        $data['c_dcd' . $c2] = $cd->credit_debit;
                        if ($cd->credit_debit == 'Credit') {
                            $credit = $credit + $cd->amount;
                        } else {
                            $debit = $debit + $cd->amount;
                        }
                        $data['bcd' . $c2] = $cd->sub_category;
                    }
                    $data['credit' . $c2] = $credit;
                    $data['debit' . $c2] = $debit;
                    $data['balance' . $c2] = $data['balancef' . $c2] + $credit - $debit;
                    $sub_credit += $data['credit' . $c2];
                    $sub_debit += $data['debit' . $c2];
                    $credit = 0;
                    $debit = 0;
                }
                $data['sub_balancef' . $count] = $sub_balancef;
                $data['sub_credit' . $count] = $sub_credit;
                $data['sub_debit' . $count] = $sub_debit;
                $total = $data['sub_balancef' . $count] + $sub_credit - $sub_debit;
                $data['sub_balance' . $count] = $total;
                $grand_balancef += $sub_balancef;
                $grand_credit += $sub_credit;
                $grand_debit += $sub_debit;
                $grand_balance += $total;
            } else {
                $c1++;
                $balance = $this->Admin_model->get_liability_info_date_to_date('liability_type', $d->name, $date_of_issue_from, $date_of_issue_to);
                $credit_debit = $this->Admin_model->get_liability_info_date_to_date2('liability_type', ' ' . $d->name, $date_of_issue_from, $date_of_issue_to);

                if (empty($balance)) {
                    $data['balancef1' . $c1] = 0;
                    $tmp = 0;
                }
                foreach ($balance as $b) {
                    $data['balancef1' . $c1] = $b->balance;
                    $tmp = $data['balancef1' . $c1];
                }
                $credit = 0;
                $debit = 0;
                foreach ($credit_debit as $b) {

                    $data['c_d1' . $c1] = $b->credit_debit;
                    if ($b->credit_debit == 'Credit') {
                        $credit = $credit + $b->amount;
                    } else {
                        $debit = $debit + $b->amount;
                    }
                    $data['credit1' . $c1] = $credit;
                    $data['debit1' . $c1] = $debit;
                    $data['balance1' . $c1] = $data['balancef1' . $c1] + $credit - $debit;
                    $data['amount1' . $c1] = $b->amount;
                    $data['b1' . $c1] = $b->liability_type;
                }
                if (empty($credit_debit)) {
                    $data['balance1' . $c1] = $data['balancef1' . $c1];
                }
                $l_grand_balancef += $tmp;
                $l_grand_credit += $credit;
                $l_grand_debit += $debit;
                $l_grand_balance = $l_grand_balancef + $l_grand_credit - $l_grand_debit;
            }
        }

        $data['balancef'] = $grand_balancef + $l_grand_balancef;
        $data['credit'] = $grand_credit + $l_grand_credit;
        $data['debit'] = $grand_debit + $l_grand_debit;
        $data['balance'] = $grand_balance + $l_grand_balance;
        $data['c'] = $count;
        $data['c2'] = $c2;
        $data['cc'] = $c;
        $data['cc1'] = $c1;
        $this->load->view('admin/liability_report_info', $data);
    }

    public function search_asset_report() {
        $this->load->model('Admin_model');
        $date_of_issue_from = $this->input->post('date_from');
        $date_of_issue_to = $this->input->post('date_to');
        $data['asset_type'] = $this->Admin_model->get_all_asset_type();
        $count = 0;
        $c = 0;
        $c1 = 0;
        $c2 = 0;
        $credit = 0;
        $debit = 0;
        $grand_balancef = 0;
        $grand_credit = 0;
        $grand_debit = 0;
        $grand_balance = 0;
        $l_grand_balancef = 0;
        $l_grand_credit = 0;
        $l_grand_debit = 0;
        $l_grand_balance = 0;
        foreach ($data['asset_type'] as $d) {
            $sub_credit = 0;
            $sub_debit = 0;
            $sub_balancef = 0;
            $count++;

            $data['a_type' . $count] = $d->name;
            $data['sub_category' . $count] = $this->Admin_model->get_liability_sub_category_by_type($d->name);
            if ($d->name == 'Cash' || $d->name == 'Investment' || $d->name == 'Other Assets') {

                foreach ($data['sub_category' . $count] as $s) {
                    $c2++;
                    $data['sub_c' . $count] = $s->name;
                    $balance = $this->Admin_model->get_asset_info_date_to_date('sub_category', $s->name, $date_of_issue_from, $date_of_issue_to);
                    $credit_debit = $this->Admin_model->get_asset_info_date_to_date2('sub_category', $s->name, $date_of_issue_from, $date_of_issue_to);

                    if (empty($balance)) {
                        $data['balancef' . $c2] = 0;
                    }
                    foreach ($balance as $b) {
                        $data['balancef' . $c2] = $b->balance;
                        $sub_balancef += $data['balancef' . $c2];
                    }

                    foreach ($credit_debit as $cd) {

                        $data['c_dcd' . $c2] = $cd->credit_debit;
                        if ($cd->credit_debit == 'Credit') {
                            $credit = $credit + $cd->amount;
                        } else {
                            $debit = $debit + $cd->amount;
                        }
                        $data['bcd' . $c2] = $cd->sub_category;
                    }
                    $data['credit' . $c2] = $credit;
                    $data['debit' . $c2] = $debit;
                    $data['balance' . $c2] = $data['balancef' . $c2] - $credit + $debit;
                    $sub_credit += $data['credit' . $c2];
                    $sub_debit += $data['debit' . $c2];
                    $credit = 0;
                    $debit = 0;
                }
                $data['sub_balancef' . $count] = $sub_balancef;
                $data['sub_credit' . $count] = $sub_credit;
                $data['sub_debit' . $count] = $sub_debit;
                $total = $data['sub_balancef' . $count] - $sub_credit + $sub_debit;
                $data['sub_balance' . $count] = $total;
                $grand_balancef += $sub_balancef;
                $grand_credit += $sub_credit;
                $grand_debit += $sub_debit;
                $grand_balance += $total;
            } else {
                $c1++;
                $balance = $this->Admin_model->get_asset_info_date_to_date('asset_type', $d->name, $date_of_issue_from, $date_of_issue_to);
                $credit_debit = $this->Admin_model->get_asset_info_date_to_date2('asset_type', ' ' . $d->name, $date_of_issue_from, $date_of_issue_to);
               
                if (empty($balance)) {
                    $data['balancef1' . $c1] = 0;
                    $tmp = 0;
                }
                foreach ($balance as $b) {
                    $data['balancef1' . $c1] = $b->balance;
                    $tmp = $data['balancef1' . $c1];
                }
                $credit = 0;
                $debit = 0;
                foreach ($credit_debit as $b) {

                    $data['c_d1' . $c1] = $b->credit_debit;
                    if ($b->credit_debit == 'Credit') {
                        $credit = $credit + $b->amount;
                    } else {
                        $debit = $debit + $b->amount;
                    }
                    $data['credit1' . $c1] = $credit;
                    $data['debit1' . $c1] = $debit;
                    $data['balance1' . $c1] = $data['balancef1' . $c1] - $credit + $debit;
                    $data['amount1' . $c1] = $b->amount;
                    $data['b1' . $c1] = $b->asset_type;
                }
                if (empty($credit_debit)) {
                    $data['balance1' . $c1] = $data['balancef1' . $c1];
                }
                $l_grand_balancef += $tmp;
                $l_grand_credit += $credit;
                $l_grand_debit += $debit;
                $l_grand_balance = $l_grand_balancef - $l_grand_credit + $l_grand_debit;
            }
        }

        $data['balancef'] = $grand_balancef + $l_grand_balancef;
        $data['credit'] = $grand_credit + $l_grand_credit;
        $data['debit'] = $grand_debit + $l_grand_debit;
        $data['balance'] = $grand_balance + $l_grand_balance;
        $data['c'] = $count;
        $data['c2'] = $c2;
        $data['cc'] = $c;
        $data['cc1'] = $c1;
        $this->load->view('admin/asset_report_info', $data);
    }

    public function create_asset_information() {
        $this->load->view('admin/create_asset_information');
    }

    public function create_liability_information() {
        $this->load->view('admin/create_liability_information');
    }

    public function insert_asset_info() {
        $this->load->model('Admin_model');
        $asset_type = $this->input->post('asset_type');
        if ($asset_type >= 20 && $asset_type <= 22) {
            $this->Admin_model->repair_type = $asset_type;
            $this->Admin_model->parts_installed_date = $this->input->post('fa_date');
            $this->Admin_model->parts_provider = $this->input->post('asset_type_name');
            $this->Admin_model->parts_name = $this->input->post('fa_product_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('fa_trans_type');
            $this->Admin_model->parts_model = $this->input->post('fa_product_model');
            $this->Admin_model->parts_quantity = $this->input->post('fa_quantity');
            $this->Admin_model->parts_total_amount = $this->input->post('fa_total_amount');
            //echo "here";
        } else if ($asset_type >= 23 && $asset_type <= 28) {
            $this->Admin_model->repair_type = $asset_type;
            $this->Admin_model->parts_installed_date = $this->input->post('gl_date');
            $this->Admin_model->parts_provider = $this->input->post('asset_type_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('gl_trans_type');
            $this->Admin_model->parts_model = $this->input->post('gl_product_model');
            $this->Admin_model->parts_quantity = $this->input->post('gl_quantity');
            $this->Admin_model->parts_total_amount = $this->input->post('gl_total_amount');
        } else if ($asset_type == 29) {
            $this->Admin_model->repair_type = $asset_type;
            $this->Admin_model->parts_installed_date = $this->input->post('ca_date');
            $this->Admin_model->parts_provider = $this->input->post('asset_type_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('ca_trans_type');
            $this->Admin_model->parts_total_amount = $this->input->post('ca_amount');
        }
        if ($this->Admin_model->insert_asset_info()) {
            $this->session->set_flashdata('user_insert_msg', 'Creation Successfully Completed');
            redirect('admins/create_asset_information', 'refresh');
        } else {
            $this->session->set_flashdata('user_insert_msg_error', 'Error occured to save');
            redirect('admins/create_asset_information', 'refresh');
        }
    }

    public function insert_liability_info() {
        $this->load->model('Admin_model');
        $liability_type = $this->input->post('liability_type');
        if ($liability_type >= 70 && $liability_type <= 72) {
            $this->Admin_model->repair_type = $liability_type;
            $this->Admin_model->parts_installed_date = $this->input->post('fa_date');
            $this->Admin_model->parts_provider = $this->input->post('liability_type_name');
            $this->Admin_model->parts_name = $this->input->post('fa_product_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('fa_trans_type');
            $this->Admin_model->parts_model = $this->input->post('fa_product_model');
            $this->Admin_model->parts_quantity = $this->input->post('fa_quantity');
            $this->Admin_model->parts_total_amount = $this->input->post('fa_total_amount');
            //echo "here";
        } else if ($liability_type >= 73 && $liability_type <= 78) {
            $this->Admin_model->repair_type = $liability_type;
            $this->Admin_model->parts_installed_date = $this->input->post('gl_date');
            $this->Admin_model->parts_provider = $this->input->post('liability_type_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('gl_trans_type');
            $this->Admin_model->parts_model = $this->input->post('gl_product_model');
            $this->Admin_model->parts_quantity = $this->input->post('gl_quantity');
            $this->Admin_model->parts_total_amount = $this->input->post('gl_total_amount');
        } else if ($liability_type == 79) {
            $this->Admin_model->repair_type = $liability_type;
            $this->Admin_model->parts_installed_date = $this->input->post('ca_date');
            $this->Admin_model->parts_provider = $this->input->post('liability_type_name');
            $this->Admin_model->parts_installed_vehicle_no = $this->input->post('ca_trans_type');
            $this->Admin_model->parts_total_amount = $this->input->post('ca_amount');
        }
        if ($this->Admin_model->insert_liability_info()) {
            $this->session->set_flashdata('user_insert_msg', 'Creation Successfully Completed');
            redirect('admins/create_liability_information', 'refresh');
        } else {
            $this->session->set_flashdata('user_insert_msg_error', 'Error occured to save');
            redirect('admins/create_liability_information', 'refresh');
        }
    }

    public function delete_base_info() {
        //echo $this->uri->segment(3);

        $this->load->model('Admin_model');
        $this->Admin_model->user_id = $this->uri->segment(3);
        $this->Admin_model->deleteBaseInfo();
        $this->session->set_userdata('isdeleteUser', 'some_value');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function al_sub_category() {
        $data['baseId'] = $this->input->post('type');
        $this->load->view('admin/al_sub_category', $data);
    }

    public function show_liability_report() {
        $this->load->view('admin/liability_report');
    }

    public function show_asset_report() {
        $this->load->view('admin/asset_report');
    }

}
