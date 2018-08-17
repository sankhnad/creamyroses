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
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');		
		
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
			'fname'	=> $fname,
			'lname'	=> $lname,
			'email'	=> $email,
			'mobile'=> str_replace(' ', '', $mobile),
			'mobile_otp'	=> $mobile_otp,
			'password'=> md5($password),
			'created_on'=> date("Y-m-d H:i:s", time()),
		);
		
		$id = $this->common_model->saveData( "customer", $data );	
		
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

}