<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title>Cart | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">
	<?php include("includes/header.php"); ?>
	<section class="main-container col1-layout">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<article class="col-main">
						<div class="cart">
							<div class="page-title">
								<h2>Shopping Cart<br><br></h2>
							</div>
							<div class="table-responsive">
								<form method="post">
									<fieldset>
										<table class="data-table cart-table">
											<thead>
												<tr>
													<th width="5%">&nbsp;</th>
													<th width="47%">Product Name</th>
													<th class="text-left" width="10%">Price</th>
													<th class="text-left" width="5%">Unit </th>
													<th class="text-center" width="11%">Qty</th>
													<th class="text-center" width="10%">Sub Total</th>
													<th width="2%">&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$oreginalPriceCount = $discountValuePriceCount = 0;
												foreach($cartProductObj as $cartProduct){
													$productInfo = $this->common_model->getAll('*', 'product', array('product_id' => $cartProduct->pid, 'status'=>'1'));
													if(!$productInfo){
														continue;
													}
													$productPriceObj = $this->common_model->getAll('*', 'product_price', array('id' => $cartProduct->price_id));
													$productPriceObj = json_decode(json_encode($productPriceObj), true);
													$productPrice = getDiscountFormat($productPriceObj[0]);
													$oreginalPriceCount += $productPrice['oreginal_price'] * $cartProduct->quantity;
													$discountValuePriceCount += $productPrice['discount_value'] ? $productPrice['discount_value'] * $cartProduct->quantity : 0;
												?>
												<tr>
													<td class="image">
														<a class="product-image" title="<?=$productInfo[0]->name?>" href="<?=base_url()?><?=$productInfo[0]->url_slug?>"><img width="75" alt="<?=$productInfo[0]->name?>" src="<?=$iURL_product?><?=$productInfo[0]->image?>"></a>
													</td>
													<td>
														<h2 class="product-name">
															<a href="<?=base_url()?><?=$productInfo[0]->url_slug?>"><?=$productInfo[0]->name?></a>
														</h2>
													</td>
													<td class="text-left">
														<span class="cart-price"> 
															<span class="price">
																<i class="fas fa-rupee-sign"></i> <?=number_format($productPrice['final_price'],2)?>
															</span>
														</span>
														<?php if($productPrice['discount_value']){?>
														<br>														
														<span class="cart-price old-price"> 
															<span class="price">
																<i class="fas fa-rupee-sign"></i> <?=number_format($productPrice['oreginal_price'],2)?>
															</span>
														</span>
														<?php } ?>
													</td>
													<td>
														<?=$productPrice['quantity_type']?>
													</td>
													<td class="text-center">
														<div class="input-group">
														  <span class="input-group-btn">
															  <button type="button" <?=$cartProduct->quantity == '1' ? 'disabled' : ''?> class="btn btn-danger btn-number"  data-type="minus" data-field="quant[<?=$productInfo[0]->product_id?>]">
																<span class="glyphicon glyphicon-minus"></span>
															  </button>
														  </span>
														  <input type="text" name="quant[<?=$productInfo[0]->product_id?>]" class="form-control text-center input-number" value="<?=$cartProduct->quantity?>" min="1" max="10">
														  <span class="input-group-btn">
															  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?=$productInfo[0]->product_id?>]">
																  <span class="glyphicon glyphicon-plus"></span>
															  </button>
														  </span>
													   </div>
													</td>
													<td class="text-center">
														<span class="cart-price"> 
															<span class="price">
																<i class="fas fa-rupee-sign"></i> <?=number_format($productPrice['final_price'] * $cartProduct->quantity,2)?>
															</span> 
														</span>
													</td>
													<td class="text-center">
														<a class="remove-item" title="Remove item" href="javascript:;"></a>
													</td>
												</tr>
												<?php }if(!$cartProductObj){ ?>
												<tr>
													<td colspan="7" class="boxTxEmptyCart">Your cart is empty</td>
												</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr class="first last">
													<td class="a-right last" colspan="7">
														<button onclick="gotoPage(base_url+'checkout')" class="button btn-continue" title="Continue Shopping" type="button"><span>Continue Shopping</span></button>
														<?php if($cartProductObj){?>
														<button class="button btn-empty" onClick="clearCartVal()" type="button"><span>Clear Cart</span></button>
														<?php } ?>
													</td>
												</tr>
											</tfoot>
										</table>
									</fieldset>
								</form>
							</div>
							<!-- BEGIN CART COLLATERALS -->
							<div class="cart-collaterals row">
								<div class="col-sm-4">
									
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
											<tbody>
												<tr>
													<td colspan="1" class="a-left"> Subtotal </td>
													<td class="a-right text-right"><span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format($oreginalPriceCount, 2)?></span>
													</td>
												</tr>	
												<?php if($discountValuePriceCount > 0){?>
												<tr>
													<td colspan="1" class="a-left"> Discount </td>
													<td class="a-right text-right"><span class="price discntPriceTol"><i class="fas fa-rupee-sign"></i> <?=number_format($discountValuePriceCount, 2)?></span>
													</td>
												</tr>	
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="1" class="a-left"><strong>Grand Total</strong>
													</td>
													<td class="a-right text-right"><strong><span class="price"><i class="fas fa-rupee-sign"></i> <?=number_format(($oreginalPriceCount - $discountValuePriceCount),2)?></span></strong>
													</td>
												</tr>
											</tfoot>
										</table>
										<?php if(($oreginalPriceCount - $discountValuePriceCount) > 0){?>
										<ul class="checkout">
											<li>
												<button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed to Checkout</span></button>
											</li>
											<br>
										</ul>
										<?php } ?>
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
	$('.btn-number').click(function(e) {
		e.preventDefault();
		fieldName = $(this).attr('data-field');
		type = $(this).attr('data-type');
		var input = $("input[name='" + fieldName + "']");
		var currentVal = parseInt(input.val());
		if (!isNaN(currentVal)) {
			if (type == 'minus') {
				if (currentVal > input.attr('min')) {
					input.val(currentVal - 1).change();
				}
				if (parseInt(input.val()) == input.attr('min')) {
					$(this).attr('disabled', true);
				}

			} else if (type == 'plus') {
				if (currentVal < input.attr('max')) {
					input.val(currentVal + 1).change();
				}
				if (parseInt(input.val()) == input.attr('max')) {
					$(this).attr('disabled', true);
				}
			}
		} else {
			input.val(0);
		}
	});
	$('.input-number').focusin(function() {
		$(this).data('oldValue', $(this).val());
	});
	$('.input-number').change(function() {

		minValue = parseInt($(this).attr('min'));
		maxValue = parseInt($(this).attr('max'));
		valueCurrent = parseInt($(this).val());

		name = $(this).attr('name');
		if (valueCurrent >= minValue) {
			$(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
		} else {
			alert('Sorry, the minimum value was reached');
			$(this).val($(this).data('oldValue'));
		}
		if (valueCurrent <= maxValue) {
			$(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
		} else {
			alert('Sorry, the maximum value was reached');
			$(this).val($(this).data('oldValue'));
		}


	});
	$(".input-number").keydown(function(e) {
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
			// Allow: Ctrl+A
			(e.keyCode == 65 && e.ctrlKey === true) ||
			// Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});
</script>
</body>
</html>