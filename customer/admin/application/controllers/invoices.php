<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller
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
		$cond1["status"] = "Invoiced" ;
		$data["invoices"] = $this->model1->get_all_cond($cond1, "orders") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "invoices/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function payments($msg = 0)
	{
		$cond1["type"] = "order" ;
		$cond1["status"] = "invoiced" ;
		$data["invoices"] = $this->model1->get_all_cond($cond1, "orders") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "invoices/payments" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function transaction($order_id, $msg = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			$data["due_amount"] = get_due_amount($data["order_rec"]->id, $data["order_rec"]->customer_id) ;
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "invoices/transaction" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect(base_url("invoices")) ;
	}
	
	public function update_transaction()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("transaction_amount", "Transaction Amount", "required|decimal") ;
			$this->form_validation->set_rules("transaction_type", "Transaction Type", "required|") ;
			$this->form_validation->set_rules("", "", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
			
				$cond1["id"] = $this->input->post("order_id")  ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
				$data["due_amount"] = get_due_amount($data["order_rec"]->id, $data["order_rec"]->customer_id) ;
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "invoices/transaction" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["order_id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				$param1["customer_id"] = mysql_real_escape_string($this->input->post("customer_id")) ;
				$param1["transaction_amount"] = floatval(mysql_real_escape_string($this->input->post("transaction_amount"))) ;
				$param1["transaction_type"] = mysql_real_escape_string($this->input->post("transaction_type")) ;
				$param1["timestamp"] = date("Y-m-d G:i:s") ;
				
				$rec_id = $this->model1->insert_rec($param1, "transactions") ;
				
				$cond2["id"] = $param1["order_id"] ;
				$order_rec = $this->model1->get_one($cond2, "orders") ;
				
				$cond3["id"] = $param1["customer_id"] ;
				$customer_rec = $this->model1->get_one($cond3, "customers") ;
				
				if($param1["transaction_type"] == "Credit_Note" || $param1["transaction_type"] == "Payment")
				{
					$param3["balance"] = floatval($customer_rec->balance) + $param1["transaction_amount"] ; 
					$this->model1->update_rec($param3, $cond3, "customers") ;
					
					$net = get_due_amount($order_rec->id, $order_rec->customer_id) ;
					
					if($net <= 0)
					{
						$param11["status"] = "Completed" ;
						$param11["compeletion_date"] = date("Y-m-d G:i:s") ;
						$this->model1->update_rec($param11, $cond2, "orders") ;
					}
					
				} else {
					
					$param3["balance"] = floatval($customer_rec->balance) - $param1["transaction_amount"] ; 
					$this->model1->update_rec($param3, $cond3, "customers") ;
				}
				
				if($rec_id)
					redirect(base_url("invoices/transaction/".$param1["order_id"]."/10" )) ;
				else
					redirect(base_url("invoices/transaction/".$param1["order_id"]."/5" )) ;
			}
		} else
			redirect(base_url("orders")) ;
	}
	
	public function upload_invoice($order_id = 0, $msg = 0)
	{
		if($order_id)
		{
			$cond1["id"] = $order_id ;
			$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
			
			$data["file_ext"] = "" ;
				
			if($data["order_rec"]->invoice != "") $data["file_ext"] = $this->get_file_extention($data["order_rec"]->id) ;

			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "invoices/upload_invoice" ;
			$this->load->view("template/body", $data) ;	
		}
		else
			redirect(base_url("invoices")) ;
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
		
		if($success) return true ;
	}
	
	public function upload_order_invoice()
	{
		if($_POST)
		{
			
			$config['upload_path'] =  "./order_invoices/" ;
			$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt";
			$config['max_size']	= '10240';
			$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;
			
			$this->load->library('upload', $config);
			
			
	
			$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ;
			
			if (!($this->upload->do_upload("order_invoice")))
			{
				$this->upload->display_errors('<li>', '</li>');
				$data["errors"] = $this->upload->display_errors() ;
				$data["msg"] = 3 ; 
				
				$data["order_id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ; ;
				$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
				
				$data["file_ext"] = "" ;
				
				if($data["order_rec"]->invoice != "")
					$data["file_ext"] = $this->get_file_extention(mysql_real_escape_string($this->input->post("order_id"))) ;
				
				$cond2["id"] = $data["order_rec"]->customer_id ;
				$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
				
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "invoices/upload_invoice" ;
				$this->load->view("template/body", $data) ;	
			}
			else
			{
				$data["file_data"] = $this->upload->data() ;
				if($this->delete_order_file($cond1["id"]))
				{
					$param1["invoice"] = $data["file_data"]["file_name"] ;
					$this->model1->update_rec($param1, $cond1, "orders") ;
					$data["msg"] = 4 ;
					
				//email
					$data["order_id"] = mysql_real_escape_string($this->input->post("order_id")) ;
				
					$cond1["id"] = mysql_real_escape_string($this->input->post("order_id")) ; ;
					$data["order_rec"] = $this->model1->get_one($cond1, "orders") ;
					$cond2["id"] = $data["order_rec"]->customer_id ;
					$data["customer_rec"] = $this->model1->get_one($cond2, "customers") ;
				
			
				    $param3["email_address"] = $data["customer_rec"]->email_address;
					$email_data["contact_person_name"] = $data["customer_rec"]->contact_person_name;
					$email_data["purchase_order_number"] = $data["order_rec"]->purchase_order_number;
				
			
					$email_data["payment_status"] = "Please see the attached invoice for your recent order. PO Number:";
					
					$email_message = $this->load->view("email_templates/email_status_invoiced", $email_data, TRUE) ;
					if($data["customer_rec"]->registration_email_sent == "Yes")
						send_email_message_invoicefile("Argus Distribution", $param3["email_address"], 0, 0, "Order Status: Invoiced", $email_message, $param1["invoice"]) ;
				
				//end email
	
					redirect(base_url("invoices/upload_invoice/".$cond1["id"]."/13")) ;
				
				}
				else
				{
					$param1["invoice"] = "" ;
					$this->model1->update_rec($param1, $cond1, "orders") ;
					$data["msg"] = 5 ;
				}
				
			}
		}
		else
			redirect(base_url("invoices")) ;
	}
	
	private function get_session_data()
	{
	}

	private function get_file_extention($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$order_rec = $this->model1->get_one($cond1, "orders") ;
		
		$file = array() ;
		$file = explode(".", $order_rec->invoice) ;
		return $file[1] ;
	}
	
	private function delete_order_file($order_id = 0)
	{
		$cond1["id"] = $order_id ;
		$order_rec = $this->model1->get_one($cond1, "orders") ;
		if($order_rec->invoice != "")
		{
			$result = unlink("./order_invoices/".$order_rec->invoice);
	 
			if($result)
			{
				$param1["invoice"] = "" ;
				$this->model1->update_rec($param1, $cond1, "orders") ;
				return true ;
			}
			else
				return false ;
		} else
			return true ;
	}
	
	public function download_manual($order_id = 0, $return = "upload_invoice")
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
			
			if($return == "upload_invoice") redirect(base_url("invoices/upload_invoice/".$order_id)) ;
			else redirect(base_url("invoices")) ;
		} else
			redirect(base_url("orders")) ;
	}
	
	public function remove_order_invoice($order_id = 0, $return = "upload_invoice")
	{
		if($order_id)
		{
			$success = $this->delete_order_file($order_id) ; 
			if($success)
			{
				if($return == "upload_invoices")
					redirect(base_url("invoices/upload_invoice/".$order_id)) ;
				else
					redirect(base_url("invoices")) ;
			}
			
		} else
			redirect(base_url("invoices")) ;
	}
	
	public function get_outstanding_date()
	{
		if($_POST)
		{
			$invoice_date = post_function("invoice_date") ;
			$customer_id = post_function("customer_id") ;
			 
			$cond1["id"] = $customer_id ;
			$customer_rec = $this->model1->get_one($cond1, "customers") ;
			
			$new_date = date('d/m/Y', strtotime($invoice_date. ' + '.intval($customer_rec->overdue_days).' days')) ;
			
			echo $new_date ;
		}
		else echo "fail" ; 
		exit ;
	}
}
?>