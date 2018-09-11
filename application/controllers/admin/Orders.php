<?php
defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

class Orders extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'DataTblModel', 'datatablemodel');

	}
	
	function index() {
		$data['couponInfoAry'] = $this->common_model->getAll('*', 'orders', array('is_Deleted'=>'1'));
		$this->load->view( 'admin/orders_list', $data);
	}
	

	function orders_lst(){		
		if(!$this->input->is_ajax_request() || !AID) {
			exit('Unauthorized Access');
		}

		$iSQL = $sWhere = $sAnd = $inData = $notInData = $sOrder = $sLimit = '';
		
		
		if(isset($_REQUEST['filterData'])){
			foreach($_REQUEST['filterData'] as $inDataKey => $inDataVal){
				if($inDataKey == 'filter_role'){
					if($inDataVal){
						$inData .= ' AND role IN("'.implode('","', $inDataVal).'")';
					}
				}
				if($inDataKey == 'filter_status'){
					if($inDataVal){
						$inData .= ' AND status_type IN("'.implode('","', $inDataVal).'")';
					}
				}
				if($inDataKey == 'filter_data'){
					if($inDataVal){
						$inDataVal = explode("-",$inDataVal);
						$startDate = explode("/",trim($inDataVal[0]));
						$endDate = explode("/",trim($inDataVal[1]));
						$startDate = $startDate[2].'-'.$startDate[0].'-'.$startDate[1];
						$endDate = $endDate[2].'-'.$endDate[0].'-'.$endDate[1];
						
						$inData .= ' AND created_on BETWEEN "'.$startDate.'" AND "'.$endDate.'"';
					}
				}
				
			}
		}
		
		$recordsTotal = $this->common_model->countResults('orders', array('is_Deleted'=>'1'));
		
		$aColumns=array(
			'order_id',
			'invoice_no',
			'transaction_id',
			'customer_id',
			'address',
			'pin_code',
			'phone_number',
			'coupon',
			'status_type',
			'is_Deleted',
			'payment_mode',
			'created_on',
		);

		$iSQL = "FROM orders";
		$sAnd = " AND is_Deleted = '1'";
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
			$id = encode($aRow['order_id']);
			$statusId = encode($aRow['status_type']);
			
			$btnAra = ' <a class="green" data-tooltip="tooltip" title="Edit" href="'.base_url().'admin/coupons/edit/'.$id.'"> <i class="ace-icon fas fa-pencil-alt bigger-130"></i> </a>';
			
			$btnAra .= ' <a class="red" data-tooltip="tooltip" title="Delete" onClick="changeStatus(this, \''.$id.'\', \'delete\', \'coupon\');" href="javascript:;"> <i class="ace-icon far fa-trash-alt bigger-130"></i> </a>';
			
			$isActivCheck = '';
			$paymentMode = '';
			
			$offLbl = 'Active';
			
			if($aRow['status_type'] == '0'){
			
				$isActivCheck = '<a href="'.base_url().'orders/orderStatus/'.$id.'/'.$statusId.'" target="_blank" data-toggle="tooltip" title="Order Pending" class="badge badge-warningsuccess">Pending</a>';

			}else if($aRow['status_type'] == '1'){
				$isActivCheck = 'Way to Delivery';
				
			}else if($aRow['status_type'] == '2'){
				$isActivCheck = '<a href="'.base_url().'orders/orderStatus/'.$id.'/'.$statusId.'" target="_blank" data-toggle="tooltip" title="Order Complete" class="badge badge-success">Complete</a>';

			}else if($aRow['status_type'] == '3'){
				$kycStatus = '<a href="'.base_url().'customers/kyc/'.$id.'/'.$kycID.'" target="_blank" data-toggle="tooltip" title="Order Rejected: '.$aRow['comment'].'" class="badge badge-danger">Rejected</a>';
			
			}
			
						  
			$btnAra = '<a href="'.admin_url().'orders/orderQuickView/'.$id.'/" class="blue" data-tooltip="tooltip" > <i class="ace-icon fas fa-search-plus bigger-130"></i></a>';

			
			if($aRow['payment_mode'] == '1'){
				$paymentMode = 'COD';
			}if($aRow['payment_mode'] == '2') {
				$paymentMode = 'Online';
			}

			
			$row = array();
			$row[] = $aRow['order_id'];
			$row[] = $aRow['invoice_no'];
			$row[] = $aRow['transaction_id'];
			$row[] = $aRow['coupon'];
			$row[] = $paymentMode;
			$row[] = $isActivCheck;
			$row[] = date('jS M Y',strtotime($aRow['created_on']));
			$row[] = '<div class="action-buttons">'.$btnAra.'</div>';
			$results[ 'data' ][] = $row;
		}
		$results["tempData"] = '';
		echo json_encode( $results );
	}
	
	function orderQuickView($orderId){
		$oid = decode($orderId);
		$aColumns=array(
			'a.pin_code',
			'a.is_eggless',
			'a.actual_price',
			'a.discount',
			'a.total_price',
			'a.cake_message',
			'a.quantity',
			'a.delivery_date',
			'a.delivery_time_slot',
			
			
			'b.invoice_no',
			'b.transaction_id',
			'b.payment_mode',
			'b.customer_id',
			'b.address',
			'b.pin_code',
			'b.phone_number',
			'b.coupon',
			'b.status_type',
			'b.created_on',
			
			
			'd.name',
		);
		
		
		$orderDetailsObj = $this->manual_model->getOrderDetails(str_replace( " , ", " ", implode( ", ", $aColumns )), array('a.oid'=>$oid));
		
		$orderObj		 = $this->common_model->getAll('*', 'orders', array('is_Deleted'=>'1','order_id'=>$oid));
		$customer_id 	 = $orderObj[0]->customer_id;
		$billingAddressObj = $this->common_model->getAll('*', 'address', array('isDeleted'=>'1','isDefault'=>'1','cid'=>$customer_id));
		
		if(!$data){
			echo json_encode(array('requestStatus'=>'error'));
			exit;
		}
		
		$data['orderDetailsObj']   =  $orderDetailsObj;
		$data['orderObj'] 		   =  $orderObj;
		$data['orderDetailsObj']   =  $orderDetailsObj;
		$data['billingAddressObj'] =  $billingAddressObj;
		$this->load->view( 'admin/temolate/order_confirmation', $data);

		
		
	}
	

}