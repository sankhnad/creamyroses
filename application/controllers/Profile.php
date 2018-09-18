<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Profile extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['activeNav'] = 'profile';	
		$cid = decode($this->session->userdata('CID'));
		$customerData = $this->common_model->getAll('*', 'customer', array('isDeleted'=>'1', 'id'=>$cid));
		$data['customerData'] = $customerData;

		$this->load->view('store/profile', $data);
	}
	
	function registerView(){
		$data['activeNav'] = 'Register';		
		$this->load->view('store/register', $data);
	}
	
	function addToWishList(){
		//echo '<pre>';print_r($this->session->userdata());die;
		$pid = $this->input->post('pid');
		$cid = decode($this->session->userdata('CID'));
		if(!$cid){
			echo json_encode(array('status'=>'error'));
			exit;
		}
		$table = 'wish_list';
		$data = array(
			'pid' => $pid,
			'cid' => $cid,
		);
		$wishLIst = getProductWishList($pid, $cid);
		if($wishLIst){
			$this->common_model->deleteData($table, $data);
		}else{
			$this->common_model->saveData($table, $data);
		}
		echo json_encode(array('status'=>'success'));
		exit;
	}
	
	function wishlistListing(){
		$data['activeNav'] = 'wishlist';		

		$pid = $this->input->post('pid');
		$cid = decode($this->session->userdata('CID'));
		
			$select = array(
				'b.product_id as p_product_id',
				'b.name as p_name',
				'b.url_slug as p_url_slug',
				'b.image as p_image',
				'b.description as p_desc',
			);
			
			$where = array(
				'a.cid' => $cid,
				'b.isDeleted'=>'1',
				'b.status'=>'1',
			);
			
			$select = str_replace( " , ", " ", implode( ", ", $select));			
			$productListObj = $this->manual_model->getWishlistListing($select, $where);		
			$data['productListObj'] = $productListObj;
			//echo '<pre>';print_r($productListObj);die;
	
		$this->load->view('store/wishlist', $data);
	}
	
	function address(){
		$data['activeNav'] = 'address';		
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$addressList = $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1'), array('a.isDefault','asc'));

		$data['addressList'] = $addressList;

		$this->load->view('store/address-book', $data);
	}
	
	function orders(){
		$data['activeNav'] = 'orders';		
		$this->load->view('store/orders', $data);
	}
	
	function addAddress(){
		$data['activeNav'] = 'address';	
		$data['data'] = array();	
		
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$this->load->view('store/addressData', $data);
	}

	function editNewAddress(){
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->session->userdata('CID'));
		
		$name 			= trim($this->input->post('name'));
		$mobile 		= $this->input->post('mobile');
		$pin 			= $this->input->post('pin');
		$addresline1 	= trim($this->input->post('addresline1'));
		$addresline2 	= trim($this->input->post('addresline2'));
		$landmark 		= trim($this->input->post('landmark'));
		$city 			= trim($this->input->post('city'));
		$state 			= $this->input->post('state');
		$isDefault 		= $this->input->post('isDefault');
		$type 			= $this->input->post('type');
		$remarks 		= $this->input->post('remarks');		
		
		$data = array(
			'cid'		=> $cid,
			'name'		=> rtrim($name,','),
			'mobile'	=> str_replace(' ', '', $mobile),
			'pin'		=> $pin,
			'address_line_1'=> rtrim($addresline1,','),
			'address_line_2'=> rtrim($addresline2,','),
			'landmark'	=> rtrim($landmark,','),
			'city'		=> rtrim($city,','),
			'stateCode'	=> $state,
			'type'	=> $type,
			'remarks'	=> $remarks,
		);
		
		$table = 'address';
		if($isDefault){
			$this->common_model->updateData($table, array('isDefault'=>'1', 'cid'=>$cid), array('isDefault'=>'0'));
			$data['isDefault'] = '1';
		}else{
			$data['isDefault'] = '0';
		}
		
		if($aid){		
			$this->common_model->updateData($table, array('aid'=>$aid), $data);
		}else{
			$data['created_on'] = date( "Y-m-d H:i:s", time() );
			$aid = $this->common_model->saveData($table, $data );
		}
		echo json_encode(array('status'=>'success'));
	}

	function deleteAddress(){
		$tbl = 'address';
		$this->input->post('id');
		$aid = decode($this->input->post('id'));
		$where = array('aid'=>$aid);
		$data = array(
			'isDeleted'=> '0',
		);
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}	

	function setDefaultAddress(){
		$tbl = 'address';
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$this->common_model->updateData($tbl, array('isDefault'=>'1'), array('isDefault'=>'0', 'cid'=>$cid));
		
		$aid = decode($this->input->post('aid'));
		$where = array('aid'=>$aid);
		$data = array(
			'isDefault'=> '1',
		);
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => true ) );
	}

	function getAddress($addressId){
		$data['activeNav'] = 'address';		
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));

		$output = '';
		$aid = decode($addressId);
		$cid = decode($this->session->userdata('CID'));
		$where = array(
			'cid'		=> $cid,
			'aid'		=> $aid,
			'isDeleted'		=> '1',
		);
		if($aid){
			$data['data'] = $this->common_model->getAll('*', 'address', $where);
		}else{
			$data['data'] = array();
		}
		$this->load->view('store/addressData', $data);
	}
	
	function customerAddEdit() {
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		
		$output = '';
		$cid 		= decode($this->session->userdata('CID'));
		$fname 		= $this->input->post('fname');
		$lname 		= $this->input->post('lname');
		$mobile = $this->input->post('mobile');		
		//$gender = $this->input->post('gender') == '1' ? 'M' : 'F';
		$dob = $this->input->post('dob') ? convertData($this->input->post('dob')) : NULL;
		$doa = $this->input->post('doa') ? convertData($this->input->post('doa')) : NULL;
		

		$data = array(
			'fname'	=> $fname,
			'lname'	=> $lname,
			//'email'	=> $email,
			'mobile'=> preg_replace('/\s+/', '', $mobile),
			//'gender'=> $gender,
			'dob'	=> $dob,
			'doa'	=> $doa,
		);
		
		
		
		$avtar = $_FILES['avtar']['name'];
		if($avtar){
			$data['avtar'] = uploadFiles('avtar', $path = 'uploads/profile/', 'thumb', 360, 360 );
		}		
		
		if($cid){		
			$this->common_model->updateData('customer', array('id'=>$cid), $data);
		}
			
		echo json_encode( array( 'status' => true, 'cid' => encode($cid)) );
	}
}