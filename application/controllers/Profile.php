<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Profile extends CI_Controller {
	
	public
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$data['activeNav'] = 'Login';		
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
		$pid = $this->input->post('pid');
		$cid = decode($this->session->userdata('CID'));
		
		
		$this->load->view('store/wishlist', $data);
	}
}