<?php
$cid = $this->session->userdata('CID');
$priceObj = getProductPrice($productDataObj[0]->product_id);

if($priceObj){
	$price = $priceObj[0]->product_price;
	$discount_price = getDiscount( $priceObj[ 0 ]->discount_type, $priceObj[ 0 ]->product_price, $priceObj[ 0 ]->discount );


	$weightList = '';
	$selCount = 1;
	//echo '<pre>';print_r($priceObj);die;
	foreach ( $priceObj as $priceData ) {
		if ($selCount == 1){
			$weightList .= '<li class="active" onClick="getPriceByWeight('.$priceData->id.',this)">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</li>';
		}else{
			$weightList .= '<li onClick="getPriceByWeight('.$priceData->id.',this)">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</li>';
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
								
		$shippingMethodList .= '<input type="radio" name="delivery_tiem[]" value="' . encode( $shipData->option_id ) . '">' . $shipData->name . '&nbsp;(' . $shippingPrice . ')<br/>';
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
	<title><?=$productDataObj[0]->name?> | Creamy Roses</title>
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
									<div class="boxAddToCartB">
										<button class="js-cart-button" type="button">Add to Cart</button>
										<button class="js-cart-button js-cart-button_buy" type="button">Buy Now</button>
									</div>
									<div class="boxEmailAddWish">
										<ul>
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

								<div class="product-shop col-lg-8 col-sm-6 col-xs-12">									
									<div class="pro-desc">
										<div class="pro-title">
											<h1 class="js-pro-title"><?=$productDataObj[0]->name?></h1>
										</div>
										<div class="seprator"></div>
										<div class="product-contain">
											<p>Quick Overview</p><br>
											<?=trimData($productDataObj[0]->description, 160, true)?>
										</div>
										<div class="seprator"></div>
										<div class="product-price-area">
											<div class="product-price-details">
												<p class="js-price1"> <span>Rs.</span> <span id="discount_price"><?=number_format($price,2)?></span></p>
											</div>
											<div class="product-addon-wrap">
												<div class="js-addon-desc">
													<div class="item-list">
														<h3>Select Weight</h3>
														<ul class="cake-attribute">
															<?=$weightList?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<label class="js-upgrade-title"><input <?=$productDataObj[0]->isEggless == '1' ? 'checked' : ''?> type="checkbox" /> Do you want to make it Eggless ? <!--Rs. 50--></label><br>
										<label class="js-upgrade-title"><?=$shippingMethodList?>
										<!--<input type="radio" /> Midnight Delivery (For Delivery between 10 PM - 12:30 AM)</label>-->
										
										<div class="boxTopShap">
											<div class="delivery_lbl_b">Delivery</div>
											<div class="form-group delivery_bx_b">
												<div class='input-group'>
													<input type='text' class="form-control numericOnly" placeholder="Enter delivery pincode" id="pincode" required/>
													<span class="input-group-addon btn-check" onClick="checkPinCode()">
														Check
													</span>
													<span id="errormsg" class="pinValiMsg">Not a valid pincode  Please enter 6 digit pincode  We dont deliver in this area. </span>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="seprator"></div>
									
									</div>
									<div class="clearfix"></div>
									<div class="product-next-prev"> 
										<a class="product-next" href="#"><span></span></a> 
										<a class="product-prev" href="#"><span></span></a> 
									</div>
									
									
								</div>
							</div>

							<div class="product-collateral">
								<div class="add_info">
									<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
										<li class="active"> <a href="#description_tab" data-toggle="tab">Description </a> </li>
										<li> <a href="#delivery_tab" data-toggle="tab">Delivery Policy</a> </li>
										<li> <a href="#care_tab" data-toggle="tab">Refund Policy</a> </li>
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