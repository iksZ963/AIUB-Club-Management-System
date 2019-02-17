<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Show_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
    }

	public function profile($msg) {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$data['msg'] = $msg;
			if ($user_type == 'osa') {
				$data['profile'] = $this->Common_model->get_allinfo_byid('osa_member', 'userid', $this->session->ses_userid);
			} else {
				$data['profile'] = $this->Common_model->get_allinfo_byid('member', 'userid', $this->session->ses_userid);
			}
			$this->load->view('admin/header');
			$this->load->view('admin/profile', $data);
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function calendar($msg) {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$data['msg'] = $msg;
			$this->load->view('admin/header');
			$this->load->view('admin/calendar', $data);
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function messages($msg) {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$data['msg'] = $msg;
			$data['all_message'] = $this->Common_model->get_all_info('message');
			$this->load->view('admin/header');
			$this->load->view('admin/messages', $data);
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function osa_member($msg) {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$data['msg'] = $msg;
			$data['osa'] = $this->Common_model->get_all_info('osa');
			$data['all_club'] = $this->Common_model->get_all_info('club');
			$data['all_osa_member'] = $this->Common_model->get_all_info('osa_member');
			$this->load->view('admin/header');
			$this->load->view('admin/osa_member_list', $data);
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function osa($msg) {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$data['msg'] = $msg;
			$data['osa'] = $this->Common_model->get_all_info('osa');
			$data['all_club'] = $this->Common_model->get_all_info('club');
			$this->load->view('admin/header');
			$this->load->view('admin/osa', $data);
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

    public function club_members($msg, $club_id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['member_list'] = $this->Common_model->get_allinfo_byid('member','club_id', $club_id);
            $result = $this->Common_model->get_allinfo_byid('club','record_id', $club_id);
            foreach ($result as $res){
            	$data['club_name'] = $res->club_name;
            	$data['club_id'] = $res->record_id;
			}
            $this->load->view('admin/header');
            $this->load->view('admin/member_list', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function test($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_club'] = $this->Common_model->get_all_info('club');
            $this->load->view('admin/header');
            $this->load->view('admin/test', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function club_list($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_club'] = $this->Common_model->get_all_info('club');
            $this->load->view('admin/header');
            $this->load->view('admin/club_list', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function profit_loss($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_product'] = $this->Common_model->get_all_info('insert_product_info');
            $this->load->view('admin/header');
            $this->load->view('admin/profit_loss', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function search_income() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['income_head'] = $this->Common_model->get_all_info('income_head');
            $this->load->view('admin/header');
            $this->load->view('admin/search_income', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function search_expense() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['expense_head'] = $this->Common_model->get_all_info('expense_head');
            $this->load->view('admin/header');
            $this->load->view('admin/search_expense', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_due_statement() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $this->load->view('admin/header');
            $this->load->view('admin/sales_due_statement', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function purchase_due_statement() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_vendor'] = $this->Common_model->get_all_info('create_manufacture_company');
            $this->load->view('admin/header');
            $this->load->view('admin/purchase_due_statement', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function delivered_product($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['invoice'] = $this->Common_model->get_distinct_value('invoice_no', 'sell_product');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/delivered_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function dashboard_purchase_due() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $count = 0;
            $purchase_due_result = $this->Common_model->group_by_sum('purchase_due', 'manufacturer', 'total', 'paid');
            foreach ($purchase_due_result as $purchase_due_info) {
                $count++;
                $single_voucher_total = $purchase_due_info->sum_result1;
                $single_voucher_total_paid = $purchase_due_info->sum_result2;
                $purchase_due = $single_voucher_total - $single_voucher_total_paid;
                $single_Vendor = $purchase_due_info->manufacturer;
                $result = $this->Common_model->get_allinfo_byid('create_manufacture_company', 'manufacture_company', $single_Vendor);
                foreach ($result as $info) {
                    $mobile_no = $info->mobile;
                    $address = $info->address;
                }
                $data['purchase_due' . $count] = $purchase_due;
                $data['vendor_name' . $count] = $single_Vendor;
                $data['mobile' . $count] = $mobile_no;
                $data['address' . $count] = $address;
            }
            $data['count_it'] = $count;
            $this->load->view('admin/header');
            $this->load->view('admin/dashboard_purchase_due', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function dashboard_sales_due() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $count = 0;
            $sales_due_result = $this->Common_model->group_by_sum('sales_due', 'client_id', 'total', 'paid');
            foreach ($sales_due_result as $sales_due_info) {
                $count++;
                $single_voucher_total = $sales_due_info->sum_result1;
                $single_voucher_total_paid = $sales_due_info->sum_result2;
                $sales_due = $single_voucher_total - $single_voucher_total_paid;
                $single_client = $sales_due_info->client_id;
                $result = $this->Common_model->get_allinfo_byid('add_client', 'record_id', $single_client);
                foreach ($result as $info) {
                    $client_name = $info->name;
                    $mobile_no = $info->mobile;
                    $address = $info->address;
                }
                $data['sales_due' . $count] = $sales_due;
                $data['client_name' . $count] = $client_name;
                $data['client_id' . $count] = $single_client;
                $data['mobile' . $count] = $mobile_no;
                $data['address' . $count] = $address;
            }
            $data['count_it'] = $count;
            $this->load->view('admin/header');
            $this->load->view('admin/dashboard_sales_due', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_due($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_invoice'] = $this->Common_model->get_distinct_value("invoice_no", "sales_due");
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/sales_due', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function purchase_due($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_voucher'] = $this->Common_model->get_distinct_value("voucher_no", "purchase_due");
            $data['all_vendor'] = $this->Common_model->get_all_info('create_manufacture_company');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/purchase_due', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function search_product() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['product_type'] = $this->Common_model->get_all_info('create_product_type');
            $data['product_name'] = $this->Common_model->get_all_info('create_product_name');
            $data['sub_category'] = $this->Common_model->get_all_info('create_sub_category');
            $data['brand'] = $this->Common_model->get_all_info('create_brand_name');

            $this->load->view('admin/header');
            $this->load->view('admin/search_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function stock_shortage() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['product_result'] = $this->Common_model->get_all_info('insert_product_info');
            $this->load->view('admin/header');
            $this->load->view('admin/stock_shortage', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function near_expired_product() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $array_check_expire = array(
                "expiry_date>=" => date('Y-m-d'),
                "expiry_date<" => date('Y-m-d', strtotime('+15 days'))
            );

            $data['expired_product'] = $this->Common_model->get_all_info_by_array('purchase_product', $array_check_expire);
            $title = "Near ";
            $data['title'] = $title;
            $this->load->view('admin/header');
            $this->load->view('admin/expired_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function expired_product() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $array_check_expire = array(
                "expiry_date<" => date('Y-m-d')
            );
            $data['expired_product'] = $this->Common_model->get_all_info_by_array('purchase_product', $array_check_expire);
            $title = " ";
            $data['title'] = $title;
            $this->load->view('admin/header');
            $this->load->view('admin/expired_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function monthly_sales_number() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $column_with_value_array = array(
                "date>=" => date('Y-m-d', strtotime('-1 month')),
                "date<=" => date('Y-m-d')
            );
            $result = $this->Common_model->get_distinct_value_where('invoice_no', 'sell_product', $column_with_value_array);
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $data['pro_result' . $count] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $info->invoice_no);
            }
            $data['count_it'] = $count;
            $data['title'] = "Sales of Month";
            $data['t'] = "Month";
            $this->load->view('admin/header');
            $this->load->view('admin/sales_number', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function today_sales_number() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $column_with_value_array = array(
                "date" => date('Y-m-d')
            );
            $result = $this->Common_model->get_distinct_value_where('invoice_no', 'sell_product', $column_with_value_array);
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $data['pro_result' . $count] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $info->invoice_no);
            }
            $data['count_it'] = $count;
            $data['title'] = "Sales of Day";
            $data['t'] = "Day";
            $this->load->view('admin/header');
            $this->load->view('admin/sales_number', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function only_product_info() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('insert_product_info');
            $this->load->view('admin/header');
            $this->load->view('admin/only_product_info', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_bank_name($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {

            $data['all_value'] = $this->Common_model->get_all_info('create_bank_name');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/create_bank_name', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function bank_deposit($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {

            $data['all_bank'] = $this->Common_model->get_all_info('create_bank_name');
            $data['all_value'] = $this->Common_model->get_all_info('bank_deposit');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/bank_deposit', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function bank_withdraw($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {

            $data['all_bank'] = $this->Common_model->get_all_info('create_bank_name');
            $data['all_value'] = $this->Common_model->get_all_info('bank_withdraw');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/bank_withdraw', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function bank_report($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {

            $data['all_bank'] = $this->Common_model->get_bank_name();
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/bank_report', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_salary_sheet($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_employee'] = $this->Common_model->get_all_info('employee');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/create_salary_sheet', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function report($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/report', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function ledger($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/ledger', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function expense_head($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('expense_head');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/expense_head', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function expense($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['expense_head'] = $this->Common_model->get_all_info('expense_head');
            $data['all_value'] = $this->Common_model->get_all_info('expense');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/expense', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function income_head($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('income_head');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/income_head', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function income($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['income_head'] = $this->Common_model->get_all_info('income_head');
            $data['all_value'] = $this->Common_model->get_all_info('income');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/income', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function officer_list() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/officer_list', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function manufacturer_return_list() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('returned_to_manufacturer');
            $this->load->view('admin/header');
            $this->load->view('admin/manufacturer_return_list', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_return_info() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('returned_product_info');
            $this->load->view('admin/header');
            $this->load->view('admin/sales_return_info', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_statement($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['all_product'] = $this->Common_model->get_all_info('insert_product_info');
            $data['invoice'] = $this->Common_model->get_distinct_value('invoice_no', 'sell_product');
            $data['admin'] = $this->Common_model->get_all_info('admin');
            $data['employee'] = $this->Common_model->get_all_info('employee');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/sales_statement', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function return_product($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $this->load->model('Common_model');

            $data['sold_product'] = $this->Common_model->get_distinct_value('invoice_no', 'sell_product');
            $data['all_value'] = $this->Common_model->get_all_info('returned_product_info');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/return_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $result = $this->Common_model->get_distinct_value_order_by('invoice_no', 'sell_product');
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $data['pro_result' . $count] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $info->invoice_no);
            }
            $data['count_it'] = $count;
            $data['all_product'] = $this->Common_model->get_all_info('insert_product_info');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/sell_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_dealing($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['all_value'] = $this->Common_model->get_all_info('sales_dealing');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/sales_dealing', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_schedule($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['all_value'] = $this->Common_model->get_all_info('sales_schedule');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/sales_schedule', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function add_client($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $result = $this->Common_model->get_all_info_orderby('add_client', 'record_id', 'DESC');
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $client_id = $info->record_id;
                $due_result = $this->Common_model->get_allinfo_byid('sales_due', 'client_id', $client_id);
                $total = 0;
                $paid = 0;
                foreach ($due_result as $due_info) {
                    $total += $due_info->total;
                    $paid += $due_info->paid;
                }
                $old_due = $total - $paid;
                $data['old_due' . $count] = $old_due;
            }
            $data['all_value'] = $result;
            $this->load->view('admin/header');
            $this->load->view('admin/add_client', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function manufacturer_return($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['purchased_product'] = $this->Common_model->get_distinct_value('invoice_no', 'purchase_product');
            $data['all_value'] = $this->Common_model->get_all_info('returned_product_info');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/return_to_manufacture', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function product_inout($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/product_inout', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function purchase_statement($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_product'] = $this->Common_model->get_all_info('insert_product_info');
            $data['invoice_product'] = $this->Common_model->get_distinct_value('invoice_no', 'purchase_product');
            $data['company'] = $this->Common_model->get_all_info('create_manufacture_company');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/purchase_statement', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function purchase_product($id, $msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $result = $this->Common_model->get_distinct_value_order_by('invoice_no', 'purchase_product');
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $data['pro_result' . $count] = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $info->invoice_no);
            }
            $data['count_it'] = $count;
            $data['manufacture_company'] = $this->Common_model->get_all_info('create_manufacture_company');
            $data['all_product'] = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $id);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/purchase_product', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_product_info($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['product_type'] = $this->Common_model->get_all_info('create_product_type');
            $data['sub_category'] = $this->Common_model->get_all_info('create_sub_category');
            $data['brand'] = $this->Common_model->get_all_info('create_brand_name');
            $data['manufacture_company'] = $this->Common_model->get_all_info('create_manufacture_company');
            $data['all_value'] = $this->Common_model->get_all_info_orderby('insert_product_info', 'record_id', "DESC");
            $data['product_name'] = $this->Common_model->get_all_info('create_product_name');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/insert_product_info', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_schedule($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_employee'] = $this->Common_model->get_all_info('employee');
            $data['all_value'] = $this->Common_model->get_all_info('employee_schedule');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/employee_schedule', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function dashboard($no) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            if ($no == 1) {
                $array_check_ap = array(
                    "date >= " => date('Y-m-d')
                );
                $data['appointment'] = $this->Common_model->get_all_info_by_array('appointment_info', $array_check_ap);
            } elseif ($no == 2) {
                $data['patient'] = $this->Common_model->get_all_info('patient');
            } elseif ($no == 3) {
                $data['employee'] = $this->Common_model->get_allinfo_byid('staff', 'staff_type', 'Doctor');
                $data["title"] = "Doctor Info.";
            } elseif ($no == 4) {
                $data['employee'] = $this->Common_model->get_allinfo_byid('staff', 'staff_type', 'Nurse');
                $data["title"] = "Nurse Info.";
            } elseif ($no == 5) {
                $data['employee'] = $this->Common_model->get_allinfo_byid('staff', 'staff_type', 'Staff');
                $data["title"] = "Staff Info.";
            } elseif ($no == 6) {
                $data['enquiry'] = $this->Common_model->get_all_info('enquiry');
            } elseif ($no == 7) {
                $data['notice'] = $this->Common_model->get_allinfo_byid('insert_notice', 'date', date('Y-m-d'));
                $data["title"] = "Today Notice";
            } elseif ($no == 8) {
                $array_check = array(
                    "status" => 0
                );
                $data['admitted_patient'] = $this->Common_model->get_all_info_by_array('patient_admission', $array_check);
                $data["title"] = "Admitted Patients";
            }
            $data['no'] = $no;
            $this->load->view('admin/header');
            $this->load->view('admin/dashboard_link', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_type($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_product_type');
            $this->load->view('admin/header');
            $this->load->view('admin/create_product_type', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_sub_category($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_category'] = $this->Common_model->get_all_info('create_product_type');
            $data['all_value'] = $this->Common_model->get_all_info('create_sub_category');
            $this->load->view('admin/header');
            $this->load->view('admin/create_product_sub_category', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_brand_name($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_brand_name');
            $this->load->view('admin/header');
            $this->load->view('admin/create_brand_name', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_name($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_product_name');
            $this->load->view('admin/header');
            $this->load->view('admin/create_product_name', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_manufacture_company($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $result = $this->Common_model->get_all_info('create_manufacture_company');
            $count = 0;
            foreach ($result as $info) {
                $count++;
                $search_vendor = $info->manufacture_company;
                $due_result = $this->Common_model->get_allinfo_byid('purchase_due', 'manufacturer', $search_vendor);
                $total = 0;
                $paid = 0;
                foreach ($due_result as $due_info) {
                    if (!empty($due_info->total)) {
                        $total += $due_info->total;
                    }
                    if (!empty($due_info->paid)) {
                       $paid += $due_info->paid;
                    }
                }
                $old_due = $total - $paid;
                $data['old_due' . $count] = $old_due;
            }
            $data['all_value'] = $result;
            $this->load->view('admin/header');
            $this->load->view('admin/create_manufacture_company', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_storage_type($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_storage_type');
            $this->load->view('admin/header');
            $this->load->view('admin/create_storage_type', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_department($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/create_department', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_designation($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('create_designation');
            $this->load->view('admin/header');
            $this->load->view('admin/create_designation', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_employee($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_designation'] = $this->Common_model->get_all_info('create_designation');
            $data['all_department'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/create_employee', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_list($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_employee'] = $this->Common_model->get_all_info('employee');
            $this->load->view('admin/header');
            $this->load->view('admin/employee_list', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function project_settings($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('project_program');
            $this->load->view('admin/header');
            $this->load->view('admin/project_settings', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function reg_processing($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('reg_processing');
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['all_project'] = $this->Common_model->get_all_info('project_program');
            $this->load->view('admin/header');
            $this->load->view('admin/reg_processing', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function land_dealing($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('land_dealing');
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['all_project'] = $this->Common_model->get_all_info('project_program');
            $this->load->view('admin/header');
            $this->load->view('admin/land_dealing', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function customer_care($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('customer_care');
            $this->load->view('admin/header');
            $this->load->view('admin/customer_care', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function publication($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('publication');
            $this->load->view('admin/header');
            $this->load->view('admin/publication', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function payment_processing($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('payment_processing');
            $data['all_project'] = $this->Common_model->get_all_info('project_program');
            $this->load->view('admin/header');
            $this->load->view('admin/payment_processing', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function down_payment($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('down_payment');
            $data['all_project'] = $this->Common_model->get_all_info('payment_processing');
            $this->load->view('admin/header');
            $this->load->view('admin/down_payment', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function payment_status($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_value'] = $this->Common_model->get_all_info('down_payment');
            $data['all_project'] = $this->Common_model->get_all_info('payment_processing');
            $this->load->view('admin/header');
            $this->load->view('admin/down_payment', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function installment_payment($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_down'] = $this->Common_model->get_all_info('down_payment');
            $this->load->view('admin/header');
            $this->load->view('admin/installment_payment', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_user($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_user'] = $this->Common_model->get_all_info('user');
            $data['all_employee'] = $this->Common_model->get_all_info('employee');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/create_user', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_attendance($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_department'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/employee_attendance', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function attendance_report($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['msg'] = $msg;
            $data['all_department'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/attendance_report', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_notice($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('insert_notice');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/insert_notice', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function send_sms_employee() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $data['all_value'] = $this->Common_model->get_all_info('create_sms');
            $this->load->view('admin/header');
            $this->load->view('admin/send_sms_employee', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_sms($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $this->load->model('Common_model');
            $table_name = "create_sms";
            $data['all_value'] = $this->Common_model->get_all_info($table_name);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/create_sms', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function search_by_serial($msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $this->load->model('Common_model');
            $serial = '';
            $result = $this->Common_model->get_all_info('sell_product');
            foreach ($result as $res){
                $serial .= '#'.$res->serial;
            }
            $data['serial'] = explode('#', $serial);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/search_serial', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

}
