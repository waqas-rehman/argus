<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$cond1["type"] = "quotation" ;
		$data["orders"] = $this->model1->get_all_cond($cond1, "orders") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "quotations/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function quotation_details($quotation_id, $msg = 0)
	{
		if($quotation_id)
		{
			$data["msg"] = $msg ;
			
			$cond1["id"] = $quotation_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$cond2["order_id"] = $quotation_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "order_products") ;
			
			$cond["id"] = $data["order_rec"]->customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond, "customers") ;
			
			$cond3["id"] = $data["customer_rec"]->vat_code ; 
			$data["vat_rec"] = $this->model1->get_one($cond3, "vat_codes") ;
			
			$data["file_ext"] = "" ;
			
			if($data["order_rec"]->order_file != "")
				$data["file_ext"] = $this->get_file_extention($data["order_rec"]->id) ;
			
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "quotations/quotation_details" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("quotations")) ;
	}
	
	public function delete_quotation($quotation_id = 0)
	{
		if($quotation_id)
		{
			$cond1["id"] = $quotation_id ;
			$success1 = $this->model1->delete_rec($cond1, "orders") ;
			
			$cond2["order_id"] = $quotation_id ;
			$success2 = $this->model1->delete_rec($cond2, "order_products") ;
			
			if(($success1) && ($success2)) redirect(base_url("quotations/index/1")) ;
			else redirect(base_url("quotations/index/2")) ;
		} else
			redirect(base_url("quotations")) ;
	}
	
	private function get_session_data()
	{}
}