<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Show_edit_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
    }

    public function create_manufacture_company($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_manufacture_company', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_create_manufacture_company', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_name($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_product_name', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_create_product_name', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_product_type($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_product_type', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_create_product_type', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_dealing($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['one_value'] = $this->Common_model->get_allinfo_byid('sales_dealing', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_sales_dealing', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function sales_schedule($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['all_client'] = $this->Common_model->get_all_info('add_client');
            $data['one_value'] = $this->Common_model->get_allinfo_byid('sales_schedule', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_sales_schedule', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function add_client($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $this->load->model('Common_model');
            $data['one_value'] = $this->Common_model->get_allinfo_byid('add_client', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_add_client', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_product_info($id, $msg) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $this->load->model('Common_model');
            $data['product_name'] = $this->Common_model->get_all_info('create_product_name');
            $data['sub_category'] = $this->Common_model->get_all_info('create_sub_category');
            $data['product_type'] = $this->Common_model->get_all_info('create_product_type');
            $data['brand'] = $this->Common_model->get_all_info('create_brand_name');
            $data['manufacture_company'] = $this->Common_model->get_all_info('create_manufacture_company');
            $data['one_value'] = $this->Common_model->get_allinfo_byid('insert_product_info', 'record_id', $id);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/edit_product_info', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_schedule($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('employee_schedule', 'record_id', $id);
            $this->load->view('admin/header');
            $this->load->view('admin/edit_employee_schedule', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function employee_list($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('employee', 'record_id', $id);
            $data['all_designation'] = $this->Common_model->get_all_info('create_designation');
            $data['all_department'] = $this->Common_model->get_all_info('create_department');
            $this->load->view('admin/header');
            $this->load->view('admin/edit_employee', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_user($id) {
        $user_type = $this->session->ses_user_type;
        if ($user_type == "admin" || $user_type == "staff") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('user', 'record_id', $id);
            $data['all_employee'] = $this->Common_model->get_all_info('employee');
            $this->load->view('admin/header');
            $this->load->view('admin/edit_user', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_sms($id, $msg) {
        if ($this->session->userdata('ses_user_type') == "admin") {
            $data['all_value'] = $this->Common_model->get_all_info('create_sms');
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_sms', 'record_id', $id);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/edit_create_sms', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function insert_notice($id, $msg) {
        if ($this->session->userdata('ses_user_type') == "admin") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('insert_notice', 'record_id', $id);
            $data['all_value'] = $this->Common_model->get_all_info('insert_notice');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/edit_insert_notice', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_sub_category($id, $msg) {
        if ($this->session->userdata('ses_user_type') == "admin") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_sub_category', 'record_id', $id);
            $data['all_category'] = $this->Common_model->get_all_info('create_product_type');
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/edit_sub_category', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

    public function create_brand_name($id, $msg) {
        if ($this->session->userdata('ses_user_type') == "admin") {
            $data['one_value'] = $this->Common_model->get_allinfo_byid('create_brand_name', 'record_id', $id);
            $data['msg'] = $msg;
            $this->load->view('admin/header');
            $this->load->view('admin/edit_brand_name', $data);
            $this->load->view('admin/footer');
        } else {
            $data['wrong_msg'] = "";
            $this->load->view('website/login_check', $data);
        }
    }

}
