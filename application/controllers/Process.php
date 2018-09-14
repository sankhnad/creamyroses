<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process extends CI_Controller {
	public
	function __construct() {
		parent::__construct();
	}	
	
	public function getPrice(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$id 	  = $this->input->post('id');
		$priceObj = $this->common_model->getAll( '*', 'product_price', array('id' => $id));
	
		echo json_encode($priceObj);
	}

	public function getPincode(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$pincode 	= $this->input->post('pincode');
		$pinCodeObj = $this->common_model->getAll( '*', 'location_pin', array('pin' => $pincode));

		if($pinCodeObj){
			$result = 'success';
			$this->session->set_userdata('PIN_CODE', $pincode);
		}else{
			$result = 'error';
		}
	
		echo json_encode(array('result'=>$result));
	}
	
	function getProductDeliverySlot(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$pid 	= $this->input->post('pid');
		
		$slotWhere = array(
			'a.product_id'=>$pid,
			'b.status'=>'1',			
		);
		$result =  $this->manual_model->getProductDeliverySlot(array('b.*'), $slotWhere);
		echo json_encode($result);
	}
	
	public function getCoupon(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$coupon 		= $this->input->post('coupon');
		$cart_total 	= $this->input->post('cart_total');
		$couponObj 		= $this->common_model->getAll( '*', 'coupon', array('code' => $coupon,'status'=> '1','total <='=> $cart_total));

		if($couponObj){
			$result = 'success';
			$this->session->set_userdata('COUPON_CODE', $coupon);
			$this->session->set_userdata('COUPON_DATA', $couponObj);
		}else{
			$result = 'error';
		}
	
		echo json_encode(array('result'=>$result,'data'=>$couponObj));
	}

}

