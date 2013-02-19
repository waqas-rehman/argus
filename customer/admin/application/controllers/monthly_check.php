<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monthly_check extends CI_Controller
{
	public function __construct()
	{
		parent::__construct() ;
		//if( !($this->session->userdata("admin_logged_in")) )
			//redirect(base_url("home")) ;
	}
	
	public function daily_reminder_overdue()
	{
		$customer_record["customer_rec"] =  $this->model2->get_customer_invoice1() ;
		
		$attribute1 = array("id","company_name","contact_person_name","telephone_number","balance", "email_address", "account_email", "overdue_days", "registration_email_sent") ;
		$attribute2 = array("invoice_date") ;
		
		$cond2["user_type"] = "customer" ;
 		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "id", "customer_id", "customers", "orders",  "customers.creation_date", "DESC") ;
		
		if($customer_record["customer_rec"])
		{
			foreach ($customer_record["customer_rec"] as $records):
				$overdue_date =  date("Y-m-d", strtotime($records->invoice_date . "+".(intval($records->overdue_days))." day"))."<br />" ;
				$difference = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ;
				
				$cond1["id"] = $records->id;
				if($difference > 0)
				{
					$param1["outstanding_date"] = date("Y-m-d G:i:s") ;
					$param1["status"] = 'Outstanding';
					$rec_id = $this->model1->update_rec($param1, $cond1, "orders") ;
				
					$email_data["difference"] = $difference;
					
					$email_data["contact_person_name"] = $records->contact_person_name;
					
					$email_data["invoice_date"] = $records->invoice_date;
					$email_adress["email_address"] = create_email_address($records->email_address,$records->account_email) ;
					$email_message = $this->load->view("email_templates/email_daily_reminder", $email_data, TRUE) ;//
					if($records->registration_email_sent == "Yes")
						send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Reminder: Your Account is Overdue", $email_message, 0) ;
				}
			endforeach ;
		}
	}
	
	public function monthly_email_customers()
	{
		$customer_record["customer_rec"] =  $this->model2->get_customer_invoice();
		$attribute1 = array("id","company_name","contact_person_name","telephone_number","balance", "email_address", "account_email", "overdue_days") ;
		$attribute2 = array("invoice_date") ;
		$cond2["user_type"] = "customer" ;
 		$data["customers"] = $this->model1->inner_join_orderby_limit($attribute1, $attribute2, 0, 0, "id", "customer_id", "customers", "orders",  "customers.creation_date", "DESC") ;
		
		foreach ($customer_record["customer_rec"] as $records):
		
			$difference = $this->date_func2($records->invoice_date, $records->overdue_days);
			
			if($difference < 0)
			{
				$email_data["difference"] = $difference;
				$email_data["contact_person_name"] = $records->contact_person_name;
				$email_data["invoice_date"] = $records->invoice_date;
				$email_data["account_balance"] = $records->balance;
			    $email_adress["email_address"] = create_email_address($records->email_address, $records->account_email) ;			
				//$email_data["view"] = "email_templates/monthly_customer_email" ;
				
				$email_message = $this->load->view("email_templates/monthly_customer_email", $email_data, TRUE) ;
				//$this->load->view("email_templates/monthly_customer_email", $email_data) ;
				if($records->registration_email_sent == "Yes")
					send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Monthly Report", $email_message,0) ;
			}
			
			if($difference == 0)
			{
				$email_data["difference"] = "After 1 day your owes amount will be overdue.";
				$email_data["contact_person_name"] = $records->contact_person_name;
				$email_data["invoice_date"] = $records->invoice_date;
				$email_data["account_balance"] = $records->balance;
			    $email_adress["email_address"] = create_email_address($records->email_address, $records->account_email) ;			
				//$email_data["view"] = "email_templates/monthly_customer_email" ;
				
				$email_message = $this->load->view("email_templates/monthly_customer_email", $email_data, TRUE) ;
				//$this->load->view("email_templates/monthly_customer_email", $email_data) ;
				if($records->registration_email_sent == "Yes")
					send_email_message("Argus Distribution",$email_adress["email_address"], 0, 0, "Monthly Report", $email_message,0) ;
			}
			endforeach;		 
	}
		
	public function date_func2($invoice_date, $overdue_days)
	{
		$overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day"))."<br />" ;
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		return $diff;
	}
}
?>