<!DOCTYPE html>
<html lang="en">
<head>	
	<?php include('includes/path.php');?>
	<title>Login | FIMCO | POCHI</title>
	<?php include('includes/styles.php'); ?>
</head>
<body class="login-layout light-login">
	<div id="preloader"> <img src="<?=$iURL_assets?>admin/images/preloader.gif" alt="" /> </div>
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center logoLoginAra">
							<img src="<?=$iURL_assets?>logo.png" height="80px" />
							<div>&copy; <strong>FIMCO</strong> <i>Inform, Advise, Execute</i></div>
						</div>
						<div class="space-6"></div>
						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h3 class="header blue center">
												<i class="ace-icon fa fa-key"></i>
												Login
												<div class="space-6"></div>
											</h3>											
										<div class="space-6"></div>
										<form id="adminlogin">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="email" type="text" class="form-control" placeholder="Email / Username" required />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>											
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input name="password" type="password" class="form-control" placeholder="Password" required />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>
												<div class="row">
													<div class="col-md-5 imgCpatch">
														<?=$captcha?>
													</div>
													<div class="col-md-5">
														<div class="form-group">
														   <input class="form-control" name="captcha" placeholder="Enter Captcha" type="text">
														 </div>
													</div>
													<div class="col-md-2">
														<div class="reladCpc" onclick="newCaptcha()">
															 <i class="fas fa-sync"></i>
														</div>
													</div>
												</div>
												<div class="space"></div>
												<div class="clearfix">
													<label class="inline">
														<input name="rememberMe" type="checkbox" class="ace" />
														<span class="lbl"> Remember Me</span>
													</label>
												
													<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Login</span>
													</button>												
												</div>
												<div class="space-4"></div>
											</fieldset>
										</form>
									</div>
									<!-- /.widget-main -->
									<div class="toolbar clearfix">
										<div>
											<a href="#" data-target="#forgot-box" class="forgot-password-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												I forgot my password
											</a>
										</div>
										<!--<div>
											<a href="#" data-target="#signup-box" class="user-signup-link">
												I want to register
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>										
										</div>-->
									</div>
								</div>
								<!-- /.widget-body -->
							</div>
							<!-- /.login-box -->
							<div id="forgot-box" class="forgot-box widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>
									
										<div class="space-6"></div>
										<p>Enter your email and to receive instructions</p>
										<form id="forgetpassword">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="email" class="form-control" name="email" placeholder="Email" />
														<i class="ace-icon fa fa-envelope"></i>
													</span>
												</label>											
												<div class="clearfix">
													<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
														<i class="ace-icon fa fa-lightbulb-o"></i>
														<span class="bigger-110">Send Me!</span>
													</button>
												</div>
											</fieldset>
										</form>
									</div>
									<!-- /.widget-main -->
									<div class="toolbar center">
										<a href="#" data-target="#login-box" class="back-to-login-link">
											Back to login
											<i class="ace-icon fa fa-arrow-right"></i>
										</a>									
									</div>
								</div>
								<!-- /.widget-body -->
							</div>
							<div class="boxNdHlpbox">
								<span>Need help or have feedback? <a href="<?=base_url()?>contact">Contact us</a></span>
							</div>
							<!-- /.forgot-box -->
							<!--<div id="signup-box" class="signup-box widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												New User Registration
											</h4>
									
										<div class="space-6"></div>
										<p> Enter your details to begin: </p>
										<form>
											<fieldset>
												<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>
											
												<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
											
												<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
											
												<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>
											
												<label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>
											
												<div class="space-24"></div>
												<div class="clearfix">
													<button type="reset" class="width-30 pull-left btn btn-sm">
														<i class="ace-icon fa fa-refresh"></i>
														<span class="bigger-110">Reset</span>
													</button>												
													<button type="button" class="width-65 pull-right btn btn-sm btn-success">
														<span class="bigger-110">Register</span>
														<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
													</button>
												</div>
											</fieldset>
										</form>
									</div>
									<div class="toolbar center">
										<a href="#" data-target="#login-box" class="back-to-login-link">
											<i class="ace-icon fa fa-arrow-left"></i>
											Back to login
										</a>
									</div>
								</div>
							</div>-->
							<!-- /.signup-box -->
						</div>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.main-content -->
	</div>
	<!-- /.main-container -->
	<!-- basic scripts -->
	<?php include('includes/scripts.php')?>
	<script>
		isEnableTimerCnt = true;;
	</script>
	<script src="<?=$iURL_assets?>admin/js/custom.js"></script>
	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		function redirectPageHash(){
			u_idleTime = parseInt(readCookie('logoutCookie'));
			if(u_idleTime > 100){
				var redictURL = window.location.hash.substring(1);
                redictURL = redictURL ? redictURL : base_url;
				timerAlert('Redirecting!', 'Redirecting to last page', redictURL);
			}
		}
		jQuery( function ( $ ) {			
			$( document ).on( 'click', '.toolbar a[data-target]', function ( e ) {
				e.preventDefault();
				var target = $( this ).data( 'target' );
				$( '.widget-box.visible' ).removeClass( 'visible' ); //hide others
				$( target ).addClass( 'visible' ); //show target
			});
			
			createCookie('logoutCookie', 0);			
			
			setInterval("redirectPageHash()", 1000); 
		});
		
	</script>
</body>
</html>