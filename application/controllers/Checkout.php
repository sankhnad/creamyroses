<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Checkout extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$session_id = $this->session->userdata('SESSION_ID');
		$cid = decode($this->session->userdata('CID'));
		
		$aColumns=array(
			'a.pin_code',
			'a.is_eggless',
			'a.actual_price',
			'a.discount',
			'a.total_price',
			'a.cake_message',
			'a.unit',
			'a.quantity',
			'a.delivery_date',
			'a.delivery_time_slot',
			
			'd.name',
			'd.image',
			
			'e.price as shipingChrg',
		);
		
		$cartDetailsObj  = $this->manual_model->getOrderDetails(str_replace( " , ", " ", implode( ", ", $aColumns )), array('a.cid'=>$cid,'a.is_in_cart'=>'1'));

		//echo '<pre>';print_r($cartDetailsObj);die;

		
		$addressList 			= $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1'), array('a.isDefault','asc'));
		$defaultAddress			= $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1','a.isDefault'=>'1'), array('a.isDefault','asc'));
		
		$data['cartDetailsObj']	= $cartDetailsObj;
		$data['defaultAddress']	= $defaultAddress;
		$data['addressList'] 	= $addressList;
		$data['stateAry'] 		= $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		
		$addressList = $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1'), array('a.isDefault','asc'));

		$data['addressList'] = $addressList;
		
		$this->load->view('store/checkout_temp', $data);
		//$this->load->view('store/checkout', $data);
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
	
	function order(){
			$cid = decode($this->input->post('cid'));
			$post = $this->input->post();
			
			$invoice_no  = generateRandom(5,$type='number');
			$payment_mode = '1';
			$customer_id = $cid;
			$address  	 = $post['billing_name'].','.$post['billing_email'].','.$post['billing_address_line_1'].','.$post['billing_address_line_2'].','.$post['billing_pin'].','.$post['billing_city'].','.$post['billing_stateCode'].','.$post['billing_landmark'].','.$post['billing_remarks'];
			$pincode  	 = $post['billing_pin'];
			$mobile  	 = $post['billing_mobile'];
			$status_type = '2';
			
			$cart_sub_total = $post['cart_sub_total'];
			$discount 		= $post['discount_val'];
			$total_price    = $post['order_total_val'];
			
			$orderAray = array(
				'invoice_no' => $invoice_no,
				'payment_mode' => $payment_mode,
				'customer_id' => $customer_id,
				'address' => $address,
				'pin_code' => $pincode,
				'phone_number' => $mobile,
				'coupon' => '',
				'status_type' => $status_type,
			);
						
			$oid = $this->common_model->saveData('orders', $orderAray);	
			
				$orderDetailAray = array(
					'oid' => $oid,
					'is_in_cart' => 0,
					'actual_price' => $cart_sub_total,
					'discount' => $discount,
					'total_price' => $total_price,
				);
				//echo '<pre>';print_r($orderDetailAray);die;
				$this->common_model->updateData('order_details', array('cid'=>$customer_id), $orderDetailAray);
				
			
			//$this->cart->destroy();
			//$this->session->unset_userdata('CID');
			echo json_encode( array('status' => 'success') );
		} 

}