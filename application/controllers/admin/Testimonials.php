<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Testimonials extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$data['activeMenu']     = 'others';
		$data['activeSubMenu']  = 'testimonials';
		$this->load->view( 'admin/testimonials_list', $data);
	
	}
	
	function testimonials_lst(){		
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
		
		$recordsTotal = $this->common_model->countResults('testimonials', array('isDeleted'=>'1'));
		
		$aColumns=array(
			'name',
			'designation',
			'company',
			'short_desc',
			'description',
			'avtar',
			'isDeleted',
			'status',
			'created_on',
			'tid',
		);

		$iSQL = "FROM testimonials";
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
			$id = encode($aRow['tid']);
			
			
		    $btnAra = '<a class="blue" data-tooltip="tooltip"   target="_blank" href="'.base_url().'admin/testimonials/edit/'.$id.'" title="Edit"><i class="ace-icon fas fa-pencil-alt bigger-130"></i></a>';
			
			
	        $btnAra .= '<a class="red" data-tooltip="tooltip" onclick="deleteTestimonial(this,\''.$id.'\', \'testimonial\')" title="Delete" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i></a>';
			
			$isActivCheck = '';
			$typeSelection = '';
			$offLbl = 'Active';
			if($aRow['status'] == '1'){
				$isActivCheck = 'checked';
			}else if($aRow['status'] == '0'){
				$offLbl = 'Inactive';
			}
			
			
			$status = '<div data-statusid="'.$id.'" onClick="changeTestimonialsStatus(this,\''.$id.'\',\'testimonial\')" class="swithAraBoxBefre"><label class="switchS switchSCuStatus">
						  <input name="group_status" value="1" class="switchS-input" type="checkbox" '.$isActivCheck.' />
						  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> </label></div>';			  
			$iURL_banner  = $this->config->item('default_path')['testimonials'];
			$avtarURL     = $iURL_banner.'thumb/';
			$avtarURL    .= $aRow['avtar'] ? $aRow['avtar'] : 'user.png';
			
	    	$cDetail = '<ul class=\'popovLst\'>
							<li class=\'prvImgPoA\'><img src=\''.$avtarURL.'\' /></li>
							<li class=\'prvImgPoA\'><strong>Name: </strong>'.$aRow['name'].'</li>
							<li class=\'prvImgPoA\'><strong>Designation: </strong>'.$aRow['designation'].'</li>
							<li class=\'prvImgPoA\'><strong>Company: </strong>'.$aRow['company'].'</li>
							
							
						
					    </ul>';
			
			$fullName = '<a href="javascript:;" data-trigger="hover"  data-toggle="popover"  data-content="'.$cDetail.'">'.$aRow['name'].'</a>';			  
			
				
			$row = array();
			$row[] = $fullName;
			$row[] = $aRow['designation'];
			$row[] = $aRow['company'];
			$row[] = $status;
			$row[] = '<div class="action-buttons">'.$btnAra.'</div>';
			$results[ 'data' ][] = $row;
		}
		$results["tempData"] = '';
	
		echo json_encode( $results );
	}
	
	function add(){
	    
		$data[ 'testimonialsAray' ] = array();
		$data[ 'activeMenu' ]       = 'others';
		$data[ 'activeSubMenu' ]    = 'testimonials';
		$data[ 'eTID' ]             = '';
	
		$this->load->view( 'admin/testimonials_data', $data );
	}
	
	function edit($id=''){
		
		$eTID    = $id;
		$id      = decode($id);
		$finalOu = array();
				
		$testimonialsAray = $this->common_model->getAll('*', 'testimonials', array('isDeleted'=>'1', 'tid'=>$id));
		
		if(!$testimonialsAray){
			$this->load->view('admin/404');
			exit;
		}
		
		$data[ 'activeMenu' ]       = 'others';
		$data[ 'activeSubMenu' ]    = 'testimonials';
		$data[ 'testimonialsAray' ] = $testimonialsAray;
		$data['eTID']               = $eTID;
		
		$this->load->view( 'admin/testimonials_data', $data );
	}
	
	
	function storeTestimonials(){
		if ( !$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access' );
		}
		
		//echo '<pre>';print_r($this->input->post());die;
		$tid        		= decode($this->input->post('tid'));
		$name       		= $this->input->post('name');
		$designation       	= $this->input->post('designation');
		$company   			= $this->input->post('company');
		$description 		= $this->input->post('description');
		$status     		= $this->input->post( 'status' ) ? $this->input->post( 'status' ) : '1';
		
		
		$data = array(
			'name'	  => $name,
			'designation' => $designation,
			'company' => $company,
			'description' => $description,
			'status' 	  => $status,
		);
			
		$avtar = $_FILES['img']['name'];
		
		
		if($tid){
			if($avtar){
				$data['avtar '] = uploadFiles('img', $path = 'uploads/testimonials/', 'thumb', 360, 360 );
			}
			
			$this->common_model->updateData('testimonials', array('tid'=>$tid), $data);
			$status = 'updated';
			$id = $this->input->post('tid');
		}else{
		
			if($avtar){
				$data['avtar '] = uploadFiles('img', $path = 'uploads/testimonials/', 'thumb', 360, 360 );
			}else{
				$data['avtar '] = 'default.jpg';
			}	

			
			$data['created_on'] = date("Y-m-d H:i:s", time());
			$id = $this->common_model->saveData('testimonials', $data);
			
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
		
		if($type == 'testimonial'){
			$where = array('tid'=>$id);
			$tbl = 'testimonials';
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
		
		if($type == 'testimonial'){
					
			$where = array('tid'=>$id);
			$tbl = 'testimonials';
			
		}
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}
}