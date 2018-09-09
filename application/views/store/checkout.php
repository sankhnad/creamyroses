<?php
if ( $defaultAddress ) {	
	$aid			= $defaultAddress[0]->aid;
	$name			= $defaultAddress[0]->name;
	$mobile			= $defaultAddress[0]->mobile;
	$pin			= $defaultAddress[0]->pin;
	$address_line_1 = $defaultAddress[0]->address_line_1;
	$address_line_2 = $defaultAddress[0]->address_line_2;
	$landmark		= $defaultAddress[0]->landmark;
	$city			= $defaultAddress[0]->city;
	$sid			= $defaultAddress[0]->stateCode;
	$type			= $defaultAddress[0]->type;
	$isDefault		= $defaultAddress[0]->isDefault;
	$remarks		= $defaultAddress[0]->remarks;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('includes/commonfile.php');?>
	<title>Checkout | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

<body class="shopping-cart-page">
	<?php include("includes/header.php"); ?>
<!-- Main Container -->
<section class="main-container col2-left-layout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
            

                <div id='mainContentWrapper'>
                    <div class="col-md-12">
                        <h2 style="text-align: center;">
                            Review Your Order &amp; Complete Checkout
                        </h2>
                        <hr/>
                        <a href="#" class="btn btn-info" style="width: 100%;">Add More Products &amp; Services</a>
                        <hr/>
                        <div class="shopping_cart">
                            <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Review
                                                    Your Order</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="items">
                                                    <div class="col-md-9">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <a class="btn btn-warning btn-sm pull-right"
                                                                       href="#"
                                                                       title="Remove Item">X</a>
                                                                    <b>
                                                                        Premium Posting</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <ul>
                                                                        <li>One Job Posting Credit</li>
                                                                        <li>Job Distribution*</li>
                                                                        <li>Social Media Distribution</li>
                                                                    </ul>
                                                                </td>
                                                                <td>
                                                                    <b>$147.00</b>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div style="text-align: center;">
                                                            <h3>Order Total</h3>
                                                            <h3><span style="color:green;">$147.00</span></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;"><a style="width:100%;"
                                                                                            data-toggle="collapse"
                                                                                            data-parent="#accordion"
                                                                                            href="#collapseTwo"
                                                                                            class=" btn btn-success"
                                                                                            onclick="$(this).fadeOut(); $('#payInfo').fadeIn();">Continue
                                                to Billing Information&raquo;</a></div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Contact
                                                and Billing Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <b>Help us keep your account safe and secure, please verify your billing
                                                information.</b> <a href="javascript:void(0);" data-toggle="modal" data-target="#addressAddEdit">Change Address</a>
                                            <br/><br/>
											<form id="editNewAddress">
												<input type="hidden" name="aid" value=""/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Best Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email" name="email">
                                                               
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">Fill Name:</label></td>
                                                    <td>
                          							  <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?=$name?>" required>
                                                               
                                                    </td>
                                                </tr>
												
												<tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">Mobile</label></td>
                                                    <td>
															<input data-tooltip="tooltip" title="10-digit mobile number without prefixes" type="text" name="mobile" data-mask="0000000000" class="form-control" value="<?=$mobile?>" required>
                                                               
                                                    </td>
                                                </tr>
                                                
												
												<tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">Country</label></td>
                                                    <td>
                                                        <select class="selectpicker" data-width="100%" title="Select Country" disabled required>
														  <option selected>India</option>
														</select>
                                                               
                                                    </td>
                                                </tr>
												
												<tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">PIN Code</label></td>
                                                    <td>
															<input data-tooltip="tooltip" title="6 digits [0-9] pincode" type="text" name="pin" data-mask="000000" class="form-control" value="<?=$pin?>" required/>
                                                               
                                                    </td>
                                                </tr>

                                                
												
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Street Address:</label></td>
                                                    <td>
														<div class="col-md-6">
														  <input type="text" name="addresline1" class="form-control" maxlength="60" placeholder="Flat / House No. / Floor / Building"  value="<?=$address_line_1?>" required>
														</div>
														<div class="col-md-6">
														  <input type="text" name="addresline2" class="form-control" maxlength="60" placeholder="Colony / Street / Locality"  value="<?=$address_line_2?>">
														</div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Land Mark:</label></td>
                                                    <td>
                          								<input type="text" name="landmark" class="form-control" maxlength="60" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc."  value="<?=$landmark?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input type="text" name="city" class="form-control" maxlength="60" required value="<?=$city?>"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="selectpicker" data-width="100%" name="state" title="Select State" data-live-search="true" required>
														  <?php 
														foreach($stateAry as $stateData){
															if($stateData->sid == $sid){
														?>
														  <option selected="selected" value="<?=$stateData->sid?>"><?=$stateData->stateName?> </option>
														  <?php }else{ ?>
														   <option selected="selected" value="<?=$stateData->sid?>"><?=$stateData->stateName?> </option>
							
														 <?php  }
														  } ?>
														</select>
                                                    </td>
                                                </tr>

                                            </table>
											</form>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center;"><a data-toggle="collapse"
                                                                                data-parent="#accordion"
                                                                                href="#collapseThree"
                                                                                class=" btn   btn-success" id="payInfo"
                                                                                style="width:100%;display: none;" onClick="$(this).fadeOut();  
                       document.getElementById('collapseThree').scrollIntoView()">Enter Payment Information &raquo;</a>
                                            </div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <b>Payment Information</b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <span class='payment-errors'></span>
                                            <fieldset>
                                                <legend>What method would you like to pay with today?</legend>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="card-holder-name">Name on
                                                        Card</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" stripe-data="name"
                                                               id="name-on-card" placeholder="Card Holder's Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="card-number">Card
                                                        Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" stripe-data="number"
                                                               id="card-number" placeholder="Debit/Credit Card Number">
                                                        <br/>
                                                        <div><img class="pull-right"
                                                                  src="https://s3.amazonaws.com/hiresnetwork/imgs/cc.png"
                                                                  style="max-width: 250px; padding-bottom: 20px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="expiry-month">Expiration
                                                            Date</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-xs-3">
                                                                    <select class="form-control col-sm-2"
                                                                            data-stripe="exp-month" id="card-exp-month"
                                                                            style="margin-left:5px;">
                                                                        <option>Month</option>
                                                                        <option value="01">Jan (01)</option>
                                                                        <option value="02">Feb (02)</option>
                                                                        <option value="03">Mar (03)</option>
                                                                        <option value="04">Apr (04)</option>
                                                                        <option value="05">May (05)</option>
                                                                        <option value="06">June (06)</option>
                                                                        <option value="07">July (07)</option>
                                                                        <option value="08">Aug (08)</option>
                                                                        <option value="09">Sep (09)</option>
                                                                        <option value="10">Oct (10)</option>
                                                                        <option value="11">Nov (11)</option>
                                                                        <option value="12">Dec (12)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <select class="form-control" data-stripe="exp-year"
                                                                            id="card-exp-year">
                                                                        <option value="2016">2016</option>
                                                                        <option value="2017">2017</option>
                                                                        <option value="2018">2018</option>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2023">2023</option>
                                                                        <option value="2024">2024</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="cvv">Card CVC</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" stripe-data="cvc"
                                                                   id="card-cvc" placeholder="Security Code">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-9">
                                                        </div>
                                                    </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-success btn-lg" style="width:100%;">Pay
                                                Now
                                            </button>
                                            <br/>
                                            <div style="text-align: left;"><br/>
                                                By submiting this order you are agreeing to our <a href="/legal/billing/">universal
                                                    billing agreement</a>, and <a href="/legal/terms/">terms of service</a>.
                                                If you have any questions about our products or services please contact us
                                                before placing this order.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>    
                
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                 <div class="side-banner"><img src="<?=base_url()?>assets/store/images/side-banner.jpg" width="100%" alt="banner"></div> 
                
            </aside>
        </div>
    </div>
</section>

	<!-- Modal -- Add or Edit Address -- Modal -->
	<div id="addressAddEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
									<div class="manage_add"><a href="<?=base_url()?>add-address">Add Addresses</a> </div>
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
															<li><a href="javascript:void(0)" onClick="selectAddress('<?=encode($addressData->aid)?>', '<?=$CID?>')">Select</a></li>
														</ul>
													</div>
												</div>
									<?php } ?>
									</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

<!-- Main Container End --> 
	<?php include("includes/footer.php"); ?>
	<?php include("includes/script.php"); ?>
	<script type="text/javascript" src="<?=$iURL_storeAssts?>js/cloud-zoom.js"></script>
</body>
</html>