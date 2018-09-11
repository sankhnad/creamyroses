<?php
include('paths.php');
$adminDATA  = unserialize(adminDATA);
$cityListsObj = getCitiesList();

$CID = $this->session->userdata('CID');
$SESSION_ID = $this->session->userdata('SESSION_ID');
if(!$SESSION_ID){
	$SESSION_ID = generateRandom(15);
	$this->session->set_userdata('SESSION_ID', $SESSION_ID);
}

if(isset($CID)){
	$id = decode($CID);

	$where = array(
		'id' => $id,
	);

	$customerObj  = getCustomerrData($where);
	$customerName = $customerObj[0]->fname;
}

$catListAry = getCategoryList(array('isDeleted' => '1', 'status' => '1'));

//if(!AID || !isset($adminDATA[0]->fld_aid)){
	//redirect(base_url().'login');
//}

/*$csrf = array(
	'name' => $this->security->get_csrf_token_name(),
	'hash' => $this->security->get_csrf_hash()
);*/

?>
