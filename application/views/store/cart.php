<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicons Icon -->
<link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<title>Cart || Cakes</title>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php include("include/style.php"); ?>

</head>
<body class="shopping-cart-page">
<div id="page">


  <?php include("include/header.php"); ?>

  <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <article class="col-main">
            <div class="cart">
              <div class="page-title">
                <h2>Shopping Cart</h2>
              </div>
              <div class="table-responsive">
                <form method="post" action="#updatePost/">
                  <input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
                  <fieldset>
                    <table class="data-table cart-table" id="shopping-cart-table">
                      <colgroup>
                      <col width="1">
                      <col>
                      <col width="1">
                      <col width="1">
                      <col width="1">
                      <col width="1">
                      <col width="1">
                      </colgroup>
                      <thead>
                        <tr class="first last">
                          <th rowspan="1">&nbsp;</th>
                          <th rowspan="1"><span class="nobr">Product Name</span></th>
                          <th rowspan="1"></th>
                          <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
                          <th class="a-center" rowspan="1">Qty</th>
                          <th colspan="1" class="a-center">Subtotal</th>
                          <th class="a-center" rowspan="1">&nbsp;</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr class="first last">
                          <td class="a-right last" colspan="50"><button onclick="setLocation('/shop.php')" class="button btn-continue" title="Continue Shopping" type="button"><span>Continue Shopping</span></button>
                            <button class="button btn-update" title="Update Cart" value="update_qty" name="update_cart_action" type="submit"><span>Update Cart</span></button>
                            <button id="empty_cart_button" class="button btn-empty" title="Clear Cart" value="empty_cart" name="update_cart_action" type="submit"><span>Clear Cart</span></button></td>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr class="first odd">
                          <td class="image"><a class="product-image" title="Sample Product" href="#/women-s-crepe-printed-black/"><img width="75" alt="Sample Product" src="assets/products-images/product1.jpg"></a></td>
                          <td><h2 class="product-name"> <a href="#/women-s-crepe-printed-black/">Sample Product</a> </h2></td>
                          <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15945/"></a></td>
                          <td class="a-right"><span class="cart-price"> <span class="price"><i class="fa fa-rupee"></i> 70.00</span> </span></td>

                          <td class="a-center movewishlist">
                              <div class="col-lg-2">
    <div class="input-group">
        <span class="input-group-btn">
        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
        <span class="glyphicon glyphicon-minus"></span>
        </button>
        </span>
        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
        <span class="input-group-btn">
        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
        <span class="glyphicon glyphicon-plus"></span>
        </button>
        </span>
    </div>
</div>
                          </td>

                          <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><i class="fa fa-rupee"></i> 70.00</span> </span></td>
                          <td class="a-center last"><a class="button remove-item" title="Remove item" href="#"><span><span>Remove item</span></span></a></td>
                        </tr>

                        <tr class="last even">
                          <td class="image"><a class="product-image" title="Sample Product" href="#women-s-u-tank-top/"><img width="75" alt="Sample Product" src="assets/products-images/product2.jpg"></a></td>
                          <td><h2 class="product-name"> <a href="#women-s-u-tank-top/">Sample Product</a> </h2></td>
                          <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15946/"></a></td>
                          <td class="a-right"><span class="cart-price"> <span class="price"><i class="fa fa-rupee"></i> 7.38</span> </span></td>
                          <td class="a-center movewishlist"><input maxlength="12" class="input-text qty" title="Qty" size="4" value="1" name="cart[15946][qty]"></td>
                          <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><i class="fa fa-rupee"></i> 7.38</span> </span></td>
                          <td class="a-center last"><a class="button remove-item" title="Remove item" href="#"><span><span>Remove item</span></span></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </fieldset>
                </form>
              </div>

              <!-- BEGIN CART COLLATERALS -->
              <div class="cart-collaterals row">

                
                <div class="col-sm-4">
                  <div class="discount">
                    <h3>Discount Codes</h3>
                    <form method="post" action="#couponPost/" id="discount-coupon-form">
                      <label for="coupon_code">Enter your coupon code if you have one.</label>
                      <input type="hidden" value="0" id="remove-coupone" name="remove">
                      <input type="text" value="" name="coupon_code" id="coupon_code" class="input-text fullwidth">
                      <button value="Apply Coupon" onclick="discountForm.submit(false)" class="button coupon " title="Apply Coupon" type="button"><span>Apply Coupon</span></button>
                    </form>
                  </div>
                </div>

                <div class="col-sm-4"></div>

                <div class="totals col-sm-4">
                  <h3>Shopping Cart Total</h3>
                  <div class="inner">
                    <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                      <colgroup>
                      <col>
                      <col width="1">
                      </colgroup>
                      <tfoot>
                        <tr>
                          <td colspan="1" class="a-left" style=""><strong>Grand Total</strong></td>
                          <td class="a-right" style=""><strong><span class="price"><i class="fa fa-rupee"></i> 77.38</span></strong></td>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr>
                          <td colspan="1" class="a-left" style=""> Subtotal </td>
                          <td class="a-right" style=""><span class="price"><i class="fa fa-rupee"></i> 77.38</span></td>
                        </tr>
                      </tbody>
                    </table>
                    <ul class="checkout">
                      <li>
                        <button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed to Checkout</span></button>
                      </li>
                      <br>
                    </ul>
                  </div>
                  <!--inner--> 
                </div>

              </div>
              
              <!--cart-collaterals-->
              <div class="crosssel hide">
                <div class="new_title">
                  <h2>you may be interested</h2>
                </div>
                <div class="category-products">
                  <ul class="products-grid">
                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                      <div class="item-inner">
                        <div class="item-img">
                          <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="assets/products-images/product10.jpg"> </a>
                            <div class="box-hover">
                              <ul class="add-to-links">
                                <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                <li><a class="link-compare" href="compare.html"></a> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                            <div class="item-content">
                              <div class="rating">
                                <div class="ratings">
                                  <div class="rating-box">
                                    <div style="width:80%" class="rating"></div>
                                  </div>
                                  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                              </div>
                              <div class="item-price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 155.00</span> </span> </div>
                              </div>
                              <div class="action">
                                <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>

                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                      <div class="item-inner">
                        <div class="item-img">
                          <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="assets/products-images/product1.jpg"> </a>
                            <div class="box-hover">
                              <ul class="add-to-links">
                                <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                <li><a class="link-compare" href="compare.html"></a> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                            <div class="item-content">
                              <div class="rating">
                                <div class="ratings">
                                  <div class="rating-box">
                                    <div style="width:80%" class="rating"></div>
                                  </div>
                                  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                              </div>
                              <div class="item-price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 225.00</span> </span> </div>
                              </div>
                              <div class="action">
                                <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                      <div class="item-inner">
                        <div class="item-img">
                          <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="assets/products-images/product2.jpg"> </a>
                            <div class="box-hover">
                              <ul class="add-to-links">
                                <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                <li><a class="link-compare" href="compare.html"></a> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                            <div class="item-content">
                              <div class="rating">
                                <div class="ratings">
                                  <div class="rating-box">
                                    <div style="width:80%" class="rating"></div>
                                  </div>
                                  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                              </div>
                              <div class="item-price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><i class="fa fa-rupee"></i> 99.00</span> </span> </div>
                              </div>
                              <div class="action">
                                <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                      <div class="item-inner">
                        <div class="item-img">
                          <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="assets/products-images/product3.jpg"> </a>
                            <div class="new-label new-top-left">new</div>
                            <div class="box-hover">
                              <ul class="add-to-links">
                                <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                <li><a class="link-compare" href="compare.html"></a> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                            <div class="item-content">
                              <div class="rating">
                                <div class="ratings">
                                  <div class="rating-box">
                                    <div style="width:80%" class="rating"></div>
                                  </div>
                                  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                </div>
                              </div>
                              <div class="item-price">
                                <div class="price-box">
                                  <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> <i class="fa fa-rupee"></i> 156.00 </span> </p>
                                  <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> <i class="fa fa-rupee"></i> 167.00 </span> </p>
                                </div>
                              </div>
                              <div class="action">
                                <button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </article>
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>
        
      </div>
    </div>
  </section>
  <!-- Main Container End --> 



<?php include("include/footer.php"); ?>

<?php include("include/script.php"); ?>
<!-- <script type="text/javascript">
   $(window).load(function(){        
   $('#addonProduct').modal('show');
    }); 
</script> -->
</body>
</html>
