<?php defined('BASEPATH') or exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// // //general settings
		// // $global_data['general_settings'] = $this->settings_model->get_general_settings();
		// // $this->general_settings = $global_data['general_settings'];
		// // //storage settings
		// // $this->storage_settings = $this->settings_model->get_storage_settings();

		// // $global_data['settings'] = $this->settings_model->get_settings(1);


		// // $global_data['csrf'] = array(
		// // 	'name' => $this->security->get_csrf_token_name(),
		// // 	'hash' => $this->security->get_csrf_hash()
		// // );

		// $this->load->vars($global_data);

		// $this->output->delete_cache();
	}


	public function show_404()
	{
		$this->output->set_status_header('404');
		$this->load->view('error404');
	}
}

// class Super_Admin_Controller extends Core_Controller
// {
// 	function __construct()
// 	{
// 		parent::__construct();
// 		$this->output->delete_cache();
// 	}

// 	public function paginate($url, $total_rows, $per_page)
// 	{
// 		//initialize pagination
// 		$page = $this->security->xss_clean($this->input->get('page'));
// 		$page = clean_number($page);
// 		if (empty($page)) {
// 			$page = 0;
// 		}

// 		if ($page != 0) {
// 			$page = $page - 1;
// 		}

// 		$config['num_links'] = 4;
// 		$config['base_url'] = $url;
// 		$config['total_rows'] = $total_rows;
// 		$config['per_page'] = $per_page;
// 		$config['reuse_query_string'] = true;

// 		$config['enable_query_string'] = true;
// 		$config['use_page_numbers'] = TRUE;
// 		$config['page_query_string'] = TRUE;
// 		$config['query_string_segment'] = 'page';

// 		$this->pagination->initialize($config);

// 		$per_page = clean_number($per_page);

// 		return array('per_page' => $per_page, 'offset' => $page * $per_page, 'current_page' => $page + 1);
// 	}
// }
