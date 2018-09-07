<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Login extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['activeNav'] = 'Login';		
		$this->load->view('store/login', $data);
	}
		
	function registerView(){
		$data['isverify']  = 0; 		

		$data['activeNav'] = 'Register';		
		$this->load->view('store/register', $data);
	}

	function check() {
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}		
		$status = $id = '';
		$email = $this->input->post( 'email' );
		$password = md5( $this->input->post( 'password' ) );
		$remember = $this->input->post( 'remember');
		$smsVerify = $this->manual_model->check_isSMS_verifieds($email);
		
		if(empty($smsVerify)){
			//echo "===22";die;
			echo json_encode( array( 'status' => 'pending','password' => $password ) );
			return(false);
		}
		$result = $this->manual_model->checkLoginCustomerEmail($email);
		if($result){
			if($password == $result[0]->password){
				if($result[0]->status == '1'){
					$id = encode($result[0]->id);
					$this->session->set_userdata( 'CID', $id);
					if($remember){
						set_cookie('CID',$id,3600*9999); 
						get_cookie('CID'); 
					}
					$status = 'success';
				}else if ( $result[0]->status == '2' ) {
					$status = 'pending';
				}
			}else{
				$status = 'error';
			}
		}else{
			$status = 'error';
		}
		
		echo json_encode(array('status' => $status));
	}
	
	function register() {
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		//echo '<pre>';print_r($this->input->post());die;
		$status = '';
		
		$fname 				 = $this->input->post('fname');
		$lname 				 = $this->input->post('lname');
		$email 				 = $this->input->post('email');
		$mobile 			 = $this->input->post('mobile');
		$password 			 = $this->input->post('password');		
		$assign_rferral_code = trim($this->input->post('assign_rferral_code'));		
		$rferral_code 		 = 'CRS'.generateRandom(5, 'number');
		$ref_amount = 20;
		
		$chekEmail = $this->checkCustEmailAvlb( $email, 'email');
		
		if ($chekEmail == 'error' ) {
			$status = 'email-error';
		} else if($mobile){
			$chekUser = $this->checkCustEmailAvlb( $mobile, 'mobile');
			if ($chekUser == 'error') {
				$status = 'mobile-error';
			}
		}
		if($status){
			echo json_encode( array( 'status' => $status ) );
			return(false);
		}

		$mobile_otp = 	generateRandom(5,$type='number');
		$data = array(
				'fname'					=> $fname,
				'lname'					=> $lname,
				'email'					=> $email,
				'mobile'				=> str_replace(' ', '', $mobile),
				'mobile_otp'			=> $mobile_otp,
				'password'				=> md5($password),
				'referral_code'			=> $rferral_code,
				'created_on'			=> date("Y-m-d H:i:s", time()),
		);
		
		$id = $this->common_model->saveData( "customer", $data );	
		
		if($assign_rferral_code){
			$refObj = $this->common_model->getAll("id", 'customer', array('referral_code'=>$assign_rferral_code));
			if($refObj){
				$sql = 'SELECT SUM(amount) as iTotal FROM `referals` WHERE status = "1" AND ref_cid = "'.$refObj[0]->id.'" AND created_on >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)';
				$totalAmount = $this->common_model->customQuery($sql);
				
				
				if($totalAmount[0]['iTotal']< 1000){
					$refData = array(
							'ref_cid'			=> $refObj[0]->id,
							'used_by_cid'		=> $id,
							'amount'			=> $ref_amount,
							'status'			=> '1',
							'created_on'		=> date("Y-m-d H:i:s", time()),
					);				
					$this->common_model->saveData( "referals", $refData);
				}
			}
		}
		$dataAray = array(
			'otp' => $data['mobile_otp'],
			'number' => $data['mobile'],
		);
		sendCommonSMS('activateAccount', $dataAray);
		
		echo json_encode( array( 'status' => 'success'));
	}
	
	function checkCustEmailAvlb( $data = '', $type = '', $cid='' ) {
		if(!$this->input->is_ajax_request()){
			exit( 'No direct script access allowed' );
		}
		$data = $data == '' ? $this->input->post('data') : $data;
		$type = $type == '' ? $this->input->post('type') : $type;
		if(!$cid){
			$cid = decode($this->input->post('cid'));
		}
		
		if ( $type == 'email' ) {
			$where = array( 'email' => $data );
		} elseif ( $type == 'mobile' ) {
			$where = array( 'mobile' => $data );
		} else {
			return false;
		}
		if($cid !=''){
			$notinData = array('id'=> array($cid));
		}else{
			$notinData = array();
		}
		
		$data = $this->common_model->getAll('id', 'customer', $where, '', '', $notinData);
		if ( count( $data ) > 0 ) {
			$status =  'error';
		} else {
			$status =  'valid';
		}
		if(isset($_REQUEST['data'])){
			echo json_encode( array( 'status' => $status ) );
		}else{
			return($status);
		}
	}
	
	function logout() {
        $this->session->sess_destroy();
		delete_cookie('UID');
		unset( $_SESSION['UID']);
        unset( $_SESSION['CREATED']);
        redirect( base_url() . 'login');
    }
	
	function checkOtp() {
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		//echo '<pre>';print_r($this->input->post());die;
		$mobile  	= $this->input->post('otpMobile');
		$otp	    = $this->input->post('otp');
		$checkOtp 	= $this->common_model->getAll("id", 'customer', array('mobile_otp'=>$otp,'mobile'=>$mobile));
		
		if(count($checkOtp) > 0){
			$data = array(
				'isSMS_verified' => '1',
			);
			$this->common_model->updateData('customer', array('mobile'=>$mobile), $data);
			$status = 'success';
		}else{
			$status = 'otp-error';
		}
		echo json_encode( array( 'status' => $status ) );
	}
	
	function verif_otp(){
		
		$password 			= $this->uri->segment( 2 );
		$customerObj	 	= $this->common_model->getAll("id", 'customer', array('password'=>$password));
		
		//echo '<pre>';print_r($customerObj);die;

		$data['activeNav'] = 'Register';
		$data['isverify']  = 1; 		
		$this->load->view('store/register', $data);
	}

	


}