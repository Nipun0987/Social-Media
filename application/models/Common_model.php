<?php
class Common_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function select($table, $condition = [], $selectField = '*', $condition2 = [], $orderby = "")
    {
        $this->db->select($selectField);
        $this->db->from($table);
        if (isset($condition) && !empty($condition)) {
            $this->db->where($condition);
        }
        if (isset($condition2) && !empty($condition2)) {
            $this->db->where($condition2);
        }
        // $this->db->where('disable_top','0');
        //echo $this->db->last_query();exit;
        if (isset($orderby) && !empty($orderby)) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function selectPagination($table, $condition = [], $selectField = '*', $perPage = 0, $start = 0, $orderby = "")
    {
        $this->db->select($selectField);
        $this->db->from($table);
        if (isset($condition) && !empty($condition)) {
            $this->db->where($condition);
        }
        if (isset($orderby) && !empty($orderby)) {
            $this->db->order_by($orderby);
        }
        if (!empty($perPage)) {
            $this->db->limit($perPage, $start);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function insert($table, $data)
    {
        $insdata = $this->db->insert($table, $data);
        if ($insdata) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
    function update($table, $data, $id)
    {
        $uptdata = $this->db->update($table, $data, array('id' => $id));
        if ($uptdata) {
            return "Record Updated Successfully";
        }
    }
    function deleteData($table, $whereCondition)
    {

        $this->db->where($whereCondition);
        return $this->db->delete($table);
    }
    function updateCategory($table, $data)
    {
        $id = $data['cms_id'];
        $uptdata = $this->db->update($table, $data, array('cms_id' => $id));
        if ($uptdata) {
            return "Record Updated Successfully";
        }
    }

    function getallCmsPageByName($name)
    {

        $this->db->select('id');
        $this->db->where('name', $name);
        $this->db->from('page_categories');
        $query = $this->db->get();

        //echo $this->db->last_query();exit;
        $stid = array();
        foreach ($query->result() as $res_id) {
            $stid[] = $res_id->id;
        }
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->where_in('category_id', $stid);
        $resultQuery = $this->db->get();

        return $resultQuery->result();
    }

    function getallCmsPageURLById($id = 0)
    {

        $this->db->select('url');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $this->db->from('page_categories');
        $query = $this->db->get();

        return $query->result();
    }
    function getallTestimonial()
    {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'random');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }
    function getSeoDetail($id)
    {
        $this->db->select('*');
        $this->db->from('seo_table');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_user_emailData($email)
    {
        // Select record
        $this->db->select('*');
        $this->db->where('email', $email);
        $q = $this->db->get('tbl_admin_users');
        $response = $q->result_array();
        // echo  $this->db->last_query(); 
        return $response;
    }
    function Check_email_id($email)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $dataall =  $query->num_rows();
        if ($dataall > 0) {
            return true;
        } else {

            return false;
        }
    }
    function update_employee($table, $data, $id)
    {
        $uptdata = $this->db->update($table, $data, array('employee_id' => $id));
        if ($uptdata) {
            return "Record Updated Successfully";
        }
    }


    // methods done by rkj
    function get_user_by_id_rkj($user_id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_master');
        return $query->result();
    }

    function check_unique_email($email)
    {
        $this->db->select('*');
        $this->db->from('user_master');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $dataall =  $query->num_rows();

        // if ($dataall > 0) {
        // 	return true;
        // } else {

        // 	return false;
        // }

        return $dataall;
    }


    public function do_upload($file, $file_type = null, $upload_path = null, $file_name = null)
    {
        if ($file_type == null) {
            $type = 'gif|jpg|png|pdf|csv';
        } else {
            $type = $file_type;
        }

        if ($upload_path == null) {
            $path = './uploads/ebs_files/';
        } else {
            $path = $upload_path;
        }

        $config['upload_path']          = $path;
        $config['allowed_types']        = $type;
        $config['max_size']             = 1000;
        $config['max_width']            = 100000;
        $config['max_height']           = 100000;
        $config['encrypt_name'] = TRUE;

        if ($file_name == null) {
            $new_name = uniqid() . $file;
        } else {
            $new_name = $file_name;
        }


        $config['file_name'] = $new_name;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errors', $error['error']);
            redirect($this->agent->referrer());
            // echo 'file_error' . $file;
        } else {
            $filedata = array('upload_data' => $this->upload->data());

            return  $path . $filedata['upload_data']['file_name'];

            // var_dump($filedata);

            // return $filedata['upload_data']['file_name'];
        }
    }


    public function do_upload_base_64_image($base_64_string, $upload_path)
    {

        $extension = '.png';

        // if (($extension == 'png') || ($extension == 'jpg') || ($extension == 'jpeg')) {
        //     // return 0;
        // }else{
        //     return 0;
        // }

        $new_name = uniqid() . $extension;

        $fp = fopen($upload_path . $new_name, "w+");

        $result = fwrite($fp, base64_decode($base_64_string));

        if ($result != false) {
            return $upload_path . $new_name;
        } else {
            return '2';
        }
    }


    public function get_table_data($field, $col_name, $table_name, $orderby, $group_by = NULL, $selected_field = Null)
    {
        $this->db->where($col_name, $field);

        $this->db->order_by($orderby);

        if ($group_by !== NULL) {
            $this->db->group_by($group_by);
        }

        if ($selected_field !== NULL) {
            $this->db->select($selected_field);
        } else {
            $this->db->select('*');
        }

        $this->db->order_by($orderby);

        $query = $this->db->get($table_name);

        return $query->result();
    }

    public function get_table_data_by_array($table_name, $where_array, $order_by, $group_by = NULL, $selected_field = Null, $find_num_rows = Null, $limit_no = Null)
    {

        if ($selected_field !== NULL) {
            $this->db->select($selected_field);
        } else {
            $this->db->select('*');
        }

        $this->db->where($where_array);
        $this->db->order_by($order_by);

        if ($group_by !== NULL) {
            $this->db->group_by($group_by);
        }

        if ($find_num_rows == Null) {
            if ($limit_no == Null) {
                $query = $this->db->get($table_name);
                return $query->result();
            } else {
                $this->db->limit($limit_no);
                $query = $this->db->get($table_name);
                return $query->result();
            }
        } elseif ($find_num_rows == true) {
            $query = $this->db->get($table_name)->num_rows();
            return $query;
        }
    }

    public function get_table($table_name, $orderby, $group_by = NULL)
    {
        $this->db->order_by($orderby);

        if ($group_by !== NULL) {
            $this->db->group_by($group_by);
        }

        $this->db->select('*');

        $query = $this->db->get($table_name);

        return $query->result();
    }

    public function get_edit_unique($value, $col_name, $table_name, $id_name, $id_no)
    {
        $this->db->select('*');
        $this->db->where($col_name, $value);
        $query = $this->db->get($table_name);
        $res = $query->result();


        if (!empty($res)) {
            if ($res[0]->$id_name != $id_no) {
                return FALSE;
            } elseif ($res[0]->$id_name == $id_no) {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    public function user_above_entry($userlower, $userhigher)
    {
        $userlower_user_above = get_table_data($userlower, 'user_id', 'user_master', 'user_id')[0];

        if ($userlower_user_above->users_above == null) {
            $data['users_above'] = $userhigher;
            $this->db->where('user_id', $userlower);
            $res = $this->db->update('user_master', $data);
            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            $data['users_above'] = str_replace(":" . $userhigher, "", $userlower_user_above);

            $data['users_above'] = str_replace($userhigher . ":", "", $userlower_user_above);

            $data['users_above'] = str_replace($userhigher, "", $userlower_user_above);

            $data['users_above'] = $userlower_user_above->users_above . ':' . $userhigher;
            $this->db->where('user_id', $userlower);
            $res = $this->db->update('user_master', $data);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function user_under_entry($userlower, $userhigher)
    {
        $userlower_user_above = get_table_data($userhigher, 'user_id', 'user_master', 'user_id')[0];

        if ($userlower_user_above->users_under == null) {
            $data['users_under'] = $userlower;
            $this->db->where('user_id', $userhigher);
            $res = $this->db->update('user_master', $data);
            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            $data['users_under'] = str_replace(":" . $userlower, "", $userlower_user_above);

            $data['users_under'] = str_replace($userlower . ":", "", $userlower_user_above);

            $data['users_under'] = str_replace($userlower, "", $userlower_user_above);

            $data['users_under'] = $userlower_user_above->users_under . ':' . $userlower;

            $this->db->where('user_id', $userhigher);

            $res = $this->db->update('user_master', $data);

            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function update_role_levels($old_level)
    {
        if ($old_level !== NULL) {
            $this->db->where('role_level >=', $old_level);

            $query = $this->db->get('role_master');

            $res = $query->result();

            if (!empty($res)) {

                for ($i = 0; $i < count($res); $i++) {
                    $data['role_level'] = $res[$i]->role_level + 1;

                    $this->db->where('id', $res[$i]->id);

                    $res2 = $this->db->update('role_master', $data);
                }
            }
        }
    }


    public function update_comp_role_levels($old_level)
    {
        if ($old_level !== NULL) {
            $this->db->where('role_level >=', $old_level);

            $query = $this->db->get('comp_role_master');

            $res = $query->result();

            if (!empty($res)) {

                for ($i = 0; $i < count($res); $i++) {
                    $data['role_level'] = $res[$i]->role_level + 1;

                    $this->db->where('id', $res[$i]->id);

                    $res2 = $this->db->update('comp_role_master', $data);
                }
            }
        }
    }


    public function update_tpa_company_role_levels($old_level)
    {
        if ($old_level !== NULL) {
            $this->db->where('role_level >=', $old_level);

            $query = $this->db->get('tpa_company_role_master');

            $res = $query->result();

            if (!empty($res)) {

                for ($i = 0; $i < count($res); $i++) {
                    $data['role_level'] = $res[$i]->role_level + 1;

                    $this->db->where('id', $res[$i]->id);

                    $res2 = $this->db->update('tpa_company_role_master', $data);
                }
            }
        }
    }

    public function update_insurance_company_role_levels($old_level)
    {
        if ($old_level !== NULL) {
            $this->db->where('role_level >=', $old_level);

            $query = $this->db->get('insurance_company_role_master');

            $res = $query->result();

            if (!empty($res)) {

                for ($i = 0; $i < count($res); $i++) {
                    $data['role_level'] = $res[$i]->role_level + 1;

                    $this->db->where('id', $res[$i]->id);

                    $res2 = $this->db->update('insurance_company_role_master', $data);
                }
            }
        }
    }


    public function get_all_rm($level)
    {

        $this->db->select('*');

        $this->db->where('role_level <', $level);

        $query = $this->db->get('role_master');

        $res = $query->result();

        $supervisors = array();

        if (!empty($res)) {

            for ($i = 0; $i < count($res); $i++) {

                @$user = get_table_data($res[$i]->id, 'role_id', 'user_master', 'user_id')[0];

                if ($user !== NULL) {
                    array_push($supervisors, $user);
                }
            }
        }

        return $supervisors;
    }


    public function get_all_comp_rm($level, $comp_id)
    {

        $this->db->select('*');

        $this->db->where('role_level <', $level);

        $query = $this->db->get('comp_role_master');

        $res = $query->result();

        $supervisors = array();

        if (!empty($res)) {

            for ($i = 0; $i < count($res); $i++) {

                $array = array('role_id' => $res[$i]->id, 'company_id' => $comp_id);

                @$user = get_table_data_by_array('company_users', $array, 'id')[0];

                if ($user !== NULL) {
                    array_push($supervisors, $user);
                }
            }
        }

        return $supervisors;
    }



    public function get_all_ins_rm($level)
    {
        $this->db->select('*');

        $this->db->where('role_level <', $level);

        $query = $this->db->get('insurance_company_role_master');

        $res = $query->result();

        $supervisors = array();

        if (!empty($res)) {

            for ($i = 0; $i < count($res); $i++) {

                @$user = get_table_data($res[$i]->id, 'role_id', 'insurance_company_user_master', 'id')[0];

                if ($user !== NULL) {
                    array_push($supervisors, $user);
                }
            }
        }

        return $supervisors;
    }


    function update_data_with_logs($table, $coloumn_identifier, $data)
    {
        $results = get_table_data_by_array($table, $coloumn_identifier, 'id');

        foreach ($results as $result) {

            $log['table_name'] = $table;

            $log['main_id_number'] = $result->id;

            $log['data_before_updation'] = json_encode($result);

            $res = $this->db->insert('logs_master', $log);

            $insert_id = $this->db->insert_id();

            if ($res == true) {

                $this->db->where('id', $result->id);

                $res2 = $this->db->update($table, $data);

                if ($res2 == true) {

                    $new_data = get_table_data($result->id, 'id', $table, 'id')[0];

                    $log_data['data_after_updation'] = json_encode($new_data);

                    $this->db->where('id', $insert_id);

                    $res3 = $this->db->update('logs_master', $log_data);
                }
            }
        }

        return true;
    }



    public function insert_data_in_table($table_name, $data)
    {

        $res = $this->db->insert($table_name, $data);

        $table_id = $this->db->insert_id();

        $array = array('status' => $res, 'id' => $table_id);

        return $array;
    }
}
