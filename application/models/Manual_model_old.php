<?php
class Manual_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}	
	
	function checkLoginUserEmail($data='') {
		if($data !=''){
			$this->db->select('aid, password, status, isDeleted');
			$this->db->from('admin_user');
			$this->db->where('email',$data);
			$this->db->or_where('username', $data); 
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}
	
	function checkLoginCustomerEmail($data='') {
		if($data !=''){
			$this->db->select('fld_cid, fld_password, fld_status, fld_isEmail_verified, fld_isSMS_verified');
			$this->db->from('tbl_customer');
			$this->db->where('fld_email',$data);
			$this->db->where('fld_isDeleted','2');
			$this->db->or_where('fld_username', $data); 
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result();
		}
	}

	function getFullUserData($uid){		
		$this->db->select('a.*, b.fld_name as userTypeName, c.fld_blockName, d.fld_districtName, e.fld_stateName');
		$this->db->from('tbl_user AS a');
		$this->db->join('tbl_usertype AS b', 'a.fld_userType = b.fld_id', 'LEFT');
		$this->db->join('tbl_block AS c', 'a.fld_blockCode = c.fld_blockCode', 'LEFT');
		$this->db->join('tbl_district AS d', 'a.fld_districtCode = d.fld_districtCode', 'LEFT');
		$this->db->join('tbl_state AS e', 'a.fld_stateCode = e.fld_stateCode', 'LEFT');
		$this->db->where('a.fld_id',$uid);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}

	function getFullCustomerAddress($where, $order=array()){
		$this->db->select('a.*,b.fld_cityName');
		$this->db->from('tbl_address AS a');
		$this->db->join('tbl_city AS b', 'a.fld_stateCode = b.fld_cid', 'LEFT');
		$this->db->where($where);
		if ( !empty( $order ) ) {
			$this->db->order_by( $order[ 0 ], $order[ 1 ] );
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}	
	
	function createDublicateRecord($fromTbl='', $toTbl='', $select='*', $where='') {
		$SQL = 'INSERT INTO '.$toTbl.' 
				('.$select[0].') 
				SELECT '.$select[0].' 
				FROM '.$fromTbl.' '.$where;
		$query = $this->db->query($SQL);
		return $this->db->insert_id();
	}
	
	function findDubliSlug($slug,$fromTbl) {
		$SQL = 'SELECT count(fld_url_slug) as iTotal FROM '.$fromTbl.' WHERE fld_url_slug LIKE "'.$slug.'%"';
		$query = $this->db->query($SQL);
		return $query->result();
	}
	
	function getAreaData($aID='', $dID='', $sID='', $cID='') {
			$this->db->select('fld_aid, fld_pin, fld_areaName');
			$this->db->from('tbl_area');
			
			if($aID !=''){
				$this->db->where('fld_aid',$aID);
			}
			if($dID !=''){
				$this->db->where('fld_isDeleted',$dID);
			}
			if($sID !=''){
				$this->db->where('fld_status',$sID);
			}
			if($cID !=''){
				$this->db->where('fld_cid',$cID);
			}
			
			$query = $this->db->get();
			return $query->result();
	}
	
	function getVendorAreaDetails($where, $order=array()){
		$this->db->select('a.fld_pin,a.fld_areaName');
		$this->db->from('tbl_area AS a');
		$this->db->join('tbl_vendor_area AS b', 'a.fld_aid = b.fld_area_id', 'LEFT');
		$this->db->where($where);
		if ( !empty( $order ) ) {
			$this->db->order_by( $order[ 0 ], $order[ 1 ] );
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();		
	}	


}