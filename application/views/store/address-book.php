<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
		<title>Address Book | Creamy Roses</title>
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
									
									
									<div class="box-account">
										<div class="page-title">
											<h2>Address Information</h2>
										</div>
										
										<div class="col2-set">
											<h4>Address Book</h4>
											<div class="manage_add"><a href="<?=base_url()?>add-address">Add Addresses</a> </div>
											<div class="col-1">
												<h5>Primary Billing Address</h5>
												<address>John Doe<br>
                          aundh<br>
                          tyyrt,  Alabama, 46532<br>
                          United States<br>
                          T: 454541 <br>
                          <a href="#">Edit Address</a>
                          </address>
											</div>
											<div class="col-2">
												<h5>Primary Shipping Address</h5>
												<address>John Doe<br>  
                          aundh<br>
                          tyyrt,  Alabama, 46532<br>
                          United States<br>
                          T: 454541 <br>
                          <a href="#">Edit Address</a>
                          </address>
											</div>
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