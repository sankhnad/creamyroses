<?php
$heading = $description = $img = $buttonText = $buttonLink = $isStatus = '';
$typeLbl = 'Create';
$linkTopBrod = 'New Banner';
$lngk = 'add';
$isStatus = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$typeLbl?> Banner | Creamy Roses</title>
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
							<div class="row">
								<div class="col-md-8">
									<div class="boxBls">
										<div class="hedBoHm">TOP TWO PRODUCTS</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Title</label>
												<input type="text" maxlength="50" class="form-control" />
											</div>
											<div class="form-group">
												<label>Product URL</label>
												<input type="text" class="form-control" />
											</div>
											<div class="form-group">
												<label>Product URL</label>
												<input type="text" class="form-control" />
											</div>
											<div class="form-group dropyCHet">
												<label>Image (407 X 210)</label>
												<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_banner?><?=$img ? $img : 'default.jpg'?>"/>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Title</label>
												<input type="text" maxlength="50" class="form-control" />
											</div>
											<div class="form-group">
												<label>Product URL</label>
												<input type="text" class="form-control" />
											</div>
											<div class="form-group dropyCHet">
												<label>Image  (407 X 210)</label>
												<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_banner?><?=$img ? $img : 'default.jpg'?>"/>
											</div>
										</div>
										<div class="text-center">
											<button type="submit" class="btn btn-success"><i class="ace-icon fas fa-save bigger-110"></i> Update</button>
											<br><br>
										</div>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="boxBls">
										<div class="hedBoHm">HOT DEAL (263 X 427)</div>
										<div class="col-md-12">								
											<div class="form-group">
												<label>Title</label>
												<input type="text" maxlength="50" class="form-control" />
											</div>
											<div class="form-group">
												<label>Product URL</label>
												<input type="text" class="form-control" />
											</div>
											<div class="form-group dropyCHet">
												<label>Image</label>
												<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_banner?><?=$img ? $img : 'default.jpg'?>"/>
											</div>
										</div>
										<div class="text-center"><button type="submit" class="btn btn-success"><i class="ace-icon fas fa-save bigger-110"></i> Update</button><br><br></div>
									</div>
								</div>
							</div>
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