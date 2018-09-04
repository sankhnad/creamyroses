<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Products extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$data['activeMenu'] = 'store';
		$data['activeSubMenu'] = 'products';
		$this->load->view( 'admin/product_list', $data);
	}
	
	function product_list() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		
		$iSQL = $sWhere = $sAnd = $inData = $notInData = $sOrder = $sLimit = '';
		$tbl = 'product';

		if(isset($_REQUEST['filterData'])){			
			foreach($_REQUEST['filterData'] as $inDataKey => $inDataVal){
				if($inDataKey == 'status_filter'){
					if($inDataVal){
						$filterData .= ' AND status IN("'.implode('","', $inDataVal).'")';
					}
				}
				if ( $inDataKey == 'filter_date' ) {
					if ( $inDataVal ) {
						$tempDate = convertToSQLDate($inDataVal);
						$startDate = $tempDate[0];
						$endDate = isset($tempDate[1]) ? $tempDate[1] : '';
						$inData .= ' AND created_on BETWEEN "'.$startDate.'" AND "'.$endDate.'"';
					}
				}
			}
		}

		$recordsTotal = $this->common_model->countResults($tbl, array('isDeleted'=>"1"));

		$aColumns=array(
			'name',
			'sku_code',
			'status',
			'image',
			'created_on',
			'product_id',
		);
		
		$iSQL = " FROM ".$tbl;

		$quryTmp = $this->datatablemodel->multi_tbl_list( $aColumns, 0 );
		$sWhere = $quryTmp[ 'where' ] ? $quryTmp[ 'where' ] : ' WHERE 1 = 1 ';
		$sOrder = $quryTmp[ 'order' ];
		$sLimit = $quryTmp[ 'limit' ];		
		
		$sAnd .=  ' AND isDeleted = "1"';
		
		$sQuery = "SELECT " . str_replace( " , ", " ", implode( ", ", $aColumns ) ) . " 
		$iSQL
		$sWhere
		$sAnd
		$inData
		$notInData
		$sOrder
		$sLimit
		";
		
		$qtrAry = $this->common_model->customQuery( $sQuery );

		$sQuery = "SELECT COUNT(".$aColumns[0].") AS iFiltered
		$iSQL
		$sWhere
		$sAnd
		$inData
		$notInData
		";
		
		$iFilteredAry = $this->common_model->customQuery( $sQuery );
		$recordsFiltered = $iFilteredAry[0][ 'iFiltered' ];

		$sEcho = $this->input->get_post( 'draw', true );
		$results = array(
			"draw" => intval( $sEcho ),
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => array(),
			"tempData" => $qtrAry
		);
		
		foreach ( $results['tempData'] as $aKey => $aRow ) {		
			$id = $aRow['product_id'];
			$encodedID = encode($id);
			
			$btnAra = ' <a class="blue" data-tooltip="tooltip" title="Edit" href="'.admin_url().'products/edit/'.$encodedID.'"> <i class="ace-icon fas fa-pencil-alt bigger-130"></i> </a>';
			
			$btnAra .= ' <a class="red" data-tooltip="tooltip" title="Delete" onClick="deleteCommon(this,\''.$encodedID.'\',\'product\')" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i> </a>';
			
			
			
			$isActivCheck = '';
			$offLbl = 'Inactive';
			if($aRow['status'] == '1'){
				$isActivCheck = 'checked';
				$offLbl = 'Active';
			}
			
			$status = '<div data-status="'.$aRow['status'].'" onClick="changeStatus(this, \''.$encodedID.'\', \'status\', \'product\')" data-state="'.$offLbl.'" class="swithAraBoxBefre"><label class="switchS switchSCuStatus">
						  <input name="verifiedEmail" data-statusid="'.$encodedID.'" value="1" class="switchS-input" type="checkbox" '.$isActivCheck.' />
						  <span class="switchS-label" data-on="Active" data-off="'.$offLbl.'"></span> <span class="switchS-handle"></span> </label></div>';
			
			$iURL_product = $this->config->item('default_path')['product'];
			$avtarURL = $iURL_product.'thumb/';
			$avtarURL .= $aRow['image'] ? $aRow['image'] : 'default.jpg';
			
			
			$cDetail = '<ul class=\'popovLst\'>
							<li class=\'prvImgPoA\'><img src=\''.$avtarURL.'\' /></li>
					    </ul>';
			
			$fullName = '<a href="javascript:;"  data-trigger="hover"  data-toggle="popover"  data-content="'.$cDetail.'">'.$aRow['name'].'</a>';
			
			$row   = array();
			$row[] = '<img width="100px" src=\''.$avtarURL.'\' />';
			$row[] = $fullName;

			$row[] = $aRow['sku_code'];
			
			$row[] = $status;			
			$row[] = '<div class="action-buttons">'.$btnAra.'</div>';
			$results[ 'data' ][] = $row;
		
		}
		$results[ "tempData" ] = '';
		echo json_encode( $results );
	}
	
	function add(){
		$data['slctQntityTypeAry'] = array();
		$data['slctQntity'] = array();
		$data['slctDiscType'] = array();
		$data['selctDisc'] = array();
		$data['slctPrice'] = array();
		$data['moreImagesArr'] = array();

		$data['typeAry'] = $this->common_model->getAll('*', 'type', array('isDeleted'=>1));
		$data['deliveryOptAry']  = $this->common_model->getAll( 'option_id,name', 'delivery_option', array('isDeleted' => '1', 'status' => '1' ));
		$data['relatedProductAry']  = $this->common_model->getAll( '*', 'product', array('isDeleted' => '1', 'status' => '1' ));
		$data['productSelectsAry'] = $data['categorySelectsAry'] = $data['typeSelectsAry'] = $data['productAray'] = $data['deliveryOptSelectsAry'] = array();
		$data['ePID'] = '';
		$data['activeMenu'] = 'store';
		$data['activeSubMenu'] = 'products';
		$this->load->view( 'admin/product_data', $data);
	}
	
	function edit($id=''){
		$ePID = $id;
		$id   = decode($id);
		
		$catOption 	 = $this->common_model->getAll('category_id, name, parent_id', 'category', array('isDeleted'=>'1','parent_id'=>'0'), 'sort_order asc');
		$productAray = $this->common_model->getAll('*', 'product', array('isDeleted'=>'1', 'product_id'=>$id));		
		
		$data['typeAry'] 			= $this->common_model->getAll('*', 'type', array('isDeleted'=>'1'));
		$data['deliveryOptAry']  	= $this->common_model->getAll( 'option_id,name', 'delivery_option', array('isDeleted' => '1', 'status' => '1' ));
		$data['relatedProductAry']  = $this->common_model->getAll( '*', 'product', array( 'isDeleted' => '1', 'status' => '1' ) );
		$data['productSelectsAry']  = $this->common_model->getAll( '*', 'product_to_related', array( 'product_id' => $id ) );
		$data['moreImagesArr']  = $this->common_model->getAll( '*', 'product_images', array( 'product_id' => $id ) );
		
		$data['typeSelectsAry'] 	= $this->common_model->getAll( '*', 'product_to_type', array('product_id' => $id ) );
		$data['deliveryOptSelectsAry'] 	= $this->common_model->getAll( '*', 'product_to_delivary_option', array('product_id' => $id ) );
		
		$productPriceMainAry =  $this->common_model->getAll( '*', 'product_price', array('product_id' => $id ) );

	   $slctQntityTypeAry = $slctQntity = $slctPrice = $slctDiscType = $selctDisc =  array();
		
		foreach($productPriceMainAry as $priceObjData){
			$slctQntityTypeAry[] = $priceObjData->quantity_type;
			$slctQntity[] 		 = $priceObjData->quantity;
			$slctPrice[] 		 = $priceObjData->product_price;
			$slctDiscType[] 	 = $priceObjData->discount_type;
			$selctDisc[] 		 = $priceObjData->discount;
		}
		
		$data['slctQntityTypeAry'] = $slctQntityTypeAry;
		$data['slctQntity'] = $slctQntity;
		$data['slctPrice'] = $slctPrice;
		$data['slctDiscType'] = $slctDiscType;
		$data['selctDisc'] = $selctDisc;
		
		//echo '<pre>';print_r($slctQntityTypeAry);
		//echo '<pre>';print_r($slctQntity);
		//echo '<pre>';print_r($slctPrice);
		//echo '<pre>';print_r($slctDiscType);
		//echo '<pre>';print_r($selctDisc);die;
		
		$data['productAray'] = $productAray;
		$data['parentArayList'] = $catOption;	
			
		$data['ePID'] = $ePID;
		
		$data['activeMenu'] = 'store';
		$data['activeSubMenu'] = 'products';
		$this->load->view( 'admin/product_data', $data);
	}
	
	function storeProduct(){
		if ( !$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access' );
		}
		
		
		$relatedProductAry = $this->input->post('related_product');
		$deliveryOptiontAry = $this->input->post('delivery_option');
		$quantityTypeAry   = $this->input->post('quantityType');
		$quantityAry 	   = $this->input->post('quantity');
		$priceAry		   = $this->input->post('price');
		$discountTypeAry   = $this->input->post('discountType');
		$discountValueAry  = $this->input->post('discountValue');
		$typeAry		   = $this->input->post('type');
		$category		   = $this->input->post('category');
		$categoryArr	   = explode(',', $category);


		$pid			= decode($this->input->post('pid'));
		$name 			= trim($this->input->post('name'));
		$slug 			= $this->input->post('url_slug');
		$price			= $this->input->post('price');
		$status 		= $this->input->post( 'isStatus' ) ? $this->input->post( 'isStatus' ) : '0';
		$desc 			= trim($this->input->post('desc'));
		$sku 			= trim($this->input->post('sku'));
		$availableDate	= $this->input->post('date') ? convertData($this->input->post('date')) : NULL;
		$sort			= $this->input->post('sort');
		$isEggless		= $this->input->post( 'isEggless' ) ? $this->input->post( 'isEggless' ) : '0';
	
		$metaTitle 		= trim($this->input->post('meta_title'));
		$metaDesc 		= trim($this->input->post('meta_desc'));
		$metaKey 		= trim($this->input->post('meta_keywords'));
		
		$deliveryDesc 	= trim($this->input->post('deliveryDesc'));
		$refundDesc 	= trim($this->input->post('refundDesc'));


				
		
		$data = array(
			'name' 			=> $name,
			'url_slug' 		=> $slug,
			'status' 		=> $status,
			'description' 	=> $desc,
			'sku_code' 		=> $sku,
			'date_available'=> $availableDate,
			'sort_number' 	=> $sort,
			'isEggless' 	=> $isEggless,
			'meta_title' => $metaTitle,
			'meta_description' => $metaDesc,
			'meta_keyword' => $metaKey,
			'delivery_description' => $deliveryDesc,
			'refund_description' => $refundDesc,
			
			
		);
		$notId = '';
		if($pid){
			$notId = array('product_id'=> array($pid));
		}
		
		$iCount = $this->common_model->getAll('count(product_id) as totl', 'product', array('isDeleted'=>'1','url_slug'=>$slug), '', '', $notId);
		$iCount = $iCount[0]->totl;
		if($iCount > 0){
			echo json_encode(array('status'=> 'slug_error'));
			exit;
		}
		
		$avtar = $_FILES['img']['name'];
		if($avtar){
			$data['image'] = uploadFiles('img', $path = 'uploads/product/', 'thumb', 360, 360 );
		}
		
		$number_of_files = sizeof($_FILES['images']['tmp_name']);
		$files 			 = $_FILES['images'];

		
		
		if($pid){
			$this->common_model->updateData('product', array('product_id'=>$pid), $data);
			$this->common_model->deleteData('product_to_type', array('product_id'=>$pid));	
			$this->common_model->deleteData('product_to_category', array('product_id'=>$pid));
			$this->common_model->deleteData('product_to_related', array('product_id'=>$pid));
			$this->common_model->deleteData('product_price', array('product_id'=>$pid));	
			$this->common_model->deleteData('product_to_delivary_option', array('product_id'=>$pid));	
			
			$status = 'updated';
			$id = $this->input->post('pid');
		}else{
		
			$data['created_on '] = date("Y-m-d H:i:s", time());
			$pid = $this->common_model->saveData('product', $data);			
			$status = 'added';
			$id = encode($pid);
			
		}
		
		
		if(isset($typeAry)){
			foreach($typeAry as $typeData){
				$tData[]= array(
					'product_id' => $pid,
					'type_id' => $typeData,
				);
			}
			$this->common_model->bulkSaveData('product_to_type', $tData);
		}	
		
		if(isset($deliveryOptiontAry)){
			foreach($deliveryOptiontAry as $optionData){
				$dData[]= array(
					'product_id' => $pid,
					'delivery_option_id' => $optionData,
				);
			}
			$this->common_model->bulkSaveData('product_to_delivary_option', $dData);
		}		
	
		if(isset($relatedProductAry)){
			foreach($relatedProductAry as $relatedProductsData){
				$rData[]= array(
					'product_id' => $pid,
					'product_related_id' => $relatedProductsData,
				);
			}
			$this->common_model->bulkSaveData('product_to_related', $rData);
		}
		if(isset($categoryArr)){
			foreach($categoryArr as $categoryData){
				$cData[]= array(
					'product_id' => $pid,
					'category_id' => $categoryData,
				);
			}
			$this->common_model->bulkSaveData('product_to_category', $cData);
		}
		
		if(isset($priceAry)){
			$i = 0;
			foreach($priceAry as $price){
				if($priceAry[$i] >= 0){
					$productPriceData[] = array(
						'product_id' => $pid,
						'quantity_type' => isset($quantityTypeAry[$i]) ? $quantityTypeAry[$i] : NULL,
						'quantity' =>  isset($quantityAry[$i]) ? $quantityAry[$i] : NULL,
						'product_price' => isset($priceAry[$i]) ? $priceAry[$i] : NULL,
						'discount_type' => isset($discountTypeAry[$i]) ? $discountTypeAry[$i] : NULL,
						'discount' =>  isset($discountValueAry[$i]) ? $discountValueAry[$i] : NULL,
					);
					$i++;
				}
			}
			$this->common_model->bulkSaveData('product_price', $productPriceData);
		}
		
		if(isset($files)){
				for($i=0;$i<$number_of_files;$i++){
					$_FILES['images']['name'] 		= $files['name'][$i];
					$_FILES['images']['type']		= $files['type'][$i];
					$_FILES['images']['tmp_name'] 	= $files['tmp_name'][$i];
					$_FILES['images']['error'] 		= $files['error'][$i];
					$_FILES['images']['size'] 		= $files['size'][$i];
					$imageName = uploadFiles('images', $path = 'uploads/product/', 'thumb', 360, 360 );
					$insertImgData[] = array(
							'image' => $imageName,
							'product_id' => $pid 
					);
				}
				
				$this->common_model->bulkSaveData('product_images', $insertImgData);	
		}
	
		
		echo json_encode(array('status'=> $status, 'id' => $id));		
	}
	
	function generateURLSlug(){
		if ( !$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access' );
		}
		//echo '<pre>';print_r($this->input->post());die;
		$catName = $this->input->post('data');
		$type = $this->input->post('type');
		$notId = $this->input->post('notId');
		if($notId){
			$notId = array('product_id'=> array(decode($notId)));
		}
		$slug = slugify($catName);
		
		
		$iCount = $this->common_model->getAll('count(product_id) as totl', 'product', array('isDeleted'=>'1','url_slug'=>$slug), '', '', $notId);
		$iCount = $iCount[0]->totl;
		
		if($iCount > 0 && $type == 'prd'){
			$iTotalAry = $this->manual_model->findDubliSlug($slug,'product');
			$iTotal = $iTotalAry[0]->iTotal;			
			$slug = $slug.($iTotal);
		}
		if($type == 'slug'){
			echo json_encode(array('status'=> $iCount > 0 ? 'error':'success'));
		}else if($type == 'prd'){
			echo json_encode(array('slug'=> $slug));
		}
		
	}
	
	function getCustomerGroupId(){
		if (!AID) {
			exit( 'Unauthorized Access' );
		}
		
		if($this->input->post('id')){
			$groupId = $this->input->post('id');
			$result  = $this->common_model->getAll('cid, fname, lname', 'customer', array('status'=>'1','isDeleted'=>'1','id'=>$groupId), 'cid asc');
		}
		
		if($this->input->post('id')){
			echo json_encode($result);
		}else{
			return($result);
		}		
	}
	
	function getCategoryList(){
		$categoryObj = $this->common_model->getAll( 'category_id, name, parent_id', 'category', array( 'isDeleted' => '1'), 'sort_order asc' );
		$pid = decode($this->input->post('pid'));
		$categorySelectsAry = $data = array();
		if($pid){
			$categorySelectsAry = $this->common_model->getAll( 'category_id', 'product_to_category', array('product_id' => $pid) );
			$categorySelectsAry = json_decode(json_encode($categorySelectsAry), true);
			$categorySelectsAry = array_column($categorySelectsAry, 'category_id');
		}
		
		$k = 0;
		foreach($categoryObj as $category){
			$data[$k] = array(
				'id' => $category->category_id,
				'pId' =>  $category->parent_id,
				'name' =>  $category->name,
			);
			if(in_array($category->category_id, $categorySelectsAry)){
				//$data[$k]['open'] = true;
				$data[$k]['checked'] = true;
			}
			$k++;
		}
		echo json_encode($data);
	}
}