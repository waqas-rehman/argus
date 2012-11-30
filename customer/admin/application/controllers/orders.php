<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
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
		$data["orders"] = $this->model1->get_all_cond($cond1, "orders") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "orders/index" ;
		$this->load->view("template/body", $data) ;
		
					
	
	}
	public function remove_order($order_id = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			
			//$res1 = $this->delete_product_manual($cond1["id"]) ;
			$res1 = $this->model1->delete_rec($cond1, "orders") ;
			
			if($res1)
				redirect(base_url("orders/index/1")) ;
			else
				redirect(base_url("orders/index/2")) ;
		} else
			redirect(base_url("product")) ;
	}
	
	public function edit_status($order_id = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$data["msg"] = 0 ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/udpate_status" ;
			$this->load->view("template/body", $data) ;	
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function update_status()
	{
		if($_POST)
		{
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
			
			$order_rec = $this->model1->get_one($cond1, "orders") ;
			
			if($order_rec->invoice_date == "0000-00-00 00:00:00" && $param1["status"] == "Invoiced")
				$this->calculate_invoice($order_rec->id, $order_rec->customer_id) ;
			
			switch($param1["status"])
			{
				case "Pending" :
						$param1["order_date"] = "0000-00-00 00:00:00" ;
						$param1["acceptance_date"] = "0000-00-00 00:00:00" ;
						$param1["shipment_date"] = "0000-00-00 00:00:00" ;
						$param1["invoice_date"] = "0000-00-00 00:00:00" ;
						$param1["outstanding_date"] = "0000-00-00 00:00:00" ;
						$param1["compeletion_date"] = "0000-00-00 00:00:00" ;
						break ;
				
				case "Ordered" : $param1["order_date"] = date("Y-m-d G:i:s") ; break ;
				case "Accepted" : $param1["acceptance_date"] = date("Y-m-d G:i:s") ; break ;
				case "Shipped" : $param1["shipment_date"] = date("Y-m-d G:i:s") ; break ;
				case "Invoiced" : $param1["invoice_date"] = date("Y-m-d G:i:s") ; break ;
				case "Outstanding" : $param1["outstanding_date"] = date("Y-m-d G:i:s") ; break ;
				case "Completed" : $param1["compeletion_date"] = date("Y-m-d G:i:s") ; break ;
			}
			
			$rec_id = $this->model1->update_rec($param1, $cond1, "orders") ;
			
			// email started.
				
				 
				if($rec_id) {
				
				$cond2["customer_record"] = $this->model1->get_one($cond1, "orders") ;
				$id2["id"] = $cond2["customer_record"]->customer_id;
				
				$order_file["order_file"] = $cond2["customer_record"]->order_file;
				
				
				$data["customer_rec"] = $this->model1->get_one($id2, "customers") ;
				
				
				
					
					$email_data["client_name"] = $data["customer_rec"]->company_name;
					$email_data["contact_person_name"] = $data["customer_rec"]->contact_person_name;
					$email_data["order_status"] = $cond2["customer_record"]->status;
					$param3["email_address"] = $data["customer_rec"]->email_address;
					
					$email_data["insert_text"] = mysql_real_escape_string($this->input->post("email_data")) ;
					
					if ($email_data["order_status"] == "Completed"){
					$email_data["payment_status"] = "Payment has been registered on your account";
					
					$email_message = $this->load->view("email_templates/email_status_customer", $email_data, TRUE) ;
					send_email_message("Argus Distribution", $param3["email_address"], 0, 0, "Statuse has been Changed", $email_message,0) ;
				}
				if ($email_data["order_status"] == "Ordered"){
					$email_data["payment_status"] = "Your order statues has been changed to Ordered.";
					
					$email_message = $this->load->view("email_templates/email_status_customer", $email_data, TRUE) ;
					send_email_message("Argus Distribution", $param3["email_address"], 0, 0, "Statuse has been Changed", $email_message,0) ;
				}
				
				if ($email_data["order_status"] == "Shipped"){
					//$email_data["payment_status"] = "Your order statues has been changed to Shipped.";
					
					$email_message = $this->load->view("email_templates/email_status_shiped", $email_data, TRUE) ;
					send_email_message("Argus Distribution", $param3["email_address"], 0, 0, "Your order has been shipped", $email_message,0) ;
				}
				if ($email_data["order_status"] == "Accepted"){
					$email_data["payment_status"] = "This email is to confirm that your order has been accepted. You will receive another email to confirm when the order has been shipped. This will also contain your estimated delivery date.";
					
					$email_message = $this->load->view("email_templates/email_status_customer", $email_data, TRUE) ;
					send_email_message("Argus Distribution", $param3["email_address"], 0, 0, "Statuse has been Changed", $email_message,0) ;
				}
				if ($email_data["order_status"] == "Outstanding"){
					$email_data["payment_status"] = "Your order statues has been changed to Outstanding.";
					
					$email_message = $this->load->view("email_templates/email_status_customer", $email_data, TRUE) ;
					send_email_message("Argus Distribution", $param3["email_address"], 0, 0, "Statuse has been Changed", $email_message,0) ;
				}
					
			
			// email ended..
			if($rec_id)
			{
				if($param1["status"] == "Invoiced") redirect(base_url("invoices/upload_invoice/".$cond1["id"])) ;
				else redirect(base_url("orders/order_details/".$cond1["id"]."/14" )) ;
			}
			
			else redirect(base_url("orders/order_details/".$cond1["id"]."/5" )) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	}
	private function calculate_invoice($order_id, $customer_id)
	{
		$cond1["order_id"] = $order_id ;
		$order_products = $this->model1->get_all_cond($cond1, "order_products") ;
		
		$cond2["id"] = $customer_id ;
		$customer_rec = $this->model1->get_one($cond2, "customers") ;
		
		$cond3["id"] = $customer_rec->vat_code ;
		$vat_rec = $this->model1->get_one($cond3, "vat_codes") ;
		
		$vat_rate = (floatval($vat_rec->vat_rate)/100) ;
		$maximum_limit = floatval($customer_rec->maximum_limit) ;
		$transpotation_charges = floatval($customer_rec->transport_charges) ;
		
		$products_total = 0 ;
		$products_total_vat = 0 ;
		
		if($order_products)
		{
			/* id	order_id	product_group_id	product_group	product_id	product_name	product_quantity	product_price	vat_rate /**/
			foreach($order_products as $rec):
				$products_total = $products_total + (floatval($rec->product_price) * intval($rec->product_quantity)) ;
				$products_total_vat = $products_total_vat + (floatval($rec->product_price) * intval($rec->product_quantity)) + (floatval($rec->product_price) * intval($rec->product_quantity) * (floatval($rec->vat_rate)/100)) ;
			endforeach ;		
		}
		$temp = 0.0 ;
		
		if($products_total <= $maximum_limit) 
		{
			$temp = $vat_rate * $transpotation_charges ;
			$products_total_vat = $products_total_vat + $transpotation_charges + $temp ;
		}
		
		$param1["balance"] = (floatval($customer_rec->balance)) + ((-1)*($products_total_vat)) ;
		$cond4["id"] = $customer_id ;
		$success = $this->model1->update_rec($param1, $cond4, "customers") ;
		
		$param2["invoice_amount"] = $products_total_vat ;
		$cond5["id"] = $order_id ;
		$success = $this->model1->update_rec($param2, $cond5, "orders") ;
		
		if($success) return true ;
	}
	
	public function order_details($order_id = 0, $msg = 0)
	{
		if($order_id)
		{
			$data["msg"] = $msg ;
			
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$cond2["order_id"] = $order_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "order_products") ;
			
			$cond["id"] = $data["order_rec"]->customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond, "customers") ;
			
			$cond3["id"] = $data["customer_rec"]->vat_code ; 
			$data["vat_rec"] = $this->model1->get_one($cond3, "vat_codes") ;
			
			$data["file_ext"] = "" ;
			
			if($data["order_rec"]->order_file != "")
				$data["file_ext"] = $this->get_file_extention($data["order_rec"]->id) ;
			
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/view_order" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	private function get_session_data()
	{
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
			$result = unlink("./order_files/".$order_rec->order_file);
	 
			if($result)
			{
				$param1["order_file"] = "" ;
				$this->model1->update_rec($param1, $cond1, "orders") ;
				return true ;
			}
			else
				return false ;
		} else
			return true ;
	}
	
	public function download_manual($order_id = 0, $return = "order_details")
	{
		if($order_id)
		{
			$file_extension = $this->get_file_extention($order_id) ;
			
			$this->load->helper("download") ;
			
			$cond1["id"] = $order_id ;
			$order_rec = $this->model1->get_one($cond1, "orders") ;
			
			$data = file_get_contents("./order_files/".$order_rec->order_file) ;
			$name = $order_rec->purchase_order_number.".".$file_extension ;
	
			force_download($name, $data) ;
			
			if($return == "order_details") redirect(base_url("orders/order_detail".$order_id)) ;
			else redirect(base_url("orders/edit_order_file/".$order_id)) ;
		} else
			redirect(base_url("orders")) ;
	}
	
	public function remove_order_form($order_id = 0, $return = "order_details")
	{
		if($order_id)
		{
			$success = $this->delete_order_file($order_id) ; 
			if($success) redirect(base_url("orders/edit_order_file/".$order_id)) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function edit_basic_details($order_id = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$data["msg"] = 0 ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/edit_basic_info" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function update_order_details()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("purchase_order_number", "Purchase Order Number", "required") ;
			$this->form_validation->set_rules("invoice_address", "Invoice Address", "required") ;
			$this->form_validation->set_rules("delivery_address", "Delivery Address", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "orders/edit_basic_info" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				$cond1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				
				$param1["purchase_order_number"] = mysql_real_escape_string($this->input->post("purchase_order_number")) ;
				$param1["invoice_address"] = mysql_real_escape_string($this->input->post("invoice_address")) ;
				$param1["delivery_address"] = mysql_real_escape_string($this->input->post("delivery_address")) ;
				
				$rec_id = $this->model1->update_rec($param1, $cond1, "orders") ;
				
				if($rec_id) redirect(base_url("orders/order_details/".$cond1["id"]."/10" )) ;
				else redirect(base_url("orders/order_details/".$cond1["id"]."/5" )) ;
				
			}
		} else
			redirect(base_url("orders")) ;
	}
	
	public function edit_product_details($order_id = 0)
	{
		if($order_id)
		{	
			$data["order_id"] = $order_id ;
			
			$condx["id"] = $order_id ;
			$order_rec = $this->model1->get_one($condx, "orders") ;
			
			$cond1["order_id"] = $order_id ;
			$data["total_products"] = $this->model1->count_rec_cond($cond1, "order_products") ;
			$data["products_rec"] = $this->model1->get_all_cond($cond1, "order_products") ;
					
			$cond2["status"] = "Active" ;
			$data["product_groups"] = $this->model1->get_all_cond($cond2, "product_groups") ;
					
			$cond3["id"] = $order_rec->customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond3, "customers") ;
						
			$cond4["id"] = $data["customer_rec"]->vat_code ;
			$data["vat_rec"] =  $this->model1->get_one($cond4, "vat_codes") ;
				
			$data["msg"] = 0 ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/edit_order_products" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function update_products()
	{
		if($_POST)
		{
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
						$param1["product_quantity"] = intval($product_quantity[$i]) ;
						$param1["product_price"] = floatval($arr[1]) ;
						$param1["vat_rate"] = $vat_rate ;
						
						$order_rec = $this->model1->insert_rec($param1, "order_products") ;
						
						$temp_sub_total = $temp_sub_total + ($param1["product_price"] * $param1["product_quantity"]) ;
						$temp_vat_total = $temp_vat_total + (($param1["vat_rate"]/100) * $param1["product_price"] * $param1["product_quantity"]) ;
						
						$i = $i + 1 ;
					endforeach ;
				}
			}
			
			redirect(base_url("orders/order_details/".$order_id."/11")) ;

		} else
			redirect(base_url("orders")) ;
	}
	
	public function edit_order_description($order_id = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$data["msg"] = 0 ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/edit_order_description" ;
			$this->load->view("template/body", $data) ;	
		} else
			redirect(base_url("orders")) ;
	}
	
	public function update_order_description()
	{
		if($_POST)
		{
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			$cond1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				
			$param1["order_description"] = mysql_real_escape_string($this->input->post("order_description")) ;
			
			$rec_id = $this->model1->update_rec($param1, $cond1, "orders") ;
				
			if($rec_id) redirect(base_url("orders/order_details/".$cond1["id"]."/12" )) ;
			else redirect(base_url("orders/order_details/".$cond1["id"]."/5" )) ;
				
		} else
			redirect(base_url("")) ;
	}
	
	public function edit_order_file($order_id = 0)
	{
		if($order_id)
		{
			$data["order_id"] = $order_id ;
		
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$data["file_ext"] = "" ;
			
			if($data["order_rec"]->order_file != "")
				$data["file_ext"] = $this->get_file_extention($order_id) ;
			
			$data["msg"] = 0 ;
			
			$cond2["id"] = $data["order_rec"]->customer_id ;
			$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
			
			$data["msg"] = 0 ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "orders/edit_order_file" ;
			$this->load->view("template/body", $data) ;	
			
		} else
			redirect(base_url("orders")) ;
	}
	
	public function upload_order_file()
	{
		if($_POST)
		{
			
			
			$config['upload_path'] =  "./order_files/" ;
			$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt";
			$config['max_size']	= '10240';
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;
			
			$this->load->library('upload', $config);
	
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			
			
			if (!($this->upload->do_upload("order_file")))
			{
				$this->upload->display_errors('<li>', '</li>');
				$data["errors"] = $this->upload->display_errors() ;
				$data["msg"] = 3 ; 
				$data["order_id"] = mysql_real_escape_string($this->input->post("order_id")) ;
		
				$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ; ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
				
				$data["file_ext"] = "" ;
				
				if($data["order_rec"]->order_file != "")
					$data["file_ext"] =$this->get_file_extention(mysql_real_escape_string($this->input->post("order_id"))) ;
				 
				$cond2["id"] = $data["order_rec"]->customer_id ;
				$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
				
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "orders/edit_order_file" ;
				$this->load->view("template/body", $data) ;	
			}
			else
			{
				$data["file_data"] = $this->upload->data() ;
				if($this->delete_order_file($cond1["id"]))
				{
					$param1["order_file"] = $data["file_data"]["file_name"] ;
					$this->model1->update_rec($param1, $cond1, "orders") ;
					$data["msg"] = 4 ;

					redirect(base_url("orders/order_details/".$cond1["id"]."/13"));
					
					 
				}
				else
				{
					$param1["order_file"] = "" ;
					$this->model1->update_rec($param1, $cond1, "orders") ;
					$data["msg"] = 5 ;
				}
				
			}
			
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
			echo '<td id="product_'.$td_num.'"><select id="products'.$td_num.'" name="products[]" class="products_dropdown"><option value="">Select Product</option></select></td>' ;
				
			echo '<td id="quantity_'.$td_num.'"><input type="text" id="product_quantity'.$td_num.'"  name="product_quantity[]" value="" class="product_quantity" number="'.$td_num.'" /></td>' ;
			echo '<td id="unit_price_'.$td_num.'">0.00</td>' ;
			echo '<td id="total_price_'.$td_num.'">0.00</td>' ;
			echo '<td id="action_'.$td_num.'"><a id="'.$td_num.'" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="'. base_url("img/icons/packs/fugue/16x16/cross-script.png").'" /></a></td>' ;
			echo '</tr>' ;
			
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
					echo '<select id="products'.$number.'" name="products[]" class="products_dropdown" number="'.$number.'">' ;
					echo '<option value="">Select Product</option>' ;
					foreach($products as $rec):
						$val = $rec->product_id."|" ;
						if($rec->new_product_price != "") $val = $val.$rec->new_product_price ;
						else $val = $val.$rec->product_price ;
						echo '<option value="'.$val.'">'.$rec->product_name.'</option>' ;
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
}

?>