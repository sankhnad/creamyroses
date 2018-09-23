<?php
if ($testimonialsAray) {
	$name 			= $testimonialsAray[ 0 ]->name;
	$designation	= $testimonialsAray[ 0 ]->designation;
	$company 		= $testimonialsAray[ 0 ]->company;
	$short_desc 	= $testimonialsAray[ 0 ]->short_desc;
	$description 	= $testimonialsAray[ 0 ]->description;
	$img			= $testimonialsAray[ 0 ]->avtar;
	$isStatus 		= $testimonialsAray[ 0 ]->status;
	
	$typeLbl 	 	= 'Update';
	$linkTopBrod 	= $name;
	$lngk 		    = 'edit';
} else {
	$name = $designation = $company = $short_desc = $description = $isStatus = $img = '';
	
	$typeLbl = 'Create';
	$linkTopBrod = 'New Testimonial';
	$lngk = 'add';
	$isStatus = 1;
}    
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$typeLbl?> Banner | Traveller India Web Admin</title>
	<link href="<?=$iURL_assets?>admin/js/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
	<?php include('includes/styles.php'); ?>
</head>

<body class="no-skin">
	<?php include('includes/header.php')?>
	<div class="main-container ace-save-state" id="main-container">
		<?php include('includes/sidebar.php')?>
		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="<?=base_url()?>">Home</a>
						</li>
						<li>
							<a href="<?=admin_url()?>testimonial">Testimonial</a>
						</li>
						
					</ul>
					<!-- /.breadcrumb -->
					<div class="nav-search">
						<i>Last Login : <?=lastLogin(AID);?></i>
					</div>
					<!-- /.nav-search -->
				</div>
				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							<div class="headPageA">
								<div class="titleAre"><i class="fas fa-box-open"></i> <?=$typeLbl?> Testimonial</div>
							</div>
							<div class="hr dotted hr-double"></div>						
							<form class="form-horizontal" id="editNewTestimonials">
								<input type="hidden" value="<?=$eTID?>" name="tid"/>
								<div class="form-group row">
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Name &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<input type="text" name="name" class="form-control" value="<?=$name?>" placeholder="Enter Name" required/>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Company &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<input type="text" name="company" class="form-control" value="<?=$company?>" placeholder="Enter Compoany Name" required/>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Place &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<input type="text" name="designation" class="form-control" value="<?=$designation?>" placeholder="Enter Designation" required/>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
        									  <div class="form-group ">
        										<label class="col-md-12">&nbsp;</label>
        										<div class="col-md-12">
        										  <div class="borderChexBx">
        											<label>Status</label>
        											<label class="switchS switchSCuStatus">
        											<input name="status" value="1" class="switchS-input" type="checkbox" <?=$isStatus == 1 ? 'checked' : ''?> />
        											<span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> </label>
        										  </div>
        										</div>
        									  </div>
        									</div>
											
											<!--<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Title &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<textarea name="title" class="form-control" placeholder="Enter Title" required/><?=$short_desc?></textarea>
													</div>
												</div>
											</div>-->
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-md-12">Description</label>
													<div class="col-md-12">
														<textarea name="description" maxlength="200" rows="8" class="form-control"><?=$description?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">										
										<div class="form-group dropyCHet col-sm-12">
											<label>Image</label>
											<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_testimonials?><?=$img ? $img : 'user.png'?>"/>
										</div>										
									</div>

									<div class="col-sm-12">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-md-12 text-right">
													<a href="<?=base_url()?>admin/testimonials" class="btn btn-inverse waves-effect waves-light">Cancel</a>
													<button type="submit" class="btn btn-success waves-effect waves-light"><i class="ace-icon fas fa-save bigger-110"></i> <?=$typeLbl?> Banner</button>
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
				<!-- /.page-content -->
			</div>
		</div>
		<!-- /.main-content -->
		<?php include('includes/footer.php')?>
	</div>
	
	<!-- basic scripts -->
	<script src="<?=$iURL_assets?>admin/js/dropify/dist/js/dropify.min.js"></script>
	<?php include('includes/scripts.php')?>
	<script src="<?=$iURL_assets?>admin/js/custom.js"></script>
	<script>
		$(document).ready(function(){
			$('.dropify').dropify();
		});
	</script>
</body>

</html>