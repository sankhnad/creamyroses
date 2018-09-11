<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Cart extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$table = 'order_details';
		$cid = decode($this->session->userdata('CID'));
		$data['cartProductObj'] = $this->common_model->getAll('*', $table, array('cid'=>$cid));
		$this->load->view('store/cart', $data);
	}
	
	function addToCart(){
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		$session_id = $this->session->userdata('SESSION_ID');
		$cid = decode($this->session->userdata('CID'));
		$pid = $this->input->post('pid');
		$delivary_option_id = $this->input->post('delivary_option_id');
		$pin_code = $this->input->post('pin_code');
		$is_eggless = $this->input->post('is_eggless');
		$price_id = $this->input->post('price_id');
		$cake_message = $this->input->post('cake_message');
		$delivery_date = $this->input->post('delivery_date');
		$delivery_time_slot = $this->input->post('delivery_time_slot');
		$table = 'order_details';
		$cidWhere = '';
		$quantity = '';
		if($cid){
			$cidWhere = 'cid = '.$cid;
		}else{
			$cidWhere = 'session_id = "'.$session_id.'"';
		}
		$cartData = $this->common_model->getAll('*',$table, $cidWhere. ' AND price_id = '.$price_id.' AND pid = '.$pid);
		
		if($cartData){
			$cartData = $this->manual_model->updateCartQty($cartData[0]->id);
		}else{
			$data = array(
				'session_id' => $session_id,
				'cid' => $cid,
				'pid' => $pid,
				'delivary_option_id' => $delivary_option_id,
				'pin_code' => $pin_code,
				'is_eggless' => $is_eggless,
				'price_id' => $price_id,
				'cake_message' => $cake_message,
				'quantity' => 1,
				'delivery_date' => convertToSQLDate($delivery_date),
				'delivery_time_slot' => $delivery_time_slot,
			);
			$cartData = $this->common_model->saveData($table, $data);
		}
		echo json_encode(array('status'=>'success'));
	}
	
	function clearCartVal(){
		if(!$this->input->is_ajax_request()) {
			exit( 'No direct script access allowed' );
		}
		$session_id = $this->session->userdata('SESSION_ID');
		$cid = decode($this->session->userdata('CID'));
		
		$table = 'order_details';
		if($cid){
			$data = array(
				'cid' => $cid,
			);
		}else{
			$data = array(
				'session_id' => $session_id,
			);
		}
		
		$this->common_model->deleteData($table, $data);
		echo json_encode(array('status'=>'success'));
	}
}