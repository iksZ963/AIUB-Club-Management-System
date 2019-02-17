<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Get_ajax_value extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function get_club_details()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$club_id = $this->input->post('club_id');

			$checking_array = array();

			if (!empty($club_id)) {
				$checking_array['record_id'] = $club_id;
			}
			$data['club_details'] = $this->Common_model->check_value_get_data('club', $checking_array);
			$this->load->view('admin/club_details', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_message()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom" || $user_type == "member") {
			$to_ = $this->input->post('to_');
			$from_ = $this->input->post('from_');

			$data['from_'] = $from_;

			$checking_array = array();
			$checking_array2 = array();

			if (!empty($from_)) {
				$checking_array['from_'] = $from_;
				$checking_array2['to_'] = $from_;
			}
			if (!empty($to_)) {
				$checking_array['to_'] = $to_;
				$checking_array2['from_'] = $to_;
			}
			$data['messages'] = $this->Common_model->check_value_get_data('message', $checking_array);
			$data['messages2'] = $this->Common_model->check_value_get_data('message', $checking_array2);

			$update_data = array('status' => 1);
			$this->Common_model->update_data_onerow_where_array('message', $update_data, $checking_array);
//			print_r($data['messages']);
			$this->load->view('admin/message_body', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_member_list()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$club_id = $this->input->post('club_id');

			$checking_array = array();

			if (!empty($club_id)) {
				$checking_array['club_id'] = $club_id;
			}
			$data['member_list'] = $this->Common_model->check_value_get_data('member', $checking_array);
			$this->load->view('admin/member_list', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_product_profit_loss_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$product_id = $this->input->post('product_id');
			$checking_array = array();
//            if (!empty($date_from) && !empty($date_to))  {
//                $checking_array['date >='] = $date_from;
//                $checking_array['date <='] = $date_to;
//            }
			if (!empty($product_id)) {
				$checking_array['record_id'] = $product_id;
			}
			$data['all_product_info'] = $this->Common_model->check_value_get_data('insert_product_info', $checking_array);
			if (!empty($data['all_product_info'])) {
				$count = 0;
				foreach ($data['all_product_info'] as $p) {
					$purchase_price = $p->purchase_price;
					$array_check = array();
					$array_check['product_id'] = $p->record_id;
					if (!empty($date_from) && !empty($date_to)) {
						$array_check['date >='] = $date_from;
						$array_check['date <='] = $date_to;
					}
					$sold_qty = 0;
					$total_sale = 0;
					$sales = $this->Common_model->get_all_info_by_array('sell_product', $array_check);
					foreach ($sales as $s) {
						$sold_qty += $s->product_qty;
						$total_sale += ($s->total - $s->discount);
					}
					if ($sold_qty != 0) {
						$count++;
						$data['name' . $count] = $p->product_name . ' [' . strtoupper($p->manufacture_company) . ']';
						$data['purchase_price' . $count] = $p->purchase_price;
						$data['sold_qty' . $count] = $sold_qty;
						$data['selling_price' . $count] = round($total_sale / $sold_qty, 2);
						$data['profit_loss_unit' . $count] = $data['selling_price' . $count] - $purchase_price;
						$data['profit_loss_total' . $count] = $data['profit_loss_unit' . $count] * $sold_qty;
						$data['total_sale' . $count] = $total_sale;
					}
				}
				$data['c'] = $count;
				$data['start_date'] = $date_from;
				$data['end_date'] = $date_to;
				$this->load->view('admin/show_product_profit_loss_info', $data);
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_expense_report()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$expense_head = $this->input->post('expense_head');

			$checking_array = array();
			$data['date_range'] = "";
			$data["expense_head"] = "All Expense Info.";
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
				$data['date_range'] = "(" . date('d F', strtotime($date_from)) . " - " . date('d F', strtotime($date_to)) . ")";
			}
			if (!empty($expense_head)) {
				$checking_array['head'] = $expense_head;
				$data["expense_head"] = $expense_head;
			}
			$data["all_value"] = $this->Common_model->get_all_info_by_array("expense", $checking_array);

			$this->load->view('admin/get_expense_report', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_income_report()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$income_head = $this->input->post('income_head');

			$checking_array = array();
			$data['date_range'] = "";
			$data["income_head"] = "All Income Info.";
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
				$data['date_range'] = "(" . date('d F', strtotime($date_from)) . " - " . date('d F', strtotime($date_to)) . ")";
			}
			if (!empty($income_head)) {
				$checking_array['head'] = $income_head;
				$data["income_head"] = $income_head;
			}
			$data["all_value"] = $this->Common_model->get_all_info_by_array("income", $checking_array);

			$this->load->view('admin/get_income_report', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_purchase_due_statement()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$vendor = $this->input->post('vendor');

			$checking_array = array();
			$data['date_range'] = "";
			if (!empty($vendor)) {
				$checking_array['manufacturer'] = $vendor;
			}
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
				$data['date_range'] = "(" . date('d F', strtotime($date_from)) . " - " . date('d F', strtotime($date_to)) . ")";
			}
			$data["all_value"] = $this->Common_model->get_all_info_by_array("purchase_due", $checking_array);

			$this->load->view('admin/show_purchase_due_statement', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_sales_due_statement()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$client_id = $this->input->post('client_id');

			$checking_array = array();
			$data['date_range'] = "";
			if (!empty($client_id)) {
				$checking_array['client_id'] = $client_id;
			}
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
				$data['date_range'] = "(" . date('d F', strtotime($date_from)) . " - " . date('d F', strtotime($date_to)) . ")";
			}
			$data["all_value"] = $this->Common_model->get_all_info_by_array("sales_due", $checking_array);

			$this->load->view('admin/show_sales_due_statement', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_challan_statement()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$challan = $this->input->post('challan');

			$checking_array = array();
			if (!empty($challan)) {
				$checking_array['invoice_no'] = $challan;
			}
			$result = $this->Common_model->get_distinct_value_where('invoice_no', "sell_product", $checking_array);
			$count = 0;
			foreach ($result as $info) {
				$count++;
				$checking_array['invoice_no'] = $info->invoice_no;
				$data['pro_result' . $count] = $this->Common_model->get_all_info_by_array("sell_product", $checking_array);
			}
			$data['count_it'] = $count;
			$this->load->view('admin/challan_statement_show_all', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_product_model()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$product_name = $this->input->post('product_name');
			$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'product_name', $product_name);

			$data = array();
			foreach ($result as $info) {
				array_push($data, $info->product_model);
			}
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_customer_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$client_id = $this->input->post('customer_id');
			$result = $this->Common_model->get_allinfo_byid('sales_due', 'client_id', $client_id);
			$total = 0;
			$paid = 0;
			foreach ($result as $info) {
				$total += $info->total;
				$paid += $info->paid;
			}
			$old_due = $total - $paid;
			$data['old_due'] = $old_due;
			$data['all_value'] = $this->Common_model->get_allinfo_byid('add_client', 'record_id', $client_id);
			$this->load->view('admin/get_customer_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_client_due()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$client = $this->input->post('client');
			if (empty($client)) {
				$old_due = 0;
			} else {
				$client = explode('#', $this->input->post('client'));
				$client_name = $client[0];
				$client_id = $client[1];

				$result = $this->Common_model->get_allinfo_byid('sales_due', 'client_id', $client_id);
				$total = 0;
				$paid = 0;
				foreach ($result as $info) {
					$total += $info->total;
					$paid += $info->paid;
				}
				$old_due = $total - $paid;
			}
			$data = array($old_due);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function show_sales_due()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$search_client = $this->input->post('search_client');
			if (empty($search_client)) {
				echo "<p style='color: red;font-size: 20px;'>Please select a client.</p>";
			} else {
				$search_client = explode('#', $this->input->post('search_client'));
				$client_name = $search_client[0];
				$client_id = $search_client[1];

				$data['all_value'] = $this->Common_model->get_allinfo_byid('sales_due', 'client_id', $client_id);
				$total = 0;
				$paid = 0;
				foreach ($data['all_value'] as $info) {
					$total += $info->total;
					$paid += $info->paid;
				}
				$old_due = $total - $paid;
				$data['old_due'] = $old_due;
				$data['client_name'] = $client_name;
				$data['client_id'] = $client_id;
				$this->load->view('admin/show_sales_due', $data);
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_sales_due_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$invoice = $this->input->post('invoice');

			$result = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			if (empty($result)) {
				$data = array("Not Available", "Not Available", "Not Available", "Not Available");
			} else {
				foreach ($result as $info) {
					$client_id = $info->client_id;
					$customer = $info->client_name . " [Id: " . $info->client_id . "]";
					$total = $info->total;
				}

				$result = $this->Common_model->get_allinfo_byid('add_client', 'record_id', $client_id);
				foreach ($result as $info) {
					$mobile = $info->mobile;
				}

				$total_paid = 0;
				$result = $this->Common_model->get_allinfo_byid('sales_due', 'invoice_no', $invoice);
				foreach ($result as $info) {
					$total_paid += $info->paid;
				}
				$due = $total - $total_paid;

				$data = array($customer, $total, $due, $mobile);
			}
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function show_purchase_due()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$search_vendor = $this->input->post('search_vendor');

			if (empty($search_vendor)) {
				echo "<p style='color: red;font-size: 20px;'>Please select a vendor.</p>";
			} else {
				$data['all_value'] = $this->Common_model->get_allinfo_byid('purchase_due', 'manufacturer', $search_vendor);
				$total = 0;
				$paid = 0;
				foreach ($data['all_value'] as $info) {
					$total += $info->total;
					$paid += $info->paid;
				}
				$old_due = $total - $paid;
				$data['old_due'] = $old_due;
				$data['vendor_name'] = $search_vendor;
				$this->load->view('admin/show_purchase_due', $data);
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_due_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$voucher = $this->input->post('voucher');

			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $voucher);
			$total = 0;
			if (empty($result)) {
				$data = array("Not Available", "Not Available", "Not Available");
			} else {
				foreach ($result as $info) {
					$manufacture_company = $info->manufacture_company;
					$total += $info->sub_total;
				}

				$total_paid = 0;
				$result = $this->Common_model->get_allinfo_byid('purchase_due', 'voucher_no', $voucher);
				foreach ($result as $info) {
					$total_paid += $info->paid;
				}
				$due = $total - $total_paid;
				$data = array($manufacture_company, $total, $due);
			}
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function show_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$search_product_type = $this->input->post('search_product_type');
			$search_product_name = $this->input->post('search_product_name');
			$search_product_model = $this->input->post('search_product_model');
			$sub_category = $this->input->post('sub_category');
			$brand_name = $this->input->post('brand_name');


			$array_check = array();
			if (!empty($search_product_type)) {
				$array_check["product_type"] = $search_product_type;
			}
			if (!empty($search_product_name)) {
				$array_check["product_name"] = $search_product_name;
			}
			if (!empty($search_product_model)) {
				$array_check["product_model"] = $search_product_model;
			}
			if (!empty($sub_category)) {
				$array_check["sub_category"] = $sub_category;
			}
			if (!empty($brand_name)) {
				$array_check["brand_name"] = $brand_name;
			}

			$data['all_value'] = $this->Common_model->get_all_info_by_array("insert_product_info", $array_check);
			$this->load->view('admin/show_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_salary_sheet()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$month = $this->input->post('month');
			$this->load->model('Common_model');
			$data['all_value'] = $this->Common_model->get_allinfo_byid('create_salary_sheet', 'month', $month);
			$total = 0;
			foreach ($data['all_value'] as $info) {
				$total += $info->salary_scale;
			}
			$data['month'] = $month;
			$data['total'] = $total;
			$this->load->view('admin/show_salary_sheet', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_des_acc_salary()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$employee_id = $this->input->post('employee_id');

			$result = $this->Common_model->get_allinfo_byid('employee', 'record_id', $employee_id);
			if (empty($result)) {
				$data = array("Not Available", "Not Available", "Not Available");
			} else {
				foreach ($result as $info) {
					$designation = $info->designation;
					$account = $info->account;
					$salary = $info->total_salary;
				}
				$data = array($designation, $account, $salary);
			}
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_bank_report()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$bank_name = $this->input->post('bank_name');
			if (empty($from_date) && empty($to_date)) {
				$data['deposit_result'] = $this->Common_model->get_allinfo_byid('bank_deposit', 'bank_name', $bank_name);
				$data['withdraw_result'] = $this->Common_model->get_allinfo_byid('bank_withdraw', 'bank_name', $bank_name);
			} elseif (empty($bank_name)) {
				$data['deposit_result'] = $this->Common_model->data_between_date('bank_deposit', 'date', $to_date, $from_date);
				$data['withdraw_result'] = $this->Common_model->data_between_date('bank_withdraw', 'date', $to_date, $from_date);
			} else {
				$data['deposit_result'] = $this->Common_model->data_between_date_where('bank_deposit', 'date', $to_date, $from_date, 'bank_name', $bank_name);
				$data['withdraw_result'] = $this->Common_model->data_between_date_where('bank_withdraw', 'date', $to_date, $from_date, 'bank_name', $bank_name);
			}
			$this->load->view('admin/bank_show_report', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_report_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$data['all_sales'] = $this->Common_model->data_date_to_date('sell_product', 'date', $date_from, $date_to);
			$data['sales_due'] = $this->Common_model->data_date_to_date('sales_due', 'date', $date_from, $date_to);
			$data['all_income'] = $this->Common_model->data_date_to_date('income', 'date', $date_from, $date_to);

			$data['all_purchase_product'] = $this->Common_model->data_date_to_date('purchase_product', 'date', $date_from, $date_to);
			$data['purchase_due'] = $this->Common_model->data_date_to_date('purchase_due', 'date', $date_from, $date_to);
			$data['all_expense'] = $this->Common_model->data_date_to_date('expense', 'date', $date_from, $date_to);
			$data['all_salary'] = $this->Common_model->data_date_to_date('create_salary_sheet', 'date', $date_from, $date_to);

			$count = 0;
			foreach ($data['all_sales'] as $info1) {
				$count++;
				$data['date' . $count] = $info1->date;
				$data['invoice' . $count] = $info1->invoice_no;
				$data['selling_amount' . $count] = $info1->sub_total;
				$data['particular' . $count] = "X";
				$data['amount' . $count] = "0";
				$data['client' . $count] = "X";
				$data['sales_collection' . $count] = "0";
			}
			foreach ($data['sales_due'] as $info1) {
				if ($info1->paid != 0) {
					$count++;
					$data['date' . $count] = $info1->date;
					$data['invoice' . $count] = "0";
					$data['selling_amount' . $count] = "0";
					$data['particular' . $count] = "X";
					$data['amount' . $count] = "0";
					$data['client' . $count] = $info1->client_name;
					$data['sales_collection' . $count] = $info1->paid;
				}
			}
			foreach ($data['all_income'] as $info1) {
				$count++;
				$data['date' . $count] = $info1->date;
				$data['invoice' . $count] = "0";
				$data['selling_amount' . $count] = "0";
				$data['particular' . $count] = $info1->head;
				$data['amount' . $count] = $info1->amount;
				$data['client' . $count] = "X";
				$data['sales_collection' . $count] = "0";
			}

			$count_ex = 0;
			foreach ($data['all_purchase_product'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['voucher' . $count_ex] = $info1->invoice_no;
				$data['purchase_amount' . $count_ex] = $info1->sub_total;
				$data['expense_particular' . $count_ex] = "X";
				$data['expense_amount' . $count_ex] = "0";
				$data['vendor' . $count_ex] = "X";
				$data['purchase_payment' . $count_ex] = "0";
			}
			foreach ($data['purchase_due'] as $info1) {
				if ($info1->paid != 0) {
					$count_ex++;
					$data['expense_date' . $count_ex] = $info1->date;
					$data['voucher' . $count_ex] = "0";
					$data['purchase_amount' . $count_ex] = "0";
					$data['expense_particular' . $count_ex] = "X";
					$data['expense_amount' . $count_ex] = "0";
					$data['vendor' . $count_ex] = $info1->manufacturer;
					$data['purchase_payment' . $count_ex] = $info1->paid;
				}
			}
			foreach ($data['all_expense'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['voucher' . $count_ex] = "0";
				$data['purchase_amount' . $count_ex] = "0";
				$data['expense_particular' . $count_ex] = $info1->head;
				$data['expense_amount' . $count_ex] = $info1->amount;
				$data['vendor' . $count_ex] = "X";
				$data['purchase_payment' . $count_ex] = "0";
			}
			foreach ($data['all_salary'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['voucher' . $count_ex] = "0";
				$data['purchase_amount' . $count_ex] = "0";
				$data['expense_particular' . $count_ex] = "Salary (" . $info1->employee_name . ")";
				$data['expense_amount' . $count_ex] = $info1->salary_scale;
				$data['vendor' . $count_ex] = "X";
				$data['purchase_payment' . $count_ex] = "0";
			}
			if ($count >= $count_ex) {
				$empty_range = $count - $count_ex;
				$start = $count_ex + 1;
				$finish = $count_ex + $empty_range;
				for ($i = $start; $i <= $finish; $i++) {
					$data['expense_date' . $i] = "";
					$data['voucher' . $i] = "";
					$data['purchase_amount' . $i] = "";
					$data['expense_particular' . $i] = "";
					$data['expense_amount' . $i] = "";
					$data['vendor' . $i] = "";
					$data['purchase_payment' . $i] = "";
				}
				$data['count_it'] = $count;
			} else {
				$empty_range = $count_ex - $count;
				$start = $count + 1;
				$finish = $count + $empty_range;
				for ($i = $start; $i <= $finish; $i++) {
					$data['date' . $i] = "";
					$data['invoice' . $i] = "";
					$data['selling_amount' . $i] = "";
					$data['particular' . $i] = "";
					$data['amount' . $i] = "";
					$data['client' . $i] = "";
					$data['sales_collection' . $i] = "";
				}
				$data['count_it'] = $count_ex;
			}

			$data['date_range'] = "(" . date('d F', strtotime($date_from)) . " - " . date('d F', strtotime($date_to)) . ")";
			$this->load->view('admin/show_report_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_ledger_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$data['all_sales'] = $this->Common_model->data_date_to_date('sales_due', 'date', $date_from, $date_to);
			$data['bank_deposit'] = $this->Common_model->data_date_to_date('bank_deposit', 'date', $date_from, $date_to);
			$data['all_income'] = $this->Common_model->data_date_to_date('income', 'date', $date_from, $date_to);

			$data['all_purchase_product'] = $this->Common_model->data_date_to_date('purchase_due', 'date', $date_from, $date_to);
			$data['bank_withdraw'] = $this->Common_model->data_date_to_date('bank_withdraw', 'date', $date_from, $date_to);
			$data['all_expense'] = $this->Common_model->data_date_to_date('expense', 'date', $date_from, $date_to);
			$data['all_salary'] = $this->Common_model->data_date_to_date('create_salary_sheet', 'date', $date_from, $date_to);

			$count = 0;
			foreach ($data['all_sales'] as $info1) {
				if ($info1->paid != 0) {
					$count++;
					$data['date' . $count] = $info1->date;
					$data['particular' . $count] = "Sales Collection";
					$data['client_info' . $count] = $info1->client_name;
					$data['amount' . $count] = $info1->paid;
				}
			}
			foreach ($data['all_income'] as $info1) {
				$count++;
				$data['date' . $count] = $info1->date;
				$data['particular' . $count] = $info1->head;
				$data['client_info' . $count] = "X";
				$data['amount' . $count] = $info1->amount;
			}
			foreach ($data['bank_deposit'] as $info1) {
				$count++;
				$data['date' . $count] = $info1->date;
				$data['particular' . $count] = 'Deposit By: ' . $info1->responsible_person . '<br>(' . $info1->bank_name . '<br>A/C: ' . $info1->account_no . ')';
				$data['client_info' . $count] = "X";
				$data['amount' . $count] = $info1->amount;
			}

			$count_ex = 0;
			foreach ($data['all_purchase_product'] as $info1) {
				if ($info1->paid != 0) {
					$count_ex++;
					$data['expense_date' . $count_ex] = $info1->date;
					$data['expense_particular' . $count_ex] = "Purchase Payment";
					$data['expense_vendor' . $count_ex] = $info1->manufacturer;
					$data['expense_amount' . $count_ex] = $info1->paid;
				}
			}
			foreach ($data['all_expense'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['expense_particular' . $count_ex] = $info1->head;
				$data['expense_vendor' . $count_ex] = "X";
				$data['expense_amount' . $count_ex] = $info1->amount;
			}
			foreach ($data['all_salary'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['expense_particular' . $count_ex] = "Salary (" . $info1->employee_name . ")";
				$data['expense_vendor' . $count_ex] = "X";
				$data['expense_amount' . $count_ex] = $info1->salary_scale;
			}
			foreach ($data['bank_withdraw'] as $info1) {
				$count_ex++;
				$data['expense_date' . $count_ex] = $info1->date;
				$data['expense_particular' . $count_ex] = 'Withdraw By: ' . $info1->responsible_person . '<br>(' . $info1->bank_name . '<br>A/C: ' . $info1->account_no . ')';
				$data['expense_vendor' . $count_ex] = "X";
				$data['expense_amount' . $count_ex] = $info1->amount;
			}

			if ($count >= $count_ex) {
				$empty_range = $count - $count_ex;
				$start = $count_ex + 1;
				$finish = $count_ex + $empty_range;
				for ($i = $start; $i <= $finish; $i++) {
					$data['expense_date' . $i] = "";
					$data['expense_particular' . $i] = "";
					$data['expense_vendor' . $i] = "";
					$data['expense_amount' . $i] = "";
				}
				$data['count_it'] = $count;
			} else {
				$empty_range = $count_ex - $count;
				$start = $count + 1;
				$finish = $count + $empty_range;
				for ($i = $start; $i <= $finish; $i++) {
					$data['date' . $i] = "";
					$data['particular' . $i] = "";
					$data['client_info' . $i] = "";
					$data['amount' . $i] = "";
				}
				$data['count_it'] = $count_ex;
			}

			$this->load->view('admin/show_ledger_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_sales_statement()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$product_id = $this->input->post('product_id');
			$client_id = $this->input->post('client_id');
			$sales_type = $this->input->post('sales_type');
			$invoice = $this->input->post('invoice');
			$user = $this->input->post('user');

			$checking_array = array();

			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
			}
			if (!empty($product_id)) {
				$checking_array['product_id'] = $product_id;
			}
			if (!empty($sales_type)) {
				$checking_array['sales_type'] = $sales_type;
			}
			if (!empty($invoice)) {
				$checking_array['invoice_no'] = $invoice;
			}
			if (!empty($user)) {
				$checking_array['sold_by'] = $user;
			}
			if (!empty($client_id)) {
				$checking_array['client_id'] = $client_id;
			}
			$result = $this->Common_model->get_distinct_value_where('invoice_no', "sell_product", $checking_array);
			$count = 0;
			foreach ($result as $info) {
				$count++;
				$checking_array['invoice_no'] = $info->invoice_no;
				$data['pro_result' . $count] = $this->Common_model->get_all_info_by_array("sell_product", $checking_array);
			}
			$data['count_it'] = $count;
			$this->load->view('admin/sales_statement_show_all', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_officer_list()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$department = $this->input->post('department');
			$data['all_employee'] = $this->Common_model->get_allinfo_byid('employee', 'department', $department);
			$this->load->view('admin/show_officer_list', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function return_product()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$invoice = $this->input->post('invoice_no');
			$date = date('Y-m-d');

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			foreach ($result as $info) {
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$sell_qty = $info->product_qty;
				$manufacture_company = $info->manufacture_company;

				//Updating total quantity in insert_product_info
				$checking_array = array(
					'record_id' => $product_id
				);

				$single_result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
				foreach ($single_result as $single_info) {
					$old_qty = $single_info->total_qty;
					$new_qty = $old_qty + $sell_qty;
				}
				$update_data = array(
					'total_qty' => $new_qty
				);

				$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);


				//keeping return record as return list
				$returned_qty = $sell_qty;
				$insert_data = array(
					'date' => $date,
					'invoice_no' => $invoice,
					'product_id' => $product_id,
					'product_type' => $product_type,
					'sub_category' => $sub_category,
					'brand_name' => $brand_name,
					'product_name' => $product_name,
					'product_model' => $product_model,
					'manufacture_company' => $manufacture_company,
					'returned_qty' => $returned_qty
				);
				$this->Common_model->insert_data('returned_product_info', $insert_data);
			}
			//deleting voucher info from sell_product & sales_due
			$this->Common_model->delete_info('invoice_no', $invoice, 'sell_product');
			$this->Common_model->delete_info('invoice_no', $invoice, 'sales_due');

			$data['return_product'] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			$this->load->view('admin/sold_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function update_product_full_row()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$record_id = $this->input->post('record_id');
			$product_qty = $this->input->post('product_qty');
			$sub_total = $this->input->post('total_price');
			$date = date('Y-m-d');

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('sell_product', 'record_id', $record_id);
			foreach ($result as $info) {
				$invoice = $info->invoice_no;
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$sell_qty = $info->product_qty;
				$sell_price = $info->sub_total;
				$total_price = $info->total;
			}
			//Updating total quantity in insert_product_info
			$checking_array = array(
				'record_id' => $product_id
			);
			$result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
			foreach ($result as $info) {
				$old_qty = $info->total_qty;
				$new_qty = $old_qty + ($sell_qty - $product_qty);
			}
			$update_data = array(
				'total_qty' => $new_qty
			);
			$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);

			//keeping return record as return list
			$returned_qty = $sell_qty - $product_qty;
			$insert_data = array(
				'date' => $date,
				'invoice_no' => $invoice,
				'product_id' => $product_id,
				'product_type' => $product_type,
				'sub_category' => $sub_category,
				'brand_name' => $brand_name,
				'product_name' => $product_name,
				'product_model' => $product_model,
				'manufacture_company' => $manufacture_company,
				'returned_qty' => $returned_qty
			);
			$this->Common_model->insert_data('returned_product_info', $insert_data);
			$update_data = array(
				'product_qty' => $product_qty,
				'sub_total' => $sub_total
			);
			$this->Common_model->update_data_onerow('sell_product', $update_data, 'record_id', $record_id);

			//Updating new total to sell_product
			$new_total = $total_price - ($sell_price - $sub_total);
			$update_data = array(
				'total' => $new_total
			);
			$this->Common_model->update_data_onerow('sell_product', $update_data, 'invoice_no', $invoice);

			//Updating new total to sales_due
			$result = $this->Common_model->get_allinfo_byid('sales_due', 'invoice_no', $invoice);
			foreach ($result as $info) {
				$old_due = $info->due;
			}
			$update_data = array(
				'total' => $new_total,
				'due' => $old_due - ($sell_price - $sub_total)
			);
			$this->Common_model->update_data_onerow('sales_due', $update_data, 'invoice_no', $invoice);

			$data['return_product'] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			$this->load->view('admin/sold_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function return_product_full_row()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$record_id = $this->input->post('record_id');
			$date = date("Y-m-d");

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('sell_product', 'record_id', $record_id);
			foreach ($result as $info) {
				$invoice = $info->invoice_no;
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$sell_qty = $info->product_qty;
				$sell_price = $info->sub_total;
				$total_price = $info->total;
			}

			//Updating total quantity in insert_product_info
			$checking_array = array(
				'record_id' => $product_id
			);
			$result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
			foreach ($result as $info) {
				$old_qty = $info->total_qty;
				$new_qty = $old_qty + $sell_qty;
			}
			$update_data = array(
				'total_qty' => $new_qty
			);
			$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);

			//keeping return record as return list
			$returned_qty = $sell_qty;
			$insert_data = array(
				'date' => $date,
				'invoice_no' => $invoice,
				'product_id' => $product_id,
				'product_type' => $product_type,
				'sub_category' => $sub_category,
				'brand_name' => $brand_name,
				'product_name' => $product_name,
				'product_model' => $product_model,
				'manufacture_company' => $manufacture_company,
				'returned_qty' => $returned_qty
			);
			$this->Common_model->insert_data('returned_product_info', $insert_data);

			$this->Common_model->delete_info('record_id', $record_id, 'sell_product');

			//Updating new total to sell_product
			$new_total = $total_price - $sell_price;
			$update_data = array(
				'total' => $new_total
			);
			$this->Common_model->update_data_onerow('sell_product', $update_data, 'invoice_no', $invoice);

			//Updating new total to sales_due
			$result = $this->Common_model->get_allinfo_byid('sales_due', 'invoice_no', $invoice);
			foreach ($result as $info) {
				$old_due = $info->due;
			}
			$update_data = array(
				'total' => $new_total,
				'due' => $old_due - $sell_price
			);
			$this->Common_model->update_data_onerow('sales_due', $update_data, 'invoice_no', $invoice);

			$data['return_product'] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			$this->load->view('admin/sold_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function sold_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$invoice = $this->input->post('invoice_no');
			$data['return_product'] = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice);
			$this->load->view('admin/sold_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function sales_success_msg2()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$all_sales = $this->input->post('all_sales');
			$date = $this->input->post('date');
			$result = $this->Common_model->find_last_id('record_id', 'sell_product');
			if (!$result) {
				$invoice_no = 1001;
			} else {
				foreach ($result as $row) {
					$invoice_no = ($row->invoice_no) + 1;
				}
			}

			$client_name = $this->input->post('client_name');
			$client_name_id = $this->input->post('client_name_id');
			if ($client_name_id == "New") {
				$result = $this->Common_model->find_last_id('record_id', 'add_client');
				if (!$result) {
					$client_id = 1;
				} else {
					foreach ($result as $row) {
						$client_id = ($row->record_id) + 1;
					}
				}
				$img_name = $client_id . ".jpg";

				$insert_data = array(
					'record_id' => $client_id,
					'date' => $date,
					'name' => $client_name,
					'image' => $img_name
				);
				$this->Common_model->insert_data('add_client', $insert_data);
			} else {
				$client_name_id = explode('#', $client_name_id);
				$client_name = $client_name_id[0];
				$client_id = $client_name_id[1];
			}

			$paid = $this->input->post('pay');
			$due = $this->input->post('due');
			$discount = $this->input->post('discount');
			$complete_total = $this->input->post('complete_total');
			$invoice_total = $this->input->post('invoice_total');
			$previous_due = $this->input->post('previous_due');
			$payment_type = $this->input->post('payment_type');
			$bank_name = $this->input->post('bank_name');
			$account_no = $this->input->post('account_no');
			$cheque_no = $this->input->post('cheque_no');
			$user = $this->session->ses_full_name;

			if (!empty($all_sales)) {
				foreach ($all_sales as $single_sale) {
					$sales_type = $single_sale[0];
					$product_id = $single_sale[1];
					$purchase_category = $single_sale[2];
					$product_name = $single_sale[3];
					$vendor = $single_sale[4];
					$selling_price = $single_sale[5];
					$product_qty = $single_sale[6];
					$total_price = $single_sale[7];
					$serial = $single_sale[8];
					$warranty = $single_sale[9];
					if (!empty($serial)) {
						$serial = implode('#', $serial);
					}

					$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $product_id);
					foreach ($result as $info) {
						$total_qty = $info->total_qty;
					}
					$insert_data = array(
						'date' => $date,
						'invoice_no' => $invoice_no,
						'sales_type' => $sales_type,
						'product_id' => $product_id,
						'product_type' => $purchase_category,
//                        'sub_category' => $sub_category,
//                        'brand_name' => $brand_name,
						'product_name' => $product_name,
//                        'product_model' => $product_model,
						'manufacture_company' => $vendor,
						'serial' => $serial,
						'warranty' => $warranty,
						'price_per_unit' => $selling_price,
						'product_qty' => $product_qty,
						'sub_total' => $total_price,
						'client_name' => $client_name,
						'client_id' => $client_id,
						'discount' => $discount,
						'total' => $invoice_total - $discount,
						'payment_type' => $payment_type,
						'bank_name' => $bank_name,
						'account_no' => $account_no,
						'cheque_no' => $cheque_no,
						'sold_by' => $user
					);
					$this->Common_model->insert_data('sell_product', $insert_data);
					$new_qty = $total_qty - $product_qty;
					$update_data = array(
						'total_qty' => $new_qty
					);
					$this->Common_model->update_data_onerow('insert_product_info', $update_data, 'record_id', $product_id);
				}

				$update_data = array('delete_status' => 0);
				$this->Common_model->update_data_all_column('sales_due', $update_data);

				$insert_data = array(
					'date' => $date,
					'invoice_no' => $invoice_no,
					'client_name' => $client_name,
					'client_id' => $client_id,
					'total' => $invoice_total - $discount,
					'paid' => $paid,
					'due' => $due,
					'delete_status' => 1
				);
				$this->Common_model->insert_data('sales_due', $insert_data);

				$data['date'] = $date;
				$data['invoice'] = $invoice_no;
				$data['customer_name'] = $client_name;
				$data['customer_id'] = " [Client ID: " . $client_id . "]";
				$data['invoice_total'] = $invoice_total;
				$data['discount'] = $discount;
				$data['sub_total'] = $invoice_total - $discount;
				$data['previous_due'] = $previous_due;
				$data['complete_total'] = $complete_total;
				$data['paid'] = $paid;
				$data['due'] = $due;
				$data['sold_by'] = $user;

				$data['all_sales'] = $all_sales;

				$this->load->view('admin/show_sales_invoice', $data);
			} else {
				echo "<p style='color: red; font-size: 20px; text-align: center;'>Please provide your product details</p>";
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function selling_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$product_id = $this->input->post('record_id');
			$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $product_id);
			foreach ($result as $info) {
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$selling_price = $info->selling_price;
				$available_qty = $info->total_qty;
				$product_quantity = 1;
				$total_price = $product_quantity * $selling_price;
			}
			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'product_id', $product_id);
			$all_serial = "";
			foreach ($result as $info) {
				$all_serial .= $info->serial . "###";
			}

			$result = $this->Common_model->get_allinfo_byid('sell_product', 'product_id', $product_id);
			foreach ($result as $info) {
				$sales_serial = explode('#', $info->serial);
				foreach ($sales_serial as $s) {
					$sales_serial = $s . "###";
					$all_serial = str_replace($sales_serial, '', $all_serial);
				}
			}

			$data = array($product_id, $product_type, $product_name, $product_model,
				$manufacture_company, $selling_price, $product_quantity,
				$total_price, $available_qty, $sub_category, $brand_name, $all_serial);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function client_details()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$client = explode('#', $this->input->post('client'));
			$client_id = $client[1];

			$result = $this->Common_model->get_allinfo_byid('add_client', 'record_id', $client_id);

			foreach ($result as $info) {
				$mobile = $info->mobile;
				$email = $info->email;
			}
			$data = array($mobile, $email);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function return_to_manufacture()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$invoice = $this->input->post('invoice_no');
			$date = date('Y-m-d');

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $invoice);
			foreach ($result as $info) {
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$purchase_qty = $info->product_qty;
				$manufacture_company = $info->manufacture_company;

				//Updating total quantity in insert_product_info
				$checking_array = array(
					'record_id' => $product_id
				);
				$single_result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
				foreach ($single_result as $single_info) {
					$old_qty = $single_info->total_qty;
					$new_qty = $old_qty - $purchase_qty;
				}
				$update_data = array(
					'total_qty' => $new_qty
				);
				$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);

				//keeping return record as return list
				$returned_qty = $purchase_qty;
				$insert_data = array(
					'date' => $date,
					'invoice_no' => $invoice,
					'manufacture_company' => $manufacture_company,
					'product_id' => $product_id,
					'product_name' => $product_name,
					'product_type' => $product_type,
					'sub_category' => $sub_category,
					'brand_name' => $brand_name,
					'product_model' => $product_model,
					'returned_qty' => $returned_qty
				);
				$this->Common_model->insert_data('returned_to_manufacturer', $insert_data);
			}

			//deleting voucher info from purchase_product & purchase_due
			$this->Common_model->delete_info('invoice_no', $invoice, 'purchase_product');
			$this->Common_model->delete_info('voucher_no', $invoice, 'purchase_due');

			$data['return_product'] = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $invoice);
			$this->load->view('admin/purchased_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function return_to_manufacture_update_full_row()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$record_id = $this->input->post('record_id');
			$product_qty = $this->input->post('product_qty');
			$sub_total = $this->input->post('total_price');
			$date = date('Y-m-d');

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'record_id', $record_id);
			foreach ($result as $info) {
				$invoice = $info->invoice_no;
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$purchase_qty = $info->product_qty;
				$purchase_price = $info->sub_total;
				$total_price = $info->total;
			}

			//Updating total quantity in insert_product_info
			$checking_array = array(
				'record_id' => $product_id
			);
			$result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
			foreach ($result as $info) {
				$old_qty = $info->total_qty;
				$new_qty = $old_qty - ($purchase_qty - $product_qty);
			}
			$update_data = array(
				'total_qty' => $new_qty
			);
			$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);

			//keeping return record as return list
			$returned_qty = $purchase_qty - $product_qty;
			$insert_data = array(
				'date' => $date,
				'invoice_no' => $invoice,
				'manufacture_company' => $manufacture_company,
				'product_id' => $product_id,
				'product_name' => $product_name,
				'product_type' => $product_type,
				'sub_category' => $sub_category,
				'brand_name' => $brand_name,
				'product_model' => $product_model,
				'returned_qty' => $returned_qty
			);
			$this->Common_model->insert_data('returned_to_manufacturer', $insert_data);

			$update_data = array(
				'product_qty' => $product_qty,
				'sub_total' => $sub_total
			);
			$this->Common_model->update_data_onerow('purchase_product', $update_data, 'record_id', $record_id);

			//Updating new total to purchase_product
			$new_total = $total_price - ($purchase_price - $sub_total);
			$update_data = array(
				'total' => $new_total
			);
			$this->Common_model->update_data_onerow('purchase_product', $update_data, 'invoice_no', $invoice);

			//Updating new total to purchase_due
			$result = $this->Common_model->get_allinfo_byid('purchase_due', 'voucher_no', $invoice);
			foreach ($result as $info) {
				$old_due = $info->due;
			}
			$update_data = array(
				'total' => $new_total,
				'due' => $old_due - ($purchase_price - $sub_total)
			);
			$this->Common_model->update_data_onerow('purchase_due', $update_data, 'voucher_no', $invoice);

			$data['return_product'] = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $invoice);
			$this->load->view('admin/purchased_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function return_to_manufacture_full_row()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$record_id = $this->input->post('record_id');
			$date = date('Y-m-d');

			//Getting data by specific record id
			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'record_id', $record_id);
			foreach ($result as $info) {
				$invoice = $info->invoice_no;
				$product_id = $info->product_id;
				$product_type = $info->product_type;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$purchase_qty = $info->product_qty;
				$purchase_price = $info->sub_total;
				$total_price = $info->total;
			}

			//Updating total quantity in insert_product_info
			$checking_array = array(
				'record_id' => $product_id
			);
			$result = $this->Common_model->get_all_info_by_array('insert_product_info', $checking_array);
			foreach ($result as $info) {
				$old_qty = $info->total_qty;
				$new_qty = $old_qty - $purchase_qty;
			}
			$update_data = array(
				'total_qty' => $new_qty
			);
			$this->Common_model->update_data_onerow_where_array('insert_product_info', $update_data, $checking_array);

			//keeping return record as return list
			$returned_qty = $purchase_qty;
			$insert_data = array(
				'date' => $date,
				'invoice_no' => $invoice,
				'manufacture_company' => $manufacture_company,
				'product_id' => $product_id,
				'product_name' => $product_name,
				'product_type' => $product_type,
				'sub_category' => $sub_category,
				'brand_name' => $brand_name,
				'product_model' => $product_model,
				'returned_qty' => $returned_qty
			);
			$this->Common_model->insert_data('returned_to_manufacturer', $insert_data);
			$this->Common_model->delete_info('record_id', $record_id, 'purchase_product');

			//Updating new total to purchase_product
			$new_total = $total_price - $purchase_price;
			$update_data = array(
				'total' => $new_total
			);
			$this->Common_model->update_data_onerow('purchase_product', $update_data, 'invoice_no', $invoice);

			//Updating new total to purchase_due
			$result = $this->Common_model->get_allinfo_byid('purchase_due', 'voucher_no', $invoice);
			foreach ($result as $info) {
				$old_due = $info->due;
			}
			$update_data = array(
				'total' => $new_total,
				'due' => $old_due - $purchase_price
			);
			$this->Common_model->update_data_onerow('purchase_due', $update_data, 'voucher_no', $invoice);

			$data['return_product'] = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $invoice);
			$this->load->view('admin/purchased_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function purchased_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$invoice = $this->input->post('invoice_no');
			$data['return_product'] = $this->Common_model->get_allinfo_byid('purchase_product', 'invoice_no', $invoice);
			$this->load->view('admin/purchased_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_purchase_for_manufacture_return()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');

			$checking_array = array();
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
			}

			$result = $this->Common_model->get_distinct_value_where('invoice_no', 'purchase_product', $checking_array);
			$count = 0;
			foreach ($result as $info) {
				$count++;
				$checking_array['invoice_no'] = $info->invoice_no;
				$data['product_result' . $count] = $this->Common_model->get_all_info_by_array('purchase_product', $checking_array);
			}
			$data['count_it'] = $count;
			$data['category'] = "";
			$this->load->view('admin/get_purchase_for_manufacture_return', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function inout_report()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$trans_type = $this->input->post('trans_type');

			$checking_array = array();
			if ($trans_type == "in") {
				//Sell
				if (!empty($date_from) && !empty($date_to)) {
					$checking_array['date>='] = $date_from;
					$checking_array['date<='] = $date_to;
				}
				$result = $this->Common_model->get_distinct_value_where('invoice_no', 'purchase_product', $checking_array);
				$count = 0;
				foreach ($result as $info) {
					$count++;
					$checking_array['invoice_no'] = $info->invoice_no;
					$data['product_result' . $count] = $this->Common_model->get_all_info_by_array('purchase_product', $checking_array);
				}
				$data['count_it'] = $count;
				$this->load->view('admin/product_in_report', $data);
			} elseif ($trans_type == "out") {
				//Purchase
				if (!empty($date_from) && !empty($date_to)) {
					$checking_array['date>='] = $date_from;
					$checking_array['date<='] = $date_to;
				}
				$result = $this->Common_model->get_distinct_value_where('invoice_no', "sell_product", $checking_array);
				$count = 0;
				foreach ($result as $info) {
					$count++;
					$checking_array['invoice_no'] = $info->invoice_no;
					$data['product_result' . $count] = $this->Common_model->get_all_info_by_array("sell_product", $checking_array);
				}
				$data['count_it'] = $count;
				$this->load->view('admin/product_out_report', $data);
			} else {
				//Purchase
				$checking_array_p = array();
				if (!empty($date_from) && !empty($date_to)) {
					$checking_array['date>='] = $date_from;
					$checking_array['date<='] = $date_to;
					$checking_array_p['date>='] = $date_from;
					$checking_array_p['date<='] = $date_to;
				}
				$result = $this->Common_model->get_distinct_value_where('invoice_no', 'purchase_product', $checking_array);
				$count = 0;
				foreach ($result as $info) {
					$count++;
					$checking_array['invoice_no'] = $info->invoice_no;
					$data['product_result' . $count] = $this->Common_model->get_all_info_by_array('purchase_product', $checking_array);
				}
				$data['count_it'] = $count;

				//Sell
				$result2 = $this->Common_model->get_distinct_value_where('invoice_no', 'sell_product', $checking_array_p);
				$count2 = 0;
				foreach ($result2 as $info2) {
					$count2++;
					$checking_array_p['invoice_no'] = $info2->invoice_no;
					$data['product_result2' . $count2] = $this->Common_model->get_all_info_by_array('sell_product', $checking_array_p);
				}
				$data['count_it2'] = $count2;
				$this->load->view('admin/product_inout_report', $data);
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_purchase_statement()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$product_id = $this->input->post('product_id');
			$invoice = $this->input->post('invoice');
			$manufacturer = $this->input->post('manufacturer');
			$checking_array = array();
			if (!empty($date_from) && !empty($date_to)) {
				$checking_array['date>='] = $date_from;
				$checking_array['date<='] = $date_to;
			}
			if (!empty($product_id)) {
				$checking_array['product_id'] = $product_id;
			}
			if (!empty($invoice)) {
				$checking_array['invoice_no'] = $invoice;
			}
			if (!empty($manufacturer)) {
				$checking_array['manufacture_company'] = $manufacturer;
			}
			$result = $this->Common_model->get_distinct_value_where('invoice_no', "purchase_product", $checking_array);
			$count = 0;
			foreach ($result as $info) {
				$count++;
				$checking_array['invoice_no'] = $info->invoice_no;
				$data['product_result' . $count] = $this->Common_model->get_all_info_by_array("purchase_product", $checking_array);
			}
			$data['count_it'] = $count;
			$this->load->view('admin/purchase_statement_product', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function show_sold_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$serial = $this->input->post('serial_no');
			$data['serial'] = $serial;

			if (!empty($serial)) {
				$result = $this->Common_model->get_all_info("sell_product");
				foreach ($result as $res) {
					$s = explode('#', $res->serial);
					if (in_array($serial, $s)) {
						$d = $res->record_id;
						break;
					}
				}
				$data['all_value'] = $this->Common_model->get_allinfo_byid("sell_product", 'record_id', $d);
			} else {
				$data['all_value'] = $this->Common_model->get_all_info("sell_product");
			}


			$this->load->view('admin/show_sold_product_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function purchase_success_msg2()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$all_purchase = $this->input->post('all_purchase');
			$date = $this->input->post('date');
			$result = $this->Common_model->find_last_id('invoice_no', 'purchase_product');
			if (!$result) {
				$voucher = 1001;
			} else {
				foreach ($result as $row) {
					$voucher = ($row->invoice_no) + 1;
				}
			}
			$paid = $this->input->post('pay');
			$due = $this->input->post('due');
			$complete_total = $this->input->post('complete_total');
			$payment_type = $this->input->post('payment_type');
			$bank_name = $this->input->post('bank_name');
			$account_no = $this->input->post('account_no');
			$cheque_no = $this->input->post('cheque_no');
			foreach ($all_purchase as $single_purchase) {
				$product_id = $single_purchase[0];
				$purchase_category = $single_purchase[1];
//                $purchase_sub_category = $single_purchase[2];
//                $purchase_brand_name = $single_purchase[3];
				$product_name = $single_purchase[2];
				$temp_serial = $single_purchase[3];
				$serial = preg_replace('/\s+/', '###', $temp_serial);
				$vendor = $single_purchase[4];
				$total_price = $single_purchase[5];
				$product_qty = $single_purchase[6];
				$purchase_price = $single_purchase[7];
				$average_price = $single_purchase[8];
				$selling_price = $single_purchase[9];
				$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $product_id);
				foreach ($result as $info) {
					$total_qty = $info->total_qty;
				}
				$insert_data = array(
					'date' => $date,
					'invoice_no' => $voucher,
					'product_id' => $product_id,
					'product_type' => $purchase_category,
//                    'sub_category' => $purchase_sub_category,
//                    'brand_name' => $purchase_brand_name,
					'product_name' => $product_name,
					'serial' => $serial,
					'manufacture_company' => $vendor,
					'product_price' => $total_price,
					'sub_total' => $total_price,
					'product_qty' => $product_qty,
					'purchase_price' => $purchase_price,
					'average_price' => $average_price,
					'selling_price' => $selling_price,
					'total' => $complete_total,
					'payment_type' => $payment_type,
					'bank_name' => $bank_name,
					'account_no' => $account_no,
					'cheque_no' => $cheque_no
				);
				$this->Common_model->insert_data('purchase_product', $insert_data);
				$new_qty = $total_qty + $product_qty;
				$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $product_id);
				foreach ($result as $res) {
					$s = $res->serial;
				}
				$update_data = array(
					'total_qty' => $new_qty,
					'purchase_price' => $average_price,
					'selling_price' => $selling_price,
					'serial' => $s . '###' . $serial
				);
				$this->Common_model->update_data_onerow('insert_product_info', $update_data, 'record_id', $product_id);
			}
			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('purchase_due', $update_data);

			$insert_data = array(
				'date' => $date,
				'voucher_no' => $voucher,
				'manufacturer' => $vendor,
				'total' => $complete_total,
				'paid' => $paid,
				'due' => $due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('purchase_due', $insert_data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$product_id = $this->input->post('product_id');
			$result = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $product_id);
			foreach ($result as $info) {
				$product_type = $info->product_type;
				$product_id = $info->record_id;
				$product_name = $info->product_name;
				$product_model = $info->product_model;
				$manufacture_company = $info->manufacture_company;
				$sub_category = $info->sub_category;
				$brand_name = $info->brand_name;
			}

			$result = $this->Common_model->get_allinfo_byid('purchase_product', 'product_id', $product_id);
			$total_price = 0;
			$total_qty = 0;
			foreach ($result as $info) {
				$total_price += $info->sub_total;
				$total_qty += $info->product_qty;
			}
			$data = array($product_type, $product_name, $product_model,
				$manufacture_company, $sub_category, $brand_name, $total_price, $total_qty, $product_id);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function department_designation()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$employee = explode('#', $this->input->post('employee'));
			$employee_id = $employee[1];

			$result = $this->Common_model->get_allinfo_byid('employee', 'record_id', $employee_id);

			foreach ($result as $info) {
				$department = $info->department;
				$designation = $info->designation;
			}
			$data = array($department, $designation);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_project_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('project_id');

			$result = $this->Common_model->get_allinfo_byid('payment_processing', 'record_id', $id);

			foreach ($result as $info) {
				$area = $info->land_area;
				$land_amount = $info->land_amount;
				$land_price = $info->total_amount;
				$interest_rate = $info->interest_rate;
				$num_months = $info->num_months;
				$installment_amount = $info->installment_amount;
			}
			$data = array($area, $land_amount, $land_price, $interest_rate, $num_months, $installment_amount);
			echo json_encode($data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_payment_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('payment_id');

			$result = $this->Common_model->get_allinfo_byid('down_payment', 'record_id', $id);

			$data['all_down'] = $result;
			$this->load->view('admin/show_payment_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function pay_installment()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date = $this->input->post('date');
			$payment_id = $this->input->post('payment_id');
			$rest_month = $this->input->post('rest_month');
			$paid_amount = $this->input->post('paid_amount');
			$num_months = $this->input->post('num_months');
			$pay_method = $this->input->post('pay_method');
			$bank_name = $this->input->post('bank_name');
			$branch_name = $this->input->post('branch_name');
			$ac_no = $this->input->post('ac_no');
			$cheque_no = $this->input->post('cheque_no');

			$insert_data = array(
				'date' => $date,
				'payment_id' => $payment_id,
				'num_months' => $num_months,
				'paid_amount' => $paid_amount,
				'pay_method' => $pay_method,
				'bank_name' => $bank_name,
				'branch_name' => $branch_name,
				'ac_no' => $ac_no,
				'cheque_no' => $cheque_no,
			);
			$this->Common_model->insert_data('installment_payment', $insert_data);


			$result = $this->Common_model->get_allinfo_byid('down_payment', 'record_id', $payment_id);
			foreach ($result as $res) {
				$rest_month_old = $res->rest_months;
				$rest_amount_old = $res->rest_amount;
			}
			$rest_month_new = $rest_month_old - $num_months;
			$rest_amount_new = $rest_amount_old - $paid_amount;

			$update_data = array(
				'rest_months' => $rest_month_new,
				'rest_amount' => $rest_amount_new,
			);
			$this->Common_model->update_data_onerow('down_payment', $update_data, 'record_id', $payment_id);

			$result = $this->Common_model->get_allinfo_byid('down_payment', 'record_id', $payment_id);
			$data['all_down'] = $result;
			$this->load->view('admin/show_payment_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_employee_for_attendance()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$department = $this->input->post('department');
			$data['department'] = $department;
			$session = date("Y");
			$data['session'] = $session;
			$data['date'] = $this->input->post('date');
			$data['intime'] = $this->input->post('intime');
			$this->load->model('Common_model');
			$table_name = "employee";

			$result = $this->Common_model->get_all_info($table_name);
			$data['all_value'] = $result;
//            print_r($result);
			$this->load->view('admin/employee_info_for_attendance', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function get_employee_attendance_report()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$report = $this->input->post('report');
			$data['e_type'] = $report;
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
//            echo $report.$date_from.$date_to;
			$table_name = "employee_attendance";
			$checking_array = array(
				'department' => $report
			);
			$data['date_range'] = date('d F, Y', strtotime($date_from)) . " - " . date('d F, Y', strtotime($date_to));

			$result = $this->Common_model->data_date_to_date($table_name, 'date', $date_from, $date_to);

			$data['all_value'] = $result;
			$this->load->view('admin/attendance_report_info', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function send_sms_employee()
	{
		$sms_body = $this->input->post('sms_body');

		$result = $this->Common_model->get_all_info('employee');

		if (!empty($result)) {
			foreach ($result as $res) {
				$return_code = $this->send_sms("+88" . $res->mobile, $sms_body);
			}
			echo "<p style='color: green; font-size: 20px; padding: 10px;'>Message Sent Successfully</p>";
		} else {
			echo "<p style='color: red; font-size: 20px; padding: 10px;'>No user found</p>";
		}
	}

	public function send_sms($mobile, $sms_body)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://107.20.199.106/restapi/sms/1/text/single",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{ "
				. "\"from\":\"+8804445650406\", "
				. "\"to\":\"" . $mobile . "\", "
				. "\"text\":\"" . $sms_body . "\" }",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: Basic bGVvcGFyZDU4OmFiYzI3MTEzMTg5MA==",
				"content-type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			//echo "cURL Error #:" . $err;
			return -1;
		} else {
			//echo $response;
			$result = json_decode($response, true);
			return $result['messages'][0]['status']['groupId'];
		}
	}

	public function get_sms_by_title()
	{
		$title = $this->input->post('title');
		$this->load->model('Common_model');
		$message = $this->Common_model->one_column_one_info('body', 'title', $title, 'create_sms');
		foreach ($message as $m) {
			$msg = $m->body;
		}
		echo $msg;
	}

}
