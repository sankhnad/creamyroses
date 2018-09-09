<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Checkout extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$cid 					= decode($this->session->userdata('CID'));
		$addressList 			= $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1'), array('a.isDefault','asc'));
		$defaultAddress			= $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1','a.isDefault'=>'1'), array('a.isDefault','asc'));
		
		$data['defaultAddress']	= $defaultAddress;
		$data['addressList'] 	= $addressList;
		$data['stateAry'] 		= $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$this->load->view('store/checkout', $data);
	}
	
	function addAddress(){
		$data['activeNav'] = 'address';	
		$data['data'] = array();	
		
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$this->load->view('store/newAddressData', $data);
	}

	
	function getAddress(){
		$output = '';
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$where = array(
			'cid'		=> $cid,
			'aid'		=> $aid,
			'isDeleted'		=> '1',
		);
		$data = $this->common_model->getAll('*', 'address', $where);
		if($data){
			$output = array(
				'name'		=> $data[0]->name,
				'mobile'	=> $data[0]->mobile,
				'pin'		=> $data[0]->pin,
				'address_line_1'=> $data[0]->address_line_1,
				'address_line_2'=> $data[0]->address_line_2,
				'landmark'	=> $data[0]->landmark,
				'city'		=> $data[0]->city,
				'sid'	=> $data[0]->stateCode,
				'type'	=> $data[0]->type,
				'isDefault'	=> $data[0]->isDefault,
				'remarks'	=> $data[0]->remarks,
			);
		}
		echo json_encode($output);
	}

	
	function editNewAddress(){
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$name = trim($this->input->post('name'));
		$mobile = $this->input->post('mobile');
		$pin = $this->input->post('pin');
		$addresline1 = trim($this->input->post('addresline1'));
		$addresline2 = trim($this->input->post('addresline2'));
		$landmark = trim($this->input->post('landmark'));
		$city = trim($this->input->post('city'));
		$state = $this->input->post('state');
		$isDefault = $this->input->post('isDefault');
		$type = $this->input->post('type');
		$remarks = $this->input->post('remarks');		
		
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
		echo json_encode( array('aid' => encode($aid)) );
	}


}