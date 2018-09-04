<?php
	$priceObj = getProductPrice($productDataObj[0]->product_id);
	//echo '<pre>';print_r($productDataObj);die;
	if(count($priceObj) > 0){
		$price = $priceObj[0]->product_price;
		$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);
		
		$weightList='';
		$selCount = 1;
		foreach($priceObj as $priceData){
			if($selCount == 1){
				$weightList.='<option selected="selected" value="'.encode($priceData->id).'">'.$priceData->quantity.'&nbsp;'.$priceData->quantity_type.'</option>';
			}else{
				$weightList.='<option value="'.encode($priceData->id).'">'.$priceData->quantity.'&nbsp;'.$priceData->quantity_type.'</option>';
			}
			$selCount++;
		}
		//echo $prdctSizeList;die;
	
	}else{
		$price = 0;
		$discount_price = 0;
	}
	//echo '<pre>';print_r($productDataObj[0]->description);die;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<?php include('includes/commonfile.php');?>
	<title><?=$categoryObj[0]->name?> | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>
    <body class="shopping-cart-page">
        <div id="page">
        <?php include("includes/header.php"); ?>

        <!-- Main Container -->
        <section class="main-container col1-layout">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

                        <!-- Breadcrumbs -->
                        <div class="breadcrumbs" style="float: left;">
                            <ul>
                                <li class="home"> <a href="./" title="Go to Home Page">Home</a> <span>/</span> </li>
                                <li class="category1601"> <strong><?=$productDataObj[0]->name?> </strong> </li>
                            </ul>
                        </div>
                        <!-- Breadcrumbs End --> 

                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <article class="col-main">
                            <div class="product-view">
                                <div class="product-essential">
                                    <form action="#" method="post" id="product_addtocart_form">
                                        <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">

                                        <div class="product-img-box col-lg-4 col-sm-6 col-xs-12">
                                            <div class="new-label new-top-left"> New </div>
                                            <div class="product-image">
                                                <div class="product-full"> <img id="product-zoom" src="<?=$iURL_product?><?=$productDataObj[0]->image?>" data-zoom-image="assets/products-images/product1.jpg" alt="product-image"/> </div>
												<?php if(count($imageObj) > 0){ ?>
															<div class="more-views">
																<div class="slider-items-products">
																	<div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
																		<div class="slider-items slider-width-col4 block-content">
																		
																			<?php foreach($imageObj as $imgData){ ?>
																							<div class="more-views-items"> 
																								<a href="#" data-image="<?=$iURL_product?><?=$imgData->image?>" data-zoom-image="<?=$iURL_product?><?=$imgData->image?>"> <img id="product-zoom"  src="<?=$iURL_product?><?=$imgData->image?>" alt="product-image"/> </a>
																							</div>
																			<?php } ?>																		
																			
																		</div>
																	</div>
																</div>
															</div>
												<?php } ?>
                                            </div>
                                            <!-- end: more-images --> 
                                        </div>

                                        <div class="product-shop col-lg-8 col-sm-6 col-xs-12">
                                            <div class="product-next-prev"> <a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a> </div>
                                            <div class="product-name">
                                                <h1><?=$productDataObj[0]->name?></h1>
                                            </div>
                                            <div class="ratings">
                                                <div class="rating-box">
                                                    <div style="width:60%" class="rating"></div>
                                                </div>
                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                                            </div>
                                            <div class="price-block">
                                                <div class="price-box">
															<?php if($discount_price > 0){ ?>
																<p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> <i class="fa fa-inr" aria-hidden="true"></i><span id="discount_price"> <?=number_format($discount_price,2)?> </span></span> </p>
																<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-inr" aria-hidden="true"></i><span id="normalPrice"> <?=number_format($price,2)?> </span></span> </p>
																<p class="availability in-stock in-off pull-right"><span>(<i class="fa fa-inr" aria-hidden="true"></i>
																<?=$priceObj[0]->discount?> Off)</span></p>
															<?php
															 }else{ ?>
															<p class="special-price"><span class="price-label">Special Price</span> <span class="price"><i class="fa fa-rupee"></i> <?=number_format($price,2)?> </span> </p>
															<?php } ?>
<!--                                                    <p class="availability in-stock pull-right"><span>In Stock</span></p>
-->                                                    
                                                </div>
                                            </div>

                                            <div class="check-pincode">
                                                <div class="pull-left">
                                                    <div class="row">
                                                        <label class="col-md-1">Delivery</label>
                                                        <div class='col-sm-4'>
                                                            <div class="form-group">
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type='text' class="form-control" placeholder="Enter Pincode" />
                                                                    <span class="input-group-addon btn-check">
                                                                        Change
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(function () {
                                                                $('#datetimepicker1').datetimepicker();
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="short-description">
                                                <h2>Quick Overview</h2>
                                                <p><?=substr($productDataObj[0]->description,0,160)?> </p>
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
															<p>Make it eggless <input type="checkbox" checked="checked" name="isEggless"  /></p>
															<!--<small>Rs. 100</small>-->
														<?php }else{ ?>
															<p>Make it eggless <input type="checkbox" name="isEggless"/></p>
														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="date-time-selector">
                                                <div class="weight-selector">
                                                    <div class="eggless-selector">
                                                        
                                                    </div>
                                                    <div class="pull-left">
                                                        <div class="row">
                                                            <div class='col-sm-8'>
                                                                <div class="form-group">
                                                                    <h5><input type="checkbox" name="" /> Midnight Delivery (For Delivery between 10 PM - 12:30 AM)</h5>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $(function () {
                                                                    $('#datetimepicker1').datetimepicker();
                                                                });
                                                            </script>
                                                        </div>

                                                        <div class="row">
                                                            <div class='col-sm-3'>
                                                                <div class="form-group">
                                                                    <div class='input-group date' id='datetimepicker1'>
                                                                        <input type='text' class="form-control" placeholder="Select Date" />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $(function () {
                                                                    $('#datetimepicker1').datetimepicker();
                                                                });
                                                            </script>
                                                        </div>

                                                        <div class="row">
                                                            <div class='col-sm-3'>
                                                                <div class="form-group">
                                                                    <div class='input-group date' id='datetimepicker3'>
                                                                        <input type='text' class="form-control" placeholder="Select Time" />
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $(function () {
                                                                    $('#datetimepicker3').datetimepicker({
                                                                        format: 'LT'
                                                                    });
                                                                });
                                                            </script>
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
                                                    <li> <a class="link-wishlist" href="wishlist.html"><span>Add to Wishlist</span></a></li>
                                                    <!--<li><span class="separator">|</span> <a class="link-compare" href="compare.html"><span>Add to Compare</span></a></li>-->
                                                </ul>
                                                <!--<p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>-->
                                            </div>
                                        </div>

                                        <!-- <div class="product-shop col-lg-4 col-sm-4 col-xs-12">
                                            <div class="xpress-product-sec">
                                                <form action="post">
                                                <div class="price-box-in text-center">
                                                <p class="special-price"> 
                                                <span class="price-label">Special Price</span> 
                                                <span id="product-price-48" class="price"> <i class="fa fa-inr" aria-hidden="true"></i> 309.99 </span> 
                                                </p>
                                                </div>
                                                <div class="main-content-form">
                                                <div class="form-group">                           
                                                <input type="text" name=""  class="form-control" placeholder="* Area & City (or) PIN" />
                                                <span id="selectedlocality" class=""></span>
                                                </div>
                                                <div class="form-group">                           
                                                <input type="date" name=""  class="form-control" placeholder="When?" />
                                                </div>
                                                </div>
                                                <div class="add-to-box">
                                                <button onclick="productAddToCartForm.submit(this)" class="button btn-cart btn-block" title="Add to Cart" type="button">Add to Cart</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                                <!-- Start: Details Tab  -->
                                <div class="product-collateral">
                                    <div class="add_info">
                                        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                                            <li class="active"> <a href="#product_tabs_description" data-toggle="tab">Description </a> </li>
                                            <li> <a href="#product_tabs_custom" data-toggle="tab">Delivery Information</a> </li>
                                            <li> <a href="#product_tabs_custom1" data-toggle="tab">Refund Instructions</a> </li>
                                        </ul>
                                        <div id="productTabContent" class="tab-content">
                                            <div class="tab-pane fade in active" id="product_tabs_description">
                                                <div class="std">
                                                    <?=$productDataObj[0]->description?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="product_tabs_custom">
                                                <div class="product-tabs-content-inner clearfix">
                                                    <?=$productDataObj[0]->delivery_description?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="product_tabs_custom1">
                                                <div class="product-tabs-content-inner clearfix">
                                                   <?=$productDataObj[0]->refund_description ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End: Details Tab  -->
                                <!-- Start: Related Product Slider -->
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
                                                                    <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product10.jpg"> </a>
                                                                    <div class="new-label new-top-left">new</div>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 245.00</span> </span> </div>
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
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product11.jpg"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 155.00</span> </span> </div>
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
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product12.jpg"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 185.00</span> </span> </div>
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
                                                                    <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product13.jpg"> </a>
                                                                    <div class="new-label new-top-left">new</div>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 235.00</span> </span> </div>
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
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product14.jpg"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 225.00</span> </span> </div>
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
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product16.jpg"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 335.00</span> </span> </div>
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
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="#"> <img alt="Retis lapen casen" src="assets/products-images/product22.jpg"> </a>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="#"> Retis lapen casen </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 125.00</span> </span> </div>
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
                                <!-- End: Related Product Slider --> 
                            </div>
                        </article>
                        <!--  ///*///======    End article  ========= //*/// --> 
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Container End --> 


        <?php include("includes/footer.php"); ?>
        <?php include("includes/script.php"); ?>
        <script type="text/javascript" src="assets/js/cloud-zoom.js"></script>
    </body>
</html>