<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');

class Show_data extends CI_Controller {
    public function show_result($no) {
        $this->load->model('Common_model');
        $data['all_class'] = $this->Common_model->get_all_info('1_create_class');
        $data['all_group'] = $this->Common_model->get_all_info('2_create_group');
        $data['all_section'] = $this->Common_model->get_all_info('3_create_section');
        $data['all_shift'] = $this->Common_model->get_all_info('4_create_shift');
        $data['all_session'] = $this->Common_model->get_all_info('5_create_session');
        $data['all_exam_type'] = $this->Common_model->get_all_info('8_create_exam_type');
        
        $this->load->view('website/header');
        $data['no']=$no;
        $this->load->view('website/select_for_result', $data);
        $this->load->view('website/footer');
    }

    public function exam_routine() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('41_exam_routine');
        $this->load->view('website/header');
        $this->load->view('website/show_exam_routine', $data);
        $this->load->view('website/footer');
    }

    public function class_routine() {
        $this->load->model('Common_model');
        $data['all_class'] = $this->Common_model->get_all_info('1_create_class');
        $data['all_group'] = $this->Common_model->get_all_info('2_create_group');
        $data['all_section'] = $this->Common_model->get_all_info('3_create_section');
        $data['all_shift'] = $this->Common_model->get_all_info('4_create_shift');
        $data['all_session'] = $this->Common_model->get_all_info('5_create_session');
        $data['all_version'] = $this->Common_model->get_all_info('6_create_version');
        $this->load->view('website/header');
        $this->load->view('website/select_routine_info', $data);
        $this->load->view('website/footer');
    }

    public function board_of_directors() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('38_board_of_directors');
        $this->load->view('website/header');
        $this->load->view('website/show_board_of_directors', $data);
        $this->load->view('website/footer');
    }

    public function notice($user_title) {
        $this->load->model('Common_model');
        if ($user_title == 1) {
            $title_name = "Student";
        } elseif ($user_title == 2) {
            $title_name = "Teacher";
        } elseif ($user_title == 3) {
            $title_name = "Staff";
        } elseif ($user_title == 4) {
            $title_name = "Governing Body";
        }
        $data['all_value'] = $this->Common_model->get_allinfo_byid('37_notice', 'user_title', $user_title);

        $data['user_title'] = $title_name;

        $this->load->view('website/header');
        $this->load->view('website/show_notice', $data);
        $this->load->view('website/footer');
    }

    public function contact() {
        $this->load->model('Common_model');
        $this->load->view('website/header');
        $this->load->view('website/show_contact');
        $this->load->view('website/footer');
    }

    public function syllabus() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('36_syllabus');
        $this->load->view('website/header');
        $this->load->view('website/show_syllabus', $data);
        $this->load->view('website/footer');
    }

    public function booklist() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info_orderby('35_booklist', 'group_name', 'DESC');
        $this->load->view('website/header');
        $this->load->view('website/show_booklist', $data);
        $this->load->view('website/footer');
    }

    public function governing_body_profile() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('34_governing_body_profile');
        $this->load->view('website/header');
        $this->load->view('website/show_governing_body_profile', $data);
        $this->load->view('website/footer');
    }

    public function show_academic_calendar() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('23_academic_calendar');
        $this->load->view('website/header');
        $this->load->view('website/show_academic_calendar', $data);
        $this->load->view('website/footer');
    }

    public function photo_gallery() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('33_photo_gallery');
        $this->load->view('website/header');
        $this->load->view('website/show_photo_gallery', $data);
        $this->load->view('website/footer');
    }

    public function single_page_content($title) {
        $this->load->model('Common_model');
        if ($title == 1) {
            $title_name = "College Profile";
        } elseif ($title == 2) {
            $title_name = "Message from Honorable MP";
        } elseif ($title == 3) {
            $title_name = "Message from President";
        } elseif ($title == 4) {
            $title_name = "Message from Principle";
        } elseif ($title == 5) {
            $title_name = "Message from Upazilla Chairman";
        } elseif ($title == 6) {
            $title_name = "Message from UNO";
        } elseif ($title == 7) {
            $title_name = "Message from Meyor";
        } elseif ($title == 8) {
            $title_name = "Mission-Vision";
        } elseif ($title == 9) {
            $title_name = "Rules & Regulations";
        } elseif ($title == 10) {
            $title_name = "Instruction for Guardians";
        } elseif ($title == 11) {
            $title_name = "Dress Code";
        }
        $result = $this->Common_model->get_allinfo_byid('32_single_page_content', 'title', $title);
        if (empty($result)) {
            $details = "";
            $image = "";
        } else {
            foreach ($result as $info) {
                $details = $info->details;
                $image = $info->image;
            }
        }
        $data['title_name'] = $title_name;
        $data['image'] = $image;
        $data['details'] = $details;
        $this->load->view('website/header');
        $this->load->view('website/single_page_content', $data);
        $this->load->view('website/footer');
    }

    public function show_teacher_info() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('13_insert_teacher_info');
        $this->load->view('website/header');
        $this->load->view('website/show_teacher_info', $data);
        $this->load->view('website/footer');
    }

    public function show_staff_info() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('14_insert_staff_info');
        $this->load->view('website/header');
        $this->load->view('website/show_staff_info', $data);
        $this->load->view('website/footer');
    }

    public function show_student_info() {
        $this->load->model('Common_model');
        $data['all_value'] = $this->Common_model->get_all_info('12_insert_student_info');
        $this->load->view('website/header');
        $this->load->view('website/show_student_info', $data);
        $this->load->view('website/footer');
    }

}
