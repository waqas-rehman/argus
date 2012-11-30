<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$attribute1 = array("id","company_name","contact_person_name","telephone_number") ;
		$attribute2 = array("username","last_login") ;
		
		$cond2["user_type"] = "customer" ;
 		
		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, $cond2, "id", "user_id", "customers", "user_logins",  "customers.creation_date", "DESC") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "customer/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function product_prices_form($customer_id = 0, $msg = 0)
	{
		if($customer_id)
		{
			$cond1["id"] = $customer_id ;
			$param1["special_prices"] = "Yes" ;
			$this->model1->update_rec($param1, $cond1, "customers") ;
			
			$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
			
			$data["current_products"] = $this->model2->get_current_products($customer_id) ;
			$data["other_products"] = $this->model2->get_other_products($customer_id) ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "customer/customer_product_form" ;
			$this->load->view("template/body", $data) ;
		}
		else
			redirect(base_url("customer")) ;
	}
	
	public function customer_form()
	{
		$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
		$data["msg"] = 0 ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "customer/add_customer" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function add_customer()
	{
		
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("company_name", "Company Name", "required") ;
			$this->form_validation->set_rules("contact_person_name", "First Name", "required") ;
			$this->form_validation->set_rules("email_address", "Email Address", "required|valid_email") ;
			$this->form_validation->set_rules("telephone_number", "Telephone Number", "required|max_length[20]|min_length[10]|numeric") ;
			
			$this->form_validation->set_rules("address_line_1", "Address Line 1", "required") ;
			$this->form_validation->set_rules("address_line_2", "Address Line 2", "required") ;
			$this->form_validation->set_rules("city", "City", "required") ;
			$this->form_validation->set_rules("country", "Country", "required") ;
			
			$this->form_validation->set_rules('post_code', 'Post Code', 'required') ;
			$this->form_validation->set_rules('status', 'Status', 'required') ;
			$this->form_validation->set_rules('username', 'Usernmae', 'required|is_unique[user_logins.username]') ;
			//$this->form_validation->set_rules('password', 'Password', 'required') ;
			$this->form_validation->set_rules('vat_code', 'VAT Code', 'required') ;
			$this->form_validation->set_rules('special_prices', 'Special Prices', 'required') ;
			
			$this->form_validation->set_rules('maximum_limit', 'Maximum Limit', 'required|decimal') ;
			$this->form_validation->set_rules('transport_charges', 'Transport Charges', 'required|decimal') ;
			$this->form_validation->set_rules('overdue_days', 'Overdue Days', 'required|integer') ;
			
			if ($this->form_validation->run() == FALSE)
			{
				$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "customer/add_customer" ;
				$this->load->view("template/body", $data) ;
			}
			
			else
			{
				$password = generatePassword($length = 8); 
				$param1["company_name"] = mysql_real_escape_string($this->input->post("company_name")) ;
				$param1["contact_person_name"] = mysql_real_escape_string($this->input->post("contact_person_name")) ;
				$param1["email_address"] = mysql_real_escape_string($this->input->post("email_address")) ;
				$param1["telephone_number"] = mysql_real_escape_string($this->input->post("telephone_number")) ;
				
				$param1["address_line_1"] = mysql_real_escape_string($this->input->post("address_line_1")) ;
				$param1["address_line_2"] = mysql_real_escape_string($this->input->post("address_line_2")) ;
				$param1["city"] = mysql_real_escape_string($this->input->post("city")) ;
				$param1["country"] = mysql_real_escape_string($this->input->post("country")) ;
				
				$param1["post_code"] = mysql_real_escape_string($this->input->post("post_code")) ;
				$param1["special_prices"] = mysql_real_escape_string($this->input->post("special_prices")) ;
				$param1["vat_code"] = mysql_real_escape_string($this->input->post("vat_code")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
				
				$param1["maximum_limit"] = mysql_real_escape_string($this->input->post("maximum_limit")) ;
				$param1["transport_charges"] = mysql_real_escape_string($this->input->post("transport_charges")) ;
				$param1["overdue_days"] = mysql_real_escape_string($this->input->post("overdue_days")) ;
				
				$rec_id = $this->model1->insert_rec($param1, "customers") ;
				
				$param2["user_id"] = $rec_id ;
				$param2["username"] = mysql_real_escape_string($this->input->post("username")) ;
				//$param2["password"] =  md5("secure-password-".mysql_real_escape_string($this->input->post("password"))) ;
				$param2["password"] =  md5("secure-password-".mysql_real_escape_string($password)) ;
				
				$param2["user_type"] =  "customer" ;
				$login_rec_id = $this->model1->insert_rec($param2, "user_logins") ;
				$this->load->library('encrypt');
				if(($rec_id) && ($login_rec_id)) {
										//$this->load->helper('MY_Encrypt');
					$email_data["user_id"] = url_base64_encode($rec_id);
					
					$email_data["client_name"] = $param1["company_name"] ;
					$email_data["contact_person_name"] = $param1["contact_person_name"] ;
					$email_data["username"] = $param2["username"] ;
					//$email_data["password"] = mysql_real_escape_string($this->input->post("password")) ;
					$email_message = $this->load->view("email_templates/customer_registration", $email_data, TRUE) ;
					
					send_email_message("Argus Distribution", $param1["email_address"], 0, 0, "Argus Distribution Registration", $email_message,0) ;
					if($param1["special_prices"] == "Yes") {
						redirect(base_url("customer/customer_products/".$rec_id."/2")) ;
					} else {
						//$email_data["view"] = "email_templates/customer_registration.php" ;
						//$this->load->view("template/body", $email_data) ;
						redirect(base_url("customer/customer_details/".$rec_id."/3")) ;
					}
				} else {
					
					$data["msg"] = 2 ;
					$data["session_data"] = $this->get_session_data() ;
					$data["view"] = "customer/add_customer" ;
					$this->load->view("template/body", $data) ;
				
				}
			}
		}
		
		else
			redirect(base_url("customer")) ;
	}
	
	public function customer_products($customer_id = 0 , $msg = 0) 
	{
		if($customer_id)
		{
			$cond1["id"] = $customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
			
			$attribute1 = array("id", "group_id", "product_name", "product_code", "adl_code", "product_price", "product_manual", "creation_date", "update_date", "status") ;
		$attribute2 = array("group_name") ;
		
			$data["products"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "group_id", "id", "products", "product_groups", "products.creation_date", "DESC") ;
			
			
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "customer/customer_products" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect("customer") ;
	}
	
	public function add_customer_products()
	{
		if($_POST)
		{
			$param1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
			$product_ids = $this->input->post("product_ids") ;
			$res1 = 0 ;
			if($product_ids)
			{
				foreach($product_ids as $rec):
					$product_price_id = "product_price_".$rec ;
					$param1["product_id"] = $rec ;
					$param1["product_price"] = mysql_real_escape_string($this->input->post($product_price_id)) ;
					$res1 = $this->model1->insert_rec($param1,"customer_products") ;
					if($res1) { }
					else break ;
				endforeach ;
			}
			if($res1)
				redirect(base_url("customer/customer_details/".$param1["customer_id"]."/5")) ;
			else
				redirect(base_url("customer/customer_details/".$param1["customer_id"])) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function add_update_customer_products()
	{
		if($_POST)
		{
			$condx["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
			$this->model1->delete_rec($condx, "customer_products") ;
			
			$param1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
			$product_ids = $this->input->post("product_ids") ;
			
			if($product_ids)
			{
				foreach($product_ids as $rec):
					$product_price_id = "product_price_".$rec ;
					$param1["product_id"] = $rec ;
					$param1["product_price"] = mysql_real_escape_string($this->input->post($product_price_id)) ;
					$res1 = $this->model1->insert_rec($param1,"customer_products") ;
					if($res1) { }
					else break ;
				endforeach ;
			}
			if($res1)
				redirect(base_url("customer/index/3")) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function customer_details($customer_id = 0, $msg = 0)
	{
		if($customer_id)
		{
			$cond1["id"] = $customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
			
			$cond2["user_id"] = $customer_id ;
			$data["customer_login_rec"] = $this->model1->get_one($cond2, "user_logins") ;
			$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "customer/edit_customer" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function upadte_customer()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("company_name", "Company Name", "required") ;
			$this->form_validation->set_rules("contact_person_name", "First Name", "required") ;
			$this->form_validation->set_rules("email_address", "Email Address", "required|valid_email") ;
			$this->form_validation->set_rules("telephone_number", "Telephone Number", "required|max_length[20]|min_length[10]|numeric") ;
			
			$this->form_validation->set_rules("address_line_1", "Address Line 1", "required") ;
			$this->form_validation->set_rules("address_line_2", "Address Line 2", "required") ;
			$this->form_validation->set_rules("city", "City", "required") ;
			$this->form_validation->set_rules("country", "Country", "required") ;
			
			$this->form_validation->set_rules('post_code', 'Post Code', 'required') ;
			$this->form_validation->set_rules('status', 'Status', 'required') ;
			
			$this->form_validation->set_rules('maximum_limit', 'Maximum Limit', 'required|decimal') ;
			$this->form_validation->set_rules('transport_charges', 'Transport Charges', 'required|decimal') ;
			$this->form_validation->set_rules('overdue_days', 'Overdue Days', 'required|integer') ;
			
			$condx["user_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
			$temp_customer_rec = $this->model1->get_one($condx, "user_logins") ;
			
			if($temp_customer_rec->username != mysql_real_escape_string($this->input->post("username")))
				$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user_logins.username]') ;
			
			$this->form_validation->set_rules('vat_code', 'VAT Code', 'required') ;
	
			if ($this->form_validation->run() == FALSE) {
				
				$customer_id = mysql_real_escape_string($this->input->post("customer_id")) ;
				
				$cond1["id"] = $customer_id ;
				$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
				
				$cond2["user_id"] = $customer_id ;
				$data["customer_login_rec"] = $this->model1->get_one($cond2, "user_logins") ;
				$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "customer/edit_customer" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["company_name"] = mysql_real_escape_string($this->input->post("company_name")) ;
				$param1["contact_person_name"] = mysql_real_escape_string($this->input->post("contact_person_name")) ;
				$param1["email_address"] = mysql_real_escape_string($this->input->post("email_address")) ;
				$param1["telephone_number"] = mysql_real_escape_string($this->input->post("telephone_number")) ;
				
				$param1["address_line_1"] = mysql_real_escape_string($this->input->post("address_line_1")) ;
				$param1["address_line_2"] = mysql_real_escape_string($this->input->post("address_line_2")) ;
				$param1["city"] = mysql_real_escape_string($this->input->post("city")) ;
				$param1["country"] = mysql_real_escape_string($this->input->post("country")) ;
				
				$param1["post_code"] = mysql_real_escape_string($this->input->post("post_code")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
				$param1["vat_code"] = mysql_real_escape_string($this->input->post("vat_code")) ;
				
				$param1["maximum_limit"] = mysql_real_escape_string($this->input->post("maximum_limit")) ;
				$param1["transport_charges"] = mysql_real_escape_string($this->input->post("transport_charges")) ;
				$param1["overdue_days"] = mysql_real_escape_string($this->input->post("overdue_days")) ;
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				
				$rec_id = $this->model1->update_rec($param1, $cond1, "customers") ;
				
				$cond2["user_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				$param2["username"] = mysql_real_escape_string($this->input->post("username")) ;
				
				$login_rec_id = $this->model1->update_rec($param2, $cond2, "user_logins") ;
				
				if(($rec_id) && ($login_rec_id)) redirect(base_url("customer/customer_details/".$cond1["id"]."/4")) ;
				else redirect(base_url("customer/customer_details/".$cond1["id"]."/2")) ;
			}
		}
		else
			redirect(base_url("customer")) ;
	}
	
	public function remove_customer($customer_id = 0)
	{
		if($customer_id)
		{
			$cond1["id"] = $customer_id ;
			$res1 = $this->model1->delete_rec($cond1, "customers") ;
			
			$cond2["user_id"] = $customer_id ;
			$res2 = $this->model1->delete_rec($cond2, "user_logins") ;
			$cond3["customer_id"] = $customer_id ;
			$res3 = $this->model1->delete_rec($cond3, "orders") ;
			
			$res4 = $this->model1->delete_rec($cond3, "customer_products") ;
			
			$res5 = $this->model1->delete_rec($cond3, "returns") ;
			
			$res6 = $this->model1->delete_rec($cond3, "transactions") ;
			
			if(($res1) && ($res2))
				redirect(base_url("customer/index/1")) ;
			else
				redirect(base_url("customer/index/2")) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function email_form($customer_id = 0, $msg = 0)
	{
		if($customer_id)
		{
			$cond1["id"] = $customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "email/email" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function send_message()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("customer_email_address", "Customer Email Address(es)", "required|valid_emails") ;
			/*$this->form_validation->set_rules("cc_email_address", "CC Email Address(es)", "valid_emails") ;
			$this->form_validation->set_rules("bcc_email_address", "BCC Email Address(es)", "valid_emails") ;
			$this->form_validation->set_rules("email_subject", "Email Subject", "required") ;
			$this->form_validation->set_rules("email_message", "Email Message", "required") ;
			/**/
			if ($this->form_validation->run() == FALSE) {
			
				$customer_id = mysql_real_escape_string($this->input->post("customer_id")) ;
				$cond1["id"] = $customer_id ;
				$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "email/email" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["customer_email_address"] = mysql_real_escape_string($this->input->post("customer_email_address")) ;
				$param1["cc_email_address"] = mysql_real_escape_string($this->input->post("cc_email_address")) ;
				$param1["bcc_email_address"] = mysql_real_escape_string($this->input->post("bcc_email_address")) ;
				
				$param1["email_subject"] = mysql_real_escape_string($this->input->post("email_subject")) ;
				$param1["email_message"] = mysql_real_escape_string($this->input->post("email_message")) ;
				$param1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				
				$config['upload_path'] =  "./email_attachments/" ;
				$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt" ;
				$config['max_size']	= '10240' ;
				$config['encrypt_name']	= TRUE ;
				$config['remove_spaces']	= TRUE ;
				
				$this->load->library('upload', $config) ;
				
				if (!($this->upload->do_upload("email_attachment"))) $param1["attachment_file"] = FALSE ;
				else
				{
					$data["file_data"] = $this->upload->data() ;
					$param1["attachment_file"] = $data["file_data"]["file_name"] ;
				}
				
				$save_email_address = mysql_real_escape_string($this->input->post("save_email_message")) ;
				
				if($save_email_address == "yes") $this->save_email($param1) ;
				//send_email_message($title, $to, $cc, $bcc, $subject, $message)
				
				if($param1["cc_email_address"] == "") $param1["cc_email_address"] = 0 ;
				if($param1["bcc_email_address"] == "") $param1["bcc_email_address"] = 0 ;
				
				if(send_email_message("Argus Distribution", $param1["customer_email_address"], $param1["cc_email_address"], $param1["bcc_email_address"], $param1["email_subject"], $param1["email_message"], $param1["attachment_file"]))
					redirect(base_url("customer/email_form/".($param1["customer_id"])."/3")) ;
				else
					redirect(base_url("customer/email_form/".($param1["customer_id"])."/2")) ;	
			}
			
		} else
			redirect(base_url("customer")) ;
	}

	private function get_session_data()
	{
		$session_data = array(
					"sad" => $this->session->userdata('email')
				) ;
		return $session_data ;
	}
	
	private function save_email($params)
	{
		$param1["staff_id"] = $params["customer_id"] ;
		$param1["customer_id"] = $params["customer_id"] ;
		$param1["email_address"] = $params["customer_email_address"] ;
		$param1["cc_email_address"] = $params["cc_email_address"] ;
		$param1["bcc_email_address"] = $params["bcc_email_address"] ;
		$param1["email_subject"] = $params["email_subject"] ;
		$param1["email_message"] = $params["email_message"] ;
		$param1["sent_time"] = date("Y-m-d G:i:s") ;
		
		$res = $this->model1->insert_rec($param1, "email_messages") ;
	}
	
	public function email_templates()
	{
	}
	
}
?>