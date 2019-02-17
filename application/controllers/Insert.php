<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Insert extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function add_club()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$club_name = $this->input->post('club_name');
			$foundation_date = $this->input->post('foundation_date');
			$slogan = $this->input->post('slogan');
			$details = $this->input->post('details');
			$current_com = $this->input->post('current_com');

			$result = $this->Common_model->find_last_id('record_id', 'club');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/club/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('logo');

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/club/' . $img_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();


			$insert_data = array(
				'club_name' => $club_name,
				'foundation_date' => $foundation_date,
				'slogan' => $slogan,
				'details' => $details,
				'current_committee' => $current_com,
				'logo' => $img_name,
				'status' => 1
			);
			$this->Common_model->insert_data('club', $insert_data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function post_club()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$clubs = $this->input->post('clubs');
			$clubs = implode('#', $clubs);
			$post = $this->input->post('post');
			$date = date('Y-m-d');
			$time = date('h:i:s');
			$posted_to = $clubs;
			$posted_by = $this->session->ses_userid;


			$insert_data = array(
				'date' => $date,
				'time' => $time,
				'post' => $post,
				'posted_to' => $posted_to,
				'posted_by' => $posted_by,
			);
			$this->Common_model->insert_data('post', $insert_data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function send_message()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom" || $user_type == "member") {

			$to_ = $this->input->post('to_');
			$message = $this->input->post('message');
			$date = date('Y-m-d');
			$time = date('h:i:s');
			$from_ = $this->session->ses_userid;


			$insert_data = array(
				'date' => $date,
				'time' => $time,
				'to_' => $to_,
				'message' => $message,
				'from_' => $from_,
			);
			$this->Common_model->insert_data('message', $insert_data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function add_member()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$name = $this->input->post('name');
			$club_id = $this->input->post('club_id');
			$club_name = $this->input->post('club_name');
			$role = $this->input->post('c_role');
			$designation = $this->input->post('designation');
			if ($designation == 'Other') {
				$designation = $this->input->post('other_des');
			}
			$joining_sem = $this->input->post('joining_sem') . '-' . $this->input->post('joining_sem_year');
			$faculty = $this->input->post('faculty');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$cgpa = $this->input->post('cgpa');
			$userid = $this->input->post('aiub_id');
			$password = $this->input->post('password');

			$result = $this->Common_model->find_last_id('record_id', 'member');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/member/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('image');

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/member/' . $img_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();



			$insert_data = array(
				'name' => $name,
				'club_id' => $club_id,
				'club_name' => $club_name,
				'member_type' => $role,
				'designation' => $designation,
				'joining_semester' => $joining_sem,
				'faculty' => $faculty,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'cgpa' => $cgpa,
				'userid' => $userid,
				'password' => $password,
				'image' => $img_name,
			);
			$this->Common_model->insert_data('member', $insert_data);

			$insert_data = array(
				'user_type' => $role,
				'userid' => $userid,
				'password' => $password,
			);
			$this->Common_model->insert_data('login', $insert_data);

		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function add_osa_member()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa") {

			$name = $this->input->post('name');
			$designation = $this->input->post('designation');
			if ($designation == 'Other') {
				$designation = $this->input->post('other_des');
			}
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$userid = $this->input->post('aiub_id');
			$password = $this->input->post('password');

			$result = $this->Common_model->find_last_id('record_id', 'member');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/member/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('image');

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/member/' . $img_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();


			$insert_data = array(
				'name' => $name,
				'designation' => $designation,
				'contact' => $phone,
				'email' => $email,
				'userid' => $userid,
				'password' => $password,
				'image' => $img_name,
			);
			$this->Common_model->insert_data('osa_member', $insert_data);


			$insert_data = array(
				'user_type' => 'osa',
				'userid' => $userid,
				'password' => $password,
			);
			$this->Common_model->insert_data('login', $insert_data);

		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function sales_due()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date = $this->input->post('date');
			$invoice_no = $this->input->post('invoice');
			$result = $this->Common_model->get_allinfo_byid('sell_product', 'invoice_no', $invoice_no);
			foreach ($result as $info) {
				$client_name = $info->client_name;
				$client_id = $info->client_id;
			}
			$mobile = $this->input->post('mobile');
			$total = $this->input->post('total');
			$paid = $this->input->post('paid');
			$due = $this->input->post('final_due');

			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('sales_due', $update_data);


			$insert_data = array(
				'date' => $date,
				'invoice_no' => $invoice_no,
				'client_name' => $client_name,
				'client_id' => $client_id,
				'mobile' => $mobile,
				'total' => $total,
				'paid' => $paid,
				'due' => $due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('sales_due', $insert_data);
			redirect('Show_form/sales_due/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function insert_purchase_payment()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$search_vendor = $this->input->post('search_vendor');
			$paid = $this->input->post('paid');
			$final_due = $this->input->post('final_due');
			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('purchase_due', $update_data);

			$insert_data = array(
				'date' => date('Y-m-d'),
				'voucher_no' => "Payment",
				'manufacturer' => $search_vendor,
				'total' => 0,
				'paid' => $paid,
				'due' => $final_due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('purchase_due', $insert_data);

			$data['all_value'] = $this->Common_model->get_allinfo_byid('purchase_due', 'manufacturer', $search_vendor);
			$data['old_due'] = $this->input->post('final_due');
			$data['vendor_name'] = $search_vendor;
			$this->load->view('admin/show_purchase_due', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function insert_sales_payment()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$search_client = explode('#', $this->input->post('search_client'));
			$client_name = $search_client[0];
			$client_id = $search_client[1];

			$paid = $this->input->post('paid');
			$final_due = $this->input->post('final_due');
			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('sales_due', $update_data);

			$insert_data = array(
				'date' => date('Y-m-d'),
				'invoice_no' => "Payment",
				'client_name' => $client_name,
				'client_id' => $client_id,
				'total' => 0,
				'paid' => $paid,
				'due' => $final_due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('sales_due', $insert_data);

			$data['all_value'] = $this->Common_model->get_allinfo_byid('sales_due', 'client_id', $client_id);
			$data['old_due'] = $this->input->post('final_due');
			$data['client_name'] = $client_name;
			$data['client_id'] = $client_id;
			$this->load->view('admin/show_sales_due', $data);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_salary_sheet()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$employee_id = $this->input->post('employee_id');
			if (!empty($employee_id)) {
				$result = $this->Common_model->one_column_one_info('name', 'record_id', $employee_id, 'employee');
				foreach ($result as $info) {
					$employee_name = $info->name;
				}
				$month = $this->input->post('month');
				$designation = $this->input->post('designation');
				$account_no = $this->input->post('account_no');
				$salary_scale = $this->input->post('salary_scale');
				$insert_data = array(
					'date' => date('Y-m-d'),
					'employee_id' => $employee_id,
					'employee_name' => $employee_name,
					'month' => $month,
					'designation' => $designation,
					'account_no' => $account_no,
					'salary_scale' => $salary_scale
				);
				$this->Common_model->insert_data('create_salary_sheet', $insert_data);
				redirect('Show_form/create_salary_sheet/created', 'refresh');
			} else {
				redirect('Show_form/create_salary_sheet/empty', 'refresh');
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function bank_withdraw()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$date = $this->input->post('date');
			$bank = explode("#", $this->input->post('bank'));
			$amount = $this->input->post('amount');
			$responsible_person = $this->input->post('responsible_person');
			$insert_data = array(
				'date' => $date,
				'bank_name' => $bank[0],
				'account_no' => $bank[1],
				'amount' => $amount,
				'responsible_person' => $responsible_person
			);
			$this->Common_model->insert_data('bank_withdraw', $insert_data);
			redirect('Show_form/bank_withdraw/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function bank_deposit()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$date = $this->input->post('date');
			$bank = explode("#", $this->input->post('bank'));
			$amount = $this->input->post('amount');
			$responsible_person = $this->input->post('responsible_person');
			$insert_data = array(
				'date' => $date,
				'bank_name' => $bank[0],
				'account_no' => $bank[1],
				'amount' => $amount,
				'responsible_person' => $responsible_person
			);
			$this->Common_model->insert_data('bank_deposit', $insert_data);
			redirect('Show_form/bank_deposit/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_bank_name()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$bank_name = $this->input->post('bank_name');
			$account_no = $this->input->post('account_no');
			$insert_data = array(
				'bank_name' => $bank_name,
				'account_no' => $account_no
			);
			$this->Common_model->insert_data('create_bank_name', $insert_data);
			redirect('Show_form/create_bank_name/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function expense()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');

			$date = $this->input->post('date');
			$expense_head = $this->input->post('expense_head');
			$voucher_no = $this->input->post('voucher_no');
			$quantity = $this->input->post('quantity');
			$amount = $this->input->post('amount');
			$comment = $this->input->post('comment');

			$insert_data = array(
				'date' => $date,
				'head' => $expense_head,
				'voucher_no' => $voucher_no,
				'quantity' => $quantity,
				'amount' => $amount,
				'comment' => $comment
			);
			$this->Common_model->insert_data('expense', $insert_data);
			redirect('Show_form/expense/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function expense_head()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');

			$expense_head = $this->input->post('expense_head');
			$insert_data = array(
				'head' => $expense_head
			);
			$this->Common_model->insert_data('expense_head', $insert_data);
			redirect('Show_form/expense_head/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function income_head()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');

			$income_head = $this->input->post('income_head');
			$insert_data = array(
				'head' => $income_head
			);
			$this->Common_model->insert_data('income_head', $insert_data);
			redirect('Show_form/income_head/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function income()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');

			$date = $this->input->post('date');
			$income_head = $this->input->post('income_head');
			$invoice_no = $this->input->post('invoice_no');
			$quantity = $this->input->post('quantity');
			$amount = $this->input->post('amount');
			$comment = $this->input->post('comment');

			$insert_data = array(
				'date' => $date,
				'head' => $income_head,
				'invoice_no' => $invoice_no,
				'quantity' => $quantity,
				'amount' => $amount,
				'comment' => $comment
			);
			$this->Common_model->insert_data('income', $insert_data);
			redirect('Show_form/income/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function sales_dealing()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$client = explode('#', $this->input->post('client'));
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$meeting_date = $this->input->post('meeting_date');
			$venue = $this->input->post('venue');
			$time = $this->input->post('time');
			$responsible_person = $this->input->post('responsible_person');
			$comments = $this->input->post('comments');

			$insert_data = array(
				'date' => date('Y-m-d'),
				'name' => $client[0],
				'client_id' => $client[1],
				'mobile' => $mobile,
				'email' => $email,
				'meeting_date' => $meeting_date,
				'venue' => $venue,
				'time' => $time,
				'responsible_person' => $responsible_person,
				'comments' => $comments
			);
			$this->Common_model->insert_data('sales_dealing', $insert_data);
			redirect('Show_form/sales_dealing/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function sales_schedule()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$client = explode('#', $this->input->post('client'));
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$meeting_date = $this->input->post('meeting_date');
			$venue = $this->input->post('venue');
			$time = $this->input->post('time');
			$responsible_person = $this->input->post('responsible_person');

			$insert_data = array(
				'date' => date('Y-m-d'),
				'name' => $client[0],
				'client_id' => $client[1],
				'mobile' => $mobile,
				'email' => $email,
				'meeting_date' => $meeting_date,
				'venue' => $venue,
				'time' => $time,
				'responsible_person' => $responsible_person,
			);
			$this->Common_model->insert_data('sales_schedule', $insert_data);
			redirect('Show_form/sales_schedule/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function add_client()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$result = $this->Common_model->find_last_id('record_id', 'add_client');
			if (!$result) {
				$max_id = 101;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$client_name = $this->input->post('client_name');
			$mobile = $this->input->post('mobile');
			$address = $this->input->post('address');
			$previous_due = $this->input->post('previous_due');

			if (empty($previous_due)) {
				$previous_due = 0;
			}

			$insert_data = array(
				'record_id' => $max_id,
				'date' => date('Y-m-d'),
				'name' => $client_name,
				'mobile' => $mobile,
				'address' => $address,
				'previous_due' => $previous_due
			);
			$this->Common_model->insert_data('add_client', $insert_data);

			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('sales_due', $update_data);

			$insert_data = array(
				'date' => date('Y-m-d'),
				'invoice_no' => "Previous Due",
				'client_name' => $client_name,
				'client_id' => $max_id,
				'mobile' => $mobile,
				'total' => $previous_due,
				'paid' => 0,
				'due' => $previous_due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('sales_due', $insert_data);
			redirect('Show_form/add_client/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function insert_product_info()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$result = $this->Common_model->find_last_id('record_id', 'insert_product_info');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/product/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('image');

			$product_type = $this->input->post('product_type');
			$sub_category = $this->input->post('sub_category');
			$product_name = $this->input->post('product_name');
			$brand_name = $this->input->post('brand_name');
			$product_model = $this->input->post('product_model');
			$manufacture_company = $this->input->post('manufacture_company');
			$unit_type = $this->input->post('unit');
			$reminder_level = $this->input->post('reminder_level');
			$product_indication = $this->input->post('product_indication');
			$shelf_details = $this->input->post('shelf_details');

			$insert_data = array(
				'record_id' => $max_id,
				'date' => date('Y-m-d'),
				'product_type' => $product_type,
				'sub_category' => $sub_category,
				'product_name' => $product_name,
				'brand_name' => $brand_name,
				'product_model' => $product_model,
				'manufacture_company' => $manufacture_company,
				'product_indication' => $product_indication,
				'unit_type' => $unit_type,
				'reminder_level' => $reminder_level,
				'image' => $img_name,
				'shelf_details' => $shelf_details
			);
			$this->Common_model->insert_data('insert_product_info', $insert_data);
			redirect('Show_form/insert_product_info/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function employee_schedule()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date = $this->input->post('date');
			$employee = explode('#', $this->input->post('employee'));
			$employee_name = $employee[0];
			$employee_id = $employee[1];
			$designation = $this->input->post('designation');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$temp_available_days = $this->input->post('available_days');
			$available_days = "";
			foreach ($temp_available_days as $day) {
				$available_days = $available_days . $day . "#";
			}
			$insert_data = array(
				'date' => $date,
				'employee_id' => $employee_id,
				'employee_name' => $employee_name,
				'designation' => $designation,
				'start_time' => $start_time,
				'end_time' => $end_time,
				'available_days' => $available_days
			);
			$this->Common_model->insert_data('employee_schedule', $insert_data);
			redirect('Show_form/employee_schedule/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_product_type()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$product_type = $this->input->post('product_type');
			$insert_data = array(
				'product_type' => $product_type
			);
			$this->Common_model->insert_data('create_product_type', $insert_data);
			redirect('Show_form/create_product_type/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_sub_category()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$category = $this->input->post('category');
			$sub_category = $this->input->post('sub_category');
			$insert_data = array(
				'category' => $category,
				'sub_category' => $sub_category
			);
			$this->Common_model->insert_data('create_sub_category', $insert_data);
			redirect('Show_form/create_sub_category/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_product_name()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$product_name = $this->input->post('product_name');
			$insert_data = array(
				'product_name' => $product_name
			);
			$this->Common_model->insert_data('create_product_name', $insert_data);
			redirect('Show_form/create_product_name/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_brand_name()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$brand_name = $this->input->post('brand_name');
			$insert_data = array(
				'brand_name' => $brand_name
			);
			$this->Common_model->insert_data('create_brand_name', $insert_data);
			redirect('Show_form/create_brand_name/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_manufacture_company()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$vendor_name = $this->input->post('vendor_name');
			$mobile = $this->input->post('mobile_no');
			$address = $this->input->post('address');
			$previous_due = $this->input->post('previous_due');
			if (empty($previous_due)) {
				$previous_due = 0;
			}

			$insert_data = array(
				'manufacture_company' => $vendor_name,
				'mobile' => $mobile,
				'address' => $address,
				'previous_due' => $previous_due
			);
			$this->Common_model->insert_data('create_manufacture_company', $insert_data);

			$update_data = array('delete_status' => 0);
			$this->Common_model->update_data_all_column('purchase_due', $update_data);
			$insert_data = array(
				'date' => date('Y-m-d'),
				'voucher_no' => "Previous Due",
				'manufacturer' => $vendor_name,
				'total' => $previous_due,
				'paid' => 0,
				'due' => $previous_due,
				'delete_status' => 1
			);
			$this->Common_model->insert_data('purchase_due', $insert_data);

			redirect('Show_form/create_manufacture_company/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_storage_type()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$storage_type = $this->input->post('storage_type');
			$insert_data = array(
				'storage_type' => $storage_type
			);
			$this->Common_model->insert_data('create_storage_type', $insert_data);
			redirect('Show_form/create_storage_type/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_department()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$department = $this->input->post('department');
			$insert_data = array(
				'department' => $department
			);
			$this->Common_model->insert_data('create_department', $insert_data);
			redirect('Show_form/create_department/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_designation()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$designation = $this->input->post('designation');
			$insert_data = array(
				'designation' => $designation
			);
			$this->Common_model->insert_data('create_designation', $insert_data);
			redirect('Show_form/create_designation/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function project_settings()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$project = $this->input->post('project');
			$insert_data = array(
				'project_program' => $project
			);
			$this->Common_model->insert_data('project_program', $insert_data);
			redirect('Show_form/project_settings/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function reg_processing()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date = $this->input->post('date');
			$client = $this->input->post('client');
			$project = $this->input->post('project');
			$price = $this->input->post('price');
			$land_amount = $this->input->post('land_amount');
			$balance = $this->input->post('balance');
			$num_installment = $this->input->post('num_installment');
			$reg_fee = $this->input->post('reg_fee');
			$insert_data = array(
				'date' => $date,
				'client_name' => $client,
				'project_program' => $project,
				'price_per_unit' => $price,
				'land_amount' => $land_amount,
				'total' => $balance,
				'num_installment' => $num_installment,
				'registration_fee' => $reg_fee,
			);
			$this->Common_model->insert_data('reg_processing', $insert_data);
			redirect('Show_form/reg_processing/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function customer_care()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$date = $this->input->post('date');
			$visitor = $this->input->post('name');
			$mobile = $this->input->post('mobile');
			$address = $this->input->post('address');
			$destination = $this->input->post('destination');
			$insert_data = array(
				'date' => $date,
				'name' => $visitor,
				'mobile_no' => $mobile,
				'address' => $address,
				'destination' => $destination,
			);
			$this->Common_model->insert_data('customer_care', $insert_data);
			redirect('Show_form/customer_care/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function payment_processing()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {


			$project_program = $this->input->post('project_program');
			$land_area = $this->input->post('land_area');
			$land_amount = $this->input->post('land_amount');
			$price = $this->input->post('price');
			$interest_rate = $this->input->post('interest_rate');
			$total_amount = $this->input->post('balance');
			$num_months = $this->input->post('num_months');
			$installment_amount = $this->input->post('installment_amount');
			$delay_charge = $this->input->post('delay_charge');
			$insert_data = array(
				'project_program' => $project_program,
				'land_area' => $land_area,
				'land_amount' => $land_amount,
				'land_price' => $price,
				'interest_rate' => $interest_rate,
				'total_amount' => $total_amount,
				'num_months' => $num_months,
				'installment_amount' => $installment_amount,
				'delay_charge' => $delay_charge,
			);
			$this->Common_model->insert_data('payment_processing', $insert_data);
			redirect('Show_form/payment_processing/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function down_payment()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {


			$date = $this->input->post('date');
			$project_id = $this->input->post('project_program');

			$result = $this->Common_model->get_allinfo_byid('payment_processing', 'record_id', $project_id);
			foreach ($result as $res) {
				$project_program = $res->project_program;
			}

			$land_area = $this->input->post('land_area');
			$land_amount = $this->input->post('land_amount');
			$price = $this->input->post('price');
			$interest_rate = $this->input->post('interest_rate');
			$num_months = $this->input->post('num_months');
			$installment_amount = $this->input->post('installment_amount');
			$down_payment = $this->input->post('down_payment');
			$rest_balance = $this->input->post('rest_balance');
			$insert_data = array(
				'date' => $date,
				'project_program' => $project_program,
				'land_area' => $land_area,
				'land_amount' => $land_amount,
				'land_price' => $price,
				'interest_rate' => $interest_rate,
				'num_months' => $num_months,
				'installment_amount' => $installment_amount,
				'down_payment' => $down_payment,
				'rest_amount' => $rest_balance,
			);
			$this->Common_model->insert_data('down_payment', $insert_data);
			redirect('Show_form/down_payment/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function publication()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$title = $this->input->post('title');
			$file_name = $title . ".pdf";

			$config['file_name'] = $file_name;
			$config['upload_path'] = './assets/files/publications/';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('publication');

			$insert_data = array(
				'file_name' => $file_name
			);
			$this->Common_model->insert_data('publication', $insert_data);
			redirect('Show_form/publication/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_employee()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa") {
			$result = $this->Common_model->find_last_id('record_id', 'employee');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/employee/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('image');

			$name = $this->input->post('name');
			$designation = $this->input->post('designation');
			$joining_date = $this->input->post('joining_date');
			$department = $this->input->post('department');
			$mobile = $this->input->post('mobile');
			$address = $this->input->post('address');
			$bank_name = $this->input->post('bank_name');
			$account = $this->input->post('account');
			$total_salary = $this->input->post('total_salary');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$hr = $this->input->post('hr');
			$inventory = $this->input->post('inventory');
			$commerce = $this->input->post('commerce');
			$project = $this->input->post('project');
			$crm = $this->input->post('crm');
			$payment = $this->input->post('payment');
			$accounting = $this->input->post('accounting');
			$others = $this->input->post('others');

			$insert_data = array(
				'record_id' => $max_id,
				'name' => $name,
				'designation' => $designation,
				'joining_date' => $joining_date,
				'department' => $department,
				'mobile' => $mobile,
				'address' => $address,
				'image' => $img_name,
				'bank_name' => $bank_name,
				'account' => $account,
				'total_salary' => $total_salary,
				'username' => $username,
				'password' => $password,
				'block_status' => 0
			);
			$this->Common_model->insert_data('employee', $insert_data);
			redirect('Show_form/create_employee/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function employee_attendance()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->form_validation->set_rules('intime', 'intime', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				redirect('Show_form/teacher_excom_attendance/empty', 'refresh');
			} else {
				$date = $this->input->post('date');
				$day = $this->input->post('day');
				$session_name = $this->input->post('session');
				$intime = $this->input->post('intime');
				$count = $this->input->post('count');
				$department = $this->input->post('department');
				for ($i = 1; $i <= $count; $i++) {
					$employee = $this->input->post('employee_id' . $i);
					$name = $this->input->post('name' . $i);
					$status = $this->input->post('status' . $i);
					$designation = $this->input->post('designation' . $i);
					$insert_data = array(
						'date' => $date,
						'day' => $day,
						'year' => $session_name,
						'employee_id' => $employee,
						'department' => $department,
						'name' => $name,
						'designation' => $designation,
						'intime' => $intime,
						'status' => $status,
					);
					$this->Common_model->insert_data('employee_attendance', $insert_data);
				}
				redirect('Show_form/employee_attendance/created', 'refresh');
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_sms()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$this->form_validation->set_rules('date', 'Create Date', 'trim|required');
			$this->form_validation->set_rules('title', 'Message Title', 'trim|required');
			$this->form_validation->set_rules('body', 'Message Body', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				redirect('Show_form/create_sms/empty', 'refresh');
			} else {
				$date = $this->input->post('date');
				$title = $this->input->post('title');
				$body = $this->input->post('body');

				$insert_data = array(
					'create_date' => $date,
					'title' => $title,
					'body' => $body
				);
				$this->Common_model->insert_data('create_sms', $insert_data);
				redirect('Show_form/create_sms/created', 'refresh');
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function insert_notice()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$this->load->model('Common_model');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			$this->form_validation->set_rules('particular', 'Particular', 'trim|required');
			$this->form_validation->set_rules('details', 'Details', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				redirect('Show_form/insert_notice/empty', 'refresh');
			} else {
				$date = $this->input->post('date');
				$particular = $this->input->post('particular');
				$details = $this->input->post('details');

				$insert_data = array(
					'date' => $date,
					'particular' => $particular,
					'details' => $details
				);
				$this->Common_model->insert_data('insert_notice', $insert_data);
				redirect('Show_form/insert_notice/created', 'refresh');
			}
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function create_user()
	{
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {
			$result = $this->Common_model->find_last_id('record_id', 'user');
			if (!$result) {
				$max_id = 1;
			} else {
				foreach ($result as $row) {
					$max_id = ($row->record_id) + 1;
				}
			}
			$img_name = $max_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/user/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('image');

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/user/' . $img_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$name = $this->input->post('name');
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$address = $this->input->post('address');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$inventory = $this->input->post('inventory');
			$sales = $this->input->post('sales');
			$accounting = $this->input->post('accounting');
			$hr = $this->input->post('hr');

			$permission = "";
			if (!empty($inventory)) {
				$permission .= $inventory . "###";
			}
			if (!empty($sales)) {
				$permission .= $sales . "###";
			}
			if (!empty($accounting)) {
				$permission .= $accounting . "###";
			}
			if (!empty($hr)) {
				$permission .= $hr;
			}

			$insert_data = array(
				'record_id' => $max_id,
				'name' => $name,
				'mobile' => $mobile,
				'email' => $email,
				'address' => $address,
				'username' => $username,
				'password' => $password,
				'permission' => $permission
			);
			$this->Common_model->insert_data('user', $insert_data);
			redirect('Show_form/create_user/created', 'refresh');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}
}
