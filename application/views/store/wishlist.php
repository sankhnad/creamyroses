<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
		<title>My Wishlist | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">

		<?php include("includes/header.php"); ?>

		<!-- Main Container -->
		<section class="main-container col2-left-layout">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-9 col-sm-push-3">
						<article class="col-main">
							<div class="my-account">
            					<div class="page-title">
									<h2>My Dashboard</h2>
								</div>
            <div class="my-wishlist">
			<div class="page-title">
											<h2>Wishlist Information</h2>
										</div>
              <div class="table-responsive">
                <form method="post" action="#/wishlist/index/update/wishlist_id/1/" id="wishlist-view-form">
                  <fieldset>
                    <input type="hidden" value="ROBdJO5tIbODPZHZ" name="form_key">
                    <table id="wishlist-table" class="clean-table linearize-table data-table">
                      <thead>
                        <tr class="first last">
                          <th class="customer-wishlist-item-image">Image</th>
                          <th class="customer-wishlist-item-info">Description</th>
<!--                          <th class="customer-wishlist-item-quantity">Quantity</th>
-->
                          <th class="customer-wishlist-item-price">Price</th>
                          <th class="customer-wishlist-item-cart"></th>
                          <th class="customer-wishlist-item-remove"></th>
                        </tr>
                      </thead>
                      <tbody>
					  	<?php 
						if(count($productListObj) > 0){
							foreach($productListObj as $wishData){
										$priceObj = getProductPrice($wishData->p_product_id);
										if(count($priceObj) > 0){
											$price = $priceObj[0]->product_price;
											$discount_price = getDiscount($priceObj[0]->discount_type, $priceObj[0]->product_price, $priceObj[0]->discount);

										}else{
											$price = 0;
											$discount_price = 0;
										}
						 ?>

                        <tr id="item_31" class="first odd">
						
                          <td class="wishlist-cell0 customer-wishlist-item-image"><a title="<?=$wishData->p_name?>" href="<?=base_url();?><?=$wishData->p_url_slug?>" class="product-image"> <img width="150" alt="Softwear Women's Designer" src="<?=$iURL_product?><?=$wishData->p_image?>"> </a></td>
						  
                          <td class="wishlist-cell1 customer-wishlist-item-info"><h3 class="product-name"><a title="<?=$wishData->p_name?>" href="<?=base_url();?><?=$wishData->p_url_slug?>"><?=$wishData->p_name?></a></h3>
                            <div class="description std">
                              <div class="inner"><?=$wishData->p_desc?></div>
                            </div>
                            </td>
                          <!--<td data-rwd-label="Quantity" class="wishlist-cell2 customer-wishlist-item-quantity"><div class="cart-cell">
                              <div class="add-to-cart-alt">
                                <input type="text" value="1" name="qty[31]" class="input-text qty validate-not-negative-number" pattern="\d*">
                              </div>
                            </div></td>-->
                          <td data-rwd-label="Price" class="wishlist-cell3 customer-wishlist-item-price"><div class="cart-cell">
                              <div class="price-box"> <span id="product-price-39" class="regular-price"> <span class="price"><i class="fas fa-rupee-sign"></i>&nbsp;<?=number_format($price,2)?></span> </span> </div>
                            </div></td>
                          <td class="wishlist-cell4 customer-wishlist-item-cart"><div class="cart-cell">
                              <button class="button btn-cart" onClick="addWItemToCart(31);" title="Add to Cart" type="button"><span><span>Add to Cart</span></span></button>
                            </div>
                            <!--<p><a href="#/" class="">Edit</a></p>--></td>
                          <td class="wishlist-cell5 customer-wishlist-item-remove last"><a class="remove-item" title="Clear Cart"  href="#" onClick="addToWishList(this,'<?=$wishData->p_product_id?>','delete')"><span><span></span></span></a></td>
                        </tr>
						<?php } ?>
							                    <div class="buttons-set buttons-set2">
												  <button class="button btn-share" title="Share Wishlist" name="save_and_share" type="submit"><span>Share Wishlist</span></button>
												  <button class="button btn-add" onClick="addAllWItemsToCart()" title="Add All to Cart" type="button"><span>Add All to Cart</span></button>
												  <button class="button btn-update" title="Update Wishlist" name="do" type="submit"><span>Update Wishlist</span></button>
												</div>

							
						<?php }else{ ?>
						
						<tr>
							<td colspan="5">Wishlist is empty !</td>
						</tr>
						<?php }	?>

                      </tbody>
                    </table>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="buttons-set">
              <p class="back-link"><a href="#/customer/account/"><small>« </small>Back</a></p>
            </div>
          </div>
						</article>
						<!--  ///*///======    End article  ========= //*/// -->
					</div>
					<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
						<!--  <div class="side-banner"><img src="assets/images/side-banner.jpg" alt="banner"></div>-->
						<div class="block block-account">
							<div class="block-title">My Account</div>
							<div class="block-content">
								<?php include("includes/left_tab.php"); ?>
							</div>
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