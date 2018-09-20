<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
		<title>My Orders | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">

		<?php include("includes/header.php"); ?>

		<!-- Main Container -->
		<section class="main-container col2-left-layout">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-9 col-sm-push-3">
						<article class="col-main">
							<div class="my-account">
								<div class="page-title">
									<h2>My Dashboard</h2>
								</div>
								<div class="dashboard">
									<div class="recent-orders">
										<div class="title-buttons"><strong>Recent Orders</strong> <!--<a href="#">View All </a>--> </div>
										<div class="table-responsive">
											<table class="data-table" id="my-orders-table">
												<col>
												<col>
												<col>
												<col width="1">
												<col width="1">
												<col width="1">
												<thead>
													<tr class="first last">
														<th>Order #</th>
														<th>Invoice No.</th>
														<th>Payment Mode</th>
														<th>Delivery Date</th>
														<th>Delivery Time</th>
														<th><span class="nobr">Order Total</span></th>
														<th>Status</th>
														<th>&nbsp;</th>
													</tr>
												</thead>
												<tbody>
												<?php 
												if(count($ordersAry)>0){
												foreach($ordersAry as $orderData){ 
															$paymentMode  		=	$orderData->payment_mode == 1?'COD':'Online';
															$orderDetailsObj 	=	getOrderDetails($orderData->order_id);
															
															$totalAmount = 0;
															foreach($orderDetailsObj as $detailsData){
																	$totalAmount+=$detailsData->total_price;
															}
															
															//echo '<pre>';print_r($orderDetails);die;
									
															switch($orderData->status_type){
																	case 0:
																			$orderStatus = 'Cancled by customer';break;
																	case 1:
																			$orderStatus = 'Delivered';break;
																	case 2:
																			$orderStatus = 'Pending';break;
																	case 3:
																			$orderStatus = 'Dispatched';break;
																	case 4:
																			$orderStatus = 'Rejected by Shop';break;
																	case 5:
																			$orderStatus = 'Failed';break;
																	case 6:
																			$orderStatus = 'Order Placed';break;
																			
															}
												?>
													<tr class="first odd">
														<td><?=$orderData->order_id;?></td>
														<td><?=$orderData->invoice_no;?> </td>
														<td><?=$paymentMode;?> </td>
														<td><?=date('jS M Y',strtotime($orderData->delivery_date));?> </td>
														<td><?=$orderData->delivery_option.'&nbsp;('.$orderData->delivery_time.')';?> </td>
														<td><?=number_format($totalAmount,2)?> </td>
														<td><?=$orderStatus;?> </td>
														<td class="a-center last"> <a href="<?=base_url();?>order-details/<?=encode($orderData->order_id)?>">View Order</a></td>
													</tr>
												<?php } }else{?>
													<tr>
														<td colspan="8">No order found !</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									
								</div>
							</div>
						</article>
						<!--  ///*///======    End article  ========= //*/// -->
					</div>
					<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
						<!--  <div class="side-banner"><img src="assets/images/side-banner.jpg" alt="banner"></div>-->
						<div class="block block-account">
							<div class="block-title">My Account</div>
							<div class="block-content">
								<?php include("includes/left_tab.php"); ?>

							</div>
						</div>
					</aside>
				</div>
			</div>
		</section>
		<!-- Main Container End --> 
	
		<?php include("includes/footer.php"); ?>
		<?php include("includes/script.php"); ?>
</body>
</html>