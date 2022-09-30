<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth_controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('superadmin_model');
        $this->load->model('common_model');
    }

    public function index()
    {
        $data['user'] = $this->superadmin_model->get_all_users();
        // $data['user'] = get_table_data($this->session->userdata('user_id'), 'user_id', 'user', 'user_id');

        $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('superadmin/login', $data);
        $this->load->view('superadmin/partials/footer', $data);
    }

    public function login_post()
    //validate inputs
    {
    $this->form_validation->set_rules('user_name', 'User Name', 'required|max_length[100]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('errors', validation_errors());
        $this->session->set_flashdata('form_data', $this->auth_model->input_values());
        // var_dump('hj');  
        // exit;
        redirect($this->agent->referrer());
    } else {

            if ($this->auth_model->index()) {
                (redirect('superadmin_controller/home'));
            } else {
                redirect($this->agent->referrer());
            }
        }
    }

  
    // logout

    public function logout()
    {
        redirect(base_url() . '/login');
    }
}
