<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returns extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{ 
		$data["return_recs"] = $this->model1->get_all("returns") ;
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "returns/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function view_return_details($rec_id, $msg = 0)
	{
		if($rec_id)
		{
			$cond1["id"] = $rec_id ;
			$data["return_rec"] = $this->model1->get_one($cond1, "returns") ;
			
			$cond2["returns_id"] = $rec_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "returns_records") ;
			$data["total_products"] = $this->model1->count_rec_cond($cond2, "returns_records") ;
			
			$cond3["status"] = "Active" ;
			$data["product_groups"] = $this->model1->get_all_cond($cond3, "product_groups") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "returns/view_return" ;
			$this->load->view('template/body', $data);
		}
	}
	
	public function edit_returns($rec_id, $msg = 0)
	{
		if($rec_id)
		{
			$cond1["id"] = $rec_id ;
			$data["return_rec"] = $this->model1->get_one($cond1, "returns") ;
			
			$cond2["returns_id"] = $rec_id ;
			$data["products_rec"] = $this->model1->get_all_cond($cond2, "returns_records") ;
			$data["total_products"] = $this->model1->count_rec_cond($cond2, "returns_records") ;
			
			$cond3["status"] = "Active" ;
			$data["product_groups"] = $this->model1->get_all_cond($cond3, "product_groups") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "returns/return_details" ;
			$this->load->view('template/body', $data);
		}
		else
			redirect(base_url("returns")) ;
	}
	
	public function update_return()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("status", "Status", "required") ;
			$this->form_validation->set_rules("rma_number", "RMA Number", "required") ;
			$this->form_validation->set_rules("customer_representative", "Customer Representative", "required") ;
			$this->form_validation->set_rules("credit_required", "Credit Required", "required") ;
			$this->form_validation->set_rules("repair_required", "Repair Required", "required") ;
			
			$this->form_validation->set_rules("invoice_number", "Invoice Number to Credit Against", "required") ;
			$this->form_validation->set_rules("report_required", "Report Required", "required") ;
			$this->form_validation->set_rules("site_address", "Site Address", "required") ;
			$this->form_validation->set_rules("installation_details", "Installation Details", "required") ;
			
			//$this->form_validation->set_rules("product_details", "List of products being returned and their individual date codes", "required") ;
			$this->form_validation->set_rules("environmental_conditions", "Description of Faults and Environmental Conditions", "required") ;
			$this->form_validation->set_rules("installation_date", "Date of Installation", "required") ;
			$this->form_validation->set_rules("last_maintaince_date", "Date of Last Maintaince", "required") ;
			
			$this->form_validation->set_rules("additional_description", "Additional Description", "required") ;
			
			if($this->form_validation->run() == FALSE)
			{
				$data["msg"] = 1 ;
				
				$cond2["returns_id"] = $rec_id ;
				$data["products_rec"] = $this->model1->get_all_cond($cond2, "returns_records") ;
				$data["total_products"] = $this->model1->count_rec_cond($cond2, "returns_records") ;
				
				$cond3["status"] = "Active" ;
				$data["product_groups"] = $this->model1->get_all_cond($cond3, "product_groups") ;
				$data["session_data"] = $this->session_data("") ;
				$data["view"] = "returns/return_details" ;
				$this->load->view('template/body', $data);
			}
			
			else
			{
				$param1["rma_number"] = mysql_real_escape_string($this->input->post("rma_number")) ;
				$param1["customer_representative"] = mysql_real_escape_string($this->input->post("customer_representative")) ;
				$param1["credit_required"] = mysql_real_escape_string($this->input->post("credit_required")) ;
				$param1["repair_required"] = mysql_real_escape_string($this->input->post("repair_required")) ;
				
				$param1["invoice_number"] = mysql_real_escape_string($this->input->post("invoice_number")) ;
				$param1["report_required"] = mysql_real_escape_string($this->input->post("report_required")) ;
				$param1["site_address"] = mysql_real_escape_string($this->input->post("site_address")) ;
				$param1["installation_details"] = mysql_real_escape_string($this->input->post("installation_details")) ;
				
				//$param1["product_details"] = mysql_real_escape_string($this->input->post("product_details")) ;
				$param1["environmental_conditions"] = mysql_real_escape_string($this->input->post("environmental_conditions")) ;
				$param1["installation_date"] = mysql_real_escape_string(date("Y-m-d", strtotime($this->input->post("installation_date")))) ; 
				$param1["last_maintaince_date"] = mysql_real_escape_string(date("Y-m-d", strtotime($this->input->post("last_maintaince_date")))) ;
				
				$param1["additional_description"] = mysql_real_escape_string($this->input->post("additional_description")) ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
				
				$cond1["id"] = $this->input->post("return_id") ;
				$cond1["customer_id"] = $this->input->post("customer_id") ;
				$return_id = $cond1["id"] ;
				$rec_id = $this->model1->update_rec($param1, $cond1, "returns") ;
				
				if($rec_id)
				{
					$ids = mysql_real_escape_string($this->input->post("current_tr")) ; 
					$num_of_records = mysql_real_escape_string($this->input->post("current_num")) ;
					
					$product_group = $this->input->post("product_group") ;
					$products = $this->input->post("products") ;
					$product_quantity = $this->input->post("product_quantity") ;
					$date_code = $this->input->post("date_code") ;
					
					$condxx["returns_id"] = $return_id ;
					$success1 = $this->model1->delete_rec($condxx, "returns_records") ;
					
					if($num_of_records > 0)
					{
						if($products)
						{
							$i = 0 ;
							$arr = array() ;
							foreach($products as $rec => $val):
								$arr = explode("|", $val) ;
								
								$gr_pr_rec = $this->model2->get_group_product_name($product_group[$i], intval($arr[0])) ;
								
								$param11["returns_id"] = $return_id ;
								
								$param11["group_id"] = $product_group[$i] ;
								$param11["group_name"] = $gr_pr_rec->group_name ;
								
								$param11["product_id"] = $arr[0] ;
								$param11["product_name"] = $gr_pr_rec->product_name ;
								$param11["product_quantity"] = intval($product_quantity[$i]) ;
								$param11["date_code"] = $date_code[$i] ;
								
								if($param11["product_quantity"] > 0) $order_rec = $this->model1->insert_rec($param11, "returns_records") ;
								
								$i = $i + 1 ;
							endforeach ;
						}
					}
					redirect(base_url("returns/edit_returns/".$cond1['id']."/3")) ;
				}
				else redirect(base_url("returns/edit_returns/".$cond1['id']."/4")) ;
			}
		} else
			redirect(base_url("returns")) ;
	}
	
	public function remove_return($rec_id)
	{
		if($rec_id)
		{
			$cond["id"] = $rec_id ;
			$success = $this->model1->delete_rec($cond, "returns") ;
			if($success) redirect(base_url("returns/index/4")) ;
			else  redirect(base_url("returns/index/5")) ;
		}
		else
			redirect(base_url("returns")) ;
	}
	
	private function get_session_data()
	{
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
				
			//echo '<td id="quantity_'.$td_num.'"><input type="text" id="product_quantity'.$td_num.'"  name="product_quantity[]" value="" class="product_quantity" number="'.$td_num.'" /></td>' ;
			
			echo '<td id="quantity_'.$td_num.'"><input style="height:13px;" type="text" id="product_quantity'.$td_num.'"  name="product_quantity[]" value="" class="product_quantity" number="'.$td_num.'" /></td>' ;
			
			echo '<td id="datecode_'.$td_num.'"><input style="height:13px;" type="text" id="date_code'.$td_num.'"  name="date_code[]" value="" number="'.$td_num.'" /></td>' ;
			echo '<td id="action_'.$td_num.'"><a id="'.$td_num.'" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="'. base_url("img/icons/packs/fugue/16x16/cross-script.png").'" /></a></td>' ;
			echo '</tr>' ;
			
		} else
			redirect(base_url("orders")) ;
	}
}

?>