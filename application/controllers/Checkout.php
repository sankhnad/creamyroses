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
	
	function order(){
			if($this->session->userdata('CID') != ''){
				$CID = decode($this->session->userdata('CID'));
			}
			$cart = $this->cart->contents();
			if($this->session->userdata('cid') != ''){
				$coupon_id = $this->session->userdata('cid');
			}
			if($this->session->userdata('type') != ''){
				$discount_type = $this->session->userdata('type');
			}
			if($this->session->userdata('discount') != ''){
				$discount = $this->session->userdata('discount');
			}


			if(count($cart) > 0){
				$post = $this->input->post();
			
				$orderAry = array(
					'customer_id' 		=> $CID,
					'price' 			=> $post['amount'],
					'coupon_id' 		=> $coupon_id,
					'discount_type' 	=> $discount_type,
					'discount' 			=> $discount,
					'created_on' 		=> date("Y-m-d H:i:s", time()),
				);	
			
				$order_id = $this->common_model->saveData('orders', $orderAry);	
			
				if ($cart = $this->cart->contents()){
					foreach ($cart as $item){
						$order_detailAry [] = array(
							'order_id' 			=> $order_id,
							'product_id' 		=> $item['id'],
							'unit_price' 		=> $item['price'],
							'qty' 				=> $item['qty'],
							'sub_total_price' 	=> $item['subtotal'],
							'created_on' 		=>date("Y-m-d H:i:s", time())
						);	
					}
					$this->common_model->bulkSaveData('oder_details', $order_detailAry);
				}
			
				$billingAry = array(
					'order_id'	 	=> $order_id,
					'fname' 		=> $post['fname'],
					'lname' 		=> $post['lname'],
					'company_name' 	=> $post['company'],
					'email' 		=> $post['email'],
					'phone' 		=> $post['phone'],
					'address' 		=> $post['address'],
					'country' 		=> $post['country'],
					'state' 		=> $post['state'],
					'city' 			=> $post['city'],
					'zip_code' 		=> $post['pincode'],
					'created_on' 	=> date("Y-m-d H:i:s", time()),
				);
						
				$billing_id = $this->common_model->saveData('shipping', $billingAry);	
				
			
			
				$data['transactionId'] = 1;
				$data['order_id'] 	   = $order_id;
				$data['p_list'] 	   = $p_list;
				$data['pr_list'] 	   = $pr_list;
				$data['pcategory_id']  = $pcategory_id;
				$data['sc_list'] 	   = $subCategory;
				$data['cart'] 	   	   = $cartData;
			}else{
			
				$data['transactionId'] = '';
			
			}
			$this->cart->destroy();
			$this->session->unset_userdata('cid');
			$this->session->unset_userdata('code');
			$this->session->unset_userdata('type');
			$this->session->unset_userdata('discount');

			$data['cartData'] 	= $this->cart->contents();
			
			$this->load->view('store/response', $data);

			
	} 

}