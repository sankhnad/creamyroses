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
<title>My Dashboard || Cakes</title>
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
              <article class="col-main">
                <div class="my-account">
                  <div class="page-title">
                    <h2>My Dashboard</h2>
                  </div>
                  <div class="dashboard">
                    <div class="welcome-msg"> <strong>Hello,John Doe!</strong>
                      <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                    </div>
                    <div class="recent-orders">
                      <div class="title-buttons"><strong>Recent Orders</strong> <a href="#">View All </a> </div>
                      <div class="table-responsive">
                        <table class="data-table" id="my-orders-table">
                          <col>
                          <col>
                          <col>
                          <col width="1">
                          <col width="1">
                          <col width="1">
                          <thead>
                            <tr class="first last">
                              <th>Order #</th>
                              <th>Date</th>
                              <th>Ship to</th>
                              <th><span class="nobr">Order Total</span></th>
                              <th>Status</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="first odd">
                              <td>500000002</td>
                              <td>9/9/10 </td>
                              <td>John Doe</td>
                              <td><span class="price"><i class="fa fa-rupee"></i> 5.00</span></td>
                              <td><em>Pending</em></td>
                              <td class="a-center last"><span class="nobr"> <a href="#">View Order</a> <span class="separator">|</span> <a href="#">Reorder</a> </span></td>
                            </tr>
                            <tr class="last even">
                              <td>500000001</td>
                              <td>9/9/10 </td>
                              <td>John Doe</td>
                              <td><span class="price"><i class="fa fa-rupee"></i> 1,397.99</span></td>
                              <td><em>Pending</em></td>
                              <td class="a-center last"><span class="nobr"> <a href="#">View Order</a> <span class="separator">|</span> <a href="#">Reorder</a> </span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="box-account">
                      <div class="page-title">
                        <h2>Account Information</h2>
                      </div>
                      <div class="col2-set">
                        <div class="col-1">
                          <h5>Contact Information</h5>
                          <a href="#">Edit</a>
                          <p>John Doe<br>
                            john.doe@gmail.com<br>
                            <a href="#">Change Password</a> </p>
                        </div>
                        <div class="col-2">
                          <h5>Newsletters</h5>
                          <a href="#">Edit</a>
                          <p> You are currently not subscribed to any newsletter. </p>
                        </div>
                      </div>
                      <div class="col2-set">
                        <h4>Address Book</h4>
                        <div class="manage_add"><a href="#">Manage Addresses</a> </div>
                        <div class="col-1">
                          <h5>Primary Billing Address</h5>
                          <address>John Doe<br>
                          aundh<br>
                          tyyrt,  Alabama, 46532<br>
                          United States<br>
                          T: 454541 <br>
                          <a href="#">Edit Address</a>
                          </address>
                        </div>
                        <div class="col-2">
                          <h5>Primary Shipping Address</h5>
                          <address>John Doe<br>  
                          aundh<br>
                          tyyrt,  Alabama, 46532<br>
                          United States<br>
                          T: 454541 <br>
                          <a href="#">Edit Address</a>
                          </address>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
              <!--  ///*///======    End article  ========= //*/// --> 
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
               <!--  <div class="side-banner"><img src="assets/images/side-banner.jpg" alt="banner"></div>--> 
                <div class="block block-account">
                  <div class="block-title">My Account</div>
                  <div class="block-content">
                    <ul>
                      <li class="current"><a>Account Dashboard</a></li>
                      <li><a href="#">Account Information</a></li>
                      <li><a href="#">Address Book</a></li>
                      <li><a href="#">My Orders</a></li>
                      <li><a href="#">Billing Agreements</a></li>
                      <li><a href="#">Recurring Profiles</a></li>
                      <li><a href="#">My Product Reviews</a></li>
                      <li><a href="#">My Tags</a></li>
                      <li><a href="#">My Wishlist</a></li>
                      <li><a href="#">My Downloadable</a></li>
                      <li class="last"><a href="#">Newsletter Subscriptions</a></li>
                    </ul>
                  </div>
                </div>
            </aside>        
        </div>
    </div>
</section>
<!-- Main Container End --> 



<?php include("include/footer.php"); ?>

<?php include("include/script.php"); ?>
</body>
</html>
