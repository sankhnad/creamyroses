<?php
if ( $productAray ) {
	$catSelctIDs 	= array();
	$prdctName		= $productAray[ 0 ]->name;
	$url_slug 		= $productAray[ 0 ]->url_slug;
	$tags 			= $productAray[ 0 ]->tags;
	$isStatus 		= $productAray[ 0 ]->status;
	$img 			= $productAray[ 0 ]->image;
	$sort	 		= $productAray[ 0 ]->sort_number;
	$sku 			= $productAray[ 0 ]->sku_code;
	$availDate 		= date('d/m/Y', strtotime($productAray[0]->date_available));
	$metaTTitle 	= $productAray[ 0 ]->meta_title;
	$metaTDesc 		= $productAray[ 0 ]->meta_description;
	$metaTKey 		= $productAray[ 0 ]->meta_keyword;
	$description 	= $productAray[ 0 ]->description;
	$isEggless 	   		= $productAray[ 0 ]->isEggless;

	$deliveryDesc 	= $productAray[ 0 ]->delivery_description;
	$refundDesc 	= $productAray[ 0 ]->refund_description;
	
	
	$typeLbl 		= 'Update';
	$linkTopBrod 	= $prdctName;
	$lngk 			= 'edit';
	
} else {
	$prdctName = $url_slug = $tags = $img = $model = $dimWidth = $sort = $outOfStockId = $sku = $subStock = $availDate = $metaTTitle =  $metaTDesc = $metaTKey = $description = $prdStock = $deliveryDesc = $refundDesc = $discount_type = $discount = $price = '';
	$catSelctIDs = array();
	$typeLbl 	   		= 'Create';
	$linkTopBrod   		= 'New Product';
	$lngk 		   		= 'add';
	$isStatus 	   		= 1;
	$isEggless 	   		= 1;
	$sMsgOptProdct 		= 1;
	$isMsgOptCrd 		= 1;
	$isTissuePacking 	= 1;
	$availDate = date('d/m/Y');
}

$typeList = $relatedPrdctList = '';

if($typeSelectsAry){
	$typeSelectsAry = json_decode(json_encode($typeSelectsAry), true);
	$typeSelectsAry = array_column($typeSelectsAry, 'type_id');
}
foreach ( $typeAry as $data ) {
	$isTypSelt = in_array($data->type_id, $typeSelectsAry) ? 'selected' : '';
	$typeList .= '<option '.$isTypSelt.' value="' . $data->type_id . '">' . $data->name . '</option>';
}

if($productSelectsAry){
	$productSelectsAry = json_decode(json_encode($productSelectsAry), true);
	$productSelectsAry = array_column($productSelectsAry, 'product_related_id');
}
foreach($relatedProductAry as $data){
	$isTypSelt = in_array($data->product_id, $productSelectsAry) ? 'selected' : '';
	$relatedPrdctList .= '<option '.$isTypSelt.' value="' . $data->product_id . '">' . $data->name . '</option>';
}

if($deliveryOptSelectsAry){
	$deliveryOptSelectsAry = json_decode(json_encode($deliveryOptSelectsAry), true);
	$deliveryOptSelectsAry = array_column($deliveryOptSelectsAry, 'delivery_option_id');
}


$delOptList = '';
foreach($deliveryOptAry as $optionData){
	$isTypSelt = in_array($optionData->option_id, $deliveryOptSelectsAry) ? 'selected' : '';
	$delOptList .= '<option '.$isTypSelt.' value="' . $optionData->option_id . '">' . $optionData->name . '</option>';
}

$isTblStatus = 0;

if(count($slctPrice) > 0){
	$isTblStatus = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title> <?=$typeLbl?> Product | POCHI Admin</title>
	<link href="<?=$iURL_assets?>admin/js/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?=$iURL_adminAssts?>js/zTreeStyle/zTreeStyle.css" type="text/css">
	<link rel="stylesheet" href="<?=$iURL_adminAssts?>js/rateyo-rating/jquery.rateyo.css" type="text/css">
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
							<a href="<?=admin_url()?>products">Products</a>
						</li>
						<li class="active">
							<a href="<?=admin_url()?>customers/<?=$lngk?>">
								<?=$typeLbl?>Product</a>
						</li>
					</ul>
					<div class="nav-search">
						<i>Last Login : <?=lastLogin(AID);?></i>
					</div>
				</div>
				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							<div class="headPageA">
								<div class="titleAre"><i class="fas fa-shopping-cart"></i> <?=$typeLbl?>Product</div>
							</div>
							<div class="hr dotted hr-double"></div>
							<div class="tabbable">
								<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
									<li class="active">
										<a data-toggle="tab" href="#generalTab"><i class="green ace-icon fas fa-cube bigger-120"></i> General</a>
									</li>
									<li>
										<a data-toggle="tab" href="#dataTab"><i class="green ace-icon fas fa-table bigger-120"></i> Data</a>
									</li>
									<li>
										<a data-toggle="tab" href="#priceTab"><i class="green ace-icon fas fa-table bigger-120"></i> Price</a>
									</li>
									<li>
										<a data-toggle="tab" href="#SEOTab"><i class="green ace-icon fab fa-searchengin bigger-120"></i> SEO</a>
									</li>
									<li>
										<a data-toggle="tab" href="#policyTab"><i class="green ace-icon fas fa-user-secret bigger-120"></i> Policy</a>
									</li>
									<li>
										<a data-toggle="tab" href="#imageTab"><i class="green ace-icon fas fa-user-secret bigger-120"></i> Images</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<form class="form-horizontal" id="editNewProduct">
									<input type="hidden" value="<?=$ePID?>" name="pid"/>
									<div class="tab-content">
										<div id="generalTab" class="tab-pane in active">
											<div class="row">
												<div class="col-sm-8">
													<div class="col-md-6">
														<div class="form-group">
															<label class="required">Product Name </label>
															<input onBlur="generateURLSlug(this.value, 'prd')" type="text" name="name" class="form-control" value="<?=$prdctName;?>" placeholder="Enter Product Name" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="required">URL Slug</label>
															<input onBlur="generateURLSlug(this.value, 'slug')" onKeyUp="$('.slugErr').hide()" data-toggle="tooltip" title="Do not use spaces instead replace spaces with - and make sure the keyword is globally unique." value="<?=$url_slug?>" type="text" name="url_slug" class="form-control" placeholder="Enter Uniqe URL Slug"/>
															<span class="help-block slugErr"> This URL slug is not available </span>
														</div>
													</div>
													
													<div class="col-md-8">
														<div class="form-group tbltagSnC">
															<label class="required">Product Tag </label><br>
															<input name="tags" type="text" class="form-control" data-role="tagsinput" value="<?=$tags?>" />
														</div>
													</div>
													
													
													
													<div class="col-md-12">
														<div class="form-group">
															<label>Description</label>
															<textarea name="desc" rows="8" class="summernote"><?=$description?></textarea>
														</div>
													</div>
													<div class="col-md-6">		
														<div class="form-group">
															<label>&nbsp;</label>
															<div class="borderChexBx">
																<label>Status</label>
																<label class="switchS switchSCuStatus">
																  <input name="isStatus" value="1" class="switchS-input" type="checkbox" <?=$isStatus == '1' ? 'checked' : ''?> />
																  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
																</label>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="required">Type</label>
														<select class="selectpicker" name="type[]" multiple title="Select Type" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
														</select>
													</div>													
													<div class="form-group">
														<label>Category</label>
														<div class="catPanLstng">
															<div class="zTreeDemoBackground left">
																<ul id="treeDemo" class="ztree"></ul>
															</div>
														</div>
													</div>
													<div class="form-group dropyCHet">
														<label>Product Image</label>
														<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_product?><?=$img ? $img : 'default.jpg'?>"/>
													</div>
												</div>
											</div>
										</div>
										<div id="dataTab" class="tab-pane">
											
											<div class="col-md-4">
												<div class="form-group">
													<label>SKU</label>
													<input type="text" name="sku" class="form-control" value="<?=$sku?>" placeholder="Enter SKU Code"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Date Available</label>
													<div class="input-group">
														<input name="date" class="form-control date-picker" value="<?=$availDate?>" type="text" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy"/>
														<span class="input-group-addon"> <i class="far fa-calendar-alt bigger-110"></i> </span>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Sort Order</label>
													<input type="text" name="sort" class="form-control" value="<?=$sort?>" placeholder="Enter Sort Order" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>&nbsp;</label>
													<div class="borderChexBx">
														<label>Eggless option?</label>
														<label class="switchS switchSCuStatus">
														  <input name="isEggless" value="1" class="switchS-input"  type="checkbox" <?=$isEggless == '1' ? 'checked' : ''?>>
														  <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> 
														</label>
													</div>
												</div>
											</div>
											
											<div class="clearfix"></div>
										</div>
										<div id="priceTab" class="tab-pane">
											<table class="table prodcutPriceTbl table-bordered no-footer mb0">
												<tr>
													<th width="15%">Quantity Type</th>
													<th width="15%">Quantity</th>
													<th width="15%">Product Price</th>
													<th width="15%">Discount Type</th>
													<th width="15%">Discount Value</th>
													<th width="15%">Product Final Price</th>
													<th width="5%" class="text-center">Action</th>
												</tr>
												
											
											<?php  
											$productTbl = '';
											$i =0;
											foreach($slctPrice as $priceData){
											
											?>
												 <tr>
													<td>
														<select class="selectpicker" name="quantityType[]" title="Select Quantity" data-live-search="true"  data-width="fit" >
															<option value="gm" <?=$slctQntityTypeAry[$i]== 'gm'?'selected="selected"':'';?>>Gram</option>
															<option value="kg" <?=$slctQntityTypeAry[$i]== 'kg'?'selected="selected"':'';?>>Kilo Gram</option>
															<option value="lt" <?=$slctQntityTypeAry[$i]== 'lt'?'selected="selected"':'';?>>Litter</option>
															<option value="pic" <?=$slctQntityTypeAry[$i]== 'pic'?'selected="selected"':'';?>>Piece</option>
														</select>
													</td>
													<td> 
														<input type="text" class="form-control" placeholder="1.5, 2, 500" name="quantity[]" value="<?=$slctQntity[$i]?>" />
													</td>
													<td>
														<input type="text" class="form-control" placeholder="Price" name="price[]" value="<?=$slctPrice[$i]?>" />
													</td>
													<td>
														<select class="selectpicker" name="discountType[]" title="Discount Type" data-width="fit" >
															<option value="F" <?=$slctDiscType[$i]== 'F'?'selected="selected"':'';?>>Flat Rate (Rs)</option>
															<option value="P" <?=$slctDiscType[$i]== 'P'?'selected="selected"':'';?>>Percentage (%)</option>
														</select>
													</td>
													<td>
														<input type="text" class="form-control" placeholder="Discount" name="discountValue[]" value="<?=$selctDisc[$i]?>" />
													</td>
													<td class="discountFinalValue">
														<?php if($slctDiscType[$i]== 'F'){
																echo ((float)$slctPrice[$i] - (float)$selctDisc[$i]);
															}else{
																echo ((float)$slctPrice[$i] - ((float)$slctPrice[$i]*(float)$selctDisc[$i]/100));
															}
														?>
													 </td>
													<td class="text-center">
														<button type="button" onClick="addRemovePriceTablBox(this, \'remove\')" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
													</td>
												</tr>
																							
											<?php $i++; }?>
											</table>
											<div class="clearfix"></div>
										</div>
										 
										<div id="SEOTab" class="tab-pane ">
											<div class="col-md-12">
												<div class="form-group">
													<label class="required">Meta Tag Title</label>
													<input type="text" class="form-control" name="meta_title" value="<?=$metaTTitle?>"   />
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label>Meta Tag Description</label>
													<textarea name="meta_desc" class="form-control"><?=$metaTDesc?></textarea>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label>Meta Tag Keywords</label>
													<textarea name="meta_keywords" class="form-control"><?=$metaTKey?></textarea>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div id="policyTab" class="tab-pane ">
											<div class="form-group col-md-12">
												<label>Delivery</label>
												<textarea name="deliveryDesc" rows="8" class="summernote"><?=$deliveryDesc?></textarea>
											</div>
											<div class="form-group col-md-12">
												<label>Refund</label>
												<textarea name="refundDesc" rows="8" class="summernote"><?=$refundDesc?></textarea>
											</div>
											<div class="clearfix"></div>
										</div>
										<div id="imageTab" class="tab-pane ">
										<div class="col-sm-12">
					
											<div class="form-group">
					
											<label class="col-md-12">Select Multiple Images (Use <strong>Ctrl</strong> button) </label>
											<div class="col-md-6">
											  <input name="images[]" multiple type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify"  data-default-file="<?=$iURL_product?><?=$img ? 'default.jpg' : 'default.jpg'?>"/>
											</div>
					
											</div>
					
										</div>
										<?php 
										if(count($moreImagesArr)>0){ ?>	
										<div class="col-sm-12">
											  <div class="row">
											  <label class="col-md-12">Slider Images </label>
												<div class="col-sm-12">
												  <div class="row">
												  <?php 
												  
													foreach($moreImagesArr as $data) { 
														$id = encode($data->id);
													?>
															<div class="col-sm-3 col-md-3">
															  <div class="img-upload">
																<div class="col-12 bg-head3 imageDiv"> <img src="<?=$iURL_product?><?=$data->image?>" alt="<?=$data->image?>">
																  <button type="button" onClick="deleteProductImages(this,'<?=$id?>','images')" class="btn btn-primary btn-sm" style="width: 100%;">Remove Image</button>
																</div>
															  </div>
															</div>
												  <?php 
													}
												  ?>
												  </div>
												</div>
											  </div>
											</div>
										<?php } 
										?>
										<div class="clearfix"></div>
									  </div>
									</div>
									<div class="row">
										<div class="col-sm-12 mt20">
											<div class="form-group">
												<div class="col-md-12 text-right">
													<a href="<?=admin_url('products')?>" class="btn btn-inverse">Cancel</a>
													<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> <?=$typeLbl;?> Product</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
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
	<script type="text/javascript" src="<?=$iURL_assets?>admin/js/zTreeStyle/jquery.ztree.all.min.js"></script>
	<script type="text/javascript" src="<?=$iURL_adminAssts?>js/rateyo-rating/jquery.rateyo.js"></script>
	<script src="<?=$iURL_assets?>admin/js/custom.js"></script>
	<script>
		$( document ).ready( function () {
			$( '.dropify' ).dropify();
			addRemovePriceTablBox(this, 'add','<?=$isTblStatus?>');
		} );

		$( '.date-picker' ).datepicker( {
			autoclose: true,
		} );

		$( '.datapicker' ).daterangepicker( {
			singleDatePicker: true,
			showDropdowns: true,
		} );

		$( '.datapicker' ).daterangepicker( {
			singleDatePicker: true,
			showDropdowns: true,
		} );
		
		$('.reviewDateView').datetimepicker({
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		
		var setting = {
			check: {
				enable: true,
				chkboxType: { "Y" : "", "N" : "" }
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};
		
		$(document).ready(function(){
			var dataString = {
				pid: "<?=$ePID?>",
			};
			
			$.ajax({
				url: admin_url+"products/getCategoryList",
				dataType: 'json',
				type: "POST",
				data: dataString,
				beforeSend: function () {
					showLoader();
				},
				success: function (obj) {
					treeObj = $.fn.zTree.init($("#treeDemo"), setting, obj);
					var nodes = treeObj.getCheckedNodes(true);
					var parentNode = '';
					$.each(nodes, function( index, value ){
						parentNode = nodes[index].getParentNode();
						treeObj.expandNode(parentNode, true, false, false);
						if(parentNode){
							var i = 10;
							do{
								parentNode = parentNode.getParentNode();
								if(parentNode){
									treeObj.expandNode(parentNode, true, false, false);
								}
							}
							while (parentNode);
						}
					});

				},
				error: function () {
					csrfError();
				},
			});
		});
		$(".reviewerRating").rateYo({
          numStars: 5,
          precision: 2,
          minValue: 1,
          maxValue: 5
        }).on("rateyo.set", function (e, data) {
			$('.reviewerRatingValue').val(data.rating);
        });
		
	</script>	
</body>
</html>