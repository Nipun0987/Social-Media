<?php
class Superadmin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        // $this->load->model('common_model');
        $this->load->model('superadmin_model');
        // $this->load->model('insurance_model');
        $this->load->helper(array('form', 'url'));
        
        // if (!auth_check()) {
        //     redirect('superadmin/login');
        // }
    }

    //input values
    public function input_values()
    {
        $data = array(
            'user_id' => $this->input->post('user_id', true),
            'first_name' => $this->input->post('first_name', true),
            'user_name' => ($this->input->post('user_name', true)),
            'password' => $this->input->post('password', true),
            'phone_number' => $this->input->post('phone_number', true),
            'user_email' => $this->input->post('user_email', true),
            'full_name' => $this->input->post('full_name', true),
            'last_name' => $this->input->post('last_name', true),
        );
        return $data;
    }


    public function input_values_f_users()
    {
        $data = array(
            'user_id' => $this->input->post('user_id', true),
            'phone_number' => $this->input->post('phone_number', true),
            'first_name' => $this->input->post('first_name', true),
            'user_name' => $this->input->post('user_name', true),
            'password' => $this->input->post('password', true),
            // 'slug_url' => strtolower(str_replace(" ", "", remove_special_characters($this->input->post('slug_url', true)))),
        );
        return $data;
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// USERS FUNCTIONS START HERE /////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    // get users
    public function get_all_users()
    {
        $this->db->order_by('user_id');
        $query = $this->db->get('user');
        return $query->result();
    }

    // add user
    public function insert_user($data)
    {


        $res = $this->db->insert('user', $data);
        redirect('superadmin_controller/save');
    }


    // public function login_post_model($user_name, $password)
    // {
    //     $query = $this->db->query("select id from full_name where user_name= '$user_name' and password = '$password'");
    // }

    // function login($email, $password)
    // {
    //     $this->db->where("email", $email);
    //     $this->db->where("password", $password);
    //     $query = $this->db->get("user");
    //     return $query->result_array();
    // }

    public function home_model()
    {
        $this->db->select('*');
        $h = $this->db->get('user');
        return $h;
    }
}
