<?php
	$cid = decode( $this->session->userdata( 'CID' ) );
	$pid = $productDataObj[ 0 ]->product_id;
	$priceObj = getProductPrice( $productDataObj[ 0 ]->product_id );

	$weightList = $shippingPrice = '';
	$price = $discount_price = $fristWeightID = 0;

	if($priceObj){
		$price = $priceObj[ 0 ]->product_price;
		$discount_price = getDiscount( $priceObj[ 0 ]->discount_type, $priceObj[ 0 ]->product_price, $priceObj[ 0 ]->discount );
		$selCount = 1;
		foreach ( $priceObj as $priceData ) {
			if ( $selCount == 1 ) {
				$weightList .= '<li class="active" onClick="getPriceByWeight(' . $priceData->id . ',this)">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</li>';
				$fristWeightID = $priceData->id;
			} else {
				$weightList .= '<li onClick="getPriceByWeight(' . $priceData->id . ',this)">' . $priceData->quantity . '&nbsp;' . $priceData->quantity_type . '</li>';
			}
			$selCount++;
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$productDataObj[0]->name?>| Creamy Roses</title>
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
											<input type="hidden" class="pid" value="<?=$pid?>"/>
											<button class="js-cart-button" onClick="addToCart(this)" type="button">Add to Cart</button>
											<button class="js-cart-button js-cart-button_buy" onClick="addToCart(this, 'buy')" type="button">Buy Now</button>
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
												<?=trimData($productDataObj[0]->description, 350, true)?>
												<?=strlen($productDataObj[0]->description) > 350 ? ' <a class="readmoreAncher" href="#description_tab">read more</a>' : ''?>
											</div>
											<div class="seprator"></div>
											<div class="product-price-area">
												<div class="product-price-details">
													<p class="js-price1">
														<span><i class="fas fa-rupee-sign"></i></span>
														<span class="final_price">
															<?=number_format($price,2)?>
														</span>
													</p>
													<p class="js-price1-discount">
														<span><i class="fas fa-rupee-sign"></i></span>
														<span class="before_discount">wait</span>
													</p>
													<p class="js-discount-type">
														<span class="discount_type">
															<m><i class="fas fa-rupee-sign"></i> wait</m> OFF</span>
													</p>
												</div>
												<div class="product-addon-wrap">
													<div class="js-addon-desc">
														<div class="item-list">
															<h3>Select Weight</h3>
															<input type="hidden" class="price_id"/>
															<ul class="cake-attribute">
																<?=$weightList?>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<label class="js-upgrade-title">
											<input <?=$productDataObj[0]->isEggless == '1' ? 'checked' : ''?> class="isEggless" type="checkbox" /> Do you want to make it Eggless ? <!--Rs. 50-->
											</label>
										
											<br>

											<div class="clearfix"></div>
											<div class="boxTopShap">
												<div class="delivery_lbl_b">Delivery</div>
												<div class="form-group delivery_bx_b">
													<div class='input-group'>
														<input type='text' maxlength="6" value="<?=$this->session->userdata('PIN_CODE')?>" class="form-control pin_code integersOnly" placeholder="Enter delivery pincode" id="pincode" required/>
														<span class="input-group-addon btn-check" onClick="checkPinCode(this)">
														<?=$this->session->userdata('PIN_CODE') ? 'Change' : 'Check'?>
													</span>
													

														<span class="pinValiMsg"> </span>
														<span class="pinValiSuccMsg <?=$this->session->userdata('PIN_CODE') ? 'show_now_inline' : ''?>">Delivery Location PIN Code:  <m><?=$this->session->userdata('PIN_CODE')?></m>  </span>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="clearfix"></div>
											<div class="seprator"></div>
											<div class="msgOnCakOp">
												<label>Message on Cake:</label>
												<input type="text" class="form-control cake_message"/>
											</div>
											<div class="clearfix"></div>
											<div class="boxEmailAddWish">
												<ul>
													<li>
														<a onClick="addToWishList(this, '<?=$productDataObj[0]->product_id?>')" href="javascript:;">
															<?php 
														$wishClas = 'far';
														$wishLbl = 'Add';
												   		if($cid){
															$wishListData = getProductWishList($productDataObj[0]->product_id, $cid);
															$wishClas =  $wishListData ? 'fas' : 'far';
															$wishLbl = $wishListData ? 'Added' : 'Add';
														}
													?>
															<span><i class="<?=$wishClas?> fa-heart"></i> &nbsp; <m><?=$wishLbl?></m> to Wishlist</span>
														</a>
													</li>
													<li>
														<a class="email-friend" href="mailto:info@creamyroses.com?subject=Creamyroses&body=Have a look to this URL to get delicious cake - <?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"><span>Email to a Friend</span></a>
													</li>
												</ul>
											</div>
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
		
		<?php include("includes/footer.php"); ?>
		<?php include("includes/script.php"); ?>
		<script>
			getPriceByWeight( <?=$fristWeightID?>, this );
		</script>
		<script type="text/javascript" src="<?=$iURL_storeAssts?>js/cloud-zoom.js"></script>
	</body>

</html>