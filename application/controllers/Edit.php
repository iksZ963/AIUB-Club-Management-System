<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Edit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
    }

	public function edit_osa() {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$objective = $this->input->post('objective2');

			$activities = $this->input->post('activities2');
			$contact = $this->input->post('contact2');
			$email = $this->input->post('email2');
			$address = $this->input->post('address2');

			$update_data = array(
				'objective' => $objective,
				'activities' => $activities,
				'contact' => $contact,
				'email' => $email,
				'address' => $address,
			);
			$this->Common_model->update_data_onerow('osa', $update_data, 'record_id', 1);
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function edit_club() {
		$user_type = $this->session->ses_user_type;
		if ($user_type == "osa" || $user_type == "excom") {

			$club_id = $this->input->post('club_id');

			$club_name = $this->input->post('club_name2');
			$foundation_date = $this->input->post('foundation_date2');
			$slogan = $this->input->post('slogan2');
			$details = $this->input->post('details2');
			$current_com = $this->input->post('current_com2');

			$img_name = $club_id . ".jpg";

			$config['file_name'] = $img_name;
			$config['upload_path'] = './assets/img/club/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->do_upload('logo2');

			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/img/club/' . $img_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$update_data = array(
				'club_name' => $club_name,
				'foundation_date' => $foundation_date,
				'slogan' => $slogan,
				'details' => $details,
				'current_committee' => $current_com,
				'logo' => $img_name,
			);
			$this->Common_model->update_data_onerow('club', $update_data, 'record_id', $club_id);

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

    public function resume_member() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('member_id');
            $update_data = array('status' => 0);
            $this->Common_model->update_data_onerow('member', $update_data, 'record_id', $id);

            $result =  $this->Common_model->get_allinfo_byid('member', 'record_id', $id);
			foreach ($result as $info) {
				$club_id = $info->club_id;
			}

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

    public function suspend_member() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('member_id');
            $update_data = array('status' => 1);
            $this->Common_model->update_data_onerow('member', $update_data, 'record_id', $id);

			$result =  $this->Common_model->get_allinfo_byid('member', 'record_id', $id);
			foreach ($result as $info) {
				$club_id = $info->club_id;
			}

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

    public function resume_osa_member() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa") {
			$id = $this->input->post('member_id');
            $update_data = array('status' => 0);
            $this->Common_model->update_data_onerow('osa_member', $update_data, 'record_id', $id);
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function suspend_osa_member() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa") {
			$id = $this->input->post('member_id');
            $update_data = array('status' => 1);
            $this->Common_model->update_data_onerow('osa_member', $update_data, 'record_id', $id);
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function resume_club() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('club_id');
            $update_data = array('status' => 1);
            $this->Common_model->update_data_onerow('club', $update_data, 'record_id', $id);
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function suspend_club() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
			$id = $this->input->post('club_id');
            $update_data = array('status' => 0);
            $this->Common_model->update_data_onerow('club', $update_data, 'record_id', $id);
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function delivered_product($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $update_data = array('delivered_status' => 1);
            $this->Common_model->update_data_onerow('sell_product', $update_data, 'invoice_no', $id);
            redirect('Show_form/delivered_product/delivered', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_manufacture_company($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $vendor_name = $this->input->post('vendor_name');
            $old_vendor_name = $this->input->post('old_vendor_name');
            $mobile = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $previous_due = $this->input->post('previous_due');

            $update_data = array(
                'manufacture_company' => $vendor_name,
                'mobile' => $mobile,
                'address' => $address,
                'previous_due' => $previous_due
            );
            $this->Common_model->update_data_onerow('create_manufacture_company', $update_data, 'record_id', $id);

            //Update purchase_due vendor name
            $update_data = array(
                'manufacturer' => $vendor_name
            );
            $this->Common_model->update_data_onerow('purchase_due', $update_data, 'manufacturer', $old_vendor_name);

            //Update purchase_due due
            $update_data = array(
                'due' => $previous_due
            );

            $checking_array = array(
                'manufacturer' => $vendor_name,
                'voucher_no' => "Previous Due"
            );
            $this->Common_model->update_data_onerow_where_array('purchase_due', $update_data, $checking_array);

            //Update purchase_product vendor name
            $update_data = array(
                'manufacture_company' => $vendor_name
            );
            $this->Common_model->update_data_onerow('purchase_product', $update_data, 'manufacture_company', $old_vendor_name);

            redirect('Show_form/create_manufacture_company/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_name($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $product_name = $this->input->post('product_name');
            $update_data = array(
                'product_name' => $product_name
            );
            $this->Common_model->update_data_onerow('create_product_name', $update_data, 'record_id', $id);
            redirect('Show_form/create_product_name/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_type($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $product_type = $this->input->post('product_type');
            $update_data = array(
                'product_type' => $product_type
            );
            $this->Common_model->update_data_onerow('create_product_type', $update_data, 'record_id', $id);
            redirect('Show_form/create_product_type/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_dealing($id) {
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

            $update_data = array(
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
            $this->Common_model->update_data_onerow('sales_dealing', $update_data, 'record_id', $id);
            redirect('Show_form/sales_dealing/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_schedule($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $client = explode('#', $this->input->post('client'));
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $meeting_date = $this->input->post('meeting_date');
            $venue = $this->input->post('venue');
            $time = $this->input->post('time');
            $responsible_person = $this->input->post('responsible_person');

            $update_data = array(
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
            $this->Common_model->update_data_onerow('sales_schedule', $update_data, 'record_id', $id);
            redirect('Show_form/sales_schedule/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function add_client($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $client_name = $this->input->post('client_name');
            $old_client_name = $this->input->post('old_client_name');
            $mobile = $this->input->post('mobile');
            $address = $this->input->post('address');
            $previous_due = $this->input->post('previous_due');

            $update_data = array(
                'date' => date('Y-m-d'),
                'name' => $client_name,
                'mobile' => $mobile,
                'address' => $address,
                'previous_due' => $previous_due
            );
            $this->Common_model->update_data_onerow('add_client', $update_data, 'record_id', $id);

            //Update sales_due client name
            $update_data = array(
                'client_name' => $client_name
            );
            $this->Common_model->update_data_onerow('sales_due', $update_data, 'client_name', $old_client_name);

            //Update sales_due due
            $update_data = array(
                'due' => $previous_due
            );

            $checking_array = array(
                'client_name' => $client_name,
                'invoice_no' => "Previous Due"
            );
            $this->Common_model->update_data_onerow_where_array('sales_due', $update_data, $checking_array);

            //Update sell_product client name
            $update_data = array(
                'client_name' => $client_name
            );
            $this->Common_model->update_data_onerow('sell_product', $update_data, 'client_name', $old_client_name);

            redirect('Show_form/add_client/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_product_info($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $img_name = $id . ".jpg";

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
            $product_indication = $this->input->post('product_indication');
            $unit_type = $this->input->post('unit');
            $reminder_level = $this->input->post('reminder_level');
            $shelf_details = $this->input->post('shelf_details');
            $update_data = array(
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
                'shelf_details' => $shelf_details
            );

            $this->Common_model->update_data_onerow('insert_product_info', $update_data, 'record_id', $id);
            redirect('Show_form/insert_product_info/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_schedule($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $date = $this->input->post('date');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            $temp_available_days = $this->input->post('available_days');
            $available_days = "";
            foreach ($temp_available_days as $day) {
                $available_days = $available_days . $day . "#";
            }
            $update_data = array(
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'available_days' => $available_days
            );
            $this->Common_model->update_data_onerow('employee_schedule', $update_data, 'record_id', $id);
            redirect('Show_form/employee_schedule/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }


    public function employee_active($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $update_data = array('block_status' => 0);
            $this->Common_model->update_data_onerow('employee', $update_data, 'record_id', $id);
            redirect('Show_form/employee_list/active', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_inactive($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $update_data = array('block_status' => 1);
            $this->Common_model->update_data_onerow('employee', $update_data, 'record_id', $id);
            redirect('Show_form/employee_list/inactive', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_list($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa") {
            $img_name = $id . ".jpg";

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

            $update_data = array(
                'name' => $name,
                'designation' => $designation,
                'joining_date' => $joining_date,
                'department' => $department,
                'mobile' => $mobile,
                'address' => $address,
                'bank_name' => $bank_name,
                'account' => $account,
                'total_salary' => $total_salary,
            );
            $this->Common_model->update_data_onerow('employee', $update_data, 'record_id', $id);
            redirect('Show_form/employee_list/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function update_attendance() {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $this->load->model('Common_model');
            $report = $this->input->post('report');
            $count = $this->input->post('count');

            $table_name = 'employee_attendance';


            for ($i = 1; $i <= $count; $i++) {
                $outtime = $this->input->post('outtime' . $i);
                $record_id = $this->input->post('record' . $i);
                $status = $this->input->post('status' . $i);

                if (!empty($outtime)) {
                    $update_data = array(
                        'outtime' => $outtime,
                        'status' => $status,
                    );
                    $this->Common_model->update_data_onerow($table_name, $update_data, 'record_id', $record_id);
                } else {
                    $outtime = $this->input->post('outtime' . $count);
                    $update_data = array(
                        'outtime' => $outtime,
                        'status' => $status,
                    );
                    $this->Common_model->update_data_onerow($table_name, $update_data, 'record_id', $record_id);
                }
            }
            redirect('Show_form/attendance_report/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }
    public function create_sms($id)
    {
        if ($this->session->userdata('ses_user_type') == "osa") {
            $this->load->model('Common_model');
            $this->form_validation->set_rules('date', 'Create Date', 'trim|required');
            $this->form_validation->set_rules('title', 'Message Title', 'trim|required');
            $this->form_validation->set_rules('body', 'Message Body', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                redirect('Show_edit_form/create_sms/' . $id . '/empty', 'refresh');
            } else {
                $date = $this->input->post('date');
                $title = $this->input->post('title');
                $body = $this->input->post('body');

                $update_data = array(
                    'create_date' => $date,
                    'title' => $title,
                    'body' => $body
                );
                $this->Common_model->update_data_onerow('create_sms', $update_data, 'record_id', $id);
                redirect('Show_form/create_sms/edit', 'refresh');
            }
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_notice($id)
    {
        if ($this->session->userdata('ses_user_type') == "osa") {
            $this->form_validation->set_rules('date', 'Date', 'trim|required');
            $this->form_validation->set_rules('particular', 'Particular', 'trim|required');
            $this->form_validation->set_rules('details', 'Details', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                redirect('Show_edit_form/insert_notice/' . $id . '/empty', 'refresh');
            } else {
                $date = $this->input->post('date');
                $particular = $this->input->post('particular');
                $details = $this->input->post('details');

                $update_data = array(
                    'date' => $date,
                    'particular' => $particular,
                    'details' => $details
                );
                $this->Common_model->update_data_onerow('insert_notice', $update_data, 'record_id', $id);
                redirect('Show_form/insert_notice/edit', 'refresh');
            }
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }
    public function create_user($id)
    {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $img_name = $id . ".jpg";

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

            $permission="";
            if(!empty($inventory)){
                $permission.=$inventory."###";
            }
            if(!empty($sales)){
                $permission.=$sales."###";
            }
            if(!empty($accounting)){
                $permission.=$accounting."###";
            }
            if(!empty($hr)){
                $permission.=$hr;
            }

            $update_data = array(
                'name' => $name,
                'mobile' => $mobile,
                'address' => $address,
                'username' => $username,
                'password' => $password,
                'permission' => $permission
            );
            $this->Common_model->update_data_onerow('user', $update_data, 'record_id', $id);
            redirect('Show_form/create_user/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }
    public function create_sub_category($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $category = $this->input->post('category');
            $sub_category = $this->input->post('sub_category');
            $update_data = array(
                'category' => $category,
                'sub_category' => $sub_category
            );
            $this->Common_model->update_data_onerow('create_sub_category', $update_data, 'record_id', $id);
            redirect('Show_form/create_sub_category/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_brand_name($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "osa" || $user_type == "excom") {
            $brand_name = $this->input->post('brand_name');
            $update_data = array(
                'brand_name' => $brand_name
            );
            $this->Common_model->update_data_onerow('create_brand_name', $update_data, 'record_id', $id);
            redirect('Show_form/create_brand_name/edit', 'refresh');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }
}
