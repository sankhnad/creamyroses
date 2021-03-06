<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('includes/commonfile.php');?>
	<title>Home | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>
<body class="shopping-cart-page">
	<?php include("includes/header.php"); ?>
	<!-- Start: Slider Sec -->
	<section class="slid-sec main-slid-sec">
	    <div class="container-fluid">
	      	<div class="row">
		        <div class="col-md-12 no-padding">					
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					    <!-- Indicators -->
					    <ol class="carousel-indicators">
							<?php $sliderObj =  getSlider();
							$i = 0;
							$imgSlid = '';
							foreach($sliderObj as $sliderData){
								$isActive = $i == '0' ? 'active':'';
								if(!$sliderData->avtar){
									continue;
								}
							?>
					      	<li data-target="#myCarousel" data-slide-to="<?=$i?>" class="<?=$isActive?>"></li>
							<?php
								$imgSlid .= '<div class="item '.$isActive.'">
								<div class="updateBxLe">'.$sliderData->heading.'</div>
								<div class="updateBxDis">'.$sliderData->description.'<br><br><a href="'.$sliderData->button_link.'">'.$sliderData->button_text.'</a></div>
								<img src="'.$iURL_banner.$sliderData->avtar.'" alt="Chicago" style="width:100%;"></div>';
								$i++; } ?>
					    </ol>

					    <!-- Wrapper for slides -->
					    <div class="carousel-inner">
					      <?=$imgSlid?>
					    </div>

					    <!-- Left and right controls -->
					    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
					      <span class="glyphicon glyphicon-chevron-left"></span>
					      <span class="sr-only">Previous</span>
					    </a>
					    <a class="right carousel-control" href="#myCarousel" data-slide="next">
					      <span class="glyphicon glyphicon-chevron-right"></span>
					      <span class="sr-only">Next</span>
					    </a>
					  </div>
		        </div>
	      	</div>
	    </div>
	</section>
	<!-- End: Slider Sec -->

	<section class="main-container col2-left-layout">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<div style="overflow:hidden">
						<div class="figure banner-with-effects effect-sadie1 banner-width  with-button" style="background-color:#ffffff"><img src="<?=$iURL_storeAssts?>images/watch.jpg" alt="">
							<div class="figcaption">
								<div class="banner-content left top"><span style="color: #ffffff; font-size: 12px; letter-spacing:1px; font-weight:600">DIGITAL LIFE</span><br>
									<span style="font-size: 24px; color: #ffffff;">Slim, smart and <br style="color: #ffffff; font-size: 24px;">
									beautiful</span>
								</div>
							</div>
							<a href="#" style="color:#fff" class="left bottom btn_type_1" rel="nofollow">Read more</a></div>
						<div class="figure banner-with-effects effect-sadie1 banner-width  with-button" style="background-color:#ffffff"><img src="<?=$iURL_storeAssts?>images/shoes-banner.jpg" alt="">
							<div class="figcaption">
								<div class="banner-content left top"><b><span style="color: #fff; font-size: 12px; letter-spacing:1px">TODAYS OFFER</span></b><br>
									<span style="color: #ffffff; font-size: 24px; padding-top:5px">Men's shoes <br style="color: #ffffff; font-size: 24px;">
									collection</span>
								</div>
							</div>
							<a href="#" style="color:#fff" class="left bottom btn_type_1" rel="nofollow">Read more</a></div>
					</div>
					
					<div class="featured-pro-block">
						<div class="slider-items-products">
							<div class="new-arrivals-block">
							<?php foreach($typeAry as $typeData){ 
									if($typeData->sort_order == 1){
											$productObj = getProductList($typeData->type_id);
							?>
								<div class="block-title">
									<h2><?=$typeData->name;?></h2>
								</div>
								<div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
									<div class="home-block-inner"> </div>
									<div class="slider-items slider-width-col4 products-grid block-content">
										<?php
										 foreach($productObj as $data){ 
											$priceObj = getProductPrice($data->product_id);
											if(count($priceObj) > 0){
												$price = $priceObj[0]->product_price;
												$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);
											}else{
												$price = 0;
												$discount_price = 0;
											}

											$diff = abs(strtotime($data->created_on) - strtotime(date( "Y-m-d H:i:s", time() )));
											$date1 = new DateTime(date( "Y-m-d H:i:s", time() ));
											$date2 = new DateTime($data->created_on);
											$interval = $date1->diff($date2);
										 ?>
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <img alt="<?=$data->name?>" src="<?=$iURL_product?><?=$data->image?>"> </a>
																<?php if($interval->days < 30){?>
																	<div class="new-label new-top-left">New</div>
																<?php } ?>
																
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <?=$data->name?> </a> </div>
																
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box">
																			<?php if($discount_price > 0){ ?>
																			<p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($discount_price,2)?> </span> </p>
																			<?php }else{ ?>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<?php } ?>

																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
												</div>
										<?php } ?>
									</div>
								</div>
							<?php }} ?>
							</div>
						</div>
					</div>
					
					
					<div class="offer-banner"> <a href="#"><img alt="Banner" src="<?=$iURL_storeAssts?>images/banner-img.png" style="width: 100%;"></a> </div>

					<!-- bestsell slider -->
					<div class="featured-pro-block">
						<div class="slider-items-products">
							<div class="new-arrivals-block">
							<?php foreach($typeAry as $typeData){ 
									if($typeData->sort_order == 2){
										$productObj = getProductList($typeData->type_id);
							?>
								<div class="block-title">
									<h2><?=$typeData->name;?></h2>
								</div>
								<div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
									<div class="home-block-inner"> </div>
									<div class="slider-items slider-width-col4 products-grid block-content">
										<?php foreach($productObj as $data){ 
										 			$priceObj = getProductPrice($data->product_id);
													if(count($priceObj) > 0){
														$price = $priceObj[0]->product_price;
														$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);

													}else{
														$price = 0;
														$discount_price = 0;
													}
													
													$diff = abs(strtotime($data->created_on) - strtotime(date( "Y-m-d H:i:s", time() )));
													$date1 = new DateTime(date( "Y-m-d H:i:s", time() ));
													$date2 = new DateTime($data->created_on);
													$interval = $date1->diff($date2);
													
													
										?>
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <img alt="<?=$data->name?>" src="<?=$iURL_product?><?=$data->image?>"> </a>
																<?php if($interval->days < 30){?>
																	<div class="new-label new-top-left">New</div>
																<?php } ?>
																
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <?=$data->name?> </a> </div>
																
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box">
																			<?php if($discount_price > 0){ ?>
																			<p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($discount_price,2)?> </span> </p>
																			<?php }else{ ?>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<?php } ?>

																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
												</div>
										<?php } ?>
									</div>
								</div>
							<?php }} ?>
							</div>
						</div>
					</div>

					<div class="offer-banner"> <a href="#"><img alt="Banner" src="<?=$iURL_storeAssts?>images/banner-img.png" style="width: 100%;"></a> </div>

					<div class="featured-pro-block">
						<div class="slider-items-products">
							<div class="new-arrivals-block">
							<?php foreach($typeAry as $typeData){ 
									if($typeData->sort_order > 2){
									
										$productObj = getProductList($typeData->type_id);
												
									
							?>
								<div class="block-title">
									<h2><?=$typeData->name;?></h2>
								</div>
								<div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
									<div class="home-block-inner"> </div>
									<div class="slider-items slider-width-col4 products-grid block-content">
										<?php foreach($productObj as $data){ 
										 			$priceObj = getProductPrice($data->product_id);
													if(count($priceObj) > 0){
														$price = $priceObj[0]->product_price;
														$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);

													}else{
														$price = 0;
														$discount_price = 0;
													}
													
													$diff = abs(strtotime($data->created_on) - strtotime(date( "Y-m-d H:i:s", time() )));
													$date1 = new DateTime(date( "Y-m-d H:i:s", time() ));
													$date2 = new DateTime($data->created_on);
													$interval = $date1->diff($date2);
										
										?>
												<div class="item">
													<div class="item-inner">
														<div class="item-img">
															<div class="item-img-info"> <a class="product-image" title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <img alt="<?=$data->name?>" src="<?=$iURL_product?><?=$data->image?>"> </a>
																<?php if($interval->days < 30){?>
																	<div class="new-label new-top-left">New</div>
																<?php } ?>
																
															</div>
														</div>
														<div class="item-info">
															<div class="info-inner">
																<div class="item-title"> <a title="<?=$data->name?>" href="<?=base_url();?><?=$data->url_slug?>"> <?=$data->name?> </a> </div>
																
																<div class="item-content">
																	<div class="item-price">
																		<div class="price-box">
																			<?php if($discount_price > 0){ ?>
																			<p class="old-price"><span class="price-label">Regular Price:</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($discount_price,2)?> </span> </p>
																			<?php }else{ ?>
																			<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($price,2)?> </span> </p>
																			<?php } ?>

																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
												</div>
										<?php } ?>
									</div>
								</div>
							<?php }} ?>

							</div>
						</div>
					</div>					
				</div>

				<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
					<div class="featured-add-box">
						<div class="featured-add-inner"> <a href="#"> <img src="<?=$iURL_uploads?>pages/side-banner.jpg" alt="f-img"></a>
							<div class="banner-content">
								<div class="banner-text">Electronics</div>
								<div class="banner-text1">20% off</div>
								<p>limited time offer</p>
								<a href="#" class="view-bnt">Shop now</a> </div>
						</div>
					</div>

					<div class="hot-deal">
						<ul class="products-grid">
							<li class="right-space two-height item">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info"> <a href="#" title="Retis lapen casen" class="product-image"> <img src="<?=$iURL_storeAssts?>products-images/product21.jpg" alt="Retis lapen casen"> </a>
											<div class="hot-label hot-top-left">Hot Deal</div>
											<div class="box-timer">
												<div class="countbox_1 timer-grid"></div>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title"> <a href="#" title="Retis lapen casen"> Retis lapen casen </a> </div>
											<div class="item-content">
												<div class="item-price">
													<div class="price-box"> <span class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i> 125.00</span> </span> </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>

					<div class="testimonials">
						<div class="ts-testimonial-widget">
							<div class="slider-items-products">
								<div id="testimonials-slider" class="product-flexslider hidden-buttons home-testimonials">
									<div class="slider-items slider-width-col4 fadeInUp owl-carousel owl-theme">
										<?php
											$testimonialObj =  getTestimonial();
											foreach($testimonialObj as $testimonialData){
										?>
										<div class="holder">
											<p data-tooltip="true" title="<?=strlen($testimonialData->description) > 200 ? $testimonialData->description : ''?>"><?=trimData($testimonialData->description, 200)?></p>
											<div class="testimonial-arrow-down"></div>
											<div class="thumb">
												<div class="customer-img"> <img src="<?=$iURL_testimonials?><?=$testimonialData->avtar ? $testimonialData->avtar : 'user.png'?>" alt="<?=$testimonialData->name?>"> </div>
												<div class="customer-bio"> <strong class="name"><a href="#"><?=$testimonialData->name?></a></strong> <span><?=$testimonialData->company?>, <?=$testimonialData->designation?></span> </div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="featured-add-box">
						<div class="featured-add-inner"> <a href="#"> <img src="<?=$iURL_storeAssts?>images/ads-07.jpg" alt="f-img"></a>
							<div class="banner-content">
								<div class="banner-text">Electronics</div>
								<div class="banner-text1">20% off</div>
								<p>limited time offer</p>
								<a href="#" class="view-bnt">Shop now</a> </div>
						</div>
					</div>
					
				 	<div>
						<div class="our-features-box">
							<div class="row">

								<div class="col-lg-12 space">
									<div class="feature-box"> <span class="far fa-life-ring"></span>
										<div class="content">
											<h3>Help Center</h3>
											<p>Lorem ipsum dolor sit amet</p>
										</div>
									</div>
								</div>
								<div class="col-lg-12 space">
									<div class="feature-box"> <span class="fas fa-hand-holding-usd"></span>
										<div class="content">
											<h3>Easy RETURNS</h3>
											<p>Lorem ipsum dolor sit amet</p>
										</div>
									</div>
								</div>
								<div class="col-lg-12 space">
									<div class="feature-box last"> <span class="fas fa-truck"></span>
										<div class="content">
											<h3>Fastest Delivery</h3>
											<p>Lorem ipsum dolor sit amet</p>
										</div>
									</div>
								</div>
								<div class="col-lg-12 space">
									<div class="feature-box last"> <span class="fas fa-phone-volume"></span>
										<div class="content">
											<h3>Helpline  +0800 567 345</h3>
											<p>Lorem ipsum dolor sit amet</p>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div> 
				</aside>
			</div>
		</div>
	</section>	

<?php include("includes/footer.php"); ?>

<?php include("includes/script.php"); ?>

	<script type="text/javascript" src="<?=$iURL_storeAssts?>js/countdown.js"></script> 
	<!-- Hot Deals Timer 1--> 
	<script type="text/javascript">
		var dthen1 = new Date("12/25/17 11:59:00 PM");
		start = "08/04/15 03:02:11 AM";
		start_date = Date.parse(start);
		var dnow1 = new Date(start_date);
		if (CountStepper > 0)
		ddiff = new Date((dnow1) - (dthen1));
		else
		ddiff = new Date((dthen1) - (dnow1));
		gsecs1 = Math.floor(ddiff.valueOf() / 1000);
		
		var iid1 = "countbox_1";
		CountBack_slider(gsecs1, "countbox_1", 1);
	</script>

</body>
</html>
