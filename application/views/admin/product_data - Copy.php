<?php
if ( $productAray ) {
	$catSelctIDs 	= array();
	$prdctName		= $productAray[ 0 ]->name;
	$url_slug 		= $productAray[ 0 ]->url_slug;
	$tags 			= $productAray[ 0 ]->tags;
	$isStatus 		= $productAray[ 0 ]->status;
	$img 			= $productAray[ 0 ]->image;
	$model 			= $productAray[ 0 ]->model;
	$sort	 		= $productAray[ 0 ]->sort_number;
	$prdStock 		= $productAray[ 0 ]->product_stock;
	$outOfStockId 	= $productAray[ 0 ]->stock_status_id;
	$sku 			= $productAray[ 0 ]->sku_code;
	$subStock 		= $productAray[ 0 ]->subtract_stock;
	$availDate 		= date( 'd/m/Y', strtotime( $productAray[ 0 ]->date_available ) );
	$metaTTitle 	= $productAray[ 0 ]->meta_title;
	$metaTDesc 		= $productAray[ 0 ]->meta_description;
	$metaTKey 		= $productAray[ 0 ]->meta_keyword;
	$description 	= $productAray[ 0 ]->description;
	$isEggless 	   		= $productAray[ 0 ]->isEggless;
	$sMsgOptProdct 		= $productAray[ 0 ]->isMsgOptProdct;
	$isMsgOptCrd 		= $productAray[ 0 ]->isMsgOptCrd;
	$isTissuePacking 	= $productAray[ 0 ]->isTissuePacking;

	$deliveryDesc 	= $productAray[ 0 ]->delivery_description;
	$refundDesc 	= $productAray[ 0 ]->refund_description;
	
	
	$typeLbl 		= 'Update';
	$linkTopBrod 	= $prdctName;
	$lngk 			= 'edit';
	
} else {
	$prdctName = $url_slug = $tags = $img = $model = $dimWidth = $sort = $outOfStockId = $sku = $subStock = $availDate = $metaTTitle =  $metaTDesc = $metaTKey = $description = $prdStock = $deliveryDesc = $refundDesc = '';
	$catSelctIDs = array();
	$typeLbl 	   		= 'Create';
	$linkTopBrod   		= 'New Product';
	$lngk 		   		= 'add';
	$isStatus 	   		= 1;
	$isEggless 	   		= 1;
	$sMsgOptProdct 		= 1;
	$isMsgOptCrd 		= 1;
	$isTissuePacking 	= 1;
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

$delOptList = '';
foreach($deliveryOptAry as $optionData){
	$delOptList .= '<option '.$isTypSelt.' value="' . encode($optionData->option_id) . '">' . $optionData->name . '</option>';
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title>
		<?=$typeLbl?> Product | POCHI Admin</title>
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
										<a data-toggle="tab" href="#priceTab"><i class="green ace-icon fas fa-dollar-sign bigger-120"></i> Price</a>
									</li>									
									<li>
										<a data-toggle="tab" href="#galleryTab"><i class="green ace-icon fas fa-images bigger-120"></i> Gallery</a>
									</li>
									<li>
										<a data-toggle="tab" href="#SEOTab"><i class="green ace-icon fab fa-searchengin bigger-120"></i> SEO</a>
									</li>
									<li>
										<a data-toggle="tab" href="#policyTab"><i class="green ace-icon fas fa-user-secret bigger-120"></i> Policy</a>
									</li>
									<li>
										<a data-toggle="tab" href="#reviewTab"><i class="green ace-icon fas fa-star-half-alt bigger-120"></i> Review</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<form class="form-horizontal" id="editNewProduct">
									<input type="hidden" value="<?=$ePID?>" name="pid"/>
									<div class="tab-content">
										<div id="generalTab" class="tab-pane in active">
											<div class="row">
												<div class="col-sm-8">
													<div class="form-group col-md-6">
														<label class="required">Product Name </label>
														<input onBlur="generateURLSlug(this.value, 'prd')" type="text" name="name" class="form-control" value="<?=$prdctName;?>" placeholder="Enter Product Name" />
													</div>
													<div class="form-group col-md-6">
														<label class="required">URL Slug</label>
														<input onBlur="generateURLSlug(this.value, 'slug')" onKeyUp="$('.slugErr').hide()" data-toggle="tooltip" title="Do not use spaces instead replace spaces with - and make sure the keyword is globally unique." value="<?=$url_slug?>" type="text" name="url_slug" class="form-control" placeholder="Enter Uniqe URL Slug"/>
														<span class="help-block slugErr"> This URL slug is not available </span>
													</div>
													<div class="form-group col-md-6">
														<label>Product Tag</label>
														<div class="bootInputTag">
															<input name="tags" type="text" value="<?=$tags?>" class="form-control" data-role="tagsinput" />
														</div>
													</div>
													<div class="form-group col-md-6">
														<label>&nbsp;</label>
														<div class="borderChexBx">
															<label>Status</label>
															<label class="switchS switchSCuStatus">
															  <input name="isStatus" value="1" class="switchS-input" type="checkbox" <?=$isStatus == '1' ? 'checked' : ''?> />
															  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
															</label>
														</div>
													</div>
													<div class="form-group col-md-12">
														<label>Description</label>
														<textarea name="desc" rows="8" class="summernote"><?=$description?></textarea>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group col-md-12">
														<label class="required">Type</label>
														<select class="selectpicker" name="type[]" multiple title="Select Type" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
														</select>
													</div>
													<div class="form-group col-md-12">
														<label>Category</label>
														<div class="catPanLstng">
															<div class="zTreeDemoBackground left">
																<ul id="treeDemo" class="ztree"></ul>
															</div>
														</div>
													</div>
													<div class="form-group dropyCHet col-sm-12">
														<label>Product Image</label>
														<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_product?><?=$img ? $img : 'default.jpg'?>"/>
													</div>
												</div>
											</div>
										</div>
										<div id="dataTab" class="tab-pane">
											<div class="col-md-4">
												<div class="form-group">
													<label>Model</label>
													<input type="text" name="model" class="form-control" value="<?=$model;?>" placeholder="Enter Product Model Name"/>
												</div>
											</div>
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
											<div class="col-md-3">
												<div class="form-group">
													<label class="required">Product Stock</label>
													<input type="text" name="prdStock" class="form-control" value="<?=$prdStock?>" placeholder="Enter Product Stock" />
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="required">Subtract Stock</label>
													<select class="selectpicker" name="subStock" data-width="100%">
														<option value="1" <?=$subStock =='1' ? 'selected="Selected"': '';?>>Yes</option>
														<option value="2" <?=$subStock =='2' ? 'selected="Selected"': '';?>>No</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label class="required">Out Of Stock Status</label>
													<select class="selectpicker" name="stock" data-width="100%">
														<option value="1" <?=$outOfStockId=='1' ? 'selected="Selected"': '';?>>2 - 3 Days</option>
														<option value="2" <?=$outOfStockId=='2' ? 'selected="Selected"': '';?>>In Stock</option>
														<option value="3" <?=$outOfStockId=='3' ? 'selected="Selected"': '';?>>Out Of Stock</option>
														<option value="4" <?=$outOfStockId=='4' ? 'selected="Selected"': '';?>>Pre-Order</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Sort Order</label>
													<input type="text" name="sort" class="form-control" value="<?=$sort?>" placeholder="Enter Sort Order" />
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="borderChexBx">
														<label>Eggless option required?</label>
														<label class="switchS switchSCuStatus">
														  <input name="isEggless" value="1" class="switchS-input"  type="checkbox" <?=$isEggless == '1' ? 'checked' : ''?>>
														  <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> 
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="borderChexBx">
														<label>Message option for product?</label>
														<label class="switchS switchSCuStatus">
														  <input name="sMsgOptProdct" value="1" class="switchS-input" type="checkbox" <?=$sMsgOptProdct == '1' ? 'checked' : ''?> />
														  <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> 
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="borderChexBx">
														<label>Message option for card?</label>
														<label class="switchS switchSCuStatus">
														  <input name="isMsgOptCrd" value="1" class="switchS-input" type="checkbox" <?=$isMsgOptCrd == '1' ? 'checked' : ''?> />
														  <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> 
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="borderChexBx">
														<label>Tissue packing required?</label>
														<label class="switchS switchSCuStatus">
														  <input name="isTissuePacking" value="1" class="switchS-input"  type="checkbox" <?=$isTissuePacking == '1' ? 'checked' : ''?>>
														  <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> 
														</label>
													</div>
												</div>
											</div>
											
											<div class="clearfix"></div>
										</div>
										<div id="priceTab" class="tab-pane ">
											<table class="table table-striped table-bordered table-hover no-footer">
												<tr>
													<th>Quantity Type</th>
													<th>Quantity</th>
													<th>Product Price</th>
													<th>Discount Type</th>
													<th>Discount</th>
													<th>Reward</th>
													<th>Action</th>
												</tr>
												<tr>
													<td>
														<select class="selectpicker" name="quentityType[]" title="Quantity Type" data-width="100%" onChange="getQuantity(this)">
															<option value="1">Weight</option>
															<option value="2">Quantity</option>
															<option value="3">Size</option>
														</select>
													</td>
													<td>
														<select class="selectpicker quantity" data-live-search="true" name="quantity[]" title="Quantity" data-width="100%">
															<option value="250g">250g</option>
															<option value="500g">500g</option>
															<option value="750g">750g</option>
														</select>
													</td>
													<td>
														<input type="text" name="productPrice[]" class="form-control" placeholder="Product Price"  />
													</td>
													<td>
														<select class="selectpicker" name="discountType[]" title="Discount Type" data-width="100%">
															<option value="1">Flat Rate (Rs.)</option>
															<option value="2">Percentage (%)</option>
														</select>
													</td>
													<td>
														<input type="text" class="form-control" name="discountPrice[]"  placeholder="Discounted Price" />
													</td>
													<td>
														<input type="text" class="form-control" name="rewardPoint[]" placeholder="Quantity" />
													</td>
													<td>
														<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
													</td>
												</tr>
												<tr>
													<td>
														<select class="selectpicker" name="quentityType[]" title="Quantity Type" data-width="100%" onChange="getQuantity(this.value)">
															<option value="1">Weight</option>
															<option value="2">Quantity</option>
															<option value="3">Size</option>
														</select>
													</td>
													<td>
														<select class="selectpicker quantity" data-live-search="true" name="quantity[]" title="Quantity" data-width="100%">
															<option value="250g">250g</option>
															<option value="500g">500g</option>
															<option value="750g">750g</option>
														</select>
													</td>
													<td>
														<input type="text" name="productPrice[]" class="form-control" placeholder="Product Price"  />
													</td>
													<td>
														<select class="selectpicker" name="discountType[]" title="Discount Type" data-width="100%">
															<option value="1">Flat Rate (Rs.)</option>
															<option value="2">Percentage (%)</option>
														</select>
													</td>
													<td>
														<input type="text" class="form-control" name="discountPrice[]"  placeholder="Discounted Price" />
													</td>
													<td>
														<input type="text" class="form-control" name="rewardPoint[]" placeholder="Quantity" />
													</td>
													<td>
														<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
													</td>
												</tr>
												<tr>
													<th class="text-right">
														Delivery Option
													</th>
													<td>
														<select class="selectpicker" name="deliveryOption[]" title="Delivery Option" data-width="100%" multiple>
															<?=$delOptList;?>
														</select>
													</td>
													<td colspan="4">
													</td>
													<td>
														<button type="button" class="addMoreTbl"><i class="fa fa-plus-circle"></i></button>
													</td>
												</tr>
											</table>
											
											<div class="priceGropCon">
												<div data-toggle="tooltip" title="Remove Panel" class="removePriceGropBox"><i class="fas fa-times-circle"></i></div>
												<table class="table table-bordered no-footer">
													<tr>
														<th class="text-right">State</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" multiple title="Select State" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
															</select>
														</td>
														<th class="text-right">City</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" multiple title="Select City" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
															</select>
														</td>
														<th class="text-right">Delivery Option</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" title="Delivery Option" data-width="100%" multiple>
																<?=$delOptList;?>
															</select>
														</td>
													</tr>
													<tr>
														<table class="table table-bordered no-footer mb0">
															<tr>
																<th width="15%">Group</th>
																<th width="15%">Quantity Type</th>
																<th width="10%">Quantity</th>
																<th width="10%">Price</th>
																<th width="15%">Discount Type</th>
																<th width="10%">Discount</th>
																<th width="10%">Reward</th>
																<th width="10%">Status</th>
																<th width="5%" class="text-center">Action</th>
															</tr>
															<tr>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Group" data-live-search="true" data-size="5"  data-width="fit" >
																		<?=$typeList?>
																	</select>
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Quantity" data-live-search="true" data-size="5"  data-width="fit" >
																		<option>KG</option>
																		<option>Litter</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" title="Discount Type" data-width="fit" >
																		<option>Flat Rate (Rs)</option>
																		<option>Percentage (%)</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<label class="switchS switchSCuStatus">
																	  <input name="isStatus" value="1" class="switchS-input" checked type="checkbox">
																	  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
																	</label>
																</td>
																<td class="text-center">
																	<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
																</td>
															</tr>
															<tr>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Group" data-live-search="true" data-size="5"  data-width="fit" >
																		<?=$typeList?>
																	</select>
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Quantity" data-live-search="true" data-size="5"  data-width="fit" >
																		<option>KG</option>
																		<option>Litter</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" title="Discount Type" data-width="fit" >
																		<option>Flat Rate (Rs)</option>
																		<option>Percentage (%)</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<label class="switchS switchSCuStatus">
																	  <input name="isStatus" value="1" class="switchS-input" checked type="checkbox">
																	  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
																	</label>
																</td>
																<td class="text-center">
																	<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
																</td>
															</tr>
															<tr>
																<td colspan="8"></td>
																<td class="text-center">
																	<button type="button" class="addMoreTbl"><i class="fa fa-plus-circle"></i></button>
																</td>
															</tr>
														</table>
													</tr>
												</table>
											</div>
											
											<div class="priceGropCon">
												<div data-toggle="tooltip" title="Remove Panel" class="removePriceGropBox"><i class="fas fa-times-circle"></i></div>
												<table class="table table-bordered no-footer">
													<tr>
														<th class="text-right">State</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" multiple title="Select State" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
															</select>
														</td>
														<th class="text-right">City</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" multiple title="Select City" data-live-search="true" data-size="5"  data-width="100%" >
															<?=$typeList?>
															</select>
														</td>
														<th class="text-right">Delivery Option</th>
														<td>
															<select class="selectpicker" name="XXXXXXX" title="Delivery Option" data-width="100%" multiple>
																<?=$delOptList;?>
															</select>
														</td>
													</tr>
													<tr>
														<table class="table table-bordered no-footer mb0">
															<tr>
																<th width="15%">Group</th>
																<th width="15%">Quantity Type</th>
																<th width="10%">Quantity</th>
																<th width="10%">Price</th>
																<th width="15%">Discount Type</th>
																<th width="10%">Discount</th>
																<th width="10%">Reward</th>
																<th width="10%">Status</th>
																<th width="5%" class="text-center">Action</th>
															</tr>
															<tr>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Group" data-live-search="true" data-size="5"  data-width="fit" >
																		<?=$typeList?>
																	</select>
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Quantity" data-live-search="true" data-size="5"  data-width="fit" >
																		<option>KG</option>
																		<option>Litter</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" title="Discount Type" data-width="fit" >
																		<option>Flat Rate (Rs)</option>
																		<option>Percentage (%)</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<label class="switchS switchSCuStatus">
																	  <input name="isStatus" value="1" class="switchS-input" checked type="checkbox">
																	  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
																	</label>
																</td>
																<td class="text-center">
																	<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
																</td>
															</tr>
															<tr>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Group" data-live-search="true" data-size="5"  data-width="fit" >
																		<?=$typeList?>
																	</select>
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" multiple title="Select Quantity" data-live-search="true" data-size="5"  data-width="fit" >
																		<option>KG</option>
																		<option>Litter</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Price" name="XXXXXXX" />
																</td>
																<td>
																	<select class="selectpicker" name="XXXXXXX" title="Discount Type" data-width="fit" >
																		<option>Flat Rate (Rs)</option>
																		<option>Percentage (%)</option>
																	</select>
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<input type="text" class="form-control" placeholder="Discount" name="XXXXXXX" />
																</td>
																<td>
																	<label class="switchS switchSCuStatus">
																	  <input name="isStatus" value="1" class="switchS-input" checked type="checkbox">
																	  <span class="switchS-label" data-on="Active" data-off="Inactive"></span> <span class="switchS-handle"></span> 
																	</label>
																</td>
																<td class="text-center">
																	<button type="button" class="removeMoreTbl"><i class="fas fa-minus-circle"></i></button>
																</td>
															</tr>
															<tr>
																<td colspan="8"></td>
																<td class="text-center">
																	<button type="button" class="addMoreTbl"><i class="fa fa-plus-circle"></i></button>
																</td>
															</tr>
														</table>
													</tr>
												</table>
											</div>
											<div class="text-center">
												<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add More</button>
											</div>
											<div class="clearfix"></div>
										</div>
										<div id="galleryTab" class="tab-pane ">											
											<div class="col-sm-3">
												<div class="form-group">
													<label> &nbsp;</label>
													<div class="form-group dropyCHet mb0">
														<input name="img" type="file" data-allowed-file-extensions="png jpg gif jpeg" class="dropify" data-max-file-size="2M" data-default-file="<?=$iURL_product?><?=$img ? $img : 'default.jpg'?>"/>
													</div>
												</div>
											</div>											
											<div class="col-sm-3">
												<label>&nbsp;</label>
												<div class="addMoreImagePro"> <i class="fas fa-images"></i> <span>Add More</span> </div>
											</div>											
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
										<!--
										<div id="reviewTab" class="tab-pane">
											<div class="manualReviewFomCnt">
												<div class="col-md-6">
													<div class="form-group mb0">
														<label class="required">Review</label>
														<textarea style="min-height:119px" class="form-control reviewText"></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="required">Full Name</label>
																<input type="text" class="form-control reviewerName" placeholder="Enter Full Name" />
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="required">Email</label>
																<input type="text" class="form-control reviewerEmail" placeholder="Enter Email" />
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group mb0">
																<label>Phone</label>
																<input type="text" class="form-control phoneOnly reviewerPhone" placeholder="Enter Phone" />
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group mb0">
																<label>Review Date</label>
																<div class="input-group date reviewDateView" data-date-format="dd/mm/yyyy - HH:ii p" data-link-field="dtp_input1">
																  <input class="form-control" size="16" type="text" value="" readonly>			
																  <span class="input-group-addon">
																	  <span class="glyphicon glyphicon-th"></span>
																  </span>
																</div>
																<input type="hidden" id="dtp_input1" value="" />
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group mb0">
																<label class="required">Rating</label>
																<input type="hidden" class="reviewerRatingValue" />
																<div class="rateyo reviewerRating"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group text-center">
													<label> &nbsp; </label>
													<div class="clearfix"></div>
													<button type="button" class="btn btn-inverse resetBtnRevewi"><i class="fas fa-retweet"></i> Reset</button>
													<button type="button" class="btn btn-primary manualREvBoxBtn"><i class="fas fa-plus"></i> Manual Review</button>
													<button type="button" class="btn btn-primary addREvBoxBtn"><i class="fas fa-plus"></i> Add Review</button>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="boxRevewcontinerList">
												<div class="hr dotted hr-double"></div>
												<table class="table reviewListing table-striped table-bordered table-hover no-footer">
													<thead>
														<tr>
															<th>Name</th>
															<th>Email</th>
															<th>Phone</th>
															<th>Date</th>
															<th>Rating</th>
															<th>Review</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
-->									</div>
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