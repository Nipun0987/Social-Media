<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin_controller extends Core_Controller
{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('superadmin_model');
        $this->load->model('common_model');
        // $this->load->model('file_model');
        // $this->load->model('tpa_model');
        // $this->load->model('insurance_model');
        // $this->load->helper('email');


        $this->load->helper(array('form', 'url'));

    }

    // public function login_post()
    // {
    //     //check auth
    //     // if (auth_check()) {
    //     //     redirect('home');
    //     // }

    //     //validate inputs
    //     $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[100]');
    //     $this->form_validation->set_rules(
    //         'password',
    //         'Password',
    //         'required|min_length[6]|max_length[18]'
    //     );

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //         $this->session->set_flashdata('form_data', $this->auth_model->input_values());
    //         redirect($this->agent->referrer());
    //     } else {

    //         if ($this->auth_model->login()) {
    //             redirect(base_url() . 'dashboard');
    //         } else {
    //             redirect($this->agent->referrer());
    //         }
    //     }
    // }
    // public function index()
    // {
    //     $data['page'] = 'Log In';

    //     $data['users'] = $this->superadmin_model->get_all_users();

    //     // $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'users', 'user_id')[0];


    //     $this->load->view('superadmin/partials/header_1', $data);
    //     $this->load->view('superadmin/login', $data);
    //     $this->load->view('superadmin/partials/footer', $data);
    // }

    // public function login_post()
    // {
    //     $user_name = $this->input->post('user_name');
    //     $password = $this->input->post('password');

    //     $this->load->model('superadmin_model');
    //     $this->superadmin_model->login_post_model($user_name, $password);
        
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //         $this->session->set_flashdata('form_data', $this->superadmin_model->input_values());
    //         redirect($this->agent->referrer());
    //     } else {
    //         if ($this->superadmin_model->login_post_model()) {
    //             redirect('superadmin_controller/home');
    //         } else {
    //             redirect($this->agent->referrer());
    //         }
    //     }
    // }

    public function signup()
    {
        $data['page'] = 'Sign Up';

        $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('superadmin/signup', $data);
        $this->load->view('superadmin/partials/footer', $data);
    }

    public function save()
    {
        $data['page'] = 'Sign Up Save';

        $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('superadmin/signup_save', $data);
    }



    public $user_data = array();


    public function signup_post()
    {

        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]|is_unique[user.phone_number]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[100]');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|max_length[18]'
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->superadmin_model->input_values_f_users());

            redirect($this->agent->referrer());
        } else {
            $this->user_data['phone_number'] = $this->input->post('phone_number', true);
            $this->user_data['first_name'] = $this->input->post('first_name', true);
            $this->user_data['user_name'] = $this->input->post('user_name', true);
            $this->user_data['password'] = $this->input->post('password', true);


            $this->superadmin_model->insert_user($this->user_data);

            // $this->load->view('superadmin/partials/header_1');
            // $this->load->view('superadmin/signup_save');
        }
    }

    public function home()
    {
        $data['page'] = 'Home';
        $data['user'] = $this->superadmin_model->get_all_users();

        // $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'users', 'user_id')[0];
        
        // $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('home', $data);
        // $this->load->view('superadmin/partials/footer', $data);
    }

    // public function home_data()
    // {
    // 	$this->load->model('superadmin_model');
    //     $fetch  =$this->superadmin_model->home_model();

    // 	$this->load->view('home',$fetch);

    // }

         //Logout//
    public function logout()
    {
        $this->auth_model->logout();
        redirect('superadmin/login');
    }
}
