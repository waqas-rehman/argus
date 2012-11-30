<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registration extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
	}
	
	
	
	public function index($msg = 0)
	{
		
		if($this->session->userdata("admin_logged_in")) {
		$data["msg"] = $msg ;
			$data['user_id'] = $_GET['id'];
			$this->load->view("account/customer_changepass", $data) ;
			
 	}
 }
	public function update_password()
	{
		if($_POST)
		{
			$this->form_validation->set_rules('new_password', 'New Password', 'required') ;
			$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]') ;
			
			if ($this->form_validation->run() == FALSE)
			{
				$data["msg"] = 1 ;
				//$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/customer_changepass" ;
				$this->load->view("template/body", $data) ;
			}
			
			else
			{
				echo $cond1["user_id"] = mysql_real_escape_string($this->input->post("user_id")) ;
				$temp_password = mysql_real_escape_string($this->input->post("new_password")) ;
				exit;
				$param1["password"] = md5("secure-password-".$temp_password) ;
				$success = $this->model1->update_rec($param1, $cond1, "user_logins") ;
				
				if($success) $data["msg"] = 2 ;
				else $data["msg"] = 3 ;
				
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/customer_changepass" ;
				$this->load->view("template/body", $data) ;
			}
		} else
			redirect(base_url("dashboard")) ;
	}
	
	private function random_string($str_length = 10)
	{
		$this->load->helper('string') ;
		return random_string('alnum', $str_length) ;
	}

}