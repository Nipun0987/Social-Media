<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
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

    public function signup_post(){
        $form_data = $this->input->post();

        var_dump($form_data['first_name']);
    }
}
