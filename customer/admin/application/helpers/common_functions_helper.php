<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('date_difference'))
{
	function date_difference($date1, $date2)
	{	
		//echo $date3 = date("Y-m-d", strtotime($date1));
		//echo $date4 = date("Y-m-d", strtotime($date2));
		$date11 = date("Y-m-d", strtotime($date1)) ;
		//echo $date4 = date("Y/m/d", strtotime($date2));
		$date21 = date("Y-m-d", strtotime($date2)) ;
		
		echo $date11." ".$date21 ;
		exit;
	 // $date2 = "2012-11-14";
	//$date1 = "2012-11-26";
	$diff = abs(strtotime($date21) - strtotime($date11));
	echo $diff;
	
	return floor($diff / (60*60*24));
		
		//return floor($diff / (60*60*24)) ;
		
	}
}
if ( ! function_exists('generatePassword'))
{

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
}
if ( ! function_exists('test_function'))
{
	function test_function()
	{
		echo "asdasdasd";
		exit ;
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

if ( ! function_exists('create_email_address'))
{
	function create_email_address($email1, $email2)
	{
		if($email2 != "") return $email1.", ".$email2 ;
    	else return $email1 ;
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
	}
	
	if ( ! function_exists('send_email_message_invoicefile'))
{
	function send_email_message_invoicefile($title, $to, $cc, $bcc, $subject, $message, $attachment)
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
		if($attachment) $CI_2->email->attach("./order_invoices/".$attachment) ;
		
		$CI_2->email->subject($subject) ;
		$CI_2->email->message($message) ;
		
		if($CI_2->email->send()) return true ;
		else return false ;
	}

}
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
/**/

if ( ! function_exists('post_function'))
{
	function post_function($form_elements)
	{
		$CI =& get_instance() ;
		
		if(is_array($form_elements))
		{
			if($form_elements)
			{
				foreach($form_elements as $rec => $val):
					$param1[$rec] = mysql_real_escape_string($CI->input->post($val)) ;
				endforeach ;
			}
			return $param1 ;
		}
		else
			return mysql_real_escape_string($CI->input->post($form_elements)) ;
	}
}

if ( ! function_exists('form_validation_function'))
{
	function form_validation_function($form_elements)
	{
		$CI =& get_instance() ;
		$CI->load->library("form_validation") ;
		
		$CI->form_validation->set_error_delimiters("<li>", "</li>") ;
		
		foreach($form_elements as $rec => $val):
			$res = explode("&", $val);
			$CI->form_validation->set_rules($rec, $res[0], $res[1]) ;
		endforeach ;
	
		if ($CI->form_validation->run() == FALSE)
			return FALSE ;
		else
			return TRUE ;
	}
}


if( ! function_exists('upload_file'))
{
	function upload_file($file_name, $file_destination)
	{
		$CI1 =& get_instance() ;
		$CI1->load->library('upload') ;
		
		$config['upload_path'] = "./".$file_destination."/" ;
		$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt" ;
		$config['max_size']	= '10240' ;
		$config['encrypt_name']	= TRUE ;
		$config['remove_spaces']	= TRUE ;
		
		$CI1->upload->initialize($config) ;
		
		$response = array() ;
			
		if (!($CI1->upload->do_upload($file_name)))
		{
			$response["result"] = false ;
			$CI1->upload->display_errors('<li>', '</li>') ;
			$response["errors"] = $CI1->upload->display_errors() ;
		}
		else
		{
			$file_data = $CI1->upload->data() ;
			$response["result"] = true ;
			$response["encripted_file_name"] = $file_data["file_name"] ; 
			$response["original_file_name"] = $file_data["orig_name"] ;
			$response["file_extention"] = $file_data["file_ext"] ;
		}
		
		return $response ;
	}
}

if( ! function_exists('upload_image'))
{
	function upload_image($file_name, $file_destination)
	{
		$CI1 =& get_instance() ;
		$CI1->load->library('upload') ;
		
		$config['upload_path'] = "./".$file_destination."/" ;
		$config['allowed_types'] = "gif|jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt" ;
		$config['max_size']	= '10240' ;
		$config['encrypt_name']	= TRUE ;
		$config['remove_spaces']	= TRUE ;
		
		$CI1->upload->initialize($config) ;
		
		$response = array() ;
			
		if (!($CI1->upload->do_upload($file_name)))
		{
			$response["result"] = false ;
			$CI1->upload->display_errors('<li>', '</li>') ;
			$response["errors"] = $CI1->upload->display_errors() ;
		}
		else
		{
			$file_data = $CI1->upload->data() ;
			$response["result"] = true ;
			$response["encripted_file_name"] = $file_data["file_name"] ; 
			$response["original_file_name"] = $file_data["orig_name"] ;
			$response["file_extention"] = $file_data["file_ext"] ;
		}
		
		return $response ;
	}
}