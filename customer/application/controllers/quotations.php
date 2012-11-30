<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed') ;

class Quotations extends CI_Controller
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
		$cond1["type"] = "quotation" ;
		$cond1["customer_id"] = $this->session->userdata("customer_id") ;
		$data["quote_recs"] = $this->model1->get_all_cond($cond1, "orders") ;
		
		$data["msg"] = $msg ; 
		$data["session_data"] = $this->session_data("all_quotation") ;
		$data["view"] = "quotation/index" ;
		$this->load->view('template/body', $data) ;
	}
	
	public function quotation_form($msg = 0)
	{
		$cond2["status"] = "Active" ;
		$data["product_groups"] = $this->model1->get_all_cond($cond2, "product_groups") ;
		
		$cond3["id"] = $this->session->userdata("customer_id") ;
		$data["customer_rec"] = $this->model1->get_one($cond3, "customers") ;
		
		$cond4["id"] = $data["customer_rec"]->vat_code ; 
		$data["vat_rec"] = $this->model1->get_one($cond4, "vat_codes") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->session_data("quotation_form") ;
		$data["view"] = "quotation/products_form" ;
		$this->load->view('template/body', $data) ;
	}
	
	public function products()
	{
		if($_POST)
		{
			$quotation_id = $this->creation_quotation_record(mysql_real_escape_string($this->input->post("quotation_number")), mysql_real_escape_string($this->input->post("quotation_notes"))) ;
			
			$ids = mysql_real_escape_string($this->input->post("current_tr")) ; 
			$vat_rate = floatval(mysql_real_escape_string($this->input->post("vat_rate"))) ;
			$num_of_records = mysql_real_escape_string($this->input->post("current_num")) ;
			
			$sub_total = floatval(mysql_real_escape_string($this->input->post("sub_total_hidden"))) ;
			$vat_total = floatval(mysql_real_escape_string($this->input->post("vat_total_hidden"))) ;
			
			$product_group = $this->input->post("product_group") ;
			$products = $this->input->post("products") ;
			$product_quantity = $this->input->post("product_quantity") ;
			
			$temp_sub_total = 0 ;
			$temp_vat_total = 0 ;
			
			$cond_delete["order_id"] = $quotation_id ;
			$this->model1->delete_rec($cond_delete, "order_products") ;
			
			if($num_of_records > 0)
			{
				if($products)
				{
					$i = 0 ;
					$arr = array() ;
					foreach($products as $rec => $val):
						$arr = explode("|", $val) ;
						
						$gr_pr_rec = $this->model2->get_group_product_name($product_group[$i], intval($arr[0])) ;
						
						$param1["order_id"] = $quotation_id ;
						
						$param1["product_group_id"] = $product_group[$i] ;
						$param1["product_group"] = $gr_pr_rec->group_name ;
						
						$param1["product_id"] = $arr[0] ;
						$param1["product_name"] = $gr_pr_rec->product_name ;
						$param1["product_quantity"] = intval($product_quantity[$i]) ;
						$param1["product_price"] = floatval($arr[1]) ;
						$param1["vat_rate"] = $vat_rate ;
						
						if($param1["product_quantity"] > 0)
							$order_rec = $this->model1->insert_rec($param1, "order_products") ;
						
						$temp_sub_total = $temp_sub_total + ($param1["product_price"] * $param1["product_quantity"]) ;
						$temp_vat_total = $temp_vat_total + (($param1["vat_rate"]/100) * $param1["product_price"] * $param1["product_quantity"]) ;
						
						$i = $i + 1 ;
					endforeach ;
				}
			}
			
			redirect(base_url("quotations")) ;
		}
		else
			redirect(base_url("quotations")) ;
	}
	
	public function quotation_detail($quotation_id = 0)
	{
		if($quotation_id)
		{
			$data["quotation_id"] = $quotation_id ;
			
			$condx["id"] = $quotation_id ;
			$data["quotation_rec"] = $this->model1->get_one($condx, "orders") ;
			
			$cond1["order_id"] = $quotation_id ;
			$data["total_products"] = $this->model1->count_rec_cond($cond1, "order_products") ;
			$data["products_rec"] = $this->model1->get_all_cond($cond1, "order_products") ;
					
			$cond2["status"] = "Active" ;
			$data["product_groups"] = $this->model1->get_all_cond($cond2, "product_groups") ;
					
			$cond3["id"] = $this->session->userdata("customer_id") ;
			$data["customer_rec"] = $this->model1->get_one($cond3, "customers") ;
						
			$cond4["id"] = $data["customer_rec"]->vat_code ;
			$data["vat_rec"] =  $this->model1->get_one($cond4, "vat_codes") ;
						
			$data["session_data"] = $this->session_data("quotation_form") ;
			$data["view"] = "quotation/edit_products" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("quotations")) ;
	}
	
	public function update_products()
	{
		if($_POST)
		{
			$quotation_id = mysql_real_escape_string($this->input->post("quotation_id")) ;
			
			$cond1x["id"] = $quotation_id ; 
 			$param1x["purchase_order_number"] = mysql_real_escape_string($this->input->post("quotation_number")) ;
			$param1x["order_description"] = mysql_real_escape_string($this->input->post("quotation_notes")) ;
			$successx = $this->model1->update_rec($param1x, $cond1x, "orders") ;
			 
			$ids = mysql_real_escape_string($this->input->post("current_tr")) ; 
			$vat_rate = floatval(mysql_real_escape_string($this->input->post("vat_rate"))) ;
			$num_of_records = mysql_real_escape_string($this->input->post("current_num")) ;
			
			$sub_total = floatval(mysql_real_escape_string($this->input->post("sub_total_hidden"))) ;
			$vat_total = floatval(mysql_real_escape_string($this->input->post("vat_total_hidden"))) ;
			
			$product_group = $this->input->post("product_group") ;
			$products = $this->input->post("products") ;
			$product_quantity = $this->input->post("product_quantity") ;
			
			$temp_sub_total = 0 ;
			$temp_vat_total = 0 ;
			
			$cond_delete["order_id"] = $quotation_id ;
			$this->model1->delete_rec($cond_delete, "order_products") ;
			
			if($num_of_records > 0)
			{
				if($products)
				{
					$i = 0 ;
					$arr = array() ;
					foreach($products as $rec => $val):
						$arr = explode("|", $val) ;
						
						$gr_pr_rec = $this->model2->get_group_product_name($product_group[$i], intval($arr[0])) ;
						
						$param1["order_id"] = $quotation_id ;
						
						$param1["product_group_id"] = $product_group[$i] ;
						$param1["product_group"] = $gr_pr_rec->group_name ;
						
						$param1["product_id"] = $arr[0] ;
						$param1["product_name"] = $gr_pr_rec->product_name ;
						$param1["product_quantity"] = intval($product_quantity[$i]) ;
						$param1["product_price"] = floatval($arr[1]) ;
						$param1["vat_rate"] = $vat_rate ;
						
						if($param1["product_quantity"] > 0)
							$order_rec = $this->model1->insert_rec($param1, "order_products") ;
						
						$temp_sub_total = $temp_sub_total + ($param1["product_price"] * $param1["product_quantity"]) ;
						$temp_vat_total = $temp_vat_total + (($param1["vat_rate"]/100) * $param1["product_price"] * $param1["product_quantity"]) ;
						
						$i = $i + 1 ;
					endforeach ;
				}
			}
			
			redirect(base_url("quotations")) ;
		}
		else
			redirect(base_url("quotations")) ;
	}
	
	public function change_quotation($quotation_id)
	{
		if($quotation_id)
		{
			$condx["id"] = $this->session->userdata("customer_id") ;
			$customer_rec = $this->model1->get_one($condx, "customers") ;
			
			$cond1["id"] = $quotation_id ;
			
			$param1["type"] = "order" ;
			$param1["invoice_address"] = ($customer_rec->address_line_1."<br />".$customer_rec->city."<br />".$customer_rec->country."<br />".$customer_rec->telephone_number."<br />".$customer_rec->post_code) ;
			$param1["delivery_address"] = ($customer_rec->address_line_1."<br />".$customer_rec->city."<br />".$customer_rec->country."<br />".$customer_rec->telephone_number."<br />".$customer_rec->post_code) ;
			$param1["creation_date"] = date("Y-m-d G:i:s") ;
			
			$param1["status"] = "Pending" ;
			
			$success = $this->model1->update_rec($param1, $cond1, "orders") ;
			
			if($success)
				redirect(base_url("orders/order_detail/".$quotation_id)) ;
			
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
	
	private function creation_quotation_record($quotation_number, $quotation_notes)
	{
		$paramx["type"] = "quotation" ;
		$paramx["customer_id"] = $this->session->userdata("customer_id") ;
		$paramx["purchase_order_number"] = $quotation_number ;
		$paramx["invoice_address"] = "" ;
		$paramx["delivery_address"] = "" ;
		$paramx["order_description_radio"] = "" ;
		$paramx["order_description"] = $quotation_notes ;
		$paramx["order_file_radio"] = "" ;
		$paramx["order_file"] = "" ;
		$paramx["status"] = "" ;
		$paramx["creation_date"] = date("Y-m-d G:i:s") ;
		$paramx["order_date"] = "0000-00-00 00:00:00" ;
		$paramx["acceptance_date"] = "0000-00-00 00:00:00" ;
		$paramx["shipment_date"] = "0000-00-00 00:00:00" ;
		$paramx["invoice_date"] = "0000-00-00 00:00:00" ;
		$paramx["outstanding_date"] = "0000-00-00 00:00:00" ;
		$paramx["compeletion_date"] = "0000-00-00 00:00:00" ;
		
		$quote_id = $this->model1->insert_rec($paramx, "orders") ;	 
		return $quote_id ;
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array(
						"current_tab" => "quotations", 
						"sub_current_tab" => $sub_tab
						) ;
		return $session_data ;
	}
	
}
?>