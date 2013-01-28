<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
	}
	
	public function index($error = 0)
	{
		$this->load->helper('url') ;
		if($this->session->userdata("customer_logged_in"))
			redirect(base_url("dashboard")) ;
		else
		{
			$data["error"] = $error ;
			$this->load->view('login/login', $data) ;
		}
	}
	
	public function login()
	{
		$this->load->helper('url') ;
		if($_POST)
		{
			$username = mysql_real_escape_string($this->input->post("username")) ;
			$password = mysql_real_escape_string($this->input->post("password")) ;
			if($username == "" || $password == "")
			{
				redirect(base_url("home/index/1")) ;
			}
			else
			{
				$cond1["username"] = mysql_real_escape_string($this->input->post("username")) ;
				$cond1["password"] = md5("secure-password-".mysql_real_escape_string($this->input->post("password"))) ;
				$cond1["user_type"] = "customer" ;
				
				$rec = $this->model1->get_one($cond1, "user_logins") ;
				if($rec)
				{
					$cond2["id"] = $rec->user_id ;
					$customer_rec = $this->model1->get_one($cond2, "customers") ;
					$session_data = array(
										'customer_logged_in' => TRUE,
										'customer_id' => $customer_rec->id,
										'company_name' => $customer_rec->company_name,
										'contact_person_name' => $customer_rec->contact_person_name,
										'email_address' => $customer_rec->email_address
										) ;
					$this->session->set_userdata($session_data) ;
					$this->update_login_timestamp($rec->user_id) ;
					
					$this->load->helper('url') ;
					redirect(base_url("dashboard")) ;
				}
				else
				redirect(base_url("home/index/2")) ;	
			}
		} else
			redirect(base_url()) ;
	}
	
	public function update_login_timestamp($customer_id)
	{
		$cond1["id"] = $customer_id ;
		$param["last_login"] = date("Y-m-d H:i:s") ;
		$res = $this->model1->update_rec($param, $cond1, "user_logins") ;
	}
	
	public function logout()
	{
		$this->load->helper('url') ;
		$this->session->unset_userdata('customer_logged_in') ;
		$this->session->unset_userdata('customer_id') ;
		$this->session->unset_userdata('company_name') ;
		
		$this->session->unset_userdata('contact_person_name') ;
		$this->session->unset_userdata('email_address') ;
		//$this->phpbb_bridge->user_logout() ;
 		redirect(base_url()."home/index") ;
	}

	public function forget_username_password($error = 0)
	{
		$this->load->helper('url') ;
		$data["error"] = $error ;
		$this->load->view('login/forget_username_password', $data) ;
	}
	
	public function send_email()
	{
		$this->load->helper('url') ;
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

				if(send_email_message("Argus Distribution", $email_param["customer_email_address"], $email_param["cc_email_address"], $email_param["bcc_email_address"], $email_param["email_subject"], $email_param["email_message"], 0))
					redirect(base_url("home/forget_username_password/3")) ;
				else redirect(base_url("home/forget_username_password/2")) ;
				
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