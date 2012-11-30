<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		$this->load->helper('url') ;
		if( ! ($this->session->userdata("customer_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$cond1["id"] = $this->session->userdata("customer_id") ;
		$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->session_data("account_information") ;
		$data["view"] = "account/account" ;
		$this->load->view('template/body', $data);
	}
	
	public function update_account_info()
	{
		if($_POST)
		{
			$param1["company_name"] = mysql_real_escape_string($this->input->post("company_name")) ;
			$param1["contact_person_name"] = mysql_real_escape_string($this->input->post("contact_person_name")) ;
			$param1["email_address"] = mysql_real_escape_string($this->input->post("email_address")) ;
			$param1["telephone_number"] = mysql_real_escape_string($this->input->post("telephone_number")) ;
			$param1["address_line_1"] = mysql_real_escape_string($this->input->post("address_line_1")) ;
			$param1["address_line_2"] = mysql_real_escape_string($this->input->post("address_line_2")) ;
			$param1["city"] = mysql_real_escape_string($this->input->post("city")) ;
			$param1["country"] = mysql_real_escape_string($this->input->post("country")) ;
			$param1["post_code"] = mysql_real_escape_string($this->input->post("post_code")) ;
			
			$cond1["id"] = $this->session->userdata("customer_id") ;
			
			$success = $this->model1->update_rec($param1, $cond1, "customers") ;
			
			if($success) redirect(base_url("account/index/1")) ;
			else redirect(base_url("account/index/2")) ;
		} else
			redirect(base_url("account")) ;
	}
	
	public function change_password($msg = 0)
	{
		$data["msg"] = $msg ;
		$data["session_data"] = $this->session_data("change_password") ;
		$data["view"] = "account/change_password" ;
		$this->load->view('template/body', $data);
	}
	
	public function update_password()
	{
		if($_POST)
		{
			$temp_password = mysql_real_escape_string($this->input->post("new_password")) ;
			$param1["password"] = md5("secure-password-".$temp_password) ;
			$cond1["user_id"] = $this->session->userdata("customer_id") ;
			
			$success = $this->model1->update_rec($param1, $cond1, "user_logins") ;
			
			if($success) redirect(base_url("account/change_password/1")) ;
			else redirect(base_url("account/change_password/2")) ;
			
		} else
			redirect(base_url("account")) ;
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array("current_tab" => "account", "sub_current_tab" => $sub_tab) ;
		return $session_data ;
	}
	
	private function update_session_data($user_id)
	{
		$cond1["id"] = $rec->user_id ;
		$customer_rec = $this->model1->get_one($cond1, "customers") ;
		$session_data = array('company_name' => $customer_rec->company_name, 'contact_person_name' => $customer_rec->contact_person_name,'email_address' => $customer_rec->email_address) ;
		
		$this->session->set_userdata($session_data) ;			
	}
}
?>