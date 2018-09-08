<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
		<title>Account Information | Creamy Roses</title>
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
											<h2>Account Information</h2>
										</div>
										<div class="col2-set">
											<div class="col-1">
												<h5>Contact Information</h5>
												<a href="#">Edit</a>
												<p>John Doe<br> john.doe@gmail.com
													<br>
													<a href="#">Change Password</a> </p>
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