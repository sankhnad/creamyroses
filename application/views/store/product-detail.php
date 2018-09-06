<?php
$cid = $this->session->userdata('CID');
$priceObj = getProductPrice($productDataObj[0]->product_id);

if($priceObj){
	$price = $priceObj[0]->product_price;
	$discount_price = getDiscount( $priceObj[ 0 ]->discount_type, $priceObj[ 0 ]->product_price, $priceObj[ 0 ]->discount );

	$weightList = '';
	$selCount = 1;
	foreach ( $priceObj as $priceData ) {
		if ( $selCount == 1 ) {
			$weightList .= '<option selected="selected" value="' . encode( $priceData->id ) . '">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</option>';
		} else {
			$weightList .= '<option value="' . encode( $priceData->id ) . '">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</option>';
		}
		$selCount++;
	}
}else{
	$price = 0;
	$discount_price = 0;
}

if($delivarySlotObj){
	$shippingMethodList = '';
	$shippingPrice = '';
	foreach ( $delivarySlotObj as $shipData ) {
		if ( $shipData->price > 0 ) {
			$shippingPrice = '<i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;' . $shipData->price;
		} else {
			$shippingPrice = 'Free';
		}

		$shippingMethodList .= '<option value="' . encode( $shipData->option_id ) . '">' . $shipData->name . '&nbsp;(' . $shippingPrice . ')</option>';
	}
} else {
	$price = 0;
	$discount_price = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$categoryObj[0]->name?>| Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">
	<?php include("includes/header.php"); ?>

	<section class="main-container col1-layout">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="breadcrumbs" style="float: left;">
						<ul>
							<li class="home"> <a href="./" title="Go to Home Page">Home</a> <span>/</span> </li>
							<li class="category1601"> <strong><?=$productDataObj[0]->name?> </strong> </li>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 col-xs-12">
					<article class="col-main">
						<div class="product-view">
							<div class="product-essential">
								<div class="product-img-box col-lg-4 col-sm-6 col-xs-12">
									<div class="new-label new-top-left"> New </div>
									<div class="product-image">
										<div class="product-full">
											<img id="product-zoom" src="<?=$iURL_product?><?=$productDataObj[0]->image?>" data-zoom-image="<?=$iURL_product?><?=$productDataObj[0]->image?>" alt="product-image"/> 
										</div>
										<?php if($imageObj){ ?>
										<div class="more-views">
											<div class="slider-items-products">
												<div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
													<div class="slider-items slider-width-col4 block-content">
														<?php foreach($imageObj as $imgData){ ?>
															<div class="more-views-items">
																<a href="javascript:;" data-image="<?=$iURL_product?><?=$imgData->image?>" data-zoom-image="<?=$iURL_product?><?=$imgData->image?>"> <img src="<?=$iURL_product?><?=$imgData->image?>" alt="product-image"/> </a>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>

								<div class="product-shop col-lg-8 col-sm-6 col-xs-12">
									<div class="product-next-prev"> 
										<a class="product-next" href="#"><span></span></a> 
										<a class="product-prev" href="#"><span></span></a> 
									</div>
									<div class="product-name">
										<h1><?=$productDataObj[0]->name?></h1>
									</div>
									<div class="ratings"></div>
									
									<div class="price-block">
										<div class="price-box">
											<?php if($discount_price > 0){ ?>
											<p class="special-price"> 
												<span class="price-label">Special Price</span> <span id="product-price-48" class="price"> <i class="fas fa-rupee-sign" aria-hidden="true"></i><span id="discount_price"> <?=number_format($discount_price,2)?> </span></span>
											</p>
											<p class="old-price"> 
												<span class="price-label">Regular Price:</span> <span class="price"> <i class="fas fa-rupee-sign" aria-hidden="true"></i><span id="normalPrice"> <?=number_format($price,2)?> </span></span>
											</p>
											<p class="availability in-stock in-off pull-right">
												<span>(<i class="fas fa-rupee-sign" aria-hidden="true"></i> <?=$priceObj[0]->discount?> Off)</span>
											</p>
											<?php } else { ?>
											<p class="special-price">
												<span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span>
											</p>
											<?php } ?>
										</div>
									</div>

									<div class="check-pincode">
										<div class="pull-left">
											<div class="row">
												<label class="col-md-1">Delivery</label>
												<div class='col-sm-4'>
													<div class="form-group">
														<div class='input-group date' id='datetimepicker1'>
															<input type='text' class="form-control" placeholder="Enter Pincode"/>
															<span class="input-group-addon btn-check">
																	Change
																</span>
														
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="short-description">
										<h2>Quick Overview</h2>
										<?=substr($productDataObj[0]->description,0,160)?>
									</div>
									<div class="weight-eggless-selector">
										<div class="weight-selector">
											<div class="pull-left">
												<select name="" id="weight-sel" onChange="getPriceByWeight(this.value)">
													<?=$weightList;?>
												</select>
											</div>
											<div class="eggless-selector">
												<?php if($productDataObj[0]->isEggless ==1){?>
												<p>Make it eggless <input type="checkbox" checked="checked" name="isEggless"/>
												</p>
												<!--<small>Rs. 100</small>-->
												<?php }else{ ?>
												<p>Make it eggless <input type="checkbox" name="isEggless"/>
												</p>
												<?php } ?>
											</div>
										</div>
									</div>

									<div class="date-time-selector">
										<div class="weight-selector">
											<div class="eggless-selector"></div>
											<div class="pull-left">
												<div class="row">
													<div class='col-sm-8'>
														<div class="form-group">
															<h5><input type="checkbox" name="" /> Midnight Delivery (For Delivery between 10 PM - 12:30 AM)</h5>
														</div>
													</div>
												</div>

												<div class="row">
													<div class='col-sm-3'>
														<div class="form-group">
															<div class='input-group date' id='datetimepicker1'>
																<input type='text' class="form-control" placeholder="Select Date"/>
																<span class="input-group-addon">
																	<span class="glyphicon glyphicon-calendar"></span>
																</span>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class='col-sm-3'>
														<div class="form-group">
															<div class='input-group date' id='datetimepicker3'>
																<input type='text' class="form-control" placeholder="Select Time"/>
																<span class="input-group-addon">
																	<span class="glyphicon glyphicon-time"></span>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="add-to-box">
										<div class="add-to-cart">
											<div class="pull-left">
												<button onClick="productAddToCartForm.submit(this)" class="button btn-cart" title="Add to Cart" type="button">Add to Cart</button>
											</div>
											<button class="button btn-buy" title="Buy Now" type="button">Buy Now</button>
										</div>
									</div>
									<div class="email-addto-box">
										<ul class="add-to-links">
											<li>
												<a onClick="addToWishList(this, '<?=$productDataObj[0]->product_id?>')" href="javascript:;">
													<?php 
														$wishClas = 'far'; 
												   		if($cid){
															$wishClas = getProductWishList($productDataObj[0]->product_id, $cid) ? 'fas' : 'far';
														}
													?>
													<span><i class="<?=$wishClas?> fa-heart"></i> &nbsp; Add to Wishlist</span>
												</a>
											</li>
											<li>
												<a class="email-friend" href="mailto:info@creamyroses.com?subject=Creamyroses&body=Have a look to this URL to get delicious cake - <?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"><span>Email to a Friend</span></a>
											</li>
										</ul>
										
									</div>
								</div>
							</div>

							<div class="product-collateral">
								<div class="add_info">
									<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
										<li class="active"> <a href="#description_tab" data-toggle="tab">Description </a> </li>
										<li> <a href="#delivery_tab" data-toggle="tab">Delivery Information</a> </li>
										<li> <a href="#care_tab" data-toggle="tab">Care Instructions</a> </li>
									</ul>
									<div id="productTabContent" class="tab-content">
										<div class="tab-pane fade in active" id="description_tab">
											<div class="std">
												<?=$productDataObj[0]->description?>
											</div>
										</div>
										<div class="tab-pane fade" id="delivery_tab">
											<div class="product-tabs-content-inner clearfix">
												<?=$productDataObj[0]->delivery_description?>
											</div>
										</div>
										<div class="tab-pane fade" id="care_tab">
											<div class="product-tabs-content-inner clearfix">
												<?=$productDataObj[0]->refund_description ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="featured-pro-block">
								<div class="slider-items-products">
									<div class="new-arrivals-block">
										<div class="block-title">
											<h2>Related Products </h2>
										</div>
										<div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
											<div class="home-block-inner"> </div>
											<div class="slider-items slider-width-col4 products-grid block-content">
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info">
																<a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product10.jpg"> </a>
																<div class="new-label new-top-left">new</div>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 245.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product11.jpg"> </a>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 155.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- End Item -->
												<!-- Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product12.jpg"> </a>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 185.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- End Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info">
																<a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product13.jpg"> </a>
																<div class="new-label new-top-left">new</div>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 235.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product14.jpg"> </a>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 225.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- End Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product16.jpg"> </a>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 335.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Item -->
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="<?=$iURL_storeAssts?>products-images/product22.jpg"> </a>
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 125.00</span> </span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- End Item -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>
	<!-- Main Container End -->

	<?php include("includes/footer.php"); ?>
	<?php include("includes/script.php"); ?>
	<script type="text/javascript" src="<?=$iURL_storeAssts?>js/cloud-zoom.js"></script>
</body>
</html>