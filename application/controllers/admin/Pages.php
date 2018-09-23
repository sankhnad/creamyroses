<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Pages extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$data['activeMenu']     = 'pages';
		$data['activeSubMenu']  = 'home_page';
		$this->load->view( 'admin/home_page', $data);
	}
	function home() {		
		$data['activeMenu']     = 'pages';
		$data['activeSubMenu']  = 'home_page';
		$this->load->view( 'admin/home_page', $data);
	}
}