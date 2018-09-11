<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SOFTWARE SALES</title>

</head>

<body style="background:#CCC">

 <div style="width:550px; margin:0px auto; border:solid 1px #999; margin-top:20px; background:#FFF">
     <table cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; line-height:18px;">
         <tr>
             <td colspan="2" style="border-bottom: 5px solid #2196F3; padding:10px;background-color: #e2027c; text-align:center">
                 <img alt="SOFTWARE SALES Logo" src="https://softwaresales.com.au/images/footer-logo.png" width="150">
                </td>
            </tr>
            <tr>
             <td colspan="2" style="border-bottom:solid 1px #999; padding:0px 10px;">
			 	<?php 
					$name = $orderObj[0]->fname.'&nbsp;'.$orderObj[0]->lname;
					$billing_name = $billingObj[0]->fname.'&nbsp;'.$orderObj[0]->lname;
				?>
			 	
                 <p>Hi <?php echo ucwords($name);?></p>
                    <p>Thank you for your order</p>
                    <p>We have received your order. We will send you an Email with your order details</p>
                    <p>
                       Order ID: <span style="color:#00bbe6;"><?=$orderObj[0]->order_id?></span><br />
                       Order Date: <span style="color:#00bbe6;"><?=date('jS M Y',strtotime($orderObj[0]->created_on))?></span><br />
                       Payment Mode: <span style="color:#00bbe6;">Online</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:solid 1px #999; border-right:solid 1px #999; padding:0px 10px; width:50%;">
                 <p><strong>Billing Info</strong><br />
                        <?php echo ucwords($billing_name);?><br />
                        <?=$billingObj[0]->email?><br />
                        <?=$billingObj[0]->phone?><br />
                        <?=$billingObj[0]->address?><br />
                        <?=$billingObj[0]->country?><br />
                        <?=$billingObj[0]->state?><br />
                        <?=$billingObj[0]->city?><br />
                        <?=$billingObj[0]->zip_code?>
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
                        <th style="padding:5px 0px;">S.no.</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                      <?php
					  	 $sub_total = 0; 
					  	 $grand_total = 0; 
						 $discountVal = 0;
					  	 for($i=0; $i<count($orderDetailsObj); $i++){ ?>
								<tr>
									<td style="padding:10px 10px 5px; border-bottom:dashed 1px #ccc;"><?php echo $i+1;?></td>
									<td style="border-bottom:dashed 1px #ccc;"><?=$orderDetailsObj[$i]->product_name;?></td>
									<td style="border-bottom:dashed 1px #ccc;">$<?=number_format($orderDetailsObj[$i]->unit_price,2);?></td>
									<td style="border-bottom:dashed 1px #ccc;"><?=$orderDetailsObj[$i]->qty;?></td>
									<td style="border-bottom:dashed 1px #ccc;">$<?=number_format($orderDetailsObj[$i]->sub_total_price ,2);?></td>
							   </tr>
	                    <?php
								
							$sub_total += $orderDetailsObj[$i]->unit_price * $orderDetailsObj[$i]->qty;
							
							$type  = $orderObj[0]->discount_type;
							$discount  = $orderObj[0]->discount;
							if($type !=''){
								if($type == 1){
							 		$discountVal = $discount;
								}else if($type == 2){
									$discountVal = $sub_total*$discount/100;
								}
							}
							$grand_total = $sub_total - $discountVal;
							
						 }?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Subtotalt</td>
                        <td>$<?php echo number_format($sub_total,2);?></td>
                      </tr>
					  <?php if($type!=''){ ?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Discount</td>
                        <td>$<?php echo number_format($discountVal,2);?></td>
                      </tr>
					  <?php } ?>
					  
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Total Amount</td>
                        <td>$<?php echo number_format($grand_total,2);?></td>
                      </tr>

                     
                      <tr bgcolor="#d1d4d1">
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>Paid Amount : </strong></td>
                        <td><strong>$<?php echo number_format($grand_total,2);?> </strong></td>
                      </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:0px 10px; border-top:solid 1px #999;">
                 
                    <p>Thank you, <br />Warm Regards,</p> <p>Team <br /><strong>SOFTWARE SALES</strong></p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>