<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Customers extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'DataTblModel', 'datatablemodel');
	}
	
	function index() {
		$data['groupAry'] = $this->common_model->getAll('id, name', 'customer_group', array('isDeleted'=>'1', 'status'=>'1'));
		$data['activeMenu'] = 'customers';
		$this->load->view( 'admin/customer_list', $data);
	}
	
	function customer_list() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		
		$iSQL = $sWhere = $sAnd = $inData = $notInData = $sOrder = $sLimit = '';
		$tbl = 'customer';

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

		$recordsTotal = $this->common_model->countResults($tbl, array('isDeleted'=>'1'));

		$aColumns=array(
			'fname',
			'lname',
			'email',
			'mobile',
			'gender',
			'avtar',
			'dob',
			'doa',
			'isEmail_verified',
			'isSMS_verified',
			'status',
			'created_on',
			'id',
		);
		
		$iSQL = " FROM ".$tbl;

		$quryTmp = $this->datatablemodel->multi_tbl_list( $aColumns, 0 );
		$sWhere = $quryTmp[ 'where' ] ? $quryTmp[ 'where' ] : ' WHERE 1 = 1 ';
		$sOrder = $quryTmp[ 'order' ];
		$sLimit = $quryTmp[ 'limit' ];		
		
		$sAnd =  ' AND isDeleted = "1"';
		
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

		$sQuery = "SELECT COUNT(".$aColumns[1].") AS iFiltered
		$iSQL
		$sWhere
		$sAnd
		$inData
		$notInData
		";
		
		$iFilteredAry = $this->common_model->customQuery( $sQuery );
		$recordsFiltered = $iFilteredAry[ 0 ][ 'iFiltered' ];

		$sEcho = $this->input->get_post( 'draw', true );
		$results = array(
			"draw" => intval( $sEcho ),
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => $recordsFiltered,
			"data" => array(),
			"tempData" => $qtrAry
		);
		
		foreach ( $results['tempData'] as $aKey => $aRow ) {		
			$id = $aRow['id'];
			$encodedID = encode($id);
			
			$lastLogin = customerLastLogin($id);
			if($lastLogin){
				$lastLogin = date('jS M Y | h:i A', strtotime($lastLogin));
			}else{
				$lastLogin = 'Never Login';
			}
			$registeredOn = date('jS M Y | h:i A',strtotime($aRow['created_on']));
			
			$btnAra = ' <a class="green" data-tooltip="tooltip" title="Quick View" onClick="adminQuickView(\''.$id.'\')" href="javascript:;"> <i class="ace-icon fas fa-search-plus bigger-130"></i></a>';
			
			$btnAra .= ' <a class="grey" data-tooltip="tooltip" title="Last Login :<br> '.$lastLogin.' " href="'.base_url().'customers/activity_log/'.$encodedID.'"> <i class="ace-icon fas fa-undo-alt bigger-130"></i> </a>';
			
			$btnAra .= ' <a class="blue" data-tooltip="tooltip" title="Edit" href="'.admin_url().'customers/edit/'.$encodedID.'"> <i class="ace-icon fas fa-pencil-alt bigger-130"></i> </a>';
			
			$btnAra .= ' <a class="red" data-tooltip="tooltip" title="Delete" onClick="deleteCommon(this,\''.$encodedID.'\',\'customers\')" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i> </a>';
			
			
			
			$isActivCheck = '';
			$offLbl = 'Inactive';
			if($aRow['status'] == '1'){
				$isActivCheck = 'checked';
				$offLbl = 'Active';
			}
			
			$status = '<div data-status="'.$aRow['status'].'" onClick="changeStatus(this, \''.$encodedID.'\', \'status\', \'customer\')" data-state="'.$offLbl.'" class="swithAraBoxBefre"><label class="switchS switchSCuStatus">
						  <input name="verifiedEmail" data-statusid="'.$encodedID.'" value="1" class="switchS-input" type="checkbox" '.$isActivCheck.' />
						  <span class="switchS-label" data-on="Active" data-off="'.$offLbl.'"></span> <span class="switchS-handle"></span> </label></div>';
			
			$iURL_profile = $this->config->item('default_path')['profile'];
			$avtarURL = $iURL_profile.'thumb/';
			$avtarURL .= $aRow['avtar'] ? $aRow['avtar'] : 'user.png';
			
			$cDetail = '<ul class=\'popovLst\'>
							<li class=\'prvImgPoA\'><img src=\''.$avtarURL.'\' /></li>
							<li><strong>Email:</strong> '.$aRow['email'].'</li>
							<li><strong>Phone:</strong> '.$aRow['mobile'].'</li>
							<li><strong>DOB:</strong> '.date('jS M Y',strtotime($aRow['dob'])).'</li>
							<li><strong>Status:</strong> '.$offLbl.'</li>
							<li><strong>Registered:</strong> '.$registeredOn.'</li>
							<li><strong>Last Login:</strong> '.$lastLogin.'</li>
					    </ul>';
			
			$fullName = '<a href="javascript:;" onClick="customerQuickView(\''.$encodedID.'\')" title="'.$aRow['fname'].' '.$aRow['lname'].'" data-trigger="hover"  data-toggle="popover"  data-content="'.$cDetail.'">'.$aRow['fname'].' '.$aRow['lname'].'</a>';
			

			$row = array();	
			$row[] = $fullName;
			$row[] = '<a href="mailTo: '.$aRow['email'].'">'.$aRow['email'].'</a>';
			$row[] = '<a href="tel: '.$aRow['mobile'].'">'.$aRow['mobile'].'</a>';
			$row[] = $registeredOn;
			$row[] = $status;			
			$row[] = '<div class="action-buttons">'.$btnAra.'</div>';
			$results[ 'data' ][] = $row;
		
		}
		$results[ "tempData" ] = '';
		echo json_encode( $results );
	}	
	
	function add(){
		$customerDisAry = $addressList = array();
		$groupAry = $this->common_model->getAll('id, name, isDefault', 'customer_group', array('status'=>'1', 'isDeleted'=>'1'));
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$data['addressList'] = $addressList;
		$data['customerData'] = $customerDisAry;
		$data['groupAry'] = $groupAry;
		$data['cid'] = '';
		$data['activeMenu'] = 'customers';
		$this->load->view( 'admin/customer_data', $data);
	}
	
	function edit($id=''){
		if(!AID ) {
			exit( 'No direct script access allowed' );
		}
		$encriptedID = $id;
		$id = decode($id);
		if(!$id){
			$this->load->view('admin/404');
			return(false);
		}
		$customerData = $this->common_model->getAll('*', 'customer', array('isDeleted'=>'1', 'id'=>$id));
		$addressList = $this->manual_model->getFullCustomerAddress(array('a.isDeleted'=>'1'), array('a.isDefault','asc'));
		
		if(!$customerData){
			$this->load->view('admin/404');
			return(false);
		}
		$groupAry = $this->common_model->getAll('id, name, isDefault', 'customer_group', array('status'=>'1', 'isDeleted'=>'1'));
		
		$groupSelectedAry = $this->common_model->getAll('group_id', 'customer_group_member', array('customer_id'=>$id));
		$groupSelectedAry = json_decode(json_encode($groupSelectedAry), true);
		
		$data['stateAry'] = $this->common_model->getAll('sid, stateName', 'location_state', array('status'=>'1', 'isDeleted'=>'1'));
		$data['addressList'] = $addressList;
		$data['customerData'] = $customerData;
		$data['groupAry'] = $groupAry;
		$data['groupSelectedAry'] = $groupSelectedAry;
		$data['cid'] = $encriptedID;
		$data['activeMenu'] = 'customers';
		$this->load->view( 'admin/customer_data', $data);
	}
	
	function customerAddEdit() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		
		$output = '';
		$cid = decode($this->input->post('id'));
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$groupAry = $this->input->post('group');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');		
		$gender = $this->input->post('gender') == '1' ? 'M' : 'F';
		$dob = $this->input->post('dob') ? convertData($this->input->post('dob')) : NULL;
		$doa = $this->input->post('doa') ? convertData($this->input->post('doa')) : NULL;
		$password = $this->input->post('password');
		$verifiedEmail = $this->input->post('verifiedEmail') ? '1' : '0';
		$verifiedSMS = $this->input->post('verifiedSMS') ? '1' : '0';
		$status = $this->input->post('status') ? '1' : '0';
		
		
		$chekEmail = $this->checkCustEmailAvlb( $email, 'email', $cid);
		if ($chekEmail == 'error' ) {
			$output = 'email-error';
		} else if($mobile){
			$chekUser = $this->checkCustEmailAvlb( $mobile, 'mobile', $cid);
			if ($chekUser == 'error') {
				$output = 'user-error';
			}
		}
		if($output){
			echo json_encode( array( 'status' => $output ) );
			return(false);
		}

		$data = array(
			'fname'	=> $fname,
			'lname'	=> $lname,
			'email'	=> $email,
			'mobile'=> preg_replace('/\s+/', '', $mobile),
			'gender'=> $gender,
			'dob'	=> $dob,
			'doa'	=> $doa,
			'isEmail_verified'=> $verifiedEmail,
			'isSMS_verified'=> $verifiedSMS,
			'status'=> $status ? $status : 2,			
		);
		
		
		
		$avtar = $_FILES['avtar']['name'];
		if($avtar){
			$data['avtar'] = uploadFiles('avtar', $path = 'uploads/profile/', 'thumb', 360, 360 );
		}		
		
		if($password){
			$data['password'] = md5($password);
		}else{
			if(!$cid){
				$tempPass = generateRandom(5);
				$data['password'] = md5($tempPass);
			}
		}
		if($cid){		
			$this->common_model->updateData('customer', array('id'=>$cid), $data);
		}else{
			$data['created_on'] = date( "Y-m-d H:i:s", time() );
			$cid = $this->common_model->saveData( "customer", $data );
		}
		
		
		$this->common_model->deleteData('customer_group_member', array('customer_id' => $cid));
		if($groupAry){
			foreach($groupAry as $group){
				$groupData[] = array(
					'group_id' => $group,
					'customer_id' => $cid,
					'member_status' => '1',
				);
			}
			$this->common_model->bulkSaveData('customer_group_member', $groupData);
		}
		
		
		echo json_encode( array( 'status' => true, 'cid' => encode($cid)) );
	}
	
	function checkCustEmailAvlb( $data = '', $type = '', $cid='' ) {
		if ( !$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		$data = $data == '' ? $_REQUEST[ 'data' ] : $data;
		$type = $type == '' ? $_REQUEST[ 'type' ] : $type;
		if(isset($_REQUEST['id']) || $cid){
			$cid = $cid == '' ? decode($_REQUEST['id']) : $cid;
		}
		if ( $type == 'email' ) {
			$where = array( 'email' => $data );
		} elseif ( $type == 'mobile' ) {
			$where = array( 'mobile' => $data );
		} else {
			return false;
		}
		if($cid !=''){
			$notinData = array('id'=> array($cid));
		}else{
			$notinData = array();
		}
		
		$data = $this->common_model->getAll('id', 'customer', $where, '', '', $notinData);
		if ( count( $data ) > 0 ) {
			$status =  'error';
		} else {
			$status =  'valid';
		}
		if(isset($_REQUEST['data'])){
			echo json_encode( array( 'status' => $status ) );
		}else{
			return($status);
		}
	}
		
	function changeStatus() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		$id = decode($this->input->post('cid'));
		$status = $this->input->post('status');
		$type = $this->input->post('type');
		
		if($type == 'delete'){
			$data = array(
				'isDeleted'=> $status,
			);
		}else{
			$data = array(
				'status'=> $status,
			);
		}
		$this->common_model->updateData('customer', array('cid'=>$id), $data);
		echo json_encode( array( 'status' => true ) );
	}
	
	function editNewAddress(){
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'No direct script access allowed' );
		}
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$name = trim($this->input->post('name'));
		$mobile = $this->input->post('mobile');
		$pin = $this->input->post('pin');
		$addresline1 = trim($this->input->post('addresline1'));
		$addresline2 = trim($this->input->post('addresline2'));
		$landmark = trim($this->input->post('landmark'));
		$city = trim($this->input->post('city'));
		$state = $this->input->post('state');
		$isDefault = $this->input->post('isDefault');
		$type = $this->input->post('type');
		$remarks = $this->input->post('remarks');		
		
		$data = array(
			'cid'		=> $cid,
			'name'		=> rtrim($name,','),
			'mobile'	=> str_replace(' ', '', $mobile),
			'pin'		=> $pin,
			'address_line_1'=> rtrim($addresline1,','),
			'address_line_2'=> rtrim($addresline2,','),
			'landmark'	=> rtrim($landmark,','),
			'city'		=> rtrim($city,','),
			'stateCode'	=> $state,
			'type'	=> $type,
			'remarks'	=> $remarks,
		);
		
		$table = 'address';
		if($isDefault){
			$this->common_model->updateData($table, array('isDefault'=>'1', 'cid'=>$cid), array('isDefault'=>'0'));
			$data['isDefault'] = '1';
		}else{
			$data['isDefault'] = '0';
		}
		if($aid){		
			$this->common_model->updateData($table, array('aid'=>$aid), $data);
		}else{
			$data['created_on'] = date( "Y-m-d H:i:s", time() );
			$aid = $this->common_model->saveData($table, $data );
		}
		echo json_encode( array('aid' => encode($aid)) );
	}
	
	function getAddress(){
		$output = '';
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$where = array(
			'cid'		=> $cid,
			'aid'		=> $aid,
			'isDeleted'		=> '1',
		);
		$data = $this->common_model->getAll('*', 'address', $where);
		if($data){
			$output = array(
				'name'		=> $data[0]->name,
				'mobile'	=> $data[0]->mobile,
				'pin'		=> $data[0]->pin,
				'address_line_1'=> $data[0]->address_line_1,
				'address_line_2'=> $data[0]->address_line_2,
				'landmark'	=> $data[0]->landmark,
				'city'		=> $data[0]->city,
				'sid'	=> $data[0]->stateCode,
				'type'	=> $data[0]->type,
				'isDefault'	=> $data[0]->isDefault,
				'remarks'	=> $data[0]->remarks,
			);
		}
		echo json_encode($output);
	}
	
	function setDefaultAddress(){
		$tbl = 'address';
		$aid = decode($this->input->post('aid'));
		$cid = decode($this->input->post('cid'));
		$this->common_model->updateData($tbl, array('isDefault'=>'1'), array('isDefault'=>'0', 'cid'=>$cid));
		
		$aid = decode($this->input->post('aid'));
		$where = array('aid'=>$aid);
		$data = array(
			'isDefault'=> '1',
		);
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => true ) );
	}
	
	function deleteAddress(){
		$tbl = 'address';
		$this->input->post('id');
		$aid = decode($this->input->post('id'));
		$where = array('aid'=>$aid);
		$data = array(
			'isDeleted'=> '0',
		);
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}	
}