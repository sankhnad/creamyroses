<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class URL_slug extends CI_Controller {
	public

	function __construct() {
		parent::__construct();
	}

	public
	function index() {
		$slugURL1 = $this->uri->segment( 1 );
		$slugURL2 = $this->uri->segment( 2 );
		$categoryObj = $productObj = array();
		if($slugURL2){
			$productObj = $this->common_model->getAll( '*', 'product', array('url_slug' => $slugURL2, 'isDeleted'=>'1'));
		}else if($slugURL1){
			$categoryObj = $this->common_model->getAll( '*', 'category', array('url_slug' => $slugURL1, 'isDeleted'=>'1'));
		} else {
			$productObj = $this->common_model->getAll( '*', 'product', array('url_slug' => $slugURL2, 'isDeleted'=>'1'));
		}

		$data[ 'categoryObj' ] = $categoryObj;

		
		if ( $productObj ) {
			$this->load->view( 'store/product-data' );
		} else if ( $categoryObj ) {
			$this->load->view( 'store/product-listing', $data );
		} else {
			$this->load->view( 'admin/404' );
		}
	}
}