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
		$productDataObj = $productListObj = $categoryObj = array();
		$urlSlug = $slugURL2;
		
		$select = array(
			'c.category_id as c_category_id',
			'c.parent_id as c_parent_id',
			'c.name as c_name',
			'c.url_slug as c_url_slug',
			'c.image as c_image',
			'c.icon as c_icon',
			'c.isTopBar as c_isTopBar',
			'c.isLeftBar as c_isLeftBar',
			'c.sort_order as c_sort_order',
			'c.meta_description as c_meta_description',
			'c.meta_keyword as c_meta_keyword',
			'c.description as c_description',
			'c.mobile_display as c_mobile_display',
			'c.status as c_status',
			'c.created_on as c_created_on',
			'c.modified_on as c_modified_on',
			'b.product_id as p_product_id',
			'b.name as p_name',
			'b.url_slug as p_url_slug',
			'b.status as p_status',
			'b.description as p_description',
			'b.image as p_image',
			'b.sku_code as p_sku_code',
			'b.date_available as p_date_available',
			'b.product_stock as p_product_stock',
			'b.subtract_stock as p_subtract_stock',
			'b.stock_status_id as p_stock_status_id',
			'b.sort_number as p_sort_number',
			'b.isEggless as p_isEggless',
			'b.isMsgOptProdct as p_isMsgOptProdct',
			'b.isMsgOptCrd as p_isMsgOptCrd',
			'b.isTissuePacking as p_isTissuePacking',
			'b.meta_title as p_meta_title',
			'b.meta_keyword as p_meta_keyword',
			'b.meta_description as p_meta_description',
			'b.delivery_description as p_delivery_description',
			'b.refund_description as p_refund_description',
			'b.created_on as p_created_on',
			'b.modified_on as p_modified_on',
		);
		
		
		if($slugURL2){
			$productObj = $this->common_model->getAll( '*', 'product', array('url_slug' => $slugURL2, 'status'=>'1', 'isDeleted'=>'1'));	
		}else{
			$slugURL = $slugURL2 ? $slugURL2 : $slugURL1;
			
			$categoryObj = $this->common_model->getAll( '*', 'category', array('url_slug' => $slugURL, 'status'=>'1', 'isDeleted'=>'1'));
			
			
			$select = array(
				'b.name as p_name',
				'b.url_slug as p_url_slug',
				'b.image as p_image',
				'b.date_available as p_date_available',
				'b.sort_number as p_sort_number',
				'b.isEggless as p_isEggless',
				'b.created_on as p_created_on',
			);
			
			$where = array(
				'c.url_slug' => $slugURL1,
				'b.isDeleted'=>'1',
				'c.isDeleted'=>'1',
				'b.status'=>'1',
				'c.status'=>'1',				
			);
			
			$select = str_replace( " , ", " ", implode( ", ", $select));
			
			$productListObj = $this->manual_model->getProductListing($select, $where);
		}

		$data[ 'productDataObj' ] = $productDataObj;
		$data[ 'productListObj' ] = $productListObj;
		$data[ 'categoryObj' ] = $categoryObj;

		if($productListObj){
			$this->load->view( 'store/product-listing', $data);
		} else if($productDataObj){
			$this->load->view( 'store/product-data', $data);
		} else {
			$this->load->view( 'admin/404' );
		}
	}
}