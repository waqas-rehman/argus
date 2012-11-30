<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index($msg = 0)
	{
		$attribute1 = array("id", "group_id", "product_name", "product_code", "adl_code", "product_price", "product_manual", "creation_date", "update_date", "status") ;
		$attribute2 = array("group_name") ;
		
		$data["products"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "group_id", "id", "products", "product_groups", "products.creation_date", "DESC") ;
		
		$data["msg"] = $msg ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "product/index" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function product_form()
	{
		$data["msg"] = 0 ;
		$data["product_groups"] = $this->model1->get_all("product_groups") ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "product/add_product" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function add_product()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("product_name", "Product Name", "required") ;
			$this->form_validation->set_rules("product_code", "Product Code", "required") ;
			$this->form_validation->set_rules("adl_code", "ADL Code", "required") ;
			$this->form_validation->set_rules("product_price", "Product Price", "required|numeric") ;
			$this->form_validation->set_rules("product_group", "Product Group", "required") ;
			$this->form_validation->set_rules("product_description", "Product Description", "required") ;
			$this->form_validation->set_rules("status", "Status", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
			
				$data["msg"] = 1 ;
				$data["product_groups"] = $this->model1->get_all("product_groups") ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "product/add_product" ;
				$this->load->view("template/body", $data) ;
			
			} else {
			
				$param1["group_id"] = mysql_real_escape_string($this->input->post("product_group")) ;
				$param1["product_name"] = mysql_real_escape_string($this->input->post("product_name")) ;
				$param1["product_code"] = mysql_real_escape_string($this->input->post("product_code")) ;
				$param1["adl_code"] = mysql_real_escape_string($this->input->post("adl_code")) ;
				
				$param1["product_price"] = mysql_real_escape_string($this->input->post("product_price")) ;
				$param1["product_description"] = mysql_real_escape_string($this->input->post("product_description")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
				
				$rec_id = $this->model1->insert_rec($param1, "products") ;
				
				if(($rec_id)) {
					redirect(base_url("product/product_details/".$rec_id."/3")) ;
				} else {
					
					$data["msg"] = 2 ;
					$data["session_data"] = $this->get_session_data() ;
					$data["view"] = "product/add_product" ;
					$this->load->view("template/body", $data) ;
				}
			}
		}
		else
			redirect(base_url("product")) ;
		/**/
	}
	
	public function product_manual($product_id = 0, $msg = 0)
	{
		if($product_id)
		{
			$cond1["id"] = $product_id ;
			$data["product_rec"] = $this->model1->get_one($cond1, "products") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "product/product_manual" ;
			$this->load->view("template/body", $data) ;
			
		} else
			redirect(base_url("product")) ;
	}
	
	public function remove_product_manual($product_id = 0)
	{
		if($product_id)
		{
			$cond1["id"] = $product_id ;
			$product = $this->model1->get_one($cond1, "products") ;
			
			$result = unlink("./product_manuals/".$product->product_manual);
 
			if($result){
				
				$param1["product_manual"] = "" ;
				$this->model1->update_rec($param1, $cond1, "products") ;
				redirect(base_url("product/product_manual/".$product_id."/1")) ;
			
			} else
				redirect(base_url("product/product_manual/".$product_id."/2")) ;
		} else
			redirect(base_url("product")) ;
	}
	
	public function download_manual($product_id, $msg = 0 )
	{
		if($product_id)
		{
			$file_extension = $this->get_file_extention($product_id) ;
			$this->load->helper('download') ;
			$cond1["id"] = $product_id ;
			$product = $this->model1->get_one($cond1, "products") ;
			
			$data = file_get_contents("./product_manuals/".$product->product_manual) ;
			$name = $product->product_name.".".$file_extension ;
	
			force_download($name, $data) ;
			
			redirect(base_url("product/product_manual/".$product_id."/0")) ;
		} else
			redirect(base_url("product")) ;
	}
	
	public function add_product_manual()
	{
		$config['upload_path'] =  "./product_manuals/" ;
		$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt";
		$config['max_size']	= '10240';
		$config['encrypt_name']	= TRUE;
		$config['remove_spaces']	= TRUE;
		
		$this->load->library('upload', $config);

		$cond1["id"] = mysql_real_escape_string($this->input->post("product_id")) ;
		
		if (!($this->upload->do_upload("product_manual")))
		{
			$this->upload->display_errors('<li>', '</li>');
			$data["errors"] = $this->upload->display_errors() ;
			$data["msg"] = 3 ; 
		}
		else
		{
			$data["file_data"] = $this->upload->data() ;
			if($this->delete_product_manual($cond1["id"]))
			{
				$param1["product_manual"] = $data["file_data"]["file_name"] ;
				$this->model1->update_rec($param1, $cond1, "products") ;
				$data["msg"] = 4 ;
			}
			else
			{
				$param1["product_manual"] = "" ;
				$this->model1->update_rec($param1, $cond1, "products") ;
				$data["msg"] = 5 ;
			}
		}
		
		$data["product_rec"] = $this->model1->get_one($cond1, "products") ;
			
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "product/product_manual" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function product_details($product_id = 0, $msg = 0)
	{
		if($product_id)
		{
			$cond1["id"] = $product_id ;
			$data["product_rec"] = $this->model1->get_one($cond1, "products") ;
			
			$cond2["id"] = $data["product_rec"]->group_id ;
			$data["current_product_group"] = $this->model1->get_one($cond2, "product_groups") ;
			
			$data["product_groups"] = $this->model1->get_all("product_groups") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "product/edit_product" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect(base_url("customer")) ;
	}
	
	public function update_product()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("product_name", "Product Name", "required") ;
			$this->form_validation->set_rules("product_code", "Product Code", "required") ;
			$this->form_validation->set_rules("adl_code", "ADL Code", "required") ;
			$this->form_validation->set_rules("product_price", "Product Price", "required|numeric") ;
			$this->form_validation->set_rules("product_group", "Product Group", "required") ;
			$this->form_validation->set_rules("product_description", "Product Description", "required") ;
			$this->form_validation->set_rules("status", "Status", "required") ;
			
			if ($this->form_validation->run() == FALSE) {
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("product_id")) ;
				$data["product_rec"] = $this->model1->get_one($cond1, "products") ;
				
				$cond2["id"] = $data["product_rec"]->group_id ;
				$data["current_product_group"] = $this->model1->get_one($cond2, "product_groups") ;
				
				$data["product_groups"] = $this->model1->get_all("product_groups") ;
				
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "product/edit_product" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["group_id"] = mysql_real_escape_string($this->input->post("product_group")) ;
				$param1["product_name"] = mysql_real_escape_string($this->input->post("product_name")) ;
				$param1["product_code"] = mysql_real_escape_string($this->input->post("product_code")) ;
				$param1["adl_code"] = mysql_real_escape_string($this->input->post("adl_code")) ;
				
				$param1["product_price"] = mysql_real_escape_string($this->input->post("product_price")) ;
				$param1["product_description"] = mysql_real_escape_string($this->input->post("product_description")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("status")) ;
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("product_id")) ; ;
				
				$rec_id = $this->model1->update_rec($param1, $cond1, "products") ;
				
				if($rec_id) redirect(base_url("product/product_details/".$cond1["id"]."/4")) ;
				else redirect(base_url("product/product_details/".$cond1["id"]."/2")) ;
			}
		}
		else
			redirect(base_url("customer")) ;
	}
	
	public function remove_product($product_id = 0)
	{
		if($product_id)
		{
			$cond1["id"] = $product_id ;
			
			$res1 = $this->delete_product_manual($cond1["id"]) ;
			$res2 = $this->model1->delete_rec($cond1, "products") ;
			
			if(($res1) && ($res2))
				redirect(base_url("product/index/1")) ;
			else
				redirect(base_url("product/index/2")) ;
		} else
			redirect(base_url("product")) ;
	}
	
	public function product_group($msg = 0)
	{
		$data["msg"] = $msg ;
		$data["product_groups"] = $this->model1->get_all("product_groups") ;
		$data["session_data"] = $this->get_session_data() ;
		$data["view"] = "product/view_add_product_groups" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function add_product_group()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("group_name", "Product Group Name", "required") ;
			$this->form_validation->set_rules("product_group_status", "Status", "required") ;
	
			if ($this->form_validation->run() == FALSE) {
			
				$data["msg"] = 5 ;
				$data["product_groups"] = $this->model1->get_all("product_groups") ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "product/view_add_product_groups" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["group_name"] = mysql_real_escape_string($this->input->post("group_name")) ;
				$param1["creation_date"] = date("Y-m-d G:i:s") ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("product_group_status")) ;
				
				$rec = $this->model1->insert_rec($param1, "product_groups") ;

				if($rec) redirect(base_url("product/product_group/1")) ;
				else redirect(base_url("product/product_group/6")) ;
			}
		} else
			redirect(base_url("product/product_group")) ;
	}
	
	public function product_group_details($group_id = 0, $msg = 0)
	{
		if($group_id)
		{
			$cond1["id"] = $group_id ;
			$data["product_rec"] = $this->model1->get_one($cond1, "product_groups") ;
			
			$data["msg"] = $msg ;
			$data["session_data"] = $this->get_session_data() ;
			$data["view"] = "product/edit_product_group" ;
			$this->load->view("template/body", $data) ;
		} else
			redirect(base_url("product/product_group")) ;
	}
	
	public function update_group_details()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("group_name", "Product Group Name", "required") ;
			$this->form_validation->set_rules("product_group_status", "Status", "required") ;
	
			if ($this->form_validation->run() == FALSE) {
			
				$cond1["id"] = mysql_real_escape_string($this->input->post("product_group_id")) ;
				$data["product_rec"] = $this->model1->get_one($cond1, "product_groups") ;
			
				$data["msg"] = 1 ;
				$data["session_data"] = $this->get_session_data() ;
				$data["view"] = "product/edit_product_group" ;
				$this->load->view("template/body", $data) ;
			
			} else {
				
				$param1["group_name"] = mysql_real_escape_string($this->input->post("group_name")) ;
				$param1["update_date"] = date("Y-m-d G:i:s") ;
				$param1["status"] = mysql_real_escape_string($this->input->post("product_group_status")) ;
				
				$cond1["id"] = mysql_real_escape_string($this->input->post("product_group_id")) ;
				
				$rec = $this->model1->update_rec($param1, $cond1, "product_groups") ;

				if($rec) redirect(base_url("product/product_group_details/".$cond1["id"]."/3")) ;
				else redirect(base_url("product/product_group_details/".$cond1["id"]."/2")) ;
			}
		} else
			redirect(base_url("product/product_group")) ;
	}
	
	public function remove_product_group($group_id = 0)
	{
		if($group_id)
		{
			$cond2["group_id"] = $group_id ;
			$products = $this->model1->get_all_cond($cond2, "products") ;
			
			if($products)
			{
				foreach($products as $rec):
					$condx["id"] = $rec->id ;
					$res1 = $this->delete_product_manual($condx["id"]) ;
					$res2 = $this->model1->delete_rec($condx, "products") ;	
					if($res1 && $res2) {}
					else break ;
				endforeach ;
			}
			
			$cond1["id"] = $group_id ;
			$res3 = $this->model1->delete_rec($cond1, "product_groups") ;
			
			if($res1 && $res2 && $res3) redirect(base_url("product/product_group/2")) ;
			else redirect(base_url("product/product_group/3")) ;
		} else
			redirect(base_url("product/product_group")) ;
	}
	
	/************* Private Memeber Functions *******************/
	
	private function get_session_data()
	{
		$session_data = array(
					"sad" => $this->session->userdata('email')
				) ;
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
	
	private function delete_product_manual($product_id = 0)
	{
		$cond1["id"] = $product_id ;
		$product = $this->model1->get_one($cond1, "products") ;
		if($product->product_manual != "")
		{
			$result = unlink("./product_manuals/".$product->product_manual);
	 
			if($result)
			{
				$param1["product_manual"] = "" ;
				$this->model1->update_rec($param1, $cond1, "products") ;
				return true ;
			}
			else
				return false ;
		} else
			return true ;
	}
}
?>