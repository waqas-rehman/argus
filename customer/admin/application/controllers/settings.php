<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
	}
	
	public function index()
	{
		redirect(base_url("dashboard")) ;
	}
	
	public function vat_rates($msg = 0)
	{
		$data["msg"] = $msg ;
		$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
		$data["session_data"] = $this->session_data() ;
		$data["view"] = "configurations/vat_rates" ;
		$this->load->view("template/body", $data) ;
	}
	
	public function add_vat_code()
	{
		if($_POST)
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>') ;
			
			$this->form_validation->set_rules("vat_code", "VAT Code", "required") ;
			$this->form_validation->set_rules("vat_rate", "VAT Rate", "required|decimal|less_than[100]") ;
			$this->form_validation->set_rules('vat_code_status', 'Status', 'required') ;
	
			if ($this->form_validation->run() == FALSE) {
			
				$data["msg"] = 5 ;
				
			} else {
				
				$param1["vat_code"] = mysql_real_escape_string($this->input->post("vat_code")) ;
				$param1["vat_rate"] = mysql_real_escape_string($this->input->post("vat_rate")) ;
				$param1["status"] = mysql_real_escape_string($this->input->post("vat_code_status")) ;
				
				$res1 = $this->model1->insert_rec($param1, "vat_codes") ;
				
				if($res1) $data["msg"] = 1 ;
				else $data["msg"] = 6 ;
			}
			
			$data["vat_codes"] = $this->model1->get_all("vat_codes") ;
			$data["session_data"] = $this->session_data() ;
			$data["view"] = "configurations/vat_rates" ;
			$this->load->view("template/body", $data) ;
		} else {
			redirect(base_url("settings/vat_rates")) ;
		}
	}
	
	public function remove_vat_rates($rec_id)
	{
		$cond1["id"] = $rec_id ;
		$res1 = $this->model1->delete_rec($cond1, "vat_codes") ;
		
		if($res1) redirect(base_url("settings/vat_rates/2")) ;
		else redirect(base_url("settings/vat_rates/3")) ;
	}
	
	public function session_data()
	{
		$session_data = array() ;
		
		return $session_data ;
	}
}
?>