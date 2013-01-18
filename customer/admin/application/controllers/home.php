<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
	}

	public function index($error = 0)
	{
		if($this->session->userdata("admin_logged_in"))
			redirect(base_url("customer")) ;
	
		else
		{
			$data["error"] = $error ;
			$this->load->view("login/login", $data) ;
		}
	}
	
	public function login()
	{
		if($_POST)
		{
			$cond1["username"] = mysql_real_escape_string($this->input->post("username")) ;
			$cond1["password"] = md5("secure-password-".mysql_real_escape_string($this->input->post("password"))) ;
			$cond1["user_type"] = "admin" ;
			
			$rec = $this->model1->get_one($cond1, "user_logins") ;
			
			if($rec) {
				
				$cond2["id"] = $rec->user_id ;
				$admin_rec = $this->model1->get_one($cond2, "customers") ;
				
				$this->update_record($rec->id) ;
				$session_data = array("admin_logged_in" => TRUE, "admin_id" => $admin_rec->id , 'name' => $admin_rec->contact_person_name, 'email' => $admin_rec->email_address) ;
				
				$this->session->set_userdata($session_data) ;
				redirect(base_url("dashboard")) ;
				
			} else
				redirect(base_url("home/index/1")) ;
		}
		else
			redirect(base_url()."home/index") ;
	}
	
	private function update_record($user_id)
	{
		$cond1["id"] = $user_id ;
		$param1["last_login"] = date("Y-m-d G:i:s") ;
		
		$res = $this->model1->update_rec($param1,$cond1,"user_logins") ;
	}
	
	public function logout()
	{
		$this->session->unset_userdata('admin_logged_in') ;
		$this->session->unset_userdata('username') ;
		$this->session->unset_userdata('email') ;
		
		redirect(base_url()."home/index") ;
	}
	
	public function forget_username_password($error = 0)
	{	
		$data["error"] = $error ;
		$this->load->view('login/forget_username_password', $data) ;
	}
	
	public function send_email()
	{
		if($_POST)
		{
			$cond1["email_address"] = mysql_real_escape_string($this->input->post("email_address")) ;
			$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
			
			if($data["customer_rec"])
			{
				$cond2["user_id"] = $data["customer_rec"]->id ;
				$data["user_rec"] = $this->model1->get_one($cond2, "user_logins") ;
				
				$data["passwordx"] = $this->random_string(10) ;
				
				$param1["password"] = md5("secure-password-".$data["passwordx"]) ; 
				$this->model1->update_rec($param1, $cond2, "user_logins") ;
				
				$email_param["customer_email_address"] = $data["customer_rec"]->email_address ;
				$email_param["cc_email_address"] = 0 ;
				$email_param["bcc_email_address"] = 0 ;
				$email_param["email_subject"] = "Username/Password Retrieval" ;
				$email_param["email_message"] = $this->load->view("email_templates/forget_username_password", $data, TRUE) ;

				if(send_email_message("Argus Distribution", $email_param["customer_email_address"], $email_param["cc_email_address"], $email_param["bcc_email_address"], $email_param["email_subject"], $email_param["email_message"]))
					redirect(base_url("home/forget_username_password/2")) ;
				else redirect(base_url("home/forget_username_password/3")) ;
				
			} else  redirect(base_url("home/forget_username_password/1")) ;
		
		} else
			redirect(base_url("home")) ;
	}
	
	private function random_string($str_length = 10)
	{
		$this->load->helper('string') ;
		return random_string('alnum', $str_length) ;
	}

}