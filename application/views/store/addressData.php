<?php
if ( $data ) {	
	$textLbl 		= 'Update';
	$aid			= $data[0]->aid;
	$name			= $data[0]->name;
	$mobile			= $data[0]->mobile;
	$pin			= $data[0]->pin;
	$address_line_1 = $data[0]->address_line_1;
	$address_line_2 = $data[0]->address_line_2;
	$landmark		= $data[0]->landmark;
	$city			= $data[0]->city;
	$sid			= $data[0]->stateCode;
	$type			= $data[0]->type;
	$isDefault		= $data[0]->isDefault;
	$remarks		= $data[0]->remarks;
} else {
	$aid = $name = $mobile = $pin = $address_line_1 = $address_line_2 = $landmark = $city = $sid = $type = $isDefault = $remarks = '';
	$textLbl 		= 'Add';

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/commonfile.php');?>
<title>Address Book | Creamy Roses</title>
<?php include("includes/style.php"); ?>
</head>
<body class="shopping-cart-page">
<?php include("includes/header.php"); ?>
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
              <div class="box-account">
                <div class="page-title">
                  <h2>Add New Address</h2>
                </div>
                <div class="col2-set">
                  <div class="content">
                    <form id="editNewAddress" novalidate>
                      <input type="hidden" name="aid" value="<?=encode($aid)?>"/>
                      
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="required">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?=$name?>" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">Mobile</label>
                            <input data-tooltip="tooltip" title="10-digit mobile number without prefixes" type="text" name="mobile" data-mask="0000000000" class="form-control" value="<?=$mobile?>" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Country</label>
                            <select class="selectpicker" data-width="100%" title="Select Country" disabled required>
                              <option selected>India</option>
                            </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">PIN Code</label>
                            <input data-tooltip="tooltip" title="6 digits [0-9] pincode" onBlur="getZipData(this.value)" type="text" name="pin" data-mask="000000" class="form-control" value="<?=$pin?>" required/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label class="required">Street Address</label>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="addresline1" class="form-control" maxlength="60" placeholder="Flat / House No. / Floor / Building"  value="<?=$address_line_1?>" required>
                            </div>
                            <div class="col-md-6">
                              <input type="text" name="addresline2" class="form-control" maxlength="60" placeholder="Colony / Street / Locality"  value="<?=$address_line_2?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Land Mark</label>
                          <input type="text" name="landmark" class="form-control" maxlength="60" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc."  value="<?=$landmark?>">
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="required">City</label>
                            <input type="text" name="city" class="form-control" maxlength="60" required value="<?=$city?>"/>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="required">State</label>
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
                          </div>
                          <div class="form-group col-md-6">
                            <label>Address Type</label>
                            <div class="borderChexBx radioBtnAr">
                              <label>
                              <input name="type" id="homeTyp" type="radio" <?=$type == 0?'checked="checked"':'';?> <?=$aid ?'':'checked="checked"';?>  class="ace" value="0" />
                              <span class="lbl"> Home</span> </label>
                              <label>
                              <input name="type" id="officeTyp" type="radio" <?=$type == 1?'checked="checked"':'';?> class="ace" value="1" />
                              <span class="lbl"> Office</span> </label>
                              <label>
                              <input name="type" id="otherTyp"  type="radio" <?=$type == 2?'checked="checked"':'';?> class="ace" value="2" />
                              <span class="lbl"> Others</span> </label>
                            </div>
                          </div>
                          <div class="form-group col-md-6 otherTypAdrs">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" maxlength="100" placeholder="E.g. My Sweet Home; Sister's Office etc." value="<?=$remarks?>">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer posR">
                        <div class="groupSwitch">
                          <label>Mark as a default address</label>
                          <label class="switchS">
                          <input name="isDefault" <?=$isDefault == 1?'checked="checked"':'';?> value="1" class="switchS-input" type="checkbox">
                          <span class="switchS-label" data-on="Yes" data-off="No"></span> <span class="switchS-handle"></span> </label>
                        </div>
                        <a class="btn btn-inverse waves-effect waves-light m-r-10" href="<?=base_url()?>address-book">Back</a>
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> <?=$textLbl?></button>
                      </div>
                    </form>
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
            <?php include("includes/left_tab.php"); ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Main Container End -->
<?php include("includes/footer.php"); ?>
<?php include("includes/script.php"); ?>
</body>
</html>
