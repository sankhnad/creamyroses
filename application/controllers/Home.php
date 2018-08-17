<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public
	function __construct() {
		parent::__construct();
	}
	
	public function index(){
		$typeAry 		   = $this->common_model->getAll('*', 'type', '','sort_order asc');
		$data['activeNav'] = 'home';		
		$data['typeAry']   = $typeAry;
				
		$this->load->view('store/index', $data);
	}
	
	public function updateCitySelect(){
		if(!$this->input->is_ajax_request()){
			exit( 'Unauthorized Access' );
		}
		$id = decode($this->input->post('id'));
		$this->session->set_userdata( 'CITY', $id );
		set_cookie('CITY',$id,3600*9999);
		echo json_encode(array('status'=>'success'));
	}
}
