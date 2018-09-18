<?php
class Manual_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
		
	function checkLoginUserEmail($data='') {
		if($data !=''){
			$this->db->select('aid, password, status');
			$this->db->from('admin_user');
			$this->db->where('email',$data);
			$this->db->or_where('username', $data); 
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}
	
	function getFullCustomerData($select, $where){
		$this->db->select($select);
		$this->db->from('auth_user AS a');
		$this->db->join('fimcosite_profile AS b', 'a.id = b.user_id', 'LEFT');
		$this->db->join('fimcosite_account AS c', 'b.profile_id = c.profile_id', 'LEFT');
		$this->db->join('fimcosite_kyc AS d', 'c.account = d.account', 'LEFT');
		$this->db->where($where);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getLocationData($select, $where, $type){
		$this->db->select($select);
		if($type == 'city' || $type == 'state' || $type == 'pin'){
			$this->db->from('location_state AS a');
			$this->db->join('location_city AS b', 'a.sid = b.sid', 'LEFT');
		}
		if($type == 'pin'){
			$this->db->join('location_pin AS c', 'b.cid = c.cid', 'LEFT');
		}
		if($type == 'area'){
			$this->db->from('location_area AS a');
			$this->db->join('location_pin AS b', 'a.pin = b.pin', 'LEFT');
		}
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function checkImportCustomer($select, $table, $where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getFullGroupInfo($select, $where){
		$this->db->select($select);
		$this->db->from('customer_group AS a');
		$this->db->join('customer_group_member AS b', 'a.id = b.group_id', 'LEFT');
		$this->db->join('customer AS c', 'b.customer_id = c.id', 'LEFT');
		$this->db->where($where);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function checkLoginCustomerEmail($data='') {
		if($data !=''){
			$this->db->select('id, password, status, isEmail_verified, isSMS_verified, mobile, mobile_otp');
			$this->db->from('customer');
			$this->db->where('email',$data);
			$this->db->where('isDeleted','1');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}

	function getFullCustomerAddress($where, $order=array()){
		$this->db->select('a.*,b.cityName');
		$this->db->from('address AS a');
		$this->db->join('location_city AS b', 'a.stateCode = b.cid', 'LEFT');
		$this->db->where($where);
		if (!empty($order)){
			$this->db->order_by($order[0], $order[1]);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}	
	
	function findDubliSlug($table, $slug) {
		$SQL = 'SELECT count(url_slug) as iTotal FROM '.$table.' WHERE url_slug LIKE "'.$slug.'%"';
		$query = $this->db->query($SQL);
		return $query->result();
	}
	
	function getFullLocationData($select, $where){
		$this->db->select($select);
		$this->db->from('location_area AS a');
		$this->db->join('location_pin AS b', 'a.pin = b.pin', 'LEFT');
		$this->db->join('location_city AS c', 'b.cid = c.cid', 'LEFT');
		$this->db->join('location_state AS d', 'c.sid = d.sid', 'LEFT');		
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getProductListing($select, $where, $groupBy=''){
		$this->db->select($select);
		$this->db->from('product_to_category AS a');
		$this->db->join('product AS b', 'a.product_id = b.product_id', 'LEFT');
		$this->db->join('category AS c', 'a.category_id = c.category_id', 'LEFT');		
		$this->db->where($where);
		
		if($groupBy){
			$this->db->group_by($groupBy);
		}
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getProductList($select, $where){
		$this->db->select($select);
		$this->db->from('product_to_type AS a');
		$this->db->join('product AS b', 'a.product_id = b.product_id', 'LEFT');
		$this->db->join('type AS c', 'a.type_id = c.type_id', 'LEFT');
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getProductDeliverySlot($select, $where){
		$this->db->select($select);
		$this->db->from('product_to_delivary_option AS a');
		$this->db->join('delivery_option AS b', 'a.delivery_option_id = b.option_id', 'LEFT');
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function check_isSMS_verifieds($data='') {
		if($data !=''){
			$this->db->select('id, password, status, isEmail_verified, isSMS_verified');
			$this->db->from('customer');
			$this->db->where('email',$data);
			$this->db->where('isSMS_verified','1');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}

	function getWishlistListing($select, $where){
		$this->db->select($select);
		$this->db->from('wish_list AS a');
		$this->db->join('product AS b', 'a.pid = b.product_id', 'LEFT');
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function updateCartQty($id='',$type='+', $quantity = 1){
		if(!$id){
			return false;
		}
		$cidData = '';
		$cid = $this->session->userdata('CID');
		if($type == '+'){
			$sql = 'UPDATE `order_details` SET `quantity` = `quantity`+'.$quantity.' WHERE `id` = "'.$id.'"';
		}else{
			$sql = 'UPDATE `order_details` SET `quantity` = `quantity`-'.$quantity.' WHERE `id` = "'.$id.'"';
		}
		$query = $this->db->query($sql);
	}
	
	function getOrderDetails($select, $where){
		$this->db->select($select);
		$this->db->from('order_details AS a');
		$this->db->join('customer AS c', 'a.cid = c.id', 'LEFT');
		$this->db->join('product AS d', 'a.pid = d.product_id', 'LEFT');
		//$this->db->join('delivery_option AS e', 'a.delivary_option_id = e.option_id', 'LEFT');
		$this->db->join('product_price AS f', 'a.price_id = f.id', 'LEFT');
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
	
	function getTimeSlotList($select, $where, $order='', $inData=array(), $notinData=array(), $groupBy=''){
		$this->db->select($select);
		$this->db->from('delivery_option_slot AS a');
		$this->db->join('delivery_option AS b', 'a.option_id = b.option_id', 'LEFT');
		$this->db->join('time_slot AS c', 'a.slot_id = c.tid', 'LEFT');
		$this->db->where($where);
		
		if($inData){
			foreach($inData as $key=>$val){
				$this->db->where_in($key, $val);
			}			
		}
		if($notinData){
			foreach($notinData as $key=>$val){
				$this->db->where_not_in($key, $val);
			}			
		}
		if($groupBy){
			$this->db->group_by($groupBy);
		}
		if($order){
			$this->db->order_by($order);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}
}