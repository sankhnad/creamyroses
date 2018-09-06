<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<?php include('includes/commonfile.php');?>
	<title>Home | Creamy Roses</title>
	<?php include("includes/style.php"); ?>
</head>

</head>
<body class="shopping-cart-page">
<div id="page">

	<?php include("includes/header.php"); ?>
        <!-- Main Container -->
        <section class="main-container col1-layout">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <article class="col-main">
                            <div class="account-login">
                                <div class="page-title">
                                    <h2>Login or Create an Account</h2>
                                </div>
                                <fieldset class="col2-set">
                                    <div class="col-1 new-users">
                                        <strong>If you have an account with us, please log in.</strong>
                                        <div class="content">
                                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                            <div class="buttons-set">
                                                <button onClick="gotoPageView('login');" class="button create-account" type="button"><span>Login Customers</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 registered-users">
                                        <strong>Create New Account</strong>
                                        <div class="content">
                                            <p>By creating an account with our store.</p>
												<form class="register_customer">
												  <ul class="form-list">

													<li>
														<label for="email">First Name <span class="required">*</span></label>
														<input type="text" placeholder="Full Name" class="input-text required-entry"  name="fname">
													</li>
													<li>
														<label for="email">Last Name </label>
														<input type="text" placeholder="Last Name" class="input-text required-entry"  name="lname">
													</li>

													<li>
														<label for="email">Email Address <span class="required">*</span></label>
														<input type="text" placeholder="Email Address" class="input-text required-entry" name="email">
													</li>
													<li>
														<label for="email">Mobile <span class="required">*</span></label>
														<input type="text" placeholder="Contact Number" class="input-text required-entry" name="mobile" onBlur="insertOtpMobile(this.value)">
													</li>
													<li>
														<label for="email">Referral Code </label>
														<input type="text" placeholder="Referral Code" class="input-text required-entry" name="assign_rferral_code">
													</li>
													
													<li>
														<label for="pass">Password <span class="required">*</span></label>
														<input type="password" placeholder="Password" class="input-text required-entry validate-password" name="password">
													</li>
													<li>
														<label for="pass">Confirm Password <span class="required">*</span></label>
														<input type="password" placeholder="Password" class="input-text required-entry validate-password" >
													</li>
												</ul>
												
												<p class="required">* Required Fields</p>
												<div class="buttons-set">
													<button type="submit" class="button login"><span>Create Account</span></button>
												</div>

												</form>
												
												<form class="confirmOTP_customer">
													<ul class="form-list">
														<li>
															<label for="email">Mobile Number </label>
															<input type="mobile" name="otpMobile"  disabled  class="input-text required-entry">
														</li>
														<li>
															<label for="email">OTP </label>
															<input type="text" class="input-text required-entry" name="otp" placeholder="Enter Your OTP">
														</li>
														
														<li class="col-sm-12 text-center">
															<!--<button type="submit" class="button login"><span>Change Number</span></button>-->
															<button type="button" class="button login"><span>Confirm OTP</span></button>
														</li>
														
													</ul>
												</form>
												
                                            
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </article>
                        <!--  ///*///======    End article  ========= //*/// --> 
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Container End --> 
		<?php include("includes/footer.php"); ?>
		<?php include("includes/script.php"); ?>
    </body>
</html>