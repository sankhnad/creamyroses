<!-- Breadcrumbs -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container producu-area">
	
<?php 
//echo '===<pre>';print_r($transactionId);die;

if($transactionId == 1){ 

	$updateId = updateOrderStatus($order_id, $transactionId);
	//echo '<strong>'.$this->input->post('ResponseMessage').'</strong>';
	echo '<p style="color:#cf5c7c; font-size:16px;">Thank you for your purchase!</p><br>
		  <p style="color:#cf5c7c; font-size:16px;">YOUR ORDER HAS BEEN RECEIVED.&nbsp;Your Order ID is '.$order_id.'<br><br /></p>
      	<br /> ';
	
	}else{
	 	echo '<p style="color:#cf5c7c; font-size:16px;">Sorry somthing wrong.</p> <br />';
	}
?>
</div>
<!--<div class="container-fluid producu-area">
  <div class="panel-contant">
    <?= $this->cheaplingerie->get_category_content($pcategory_id); ?>
  </div>
</div>-->
