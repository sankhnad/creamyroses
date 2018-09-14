<div id="page">
<!--Start: Choose City Modal Box -->
<div class="modal fade" <?=CITY ? '': 'data-backdrop="static" data-keyboard="false"' ?>  id="ChooseCity" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
				<h4 class="modal-title text-center">Choose City</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-box">
                            <form id="search_mini_form" action="#" method="get">
                                <!-- Autocomplete End code -->
								<!--<input id="search" type="text" name="q" value="" placeholder="Search City..." class="searchbox" maxlength="128">-->
								<input id="search" type="search" onKeyUp="filterCity(this)" placeholder="Search City..." class="searchbox">
                                <button type="submit" title="Search" class="search-btn-bg" id="submit-button"></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <hr>
                        <h4>All City</h4>
                        <hr>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 allCityList">
                        <ul>
							<?php foreach($cityListsObj as $cityLists){
								echo '<li onClick="updateCitySelect(this, \''.encode($cityLists->cid).'\')"><a href="#">'.$cityLists->cityName.'</a></li>';
							}?>
                        </ul>
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<!--End: Choose City Modal Box -->

<!--Start: Main Header -->
<header>
    <!--Start:  Top Content -->
    <div class="header-container">
        <div class="container">
            <div class="row">
                <!-- Header Top Links -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="toplinks">
                        <div class="links"> 
                            <?php if(!isset($CID)){?>
								<div class="block-company-wrapper hidden-xs">
									<a href="<?=base_url()?>login">Login/Register</a>
								</div>
							<?php } ?>
                            <!--<div class="block-company-wrapper hidden-xs"><a title="Membership" href="membership.php">Membership</a></div>-->
							<?php if(isset($CID)){?>							
							<div class="dropdown block-company-wrapper hidden-xs">
								<a class="block-company dropdown-toggle" href="#" type="button" data-toggle="dropdown">
									Hi, <?=isset($customerName)?$customerName:'';?> <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?=base_url()?>profile">My Profile</a> </li>
									<li><a href="<?=base_url()?>orders">Orders</a> </li>
									<li><a href="<?=base_url()?>wishlist">Wishlist</a> </li>
									<li><a href="<?=base_url()?>logout">Logout </a> </li>
								</ul>
							</div>
							<!-- <div class="block-company-wrapper hidden-xs">
								<a title="Wishlist" href="wishlist">Wishlist</a>
							</div> -->
							<?php } ?>
                            <div class="block-company-wrapper hidden-xs"><a title="Sell on Creamy Roses" href="<?=base_url()?>contact-us">Sell on Creamy Roses</a></div>
                        </div>
                    </div>
                    <!-- End Header Top Links --> 
                </div>
            </div>
        </div>
    </div>
    <!--End:  Top Content -->

    <!--Start:  Middle Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-3 col-xs-12 logo-block">
                <!-- Header Logo -->
                <div class="logo"> 
                    <a href="./"><img class="center-block" alt="Logo" src="<?=$iURL_storeAssts?>images/logo.png"> </a> 
                </div>
                <!-- End Header Logo --> 
            </div>
        </div>
    </div>
    <!--End:  Middle Content -->

    <!--Start:  Categories Content -->
    <nav class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-3 hidden-xs">
                    <div class="mega-container visible-lg visible-md visible-sm visible-xs">
                        <div class="navleft-container">
                            <div class="mega-menu-title">
                                <h3><i class="fas fa-bars"></i> All Categories</h3>
                            </div>
                            
							<div class="mega_menu_NAV">
								<?php
									function get_menu($items, $class = '', $k = '1' ) {
										$html = '<ul class="navMeg'.$k++.'">';
										foreach($items as $key => $value){
											$html .= '<li><a href="'.base_url().$value['url_slug'].'"><i class="fa fa-home"></i> '.$value['name'].'</a>';
											if ( array_key_exists( 'child', $value ) ) {
												$html .= get_menu( $value[ 'child' ], 'child', $k );
											}
											$html .= "</li>";
										}
										$html .= "</ul>";
										return $html;
									}
									echo get_menu($catListAry[1]);
								?>
							</div>
                        </div>
                    </div>
                </div>

                <!-- Search box -->
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 category-search-form hidden-xs">
                    <div class="search-box">
                        <form id="search_mini_form" action="#" method="get">
                            <!-- Autocomplete End code -->
                            <input id="search" type="text" name="q" value="" placeholder="Search flowers, cakes, gifts etc." class="searchbox" maxlength="128">
                            <button type="submit" title="Search" class="search-btn-bg" id="submit-button"></button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5 col-md-3 col-sm-3 col-xs-12  card_wishlist_area">
                    <div class="mm-toggle-wrap">
                        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
                    </div>
                    <div class="card_wishlist_area">

                        <div class="col-3 top-cart-contain">
                            <!-- Top Cart -->
                            <div class="mini-cart">
                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#"><span class="price hidden-xs">Shopping Cart</span> <span class="cart_count hidden-xs shoppingCartValue">Cart empty</span> </a></div>
                                <div>
                                    <div class="top-cart-content">
										<?=getCartHTMLData();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- mgk wishlist --> 

                        <div class="col-3 top-cart-contain"> 
                            <!-- Top Cart -->
                            <div class="mini-cart location">
                                <div class="basket dropdown-toggle"> <a href="#"   data-toggle="modal" data-target="#ChooseCity"><span class="price hidden-xs">Delivery City</span> <span class="cart_count hidden-xs"><?=CITY_NAME ?CITY_NAME:'Choose City'; ?></span> </a> </div>
                            </div>
                        </div>

                        <div class="col-3 top-cart-contain">
                            <!-- Top Cart -->
                            <div class="mini-cart delivery">
                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> 
                                    <a href="#"><i class="fas fa-shipping-fast"></i> 
                                    <span class="price hidden-xs">Fastest delivery </span> 
                                    <span class="cart_count hidden-xs">Any time</span> 
                                    </a> 
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--End:  Categories Content -->
</header>
<!-- End: Main Header -->




