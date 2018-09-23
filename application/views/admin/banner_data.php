<?php
if ($bannerAray) {
	$heading 	= $bannerAray[ 0 ]->heading;
	$description= $bannerAray[ 0 ]->description;
	$img 		= $bannerAray[ 0 ]->avtar;
	$buttonText = $bannerAray[ 0 ]->button_text;
	$buttonLink = $bannerAray[ 0 ]->button_link;
	$isStatus 	= $bannerAray[ 0 ]->status;	

	$typeLbl 	 = 'Update';
	$linkTopBrod = $heading;
	$lngk = 'edit';
} else {
	$heading = $description = $img = $buttonText = $buttonLink = $isStatus = '';
	
	$typeLbl = 'Create';
	$linkTopBrod = 'New Banner';
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
							<a href="<?=admin_url()?>destination">Banner</a>
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
								<div class="titleAre"><i class="fas fa-box-open"></i> <?=$typeLbl?> Banner</div>
							</div>
							<div class="hr dotted hr-double"></div>						
							<form class="form-horizontal" id="editNewBanner">
								<input type="hidden" value="<?=$eBID?>" name="bid"/>
								<div class="form-group row">
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Banner Heading &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<textarea name="heading" class="form-control" placeholder="Enter Banner Heading" required/><?=$heading?></textarea>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Banner Description &nbsp; <span class="required"></span></label>
													<div class="col-md-12">
														<textarea name="description" class="form-control" placeholder="Enter Banner Description" required/><?=$description?></textarea>
													</div>
												</div>
											</div>
											
										
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Button Text</label>
													<div class="col-md-12">
														<input type="text" name="buttontext" class="form-control" value="<?=$buttonText?>" placeholder="Enter Button Text" required/>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-md-12">Button Link</label>
													<div class="col-md-12">
														<input type="text" name="buttonLink" class="form-control" value="<?=$buttonLink?>" placeholder="Enter Button Link" required/>
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
										</div>
									</div>
									<div class="col-sm-4">
										
										<div class="form-group dropyCHet col-sm-12">
											<label>Image</label>
											<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_banner?><?=$img ? $img : 'default.jpg'?>"/>
										</div>
									</div>

									<div class="col-sm-12">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="col-md-12 text-right">
													<a href="<?=base_url()?>admin/banner" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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