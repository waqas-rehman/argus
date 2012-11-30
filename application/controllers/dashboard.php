<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		$this->load->helper('url') ;
		if( ! ($this->session->userdata("customer_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index()
	{
		$cond1["customer_id"] = $this->session->userdata("customer_id") ;
		$cond2["id"] = $this->session->userdata("customer_id") ;
		$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
		
		$data["order_rec"] = $this->model2->get_orders_accepted($this->session->userdata("customer_id")) ;
		$data["orders"] = $this->model2->get_customer_invoice2($this->session->userdata("customer_id")) ;

		$data["invoice_rec"] = $this->model2->get_customer_outstanding($this->session->userdata("customer_id")) ;
		$data["invoice_complet_rec"] = $this->model2->get_customer_invoices_completed($this->session->userdata("customer_id")) ;
		
		$data["session_data"] = $this->session_data() ;
		$data["view"] = "dashboard/dashboard" ;
		$this->load->view('template/body', $data);
	}
	
	public function index1()
	{
		$data["view"] = "folder/form" ;
		$this->load->view('template/body', $data);
	}
	
	public function index2()
	{
		$data["view"] = "folder/table" ;
		$this->load->view('template/body', $data);
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array("current_tab" => "dashboard", "sub_current_tab" => $sub_tab) ;
		return $session_data ;
	}
}