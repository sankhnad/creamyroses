<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');
	if(!$CID){
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		redirect(base_url().'login?r='.$actual_link);
	}
	$custInfoObj = getCustomerrData(array('id'=>decode($CID)));
	?>
	<title>Checkout | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">
	<?php include("includes/header.php"); ?>
	<section class="main-container col2-left-layout">
		<div class="container">
			<h2 class="text-center">Review Your Order &amp; Complete Checkout<br><br></h2>
			<div class="row">
			  <div class="col">
				<div class="coupon-area"> 
				  <div class="coupon-accordion">
					<h3>Logged in as <strong><?=$custInfoObj[0]->fname?> <?=$custInfoObj[0]->lname?></strong> (<?=$custInfoObj[0]->email?> / <?=$custInfoObj[0]->mobile?>) <span class="coupon pull-right" onClick="gotoPage('<?=base_url()?>logout')">Change</span></h3>
				  </div>
				  <div class="coupon-accordion">
					<h3>Have a coupon? <span class="coupon" id="showcoupon">Click here to enter your code</span></h3>
					<div class="coupon-content" id="checkout-coupon">
					  <div class="coupon-info">
						
						  <p class="checkout-coupon">
							<input type="text" placeholder="Coupon code">
							<button type="button" class="btn button-apply-coupon" name="apply_coupon" value="Apply coupon">Apply coupon</button>
						  </p>
						
					  </div>
					</div>
				  </div>
					<div class="coupon-accordion">
						<h3><span class="coupon" id="deliveryMethod">Click here to hide panel</span></h3>
						<div class="coupon-content" id="deliveryMethodBox">
							<div class="coupon-info">
								This box is for time slot. Which have some comaptibility issue
							</div>
						</div>
					</div>
				</div>
			  </div>
			</div>			
			<div class="checkout-details-wrapper">
			  <div class="row">
				<div class="col-lg-6 col-md-6"> 
				  <div class="billing-details-wrap">
					<form action="#">
					  <h3 class="shoping-checkboxt-title">Billing Details <span data-toggle="modal" data-target="#addressListing" onClick="$('.isShipingAddress').val('0')" class="chooseAdresL">Choose Address</span></h3>
					  <div class="row">
						<div class="col-lg-12">
						  <p class="single-form-row">
							<label>Full Name <span class="required">*</span></label>
							<input type="text" name="name" required>
						  </p>
						</div>								  
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>Email address <span class="required">*</span></label>
							<input type="text" name="Email address">
						  </p>
						</div>
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>Mobile <span class="required">*</span></label>
							<input type="text" name="mobile" required>
						  </p>
						</div>
						<div class="col-lg-12">
						  <p class="single-form-row">
							<label>Street address <span class="required">*</span></label>
							<input type="text" placeholder="House number and street name" name="address_line_1" required>
						  </p>
						</div>
						<div class="col-lg-12">
						  <p class="single-form-row">
							<input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="address_line_2">
						  </p>
						</div>
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>Postcode / ZIP  <span class="required">*</span></label>
							<input type="text" name="pin" required>
						  </p>
						</div>
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>Town / City <span class="required">*</span></label>
							<input type="text" name="city" required>
						  </p>
						</div>
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>State<span class="required">*</span></label>
							<input type="text" name="stateCode" required>
						  </p>
						</div>
						<div class="col-lg-6">
						  <p class="single-form-row">
							<label>Land Mark</label>
							<input type="text" name="landmark">
						  </p>
						</div>
						<div class="col-lg-12">
						  <p class="single-form-row">
							<label>Remarks</label>
							<input type="text" name="remarks">
						  </p>
						</div>
						
						<div class="col-lg-12">
						  <div class="checkout-box-wrap">
							<label> <input checked type="checkbox"> Save to your addressbook</label>
						  </div>
						</div>
						<div class="col-lg-12">
						  <div class="checkout-box-wrap">
							<label id="chekout-box-2"> <input type="checkbox"> Ship to a different address?</label>
							<div class="ship-box-info">
								<h3 class="shoping-checkboxt-title">Shiping Address <span onClick="$('.isShipingAddress').val('1')" data-toggle="modal" data-target="#addressListing" class="chooseAdresL">Choose Address</span></h3>
							  <div class="row">
								<div class="col-lg-12">
								  <p class="single-form-row">
									<label>Full Name <span class="required">*</span></label>
									<input type="text" name="name" required>
								  </p>
								</div>								  
								<div class="col-lg-6">
								  <p class="single-form-row">
									<label>Email address <span class="required">*</span></label>
									<input type="text" name="Email address">
								  </p>
								</div>
								<div class="col-lg-6">
								  <p class="single-form-row">
									<label>Mobile <span class="required">*</span></label>
									<input type="text" name="mobile" required>
								  </p>
								</div>
								<div class="col-lg-12">
								  <p class="single-form-row">
									<label>Street address <span class="required">*</span></label>
									<input type="text" placeholder="House number and street name" name="address_line_1" required>
								  </p>
								</div>
								<div class="col-lg-12">
								  <p class="single-form-row">
									<input type="text" placeholder="Apartment, suite, unit etc. (optional)" name="address_line_2">
								  </p>
								</div>
								<div class="col-lg-6">
								  <p class="single-form-row">
									<label>Postcode / ZIP  <span class="required">*</span></label>
									<input type="text" name="pin" required>
								  </p>
								</div>
								<div class="col-lg-6">
								  <p class="single-form-row">
									<label>Town / City <span class="required">*</span></label>
									<input type="text" name="city" required>
								  </p>
								</div>
								<div class="col-lg-12">
								  <p class="single-form-row">
									<label>State<span class="required">*</span></label>
									<input type="text" name="stateCode" required>
								  </p>
								</div>
								<div class="col-lg-12">
								  <p class="single-form-row">
									<label>Land Mark</label>
									<input type="text" name="landmark">
								  </p>
								</div>
								<div class="col-lg-12">
								  <p class="single-form-row">
									<label>Remarks</label>
									<input type="text" name="remarks">
								  </p>
								</div>
							  </div>
							  <div class="seprator"></div>
							</div>
						  </div>
						</div>
						<div class="col-lg-12">
						  <p class="single-form-row m-0">
							<label>Order notes</label>
							<textarea placeholder="Notes about your order, e.g. special notes for delivery." class="checkout-mess" rows="2" cols="5"></textarea>
						  </p>
						</div>
					  </div>
					</form>
				  </div>
				  <!-- billing-details-wrap end --> 
				</div>
				<div class="col-lg-6 col-md-6"> 
				  <!-- your-order-wrapper start -->
				  <div class="your-order-wrapper">
					<h3 class="shoping-checkboxt-title">Your Order</h3>
					<!-- your-order-wrap start-->
					<div class="your-order-wrap"> 
					  <!-- your-order-table start -->
					  <div class="your-order-table table-responsive">
						<table>
						  <thead>
							<tr>
							  <th class="product-name"><strong>Product</strong></th>
							  <th class="product-total  text-right"><strong>Total</strong></th>
							</tr>
						  </thead>
						  <tbody>
							  <?php  
								$getCartListingObj = getCartListingObj();
								$totalOrderQty = $afterDiscount_price = $beforeDiscount_price = $totalPriceAfterDiscount = 0;
								if($getCartListingObj){
									
									foreach($getCartListingObj as $getCartListing){
										$productPriceObj = json_decode(json_encode($getCartListing), true);
										
										$productPrice = getDiscountFormat($productPriceObj);
										
										$beforeDiscount_price += $productPrice['oreginal_price'] ? ($productPrice['oreginal_price'] * $getCartListing->order_quantity) : 0;
										
										$afterDiscount_price += $productPrice['final_price'] * $getCartListing->order_quantity;
										
										$totalOrderQty += $getCartListing->order_quantity;
							  	?>
									<tr class="cart_item">
									  <td class="product-name" width="70%"> <?=$getCartListing->name?> &nbsp; 
										  <strong>(<?=$getCartListing->order_quantity?> &nbsp; x &nbsp; <i class="fas fa-rupee-sign"></i> <?=$productPrice['oreginal_price']?>)</strong>
										</td>
									  <td class="product-total text-right"  width="30%"><span class="amount"><i class="fas fa-rupee-sign"></i> <?=number_format(($productPrice['oreginal_price'] * $getCartListing->order_quantity),2)?></span></td>
									</tr>
							  <?php } } ?>
							  <tr>
								  <td class="btCor"></td>
								  <td class="btCor"></td>
							  </tr>
						  </tbody>
						  <tfoot>
							<tr class="cart-subtotal">
							  <th>Cart Subtotal</th>
							  <td class="text-right"><span class="amount"><strong><i class="fas fa-rupee-sign"></i> <?=number_format($beforeDiscount_price,2)?></strong></span></td>
							</tr>
							<tr class="shipping">
							  <th>Discount</th>
							  <td class="text-right"><strong><span class="amount"><i class="fas fa-rupee-sign"></i> <?=number_format(($beforeDiscount_price - $afterDiscount_price),2)?></span></strong></td>
							</tr>
							<tr class="order-total">
							  <th>Order Total</th>
							  <td class="text-right"><strong><span class="amount"><i class="fas fa-rupee-sign"></i> <?=number_format($afterDiscount_price,2)?></span></strong></td>
							</tr>
						  </tfoot>
						</table>
					  </div>
						
					  <div class="payment-method">
						<ul class="payment-accordion">
							<li><label><input type="radio" value="1" name="paymentOption"> Credit / Debit / ATM Card</label></li>
							<li><label><input type="radio" value="2" name="paymentOption"> PayTM Wallet &nbsp; <img src="<?=$iURL_storeAssts?>images/paytm.png"></label> </li>
							<li><label><input type="radio" value="3" name="paymentOption"> Net Banking</label></li>
							<li><label><input checked type="radio" value="4" name="paymentOption"> Cash on Delivery</label></li>
						</ul>
						<div class="order-button-payment">
						  <input type="submit" value="Place order" />
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	</section>
	
	<div id="addressListing" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Select Address</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="isShipingAddress" />
						   
					<?php foreach($addressList as $addressData){?>				
						<div class="col-sm-4">
							<div class="boxAddressDis <?=$addressData->isDefault == '1' ? 'defaultAdsULI':'' ?>">
								<div class="defultBxRa">Default Address</div>
								<ul class="addressULLI">
									<?php
									$aidEncripted = encode($addressData->aid);
									if($addressData->type == '0'){
										$aTyp = 'Home Address';
										$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
									}else if($addressData->type == '1'){
										$aTyp = 'Office Address';
										$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
										echo '<li>' . $addressData->remarks . ''.$aTyp.'</li>';
										$aTyp = '';
									}else if($addressData->type == '2'){
										$aTyp = 'Others';
										$aTyp = '<span class="adsTypL">('.$aTyp.')<span>';
									}
									if ( $addressData->name ) {
										echo '<li>' . $addressData->name . ''.$aTyp.'</li>';
									}
									if ( $addressData->address_line_1 ) {
										echo '<li>' . $addressData->address_line_1 . ',</li>';
									}
									if ( $addressData->address_line_2 ) {
										echo '<li>' . $addressData->address_line_2 . ',</li>';
									}
									if ( $addressData->landmark ) {
										echo '<li>' . $addressData->landmark . ',</li>';
									}
									if ( $addressData->city ) {
										echo '<li>' . $addressData->city . ', ' . $addressData->cityName . ',</li>';
									}
									if ( $addressData->pin ) {
										echo '<li>India - ' . $addressData->pin . '</li>';
									} else {
										echo '<li>India</li>';
									}
									if ( $addressData->mobile ) {
										echo '<li>Phone number: ' . $addressData->mobile . '</li>';
									}

									if ($addressData->type == '2'){
										echo '<li>Remarks: ' . $addressData->remarks . '</li>';
									}
									?>
								</ul>
								<ul class="actionAdresULLI">
									<li><a href="javascript:;">Select Address</a></li>
									<li><a target="_blank" href="<?=base_url();?>profile/getAddress/<?=$aidEncripted?>">Edit</a></li>
									<li><a href="javascript:void(0)" onClick="deleteAddress(this, '<?=$aidEncripted?>')">Delete</a></li>
								</ul>
							</div>
						</div>
					<?php } ?>
					<div class="clearfix"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	

	<?php include("includes/footer.php"); ?>
	<?php include("includes/script.php"); ?>
	<script>
/*--
    showcoupon toggle function
--------------------------*/
$( '#showcoupon' ).on('click', function() {
    $('#checkout-coupon' ).slideToggle(500);
});
$( '#deliveryMethod' ).on('click', function() {
    $('#deliveryMethodBox' ).slideToggle(500);
});
$("#chekout-box-2").on("change",function(){
    $(".ship-box-info").slideToggle("100");
});

	</script>
	<style>
		#deliveryMethodBox {
		  display: block;
		}
		.btCor {
			  background-color: #d8d8d8 !important;
			  padding: 2px !important;
			}
		.chooseAdresL{
			color: #e97730;
			cursor: pointer;
			transition: all 0.4s ease 0s;
			font-size: 14px;
    		font-weight: 400;
			float: right;
			cursor: pointer;
			padding-top: 9px;
		}
		.chooseAdresL:hover{
			text-decoration: underline;
		}
.coupon-accordion h3 {
  background: #f6f6f6;
  border-top: 3px solid #e97730;
  color: #515151;
  font-size: 14px;
  font-weight: 400;
  margin: 0 0 15px;
  padding: 20px;
  position: relative;
}
.coupon-accordion h3 .coupon {
  color: #e97730;
  cursor: pointer;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}
.coupon-accordion h3 .coupon:hover {
  color: #000000;
}

.coupon-content {
  border: 1px solid #dddddd;
  margin-bottom: 30px;
  padding: 20px;
  display: none;
}

.coupon-info p.form-row-first {
  float: left;
  width: 48%;
}
@media only screen and (max-width: 479px) {
  .coupon-info p.form-row-first {
    width: 100%;
  }
}
.coupon-info p.form-row-last {
  float: right;
  width: 48%;
}
@media only screen and (max-width: 479px) {
  .coupon-info p.form-row-last {
    width: 100%;
  }
}
.coupon-info .remember {
  margin-left: 10px;
}
.coupon-info .remember span {
  margin-left: 5px;
}

.coupon-input label {
  display: block;
  font-size: 14px;
}
.coupon-input input {
  border: 1px solid #999999;
  color: #000000;
  padding: 5px 10px;
  width: 100%;
  font-size: 14px;
}
.coupon-input span.required {
  color: red;
}

.checkout-coupon input {
  border: 1px solid #999999;
  color: #555;
  padding: 5px 10px;
  width: auto;
}
.checkout-coupon input:focus {
  outline: none;
}
.checkout-coupon .button-apply-coupon {
  margin: -5px 0 0 10px;
  padding: 7.2px 11px;
}
@media only screen and (max-width: 479px) {
  .checkout-coupon .button-apply-coupon {
    margin: 10px 0 0 0px;
  }
}

.shoping-checkboxt-title {
  border-bottom: 1px solid #dddddd;
  font-size: 24px;
  font-weight: 500;
  margin-bottom: 30px;
  padding-bottom: 15px;
}

.single-form-row {
  margin-bottom: 20px !important;
}
.single-form-row label {
  font-size: 14px;
  margin-bottom: 2px;
}
.single-form-row label span.required {
  color: red;
}
.single-form-row input {
  border: 1px solid #999999;
  color: #666;
  font-size: 14px;
  padding: 5px 12px;
  width: 100%;
}
.single-form-row input::focus {
  outline: none;
}
.single-form-row textarea {
  border: 1px solid #999999;
  color: #555555;
  padding: 12px;
  width: 100%;
  font-size: 14px;
}
.single-form-row.m-0 {
  margin: 0 !important;
}

.checkout-box-wrap p {
  font-size: 14px;
}
.checkout-box-wrap .ship-box-info {
  display: none;
}

.account-create {
  display: none;
}
.account-create .creat-pass > span {
  color: red;
}

.nice-select select {
  height: 35px;
  width: 100%;
  font-size: 14px;
  padding: 0 10px;
  color: #555;
  border: 1px solid #999;
}

@media only screen and (max-width: 767px) {
  .your-order-wrapper {
    margin-top: 70px;
  }
}
@media only screen and (max-width: 479px) {
  .your-order-wrapper {
    margin-top: 60px;
  }
}

.your-order-wrap {
  background: #f6f6f6;
}

.your-order-table {
  padding: 20px 30px;
}
.your-order-table table {
  width: 100%;
}
.your-order-table table th, .your-order-table table td {
  border-bottom: 1px solid #d8d8d8;
  border-right: medium none;
  font-size: 14px;
  padding: 15px 0;
}
.your-order-table table th {
  border-top: medium none;
  font-weight: normal;
  text-transform: uppercase;
  vertical-align: middle;
  white-space: nowrap;
  width: 250px;
}
.your-order-table table .shipping > th {
  vertical-align: top;
}

.payment-method {
  
}
.payment-accordion {
  list-style: outside none none;
  margin: 0;
  padding: 0;
}
.payment-accordion li label{
	display: block;
}
.payment-accordion li label{
	display: block;
	padding: 10px 30px;
	background-color: #f2dede;
    border-bottom: 1px solid #f6f6f6;
	margin: 0;
	cursor: pointer;
}
.payment-accordion li label:hover{
	border-bottom: 1px solid #d8d8d8;
	background-color: #FCF8E3;
}
.payment-accordion h3 a {
  color: #333333;
  font-size: 15px;
  font-weight: 500;
  padding-left: 31px;
  position: relative;
  text-decoration: none;
  text-transform: capitalize;
}
.payment-accordion h3 a::before, .payment-accordion h3 a::after {
  content: "\f216";
  display: inline-block;
  font-family: ionicons;
  font-size: 19px;
  left: 0;
  position: absolute;
  top: 0px;
}
.payment-accordion h3 a img {
  height: 60px;
  display: block;
}
.payment-accordion h3.open a::after {
  content: "\f207";
}
.payment-accordion p {
  font-size: 14px;
  padding-left: 20px;
}

.order-button-payment {
 	background-color: #f6f6f6;
    padding-top: 15px;
}
.order-button-payment input {
  background: #e97730;
  border: medium none;
  color: #ffffff;
  font-size: 14px;
  font-weight: 600;
  padding: 12px;
  text-transform: uppercase;
  width: 100%;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}
.order-button-payment input:hover {
  background: #000000;
  color: #ffffff;
}
	</style>
</body>
</html>