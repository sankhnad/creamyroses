<?php
if ( $customerData ) {	
	$actionBtn = 'Update';
	$fname = $customerData[ 0 ]->fname;
	$lname = $customerData[ 0 ]->lname;
	$email = $customerData[ 0 ]->email;
	$mobile = $customerData[ 0 ]->mobile;
	$gender = $customerData[0]->gender;
	$avtar = $customerData[ 0 ]->avtar;
	$dob = $customerData[0]->dob ? date( 'd/m/Y', strtotime($customerData[0]->dob )) : '';
	$doa = $customerData[0]->doa ? date( 'd/m/Y', strtotime($customerData[0]->doa)) : '';
} else {
	$actionBtn = 'Save';
	$status = $isSMS_verified = $isEmail_verified = $gender = 1;
	$fname = $lname = $email = $username = $mobile = $avtar = $dob = $doa = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
		<title>Account Information | Creamy Roses</title>
			<link href="<?=$iURL_assets?>admin/js/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>

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
											<div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							
							<div class="hr dotted hr-double"></div>						
							<form id="customerAddEdit" novalidate>
								<div class="row">
									<div class="col-sm-9">
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">First Name *</label>
													<div class="col-md-12">
														<input type="text" value="<?=$fname?>" name="fname" class="form-control" placeholder="Enter First Name" required/>
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Last Name</label>
													<div class="col-md-12">
														<input type="text" value="<?=$lname?>" name="lname" class="form-control" placeholder="Enter Last Name"/>
													</div>
												</div>
											</div>
																						
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Email e.g. "abc@host.com" *</label>
													<div class="col-md-12">
														<input type="email" value="<?=$email?>" onBlur="checkCustEmailAvlb(this.value,'email')" onKeyPress="$('.emailErr').hide();" name="email" class="form-control" placeholder="Enter Email" required disabled="disabled">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Mobile e.g. "9999999999" *</label>
													<div class="col-md-12">
														<input type="text" name="mobile" value="<?=$mobile?>" placeholder="Enter Phone Number" data-mask="0000000000" class="form-control" required>
														
														
													</div>
												</div>
											</div>
											
											
											<!--<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Gender</label>
													<div class="col-md-12">
														<div class="radio">
															<label>
																<input name="gender" type="radio" value="1" <?=$gender=='M' ? 'checked' : ''?> class="ace" />
																<span class="lbl"> Male</span>
															</label>
															<label>
																<input name="gender" type="radio" class="ace" value="2" <?=$gender=='F' ? 'checked' : ''?> />
																<span class="lbl"> Female</span>
															</label>
														</div>
													</div>
												</div>
											</div>-->
											
											<div class="clearfix"></div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Date of Birth</label>
													<div class="col-md-12">
														<div class="input-group">
															<input name="dob" class="form-control date-picker" value="<?=$dob?>"  type="text" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" />
															<span class="input-group-addon">
																<i class="far fa-calendar-alt bigger-110"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-md-12">Date of Birth</label>
													<div class="col-md-12">
														<div class="input-group">
															<input name="doa" value="<?=$doa?>" class="form-control date-picker" type="text" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" />
															<span class="input-group-addon">
																<i class="far fa-calendar-alt bigger-110"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											
											
										</div>
									</div>
									<div class="col-sm-3">
										<label for="input-file-now-custom-1">Profile Image</label>
										<input name="avtar" type="file" id="input-file-now-custom-1" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_profile?><?=$avtar ? $avtar : 'user.png'?>"/>
									</div>									
									<div class="col-sm-12">
										<div class="row">
											
											
											<div class="col-sm-12">
												<div class="form-group">
													<div class="col-md-12 text-right">
														
														<button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> <?=$actionBtn?> </button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					
					
					<!-- /.row -->
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
		<script src="<?=$iURL_assets?>admin/js/dropify/dist/js/dropify.min.js"></script>

		<?php include("includes/script.php"); ?>
			<script>
		$(document).ready(function(){
			$('.dropify').dropify();
		});
		$('.date-picker').datepicker({
			autoclose: true,
		});
		
		$('.datapicker').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});

		$('.datapicker').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		});
		<?php if(isset($_GET['address'])){?>
		manageAddressPan();
		<?php } ?>
		$('input[type=radio][name=type]').change(function() {
			if(this.value == '0'){
				$('.otherTypAdrs label').html('Remarks');
			}else if(this.value == '1'){
				$('.otherTypAdrs label').html('Office Name');
			}else if(this.value == '2'){
				$('.otherTypAdrs label').html('Other');
			}
		});
	</script>

</body>
</html>