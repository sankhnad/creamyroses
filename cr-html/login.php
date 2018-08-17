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
        <title>Login || Cakes</title>
        <!-- Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <?php include("include/style.php"); ?>
    </head>
    <body class="shopping-cart-page">
        <div id="page">
        <?php include("include/header.php"); ?>
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
                                                <button onclick="window.location='register.php';" class="button create-account" type="button"><span>Create an Account</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 registered-users">
                                        <strong>Registered Customers</strong>
                                        <div class="content">
                                            <p>If you have an account with us, please log in.</p>
                                            <ul class="form-list">
                                                <li>
                                                    <label for="email">Email Address <span class="required">*</span></label>
                                                    <input type="text" title="Email Address" class="input-text required-entry" id="email" value="" name="login[username]">
                                                </li>
                                                <li>
                                                    <label for="pass">Password <span class="required">*</span></label>
                                                    <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="login[password]">
                                                </li>
                                            </ul>
                                            <p class="required">* Required Fields</p>
                                            <div class="buttons-set">
                                                <button id="send2" name="send" type="submit" class="button login"><span>Login</span></button>
                                                <a class="forgot-word" href="#">Forgot Your Password?</a> 
                                            </div>
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
        <?php include("include/footer.php"); ?>
        <?php include("include/script.php"); ?>
    </body>
</html>