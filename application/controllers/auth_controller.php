<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth_controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('superadmin_model');
        // $this->load->model('cmpadmin_model');
    }

    public function index()
    {
        $data['user'] = $this->superadmin_model->get_all_users();
        // $data['current_user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'users', 'user_id')[0];


        $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('superadmin/login', $data);
        $this->load->view('superadmin/partials/footer', $data);
    }

    public function superadmin_login()
    {
        $data['page'] = 'Login Panel';
        $this->load->view('home', $data);
    }

    public function login_post()
    {
        
        
        $this->form_validation->set_rules('user_name', 'User Name');
        $this->form_validation->set_rules('password', 'Password');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
           
        } else {

            if ($this->auth_model->index()) {
                redirect($this->load->view('superadmin/home') . 'dashboard');
            } else {
                redirect($this->agent->referrer());
            }
            
        }
    }

    // public function company_users_login($slug)
    // {

    //     if (get_cookie('remember')) {
    //         $comp_user_email = get_cookie('comp_user_email');
    //         $password = get_cookie('password');
    //     }

    //     if (check_company_user()) {
    //         redirect($slug . '/dashboard');
    //     }

    //     $data['company'] = $this->superadmin_model->get_company_by_slug($slug);

    //     if (empty($data['company'])) {
    //         echo 'no data found';
    //     } else {
    //         $this->load->view('company_views/login', $data);
    //     }
    // }

    // public function company_users_login_post()
    // {
    //     //validate inputs
    //     $this->form_validation->set_rules('comp_id', 'Comp ID', 'required');
    //     $this->form_validation->set_rules('comp_user_email', 'Email', 'required|max_length[100]');
    //     $this->form_validation->set_rules('password', 'Password', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //         $this->session->set_flashdata('form_data', $this->auth_model->input_values());
    //         redirect($this->agent->referrer());
    //     } else {
    //         if ($this->auth_model->company_users_login_post()) {
    //             redirect(comp_url() . 'dashboard');
    //         } else {
    //             redirect($this->agent->referrer());
    //         }
    //     }
    // }


    // logout

    public function logout()
    {
        // $slug = comp_slug();
        $this->auth_model->tpa_comp_user_logout();
        redirect(base_url() . '/login');
    }
}
