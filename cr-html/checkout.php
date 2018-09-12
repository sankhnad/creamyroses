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
<title>Checkout || Cakes</title>
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php include("include/style.php"); ?>

</head>
<body class="shopping-cart-page">
<div id="page">

  <?php include("include/header.php"); ?>

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

                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td>1</td>
                                                    <td>Rupam Rathaur<br /> 8218405963</td>
                                                    <td>Harinagar, Jaitpur, Badarpur, AGRA 110044 (Uttar Pradesh)</td>
                                                    <td><a href="#" class="btn btn-success btn-sm">use this address</a></td>                          
                                                    <td style="width: 100px;"><a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Rupam Rathaur<br /> 8218405963</td>
                                                    <td>Harinagar, Jaitpur, Badarpur, AGRA 110044 (Uttar Pradesh)</td>
                                                    <td><a href="#" class="btn btn-success btn-sm">use this address</a></td>                           
                                                    <td style="width: 100px;"><a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Rupam Rathaur<br /> 8218405963</td>
                                                    <td>Harinagar, Jaitpur, Badarpur, AGRA 110044 (Uttar Pradesh)</td>
                                                    <td><a href="#" class="btn btn-success btn-sm">use this address</a></td>                           
                                                    <td style="width: 100px;"><a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i></a></td>
                                                </tr>

                                            </table>
                                            <b>Help us keep your account safe and secure, please verify your billing
                                                information.</b>
                                            <br/><br/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Best Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email" name="email"
                                                               required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">First name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_first_name" name="first_name"
                                                               required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Last name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_last_name" name="last_name"
                                                               required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Address:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_1"
                                                               name="address_line_1" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Unit / Suite #:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_2"
                                                               name="address_line_2" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_city" name="city"
                                                               required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="form-control" id="id_state" name="state">
                                                            <option value="AK">Alaska</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="DC">Washington D.C.</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_postalcode">Postalcode:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_postalcode" name="postalcode"
                                                               required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_phone">Phone:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_phone" name="phone" type="text"/>
                                                    </td>
                                                </tr>

                                            </table>
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
                                                                                style="width:100%;display: none;" onclick="$(this).fadeOut();  
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
                                            <div class="row">
                                                <div class="col-md-7">
                                                    
<table class="table" border="1">
    <thead>
        <tr class="active">
            <th>Item</th>
            <th>Qty</th>
            <th>Products</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img src="https://d24pyncn3hxs0c.cloudfront.net/sites/default/files/styles/uc_cart/public/love-quotient-9988317gf-A.jpg?itok=v4Jd1Rqm"></td>
            <td>1</td>
            <td>Love Quotient<br/><small><a href="#" >Uploaded Image</a></small></td>
            <td>Rs.499</td>
        </tr>
    </tbody>
</table>

<table class="table">
    <tbody>
        <tr>
            <td colspan="5"> &nbsp; </td>
            <td colspan="1" align="right">Subtotal:</td>
            <td align="right">Rs.499</td>
        </tr>
        <tr>
            <td colspan="5"> &nbsp; </td>
            <td colspan="1" align="right">Order total:</td>
            <td align="right">Rs.499</td>
        </tr>
    </tbody>
</table>

<div class="coupon-form-wrap">
    <div class="js-coupon-container" style="display: block;">
        <div class="js-coupon-header">Apply Coupon Code Here</div>
        <div class="content">
            <div class="form-item form-type-textfield form-item-code"> <input placeholder="Enter coupon code" type="text" id="edit-code" name="code" value="" size="15" maxlength="128" class="form-text"></div>
            <input type="submit" id="edit-apply" name="uc-coupon-apply" value="Apply" class="form-submit ajax-processed">
        </div>
    </div>
</div>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">Payment Method</div>
                                                        <div class="panel-body">

                                                           <div class="payment-top">
                                                              <div class="payment-method">
                                                                 <div class="form-item form-type-radios form-item-panes-payment-payment-method form-disabled">
                                                                    
                                                                    <div class="form-radios" id="edit-panes-payment-payment-method--2">
                                                                       <div class="form-item form-type-radio form-item-panes-payment-payment-method form-disabled">
                                                                          <div class="payment-radios"><input type="radio"  name="optradio" class="form-radio ajax-processed" checked="checked" id="edit-panes-payment-payment-method-secureebs--2"><label class="option">Payment via <strong><font size="3" color="#666666">Debit Card</font></strong> or <strong><font size="3" color="#FF9900">Net Banking</font></strong> </label></div>

                                                                          <div class="payment-radios"> <input type="radio"  name="optradio" class="form-radio ajax-processed" id="edit-panes-payment-payment-method-secureebs--3"> <label class="option">Payment via <strong><font size="3" color="#FF9900">Credit Card</font></strong> </label></div>

                                                                          <div class="payment-radios"> <input type="radio"  name="optradio" class="form-radio ajax-processed" id="paypal-wps"> <label class="option">Payment via <img src="https://d598e6i8i1kkq.cloudfront.net/sites/all/themes/facd7/images/checkout/paypal.png"></label></div>

                                                                          <div class="payment-radios"> <input type="radio"  name="optradio" class="form-radio ajax-processed" id="payumoney"> <label class="option">Payment via <img src="https://d598e6i8i1kkq.cloudfront.net/sites/all/themes/facd7/images/checkout/pay-u-money-logo.png" style="vertical-align: middle;"> </label></div>

                                                                          <div class="payment-radios"> <input type="radio"  name="optradio" class="form-radio ajax-processed" id="mobikwik"><label class="option">Payment via MobiKwik </label></div>

                                                                          <div class="payment-radios"> <input type="radio"  name="optradio" class="form-radio ajax-processed" id="paytm"><label for="paytm" class="option">Payment via <img src="https://d598e6i8i1kkq.cloudfront.net/sites/all/themes/facd7/images/checkout/paytm.png"> </label></div>
                                                                       </div>
                                                                    </div>
                                                                 </div>
                                                              </div>
                                                           </div>
                                                           <div class="payment-btm">
                                                              <fieldset class="form-wrapper uc-cart-checkout-review-tandc" id="uc_ct-pane">
                                                                 <div class="fieldset-wrapper">
                                                                    <div class="form-item form-type-checkboxes form-item-panes-uc-ct-uc-tc-agree">
                                                                       <label ><strong>Terms and Conditions <span class="form-required" >*</span></strong></label>
                                                                       <div id="edit-panes-uc-ct-uc-tc-agree" class="form-checkboxes">
                                                                          <div class="form-item form-type-checkbox form-item-panes-uc-ct-uc-tc-agree-uc-tc"> <input type="checkbox" id="edit-panes-uc-ct-uc-tc-agree-uc-tc" class="form-checkbox"> <label class="option" > <em>I agree with the <a class="viewTermAndCond" href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('midnight-container').style.display='block'">terms and conditions</a>.</em> </label><span class="error" style="color:#e9322d;float:left;font-size:13px;margin:6px 0 0;clear:both;display:none;">Please select terms and conditions.</span></div>
                                                                       </div>
                                                                    </div>
                                                                 </div>
                                                              </fieldset> 
                                                              <div class="paymentbtn"> <input type="button" class="btn btn-success" id="uc-common-form" value="Make Payment"></div>
                                                           </div>

                                                        </div>
                                                    </div>
                                                </div>
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
                <!-- <div class="side-banner"><img src="assets/images/side-banner.jpg" width="100%" alt="banner"></div> -->
                <div class="block block-progress">
                    <div class="block-title ">Your Checkout</div>
                    <div class="block-content">
                        <dl>
                            <dt class="complete"> Billing Address <span class="separator">|</span> <a onClick="checkout.gotoSection('billing'); return false;" href="#billing">Change</a> </dt>
                            <dd class="complete">
                                <address>
                                    John Doe<br>
                                    Abc Company<br>
                                    23 North Main Stree<br>
                                    Windsor<br>
                                    Holtsville,  New York, 00501<br>
                                    United States<br>
                                    T: 5465465 <br>
                                    F: 466523
                                </address>
                            </dd>
                            <dt class="complete"> Shipping Address <span class="separator">|</span> <a onClick="checkout.gotoSection('shipping');return false;" href="#payment">Change</a> </dt>
                            <dd class="complete">
                                <address> 
                                    John Doe<br>
                                    Abc Company<br>
                                    23 North Main Stree<br>
                                    Windsor<br>
                                    Holtsville,  New York, 00501<br>
                                    United States<br>
                                    T: 5465465 <br>
                                    F: 466523
                                </address>
                            </dd>
                            <dt class="complete"> Shipping Method <span class="separator">|</span> <a onClick="checkout.gotoSection('shipping_method'); return false;" href="#shipping_method">Change</a> </dt>
                            <dd class="complete"> Flat Rate - Fixed <br>
                                <span class="price">$15.00</span> 
                            </dd>
                            <dt> Payment Method </dt>
                        </dl>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
<!-- Main Container End --> 
 
<style type="text/css">
    table.table {
        border-color: #a1a1 !important;
    }

.js-coupon-header {
    font-size: 12px;
}
.coupon-form-wrap .form-type-textfield {
    width: 50%;
    display: inline-block;
    margin-bottom: 0;
    margin-top: 5px;
}
.coupon-form-wrap input.form-text {
    width: 95%;
    padding: 7px 0 7px 10px;
    border: 1px solid #ccc;
    font-size: 12px;
}
.js-coupon-container input.form-submit {
    background: #ccc;
    border: none;
    padding: 6px 15px 6px 15px;
    color: #464646;
    cursor: pointer;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-left: -15px;
}

</style>

<?php include("include/footer.php"); ?>

<?php include("include/script.php"); ?>
</body>
</html>
