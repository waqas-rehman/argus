<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$cond1["type"] = "order" ;
		$data["orders"] = $this->model2->get_orders() ;
		$data["Invoices"] = $this->model2->get_customer_invoice() ;
		
		$data["msg"] = $msg ;
		
		$attribute1 = array("id","company_name","contact_person_name","telephone_number","balance") ;
		$attribute2 = array("username","last_login") ;
		
		$cond2["user_type"] = "customer" ;
 		
		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, $cond2, "id", "user_id", "customers", "user_logins",  "customers.creation_date", "DESC") ;
		
		$data["view"] = "dashboard/index" ;
		$this->load->view("template/body", $data) ;

	}
}