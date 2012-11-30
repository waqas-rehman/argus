<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
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
		
		$cond1["type"] = "order" ;
		$cond1["customer_id"] = $this->session->userdata("customer_id") ;
		$data["orders"] = $this->model1->get_all_cond_orderby($cond1, "orders", "orders.creation_date", "DESC") ;
		
		$data["session_data"] = $this->session_data("all_orders") ;
		$data["view"] = "order/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function order_form()
	{
		$cond1["id"] = $this->session->userdata("customer_id");
		$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
		$credit_limit = $data["customer_rec"]->maximum_limit;
		$acount_balance = abs($data["customer_rec"]->balance);
		
		
		$orders = $this->model2->get_customer_invoice2($this->session->userdata("customer_id"));
		
		if($orders)
					{
				foreach($orders as $rec) :
												
			$overdue_date =  date("Y-m-d", strtotime($rec->invoice_date . "+".(intval($data["customer_rec"]->overdue_days))." day"))."<br />" ;
		
		 $diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ;		
		endforeach ;
			}
			
		if (!$orders) $diff = ""; 
		if ($acount_balance >= $credit_limit || $diff > 0 ) {
		
		$data["msg"] = 1 ;
		$data["session_data"] = $this->session_data("order_form") ;
		$data["view"] = "order/acount_overdue" ;
		$this->load->view("template/body", $data) ;
		}
		
		else {
		$data["msg"] = 0 ;
		$data["session_data"] = $this->session_data("order_form") ;
		$data["view"] = "order/order_form" ;
		$this->load->view("template/body", $data) ;
		}
		
	}
	
	public function order_detail($order_id = 0, $msg = 0)
	{
		if($order_id)
		{
			$data["msg"] = $msg ;
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			if($data["order_rec"]->status != "Pending") redirect(base_url("orders")) ;
			
			$cond2["order_id"] = $order_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "order_products") ;
			
			$cond["id"] = $this->session->userdata("customer_id") ;
			$data["customer_rec"] = $this->model1->get_one($cond, "customers") ;
			
			$cond3["id"] = $data["customer_rec"]->vat_code ; 
			$data["vat_rec"] = $this->model1->get_one($cond3, "vat_codes") ;
			
			$data["file_ext"] = "" ;
			$data["transport_charges"] = "";
			$data["temp_vat_tax"] = "";
			//$data[" transport_charges"] = "";
			if($data["order_rec"]->order_file != "")
				$data["file_ext"] = $this->get_file_extention($data["order_rec"]->id) ;
			
			$data["session_data"] = $this->session_data() ;
			$data["view"] = "order/order_detail" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function submmit_order()
	{
		if($_POST)
		{
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id_final")) ;
			
			
			
			$order_rec = $this->model1->get_one($cond1, "orders") ;
			
			$cond2["order_id"] = mysql_real_escape_string($this->input->post("order_id_final")) ;
			$product_recs = $this->model1->count_rec_cond($cond2, "order_products") ;
			
			if($product_recs == 0)
				redirect(base_url("orders/order_detail/".$order_id."/5")) ;
				
			//elseif(($order_rec->order_description_radio != "Yes") && ($order_rec->order_description_radio != "No") )
				//redirect(base_url("orders/order_detail/".$cond1["id"]."/6")) ;
				
			elseif(($order_rec->order_file_radio != "Yes") && ($order_rec->order_file_radio != "No") )
				redirect(base_url("orders/order_detail/".$cond1["id"]."/7")) ;
			
			else
			{
				$param1["status"] = "Ordered" ;
				$param1["order_date"] = date("Y-m-d G:i:s") ;
				$this->model1->update_rec($param1, $cond1, "orders") ;
				
				
				 
				 // email system  Started
				//$cond4["purchase_order_number"] = mysql_real_escape_string($this->input->post("purchase_order_number")) ;
				$cond5["order_id"] = mysql_real_escape_string($this->input->post("order_id_final")) ;
				
				$data["orders_prod"] = $this->model1->get_one($cond5, "order_products") ;
				
				$cond4["id"] = $this->session->userdata("customer_id") ;
				$data["customer_rec"] = $this->model1->get_one($cond4, "customers") ;
				
				$data["orders_rec"] = $this->model1->get_one($cond1, "orders") ;
				
				
				 
				if($data["msg"] = 1) {
					$email_data["delivery_address"] = $data["orders_rec"]->delivery_address;
					$email_data["creation_date"] = $data["orders_rec"]->creation_date ;
					$email_data["invoice_amount"] = mysql_real_escape_string($this->input->post("total_cost")) ;
					
					$email_data["transport_charges"] = mysql_real_escape_string($this->input->post("transport_charges")) ;
					$email_data["product_group"] = $data["orders_prod"]->product_group ;
					$email_data["product_name"] = $data["orders_prod"]->product_name ;
					$email_data["vat_rate"] = mysql_real_escape_string($this->input->post("vat_rat")) ;
					$email_data["product_quantity"] = $data["orders_prod"]->product_quantity ;
					$email_data["product_price"] = $data["orders_prod"]->product_price ;
					$email_data["po_number"] = $data["orders_rec"]->purchase_order_number;
					
					$email_data["client_name"] = $data["customer_rec"]->company_name;
					$email_data["contact_person_name"] = $data["customer_rec"]->contact_person_name;
					$param3["email_address"] = $data["customer_rec"]->email_address;
					
					$email_message = $this->load->view("email_templates/email_order_rec", $email_data, TRUE) ;
					
					send_email_message("Argus Distribution", $param3["email_address"], "sales@argusdistribution.co.uk", 0, "Order Confirmation", $email_message, 0) ;
					}
				// email system ended; 
				
				
				//$this->load->view($email_message) ;
				redirect(base_url("orders")) ; 
			}
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function general_order_details($order_id = 0, $msg = 0)
	{
		if($order_id)
		{
			$data["msg"] = $msg ;
			
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			if($data["order_rec"]->status == "Pending") redirect(base_url("orders/order_detail/".$order_id)) ;
			
			$cond2["order_id"] = $order_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "order_products") ;
			
			$cond["id"] = $this->session->userdata("customer_id") ;
			$customer_rec = $this->model1->get_one($cond, "customers") ;
			$data["customer_rec"] = $this->model1->get_one($cond, "customers") ;
			
			$cond3["id"] = $customer_rec->vat_code ; 
			$data["vat_rec"] = $this->model1->get_one($cond3, "vat_codes") ;
			
			$data["file_ext"] = "" ;
			
			if($data["order_rec"]->order_file != "")
				$data["file_ext"] = $this->get_file_extention($data["order_rec"]->id) ;
			
			$data["session_data"] = $this->session_data() ;
			$data["view"] = "order/general_order_detail" ;
			$this->load->view("template/body", $data) ;
			
		} else 
			redirect(base_url("orders")) ;
	}
	
	public function view_basic_details($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
		$data["msg"] = 0 ;
		$data["session_data"] = $this->session_data("order_form") ;
		$data["view"] = "order/edit_order_form" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function edit_basic_details($order_id = 0)
	{
		if($order_id)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("purchase_order_number", "Purchase Order Number", "required") ;
			$this->form_validation->set_rules("delivery_address", "Delivery Address", "required") ;
			$this->form_validation->set_rules("invoice_address", "Invoice Address", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
			
				$data["msg"] = 1 ;
				$cond1["id"] = $order_id ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
				$data["session_data"] = $this->session_data("order_form") ;
				$data["view"] = "order/edit_order_form" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$cond1["customer_id"] = $this->session->userdata("customer_id") ;
				$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				
				$param1["purchase_order_number"] = mysql_real_escape_string($this->input->post("purchase_order_number")) ;
				$param1["invoice_address"] = mysql_real_escape_string($this->input->post("invoice_address")) ;
				$param1["delivery_address"] = mysql_real_escape_string($this->input->post("delivery_address")) ;
						
				$success = $this->model1->update_rec($param1, $cond1, "orders") ;
				
				$next_step = mysql_real_escape_string($this->input->post("next_step")) ;
				
				if($next_step == "add_products") redirect(base_url("orders/edit_products/".$cond1["id"])) ;
				else redirect(base_url("orders/order_detail/".($order_id)."/10")) ;
			}
		} else
			redirect(base_url("orders")) ;
	}
	
	public function step2()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("purchase_order_number", "Purchase Order Number", "required|is_unique[orders.purchase_order_number]") ;
			$this->form_validation->set_rules("delivery_address", "Delivery Address", "required") ;
			$this->form_validation->set_rules("invoice_address", "Invoice Address", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
			
				$data["msg"] = 1 ;
				$cond1["id"] = $this->session->userdata("customer_id") ;
				$data["customer_rec"] = $this->model1->get_one($cond1, "customers") ;
				$data["session_data"] = $this->session_data("order_form") ;
				$data["view"] = "order/order_form" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["type"] = "order" ;
				$param1["customer_id"] = $this->session->userdata("customer_id") ;
				$param1["purchase_order_number"] = mysql_real_escape_string($this->input->post("purchase_order_number")) ;
				$param1["invoice_address"] = mysql_real_escape_string($this->input->post("invoice_address")) ;
				$param1["delivery_address"] = mysql_real_escape_string($this->input->post("delivery_address")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = "Pending" ;
				
				$data["order_id"] = $this->model1->insert_rec($param1, "orders") ;
				$data["msg"] = 1 ;
			
				$next_step = mysql_real_escape_string($this->input->post("next_step")) ;
				$data["session_data"] = $this->session_data("order_form") ;

				if($next_step == "add_products") redirect(base_url("orders/edit_products/".$data["order_id"])) ;
				else redirect(base_url("orders")) ;
			}
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function edit_products($order_id = 0)
	{
		if($order_id)
		{
			$cond["order_id"] = $order_id ;
			$temp_order_products = $this->model1->get_all_cond($cond, "order_products") ;
			
			if($temp_order_products)
			{
				$data["order_id"] = $order_id ;
				
				$cond1["order_id"] = $order_id ;
				$data["total_products"] = $this->model1->count_rec_cond($cond1, "order_products") ;
				$data["products_rec"] = $this->model1->get_all_cond($cond1, "order_products") ;
					
				$cond2["status"] = "Active" ;
				$data["product_groups"] = $this->model1->get_all_cond($cond2, "product_groups") ;
					
				$cond3["id"] = $this->session->userdata("customer_id") ;
				$data["customer_rec"] = $this->model1->get_one($cond3, "customers") ;
						
				$cond4["id"] = $data["customer_rec"]->vat_code ;
				$data["vat_rec"] =  $this->model1->get_one($cond4, "vat_codes") ;
						
				$data["session_data"] = $this->session_data("order_form") ;
				$data["view"] = "order/edit_products" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$data["order_id"] = $order_id ;
				$data["msg"] = 0 ;
				
				$cond1["status"] = "Active" ;
				$data["product_groups"] = $this->model1->get_all_cond($cond1, "product_groups") ;
				
				$cond2["id"] = $this->session->userdata("customer_id") ;
				$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
				
				$cond3["id"] = $data["customer_rec"]->vat_code ;
				$data["vat_rec"] =  $this->model1->get_one($cond3, "vat_codes") ;
				
				$data["session_data"] = $this->session_data("order_form") ;
				$data["view"] = "order/products_form" ;
				$this->load->view("template/body", $data) ;
			}
		}
		else
			redirect(base_url("orders/add_products/".$order_id)) ;
	}
	
	public function products()
	{
		if($_POST)
		{
			$next_step = mysql_real_escape_string($this->input->post("next_step")) ; 
			$order_id = mysql_real_escape_string($this->input->post("order_id")) ;
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
			
			$cond_delete["order_id"] = $order_id ;
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
						
						$param1["order_id"] = $order_id ;
						
						$param1["product_group_id"] = $product_group[$i] ;
						$param1["product_group"] = $gr_pr_rec->group_name ;
						$param1["product_id"] = $arr[0] ;
						$param1["product_name"] = $gr_pr_rec->product_name ;
						$param1["product_code"] = $gr_pr_rec->product_code ;
						$param1["product_adl_code"] = $gr_pr_rec->adl_code ;
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
			
			if($next_step == "save") redirect(base_url("orders/order_detail/".$order_id."/11")) ;
			else redirect(base_url("orders/order_description/".$order_id)) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function order_description($order_id = 0)
	{
		if($order_id)
		{
			$cond["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond, "orders") ;
			
			$data["order_id"] = $order_id ;
			$data["error"] = 0 ;
			
			$cond2["id"] = $this->session->userdata("customer_id") ;
			$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
			
			$data["session_data"] = $this->session_data("order_form") ;
			$data["view"] = "order/order_description" ;
			$this->load->view("template/body", $data) ;
				
		}
		else
			redirect(base_url("orders")) ;
	}
	
	public function add_description()
	{
		if($_POST)
		{
			$data["error"] = 0 ;
			$data["msg"] = 0 ;
			
			$data["order_id"] = mysql_real_escape_string($this->input->post("order_id")) ;

			$next_step = mysql_real_escape_string($this->input->post("next_step")) ;
			
			//$param1["order_description_radio"] = mysql_real_escape_string($this->input->post("description_radio")) ;
			$param1["order_description"] = mysql_real_escape_string($this->input->post("order_description")) ;
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			
			$cond2["id"] = $this->session->userdata("customer_id") ;
			$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
			
			/*
			if($param1["order_description_radio"] == "Yes")
			{
				$condx["id"] = $data["order_id"] ;
				$data["order_rec"] = $this->model1->get_one($condx, "orders") ;
				
				if($param1["order_description"] == "") {
				
					$data["error"] = 1 ;
					$data["session_data"] = $this->session_data("order_form") ;
					$data["view"] = "order/order_description" ;
					$this->load->view("template/body", $data) ;
				
				} else {
					$success1 = $this->model1->update_rec($param1, $cond1, "orders") ;
					
					if($next_step == "save") redirect(base_url("orders/order_detail/".$data["order_id"]."/12")) ;
					else redirect(base_url("orders/order_file/".$data["order_id"])) ;
				}
			} else {
				$param1["order_description"] = "" ;
				$success1 = $this->model1->update_rec($param1, $cond1, "orders") ;
				
				if($next_step == "save") redirect(base_url("orders/order_detail/".$data["order_id"]."/12")) ;
				else redirect(base_url("orders/order_file/".$data["order_id"])) ;
			}
			/**/
			$success1 = $this->model1->update_rec($param1, $cond1, "orders") ;
					
			if($next_step == "save") redirect(base_url("orders/order_detail/".$data["order_id"]."/12")) ;
			else redirect(base_url("orders/order_file/".$data["order_id"])) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function get_products_ajax()
	{
		if($_POST)
		{
			$number = mysql_real_escape_string($this->input->post("number")) ;
			$group_id = mysql_real_escape_string($this->input->post("group_id")) ;
			if($group_id != "")
			{
				$products = $this->model2->get_products_ajax($group_id, $this->session->userdata("customer_id")) ;
				
				if($products)
				{
					echo '<select id="products'.$number.'" name="products[]" class="products_dropdown big1" number="'.$number.'">' ;
					echo '<option value="">Select Product</option>' ;
					foreach($products as $rec):
						$val = $rec->product_id."|" ;
						if($rec->new_product_price != "") $val = $val.$rec->new_product_price ;
						else $val = $val.$rec->product_price ;
						echo '<option value="'.$val.'">'.$rec->adl_code.' - '.$rec->product_code.'</option>' ; //'.$rec->product_name.' - 
					endforeach ;
					echo '</select>' ;
				} else {
					echo 'fail' ;
				}
			} else {
				echo '<select id="products'.$number.'" name="products'.$number.'" class="products_dropdown" number="'.$number.'">' ;
				echo '<option value="">Select Product</option>' ;
				echo '</select>' ;
			}
			exit ;
		} else
			redirect(base_url("orders")) ;
	}
	
	public function get_td_ajax()
	{
		if($_POST){
			
			$td_num = mysql_real_escape_string($this->input->post("tr_number")) ;
			$groups = $this->model1->get_all("product_groups") ;
			
			echo '<tr id="tr_'.$td_num.'">' ;
			
			if($groups)
			{
				echo '<td id="group_'.$td_num.'">' ; 
				echo '<select id="product_group'.$td_num.'" name="product_group[]" class="product_group" number="'.$td_num.'" number="'.$td_num.'">' ;
				echo '<option value="">Select Group</option>' ;
				foreach($groups as $rec):
					echo '<option value="'.$rec->id.'">'.$rec->group_name.'</option>' ;
				endforeach ;
				echo '</select>' ; 
				echo '</td>' ;
			}
			echo '<td id="product_'.$td_num.'"><select id="products'.$td_num.'" name="products[]" class="products_dropdown big1"><option value="">Select Product</option></select></td>' ;
				
			echo '<td id="quantity_'.$td_num.'"><input type="text" id="product_quantity'.$td_num.'"  name="product_quantity[]" value="" class="product_quantity" number="'.$td_num.'" /></td>' ;
			echo '<td id="unit_price_'.$td_num.'">0.00</td>' ;
			echo '<td id="total_price_'.$td_num.'">0.00</td>' ;
			echo '<td id="action_'.$td_num.'"><a id="'.$td_num.'" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="'. base_url("gfx/icons/small/cancel.png").'" /></a></td>' ;
			echo '</tr>' ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function get_products_ajax_code()
	{
		if($_POST)
		{
			$get_code = mysql_real_escape_string($this->input->post("get_code")) ;
			if($get_code == "yes")
			{
				echo '<script type="application/javascript">
						$(function(){
							$(".products_dropdown").change(function(){
								var cur_val = $("#current_tr").val() ;
								var str = "#products"+cur_val+" option:selected" ;
								var option_val = $(str).val() ;
								alert("option_val: "+option_val) ;
							}) ;
						}) ;
					</script>' ;
				exit ;
			}
		} else
			redirect(base_url("orders")) ;
	}
	
	public function order_file($order_id = 0)
	{
		$data["order_id"] = $order_id ;
		
		$cond1["id"] = $order_id ;
		$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
		
		$data["file_ext"] = "" ;
		
		if($data["order_rec"]->order_file != "")
			$data["file_ext"] = $this->get_file_extention($order_id) ;
		
		$data["msg"] = 0 ;
		
		$cond2["id"] = $this->session->userdata("customer_id") ;
		$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
		
		$data["session_data"] = $this->session_data("order_form") ;
		$data["view"] = "order/order_file" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function upload_order_file()
	{
		if($_POST)
		{
			$data["file_ext"] = "" ;
			$order_id = mysql_real_escape_string($this->input->post("order_id")) ;
			
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			$file_radio = mysql_real_escape_string($this->input->post("file_radio")) ;
			
			if($file_radio == "Yes")
			{
				$config['upload_path'] =  "./admin/order_files/" ;
				$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt";
				$config['max_size']	= '10240' ;
				$config['encrypt_name']	= TRUE ;
				$config['remove_spaces']	= TRUE ;
				
				$this->load->library('upload', $config) ;
				
				if (!($this->upload->do_upload("order_file")))
				{
					$this->upload->display_errors('<li>', '</li>');
					$data["errors"] = $this->upload->display_errors() ;
					$data["msg"] = 1 ; 
					
					$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
					if($data["order_rec"]->order_file != "")
						$data["file_ext"] = $this->get_file_extention($order_id) ;
					$data["order_id"] = $cond1["id"] ;
					$data["session_data"] = $this->session_data("order_form") ;
					$data["view"] = "order/order_file" ;
					$this->load->view("template/body", $data) ;
				}
				else
				{
					$data["file_data"] = $this->upload->data() ;
					if($this->delete_order_file($cond1["id"]))
					{
						$param1["order_file_radio"] = "Yes" ;
						$param1["order_file"] = $data["file_data"]["file_name"] ;
						$this->model1->update_rec($param1, $cond1, "orders") ;
						$data["msg"] = 0 ;
						redirect(base_url("orders/order_detail/".$order_id."/13")) ;
					}
				}
				
			} else {
				$param1["order_file_radio"] = "No" ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
				if($data["order_rec"]->order_file == "")
				{
					$param1["order_file"] = "" ;
					$this->model1->update_rec($param1, $cond1, "orders") ;
				}
				$data["msg"] = 0 ;
				redirect(base_url("orders/order_detail/".$order_id."/13")) ;
			}
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function download_manual($order_id = 0, $return = "order_details")
	{
		if($order_id)
		{
			$file_extension = $this->get_file_extention($order_id) ;
			
			$this->load->helper("download") ;
			
			$cond1["id"] = $order_id ;
			$order_rec = $this->model1->get_one($cond1, "orders") ;
			
			$data = file_get_contents("./admin/order_files/".$order_rec->order_file) ;
			$name = $order_rec->purchase_order_number.".".$file_extension ;
	
			force_download($name, $data) ;
			
			redirect(base_url("orders/order_file/".$order_id)) ;
			
			if($return == "order_details") redirect(base_url("orders/order_detail".$order_id)) ;
			else redirect(base_url("orders/order_file/".$order_id)) ;
		} else
			redirect(base_url("orders")) ;
	}
	
	public function remove_order_form($order_id = 0, $return = "order_details")
	{
		if($order_id)
		{
			$success = $this->delete_order_file($order_id) ; 
			if($success) redirect(base_url("orders/order_file/".$order_id)) ;
			
			if($return == "order_details") redirect(base_url("orders/order_detail".$order_id)) ;
			else redirect(base_url("orders/order_file/".$order_id)) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function delete_order($order_id = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$temp_order_rec = $this->model1->get_one($cond1,"orders") ;
			
			$order_file = true ;
			
			if($temp_order_rec->order_file != "")
				$order_file = $this->delete_order_file($order_id) ;
			
			$cond1["id"] = $order_id ;
			$success1 = $this->model1->delete_rec($cond1, "orders") ;
			
			$cond2["order_id"] = $order_id ;
			$success2 = $this->model1->delete_rec($cond2, "order_products") ;
			
			if($order_file && $success1 && $success2) redirect(base_url("orders/index/1")) ;
			else redirect(base_url("orders/index/2")) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	private function session_data($sub_tab = "")
	{
		$session_data = array(
						"current_tab" => "orders", 
						"sub_current_tab" => $sub_tab
						) ;
		return $session_data ;
	}
	
	private function get_file_extention($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$order_rec = $this->model1->get_one($cond1, "orders") ;
		
		$file = array() ;
		$file = explode(".", $order_rec->order_file) ;
		return $file[1] ;
	}
	
	private function delete_order_file($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$order_rec = $this->model1->get_one($cond1, "orders") ;
		if($order_rec->order_file != "")
		{
			$result = unlink("./admin/order_files/".$order_rec->order_file);
	 
			if($result)
			{
				$param1["order_file"] = "" ;
				$param1["order_file_radio"] = "" ;
				$this->model1->update_rec($param1, $cond1, "orders") ;
				return true ;
			}
			else
				return false ;
		} else
			return true ;
	}
	
	
	public function date_func2($invoice_date, $overdue_days)
	{
		$overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day"))."<br />" ;
		//$overdue_date = "2012-11-01";
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		
		return $diff;
	}
	
}
?>