


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
                       <div class="content">
                    <form id="editNewAddress" novalidate>
                      <input type="hidden" name="aid" value=""/>
                      
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="required">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Full Name"  required>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">Mobile</label>
                            <input data-tooltip="tooltip" title="10-digit mobile number without prefixes" type="text" name="mobile" data-mask="0000000000" class="form-control"  required>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Country</label>
                            <select class="selectpicker" data-width="100%" title="Select Country" disabled required>
                              <option selected>India</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">PIN Code</label>
                            <input data-tooltip="tooltip" title="6 digits [0-9] pincode" onBlur="getZipData(this.value)" type="text" name="pin" data-mask="000000" class="form-control" value="" required/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label class="required">Street Address</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="addresline1" class="form-control" maxlength="60" placeholder="Flat / House No. / Floor / Building"   required>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="addresline2" class="form-control" maxlength="60" placeholder="Colony / Street / Locality" >
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Land Mark</label>
                          <input type="text" name="landmark" class="form-control" maxlength="60" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc."  value="">
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="required">City</label>
                            <input type="text" name="city" class="form-control" maxlength="60" required value=""/>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">State</label>
                            <select class="selectpicker" data-width="100%" name="state" title="Select State" data-live-search="true" required>
                              <?php 
							foreach($stateAry as $stateData){
							?>
                              <option value="<?=$stateData->sid?>"><?=$stateData->stateName?> </option>
							<?php  } ?>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Address Type</label>
                            <div class="borderChexBx radioBtnAr">
                              <label>
                              <input name="type" id="homeTyp" type="radio" checked  class="ace" value="0" />
                              <span class="lbl"> Home</span> </label>
                              <label>
                              <input name="type" id="officeTyp" type="radio"  class="ace" value="1" />
                              <span class="lbl"> Office</span> </label>
                              <label>
                              <input name="type" id="otherTyp"  type="radio"  class="ace" value="2" />
                              <span class="lbl"> Others</span> </label>
                            </div>
                          </div>
                          <div class="form-group col-md-6 otherTypAdrs">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" maxlength="100" placeholder="E.g. My Sweet Home; Sister's Office etc." >
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer posR">
                        <div class="groupSwitch">
                          <label>Mark as a default address</label>
                          <label class="switchS">
                          <input name="isDefault" value="1" class="switchS-input" type="checkbox">
                          <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> </label>
                        </div>
                        <a class="btn btn-inverse waves-effect waves-light m-r-10" href="<?=base_url()?>address-book">Back</a>
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Add Address</button>
                      </div>
                    </form>
                  </div>
                </div>    
                
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                 <div class="side-banner"><img src="<?=base_url()?>assets/store/images/side-banner.jpg" width="100%" alt="banner"></div> 
                
            </aside>
        </div>
    </div>
</section>

	
	</div>

<!-- Main Container End --> 
	<?php include("includes/footer.php"); ?>
	<?php include("includes/script.php"); ?>
	<script type="text/javascript" src="<?=$iURL_storeAssts?>js/cloud-zoom.js"></script>
</body>
</html>