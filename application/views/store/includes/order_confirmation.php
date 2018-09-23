
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CREAMY ROSES</title>

</head>

<body>

	<div style="width:550px; margin:0px auto; border:solid 1px #999; margin-top:20px;">
    	<table cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; line-height:18px;">
        	<tr>
            	<td colspan="2" style="border-bottom:solid 1px #999; padding:10px;">
                	<img alt="CREAMY ROSES LOGO" src="<?=base_url();?>assets/store/images/logo.png">
                </td>
            </tr>
            <tr>
            	<td colspan="2" style="border-bottom:solid 1px #999; padding:0px 10px;">
                	<p>Hi <?php echo ucwords($customer_name);?></p>
                    <p>Thank you for your order</p>
                    <p>We have received your order. We will send you an Email and SMS the moment your order items are dispatched to your address</p>
                    <p>
                       Order ID: <span style="color:#00bbe6;"><?=$order_no;?></span><br />
                       Invoice ID: <span style="color:#00bbe6;"><?=$invoice_no;?></span><br />
					   Order Date: <span style="color:#00bbe6;"><?=date('d-m-Y');?></span><br />
                       Payment Mode: <span style="color:#00bbe6;"><?=$payment_mode == '2'?'COD':'Online';?></span><br />
                       Delivery Date	: <span style="color:#00bbe6;"><?=$delivery_date;?></span><br />
                       Delivery Time	: <span style="color:#00bbe6;"><?=$delivery_option.'('.$delivery_time.')';?></span><br />
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:solid 1px #999; border-right:solid 1px #999; padding:0px 10px; width:50%;">
                	<p><strong>Billing Info</strong><br />
                        <?=$address;?><br />
                        <?=$pin_code;?><br />
                        <?=$phone_number;?><br />
                    </p>
                </td>
                <td style="border-bottom:solid 1px #999; padding:0px 10px; width:50%;">
                	<p><strong>Shipping Info</strong><br />
                        <?=$shipping_address;?><br />
                        <?=$shipping_pin_code;?><br />
                        <?=$shipping_number;?><br />
                    </p>
                </td>
            </tr> 
            <tr>
            	<td colspan="2" style="border-bottom:solid 1px #999; padding:0px 10px;">
                	<p>Order Summary</p>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                	<table cellpadding="0" cellspacing="0" style="width:100%; text-align:left; padding:5px 10px;">
						<tr>
							<th width="5%">&nbsp;</th>
							<th>Image</th>
							<th width="47%">Product Name</th>
							<th class="text-left" width="10%">Price</th>
							<th class="text-left" width="5%">Unit </th>
							<th class="text-center" width="11%">Qty</th>
							<th class="text-center" width="10%">Sub Total</th>
						</tr>
                      <?php 
					  $grand_Sub_total = $subTotal = $discTotal = 0;
					  $i=1; 
					  foreach($orderDetailObj as $orderData){ 
					  			$productInfo = $this->common_model->getAll('*', 'product', array('product_id' => $orderData->pid, 'status'=>'1'));
							    $subTotal = $orderData->actual_price * $orderData->quantity;
					  
					  ?>
					  <tr>
					    <td style="padding:10px 10px 5px; border-bottom:dashed 1px #ccc;"><?php echo $i++;?></td>
					    <td style="border-bottom:dashed 1px #ccc;"><img width="75" alt="<?=$productInfo[0]->name?>" src="<?=base_url()?>uploads/product/<?=$productInfo[0]->image?>"></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?=$productInfo[0]->name;?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?=number_format($orderData->actual_price,2);?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?=$orderData->unit;?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?=$orderData->quantity;?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?=number_format($subTotal,2)?></td>
                      </tr>
                     <?php 
					 
						 $grand_Sub_total += $subTotal;
						 $discTotal += $orderData->discount;
					 }?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Sub Total</td>
                        <td><?=number_format($grand_Sub_total,2);?></td>
                      </tr>
					  <?php if($discTotal > 0){
					  $grand_Sub_total = $grand_Sub_total - $discTotal;
					  ?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Discount : </td>
                        <td><?=number_format($discTotal,2);?></td>
                      </tr>
					  <?php }?>
					  <?php if($delivery_price!=''){
					   $grand_Sub_total = $grand_Sub_total - $delivery_price;
					  
					  ?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Delivery Price : </td>
						<?php if($delivery_price > 0){ ?>
                        <td><?=number_format($delivery_price,2);?></td>
						<?php } else{ ?>
                        <td>Free</td>
						<?php } ?>
                      </tr>
					  <?php }?>


					  <?php if($coupon_price  > 0){
					  					   $grand_Sub_total = $grand_Sub_total - $coupon_price;

					  ?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Coupon Apply (<?=$coupon?>) : </td>
                        <td><?=number_format($coupon_price,2);?></td>
                      </tr>
					  <?php }?>

					  <?php if($reward_balance  > 0){
					  	 $grand_Sub_total = $grand_Sub_total - $reward_balance;

					  ?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Reward Balance : </td>
                        <td><?=number_format($reward_balance,2);?></td>
                      </tr>
					  <?php }?>

                      
                      <tr bgcolor="#d1d4d1">
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>Paid Amount : </strong></td>
                        <td><strong>Rs.<?php echo number_format($grand_Sub_total,2);?> </strong></td>
                      </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:0px 10px; border-top:solid 1px #999;">
                	
                    <p>Thank you, <br />Warm Regards,</p> <p>Team <br /><strong>CREAMY ROSES</strong></p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


