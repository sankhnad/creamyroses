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
											<h2>Address Book</h2>
										</div>
										
										<div class="col2-set">
											
											<div class="manage_add"><a href="<?=base_url()?>add-address">Add Addresses</a> </div>
									<?php foreach($addressList as $addressData){?>
									
									<div class="col-sm-4">
										<div class="boxAddressDis <?=$addressData->isDefault == '1' ? 'defaultAdsULI':'' ?>">
											<div class="defultBxRa">Default Address</div>
											<ul class="addressULLI">
												<?php
												$aidEncripted = encode($addressData->aid);
												if($addressData->type == '0'){
													$aTyp = 'Home Address';
													$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
												}else if($addressData->type == '1'){
													$aTyp = 'Office Address';
													$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
													echo '<li>' . $addressData->remarks . ''.$aTyp.'</li>';
													$aTyp = '';
												}else if($addressData->type == '2'){
													$aTyp = 'Others';
													$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
												}
												if ( $addressData->name ) {
													echo '<li>' . $addressData->name . ''.$aTyp.'</li>';
												}
												if ( $addressData->address_line_1 ) {
													echo '<li>' . $addressData->address_line_1 . ',</li>';
												}
												if ( $addressData->address_line_2 ) {
													echo '<li>' . $addressData->address_line_2 . ',</li>';
												}
												if ( $addressData->landmark ) {
													echo '<li>' . $addressData->landmark . ',</li>';
												}
												if ( $addressData->city ) {
													echo '<li>' . $addressData->city . ', ' . $addressData->cityName . ',</li>';
												}
												if ( $addressData->pin ) {
													echo '<li>India - ' . $addressData->pin . '</li>';
												} else {
													echo '<li>India</li>';
												}
												if ( $addressData->mobile ) {
													echo '<li>Phone number: ' . $addressData->mobile . '</li>';
												}
																				
												if ($addressData->type == '2'){
													echo '<li>Remarks: ' . $addressData->remarks . '</li>';
												}
												?>
											</ul>
											<ul class="actionAdresULLI">
												<li><a href="<?=base_url();?>profile/getAddress/<?=$aidEncripted?>">Edit</a></li>
												<li><a href="javascript:void(0)" onClick="deleteAddress(this, '<?=$aidEncripted?>')">Delete</a></li>
												<li><a href="javascript:void(0)" onClick="setDefaultAddress(this, '<?=$aidEncripted?>','<?=$CID?>')">Set as Default</a></li>
											</ul>
										</div>
									</div>
									<?php } ?>
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