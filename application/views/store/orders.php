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
														<th>Date</th>
														<th>Ship to</th>
														<th><span class="nobr">Order Total</span>
														</th>
														<th>Status</th>
														<th>&nbsp;</th>
													</tr>
												</thead>
												<tbody>
													<tr class="first odd">
														<td>500000002</td>
														<td>9/9/10 </td>
														<td>John Doe</td>
														<td><span class="price"><i class="fa fa-rupee"></i> 5.00</span>
														</td>
														<td><em>Pending</em>
														</td>
														<td class="a-center last"><span class="nobr"> <a href="#">View Order</a> <span class="separator">|</span> <!--<a href="#">Reorder</a>--> </span>
														</td>
													</tr>
													<tr class="last even">
														<td>500000001</td>
														<td>9/9/10 </td>
														<td>John Doe</td>
														<td><span class="price"><i class="fa fa-rupee"></i> 1,397.99</span>
														</td>
														<td><em>Pending</em>
														</td>
														<td class="a-center last"><span class="nobr"> <a href="#">View Order</a> <span class="separator">|</span> <!--<a href="#">Reorder</a>--> </span>
														</td>
													</tr>
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