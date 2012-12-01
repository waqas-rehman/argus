<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$cond1["id"] = $this->session->userdata("admin_id") ;
		$data["admin_rec"] = $this->model1->get_one($cond1, "customers") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "account/profile" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function update_profile()
	{
		if($_POST)
		{
			$this->form_validation->set_rules('contact_person_name', 'Admin Name', 'required') ;
			$this->form_validation->set_rules('email_address', 'Email Address', 'required|email') ;
			
			if ($this->form_validation->run() == FALSE)
			{
				$cond1["id"] = $this->session->userdata("admin_id") ;
				$data["admin_rec"] = $this->model1->get_one($cond1, "customers") ;
				
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/profile" ;
				$this->load->view("template/body", $data) ;
			}
			
			else
			{
				$cond1["id"] = $this->session->userdata("admin_id") ;
				$param1["contact_person_name"] = mysql_real_escape_string($this->input->post("contact_person_name")) ;
				$param1["email_address"] = mysql_real_escape_string($this->input->post("email_address")) ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$success = $this->model1->update_rec($param1, $cond1, "customers") ;
				
				if($success) $data["msg"] = 2 ;
				else $data["msg"] = 3 ;
				
				$data["admin_rec"] = $this->model1->get_one($cond1, "customers") ;
				
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/profile" ;
				$this->load->view("template/body", $data) ;
			}
		} else
			redirect(base_url("dashboard")) ;
	}
	
	public function change_password($msg = 0)
	{
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "account/change_password" ;
		$this->load->view("template/body", $data) ;
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
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/change_password" ;
				$this->load->view("template/body", $data) ;
			}
			
			else
			{
				$cond1["user_id"] = $this->session->userdata("admin_id") ;
				$temp_password = mysql_real_escape_string($this->input->post("new_password")) ;
				
				$param1["password"] = md5("secure-password-".$temp_password) ;
				$success = $this->model1->update_rec($param1, $cond1, "user_logins") ;
				
				if($success) $data["msg"] = 2 ;
				else $data["msg"] = 3 ;
				
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "account/change_password" ;
				$this->load->view("template/body", $data) ;
			}
		} else
			redirect(base_url("dashboard")) ;
	}
	
	private function get_session_data()
	{
		$session_data = array("sad" => $this->session->userdata('email')) ;
		return $session_data ;
	}
}