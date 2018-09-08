<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Profile extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['activeNav'] = 'profile';		
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
		$this->load->view('store/address-book', $data);
	}
	
	function orders(){
		$data['activeNav'] = 'orders';		
		$this->load->view('store/orders', $data);
	}
	function addAddress(){
		$data['activeNav'] = 'address';		
		$this->load->view('store/addressData', $data);
	}


}