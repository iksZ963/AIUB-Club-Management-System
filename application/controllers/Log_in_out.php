<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Log_in_out extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function index()
	{
		if ($this->session->userdata('ses_logged') == "YES") {

			$user_type = $this->session->ses_user_type;

			$data['all_post'] = $this->Common_model->get_all_info('post');

			$this->load->view('admin/header');
			if ($user_type == 'osa') {
				$this->load->view('admin/dashboard', $data);
			} elseif ($user_type == 'excom') {
				$this->load->view('admin/dashboard', $data);
			} else {
				$this->load->view('admin/dashboard', $data);
			}
			$this->load->view('admin/footer');
		} else {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		}
	}

	public function block_msg()
	{
		$data['wrong_msg'] = "Sorry ! Your ID is inactive now<br>Please Contact with OSA";
		$this->load->view('website/login_check', $data);
	}

	public function login_check()
	{
		$this->form_validation->set_rules('userid', 'User ID', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['wrong_msg'] = "";
			$this->load->view('website/login_check', $data);
		} else {
			$userid = $this->input->post('userid');
			$password = $this->input->post('password');
			$block_status = 0;
			$has_user = 0;
			$checking_array = array("userid" => $userid, "password" => $password);
			$result = $this->Common_model->check_value_get_data('login', $checking_array);

			if ($result) {
				$has_user = 1;
				foreach ($result as $result_info) {
					$block_status = "";
					$record_id = $result_info->record_id;
					$userid = $result_info->userid;
					$password = $result_info->password;
					$user_type = $result_info->user_type;
					if ($user_type == 'osa') {
						$result = $this->Common_model->check_value_get_data('osa_member', $checking_array);
						foreach ($result as $res){
							$username = $res->name;
						}
					} else {
						$result = $this->Common_model->check_value_get_data('member', $checking_array);
						foreach ($result as $res){
							$username = $res->name;
						}
					}
				}
			}


			if ($block_status == 1) {
				redirect('Log_in_out/block_msg', 'refresh');
			} elseif ($has_user == 1) {
				$sesdata = array(
					'ses_record_id' => $record_id,
					'ses_userid' => $userid,
					'ses_password' => $password,
					'ses_user_type' => $user_type,
					'ses_username' => $username,
					'ses_logged' => "YES"
				);
				$this->session->set_userdata($sesdata);
				redirect('/Log_in_out', 'refresh');
			} else {
				$data['wrong_msg'] = "Wrong Name/Password";
				$this->load->view('website/login_check', $data);
			}
		}
	}

	public function logout()
	{
		$user_type = $this->session->ses_user_type;
		if ($this->session->userdata('ses_logged') == "YES") {

			$logout_array = array('ses_record_id', 'ses_userid', 'ses_password', 'ses_user_type', 'ses_username', 'ses_logged');

			$this->session->unset_userdata($logout_array);
			redirect('/Log_in_out', 'refresh');
		}
	}

}
