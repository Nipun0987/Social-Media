<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getAllCMSListByCategoryByName()
{
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('Common_model');

    // Call a function of the model

    //$condition = array('is_active'=>1);
    //$result = $CI->Common_model->getallCmsPageByName($name);
    $result = $CI->Common_model->select('pages');

    return $result;
}

function getAllCMSCategoryList()
{
    $CI = get_instance();
    $CI->load->model('Common_model');

    $condition = array('category_id' => 0);
    $condition2 = array('disable_top' => 1);
    $orderby = "priority ASC";
    $result = $CI->Common_model->select('pages', $condition, '*', $condition2, $orderby);
    return $result;
}
function getAllCMSSubCategoryListByCategoryId($category_id)
{
    $CI = get_instance();
    $CI->load->model('Common_model');

    $condition = array('category_id' => $category_id);
    $result = $CI->Common_model->select('pages', $condition);

    return $result;
}

function getCategoryNameByID($id)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('id' => $id);
    $result = $CI->Common_model->select('page_categories', $condition, 'name');
    if (count($result > 0)) {
        $result = $result[0]->name;
    }
    return $result;
}
function getCategoryPageURLByID($id)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('id' => $id);
    $result = $CI->Common_model->select('page_categories', $condition, 'url');
    if (count($result > 0)) {
        $result = $result[0]->url;
    }
    return $result;
}
function getSubCategoryNameByID($id = 0)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('id' => $id, 'is_active' => 1);
    $result = $CI->Common_model->select('page_sub_categories', $condition, 'name');
    if (count($result > 0)) {
        $result = $result[0]->name;
        return $result;
    }
}
/* 1 - Services , 2 - Home Help*/
function getAllCategoryListByType($type = 0)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('type' => $type, 'is_active' => 1);
    $result = $CI->Common_model->select('page_categories', $condition, 'id,name,type');

    return $result;
}

function getAllWidgetsByThemeId($id = 0)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('select_theme' => $id);
    $result = $CI->Common_model->select('widgets', $condition);

    return $result;
}

function getAllWidgets()
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    //$condition = array('select_theme'=>$id);
    $result = $CI->Common_model->select('widgets');

    return $result;
}

function getcountryList()
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('is_active' => 1);
    $result = $CI->Common_model->select('countries', $condition);

    return $result;
}
function getStaticCMSById($id = 0)
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $condition = array('id' => $id);
    $result = $CI->Common_model->select('static_cms_page', $condition);

    return $result[0];
}
function getCountries()
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $result = $CI->Common_model->select('countries');
    return $result;
}
function getGeneralSetting()
{
    $CI = get_instance();
    $CI->load->model('Common_model');
    $result = $CI->Common_model->select('genral_setting');
    return $result;
}




//generate token
if (!function_exists('generate_token')) {
    function generate_token()
    {
        $token = uniqid("", TRUE);
        $token = str_replace(".", "-", $token);
        return $token . "-" . rand(10000000, 99999999);
    }
}

//check auth
if (!function_exists('auth_check')) {
    function auth_check()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_in();
    }
}






//check auth
if (!function_exists('superadmin_check')) {
    function superadmin_check()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_superadmin();
    }
}

//get logged user
if (!function_exists('user')) {
    function user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $user = $ci->auth_model->get_logged_user();
        if (empty($user)) {
            $ci->auth_model->logout();
        } else {
            return $user;
        }
    }
}

//check is user vendor
if (!function_exists('user_type')) {
    function user_type()
    {
        $ci = &get_instance();
        $user = $ci->auth_model->get_logged_user();
        if (!empty($user)) {
            return $ci->auth_user->user_type;
        } else {
            $ci->auth_model->logout();
        }
    }
}



//get user by id
if (!function_exists('get_user')) {
    function get_user($user_id)
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->get_user($user_id);
    }
}

//generate unique id
if (!function_exists('generate_unique_id')) {
    function generate_unique_id()
    {
        $id = uniqid("", TRUE);
        $id = str_replace(".", "-", $id);
        return $id . "-" . rand(10000000, 99999999);
    }
}


//delete file from server
if (!function_exists('delete_file_from_server')) {
    function delete_file_from_server($path)
    {
        $full_path = FCPATH . $path;
        if (strlen($path) > 15 && file_exists($full_path)) {
            @unlink($full_path);
        }
    }
}

//delete file from server
if (!function_exists('aws_uploads_url')) {
    function aws_uploads_url()
    {
        $aws_uploads_url = 'https://bima-birbal-uploads.s3.ap-south-1.amazonaws.com/';
        return $aws_uploads_url;
    }
}


//delete file from server
if (!function_exists('get_unformatted_text')) {
    function get_unformatted_text($val)
    {
        $new_val = str_replace('_', ' ', $val);
        $new_val = str_replace('-', ' ', $new_val);
        return ucwords($new_val);
    }
}


//get logged user
if (!function_exists('company')) {
    function company()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $company = $ci->auth_model->get_logged_company();
        if (empty($company)) {
            $ci->auth_model->logout();
        } else {
            return $company;
        }
    }
}

//get user by id
if (!function_exists('get_company')) {
    function get_company($company_id)
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->get_company($company_id);
    }
}

//clean number
if (!function_exists('clean_number')) {
    function clean_number($num)
    {
        $ci = &get_instance();
        $num = $ci->security->xss_clean($num);
        $num = intval($num);
        $num = mysqli_real_escape_string($ci->db->conn_id, $num);
        return $num;
    }
}


//remove special characters
if (!function_exists('remove_special_characters')) {
    function remove_special_characters($str)
    {
        $ci = &get_instance();
        $str = str_replace('#', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace("'", '', $str);
        $str = str_replace('(', '', $str);
        $str = str_replace(')', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('+', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('`', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('~', '', $str);
        $str = mysqli_real_escape_string($ci->db->conn_id, $str);
        return $str;
    }

    //get area by area id
    if (!function_exists('get_area_by_area_id')) {
        function get_area_by_area_id($area_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->location_model->get_area_by_area_id($area_id);
        }
    }

    //get city by city id
    if (!function_exists('get_city_by_city_id')) {
        function get_city_by_city_id($city_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->location_model->get_city_by_city_id($city_id);
        }
    }

    //get state by state id
    if (!function_exists('get_state_by_state_id')) {
        function get_state_by_state_id($state_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->location_model->get_state_by_state_id($state_id);
        }
    }

    //get zone by zone id
    if (!function_exists('get_zone_by_zone_id')) {
        function get_zone_by_zone_id($zone_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->location_model->get_zone_by_zone_id($zone_id);
        }
    }


    //get categories json
    if (!function_exists('get_repositories_json')) {
        function get_repositories_json()
        {
            $ci = &get_instance();
            return $ci->repository_model->get_repositories_json();
        }
    }




    //get logged user
    if (!function_exists('insurer')) {
        function insurer()
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            $insurer = $ci->auth_model->get_logged_insurer();
            if (empty($insurer)) {
                $ci->auth_model->logout();
            } else {
                return $insurer;
            }
        }
    }



    //get logged user
    if (!function_exists('encrypt_url')) {
        function encryptUrl($val)
        {
            $newval = $val . '*bimabuy9004124260';
            $encVal = urlencode(base64_encode($newval));
            return $encVal;
        }
    }


    //get logged user
    if (!function_exists('decrypt_url')) {
        function decryptUrl($val)
        {
            $val2 = urldecode(base64_decode($val));
            $pos = strpos($val2, '*');
            $val3 = substr($val2, 0, $pos);
            return $val3;
        }
    }


    if (!function_exists('repopulate_ajax_dropdown')) {
        function repopulate_ajax_dropdown($val)
        {
            if (isset($_POST['state_id'])) {
                $stateid = $_POST['state_id'];
                $state = get_state_by_state_id($stateid);

                echo '<option value="' . $city->city_id . '" selected="" >' . $city->city_name . '</option>';
            }
        }
    }


    //get zone by zone id
    if (!function_exists('get_department_by_department_id')) {
        function get_department_by_department_id($department_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->department_model->get_department_by_department_id($department_id);
        }
    }

    //get zone by zone id
    if (!function_exists('get_designation_by_designation_id')) {
        function get_designation_by_designation_id($designation_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->designation_model->get_designation_by_designation_id($designation_id);
        }
    }


    //get zone by zone id
    if (!function_exists('get_employee_by_employee_id')) {
        function get_employee_by_employee_id($employee_id)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->employee_model->get_employee_by_employee_id($employee_id);
        }
    }


    //get zone by zone id
    if (!function_exists('update_posp_status')) {
        function update_posp_status($user_id, $posp_check_id, $status)
        {
            // Get a reference to the controller object
            $ci = &get_instance();
            return $ci->posp_model->update_posp_status($user_id, $posp_check_id, $status);
        }
    }
}



if (!function_exists('get_logo_email')) {
    function get_logo_email($settings)
    {
        return base_url() . $settings->logo_email;
    }
}


//get translated message
if (!function_exists('trans')) {
    function trans($string)
    {
        $ci = &get_instance();
        return $ci->lang->line($string);
    }
}


// Helper function by rkj

if (!function_exists('get_table_data')) {
    function get_table_data($field, $col_name, $table_name, $orderby, $group_by = NULL, $selected_field = Null)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_table_data($field, $col_name, $table_name, $orderby, $group_by, $selected_field);

        return $result;
    }
}


if (!function_exists('get_table')) {
    function get_table($table_name, $orderby, $group_by = NULL, $selected_field = Null)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_table($table_name, $orderby, $group_by, $selected_field);

        return $result;
    }
}


if (!function_exists('get_table_data_by_array')) {
    function get_table_data_by_array($table_name, $where_array, $order_by, $group_by = NULL, $selected_field = Null, $find_num_rows = Null, $limit_no = Null)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_table_data_by_array($table_name, $where_array, $order_by, $group_by, $selected_field, $find_num_rows, $limit_no);

        return $result;
    }
}



if (!function_exists('get_current_user_by_rkj')) {
    function get_current_user_by_rkj()
    {
        $ci = &get_instance();

        $id = $ci->session->userdata('user_id');

        $ci->load->model('common_model');

        $result = $ci->common_model->get_user_by_id_rkj($id);

        return $result;
    }
}


if (!function_exists('get_user_by_id_rkj')) {
    function get_user_by_id_rkj($user_id)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_user_by_id_rkj($user_id);

        var_dump($result);
    }
}


//print old form data
if (!function_exists('old')) {
    function old($field)
    {
        $ci = &get_instance();
        if (isset($ci->session->flashdata('form_data')[$field])) {
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }
}


if (!function_exists('newold')) {
    function newold()
    {
        return 'klns';
    }
}


if (!function_exists('check_company_user')) {
    function check_company_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_cmp_user();
    }
}


if (!function_exists('check_tpa_company_user')) {
    function check_tpa_company_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_tpa_cmp_user();
    }
}

if (!function_exists('comp_slug')) {
    function comp_slug()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->session->comp_data('comp_slug');
    }
}

if (!function_exists('trim_company_user_username')) {
    function trim_company_user_username($username)
    {
        return substr($username, 0, strpos($username, "_"));
    }
}

// Helper function by rkj
if (!function_exists('get_comp_by_id')) {
    function get_comp_by_id()
    {
        $ci = &get_instance();

        $id = $ci->session->userdata('comp_id');

        $ci->load->model('common_model');

        $result = $ci->auth_model->get_comp($id);

        return $result;
    }
}

// Helper function by rkj
if (!function_exists('get_comp_users')) {
    function get_comp_users($id)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_comp($id);

        return $result;
    }
}


if (!function_exists('check_company_employee_user')) {
    function check_company_employee_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_emp_user();
    }
}



if (!function_exists('check_superadmin_user')) {
    function check_superadmin_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_superadmin();
    }
}


if (!function_exists('og_url')) {
    function og_url()
    {
        return base_url();
    }
}

if (!function_exists('ebs_url')) {
    function ebs_url()
    {
        return base_url() . 'superadmin/';
    }
}


if (!function_exists('comp_url')) {
    function comp_url()
    {
        $ci = &get_instance();

        return base_url() . $ci->session->userdata('comp_slug') . '/';
    }
}


if (!function_exists('tpa_comp_url')) {
    function tpa_comp_url()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return base_url() . $ci->session->userdata('tpa_comp_slug') . '/';
    }
}



if (!function_exists('ins_comp_url')) {
    function ins_comp_url()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return base_url() . $ci->session->userdata('insurance_comp_slug') . '/';
    }
}




//post method
if (!function_exists('post_method')) {
    function post_method()
    {
        $ci = &get_instance();

        if ($ci->input->method(FALSE) != 'post') {
            $ci->output->set_status_header('404');
            $ci->load->view('error404');
            // exit();
        }
    }
}

//get method
if (!function_exists('get_method')) {
    function get_method()
    {
        $ci = &get_instance();
        if ($ci->input->method(FALSE) != 'get') {
            exit();
            $ci->output->set_status_header('404');
            $ci->load->view('error404');
        }
    }
}


//get method
if (!function_exists('deleteData')) {
    function deleteData($table, $whereCondition)
    {
        $ci = &get_instance();
        return $ci->Common_model->deleteData($table, $whereCondition);
    }
}

if (!function_exists(('get_edit_unique'))) {
    function get_edit_unique($value, $col_name, $table_name, $id_name, $id_no)
    {
        $ci = &get_instance();
        return $ci->Common_model->get_edit_unique($value, $col_name, $table_name, $id_name, $id_no);
    }
}

if (!function_exists(('get_all_user_rkj'))) {
    function get_all_user_rkj()
    {
        $ci = &get_instance();
        return $ci->superadmin_model->get_all_user_rkj();
    }
}

if (!function_exists(('get_all_user_rkj_except_current'))) {
    function get_all_user_rkj_except_current($id)
    {
        $ci = &get_instance();
        return $ci->superadmin_model->get_all_user_rkj_except_current($id);
    }
}

if (!function_exists(('user_above_entry'))) {
    function user_above_entry($userlower, $userhigher)
    {
        if ($userhigher == $userlower) {
            return false;
        } else {
            $ci = &get_instance();
            return $ci->Common_model->user_above_entry($userlower, $userhigher);
        }
    }
}

if (!function_exists(('user_under_entry'))) {
    function user_under_entry($userlower, $userhigher)
    {
        if ($userhigher == $userlower) {
            return false;
        } else {
            $ci = &get_instance();
            return $ci->Common_model->user_under_entry($userlower, $userhigher);
        }
    }
}



if (!function_exists('update_role_levels')) {
    function update_role_levels($old_level)
    {
        $ci = &get_instance();
        return $ci->Common_model->update_role_levels($old_level);
    }
}



if (!function_exists('update_comp_role_levels')) {
    function update_comp_role_levels($old_level)
    {
        $ci = &get_instance();
        return $ci->Common_model->update_comp_role_levels($old_level);
    }
}



if (!function_exists('update_tpa_company_role_levels')) {
    function update_tpa_company_role_levels($old_level)
    {
        $ci = &get_instance();
        return $ci->Common_model->update_tpa_company_role_levels($old_level);
    }
}

if (!function_exists('update_insurance_company_role_levels')) {
    function update_insurance_company_role_levels($old_level)
    {
        $ci = &get_instance();
        return $ci->Common_model->update_insurance_company_role_levels($old_level);
    }
}



if (!function_exists('get_all_rm')) {
    function get_all_rm($level)
    {
        $ci = &get_instance();
        return $ci->Common_model->get_all_rm($level);
    }
}


if (!function_exists('get_all_comp_rm')) {
    function get_all_comp_rm($level, $comp_id)
    {
        $ci = &get_instance();
        return $ci->Common_model->get_all_comp_rm($level, $comp_id);
    }
}

if (!function_exists('get_all_ins_rm')) {
    function get_all_ins_rm($level)
    {
        $ci = &get_instance();
        return $ci->Common_model->get_all_ins_rm($level);
    }
}

if (!function_exists('encode_url')) {
    function encode_url($url)
    {
        $key = "sdfdfs789fs7d";
        $encoded = @base64_encode(openssl_encrypt($url, 'AES-128-CBC', md5($key)));
        return urlencode($encoded);
    }
}

if (!function_exists('decode_url')) {
    function decode_url($url)
    {
        $url = urldecode($url);
        $key = "sdfdfs789fs7d";
        $decoded = openssl_decrypt(base64_decode($url), 'AES-128-CBC', md5($key));
        return $decoded;
    }
}

if (!function_exists('randomPassword')) {
    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}


if (!function_exists('create_master_key')) {
    function create_master_key()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}



if (!function_exists('encrypt_password')) {
    function encrypt_password($password)
    {
        $salt = 'password';
        return urlencode(base64_encode($salt . $password));
    }
}

if (!function_exists('decrypt_password')) {
    function decrypt_password($password)
    {
        $salt = 'password';
        return str_replace($salt, '', base64_decode(urldecode($password)));
    }
}


if (!function_exists('check_tpa_company_user')) {
    function check_tpa_company_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_cmp_user();
    }
}


////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////    TPA ENCODED URLS /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists('tpa_login')) {
    function tpa_login()
    {
        return '/' . urlencode(base64_encode('tpa_login'));
    }
}

if (!function_exists('tpa_dashboard')) {
    function tpa_dashboard()
    {
        return '/' . urlencode(base64_encode('tpa_dashboard'));
    }
}

if (!function_exists('get_tpa_comp_users')) {
    function get_tpa_comp_users($id)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->get_tpa_comp($id);

        return $result;
    }
}





////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////    INSURANCE COMPANY METHODS  ///////////////////////////
////////////////////////////////////////////////////////////////////////////////////////


if (!function_exists('check_insurance_company_user')) {
    function check_insurance_company_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->auth_model->is_logged_insurance_cmp_user();
    }
}



if (!function_exists('insurance_comp_url')) {
    function insurance_comp_url()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        return base_url() . $ci->session->userdata('insurance_comp_slug') . '/';
    }
}


if (!function_exists('log_master')) {
    function log_master($old_data, $data, $table)
    {
        $log['table_name'] = $table;
        $log['data_before_updation'] = json_encode($old_data);
        $log['data_after_updation'] = json_encode($data);
        $update = json_decode($log['data_after_updation']);
        $log['updated_by'] = $update->updated_by;

        // Get a reference to the controller object
        $ci = &get_instance();
        return $ci->logs_model->insert_logs($log);
    }
}


if (!function_exists('show_404')) {
    function show_404()
    {
        $ci = &get_instance();
        $ci->output->set_status_header('404');
        $ci->load->view('error404');
    }
}



if (!function_exists('findObjectById')) {
    function findObjectById($old_array, $key, $value)
    {
        $array = $old_array;

        foreach ($array as $element) {
            if ($value == $element->$key) {
                return $element;
            }
        }

        return false;
    }
}


if (!function_exists('set_rupee')) {
    function set_rupee($ruppe)
    {
        $fmt = new NumberFormatter('en_hi', NumberFormatter::CURRENCY);

        $val = $fmt->formatCurrency($ruppe, "IND");

        return 'Rs.' . str_replace("IND", "", $val);
    }
}


if (!function_exists('update_data_with_logs')) {
    function update_data_with_logs($table, $coloumn_identifier, $data)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->update_data_with_logs($table, $coloumn_identifier, $data);

        return $result;
    }
}


if (!function_exists('insert_data_in_table')) {
    function insert_data_in_table($table_name, $data)
    {
        $ci = &get_instance();

        $ci->load->model('common_model');

        $result = $ci->common_model->insert_data_in_table($table_name, $data);

        return $result;
    }
}

////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////    INSURANCE COMPANY METHODS  ///////////////////////////
////////////////////////////////////////////////////////////////////////////////////////