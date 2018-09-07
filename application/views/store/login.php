<!DOCTYPE html>
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
                                        <strong>New Customers</strong>
                                        <div class="content">
                                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                            <div class="buttons-set">
                                                <button onClick="gotoPageView('registration');" class="button create-account" type="button"><span>Create an Account</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 registered-users">
                                        <strong>Registered Customers</strong>
                                        <div class="content">
                                            <p>If you have an account with us, please log in.</p>
											<form id="login_customer" novalidate>
												<ul class="form-list">
													<li>
														<label for="email">Email Address <span class="required">*</span></label>
														<input type="text" title="Email Address" class="input-text" name="email" required>
													</li>
													<li>
														<label for="pass">Password <span class="required">*</span></label>
														<input type="password" title="Password"  class="input-text" name="password" required>
													</li>
												</ul>
                                            <p class="required">* Required Fields</p>
                                            <div class="buttons-set">
                                                <button id="send2" name="send" type="submit" class="button login"><span>Login</span></button>
                                                <a class="forgot-word" href="#">Forgot Your Password?</a> 
                                            </div>
											</form>
											<form id="confirmOTP_customer" novalidate class="hide-now">
											  <ul class="form-list">
												<li>
												  <label for="email">Mobile Number </label>
												  <input type="mobile" name="otpMobile" readonly="readonly" class="input-text">
												</li>
												<li>
												  <label for="email">OTP <span class="required">*</span></label>
												  <input type="text" class="input-text required-entry" name="otp" placeholder="Enter Your OTP" required>
												</li>
												<li class="col-sm-12 text-center">
												  <!--<button type="submit" class="button login"><span>Change Number</span></button>-->
												  <button type="submit" class="button login"><span>Confirm OTP</span></button>
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