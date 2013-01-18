<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		$this->load->helper('url') ;
	}
	
	
	public function index($user_id, $msg = 0)
	{
		$this->load->library('encrypt');
		
		$data["msg"] = $msg ;
		$data['user_id'] = url_base64_decode($user_id) ;
		$this->load->view("login/change_password", $data) ;	
 	}

	public function update_password()
	{
		if($_POST)
		{
			$this->form_validation->set_rules('new_password', 'New Password', 'required') ;
			$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]') ;
			
			if ($this->form_validation->run() == FALSE)
			{	$data["user_id"] = mysql_real_escape_string($this->input->post("user_id")) ;
				$data["msg"] = 1 ;
				
				$this->load->view("login/change_password", $data) ;			}
			
			else
			{	 
				 $cond1["user_id"] = mysql_real_escape_string($this->input->post("user_id"));
				 
				 $temp_password = mysql_real_escape_string($this->input->post("new_password")) ;
				 $param1["password"] = md5("secure-password-".$temp_password) ;
				
				 $success = $this->model1->update_rec($param1, $cond1, "user_logins") ;
				
				if($success) $data["error"] = 4 ;
				else $data["msg"] = 3 ;
				
				//$data["session_data"] = $this->get_session_data() ;
				$this->load->view("login/login", $data) ;
				
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