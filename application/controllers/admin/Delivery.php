<?php
defined( 'BASEPATH' )OR exit( 'Unauthorized Access!!' );

class Delivery extends CI_Controller {
	
	function index() {
		$data['activeMenu'] = 'store';
		$data['activeSubMenu'] = 'delivery';
		$data['slotAry'] = $this->common_model->getAll('slot, tid', 'time_slot');
		$this->load->view('admin/delivery_option', $data);
	}
	
	
	function delivery_option_list() {
		if(!$this->input->is_ajax_request() || !AID) {
			exit('Unauthorized Access');
		}
		
		$iSQL = $sWhere = $sAnd = $inData = $notInData = $sOrder = $sLimit = '';
		
		if(isset($_REQUEST['filterData'])){
			foreach($_REQUEST['filterData'] as $inDataKey => $inDataVal){
				if ( $inDataKey == 'filter_status' ) {
					if($inDataVal){
						$inData .= ' AND status IN("'.implode('","', $inDataVal).'")';
					}
				}
				if($inDataKey == 'filter_date'){
					if($inDataVal){
						$tempDate = convertToSQLDate($inDataVal);
						$startDate = $tempDate[0];
						$endDate = isset($tempDate[1]) ? $tempDate[1] : '';
						$inData .= ' AND created_on BETWEEN "'.$startDate.'" AND "'.$endDate.'"';
					}
				}				
			}
		}	
		
		$recordsTotal = $this->common_model->countResults('location_state', array('isDeleted'=>'1'));
		
		$aColumns=array(
			'name',
			'(SELECT COUNT(*) FROM delivery_option_slot WHERE option_id = delivery_option.option_id AND isDeleted = 1) AS totalTimeSlot',
			'created_on',
			'status',
			'option_id',
			'price',
		);
		
		$iSQL = "FROM delivery_option";
		
		$quryTmp = $this->datatablemodel->multi_tbl_list($aColumns, 2);
		$sWhere = $quryTmp['where'] ? $quryTmp['where'] : ' WHERE 1 = 1 ';
		$sOrder = $quryTmp['order'];
		$sLimit = $quryTmp['limit'];
		$sAnd 	= ' AND isDeleted="1"';
		
		
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
			$id = encode($aRow['option_id']);
			
			$isActivCheck = '';
			if($aRow['status'] == '1'){
				$isActivCheck = 'checked';
			}
			
			$status = '<div data-statusid="'.$id.'" onClick="changeDeliveryStatus(this,\''.$id.'\',\'delievry\')" class="swithAraBoxBefre"><label class="switchS switchSCuStatus">
						  <input name="group_status" value="1" class="switchS-input" type="checkbox" '.$isActivCheck.' />
						  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> </label></div>';
			
			$btnAra = '<a class="blue" data-tooltip="tooltip" onclick="editDelivery(this,\''.$id.'\', \'delievry\')" title="Edit" href="javascript:;"> <i class="ace-icon fas fa-pencil-alt bigger-130"></i></a>';
			$btnAra .= '<a class="red" data-tooltip="tooltip" onclick="deleteDelivery(this,\''.$id.'\', \'delivery\')" title="Delete" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i></a>';
			
			$row = array();
			$row[] = $aRow['name'];
			$row[] = $aRow['price'];
			$row[] = $aRow['totalTimeSlot'];
			$row[] = date('jS M Y | h:i A',strtotime($aRow['created_on']));
			$row[] = $status;
			$row[] = '<span data-id="'.$id.'" class="btnAreaAction">'.$btnAra.'</span>';
			$results['data'][] = $row;
		}
		$results["tempData"] = '';
		echo json_encode( $results );
	}
	
	function addEditDelivery() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
		$did 	 = decode($this->input->post('did'));
		$timeAry = $this->input->post('tid');
		$name    = $this->input->post('name');
		$price    = $this->input->post('price');
		$data 	= array(
					'name'=>$name,
					'price'=>$price,
				);

		
		if($did){	
			$this->common_model->updateData('delivery_option`', array('option_id'=>$did), $data);
			$this->common_model->deleteData('delivery_option_slot', array('option_id'=>$did));
			foreach($timeAry as $timeData){
				$Tdata[]= array(
					'option_id' => $did,
					'slot_id' 	=> decode($timeData),
				);
			}
			$this->common_model->bulkSaveData('delivery_option_slot', $Tdata);

		}else{
			$data['created_on '] = date("Y-m-d H:i:s", time());
			$id = $this->common_model->saveData('delivery_option', $data);			
		
			foreach($timeAry as $timeData){
				$Tdata[]= array(
					'option_id' => $id,
					'slot_id' 	=> decode($timeData),
				);
			}
			$this->common_model->bulkSaveData('delivery_option_slot', $Tdata);

		}
		echo json_encode( array( 'status' => true ) );
	}
	
	

	
	function deleteData() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
		
		$id = decode($this->input->post('id'));
		$type = $this->input->post('type');
		$data = array('isDeleted'=>'0');
		
		if($type == 'delivery'){
			$recordsTotal = $this->common_model->countResults('delivery_option_slot', array('option_id'=>$id));
			if($recordsTotal > 0){
				echo json_encode( array( 'status' => 'child' ) );
				exit;
			}
			
			$where = array('option_id'=>$id);
			$tbl = 'delivery_option';
			
		}
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}
	
	function getData() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
		$id = decode($this->input->post('id'));
		$type = $this->input->post('type');
		
		
		 $deliveryAry = $this->common_model->getAll('name, option_id', 'delivery_option', array('option_id'=>$id));
		 $slotAry = $this->common_model->getAll('slot_id', 'delivery_option_slot', array('option_id'=>$id));
		 
		 foreach($slotAry as $data){
		 	$slotIds[] = encode($data->slot_id);
		 }

			$result = array(
				'did' => encode($id),
				'slotId' => $slotIds,
				'optName' => $deliveryAry[0]->name,
			);
			
			//echo '<pre>';print_r($result);die;
		echo json_encode($result);
	}
	
	function changeStatus() {
		if(!$this->input->is_ajax_request() || !AID ) {
			exit( 'Unauthorized Access!!' );
		}
		
		$id = decode($this->input->post('id'));
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$data = array('status'=>$value);
		
		$where = array('option_id'=>$id);
		$tbl = 'delivery_option';
		
		
		$this->common_model->updateData($tbl, $where, $data);
		echo json_encode( array( 'status' => 'success' ) );
	}
	
}

