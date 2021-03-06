<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('date_difference'))
{
	function date_difference($date1, $date2)
	{
		$diff = strtotime($date2) - strtotime($date1) ;
		return floor($diff / (60*60*24)) ;
	}
}

if ( ! function_exists('get_states'))
{
	function get_states()
	{
		$CI =& get_instance() ;
		$CI->load->model('model1') ;
		$states = $CI->model1->get_all("states") ;
		return $states ;
    }
}

if ( ! function_exists('get_random_string'))
{
	function get_random_string($length = 10)
	{
		$CI =& get_instance() ;
		$CI->load->helper('string') ;
		
		//$this->load->helper('string') ;
		return random_string('alnum', $length) ;
	}
}

if ( ! function_exists('get_root_path'))
{
	function get_root_path($directory)
	{
		$CI =& get_instance() ;
		$CI->load->model('model1') ;
		
		$cond1["id"] = 1 ;
		$rec = $CI->model1->get_one($cond1, "root_paths") ;
		$root_path = $rec->path ;
		
		if($_SERVER['HTTP_HOST'] == 'localhost')
		{
			$uploaddir = $_SERVER["DOCUMENT_ROOT"]."te".$root_path.$directory."/" ;
		}
		else
		{
			$uploaddir = $_SERVER["DOCUMENT_ROOT"].$root_path.$directory."/" ;
		}
		
		return $uploaddir ;
    }
}

if ( ! function_exists('get_image_path'))
{
	function get_image_path($directory)
	{
		$CI =& get_instance() ;
		$CI->load->model('model1') ;
		
		$cond1["id"] = 1 ;
		$rec = $CI->model1->get_one($cond1, "root_paths") ;
		$root_path = $rec->path ;
		
		$uploaddir = base_url().$root_path.$directory."/" ;
		return $uploaddir ;
    }
}

if ( ! function_exists('send_email_message'))
{
	function send_email_message($title, $to, $cc, $bcc, $subject, $message, $attachment)
	{
		$CI_1 =& get_instance() ;
		$CI_1->load->model('model1') ;
		
		$email_cond["id"] = 1 ;
		$email_rec = $CI_1->model1->get_one($email_cond, "email_config") ;
		
		$config = array() ;
		
		if($email_rec->protocol != "") $config['protocol'] = $email_rec->protocol ;
		if($email_rec->smtp_host != "") $config['smtp_host'] = $email_rec->smtp_host ;
		if($email_rec->smtp_port != "") $config['smtp_port'] = intval($email_rec->smtp_port) ;
		if($email_rec->smtp_user != "") $config['smtp_user'] = $email_rec->smtp_user ;
		
		if($email_rec->smtp_pass != "") $config['smtp_pass'] = $email_rec->smtp_pass ;
		if($email_rec->mailtype != "") $config['mailtype'] = $email_rec->mailtype ;
		if($email_rec->smtp_user != "") $config['smtp_user'] = $email_rec->smtp_user ;
		
		$CI_2 =& get_instance() ;

		$CI_2->load->library('email', $config);
		$CI_2->email->set_newline("\r\n") ;
		
		$CI_2->email->from($config['smtp_user'], $title) ;
		$CI_2->email->to($to) ;
		
		if($cc) $CI_2->email->cc($cc) ;
		if($bcc) $CI_2->email->bcc($bcc) ;
		if($attachment) $CI_2->email->attach("./email_attachments/".$attachment) ;
		
		$CI_2->email->subject($subject) ;
		$CI_2->email->message($message) ;
		
		if($CI_2->email->send()) return true ;
		else return false ;
	}
} /**/

if ( ! function_exists('get_date_diff'))
{
	function get_date_diff($date1, $date2)
	{
		$CI =& get_instance() ;
		$CI->load->model('model1') ;
		
		$date_diff = $CI->model2->get_date_diff($date1, $date2) ;
	if($date_diff){
	
	return intval($date_diff->DiffDate) ;
	} else return 0 ;
   }
}

if ( ! function_exists('get_due_amount'))
{
	function get_due_amount($order_id, $customer_id)
	{
		$CI =& get_instance() ;
		$CI->load->model('model1') ;
		
		$cond1["id"] = $order_id ;
		$order = $CI->model1->get_one($cond1, "orders") ;
		
		$net = floatval($order->invoice_amount) ;
		
		$cond2["order_id"] = $order_id ;
		$cond2["customer_id"] = $customer_id ;
		$order_recs = $CI->model1->get_all_cond($cond2, "transactions") ;
		
		if($order_recs){
			foreach($order_recs as $rec):
				if($rec->transaction_type == "Credit_Note")
					$net = $net - floatval($rec->transaction_amount) ;
				elseif($rec->transaction_type == "Payment")
					$net = $net - floatval($rec->transaction_amount) ;
				elseif($rec->transaction_type == "Add_Back")
					$net = $net + floatval($rec->transaction_amount) ;
			endforeach ;
		}
		
		return $net ;
    }
}

if ( ! function_exists('get_decimal_number_format'))
{
	function get_decimal_number_format($number)
	{
		return number_format($number, 2, '.', '');
    }
}

if ( ! function_exists('create_email_address'))
{
	function create_email_address($email1, $email2)
	{
		if($email2 != "") return $email1.", ".$email2 ;
    	else return $email1 ;
	}
}
