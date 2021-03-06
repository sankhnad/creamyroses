<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by Sankhnad Mishra.
 * User: info@sankhnad.com
 * Date: 03 July 2018
 * Time: 05:14 PM
 */
if(! function_exists('uploadFiles')){
	function uploadFiles( $fileName, $path = 'uploads/', $thumbs = '', $height = 240, $width = 360, $fileType = 'img' ) {
		$CI = & get_instance();
		$picture = $_FILES[ $fileName ][ 'name' ];
		$uploadFileName = '';
		if ( $picture ) {
			$config[ 'encrypt_name' ] = TRUE;
			$config[ 'upload_path' ] = $path;
			if ( $fileType == 'img' ) {
				$config[ 'allowed_types' ] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
			} else if ( $fileType == 'doc' ) {
				$config[ 'allowed_types' ] = 'pdf|doc|docx|ppt|xls|xlsx|txt|PDF|DOC|DOCX|PPT|TXT|XLS|XLSX';
			}else{
				$config[ 'allowed_types' ] = $fileType;
			}
			
			$CI->load->library( 'upload', $config );
			$CI->upload->initialize( $config );
			if ( $CI->upload->do_upload( $fileName ) ) {
				$fileData = $CI->upload->data();
				$uploadFileName = $fileData[ 'file_name' ];
			}
			if ( $thumbs != ''  && isset($fileData)) {
				$CI->gallery_path = realpath( APPPATH . '../' . $path );
				$config1 = array(
					'image_library' => 'gd2',
					'source_image' => $fileData[ 'full_path' ],
					'new_image' => $CI->gallery_path . '/' . $thumbs,
					'maintain_ratio' => TRUE,
					'create_thumb' => TRUE,
					'thumb_marker' => '',
					'width' => $width,
					'height' => $height
				);
				$CI->load->library( 'image_lib', $config1 );
				$CI->image_lib->resize();
			}
			return $uploadFileName;
		}
	}
}

if(! function_exists('generateRandom')){
	function crypto_rand_secure($min, $max){
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
	function generateRandom($length,$type='all'){
		$token = "";
		if($type == 'all'){
		$codeAlphabet = "ABCEFGHJKLMNPQRSTUVWXYZ";
		$codeAlphabet.= "0123456789";
		}else if($type == 'string'){
			$codeAlphabet = "ABCEFGHJKLMNPQRSTUVWXYZ";
		}else if($type == 'number'){
			$codeAlphabet = "0123456789";
		}else{
			$codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+=-:"?><{}][/';
		}
		$max = strlen($codeAlphabet);
		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
		}
		return $token;
	}
}

if(! function_exists('trimData')){
	function trimData($str, $limit=100, $strip = false) {
		$str = ($strip == true)?strip_tags($str):$str;
		if (strlen ($str) > $limit) {
			$str = substr ($str, 0, $limit - 3);
			return (substr ($str, 0, strrpos ($str, ' ')).'...');
		}
		return trim($str);
	}
}

if(! function_exists('timeAgo')){
	function timeAgo($timestamp){
		$datetime1=new DateTime("now");
		$datetime2=date_create($timestamp);
		$diff=date_diff($datetime1, $datetime2);
		$timemsg='';
		if($diff->y > 0){
			$timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');
	
		}
		else if($diff->m > 0){
		 $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
		}
		else if($diff->d > 0){
		 $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
		}
		else if($diff->h > 0){
		 $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
		}
		else if($diff->i > 0){
		 $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
		}
		else if($diff->s > 0){
		 $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
		}	
		$timemsg = $timemsg.' ago';
		return $timemsg;
	}
}

if(! function_exists('encode')){
	function encode($str){		
		for($i=0; $i<3;$i++){
			//$str=strrev(base64_encode($str));
			$str = strtr(strrev(base64_encode($str)), '+/=', '._-');
		}
		return $str;
	}
}

if(! function_exists('decode')){	
	function decode($str){
	  for($i=0; $i<3;$i++){
		  //$str=base64_decode(strrev($str));
		  $str = base64_decode(strtr(strrev($str), '._-', '+/='));
	  }
	  return $str;
	}
}

if(! function_exists('getIndicatrIParent')){
    function getIndicatrIParent($iid='',$status='') {
		$CI = & get_instance();
		if($status != ''){
			$where = array('id'=>$iid, 'status'=>$status);
		}else{
			$where = array('id'=>$iid);
		}
		return $CI->common_model->getAll( '*', 'tbl_indicator_master', $where, array( 'sort', 'asc' ) );
	}
}

if (!function_exists('array_tree')){
  function array_tree($arr, $main_index, $parent_index, $child_index) {
    $new = array();
    foreach ($arr as $a){
      $new[$a[$parent_index]][] = $a;
    }
    // we create a closure in order to be recursive
    function create_tree(&$list, $parent, $i, $c) {
      $tree = array();
      foreach ($parent as $k => $l){
        if(isset($list[$l[$i]])){
          $l[$c] = create_tree($list, $list[$l[$i]], $i, $c);
        }
        $tree[] = $l;
      }
      return $tree;
    }
    return create_tree($new, $new[0], $main_index, $child_index);
  }
}

if(!function_exists('createNotification()')){
  function createNotification($data=array()) {
    if($data){
		$CI = & get_instance();
		return $CI->common_model->saveData("tbl_notification", $data);
	}
  }
}

if(! function_exists('notficationCount')){
    function notficationCount($uType, $status='') {
		$CI = & get_instance();
		if($status != ''){
			$where = array('visibleTo_id'=>$uType, 'is_read'=>$status);
		}else{
			$where = array('visibleTo_id'=>$uType);
		}
		return $CI->common_model->countResults('tbl_notification', $where);
	}
}

if(! function_exists('search_in_array')){
	function search_in_array($array, $key, $value){ 
		$results = array(); 

		if (is_array($array)) 
		{ 
			if (isset($array[$key]) && $array[$key] == $value) 
				$results[] = $array; 

			foreach ($array as $subarray) 
				$results = array_merge($results, search_in_array($subarray, $key, $value)); 
		} 

		return $results; 
	} 
}

if(! function_exists('lastLogin')){
	function lastLogin($uid){
		$CI = & get_instance();
		$lstLoginAry = $CI->common_model->getAll('created_date', 'admin_audittrail', array('userID'=>$uid, 'user_type'=>'0', 'action' => 'Login', 'status' => 'Success'), 'created_date desc', '', '', '', '2');
		if($lstLoginAry){
			if(isset($lstLoginAry[1]->created_date)){
				return date('jS M Y | h:i A', strtotime($lstLoginAry[1]->created_date));
			}else{
				return date('jS M Y | h:i A', strtotime($lstLoginAry[0]->created_date));
			}
		}else{
			return 'Today';
		}
	}
}

if(! function_exists('adminLastLogin')){
	function adminLastLogin($aid){
		$CI = & get_instance();
		$lstLoginAry = $CI->common_model->getAll('created_date', 'admin_audittrail', array('userID'=>$aid, 'user_type'=>'0', 'action' => 'Login', 'status' => 'Success'), 'created_date desc', '', '', '', '1');
		if($lstLoginAry){
			return $lstLoginAry[0]->created_date;
		}
	}
}

if(! function_exists('customerLastLogin')){
	function customerLastLogin($cid){
		$CI = & get_instance();
		$lstLoginAry = $CI->common_model->getAll('created_date', 'admin_audittrail', array('userID'=>$cid, 'user_type'=>'1', 'action' => 'Login', 'status' => 'Success'), 'created_date desc', '', '', '', '1');
		if($lstLoginAry){
			return $lstLoginAry[0]->created_date;
		}
	}
}

if(! function_exists('ispendingKYC')){
	function ispendingKYC(){
		$CI = & get_instance();
		return 5;
	}
}

if(! function_exists('ispendingContact')){
	function ispendingContact(){
		$CI = & get_instance();
		return $CI->common_model->countResults('admin_contact_us', array('isRead'=>'1'));
	}
}

if(! function_exists('getProductWishList')){
	function getProductWishList($pid, $cid){
		$CI = & get_instance();
		if(!$pid|| !$cid){
			return(false);
		}
		$data = array(
			'pid' => $pid,
			'cid' => $cid,
		);
		return $CI->common_model->getAll('id', 'wish_list', $data);
	}

}


if(! function_exists('ispendingBank')){
	function ispendingBank(){
		$CI = & get_instance();
		return 10;
	}
}

if(! function_exists('validatePassword')){
	function validatePassword($decrypted, $encrypted) { 
		// $decrypted, $encrypted = 'abc', 'pbkdf2_sha256$36000$7Ceq5OMccwI9$pK+DdwQKNPICUdCWF9aCvS3jqNCNJu5ySNv1WGa3uck='
		$pieces = explode("$", $encrypted);

		$iterations = $pieces[1];
		$salt = $pieces[2];
		$old_hash = $pieces[3];

		$hash = hash_pbkdf2("SHA256", $decrypted, $salt, $iterations, 0, true);
		$hash = base64_encode($hash);

		if ($hash == $old_hash) {
		   return true;
		}
		else {
		   return false; 
		}
	}
}

if(! function_exists('encryptPassword')){
	function encryptPassword($password, $iterations=36000, $algorithm='sha256'){
		// Django password in PHP
		$salt = base64_encode(openssl_random_pseudo_bytes(9));
		$hash = hash_pbkdf2($algorithm, $password, $salt, $iterations, 32, true);
		return 'pbkdf2_' . $algorithm . '$' . $iterations . '$' . $salt . '$' . base64_encode($hash);
	}
}

if(! function_exists('store_url')){
	function store_url($uri = ''){
		$domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
		$domain = preg_replace('/index.php.*/', '', $domain);
		if (!empty($_SERVER['HTTPS'])) {
			return 'https://' . $domain.'admin/';
		} else {
			return 'http://' . $domain.'admin/';
		}		
	}
}

if(! function_exists('admin_url')){
	function admin_url($uri = ''){
		$domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
		$domain = preg_replace('/index.php.*/', '', $domain);
		if (!empty($_SERVER['HTTPS'])) {
			return 'https://' . $domain.'admin/';
		} else {
			return 'http://' . $domain.'admin/';
		}		
	}
}

if(! function_exists('getTemplateEnSList')){
	function getTemplateEnSList($type = ''){
		$CI = & get_instance();
		if($type){
			$where = array('type'=>$type);
		}
		return $CI->common_model->getAll('id, title, default_title', 'admin_message_template', $where, 'created_on desc', '', array('isDeleted'=>array('0')));
	}
}

if(! function_exists('convertToSQLDate')){
	function convertToSQLDate($date='', $symbol = '/'){
		if(!$date){
			return date("Y-m-d H:i:s", time());
		}
		$bothDate = explode("-", $date);
		$startDate = explode( $symbol, trim($bothDate[0]));
		$startDate = $startDate[2].'-'.$startDate[0].'-'.$startDate[1];
		if(isset($bothDate[1])){
			$endDate = explode( $symbol, trim($bothDate[1]));			
			$endDate = $endDate[2].'-'.$endDate[0].'-'.$endDate[1];
			return array($startDate, $endDate);
		}else{
			return $startDate;
		}
	}
}

if(! function_exists('getCitiesList')){
    function getCitiesList($where = array()) {
		$CI = & get_instance();
		$where['isDeleted'] = '1';
		$where['status'] = '1';		
		$cityObj = $CI->common_model->getAll('*', 'location_city', $where, 'cityName asc');
		return $cityObj;
	}
}

if(! function_exists('getCategoryList')){
    function getCategoryList($where) {
		$CI = & get_instance();
		$ref = [];
		$items = [];
		$categoryObj = $CI->common_model->getAll('*', 'category', $where, 'sort_order asc');
		
		foreach ( $categoryObj as $categoryData ) {
			$thisRef = & $ref[ $categoryData->category_id ];
			$thisRef[ 'category_id' ] = $categoryData->category_id;
			$thisRef[ 'parent_id' ] = $categoryData->parent_id;
			$thisRef[ 'name' ] = $categoryData->name;
			$thisRef[ 'url_slug' ] = $categoryData->url_slug;
			$thisRef[ 'status' ] = $categoryData->status;
			$thisRef[ 'isDeleted' ] = $categoryData->isDeleted;
			$thisRef[ 'isTopBar' ] = $categoryData->isTopBar;
			$thisRef[ 'isLeftBar' ] = $categoryData->isLeftBar;
			$thisRef[ 'icon' ] = $categoryData->icon;
			$thisRef[ 'sort_order' ] = $categoryData->sort_order;
			if ( $categoryData->parent_id == 0 ) {
				$items[ $categoryData->category_id ] = & $thisRef;
			} else {
				$ref[ $categoryData->parent_id ][ 'child' ][ $categoryData->category_id ] = & $thisRef;
			}
		}
		return array($ref,$items);
	}
}

if(! function_exists('convertData')){
	function convertData($date, $type='database') {
		$newDate = false;
		if($type == 'database' && $date){
			$date =  explode("/",$date);
			if(isset($date[2])){
				$newDate = $date[2].'-'.$date[1].'-'.$date[0];
			}
		}
		if($type == 'front' && $date){
			$newDate = date('d/m/Y', strtotime($date));
		}
		return $newDate;
	}
}

if(!function_exists('slugify')){
	function slugify($string, $replace = array(), $delimiter = '-', $locale = 'en_US.UTF-8', $encoding = 'UTF-8') {
		if (!extension_loaded('iconv')) {
			throw new Exception('iconv module not loaded');
		}
		// Save the old locale and set the new locale
		$oldLocale = setlocale(LC_ALL, '0');
		setlocale(LC_ALL, $locale);
		$clean = iconv($encoding, 'ASCII//TRANSLIT', $string);
		if (!empty($replace)) {
			$clean = str_replace((array) $replace, ' ', $clean);
		}
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower($clean);
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		$clean = trim($clean, $delimiter);
		// Revert back to the old locale
		setlocale(LC_ALL, $oldLocale);
		return $clean;
	}
}

if(! function_exists('getProductist')){
    function getProductist($where) {
		$CI = & get_instance();
		$ref = [];
		$items = [];
		$productObj = $CI->common_model->getAll('*', 'product', $where, 'sort_order asc');
		foreach ( $productObj as $productData ) {
			$thisRef = & $ref[ $productData->product_id ];
			$thisRef[ 'product_id' ] = $productData->product_id;
			$thisRef[ 'model' ] = $productData->model;
			$thisRef[ 'name' ] = $productData->name;
			$thisRef[ 'url_slug' ] = $productData->url_slug;
			$thisRef[ 'image' ] = $productData->image;
			
			$thisRef[ 'quantity' ] = $productData->quantity;
			$thisRef[ 'stock_status_id' ] = $productData->stock_status_id;
			
			$thisRef[ 'price' ] = $productData->price;
			$thisRef[ 'date_available' ] = $productData->date_available;
			$thisRef[ 'weight' ] = $productData->weight;
			$thisRef[ 'weight_class_id' ] = $productData->weight_class_id;
			$thisRef[ 'lenght_class_id' ] = $productData->lenght_class_id;
			$thisRef[ 'length' ] = $productData->length;
			$thisRef[ 'width' ] = $productData->width;
			$thisRef[ 'height' ] = $productData->height;
			$thisRef[ 'description' ] = $productData->description;
			$thisRef[ 'status' ] = $productData->status;
			$thisRef[ 'sort_order' ] = $productData->sort_order;
			
			$items[ $productData->product_id ] = & $thisRef;
		}
		return array($items);
	}
}

if(! function_exists('getCustomerrData')){
    function getCustomerrData($where) {
		$CI = & get_instance();
		$customertObj = $CI->common_model->getAll('*', 'customer', $where);
		return $customertObj;
	}
}

if(! function_exists('getProductList')){

    function getProductList($typeId='') {

		$CI = & get_instance();

		$where['b.isDeleted'] = '1';

		$where['b.status'] = '1';	

		if($typeId !=''){
			$where['a.type_id'] = $typeId;	
		}		

		$hotelObj = $CI->manual_model->getProductList('b.*,c.url_slug as type_url,a.type_id', $where);

		return $hotelObj;

	}

}

if(! function_exists('getProductPrice')){

    function getProductPrice($prdId='') {

		$CI = & get_instance();


		if($prdId !=''){
			$where['product_id'] = $prdId;	
		}		

		$productPriceObj = $CI->common_model->getAll( '*', 'product_price', $where, 'product_price asc');
		return $productPriceObj;
	}
}

if(! function_exists('getDiscount')){
    function getDiscount($type, $prdctAmnt, $discountVal) {
		$totalDiscount = 0;
		if($type == 'F'){
			$totalDiscount = (float)$prdctAmnt - (float)$discountVal;
		}else if($type == 'P'){
			$totalDiscount = (float)$prdctAmnt - ((float)$prdctAmnt*(float)$discountVal/100);
		}
		return $totalDiscount;
	}
}

if(! function_exists('getDiscountFormat')){
	function getDiscountFormat($obj){	
		
		$finalPrice		= '';
		$price		 	= $obj['product_price'];
		$discountVal	= $obj['discount'];
		$discountType 	= $obj['discount_type'];
		$quantity 	 	= isset($obj['order_quantity']) ? $obj['order_quantity'] : $obj['quantity'];
		$quantity_type	= $obj['quantity_type'];			
		
		if($discountType == 'F'){
			$finalPrice = $price - $discountVal;
		}else if($discountType == 'P'){
			if($discountVal){
				$finalPrice = $price - ($price*$discountVal/100);
			}
		}
		
		if(!$discountVal){
			$finalPrice = $price;
		}
		return array(
			'oreginal_price'=>$price,
			'final_price' => $finalPrice,
			'discount_value' => $discountVal,
			'quantity' => $quantity,
			'quantity_type' => $quantity_type,
		);
	}
}

if(! function_exists('updateOrderStatus')){
    function updateOrderStatus($oderId,$transactionId) {
		$CI = & get_instance();
		
		$data['transaction_id'] = $transactionId;	
		$id = $CI->common_model->updateData('orders', array('order_id'=>$oderId), $data);
		
	
		$where['a.order_id'] = $oderId;	
		$orderObj 		   = $CI->manual_model->getOrderDetails('a.*,b.fname,b.lname,b.email',$where);
		$customer_email    = $orderObj[0]->email;
		
		$where1['a.order_id'] = $oderId;	
		$orderDetailsObj	= $CI->manual_model->getOrderDetailsData('a.*,b.product_name', $where1);
		
		$where2['order_id'] = $oderId;	
		$billingObj			= $CI->common_model->getAll('*', 'shipping', $where2);

		
		$CI->load->helper('url');
		$CI->load->library('email');
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);
		$CI->email->from('info@jk', 'CR');
		$CI->email->to($customer_email);
		$CI->email->bcc('info@jk');
		$CI->email->subject('Your order for Order Id '.$oderId.' is confirmed');	


		$data['orderObj']	 	 = $orderObj;
		$data['orderDetailsObj'] = $orderDetailsObj;
		$data['billingObj'] 	 = $billingObj;
		$data['payment_mode']= 'Online';
		
		$email = $CI->load->view("store/template/order_confirmation", $data,true);	
		//echo '<pre>';print_r($email);die;
		
		$CI->email->message( $email );
		$CI->email->send();				
		
		return $id;
	}

}

if(! function_exists('getOrderDetails')){
    function getOrderDetails($orderId) {
		$CI = & get_instance();
		$where['a.oid'] = $orderId;	
		$orderObj 		     = $CI->manual_model->getOrderDetails('a.*', $where);
		return $orderObj;
	}
}

if(! function_exists('getCartListingObj')){
	function getCartListingObj(){
		$CI = & get_instance();
		$cid = decode($CI->session->userdata('CID'));
		$select = array(
			'a.id as od_id',
			'a.pid',
			'a.price_id',
			'a.quantity as order_quantity',
			'd.image',
			'd.url_slug',
			'd.name',
			'f.quantity_type',
			'f.quantity',
			'f.product_price',
			'f.discount_type',
			'f.discount',
		);
		
		$where = array(
			'a.is_in_cart'=>'1'
		);
		if($cid){
			$where['a.cid'] = $cid;
		}else{
			$where['a.session_id'] = $CI->session->userdata('SESSION_ID');
		}
		return $CI->manual_model->getOrderDetails($select, $where);
	}
}

if(! function_exists('removeInvalidCart')){
	function removeInvalidCart($id){
		$CI = & get_instance();
		$cid = decode($CI->session->userdata('CID'));
		$where = array('id'=> $id, 'is_in_cart'=>'1');
		if($cid){
			$where['cid'] = $cid;
		}else{
			$where['session_id'] = $CI->session->userdata('SESSION_ID');
		}
		return $CI->common_model->deleteData('order_details', $where);
	}
}

if(! function_exists('getCartHTMLData')){
	function getCartHTMLData(){
		$CI = & get_instance();
		$cid = decode($CI->session->userdata('CID'));
		$iURL_product = $CI->config->item('default_path')['product'];
		$html = '';
		$getCartListingObj = getCartListingObj();
		if($getCartListingObj){

			$html .= '<ul class="mini-products-list" id="cart-sidebar">';

					$totalOrderQty = $afterDiscount_price = $beforeDiscount_price = $totalPriceAfterDiscount = 0;
					foreach($getCartListingObj as $getCartListing){

						if(!$getCartListing->product_price){
							removeInvalidCart($getCartListing->od_id);
							continue;
						}

						$productPriceObj = json_decode(json_encode($getCartListing), true);

						$productPrice = getDiscountFormat($productPriceObj);

						$beforeDiscount_price += $productPrice['oreginal_price'] ? ($productPrice['oreginal_price'] * $getCartListing->order_quantity) : 0;

						$afterDiscount_price += $productPrice['final_price'] * $getCartListing->order_quantity;

						$totalOrderQty += $getCartListing->order_quantity;

				$html .= '<li class="item last">
							<div class="item-inner">
								<a class="product-image" title="'.$getCartListing->name.'" href="'.base_url().$getCartListing->url_slug.'"><img alt="'.$getCartListing->name.'" src="'.$iURL_product.$getCartListing->image.'"> </a>
								<div class="product-details">
									<div class="access"><a class="btn-remove1" onClick="removeCartItem(this, '.$getCartListing->od_id.')" href="javascript:;">Remove</a> <a class="btn-edit" onClick="gotoPage(\''.base_url().'cart\')" title="Edit item" href="javascript:;"><i class="icon-pencil"></i></a> </div>

									<strong>'.$getCartListing->quantity.' '.$getCartListing->quantity_type.'</strong> <span class="price">'.$getCartListing->order_quantity.' &nbsp; x &nbsp; <i class=\'fas fa-rupee-sign\'></i> '.$productPrice['final_price'].' =  <i class=\'fas fa-rupee-sign\'></i> '.number_format(($productPrice['final_price'] * $getCartListing->order_quantity),2).'</span>
									<p class="product-name"><a href="'.base_url().$getCartListing->url_slug.'">'.trimData($getCartListing->name, 30).'</a> </p>
								</div>
							</div>
						</li>';
						}
			$html .= '</ul>';

			$html .= '<div class="actions">
						<button class="btn-checkout" onClick="gotoPage(\''.base_url().'checkout\')" title="Checkout" type="button"><span>Checkout</span> </button>
						<a href="javascript:;" onClick="gotoPage(\''.base_url().'cart\')" class="view-cart"><span>View Cart</span></a>
					</div>';
			$html .= '<script>
						$(".shoppingCartValue").html("'.$totalOrderQty.' Items/ <i class=\'fas fa-rupee-sign\'></i> '.number_format($afterDiscount_price,2).'")
					</script>';
		} else {
			echo '<li class="emptyCartWarn">Your cart is empty</li>';
		}
		return $html;
	}
}

if(! function_exists('getRewardBalance')){
	function getRewardBalance(){
		$CI = & get_instance();
		$cid = decode($CI->session->userdata('CID'));
		if($cid){
			$creditBal = $CI->common_model->getAll('SUM(amount) AS credit', 'referals', array('ref_cid'=>$cid, 'status'=>'1'));
			$debitBal = $CI->common_model->getAll('SUM(amount) AS debit', 'referals', array('ref_cid'=>$cid, 'status'=>'0'));
			
			$creditBal = $creditBal ? $creditBal[0]->credit : 0;
			$debitBal = $debitBal ? $debitBal[0]->debit : 0;
			return ($creditBal - $debitBal);
		}
		
		return 0;
	}
}

if(! function_exists('getTestimonial')){
	function getTestimonial(){
		$CI = & get_instance();
		return $CI->common_model->getAll('*', 'testimonials', array('isDeleted'=>'1', 'status'=>'1'));
	}
}

if(!function_exists('getSlider')){
	function getSlider(){
		$CI = & get_instance();
		return $CI->common_model->getAll('*', 'banner', array('isDeleted'=>'1', 'status'=>'1'));
	}
}
?>


