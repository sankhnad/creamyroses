<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('sendEmail')){
    function sendEmail($data,$emailConfig){
		$CI =& get_instance();   		
		$CI->load->model('common_model');
		$CI->load->helper('form'); 
		$CI->load->library('email');
		$CI->load->helper('path');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html'; // Append This Line
		$CI->email->initialize($config);	
		
		$subject 	 = isset($emailConfig['subject']) 	  ? $emailConfig['subject'] 	: 'logo.png';
		$message 	 = isset($emailConfig['message']) 	  ? $emailConfig['message'] 	: 'logo.png';
		$to_email 	 = isset($emailConfig['to_email'])	  ? $emailConfig['to_email']	: 'logo.png';
		$from_name 	 = isset($emailConfig['from_name'])   ? $emailConfig['from_name']	: 'logo.png';
		$from_email  = isset($emailConfig['from_email'])  ? $emailConfig['from_email'] 	: 'logo.png';
		$upload_file = isset($emailConfig['upload_file']) ? $emailConfig['upload_file'] : '';
		$upload_path = isset($emailConfig['upload_path']) ? $emailConfig['upload_path']	: 'uploads/';
		
		switch ($data['case']){
            case 'registration':
                include(APPPATH.'email/register.php');
                break;
            case 1:
                $case;
                break;
            case 2:
                $case;
                break;
            default:
                return false;
        }
		
		if($upload_file){
			$path = set_realpath($upload_path);
			$CI->email->attach($path . $upload_file);
		}
		
		$CI->email->from($from_email, $from_name); 
		$CI->email->to($to_email);
		$CI->email->subject($subject); 
		$CI->email->message($message); 
   
         //Send mail 
         if($CI->email->send())
		 {
			 return true;
		 }else{
			 return false;
		 }
    }
}

?>