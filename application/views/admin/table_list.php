<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/commonfile.php');?>
	<title>Manage Database | POCHI Admin</title>
	<?php include('includes/styles.php'); ?>
	<style>
		.responseCode{
			display: none;
		}
		.responseCode textarea {
		  background-color: #333;
		  color: #fff;
		  margin-top: 25px;
		  min-height: 250px;
		}
	</style>
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
							<a href="<?=admin_url()?>">Home</a>
						</li>
						<li>
							<a href="<?=admin_url()?>process/sql">Manage Database</a>
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
								<div class="titleAre"><i class="fas fa-database"></i> Manage Database</div>
								<div class="buttonAre">
									<button type="button" class="btn btn-primary" onClick="SQLQueryModel()"><i class="ace-icon fas fa-syringe bigger-110"></i> Add Custom Query</i></button>
								</div>
							</div>
							<div class="hr dotted hr-double"></div>

							<table class="table data_table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Table Name</th>
										<th>Total Record</th>
										<th>Action</th>
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
		<!-- /.main-content -->
		<?php include('includes/footer.php')?>
	</div>
	<!-- /.main-container -->

	<!-- Modal:  SQL Push Model  -  Modal -->
	<div id="SQLQueryModel" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Custom Query</h4>
				</div>
				<form class="form-horizontal" id="runSQLQuery" role="form">
					<input type="hidden" class="primaryKey" value="">
					<div class="modal-body">
						<textarea class="form-control" name="code"></textarea>
						<div class="responseCode">
							<textarea class="form-control"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button  type="button" class="btn btn-sm btn-inverse" data-dismiss="modal"><span class="bigger-110">Close</span></button>
						<button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fas fa-syringe bigger-110"></i>  Run Query</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- basic scripts -->
	<?php include('includes/scripts.php')?>
	<script src="<?=$iURL_assets?>admin/js/custom.js"></script>
	<script>
		function filterRecord() {
			filterData = {
				//"filter_kyc": $( 'select.filter_kyc' ).val(),
				//"filter_data": $( 'input.filter_data' ).val(),
			};
			ajaxPageTarget('data_table', 'database', 'table_list' );

		}
		filterRecord();
		function SQLQueryModel(table , key, value){
			$('#SQLQueryModel').modal();
			$('#SQLQueryModel textarea').focus();
		}
		$(document).on("submit", "#runSQLQuery", function (e) {
			e.preventDefault();
			$.ajax({
				url: admin_url + 'database/runSQLQuery',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function (obj){
					$('.responseCode textarea').html(obj);
					$('.responseCode').slideDown();
				},
				error: function () {
					csrfError();
				}
			});
		});
	</script>
</body>
</html>