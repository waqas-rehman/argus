<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		
		if( !($this->session->userdata("admin_logged_in")) )
			redirect(base_url("home")) ;
		
	}
	
	
	
	public function daily_reminder_overdue()
	{
					
			
		 $customer_record["customer_rec"] =  $this->model2->get_customer_invoice();
		
	
		$attribute1 = array("id","company_name","contact_person_name","telephone_number","balance", "email_address", "overdue_days") ;
		$attribute2 = array("invoice_date") ;
		
		$cond2["user_type"] = "customer" ;
 		
		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "id", "customer_id", "customers", "orders",  "customers.creation_date", "DESC") ;
		
		
		
		/*
			foreach ($customer_record["customer_rec"] as $records):
					
			 $balance = $records->balance ."<br />";
			 $contact_person = $records->contact_person_name."<br />";
			  $email_address = $records->email_address."<br />";
			 $overdue_days = $records->overdue_days."<br />";
			 $invoice_date = $records->invoice_date."<br />";
			 
						 
			  
			  endforeach ;
					*/
			//		foreach ($data["customers_rec"] as $records){
			 //echo $records->invoice_date ; echo "<br />" ; } 
				//exit ; 
				
				
			 //foreach ($customers as $records){
			 //$records->balance ; echo "<br />" ; } 
				
				//$customers->balance;
				
			 
			
			
	//function date_func($invoice_date, $overdue_days){
	
		foreach ($customer_record["customer_rec"] as $records):
		
			
			$difference = date_func2($records->invoice_date, $records->overdue_days);
		 
		 
		if($difference > 0)
		 
		 $email_data["difference"] = $difference;
			
			
	//}
			// email started.
				
					
				
					
					//$email_data["client_name"] = $customer_record["customer_rec"]->company_name;
					$email_data["contact_person_name"] = $records->contact_person_name;
					$email_data["invoice_date"] = $records->invoice_date;
				    $email_adress["email_address"] = $records->email_address;			
					
					
					
					$email_data["view"] = "email_templates/email_daily_reminder" ;
					$this->load->view("template/body", $email_data) ;
					
					$email_message = $this->load->view("email_templates/email_daily_reminder", $email_data, TRUE) ;
					
					send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Your Account is overdue", $email_message, 0) ;
					
			endforeach;		 
			
			// email ended..

	
}

public function monthly_email_customers()
	{
					
			
		$customer_record["customer_rec"] =  $this->model2->get_customer_invoice();
		
	
		$attribute1 = array("id","company_name","contact_person_name","telephone_number","balance", "email_address", "overdue_days") ;
		$attribute2 = array("invoice_date") ;
		
		$cond2["user_type"] = "customer" ;
 		
		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "id", "customer_id", "customers", "orders",  "customers.creation_date", "DESC") ;
		
		
		
		
			//foreach ($customer_record["customer_rec"] as $records):
					
			 //$balance = $records->balance ."<br />";
			 //$contact_person = $records->contact_person_name."<br />";
			 // $email_address = $records->email_address."<br />";
		//	 $overdue_days = $records->overdue_days."<br />";
			// $invoice_date = $records->invoice_date."<br />";
			 
						 
			  
			//  endforeach ;
					
			//		foreach ($data["customers_rec"] as $records){
			 //echo $records->invoice_date ; echo "<br />" ; } 
				//exit ; 
				
				
			 //foreach ($customers as $records){
			 //$records->balance ; echo "<br />" ; } 
				
				//$customers->balance;
				
			 
			
			
	//function date_func($invoice_date, $overdue_days){
	
		foreach ($customer_record["customer_rec"] as $records):
		
		$difference = date_func2($records->invoice_date, $records->overdue_days);
		  
		
		if($difference < 0 ) {
		 $email_data["difference"] = $difference;
			
			
	//}
			// email started.
				
					
				
					
					//$email_data["client_name"] = $customer_record["customer_rec"]->company_name;
					$email_data["contact_person_name"] = $records->contact_person_name;
					$email_data["invoice_date"] = $records->invoice_date;
					$email_data["account_balance"] = $records->balance;
				    $email_adress["email_address"] = $records->email_address;			
					
					
					
					$email_data["view"] = "email_templates/monthly_customer_email" ;
					$this->load->view("template/body", $email_data) ;
					
					$email_message = $this->load->view("email_templates/monthly_customer_email", $email_data, TRUE) ;
					
					send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Monthly Report", $email_message,0) ;
					}
					
					
					if($diff == 0 ) {
		 $email_data["difference"] = $diff;
			
			
	//}
			// email started.
				
					
				
					
					//$email_data["client_name"] = $customer_record["customer_rec"]->company_name;
					$email_data["contact_person_name"] = $records->contact_person_name;
					$email_data["invoice_date"] = $records->invoice_date;
					$email_data["account_balance"] = $records->balance;
				    $email_adress["email_address"] = $records->email_address;			
					$email_data["differen"] = "After 1 day your owes amount will be overdue.";
					
					
					$email_data["view"] = "email_templates/monthly_customer_email" ;
					$this->load->view("template/body", $email_data) ;
					
					$email_message = $this->load->view("email_templates/monthly_customer_email", $email_data, TRUE) ;
					
					send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Monthly Report", $email_message,0) ;
					}
			endforeach;		 
			
			// email ended..

public function date_func2($invoice_date, $overdue_days)
	{
		 $overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day"))."<br />" ;
		//$overdue_date = "2012-11-01";
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		
		return $diff;
	}

	
}



?>