<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Banner extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$data['activeMenu']     = 'others';
		$data['activeSubMenu']  = 'banner';
		$this->load->view( 'admin/banner_list', $data);
	
	}
	
	function banner_lst(){		
		if(!$this->input->is_ajax_request() || !AID) {
			exit('Unauthorized Access');
		}

		$iSQL = $sWhere = $sAnd = $inData = $notInData = $sOrder = $sLimit = '';
		
		
		if(isset($_REQUEST['filterData'])){
			foreach($_REQUEST['filterData'] as $inDataKey => $inDataVal){
				
				if($inDataKey == 'filter_status'){
					if($inDataVal){
						$inData .= ' AND status IN("'.implode('","', $inDataVal).'")';
					}
				}
				
				
			}
		}
		
		$recordsTotal = $this->common_model->countResults('banner', array('isDeleted'=>'1'));
		
		$aColumns=array(
			'heading',
			'description',
			'button_text',
			'button_link',
			'avtar',
			'isDeleted',
			'status',
			'created_on',
			'bid',
		);

		$iSQL = "FROM banner";
		$sAnd = " AND isDeleted = '1'";
		$quryTmp = $this->datatablemodel->multi_tbl_list($aColumns, 3);
		$sWhere = $quryTmp['where'] ? $quryTmp['where'] : ' WHERE 1 = 1 ';
		$sOrder = $quryTmp['order'];
		$sLimit = $quryTmp['limit'];

		$sQuery = "SELECT " . str_replace( " , ", " ", implode( ", ", $aColumns ) ) . " 
		$iSQL
		$sWhere
		$sAnd
		$inData
		$notInData
		$sOrder
		$sLimit
		";		
		$qtrAry = $this->common_model->customQuery($sQuery);
		
		$sQuery = "SELECT COUNT(".$aColumns[0].") AS iFiltered
		$iSQL
		$sWhere
		$sAnd
		$inData
		$notInData
		";
		$iFilteredAry = $this->common_model->customQuery($sQuery);
		$recordsFiltered = $iFilteredAry[0]['iFiltered'];
		
		$sEcho = $this->input->get_post('draw',true );
		$results = array(
			"draw" => intval($sEcho),
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => array(),
			"tempData" => $qtrAry
		);
		
		foreach ($results['tempData'] as $aKey => $aRow) {		
			$id = encode($aRow['bid']);
			
			
		    $btnAra = '<a class="blue" data-tooltip="tooltip"   target="_blank" href="'.base_url().'admin/banner/edit/'.$id.'" title="Edit"><i class="ace-icon fas fa-pencil-alt bigger-130"></i></a>';
			
			
	        $btnAra .= '<a class="red" data-tooltip="tooltip" onclick="deleteBanner(this,\''.$id.'\', \'banner\')" title="Delete" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i></a>';
			
			$isActivCheck = '';
			$typeSelection = '';
			$offLbl = 'Active';
			if($aRow['status'] == '1'){
				$isActivCheck = 'checked';
			}else if($aRow['status'] == '0'){
				$offLbl = 'Inactive';
			}
			
			
			$status = '<div data-statusid="'.$id.'" onClick="changeBannerStatus(this,\''.$id.'\',\'banner\')" class="swithAraBoxBefre"><label class="switchS switchSCuStatus">
						  <input name="group_status" value="1" class="switchS-input" type="checkbox" '.$isActivCheck.' />
						  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> </label></div>';			  
			$iURL_banner  = $this->config->item('default_path')['banner'];
			$avtarURL     = $iURL_banner.'thumb/';
			$avtarURL    .= $aRow['avtar'] ? $aRow['avtar'] : 'user.png';
			
	    	$cDetail = '<ul class=\'popovLst\'>
							<li class=\'prvImgPoA\'><img src=\''.$avtarURL.'\' /></li>
					    </ul>';
			
			$fullName = '<a href="javascript:;" data-trigger="hover"  data-toggle="popover"  data-content="'.$cDetail.'">'.$aRow['heading'].'</a>';			  
			
				
			$row = array();
			$row[] = $fullName;
			$row[] = $aRow['description'];
			$row[] = $aRow['button_text'];
			$row[] = $aRow['button_link'];
			$row[] = date('jS M Y',strtotime($aRow['created_on']));
			$row[] = $status;
			$row[] = '<div class="action-buttons">'.$btnAra.'</div>';
			$results[ 'data' ][] = $row;
		}
		$results["tempData"] = '';
	
		echo json_encode( $results );
	}
	
	function add(){
	    
		$data[ 'bannerAray' ]       = array();
		$data[ 'activeMenu' ]       = 'others';
		$data[ 'activeSubMenu' ]    = 'banner';
		$data[ 'eBID' ]             = '';
	
		$this->load->view( 'admin/banner_data', $data );
	}
	
	function edit($id=''){
		$eBID    = $id;
		$id      = decode($id);
		$finalOu = array();
				
		$bannerAray = $this->common_model->getAll('*', 'banner', array('isDeleted'=>'1', 'bid'=>$id));
		
		if(!$bannerAray){
			$this->load->view('admin/404');
			exit;
		}
		$data[ 'activeMenu' ]       = 'others';
		$data[ 'activeSubMenu' ]    = 'banner';
		$data[ 'bannerAray' ]       = $bannerAray;
		$data['eBID']               = $eBID;
		$this->load->view( 'admin/banner_data', $data );
	}
	
	
	function storeBanner(){
		if ( !$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access' );
		}
		
	
		$bid        = decode($this->input->post('bid'));
		$heading       = $this->input->post('heading');
		$description       = $this->input->post('description');
		$buttonLink   = $this->input->post('buttonLink');
		$buttontext  = $this->input->post('buttontext');
		$status     = $this->input->post( 'status' ) ? $this->input->post( 'status' ) : '1';
		
		
		$data = array(
			'heading' => $heading,
			'description' => $description,
			'button_text' => $buttontext,
			'button_link' => $buttonLink,
			'status' => $status,
		);
			
		$avtar = $_FILES['img']['name'];
		
		
		if($bid){
			if($avtar){
				$data['avtar '] = uploadFiles('img', $path = 'uploads/banner/', 'thumb', 360, 360 );
			}		
			$this->common_model->updateData('banner', array('bid'=>$bid), $data);
			$status = 'updated';
			$id = $this->input->post('bid');
		}else{
			if($avtar){
				$data['avtar '] = uploadFiles('img', $path = 'uploads/banner/', 'thumb', 360, 360 );
			}else{
				$data['avtar '] = 'default.jpg';
			}
			
			$data['created_on'] = date("Y-m-d H:i:s", time());
			$id = $this->common_model->saveData('banner', $data);
			
			$status = 'added';
			$id = encode($id);
		}
		
		echo json_encode(array('status'=> $status, 'id' => $id));		
	}

	
	function changeStatus() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
	
		$id = decode($this->input->post('id'));
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$data = array('status'=>$value);
		
		if($type == 'banner'){
			$where = array('bid'=>$id);
			$tbl = 'banner';
		}
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}
	
	function deleteData() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
		
		$id   = decode($this->input->post('id'));
		$type = $this->input->post('type');
		$data = array('isDeleted'=>0);
		
		if($type == 'banner'){
					
			$where = array('bid'=>$id);
			$tbl = 'banner';
			
		}
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}
}