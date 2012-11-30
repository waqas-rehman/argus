<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
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
		$data["tatal_groups"] = $this->model1->count_rec("product_groups") ;
		$product_groups = $this->model1->get_all("product_groups") ;
		
		if($product_groups)
		{	
			$i = 1 ;
			foreach($product_groups as $rec):
				$data["products"][$i] = $this->model2->customer_products($this->session->userdata("customer_id"), $rec->id) ;
				$i = $i + 1 ;
			endforeach ;
		}
		
		$data["session_data"] = $this->session_data() ;
		$data["view"] = "products/products" ;
		$this->load->view('template/body', $data);
	}
	
	public function download_manual($product_id, $msg = 0)
	{
		if($product_id)
		{
			$file_extension = $this->get_file_extention($product_id) ;
			$this->load->helper('download') ;
			$cond1["id"] = $product_id ;
			$product = $this->model1->get_one($cond1, "products") ;
			
			$data = file_get_contents("./admin/product_manuals/".$product->product_manual) ;
			$name = $product->product_name.".".$file_extension ;
	
			force_download($name, $data) ;
			
			redirect(base_url("products")) ;
		} else
			redirect(base_url("products")) ;
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array("current_tab" => "products", "sub_current_tab" => $sub_tab) ;
		return $session_data ;
	}
	
	private function get_file_extention($product_id)
	{
		$cond1["id"] = $product_id ;
		$product = $this->model1->get_one($cond1, "products") ;
		
		$file = array() ;
		$file = explode(".", $product->product_manual) ;
		return $file[1] ;
	}
}