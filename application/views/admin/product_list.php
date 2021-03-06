<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title>Products List | Admin </title>
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
						<li class="active">
							<a href="<?=admin_url()?>products">Products</a>
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
								<div class="titleAre"><i class="fas fa-users"></i> Products List</div>
								<div class="buttonAre">
									<a href="<?=admin_url()?>products/add" class="btn btn-primary"><i class="ace-icon fas fa-plus"></i> Add Product</i></a>
								</div>
							</div>
							<div class="hr dotted hr-double"></div>
							<div class="filterPageare">
								<div class="filterPanL">
									<select class="selectpicker filter_status" title="Select Status" data-width="fit" multiple data-actions-box="true">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>								
								<div class="filterPanL">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="far fa-calendar-alt bigger-110"></i>
										</span>									
										<input class="form-control filter_date" placeholder="Created On" type="text"/>
									</div>
								</div>
								<div class="filterPanL">
									<button type="button" title="Filter Record" onClick="filterRecord();" class="btn btn-warning fxFilBtn btn-sm"><i class="fa fa-filter"></i> &nbsp;Filter</button>
									<button type="button" title="Filter Record" onClick="resetFilterRecord(1);" class="btn btn-grey fxFilBtn btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; Reset</button>
								</div>
							</div>
							<table class="table data_table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="10%">Image</th>
										<th width="30%">Name</th>
										<th width="15%">Created On</th>
										<th width="10%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<!-- /.row -->
				</div>
				<!-- /.page-content -->
			</div>
		</div>
	
		<?php include('includes/footer.php')?>
	</div>
	<!-- basic scripts -->
	<?php include('includes/scripts.php')?>
	<script src="<?=$iURL_assets?>admin/js/custom.js"></script>
	<script>
		function filterRecord() {
			filterData = {
				"filter_date": $( 'input.filter_date' ).val(),
				"filter_status": $( 'select.filter_status' ).val(),
				"filter_group": $( 'select.filter_group' ).val(),
			};
			ajaxPageTarget('data_table', 'products', 'product_list' );
		}
		filterRecord();
	</script>
	<style>
		.data_table tr th:first-child, .data_table tr td:first-child{
			text-align: center;
		}
	</style>
</body>

</html>