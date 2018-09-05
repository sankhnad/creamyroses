<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('sendSMS')) {
    function sendSMS($data) {
        $CI = & get_instance();	
				
		$message = generateMsgText($data);
		$number = $data['number'];
		
		if(!$message || !$number){
			return 'error_data';
		}
		
		$username = 'rohit.k';
		$apikey = 'bdd03d4b-fcf0-4b3c-bbd7-5a6707568ab5';		
		$smsType = 'TRANS';
		$sendername = 'CMYROS';
		
		$url = 'http://sms.webrinfotech.com/sendSMS';
		$data = array(
			"username" => $username,
			"message" => $message,
			"sendername" => $sendername,
			"smstype" => $smsType,
			"numbers" => $number,
			"apikey" => $apikey,
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec( $ch );
		curl_close($ch);
		return 'success';
    }
	
	function generateMsgText($data) {
		switch ($data['case']) {
			case 'activateAccount':			
				$msgText = str_replace(
					array(
						'[[OTP]]',
					),
					array(
						$data['otp'],
					),
					$data['DB_message']
				);
				break;
		}
		return trim($msgText);
	}
}

if(! function_exists('sendCommonSMS')){
	function sendCommonSMS($case, $dataAray) {
		$CI = & get_instance();
		$status = 'error';
		switch ($case) {				
			case 'activateAccount':
				$template = $CI->common_model->getAll('*', 'admin_message_template', array('id'=>'4'), '', '', array('isDeleted'=>array('0')));
				$dataAray['case']  = $case;
				$dataAray['DB_message']  = $template[0]->message ? $template[0]->message : $template[0]->default_msg;				
				$status = sendSMS($dataAray);
				break;
		}
		return $status;
	}
}

?>
