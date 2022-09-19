<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    
	public function home()
	{
		$data['page'] = 'Home';

		// $this->load->view('superadmin/partials/header_1', $data);
		$this->load->view('home', $data);
		// $this->load->view('superadmin/partials/footer', $data);
	}
}