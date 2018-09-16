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

		$data['deliveryOptionObj']  = $this->common_model->getAll('*','delivery_option', array('isDeleted' => '1', 'status' => '1'));
		
		$data['getTimeSlotListObj']  = $this->manual_model->getTimeSlotList(array('a.slot_id','c.slot'), array('b.isDeleted' => '1', 'b.status' => '1', 'a.option_id' => '1'), 'c.tid ASC');
		
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
		$cid = decode($this->session->userdata('CID'));
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
		if(!$this->input->is_ajax_request() ) {
			exit( 'No direct script access allowed' );
		}
		
		
		
		$aid 			= decode($this->input->post('aid'));
		$cid 			= decode($this->input->post('cid'));
		$name 			= trim($this->input->post('name'));
		$mobile 		= $this->input->post('mobile');
		$pin 			= $this->input->post('pin');
		$addresline1 	= trim($this->input->post('addresline1'));
		$addresline2 	= trim($this->input->post('addresline2'));
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
	
	public function getCoupon(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$cid 			= decode($this->session->userdata('CID'));
		$cartProductObj = $this->common_model->getAll('*', 'order_details', array('is_in_cart'=>'1', 'cid' => $cid));
		
		if(!$cartProductObj){
			echo json_encode(array('status' => 'error', 'type'=>'cart') );
			exit;
		}
		
		$beforeDiscount_price = $afterDiscount_price = 0;
		$ordeDetailsAry = array();
		foreach($cartProductObj as $cartProduct){
			$productInfo = $this->common_model->getAll('*', 'product', array('product_id' => $cartProduct->pid, 'status'=>'1'));

			if(!$productInfo){
				continue;
			}
			
			$productPriceObj = $this->common_model->getAll('*', 'product_price', array('id' => $cartProduct->price_id));
			if(!$productPriceObj){
				continue;
			}

			$productPriceObj = json_decode(json_encode($productPriceObj), true);
			$productPrice = getDiscountFormat($productPriceObj[0]);

			$beforeDiscount_price += $productPrice['oreginal_price'] ? ($productPrice['oreginal_price'] * $cartProduct->quantity) : 0;

			$afterDiscount_price += $productPrice['final_price'] * $cartProduct->quantity;

		}
			$coupon 		= $this->input->post('coupon');
			$couponObj 		= $this->common_model->getAll( '*', 'coupon', array('code' => $coupon,'status'=> '1','total <='=> $afterDiscount_price));

		
		if($couponObj){
			$result = 'success';
		}else{
			$result = 'error';
		}
	
		echo json_encode(array('result'=>$result,'data'=>$couponObj));
	}

	function order(){
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}

		$session_id 	= $this->session->userdata('SESSION_ID');
		$cid 			= decode($this->session->userdata('CID'));
		
		$couponCode 	= $this->input->post('c_name');
		$diff_ship 		= $this->input->post('diff_ship');
		$save_address 	= $this->input->post('save_address');
		$paymentOption  = $this->input->post('paymentOption');
		
		

		if($diff_ship){
			$name 			= trim($this->input->post('shipping_name'));
			$email 			= trim($this->input->post('shipping_email'));
			$mobile 		= $this->input->post('shipping_mobile');
			$addresline1 	= trim($this->input->post('shipping_address_line_1'));
			$addresline2 	= trim($this->input->post('shipping_address_line_2'));
			$pin 			= $this->input->post('shipping_pin');
			$city 			= trim($this->input->post('shipping_city'));
			$stateId		= $this->input->post('shipping_stateCode');
			$landmark 		= trim($this->input->post('shipping_landmark'));
			$remarks 		= $this->input->post('shipping_remarks');
			

		}else{
			$name 			= trim($this->input->post('billing_name'));
			$email 			= trim($this->input->post('billing_email'));
			$mobile 		= $this->input->post('billing_mobile');
			$addresline1 	= trim($this->input->post('billing_address_line_1'));
			$addresline2 	= trim($this->input->post('billing_address_line_2'));
			$pin 			= $this->input->post('billing_pin');
			$city 			= trim($this->input->post('billing_city'));
			$stateId		= $this->input->post('billing_stateCode');
			$landmark 		= trim($this->input->post('billing_landmark'));
			$remarks 		= $this->input->post('billing_remarks');
		}	
		
			$stateObj 		= $this->common_model->getAll('*', 'location_state', array('sid' => $stateId));
			$state= $stateObj[0]->stateName;
	
		
		$cartProductObj = $this->common_model->getAll('*', 'order_details', array('is_in_cart'=>'1', 'cid' => $cid));
		
		if(!$cartProductObj){
			echo json_encode(array('status' => 'error', 'type'=>'cart') );
			exit;
		}
		
		$beforeDiscount_price = $afterDiscount_price = 0;
		$ordeDetailsAry = array();
		foreach($cartProductObj as $cartProduct){
			$productInfo = $this->common_model->getAll('*', 'product', array('product_id' => $cartProduct->pid, 'status'=>'1'));

			if(!$productInfo){
				continue;
			}
			
			$productPriceObj = $this->common_model->getAll('*', 'product_price', array('id' => $cartProduct->price_id));
			if(!$productPriceObj){
				continue;
			}

			$productPriceObj = json_decode(json_encode($productPriceObj), true);
			$productPrice = getDiscountFormat($productPriceObj[0]);

			$beforeDiscount_price += $productPrice['oreginal_price'] ? ($productPrice['oreginal_price'] * $cartProduct->quantity) : 0;

			$afterDiscount_price += $productPrice['final_price'] * $cartProduct->quantity;
			
			$ordeDetailsAry[] = array(
				'is_in_cart'=>'0',
				'actual_price' => $productPrice['oreginal_price'],
				'discount' => $productPrice['discount_value'],
				'total_price' => $productPrice['final_price'],
				'unit' => $cartProduct->quantity,
			);
			
		}
		
		//echo '<pre>';print_r($applyCuponObj);die;
		
		
		$afterCouponDiscount_Price = $afterDiscount_price;

		$couponCodeObj  = $this->common_model->getAll('*', 'coupon', array('status'=>'1', 'code' => $couponCode));

		$couponCal = 0;
		$discountVal = 0;

		//echo "==".$beforeCouponDiscount_Price = $beforeDiscount_price - $afterDiscount_price;

		if ( isset( $couponCode ) ) {
			$coupon = $couponCode;
			$couponType = $couponCodeObj[ 0 ]->type;
			$discountVal = $couponCodeObj[ 0 ]->discount;
			if ( $couponType == 1 ) {
				$couponCal = $afterDiscount_price * $discountVal / 100;
				$afterCouponDiscount_Price = $afterDiscount_price - $couponCal;
			} else {
				$couponCal = $discountVal;
				$afterCouponDiscount_Price = $afterDiscount_price - $couponCal;
			}
		}else{
			$coupon = $couponCal = '';
		}
		
		$order_status = '';
		
		if($paymentOption == '1'){
			$order_status = '6';
		}else if($paymentOption == '2'){
			$order_status = '6';
		}else{
			$order_status = '5';
		}
		
		$orderAray = array(
			'invoice_no' 		=> 'INV'.generateRandom(5,$type='number'),
			'payment_mode' 		=> $paymentOption,
			'customer_id' 		=> $cid,
			'address' 			=> $name.','.$email.','.$addresline1.','.$addresline2.','.$city.','.$state.','.$landmark,
			'pin_code' 			=> $pin,
			'phone_number' 		=> $mobile,
			'coupon' 			=> $coupon,  
			'coupon_price' 		=> $couponCal,  
			'status_type' 		=> $order_status,
		);
		
		//echo '====<pre>';print_r($orderAray);die;
		$oid = $this->common_model->saveData('orders', $orderAray);	
		
		foreach($ordeDetailsAry as $ordeDetailsData){
			$ordeDetailsUpdate = $ordeDetailsData;
			$ordeDetailsUpdate['oid'] = $oid;
			$this->common_model->updateData('order_details', array('is_in_cart'=>'1', 'cid' => $cid), $ordeDetailsUpdate);
		}
		echo json_encode( array('status' => 'success') );
	} 
}