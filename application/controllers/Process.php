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
		$id 			= $this->input->post('id');
		$priceObj 		= $this->common_model->getAll( '*', 'product_price', array('id' => $id));
		$discount_price	= getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);

		$data['discount_price'] = $discount_price;
	
		echo json_encode(array('result'=>$priceObj,'discountPrice'=>$discount_price));
	}

	public function getPincode(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$pincode 	= $this->input->post('pincode');
		$pinCodeObj = $this->common_model->getAll( '*', 'location_pin', array('pin' => $pincode));

		if($pinCodeObj){
				$result = 'success';
		}else{
				$result = 'error';
		}
	
		echo json_encode(array('result'=>$result));
	}

}
