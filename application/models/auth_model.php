<?php
class Auth_model extends CI_Model
{
    // private $exp_time = 60 * 5;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    //input values
    public function input_values()
    {
        $data = array(
            'username' => ($this->input->post('user_name', true)),
            'password' => $this->input->post('password', true),
            'phone_number' => $this->input->post('phone_number', true),
            'first_name' => $this->input->post('first_name', true),
            // 'email' => $this->input->post('email', true),
            // 'old_password' => $this->input->post('old_password', true),
            // 'new_password' => $this->input->post('new_password', true),
            // 'cnf_password' => $this->input->post('cnf_password', true),
        );
        return $data;
    }

    //login
    public function index()
    {
        $data['user_name'] = $this->input->post('user_name');
        $data['password'] = $this->input->post('password');
        $user = get_table_data($data['user_name'], 'user_name', 'user', 'user_name')[0];

       
        if (!empty($user)) {

            if ($user->is_active == 0) {
                $this->session->set_flashdata('error', 'Your account is inactive. You cannot log in.');
                return false;
            }

            
        } else {
            $this->session->set_flashdata('error');
            return false;
        }
    }
}
