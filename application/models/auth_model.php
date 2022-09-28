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
            'username' =>($this->input->post('user_name', true)),
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
        $data['user_name'] = trim($this->input->post('user_name'));
        $data['password'] = $this->input->post('password');
        $user = get_table_data($data['user_name'], 'user_id', 'user', 'user_id')[0];

        if (!empty($user)) {

            if ($user->is_active == 0) {
                $this->session->set_flashdata('error', 'Your account is inactive. You cannot log in.');
                return false;
            }

             if ($user->user_id == 1) {
                $user_data = array(
                    'user_id' => $user->user_id,
                    'user_name' => $user->user_name,
                    'first_name' => $user->first_name,
                    'phone_number' => $user->phone_numer,
                    // 'user_email' => $user->email,
                    'is_logged_in' => true,
                    'is_superadmin_logged_in' => true,
                );
            } else {
                $user_data = array(
                    'user_id' => $user->user_id,
                    'user_name' => $user->user_name,
                    'first_name' => $user->first_name,
                    'phone_number' => $user->phone_numer,
                    // 'user_email' => $user->email,
                    'is_logged_in' => true,
                );
            }

            // if ($data['remember_me']) {
            //     set_cookie("user_name", $data['user_name'], $this->exp_time);
            //     set_cookie("password", $data['password'], $this->exp_time);
            //     set_cookie("remember_me", $data['remember_me'], $this->exp_time);
            // } else {
            //     delete_cookie("user_email");
            //     delete_cookie("password");
            //     delete_cookie("remember_me");
            // }

            // $this->Email_model->send_login_notification($user);
            // $this->session->set_flashdata('error', 'Fine');
            $this->session->set_userdata($user_data);
            return true;
        }
        
         else {
            $this->session->set_flashdata('error');
            return false;
        }
    }
}