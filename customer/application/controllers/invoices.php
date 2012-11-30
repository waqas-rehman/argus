<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller
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
		$data["msg"] = $msg ;
		
		$data["orders"] = $this->model2->get_invoices($this->session->userdata("customer_id")) ;
		
		$cond2["id"] = $this->session->userdata("customer_id") ;
		$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;

		$data["session_data"] = $this->session_data("all_orders") ;
		$data["view"] = "invoices/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array("current_tab" => "invoices", "sub_current_tab" => $sub_tab) ;
		return $session_data ;
	}
	
	public function download_manual($order_id = 0)
	{
		if($order_id)
		{
			$file_extension = $this->get_file_extention($order_id) ;
			
			$this->load->helper("download") ;
			
			$cond1["id"] = $order_id ;
			$order_rec = $this->model1->get_one($cond1, "orders") ;
			
			$data = file_get_contents("./admin/order_invoices/".$order_rec->invoice) ;
			$name = $order_rec->purchase_order_number.".".$file_extension ;
	
			force_download($name, $data) ;
			
			redirect(base_url("invoices")) ;
		} else
			redirect(base_url("invoices")) ;
	}
	
	private function get_file_extention($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$order_rec = $this->model1->get_one($cond1, "orders") ;
		
		$file = array() ;
		$file = explode(".", $order_rec->invoice) ;
		return $file[1] ;
	}
}
?>