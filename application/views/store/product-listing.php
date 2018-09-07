<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$categoryObj[0]->name?> | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="grid-page">	
	<?php include("includes/header.php"); ?>

	<!-- Main Container -->
	<section class="main-container col2-left-layout">
		<div class="container-fluid">
			<div class="row">

				<div class="col-sm-9 col-sm-push-3">
					<!-- Breadcrumbs -->
					<div class="breadcrumbs">
						<ul>
							<li class="home"> <a href="<?=base_url()?>" title="Go to Home Page">Home</a> <span>/</span> </li>
							<li class="category1599"> <a href="<?=base_url()?><?=$categoryObj[0]->url_slug?>"><?=$categoryObj[0]->name?></a>
								<!-- <span>/</span> -->
							</li>
							<!-- <li class="category1599"> <a href="#" > Delicious Cakes</a> </li> -->
						</ul>
					</div>
					<!-- Breadcrumbs End -->

					<div class="page-title">
						<h2 class="page-heading"> 
							<span class="page-heading-title"><?=$categoryObj[0]->name?></span> 
						</h2>
					</div>
					
					<article class="col-main">
						<div class="toolbar">
							<div class="display-product-option">
								<div class="pages">
									<label>Page:</label>
									<ul class="pagination">
										<li><a href="#">&laquo;</a>
										</li>
										<li class="active"><a href="#">1</a>
										</li>
										<li><a href="#">2</a>
										</li>
										<li><a href="#">3</a>
										</li>
										<li><a href="#">&raquo;</a>
										</li>
									</ul>
								</div>
								<div class="product-option-right">
									<div id="sort-by">
										<label class="left">Sort By: </label>
										<ul>
											<li>
												<a href="#">Relevance<span class="right-arrow"></span></a>
												<ul>
													<!-- <li><a href="#">Relevance</a></li> -->
													<li><a href="#">Price Low-High</a></li>
													<li><a href="#">Price High-Low</a></li>
												</ul>
											</li>
										</ul>
										<a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a>
									</div>
									<div class="pager">
										<div id="limiter">
											<label>View: </label>
											<ul>
												<li>
													<a href="#">12<span class="right-arrow"></span></a>
													<ul>
														<li><a href="#">100</a>
														</li>
														<li><a href="#">500</a>
														</li>
														<li><a href="#">1000</a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="category-products">
							<ul class="products-grid">
								<?php
								if($productListObj){
								foreach($productListObj as $productList){
									$diff = abs(strtotime($productList->p_created_on) - strtotime(date( "Y-m-d H:i:s", time() )));
	
									$date1 = new DateTime(date( "Y-m-d H:i:s", time() ));
									$date2 = new DateTime($productList->p_created_on);
									$interval = $date1->diff($date2);
									
									$priceObj = getProductPrice($productList->p_product_id);
									if(count($priceObj) > 0){
										$price = $priceObj[0]->product_price;
										$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);

									}else{
										$price = 0;
										$discount_price = 0;
									}									
								?>
								<li class="item col-lg-3 col-md-4 col-sm-4 col-xs-6">
									<div class="item-inner">
										<div class="item-img">
											<div class="item-img-info">
												<a href="<?=base_url()?><?=$categoryObj[0]->url_slug?>/<?=$productList->p_url_slug?>" title="<?=$productList->p_name?>" class="product-image"><img src="<?=base_url()?>uploads/product/thumb/<?=$productList->p_image?>" alt="<?=$productList->p_name?>"></a>
												<?php if($interval->days < 30){?>
												<div class="new-label new-top-left">New</div>
												<?php } ?>
												<div class="label-wishlist"><i class="fab fa-gratipay"></i>
												</div>
											</div>
										</div>
										<div class="item-info">
											<div class="info-inner">
												<div class="item-title"> <a title="<?=$productList->p_name?>" href="product-detail.php"> <?=$productList->p_name?> </a> </div>
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
								</li>
								<?php 
									}
								}else{
									echo 'No Record Found';
								}
								?>
							</ul>
						</div>

						<div class="toolbar">
							<div class="display-product-option">
								<div class="pages">
									<label>Page:</label>
									<ul class="pagination">
										<li><a href="#">&laquo;</a>
										</li>
										<li class="active"><a href="#">1</a>
										</li>
										<li><a href="#">2</a>
										</li>
										<li><a href="#">3</a>
										</li>
										<li><a href="#">&raquo;</a>
										</li>
									</ul>
								</div>
								<div class="product-option-right">
									<div id="sort-by">
										<label class="left">Sort By: </label>
										<ul>
											<li>
												<a href="#">Relevance<span class="right-arrow"></span></a>
												<ul>
													<!-- <li><a href="#">Relevance</a></li> -->
													<li><a href="#">Price Low-High</a>
													</li>
													<li><a href="#">Price High-Low</a>
													</li>
												</ul>
											</li>
										</ul>
										<a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a>
									</div>
									<div class="pager">
										<div id="limiter">
											<label>View: </label>
											<ul>
												<li>
													<a href="#">12<span class="right-arrow"></span></a>
													<ul>
														<li><a href="#">100</a>
														</li>
														<li><a href="#">500</a>
														</li>
														<li><a href="#">1000</a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article>
					<!--  ///*///======    End article  ========= //*/// -->
				</div>

				<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
					<div class="side-banner"><img src="assets/images/side-banner.jpg" width="100%" alt="banner">
					</div>
					<!-- Start: price filter box -->
					<div class="block block-poll">
						<div class="block-title">Price Filter</div>
						<form id="pollForm" action="#" method="post" onSubmit="return validatePollAnswerIsSelected();">
							<div class="block-content">
								<p class="block-subtitle">What is your favorite Magento feature?</p>
								<ul id="poll-answers">
									<li class="odd">
										<input type="checkbox" name="vote" class="radio poll_vote" id="vote_5" value="5">
										<span class="label">
									<label for="vote_5">Rs.100 - Rs.500 (8)</label>
									</span>

									</li>
									<li class="even">
										<input type="checkbox" name="vote" class="radio poll_vote" id="vote_6" value="6">
										<span class="label">
									<label for="vote_6">Rs.500 - Rs.1000 (19)</label>
									</span>

									</li>
									<li class="odd">
										<input type="checkbox" name="vote" class="radio poll_vote" id="vote_7" value="7">
										<span class="label">
									<label for="vote_7">Rs.1000 - Rs.1500 (8)</label>
									</span>

									</li>
									<li class="last even">
										<input type="checkbox" name="vote" class="radio poll_vote" id="vote_8" value="8">
										<span class="label">
									<label for="vote_8">Rs.1500 - Rs.2000 (3)</label>
									</span>

									</li>
								</ul>
								<div class="actions">
									<button type="submit" title="Vote" class="button"><span>Refine Search</span></button>
								</div>
							</div>
						</form>
					</div>
					<!-- End: price filter box -->
					<div class="block block-cart">
						<div class="block-title ">Recently added item(s)</div>
						<div class="block-content">
							<ul>
								<li class="item">
									<a href="shopping_cart.html" title="Fisher-Price Bubble Mower" class="product-image"><img src="assets/products-images/product10.jpg" alt="Fisher-Price Bubble Mower"></a>
									<div class="product-details">
										<div class="access"> <a href="shopping_cart.html" title="Remove This Item" class="btn-remove1"> <span class="icon"></span> Remove </a> </div>
										<strong>1</strong> x <span class="price"><i class="fas fa-rupee-sign"></i> 19.99</span>
										<p class="product-name"> <a href="shopping_cart.html">Retis lapen casen...</a> </p>
									</div>
								</li>
								<li class="item last">
									<a href="shopping_cart.html" title="Prince Lionheart Jumbo Toy Hammock" class="product-image"><img src="assets/products-images/product1.jpg" alt="Prince Lionheart Jumbo Toy Hammock"></a>
									<div class="product-details">
										<div class="access"> <a href="shopping_cart.html" title="Remove This Item" class="btn-remove1"> <span class="icon"></span> Remove </a> </div>
										<strong>1</strong> x <span class="price"><i class="fas fa-rupee-sign"></i> 8.00</span>
										<p class="product-name"> <a href="shopping_cart.html"> Retis lapen casen...</a> </p>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="block block-layered-nav hide">
						<div class="block-title">Shop By</div>
						<div class="block-content">
							<p class="block-subtitle">Shopping Options</p>
							<dl id="narrow-by-list">
								<dt class="odd">Price</dt>
								<dd class="odd">
									<ol>
										<li> <a href="#"><span class="price"><i class="fas fa-rupee-sign"></i> 0.00</span> - <span class="price"><i class="fas fa-rupee-sign"></i> 99.99</span></a> (6) </li>
										<li> <a href="#"><span class="price"><i class="fas fa-rupee-sign"></i> 100.00</span> and above</a> (6) </li>
									</ol>
								</dd>
								<dt class="even">Manufacturer</dt>
								<dd class="even">
									<ol>
										<li> <a href="#">TheBrand</a> (9) </li>
										<li> <a href="#">Company</a> (4) </li>
										<li> <a href="#">LogoFashion</a> (1) </li>
									</ol>
								</dd>
								<dt class="odd">Color</dt>
								<dd class="odd">
									<ol>
										<li> <a href="#">Green</a> (1) </li>
										<li> <a href="#">White</a> (5) </li>
										<li> <a href="#">Black</a> (5) </li>
										<li> <a href="#">Gray</a> (4) </li>
										<li> <a href="#">Dark Gray</a> (3) </li>
										<li> <a href="#">Blue</a> (1) </li>
									</ol>
								</dd>
								<dt class="last even">Size</dt>
								<dd class="last even">
									<ol>
										<li> <a href="#">S</a> (6) </li>
										<li> <a href="#">M</a> (6) </li>
										<li> <a href="#">L</a> (4) </li>
										<li> <a href="#">XL</a> (4) </li>
									</ol>
								</dd>
							</dl>
						</div>
					</div>
					<div class="block block-compare hide">
						<div class="block-title ">Compare Products (2)</div>
						<div class="block-content">
							<ol id="compare-items">
								<li class="item odd">
									<input type="hidden" value="2173" class="compare-item-id">
									<a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Retis lapen casen...</a>
								</li>
								<li class="item last even">
									<input type="hidden" value="2174" class="compare-item-id">
									<a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Retis lapen casen...</a>
								</li>
							</ol>
							<div class="ajax-checkout">
								<button type="submit" title="Submit" class="button button-compare"><span>Compare</span></button>
								<button type="submit" title="Submit" class="button button-clear"><span>Clear</span></button>
							</div>
						</div>
					</div>
					<div class="custom-slider-wrap hide">
						<div class="custom-slider-inner">
							<div class="home-custom-slider">
								<div>
									<div class="sideoffer-banner">
										<a href="#" title="Side Offer Banner">
									<img class="hidden-xs" src="assets/images/custom-slide1.jpg" alt="Side Offer Banner"></a>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="block block-list block-viewed hide">
						<div class="block-title"> Recently Viewed </div>
						<div class="block-content">
							<ol id="recently-viewed-items">
								<li class="item odd">
									<p class="product-name"><a href="#"> Retis lapen casen...</a>
									</p>
								</li>
								<li class="item even">
									<p class="product-name"><a href="#"> Retis lapen casen...</a>
									</p>
								</li>
								<li class="item last odd">
									<p class="product-name"><a href="#"> Retis lapen casen...</a>
									</p>
								</li>
							</ol>
						</div>
					</div>
					<div>
					</div>
				</aside>
			</div>
		</div>
	</section>
	<!-- Main Container End -->

	<?php include("includes/footer.php"); ?>
	<?php include("includes/script.php"); ?>
</body>
</html>