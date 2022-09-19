<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['page'] = 'Log In';

        $this->load->view('superadmin/partials/header_1', $data);
        $this->load->view('superadmin/login', $data);
        $this->load->view('superadmin/partials/footer', $data);
    }

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
        $this->load->view('superadmin/partials/footer', $data);
    }

    public function signup_post()
    {

        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('user_name', 'Username', 'required|max_length[100]');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|max_length[18]',
            array('required' => 'You must provide a %s.')
        );
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('superadmin/partials/header_1');
            $this->load->view('superadmin/signup');
            $this->load->view('superadmin/partials/footer');
        } else {
            $this->load->view('superadmin/partials/header_1');
            $this->load->view('superadmin/signup_save');
        }
    }
}
