<?php
if ( $orderObj[ 0 ]->payment_mode == '1' ) {
	$paymentMode = 'COD';
} else if ( $orderObj[ 0 ]->payment_mode == '2' ) {
	$paymentMode = 'Online';
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Order Details</title>
</head>
<style>
	.backButton {
		background: #333;
		padding: 3px 8px;
		text-decoration: none;
		color: #fff;
		float: right;
		font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 12px;
	}
	
	.backButton {
		background: #000;
	}
</style>
<body>
<div style="width:1100px; margin-left:auto; margin-right:auto;">
<div id="divToPrint" style="width:1100px; margin-left:auto; margin-right:auto; margin-top:20px;">
  <table style="border:solid 1px #333333;" cellpadding="0" cellspacing="0">
    <tr>
      <td><table style="width:100%; max-width:1100px;" cellpadding="0" cellspacing="0">
          <tr>
            <td style="width:330px; padding:5px 10px;"><img style="width:50%;" src="<?=base_url();?>assets/store/images/logo.png"/> </td>
            <td style="width:550px; padding:5px 10px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Contact us: 011-23222844 || creamyroses@info.com</span><br/>
            </td>
            <td style="width:220px; text-align:center; padding:5px; font-family:Arial, Helvetica, sans-serif; font-size:16px;"><span style=" border:dashed 2px #666666; float:right; padding:5px 10px;">Invoice No. #
              <?=$orderObj[0]->invoice_no;?>
              </span> </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td style="border-top:#333 solid 1px;"><table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
          <tr>
            <td width="500px" style=" border-right:solid 1px #333333; padding:5px 10px;"><b>Order ID:
              <?=$orderObj[0]->order_id;?>
              </b><br/>
              <b>Order Date:
              <?=date('jS M Y',strtotime($orderObj[0]->created_on));?>
              <br />
              <b>Payment Mode:
              <?=$paymentMode;?>
              </b> </td>
            <td width="300px" style=" border-right:solid 1px #333333; padding:5px 10px;"><b>Billing Address</b><br/>
              <?=$billingAddressObj[0]->name?>
              <br/>
              <?=$billingAddressObj[0]->address_line_1;?>
              <br/>
              <?=$billingAddressObj[0]->address_line_2;?>
              <br/>
              <?=$billingAddressObj[0]->landmark;?>
              <br/>
              <?=$billingAddressObj[0]->pin;?>
              <?=$billingAddressObj[0]->city;?>
            </td>
            <td width="300px" style="padding:5px 10px;"><b>Shipping Address</b><br/>
              <?=$billingAddressObj[0]->name?>
              <br/>
              <?=$orderObj[0]->address;?>
              <br/>
              <?=$orderObj[0]->pin_code;?>
              <br/>
              <?=$orderObj[0]->phone_number;?>
              <br/>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td style="border-top:solid 1px #333333;"><table width="1100px" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">
          <tr>
            <td width="300px" style="border-bottom:#333 solid 1px; padding:5px 10px;"><b>Image</b> </td>
            <td width="300px" style="border-bottom:#333 solid 1px; padding:5px 10px;"><b>Product Name</b> </td>
            <td width="200px" style="border-bottom:#333 solid 1px; padding:5px 10px;"><b>Price</b> </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><b>Unit</b> </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><b>Qty </b> </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><b>Discount</b> </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><b>Make it Eggless</b> </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><b>Total</b> </td>
          </tr>
          <?php 
					foreach($orderDetailsObj as $row){
					
				
					?>
          <tr>
            <td width="200px" style="line-height:25px; border-bottom:#333 solid 1px; padding:5px 10px;"><img height="80px" width="80px" src="<?=base_url()?>uploads/product/thumb/<?=$row->image?>" align="absmiddle"/> </td>
            <td style="line-height:35px; border-bottom:#333 solid 1px; padding:5px 10px;" width="300px"><?=$row->name?>
            </td>
            <td width="200px" style="line-height:25px; border-bottom:#333 solid 1px; padding:5px 10px;"><?=round($row->actual_price,2)?>
            </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><?=$row->unit?>
            </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><?=$row->quantity?>
            </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><?=$row->discount?>
            </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><?=$row->discount?>
            </td>
            <td width="200px" style="text-align:right; border-bottom:#333 solid 1px; padding:5px 10px;"><?=round($row->total_price,2)?>
            </td>
          </tr>
          <?php }?>
          <tr>
            <td colspan="4" style="padding-top:15px; text-align:right;"><b>Shipping Charges</b><br/>
            </td>
            <td style="text-align:right; padding:5px 10px;"><?=round(234,2);?>
            </td>
          </tr>
          <tr>
            <td colspan="4" style="padding-top:15px; text-align:right; padding:5px 10px;"><b>Total</b><br/>
            </td>
            <td style="text-align:right; padding:5px 10px;"><b>
              <?=round(879,2);?>
              </b> </td>
          </tr>
        </table>
        <?php if($orderObj[0]->coupon!=''){?>
        <table width="100%" cellpadding="5" style="font-family:Arial, Helvetica, sans-serif; font-size:28px;">
          <tr>
            <td></td>
            <td width="35%" style="text-align:right; padding:5px 10px;">Discount Coupan Applied on
              <?=$orderObj[0]->coupon;?>
            </td>
            <td width="25%" style="text-align:right; padding:5px 10px;"><b>8888</b> </td>
          </tr>
        </table>
        <?php } ?>
        <table width="100%" cellpadding="5" style="font-family:Arial, Helvetica, sans-serif; font-size:22px;">
          <tr>
            <td width="30%"></td>
            <td width="52%" style="text-align:right; padding:5px 10px;">Grand Total</td>
            <td width="18%" style="text-align:right; padding:5px 10px;"><b> 9999</b> </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><table width="100%" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-style:italic; color:#333; text-align:left; line-height:25px; margin-top:50px;">
          <tr>
            <td align="right"><img style="width:20%;" src="<?=base_url();?>assets/store/images/logo.png"/> </td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
</body>
</html>
