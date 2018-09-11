<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KITABGHAR PRAKASHAN</title>

</head>

<body>

	<div style="width:550px; margin:0px auto; border:solid 1px #999; margin-top:20px;">
    	<table cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; line-height:18px;">
        	<tr>
            	<td colspan="2" style="border-bottom:solid 1px #999; padding:10px;">
                	<img alt="KITABGHAR PRAKASHAN Logo" src="http://kgpbooks.com/images/logo.png">
                </td>
            </tr>
            <tr>
            	<td colspan="2" style="border-bottom:solid 1px #999; padding:0px 10px;">
                	<p>Hi Jai</p>
                    <p>Thank you for your order</p>
                    <p>We have received your order. We will send you an Email and SMS the moment your order items are dispatched to your address</p>
                    <p>
                       Order ID: <span style="color:#00bbe6;"><?php // echo $order_no;?></span><br />
                       Order Date: <span style="color:#00bbe6;"><?php echo date('d-m-Y');?></span><br />
                       Payment Mode: <span style="color:#00bbe6;"><?php //echo $payment_mode;?></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:solid 1px #999; border-right:solid 1px #999; padding:0px 10px; width:50%;">
                	<p><strong>Billing Info</strong><br />
                        <?php echo $billing_address['fld_customer_name'];?><br />
                        <?php echo $billing_address['fld_customer_address'];?><br />
                        <?php echo $billing_address['fld_city_name'].','.$state;?><br />
                        <?php echo $billing_address['fld_customer_pincode'];?><br />
                        <?php echo $billing_address['fld_customer_mobile'];?>
                    </p>
                </td>
                <td style="border-bottom:solid 1px #999; padding:0px 10px; width:50%;">
                	<p><strong>Shipping Info</strong><br />
                        <?php echo $ship_address['fld_shipping_name'];?><br />
                        <?php echo $ship_address['fld_shipping_address'];?><br />
                        <?php echo $ship_address['fld_shipping_city'].','.$state;?><br />
                        <?php echo $ship_address['fld_shipping_pincode'];?><br />
                        <?php echo $ship_address['fld_shipping_mobile'];?>
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
                        <th>Item Name</th>
                        <th>SKU Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                      </tr>
                      <?php $grand_total=''; for($i=0; $i<count($order_mail_datarecord); $i++){ ?>
					  <tr>
                        <td style="padding:10px 10px 5px; border-bottom:dashed 1px #ccc;"><?php echo $i+1;?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?php echo $order_mail_datarecord[$i]['fld_product_name'];?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?php echo $order_mail_datarecord[$i]['fld_product_sku'];?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?php echo $order_mail_datarecord[$i]['fld_order_quantity'];?></td>
                        <td style="border-bottom:dashed 1px #ccc;"><?php echo number_format($order_mail_datarecord[$i]['fld_order_price'],2);?></td>
						<?php $grand_total+=$order_mail_datarecord[$i]['fld_order_price'] * $order_mail_datarecord[$i]['fld_order_quantity'];?>
                        
                      </tr>
                     <?php }?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Total Amount</td>
                        <td><?php echo number_format($grand_total,2);?></td>
                      </tr>
					  <?php if(@$shipping_charge!=''){?>
                      <tr>
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Shipping Charge : </td>
                        <td><?php echo number_format(@$shipping_charge,2);?></td>
                      </tr>
					  <?php }?>

                      <?php 
                         if($coupan_code!=''){
                          @$discount=($grand_total*$coupan_discount)/100;
                       ?>
					  <tr>
						<td colspan="4"><p>Discount Applied Code <strong><?php echo $coupan_code;?></strong> to get <?php echo $coupan_discount;?>%</p></td>
						<td><strong><?php echo number_format(@$discount,2);?></strong></td>
					 </tr>
					 <?php }?>
                      <tr bgcolor="#d1d4d1">
                        <td style="padding:5px 10px;">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>Paid Amount : </strong></td>
                        <td><strong>Rs.<?php echo number_format($grand_total+@$shipping_charge-@$discount,2);?> </strong></td>
                      </tr>
                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:0px 10px; border-top:solid 1px #999;">
                	
                    <p>Thank you, <br />Warm Regards,</p> <p>Team <br /><strong>KITABGHAR PRAKASHAN</strong></p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>


