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
}